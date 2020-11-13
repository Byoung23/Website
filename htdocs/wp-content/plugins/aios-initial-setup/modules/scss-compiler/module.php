<?php
/**
 * Name: SCSS Compiler
 * Description: Auto compile scss from active themes, error will occur when not setup properly. 
 * @since Version 4.1.4
 */
require_once( 'action.class.php' );
require_once( 'development-mode.class.php' );
use AIOS\Services\ArrayHelper;

if( ! class_exists( 'AIOS_Initial_Setup_SCSS_Compiler' ) ) {

    class AIOS_Initial_Setup_SCSS_Compiler {

        /**
         * Save options to settings as array
         */
        private $settings, $log_file;

        /**
         * Instatiate Class
         * @since v4.1.4
         * @return void
         */
        public function __construct() {
            /**
             * Get settings of compiler
             */
            $scss_compiler = get_option( 'scss_compiler', array() );
            $scss_compiler = ArrayHelper::stripslashes_deep( $scss_compiler );
            extract($scss_compiler);

            $this->settings['scss_location']            = ( isset( $scss_compiler['scss_location'] ) ? $scss_compiler['scss_location'] : 'scss' );
            $this->settings['scss_dir']                 = str_replace( '\\', '/', get_stylesheet_directory() . '\\' . $this->settings['scss_location'] . '\\' );
            $this->settings['css_location']             = ( isset( $scss_compiler['css_location'] ) ? $scss_compiler['css_location'] : 'css' );
            $this->settings['css_dir']                  = str_replace( '\\', '/', get_stylesheet_directory() . '\\' . $this->settings['css_location'] . '\\' );
            $this->settings['compiling_mode']           = ( isset( $scss_compiler['compiling_mode'] ) ? $scss_compiler['compiling_mode'] : 'Leafo\ScssPhp\Formatter\Compressed' );
            $this->settings['source_map_mode']          = ( isset( $scss_compiler['source_map_mode'] ) ? $scss_compiler['source_map_mode'] : 'SOURCE_MAP_NONE' );
            $this->settings['error_display']            = ( isset( $scss_compiler['error_display'] ) ? $scss_compiler['error_display'] : 'show' );
            $this->settings['disabled_auto_enqueue']    = ( isset( $scss_compiler['disabled_auto_enqueue'] ) ? $scss_compiler['disabled_auto_enqueue'] : 'no' );
            
            /**
             * Check if folder exists
             * Trigger to compile
             */
            if( is_dir( $this->settings['scss_dir'] ) || is_dir( $this->settings['css_dir'] ) ) {
                $this->compiler = new AIOS_Compile_SCSS(
                    $this->settings['scss_dir'],
                    $this->settings['css_dir'],
                    $this->settings['compiling_mode'],
                    $this->settings['source_map_mode'],
                    $this->settings['error_display'],
                    $this->settings['disabled_auto_enqueue']
                );
            }

            /**
             * Create log file
             */
            $this->log_file = $this->settings['scss_dir'] . '/error_log.log';

            /**
             * Instatiate actions
             */
            $this->add_actions();
        }

        /**
         * Run WordPress Actions
         */
        private function add_actions() {
            add_action( 'admin_notices', array( $this, 'is_dir_exists' ) );
            add_action( 'wp_head', array( $this, 'recompile_scss' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'compiled_scss_enqueue_styles' ), 12 );
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets_logged_in_users' ), 100 );
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets_logged_in_users' ), 100 );
			add_action( 'admin_bar_menu', array( $this, 'development_mode_bar_menu' ), 1001 );
        }

        /**
         * Notify logged in user if directory is/are exists
         * 
         * @since 4.1.4
         * @return string
         */
        public function is_dir_exists() {
            if( !is_dir( $this->settings['scss_dir'] ) || !is_dir( $this->settings['css_dir'] ) ) {
                echo '<div class="wpui-minimalist-notifications wpui-error">
                    <p><strong>AIOS SCSS Compiler:</strong> One or more specified directories does not exist. Please create the directories or <a href="' . get_admin_url( '', 'admin.php?page=init-setup&panel=scss-compiler' ) . '">update your settings.</a></p>
                </div>';
            }
        }

        /**
         * Apply filter to recompile
         * @usage add_filter( aios_recompile_scss, return true);
         * @param $recompile - if true this will compile all sass. default: false(bool)
         * @since 4.1.4
         * @return void
         */
        public function recompile_scss() {
            $recompile = apply_filters('aios_recompile_scss', $this->compiler->recompile());
            if ( $recompile ) {
                $this->scss_compile();
                $this->handle_compiling_errors();
            }
        }

        /**
         * Re/Compile SCSS to CSS
         * 
         * @usage
            * function aios_scss_set_variables(){
            *     $variables = array(
            *         'black' => '#000',
            *         'white' => '#fff'
            *     );
            *     return $variables;
            * }
            * add_filter( 'aios_scss_variables', 'aios_scss_set_variables' );
         * @since 4.1.4
         * @return void
         */
        public function scss_compile() {
            $variables = apply_filters('aios_scss_variables', array());
            foreach ($variables as $variable_key => $variable_value) {
                if (strlen(trim($variable_value)) == 0) {
                    unset($variables[$variable_key]);
                }
            }
            $this->compiler->set_variables($variables);
            $this->compiler->compile();
        }

        /**
         * Handle compiling error
         * @since 4.1.4
         * @return void
         */
        public function handle_compiling_errors() {
            /** Show to logged in users: All the methods for checking user login are set up later in the WP flow, so this only checks that there is a cookie */
            if ( 
                !is_admin() && $this->settings['error_display'] === 'show-logged-in' 
                && !empty($_COOKIE[LOGGED_IN_COOKIE]) 
                && count($this->compiler->compile_errors) > 0 ) {
                $this->compile_error_display( $this->compiler->compile_errors );
            } else if ( 
                !is_admin() 
                && $this->settings['error_display'] === 'show' 
                && count($this->compiler->compile_errors) > 0 ) {
                /** Show in the header to anyone */
                $this->compile_error_display( $this->compiler->compile_errors );
            } else { 
                /** Hide errors and print them to a log file. */
                foreach ($this->compiler->compile_errors as $error) {
                    $error_string = date('m/d/y g:i:s', time()) .': ';
                    $error_string .= $error['file'] .' - '. $error['message'] . PHP_EOL;
                    file_put_contents($this->log_file, $error_string, FILE_APPEND);
                    $error_string = "";
                }
            }
        
            /** Clean out log file if it get's too large */
            if ( file_exists($this->log_file) ) {
                if ( filesize($this->log_file) > 1000000) {
                    $log_contents = file_get_contents($this->log_file);
                    $log_arr = explode("\n", $log_contents);
                    $new_contents_arr = array_slice($log_arr, count($log_arr)/2);
                    $new_contents = implode(PHP_EOL, $new_contents_arr) . 'LOG FILE CLEANED ' . date('n/j/y g:i:s', time());
                    file_put_contents($this->log_file, $new_contents);
                }
            }
        }

        /**
         * Compile error styling
         * @since 4.1.4
         * @return string
         */
        public function compile_error_styles() {
            echo '<style>
                .scss_errors {
                    position: fixed;
                    top: 0px;
                    z-index: 99999;
                    width: 100%;
                }
                .scss_errors pre {
                    background: #f5f5f5;
                    border-left: 5px solid #DD3D36;
                    box-shadow: 0 2px 3px rgba(51,51,51, .4);
                    color: #666;
                    font-family: monospace;
                    font-size: 14px;
                    margin: 20px 0;
                    overflow: auto;
                    padding: 20px;
                    white-space: pre;
                    white-space: pre-wrap;
                    word-wrap: break-word;
                }
            </style>';
        }


        /**
         * Display compiling error
         * @since 4.1.4
         * @return string
         */
        public function compile_error_display( $errors ) {
            echo '<div class="scss_errors"><pre>';
                echo '<h6 style="margin: 15px 0;">Sass Compiling Error</h6>';
                foreach( $errors as $error) {
                    echo '<p class="sass_error">';
                        echo '<strong>'. $error['file'] .'</strong> <br/><em>"'. $error['message'] .'"</em>';
                    echo '</p>';
                }
            echo '</pre></div>';
          
            add_action( 'wp_print_styles', array( $this, 'compile_error_styles' ) );
        }

        /**
         * Enqueue compiled SCSS
         * @since 4.1.4
         * @return void
         */
        public function compiled_scss_enqueue_styles() {
            $this->compiler->enqueue_files( $this->settings['css_location'] );
        }

		/**
		 * Add button for suspend or resume
		 *
		 * @since 4.1.4
		 *
		 * @access public
		 */
		public function development_mode_bar_menu( $wp_admin_bar ) {
            if( strtolower(wp_get_current_user()->user_login) === 'agentimage' ) {
                $is_active = get_option( 'aios_scss_compiler_development', 'off' );
    
                if ( $is_active == 'on' ) {
                    $args = array(
                        'id' => 'aios_scss_bar_menu_production',
                        'title' => '<em class="ai-font-play-button-a"></em> Turn OFF Development',
                        'href' => '#', 
                        'meta' => array(
                            'class' => 'aios-scss-resume'
                        )
                    );
                } else {
                    $args = array(
                        'id' => 'aios_scss_bar_menu_development',
                        'title' => '<em class="ai-font-pause-button-a"></em> Turn ON Development', 
                        'href' => '#', 
                        'meta' => array(
                            'class' => 'aios-scss-suspend'
                        )
                    );
                }

                $wp_admin_bar->add_node( $args );
            }
        }
        
        /**
         * Enqueue assets for logged in users
         * 
         * @since 4.1.4
         * @return void
         */
        public function enqueue_assets_logged_in_users() {
            if( is_user_logged_in() ) {
                $cdn = 'https://resources.agentimage.com';
                $font = 'https://fonts.googleapis.com';

				/** Google Font: Roboto Condensed and Roboto **/
				wp_enqueue_style( 'frontend-user-logged-uiux-google-font-roboto-condensed', $font  . '/css?family=Roboto+Condensed:400,700' );
				wp_enqueue_style( 'frontend-user-logged-uiux-google-font-roboto', $font  . '/css?family=Roboto:400,400i,500,700,700i' );

				/** Enqueue notification **/
                wp_enqueue_style( 'aios-sweetalert2-style', $cdn . '/admin/css/swal.css' );
                wp_enqueue_script( 'aios-sweetalert2-script', $cdn . '/admin/js/sweetalert2.min.js' );

				/** Enqueue WPUIKIT **/
                wp_enqueue_style( 'aios-wpuikit-style', $cdn . '/wpuikit/v1/wpuikit.css' );
                wp_enqueue_script( 'aios-wpuikit-script', $cdn . '/wpuikit/v1/wpuikit.js' );
                
                /** Admin */
                wp_enqueue_script( 'aios-scss-compiler-logged-users', plugin_dir_url( __FILE__ ) . 'assets/js/admin.js' );
                wp_localize_script( 'aios-scss-compiler-logged-users', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
            }
        }

    }

    $aios_initial_setup_module_instances_object['AIOS_Initial_Setup_SCSS_Compiler'] = new AIOS_Initial_Setup_SCSS_Compiler();

}