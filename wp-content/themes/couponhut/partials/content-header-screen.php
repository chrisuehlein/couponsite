
<?php
	$image = fw_ssd_get_option('header-search-image');
	if ( $image ) {
		$bg_image = wp_get_attachment_image_src( $image['attachment_id'], 'ssd_single-post-image' );
		$image_url = $bg_image['0'];
	} else {
		$image_url = '';
	}
	

	// Categories
	$term_args = array( 'hide_empty' => 0 );
	$deal_cats = get_terms('deal_category', $term_args );

?>
<div class="header-screen">
	<div class="bg-image parallax" data-bgimage="<?php echo esc_url($image_url); ?>"></div>
	<div class="overlay-dark"></div>
	<div class="header-screen-content">
		<form action="<?php echo esc_url( home_url( "/" ) ); ?>" method="get" class="header-screen-search">
			<span><?php esc_html_e("I'm searching for", 'couponhut') ?></span>
			<input type="text" name="s" placeholder="<?php esc_attr_e('Deals & Coupons', 'couponhut');?>">
			<span><?php esc_html_e('in', 'couponhut');?></span>
			<?php 
			if ( ! empty( $deal_cats ) && ! is_wp_error( $deal_cats ) ){

				// Categories Dropdown
				echo '<div class="dropdown">';

				echo '<button id="categories-widget-dropdown dropdown-menu-one-column" class="btn-dropdown" data-toggle="dropdown" >' . esc_html__('Category', 'couponhut') . '</button>';

				echo '<ul class="dropdown-menu dropdown-menu-one-column" aria-labelledby="categories-widget-dropdown" data-name="category_name">';
					echo '<li>
							<a href="#" data-value="" data-current="' . $current . '">' . esc_html__('None', 'couponhut') . '</a>
						</li>';
				foreach ( $deal_cats as $deal_cat ) {
					$icon_class = get_field('icon', "{$deal_cat->taxonomy}_{$deal_cat->term_id}");
					echo '<li>
						<a href="' . get_term_link($deal_cat) . '" data-value="' . $deal_cat->slug . '"><i class="' . $icon_class . '"></i>' . $deal_cat->name . '</a>
					</li>';
				}
				echo '</ul>';
				echo '</div>';

			}
			?>
			<input type="hidden" name="post_type" value="deal" />
			<input type="hidden" name="category_name" value="beauty" />
			<input type="submit" id="searchsubmit" value="<?php esc_attr_e('Search', 'couponhut'); ?>" />
		</form>
	</div>
</div>