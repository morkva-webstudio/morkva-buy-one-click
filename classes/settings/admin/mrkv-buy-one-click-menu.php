<?php
# Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

# Check if class exist
if (!class_exists('MRKV_BUY_ONE_CLICK_MENU'))
{
	/**
	 * Class for setup plugin admin menu
	 */
	class MRKV_BUY_ONE_CLICK_MENU
	{
		/**
	     * Slug for page in Woo Tab Sections
	     * 
	     * */
	    private $slug = 'mrkv_buy_one_click_settings';

		/**
		 * Constructor for plugin admin menu
		 * */
		function __construct()
		{
			# Register page settings
			add_action('admin_menu', array($this, 'mrkv_buy_one_click_register_plugin_page'), 99);
		}

		/**
		 * Add settings page to menu
		 * */
		public function mrkv_buy_one_click_register_plugin_page()
		{
			# Add menu to WP
	        add_menu_page(__('morkva quick order button', 'morkva-buy-one-click'), __('morkva quick order button', 'morkva-buy-one-click'), 'manage_options', $this->slug, array($this, 'mrkv_buy_one_click_get_plugin_settings_content'), MRKV_BUY_ONE_CLICK_PLUGIN_URL . 'assets/images/morkva-icon-20x20.svg');
		}

		/**
		 * Get settings page
		 * */
		public function mrkv_buy_one_click_get_plugin_settings_content()
		{
			# Header data
			$header_pre_link = '/wp-admin/admin.php?page=';
			$current_page = 'mrkv_buy_one_click_settings';	

			# Tab list
			$mrkv_boclick_tabs = array(
				'basic_settings' => __('Basic', 'morkva-buy-one-click'),
				'styles_settings' => __('Styles', 'morkva-buy-one-click'),
			);

			# Position list 
			$all_position_availiable = array(
				'shortcode' => __('Shortcode', 'morkva-buy-one-click'),
				'after_add_to_cart_button_main' => __('After add to cart button', 'morkva-buy-one-click'),
				'after_add_to_cart_button' => __('Summary', 'morkva-buy-one-click'),
			);

			# Get data settings 
			$settings_slug = 'mrkv_buy_one_settings';
			$settings_data = get_option($settings_slug);

			# Get field creator object
			require_once MRKV_BUY_ONE_CLICK_PLUGIN_PATH . 'classes/settings/global/mrkv-buy-one-click-option-fields.php';
			$field_creator = new MRKV_BUY_ONE_CLICK_OPTION_FILEDS();

			# Sanitized fields validator
			$allowed_tags = array(
			    'input' => array(
			        'id'          => true,
			        'type'        => true,
			        'name'        => true,
			        'checked'     => true,
			        'value'       => true,
			        'class'       => true,
			        'placeholder' => true,
			    ),
			    'label' => array(
			        'for'   => true,
			        'class' => true,
			    ),
			    'div' => array(
			        'class' => true,
			    ),
			    'span' => array(
			        'class' => true,
			    ),
			    'select' => array(
			        'id'       => true,
			        'name'     => true,
			        'class'    => true,
			        'multiple' => true,
			        'size'     => true,
			    ),
			    'option' => array(
			        'value'    => true,
			        'selected' => true,
			        'label'    => true,
			    ),
			    'p' => array(
			        'class' => true,
			    )
			);

			# Get all statuses
			$all_order_statuses = wc_get_order_statuses();

			# Include template
			include MRKV_BUY_ONE_CLICK_PLUGIN_PATH . 'templates/settings/template-buy-one-click-settings.php';
		}
	}
}