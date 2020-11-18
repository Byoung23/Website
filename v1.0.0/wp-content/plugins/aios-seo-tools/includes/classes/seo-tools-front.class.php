<?php 
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

if ( !class_exists( 'aios_seo_tools_frontend' ) ) {
	class aios_seo_tools_frontend {

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
			extract( $this->aios_seo_tools_settings );

			/** If google verification | bing verification code is not empty **/
			if ( !empty( $bing_verification_code ) || !empty( $google_verification_code ) ) {
				add_action( 'wp_head', array( $this, 'site_verification_code' ), 1 );
			}

			/** Google Services for Web Traffic **/
			if ( $google_services == 'google-analytics' ) {
				add_action( 'wp_head', array( $this, 'google_analytics' ), 500 );
			} else if ( $google_services == 'google-tag-manager' ) {
				add_filter( 'wp_head', array( $this, 'google_tag_manager_head' ), 500 );
				add_action( 'aios_seotools_gtm_body', array( $this, 'google_tag_manager_body' ) );
			} else if ( $google_services == 'google-adwords' ) {
				add_filter( 'wp_head', array( $this, 'google_adwords_tag_manager_head' ), 500 );
				add_filter( 'wp_head', array( $this, 'google_adwords_tag_manager_head_additional_code' ), 501 );
			}

			add_action( 'wp_head', array( $this, 'google_gpublisher' ), 2 );
			add_action( 'wp_footer', array( $this, 'rich_snipper_json' ) , 100 );
		}

		/**
		 * Google verification Code.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function site_verification_code() {
			extract( $this->aios_seo_tools_settings );

			$bing_verification = !empty( $bing_verification_code ) ? '<meta name="msvalidate.01" content="' . $bing_verification_code . '" />' . "\r\n" : '';
			$google_verification = !empty( $google_verification_code ) ? '<meta name="google-site-verification" content="' . $google_verification_code . '" />' . "\r\n" : '';

			$site_verification_output = "\r\n" . '<!-- BEGIN: AIOS SEO Site Verifications -->' . "\r\n";
				$site_verification_output .= $bing_verification;
				$site_verification_output .= $google_verification;
			$site_verification_output .= '<!-- END: AIOS SEO Site Verifications -->' . "\r\n";
			
			echo $site_verification_output;
		}

		/**
		 * Insert Analytics/GTM in Header.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function google_analytics() {
			extract( $this->aios_seo_tools_settings );

			if ( !empty( $google_analytics_code ) ) {
				$google_analytics_output = "<!-- BEGIN: AIOS SEO Google Analytics -->
				<script>
					(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
					 
					ga('create', '" . $google_analytics_code . "', 'auto');
					" . $google_analytics_additional_code . "
					ga('send', 'pageview');
				</script>
				<!-- END: AIOS SEO Google Analytics -->";
				
				$google_analytics_output = apply_filters( 'aios_seo_tools_google_analytics_output_filter', $google_analytics_output);
				
				echo $google_analytics_output;
			}
		}

		/**
		 * Google Tag Manager Code in Head
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function google_tag_manager_head() {
			extract( $this->aios_seo_tools_settings );

			if ( !empty( $google_tag_manager_id ) ) {
				echo '<!-- BEGIN: AIOS SEO Google Tag Manager Head Code -->
				<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':
				new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=
				\'https://www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,\'script\',\'dataLayer\',\'' . $google_tag_manager_id . '\');</script>
				<!-- END: AIOS SEO Google Tag Manager Head Code -->';
			}
		}

		/**
		 * Google Tag Manager Code in Body
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function google_tag_manager_body() {
			extract( $this->aios_seo_tools_settings );

			if ( !empty( $google_tag_manager_id ) ) {
		 		echo'<!-- BEGIN: AIOS SEO Google Tag Manager Body Code --><noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . $google_tag_manager_id . '"	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript><!-- END: AIOS SEO Google Tag Manager Body Code -->';
			}
		}

		/**
		 * Google AdWords Tag Manager Code in Head
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function google_adwords_tag_manager_head() {
			extract( $this->aios_seo_tools_settings );

			if ( !empty( $google_adwords_tag_manager_id ) ) {
				echo '<!-- BEGIN: AIOS SEO Google AdWords Tag Manager Head Code -->
				<script async src="https://www.googletagmanager.com/gtag/js?id=AW-797091247"></script>
				<script>
					window.dataLayer = window.dataLayer || [];
					function gtag(){dataLayer.push(arguments);}
					gtag(\'js\', new Date());
					gtag(\'config\', \'' . $google_adwords_tag_manager_id . '\');
				</script>
				<!-- END: AIOS SEO Google AdWords Tag Manager Head Code -->';
			}
		}

		/**
		 * Google AdWords Tag Manager Code in Head
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function google_adwords_tag_manager_head_additional_code() {
			extract( $this->aios_seo_tools_settings );
			
			if ( !empty( $google_adwords_additional_code ) ) {
				echo '<!-- BEGIN: AIOS SEO Google AdWords Tag Manager Additional Code Code -->
				<script>' . $google_adwords_additional_code . '</script>
				<!-- END: AIOS SEO Google AdWords Tag Manager Additional Code Code -->';
			}
		}

		/**
		 * Insert Rich Snippet on footer.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function rich_snipper_json() { 
			$rich_snippet 			= get_option( 'aios-seotools' );
			$rs_name_val 			= $rich_snippet['rs-name'];
			$rs_property_val 		= $rich_snippet['rs-property'];
			$rs_address_val 		= $rich_snippet['rs-address'];
			$rs_locality_val 		= $rich_snippet['rs-locality'];
			$rs_region_val 			= $rich_snippet['rs-region'];
			$rs_postal_code_val 	= $rich_snippet['rs-postal-code'];
			$rs_contact_type_val 	= $rich_snippet['rs-contact-type'];
			$rs_telephone_val 		= $rich_snippet['rs-telephone'];
			$rs_email_val 			= $rich_snippet['rs-email'];
			$rs_image_val 			= $rich_snippet['rs-photo'];
			$rs_description_val 	= $rich_snippet['rs-description'];
			$rs_reference_val 		= $rich_snippet['rs-reference'];

			$rs_geo_url_val 		= $rich_snippet['rs-geo-url'];
			$rs_geo_latitude_val 	= $rich_snippet['rs-geo-latitude'];
			$rs_geo_longitude_val 	= $rich_snippet['rs-geo-longitude'];
			$rs_openinghours_val 	= $rich_snippet['rs-opening-hours'];

			$rs_property 			= !empty( $rs_property_val ) ? "\r\n" . '"@type": "' . $rs_property_val .'"' : '';
			$rs_name 				= !empty( $rs_name_val ) ? ',' . "\r\n" . '"name": "' . $rs_name_val . '"' : ',' . "\r\n" . '"name": "' . get_bloginfo( 'name' ) . '"';
			$rs_address 			= !empty( $rs_address_val ) ? ',' . "\r\n" . '"streetAddress": "' . $rs_address_val . '"' : '';
			$rs_locality 			= !empty( $rs_locality_val ) ? ',' . "\r\n" . '"addressLocality": "' . $rs_locality_val . '"' : '';
			$rs_region 				= !empty( $rs_region_val ) ? ',' . "\r\n" . '"addressRegion": "' . $rs_region_val . '"' : '';
			$rs_postal_code 		= !empty( $rs_postal_code_val ) ? ',' . "\r\n" . '"postalCode": "' . $rs_postal_code_val . '"' : '';
			$rs_email 				= !empty( $rs_email_val ) ? ',' . "\r\n" . '"email": "' . $rs_email_val . '"' : '';
			$rs_image 				= !empty( $rs_image_val ) ? ',' . "\r\n" . '"image": "' . $rs_image_val . '"' : '';
			$rs_description 		= !empty( $rs_description_val ) ? ',' . "\r\n" . '"description": "' . $rs_description_val . '"' : '';
			$rs_telephone 			= !empty( $rs_telephone_val ) ? ',' . "\r\n" . '"contactPoint": { "@type": "ContactPoint",' . "\r\n" . '"telephone": "' . $rs_telephone_val . '",' . "\r\n" . '"contactType": "' . $rs_contact_type_val . '"' . "\r\n" . "}" : '';
			$rs_telephone_property 	= !empty( $rs_telephone_val ) ? ',' . "\r\n" . '"telephone": "' . $rs_telephone_val . '"' : '';
			$rs_reference 			= explode( "\n" , $rs_reference_val );

			$rs_gmapshorturl 		= !empty( $rs_geo_url_val ) ? ',' . "\r\n" . '"hasMap": "' . $rs_geo_url_val . '"' : '';
			// $rs_geo_location 		= !empty( $rs_geo_latitude_val || $rs_geo_longitude_val ) ?  ',' . "\r\n" . '"geo": {' . '"@type": "GeoCoordinates",' . "\r\n" . '"latitude": "' . $rs_geo_latitude_val . '",' . "\r\n" . '"longitude": "' . $rs_geo_longitude_val . '"' . "\r\n" . '}' : '';
			$rs_geo_location 		= '';

			$rs_openinghours 		= !empty( $rs_openinghours_val ) ? ',' . "\r\n" . '"openingHours": "' . $rs_openinghours_val . '"' : '';

			$ldjson = '';
				$ldjson .= '
				<!-- BEGIN: AIOS SEO Rich Snipper Data Structured -->
				<script type="application/ld+json">
				    {
				    	"@context": "http://schema.org", ' . $rs_property . $rs_name . ',
				    	"url": "' . get_bloginfo( 'url' ) . '",
				    	"priceRange" : "$$$"';
				    if ( !empty( $rs_address_val ) || !empty( $rs_locality_val ) || !empty( $rs_region_val ) || !empty( $rs_postal_code_val ) ) {
				    	$ldjson .= ',' . "\r\n" . '"address": {
				    		"@type": "PostalAddress"'
				    		. $rs_address . $rs_locality . $rs_region . $rs_postal_code .
				    	'}';
			    	}
				    if ( $rs_property_val != 'Organization' ) {
				    	$ldjson .= $rs_openinghours . $rs_gmapshorturl .  $rs_geo_location;
				    }
				    $ldjson .= $rs_description . $rs_email . $rs_image . $rs_telephone . $rs_telephone_property;
				    if ( !empty( $rs_reference_val ) ) {
				    	$ldjson .= ',"sameAs" : [';
		    			$i = 0;
			    		$len = count( $rs_reference );
			    		foreach ( $rs_reference as $siteRef ) {
			    			$siteRef = str_replace( array( "\r", "\n" ) , '', $siteRef );
			    			if ( $i == 0 ) {
			    				$ldjson .= '"' . $siteRef . '"';
			    			} else {
			    				$ldjson .= ', "' . $siteRef . '"';
			    			}
			    			$i++;
			    		}
			    		$ldjson .= ']' . "\r\n";
				    }
				$ldjson .= '
					}
			</script>
			<!-- END: AIOS SEO Rich Snipper Data Structured -->' . "\r\n";

			echo $ldjson;
		}

		/**
		 * Insert link rel=publisher.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function google_gpublisher() {
			extract( $this->aios_seo_tools_settings );

			if( !empty( $google_plus_publisher ) ) echo '<!-- AIOS Google Publisher -->' . "\r\n" . '<link rel="publisher" href="' . $google_plus_publisher . '">' . "\r\n" . '<!-- End AIOS Google Publisher -->' . "\r\n";
		}

	}
}

$aios_seo_tools_frontend = new aios_seo_tools_frontend();