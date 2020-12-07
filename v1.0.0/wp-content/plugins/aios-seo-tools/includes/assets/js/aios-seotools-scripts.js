( function($) {

	/** Hide AIOS SEO Tools Menu **/
	function hide_aios_menu() {
		$( 'a[href="options-general.php?page=aios-seo-tools"]' ).remove();
	}

	function remove_meta() {
		/** RegEx **/
		var google_v_regex = /\<meta name=\"google-site-verification\" content=\"(.*)\"(.*)\/?(.*)\>?/;
		var bing_v_regex = /\<meta name=\"msvalidate\.01\" content=\"(.*)\"(.*)\/?(.*)\>?/;

		/** Google Verification Code **/
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

		/** Google Analytics **/
		$( 'input[name="aios-seotools[ga-tracking-code]"]' ).on( 'change', function() {
			var this_val = $( this ).val();
			var google_analytics_v_regex = /(UA|YT|MO)-\d+-\d+/;
			if ( google_analytics_v_regex.test( this_val ) == false && this_val != "" ) {
				alert( 'Enter Correct Google Analytics Code' );
				$( this ).val( '' );
			}
		} );
	}

	function rs_upload_imag() {
		$( '#aios-seotools-photo-button' ).on( 'click', function() {
	        var image = wp.media({ 
	            title: 'Upload Image',
	            /** mutiple: true if you want to upload multiple files at once **/
	            multiple: false
	        }).open()
	        .on( 'select', function(e){
	            /** This will return the selected image from the Media Uploader, the result is an object **/
	            var uploaded_image = image.state().get( 'selection' ).first();

	            /** We convert uploaded_image to a JSON object to make accessing it easier **/
	            var image_url = uploaded_image.toJSON().url;

	            /** Let's assign the url value to the input field **/
	            $( 'input[name="aios-seotools[rs-photo]"]' ).val( image_url );
	            $( '.aios-seotools-photo-preview' ).attr( 'src', '' );
	            $( '.aios-seotools-photo-preview' ).attr( 'src', image_url );
	        });
	    });
	}

	function rs_opening_hours() {
		var input_main = $( 'input[name="aios-seotools[rs-opening-hours]"]' ),
			hours_selector = $( '.rs-opening-hours-selector' ),
			day_checker = $( '.rs-opening-hours-checklist li' );

		day_checker.on( 'change', 'input[type="checkbox"], select', function() {
			var checked_days = $('.rs-opening-hours-checklist li:not(:last-child) input[type="checkbox"]:checked'),
				checked_alldays = $( '.rs-opening-hours-checklist li .rs-oh-24-7' );

			if ( $( this ).hasClass( 'rs-oh-24-7' ) ) {
				if ( checked_alldays.is( ':checked' ) ) {
					checked_days.prop( 'checked', false );
					input_main.val( $( this ).val() );
					$( this ).parents( 'ul' ).find( '.rs-opening-hours-selector' ).css({ display: 'none' });
				} else {
					input_main.val( "" );
				}
			} else {
				checked_alldays.prop( 'checked', false );
				if ( $( this ).attr( 'type' ) == "checkbox" ) {
					if ( $( this ).is( ':checked' ) ) {
						$( this ).parent().find( '.rs-opening-hours-selector' ).css({ display: 'inline-block' });
					} else {
						$( this ).parent().find( '.rs-opening-hours-selector' ).css({ display: 'none' });					
					}
				}

				var checkedVals = checked_days.map(function() {
					var day_time = "",
						day = this.value,
						open_time = $( this ).parent( 'li').find( 'select.opening-hour' ).val(),
						close_time = $( this ).parent( 'li').find( 'select.closing-hour' ).val();

						if ( open_time != "" || close_time != "" ) {
							day_time = day + " " + open_time + "-" + close_time;
						} else {
							day_time = day;
						}

				    return day_time;
				}).get();
				input_main.val( checkedVals.join(", ") );
			}
		} );
	}

	function rs_get_lat_long_embed_code() {

		var geo_map_regex  = /https?\:\/\/(.*)\/maps\/(.*)\/(@(.*)),(.*),(.*)z\/(.*)/i,
			geo_lat = $( 'input[name="aios-seotools[rs-geo-latitude]"]' ),
			geo_long = $( 'input[name="aios-seotools[rs-geo-longitude]"]' );
			/** https://www.google.com.ph/maps/place/Pasig,+Metro+Manila/@14.5790402,121.0462741,13z/data=!3m1!4b1!4m5!3m4!1s0x3397c7dc88f7b24f:0x4a592b2b4b34fd89!8m2!3d14.5763768!4d121.0851097?hl=en **/
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

	$( document ).ready( function() {
		hide_aios_menu();
		remove_meta();
		rs_upload_imag();
		rs_opening_hours();
		rs_get_lat_long_embed_code();
	} );

} )( jQuery );