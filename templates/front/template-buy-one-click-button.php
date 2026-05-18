<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php $is_quote_mode = !empty($is_quote_mode); ?>
<div class="mrkv_buy-one-click__open-call button <?php echo esc_attr($flatsome_btn_class); ?><?php echo $is_quote_mode ? ' mrkv_buy-one-click--quote' : ''; ?>"
	data-quote="<?php echo $is_quote_mode ? '1' : '0'; ?>"><?php echo esc_html($open_call_btn_text); ?></div>