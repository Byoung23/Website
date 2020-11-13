( function($) {
	$( document ).ready( function() {

		var $document 		= $( document ),
			$window 		= $( window ),
			$qsselect 		= $( 'select.qs-select' ),
			$qsselectsingle = $( 'select.qs-select-single' );


		function __construct() {
			$window.on( 'load', function() {
				$qsselect.each( function (i,v) {
					var fieldName 	= $(v).attr( 'id' );
					ajaxQuickSearch( $(v), fieldName );
				} );

				$qsselectsingle.each( function() {
					var $this = $( this );
					$this.selectpicker();
				} );
			} );
		}

		function ajaxQuickSearch( input, areaSrc ) {
			
			/* Set up messages */
			var select_title 		    = input.attr('title'),
				acceptedValues 		    = new Array(),
                acceptedValuesText 	    = ( select_title == '' ? 'value' : select_title );
			
			if ( typeof areaSrc == "string" ) {
				
				if ( areaSrc.search("city") > -1 ) {
					acceptedValues.push("city");
				}

				if ( areaSrc.search("zip") > -1 ) {
					acceptedValues.push("ZIP");
				}

				if ( areaSrc.search("neighborhood") > -1 ) {
					acceptedValues.push("Neighborhood");
				}

				if ( areaSrc.search("mlsarea") > -1 ) {
					acceptedValues.push("MLS Area");
				}
				
				if ( acceptedValues.length == 2 ) {
					acceptedValuesText = acceptedValues.join(" or ");
				}
				
				if ( acceptedValues.length > 2 ) {
					acceptedValuesText = acceptedValues.join(", ");
					lastCommaIndex = acceptedValuesText.lastIndexOf(",");
					
					acceptedValuesText1 = acceptedValuesText.slice(0,lastCommaIndex);
					
					acceptedValuesText2 = acceptedValuesText.slice(lastCommaIndex,acceptedValuesText.length);
					acceptedValuesText2 = acceptedValuesText2.replace(",",", or");
					
					acceptedValuesText = acceptedValuesText1 + acceptedValuesText2;
					
                }
                
                acceptedValuesText = acceptedValuesText.replace( 'Select a', '' );
			
            }


            if( input.attr('data-status-placeholder') != undefined ) {
                acceptedValuesText = input.attr('data-status-placeholder');
            }
			
			/* Set up quick search */
			var $formName 		= input.parents( 'form' ),
				$eventSelect 	= input,
				options 		= {
					ajax: {
						url: aios_qs_ajax,
						type: 'POST',
        				dataType: 'json',
						data: { 
							fieldname: areaSrc,
							q: '{{{q}}}'
						}
					},
					locale: {
						errorText: 'Error retrieving results.',
						statusInitialized: 'Start typing a ' + acceptedValuesText + '.',
						statusNoResults: 'The ' + acceptedValuesText + ' not found.',
						searchPlaceholder: '',
						statusSearching: 'Looking for ' + acceptedValuesText + '...'
					},
					preserveSelectedPosition: 'before',
					preprocessData: function( data ) {
						var i, l = data.length, array = [];
						
						if (l) {
							
							

							for(var i = 0; i <= data.length - 1; i++){
								array.push($.extend(true, data[i], {
									text : data[i].text,
									value: data[i].value,
									data : { type: data[i].type, subtext: data[i].remarks }
								}));
							}
						}
						
						

						return array;
					}
				};

			if( $formName.length && $eventSelect.length ) {
				
    			$eventSelect.selectpicker({ liveSearch: true }).ajaxSelectPicker(options);

				// Regenerate fields content
				$eventSelect.on('hidden.bs.select', function (e, clickedIndex, newValue, oldValue) {
					// Remove old data
					$( '.city-zip-fields' ).remove();

					$d = $( this );
					$d.find( 'option:selected' ).each( function(){
						$dd = $(this);
						$field_type = $dd.data('type');
						$field_value = $dd.val();

						if($field_type == 'listingIdList'){

							mlsIdField = $formName.find('input[name=listingIdList]');
							
							if(mlsIdField.length > 0){
								mlsIdField.val(mlsIdField.val() + ',' + $field_value)
							}else{
								$formName.prepend('<input type="hidden" class="city-zip-fields" name="' + $field_type + '" value="' + $field_value + '">');
							}
							
						}else if($field_type == 'street'){
							$formName.prepend('<input type="hidden" class="city-zip-fields" name="' + $field_type + '" value="' + $field_value + '">');
							$formName.prepend('<input type="hidden" class="city-zip-fields" name="streetNumber" value=" ">');
						}else{
							$formName.prepend('<input type="hidden" class="city-zip-fields" name="' + $field_type + '" value="' + $field_value + '">');
						}
					});
				});

			}
		}

		// Instantiate
		__construct();

	} );
} )( jQuery );