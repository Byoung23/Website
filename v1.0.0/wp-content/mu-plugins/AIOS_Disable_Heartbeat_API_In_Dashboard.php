<?php
/*
Plugin Name: AIOS Disable Heartbeat API In Dashboard
Plugin URI:  http://www.agentimageos.com
Description: This Must-Use plugin disables the Heartbeat API in the Dashboard
Version:     1.0
Author:      Christopher Alabada <christopher.alabada@thedesignpeople.com>
Author URI:  http://www.agentimageos.com
*/
// THIS ONLY WORKS WHILE HOSTED WITH AGENT IMAGE

// defines
define( 'AIOS_HEARTBEAT_PATH', '/var/www/php_includes/AIOS_Disable_Heartbeat_API_In_Dashboard' );

// make sure main exists
if ( file_exists(AIOS_HEARTBEAT_PATH . '/main.php')) {
	require_once(AIOS_HEARTBEAT_PATH . '/main.php');
}

