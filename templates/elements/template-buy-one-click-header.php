<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<div class="admin_mrkv_ua_shipping__header mrkv_block_rounded">
	<div class="admin_mrkv_ua_shipping__header__content">
		<a class="admin_mrkv_ua_shipping__header_img" href="<?php echo esc_url($header_pre_link); ?>mrkv_buy_one_click_settings">
			<img src="<?php echo esc_url(MRKV_BUY_ONE_CLICK_PLUGIN_URL . 'assets/images/buy-one-click.svg'); ?>" alt="morkva Buy One Click" title="morkva Buy One Click">
		</a>
		<a class="<?php if($current_page == 'mrkv_buy_one_click_settings'){ echo 'active'; } ?>" href="<?php echo esc_url($header_pre_link); ?>mrkv_buy_one_click_settings"><?php echo esc_html__('Global', 'morkva-buy-one-click'); ?></a>
		<a class="admin_mrkv_ua_shipping_morkva-logo" href="https://morkva.co.ua/" target="blanc">
			<img src="<?php echo esc_url(MRKV_BUY_ONE_CLICK_PLUGIN_URL . 'assets/images/morkva-logo.svg'); ?>" alt="morkva" title="morkva">
		</a>
	</div>
</div>