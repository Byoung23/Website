( function($) {
	$( document ).ready( function() {

		var $document 		= $( document ),
			$window 		= $( window ),
			$viewport 		= $( 'html, body' ),
			$html 			= $( 'html' ),
			$body 			= $( 'body' );
		/**
		 * Construct.
		 */
		function __construct() {
			insertButton();
			aiosShortcodePopup();
			shortcode_autohighlight();
		}

		/**
		 * Insert button beside Manage with Live Preview
		 */
		function insertButton() {
			$( '.wrap > .wp-header-end' ).before('<a class="page-title-action aios-shortcode-popup" href="#">AIOS Shortcode Cheatsheet</a>');
		}

		/**
		 * Popup Shortcode Cheatsheet
		 */
		function aiosShortcodePopup() {

			$document.keyup( function( e ) {
				if ( $( '#aios-shortcode-popup' ).is( ':visible' ) ) {
					if ( e.keyCode == 27 ) aiosShortcodePopupHide();
				}
			} );

			$( '#aios-shortcode-popup ._overlay, #aios-shortcode-popup ._close' ).on( 'click', function(e) {
				if($('#aios-shortcode-popup').is(":visible")) {
					aiosShortcodePopupHide();
				}
			} );

			$document.on('click', '.aios-shortcode-popup', function() {
				$( '#aios-shortcode-popup' ).fadeIn();
				$( 'body' ).css({overflow: 'hidden'});
			});
		}
			function aiosShortcodePopupHide() {
				if($('#aios-shortcode-popup').is(":visible")) {
					$('#aios-shortcode-popup').fadeOut();
					$( 'body' ).css({overflow: 'visible'});
				}
			}

		/**
		 * Shortcode Auto-Highlight
		 */
		function shortcode_autohighlight() {
			var autoHighlight = $(".auto-highlight");
		
			autoHighlight.on('mouseup', function(e){
				e.preventDefault();
				$(e.currentTarget).select();
			});
		}

		/**
		 * Instantiate
		 */
		__construct();

	} );
} )( jQuery );