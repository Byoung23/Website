<?php
/**
 * Name: IHF OVerride Text Color
 * Description: Change the text color of price to black on v
 * 
 */
class AIOS_Initial_Setup_IHF_Override_Text_Color {
	
	function __construct() {
		add_action( 'wp_enqueue_scripts', array($this,'enqueue_assets') ); 
	}
	
	function enqueue_assets() {
		wp_register_style('aios-initial-setup-ihf-override-text-color', AIOS_INITIAL_SETUP_URL . 'modules/ihf-override-text-color/css/aios-initial-setup-ihf-override-text-color.css');
		wp_enqueue_style('aios-initial-setup-ihf-override-text-color');	
	}
}

$aios_initial_setup_module_instances_object['aios_initial_setup_module_ihf_override_text_color_module'] = new AIOS_Initial_Setup_IHF_Override_Text_Color();



