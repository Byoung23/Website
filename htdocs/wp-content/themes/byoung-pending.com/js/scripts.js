( function() {

	var app = {
		initHeaderScripts: function() {
			jQuery('#nav').splitNav({
				'logo': jQuery('.hdr-logo'),
			});

			jQuery(".header-wrapper .nav, .fixed-header-wrapper .nav").navTabDoubleTap();

			jQuery('.header-wrapper .nav li, .fixed-header-wrapper .nav li').each(function() {
				var link = jQuery(this).find(' > a');
				link.html('<span data-title="'+link.data('title')+'">'+link.text()+'</span>');
			});

			function centerSubmenus() {
				jQuery(".nav > li > .sub-menu").each( function() {
					var linkW = jQuery(this).parent().width();
					var mLeft = (linkW - jQuery(this).width())/2;
					jQuery(this).css("margin-left",mLeft+"px");
				});
			}
			centerSubmenus();
			jQuery(window).resize( function() { centerSubmenus() } );

			jQuery.fn.slideFadeToggle  = function(speed, easing, callback) {
			    return this.animate({opacity: 'toggle'}, speed, easing, callback);
			};

			jQuery('.nav li').hover(function(){
			    jQuery('> ul', this).stop(true,true).fadeIn(300);
			},function(){
			    jQuery('> ul', this).stop(true,true).fadeOut(300);
			});
			
			jQuery("#slideshow,.ip-banner,#inner-page-wrapper").add(window).click( function() { 
				jQuery('.sub-menu').stop(true,true).fadeOut(300); 
			});
			

			var iScrollPos = 0;
		    jQuery(window).scroll(function () {
		        var iCurScrollPos = jQuery(this).scrollTop();
		        if (jQuery(window).width() > 991) {
		            if (iCurScrollPos >= 250 ) {
		                jQuery(".fixed-header-wrapper").addClass( "sticking" );
		            } else {
		                jQuery(".fixed-header-wrapper").removeClass( "sticking" );
		            }
		           //iScrollPos = iCurScrollPos;
		       }
		    });

		    jQuery(window).scroll(function() {
				jQuery('.sub-menu').stop(true,true).fadeOut(300);
		    });
		},
		initWelcome: function() {
			jQuery(".welcome-left, .welcome-right").chainHeight({
				breakpoints: [
		            {
		                min: 992
		            }
		        ]
			});
		},
		initMap: function() {
			jQuery('#image-map area').each(function() {
				var area = jQuery(this);
				var areaClass = area.attr('class').split(' ')[0];

				area.hover(function() {
					console.log(jQuery(this).attr('class'));
					jQuery('li.'+areaClass).addClass('active');
					jQuery('.map-hover.'+areaClass).addClass('active');
				}, function() {
					jQuery(this).removeClass('active');
					jQuery('li.'+areaClass).removeClass('active');
					jQuery('.map-hover.'+areaClass).removeClass('active');
				});
			});

			jQuery('.area-list li').each(function() {
				var area = jQuery(this);
				var areaClass = area.attr('class').split(' ')[0];

				area.hover(function() {
					jQuery('li.'+areaClass).addClass('active');
					jQuery('.map-hover.'+areaClass).addClass('active');
				}, function() {
					jQuery('li.'+areaClass).removeClass('active');
					jQuery('.map-hover.'+areaClass).removeClass('active');
				});
			});
		}, 
		initFeaturedProperties: function() {
			jQuery('.fp-list').slick({
				dots: false,
				arrows: false,
				speed: 400,
				autoplay: true,
				autoplaySpeed: 4000,
				slidesToShow: 3,
				slidesToScroll: 1,
				// asNavFor: '.fp-details-list',
				responsive: [
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 3,
							asNavFor: jQuery('.fp-details-list'),
							centerMode: true,
							centerPadding: 0
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
							asNavFor: jQuery('.fp-details-list')
						}
					},
				]
			});
			jQuery('.fp-details-list').slick({
				dots: false,
				arrows: false,
				speed: 0,
				autoplay: false,
				autoplaySpeed: 4000,
				slidesToShow: 1,
				slidesToScroll: 1,
				fade: true,
				// asNavFor: '.fp-list',
				responsive: [
					{
						breakpoint: 992,
						settings: {
							asNavFor: jQuery('.fp-list')
						}
					},
					{
						breakpoint: 768,
						settings: {
							asNavFor: jQuery('.fp-list')
						}
					},
				]
			});

			jQuery('.slick-slide').on('mouseenter', function (e) {
				var $currTarget = jQuery(e.currentTarget),
			    index = $currTarget.data('slick-index'),
			    slickObj = jQuery('.fp-details-list').slick('getSlick');
				slickObj.slickGoTo(index);
			});

			jQuery('.mobile .fp a').click(function( e ) {
			  	e.preventDefault();
			  	if( jQuery(this).hasClass('clicked_once') ) {
			  		var item_link = jQuery(this).attr('href');
			  		window.location.href = item_link;
			  	}
			  	jQuery(this).addClass('clicked_once');
			});
		},
		initTestimonials: function() {
			jQuery('.testi-list').slick({
				dots: false,
				arrows: false,
				speed: 200,
				autoplay: true,
				autoplaySpeed: 4000,
				slidesToShow: 1,
				slidesToScroll: 1,
				fade: true,
			});
		},
		initNavigateSections: function() {

			var navDots = jQuery('.nav-dots-list');
			var sections  =["#slideshow",
							"#welcome",
							"#map",
							"#featured-communities",
							"#featured-properties",
							"#testimonials",
							".footer-wrapper",
							'.section-gap'

							];

			var scrolling = false;
			var viewPort = jQuery(window);
			var navOffset;
			var previousScroll = 0;

			jQuery('.navDots li a').on('click', function(e) {
				e.preventDefault();
			})

			viewPort.on('scroll', function(e) {
				scrolling = true;

				/* Check scrolling direction */
				var currentScroll = jQuery(this).scrollTop();
				if (currentScroll > previousScroll) {
					navOffset = jQuery('.navigate-sections').offset().top + jQuery('.navigate-sections').height();
				} else {
					navOffset = jQuery('.navigate-sections').offset().top;
				}
				previousScroll = currentScroll;

			});

			setInterval( function() {
				if (scrolling) {
					scrolling = false;
					jQuery.each(sections, function(index, value) {
						var offTop = jQuery(value).offset().top;
						var offBottom = offTop + jQuery(value).outerHeight(true);

						if (navOffset >= offTop && navOffset <= offBottom ) {
							/*change colors of dots when on sections with white backgrounds*/
							if (value === "#welcome" || value === "#map" || value === "#featured-communities" || value === "#featured-properties"
								|| value === "#testimonials" ) {								
								navDots.addClass('on-white');
							} else {								
								navDots.removeClass('on-white');
							}

							/* Update dots */
							jQuery('li.nav-dot.active').removeClass('active');
							jQuery('li.nav-dot[data-id="'+value+'"]').addClass('active');
						}
					});
				}
			}, 250);

		},
		// initPopups: function() {
		// 	function popup() {
		// 		// setTimeout(function() {
		// 			if (!jQuery.aiosPopup.instance.isOpen && !jQuery('body').hasClass('ppop-opened')) {
		// 				jQuery.aiosPopup.open({
		// 					items: {
		// 						src: '.ppop-wrap',
		// 						type: 'inline'
		// 					},
		// 					removalDelay: 300,
		// 					mainClass: 'ppop-anim',
		// 					callbacks: {
		// 						close: function() {
		// 							jQuery('body').addClass('ppop-opened');
		// 						}
		// 					}
		// 				});
		// 			}
		// 		// }, 5000);				
		// 	}

		// 	popup();

		// 	jQuery('.gc-popup').aiosPopup({
		// 		items: {
		// 			src: '.gc-wrap',
		// 			type: 'inline'
		// 		},
		// 		removalDelay: 300,
		// 		mainClass: 'gc-anim',
		// 		callbacks: {
		// 			close: function() {
		// 				popup();
		// 			}
		// 		}				
		// 	});
		// },
		initQuickSearch: function() {
			/* Put quick search code here */
		},
		initCustomFunction: function() {
			/* See the pattern? Create more functions like this if needed. */
		}
		
	}

	
	jQuery(document).ready( function() {
		app.initHeaderScripts();
		app.initWelcome();
		app.initMap();
		app.initFeaturedProperties();
		app.initTestimonials();
		app.initNavigateSections();
		app.initPopups();
		
		/* Initialize quick search */
		app.initQuickSearch();
		
	});
	
	jQuery(window).on('load', function(){
		
	});


})();