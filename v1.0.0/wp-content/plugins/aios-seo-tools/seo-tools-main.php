<?php
/**
 * Plugin Name: AIOS SEO Tools
 * Description: Site verification for bing and google. To standardized google analytics and contact form 7 goals tracker.
 * Version: 1.3.7
 * Author: Agent Image
 * Author URI: https://www.agentimage.com/
 * License: Proprietary
 */

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );
if ( !defined( 'SEOTOOLS_SETUP_URL' ) ) define( 'SEOTOOLS_SETUP_URL', plugin_dir_url(__FILE__) );
if ( !defined( 'SEOTOOLS_SETUP_DIR' ) ) define( 'SEOTOOLS_SETUP_DIR', realpath( plugin_dir_path(__FILE__) . DIRECTORY_SEPARATOR ) );

/** Require a helper file **/
require_once( 'helpers/file-loader.php' );


if ( !class_exists( 'aios_seo_tools' ) ) {

	/**
	 * Initialize Plugin
	 *
	 * @since 1.2.4
	 */
	class aios_seo_tools {

		/**
		 * Constructor.
		 *
		 * @since 1.2.4
		 *
		 * @access public
		 */
		public function __construct() {
			$this->add_actions();
			$this->required_files();
		}

		/**
		 * Add Actions.
		 *
		 * @since 1.2.4
		 *
		 * @access public
		 */
		public function add_actions() {
			register_activation_hook( __FILE__, array( $this, 'install' ) );
			register_deactivation_hook( __FILE__, array( $this, 'uninstall' ) );
			
			// Check if is_plugin_active exists
			if( !function_exists('is_plugin_active') ) include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			add_filter( 'plugin_action_links', array( $this, 'disable_plugin_deactivation' ), 10, 6 );

			// Check if yoast has verification data.
			$yoastseo = get_option( 'wpseo' );
			$yoastseo_bv = $yoastseo['msverify'];
			$yoastseo_gv = $yoastseo['googleverify'];
			
			if ( !empty( $yoastseo_bv ) || !empty( $yoastseo_gv ) ) add_action( 'admin_notices', array( $this, 'aios_seo_checker_duplicate' ) );

			// Check if plugin is active: Google Universal Analytics
			if ( is_plugin_active( 'google-universal-analytics/googleanalytics.php' ) ) add_action( 'admin_notices', array( $this, 'aios_seo_checker_google_ua' ) );

			// Check if plugin is active: GSEO Rich Snippet
			if ( is_plugin_active( 'gseo-rich-snippets/gseo-main.php' ) ) add_action( 'admin_notices', array( $this, 'aios_seo_checker_gseors' ) );

			// Check if plugin is active: Google Analytics by MonsterInsights
			if ( is_plugin_active( 'google-analytics-for-wordpress/googleanalytics.php' ) ) add_action( 'admin_notices', array( $this, 'aios_seo_checker_ga_monsterinsights' ) );

			//disable yoast rich snippets
			if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) add_filter( 'wpseo_json_ld_output', '__return_false' );

			// Check version of wpcf7
			if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
				$wpcfv = get_plugin_data( ABSPATH . 'wp-content/plugins/contact-form-7/wp-contact-form-7.php' )['Version'];
				if ( version_compare( substr( $wpcfv, 0, 3 ), '4.7', '<' ) ) add_action( 'admin_notices', array( $this, 'aios_seo_wpcf_version' ) );
			}
		}

		/**
		 * Plugin Installation.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function install(){

		}

		/**
		 * Plugin Uninstallation.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function uninstall(){

		}

		/**
		 * Remove links to edit/delete.
		 *
		 * @since 1.2.4
		 *
		 * @access public
		 */
		public function disable_plugin_deactivation( $actions, $plugin_file, $plugin_data, $context ) {

			$folder_name_arr = explode( '/' , SEOTOOLS_SETUP_URL);
			$folder_name_plugin = $folder_name_arr[ count( $folder_name_arr ) - 3 ];
			$folder_name = $folder_name_arr[ count( $folder_name_arr ) - 2 ];

			// Remove edit link 
			if ( array_key_exists( 'edit', $actions ) && in_array( $plugin_file, array( $folder_name . '/seo-tools-main.php' ) ) ) {
				unset( $actions['edit'] );
			}
			// Remove deactivate link 
			if ( array_key_exists( 'deactivate', $actions ) && in_array( $plugin_file, array( $folder_name . '/seo-tools-main.php' ) ) ) {
				unset( $actions['deactivate'] );
			}
			// Remove settings link 
			if ( array_key_exists( 'settings', $actions ) && in_array( $plugin_file, array( $folder_name . '/seo-tools-main.php' ) ) ) {
				unset( $actions['settings'] );
			} 

			return $actions; 

		}

		/**
		 * Error for Duplicate Verification
		 *
		 * @since 1.2.4
		 *
		 * @access public
		 */
		public function aios_seo_checker_duplicate() {
			printf( '<div class="notice notice-error"><p>Please remove "Google Search Console" and "Bing Webmaster Tools" in Yoast Plugin. <a href="' . get_admin_url() . 'admin.php?page=wpseo_dashboard#top#webmaster-tools" target="_blank">Click Here</a></p></div>' );
		}

		/**
		 * Error for Google Universal Analytics Plugin
		 *
		 * @since 1.2.4
		 *
		 * @access public
		 */
		public function aios_seo_checker_google_ua() {
			printf( '<div class="notice notice-error"><p>Please Deactivate Plugin "Google Universal Analytics". <a href="' . get_admin_url() . 'plugins.php" target="_blank">Click Here</a></p></div>' );
		}

		/**
		 * Error for GSEO Plugin
		 *
		 * @since 1.2.4
		 *
		 * @access public
		 */
		public function aios_seo_checker_gseors() {
			printf( '<div class="notice notice-error"><p>Please Deactivate Plugin "SEO Rich Snippet". <a href="' . get_admin_url() . 'plugins.php" target="_blank">Click Here</a></p></div>' );
		}

		/**
		 * Error for Google Analytics by MonsterInsights Plugin
		 *
		 * @since 1.2.4
		 *
		 * @access public
		 */
		public function aios_seo_checker_ga_monsterinsights() {
			printf( '<div class="notice notice-error"><p>Please Deactivate Plugin "Google Analytics by MonsterInsights Plugin". <a href="' . get_admin_url() . 'plugins.php" target="_blank">Click Here</a></p></div>' );
		}

		/**
		 * If cf7 is lower than 4.7
		 *
		 * @since 1.2.4
		 *
		 * @access public
		 */
		public function aios_seo_wpcf_version() {
			printf( '<div class="notice notice-error"><p>Please Update Contact Form 7 version to 4.7 or newer.</p></div>' );
		}

		/**
		 * Require files.
		 *
		 * @since 1.2.4
		 *
		 * @access public
		 */
		public function required_files() {
			require_once( 'seo-tools-autoloader.php' );
		}

	}

}

$aios_seo_tools = new aios_seo_tools();