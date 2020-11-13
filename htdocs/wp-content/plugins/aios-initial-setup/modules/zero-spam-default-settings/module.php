<?php
/**
 * Name: Zero Spam
 * Description: Update zero spam options and add script fixer
 */
class AIOS_Initial_Setup_Zero_Spam_Default_Settings {
	
	function __construct() {
		/* Enqueue scripts */
		add_action( 'admin_enqueue_scripts', array( $this,'custom_admin_assets' )  );
		add_action( 'wp_loaded', array( $this,'update_options' ) );
	}
	
	function update_options() {
		$settings['wp_generator'] = true;
		$settings['log_spammers'] = true;
		$settings['comment_support'] = true;
		$settings['registration_support'] = true;
		$settings['cf7_support'] = true;
		
		update_option('zerospam_general_settings',$settings);
	}
	
	function custom_admin_assets() {
		wp_enqueue_script('jquery');
		wp_register_script('aios-initial-setup-zero-spam-default-settings', AIOS_INITIAL_SETUP_URL . 'modules/zero-spam-default-settings/js/scripts.js');
		wp_enqueue_script('aios-initial-setup-zero-spam-default-settings');
	}
	
}

$aios_initial_setup_module_instances_object['aios_initial_setup_zero_spam_default_settings_module'] = new AIOS_Initial_Setup_Zero_Spam_Default_Settings();