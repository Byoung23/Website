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
			remove_verification_tag();
			rs_opening_hours();
			rs_get_lat_long_embed_code();
		}

		function remove_verification_tag() {
			// RegEx
			var google_v_regex = /\<meta name=\"google-site-verification\" content=\"(.*)\"(.*)\/?(.*)\>?/;
			var bing_v_regex = /\<meta name=\"msvalidate\.01\" content=\"(.*)\"(.*)\/?(.*)\>?/;

			// Google Verification Code
			$( 'input[name="aios-seotools[google-verification]"], input[name="aios-seotools[bing-verification]"]' ).on( 'change', function() {
				var this_val = $( this ).val();
				if ( google_v_regex.test( this_val ) ) {
					var array_match = this_val.match( google_v_regex );
					$( this ).val( array_match[1] );
				} else if ( bing_v_regex.test( this_val ) ) {
					var array_match = this_val.match( bing_v_regex );
					$( this ).val( array_match[1] );
				}
			} );

			// Google Analytics
			$( 'input[name="aios-seotools[ga-tracking-code]"]' ).on( 'change', function() {
				var this_val = $( this ).val();
				var google_analytics_v_regex = /(UA|YT|MO)-\d+-\d+/;
				if ( google_analytics_v_regex.test( this_val ) == false && this_val != "" ) {
					alert( 'Enter Correct Google Analytics Code' );
					$( this ).val( '' );
				}
			} );
		}

		function rs_opening_hours() {
			var $totalDayHours 	= $( 'input[name="aios-seotools[rs-opening-hours]"]' ),
				$opensPartially = $( 'input.opens-partially' ),
				$openfulltime 	= $( 'input.open-fulltime' ),
				$selectOpening 	= $( 'select.opening-hour' ),
				$selectClosing 	= $( 'select.closing-hour' ),
				$openingHour 	= $( '.rs-opening-hours-selector' );

			$opensPartially.on( 'change', function() {
				var $this = $( this ); 

				if ( $openfulltime.is( ':checked' ) ) 
					$openfulltime.prop( 'checked', false );

				if ( $this.is( ':checked' ) ) {
					$this.parents( '.form-checkbox' ).find( '.rs-opening-hours-selector' ).show();
				} else {
					$this.parents( '.form-checkbox' ).find( '.rs-opening-hours-selector' ).hide();
				}

				rs_hours();
			} );

			$openfulltime.on( 'change', function() {
				if ( $( this ).is( ':checked' ) ) {
					$opensPartially.prop( 'checked', false );
					$totalDayHours.val( $( this ).val() );
					$openingHour.css({ display: 'none' });
				}
			} );

				$selectOpening.on( 'change', function() {
					rs_hours();
				} );
				$selectClosing.on( 'change', function() {
					rs_hours();
				} );
		}
			function rs_hours() {
				var $totalDayHours 	= $( 'input[name="aios-seotools[rs-opening-hours]"]' );
				var checkedVals = $( 'input.opens-partially:checked' ).map(function() {
					console.log( $( this ) );
					var day_time = "",
						day = this.value,
						open_time = $( this ).parents( '.form-checkbox' ).find( '.opening-hour' ).val(),
						close_time = $( this ).parents( '.form-checkbox' ).find( '.closing-hour' ).val();

						if ( open_time != "" || close_time != "" ) {
							day_time = day + " " + open_time + "-" + close_time;
						} else {
							day_time = day;
						}

					return day_time;
				}).get();

				$totalDayHours.val( checkedVals.join(", ") );
			}

		function rs_get_lat_long_embed_code() {

			var geo_map_regex  = /https?\:\/\/(.*)\/maps\/(.*)\/(@(.*)),(.*),(.*)z\/(.*)/i,
				geo_lat = $( 'input[name="aios-seotools[rs-geo-latitude]"]' ),
				geo_long = $( 'input[name="aios-seotools[rs-geo-longitude]"]' );
				// https://www.google.com.ph/maps/place/Pasig,+Metro+Manila/@14.5790402,121.0462741,13z/data=!3m1!4b1!4m5!3m4!1s0x3397c7dc88f7b24f:0x4a592b2b4b34fd89!8m2!3d14.5763768!4d121.0851097?hl=en
			$( '#wpui-container' ).on( 'change', 'input[name="aios-seotools[rs-geo-url]"]', function() {
				var url = $( this ).val(),
					match = url.match( geo_map_regex );
				if ( geo_map_regex.test( url ) ) {
					geo_lat.val( match[4] );
					geo_long.val( match[5] );
				} else {
					if ( url != '' ) {
						alert( 'Invalid Url' );
					}
				}
			} );

		}

		/**
		 * Instantiate
		 */
		__construct();

	} );
} )( jQuery );