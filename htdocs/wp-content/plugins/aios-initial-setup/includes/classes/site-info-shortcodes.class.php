<?php
/**
 * This will initialize the plugin
 *
 * @since 2.8.6
 */
if ( !class_exists( 'aios_initial_setup_init_contact_info_shortcodes' ) ) {
	
	class aios_initial_setup_init_contact_info_shortcodes{

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
			add_action( 'admin_head',  						array( $this, 'show_favicon' ), 1 );
			add_action( 'wp_head',  						array( $this, 'show_favicon' ), 1 );

			add_shortcode( 'ai_client_logo', 				array( $this, 'get_ai_client_logo' ), 10 );
			add_shortcode( 'ai_client_ip_logo', 			array( $this, 'get_ai_client_ip_logo' ), 10 );
			add_shortcode( 'ai_client_photo', 				array( $this, 'get_ai_client_photo' ), 10 );
			add_shortcode( 'ai_client_name', 				array( $this, 'get_ai_client_name' ), 10 );
			add_shortcode( 'ai_client_address', 			array( $this, 'get_ai_client_address' ), 10 );
			add_shortcode( 'ai_client_email', 				array( $this, 'get_ai_client_email' ), 10 );
			add_shortcode( 'ai_client_phone', 				array( $this, 'get_ai_client_phone' ), 10 );
			add_shortcode( 'ai_client_cell', 				array( $this, 'get_ai_client_cell' ), 10 );
			add_shortcode( 'ai_client_fax', 				array( $this, 'get_ai_client_fax' ), 10 );
			add_shortcode( 'ai_client_email_text',			array( $this, 'get_ai_client_email_text' ), 10 );
			add_shortcode( 'ai_client_phone_text',			array( $this, 'get_ai_client_phone_text' ), 10 );
			add_shortcode( 'ai_client_cell_text',			array( $this, 'get_ai_client_cell_text' ), 10 );
			add_shortcode( 'ai_client_fax_text',			array( $this, 'get_ai_client_fax_text' ), 10 );
			add_shortcode( 'ai_client_facebook', 			array( $this, 'get_ai_client_facebook' ), 10 );
			add_shortcode( 'ai_client_twitter', 			array( $this, 'get_ai_client_twitter' ), 10 );
			add_shortcode( 'ai_client_google_plus', 		array( $this, 'get_ai_client_google_plus' ), 10 );
			add_shortcode( 'ai_client_linkedin', 			array( $this, 'get_ai_client_linkedin' ), 10 );
			add_shortcode( 'ai_client_youtube', 			array( $this, 'get_ai_client_youtube' ), 10 );
			add_shortcode( 'ai_client_instagram', 			array( $this, 'get_ai_client_instagram' ), 10 );
			add_shortcode( 'ai_client_pinterest', 			array( $this, 'get_ai_client_pinterest' ), 10 );
			add_shortcode( 'ai_client_trulia', 				array( $this, 'get_ai_client_trulia' ), 10 );
			add_shortcode( 'ai_client_zillow', 				array( $this, 'get_ai_client_zillow' ), 10 );
			add_shortcode( 'ai_client_houzz', 				array( $this, 'get_ai_client_houzz' ), 10 );
			add_shortcode( 'ai_client_blogger', 			array( $this, 'get_ai_client_blogger' ), 10 );
			add_shortcode( 'ai_client_yelp', 				array( $this, 'get_ai_client_yelp' ), 10 );
			add_shortcode( 'ai_client_skype', 				array( $this, 'get_ai_client_skype' ), 10 );
			add_shortcode( 'ai_client_caimeiju', 			array( $this, 'get_ai_client_caimeiju' ), 10 );
			add_shortcode( 'ai_client_rss', 				array( $this, 'get_ai_client_rss' ), 10 );
			add_shortcode( 'ai_client_partner_photo', 		array( $this, 'get_ai_client_partner_photo' ), 10 );
			add_shortcode( 'ai_client_partner_name', 		array( $this, 'get_ai_client_partner_name' ), 10 );
			add_shortcode( 'ai_client_partner_address',		array( $this, 'get_ai_client_partner_address' ), 10 );
			add_shortcode( 'ai_client_partner_email', 		array( $this, 'get_ai_client_partner_email' ), 10 );
			add_shortcode( 'ai_client_partner_phone', 		array( $this, 'get_ai_client_partner_phone' ), 10 );
			add_shortcode( 'ai_client_partner_cell', 		array( $this, 'get_ai_client_partner_cell' ), 10 );
			add_shortcode( 'ai_client_partner_fax', 		array( $this, 'get_ai_client_partner_fax' ), 10 );
			add_shortcode( 'ai_client_partner_email_text',	array( $this, 'get_ai_client_partner_email_text' ), 10 );
			add_shortcode( 'ai_client_partner_phone_text',	array( $this, 'get_ai_client_partner_phone_text' ), 10 );
			add_shortcode( 'ai_client_partner_cell_text',	array( $this, 'get_ai_client_partner_cell_text' ), 10 );
			add_shortcode( 'ai_client_partner_fax_text',	array( $this, 'get_ai_client_partner_fax_text' ), 10 );
			add_shortcode( 'ai_client_partner_facebook', 	array( $this, 'get_ai_client_partner_facebook' ), 10 );
			add_shortcode( 'ai_client_partner_twitter', 	array( $this, 'get_ai_client_partner_twitter' ), 10 );
			add_shortcode( 'ai_client_partner_google_plus',	array( $this, 'get_ai_client_partner_google_plus' ), 10 );
			add_shortcode( 'ai_client_partner_linkedin', 	array( $this, 'get_ai_client_partner_linkedin' ), 10 );
			add_shortcode( 'ai_client_partner_youtube', 	array( $this, 'get_ai_client_partner_youtube' ), 10 );
			add_shortcode( 'ai_client_partner_instagram', 	array( $this, 'get_ai_client_partner_instagram' ), 10 );
			add_shortcode( 'ai_client_partner_pinterest', 	array( $this, 'get_ai_client_partner_pinterest' ), 10 );
			add_shortcode( 'ai_client_partner_trulia', 		array( $this, 'get_ai_client_partner_trulia' ), 10 );
			add_shortcode( 'ai_client_partner_zillow', 		array( $this, 'get_ai_client_partner_zillow' ), 10 );
			add_shortcode( 'ai_client_partner_houzz', 		array( $this, 'get_ai_client_partner_houzz' ), 10 );
			add_shortcode( 'ai_client_partner_blogger', 	array( $this, 'get_ai_client_partner_blogger' ), 10 );
			add_shortcode( 'ai_client_partner_yelp', 		array( $this, 'get_ai_client_partner_yelp' ), 10 );
			add_shortcode( 'ai_client_partner_skype', 		array( $this, 'get_ai_client_partner_skype' ), 10 );
			add_shortcode( 'ai_client_partner_caimeiju', 	array( $this, 'get_ai_client_partner_caimeiju' ), 10 );
			add_shortcode( 'ai_client_partner_rss', 		array( $this, 'get_ai_client_partner_rss' ), 10 );
		}

		/**
		 * Enqueue scripts and styles for initial setup sub page
		 *
		 * @since 3.0.1
		 *
		 * @access public
		 */
		public function show_favicon() {
			$aiis_ci = get_option( 'aiis_ci' );
			$favicon = ( isset( $aiis_ci['favicon'] ) ? $aiis_ci['favicon'] : '' );
			if ( !empty( $favicon ) ) echo str_replace( '[stylesheet_directory]', get_stylesheet_directory_uri(), stripslashes( $favicon ) );
		}


		/**
		 * ai_client_logo
		 *
		 * @access public
		 */
		public function get_ai_client_logo() {
			return get_option( 'aiis_ci' )[ 'logo' ];
		}

		/**
		 * ai_client_ip_logo
		 *
		 * @access public
		 */
		public function get_ai_client_ip_logo() {
			return get_option( 'aiis_ci' )[ 'ip-logo' ];
		}

		/**
		 * ai_client_photo
		 *
		 * @access public
		 */
		public function get_ai_client_photo() {
			return get_option( 'aiis_ci' )[ 'photo' ];
		}

		/**
		 * ai_client_name
		 *
		 * @access public
		 */
		public function get_ai_client_name() {
			return get_option( 'aiis_ci' )[ 'name' ];
		}

		/**
		 * ai_client_address
		 *
		 * @access public
		 */
		public function get_ai_client_address() {
			return get_option( 'aiis_ci' )[ 'address' ];
		}

		/**
		 * ai_client_email
		 *
		 * @access public
		 */
		public function get_ai_client_email( $atts,  $content = null ) {
			$atts = shortcode_atts( array(
				'class' => ''
			), $atts );

			$emailAdd = get_option( 'aiis_ci' )[ 'email' ];

			/** Do character replacements in the email address **/
			$obfuscated_email = str_replace( '@', '(at)', $emailAdd );
			$obfuscated_email = str_replace( '.', '(dotted)', $obfuscated_email );
			
			/** Replace instances of {default-email} with the obfuscated version in the content **/
			$obfuscated_content = do_shortcode( str_replace( '{default-email}', $obfuscated_email, $content ) );			
			
			/** Return output **/
			return '<a class="asis-mailto-obfuscated-email ' . $atts['class'] . '" data-value="' . $obfuscated_email . '" href="#">' . $obfuscated_content . '</a>';
		}

		/**
		 * ai_client_phone
		 *
		 * @access public
		 */
		public function get_ai_client_phone( $atts, $content = null ) {
			$pnumber = get_option( 'aiis_ci' )[ 'phone' ];

			if( strpos( $content, '{default-phone}' ) !== false ) {
				/** Replace instances of {default-phone} with the obfuscated version in the content **/
				$content = str_replace( '{default-phone}', $pnumber, $content );
				$output = '<em class="ai-mobile-phone" data-href="' . $pnumber . '">' . $content . '</span></em>';
			} else {
				$output = '<em class="ai-mobile-phone" data-href="' . $pnumber . '">' . $content . '<span class="mobile-number client-phone">' . $pnumber . '</span></em>';
			}

			return $output;
		}

		/**
		 * ai_client_cell
		 *
		 * @access public
		 */
		public function get_ai_client_cell( $atts, $content = null ) {
			$cnumber = get_option( 'aiis_ci' )[ 'cell' ];

			if( strpos( $content, '{default-cell}' ) !== false ) {
				/** Replace instances of {default-cell} with the obfuscated version in the content **/
				$content = str_replace( '{default-cell}', $cnumber, $content );
				$output = '<em class="ai-mobile-phone" data-href="' . $cnumber . '">' . $content . '</span></em>';
			} else {
				$output = '<em class="ai-mobile-phone" data-href="' . $cnumber . '">' . $content . '<span class="mobile-number client-cell">' . $cnumber . '</span></em>';
			}

			return $output;
		}

		/**
		 * ai_client_fax
		 *
		 * @access public
		 */
		public function get_ai_client_fax( $atts, $content = null ) {
			$faxnumber = get_option( 'aiis_ci' )[ 'fax' ];

			if( strpos( $content, '{default-fax}' ) !== false ) {
				/** Replace instances of {default-fax} with the obfuscated version in the content **/
				$content = str_replace( '{default-fax}', $faxnumber, $content );
				$output = '<em class="ai-mobile-phone" data-href="' . $faxnumber . '">' . $content . '</span></em>';
			} else {
				$output = '<em class="ai-mobile-phone" data-href="' . $faxnumber . '">' . $content . '<span class="mobile-number client-fax">' . $faxnumber . '</span></em>';
			}

			return $output;
		}

		/**
		 * ai_client_email_text - Text Only
		 *
		 * @access public
		 */
		public function get_ai_client_email_text() {
			return get_option( 'aiis_ci' )[ 'email' ];
		}

		/**
		 * ai_client_phone_text - Text Only
		 *
		 * @access public
		 */
		public function get_ai_client_phone_text() {
			return get_option( 'aiis_ci' )[ 'phone' ];
		}

		/**
		 * ai_client_cell_text - Text Only
		 *
		 * @access public
		 */
		public function get_ai_client_cell_text() {
			return get_option( 'aiis_ci' )[ 'cell' ];
		}

		/**
		 * ai_client_fax_text - Text Only
		 *
		 * @access public
		 */
		public function get_ai_client_fax_text() {
			return  get_option( 'aiis_ci' )[ 'fax' ];
		}

		/**
		 * ai_client_facebook
		 *
		 * @access public
		 */
		public function get_ai_client_facebook() {
			return get_option( 'aiis_ci' )[ 'facebook' ];
		}

		/**
		 * ai_client_twitter
		 *
		 * @access public
		 */
		public function get_ai_client_twitter() {
			return get_option( 'aiis_ci' )[ 'twitter' ];
		}

		/**
		 * ai_client_google_plus
		 *
		 * @access public
		 */
		public function get_ai_client_google_plus() {
			return get_option( 'aiis_ci' )[ 'google-plus' ];
		}

		/**
		 * ai_client_linkedin
		 *
		 * @access public
		 */
		public function get_ai_client_linkedin() {
			return get_option( 'aiis_ci' )[ 'linkedin' ];
		}

		/**
		 * ai_client_youtube
		 *
		 * @access public
		 */
		public function get_ai_client_youtube() {
			return get_option( 'aiis_ci' )[ 'youtube' ];
		}

		/**
		 * ai_client_instagram
		 *
		 * @access public
		 */
		public function get_ai_client_instagram() {
			return get_option( 'aiis_ci' )[ 'instagram' ];
		}

		/**
		 * ai_client_pinterest
		 *
		 * @access public
		 */
		public function get_ai_client_pinterest() {
			return get_option( 'aiis_ci' )[ 'pinterest' ];
		}

		/**
		 * ai_client_trulia
		 *
		 * @access public
		 */
		public function get_ai_client_trulia() {
			return get_option( 'aiis_ci' )[ 'trulia' ];
		}

		/**
		 * ai_client_zillow
		 *
		 * @access public
		 */
		public function get_ai_client_zillow() {
			return get_option( 'aiis_ci' )[ 'zillow' ];
		}

		/**
		 * ai_client_houzz
		 *
		 * @access public
		 */
		public function get_ai_client_houzz() {
			return get_option( 'aiis_ci' )[ 'houzz' ];
		}

		/**
		 * ai_client_blogger
		 *
		 * @access public
		 */
		public function get_ai_client_blogger() {
			return get_option( 'aiis_ci' )[ 'blogger' ];
		}

		/**
		 * ai_client_yelp
		 *
		 * @access public
		 */
		public function get_ai_client_yelp() {
			return get_option( 'aiis_ci' )[ 'yelp' ];
		}

		/**
		 * ai_client_skype
		 *
		 * @access public
		 */
		public function get_ai_client_skype() {
			return get_option( 'aiis_ci' )[ 'skype' ];
		}

		/**
		 * ai_client_caimeiju
		 *
		 * @access public
		 */
		public function get_ai_client_caimeiju() {
			return get_option( 'aiis_ci' )[ 'caimeiju' ];
		}

		/**
		 * ai_client_rss
		 *
		 * @access public
		 */
		public function get_ai_client_rss() {
			return get_option( 'aiis_ci' )[ 'rss' ];
		}

		/**
		 * ai_client_partner_photo
		 *
		 * @access public
		 */
		public function get_ai_client_partner_photo() {
			return get_option( 'aiis_ci' )[ 'partner-photo' ];
		}

		/**
		 * ai_client_partner_name
		 *
		 * @access public
		 */
		public function get_ai_client_partner_name() {
			return get_option( 'aiis_ci' )[ 'partner-name' ];
		}

		/**
		 * ai_client_partner_address
		 *
		 * @access public
		 */
		public function get_ai_client_partner_address() {
			return get_option( 'aiis_ci' )[ 'partner-address' ];
		}

		/**
		 * ai_client_partner_email
		 *
		 * @access public
		 */
		public function get_ai_client_partner_email( $atts,  $content = null ) {
			$atts = shortcode_atts( array(
				'class' => ''
			), $atts );

			/** Do character replacements in the email address **/
			$obfuscated_email = str_replace( '@', '(at)', get_option( 'aiis_ci' )[ 'partner-email' ] );
			$obfuscated_email = str_replace( '.', '(dotted)', $obfuscated_email );
			
			/** Replace instances of email address with the obfuscated version in the content **/
			$obfuscated_content = do_shortcode( str_replace( '{default-email}', $obfuscated_email, $content ) );			
			
			/** Return output **/
			return '<a class="asis-mailto-obfuscated-email ' . $atts['class'] . '" data-value="' . $obfuscated_email . '" href="#">' . $obfuscated_content . '</a>';
		}

		/**
		 * ai_client_partner_phone
		 *
		 * @access public
		 */
		public function get_ai_client_partner_phone( $atts, $content = null ) {
			$pnumber = get_option( 'aiis_ci' )[ 'partner-phone' ];

			if( strpos( $content, '{default-phone}' ) !== false ) {
				/** Replace instances of {default-phone} with the obfuscated version in the content **/
				$content = str_replace( '{default-phone}', $pnumber, $content );
				$output = '<em class="ai-mobile-phone" data-href="' . $pnumber . '">' . $content . '</span></em>';
			} else {
				$output = '<em class="ai-mobile-phone" data-href="' . $pnumber . '">' . $content . '<span class="mobile-number client-fax-phone">' . $pnumber . '</span></em>';
			}

			return $output;
		}

		/**
		 * ai_client_partner_cell
		 *
		 * @access public
		 */
		public function get_ai_client_partner_cell( $atts, $content = null ) {
			$cnumber = get_option( 'aiis_ci' )[ 'partner-cell' ];

			if( strpos( $content, '{default-cell}' ) !== false ) {
				/** Replace instances of {default-cell} with the obfuscated version in the content **/
				$content = str_replace( '{default-cell}', $cnumber, $content );
				$output = '<em class="ai-mobile-phone" data-href="' . $cnumber . '">' . $content . '</span></em>';
			} else {
				$output = '<em class="ai-mobile-phone" data-href="' . $cnumber . '">' . $content . '<span class="mobile-number client-fax-cell">' . $cnumber . '</span></em>';
			}

			return $output;
		}

		/**
		 * ai_client_partner_fax
		 *
		 * @access public
		 */
		public function get_ai_client_partner_fax( $atts, $content = null ) {
			$faxnumber = get_option( 'aiis_ci' )[ 'partner-fax' ];

			if( strpos( $content, '{default-fax}' ) !== false ) {
				/** Replace instances of {default-fax} with the obfuscated version in the content **/
				$content = str_replace( '{default-fax}', $faxnumber, $content );
				$output = '<em class="ai-mobile-phone" data-href="' . $faxnumber . '">' . $content . '</span></em>';
			} else {
				$output = '<em class="ai-mobile-phone" data-href="' . $faxnumber . '">' . $content . '<span class="mobile-number client-fax-fax">' . $faxnumber . '</span></em>';
			}

			return $output;
		}

		/**
		 * ai_client_partner_email_text - Text Only
		 *
		 * @access public
		 */
		public function get_ai_client_partner_email_text() {
			return get_option( 'aiis_ci' )[ 'partner-email' ];
		}

		/**
		 * ai_client_partner_phone_text - Text Only
		 *
		 * @access public
		 */
		public function get_ai_client_partner_phone_text() {
			return get_option( 'aiis_ci' )[ 'partner-phone' ];
		}

		/**
		 * ai_client_partner_cell_text - Text Only
		 *
		 * @access public
		 */
		public function get_ai_client_partner_cell_text() {
			return get_option( 'aiis_ci' )[ 'partner-cell' ];
		}

		/**
		 * ai_client_partner_fax_text - Text Only
		 *
		 * @access public
		 */
		public function get_ai_client_partner_fax_text() {
			return get_option( 'aiis_ci' )[ 'partner-fax' ];
		}

		/**
		 * ai_client_partner_facebook
		 *
		 * @access public
		 */
		public function get_ai_client_partner_facebook() {
			return get_option( 'aiis_ci' )[ 'partner-facebook' ];
		}

		/**
		 * ai_client_partner_twitter
		 *
		 * @access public
		 */
		public function get_ai_client_partner_twitter() {
			return get_option( 'aiis_ci' )[ 'partner-twitter' ];
		}

		/**
		 * ai_client_partner_google_plus
		 *
		 * @access public
		 */
		public function get_ai_client_partner_google_plus() {
			return get_option( 'aiis_ci' )[ 'partner-google-plus' ];
		}

		/**
		 * ai_client_partner_linkedin
		 *
		 * @access public
		 */
		public function get_ai_client_partner_linkedin() {
			return get_option( 'aiis_ci' )[ 'partner-linkedin' ];
		}

		/**
		 * ai_client_partner_youtube
		 *
		 * @access public
		 */
		public function get_ai_client_partner_youtube() {
			return get_option( 'aiis_ci' )[ 'partner-youtube' ];
		}

		/**
		 * ai_client_partner_instagram
		 *
		 * @access public
		 */
		public function get_ai_client_partner_instagram() {
			return get_option( 'aiis_ci' )[ 'partner-instagram' ];
		}

		/**
		 * ai_client_partner_pinterest
		 *
		 * @access public
		 */
		public function get_ai_client_partner_pinterest() {
			return get_option( 'aiis_ci' )[ 'partner-pinterest' ];
		}

		/**
		 * ai_client_partner_trulia
		 *
		 * @access public
		 */
		public function get_ai_client_partner_trulia() {
			return get_option( 'aiis_ci' )[ 'partner-trulia' ];
		}

		/**
		 * ai_client_partner_zillow
		 *
		 * @access public
		 */
		public function get_ai_client_partner_zillow() {
			return get_option( 'aiis_ci' )[ 'partner-zillow' ];
		}

		/**
		 * ai_client_partner_houzz
		 *
		 * @access public
		 */
		public function get_ai_client_partner_houzz() {
			return get_option( 'aiis_ci' )[ 'partner-houzz' ];
		}

		/**
		 * ai_client_partner_blogger
		 *
		 * @access public
		 */
		public function get_ai_client_partner_blogger() {
			return get_option( 'aiis_ci' )[ 'partner-blogger' ];
		}

		/**
		 * ai_client_partner_yelp
		 *
		 * @access public
		 */
		public function get_ai_client_partner_yelp() {
			return get_option( 'aiis_ci' )[ 'partner-yelp' ];
		}

		/**
		 * ai_client_partner_skype
		 *
		 * @access public
		 */
		public function get_ai_client_partner_skype() {
			return get_option( 'aiis_ci' )[ 'partner-skype' ];
		}

		/**
		 * ai_client_partner_caimeiju
		 *
		 * @access public
		 */
		public function get_ai_client_partner_caimeiju() {
			return get_option( 'aiis_ci' )[ 'partner-caimeiju' ];
		}

		/**
		 * ai_client_partner_rss
		 *
		 * @access public
		 */
		public function get_ai_client_partner_rss() {
			return get_option( 'aiis_ci' )[ 'partner-rss' ];		
		}

	}

	$aios_initial_setup_init_contact_info_shortcodes = new aios_initial_setup_init_contact_info_shortcodes();
	
}