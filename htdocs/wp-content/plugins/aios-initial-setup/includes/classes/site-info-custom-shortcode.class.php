<?php
/**
 * Custom fields and shortcode
 * This will initialize each functions
 * @since 4.0.8
 */
if ( !class_exists( 'aios_site_info_custom_fields_shortcodes' ) ) {
    
    class aios_site_info_custom_fields_shortcodes {

        public $label_value;
        public $name_value;
        public $shortcode_value;
        public $value;

        /**
		 * Initialize.
		 *
		 * @since 4.0.8
		 * @access protected
		 * @return null
		 */
		public function __construct( $aios_cicf_custom_fields = [], $v ) {
            if( !empty( $aios_cicf_custom_fields ) ) {
                $this->label_value = $aios_cicf_custom_fields['label_value'];
                $this->name_value = $aios_cicf_custom_fields['name_value'];
                $this->shortcode_value = $aios_cicf_custom_fields['shortcode_value'];
                $this->value = $v;
                $this->add_actions();
            }
		}

		/**
		 * Add Actions.
		 *
		 * @since 4.0.8
		 * @access protected
		 * @return void
		 */
		protected function add_actions() {
            if ( !shortcode_exists('aios_cicf_' . $this->shortcode_value) ) add_shortcode( 'aios_cicf_' . $this->shortcode_value, array( $this, 'custom_fields' ) );
        }

		/**
		 * Return info.
		 *
		 * @since 3.1.8
		 * @access public
		 * @return string
		 */
		public function custom_fields() {
			return $this->value;
		}

    }

}


/**
 * Run class for each fields
 */
$clientInfoFields = get_option( 'aios_cicf_custom_fields', array() );
$clientInfoFieldsValue = get_option( 'aios_cicf', array() );
foreach ( $clientInfoFields as $k => $v) {
	$inputValue = ( isset( $clientInfoFieldsValue[$v['name_value']] ) ? $clientInfoFieldsValue[$v['name_value']] : '' );
    new aios_site_info_custom_fields_shortcodes( $v, $inputValue );
}