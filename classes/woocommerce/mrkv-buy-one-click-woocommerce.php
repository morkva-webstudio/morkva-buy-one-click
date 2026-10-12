<?php
# Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

# Check if class exist
if (!class_exists('MRKV_BUY_ONE_CLICK_WOOCOMMERCE'))
{
	/**
	 * Class for setup plugin settings WOOCOMMERCE
	 */
	class MRKV_BUY_ONE_CLICK_WOOCOMMERCE
	{
		/**
		 * Constructor for plugin settings WOOCOMMERCE
		 * */
		function __construct()
		{
			add_action( 'wp_ajax_mrkv_buy_one_click__create_order', array($this, 'mrkv_buy_one_click__create_order_func') );
			add_action( 'wp_ajax_nopriv_mrkv_buy_one_click__create_order', array($this, 'mrkv_buy_one_click__create_order_func') );

			add_action('woocommerce_single_product_summary', array($this, 'mrkv_buy_one_click_summary_add_btn'), 31);
			add_action('woocommerce_after_add_to_cart_button', array($this, 'mrkv_buy_one_click__add_btn'), 31);
		}

		/**
		 * Create buy one click order
		 * */
		public function mrkv_buy_one_click__create_order_func()
		{
			if (!isset($_POST['nonce']) || !wp_verify_nonce(sanitize_text_field( wp_unslash($_POST['nonce'])), 'mrkv_buy_one_click_nonce')) {
		        wp_send_json_error(__('Invalid nonce.', 'morkva-buy-one-click'), 403);
		        wp_die();
		    }

		    $product_id = isset($_POST['product_id']) ? sanitize_text_field(wp_unslash($_POST['product_id'])) : '';
		    $first_name = isset($_POST['first_name']) ? sanitize_text_field(wp_unslash($_POST['first_name'])) : '';
		    $phone = isset($_POST['phone']) ? '380' . sanitize_text_field(wp_unslash($_POST['phone'])) : '';
		    $is_quote_request = isset($_POST['is_quote']) && $_POST['is_quote'] === '1';

		    $product = wc_get_product( $product_id );

		    $settings_data = get_option('mrkv_buy_one_settings');
			$is_active_show = isset($settings_data['enabled']) ? $settings_data['enabled'] : '';
			$order_status = 'on-hold';

			# Server-side trust-but-verify: quote-mode needs the toggle on and a
			# simple product with an empty price (JS spoofing is ignored).
			$is_quote_mode = $is_quote_request
				&& !empty($settings_data['quote']['enabled'])
				&& $settings_data['quote']['enabled'] === 'on'
				&& $product instanceof WC_Product
				&& $product->is_type('simple')
				&& $product->get_price() === '';

		    if($is_active_show && $product && $first_name && $phone)
		    {
		    	if ( strpos( $order_status, 'wc-' ) !== 0 ) {
			        $order_status = 'wc-' . $order_status;
			    }

			    $order = new WC_Order();
			    $order->add_product( $product, 1 );
			    $order->set_billing_first_name( sanitize_text_field( $first_name ) );
    			$order->set_billing_phone( sanitize_text_field( $phone ) );
    			# Fields the checkout would set: order origin, account link, IP/UA (Meta CAPI matching)
    			$order->set_created_via( 'buy_one_click' );
    			$order->set_customer_id( get_current_user_id() );
    			$order->set_customer_ip_address( WC_Geolocation::get_ip_address() );
    			$order->set_customer_user_agent( wc_get_user_agent() );
    			$order->calculate_totals();

    			if ( $is_quote_mode ) {
    				$order->update_meta_data( '_mrkv_is_quote_request', 'yes' );
    				$order->add_order_note(
    					__( 'Quote request — product has no price; customer wants a quote.', 'morkva-buy-one-click' )
    				);
    			}

    			$order->set_status( $order_status );
    			$order_id = $order->save();

				do_action( 'mrkv_buy_one_click_order_created', $order_id, $product_id );

		    	if ( $order_id && WC()->mailer() && isset( WC()->mailer()->emails['WC_Email_New_Order'] ) ) {
			    	WC()->mailer()->emails['WC_Email_New_Order']->trigger( $order_id );
			    }

			    wp_send_json_success(
			    	array(
			    		'order_number' => $order->get_id()
			    	)
			    );
		    }

		    wp_die();
		}

		public function mrkv_buy_one_click_summary_add_btn()
		{
			$settings_data = get_option('mrkv_buy_one_settings');
			$position = isset($settings_data['position']) ? $settings_data['position'] : '';

			if ( $position === 'after_add_to_cart_button' ) {
				echo do_shortcode('[mrkv_buy_one_click]');
				return;
			}

			# Quote-mode fallback for the in-form position: an empty-price simple
			# product makes WC drop the add-to-cart form, so the primary hook
			# `woocommerce_after_add_to_cart_button` never fires. Render here.
			if ( $position !== 'after_add_to_cart_button_main' ) {
				return;
			}

			if ( empty($settings_data['quote']['enabled']) || $settings_data['quote']['enabled'] !== 'on' ) {
				return;
			}

			global $product;
			if ( ! $product instanceof WC_Product || ! $product->is_type('simple') || $product->get_price() !== '' ) {
				return;
			}

			# If the form still renders (product purchasable), the primary hook
			# will fire — avoid a double-render here.
			if ( $product->is_purchasable() ) {
				return;
			}

			echo do_shortcode('[mrkv_buy_one_click]');
		}

		public function mrkv_buy_one_click__add_btn()
		{
			$settings_data = get_option('mrkv_buy_one_settings');

		    if ( isset($settings_data['position']) && $settings_data['position'] === 'after_add_to_cart_button_main' ) {
		        echo do_shortcode('[mrkv_buy_one_click]');
		    }
		}
	}
}