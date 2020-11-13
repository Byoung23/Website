<?php
/** Exit if accessed directly **/
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This class will return require files
 *
 * @since 3.0.9
 */

if ( !class_exists( 'AIOS_Initial_Setup_Activity_Logs_Widgets' ) ) {
	class AIOS_Initial_Setup_Activity_Logs_Widgets {

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
			add_filter( 'widget_update_callback', array( &$this, 'hooks_widget_update_callback' ), 9999, 4 );
			/** Widget delete. **/ 
			add_filter( 'sidebar_admin_setup', array( &$this, 'hooks_widget_delete' ) );
		}

		public function hooks_widget_update_callback( $instance, $new_instance, $old_instance, WP_Widget $widget ) {

			if ( ! empty( $_REQUEST['sidebar'] ) ){
				$sidebar = strtolower( $_REQUEST['sidebar'] );
			} else {
				$sidebar = 'unknown';
			}

			aios_insert_activity_logs( array(
				'action' 		=> 'Widget Updated',
				'activity'		=> 'Widget Name: <strong>' . $widget->id_base .'</strong> Sidebar Name: <strong>' . $sidebar .'</strong>',
				'object-type'	=> 'Widget'
			) );

			return $instance;
		}

		public function hooks_widget_delete() {
			// A reference: http://grinninggecko.com/hooking-into-widget-delete-action-in-wordpress/
			if ( 'post' == strtolower( $_SERVER['REQUEST_METHOD'] ) && ! empty( $_REQUEST['widget-id'] ) ) {
				if ( isset( $_REQUEST['delete_widget'] ) && 1 === (int) $_REQUEST['delete_widget'] ) {
					aios_insert_activity_logs( array(
						'action' 		=> 'Widget Deleted',
						'activity'		=> 'Widget Name: <strong>' . $_REQUEST['id_base'] .'</strong> Sidebar Name: <strong>' . $_REQUEST['sidebar'] .'</strong>',
						'object-type'	=> 'Widget'
					) );
				}
			}
		}

	}
}

$aios_initial_setup_Activity_Logs_Widgets = new AIOS_Initial_Setup_Activity_Logs_Widgets();