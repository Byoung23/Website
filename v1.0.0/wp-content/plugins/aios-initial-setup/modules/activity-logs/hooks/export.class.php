<?php
/** Exit if accessed directly **/
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This class will return require files
 *
 * @since 3.0.9
 */

if ( !class_exists( 'AIOS_Initial_Setup_Activity_Logs_Export' ) ) {
	class AIOS_Initial_Setup_Activity_Logs_Export {

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
			add_action( 'export_wp', array( $this, 'hooks_export_wp' ) );
		}

		public function hooks_export_wp( $args ) {
			aios_insert_activity_logs(
				array(
					'action' 		=> 'Export Downloaded',
					'activity'		=> isset( $args['content'] ) ? $args['content'] : 'all',
					'object-type'	=> 'Export'
				)
			);
		}

	}
}

$aios_initial_setup_Activity_Logs_Export = new AIOS_Initial_Setup_Activity_Logs_Export();