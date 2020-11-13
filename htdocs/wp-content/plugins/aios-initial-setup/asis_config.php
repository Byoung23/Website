<?php
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( !class_exists( 'asis_initial_config' ) ) {

	class asis_initial_config {
		/**
		 * The plugin version number.
		 *
		 * @since 2.5.4
		 *
		 * @access private
		 * @var string
		 */
		private $asis_transient_module = 'asis_initial_setup_advanced_setting';

		/**
		 * Option Tabs.
		 *
		 * @since 2.8.8
		 *
		 * @access public
		 */
		public function asis_options( $tabs = array() ) {
			$tabs = array(
				'' => array(
					'url' 		=> 'generate-pages',
					'title' 	=> 'Generate Pages',
					'child' 	=> array(
						array(
							'url' 		=> 'default-pages',
							'title' 	=> 'Default Pages',
							'function'	=> 'generate-pages/default-pages.php'
						),
						array(
							'url' 		=> 'bulk-page',
							'title' 	=> 'Bulk Page',
							'function'	=> 'generate-pages/bulk-page.php'
						)
					)
				),
				'elements' => array(
					'url' 		=> 'elements',
					'title' 	=> 'Elements',
					'child' 	=> array(
						array(
							'url' 		=> '404-page-style',
							'title' 	=> '404 Page Style',
							'function' 	=> '404-page-style/404-admin.php'
						),
						array(
							'url' 		=> 'cf-style',
							'title' 	=> 'CF7 Style',
							'function'	=> 'cf7-form-style/cf7-form-style.php'
						)
					)
				),
				'quick-search' => array(
					'url' 		=> 'quick-search',
					'title' 	=> 'Quick Search',
					'function'	=> 'quick-search/quick-search.php',
					'restrict' 	=> 'yes'
				),
				'enqueue-libraries' => array(
					'url' 		=> 'enqueue-libraries',
					'title' 	=> 'Enqueue Libraries',
					'function'	=> 'advanced/enqueue-libraries.php',
					'restrict' 	=> 'yes'
				),
				'login-screen' => array(
					'url' 		=> 'login-screen',
					'title' 	=> 'Login Screen',
					'function'	=> 'advanced/custom-login-screen.php',
					'restrict' 	=> 'yes'
				),
				'duplicate-menu' => array(
					'url' 		=> 'duplicate-menu',
					'title' 	=> 'Duplicate Menu',
					'function'	=> 'advanced/duplicate-menu.php'
				),
				'metaboxes' => array(
					'url' 		=> 'metaboxes',
					'title' 	=> 'Custom Metabox',
					'restrict' 	=> 'yes',
					'child' 	=> array(
						array(
							'url' 		=> 'metaboxes-settings',
							'title' 	=> 'Settings',
							'function' 	=> 'metaboxes/settings.php'
						),
						array(
							'url' 		=> 'metaboxes-implement',
							'title' 	=> 'How to',
							'function'	=> 'metaboxes/implement.php'
						)
					)
				),
				'scss-compiler' => array(
					'url' 		=> 'scss-compiler',
					'title' 	=> 'SCSS Compiler',
					'restrict' 	=> 'yes',
					'child' 	=> array(
						array(
							'url' 		=> 'scss-compiler-settings',
							'title' 	=> 'Settings',
							'function'	=> 'scss-compiler/scss-compiler.php',
						),
						array(
							'url' 		=> 'scss-compiler-readme',
							'title' 	=> 'ReadMe',
							'function'	=> 'scss-compiler/scss-readme.php',
						)
					)
				),
				'settings' => array(
					'url' 		=> 'settings',
					'title' 	=> 'Settings',
					'function'	=> 'advanced/settings.php',
					'restrict' 	=> 'yes'
				),
				'shortcodes' => array(
					'url' 		=> 'shortcodes',
					'title' 	=> 'Shortcodes',
					'function' 	=> 'shortcodes/shortcodes.php'
				)
			);

			return array_filter( $tabs );
		}

		/**
		 * Option Tabs.
		 *
		 * @since 2.8.8
		 *
		 * @access public
		 */
		public function asis_contact_info_options( $tabs = array() ) {
			$tabs = array(
				'' => array(
					'url' 		=> 'general',
					'title' 	=> 'General',
					'child' 	=> array(
						array(
							'url' 		=> 'favicon',
							'title' 	=> 'Favicon',
							'function'	=> 'site-info/general/favicon.php'
						),
						array(
							'url' 		=> 'logo',
							'title' 	=> 'Logo',
							'function'	=> 'site-info/general/logo.php'
						),
						array(
							'url' 		=> 'shortcodes',
							'title' 	=> 'Shortcodes',
							'function' 	=> 'site-info/general/shortcodes.php'
						),
						array(
							'url' 		=> 'custom-fields-shortcodes',
							'title' 	=> 'Custom Fields & Shortcodes',
							'function' 	=> 'site-info/general/custom-fields-shortcodes.php'
						),
					)
				),
				'client-one' => array(
					'url' 		=> 'client-one',
					'title' 	=> 'Client One',
					'child' 	=> array(
						array(
							'url' 		=> 'basic',
							'title' 	=> 'Basic',
							'function'	=> 'site-info/client-one/basic.php'
						),
						array(
							'url' 		=> 'photo',
							'title' 	=> 'Photo',
							'function'	=> 'site-info/client-one/photo.php'
						),
						array(
							'url' 		=> 'social-media',
							'title' 	=> 'Social Media',
							'function'	=> 'site-info/client-one/social-media.php'
						),
						array(
							'url' 		=> 'shortcodes',
							'title' 	=> 'Shortcodes',
							'function' 	=> 'site-info/client-one/shortcodes.php'
						),
					)
				),
				'client-two' => array(
					'url' 		=> 'client-two',
					'title' 	=> 'Client Two',
					'child' 	=> array(
						array(
							'url' 		=> 'basic',
							'title' 	=> 'Basic',
							'function'	=> 'site-info/client-two/basic.php'
						),
						array(
							'url' 		=> 'photo',
							'title' 	=> 'Photo',
							'function'	=> 'site-info/client-two/photo.php'
						),
						array(
							'url' 		=> 'social-media',
							'title' 	=> 'Social Media',
							'function'	=> 'site-info/client-two/social-media.php'
						),
						array(
							'url' 		=> 'shortcodes',
							'title' 	=> 'Shortcodes',
							'function' 	=> 'site-info/client-two/shortcodes.php'
						),
					)
				)
			);

			return array_filter( $tabs );
		}

		/**
		 * Returns list of transient
		 *
		 * @since 2.5.4
		 *
		 * @return string
		 *
		 * @access public
		 */
		public function name_asis_transient_module( $module_name ) {
			return $this->asis_transient_module . '_' . $module_name;
		}

		public function set_asis_transient_module( $module_name, $module_value, $module_autoload ) {
			return set_transient( $this->asis_transient_module . '_' . $module_name, $module_value, $module_autoload );
		}

		public function get_asis_transient_module( $module_name ) {
			return get_transient( $this->asis_transient_module . '_' . $module_name );
		}

		public function delete_asis_transient_module( $module_name ) {
			return delete_transient( $this->asis_transient_module . '_' . $module_name );
		}

		/**
		 * Return list of default modules.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function asis_default_module_lists( $aiosDefaultModules = array() ){

			$aiosDefaultModules = array(
				'activity-logs'								=> array( 'require-plugin' => 'no' ),
				'add-grayscale-image'						=> array( 'require-plugin' => 'no' ),
				'default-settings' 							=> array( 'require-plugin' => 'no' ),
				'duplicate-posts-page' 						=> array( 'require-plugin' => 'no' ),
				'dead-link-disabler'						=> array( 'require-plugin' => 'no' ),
				'remove-auto-p' 							=> array( 'require-plugin' => 'no' ),
				'aios_email_notification_metabox' 			=> array( 'require-plugin' => 'no' ),
				'simplepie-filters' 						=> array( 'require-plugin' => 'no' ),
				'yoast-breadcrumbs-fix' 					=> array( 'require-plugin' => 'no' ),
				'coming-soon-generator' 					=> array( 'require-plugin' => 'no' ),
				'idxb-titles'								=> array( 'require-plugin' => 'no' ),
				'login-attempts'							=> array( 'require-plugin' => 'no' )
			);

			return $aiosDefaultModules;
		}

		/**
		 * Returns updated list of default plugins
		 *
		 * @since 2.5.4
		 *
		 * @return string
		 *
		 * @access public
		 */
		public function aios_initial_setup_advanced_setting_module( $updated_default_modules = array() ) {
			/** Lists of updated default modules **/
			$updated_default_modules 	= $this->asis_default_module_lists();

			/** BEGIN: Set default/Update Options **/
			if ( $this->get_asis_transient_module( 'modules' ) ) {

				/** Check if plugin is active: Contact Form 7 **/
				if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
					$updated_default_modules['contact-form-7-config-validation']['require-plugin'] 			= 'no';
					$updated_default_modules['contact-form-7-email-template']['require-plugin'] 			= 'no';
					$updated_default_modules['contact-form-7-fix-date-field']['require-plugin'] 			= 'no';
					$updated_default_modules['contact-form-7-fix-formdata-compatibility']['require-plugin'] = 'no';
					$updated_default_modules['contact-form-7-form-submissions']['require-plugin'] 			= 'no';
				} else {
					$updated_default_modules['contact-form-7-config-validation']['require-plugin'] 			= 'yes';
					$updated_default_modules['contact-form-7-email-template']['require-plugin'] 			= 'yes';
					$updated_default_modules['contact-form-7-fix-date-field']['require-plugin'] 			= 'yes';
					$updated_default_modules['contact-form-7-fix-formdata-compatibility']['require-plugin'] = 'yes';
					$updated_default_modules['contact-form-7-form-submissions']['require-plugin'] 			= 'yes';
				}

				/** Check if plugin is active: Cyclone Slider **/
				if ( is_plugin_active( 'cyclone-slider/cyclone-slider.php' ) ) {
					$updated_default_modules['cyclone-slider-2-override-defaults']['require-plugin'] = 'no';
				} else {
					$updated_default_modules['cyclone-slider-2-override-defaults']['require-plugin'] = 'yes';
				}

				/** Check if plugin is active: IHF **/
				if ( is_plugin_active( 'optima-express/iHomefinder.php' ) ) {
					$updated_default_modules['ihf-extra-configuration']['require-plugin'] 				= 'no';
					$updated_default_modules['ihf-fixes']['require-plugin']				 				= 'no';
					$updated_default_modules['ihf-fix-location-field-bleeding']['require-plugin'] 		= 'no';
				} else {
					$updated_default_modules['ihf-extra-configuration']['require-plugin'] 				= 'yes';
					$updated_default_modules['ihf-fixes']['require-plugin']				 				= 'yes';
					$updated_default_modules['ihf-fix-location-field-bleeding']['require-plugin'] 		= 'yes';
				}

				/** Check if plugin is active: Cyclone Slider && IHF**/
				if ( is_plugin_active( 'cyclone-slider/cyclone-slider.php' ) && is_plugin_active( 'optima-express/iHomefinder.php' ) ) {
					$updated_default_modules['ihf-cyclone-slider-conflict-fix']['require-plugin'] = 'no';
				} else {
					$updated_default_modules['ihf-cyclone-slider-conflict-fix']['require-plugin'] = 'yes';
				}

				/** Check if plugin is active: AIOS Listings **/
				if ( is_plugin_active( 'AIOS_Listings/listing_module.php.php' ) ) {
					$updated_default_modules['site-adjustments']['require-plugin'] 	= 'no';
				} else {
					$updated_default_modules['site-adjustments']['require-plugin'] 	= 'yes';
				}

				/** Check if plugin is active: TINYMCE **/
				if ( is_plugin_active( 'tinymce-advanced/tinymce-advanced.php' ) ) {
					$updated_default_modules['tinymce-config']['require-plugin'] 	= 'no';
				} else {
					$updated_default_modules['tinymce-config']['require-plugin'] 	= 'yes';
				}
				
				/** Check if plugin is active: ZERO SPAM **/
				if ( is_plugin_active( 'zero-spam/zero-spam.php' ) ) {
					$updated_default_modules['zero-spam-default-settings']['require-plugin'] 	= 'no';
				} else {
					$updated_default_modules['zero-spam-default-settings']['require-plugin'] 	= 'yes';
				}
			}

			return $updated_default_modules ;
        }
        
		/**
		 * Create custom db table for CF7 Leads
		 *
		 * @since 4.4.1
         * @param $dbversion - check if need to update
		 *
		 * @access public
		 */
		public function aios_install_data_table_leads( $dbversion ) {

            global $wpdb;
            $table_name         = $wpdb->prefix . AIOS_LEADS_NAME;
            $charset_collate    = $wpdb->get_charset_collate();

            /**
             * Check table exists before create
             */
            if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {
                $sql = "CREATE TABLE $table_name (
                    id              int(11) NOT NULL AUTO_INCREMENT,
                    title           VARCHAR (255) NOT NULL,
                    category        VARCHAR (255) NOT NULL,
                    client_name     VARCHAR (255) NOT NULL,
                    client_email    VARCHAR (255) NOT NULL,
                    client_body     longtext NOT NULL,
                    remote_ip       VARCHAR (255) NOT NULL,
                    page_source     VARCHAR (255) NOT NULL,
                    date            VARCHAR (255) NOT NULL,

                    created_at  datetime NOT NULL,
                    expires_at  datetime NOT NULL,
                    PRIMARY KEY  (id)
                ) $charset_collate;";
                
                require_once ABSPATH . 'wp-admin/includes/upgrade.php';
                dbDelta( $sql );

                /** Add options for db versioning */
                add_option( AIOS_LEADS_NAME . '_version', $dbversion );
            }

            /**
             * Check if database exists before updating
             */
            if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name ) {
                /** Check if db version is up to date if not update table */
                $installed_ver = get_option( AIOS_LEADS_NAME . '_version' );
                if ( $installed_ver != $dbversion ) {
                    $sql = "CREATE TABLE $table_name (
                        id              int(11) NOT NULL AUTO_INCREMENT,
                        title           VARCHAR (255) NOT NULL,
                        category        VARCHAR (255) NOT NULL,
                        client_name     VARCHAR (255) NOT NULL,
                        client_email    VARCHAR (255) NOT NULL,
                        client_body     longtext NOT NULL,
                        remote_ip       VARCHAR (255) NOT NULL,
                        page_source     VARCHAR (255) NOT NULL,
                        date            VARCHAR (255) NOT NULL,
                    
                        created_at  datetime NOT NULL,
                        expires_at  datetime NOT NULL,
                        PRIMARY KEY  (id)
                    ) $charset_collate;";
    
                    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
                    dbDelta( $sql );
    
                    update_option(AIOS_LEADS_NAME . '_version', $dbversion);
                }
            }

        }
        
		/**
		 * Create custom db table for CF7 Leads
		 *
		 * @since 4.4.1
         * @param $dbversion - check if need to update
		 *
		 * @access public
		 */
		public function aios_install_data_table_audit_logs( $dbversion ) {

            global $wpdb;
            $table_name         = $wpdb->prefix . AIOS_AUDIT_LOGS_NAME;
            $charset_collate    = $wpdb->get_charset_collate();

            /**
             * Check table exists before create
             */
            if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {
                $sql = "CREATE TABLE $table_name (
                    id              int(11) NOT NULL AUTO_INCREMENT,
                    date            VARCHAR (255) NOT NULL,
                    action          VARCHAR (255) NOT NULL,
                    object_type     VARCHAR (255) NOT NULL,
                    network_ip      VARCHAR (255) NOT NULL,
                    local_ip        VARCHAR (255) NOT NULL,

                    author          VARCHAR (255) NOT NULL,
                    content         longtext NOT NULL,

                    created_at      datetime NOT NULL,
                    expires_at      datetime NOT NULL,
                    PRIMARY KEY  (id)
                ) $charset_collate;";
                
                require_once ABSPATH . 'wp-admin/includes/upgrade.php';
                dbDelta( $sql );

                /** Add options for db versioning */
                add_option( AIOS_AUDIT_LOGS_NAME . '_version', $dbversion );
            }

            /**
             * Check if database exists before updating
             */
            if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name ) {
                /** Check if db version is up to date if not update table */
                $installed_ver = get_option( AIOS_AUDIT_LOGS_NAME . '_version' );
                if ( $installed_ver != $dbversion ) {
                    $sql = "CREATE TABLE $table_name (
                        id              int(11) NOT NULL AUTO_INCREMENT,
                        date            VARCHAR (255) NOT NULL,
                        action          VARCHAR (255) NOT NULL,
                        object_type     VARCHAR (255) NOT NULL,
                        network_ip      VARCHAR (255) NOT NULL,
                        local_ip        VARCHAR (255) NOT NULL,
    
                        author          VARCHAR (255) NOT NULL,
                        content         longtext NOT NULL,
    
                        created_at      datetime NOT NULL,
                        expires_at      datetime NOT NULL,
                        PRIMARY KEY  (id)
                    ) $charset_collate;";
    
                    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
                    dbDelta( $sql );
    
                    update_option(AIOS_AUDIT_LOGS_NAME . '_version', $dbversion);
                }
            }

        }

	}
}