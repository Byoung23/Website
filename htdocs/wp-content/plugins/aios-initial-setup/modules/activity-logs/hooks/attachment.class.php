<?php
/** Exit if accessed directly **/
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This class will return require files
 *
 * @since 3.0.9
 */

if ( !class_exists( 'AIOS_Initial_Setup_Activity_Logs_Attachment' ) ) {
	class AIOS_Initial_Setup_Activity_Logs_Attachment {

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
			add_action( 'add_attachment', array( $this, 'hooks_add_attachment' ) );
			add_action( 'edit_attachment', array( $this, 'hooks_edit_attachment' ) );
			add_action( 'delete_attachment', array( $this, 'hooks_delete_attachment' ) );
		}

		protected function add_log_attachment( $action, $attachment_id ) {
			$post = get_post( $attachment_id );
			aios_insert_activity_logs(
				array(
					'action' 		=> $action,
					'activity'		=> 'Attachment ID: <strong>' . $attachment_id . '</strong> | Name: <strong>' . esc_html( get_the_title( $post->ID ) ) . '</strong>',
					'object-type'	=> 'Attachment'
				)
			);
		}

		public function hooks_delete_attachment( $attachment_id ) {
			$this->add_log_attachment( 'Attachment Deleted', $attachment_id );
		}

		public function hooks_edit_attachment( $attachment_id ) {
			$this->add_log_attachment( 'Attachment Updated', $attachment_id );
		}

		public function hooks_add_attachment( $attachment_id ) {
			$this->add_log_attachment( 'Attachment Added', $attachment_id );
		}



	}
}

$aios_initial_setup_Activity_Logs_Attachment = new AIOS_Initial_Setup_Activity_Logs_Attachment();