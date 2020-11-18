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
			edit_tags();
        }
        
        function edit_tags() {
            if( $body.hasClass( 'term-php' ) ) if( $( '#wpseo_meta' ).length ) $( '.wrap' ).addClass( 'has-wpseo' );
		}

		/**
		 * Instantiate
		 */
		__construct();

	} );
} )( jQuery );