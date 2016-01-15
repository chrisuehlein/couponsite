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

$args['meta_key'] = 'expiring_date';
$args['orderby'] = 'meta_value';
$args['order'] = 'asc';


// Query only not expired deals

$args['meta_query'] = array(
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