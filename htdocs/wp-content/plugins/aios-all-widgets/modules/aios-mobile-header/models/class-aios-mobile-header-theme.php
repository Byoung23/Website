<?php

class AIOS_Mobile_Header_Theme {
	
	protected $_theme_name;
	
	function __construct( $theme_name ) {
		
		$this->_theme_name = $theme_name;
		
	}
	
	function get_url() {

		$url = str_replace(AIOS_MOBILE_HEADER_DIRECTORY, AIOS_MOBILE_HEADER_URL, $this->get_full_path());
		$url = str_replace("\\","/",$url);
		
		return $url;
		
	}
	
	function get_full_path() {
		
		$theme_locations = unserialize(AIOS_MOBILE_HEADER_THEME_LOCATIONS);
		
		foreach ( $theme_locations as $location ) {
			
			if ( !file_exists( $location ) ) { continue; }
			
			$contents = preg_grep('/^([^.])/', scandir( $location ));
			
			foreach ( $contents as $content ) {
				
				$full_dir_path = $location . DIRECTORY_SEPARATOR . $content;
				
				if ( is_dir( $full_dir_path ) ) {
					
					if ( $content == $this->_theme_name ) {
						return $full_dir_path;
					}
					
				}
				
			}
			
		}
		
		return false;
		
	}
	
}