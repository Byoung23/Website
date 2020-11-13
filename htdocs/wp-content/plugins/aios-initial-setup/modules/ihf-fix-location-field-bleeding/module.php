<?php
/**
 * Name: IHF Fix Location Field Bleeding
 * Description: This will prevent location field from exceeding container
 */
class AIOS_Initial_Setup_IHF_Fix_Location_Field_Bleeding {
	
	function __construct() {
		add_action( 'wp_enqueue_scripts', array($this,'enqueue_assets') ); 
	}
	
	function enqueue_assets() {
	
		wp_register_style('aios-initial-setup-ihf-location-field-bleeding', AIOS_INITIAL_SETUP_URL . 'modules/ihf-fix-location-field-bleeding/css/aios-initial-setup-ihf-fix-location-field-bleeding.css');
		wp_enqueue_style('aios-initial-setup-ihf-location-field-bleeding');
		
		
	}
	
}

$aios_initial_setup_module_instances_object['aios_initial_setup_module_ihf_locaton_field_bleeding_module'] = new AIOS_Initial_Setup_IHF_Fix_Location_Field_Bleeding();



