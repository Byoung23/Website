<?php
/** Exit if accessed directly **/
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This class will return require files
 *
 * @since 3.0.9
 */

if ( !class_exists( 'AIOS_Initial_Setup_Activity_Logs_User' ) ) {
	class AIOS_Initial_Setup_Activity_Logs_User {

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
			add_action( 'wp_login', array( $this, 'hooks_wp_login' ), 10, 2 );
			add_action( 'wp_logout', array( $this, 'hooks_wp_logout' ) );
			add_action( 'delete_user', array( $this, 'hooks_delete_user' ) );
			add_action( 'user_register', array( $this, 'hooks_user_register' ) );
			add_action( 'profile_update', array( $this, 'hooks_profile_update' ) );
			add_action( 'wp_login_failed', array( $this, 'hooks_wrong_password' ) );
		}

		public function hooks_wp_login( $user_login, $user ) {
			aios_insert_activity_logs(
				array(
					'action' 		=> 'User Logged In',
					'activity'		=> 'Username: <strong>' . $user->user_login . '</strong> | Role: <strong>' . ( empty( $user->roles[0] ) ? 'No Role is Selected' : $user->roles[0] ) . '</strong>',
					'object-type'	=> 'User'
				)
			);
		}

		public function hooks_user_register( $user_id ) {
			$user = get_user_by( 'id', $user_id );

			aios_insert_activity_logs(
				array(
					'action' 		=> 'User Created',
					'activity'		=> 'Username: <strong>' . $user->user_login . '</strong> | Role: <strong>' . ( empty( $user->roles[0] ) ? 'No Role is Selected' : $user->roles[0] ) . '</strong>',
					'object-type'	=> 'User'
				)
			);
		}
		public function hooks_delete_user( $user_id ) {
			$user = get_user_by( 'id', $user_id );

			aios_insert_activity_logs(
				array(
					'action' 		=> 'User Deleted',
					'activity'		=> 'Username: <strong>' . $user->user_login . '</strong> | Role: <strong>' . ( empty( $user->roles[0] ) ? 'No Role is Selected' : $user->roles[0] ) . '</strong>',
					'object-type'	=> 'User'
				)
			);
		}

		public function hooks_wp_logout() {
			$user = wp_get_current_user();

			aios_insert_activity_logs(
				array(
					'action' 		=> 'User Logged Out',
					'activity'		=> 'Username: <strong>' . $user->user_login . '</strong> | Role: <strong>' . ( empty( $user->roles[0] ) ? 'No Role is Selected' : $user->roles[0] ) . '</strong>',
					'object-type'	=> 'User'
				)
			);
		}

		public function hooks_profile_update( $user_id ) {
			$user = get_user_by( 'id', $user_id );

			aios_insert_activity_logs(
				array(
					'action' 		=> 'User Updated',
					'activity'		=> 'Username: <strong>' . $user->user_login . '</strong> | Role: <strong>' . ( empty( $user->roles[0] ) ? 'No Role is Selected' : $user->roles[0] ) . '</strong>',
					'object-type'	=> 'User'
				)
			);
		}

		public function hooks_wrong_password( $username ) {
			if( $username == '' ) return;
			$activity = 'Someone is trying to access this user <strong>' . $username . ' with a wrong password</strong>';
			
			aios_insert_activity_logs(
				array(
					'action' 		=> 'Invalid Login',
					'activity'		=> $activity,
					'object-type'	=> 'User'
				)
			);
		}

	}
}

$aios_initial_setup_Activity_Logs_User = new AIOS_Initial_Setup_Activity_Logs_User();