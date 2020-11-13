<?php
/*
 * Plugin Name: AIOS S3 Tools
 * Description: This plugin allows you to manage internal resources.
 * Version: 1.1.5
 * Author: AgentImage
 * Author URI: https://www.agentimage.com/
 * License: Proprietary
 */

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );
define( 'AIOS_AWS_URL', plugin_dir_url( __FILE__ ) );
define( 'AIOS_AWS_DIR', realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR );


/*
 * Initiliaze Activation/Deactivation Hook/Session
 */
$aios_aws_hook = new aios_aws_hook();

class aios_aws_hook {

	function __construct() {

		register_activation_hook(  __FILE__, array( $this, 'aios_aws_activation' ) );
		register_deactivation_hook(  __FILE__, array( $this, 'aios_aws_deactivation' ) );


		add_action('init', array( $this, 'aios_aws_catch_user'), 1);

		// Destroy Session on login and logout
		add_action('wp_logout', array( $this, 'plugin_session_end' ) );
		add_action('wp_login', array( $this, 'plugin_session_end' ) );

	}


	// On plugin activation
	function aios_aws_activation() {
		set_transient( 'aios_aws_active', true, 0 );
	}

	// On plugin deactivation
	function aios_aws_deactivation() {
		delete_transient( 'aios_aws_active' );
	}

	function aios_aws_catch_user() {
		/*
		 * Check if logged in and user is AgentImage then Load required files except on rewrite and redirect
		 */
		if ( strtolower( wp_get_current_user()->user_login ) == strtolower("AgentImage") ) {

			if ( get_transient( 'aios_aws_active' ) ) {
				require_once( 'vendor/aws-s3.php' );
				
				$aws_modules_directory = AIOS_AWS_DIR . 'modules';
				$aws_modules = preg_grep('/^([^.])/', scandir( $aws_modules_directory ));
							
				foreach ( $aws_modules as $module ) {
					
					$full_dir_path = $aws_modules_directory . DIRECTORY_SEPARATOR . $module;
					
					if ( is_dir( $full_dir_path ) ) {
						require_once( $full_dir_path . DIRECTORY_SEPARATOR . 'module.php' );
					}
					
				}

			}

		}
	    
	}

	function plugin_session_end() {
		// Deleting a cookie
		unset( $_COOKIE["wordpress_QWdlbnRJbWFnZQ"] );
		setcookie( "wordpress_QWdlbnRJbWFnZQ", "", time()-3600 );
	}

}