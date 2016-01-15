<?php if (!defined('FW')) die( 'Forbidden' ); ?>

<h4 class="list-menu-title"><?php esc_html_e('Categories', 'couponhut'); ?><i class="fa fa-chevron-down"></i></h4>

<?php 
$term_args = array( 'hide_empty' => 0 );
$deal_cats = get_terms('deal_category', $term_args );

 if ( ! empty( $deal_cats ) && ! is_wp_error( $deal_cats ) ){
	echo '<ul class="nav nav-stacked list-menu">';
	foreach ( $deal_cats as $deal_cat ) {
		if ( taxonomy_exists('deal_company') ) {
			$icon_class = get_field('icon', "{$deal_cat->taxonomy}_{$deal_cat->term_id}");
			echo '<li>
			<a href="' . get_term_link($deal_cat) . '"><i class="' . $icon_class . '"></i><span>' . $deal_cat->name . '<span class="number-counter">' . $deal_cat->count . '</span></span></a>
		</li>';
	}
		
	}
	echo '</ul>';
}
?>

