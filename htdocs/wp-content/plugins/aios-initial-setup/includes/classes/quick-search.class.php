<?php
/**
 * This will replace admin bar menu
 *
 * @since 2.8.6
 */
if ( !class_exists( 'aios_initial_setup_init_quick_search' ) ) {
	
	class aios_initial_setup_init_quick_search{

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function __construct() {
			$this->add_actions();
		}

		/**
		 * Add Actions.
		 *
		 * @since 1.0.0
		 *
		 * @access protected
		 */
		protected function add_actions() {
			$quick_search 		= get_option( 'aios-quick-search' );
			$enabled 			= isset( $quick_search['enabled'] ) ? $quick_search['enabled'] : '';

			if ( !empty( $enabled ) ) {
				/** Create Shortcode **/
				add_shortcode( 'aios_quick_searh_autocomplete', array( $this, 'get_aios_quick_searh_autocomplete' ) );
				add_shortcode( 'aios_quick_search_autocomplete', array( $this, 'get_aios_quick_search_autocomplete' ) );
				add_shortcode( 'aios_quick_search_property_type', array( $this, 'get_aios_quick_search_property_type' ) );
				add_shortcode( 'aios_quick_search_beds', array( $this, 'get_aios_quick_search_beds' ) );
				add_shortcode( 'aios_quick_search_baths', array( $this, 'get_aios_quick_search_baths' ) );
				add_shortcode( 'aios_quick_search_price', array( $this, 'get_aios_quick_search_price' ) );

				/** Create Virtual Page for JSON **/
				add_action( 'init', array( $this, 'virtual_page' ) );
			}
		}

		/**
		 * Generate JSON by CID
		 *
		 * @since 3.0.5
		 *
		 * @access public
		 */	
		public function generate_json( $cid, $types ) {

			$fieldnames = array_filter( explode(',', $types) );

			if ( $types != 'cityId,' ) $types = str_replace( 'cityId', 'city', $types );

			$output = '';
			$fieldname_count = 1;

			foreach ( $fieldnames as $fieldname ) {
				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, "http://www.idxhome.com/service/listing/areas/ajax/" . trim( $cid ) . "?fieldName=" . $fieldname . "&maxResults=0" );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
				$areas = curl_exec($ch);
				$areas = json_decode( $areas );
				$area = array();
				$v = '';
				$count = 1;

				foreach ( $areas as $area ) {
					$separator = ( $count == 1 ? '' : ',' );

					switch($area->fieldName) {
						case 'cityId':
							$remarks = 'City';
							break;
						
						case 'zip':
							$remarks = 'Zip Code';
							break;

						case 'mlsarea':
							$remarks = 'MLS Area';
							break;

						case 'neighborhood':
							$remarks = 'Neighborhood';
							break;

						default:
							$remarks = '';
							break;
					}

					$v .= $separator . '{ "remarks": "' . $remarks . '", "value": "' . $area->value . '", "text": "' . $area->label . '", "type": "' . $area->fieldName . '[]"}' ;
					$count++;
				}

				$fieldname_separator = ( $fieldname_count == 1 ? '' : ',' );

				if ( !empty( $v ) ) {
					$output .= $fieldname_separator . $v;
					$fieldname_count++;
				}
			}

			return '{"' . str_replace( ',', '', strtolower( $types ) ) . '":[' .  $output . ']}';
		}

		/**
		 * FALLBACK for previous wrong spelling
		 *
		 * @since 3.0.5
		 *
		 * @access public
		 * @return string
		 */	
		public function get_aios_quick_searh_autocomplete( $atts ) {
			/** Set defaults **/
			$atts = shortcode_atts(
				array(
					'id' 			=> 'city',
					'name' 			=> 'cityzip',
					'class' 		=> '',
					'placeholder' 	=> 'Select a City'
				), $atts, 'aios_quick_searh_autocomplete' 
			);

			$areas =  '<select name="' . $atts['name'] . '" id="' . $atts['id'] . '"  data-type="' . $atts['id'] . '" class="qs-select ' . $atts['class'] . '" multiple title="' . $atts['placeholder'] . '"></select>';

			return $areas;
		}

		/**
		 * Create a shortcode for City auto_complete
		 *
		 * @since 3.0.5
		 *
		 * @access public
		 * @return string
		 */	
		public function get_aios_quick_search_autocomplete( $atts ) {
			$quick_search 			= get_option( 'aios-quick-search' );
			$arr_default_id 		= array();
			$arr_default_id[] 		= $quick_search['cityId'] == 'cityId' && ( !empty( $quick_search['zip'] ) || !empty( $quick_search['neighborhood'] ) || !empty( $quick_search['mlsarea'] ) ) ? 'city' : 'cityid';
			$arr_default_id[] 		= $quick_search['zip'] == 'zip' ? 'zip' : '';
			$arr_default_id[] 		= $quick_search['neighborhood'] == 'neighborhood' ? 'neighborhood' : '';
			$arr_default_id[] 		= $quick_search['mlsarea'] == 'mlsarea' ? 'mlsarea' : '';
			$arr_default_id  		= array_filter( $arr_default_id );
			$default_id 			= implode( '', $arr_default_id );
			$default_placeholder  	= ucwords( implode( ', ', $arr_default_id ) );
			$default_placeholder 	= str_replace( 'Cityid', 'City', $default_placeholder );
			$default_placeholder 	= str_replace( 'Zip', 'ZIP', $default_placeholder );

			/** Set defaults **/
			$atts = shortcode_atts(
				array(
					'id' 			        => $default_id,
					'name' 			        => '',
					'is_name_arr' 	        => false,
					'class' 		        => '',
                    'placeholder' 	        => 'Select a ' . $default_placeholder,
                    'status_placeholder'    => ''
				), $atts, 'aios_quick_search_autocomplete' 
			);

			$selectType = isset( $quick_search['enable_single_qs'] ) ? '' : 'multiple';
			$name = ( !empty( $atts['name'] ) ? $atts['name'] : $default_id );
            $name = ( $atts['is_name_arr'] ? $name . '[]' : $name );
            $status_placeholder = ( !empty( $atts['status_placeholder'] ) ? 'data-status-placeholder="' . $atts['status_placeholder'] . '"' : '' );

			$areas =  '<select name="' . $name . '" id="' . $atts['id'] . '"  data-type="' . $atts['id'] . '" class="qs-select ' . $atts['class'] . '" '. $selectType .' title="' . $atts['placeholder'] . '" ' . $status_placeholder . '></select>';

			return $areas;
		}

		/**
		 * Create a shortcode for property types
		 *
		 * @since 3.0.5
		 *
		 * @access public
		 * @return string
		 */	
		public function get_aios_quick_search_property_type( $atts ) {
			/** Set defaults **/
			$atts = shortcode_atts(
				array(
					'id'				=> 'property-type',
					'name'				=> 'propertyType',
					'is_name_arr' 		=> false,
					'class' 			=> '',
					'placeholder' 		=> 'Select Property Type',
					'use_ihf_default' 	=> false,
					'types' 			=> 'commercial=>Commercial|condo-coop=>Condo/coop|investment=>Investment|land=>Land|mobile-manufactured=>Mobile/manufactured|residential=>Residential|single-family=>Single Family|townhouse=>Townhouse|vacation=>Vacation'
				), $atts, 'aios_quick_search_property_type' 
			);

			extract( $atts );
			$arr_types = explode( '|', $types);
			$name = ( $is_name_arr ? $name . '[]' : $name );

			$html = '<select name="' . $name . '" id="' . $id . '" class="qs-select-single ' . $class . '" title="' . $placeholder . '">';
			if( !empty( $placeholder ) ) $html .= '<option data-hidden="true" value="">' . $placeholder . '</option>';

			if ( $use_ihf_default ) {
				$html .= '<option value="SFR,CND">House / Condo</option>
					<option value="SFR">House Only</option>
					<option value="CND">Condo Only</option>
					<option value="LL">Lots / Land</option>
					<option value="RI">Multi-Unit Residential</option>
					<option value="RNT">Rental</option>
					<option value="COM">Commercial</option>';
			} else {
				foreach ( $arr_types as $type ) {
					if ( strpos( $type, '=>' ) !== false ) {
						$arr_type = explode( '=>', $type );
						$html .= '<option value="' . trim( $arr_type[0] ) . '">' . trim( $arr_type[1] ) . '</option>';
					} else {
						$html .= '<option value="' . trim( $type ) . '">' . trim( $type ) . '</option>';
					}
				}
			}
			$html .= '</select>';

			return $html;
		}

		/**
		 * Create a shortcode for quick search beds
		 *
		 * @since 3.0.5
		 *
		 * @access public
		 * @return string
		 */	
		public function get_aios_quick_search_beds( $atts ) {
			/** Set defaults **/
			$atts = shortcode_atts(
				array(
					'id'			=> 'beds',
					'name'			=> 'bedrooms',
					'is_name_arr' 	=> false,
					'class' 		=> '',
					'placeholder' 	=> 'Beds',
					'min' 			=> '1',
					'max' 			=> '5'
				), $atts, 'aios_quick_search_beds' 
			);

			extract( $atts );
			$numbers = range( $min, $max);
			$name = ( $atts['is_name_arr'] ? $name . '[]' : $name );

			$html 	= '<select name="' . $name . '" id="' . $id . '" class="qs-select-single ' . $class . '" title="' . $placeholder . '">';

			if( !empty( $placeholder ) ) $html .= '<option data-hidden="true" value="">' . $placeholder . '</option>';

			foreach ( $numbers as $number ) {
				$html .= '<option value="' . trim( $number ) . '">' . trim( $number ) . '</option>';
			}
			$html .= '</select>';

			return $html;
		}

		/**
		 * Create a shortcode for quick search baths
		 *
		 * @since 3.0.5
		 *
		 * @access public
		 * @return string
		 */	
		public function get_aios_quick_search_baths( $atts ) {
			/** Set defaults **/
			$atts = shortcode_atts(
				array(
					'id'			=> 'baths',
					'name'			=> 'bathCount',
					'is_name_arr' 	=> false,
					'class' 		=> '',
					'placeholder' 	=> 'Baths',
					'min' 			=> '1',
					'max' 			=> '5',
					'halfbath'  	=> false
				), $atts, 'aios_quick_search_baths' 
			);

			extract( $atts );
			$increment = $halfbath == 'true' ? 0.5 : 1;
			$numbers = range( $min, $max, $increment);
			$name = ( $is_name_arr ? $name . '[]' : $name );

			$html 	= '<select name="' . $name . '" id="' . $id . '" class="qs-select-single ' . $class . '" title="' . $placeholder . '">';

			if( !empty( $placeholder ) ) $html .= '<option data-hidden="true" value="">' . $placeholder . '</option>';

			foreach ( $numbers as $number ) {
				$html .= '<option value="' . trim( $number ) . '">' . trim( $number ) . '</option>';
			}
			$html .= '</select>';

			return $html;
		}

		/**
		 * Create a shortcode for quick search price
		 *
		 * @since 3.0.5
		 *
		 * @access public
		 * @return string
		 */	
		public function get_aios_quick_search_price( $atts ) {
			/** Set defaults **/
			$atts = shortcode_atts(
				array(
					'id'			=> 'price',
					'name'			=> '',
					'is_name_arr' 	=> false,
					'is_min_price' 	=> false,
					'class' 		=> '',
					'placeholder' 	=> 'Price',
					'prices' 		=> '100000|300000|500000',
					'currency' 		=> '$'
				), $atts, 'aios_quick_search_price' 
			);

			extract( $atts );
			$arr_prices = explode( '|', $prices);
			$nameField = ( !empty( $name ) ? $name : ( $isMinPrice ? 'minListPrice' : 'maxListPrice' ) );
			$nameField = ( $is_name_arr ? $nameField . '[]' : $nameField );

			$html = '<select name="' . $nameField . '" id="' . $id . '" class="qs-select-single ' . $class . '" title="' . $placeholder . '">';
			if( !empty( $placeholder ) ) $html .= '<option data-hidden="true" value="">' . $placeholder . '</option>';
			
			foreach ( $arr_prices as $price ) {
				$price = trim( $price );
				if ( strpos( $price, '-') !== false ) {
					$arr_price = explode( '-', $price);
					$html .= '<option value="' . number_format( floatval( $arr_price[0] ) ) . '-' . number_format( floatval( $arr_price[1] ) ) . '">' . $currency . number_format( floatval( $arr_price[0] ) ) . ' - ' . $currency . number_format( floatval( $arr_price[1] ) ) . '</option>';
				} else {
					$html .= '<option value="' . number_format( floatval( $price ) ) . '">' . $currency . number_format( floatval( $price ) ) . '</option>';
				}
			}
			$html .= '</select>';

			return $html;
		}
		
		/**
		 * Compare two strings. Used by virtual_page() in alphabetizing search locations.
		 *
		 * @param string $a - first string to compare
		 * @param string $b - second string to compare
		 *
		 * @int bool
		 *
		 * @since 3.8.4
		 *
		 * @access protected
		 */
		protected function sort_locations_by_text($a,$b) {
			return strcmp($a->text, $b->text);
		}

		/**
		 * This will display all json files in a virtual page
		 *
		 * @since 3.0.5
		 *
		 * @access public
		 */	
		public function virtual_page( ){
			error_reporting(0);			
			if( strpos( $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], str_replace( array( 'http://', 'https://' ), '', get_site_url().'/31jislt2xAmlqApY8aDhWbCzmonLuOZp' ) ) !== false ){

				header('Access-Control-Allow-Origin: *');

				$dummy_opt =  '{"cityId":[{"value":"47","text":"Auburn","type":"cityId[]"},{"value":"119","text":"Cameron Park","type":"cityId[]"},{"value":"155","text":"Citrus Heights","type":"cityId[]"},{"value":"236","text":"Discovery Bay","type":"cityId[]"},{"value":"261","text":"El Dorado","type":"cityId[]"},{"value":"262","text":"El Dorado Hills","type":"cityId[]"},{"value":"271","text":"Elk Grove","type":"cityId[]"},{"value":"343","text":"Grass Valley","type":"cityId[]"},{"value":"6848","text":"Mountain House","type":"cityId[]"},{"value":"23351","text":"Murphys","type":"cityId[]"},{"value":"720","text":"Placerville","type":"cityId[]"},{"value":"781","text":"Rocklin","type":"cityId[]"},{"value":"791","text":"Roseville","type":"cityId[]"},{"value":"887","text":"Sonora","type":"cityId[]"},{"value":"954","text":"Twain Harte","type":"cityId[]"}]}';

				$qs_option 	= stripslashes( get_option('aios-quick-search-option') );
				$options 	= !empty( $qs_option ) ? $qs_option : $dummy_opt;

				$options 	= json_decode( $options );


				$fieldname 	= ( $_POST['fieldname'] == 'city' ? 'cityId' : $_POST['fieldname'] );
				$s 			= ( $_POST['q'] == '' ? '' : $_POST['q'] );

				if ( isset( $_POST['fieldname'] ) && isset( $_POST['q'] ) ) {

					$arsearch = array();
					foreach ( $options->$fieldname as $option ) {
						if ( stripos( $option->text, $s ) !== false) {
							array_unshift( $arsearch, $option );
						}
					}
					
					usort($arsearch, array($this,"sort_locations_by_text"));

					$arsearch = array_slice( array_values( $arsearch ), 0, 20 );
					
					$quick_search 		= get_option( 'aios-quick-search' );

					if(isset($quick_search['mls']) && $quick_search['mls'] == 'mls'){
						if(strpos($s, ' ') === false){	
							$arsearch = array_merge($arsearch, json_decode('[{ "remarks": "MLS#", "value": "'.$s.'" , "text": "'.$s.'" , "type": "listingIdList"}]'));
						}
					}

					if(isset($quick_search['address']) && $quick_search['address'] == 'address'){
							$arsearch = array_merge($arsearch, json_decode('[{ "remarks": "Street Address", "value": "'.$s.' " , "text": "'.$s.'" , "type": "street"}]'));
					}
			

					echo json_encode( $arsearch );
				} elseif ( isset( $_POST['fieldname'] ) ) {
					echo json_encode($options->$fieldname);
				} else {
					echo json_encode($options);
				}

				exit;
			} 
		}

	}

    $aios_initial_setup_init_quick_search = new aios_initial_setup_init_quick_search();
        
}