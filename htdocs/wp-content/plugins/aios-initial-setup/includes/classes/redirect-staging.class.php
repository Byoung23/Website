<?php
/**
 * This will redirect all aios-staging to live.
 *
 * @since 3.1.9
 */
if ( !class_exists( 'aios_initial_setup_init_redirect_staging' ) ) {
	
	class aios_initial_setup_init_redirect_staging{

		/**
		 * Constructor
		 *
		 * @since 3.1.9
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {
			$this->add_actions();
		}

		/**
		 * Add Actions
		 *
		 * @since 3.1.9
		 *
		 * @access public
		 * @return void
		 */
		public function add_actions() {
			$site_url = get_site_url();
			/** Check if blog url doesn't have "aios-staging.com" **/
			if ( strpos( $site_url, 'aios-staging.com') === false ) {
				add_action( 'init', array( $this, 'redirect_staging' ) );
			}
		}

		/**
		 * This will trigger if blogurl doesn't have "aios-staging.com"
		 *
		 * @since 3.1.9
		 *
		 * @access public
		 * @return void
		 */
		public function redirect_staging() {
			/** Check if Request URL have "aios-staging.com" **/
			$requested_url = ( isset( $_SERVER['HTTPS'] ) ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'];
			if ( strpos( $requested_url, 'aios-staging.com') !== false ) {
				$site_url = get_bloginfo( 'home' );
				$redirect_to = str_replace( $requested_url, $site_url,  $requested_url ) . $_SERVER['REQUEST_URI'];
				$agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

				$ch = curl_init($redirect_to);
				curl_setopt($ch, CURLOPT_NOBODY, 1);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
				curl_setopt($ch, CURLOPT_USERAGENT, $agent);
				curl_exec($ch);
				$target_header = curl_getinfo($ch);
				curl_close($ch);

				/** Check if site is not 404 page **/
				if ( $target_header['http_code'] >= 200 && $target_header['http_code'] < 300 ) {
					wp_redirect( $target_header['url'] , 301);
					exit;
				} else {
					wp_redirect( $site_url, 301 );
					exit;
				}
			}
		}
	}

	// $aios_initial_setup_init_redirect_staging = new aios_initial_setup_init_redirect_staging();
}