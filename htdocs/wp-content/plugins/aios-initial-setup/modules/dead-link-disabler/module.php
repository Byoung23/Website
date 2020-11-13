<?php
/**
 * Name: Disable Right Click And Inspect Element
 * Description: Prevent user from user right click or f12
 */
class AIOS_Initial_Setup_Dead_Link_Disabler {
	
	function __construct() {
		
		/* Enqueue scripts */
		add_action( 'wp_enqueue_scripts', array($this,'enqueue_assets')  );
		
	}
	
	function enqueue_assets() {
		
		wp_register_script('aios_initial_setup_dead_link_disabler', AIOS_INITIAL_SETUP_URL . 'modules/dead-link-disabler/js/aios-initial-setup-dead-link-disabler.js');
		wp_enqueue_script('aios_initial_setup_dead_link_disabler');
		
	}
}

$aios_initial_setup_module_instances_object['aios_initial_setup_dead_link_disabler_module'] = new AIOS_Initial_Setup_Dead_Link_Disabler();