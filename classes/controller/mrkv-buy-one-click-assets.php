<?php
# Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

# Check if class exist
if (!class_exists('MRKV_BUY_ONE_CLICK_FRONT_ASSETS'))
{
	/**
	 * Class for setup plugin front assets
	 */
	class MRKV_BUY_ONE_CLICK_FRONT_ASSETS
	{
		/**
		 * Constructor for plugin front assets
		 * */
		function __construct()
		{
			add_action( 'wp_enqueue_scripts', [$this, 'mrkv_enqueue_assets_on_product_page'] );
		}

		public function mrkv_enqueue_assets_on_product_page()
		{
			if ( is_product() ) 
			{
				$settings_data = get_option('mrkv_buy_one_settings');
				$is_active_show = isset($settings_data['enabled']) ? $settings_data['enabled'] : '';

				if($is_active_show)
				{
					# Styles
					$form_background = '#ffffff';
					$form_text_color = '#000000';
					$form_btn_back = isset($settings_data['style']['form_btn_back']) ? $settings_data['style']['form_btn_back'] : '#ed6230';
					$form_btn_txt = '#ffffff';
					$open_btn_back = isset($settings_data['style']['open_btn_back']) ? $settings_data['style']['open_btn_back'] : '#ed6230';
					$open_btn_txt = '#ffffff';
					$border_style = '0';

					$border_radius = ($border_style) ? $border_style . 'px' : '0px'; 

					# Typography
					$title_fs = isset($settings_data['style']['title_fs']) ? $settings_data['style']['title_fs'] : '';
					$subtitle_fs = isset($settings_data['style']['subtitle_fs']) ? $settings_data['style']['subtitle_fs'] : '';
					$label_fs = isset($settings_data['style']['label_fs']) ? $settings_data['style']['label_fs'] : '';
					$button_fs = isset($settings_data['style']['button_fs']) ? $settings_data['style']['button_fs'] : '';

					$settings_css = "
					    .mrkv_buy-one-click__form__inner, .mrkv_buy-one-click__open-call.button,
					    #mrkv_buy-one-click__username, #mrkv_buy-one-click__phone, .mrkv_buy-one-click__create_order.button,
					    .mrkv_buy-one-click__form__inner .iti__selected-flag {
					        border-radius: " . esc_attr($border_radius) . " !important;
					    }
					    .mrkv_buy-one-click__form__inner {
					        background-color: " . esc_attr($form_background) . ";
					        color: " . esc_attr($form_text_color) . ";
					    }
					    .mrkv_buy-one-click__form__inner h2,
					    .mrkv_buy-one-click__form__inner p,
					    .mrkv_buy-one-click__form__inner label,
					    .mrkv_buy-one-click__product__info h5 {
					        color: " . esc_attr($form_text_color) . ";
					    }
					    .mrkv_buy-one-click__title {
					        font-size: " . esc_attr($title_fs) . "px;
					    }
					    .mrkv_buy-one-click__form__inner p {
					        font-size: " . esc_attr($subtitle_fs) . "px;
					    }
					    .mrkv_buy-one-click__form__inner label {
					        font-size: " . esc_attr($label_fs) . "px;
					    }
					    .mrkv_buy-one-click__open-call.button {
					        background-color: " . esc_attr($open_btn_back) . ";
					        color: " . esc_attr($open_btn_txt) . ";
					        font-size: " . esc_attr($button_fs) . "px;
					    }
					    .mrkv_buy-one-click__create_order.button {
					        background-color: " . esc_attr($form_btn_back) . ";
					        color: " . esc_attr($form_btn_txt) . ";
					        font-size: " . esc_attr($button_fs) . "px;
					    }
					";

					$country = WC()->countries->get_base_country();

					if (!$country) {
					    $country = 'US';
					}

					$country = strtolower(substr($country, 0, 2));


					$args = array(
			        	'ajax_url' => admin_url( 'admin-ajax.php' ),
			        	'default_country' => $country,
			        	'nonce'    => wp_create_nonce('mrkv_buy_one_click_nonce')
			        );

					# Custom style and script
			        wp_enqueue_style('front-mrkv-buy-one-click', MRKV_BUY_ONE_CLICK_PLUGIN_URL . 'assets/css/front/front-mrkv-buy-one-click.css', array(), '0.1.0');
			        wp_enqueue_script('front-buy-one-click', MRKV_BUY_ONE_CLICK_PLUGIN_URL . 'assets/js/front/front-buy-one-click.js', array('jquery'), '0.1.0', true);
			        wp_localize_script('front-buy-one-click', 'mrkv_buy_one_click_helper', $args);

			        wp_add_inline_style( 'front-mrkv-buy-one-click', $settings_css );

			        wp_enqueue_style(
					    'intl-tel-input',
					    MRKV_BUY_ONE_CLICK_PLUGIN_URL . 'assets/css/front/front-mrkv-but-one-click-tel.css',
					    array(),
					    '17.0.8'
					);

					wp_enqueue_script(
					    'intl-tel-input',
					    MRKV_BUY_ONE_CLICK_PLUGIN_URL . 'assets/js/front/front-mrkv-but-one-click-tel.js',
					    array('jquery'),
					    '17.0.8',
					    true
					);

					wp_enqueue_script(
					    'intl-tel-input-utils',
					    MRKV_BUY_ONE_CLICK_PLUGIN_URL . 'assets/js/front/utils.js',
					    array('intl-tel-input'),
					    '17.0.8',
					    true
					);

				}
			}
		}
	}
}