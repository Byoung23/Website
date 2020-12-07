<?php
/**
 * This will initialize the plugin
 *
 * @since 3.0.6
 */

use AIOS\Services\IPS;

if ( !class_exists( 'aios_initial_setup_init_admin_bar' ) ) {
	
	class aios_initial_setup_init_admin_bar{

		/**
		 * Constructor
		 *
		 * @since 3.0.6
		 *
		 * @access public
		 */
		public function __construct() {
			$this->add_actions();
		}

		/**
		 * Add Actions.
		 *
		 * @since 3.0.6
		 *
		 * @access protected
		 */
		protected function add_actions() {
			/** Enqueue required css/js files **/
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_uiux' ), 10 );
			add_action( 'wp_enqueue_scripts', array( $this, 'frontend_uiux' ), 99 );

			/** AJAX Update Option  **/

			/** Destroy cookies on login page **/
			add_action( 'login_head', array( $this, 'custom_login_page' ) );

			/**Add menu above**/
			add_action( 'admin_bar_menu', array( $this, 'server_data_local_ip' ), 997 );
			add_action( 'admin_bar_menu', array( $this, 'server_data_network_ip' ), 998 );
			add_action( 'admin_bar_menu', array( $this, 'server_data_server_ip' ), 999 );
		}

		/**
		 * Enqueue detect local ip address
		 *
		 * @since 2.8.6
		 *
		 * @access public
		 */
		public function admin_uiux() {
			wp_enqueue_script( 'aios-initial-setup-detect-local-ip-address', AIOS_INITIAL_SETUP_URL . 'includes/assets/js/detect-local-ip-address.js' );
		}

		/**
		 * Enqueue detect local ip address
		 *
		 * @since 2.8.6
		 *
		 * @access public
		 */
		public function frontend_uiux() {
			$current_username = wp_get_current_user()->user_login;
			if ( strtolower( $current_username ) === 'agentimage' ) {
				wp_enqueue_script( 'aios-initial-setup-detect-local-ip-address', AIOS_INITIAL_SETUP_URL . 'includes/assets/js/detect-local-ip-address.js' );
			}
		}

		/**
		 * Deleting a cookie
		 *
		 * @since 2.8.6
		 *
		 * @access public
		 */
		public function custom_login_page() {
			echo '<script>
				var date = new Date();
					date.setTime( date.getTime() + (-1000 * 60 * 60 * 1000) );
					expires = "; expires=" + date.toUTCString();
					document.cookie = "aioswp_6c6f63616c2d69702d61646472657373=" + false + expires + "; path=/";
			</script>';
		}


		/**
		 * Detect local ip
		 *
		 * @since 3.0.6
		 *
		 * @access public
		 */
		public function server_data_local_ip( $wp_admin_bar ) {
			$current_username = wp_get_current_user()->user_login;
			if ( strtolower( $current_username ) === 'agentimage' ) {

				$args = array(
					'id' => 'aios-server-data-local-ip',
					'title' => 'Local IP: <span></span>', 
					'href' => '', 
					'meta' => array(
						'class' => 'aios-server-data-local-ip',
					)
				);
				$wp_admin_bar->add_node( $args );

			}
		}

		/**
		 * Detect local ip
		 *
		 * @since 3.0.6
		 *
		 * @access public
		 */
		public function server_data_network_ip( $wp_admin_bar ) {
			$current_username = wp_get_current_user()->user_login;
			if ( strtolower( $current_username ) === 'agentimage' ) {
				$network_ip = explode( ',', IPS::network_ip() );

				$args = array(
					'id' => 'aios-server-data-network-ip',
					'title' => 'Network IP: ' . $network_ip[0], 
					'href' => '', 
					'meta' => array(
						'class' => 'aios-server-data-network-ip',
					)
				);

				$wp_admin_bar->add_node( $args );
			}
		}

		/**
		 * Domain to IP
		 * instead: gethostbyname() to use
		 *
		 * @since 3.0.6
		 *
		 * @access public
		 * @return string
		 */
		public function getAddrByHost($host, $timeout = 1) {
			$query = `nslookup -timeout=$timeout -retry=1 $host`;
			if(preg_match('/\nAddress: (.*)\n/', $query, $matches)) return trim($matches[1]);
		}

		/**
		 * Detect Server IP
		 *
		 * @since 3.0.6
		 *
		 * @access public
		 */
		public function server_data_server_ip( $wp_admin_bar ) {
			$current_username = wp_get_current_user()->user_login;
			if ( strtolower( $current_username ) === 'agentimage' ) {

				$blacklist = array( '::1' );

				if( !in_array( $_SERVER['REMOTE_ADDR'], $blacklist ) ){
					$current_site 	= str_replace( '/', '', preg_replace( '/https?:/', '', get_site_url() ) );
					$current_site 	= str_replace( ' ', '', $current_site );
					$host_server 	= $this->getAddrByHost( $current_site );
					$rs_servers 	= array(
						'204.232.242.216' 	=> 'RS0',
						'50.57.19.16' 		=> 'RS1',
						'166.78.232.69' 	=> 'RS2',
						'50.57.238.35' 		=> 'RS3',
						'108.171.170.125' 	=> 'RS4',
						'192.168.100.125' 	=> 'RS4',
						'108.171.170.124' 	=> 'RS VIP',
						'192.168.100.124' 	=> 'RS VIP',
						'104.25.23.20' 		=> 'Cloudflare - Main Sites',
						'104.18.37.215'		=> 'Cloudflare - Client Sites',
					);

					if ( isset( $rs_servers[$host_server] ) || !empty( $rs_servers[$host_server] ) ) {
						$server = $rs_servers[$host_server];
					} else {
						if ( strpos( $current_site, 'aios-staging.agentimage.com' ) !== false ) {
							$server = 'RS0';
						} elseif ( strpos( $current_site, 'aios1-staging.agentimage.com' ) !== false ) {
							$server = 'RS1';
						} elseif ( strpos( $current_site, 'aios2-staging.agentimage.com' ) !== false ) {
							$server = 'RS2';
						} elseif ( strpos( $current_site, 'aios3-staging.agentimage.com' ) !== false ) {
							$server = 'RS3';
						} elseif ( strpos( $current_site, 'rs4.aios-staging.com' ) !== false ) {
							$server = 'RS4';
						} elseif ( strpos( $current_site, 'vip1.aios-staging.com' ) !== false ) {
							$server = 'RS VIP';
						} else {
							$server = $current_site;
						}
					}

				} else {
					$server = 'localhost';
				}

				$args = array(
					'id' => 'aios-server-data-host-ip',
					'title' => 'Host: ' . $server, 
					'href' => '', 
					'meta' => array(
						'class' => 'aios-server-data-host-ip',
					)
				);
				$wp_admin_bar->add_node( $args );

			}
		}

    }
    
    $aios_initial_setup_init_admin_bar = new aios_initial_setup_init_admin_bar();
    
}