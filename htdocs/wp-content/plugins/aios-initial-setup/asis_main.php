<?php
/**
 * Plugin Name: AIOS Initial Setup
 * Description: Initial Setup for Agent Image Open Source Website.
 * Version: 4.4.7
 * Author: Agent Image
 * Author URI: https://www.agentimage.com/
 * License: Proprietary
 */

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );
$aios_initial_setup_module_instances_object = array();

/** Define Var */
if( ! defined( 'WPCF7_AUTOP' ) ) define ('WPCF7_AUTOP', false );
if( ! defined( 'AIOS_LEADS_NAME' ) ) define( 'AIOS_LEADS_NAME', 'aios_leads' );
if( ! defined( 'AIOS_LEADS_VERSION' ) ) define( 'AIOS_LEADS_VERSION', '1.0.0' );
if( ! defined( 'AIOS_AUDIT_LOGS_NAME' ) ) define( 'AIOS_AUDIT_LOGS_NAME', 'audit_logs' );
if( ! defined( 'AIOS_AUDIT_LOGS_VERSION' ) ) define( 'AIOS_AUDIT_LOGS_VERSION', '1.0.0' );

/** Define paths */
if( ! defined( 'AIOS_INITIAL_SETUP_VERSION' ) ) define( 'AIOS_INITIAL_SETUP_VERSION', '4.4.0' );
if( ! defined( 'AIOS_INITIAL_SETUP_URL' ) ) define( 'AIOS_INITIAL_SETUP_URL', plugin_dir_url( __FILE__ ) );
if( ! defined( 'AIOS_INITIAL_SETUP_DIR' ) ) define( 'AIOS_INITIAL_SETUP_DIR', realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR );

require_once( 'asis_services.php' );
require_once( 'asis_config.php' );

if ( !class_exists( 'asis_initialSetup' ) ) {

	class asis_initialSetup extends asis_initial_config {

		/**
		 * Constructor.
		 *
		 * @since 2.5.4
		 *
		 * @access public
		 */
		public function __construct() {
			$this->asis_initialSetup_actions();
			$this->asis_required_files();
		}

		/**
		 * Add Actions.
		 *
		 * @since 1.0.0
		 *
		 * @access protected
		 */
		protected function asis_initialSetup_actions() {
			register_activation_hook( __FILE__, array( $this, 'install' ) );
			register_deactivation_hook( __FILE__, array( $this, 'uninstall' ) );
			add_action( 'plugins_loaded', array($this, 'update_initial_db') );
			add_action( 'admin_init', array($this, 'register_transient_plugin') );
		}

		/**
		 * Register transient
		 *
		 * @since 2.5.4
		 *
		 * @return string
		 *
		 * @access public
		 */
		public function register_transient_plugin() {
			if ( !$this->get_asis_transient_module( 'modules' ) ) $this->set_asis_transient_module( 'modules', true, false );
		}

		/**
		 * Plugin Uninstallation.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function uninstall(){}

		/**
		 * Plugin Installation.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function install(){
			update_option('permalink_structure','/%postname%/');
            update_option('blogdescription','');

            $this->aios_install_data_table_leads( AIOS_LEADS_VERSION );
            $this->aios_install_data_table_audit_logs( AIOS_AUDIT_LOGS_VERSION );
		}

		/**
		 * Check if database need to be updated.
		 *
		 * @since 4.1.1
		 *
		 * @access public
		 */
		public function update_initial_db(){
            $leads_version = get_option( AIOS_LEADS_NAME . '_version' );
            if ( $leads_version != AIOS_LEADS_VERSION ) $this->aios_install_data_table_leads( AIOS_LEADS_VERSION );

            $audit_logs_version = get_option( AIOS_AUDIT_LOGS_NAME . '_version' );
            if ( $audit_logs_version != AIOS_AUDIT_LOGS_VERSION ) $this->aios_install_data_table_audit_logs( AIOS_AUDIT_LOGS_VERSION );
		}

		/**
		 * Loads all PHP files in a given directory.
		 *
		 * @param string $directory_name
		 * @access public
		 */
		public function load_directory( $directory_name ) {
			$path = trailingslashit( AIOS_INITIAL_SETUP_DIR . $directory_name );
			$file_names = glob( $path . '*.php' );
			foreach ( $file_names as $filename ) {
				if ( file_exists( $filename ) ) {
					require_once $filename;
				}
			}
		}

		/**
		 * Loads specified PHP files from the plugin includes directory.
		 *
		 * @param array $file_names The names of the files to be loaded in the includes directory.
		 * @access public
		 */
		public function load_files( $file_names = array() ) {
			foreach ( $file_names as $file_name ) {
				if ( file_exists( $path = AIOS_INITIAL_SETUP_DIR . $file_name . '.php' ) ) {
					require_once $path;
				}
			}

		}

		/**
		 * Load required files.
		 *
		 * @since 1.0.0
		 *
		 * @access protected
		 */
		protected function asis_required_files() {
			/** Update option to enable classic editor */
			if( empty( get_option( 'aios-modules-classic-editor-install', '' ) ) ) {
				$aios_initial_setup_modules = get_option( 'aios_initial_setup_modules' );
				$aios_initial_setup_modules['classic-editor'] = 'yes';
				update_option( 'aios_initial_setup_modules', $aios_initial_setup_modules );
				update_option( 'aios-modules-classic-editor-install', 'installed' );
			}

			self::load_directory( 'helpers' );
			self::load_files( array( 
				'asis_autoloader',
				'includes/init.class',
				'includes/dashboard/news.dashboard.class',
				'includes/ajax.class',
				'includes/minify/minify.class'
			) );
			self::load_directory( 'includes/classes' );

			/** Load modules */
			$asis_modules_directory 	= AIOS_INITIAL_SETUP_DIR . 'modules';
			$asis_modules 				= preg_grep( '/^([^.])/', scandir( $asis_modules_directory ) );
			$asis_module_opts_option 	= get_option( 'aios_initial_setup_modules' );
            $asis_modules_opts_get		= !empty( $asis_module_opts_option ) ? $asis_module_opts_option : array();
            $asis_modules_opts          = is_array( $asis_modules_opts_get ) ? $asis_modules_opts_get : array( $asis_modules_opts_get );
			$asis_modules_opts_arr 		= array();
			foreach ( $asis_modules_opts as $k => $v) if ( $v ==  'yes' ) $asis_modules_opts_arr[$k]['require-plugin'] = 'no';

			$asis_modules_default 	= $this->aios_initial_setup_advanced_setting_module();
			$asis_modules_default 	= ( is_array( $asis_modules_default ) ? $asis_modules_default : array( $asis_modules_default ) );
			$asis_modules_arr 		= array_merge( $asis_modules_default, $asis_modules_opts_arr );

			foreach ( $asis_modules as $module ) {

				if ( isset( $asis_modules_arr[ $module ] ) ) {
					$is_installed = $asis_modules_arr[ $module ]['require-plugin'];
					$asis_modules_req = $is_installed == 1 || !empty( $is_installed ) ? $is_installed : 'uninstalled';
					$full_dir_path = $asis_modules_directory . DIRECTORY_SEPARATOR . $module;

					if ( $asis_modules_req == 'no' || $asis_modules_req == 'installed' ) {
						if ( is_dir( $full_dir_path ) ) require_once( $full_dir_path . DIRECTORY_SEPARATOR . 'module.php' );
					}
				}

			}

		}

	}

}

$asis_initialSetup = new asis_initialSetup();
