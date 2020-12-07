<?php
/**
 * Name: Site Adjustments
 * Description: Fix for Listings V2(AIOS_Listings/listing_module)
 */

class AIOS_Initial_Setup_SiteAdjustments {
	
	function __construct() {
		add_action( 'wp_enqueue_scripts', array($this,'enqueue_scripts') );
	}
	
	function enqueue_scripts() {
		wp_enqueue_script('site-fixes', AIOS_INITIAL_SETUP_URL . 'modules/site-adjustments/js/site-adjustments.js',array(), '1.0.0', true);
	}

}

$aios_initial_setup_module_instances_object['aios_initial_setup_siteadjustments_module'] = new AIOS_Initial_Setup_SiteAdjustments();
