<?php
/**
 * This class will return require files
 *
 * @since 2.8.6
 */
if ( !class_exists( 'aios_initial_setup_init_ajax' ) ) {
	
	class aios_initial_setup_init_ajax{

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function __construct() {
			$this->add_actions();
		}

		/**
		 * Add Actions.
		 *
		 * @since 1.0.0
		 *
		 * @access protected
		 */
		protected function add_actions() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_uiux' ), 11 );

			/** AJAX Action to Save Options**/
			add_action( 'wp_ajax_aios_save_options', array( $this, 'aios_save_options' ) );

			/** AJAX Action to Generate Default Pages **/
			add_action( 'wp_ajax_generate_default_pages', array( $this, 'generate_default_pages' ) );

			/** AJAX Action to Generate Bulk Pages **/
			add_action( 'wp_ajax_generate_bulk_pages', array( $this, 'generate_bulk_pages' ) );

			/** AJAX Action to Generate Quick Search JSON**/
			add_action( 'wp_ajax_quick_search_generate_json', array( $this, 'quick_search_generate_json' ) );

			/** AJAX Action to Duplicate Menu **/
			add_action( 'wp_ajax_duplicate_menu', array( $this, 'duplicate_menu' ) );

			/** AJAX Action to Refresh minified resources **/
			add_action( 'wp_ajax_refresh_minified_resources', array( $this, 'refresh_minified_resources' ) );

			/** AJAX Action to Add custom fields **/
			add_action( 'wp_ajax_client_info_custom_fields', array( $this, 'client_info_custom_fields' ) );
		}

		public function aios_save_options() {
			
			$option_name = $_POST['option_name'];
			$option_value = $_POST['option_value'];

			$notification = array();
			update_option( $option_name, $option_value );

			$notification[] = 'Updated';

			/** Output in ajax **/
			echo json_encode( $notification );
			die();
		}

		/**
		 * Enqueue scripts and styles for initial setup sub page
		 *
		 * @since 2.8.6
		 *
		 * @access public
		 */
		public function admin_uiux() {
			$admin_page_id = get_current_screen()->id;
			$admin_page_contains = 'aios-all-in-one_page_init-setup';

			if ( strpos($admin_page_id, $admin_page_contains) !== false ) {
				/** Enqueue Initial Setup Styles **/
				// wp_enqueue_style( 'aios-initial-setup-admin-style', AIOS_INITIAL_SETUP_URL . 'includes/assets/css/initial-setup-admin.css' );

				wp_enqueue_script( 'aios-initial-setup-admin-script', AIOS_INITIAL_SETUP_URL . 'includes/assets/js/initial-setup-admin.js' );
				wp_localize_script( 'aios-initial-setup-admin-script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
			}
		}


		/**
		 * Generate default page
		 *
		 * @since 2.8.6
		 *
		 * @access public
		 */
		public function generate_default_pages() {

			$ids = $_POST['ids'];
			$notification = array();

			$aios_initial_setup_generate_default_pages = new aios_initial_setup_generate_default_pages();
			$aios_initial_setup_generate_default_pages->generate_default_pages( $ids );

			$notification[] = 'Pages are Generated.';
			$notification[] = 'View Created: <a href="' . admin_url( 'edit.php?post_type=page&orderby=date&order=desc' ) . '" target="_blank" class="wpui-text-decoration-none"> Pages</a> | <a href="' . admin_url( 'admin.php?page=wpcf7' ) . '" target="_blank" class="wpui-text-decoration-none">Forms</a>';

			/** Output in ajax **/
			echo json_encode( $notification );
			die();
		}

		/**
		 * Generate bulk pages
		 *
		 * @since 2.8.6
		 *
		 * @access public
		 */
		public function generate_bulk_pages() {
			$pages = $_POST[ 'pages' ];
			$page_content = $_POST[ 'page_content' ];
			$page_status = $_POST[ 'page_status' ];
			$page_parent = $_POST[ 'page_parent' ];
			$page_template = $_POST[ 'page_template' ];
			$notification = array();

			/** Create Pages**/
			$aios_initial_setup_generate_bulk_pages = new aios_initial_setup_generate_bulk_pages();
			$aios_initial_setup_generate_bulk_pages->generate_bulk_pages(  $pages, $page_content, $page_status, $page_parent, $page_template );

			$notification[] = 'Pages are Generated.';
			$notification[] = 'View Created: <a href="' . admin_url( 'edit.php?post_type=page&orderby=date&order=desc' ) . '" target="_blank" class="wpui-text-decoration-none"> Pages</a>';

			echo json_encode( $notification );
			die();
		}

		/**
		 * Generate bulk pages
		 *
		 * @since 3.0.5
		 *
		 * @access public
		 */
		public function quick_search_generate_json() {
			$cid 	= $_POST['cid'];
			$types 	= $_POST['types'];

			$aios_initial_setup_init_quick_search = new aios_initial_setup_init_quick_search();
			echo json_encode( $aios_initial_setup_init_quick_search->generate_json( $cid, $types ) );
			die();
		}

		/**
		 * Duplicate Menu
		 *
		 * @since 3.0.5
		 *
		 * @access public
		 */
		public function duplicate_menu() {
			$id 			= intval( $_POST['id'] );
			$name 			= sanitize_text_field( $_POST['name'] );
			$notification 	= array();

			$id 			= $id;
			$name 			= $name;
			$source 		= wp_get_nav_menu_object( $id );
			$source_items 	= wp_get_nav_menu_items( $id );
			$new_menu_id 	= wp_create_nav_menu( $name );

			if ( $new_menu_id ) { 
				$rel 	= array();
				$i 		= 1;
				foreach ( $source_items as $menu_item ) {
					$args = array(
						'menu-item-db-id'		=> $menu_item->db_id,
						'menu-item-object-id'	=> $menu_item->object_id,
						'menu-item-object'		=> $menu_item->object,
						'menu-item-position'	=> $i,
						'menu-item-type'		=> $menu_item->type,
						'menu-item-title'		=> $menu_item->title,
						'menu-item-url'			=> $menu_item->url,
						'menu-item-description'	=> $menu_item->description,
						'menu-item-attr-title'	=> $menu_item->attr_title,
						'menu-item-target'		=> $menu_item->target,
						'menu-item-classes'		=> implode( ' ', $menu_item->classes ),
						'menu-item-xfn'			=> $menu_item->xfn,
						'menu-item-status'		=> $menu_item->post_status
					);

					$parent_id = wp_update_nav_menu_item( $new_menu_id, 0, $args );

					$rel[$menu_item->db_id] = $parent_id;

					/** did it have a parent? if so, we need to update with the NEW ID **/
					if ( $menu_item->menu_item_parent ) {
						$args['menu-item-parent-id'] = $rel[$menu_item->menu_item_parent];
						$parent_id = wp_update_nav_menu_item( $new_menu_id, $parent_id, $args );
					}

					$i++;
				}

				$notification[] = 'success';
			} else {
				$notification[] = 'error';
			}

			echo json_encode( $notification );
			die();
		}

		/**
		 * Refresh minified resources.
		 *
		 * @since 3.9.1
		 *
		 * @access public
		 * @return void
		 */
		public function refresh_minified_resources() {
			$aiosmin = WP_CONTENT_DIR . '/aiosmin';
			$notification = array();
			if( get_transient( 'aiosmin' ) == 'minified' ) {
				wp_delete_file( $aiosmin . '/aios-bundle.css' );
				wp_delete_file( $aiosmin . '/aios-header-bundle.js' );
				wp_delete_file( $aiosmin . '/aios-footer-bundle.js' );
				delete_transient( 'aiosmin' );
				$notification[] = 'success';
			} else {
				$notification[] = 'error';
			}
	
			echo json_encode( $notification );
			die();
		}

		/**
		 * Add client info custom fields.
		 *
		 * @since 4.0.8
		 *
		 * @access public
		 * @return void
		 */
		public function client_info_custom_fields() {
			$clientInfoFields 	= get_option( 'aios_cicf_custom_fields', array() );
			$notification 		= array();
			$field_action 		= $_POST['field_action'];
			$label_value 		= $_POST['label_value'];
			$name_value 		= $_POST['name_value'];
			$shortcode_value 	= $_POST['shortcode_value'];

			/** Check if add else remove */
			if ( $field_action == 'add' ) {
				
				/** We need to check if duplicate */
				if ( !empty( $clientInfoFields[$name_value] ) ) {
					$notification[] = 'duplicate';
				} else {
					/** Create an array for new */
					$value_arr = array();
					$value_arr[$name_value][ 'label_value' ] = $label_value;
					$value_arr[$name_value][ 'name_value' ] = $name_value;
					$value_arr[$name_value][ 'shortcode_value' ] = $shortcode_value;
					$notification[] = 'success';

					/** Save */
					$clientInfoFields = array_merge_recursive( $clientInfoFields, $value_arr );
					update_option( 'aios_cicf_custom_fields', $clientInfoFields );
				}

			} elseif ( $field_action == 'remove' ) {
				if ( isset( $clientInfoFields[$name_value] ) ) {
					unset( $clientInfoFields[$name_value] );
					update_option( 'aios_cicf_custom_fields', $clientInfoFields );
					$notification[] = 'success';
				} else {
					$notification[] = 'error';
				}
			} else {
				$notification[] = 'no action taken';
			}

			echo json_encode( $notification );
			die();
		}
		
	}

	$aios_initial_setup_init_ajax = new aios_initial_setup_init_ajax();
}
?>