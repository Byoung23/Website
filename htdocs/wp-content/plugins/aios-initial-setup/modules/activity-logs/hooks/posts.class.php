<?php
/** Exit if accessed directly **/
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This class will return require files
 *
 * @since 3.0.9
 */

if ( !class_exists( 'AIOS_Initial_Setup_Activity_Logs_Posts' ) ) {
	class AIOS_Initial_Setup_Activity_Logs_Posts {

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
			add_action( 'transition_post_status', array( $this, 'hooks_transition_post_status' ), 10, 3 );
			add_action( 'delete_post', array( $this, 'hooks_delete_post' ) );
		}

		protected function _draft_or_post_title( $post = 0 ) {
			$title = esc_html( get_the_title( $post ) );
			
			if ( empty( $title ) )
				$title = '(no title)';
			
			return $title;
		}

		public function hooks_transition_post_status( $new_status, $old_status, $post ) {
			/** Default Vars **/
			$post_id = $post->ID;
			$post_type = ucfirst($post->post_type);
			$edit_link = get_edit_post_link( $post->ID );
			$title = $this->_draft_or_post_title( $post_id );

			if ( 'auto-draft' === $old_status && ( 'auto-draft' !== $new_status && 'inherit' !== $new_status ) ) {
				/** page created **/
				$action = 'Created';
			}
			elseif ( 'auto-draft' === $new_status || ( 'new' === $old_status && 'inherit' === $new_status ) ) {
				/** nvm.. ignore it. **/
				return;
			}
			elseif ( 'trash' === $new_status ) {
				/** page was deleted. **/
				$action = 'Trashed';
			}
			elseif ( 'trash' === $old_status ) {
				$action = 'Restored';
			}
			else {
				/** page updated. I guess. **/
				$action = 'Updated';
			}

			if ( wp_is_post_revision( $post_id ) )
				return;

			/** Skip for menu items. **/
			if ( 'nav_menu_item' === get_post_type( $post_id ) || 'aios-acitivty-logs' === get_post_type( $post_id ) )
				return;

			/** Check if cf7 **/
			if ( $post_type == 'Wpcf7_contact_form' )
				$edit_link = admin_url( 'admin.php?page=wpcf7&post=' . $post_id . '&action=edit' );

			aios_insert_activity_logs(
				array(
					'action' 		=>  $post_type . ' ' . $action,
					'activity'		=> 'ID: <strong>' . $post_id . '</strong> | Title: <a target="_blank" href="' . $edit_link .  '"><strong>' . $title .  '</strong></a>',
					'object-type'	=> 'Posts/Pages'
				)
			);
		}

		public function hooks_delete_post( $post_id ) {
			if ( wp_is_post_revision( $post_id ) )
				return;

			$post = get_post( $post_id );

			if ( in_array( $post->post_status, array( 'auto-draft', 'inherit' ) ) )
				return;

			/** Skip for menu items. **/
			if ( 'nav_menu_item' === get_post_type( $post->ID ) || 'aios-acitivty-logs' === get_post_type( $post->ID ) )
				return;

			aios_insert_activity_logs(
				array(
					'action' 		=>  ucfirst($post->post_type) . ' Deleted',
					'activity'		=> 'ID: <strong>' . $post->ID . '</strong> | Title: <a target="_blank" href="' . get_edit_post_link( $post->ID ) .  '"><strong>' . $this->_draft_or_post_title( $post->ID ) .  '</strong></a>',
					'object-type'	=> 'Posts/Pages'
				)
			);
		}

	}
}

$aios_initial_setup_Activity_Logs_Posts = new AIOS_Initial_Setup_Activity_Logs_Posts();