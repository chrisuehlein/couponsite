jQuery(document).ready(function($){

	"use strict";

	/**
	 * ----------------------------------------------------------------------------------------
	 *    Globals
	 * ----------------------------------------------------------------------------------------
	 */

	var $body = $('body');
	var $window = $(window);

	/**
	 * ----------------------------------------------------------------------------------------
	 *    <bgimage>
	 * ----------------------------------------------------------------------------------------
	 */

	var $bgimage = $('.bg-image, .widget-bgimage');

	$bgimage.each(function(){
		var $this = $(this);
		var bgimage = $this.data('bgimage')

		$this.css('background-image', 'url("' + bgimage + '")' );
	})

	/**
	* ----------------------------------------------------------------------------------------
	*    Countdown Init
	* ----------------------------------------------------------------------------------------
	*/
	
	var $dealCountdown = $('.jscountdown-wrap');
	var expiredText = couponhut.expired;
	var dayText = couponhut.day;
	var daysPluralText = couponhut.days;
	var hourText = couponhut.hour;
	var hoursPluralText = couponhut.hours;
	var minuteText = couponhut.minute;
	var minutesPluralText = couponhut.minutes;

	$dealCountdown.each(function(){

		var $this = $(this);
		var finalDate = $this.data('time');

		$this.countdown(finalDate)
		.on('update.countdown', function(event) {

			var format = '%H:%M:%S';

			if ( $this.data('short') ) {

				if( event.offset.totalDays > 0 ) {
					format = '%-D %!D:' + dayText + ' ,' + daysPluralText + ' ;';
				} else if ( event.offset.hours > 0 ) {
					format = '%-H %!H:' + hourText + ' ,' + hoursPluralText + ' ;';
				} else {
					format = '%-M %!M:' + minuteText + ' ,' + minutesPluralText  + ' ;';
				}

				$this.html(event.strftime(format));

			} else if(event.offset.totalDays > 0) {
				var daysFormat = '%-D';

				$this.html('<span class="jscountdown-days">' + 
					event.strftime(daysFormat) +
					'</span>' + 
					'<span class="jscountdown-days-text">' + 
					event.strftime('%!D:' + dayText + ' ,' + daysPluralText + ' ;') + 
					'</span>' +
					'<span class="jscountdown-time">' +
						event.strftime(format) + 
					'</span>');

				// $this.html(event.strftime(daysFormat));
			} else {
				$this.html(event.strftime(format));
			}

		})
		.on('finish.countdown', function(event) {
			$this.html(expiredText)
			.parent().addClass('disabled')

		})

	})


	/**
	 * ----------------------------------------------------------------------------------------
	 *    Isotope
	 * ----------------------------------------------------------------------------------------
	 */

	var $isotopeContainer = $(".isotope-wrapper");

	$isotopeContainer.each(function(){

		var $this = $(this);
		var isotopeCols = $this.data('isotope-cols');
		
		function setIsotopeCols(){

			var windowWidth = $(document).width();

			if ( windowWidth <= 478 ) {
				if(typeof $this.data('isotope-cols-xs') != 'undefined') {
					isotopeCols = $this.data('isotope-cols-xs');
				} else {
					isotopeCols = 1;
				}
			}
			else if ( windowWidth <= 767 ) {
				if(typeof $this.data('isotope-cols-xs') != 'undefined') {
					isotopeCols = $this.data('isotope-cols-xs');
				} else {
					isotopeCols = 2;
				}
			} else if ( windowWidth <= 992 ) {

				if(typeof $this.data('isotope-cols-sm') != 'undefined') {
					isotopeCols = $this.data('isotope-cols-sm');
				} else {
					isotopeCols = $this.data('isotope-cols') - 1;
				}

			} else {
				isotopeCols = $this.data('isotope-cols');
			}

			$this.children().css('width', $this.width() / isotopeCols - 1 + 'px' );

		}


		function setIsotopeGutter(){

			if(typeof($this.data('isotope-gutter')) != "undefined" && $this.data('isotope-gutter') !== null) {
				var itemGutter = $this.data('isotope-gutter');

				$this.css({
					'margin-left' : -itemGutter + 'px'
				})

				$this.children().css({
					'padding-bottom' : itemGutter + 'px',
					'padding-left' : itemGutter + 'px'
				})

			}		

		}

		setIsotopeCols();
		setIsotopeGutter();
		// Isotope Init
		$this.isotope({
			transitionDuration: '0.3s',
			layoutMode: 'masonry',
			masonry: {
				columnWidth: $this.width() / isotopeCols - 1
			}
		});

		// Fires Layout when all images are loaded
		$this.imagesLoaded( function() {
			$this.show();
			$window.trigger('resize');
		});

		// Set the items width on resize
		$window.on('resize', function (){
			setIsotopeCols();
			setIsotopeGutter();
			$this.isotope({
				transitionDuration: '0.3s',
				layoutMode: 'fitRows',
				masonry: {
					columnWidth: $this.width() / isotopeCols - 1
				}
			});
			setTimeout(function(){
				$this.isotope('layout');
			}, 1000);
		});

	})


	/**
	 * ----------------------------------------------------------------------------------------
	 *    Nav Menu
	 * ----------------------------------------------------------------------------------------
	 */

	$('.is-slicknav').slicknav({
		label: '',
		init: function(){
			var $brandLogo = $('.navigation-wrapper .site-logo').clone();
			$('.slicknav_menu').prepend($brandLogo);
		}
	});

	$('.main-navigation').find('.menu-item-has-children a').each(function(){

		var $this = $(this);

		if ( $this.next().hasClass('sub-menu') ) {
			$this.append('<i class="fa fa-angle-down"></i>');
		}

	})


	/**
	 * ----------------------------------------------------------------------------------------
	 *    Header on Scroll
	 * ----------------------------------------------------------------------------------------
	 */

	var $navigation = $('.navigation-wrapper');
	var $navOffset = $('.nav-offset');
	var navHeight = $navigation.height();

	function stickyNav() {

		navHeight = $navigation.height();
		
		if ( $window.scrollTop() > navHeight ){
			$navigation.addClass('nav-sticky');
			$navOffset.css('padding-top', navHeight);

		} else if ( $window.scrollTop() == 0 ){
			$navigation.removeClass('nav-sticky');
			$navOffset.css('padding-top', '');

		}

	}

	stickyNav();

	$window.scroll(function(){
		stickyNav();
	});

	$window.on('resize',function(){
		stickyNav();
	});
	


	/**
	 * ----------------------------------------------------------------------------------------
	 *    Video Background
	 * ----------------------------------------------------------------------------------------
	 */

	var bigvideos = {};
	

	$('.bigvideo-wrapper').each(function( index, value ){

		var $this = $(this);
		$this.find('.bg-image').hide();
		var fallback = false;
		var vjsPlayer = false;

		bigvideos[value] = new $.BigVideo({
			useFlashForFirefox: false,
			forceAutoplay: true,
			controls: false,
			doLoop: true,
			container: $this,
			shrinkable: false
		});

		bigvideos[value].init();

		if ( $this.data('bigvideo-mp4') || $this.data('bigvideo-webm') || $this.data('bigvideo-ogg')) {

			vjsPlayer = bigvideos[value].getPlayer();

			bigvideos[value].show([
				{ type: "video/mp4",  src: $this.data('bigvideo-mp4') },
				{ type: "video/webm", src: $this.data('bigvideo-webm') },
				{ type: "video/ogg",  src: $this.data('bigvideo-ogg') },
			]);

		} else {
			$this.find('.bg-image').show();
		}

		
	})


	/**
	* ----------------------------------------------------------------------------------------
	*    Hero Full Height
	* ----------------------------------------------------------------------------------------
	*/

	var $heroImage = $('.hero-image')
	var $navWrap = $('.navigation-wrapper')
	var $navMobile = $('.slicknav_menu');
	var wHeight = $window.height();

	function heroFullHeight(){
		wHeight = $window.height();
		if ( $navWrap.height() > 0 ) {
			var navHeight = $navWrap.height()
		} else {
			var navHeight = $navMobile.height();
		}
		$heroImage.height(wHeight - navHeight);
	}

	heroFullHeight();
	
	$window.on( 'scroll resize', function(){
		heroFullHeight();
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Featured Deals Slider
	* ----------------------------------------------------------------------------------------
	*/

	$(".featured-deals-slider").each(function(){
		var $this = $(this);
		$this.owlCarousel({
			singleItem: true,
			slideSpeed : 300,
			paginationSpeed : 400,
			autoPlay: 7000,
			stopOnHover: true,
			navigation: true,
			navigationText: ['<i class="icon-Triangle-ArrowLeft"></i>','<i class="icon-Triangle-ArrowRight"></i>'],
			rewindSpeed: 400
		});
	})

	

	/**
	 * ----------------------------------------------------------------------------------------
	 *    ClipboardJS
	 * ----------------------------------------------------------------------------------------
	 */

	var clipboard = new Clipboard('.show-coupon-code');

	$('.show-coupon-code').on('click', function(e){

	 	var $this = $(this);

	 	if( !$this.data('redirect') ) {
	 		e.preventDefault();
	 	}

	 })

	clipboard.on('success', function(e) {
		e.clearSelection();
		var $target = $(e.trigger);
		$($target.data('target')).modal('show');
	});


	/**
	 * ----------------------------------------------------------------------------------------
	 *    Single Deal Slider
	 * ----------------------------------------------------------------------------------------
	 */

	var $dealSlider = $('.single-deal-slider');

	$dealSlider.owlCarousel({
		singleItem:true,
		navigation: true,
		navigationText: ['<i class="icon-Triangle-ArrowLeft"></i>','<i class="icon-Triangle-ArrowRight"></i>'],
		rewindSpeed: 400,
		autoPlay: 4000
	});

	
	/**
	* ----------------------------------------------------------------------------------------
	*    Like Rating
	* ----------------------------------------------------------------------------------------
	*/

	$(".post-like a").click(function(){

		var $this = $(this);
        var post_id = $this.data("post-id");

        $.ajax({
        	type: "post",
        	url: couponhut.url,
        	data: "action=_action_ssd_post_like&nonce="+couponhut.nonce+"&post_like=&post_id="+post_id,
        	success: function(count){
                // If vote successful
                if(count != "already")
                {
                	$this.addClass("voted");
                	$this.siblings(".count").text(count);
                }
            }
        });

        return false;
    })

    /**
    * ----------------------------------------------------------------------------------------
    *    5 Star Rating
    * ----------------------------------------------------------------------------------------
    */

	$(".post-star-rating i").click(function(){

		var $this = $(this);
        var post_id = $this.data("post-id");
        var rating = $this.data("rating");

        $.ajax({
        	type: "post",
        	url: couponhut.ajaxurl,
        	dataType: 'json',
        	data: "action=_action_ssd_post_rate&nonce="+couponhut.nonce+"&post_rate=&post_id="+post_id+"&rating="+rating,
        	success: function(data){
                // If vote successful
                if(data['average'] != "already") {

                	$.each( data['stars'], function( index, value ){

                		var $starElement = $this.closest('.post-star-rating').find('i').eq(index);

                		switch (value) {
                			case 'full':
                				$starElement.removeClass('fa-star fa-star-half-o fa-star-o').addClass('fa-star');
                				break;
                			case 'half':
                				$starElement.removeClass('fa-star fa-star-half-o fa-star-o').addClass('fa-star-half-o');
                				break;
                			case 'empty':
                				$starElement.removeClass('fa-star fa-star-half-o fa-star-o').addClass('fa-star-o');
                				break;
                		}
                	});

                	// $this.addClass("voted");
                	$this.closest('.post-star-rating').siblings('.rating-average').text(data['average']);
                	$this.closest('.post-star-rating').siblings('.rating-text').find('.rating-count').text(data['rating_count_total']);

                	if(data['rating_count_total'] == 1) {
                		$this.closest('.post-star-rating').siblings('.rating-text').find('.rates').text('rating');
                	} else {
                		$this.closest('.post-star-rating').siblings('.rating-text').find('.rates').text('ratings');
                	}
                	
                }
            }
        });

        return false;
    })

	/**
	* ----------------------------------------------------------------------------------------
	*    Rating Star Hover
	* ----------------------------------------------------------------------------------------
	*/

	$(".post-star-rating i").on({
		mouseenter: function () {
			var $this = $(this);
			$this.addClass('hovered');
			$this.prevAll().addClass('hovered');
			$this.nextAll().addClass('not-hovered');
		},
		mouseleave: function () {
			var $this = $(this);
			$this.removeClass('hovered');
			$this.prevAll().removeClass('hovered');
			$this.nextAll().removeClass('not-hovered');
		}
	});

	/**
	* ----------------------------------------------------------------------------------------
	*    Dropdown Select Save Input In Hidden Field
	* ----------------------------------------------------------------------------------------
	*/


	$(".dropdown .dropdown-menu li a").on('click', function(e){

		var $this = $(this);

		var el = $this.parents('ul').data('name');

		if( el ){
			e.preventDefault();

			var dropdownButton = $this.parents( '.dropdown' ).find('button');
			
			dropdownButton.html( $this.html() );

			$this.closest('form').find('input[name="'+el+'"]').val( $this.data('value') );
		}

	});

	$('.dropdown').each(function(){

		var $this = $(this);

		var dropdownButton = $this.find('button');
		var currentItem = $this.find( '.dropdown-menu li a[data-current="true"]' );

		if ( currentItem.length > 0 ) {
			dropdownButton.html( currentItem );
		};


	})


		


	/**
	* ----------------------------------------------------------------------------------------
	*    Post Share Buttons
	* ----------------------------------------------------------------------------------------
	*/

	$('.is-shareable .facebook').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		window.open('http://www.facebook.com/sharer.php?u=' + postUrl,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	$('.is-shareable .twitter').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		window.open('https://twitter.com/share?url=' + postUrl,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	$('.is-shareable .google').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		window.open('https://plus.google.com/share?url=' + postUrl,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	$('.is-shareable .pinterest').on('click', function(e){
		e.preventDefault();
		var postUrl = $(this).closest('.is-shareable').data('post-url');
		window.open('http://pinterest.com/pin/create/button/?url=' + postUrl,'sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	})

	/**
	* ----------------------------------------------------------------------------------------
	*    Parallax
	* ----------------------------------------------------------------------------------------
	*/

	function isScrolledIntoView(elem) {
		var $elem = $(elem);
		var $window = $(window);

		var docViewTop = $window.scrollTop();
		var docViewBottom = docViewTop + $window.height();

		var elemTop = $elem.offset().top;
		var elemBottom = elemTop + $elem.height();

		return (elemTop <= docViewBottom);
	}

	function parallax(){
		var windowWidth = $(document).width();

		if ( windowWidth > 992 ) {
			var docViewTop = $window.scrollTop();
			var docViewBottom = docViewTop + $window.height();

			$('.parallax').each(function(){
				var $this = $(this);
				var top = 0;
				if ( isScrolledIntoView($this) ) {

					top = docViewBottom - $this.offset().top;
					$this.css('background-position', '50% ' + ( 100 - (top * 0.07)) + '%');
				} else {
					$this.css('background-position', '50% 0%');
				}

			})
		}

		
	}

	parallax();

	$(window).on('scroll resize', function(e){
		parallax();
	});
	
})