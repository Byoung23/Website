var AIOS_AW = AIOS_AW || {};
( function( $ ) {

	// Initialize the following code on widget update
	AIOS_AW.initialize  = {		
		init: function() {

			AIOS_AW.initialize.showSlickOptions();

		},
		showSlickOptions: function() {

			var $slick_enabler = $( '.slick-enabler' );
			$slick_enabler.on( 'change', 'input', function() {
				var this_ID = $( this ).attr( 'id' ),
					div_tID = $( '.' + this_ID );

				if ( $( this ).is( ':checked' ) ) {
					div_tID.fadeIn();
				} else {
					div_tID.fadeOut();
				}
			} );

		}
	};

	$(document).ready( AIOS_AW.initialize.init() );
	$(document).on('widget-added widget-updated', function( e, widget ){
		AIOS_AW.initialize.init();
	} );

} )( jQuery );