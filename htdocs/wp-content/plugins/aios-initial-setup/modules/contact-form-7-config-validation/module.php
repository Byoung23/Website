<?php

class AIOS_Initial_Setup_Contact_Form_7_Config_Validation {
	
	function __construct() {
		add_action( 'wpcf7_config_validator_validate', array($this, 'remove_error_email_not_in_site_domain'), 100, 1 ); 
	}
	
	function remove_error_email_not_in_site_domain($instance) {

		/* Always allow emails from other domains as senders */
		$instance->remove_error('mail.sender',103);
		$instance->remove_error('mail_2.sender',103);
	}
	
}

$aios_initial_setup_module_instances_object['aios_initial_setup_contact_form_7_config_validation_module'] = new AIOS_Initial_Setup_Contact_Form_7_Config_Validation();



