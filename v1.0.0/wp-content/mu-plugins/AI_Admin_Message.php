<?php
/*
Plugin Name: AI Admin Message
Plugin URI:  http://www.agentimage.com
Description: This Must-Use plugin allows Agent Image to display messages on the Dashboard.
Version:     1.0
Author:      Christopher Alabada <christopher.alabada@thedesignpeople.com>
Author URI:  http://www.agentimage.com
*/
// THIS ONLY WORKS WHILE HOSTED WITH AGENT IMAGE

// defines
define( 'AI_ADMIN_MESSAGE_PATH', '/var/www/php_includes/AI_Admin_Message' );

// make sure main exists
if ( is_file( AI_ADMIN_MESSAGE_PATH . '/main.php' ) ) {
    require_once( AI_ADMIN_MESSAGE_PATH . '/main.php' );
}
