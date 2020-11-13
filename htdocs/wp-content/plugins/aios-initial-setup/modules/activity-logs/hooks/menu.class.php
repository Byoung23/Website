<?php
/** Exit if accessed directly **/
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This class will return require files
 *
 * @since 3.0.9
 */

if ( !class_exists( 'AIOS_Initial_Setup_Activity_Logs_Menu' ) ) {
	class AIOS_Initial_Setup_Activity_Logs_Menu {

		/**
		 * Constructor
		 *
		 * @since 3.0.9
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {
			$this->add_actions();
		}

		/**
		 * Add Actions.
		 *
		 * @since 3.0.9
		 *
		 * @access protected
		 * @return void
		 */
		protected function add_actions() {
			add_action( 'wp_update_nav_menu', array( $this, 'hooks_menu_created_or_updated' ) );
			add_action( 'wp_create_nav_menu', array( $this, 'hooks_menu_created_or_updated' ) );
			add_action( 'delete_nav_menu', array( $this, 'hooks_menu_deleted' ), 10, 3 );
		}

		public function hooks_menu_created_or_updated( $nav_menu_selected_id ) {
			if ( $menu_object = wp_get_nav_menu_object( $nav_menu_selected_id ) ) {
				if ( 'wp_create_nav_menu' === current_filter() ){
					$action = 'Created';
				} else {
					$action = 'Updated';
				}

				aios_insert_activity_logs(
					array(
						'action' 		=> 'Menu ' . $action,
						'activity'		=> 'Menu Name: <strong>' . $menu_object->name . '</strong>',
						'object-type'	=> 'Menu'
					)
				);
			}
		}

		public function hooks_menu_deleted( $term, $tt_id, $deleted_term ) {
			aios_insert_activity_logs(
				array(
					'action' 		=> 'Menu Deleted',
					'activity'		=> 'Menu Name: <strong>' . $deleted_term->name . '</strong>',
					'object-type'	=> 'Menu'
				)
			);
		}

	}
}

$aios_initial_setup_Activity_Logs_Menu = new AIOS_Initial_Setup_Activity_Logs_Menu();