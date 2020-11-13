<?php
/*
 * Plugin Name: AIOS Real Estate Roadmaps
 * Description: Creates Buyer,Seller and Financing Resources to your Real Estate Website. Built-in customizable styles to fit in your website scheme.
 * Author: Agent Image
 * Author URI: https://www.agentimage.com/
 * Version: 1.4.8
 */

/*
 * Define paths
 */
if(!defined('AIOS_ROADMAPS_URL')){
	define('AIOS_ROADMAPS_URL', plugin_dir_url(__FILE__) );
}

if(!defined('AIOS_ROADMAPS_DIR')){
	define('AIOS_ROADMAPS_DIR', realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR );
}

require_once( AIOS_ROADMAPS_DIR  . "_lib/roadmaps-class.php" );
?>