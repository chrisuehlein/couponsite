<?php

if( get_query_var( 'paged' ) )
	$paged = get_query_var( 'paged' );
else {
	if( get_query_var( 'page' ) )
		$paged = get_query_var( 'page' );
	else
		$paged = 1;
	set_query_var( 'paged', $paged );
}

$args = array(
	'post_type' => 'deal',
	'posts_per_page' => fw_ssd_get_option('deals-per-page'),
	'paged' => $paged
);

$rating_type = get_field('rating_type', 'option');


if ( isset($_GET['sort']) ) {

	if ( $_GET['sort'] == 'rating' ) {

		$args['meta_key'] = 'rating_average';
		$args['meta_query'] = array(
			'rating_average_clause' => array(
				'key' => 'rating_average'
				),
			'stars_total_clause' => array(
				'key' => 'stars_total',
			)
		);
		$args['orderby'] = array(
			'rating_average_clause' => 'DESC',
			'stars_total_clause' => 'DESC'
		);

	}

	if ( $_GET['sort'] == 'expiring' ) {
		$args['meta_key'] = 'expiring_date';
		$args['orderby'] = 'meta_value_num';
		$args['order'] = 'asc';
	}

	if ( $_GET['sort'] == 'popular' ) {
		$args['orderby'] = 'comment_count';
		$args['order'] = ' desc';
	}

}

if ( !empty($_GET['deal_category']) ) {
	$cat_slug = $_GET['deal_category'];
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'deal_category',
			'field' => 'slug',
			'terms' => $cat_slug

		)
	);
}

if ( !empty($_GET['deal_company']) ) {
	$company_slug = $_GET['deal_company'];
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'deal_company',
			'field' => 'slug',
			'terms' => $company_slug

		)
	);
}

if ( isset($_GET['days_start_range']) && isset($_GET['days_end_range']) ) {

	$min = (int)$_GET['days_start_range'];
	$max = (int)$_GET['days_end_range'];

	$days_start = new DateTime('now + ' . $min . ' days');
	$days_start = $days_start->format('Ymd');
	$days_end = new DateTime('now + ' . $max . ' days');
	$days_end = $days_end->format('Ymd');

	if ( version_compare(phpversion(), '5.3') < 0 ) : ?>
		<div class="alert"><?php esc_html_e("It seems like your hosting provider isn't supporting PHP version at least 5.3. Please contact him or choose another provider as the date functions will not work correctly on your current configuration.", 'couponhut') ?></div>
	<?php
	endif;

	if ( !isset( $args['meta_query'] ) ) {
		$args['meta_query'] = array();
	}

	array_push(
		$args['meta_query'], 
		array(
			'key' => 'expiring_date',
			'value' => array( $days_start, $days_end ),
			'compare' => 'BETWEEN',
			'type' => 'UNSIGNED'
		)
	);

}

// Query only not expired deals

if ( !isset( $args['meta_query'] ) ) {
	$args['meta_query'] = array();
}

array_push(
	$args['meta_query'], 
	array(
		'relation' => 'OR',
		array(
			'key' => 'expiring_date',
			'value' => date('Ymd'),
			'compare' => '>=',
			'type' => 'UNSIGNED'
		),
		array(
			'key' => 'expiring_date',
			'value' => ''
		)
	)
);

$deals_query = new WP_Query($args); // The Query

?>

<?php 

	/**
	*  Posts Loop
	*/
	if ($deals_query->have_posts()) : ?>

	<div class="isotope-wrapper" data-isotope-cols="3" data-isotope-gutter="30">
		
		<?php while  ( $deals_query->have_posts() ) : $deals_query->the_post(); ?>

			<div class="deal-item-wrapper">
				<?php get_template_part('loop/content', 'deal'); ?>
			</div>
				
		<?php
		endwhile;
		?>

	</div><!-- end isotope-wrapper -->

	<?php
	// Pagination
	fw_ssd_paging_nav($deals_query);

	wp_reset_postdata();

	endif; //have_posts()
	?>