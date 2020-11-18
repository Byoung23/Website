<?php
/**
 * Name: CF7 Invisible Recaptcha Fix Tooltip
 * Description: Fix fading out on hover if Invisible Recaptcha's enabled
 */
class AIOS_Initial_Setup_Contact_Form_7_Invisible_Recaptcha_Fix_Tooltips {
	
	function __construct() {
		
		/* Enqueue scripts */
		add_action( 'wp_enqueue_scripts', array($this,'enqueue_assets')  );
		
	}
	
	function enqueue_assets() {
		
		if ( !function_exists("vsz_cf7_invisible_recaptcha") ) return
		
		wp_register_script('aios_initial_setup_cf7_invisible_recaptcha_fix_tooltips', AIOS_INITIAL_SETUP_URL . '/modules/contact-form-7-invisible-recaptcha-fix-tooltips/js/cf7-invisible-recaptcha-fix-tooltips.js');
		wp_enqueue_script('aios_initial_setup_cf7_invisible_recaptcha_fix_tooltips');
		
	}
}

$aios_initial_setup_module_instances_object['aios_initial_setup_cf7_invisible_recaptcha_fix_tooltips_module'] = new AIOS_Initial_Setup_Contact_Form_7_Invisible_Recaptcha_Fix_Tooltips();