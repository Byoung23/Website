( function($) {
	$( document ).ready( function() {

		/** Construct. **/
		function __construct() {
			development_mode();
		}

		/** Suspend or Resume UC **/
		function development_mode() {
			var $suspend_button = $( 'li.aios-scss-suspend a' ),
				$resume_button 	= $( 'li.aios-scss-resume a' );

			$suspend_button.on( 'click', function(e) {
				e.preventDefault();

				swal({
					title: 'Are you sure?',
					text: "You need to turn off this after the changes!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Proceed'
				}).then((result) => {
					if (result.value) {
						$.post( ajaxurl, {
							'action' : 'aisis_scss_development'
						}, function( response ) {
							var res = JSON.parse( response );
							swal({
								type: 'success',
								title: 'Development mode ON',
								showConfirmButton: false,
								timer: 1500
							});
							setTimeout( location.reload(), 500 );
						} );
					}
				});
			} );

			$resume_button.on( 'click', function(e) {
				e.preventDefault();

				$.post( ajaxurl, {
					'action' : 'aisis_scss_production'
				}, function( response ) {
					var res = JSON.parse( response );
					swal({
						type: 'success',
						title: 'Development mode OFF',
						showConfirmButton: false,
						timer: 1500
					});
					setTimeout( location.reload(), 500 );
				} );
			} );
		}

		/** Instantiate **/
		__construct();

	} );
} )( jQuery );
