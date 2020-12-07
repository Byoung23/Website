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
			aios_color_picker();
		}

		/**
		 * Set color picker.
		 */
		function aios_color_picker() {
			var $inputPicker = $( '.aios-color-picker' );

			$inputPicker.each( function() {
				$( this ).wpColorPicker();
			} );
		}

		/**
		 * Instantiate
		 */
		__construct();

	} );
} )( jQuery );