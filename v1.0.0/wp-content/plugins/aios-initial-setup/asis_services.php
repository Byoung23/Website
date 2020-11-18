<?php
/**
 * Load all required files for services before anything else
 * @since 4.1.0
 */
$directory_name = 'includes/services';
$path = trailingslashit( AIOS_INITIAL_SETUP_DIR . DIRECTORY_SEPARATOR . $directory_name );
$file_names = glob( $path . '*.php' );
foreach ( $file_names as $filename ) {
	if ( file_exists( $filename ) ) require_once $filename;
}