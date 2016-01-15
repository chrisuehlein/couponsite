<?php 
/**
* ----------------------------------------------------------------------------------------
*    Deal Filter Widget
* ----------------------------------------------------------------------------------------
*/
Class SSD_Widget_Deal_Filter extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => esc_html__('This widget adds deal filter tools to your site.','couponhut') );
		parent::__construct( 'deal_filter', esc_html__('[CouponHut] Deal Filter', 'couponhut'), $widget_ops );

	}

	
	public function widget( $args, $instance ) {

		wp_enqueue_script( 'ssd_deal-filter-widget', get_template_directory_uri() . '/inc/widgets/deal-filter/assets/js/scripts.js', 'jquery', '1.0', true );

		extract($args);

		$deal_cats = get_terms('deal_category', array( 
			'hide_empty' => 0 
		));

		$deal_companies = get_terms('deal_company', $term_args );

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
		$days_start = empty( $instance['days_start'] ) ? '0' : $instance['days_start'];
		$days_end = empty( $instance['days_end'] ) ? '100' : $instance['days_end'];

		echo $before_widget;

		echo '<div class="deal-filter-widget-wrapper">';
		
		if ( $title ) { echo $before_title . $title . $after_title; }

		$template_url = fw_ssd_get_browse_template_url();
		if ( !$template_url ) : ?>
			<p><?php esc_html_e('<strong>Note!</strong> Make sure than you have published one (and only one) page that uses the "Browse Deals" Template.', 'couponhut') ?></p>
		<?php else:	?>

		<form action="<?php echo esc_url($template_url); ?>">

			<?php
				if ( isset($_GET['days_start_range']) && isset($_GET['days_end_range']) ) {
				$days_start_default = $_GET['days_start_range'];
				$days_end_default = $_GET['days_end_range'];
			} else {
				$days_start_default = $days_start;
				$days_end_default = $days_end;
			}
			?>

			<div class="days-slider-wrapper">
				<div class="days-slider-numbers">
					<span class="days-slider-left-number"><?php echo wp_kses_post($days_start); ?></span>-<span class="days-slider-right-number"><?php echo wp_kses_post($days_end); ?></span><span class="days-slider-days-text"><?php esc_html_e('Days', 'couponhut'); ?></span>
				</div>
				<div class="slider" data-days-start="<?php echo esc_attr($days_start); ?>" data-days-end="<?php echo esc_attr($days_end); ?>" data-days-start-default="<?php echo esc_attr($days_start_default); ?>" data-days-end-default="<?php echo esc_attr($days_end_default); ?>"></div> 
				
			</div><!-- end days-slider-wrapper -->

			<?php
			if ( ! empty( $deal_cats ) && ! is_wp_error( $deal_cats ) ){

				if ( !empty($_GET['deal_category']) ) {
					$deal_cat_current = $_GET['deal_category'];
				} else {
					$deal_cat_current = '';
				}

				// Categories Dropdown
				echo '<div class="dropdown">';

				echo '<button id="categories-widget-dropdown dropdown-menu-one-column" class="btn-dropdown" data-toggle="dropdown" >' . esc_html__('Categories', 'couponhut') . '</button>';

				echo '<ul class="dropdown-menu dropdown-menu-one-column" aria-labelledby="categories-widget-dropdown" data-name="deal_category">';
					echo '<li>
							<a href="#" data-value="" data-current="' . $current . '">' . esc_html__('None', 'couponhut') . '</a>
						</li>';
				foreach ( $deal_cats as $deal_cat ) {
					$icon_class = get_field('icon', "{$deal_cat->taxonomy}_{$deal_cat->term_id}");
					if ( $deal_cat->slug ==  $deal_cat_current ) {
						$current = 'true';
					} else {
						$current = 'false';
					}
					echo '<li>
						<a href="' . get_term_link($deal_cat) . '" data-value="' . $deal_cat->slug . '" data-current="' . $current . '"><i class="' . $icon_class . '"></i>' . $deal_cat->name . '</a>
					</li>';
				}
				echo '</ul>';
				echo '</div>';

			}


			if ( ! empty( $deal_companies ) && ! is_wp_error( $deal_companies ) ){

				if ( !empty($_GET['deal_company']) ) {
					$deal_company_current = $_GET['deal_company'];
				} else {
					$deal_company_current = '';
				}

				// Companies Dropdown
				echo '<div class="dropdown">';

					echo '<button id="companies-widget-dropdown" class="btn-dropdown" data-toggle="dropdown" >' . esc_html__('Companies', 'couponhut') . '</button>';

					echo '<ul class="dropdown-menu" aria-labelledby="companies-widget-dropdown" data-name="deal_company">';

						echo '<li>
							<a href="#" data-value="" data-current="' . $current . '">' . esc_html__('None', 'couponhut') . '</a>
						</li>';

					foreach ( $deal_companies as $deal_company ) {

						if ( $deal_company->slug ==  $deal_company_current ) {
							$current = 'true';
						} else {
							$current = 'false';
						}
						echo '<li>
							<a href="' . get_term_link($deal_company) . '" data-value="' . $deal_company->slug . '" data-current="' . $current . '">' . $deal_company->name . '</a>
						</li>';
					}
					echo '</ul>';
				echo '</div>';
			}
			?>


			<input type="hidden" value="" name="days_start_range">
			<input type="hidden" value="" name="days_end_range">
			<input type="hidden" value="<?php echo esc_attr($deal_cat_current); ?>" name="deal_category">
			<input type="hidden" value="<?php echo esc_attr($deal_company_current); ?>" name="deal_company">
			<button type="submit" ><?php esc_html_e('Filter Deals', 'couponhut') ?></button>

		</form>
		

		<?php
		echo '</div><!-- end deal-filter-widget-wrapper -->';

		echo $after_widget;

		endif; //count($pages)

	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['days_start'] = strip_tags($new_instance['days_start']);
		$instance['days_end'] = strip_tags($new_instance['days_end']);

		return $instance;

	}

	public function form( $instance ) {

		$defaults = array(
			'title' => '',
			'days_start' => 0,
			'days_end' => 100,
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'couponhut') ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('days_start')); ?>"><?php esc_html_e('Start Day Limit', 'couponhut') ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('days_start')); ?>" name="<?php echo esc_attr($this->get_field_name('days_end')); ?>" type="text" value="<?php echo esc_attr($instance['days_start']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('days_end')); ?>"><?php esc_html_e('End Day Limit', 'couponhut') ?>:</label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('days_end')); ?>" name="<?php echo esc_attr($this->get_field_name('days_end')); ?>" type="text" value="<?php echo esc_attr($instance['days_end']); ?>" />	
		</p>
	<?php
	}

}
?>