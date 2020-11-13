<?php

class AIOS_Initial_Setup_IHF_Extra_Configuration {
	
	function __construct() {
		
		add_action("admin_menu", array( $this, "generate_menu"), 12 );
		add_action("admin_init", array( $this, "register_settings"));
		add_action("wp_head", array($this,"add_idx_variables") );
		add_action("wp_enqueue_scripts", array($this,"enqueue_assets") );
		
	}
	
	function enqueue_assets() {
		
		wp_register_script("aios-initial-setup-ihf-extra-configuration", AIOS_INITIAL_SETUP_URL . "modules/ihf-extra-configuration/js/ihf-extra-configuration.js");
		wp_enqueue_script("aios-initial-setup-ihf-extra-configuration");
		
	}
	
	function generate_menu() {
		
		if ( defined('iHomefinderConstants::PAGE_INFORMATION') ) {
			add_submenu_page(
				iHomefinderConstants::PAGE_INFORMATION, 
				"AIOS Extra Configuration", 
				"AIOS Extra Configuration", 
				"manage_options", 
				"ihf-aios-extra-configuration", 
				array( $this, 'get_content' )
			);
		}
		
	}
	
	function register_settings() {
		
		register_setting("ihf-aios-extra-configuration","ihf-aios-extra-configuration-map-layer");
		
	}
	
	function get_content() {
		
		include_once ASIS_IHF_EXTRA_CONFIGURATION . DIRECTORY_SEPARATOR . views . DIRECTORY_SEPARATOR . "ihf-extra-configuration.php";
		
	}
	
	function add_idx_variables() {
		
		$map_layer = get_option("ihf-aios-extra-configuration-map-layer") !== false ? get_option("ihf-aios-extra-configuration-map-layer") : 0;
		
		/* Added to version 2.6.6 */
		$map_layer = apply_filters('asis-ihf-aios-configuration-map-layer-filter',$map_layer);
		
		echo "<script>";
		echo "var asis_ihf_extra_configuration_map_layer = " . $map_layer . ";";
		echo "</script>";
		
	}

	
}