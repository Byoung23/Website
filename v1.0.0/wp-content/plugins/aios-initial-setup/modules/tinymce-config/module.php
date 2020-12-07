<?php
/**
 * Name: Tinymce Config
 * Description: Replace font size format from px to pt
 */

class AIOS_Initial_Setup_Tinymce_Config {
	
	function __construct() {
		add_filter( 'tiny_mce_before_init', array( $this, 'add_text_sizes' ) );
		add_filter( 'mce_buttons_2', array( $this, 'configure_buttons' ) );
	}

	function add_text_sizes($settings){
		$settings['fontsize_formats'] = "6pt 7pt 8pt 9pt 10pt 11pt 12pt 14pt 18pt 24pt 36pt 72pt";
		return $settings;
	}
	

	function configure_buttons($settings) {
		array_unshift($settings,'fontsizeselect');
		return $settings;
	}	
	
}

$aios_initial_setup_module_instances_object['aios_initial_setup_tinymce_config_module'] = new AIOS_Initial_Setup_Tinymce_Config();