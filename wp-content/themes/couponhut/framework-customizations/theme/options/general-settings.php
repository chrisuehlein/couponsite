<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'general' => array(
		'title'   => __( 'General', 'couponhut' ),
		'type'    => 'tab',
		'options' => array(
			'logo_name'    => array(
				'label' => esc_html__( 'Logo Name', 'couponhut' ),
				'desc'  => esc_html__( 'Write your website logo name', 'couponhut' ),
				'type'  => 'text',
				'value' => get_bloginfo( 'name' )
			),
			'logo_image' => array(
				'label' => esc_html__( 'Logo Image', 'couponhut' ),
				'desc'  => esc_html__( 'Upload the logo image', 'couponhut' ),
				'type'  => 'upload',
				'images_only' => true
			),
			'top_logo_padding' => array(
				'type'  => 'text',
				'value' => '20px 0px 0px 0px',
				'label' => esc_html__('Logo Padding', 'couponhut'),
				'desc'  => esc_html__('Positon the logo in the main navigation - TOP(px), RIGHT(px), BOTTOM(px), LEFT(px)', 'couponhut'),
			),
			'footer_image' => array(
				'label' => esc_html__( 'Footer Image', 'couponhut' ),
				'desc'  => esc_html__( 'Upload a footer image', 'couponhut' ),
				'type'  => 'upload'
			),
			'copyright-text' => array(
				'label' => esc_html__( 'Copyright Text', 'couponhut' ),
				'type'  => 'text',
				'value' => '&copy; ' . date("Y") . ' CouponHut. All rights reserved.'
			)
		),
	),
	'layout' => array(
		'title'   => __( 'Styling & Layout', 'couponhut' ),
		'type'    => 'tab',
		'options' => array(
			'search-screen-post-switch' => array(
				'type'  => 'switch',
				'value' => 'hide',
				'label' => esc_html__('Show Search Header at the top of Blog Posts', 'couponhut'),
				'left-choice' => array(
					'value' => 'hide',
					'label' => esc_html__('Hide', 'couponhut'),
				),
				'right-choice' => array(
					'value' => 'show',
					'label' => esc_html__('Show', 'couponhut'),
				),
			),
			'search-screen-deal-switch' => array(
				'type'  => 'switch',
				'value' => 'hide',
				'label' => esc_html__('Show Search Header at the top of Deals', 'couponhut'),
				'left-choice' => array(
					'value' => 'hide',
					'label' => esc_html__('Hide', 'couponhut'),
				),
				'right-choice' => array(
					'value' => 'show',
					'label' => esc_html__('Show', 'couponhut'),
				),
			),
			'sidebar-switch' => array(
				'type'  => 'switch',
				'value' => 'right',
				'label' => esc_html__('Sidebar Position', 'couponhut'),
				'left-choice' => array(
					'value' => 'left',
					'label' => esc_html__('Left', 'couponhut'),
				),
				'right-choice' => array(
					'value' => 'right',
					'label' => esc_html__('Right', 'couponhut'),
				),
			),
			'header-search-image' => array(
				'label' => esc_html__( 'Header Search Image', 'couponhut' ),
				'desc'  => esc_html__( 'Upload the logo image', 'couponhut' ),
				'type'  => 'upload',
				'images_only' => true
			),
			'custom-css' => array(
				'type'  => 'textarea',
				'value' => '',
				'label' => esc_html__('Custom CSS', 'couponhut'),
				'desc'  => esc_html__('Paste your custom CSS here.', 'couponhut'),
			)
		)
	),
	'colors' => array(
		'title'   => __( 'Colors', 'couponhut' ),
		'type'    => 'tab',
		'options' => array(
			'color-main' => array(
				'type'  => 'color-picker',
				'value' => '#EF6464',
				'label' => esc_html__('Main Color', 'couponhut'),
				'desc' => esc_html__('Default: #EF6464', 'couponhut'),
			),
			
			'color-secondary' => array(
				'type'  => 'color-picker',
				'value' => '#84CC76',
				'label' => esc_html__('Secondary Color', 'couponhut'),
				'desc' => esc_html__('Default: #84CC76', 'couponhut'),
			),
			'color-secondary-light' => array(
				'type'  => 'color-picker',
				'value' => '#a5da9b',
				'label' => esc_html__('Secondary Color Light', 'couponhut'),
				'desc' => esc_html__('Default: #a5da9b', 'couponhut'),
			),
			'color-fill' => array(
				'type'  => 'color-picker',
				'value' => '#F7C842',
				'label' => esc_html__('Fill Color', 'couponhut'),
				'desc' => esc_html__('Default: #F7C842', 'couponhut'),
			)
		)
	),
	'deals' => array(
		'title'   => __( 'Deals', 'couponhut' ),
		'type'    => 'tab',
		'options' => array(
			'new-deal-email' => array(
				'label' => esc_html__( 'New Deal Email', 'couponhut' ),
				'desc'  => esc_html__( 'Enter the email that the new deal confirmation emails will be send', 'couponhut' ),
				'type'  => 'text',
				'value' => ''
			),
			'member-submit-switch' => array(
				'type'  => 'switch',
				'value' => false,
				'label' => esc_html__('Allow Deal Submit Without Registration', 'couponhut'),
				'left-choice' => array(
					'value' => false,
					'label' => esc_html__('No', 'couponhut'),
				),
				'right-choice' => array(
					'value' => true,
					'label' => esc_html__('Yes', 'couponhut'),
				),
			),
			'stamp-switch' => array(
				'type'  => 'switch',
				'value' => 'show',
				'label' => esc_html__('Show Deal Discount Stamp', 'couponhut'),
				'left-choice' => array(
					'value' => 'hide',
					'label' => esc_html__('Hide', 'couponhut'),
				),
				'right-choice' => array(
					'value' => 'show',
					'label' => esc_html__('Show', 'couponhut'),
				),
			),
			'rating-switch' => array(
				'type'  => 'switch',
				'value' => 'show',
				'label' => esc_html__('Show Deal Rating', 'couponhut'),
				'left-choice' => array(
					'value' => 'hide',
					'label' => esc_html__('Hide', 'couponhut'),
				),
				'right-choice' => array(
					'value' => 'show',
					'label' => esc_html__('Show', 'couponhut'),
				),
			),
			'popup-coupons-switch' => array(
				'type'  => 'switch',
				'value' => false,
				'label' => esc_html__('Show Coupons Only As Pop Up.', 'couponhut'),
				'desc'  => esc_html__('Do not show single page for Coupon type deals.', 'couponhut'),
				'left-choice' => array(
					'value' => false,
					'label' => esc_html__('No', 'couponhut'),
				),
				'right-choice' => array(
					'value' => true,
					'label' => esc_html__('Yes', 'couponhut'),
				),
			),
			'deals-per-page' => array(
				'type'  => 'slider',
				'value' => -1,
				'properties' => array(
				    'min' => -1,
				    'max' => 60,
				    'sep' => 1,
				),
			    'label' => esc_html__('Deals Per Page', 'couponhut'),
			    'desc'  => esc_html__('Deals per page when browsing and filtering deals. Select -1 for unlimited.', 'couponhut'),
			),
			'order-categories' => array(
			 	'type'  => 'select',
			 	'value' => 'name',
			 	'label' => esc_html__('Order Categories By', 'couponhut'),
			 	'choices' => array(
			 	    'name' => esc_html__('Category Name', 'couponhut'),
			 	    'count' => esc_html__('Offers Count', 'couponhut'),
			 	)
			),
			'show-code-text'    => array(
				'label' => esc_html__( 'Show Code Button Text', 'couponhut' ),
				'type'  => 'text',
				'value' => 'Show Code'
			),
			'buy-now-text'    => array(
				'label' => esc_html__( 'Buy Now Button Text', 'couponhut' ),
				'type'  => 'text',
				'value' => 'Buy Now'
			),
			'sort-deals-tab' => array(
			    'type'  => 'select-multiple',
			    'value' => array( 'rating', 'expiring', 'popular', 'newest' ),
			    'label' => esc_html__('Tabs To Display On Browsing Page', 'couponhut'),
			    'desc'  => esc_html__('Use Ctrl + Click to select multiple.', 'couponhut'),
			    'choices' => array(
			        'rating' => esc_html__('Most Appreciated', 'couponhut'),
			        'expiring' => esc_html__('Expiring', 'couponhut'),
			        'popular' => esc_html__('Popular', 'couponhut'),
			        'newest' => esc_html__('Newest', 'couponhut'),
			    ),
			),
			'default-sort-deals-tab' => array(
			    'type'  => 'select',
			    'value' => 'newest',
			    'label' => esc_html__('Default Sorting Tab On Browsing Page', 'couponhut'),
			    'choices' => array(
			        'rating' => esc_html__('Most Appreciated', 'couponhut'),
			        'expiring' => esc_html__('Expiring', 'couponhut'),
			        'popular' => esc_html__('Popular', 'couponhut'),
			        'newest' => esc_html__('Newest', 'couponhut'),
			    ),
			)
		)
	),
	'typography' => array(
		'title'   => __( 'Typography', 'couponhut' ),
		'type'    => 'tab',
		'options' => array(
			'heading_font'  => array(
				'type'  => 'typography-v2',
				'family' => 'Josefin Sans',
				'variation'  => '600',
				'components' => array(
					'family'         => true,
					'size'           => false,
					'line-height'    => false,
					'letter-spacing' => false,
					'color'          => false,
					),
				'label' => esc_html__('Heading Font', 'couponhut'),
			),
			'body_font'  => array(
				'type'  => 'typography-v2',
				'family' => 'Lato',
				'variation'  => 'regular',
				'components' => array(
					'family'         => true,
					'size'           => false,
					'line-height'    => false,
					'letter-spacing' => false,
					'color'          => false,
					),
				'label' => esc_html__('Body Font', 'couponhut'),
			),
		)
	),
	'social' => array(
		'title'   => __( 'Connect & Social', 'couponhut' ),
		'type'    => 'tab',
		'options' => array(
			'twitter_section' => array(
				'title'   => __( 'Twitter', 'couponhut' ),
				'type'    => 'box',
				'options' => array(

					'consumer_key'    => array(
						'type'     => 'text',
						'label'    => esc_html__( 'Consumer Key', 'couponhut' ),
						'desc'     => esc_html__( 'Note: You can find the Consumer Key in the Application -> Keys and Access Tokens -> Application Settings.', 'couponhut' ),
						),
					'consumer_secret'    => array(
						'type'     => 'text',
						'label'    => esc_html__( 'Consumer Secret', 'couponhut' ),
						'desc'     => esc_html__( 'Note: You can find the Consumer Secret in the Application -> Keys and Access Tokens -> Application Settings.', 'couponhut' ),
						),
					'access_token'    => array(
						'type'     => 'text',
						'label'    => esc_html__( 'Access Token', 'couponhut' ),
						'desc'     => esc_html__( 'Note: You can find the Access Token in the Application -> Keys and Access Tokens -> Your Access Token.', 'couponhut' ),
						),
					'access_token_secret'    => array(
						'type'     => 'text',
						'label'    => esc_html__( 'Access Token Secret', 'couponhut' ),
						'desc'     => esc_html__( 'Note: You can find the Access Token Secret in the Application -> Keys and Access Tokens -> Your Access Token.', 'couponhut' ),
						),
					)
				),//twitter_section

			'mailchimp_section' => array(
				'title'   => __( 'Mailchimp', 'couponhut' ),
				'type'    => 'box',
				'options' => array(

					'mailchimp_api_key'    => array(
						'type'  => 'text',
						'label' => esc_html__( 'API Key', 'couponhut' ),
						'desc'  => esc_html__( 'Write your Mailchimp API key.', 'couponhut' ),
						'value' => ''
					),
					'mailchimp_list_id' => array(
						'type'  => 'text',
						'label' => esc_html__( 'Mailchimp Subscription List ID', 'couponhut' ),
						'desc'  => esc_html__( 'The Mailchimp Subscription List ID that you want the users to be subscribed to.', 'couponhut' ),
						'value' => ''
					)
				)
			), //mailchimp_section
		),
	), //social
);