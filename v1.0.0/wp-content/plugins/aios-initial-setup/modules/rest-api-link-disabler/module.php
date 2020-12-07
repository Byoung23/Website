<?php
/**
 * Name: Rest API URL(Disabled)
 * Description: This option will help to validate the site from https://html5.validator.nu/
 */
class AIOS_Initial_Setup_REST_API_Link_Disabler {
	
	function __construct() {
		add_action( 'after_setup_theme', array($this, 'remove_rest_api_link') );
	}
	
	function remove_rest_api_link() {
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	}
	
}

$aios_initial_setup_module_instances_object['aios_initial_setup_rest_api_link_disabler_module'] = new AIOS_Initial_Setup_REST_API_Link_Disabler();