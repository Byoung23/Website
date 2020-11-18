<?php
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

if ( !class_exists( 'cf7_google_analytics_tracking' ) ) {
	class cf7_google_analytics_tracking {

		/**
		 * List of Options
		 */
		private $aios_seo_tools_settings;

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function __construct() {
			/** List of Options **/
			$aios_seo_tools_options 		= new aios_seo_tools_options();
			$this->aios_seo_tools_settings 	= $aios_seo_tools_options->options();

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
			add_filter( 'wpcf7_form_elements', array( $this, 'wpcf7_ga_form_elements' ) );
		}

		/**
		 * Additional script for conversion.
		 *
		 * @since 1.0.0
		 *
		 * @access protected
		 */
		public function wpcf7_ga_form_elements( $form ) {
			extract( $this->aios_seo_tools_settings );

			$id = WPCF7_ContactForm::get_current()->id;
			$reg = "/(| )\(Auto-generated .*?\)/";
			$title = WPCF7_ContactForm::get_current()->title;
			$title = preg_replace( $reg, '', $title );

			/** Google Services for Web Traffic **/
			if ( $google_services == 'google-analytics' ) {
				$form = $form 
					. '<script>
						$formid = 0;
						jQuery( \'.wpcf7-form input[type="submit"]\' ).on( \'click\', function() {
							$formid = jQuery( this ).parents( \'form.wpcf7-form\' ).find( \'input[name=_wpcf7]\' ).val();
						} );
						document.addEventListener( \'wpcf7mailsent\', function( event ) {
							if ( \'' . $id . '\' == $formid ) {
								ga( \'send\', \'event\', \'Contact Form\', \'submit\', \'' . $title . '\' );
							}
						}, false );
					</script>';
			} else if ( $google_services == 'google-tag-manager' ) {
				$form = $form 
					. '<script>
					$formid = 0;
					jQuery( \'.wpcf7-form input[type="submit"]\' ).on( \'click\', function() {
						$formid = jQuery( this ).parents( \'form.wpcf7-form\' ).find( \'input[name=_wpcf7]\' ).val();
					} );
					document.addEventListener( \'wpcf7mailsent\', function( event ) {
						if ( \'' . $id . '\' == $formid ) {
							gtag( \'event\', \'send\', { 
								\'event_category\' : \'Contact Form\', 
								\'event_action\' : \'submit\', 
								\'event_label\' : \'' . $title . '\' 
							} );
						}
					}, false );
				</script>';
			} else if ( $google_services == 'google-adwords' ) {
				if ( empty( $google_adwords_conversion_string ) ) {
					$form = $form . '<script>You selected AdWords as your Google Services for Tracking Web Traffic, please make sure you add AdWords Conversion String for Tracking Conversion.</script>';
				} else {
					$form = $form 
						. '<script>
						$formid = 0;
						jQuery( \'.wpcf7-form input[type="submit"]\' ).on( \'click\', function() {
							$formid = jQuery( this ).parents( \'form.wpcf7-form\' ).find( \'input[name=_wpcf7]\' ).val();
						} );
						document.addEventListener( \'wpcf7mailsent\', function( event ) {
							if ( \'' . $id . '\' == $formid ) {
								gtag(
									\'event\', 
									\'conversion\', 
									{
										\'send_to\': \'' . $google_adwords_conversion_string . '\'
									}
								);
						}, false );
					</script>';
				}
			}
			return $form;
		}

	}
}

$cf7_google_analytics_tracking = new cf7_google_analytics_tracking();