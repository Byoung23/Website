<?php
/**
 * Minify AIOS Scripts
 *
 * @since 3.9.1
 */
/** Load require files */
require_once( 'vendor/autoload.php' );
use MatthiasMullie\Minify;

if ( !class_exists( 'aios_initial_setup_minify' ) ) {
	class aios_initial_setup_minify {

        /**
		 * minify folder and url
		 *
		 * @access private
		 */
		private $aiosmin_dir;
		private $aiosmin_url;

        /**
		 * Array of styles/scripts to be minify
		 *
		 * @access private
		 */
		private $minifyCSS;
		private $minifyJS;

		/**
		 * Constructor
		 *
		 * @since 3.9.1
		 *
		 * @access public
		 */
		public function __construct() {
		    $this->aiosmin_dir = WP_CONTENT_DIR . '/aiosmin';
		    $this->aiosmin_url = WP_CONTENT_URL . '/aiosmin';
            $this->minifyCSS = array(
                'agentimage-font',
                'aios-starter-theme-bootstrap',
                'aios-utilities-style',
                'aios-animate-style',
                'aios-slick-style',
                'aios-simplebar-style',
                'aios-bootstrap-select',
                'aios-video-plyr',
                'aios-starter-theme-popup-style',
                'aios-initial-setup-frontend-style',
                'roadmaps_style',
                'roadmaps_style_old',
                'aios-initial-setup-ihf-location-field-bleeding',
                'aios-initial-setup-ihf-fixes',
                'aios-initial-setup-ihf-sort-menu-content-overlap',
                'aios-initial-setup-ihf-wrap-search-options-link',
                'aios-starter-theme-style',
            );
            $this->minifyJS = array(
                'aios-starter-theme-bowser',
                'aios-starter-theme-crossbrowserselector',
                'aios-starter-theme-placeholders',
                'aios-starter-theme-html5',
                'aios-starter-theme-bootstrap-js',
                'aios-starter-theme-mobile-iframe-fix',
                'aios-bootstrap-select',
                'aios-slick-script',
                'aios-initial-setup-frontend-scripts',
                'aios-initial-setup-cf7-fix-date-field',
                'aios_initial_setup_dead_link_disabler',
                'aios-initial-setup-idxb-titles',
                'aios-nav-double-tap',
                'aios-starter-theme-popup',
                'aios-mobile-header-widget-navigation',
                'aios-mobile-header-main',
                'aios-autosize-script',
                'aios-chain-height-script',
                'aios-elementpeek-script',
                'aios-splitNav-script',
                'aios-simplebar-script',
                'aios-video-plyr',
                'aios-sidebar-navigation-script',
                // 'aios-quick-search-js',don't include this wp_localize from different functions
                'aios-starter-theme-global',
            );
			$this->add_actions();
		}

		/**
		 * Add Actions.
		 *
		 * @since 3.9.1
		 *
		 * @access protected
		 */
		protected function add_actions() {
            $enqueue_cdn = get_option( 'aios-enqueue-cdn' );
            $aios_minified_resources = isset( $enqueue_cdn['aios_minified_resources'] ) ? $enqueue_cdn['aios_minified_resources'] : '';
            if( $aios_minified_resources == 1 ) {
                if( get_transient( 'aiosmin' ) == 'minified' && file_exists( $this->aiosmin_dir ) ) {
                    add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_libraries' ), 10 );
                    add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_libraries' ), 1000 );
                } else {
                    add_action( 'wp_head', array( $this, 'minify_assets' ), 10 );
                }
            }
        }

		/**
		 * Enqueue CDN libraries.
		 *
		 * @since 3.9.1
		 *
		 * @access public
         * @param $aiosmin - fullpath directory wp-content/aiosmin/
         * @return void
		 */
		public function enqueue_libraries() {
            wp_enqueue_style(  'aios-bundle', $this->aiosmin_url . '/aios-bundle.css' );
            wp_enqueue_script( 'aios-header-bundle', $this->aiosmin_url . '/aios-header-bundle.js', array( 'jquery' ) );
            wp_enqueue_script( 'aios-footer-bundle', $this->aiosmin_url . '/aios-footer-bundle.js', array( 'jquery' ), null, true );
        }

		/**
		 * Dequeue list of styles that will be minify
		 *
		 * @since 3.9.1
		 *
		 * @access public
         * @param $aiosmin - fullpath directory wp-content/aiosmin/
         * @return void
		 */
		public function dequeue_libraries() {
            foreach ($this->minifyCSS as $file) wp_dequeue_style( $file );
            foreach ($this->minifyJS as $file) wp_dequeue_script( $file );
        }
        
        /**
         * Minify Assets
         *
         * @since 3.9.1
         * @access public
         * @param $aiosmin - fullpath directory wp-content/aiosmin/
         * @return array
         */
        public function minify_assets() {
            if( is_user_logged_in() ) return;
            $context = stream_context_create( array( "http" => array( "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36" ) ) );
            
            /** 
             * Check if folder and file exists then
             * create folder and files
             * use for minify assets 
             */
            if( !file_exists( $this->aiosmin_dir ) ) wp_mkdir_p( $this->aiosmin_dir );
            if( !file_exists( $this->aiosmin_dir . '/aios-bundle.css' ) ) fopen( $this->aiosmin_dir . '/aios-bundle.css', 'w' );
            if( !file_exists( $this->aiosmin_dir . '/aios-header-bundle.js' ) ) fopen( $this->aiosmin_dir . '/aios-header-bundle.js', 'w' );
            if( !file_exists( $this->aiosmin_dir . '/aios-footer-bundle.js' ) ) fopen( $this->aiosmin_dir . '/aios-footer-bundle.js', 'w' );

            /** Minify CSS */
            $styles             = wp_styles();
            $styles_registered  = $styles->registered;
            $styles_queue       = $styles->queue;
            $minifierCSS        = new Minify\CSS();
            $minifiedCSSPath    = $this->aiosmin_dir . '/aios-bundle.css';

            /**
             * Support for old starter theme
             * Force to change when compiled
             */
            $enqueue_cdn = get_option( 'aios-enqueue-cdn' );	
            if( isset( $enqueue_cdn['bootstrap_no_components_css'] ) ) {
                $styles_registered['aios-starter-theme-bootstrap']->src = 'https://resources.agentimage.com/bootstrap/bootstrap.noicons.min.css';
            } else {
                $styles_registered['aios-starter-theme-bootstrap']->src = 'https://resources.agentimage.com/bootstrap/bootstrap.min.css';
            }

            foreach ($this->minifyCSS as $file ) {
                if( in_array( $file, $styles_queue ) ) {
                    $src = $styles_registered[$file]->src;
                    if( !empty( $src ) ) {
                        $content = file_get_contents( $src, false, $context );
                        $minifierCSS->add( $content );
                    }
                }
            }
            $minifierCSS->minify($minifiedCSSPath);
            // $minifierCSS->gzip($minifiedCSSPath);

            /** Minify Javascript */
            $scripts                = wp_scripts();
            $scripts_registered     = $scripts->registered;
            $scripts_queue          = $scripts->queue;
            $scripts_in_footer      = $scripts->in_footer;
            $minifierJSHeader       = new Minify\JS();
            $minifiedJSHeaderPath   = $this->aiosmin_dir . '/aios-header-bundle.js';
            $minifierJSFooter       = new Minify\JS();
            $minifiedJSFooterPath   = $this->aiosmin_dir . '/aios-footer-bundle.js';

            /** Header */
            foreach ($this->minifyJS as $file ) {
                if( in_array( $file, $scripts_queue ) ) {
                    $src = $scripts_registered[$file]->src;
                    if( !empty( $src ) ) {
                        $content = file_get_contents( $src, false, $context );
                        if( in_array( $file, $scripts_in_footer ) ) {
                            $minifierJSFooter->add( $content );
                        } else {
                            $minifierJSHeader->add( $content );
                        }
                    }
                }
            }
            
            $minifierJSHeader->minify($minifiedJSHeaderPath);
            // $minifierJSHeader->gzip($minifiedJSHeaderPath);
            $minifierJSFooter->minify($minifiedJSFooterPath);
            // $minifierJSFooter->gzip($minifiedJSFooterPath);

            /** set transient this transient will let the minifier know if it needs to minify a new batch */
            /**
             * MINUTE_IN_SECONDS  = 60 (seconds)
             * HOUR_IN_SECONDS    = 60 * MINUTE_IN_SECONDS
             * DAY_IN_SECONDS     = 24 * HOUR_IN_SECONDS
             * WEEK_IN_SECONDS    = 7 * DAY_IN_SECONDS
             * MONTH_IN_SECONDS   = 30 * DAY_IN_SECONDS
             * YEAR_IN_SECONDS    = 365 * DAY_IN_SECONDS
             * set_transient( 'special_query_results', $special_query_results, 12 * HOUR_IN_SECONDS );
             */
            
            $enqueue_cdn = get_option( 'aios-enqueue-cdn' );
            $expiration = isset( $enqueue_cdn['expiration'] ) ?	$enqueue_cdn['expiration'] : 0;
            $expiration = $expiration == 999 ? 0 : $expiration;
            set_transient( 'aiosmin', 'minified', $expiration ); /** $expiration * 24 * 60 * 60 - days/hours/minutes/seconds */
        }

    }

    $aios_initial_setup_minify = new aios_initial_setup_minify();
}