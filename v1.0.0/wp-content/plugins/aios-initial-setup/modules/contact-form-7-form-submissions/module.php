<?php
/**
 * Store success submitted messages
 */
if ( !class_exists( 'AIOS_Initial_Setup_Contact_Form_7_Store_Messages' ) ) {
    
    class AIOS_Initial_Setup_Contact_Form_7_Store_Messages {

        /**
         * Run class
         * 
         * @return void
         */
        public function __construct() {
			add_action( 'admin_menu', array( $this, 'render_sub_pages' ), 11 );
            add_action( 'wpcf7_mail_sent', array( $this, 'wpcf7_insert_post' ) );
            add_action( 'admin_init', array( $this, 'migrate_to_post_type' ) );
            add_action( 'admin_init', array( $this, 'delete_cf7_leads' ) );
        }
        
        /**
		 * Add sub menu page
		 *
		 * @since 3.8.0
		 *
		 * @access public
		 */
		public function render_sub_pages() {
			add_menu_page( 
				'Contact Form 7 Leads - AgentImage Plugin', 
				'AIOS CF7 Leads', 
				'manage_options', 
				'aios-cf7-store-messages', 
				array( $this, 'render_backend' ),
				'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgNDM0LjE2OCA0MzQuMTY4IiBzdHlsZT0iZmlsbDojODI4NzhjIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KCTxwYXRoIGQ9Ik0zMzIuMzE4LDIzMC4xOTZWMzQuOTY3SDQwLjkzdjM2NC4yMzVoMTM0LjAzOGM5LjYxNiwwLDE3LjQ4Myw3Ljg2NywxNy40ODMsMTcuNDgzcy03Ljg2NywxNy40ODMtMTcuNDgzLDE3LjQ4M0gyMy40NDYNCgkJYy05LjYxNiwwLTE3LjQ4My03Ljg2Ny0xNy40ODMtMTcuNDgzVjE3LjQ4M0M1Ljk2Myw3Ljg2NywxMy44MzEsMCwyMy40NDYsMGgzMjYuMzU0YzkuNjE2LDAsMTcuNDgzLDcuODY3LDE3LjQ4MywxNy40ODN2MjEyLjcxMw0KCQljMCw5LjYxNi03Ljg2NywxNy40ODMtMTcuNDgzLDE3LjQ4M1MzMzIuMzE4LDIzOS44MTIsMzMyLjMxOCwyMzAuMTk2eiBNNDIyLjM1NywyNzIuNzM5Yy03LjI4NS02LjQxMS0xOC4zNTctNS44MjgtMjQuNzY4LDEuNDU3DQoJCWwtOTUuODY3LDEwNi42NDhsLTQ4LjA3OS00Ni4zMzFjLTYuOTkzLTYuNzAyLTE4LjA2Ni02LjQxMS0yNC43NjgsMC41ODNzLTYuNDExLDE4LjA2NiwwLjU4MywyNC43NjhsNjEuMTkxLDU4Ljg2DQoJCWMzLjIwNSwzLjIwNSw3LjU3Niw0Ljk1NCwxMi4yMzgsNC45NTRjMC4yOTEsMCwwLjI5MSwwLDAuNTgzLDBjNC42NjItMC4yOTEsOS4zMjQtMi4zMzEsMTIuMjM4LTUuODI4bDEwNy44MTQtMTIwLjA1Mg0KCQlDNDMwLjIyNCwyOTAuMjIyLDQyOS42NDEsMjc5LjE1LDQyMi4zNTcsMjcyLjczOXogTTI2OC4yMTIsMTAxLjk4NkgxMTAuODYzYy05LjYxNiwwLTE3LjQ4Myw3Ljg2Ny0xNy40ODMsMTcuNDgzDQoJCXM3Ljg2NywxNy40ODMsMTcuNDgzLDE3LjQ4M2gxNTcuMzQ5YzkuNjE2LDAsMTcuNDgzLTcuODY3LDE3LjQ4My0xNy40ODNTMjc3LjgyOCwxMDEuOTg2LDI2OC4yMTIsMTAxLjk4NnogTTI4NS42OTYsMjE1LjYyNw0KCQljMC05LjYxNi03Ljg2Ny0xNy40ODMtMTcuNDgzLTE3LjQ4M0gxMTAuODYzYy05LjYxNiwwLTE3LjQ4Myw3Ljg2Ny0xNy40ODMsMTcuNDgzYzAsOS42MTYsNy44NjcsMTcuNDgzLDE3LjQ4MywxNy40ODNoMTU3LjM0OQ0KCQlDMjc3LjgyOCwyMzMuMTEsMjg1LjY5NiwyMjUuMjQzLDI4NS42OTYsMjE1LjYyN3ogTTExMC44NjMsMjkxLjM4OGMtOS42MTYsMC0xNy40ODMsNy44NjctMTcuNDgzLDE3LjQ4Mw0KCQljMCw5LjYxNiw3Ljg2NywxNy40ODMsMTcuNDgzLDE3LjQ4M2g0Ni42MjJjOS42MTYsMCwxNy40ODMtNy44NjcsMTcuNDgzLTE3LjQ4M2MwLTkuNjE2LTcuODY3LTE3LjQ4My0xNy40ODMtMTcuNDgzSDExMC44NjN6Ii8+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==',
				93
			);
		}
		
		/**
		 * Fallback: Render sub menu page
		 *
		 * @since 3.8.0
		 *
		 * @access public
		 */
		public function render_backend() {
			require( 'render.php' );
        }

        /**
         * Insert post to custom post type
         * 
         * @param $wpcf7(string) - Contact Form Details
         * @param $submission(string) - Submitted data[posted_data]
         * 
		 * @since 3.8.0
         * 
         * @return void
         */
        public function wpcf7_insert_post( $WPCF7_ContactForm ){
            $title          = trim( preg_replace( '/\s*\([^)]*\)/', '', $WPCF7_ContactForm->title ) );
			$category       = preg_replace( "![^a-z0-9]+!i", "-", $title );
			$wpcf7 			= WPCF7_ContactForm :: get_current();
			$submission     = WPCF7_Submission::get_instance();

            if ( $submission ) {
				$data       = $submission->get_posted_data();
				$dataSkip 	= array( '_wpcf7', '_wpcf7_version', '_wpcf7_locale', '_wpcf7_unit_tag', '_wpcf7_container_post', 'zerospam_key' );
				$inputSingle = array( 'text', 'emai', 'textarea' );
                $firstName  = $data['your-first-name'] . $data['your-fname'] . $data['fname'] . $data['firstName'] . $data['first-name'] . $data['TxtFirstName'] . $data['f-name'];
                $middleName = $data['your-middle-name'] . $data['your-mname'] . $data['mname'] . $data['middleName'] . $data['middle-name'] . $data['TxtMiddleName'] . $data['m-name'];
				$lastName   = $data['your-last-name'] . $data['your-lname'] . $data['lname'] . $data['lastName'] . $data['last-name'] . $data['TxtLastName'] . $data['l-name'];
				$fullName 	= $data['your-name'] . $data['your-fullname'] . $data['fullname'] . $data['full_name'] . $data['TxtFullName'];
                $name       = !empty( $fullName ) ? $fullName : $firstName . ' ' . trim( $middleName . ' ' . $lastName );
                $email      = $data['your-email'] . $data['email'] . $data['email-address'] . $data['TxtEmailAddress'];
				$formTag 	= $this->accessProtected( $wpcf7, 'scanned_form_tags' ); /** List of input used */
				$meta 		= $this->accessProtected( $submission, 'meta' ); /** List of page url, time, and ip of user */
				$page_source = str_replace( get_site_url(), '', $meta['url'] );
				$date_created = date("m/d/Y h:i:s A", $meta['timestamp']);
				$body       = '<span class="full-logs-details-title mt-0">Form Details</span>';
				
				foreach ( $data as $k => $v) {
					if ( ! in_array( $k, $dataSkip ) && ! empty( $v ) ) {
						foreach ( $formTag as $kf ) {
							if ( $kf->name == $k ) {
								if ( in_array( $kf->baseType, $inputSingle ) ) {
									$labels = ( !empty( $kf->labels ) ? $kf->labels : ucwords( preg_replace( "![^a-z0-9]+!i", " ", $kf->name ) ) );
								} else {
									$labels = ucwords( preg_replace( "![^a-z0-9]+!i", " ", $kf->name ) );
								}
								$body .= '<strong>' . $labels . ':</strong> ' . ( is_array( $v ) ? join( ', ', $v ) : $v ) . '<br>';
							}
						}
					}
				}
				
				$body .= '<span class="full-logs-details-title">Other Info</span>
					<strong>Browser:</strong> ' . $meta['user_agent'] . '<br>
					<strong>Remote IP:</strong> ' . $meta['remote_ip'] . '<br>
					<strong>Page Source:</strong> ' . $page_source . '<br>
                    <strong>Date:</strong> ' . $date_created;

                /**
                 * Insert to Database Table
                 */
                global $wpdb;
                $wpdb->insert( $wpdb->prefix . AIOS_LEADS_NAME, [
                    'title'         => $title,
                    'category'      => $category,
                    'client_name'   => $name,
                    'client_email'  => $email,
                    'client_body'   => $body,
                    'remote_ip'     => $meta['remote_ip'],
                    'page_source'   => $page_source,
                    'date'          => $date_created,
                    'created_at'    => date("Y-m-d H:i:s")
                ] );
            }    
		}
		
		/**
         * Access protected property
         * 
         * @param $obj(array) - Object Array
         * @param $prop(string) - Property you want to access
         * 
		 * @since 3.8.0
         * 
         * @return void
         */
        public function accessProtected( $obj, $prop ) {
			$reflection = new ReflectionClass( $obj );
			$property = $reflection->getProperty( $prop );
			$property->setAccessible( true );
			return $property->getValue( $obj );
        }
        
        /**
         * Copy register post type to custom table
         * 
         * @since 4.4.1
         * 
         * @return void
         */
        public function migrate_to_post_type() {
            add_option( AIOS_LEADS_NAME . '_migrated', 'no' );
            $is_migrated = get_option( AIOS_LEADS_NAME . '_migrated' );
            if( $is_migrated != 'yes' ) {
                $store_messages = new WP_Query( array(
                    'post_type' 		=> 'aios-cf7-forms', 
                    'posts_per_page' 	=> -1, 
                    'orderby' 			=> 'date', 
                    'order' 			=> 'DESC'
                ) );
    
                if ( $store_messages->have_posts() ) {
                    while ( $store_messages->have_posts() ) {
                        $store_messages->the_post();
                        
                        global $wpdb;
                        $wpdb->insert( $wpdb->prefix . AIOS_LEADS_NAME, [
                            'title'         => get_the_title(),
                            'category'      => get_post_meta( get_the_ID(), 'category', true ),
                            'client_name'   => get_post_meta( get_the_ID(), 'client-name', true ),
                            'client_email'  => get_post_meta( get_the_ID(), 'client-email', true ),
                            'client_body'   => get_post_meta( get_the_ID(), 'client-body', true ),
                            'remote_ip'     => get_post_meta( get_the_ID(), 'remote-ip', true ),
                            'page_source'   => get_post_meta( get_the_ID(), 'page-source', true ),
                            'date'          => get_post_meta( get_the_ID(), 'date', true ),
                            'created_at'    => date("Y-m-d H:i:s")
                        ] );
                    }

                    update_option( AIOS_LEADS_NAME . '_migrated', 'yes' );
                    header("Refresh:0");
                } 

            }
        }

		/**
		 * Delete logs beyond 30 Days
		 *
		 * @param string $directory_name
		 * @access public
		 * @return void
		 */
		public function delete_cf7_leads() {
			$username = strtolower(wp_get_current_user()->user_login);
            if ( $username !== 'agentimage' ) return;

            $is_migrated = get_option( AIOS_LEADS_NAME . '_migrated' );
            if( $is_migrated != 'yes' ) return;
            
            /**
             * Delete old logs
             */
			$args = array(
				/** Only get post ID's to improve performance **/
				'fields'			=> 'ids', 
				'post_type' 		=> 'aios-cf7-forms',
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

    }

    $aios_initial_setup_module_instances_object['aios_initial_setup_contact_form_7_store_messages_module'] = new AIOS_Initial_Setup_Contact_Form_7_Store_Messages();

}