<?php
/**
 * Name: Activity Logs
 * Description: This class will return require files
 * @since version 3.0.9
 */

if ( !defined( 'ABSPATH' ) ) exit;
if ( !class_exists( 'AIOS_Initial_Setup_Activity_Logs' ) ) {
	class AIOS_Initial_Setup_Activity_Logs {

		/**
		 * Constructor
		 *
		 * @since 3.0.9
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {
			$this->add_actions();
			$this->loadfiles();
		}

		/**
		 * Add Actions.
		 *
		 * @since 3.0.9
		 *
		 * @access protected
		 * @return void
		 */
		protected function add_actions() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_uiux' ), 11 );

			add_action( 'admin_init', array( $this, 'delete_activity_logs_custom_table' ) );
			add_action( 'admin_init', array( $this, 'delete_activity_logs' ) );
			add_action( 'admin_menu', array( $this,'render_sub_pages' ), 98 );
		}

		/**
		 * Enqueue scripts and styles for initial setup sub page
		 *
		 * @since 3.0.9
		 *
		 * @access public
		 * @return void
		 */
		public function admin_uiux() {
			$admin_page_id = get_current_screen()->id;
			$admin_page_contains = 'aios-all-in-one_page_logs';

			if ( strpos($admin_page_id, $admin_page_contains) !== false ) {
				// wp_enqueue_script( 'aios-logs-script', AIOS_INITIAL_SETUP_URL . 'includes/assets/js/logs.js' );
				// wp_localize_script( 'aios-logs-script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
			}
        }

		/**
		 * Delete logs beyond 30 Days from custom table
		 *
		 * @param string $directory_name
		 * @access public
		 * @return void
		 */
        public function delete_activity_logs_custom_table() {
			$username = strtolower(wp_get_current_user()->user_login);

			/**  If user not agentimage return **/
            if ( $username !== 'agentimage' ) return;

            global $wpdb;
            $wpdb->query( "DELETE FROM `" . $wpdb->prefix . AIOS_AUDIT_LOGS_NAME . "` WHERE `expires_at` <= CURRENT_DATE" );
        }

		/**
		 * Delete logs beyond 30 Days
		 *
		 * @param string $directory_name
		 * @access public
		 * @return void
		 */
		public function delete_activity_logs() {
			$username = strtolower(wp_get_current_user()->user_login);

			/**  If user not agentimage return **/
            if ( $username !== 'agentimage' ) return;
            
            /**
             * Delete old logs
             */
			$args = array(
				/** Only get post ID's to improve performance **/
				'fields'			=> 'ids', 
				'post_type' 		=> 'aios-acitivty-logs',
				'posts_per_page' 	=> -1,
				'showposts' 		=> -1,
				'date_query'     => array(
					'column'  => 'post_date',
					/** date query for before 1 month  you can set date as well here **/
					'before'   => '-1 month'
				)
			);
			$activity_logs = new WP_Query( $args );
			if( $activity_logs->have_posts() ) {
				while( $activity_logs->have_posts() ) {
					$activity_logs->the_post();
					wp_delete_post( get_the_ID(), true );
				} 
			} 
            
			wp_reset_postdata();
            return false;
		}

		/**
		 * Loads all PHP files in a given directory.
		 *
		 * @param string $directory_name
		 * @access public
		 * @return void
		 */
		public function loadfiles() {
			require_once( 'insert-log.php' );
			$path = trailingslashit( AIOS_INITIAL_SETUP_DIR . DIRECTORY_SEPARATOR . 'modules/activity-logs/hooks' );
			$file_names = glob( $path . '*.php' );
			foreach ( $file_names as $filename ) {
				if ( file_exists( $filename ) ) {
					require_once $filename;
				}
			}
		}

		/**
		 * Add sub menu page.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 * @return void
		 */
		public function render_sub_pages() {
			/** Initial Setup **/
			add_submenu_page( 
				'aios-all-in-one',
				'Audit Logs - AIOS All in One', 
				'Audit Logs', 
				'manage_options', 
				'audit-logs', 
				array($this,'render_backend')
			);
		}
			public function render_backend() {
				require( 'render.php' );
			}

	}
}

$aios_initial_setup_module_instances_object['aios_initial_setup_Activity_Logs'] = new AIOS_Initial_Setup_Activity_Logs();