<?php
/**
 * This will initialize the plugin
 *
 * @since 3.2.9
 */
if ( !class_exists( 'aios_initial_setup_init_attachment_page' ) ) {
	
	class aios_initial_setup_init_attachment_page{

		/**
		 * Constructor
		 *
		 * @since 3.2.9
		 *
		 * @access public
		 */
		public function __construct() {
			$this->add_actions();
		}

		/**
		 * Add Actions.
		 *
		 * @since 3.2.9
		 *
		 * @access protected
		 */
		protected function add_actions() {
			add_filter( 'wp_unique_post_slug_is_bad_attachment_slug', '__return_true', 100 );
			add_action( 'template_redirect', array( $this, 'redirect_attachment_page' ), 2 );
		}

		/**
		 * Add Actions.
		 *
		 * @since 3.2.9
		 *
		 * @access public
		 * @return void
		 */
		public function redirect_attachment_page() {
			if ( !is_attachment() ) return false;
			
			$url = wp_get_attachment_url( get_queried_object_id() );

			if ( !empty( $url ) ) {
				$this->do_attachment_redirect( $url );
				return true;
			}

			return false;
		}

		/**
		 * Performs the redirect from the attachment page to the image file itself.
		 *
		 * @since 3.2.9
		 *
		 * @param string $attachment_url The attachment image url.
		 *
		 * @return void
		 */
		public function do_attachment_redirect( $attachment_url ) {
			header( 'X-Redirect-By: AgentImage' );
			wp_redirect( $attachment_url, 301 );
			exit;
		}


    }
    
    $aios_initial_setup_init_attachment_page = new aios_initial_setup_init_attachment_page();
    
}