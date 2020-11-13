<?php
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

if ( !class_exists( 'aios_seo_tools_autoloader' ) ) {

	class aios_seo_tools_autoloader {

		/**
		 * Constructor
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
		 * Add Action.
		 *
		 * @since 1.2.4
		 *
		 * @access public
		 */
		public function add_actions() {
		}

		/**
		 * Require files.
		 *
		 * @since 1.2.4
		 *
		 * @access public
		 */
		public function required_files() {
			$aios_seo_file_loader = new aios_seo_file_loader();

			$files = array(
				'seo-tools-config',
				'includes/seo-tools-init.class'
			);
			$aios_seo_file_loader->load_files( $files );

			$aios_seo_file_loader->load_directory( 'includes/classes' );
		}
	}

}

$aios_seo_tools_autoloader = new aios_seo_tools_autoloader();