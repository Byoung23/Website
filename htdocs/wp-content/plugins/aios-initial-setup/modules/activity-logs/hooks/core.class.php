<?php
/** Exit if accessed directly **/
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This class will return require files
 *
 * @since 3.0.9
 */

if ( !class_exists( 'AIOS_Initial_Setup_Activity_Logs_Core' ) ) {
	class AIOS_Initial_Setup_Activity_Logs_Core {

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
			add_action( '_core_updated_successfully', array( $this, 'core_updated_successfully' ) );
		}

		public function core_updated_successfully( $wp_version ) {
			global $pagenow;

			// Auto updated
			if ( 'update-core.php' !== $pagenow ){
				$object_name = 'WordPress Auto Updated';
			} else{
				$object_name = 'WordPress Updated';
			}

			aios_insert_activity_logs(
				array(
					'action' 		=> 'Core Update',
					'activity'		=> $object_name,
					'object-type'	=> 'WordPress'
				)
			);
		}

	}
}

$aios_initial_setup_Activity_Logs_Core = new AIOS_Initial_Setup_Activity_Logs_Core();