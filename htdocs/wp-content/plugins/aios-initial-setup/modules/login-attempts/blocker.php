<?php
/**
 * block isp on blacklisted when accessing wp-login and wp-registration
 */

use AIOS\Services\IPS;

if ( !class_exists( 'AIOS_Initial_Setup_Modules_Login_Attempts_Blocker' ) ) {

	class AIOS_Initial_Setup_Modules_Login_Attempts_Blocker {

        protected $post_type, $isp;

		/**
         * Initialise your object's
         * 
         * @since 4.2.4
         * @return void
         */
		public function __construct() {
			$this->add_actions();
        }

        /**
         * Check if isp exists
         * 
         * @since 4.2.4
         * @return string|boolean
         */
        public static function is_isp_exists() {
            $post = get_posts( array( 'title' => IPS::isp(), 'post_type' => 'aios-login-attempts' ));
            return !empty( $post[0]->ID ) ? $post[0]->ID : false;
        }

        /** 
         * Check if isp is more than 5 login attempts
         * 
         * @since 4.2.4
         * @return boolean
         */
        public static function is_isp_blocked() {
            $post = self::is_isp_exists();

            if( ! empty( $post ) ) {
                return get_post_meta( $post, 'attempts', true ) >= 5 ? true : false;
            } else {
                return false;
            }
        }
        
        /**
         * Check if user is in login page or registration page
         * 
         * @since 4.2.4
         * @return boolean
         */
        public static function is_login_page() {
            return in_array( $GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php') );
        }

		/**
		 * Add Actions.
		 *
		 * @since 4.2.4
		 *
		 * @return void
		 */
		protected function add_actions() {
            add_action( 'wp_login_failed', array( $this, 'failed_login_checker' ) , 10, 3 );  /** Check if logged in failed */
            add_action( 'init', array( $this, 'instantiate_blocking' ), 11 );

            if ( defined('XMLRPC_REQUEST') && XMLRPC_REQUEST ) add_action( 'init', array( $this, 'check_xmlrpc_lock' ) );
        }

        public function check_xmlrpc_lock() {
            if ( is_user_logged_in() || IPS::whitelist_ip() ) return;
                
            if ( self::is_isp_blocked() ) {
                header('HTTP/1.0 403 Forbidden');
                exit;
            }
        }

		/**
		 * If failed to loging return to normal url
         * 
		 * @since 4.2.4
		 * @param string $username - user tried to login
		 * @return void
		 */
		public function failed_login_checker( $username ) {
			/**
			 * Check if failed is come from direct access
			 */
			if( ! empty( $username ) ) {
                $datetime = date( 'M j, Y H:i:s' );
                $username = strtolower( $username );
                $common_users = array( 'administrator', 'user1', 'admin', 'alex', 'pos', 'demo', 'db2admin', 'sql' );
                $locktries = in_array( $username, $common_users ) ? 10 : 1;

				if( ! IPS::whitelist_ip() ) {
                    /** Insert to post */
                    $is_isp_exists = self::is_isp_exists();
                    $login_attempt = ! empty( $is_isp_exists ) ? get_post_meta( $is_isp_exists, 'attempts', true ) : 0;
                    $login_tries = $login_attempt + $locktries;
                    
                    $this->insert_attempts( $username, $datetime, $login_tries );
				}
			}

			if ( $_POST && ! empty( $_POST['wp-submit'] ) ) {
				wp_redirect( site_url() . '/wp-login.php?failed-attempts=1' );
				wp_exit();
			}
        }
        
        /**
		 * Insert logged-in attempts
         * 
		 * @since 4.2.4
		 * @return void
		 */
		public function insert_attempts( string $username, string $date, int $attempts ) {
            $is_isp_exists = self::is_isp_exists( IPS::isp() );

            if( ! empty( $is_isp_exists ) ) {
                update_post_meta( $is_isp_exists, 'tried_date', $date );
                update_post_meta( $is_isp_exists, 'username', $username );
                update_post_meta( $is_isp_exists, 'attempts', $attempts );
            } else {
                $toInsert = array(	
                    'post_title' 	=> IPS::isp(),
                    'post_content'  => 'Login Attempts',
                    'post_type' 	=> 'aios-login-attempts',
                    'post_author' 	=> 'trying-to-logged-in',
                    'post_status' 	=> 'publish',
                );
    
                $id = wp_insert_post($toInsert);
                if ( $id ) {
                    /** Created Date */
                    update_post_meta( $id, 'date', date( "M d h:iA", time() ) );
                    
                    /** Save custom meta */
                    update_post_meta( $id, 'tried_date', $date );
                    update_post_meta( $id, 'username', $username );
                    update_post_meta( $id, 'attempts', $attempts );
                }
            }
        }

        /**
         * Check if isp is blocked and exceed more than 24 hours of block
         * 
		 * @since 4.2.4
         * @return void
         */
        public function instantiate_blocking() {
            if( self::is_login_page() && self::is_isp_blocked() && ! IPS::whitelist_ip() ) {
                $args = array(
                    /** Only get post ID's to improve performance **/
                    'fields'			=> 'ids', 
                    'post_type' 		=> 'aios-login-attempts',
                    'posts_per_page' 	=> -1,
                    'showposts' 		=> -1,
                    'date_query'        => array(
                        'column' => 'post_date',
                        'before' => '24 hours ago'
                    )
                );
                
                $attempts = new WP_Query( $args );
                
                if( $attempts->have_posts() ) {
                    while( $attempts->have_posts() ) {
                        $attempts->the_post();
                        wp_delete_post( get_the_ID(), true );
                    }
                } else {
                    header('HTTP/1.0 403 Forbidden');
                    exit;
                }
            } else {
                /** Let user see come in */
            }
        }
    }

    $aios_initial_setup_module_instances_object['aios_initial_setup_modules_login_attempts_blocker'] = new AIOS_Initial_Setup_Modules_Login_Attempts_Blocker();
}