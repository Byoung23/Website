( function($) {

	var aios_starter_theme = {
		init: function(){
			this.aiosFramePopUp();
			this.aiosImagePopUp();
			this.aiosContentPopup();
			this.aios_scroll_top();
		},
		aiosFramePopUp: function(){
			$('.aios-frame-popup, .aios-video-popup').aiosPopup({
			  disableOn: 700,
			  type: 'iframe',
			  mainClass: 'aiosp-fade',
			  removalDelay: 160,
			  preloader: false,
			  fixedBgPos: true,
			  fixedContentPos: true
			});	
		},
		aiosImagePopUp: function(){
			$('.aios-image-popup').aiosPopup({
				type: 'image',
				closeOnContentClick: true,
				mainClass: 'aiosp-img-mobile',
				image: {
				verticalFit: true
				}
			});
		},
		aiosContentPopup: function(){
			$('.aios-content-popup').aiosPopup({
    			type: 'inline',
    			preloader: false,
    			focus: '#username',
    			modal: true,
    			callbacks : {
    				open : function(){
    					var aiosContent=  $('.aiosp-content');
    				 	aiosContent.addClass('aios-popup-body')
    				 	$('.aios-popup-body').append('<button title="Close" type="button" class="aiosp-close">&#215;</button>')
    					aiosContent.parent().append('<div class="outside-content"></div>');
    					$('.outside-content').on('click', function(){
    						$(this).aiosPopup('close');
    					})
    				}
    			}
    		});
		},
		aios_scroll_top : function(){
			var $viewport = jQuery( 'html, body' );
			
			jQuery( document ).on('click', '.aios-scroll-to', function(e) {
				var target 				= $( this ).attr('href'),
					aios_scroll_offset 	= ( $( this ).data('offset') == undefined ) ? 0 : $( this ).data('offset'),
					aios_scroll_speed 	= ( $( this ).data('speed') == undefined ) ? 1500 : $( this ).data('speed');

				// Stop the animation if the user scrolls. Defaults on .stop() should be fine
				$viewport.bind("scroll mousedown DOMMouseScroll mousewheel keyup", function(e){
					if ( e.which > 0 || e.type === "mousedown" || e.type === "mousewheel"){
						$viewport.stop().unbind('scroll mousedown DOMMouseScroll mousewheel keyup');
					}
				});

				$( 'html, body' ).animate( {
					scrollTop: ( $( target ).offset().top - aios_scroll_offset )
				}, aios_scroll_speed );

				return false
			});
		}
	}
	jQuery(document).ready( function() {
		aios_starter_theme.init();
	});
	jQuery(window).resize( function() {});
	jQuery(window).load(function(){});

})(jQuery);

