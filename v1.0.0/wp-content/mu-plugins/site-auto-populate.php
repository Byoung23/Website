<?php
/*
Plugin Name: AIOS Site Auto Populate
Plugin URI: http://www.agentimage.com
Description: This is a simple MU plugin that will trigger default plugin functions.
Author: AgentImage OS
Author URI: http://christianbautista.info
Text Domain: aios-site-auto-populate
Domain Path: /languages/
Version: 1.0.0
*/

require_once( 'site-auto-populate/roadmaps/populate_roadmaps.class.php' );
require_once( 'site-auto-populate/contact-form/populate_contact_form.class.php' );
require_once( 'site-auto-populate/pages/populate_pages.class.php' );

set_time_limit(0);
class SiteAutoPopulate{
	var $plugin_arr = array( );
	function __construct( ) {
		$is_populated = get_option( 'site-auto-populated', 'no' );
		
		if( $is_populated != 'yes' ){ // stop executing anythingn anfter this.
			add_action( 'init', array( $this, 'virtual_page' ) );	
		}
			
	}

	function virtual_page( ){
		error_reporting(0);
		// if( strpos( $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], str_replace( array( 'http://', 'https://' ), '', get_site_url().'/84921611008277968638' ) ) !== false ){	
		if (preg_match('/\/84921611008277968638$/', $_SERVER["REQUEST_URI"])) {
			new PopulateRoadmaps( );
			new PopulateContactForm( );
			new PopulatePages();
			update_option( 'site-auto-populated' , 'yes' );
			
			echo "You can only access this page once";
			//echo "<pre>";
			//print_r(get_option( 'auto-contact-forms'));
			exit();	
		} 
	}
}

new SiteAutoPopulate( );

