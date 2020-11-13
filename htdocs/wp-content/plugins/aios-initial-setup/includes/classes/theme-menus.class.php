<?php
/**
 * This will initialize the plugin
 *
 * @since 3.2.8
 */
if ( !class_exists( 'aios_initial_setup_theme_menus' ) ) {
	
	class aios_initial_setup_theme_menus{

		/**
		 * Constructor
		 *
		 * @since 3.2.8
		 *
		 * @access public
		 */
		public function __construct() {
			$this->add_actions();
		}

		/**
		 * Add Actions.
		 *
		 * @since 3.2.8
		 *
		 * @access protected
		 */
		protected function add_actions() {
			add_filter( 'walker_nav_menu_start_el', array( $this, 'allow_shortcode_nav' ), 20, 2 );
		}

		/**
		 * Check if the passed content has any shortcode. Inspired from the
		 * core's has_shortcode.
		 *
		 * @since 3.2.8
		 * @access public
		 *
		 * @param string $content The content to check for shortcode.
		 *
		 * @return boolean Returns true if the $content has shortcode, false otherwise.
		 */
		public function has_shortcode( $content ) {

			if ( false !== strpos( $content, '[' ) ) {

				preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );

				if ( ! empty( $matches ) ) {
					return true;
				}
			}
			return false;
		}

		/**
		 * Modifies the menu item display on frontend.
		 *
		 * @since 3.2.8
		 *
		 * @param string $item_output The original html.
		 * @param object $item  The menu item being displayed.
		 *
		 * @return string Modified menu item to display.
		 */
		public function allow_shortcode_nav( $item_output, $item ) {

			if ( $this->has_shortcode( $item_output ) ) {
				$item_output = do_shortcode( preg_replace( '/(https?:\/\/)/', '',  $item_output ) );
			}

			return $item_output;
		}
	}

	// $aios_initial_setup_theme_menus = new aios_initial_setup_theme_menus();

}