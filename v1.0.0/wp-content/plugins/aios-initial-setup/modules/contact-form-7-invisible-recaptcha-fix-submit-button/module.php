<?php
/**
 * Name: CF7 Invisible Recaptcha Fix Submit Button
 * Description: Replace input type button to submit
 */
class AIOS_Initial_Setup_Contact_Form_7_Invisible_Recaptcha_Fix_Submit_Button {
	
	function __construct() {
		
		add_action('init',array($this,'init_override'));
	
	}
	
	function init_override() {
		
		if ( !function_exists("vsz_cf7_invisible_recaptcha") ) { 
			return; 
		}
		
		$enable = get_option('invisible_recaptcha_enable');

		if(isset($enable) && $enable == 1){
			remove_action( 'wp_enqueue_scripts', 'vsz_cf7_invisible_recaptcha_page_scripts');
			add_action( 'wp_enqueue_scripts', array($this,'vsz_cf7_invisible_recaptcha_page_script_override') );
		}
	}
	
	function vsz_cf7_invisible_recaptcha_page_script_override() {
		if ( function_exists("vsz_cf7_invisible_recaptcha_page_scripts") ) {
			ob_start();
			vsz_cf7_invisible_recaptcha_page_scripts();
			$content = ob_get_contents();
			$content = str_replace("form.find('.wpcf7-submit').after('<input type=\"button\"","form.find('.wpcf7-submit').after('<input type=\"submit\"",$content);
			ob_end_clean();
			echo $content;
		}
	}
}

$aios_initial_setup_module_instances_object['aios_initial_setup_cf7_invisible_recaptcha_fix_submit_button_module'] = new AIOS_Initial_Setup_Contact_Form_7_Invisible_Recaptcha_Fix_Submit_Button();