<?php

/*
 * Plugin Name: AIOS All Widgets
 * Description: Bundles unrelated AgentImage widgets that are considered too simple to warrant a new plugin
 * Version: 2.2.2
 * Author: Agent Image
 * Author URI: https://www.agentimage.com/
 * License: Proprietary
 */
 
/* Define paths */

if(!defined('AIOS_ALL_WIDGETS_URL')){
	define('AIOS_ALL_WIDGETS_URL', plugin_dir_url(__FILE__) );
}

if(!defined('AIOS_ALL_WIDGETS_DIR')){
	define('AIOS_ALL_WIDGETS_DIR', realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR );
} 

/* Load classes */
require( AIOS_ALL_WIDGETS_DIR . 'lib' . DIRECTORY_SEPARATOR . 'class-aios-all-widgets-controller.php' );

/* Run plugin */
function aios_all_widgets_runner() {
}
	new AIOS_All_Widgets_Controller();

add_action( 'plugins_loaded', 'aios_all_widgets_runner',15);