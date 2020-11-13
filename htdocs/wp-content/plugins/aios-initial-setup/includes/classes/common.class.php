<?php
/**
 * This will initialize common helper
 *
 * @since 4.3.0
 */
if ( !class_exists( 'aios_initial_setup_includes_common' ) ) {
	
	class aios_initial_setup_includes_common{

		/**
		 * Constructor
		 *
		 * @since 4.3.0
		 * @access public
		 * @return void
		 */
		public function __construct() {
			$this->add_actions();
		}

		/**
		 * Add Actions.
		 *
		 * @since 4.3.0
		 * @access protected
		 * @return void
		 */
		protected function add_actions() {
            /** Dsiable confirmation notices */
            add_action( 'admin_init', array( $this, 'disable_the_confirmation_notices' ) );

            /** Add user navigated from same domain */
            add_filter( 'body_class', array( $this, 'navigate_on_same_domain' ), 11 );
            add_action( 'wp_footer', array( $this, 'domain_referer' ), 10 ); /** fallback: body_class navigate_on_same_domain */

            /** Add 'submenu' option to wp_nav_menu for displaying submenus on parent pages */
            if ( !shortcode_exists( 'wp_nav_menu' ) ) add_shortcode( 'wp_nav_menu', array( $this, 'navShortCode' ) ); 
            add_filter( 'wp_nav_menu_objects', array( $this, 'subMenuLimitShortCode' ), 10, 2 );
            
            /** Remove quick edit for all post and page */
            add_filter( 'post_row_actions', array( $this, 'remove_quick_edit' ), 10, 2 );
            add_filter( 'page_row_actions', array( $this, 'remove_quick_edit' ), 10, 2 );

            /** Disable phone formatting on IE Edge */
            add_filter( 'language_attributes' ,array( $this, 'disable_phone_formatting' ), 11, 2 );

            /** Remove uncessary admin menu */
            add_action( 'admin_init', array( $this, 'remove_admin_menus' ), 11 );

            /** Re-order admin menu */
            add_filter( 'custom_menu_order', function() { return true; } ); /** Need to return true to enable menu_order to works */
            add_filter( 'menu_order', array( $this, 'reorder_admin_menu' ), 999 );
        }

        /**
         * Disable the confirmation notices when an administrator 
         * changes their email address.
         * This was transfer 
            * from modules/general-email-notifications
         * 
         * @since 4.3.5
         * @access public
         * @return void
         */
        public function disable_the_confirmation_notices() {
            if ( get_option( 'aios_email_notification_metabox' ) != false ) {
                remove_action( 'add_option_new_admin_email', 'update_option_new_admin_email' );
                remove_action( 'update_option_new_admin_email', 'update_option_new_admin_email' );
                /**
                 * Disable the confirmation notices when an administrator
                 * changes their email address.
                 *
                 * @see https://developer.wordpress.org/reference/functions/update_option_new_admin_email/
                 */
                function wpdocs_update_option_new_admin_email( $old_value, $value ) {
                    update_option( 'admin_email', $value );
                }
                add_action( 'add_option_new_admin_email', 'wpdocs_update_option_new_admin_email', 10, 2 );
                add_action( 'update_option_new_admin_email', 'wpdocs_update_option_new_admin_email', 10, 2 );
            }
        }
        
        /**
         * If site referer same domain
         * 
         * @since 4.3.0
		 * @access public
         * @param array $classes - available classes for body
         * @return array
         */
        public function navigate_on_same_domain( $classes ) {
            if ( isset ( $_SERVER['HTTP_REFERER'] ) ) {
                if ( strpos( $_SERVER['HTTP_REFERER'], home_url() ) !== FALSE ) {
                    $classes[] = 'user-navigated-from-a-page-on-the-site';
                }
            }
            return $classes;
        }
        
        /**
         * Add fallback for caching enabled "if site referer same domain"
         * 
         * @since 4.3.0
		 * @access public
         * @param array $classes - available classes for body
         * @return array
         */
        public function domain_referer() {
            echo '<script>
                var docRef = (  document.referrer == undefined ? "" :  document.referrer );
                if ( document.referrer.indexOf( "' . home_url() . '" ) !== -1 && !document.body.classList.contains( "user-navigated-from-a-page-on-the-site" ) ) document.body.className += " user-navigated-from-a-page-on-the-site";
            </script>';
        }

         /**
         * Create shortcode of wp_nav_menu()
         * @see https://developer.wordpress.org/reference/functions/wp_nav_menu/
         * 
         * This was transfer 
            * from modules/wp-nav-menu
         * 
         * @since 4.3.5
         * @access public
         * @return string
         */
        public function navShortCode($atts) {
            ob_start();
                wp_nav_menu($atts);
                $output = ob_get_contents();
            ob_end_clean();
            return $output;
        }

        /**
         * Add 'submenu' option to wp_nav_menu 
         * for displaying submenus on parent pages
         * @see http://www.ordinarycoder.com/wordpress-wp_nav_menu-show-a-submenu-only/
         * 
         * This was transfer 
            * from modules/wp-nav-menu
         * 
         * @since 4.3.5
         * @access public
         * @return array
         */
        public function subMenuLimitShortCode( $items, $args ) {
            if ( empty($args->submenu) )return $items;

            $object_list = wp_filter_object_list( $items, array( 'title' => $args->submenu ), 'and', 'ID' );
            $parent_id = array_pop($object_list);
            $children  = $this->subMenuGetChildrenID( $parent_id, $items );

            foreach ( $items as $key => $item ) {
                if ( ! in_array( $item->ID, $children ) ) unset($items[$key]);
            }

            return $items;
        }

        /** 
         * callback: subMenuLimitShortCode
         * Get submenu lists and add submenu option
         * 
         * This was transfer 
            * from modules/wp-nav-menu
         * 
         * @since 4.3.5
         * @access public
         * @return array
         */
        public function subMenuGetChildrenID( $id, $items ) {
            $ids = wp_filter_object_list( $items, array( 'menu_item_parent' => $id ), 'and', 'ID' );
            foreach ( $ids as $id ) {
                $ids = array_merge( $ids, $this->subMenuGetChildrenID( $id, $items ) );
            }
            return $ids;
        }

        /** 
         * Remove quick links from post/page lists 
         * To fix non-saving custom post type
         * 
         * This was transfer 
            * from modules/remove-quick-edit
         * 
         * @since 4.3.5
         * @access public
         * @return array - Return the set of links without Quick Edit
         */
        public function remove_quick_edit( $actions = array(), $post = null ) {
            if ( isset( $actions['inline hide-if-no-js'] ) ) unset( $actions['inline hide-if-no-js'] );
            return $actions;
        }

        /** 
         * Remove phone format on IE Edge or User agent has Edge
         * 
         * This was transfer 
            * from modules/remove-phone-format-from-ms-edge
         * 
         * @since 4.3.5
         * @access public
         * @return array - Return the set of links without Quick Edit
         */
        public function disable_phone_formatting( $output, $doctype ) {
            if ( strpos( $_SERVER["HTTP_USER_AGENT"], " Edge/") > -1 || strpos( $_SERVER["HTTP_USER_AGENT"], "Dynamic Wrapper bot") > -1 ) {
                return $output . " x-ms-format-detection=\"none\"";
            }
            return $output;
        }

        /**
         * Remove admin menu for non-agentimage users
         * 
         * @since 4.3.5
         * @access public
         * @return void
         */
        public function remove_admin_menus() {
			$current_username = wp_get_current_user()->user_login;
			if ( strtolower( $current_username ) !== 'agentimage' ) {
                /** List of available menu page
                 * remove_menu_page( 'index.php' ); // Dashboard
                 * remove_menu_page( 'edit.php' ); // Posts 
                 * remove_menu_page( 'upload.php' ); // Media
                 * remove_menu_page( 'edit.php?post_type=page' ); // Pages
                 * remove_menu_page( 'themes.php' ); // Appearance 
                 * remove_menu_page( 'plugins.php' ); // Plugins 
                 * remove_menu_page( 'users.php' ); // Users 
                 * remove_menu_page( 'options-general.php' ); // Settings 
                 */
                remove_menu_page( 'edit-comments.php' ); /** Comments */
                remove_menu_page( 'tools.php' ); /** Tools */
            }
        }

        /**
         * Reorders admin menu to match the wanted order
         *
         * @param $menu_order
         * @access public
         * @return mixed
         */
        public function reorder_admin_menu($menu_order) {

            /** This items will be inserted after dashboard */
            $reordered_items = array(
                'edit.php',
                'edit.php?post_type=page',
                'wpcf7',
                'aios-cf7-store-messages',
                'edit.php?post_type=aios-agents',
                'edit.php?post_type=aios-listings',
                'edit.php?post_type=aios-testimonials'
            );

            /** This is where we will insert our reordered items */
            $reordered_items_insertion_point = 'separator1';

            /** Remove items we are supposed to reorder */
            $filtered_menu_order = array_diff($menu_order, $reordered_items);

            /** Init new order */
            $new_menu_order = array();

            /** Loop all current menu items */
            foreach($filtered_menu_order as $menu_item) {
                /** Add to array */
                $new_menu_order[] = $menu_item;
                /** Our trigger? Let's go! */
                if( $menu_item === $reordered_items_insertion_point ) {
                    /** Add in our reordered items */
                    $new_menu_order = array_merge($new_menu_order, $reordered_items);
                }
            }

            return $new_menu_order;
        }

    }
    
    $aios_initial_setup_includes_common = new aios_initial_setup_includes_common();
}