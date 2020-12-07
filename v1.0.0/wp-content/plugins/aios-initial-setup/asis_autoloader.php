<?php
/**
 * This class will return require files
 *
 * @since 2.8.6
 */
if ( !class_exists( 'asis_autoloader' ) ) {
	
	class asis_autoloader {

		/**
		 * Constructor
		 *
		 * @since 2.8.6
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
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_uiux' ), 11 );
			add_action( 'wp_enqueue_scripts', array( $this, 'logged_in_uiux' ), 11 );
			
			add_action( 'admin_menu', array( $this, 'edit_admin_menus' ), 99 );
			add_action( 'admin_menu', array( $this, 'main_tab_menu' ), 10 );
		}

		/**
		 * Enqueue scripts and styles
		 *
		 * @since 2.8.6
		 *
		 * @access public
		 */
		public function admin_uiux() {
			$admin_page_id = get_current_screen()->id;
            $admin_page_contains = 'aios-all-in-one';
            $admin_page_contains_other = 'aios-site-info';
			$font = 'https://fonts.googleapis.com';
			$cdn = 'https://resources.agentimage.com';

			/** Enqueue Agentimage Font **/
			wp_enqueue_style( 'agentimage-font', $cdn . '/fonts/agentimage.font.icons.css' );

			/** Google Font: Deprecated Remove Q2 2019 **/
			wp_enqueue_style( 'admin-uiux-google-font-open-sans', $font . '/css?family=Open+Sans:400,700' );

			/** Google Font: Roboto Condensed and Roboto **/
			wp_enqueue_style( 'admin-uiux-google-font-roboto-condensed', $font . '/css?family=Roboto+Condensed:400,700' );
			wp_enqueue_style( 'admin-uiux-google-font-roboto', $font . '/css?family=Roboto:400,400i,500,700,700i' );

			/** Enqueue Agentimage Utilities **/
			wp_enqueue_style( 'agentimage-utilities', $cdn . '/libraries/css/aios-utilities.min.css' );

			/** Enqueue notification **/
			wp_enqueue_style( 'aios-sweetalert2-style', $cdn . '/admin/css/swal.css' );
			wp_enqueue_script( 'aios-sweetalert2-script', $cdn . '/admin/js/sweetalert2.min.js' );

			/** Enqueue Classic WPUIKIT for old Listings */
			wp_enqueue_style( 'aios-wpuikit-classic-style', $cdn . '/wpuikit/classics/wpuikit-classic.css' );
			
			/** Enqueue WPUIKIT **/
			wp_enqueue_style( 'aios-wpuikit-style', $cdn . '/wpuikit/v1/wpuikit.css' );
			wp_enqueue_script( 'aios-wpuikit-script', $cdn . '/wpuikit/v1/wpuikit.js' );

			/** Enqueue WPUIKIT for Development **/
			// wp_enqueue_style( 'development-aios-wpuikit-style', AIOS_INITIAL_SETUP_URL . 'includes/assets/css/wpuikit.css' );
			// wp_enqueue_script( 'development-aios-wpuikit-script', AIOS_INITIAL_SETUP_URL . 'includes/assets/js/wpuikit.js' );

			/** Enqueue ajax update **/
			wp_enqueue_script( 'aios-ajax-option-update-script', AIOS_INITIAL_SETUP_URL . 'includes/assets/js/ajax-option-update.js', array(), time() );
			wp_localize_script( 'aios-ajax-option-update-script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );

			/** Enqueue AIOS All in One admin **/
			wp_enqueue_style( 'wpuikit-aios-initial-setup-admin-style', $cdn . '/admin/css/aios-all-in-one-admin.css' );
			wp_enqueue_script( 'wpuikit-aios-initial-setup-admin-script', $cdn . '/admin/js/aios-all-in-one-admin.js' );

			/** Enqueue AIOS All in One admin for Development **/
			// wp_enqueue_style( 'wpuikit-aios-initial-setup-admin-style', AIOS_INITIAL_SETUP_URL . 'includes/assets/css/aios-all-in-one-admin.css' );
			// wp_enqueue_script( 'wpuikit-aios-initial-setup-admin-script', AIOS_INITIAL_SETUP_URL . 'includes/assets/js/aios-all-in-one-admin.js' );

			if ( strpos($admin_page_id, 'dashboard') !== false ) {
				/** Enqueue Initial Setup in Dashboard **/
				wp_enqueue_style( 'aios-initial-setup-dashboard-widget', AIOS_INITIAL_SETUP_URL . 'includes/assets/css/initial-setup-dashboard-widget.css' );
			}

			if ( strpos($admin_page_id, $admin_page_contains) !== false || strpos($admin_page_id, $admin_page_contains_other) !== false ) {
				/** Enqueue Media Uploader **/
				wp_enqueue_media();

				/** Enqueue Media Color Picker **/
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( 'wp-color-picker' );
				wp_enqueue_script( 'wp-color-picker-alpha', AIOS_INITIAL_SETUP_URL . 'includes/assets/js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ) );
			}

			if ( strpos($admin_page_id, 'widgets') !== false ) {
				/** Enqueue Initial Setup Styles **/
				wp_enqueue_script( 'aios-initial-setup-widget', AIOS_INITIAL_SETUP_URL . 'includes/assets/js/initial-setup-widget.js' );
			}

		}

		/**
		 * Enqueue scripts and styles for logged in users
		 *
		 * @since 4.1.4
		 *
		 * @access public
		 */
		public function logged_in_uiux() {
			if( is_user_logged_in() ) {
				$cdn = 'https://resources.agentimage.com';

				/** Enqueue AIOS All in One admin **/
				wp_enqueue_style( 'wpuikit-aios-initial-setup-admin-style', $cdn . '/admin/css/aios-all-in-one-admin.css' );
				wp_enqueue_script( 'wpuikit-aios-initial-setup-admin-script', $cdn . '/admin/js/aios-all-in-one-admin.js' );
			}
		}

		/**
		 * Edit Menu for aios all in one
		 *
		 * @since 2.8.6
		 *
		 * @access public
		 */
		public function edit_admin_menus() {
			global $menu;
			global $submenu;

			unset( $submenu['aios-all-in-one'][0] );
		}

		/**
		 * Create a main menu tab for all plugins.
		 *
		 * @since 2.8.6
		 *
		 * @access public
		 */
		public function main_tab_menu() {
			add_menu_page( 
				'AIOS All in One', 
				'AIOS All in One',
				'manage_options', 
				'aios-all-in-one', 
				array( $this, 'renderDashboard' ),
				'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE1LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHdpZHRoPSI0MzkuNzQ2cHgiIGhlaWdodD0iNDA4LjU2NnB4IiB2aWV3Qm94PSIwIDAgNDM5Ljc0NiA0MDguNTY2IiBzdHlsZT0iZmlsbDojODI4NzhjIg0KCSB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwYXRoIGQ9Ik00MzkuNzQ2LDM5MS42Nzl2MTYuODg3SDI5Ny44MnYtMTYuODg3aDM0LjgyM2MzLjk4Mi0wLjE0OCwxNy42NzItMi4xODYsOS45OTEtMjMuNzc2bC0yOS4wNjQtNjguNzg1bDI1LjMzMi02My42ODQNCglsNTcuNjgsMTMzLjA1OGM4Ljg1NiwyMC4zNzUsMTguNzIxLDIyLjkzMywyMi4wMzEsMjMuMTg4SDQzOS43NDZ6IE0yMDMuMjUyLDcxLjMzM0wyMDMuMjUyLDcxLjMzM2w0LjExOS05LjAyOWgtMjQuNjI4DQoJTDQ3Ljk5LDM2OC40MDdsMC0wLjAwMmMtMTEuNzcyLDIwLjc4MS0yMS4yMDgsMjMuMDc1LTIzLjk1NSwyMy4yNzRIMHYxNi44ODdoNTQuMjM4di0wLjI0NWwwLjU1NywwLjI0NUwyMDMuMjUyLDcxLjMzM3oNCgkgTTQwNS44MDcsMy4wODhjLTIuOTIyLDIuNzYxLTEwLjIyOSw1LjUyMS0yNS44MTgsOS4yNTdjLTE1LjU5LDMuNzM1LTIzLjcwOSwxNi41NjMtMjMuNzA5LDE2LjU2Mw0KCWMzLjEyNy0yLjc1NywxNC4yODktNS42NDYsMjcuMDc4LTguMzI1QzM5Ni4xNDUsMTcuOTAzLDQwNS44MDcsMy4wODgsNDA1LjgwNywzLjA4OHogTTM3My4yMDcsMTEzLjI2NQ0KCWMwLDAsMTMuOTIyLTM2LjgzNSwzMS45NDUtMzcuODY2aDExLjA0N1Y2Mi4zMDVoLTU3LjYxMWMzLjI0Mi04LjE0MSwxMi45NTUtOS42OTIsMTIuOTU1LTkuNjkyDQoJYzIxLjkyMi00LjE0MSwzOC4yNDItMTEuMjA1LDM4LjI0Mi0xMS4yMDVjMjkuNzE3LTE3LjUzOCw0LjYyOS00MS40MDksNC42MjktNDEuNDA5YzYuODE4LDIyLjE2Ni04LjUyOCwyMS42NzktMzkuOTQ5LDMxLjE3OQ0KCWMtMzEuNDIyLDkuNS0zMC45MzQsMzEuMTI2LTMwLjkzNCwzMS4xMjZsMC4wMDEsMC4wMDFoLTM0LjUwN3YxMy4wOTRoMjMuNzg1YzIuNzE1LDAuMDM0LDI3LjU5OCwxLjE3MSwxNi4xMzUsMzEuODA5DQoJbC0yOS45NzUsNzYuMjU5TDI1My4xNjIsMzIuMTU0di0wLjAwMUgyMzguMDZMNzkuMzI3LDM5Mi4yMTZsLTcuNDIzLDE2LjM1aDkuNjE1aDM2LjE0NWg0Ny42NDZ2LTE2Ljg4N2gtMzcuMw0KCWMtMTIuODI2LTIuMDg2LTExLjkwNy0xMi44ODMtMTAuMTQtMTkuMzAxbDExMy4zNy0yNjkuNTg3bDAuMDA4LTAuMDI2bDYxLjM3NCwxNDYuMTc2bDAuMzMyLDAuNzE3bC02Mi4yMDIsMTU4LjI1M2gyNC4zNTgNCglsMTE4LjA2Ny0yOTQuNjUyTDM3My4yMDcsMTEzLjI2NXoiLz4NCjwvc3ZnPg0K',
				91
            );
            
            /** Convert icon https://base64.guru/converter/encode/image/svg to Data URI base64 */
		}

	}

	$asis_autoloader = new asis_autoloader();

}