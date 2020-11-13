<?php

class AIOS_Initial_Setup_Contact_Form_7_Email_Template {
	
	function __construct() {
		add_action( 'init', array( $this, 'aios_cf7_template_modules'), 1 );
	}

	function aios_cf7_template_modules() {
		if ( !function_exists( 'is_plugin_active' ) ) include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( !is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) add_action( 'admin_notices', array( $this, 'aios_cf7_activate_plugin' ) );

		require_once( 'aios-cf7-email-template.init.php' );
		require_once( 'aios-cf7-before-send.php' );
	}

	function aios_cf7_activate_plugin(){
		printf( '<div class="notice notice-error"><p>Please <strong>Download</strong> and <strong>Activate</strong> Plugin "<a href="https://wordpress.org/plugins/contact-form-7/" target="_blank">Contact Form 7</a>"</p></div>' );
	}
	
}

$aios_initial_setup_module_instances_object['aios_initial_setup_contact_form_7_email_template_module'] = new AIOS_Initial_Setup_Contact_Form_7_Email_Template();