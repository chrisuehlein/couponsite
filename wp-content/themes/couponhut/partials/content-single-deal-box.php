<div class="single-deal-box">

	<div class="single-deal-box-inner">
		<?php if( get_field('expiring_date') ) : ?>
		<div class="single-deal-countdown">
			<i class="icon-Clock"></i>
			<p class="single-deal-expires-text"><?php esc_html_e('Expires in', 'couponhut'); ?></p>
			<div class="jscountdown-wrap" data-time="<?php echo esc_attr(get_field('expiring_date')) ?>" itemprop="availability" href="http://schema.org/InStock"></div>
		</div><!-- end single-deal-countdown -->
		<?php endif; ?>

	<?php if ( get_field('deal_summary') ) : ?>
		<div class="single-deal-summary" itemprop="description">
			<?php echo wp_kses_post(get_field('deal_summary')); ?>
		</div><!-- end single-deal-summary -->
	<?php endif; ?>

	<?php 
	$current_date = date('Y/m/d');

	if ( !get_field('expiring_date') || $current_date < get_field('expiring_date') ) {

		if ( get_field('deal_type') == 'discount' )  {

			echo'<a href="' . get_field('url') . '" target="_blank" class="btn btn-color btn-deal" data-post_id="' . get_the_ID() . '">' . fw_ssd_get_option('buy-now-text') . '</a>';

		} else {
			$enable_redirect = get_field('redirect_to_offer') ? get_field('redirect_to_offer') : array('');
			echo'<a href="' . esc_url(get_field('url')) . '" target="_blank" class="btn btn-color btn-deal show-coupon-code" data-target="#discount-modal" data-clipboard-text="' . esc_attr(get_field('coupon_code')) . '" data-redirect="' . $enable_redirect[0] . '">' . fw_ssd_get_option('show-code-text') . '</a>';
		}

	} else {
		echo'<button class="btn btn-deal btn-disabled">' . esc_html__('Deal Expired', 'couponhut') . '</button>';
	}
	?>

	<?php if( get_field('discount_value') ) : ?>
		<div class="discount-ribbon">
			<?php echo wp_kses_post(get_field('discount_value')); ?>
		</div>
	<?php endif; ?>

</div><!-- end single-deal-box-inner -->


</div><!-- end single-deal-box -->