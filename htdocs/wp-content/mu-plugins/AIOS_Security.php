<?php
/*
Plugin Name: AIOS Security
Plugin URI:  http://www.agentimageos.com
Description: This Must-Use plugin logs every user and blacklists IP's on suspicious activity.
Version:     1.0
Author:      Christopher Alabada <christopher.alabada@thedesignpeople.com>
Author URI:  http://www.agentimageos.com
*/
// THIS ONLY WORKS WHILE HOSTED WITH AGENT IMAGE

// defines
define( 'AIOS_SECURITY_PATH', '/var/www/php_includes/AIOS_Security' );
define( 'AIOS_SECURITY_LIB', AIOS_SECURITY_PATH . '/lib' );

// make sure main exists
if ( file_exists( AIOS_SECURITY_LIB . '/main.php' ) ) {
	require_once( AIOS_SECURITY_LIB . '/main.php' );
}
