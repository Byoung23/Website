<?php

class AIOS_Initial_Setup_IDX_Broker_Titles{
	
	function __construct() {
		
		/* Add JS/CSS fixes */
		add_action( 'wp_enqueue_scripts', array($this,'enqueue_assets') );
		add_action( 'wp_head', array($this,'add_idx_variables') );
		
	}
	
	
	function enqueue_assets() {
		
		wp_enqueue_script("jquery");
		
		wp_register_script('aios-initial-setup-idxb-titles', AIOS_INITIAL_SETUP_URL . 'modules/idxb-titles/js/asis-idxb-titles.js');
		wp_enqueue_script('aios-initial-setup-idxb-titles');
		
	}
	
	function add_idx_variables() {
		
		if ( function_exists("wpseo_replace_vars") ) { 
			$separator = wpseo_replace_vars("%%sep%%",null);
			$title = wpseo_replace_vars("%%sitename%%",null);
		}
		else {
			$separator = "|";
			$title = wp_title("|",false);
		}
		
		echo "<script>";
		echo "var asis_idx_fixes_yoast_title_separator = '" . $separator . "';";
		echo "var asis_idx_fixes_yoast_title_sitename = '" . $title . "';";
		echo "</script>";
		
	}
	
}

$aios_initial_setup_module_instances_object['aios_initial_setup_idxb_titles_module'] = new AIOS_Initial_Setup_IDX_Broker_Titles();
