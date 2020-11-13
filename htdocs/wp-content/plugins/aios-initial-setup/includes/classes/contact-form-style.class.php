<?php
/**
 * This will initialize the plugin
 *
 * @since 2.8.6
 */
if ( !class_exists( 'aios_initial_setup_init_contact_form_style' ) ) {
	
	class aios_initial_setup_init_contact_form_style{

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
			add_action( 'wp_print_styles', array ( $this, 'initial_setup_forms' ) );
		}

		/**
		 * Enqueue scripts and styles for initial setup sub page
		 *
		 * @since 2.8.6
		 *
		 * @access public
		 */
		public function initial_setup_forms() {
			$cf7_style 			= '';
			$cf7_bg 			= get_option('cf7_bg');
			$cf7_bg_hover 		= get_option('cf7_bg_hover');
			$cf7_text 			= get_option('cf7_text');
			$cf7_text_hover 	= get_option('cf7_text_hover');
			$cf7_response_style = get_option('cf7_response_style');

			$cf7_style .= '<style>';

				$cf7_style .= '.ai-contact-wrap input.wpcf7-submit,
					.ai-default-cf7wrap input.wpcf7-submit,
					.error-forms input.wpcf7-submit {
						background: '. ( empty( $cf7_bg ) ? '#444444' : $cf7_bg ) .' !important;
						color: '. ( empty( $cf7_text ) ? '#ffffff' : $cf7_text ) .' !important;
					}
					
					.ai-contact-wrap input.wpcf7-submit:hover,
					.ai-default-cf7wrap input.wpcf7-submit:hover,
					.error-forms input.wpcf7-submit:hover {
						background: '. ( empty( $cf7_bg_hover ) ? '#444444' : $cf7_bg_hover ) .' !important;
						color: '. ( empty( $cf7_text_hover ) ? '#ffffff' : $cf7_text_hover ) .' !important;
					}';

				if ( !empty( $cf7_response_style ) ) {
					$cf7_style .= '
						div.wpcf7-response-output {
							color: ' . $cf7_response_style['text-color'] . ' !important;
							border: 2px solid ' . $cf7_response_style['border-color'] . ' !important;
						}

						div.wpcf7-mail-sent-ok {
							border: 2px solid ' . $cf7_response_style['success-border-color'] . ' !important;
						}

						div.wpcf7-mail-sent-ng,
						div.wpcf7-aborted {
							border: 2px solid ' . $cf7_response_style['border-color'] . ' !important;
						}

						div.wpcf7-spam-blocked {
							border: 2px solid ' . $cf7_response_style['spam-border-color'] . ' !important;
						}

						div.wpcf7-validation-errors,
						div.wpcf7-acceptance-missing {
							border: 2px solid ' . $cf7_response_style['error-border-color'] . ' !important;
						}

						span.wpcf7-not-valid-tip {
							color: ' . $cf7_response_style['border-color'] . ' !important;
						}

						.use-floating-validation-tip span.wpcf7-not-valid-tip {
							border: 1px solid ' . $cf7_response_style['validation-tip-border-color'] . ' !important;
							background: ' . $cf7_response_style['validation-tip-background-color'] . ' !important;
							color: ' . $cf7_response_style['validation-tip-text-color'] . ' !important;
						}';
				}

			$cf7_style .= '</style>';

			echo $cf7_style;
		}

    }
    
    $aios_initial_setup_init_contact_form_style = new aios_initial_setup_init_contact_form_style();
    
}