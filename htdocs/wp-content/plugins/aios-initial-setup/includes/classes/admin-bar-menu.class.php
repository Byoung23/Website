<?php
/**
 * This will replace admin bar menu
 *
 * @since 2.8.6
 */
if ( !class_exists( 'aios_initial_setup_init_admin_bar_menu' ) ) {
	
	class aios_initial_setup_init_admin_bar_menu{

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
			add_filter( 'admin_bar_menu', array( $this, 'custom_admin_bar_menu'), 11 );
		}

		/**
		 * This will replace Howdy on the top right side.
		 *
		 * @since 2.8.5
		 *
		 * @access public
		 */	
		public function custom_admin_bar_menu( $wp_admin_bar ) {
			$user_id 		= get_current_user_id();
			$current_user 	= wp_get_current_user();
			$profile_url 	= get_edit_profile_url( $user_id );

			if ( 0 != $user_id ) {
				$avatar = get_avatar( $user_id, 28 );
				$howdy = 'You are logged in as ' . $current_user->display_name;
				$class = empty( $avatar ) ? '' : 'with-avatar';
				 
				$wp_admin_bar->add_menu( array(
					'id' => 'my-account',
					'parent' => 'top-secondary',
					'title' => $howdy . $avatar,
					'href' => $profile_url,
					'meta' => array(
						'class' => $class
					)
				) );
			}
		}

	}
	
	$aios_initial_setup_init_admin_bar_menu = new aios_initial_setup_init_admin_bar_menu();
}