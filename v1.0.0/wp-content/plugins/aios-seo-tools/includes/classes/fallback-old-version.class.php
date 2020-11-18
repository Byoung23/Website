<?php 
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

if ( !class_exists( 'aios_seo_tools_fallback_old_version' ) ) {
	class aios_seo_tools_fallback_old_version {

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
			add_action( 'admin_init', array( $this, 'option_update' ) );
		}

		/**
		 * Update Options
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function option_update() {
			$is_updated = get_option( 'aios-seotools-update-old-option', false );

			/** Check if version is lower than 1.2.8 **/
			if ( $is_updated == false ) {
				$seo_option = get_option( 'aios-seotools', array() );
				if( !empty( $seo_option[ 'gtag' ] ) ) update_option( 'aios-seo-website-traffic', 'google-tag-manager' );
				update_option( 'aios-seotools-update-old-option', true );
			}
		}

	}
}

$aios_seo_tools_fallback_old_version = new aios_seo_tools_fallback_old_version();