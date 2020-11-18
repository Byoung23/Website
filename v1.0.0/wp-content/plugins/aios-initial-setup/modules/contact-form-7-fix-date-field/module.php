<?php

class AIOS_Initial_Setup_Contact_Form_7_Fix_Date_Field {
	
	function __construct() {
		add_action( 'wp_enqueue_scripts', array($this,'enqueue_assets') ); 
	}
	
	function enqueue_assets() {
	
		wp_enqueue_script("jquery");
		
		wp_register_script('aios-initial-setup-cf7-fix-date-field', AIOS_INITIAL_SETUP_URL . 'modules/contact-form-7-fix-date-field/js/contact-form7-normalize-date-field.js');
		wp_enqueue_script('aios-initial-setup-cf7-fix-date-field');
		
		
	}
	
}

$aios_initial_setup_module_instances_object['aios_initial_setup_module_contact_form_7_fix_date_field_module'] = new AIOS_Initial_Setup_Contact_Form_7_Fix_Date_Field ();



