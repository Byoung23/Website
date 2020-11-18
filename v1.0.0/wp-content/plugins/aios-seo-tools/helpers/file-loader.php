<?php

/**
 * This class will return require files
 */
if ( !class_exists( 'aios_seo_file_loader' ) ) {
	
	class aios_seo_file_loader {
		
		/**
		 * Loads all PHP files in a given directory.
		 *
		 * @param string $directory_name
		 * @access public
		 */
		public function load_directory( $directory_name ) {
			$path = trailingslashit( SEOTOOLS_SETUP_DIR . DIRECTORY_SEPARATOR . $directory_name );
			$file_names = glob( $path . '*.php' );
			foreach ( $file_names as $filename ) {
				if ( file_exists( $filename ) ) {
					require_once $filename;
				}
			}
		}

		/**
		 * Loads specified PHP files from the plugin includes directory.
		 *
		 * @param array $file_names The names of the files to be loaded in the includes directory.
		 * @access public
		 */
		public function load_files( $file_names = array() ) {
			foreach ( $file_names as $file_name ) {
				if ( file_exists( $path = SEOTOOLS_SETUP_DIR . DIRECTORY_SEPARATOR . $file_name . '.php' ) ) {
					require_once $path;
				}
			}

		}

	}

}

?>