<?php
if ( !class_exists( 'aios_seo_tools_config' ) ) {

	class aios_seo_tools_config {
		/**
		 * Option Tabs.
		 *
		 * @since 1.2.4
		 *
		 * @access public
		 */
		public function asis_options( $tabs = array() ) {
			$tabs = array(
				'' => array(
					'url' 		=> 'google',
					'title' 	=> 'Google',
					'child' 	=> array(
						array(
							'url' 		=> 'services',
							'title' 	=> 'Services',
							'function'	=> 'google/services.php'
						),
						array(
							'url' 		=> 'search-console',
							'title' 	=> 'Search Console',
							'function'	=> 'google/search-console.php'
						),
						array(
							'url' 		=> 'analytics',
							'title' 	=> 'Analytics',
							'function'	=> 'google/analytics.php'
						),
						array(
							'url' 		=> 'tag-manager',
							'title' 	=> 'Tag Manager',
							'function'	=> 'google/tag-manager.php'
						),
						array(
							'url' 		=> 'adwords-tag-manager',
							'title' 	=> 'AdWords Tag Manager',
							'function'	=> 'google/adwords-tag-manager.php'
						),
						array(
							'url' 		=> 'google-publisher',
							'title' 	=> 'Google Publisher',
							'function'	=> 'google/google-publisher.php'
						)
					)
				),
				'bing' => array(
					'url' 		=> 'bing',
					'title' 	=> 'Bing',
					'function'	=> 'bing/bing.php'
				),
				'schema-markup' => array(
					'url' 		=> 'schema-markup',
					'title' 	=> 'Schema Markup',
					'child' 	=> array(
						array(
							'url' 		=> 'basic',
							'title' 	=> 'Basic',
							'function'	=> 'rich-snippet/basic.php'
						),
						array(
							'url' 		=> 'map',
							'title' 	=> 'Map',
							'function'	=> 'rich-snippet/map.php'
						),
						array(
							'url' 		=> 'open-hours',
							'title' 	=> 'Open Hours',
							'function'	=> 'rich-snippet/open-hours.php'
						)
					)
				)
			);

			return array_filter( $tabs );
		}
	}

}