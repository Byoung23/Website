<?php
/**
 * Listings Settings
 *
 * @return void
 */
if ( !class_exists( 'aios_seo_tools_options' ) ) {

	class aios_seo_tools_options {

		/**
		 * Prevent undefined varible when saving empty data
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 * @return array
		 */
		public static function options(){
			$seo_option 		= get_option( 'aios-seotools', array() );
			$google_services 	= get_option( 'aios-seo-website-traffic', '' );

			return array(
				'google_services' 					=> ( !empty( $google_services ) ? $google_services : 'google-analytics' ),
				'google_verification_code' 			=> ( isset( $seo_option[ 'google-verification' ] ) ? $seo_option[ 'google-verification' ] : '' ),
				'console_account_used' 				=> ( isset( $seo_option[ 'console-account-used' ] ) ? $seo_option[ 'console-account-used' ] : '' ),
				'google_analytics_code' 			=> ( isset( $seo_option[ 'ga-tracking-code' ] ) ? $seo_option[ 'ga-tracking-code' ] : '' ),
				'ga_account_used' 					=> ( isset( $seo_option[ 'ga-account-used' ] ) ? $seo_option[ 'ga-account-used' ] : '' ),
				'google_analytics_additional_code' 	=> ( isset( $seo_option[ 'ga-additional-code' ] ) ? wp_unslash( $seo_option[ 'ga-additional-code' ] ) : '' ),
				'google_tag_manager_id' 			=> ( isset( $seo_option[ 'gtag-id' ] ) ? $seo_option[ 'gtag-id' ] : '' ),
				'gtag_account_used' 				=> ( isset( $seo_option[ 'gtag-account-used' ] ) ? $seo_option[ 'gtag-account-used' ] : '' ),
				'google_adwords_tag_manager_id' 	=> ( isset( $seo_option[ 'adwords-id' ] ) ? $seo_option[ 'adwords-id' ] : '' ),
				'adwords_account_used' 				=> ( isset( $seo_option[ 'adwords-account-used' ] ) ? $seo_option[ 'adwords-account-used' ] : '' ),
				'google_adwords_conversion_string'	=> ( isset( $seo_option[ 'adwords-conversion-string' ] ) ? $seo_option[ 'adwords-conversion-string' ] : '' ),
				'google_adwords_additional_code' 	=> ( isset( $seo_option[ 'adwords-additional-code' ] ) ? wp_unslash( $seo_option[ 'adwords-additional-code' ] ) : '' ),
				'google_plus_publisher' 			=> ( isset( $seo_option[ 'google-plus-publisher' ] ) ? $seo_option[ 'google-plus-publisher' ] : '' ),
				'bing_verification_code' 			=> ( isset( $seo_option[ 'bing-verification' ] ) ? $seo_option[ 'bing-verification' ] : '' ),
				'rs_property' 						=> ( isset( $seo_option[ 'rs-property' ] ) ? $seo_option[ 'rs-property' ] : '' ),
				'rs_name' 							=> ( isset( $seo_option[ 'rs-name' ] ) ? $seo_option[ 'rs-name' ] : '' ),
				'rs_address' 						=> ( isset( $seo_option[ 'rs-address' ] ) ? $seo_option[ 'rs-address' ] : '' ),
				'rs_locality' 						=> ( isset( $seo_option[ 'rs-locality' ] ) ? $seo_option[ 'rs-locality' ] : '' ),
				'rs_region' 						=> ( isset( $seo_option[ 'rs-region' ] ) ? $seo_option[ 'rs-region' ] : '' ),
				'rs_postal_code' 					=> ( isset( $seo_option[ 'rs-postal-code' ] ) ? $seo_option[ 'rs-postal-code' ] : '' ),
				'rs_contact_type' 					=> ( isset( $seo_option[ 'rs-contact-type' ] ) ? $seo_option[ 'rs-contact-type' ] : '' ),
				'rs_telephone' 						=> ( isset( $seo_option[ 'rs-telephone' ] ) ? $seo_option[ 'rs-telephone' ] : '' ),
				'rs_email' 							=> ( isset( $seo_option[ 'rs-email' ] ) ? $seo_option[ 'rs-email' ] : '' ),
				'rs_reference' 						=> ( isset( $seo_option[ 'rs-reference' ] ) ? $seo_option[ 'rs-reference' ] : '' ),
				'rs_description' 					=> ( isset( $seo_option[ 'rs-description' ] ) ? $seo_option[ 'rs-description' ] : '' ),
				'rs_photo' 							=> ( isset( $seo_option[ 'rs-photo' ] ) ? $seo_option[ 'rs-photo' ] : '' ),
				'rs_geo_url' 						=> ( isset( $seo_option[ 'rs-geo-url' ] ) ? $seo_option[ 'rs-geo-url' ] : '' ),
				'rs_geo_latitude' 					=> ( isset( $seo_option[ 'rs-geo-latitude' ] ) ? $seo_option[ 'rs-geo-latitude' ] : '' ),
				'rs_geo_longitude' 					=> ( isset( $seo_option[ 'rs-geo-longitude' ] ) ? $seo_option[ 'rs-geo-longitude' ] : '' ),
				'rs_opening_hours' 					=> ( isset( $seo_option[ 'rs-opening-hours' ] ) ? $seo_option[ 'rs-opening-hours' ] : '' )
			);
		}
	}

}