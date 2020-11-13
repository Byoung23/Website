<?php
/**
 * Name: IHF Extra Configuration
 * Description: Add extra helper to fix known bug
 */
$aios_initial_setup_ihf_extra_configuration = null;
function aios_initial_setup_ihf_extra_configuration_callback() {
	if ( class_exists("iHomefinderAutoloader") ) {
		/* Define paths */
		define( 'ASIS_IHF_EXTRA_CONFIGURATION', plugin_dir_path( __FILE__ ) );

		/* Include required files */
		require_once( ASIS_IHF_EXTRA_CONFIGURATION . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'class-asis-ihf-extra-configuration.php' );

		/* Init module */
		$aios_initial_setup_module_instances_object['aios_initial_setup_ihf_extra_configuration'] = new AIOS_Initial_Setup_IHF_Extra_Configuration();	
	}	
}
add_action( 'init', 'aios_initial_setup_ihf_extra_configuration_callback' );