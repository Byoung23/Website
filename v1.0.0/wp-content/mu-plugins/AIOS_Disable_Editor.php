<?php
/*
Plugin Name: AIOS Remove Editor
Plugin URI:  http://www.agentimageos.com
Description: This Must-Use plugin removes the editor from wp-admin.
Version:     1.0
Author:      Christopher Alabada <christopher.alabada@thedesignpeople.com>
Author URI:  http://www.agentimageos.com
*/
// THIS ONLY WORKS WHILE HOSTED WITH AGENT IMAGE

// defines
define( 'AIOS_DISABLE_EDITOR_PATH', '/var/www/php_includes/AIOS_Disable_Editor' );
define( 'AIOS_DISABLE_EDITOR_LIB', AIOS_DISABLE_EDITOR_PATH . '/lib' );

// make sure main exists
if ( file_exists( AIOS_DISABLE_EDITOR_LIB . '/main.php' ) ) {
        require_once( AIOS_DISABLE_EDITOR_LIB . '/main.php' );
}
