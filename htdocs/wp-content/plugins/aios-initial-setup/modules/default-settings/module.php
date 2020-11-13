<?php

class AIOS_Initial_Setup_Default_Settings {
	
	function __construct() {
		
		/* Enqueue scripts */
		add_action( 'admin_enqueue_scripts', array($this,'custom_admin_assets')  );
		add_action( 'wp_loaded', array($this,'update_options') );
		
	}
	
	function update_options() {
		
		/* Set WP Admin->Settings->Discussion->Default article settings to false */
		update_option('default_pingback_flag',0);
		update_option('default_ping_status',0);
		update_option('default_comment_status',0);
		
	}
	
	function custom_admin_assets() {
		
		wp_enqueue_script('jquery');
		
		wp_register_script('aios-initial-setup-default-settings', AIOS_INITIAL_SETUP_URL . 'modules/default-settings/js/scripts.js');
		wp_enqueue_script('aios-initial-setup-default-settings');
		
	}
	
}

$aios_initial_setup_module_instances_object['aios_initial_setup_default_settings_module'] = new AIOS_Initial_Setup_Default_Settings();