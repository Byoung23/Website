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
			shortcode_autohighlight();

			ajax_generate_pages();
			ajax_generate_bulk_pages();

			custom_login_screen();
			enqueue_libs();

			quick_search_auto_generate_json();

			duplicate_menu();

			refresh_minified_resources();
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
		 * Generate Pages.
		 */
		function ajax_generate_pages() {
			var $submit = $( 'input#generate-default-pages' );
			$submit.on( 'click', function( e ) {
				e.preventDefault();
				var $this 			= $( this ),
					$selectedPages 	= $this.parents( 'form' ).find( 'input.generate-default-pages' ),
					_arr 			= [];

				if ( $this.hasClass( 'disabled' ) ) return true;

				$this.addClass( 'disabled' );

				$selectedPages.each( function() {
					if ( $( this ).is( ':checked' ) ) {
						_arr.push( $( this ).val() );
					}
				} );

				$.post( ajaxurl, {
					'action' 	: 'generate_default_pages',
					'ids' 		: _arr
				}, function( response ) {
					var res = JSON.parse( response );
					if ( res[0] !== '' ) {
						swal({
							type: 'success',
							title: res[0],
							html: res[1],
							confirmButtonText: 'CLOSE',
						});
					} else {
						swal({
							type: 'error',
							title: 'Oops...',
							text: 'Something went wrong!',
							showConfirmButton: false,
							timer: 1500
						});
					}

					$this.removeClass( 'disabled' );
				} );
			} );
		}

		/**
		 * Generate Bulk Pages.
		 */
		function ajax_generate_bulk_pages() {
			var $submit = $( 'input#generate-bulk-pages' );
			$submit.on( 'click', function( e ) {
				e.preventDefault();
				var $this = $( this );

				if ( $this.hasClass( 'disabled' ) ) {
					return true;
				}

				if ( $this.parents( 'form' ).find( '.wpui-error-close' ).length > 0 ) {
					return true;
				}

				$this.addClass( 'disabled' );

				var _pages 			= $this.parents( 'form' ).find( '#pages-to-create' ).val(),
					_page_content 	= $this.parents( 'form' ).find( '#pages-content' ).val(),
					_page_status	= $this.parents( 'form' ).find( '#page-status' ).val(),
					_page_parent	= $this.parents( 'form' ).find( '#page-parent' ).val(),
					_page_template	= $this.parents( 'form' ).find( '#page-template' ).val();

				$.post( ajaxurl, {
					'action' 		: 'generate_bulk_pages',
					'pages' 		: _pages,
					'page_content' 	: _page_content,
					'page_status' 	: _page_status,
					'page_parent' 	: _page_parent,
					'page_template' : _page_template
				}, function( response ) {
					var res = JSON.parse( response );

					if ( res[0] !== '' ) {
						$this.removeClass( 'disabled' );
						$this.parents( 'form' ).find( '#pages-to-create' ).val('');
						swal({
							type: 'success',
							title: res[0],
							html: res[1],
							confirmButtonText: 'CLOSE',
						});
					} else {
						$this.removeClass( 'disabled' );
						swal({
							type: 'error',
							title: 'Oops...',
							text: 'Something went wrong!',
							showConfirmButton: false,
							timer: 1500
						});
					}
				} );
			} );
		}

		/**
		 * Check if radio button is change
		 */
		function custom_login_screen() {
			$( 'input[name=aios_custom_login_screen]' ).on( 'change', function() {
				if ( $( this ).val() == 'true-custom' ) {
					$( '.setting-container-logo' ).fadeIn();
				} else {
					$( '.setting-container-logo' ).fadeOut();
				}
			} );
		}

		/**
		 * Page: Enqueue Libraries
		 */
		function enqueue_libs() {
			var $el = $( 'input[name^=aios-enqueue-cdn]' );

			$el.on('change', function(){
				var $this = $( this );
				if ( $this.attr( 'data-require' ) != '' ) {
					if ( $this.is( ':checked' ) ) {
						$( '#' + $this.attr( 'data-require' ) ).attr('checked', 'checked');
					} else {
						$( '#' + $this.attr( 'data-require' ) ).removeAttr('checked');
					}
				}
			});
		}

		/**
		 * Quick Search: Auto generate json
		 */
		function quick_search_auto_generate_json() {
			var $qsbtn 		= $( '#ihf-generate-json' ),
				$options 	= $( '#aios-quick-search-option' );

			$qsbtn.on( 'click', function( e ) {
				e.preventDefault();

				var cid 	= $( 'input[name="aios-quick-search[cid]"]' ).val(),
					$types 	= $( '.aios-quick-search-types:checked' ),
					types 	= '';

				$types.each( function() {
					types += $( this ).val() + ',';
				} )

				if ( types === '' ) {
					swal({
						type: 'error',
						title: 'Select Type to Generate',
						showConfirmButton: false,
						timer: 1500
					});
				} else {
					$.post( ajaxurl, {
						'action' 	: 'quick_search_generate_json',
						'cid' 		: cid,
						'types' 	: types
					}, function( response ) {
						var res = JSON.parse( response );
						$options.val(res);

						swal({
							type: 'success',
							title: 'JSON is generated',
							showConfirmButton: false,
							timer: 1500
						});
					} );
				}

			} );
		}

		/** Duplicate Menu **/
		function duplicate_menu() {
			var $submit 	= $( 'input#duplicate-menu' ),
				$menu_name	= $( '#duplicate-this-menu-name' );

			$menu_name.on( 'keypress', function() {
				var $this 				= $( this ),
					menu_name 			= $this.val(),
					menu_name_sanitize 	= menu_name.replace(/[^a-zA-Z0-9 ]/g, '');

				$this.val( menu_name_sanitize );
			} );

			$submit.on( 'click', function( e ) {
				e.preventDefault();

				var $this 		= $( this ),
					menu_id 	= $( '#duplicate-this-menu' ).val(),
					menu_name 	= $( '#duplicate-this-menu-name' ).val();


				if ( $this.hasClass( 'disabled' ) ) return true;
				$this.addClass( 'disabled' );

				if ( menu_id == '' || menu_name == '' || menu_id == undefined || menu_name == undefined ) {
					swal({
						type: 'error',
						text: 'Menu or Menu Name is empty',
						showConfirmButton: false,
						timer: 2000
					});
				} else {
					$.post( ajaxurl, {
							'action' 	: 'duplicate_menu',
							'id' 		: menu_id,
							'name' 		: menu_name
						}, function( response ) {
							var res = JSON.parse( response );
							
							if ( res[0] == 'success' ) {
								swal({
									type: 'success',
									title: 'Success',
									showConfirmButton: false,
									timer: 1500
								});
							} else {
								swal({
									type: 'error',
									text: 'There was a problem duplicating your menu.',
									showConfirmButton: false,
									timer: 2000
								});
							}

							$this.removeClass( 'disabled' );
						}
					);
				}

			} );
		}

		/** Refresh minified resources */
		function refresh_minified_resources() {
			var $submit = $( '#refresh-minified-resources' );

			$submit.on( 'click', function( e ) {
				e.preventDefault();

				$.post( ajaxurl, {
					'action' : 'refresh_minified_resources'
				}, function( response ) {
					var res = JSON.parse( response );
					
					if ( res[0] == 'success' ) {
						swal({
							type: 'success',
							title: 'Success',
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						swal({
							type: 'error',
							text: 'Files not found.',
							showConfirmButton: false,
							timer: 2000
						});
					}
				}
			);

			} );
		}


		/**
		 * Instantiate
		 */
		__construct();

	} );
} )( jQuery );