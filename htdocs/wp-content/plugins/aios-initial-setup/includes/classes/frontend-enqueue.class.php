<?php
/**
 * This will generate default pages
 *
 * @since 2.8.6
 */
if ( !class_exists( 'aios_initial_setup_frontend_enqueue' ) ) {

	class aios_initial_setup_frontend_enqueue{

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
		 * @since 2.8.6
		 *
		 * @access protected
		 */
		protected function add_actions() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_cdn_libraries' ) );
		}

		/**
		 * Enqueue CDN libraries.
		 *
		 * @since 2.8.6
		 *
		 * @access public
		 */
		public function enqueue_cdn_libraries() {
			$font = 'https://fonts.googleapis.com';
			$cdn = 'https://resources.agentimage.com';

			$enqueue_cdn  					= get_option( 'aios-enqueue-cdn' );
			$bootstrap_no_components_css	= isset( $enqueue_cdn['bootstrap_no_components_css'] ) ? $enqueue_cdn['bootstrap_no_components_css'] : '';
			$utilities 						= isset( $enqueue_cdn['utilities'] ) ? 			$enqueue_cdn['utilities'] : '';
			$animate 						= isset( $enqueue_cdn['animate'] ) ? 			$enqueue_cdn['animate'] : '';
			$autosize 						= isset( $enqueue_cdn['autosize'] ) ? 			$enqueue_cdn['autosize'] : '';
			$chainHeight 					= isset( $enqueue_cdn['chainHight'] ) ? 		$enqueue_cdn['chainHight'] : '';
			$elementpeek 					= isset( $enqueue_cdn['elementpeek'] ) ? 		$enqueue_cdn['elementpeek'] : '';
			$splitNav 						= isset( $enqueue_cdn['splitNav'] ) ? 			$enqueue_cdn['splitNav'] : '';
			$slick 							= isset( $enqueue_cdn['slick'] ) ? 				$enqueue_cdn['slick'] : '';
			$simplebar 						= isset( $enqueue_cdn['simplebar'] ) ? 			$enqueue_cdn['simplebar'] : '';
			$sidebar_navigation 			= isset( $enqueue_cdn['sidebar_navigation'] ) ? $enqueue_cdn['sidebar_navigation'] : '';
			$videoPlyr 						= isset( $enqueue_cdn['videoPlyr'] ) ? 			$enqueue_cdn['videoPlyr'] : '';
			$libraries 						= isset( $enqueue_cdn['use_local_libraries'] ) ? AIOS_INITIAL_SETUP_URL . 'includes/assets/libraries' : 'https://resources.agentimage.com/libraries';

			/** Start: Quick Search Variables **/
			$quick_search 		= get_option( 'aios-quick-search' );
			$enabled 			= isset( $quick_search['enabled'] ) ? 				$quick_search['enabled'] : '';
			$disabled_bootstrap = isset( $quick_search['disabled_bootstrap'] ) ? 	$quick_search['disabled_bootstrap'] : '';
			/** End: Quick Search Variables **/

			wp_register_style( 'aios-initial-setup-google-font', $font . '/css?family=Open+Sans:300,400,600,700,800' );
			wp_register_style( 'agentimage-font', $cdn . '/fonts/agentimage.font.icons.css' );
			if( $bootstrap_no_components_css == 1 ) { 
				wp_register_style( 'aios-starter-theme-bootstrap', $cdn . '/bootstrap/bootstrap.noicons.min.css' );
			} else { 
				wp_register_style( 'aios-starter-theme-bootstrap', $cdn . '/bootstrap/bootstrap.min.css' ); 
			}
			wp_register_style( 'aios-starter-theme-popup-style', $libraries . '/css/aios-popup.css' );
			wp_register_style( 'aios-video-plyr', $libraries . '/css/plyr.css' );
			wp_register_style( 'aios-initial-setup-frontend-style', AIOS_INITIAL_SETUP_URL . 'includes/assets/css/aios-initial-setup-frontend.css' );
			
			/* Enqueue jQuery wp_enqueue array('jquery') - first make sure that jquery file is include in the header */
			wp_enqueue_script( 	'jquery');
			wp_register_script( 'aios-starter-theme-bowser', $libraries . '/js/bowser-scripts.js', array( 'jquery' ) );
			wp_register_script( 'aios-starter-theme-crossbrowserselector', $libraries . '/js/css-browser-selector.js', array( 'jquery' ) );
			wp_register_script( 'aios-starter-theme-placeholders', $libraries . '/js/placeholders.min.js', array( 'jquery' ) );
			wp_register_script( 'aios-video-plyr', $libraries . '/js/plyr.js' );
			wp_register_script( 'aios-starter-theme-mobile-iframe-fix', $libraries . '/js/mobile-iframe-fix.js', array( 'jquery' ) );
			wp_register_script( 'aios-starter-theme-html5', $libraries . '/js/html5.js', array( 'jquery' ) );
			wp_register_script( 'aios-starter-theme-bootstrap-js', $cdn . '/bootstrap/bootstrap.min.js', array( 'jquery' ) );
			wp_register_script( 'aios-nav-double-tap', $libraries . '/js/jquery.nav-tab-double-tap.min.js', array( 'jquery' ) );
			wp_register_script( 'aios-starter-theme-popup', $libraries . '/js/aios-popup.min.js', array( 'jquery' ) );
            wp_register_script( 'aios-initial-setup-frontend-scripts', $libraries . '/js/aios-initial-setup-frontend.min.js', array(), null, true );
            // wp_register_script( 'aios-initial-setup-frontend-scripts', AIOS_INITIAL_SETUP_URL . 'includes/assets/js/aios-initial-setup-frontend.min.js', array(), null, true );
			
			/** Required Assets: Enqueue Agentimage Font **/
			wp_enqueue_style( 'agentimage-font' ); /** Agentimage Fonts */
			wp_enqueue_style( 'aios-initial-setup-google-font' ); /** Google Fonts */
			
			wp_enqueue_style( 'aios-starter-theme-bootstrap' ); /** Required Assets: CSS Bootstrap */
			
			/** Required Assets: Javascripts */
			wp_enqueue_script( 'aios-starter-theme-bowser' ); /** Cross browser selector */
			wp_enqueue_script( 'aios-starter-theme-crossbrowserselector' ); /** browser selector */
			
			wp_enqueue_script('aios-starter-theme-placeholders');
			if ( function_exists('wp_script_add_data') ) wp_script_add_data('aios-starter-theme-placeholders', 'conditional', 'lt IE 9'); /** Placeholder for IE9 */
			
			wp_enqueue_script('aios-starter-theme-html5');
			if ( function_exists('wp_script_add_data') ) wp_script_add_data('aios-starter-theme-html5', 'conditional', 'lt IE 9'); /** HTML5 Shiv for IE9 */

			if ( $disabled_bootstrap != 1 ) wp_enqueue_script('aios-starter-theme-bootstrap-js'); /** Bootsrap JS */

			wp_enqueue_script( 'aios-nav-double-tap' ); /** Enqueue Doubletap  */
			wp_enqueue_script( 'aios-starter-theme-popup' ); /** Enqueue Magnific PopUp Plugin */

			/** Enqueue conditional assets */
			wp_register_style( 'aios-utilities-style', $libraries . '/css/aios-utilities.min.css' );
			wp_register_style( 'aios-animate-style', $libraries . '/css/style.animate.min.css' );
			wp_register_style( 'aios-slick-style', $libraries . '/css/slick.min.css' );
			wp_register_style( 'aios-simplebar-style', $libraries . '/css/simplebar.min.css');
			wp_register_style( 'aios-bootstrap-select', $libraries . '/css/aios-bootstrap-select.min.css' );
	
			wp_register_script( 'aios-autosize-script', $libraries . '/js/autosize.min.js', array( 'jquery' ) );
			wp_register_script( 'aios-chain-height-script', $libraries . '/js/jquery.chain-height.min.js', array( 'jquery' ) );
			wp_register_script( 'aios-elementpeek-script', $libraries . '/js/jquery.elementpeek.min.js', array( 'jquery' ) );
			wp_register_script( 'aios-splitNav-script', $libraries . '/js/aios-split-nav.min.js', array( 'jquery' ) );
			wp_register_script( 'aios-slick-script', $libraries . '/js/slick.min.js', array( 'jquery' ) );
			wp_register_script( 'aios-simplebar-script', $libraries . '/js/simplebar.min.js', array( 'jquery' ) );
			wp_register_script( 'aios-sidebar-navigation-script', $libraries . '/js/jquery.sidenavigation.min.js', array( 'jquery' ) );
			wp_register_script( 'aios-bootstrap-select', $libraries . '/js/aios-bootstrap-select.min.js', array( 'jquery' ) );
			wp_register_script( 'aios-quick-search-js', $libraries . '/js/aios-quick-search.min.js', array( 'jquery' ), null, true );
			// wp_register_script( 'aios-quick-search-js', AIOS_INITIAL_SETUP_URL . '/includes/assets/js/aios-quick-search.js', array( 'jquery' ), null, true );

			if ( is_singular() && get_option( 'thread_comments' ) ) 
				wp_enqueue_script( 'comment-reply' );
				
			if ( $utilities == 1 ) 
				wp_enqueue_style('aios-utilities-style');

			if ( $animate == 1 ) 
				wp_enqueue_style('aios-animate-style');

			if ( $autosize == 1 ) 
				wp_enqueue_script('aios-autosize-script');

			if ( $chainHeight == 1 ) 
				wp_enqueue_script('aios-chain-height-script');

			if ( $elementpeek == 1 ) 
				wp_enqueue_script('aios-elementpeek-script');

			if ( $sidebar_navigation == 1 ) 
				wp_enqueue_script('aios-sidebar-navigation-script');

			if ( $slick == 1 ) {
				wp_enqueue_style('aios-slick-style');
				wp_enqueue_script('aios-slick-script');
			}

			if ( $simplebar == 1 ) {
				wp_enqueue_style('aios-simplebar-style');
				wp_enqueue_script('aios-simplebar-script');
			}

			if ( $splitNav == 1 ) 
				wp_enqueue_script('aios-splitNav-script');

			if ( $videoPlyr == 1 ) {
				wp_enqueue_style( 'aios-video-plyr' );
				wp_enqueue_script( 'aios-video-plyr' );
			}

			/** Start: Quick Search **/
			if ( !empty( $enabled ) ) {
				wp_enqueue_style( 'aios-bootstrap-select' );
				wp_enqueue_script( 'aios-bootstrap-select' );
				wp_enqueue_script( 'aios-quick-search-js' );
				wp_localize_script( 'aios-quick-search-js', 'aios_qs_ajax', get_site_url() . '/31jislt2xAmlqApY8aDhWbCzmonLuOZp' );
			}
			/** End: Quick Search **/

			wp_enqueue_style( 'aios-starter-theme-popup-style' ); /** Required Assets: CSS Popup Style */

			/** Enqueue initial setups assets */
			wp_enqueue_script( 'aios-initial-setup-frontend-scripts' );
			wp_enqueue_style( 'aios-initial-setup-frontend-style' );

		}

	}
	
    $aios_initial_setup_frontend_enqueue = new aios_initial_setup_frontend_enqueue();
    
}