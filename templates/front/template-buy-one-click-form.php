<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php $is_quote_mode = !empty($is_quote_mode); ?>
<div class="mrkv_buy-one-click__form<?php echo $is_quote_mode ? ' mrkv_buy-one-click--quote' : ''; ?>">
	<div class="mrkv_buy-one-click__overlay"></div>
	<div class="mrkv_buy-one-click__form__inner">
		<div class="mrkv_buy-one-click__close_form">
			<svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.7457 3.32851C20.3552 2.93798 19.722 2.93798 19.3315 3.32851L12.0371 10.6229L4.74275 3.32851C4.35223 2.93798 3.71906 2.93798 3.32854 3.32851C2.93801 3.71903 2.93801 4.3522 3.32854 4.74272L10.6229 12.0371L3.32856 19.3314C2.93803 19.722 2.93803 20.3551 3.32856 20.7457C3.71908 21.1362 4.35225 21.1362 4.74277 20.7457L12.0371 13.4513L19.3315 20.7457C19.722 21.1362 20.3552 21.1362 20.7457 20.7457C21.1362 20.3551 21.1362 19.722 20.7457 19.3315L13.4513 12.0371L20.7457 4.74272C21.1362 4.3522 21.1362 3.71903 20.7457 3.32851Z" fill="#0F0F0F"></path> </g></svg>
		</div>
		<div class="mrkv_buy-one-click__form__inner__info">
			<?php do_action('mrkv_buy_one_click_before_title'); ?>
			<h2 class="mrkv_buy-one-click__title"><?php echo esc_html($form_title); ?></h2>
			<p class="mrkv_buy-one-click__subtitle"><?php echo esc_html($form_subtitle); ?></p>
			<?php do_action('mrkv_buy_one_click_after_subtitle'); ?>
			<div class="mrkv_buy-one-click__form__line">
				<label for="mrkv_buy-one-click__username"><?php echo esc_html__( 'First Name', 'morkva-buy-one-click' ); ?></label>
				<input id="mrkv_buy-one-click__username" placeholder="<?php echo esc_html__( 'Enter your name...', 'morkva-buy-one-click' ); ?>" name="mrkv_buy-one-click__username" type="text">
			</div>
			<div class="mrkv_buy-one-click__form__line">
				<label for="mrkv_buy-one-click__phone"><?php echo esc_html__( 'Phone', 'morkva-buy-one-click' ); ?></label>
				<input id="mrkv_buy-one-click__phone" placeholder="+380" name="mrkv_buy-one-click__phone" type="tel">
			</div>
			<input type="hidden" id="mrkv_buy-one-click__is_quote" value="<?php echo $is_quote_mode ? '1' : '0'; ?>">
			<div data-prod-id="<?php echo esc_attr($product_id); ?>" class="mrkv_buy-one-click__product-data"></div>
			<p class="mrkv_buy-one-click__above_btn"><?php echo esc_html($before_btn_text); ?></p>
			<?php do_action('mrkv_buy_one_click_before_create_btn'); ?>
			<div class="mrkv_buy-one-click__create_order button <?php echo esc_attr($flatsome_btn_class); ?>"><?php echo esc_html($button_form_txt); ?> <div class="mrkv_buy-one-click__loader"></div></div>
			<?php do_action('mrkv_buy_one_click_after_create_btn'); ?>
		</div>
		<div class="mrkv_buy-one-click__form__inner__result">
			<h2>
				<?php echo wp_kses( $result_title, array(
			    'span' => array(
			        'class' => array(),
			    ),
				) ); ?>
			</h2>
			<p><?php echo esc_html($result_text); ?></p>
		</div>
	</div>
</div>