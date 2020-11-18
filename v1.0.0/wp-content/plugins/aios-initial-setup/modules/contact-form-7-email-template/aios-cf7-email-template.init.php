<?php
if ( !class_exists( 'aios_cf7_template_admin_menu' ) ) {
	require_once( 'aios-global-variables.php' );
	
	class aios_cf7_template_admin_menu {
	
		/**
		 * Constructor
		 *
		 * @since 3.7.9
		 *
		 * @access public
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'cf7_enqueue_libs' ) );
			add_action( 'admin_menu', array( $this, 'render_sub_pages' ), 10 );
		}
	
		/**
		 * Enqueue Libraries
		 *
		 * @since 3.7.9
		 *
		 * @access public
		 */
		public function cf7_enqueue_libs() {
			$admin_page_id = get_current_screen()->id;
			$admin_page_contains = 'aios-email-template';

			if ( strpos($admin_page_id, $admin_page_contains) !== false ) {
				/** Enqueue Media Color Picker **/
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( 'wp-color-picker' );
				wp_enqueue_script( 'wp-color-picker-alpha', AIOS_INITIAL_SETUP_URL . 'includes/assets/js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ) );
				wp_enqueue_script( 'aios-cf7-template-script', AIOS_INITIAL_SETUP_URL . 'modules/contact-form-7-email-template/assets/js/scripts.js', array(), AIOS_INITIAL_SETUP_VERSION, true );
				wp_enqueue_style( 'aios-cf7-template-style', AIOS_INITIAL_SETUP_URL . 'modules/contact-form-7-email-template/assets/css/style.css', array(), AIOS_INITIAL_SETUP_VERSION, false );
			}
		}

		/**
		 * Option Tabs.
		 *
		 * @since 2.8.8
		 *
		 * @access public
		 */
		public function render_sub_pages_options( $tabs = array() ) {
			$tabs = array(
				'' => array(
					'url' 		=> 'user-confirmation',
					'title' 	=> 'User Confirmation',
					'function' 	=> 'user-confirmation.php'
				),
				'client-confirmation' => array(
					'url' 		=> 'client-confirmation',
					'title' 	=> 'Client Confirmation',
					'function' 	=> 'client-confirmation.php'
				)
			);

			return array_filter( $tabs );
		}
	
		/**
		 * Add sub menu page
		 *
		 * @since 3.7.9
		 *
		 * @access public
		 */
		public function render_sub_pages() {
			add_submenu_page( 
				'aios-all-in-one',
				'Email Template - AIOS All in One', 
				'Email Template', 
				'manage_options', 
				'aios-email-template', 
				array( $this, 'render_backend' )
			);
		}
		
		/**
		 * Fallback: Render sub menu page
		 *
		 * @since 3.7.9
		 *
		 * @access public
		 */
		public function render_backend() {
			require( 'render.php' );
		}
	
	}

	$aios_cf7_template_admin_menu = new aios_cf7_template_admin_menu();
}
?>
