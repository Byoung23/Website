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
			ajax_update_option();
			upload_images();
			image_uploader_data_atts();
			template_activator();
			siteInfoAddCustomFields();
			siteInfoAddCustomFieldsDelete();
		}
		
		/**
		 * Filter Array
		 */
		function inArray(needle, haystack) {
			var length = haystack.length;
			for(var i = 0; i < length; i++) {
				if(haystack[i] == needle) return true;
			}
			return false;
		}

		/**
		 * Update Options.
		 */
		function ajax_update_option() {
			$( '.save-option-ajax' ).on( 'click', function( e ) {
				e.preventDefault();

				var $this = $( this ),
					_inputList = [];

				$this.parents( '.wpui-tabs-container' ).find( 'input, select, textarea' ).each( function() {
					if ( $( this ).is( 'submit' ) == false || $( this ).is( 'clear' ) == false ) {

						/** Store element name **/
						var _inputName = $( this ).attr( 'name' );
						if ( _inputName !== undefined ) {
							/** Remove [] **/
							var _inputName = _inputName.replace(/\[(.*)\]/g, '');
							if( inArray( _inputName, _inputList ) == false ) _inputList.push( _inputName );
						}

					}
				} );


				/** Trigger to update ajax **/
				ajax_update_options( _inputList );
			} );
		}
 
		/**
		 * Get value of options and save as array | string
		 */
		function ajax_update_options( options ){
			var regExp 		= /\[([^)]+)\]/;
			/** do not use [] instead use {} for array **/

			options.reverse();

			for (var i = options.length - 1; i >= 0; i--) {
				var optionArr = {};
				if ( $( '#wpui-container :input[name^="' + options[i] + '["], #wpui-container-minimalist :input[name^="' + options[i] + '["]' ).length > 1 ) {

					$( '#wpui-container :input[name^="' + options[i] + '["], #wpui-container-minimalist :input[name^="' + options[i] + '["]' ).each(function( index,val ) {
						var $input 	= $( this ),
							matches = regExp.exec( '"' + $( this ).attr( 'name' ) + '"' );
						/** Default **/
						if ( $input.val() != '' && !$input.is(':checkbox') &&  !$input.is(':radio') ) {
							optionArr[matches[1]] = $input.val();
						}

						/** Check if checkbox **/
						if ( $input.is(':checkbox') ) {
							if ( $input.is(':checked') ) {
								optionArr[matches[1]] = $input.val();
							} 
						}

						/** Check if checkbox **/
						if ( $input.is(':radio') ) {
							if ( $input.is(':checked') ) {
								optionArr[matches[1]] = $input.val();
							} 
						}

					});

					/** Trigger ajax to save **/
					var option_name = options[i];
					var option_value = optionArr;

					ajax_update_options_trigger(option_name, option_value);
				} else {
					/** Trigger ajax to save **/
					var option_name 	= options[i],
						$input 			= $( '#wpui-container :input[name^="' + options[i] + '"], #wpui-container-minimalist :input[name^="' + options[i] + '"]' ),
						option_value 	= '';

						option_value = $input.val();

					if ( $input.is( ':checkbox' ) ) {
						if ( $input.is( ':checked' ) ) {
							option_value = $input.val();
						} else {
							option_value = 0;
						}
					} 

					if ( $input.is( ':radio' ) ) {
						$input.each(function() {
							if ( $( this ).is(':checked') ) {
								option_value = $(this).val();
							}
						});
					}

					ajax_update_options_trigger(option_name, option_value);
				}
			}

			swal({
				type: 'success',
				title: 'Updated',
				showConfirmButton: false,
				timer: 1500
			});
		}

		/**
		 * Trigger this to save in ajax
		 */
		function ajax_update_options_trigger( option_name, option_value ) {
			$.post( ajaxurl, {
				'action' 		: 'aios_save_options',
				'option_name' 	: option_name,
				'option_value' 	: option_value
			}, function( response ) {
				var res = JSON.parse( response );
			} );
		}

		/**
		 * Upload images
		 */
		function upload_images() {
			$( '.setting-button' ).on( 'click', 'input[type=button]', function() {
				/** Element var **/
				var this_parent			= $( this ).parents( '.setting-container-parent' ),
					image_input 		= this_parent.find( '.setting-image-input' ),
					image_prev 			= this_parent.find( '.setting-image-preview' ),
					tabContentWrapper 	= this_parent.parents( 'ul.cd-tabs-content' );

				/** Reset var **/
				tabContentWrapper.css( {height: 'auto'} );

				if ( $( this ).hasClass( 'setting-upload' ) ) {
					var image = wp.media( {
						title: 'Upload Image',
						/** mutiple: true if you want to upload multiple files at once **/
						multiple: false
					} ).open()
					.on( 'select', function(e){
						/** This will return the selected image from the setting Uploader, the result is an object **/
						var uploaded_image = image.state().get( 'selection' ).first();

						/** We convert uploaded_image to a JSON object to make accessing it easier **/
						var image_url = uploaded_image.toJSON().url;

						/** Let's assign the url value to the input field **/
						image_input.val( image_url );
						image_prev.empty( '' );
						image_prev.append( '<img src="' + image_url + '">' );
					});
				} else if( $( this ).hasClass( 'setting-remove' ) ) {
					image_input.val( '' );
					image_prev.empty( '' );
					image_prev.append( '<p>No image uploaded</p>' );
				}

			} );
		}

		/**
		 * Image uploader with array of data-* attributes
		 */
		function image_uploader_data_atts() {
			var $image_uploader_btn = $( '.wpui-uploader-button' );

			$image_uploader_btn.on( 'click', 'input[type=button]', function() {
				/** Default text */
				var $this 				= $( this ),
					post_id 			= ( $( '#post_ID' ).val() != undefined ? $( '#post_ID' ).val() : 0 ),
					this_parent			= $this.parents( '.wpui-uploader-container-parent' ),
					image_input 		= this_parent.find( '.wpui-uploader-image-input' ),
					image_prev 			= this_parent.find( '.wpui-uploader-image-preview' ),
					_title 				= ( this_parent.data( 'title' ) != '' ? this_parent.data( 'title' ) : 'Media Gallery' ),
					_type 				= ( this_parent.data( 'type' ) != '' ? this_parent.data( 'type' ) : 'image' ),
					_button_text		= ( this_parent.data( 'button-text' ) != '' ? this_parent.data( 'button-text' ) : 'Select' ),
					_filter_page_text	= ( this_parent.data( 'filter-page-text' ) != '' ? this_parent.data( 'filter-page-text' ) : 'Uploaded to this Page' );
					_no_image 			= ( this_parent.data( 'no-image' ) != '' ? this_parent.data( 'no-image' ) : 'No image uploaded' ),
					tabContentWrapper 	= this_parent.parents( 'ul.cd-tabs-content' );

				/** Reset var **/
				tabContentWrapper.css( {height: 'auto'} );

				if ( $this.hasClass( 'wpui-uploader-upload' ) ) {
					/** To change type you need to rename all type under createFilters and controller_states */
					wp.media.view.settings.post.id = post_id;

					/** Create our custom upload/browse view for our workflow. */
					var attachmentFiltersView = wp.media.view.AttachmentFilters.Uploaded.extend({
						/** Rename filter */
						createFilters: function() {
							var filters = {};
								filters.all = {
									text: 'All Images',
									props: {
										status: null,
										type: 'image',
										uploadedTo: null,
										orderby: 'date',
										order: 'DESC'
									},
									priority: 10
								};

								filters.uploaded = {
									text: _filter_page_text,
									props: {
										status: null,
										type: 'image',
										uploadedTo: wp.media.view.settings.post.id,
										orderby: 'menuOrder',
										order: 'ASC'
									},
									priority: 20
								};

							this.filters = filters;
						},
						/** on Change */
						change: function(event){
							var filter = this.filters[this.el.value];

							if ( filter ) {
								/** If we are viewing all the items, only show media items not previously attached to other posts. */
								if ( 'all' == this.el.value ){
									this.filters[this.el.value].props.post_parent = 0;
								} else {
									this.filters[this.el.value].props.post_parent = wp.media.view.settings.post.id;
								}
								this.model.set(filter.props);
							}
						},
						/** Selected Filter */
						select: function(){
							var model = this.model,
								value = 'uploaded',
								props = model.toJSON();

							_.find( this.filters, function(filter, id){
								var equal = _.all(filter.props, function(prop, key){
									return prop === ( _.isUndefined(props[key]) ? null : props[key] );
								});

								if ( equal ) return value = id;
							});

							this.$el.val(value);
						}
					});

					/** Overwrite the default view workflow with our own that has been created above. */
					wp.media.view.AttachmentFilters.Uploaded = attachmentFiltersView;

					/** Create our default controller states */
					var controller_states = [
						new wp.media.controller.Library({
							title: _title,
							filterable: 'uploaded',
							library: wp.media.query({ 
								type : _type,
								uploadedTo: wp.media.view.settings.post.id
							}),
							multiple: true,
							contentUserSetting: true
						})
					]

					var image = wp.media( {
							button: { 
								text: _button_text
							},
							state : 'library',
							states: controller_states,
							/** mutiple: true if you want to upload multiple files at once */
							multiple: true
						} )
						.open()
						.on( 'select', function(e){
							/** This will return the selected image from the setting Uploader, the result is an object **/
							var uploaded_image = image.state().get( 'selection' ).first();

							/** We convert uploaded_image to a JSON object to make accessing it easier **/
							var attachment = uploaded_image.toJSON();

							/** Let's assign the url value to the input field **/
							image_input.val( attachment.id );
							image_prev.empty( '' );
							image_prev.append( '<img src="' + attachment.url + '" style="max-width: 100%; margin-bottom: 10px;">' );
						} );
					} else if( $this.hasClass( 'wpui-uploader-remove' ) ) {
						image_input.val( '' );
						image_prev.empty( '' );
						image_prev.append( '<p>' + _no_image + '</p>' );
					}
			} );
		}

		/** Template Activator **/
		function template_activator() {

			var $template 		= $( '.wpui-template' ),
				$activatorBtn 	= $( '.wpui-template-activator' );

			$activatorBtn.on( 'click', function( e ) {
				e.preventDefault();

				var $this 			= $( this ),
					option_name		= $this.attr( 'data-theme-name' ),
					option_value 	= $this.attr( 'data-theme-value' );

				if ( $this.hasClass( 'wpui-template-activated' ) === false ) {
					$.post( ajaxurl, {
						'action' 		: 'aios_save_options',
						'option_name' 	: option_name,
						'option_value' 	: option_value
					}, function( response ) {
						var res = JSON.parse( response );

						swal({
							type: 'success',
							title: 'Updated',
							text: 'Theme will be activate after this page reload.',
							showConfirmButton: false,
							timer: 1500
						});

						$template.removeClass( 'active-template' );
						$this.parents( '.wpui-template' ).addClass( 'active-template' );

						setTimeout( function() {
							location.reload();
						}, 1500 );

					} );
				} else {
					swal({
						type: 'error',
						title: 'Theme is currently active',
						showConfirmButton: false,
						timer: 1500
					});
				}

			} );
		}
		
		/** 
		 * Use to add custom fields
		 * URL: /admin.php?page=site-info&panel_child=custom-fields-shortcodes 
		 */
		function siteInfoAddCustomFields() {
			var $btn 			= $( '#info-custom-fields' ),
				$container 		= $( '.aios-siteinfo-custom-fields' ),
				$notif 			= $( '.info-custom-fields-form-notifications' ),
				regexShortcode 	= /[ !@#$%^&*()+\-=\[\]{};':"\\|,.<>\/?1234567890]/,
				regexName 		= /[ !@#$%^&*()+\=\[\]{};':"\\|,.<>\/?1234567890]/;
			
			$btn.on( 'click', function(e) {
				e.preventDefault();

				var $this 				= $( this ),
					$parent 			= $this.parents( '.info-custom-fields-form' ),
					$label_field 		= $parent.find( '#info-custom-field-label' ),
					label_value 		= $label_field.val(),
					$name_field 		= $parent.find( '#info-custom-field-name' ),
					name_value 			= $name_field.val(),
					$shortcode_field 	= $parent.find( '#info-custom-field-shortcode' ),
					shortcode_value 	= $shortcode_field.val(),
					alertText 			= '';

				if( ( regexName.test( name_value ) || name_value == '' ) || ( regexShortcode.test( shortcode_value ) || shortcode_value == '' ) ) {
					/** Check field name value if has any special characters except hyphen and underscore */
					if( regexName.test( name_value ) || name_value == '' ) alertText += 'Field Name does not empty or contains special characters except hyphen and underscore.';
	
					/** Check field name value if has any special characters except underscore */
					if( regexShortcode.test( shortcode_value ) || shortcode_value == '' ) alertText += 'Field Shortcode does not empty or contains special characters.';

					/** Add text what's causing the error */
					swal({
						type: 'error',
						title: '',
						text: alertText,
						showConfirmButton: true
					});
				} else {
					$.post( ajaxurl, {
						'action' 			: 'client_info_custom_fields',
						'field_action' 		: 'add',
						'label_value' 		: label_value,
						'name_value' 		: name_value,
						'shortcode_value' 	: shortcode_value
					}, function( response ) {
						var res = JSON.parse( response );

						/** If does not have any duplicate, insert HTML */
						if( res[0] == 'success' ) {
							/** Insert HTML */
								var html = '<div class="wpui-row wpui-row-box">\
								<div class="wpui-col-md-3">\
									<p><span class="wpui-settings-title">' + label_value.replace(/^\w/, c => c.toUpperCase()) + '</span><span id="deleteClientInfoFields" style="color: #f00; cursor: pointer;"  data-name="' + name_value + '">Delete</span></p>\
								</div>\
								<div class="wpui-col-md-9">\
									<div class="form-group">\
										<input type="text" name="aios_cicf[' + name_value + ']" id="aios_cicf[' + name_value + ']" \
										value="">\
									</div>\
									<p class="float-left w-100 mt-2">Shortcode: <strong>[aios_cicf_' + shortcode_value + ']</strong></p>\
								</div>\
							</div>';
							$label_field.val('');
							$name_field.val('');
							$shortcode_field.val('');
							$container.append( html );
							swal({
								type: 'success',
								title: 'Added',
								showConfirmButton: false,
								timer: 1500
							});
						} else if( res[0] == 'duplicate' ) {
							/** Duplicate */
							swal({
								type: 'error',
								title: 'Duplicate',
								text: 'field name or shortcodes',
								showConfirmButton: true,
							});
						} else {
							swal({
								type: 'error',
								title: 'No Action Taken',
								showConfirmButton: false,
								timer: 1500
							});
						}
					} );
					
				}
				return false;
			} );
		}
			function siteInfoAddCustomFieldsDelete() {
				$document.on( 'click', '.deleteClientInfoFields', function() {
					var $this = $(this),
						_v = $this.attr( 'data-name' );

					Swal({
						title: 'Are you sure?',
						text: "You won't be able to revert this!",
						type: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Yes, delete it!'
					}).then((result) => {
						if (result.value) {
							$.post( ajaxurl, {
								'action' 			: 'client_info_custom_fields',
								'field_action' 		: 'remove',
								'name_value' 		: _v
							}, function( response ) {
								var res = JSON.parse( response );
								if( res[0] == 'success' ) {
									$this.parents( '.wpui-row-box' ).remove();
									swal({
										type: 'success',
										title: 'Removed',
										showConfirmButton: false,
										timer: 1500
									});
								} else {
									swal({
										type: 'error',
										title: 'No Action Taken',
										showConfirmButton: false,
										timer: 1500
									});
								}
							} );
						}
					});
				} );
			}

		/**
		 * Instantiate
		 */
		__construct();

	} );
} )( jQuery );