<?php
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

if ( !class_exists( 'aios_seotools_setup_init' ) ) {
	class aios_seotools_setup_init extends aios_seo_tools_config {

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function __construct() {
			$this->add_actions();
		}

		/**
		 * Add Actions.
		 *
		 * @since 1.0.0
		 *
		 * @access protected
		 */
		protected function add_actions() {
			add_action( 'admin_menu', array( $this, 'render_submenu' ), 97 );
			add_action( 'admin_enqueue_scripts', array( $this, 'aios_seo_admin_enqueue' ) );
		}
		
		/**
		 * Admin Menu
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function render_submenu() {
			if ( strtolower( wp_get_current_user()->user_login ) == strtolower("AgentImage") ) {
				if ( is_plugin_active( 'aios-initial-setup/asis_main.php' ) ) {
					add_submenu_page( 
						'aios-all-in-one',
						'SEO Settings - AIOS All in One', 
						'SEO Settings', 
						'manage_options', 
						'aios-seo-settings', 
						array( $this, 'aios_seo_setting' )
					);
				} else {
					add_menu_page( 
						'AIOS SEO Settings', 
						'AIOS SEO Settings', 
						'manage_options', 
						'aios-seo-settings', 
						array( $this, 'aios_seo_setting' ),
						SEOTOOLS_SETUP_URL . 'includes/assets/images/icon.png'
					);
				}
			}
		}

		/**
		 * Callback: SEO Settings
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function aios_seo_setting() {
			require_once( 'render.php' );
		}

		/**
		 * Enqueue
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function aios_seo_admin_enqueue() {
			$admin_page_id = get_current_screen()->id;
			$admin_page_contains = 'aios-seo-settings';

			if ( strpos($admin_page_id, $admin_page_contains) !== false ) {
				wp_enqueue_script( 'aios-seo-settings-js', SEOTOOLS_SETUP_URL . 'includes/assets/js/scripts.js', array(), null, true );
				wp_enqueue_media();
			}
		}

	}
}

$aios_seotools_setup_init = new aios_seotools_setup_init();