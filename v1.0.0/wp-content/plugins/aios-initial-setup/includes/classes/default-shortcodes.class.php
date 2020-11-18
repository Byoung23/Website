<?php
/**
 * This will initialize the plugin
 *
 * @since 3.1.8
 */
if ( !class_exists( 'aios_initial_setup_init_default_shortcodes' ) ) {
	
	class aios_initial_setup_init_default_shortcodes{

		/**
		 * Constructor
		 *
		 * @since 3.1.8
		 * @access public
		 * @return void
		 */
		public function __construct() {
			$this->add_actions();
		}

		/**
		 * Add Actions.
		 *
		 * @since 3.1.8
		 * @access protected
		 * @return void
		 */
		protected function add_actions() {
			/** This hook is called during each page load, after the theme is initialized. **/
			add_action( 'after_setup_theme', array( $this, 'init_shortcode' ), 20 );
		}

		/**
		 * Init Shortcodes after theme initialzie.
		 *
		 * @since 3.1.8
		 * @access public
		 * @return void
		 */
		public function init_shortcode() {
			/** Force to remove old shortcode and replace **/
			remove_shortcode( 'agentimage_credits' );
			add_shortcode( 'agentimage_credits', array( $this, 'credits_shortcode' ) );

			if ( !shortcode_exists('blogurl') ) {
				add_shortcode( 'blogurl', array( $this, 'get_blogurl' ) );
			}

			if ( !shortcode_exists('current_url') ) {
				add_shortcode( 'current_url', array( $this, 'get_current_url' ) );
			}

			if ( !shortcode_exists('agentimage_video') ) {
				add_shortcode( 'agentimage_video', array( $this, 'get_agentimage_video' ) ); 
			}

			if ( !shortcode_exists('aios_element') ) {
				add_shortcode( 'aios_element', array( $this, 'get_aios_element' ) );
			}

			if ( !shortcode_exists('iframe_async') ) {
				add_shortcode( 'iframe_async', array( $this, 'get_iframe_async' ) );
			} 

			if ( !shortcode_exists('mail_to') ) {
				add_shortcode( 'mail_to', array( $this, 'get_mail_to' ) );
			}

			if ( !shortcode_exists('ai_phone') ) {
				add_shortcode( 'ai_phone', array( $this, 'get_ai_phone' ) );
			}

			if ( !shortcode_exists('currentYear') ) {
				add_shortcode( 'currentYear', array( $this, 'get_currentYear' ) );
			}

			if ( !shortcode_exists('sitemap') ) {
				add_shortcode( 'sitemap', array( $this, 'get_sitemap' ) );
			}

			if ( !shortcode_exists('stylesheet_directory') ) {
				add_shortcode( 'stylesheet_directory', array( $this, 'get_stylesheet_directory' ) );
			}

			if ( !shortcode_exists('template_directory') ) {
				add_shortcode( 'template_directory', array( $this, 'get_template_directory' ) );
			}

			if ( !shortcode_exists('aios-mortgage-calculator') ) {
				add_shortcode( 'aios-mortgage-calculator', array( $this, 'mortgage_calculator_shortcode' ) );
			}
		}

		/**
		 * Return Agentimage Copyright.
		 *
		 * @since 3.1.8
		 * @access public
		 * @return string
		 */
		public function credits_shortcode( $atts ) {
		
			/** Set defaults **/
			$atts = shortcode_atts( array(
				"credits" 	=> "",
				"renew" 	=> "false",
				"seo" 		=> "false",
			), $atts, 'agentimage_credits' );

			/** If SEO is true **/
			if ( $atts['seo'] == "true" ) {
				$v_credits = "Real Estate Website Design & Internet Marketing by <a target='_blank' href='https://www.agentimage.com' style='text-decoration:underline;font-weight:bold'>Agent Image</a>";
			} else {
				if ( $atts['credits'] == ""  ) {
					$v_credits = "Real Estate Website Design by <a target='_blank' href='https://www.agentimage.com' style='text-decoration:underline;font-weight:bold'>Agent Image</a>";
				} else {
					$v_credits = $atts['credits'];
				}
			}

			/** Renew credits **/
			if ( $atts['renew'] == "true" ) delete_option('ai_starter_theme_agentimage_credits'); 
			
			/** Add credits if not yet existing **/
			add_option("ai_starter_theme_agentimage_credits",$v_credits);
			$credits = get_option("ai_starter_theme_agentimage_credits");
			
			/** Use persistent credits if existing **/
			$persistent_credits = get_option("ai_starter_theme_agentimage_credits_persistent");
			if ( $persistent_credits ) $credits = $persistent_credits;
			
			return $credits;
		}

		/**
		 * Return Domain.
		 *
		 * @since 3.1.8
		 * @access public
		 * @return string
		 */
		public function get_blogurl() {
			return home_url();
		}

		/**
		 * Return Current Page URL.
		 *
		 * @since 3.1.8
		 * @access public
		 * @return string
		 */
		public function get_current_url() {
			return home_url( add_query_arg( '_', false ) );
		}

		/**
		 * Return Iframe Video with Placeholder.
		 *
		 * @since 3.1.8
		 * @access public
		 * @return string
		 */
		public function get_agentimage_video( $atts ) {
			$args = shortcode_atts( array (
				'width'		=> 560,
				'height'	=> 315,
				'url'		=> 'https://player.vimeo.com/video/215609798'
			), $atts);
		
			$markup = "<iframe width='{$args['width']}' height='{$args['height']}' src='{$args['url']}'></iframe>";
			
			return $markup;
		}

		/**
		 * Return this return shortcode that doesn't accept by WordPress > 4.6.0.
		 *
		 * @since 3.1.8
		 * @access public
		 * @return string
		 */
		public function get_aios_element( $atts = [], $content = null ) {
			extract(shortcode_atts( array(
				'element' 			=> '',
				'class' 			=> '',
				'width'				=> '',
				'height' 			=> '',
				'style' 			=> '',
				'data-src' 			=> '',
				'data-class' 		=> '',
				'data-animation' 	=> '',
				'data-offset' 		=> ''
			), $atts));

			$class 			= !empty( $class ) 			? ' class="' . $class . '"' 					: '';
			$width 			= !empty( $width ) 			? ' width="' . $width . '"' 					: '';
			$height 		= !empty( $height ) 		? ' height="' . $height . '"' 					: '';
			$style 			= !empty( $style ) 			? ' style="' . $style . '"' 					: '';
			$dataSrc		= !empty( $dataSrc ) 		? ' data-src="' . $dataSrc . '"' 				: '';
			$dataClass		= !empty( $dataClass ) 		? ' data-class="' . $dataClass . '"' 			: '';
			$dataAnimation	= !empty( $dataAnimation ) 	? ' data-animation="' . $dataAnimation . '"' 	: '';
			$dataOffset		= !empty( $dataOffset ) 	? ' data-offset="' . $dataOffset . '"' 			: '';

			if ( !empty( $element ) ) {
				$content = '<' . $element
					. $class
					. $width
					. $height
					. $style
					. $dataSrc
					. $dataClass
					. $dataAnimation
					. $dataOffset .'>' . $content . '</' . $element . '>';
			}
			$content = str_replace( '{{blogurl}}', get_site_url(), $content );
			$content = str_replace( '{{theme_dir}}', get_stylesheet_directory_uri(), $content );
			$content = do_shortcode( $content );

			return $content;
		}

		/**
		 * Return load iframe after the page is fully loaded.
		 *
		 * @since 3.1.8
		 * @access public
		 * @return string
		 */
		public function get_iframe_async( $atts ) {
			$atts = shortcode_atts( array(
				'src' 		=> 'http://localhost/vip-clients/sallyforsterjones.com/',
				'width' 	=> 700,
				'height' 	=> 350,
				'id'		=> '',
				'class'		=> '',
				'additional'=> '' //for additional attributes
			), $atts );

			if ( $atts[ 'id' ] != '' ) {
				$atts[ 'id' ] = 'id="' . $atts[ 'id' ] . '"';
			}

			if ( $atts[ 'class' ] != '' ) {
				$atts[ 'class' ] = $atts[ 'class' ];
			}

			$iframe_output = '
				<iframe 
					websource="' . $atts[ 'src' ] . '"
					width="' . $atts[ 'width' ] . '"
					height="' . $atts[ 'height' ] . '"
					' . $atts[ 'id' ] . '
					class="aios-iframe ' . $atts[ 'class' ] . '"
					' . $atts[ 'additional' ] . '
				></iframe>
			';

			return $iframe_output;
		}

		/**
		 * Return Email Address Obfuscated.
		 *
		 * @since 3.1.8
		 * @access public
		 * @return string
		 */
		public function get_mail_to( $atts, $content = null ) {
			$atts = shortcode_atts( array(
				'email' => '',
				'class' => '',
			), $atts );

			//Do character replacements in the email address
			$obfuscated_email = str_replace('@','(at)',$atts['email']);
			$obfuscated_email = str_replace('.','(dotted)',$obfuscated_email);
			
			//Replace instances of email address with the obfuscated version in the content
			$obfuscated_content = do_shortcode( str_replace( $atts['email'], $obfuscated_email, $content ) );
			
			
			//Return output
			return '<a class="asis-mailto-obfuscated-email-hidden asis-mailto-obfuscated-email ' . $atts['class'] . '" data-value="' . $obfuscated_email . '">' . $obfuscated_content . '</a>';
		}

		/**
		 * Return Phone Number.
		 *
		 * @since 3.1.8
		 * @access public
		 * @return string
		 */
		public function get_ai_phone( $atts, $content = null ) {
			$atts = shortcode_atts( array(
                'filter'    => true,
				'href'      => '',
				'extension' => '',
			), $atts );

			if ( $atts['extension'] != "") {
				$atts['extension'] = 'data-ext="' . $atts['extension'] .'"';
            }

            if( $atts['filter'] == 'false' ) {
                $disabled_filter = 'data-filter="off"';
            }

			return '<em class="ai-mobile-phone" '.$disabled_filter.' data-href="'.$atts['href'].'" '.$atts['extension'].'>'.$content.'</em>';
		}

		/**
		 * Return Current Year.
		 *
		 * @since 3.1.8
		 * @access public
		 * @return string
		 */
		public function get_currentYear() {
			return date('Y');
		}

		/**
		 * Return list of pages using wp_list_pages().
		 *
		 * @since 3.1.8
		 * @access public
		 * @return string
		 */
		public function get_sitemap( $atts ) {
			if ( !is_array( $atts ) ) {
				$atts = array();
			}
			
			$defaults = array(
				'sort_column'=>'post_title',
				'title_li'=>''
			);
			
			$atts = array_merge( $defaults, $atts );
			$atts['echo'] = false;
			
			return '<ul class="sitemap-list">' . wp_list_pages( $atts ) . '</ul>';
		}

		/**
		 * Return Stylesheet Directory.
		 * If child this will get the child directory
		 *
		 * @since 3.1.8
		 * @access public
		 * @return string
		 */
		public function get_stylesheet_directory() {
			return get_stylesheet_directory_uri();
		}

		/**
		 * Return Template Directory / Parent Direct.
		 *
		 * @since 3.1.8
		 * @access public
		 * @return string
		 */
		public function get_template_directory() {
			return get_template_directory_uri();
		}

		/**
		 * Return Mortgage Calculator
		 *
		 * @since 3.6.4
		 * @access public
		 * @return string
		 */
		public function mortgage_calculator_shortcode( $atts ) {
			$atts = shortcode_atts( array(
				'years'		=> '',
				'interest'	=> '',
				'la'		=> '',
				'tax'		=> '',
				'insurance'	=> ''
			), $atts, 'aios-mortgage-calculator');

			return '<div class="aios-mortgage-calculator-standalone">
	<p>Owning a home is a great investment and it is key to plan your mortgage payments ahead of time. Calculate your monthly mortgage using our free calculator below.</p>
	<form action="#" method="post" enctype="application/x-www-form-urlencoded" name="temps">
		<span class="aios-mortgage-calculator-standalone-form-reminder">Required fields are marked*</span>
		
		<div class="aios-mortgage-calculator-standalone-mort-row">
			<div class="aios-mortgage-calculator-standalone-full-input">
				<label>Length of Loan Years *</label>
				<input type="text" class="aios-mortgage-calculator-standalone-loan-years aios-mortgage-calculator-standalone-number" name="YR" value="' . $atts['years'] . '">
			</div> 
			<div class="aios-mortgage-calculator-standalone-full-input">
				<label>Interest Rate (%) *</label>
				<input type="text" class="aios-mortgage-calculator-standalone-interest-rate aios-mortgage-calculator-standalone-number" name="IR" value="' . $atts['interest'] . '">
			</div>
			<div class="aios-mortgage-calculator-standalone-half-input">
				<label>Loan Amount *</label>
				<input type="text" class="aios-mortgage-calculator-standalone-loan-amount aios-mortgage-calculator-standalone-number" name="LA" value="' . $atts['la'] . '">
			</div>
			<div class="aios-mortgage-calculator-standalone-half-input">
				<label>Annual Property Tax *</label>
				<input type="text" class="aios-mortgage-calculator-standalone-property-tax aios-mortgage-calculator-standalone-number" value="' . $atts['tax'] . '" name="AT" >
			</div>
			<div class="aios-mortgage-calculator-standalone-full-input">
				<label>Annual Insurance *</label>
				<input type="text" class="aios-mortgage-calculator-standalone-annual-insurance aios-mortgage-calculator-standalone-number" name="AI" value="' . $atts['insurance'] . '">
			</div>
			<div class="aios-mortgage-calculator-standalone-mortgage-buttons">
				<div class="aios-mortgage-calculator-standalone-half-input">
					<button type="reset" class="aios-mortgage-calculator-standalone-reset" value="Reset">Reset</button>
				</div>
				<div class="aios-mortgage-calculator-standalone-half-input">
					<button type="submit" class="aios-mortgage-calculator-standalone-calculate" value="Calculate">Calculate</button>
				</div>
			</div>   
		</div> 
		<div class="aios-mortgage-calculator-standalone-calculation-result">
			<div class="aios-mortgage-calculator-standalone-mort-row">
				<div class="aios-mortgage-calculator-standalone-half-input">
					<span>Monthly Principal + Interest:</span>
				</div>
				<div class="aios-mortgage-calculator-standalone-half-input">
					<input readonly type="text" name="PI">
				</div>
				<div class="aios-mortgage-calculator-standalone-half-input">
					<span>Monthly Tax:</span>
				</div>
				<div class="aios-mortgage-calculator-standalone-half-input">
						<input readonly type="text" name="MT">
				</div>
				<div class="aios-mortgage-calculator-standalone-half-input">
					<span>Monthly Insurance:</span>
				</div>
				<div class="aios-mortgage-calculator-standalone-half-input">
						<input readonly type="text" name="MI" >
				</div>
				<div class="aios-mortgage-calculator-standalone-half-input">
					<span>Total Payment:</span>
				</div>
				<div class="aios-mortgage-calculator-standalone-half-input">
						<input readonly type="text" name="MP">
				</div>
			</div>
		</div>
	</form>
	<div class="aios-mortgage-calculator-standalone-disclaimer">
		<p>DISCLAIMER: The information found in these calculators are to be used as a guide and is deemed reliable but not guaranteed. Please schedule an appointment today to find out more information about your loan.</p>
	</div>
</div>';
		}

    }
    
    $aios_initial_setup_init_default_shortcodes = new aios_initial_setup_init_default_shortcodes();
    
}