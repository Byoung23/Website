<?php

//Define constants

if ( !defined('AIOS_MOBILE_HEADER_DIRECTORY') ) {
	define('AIOS_MOBILE_HEADER_DIRECTORY',dirname(__FILE__) . DIRECTORY_SEPARATOR);
}

if(!defined('AIOS_MOBILE_HEADER_URL')){
	define('AIOS_MOBILE_HEADER_URL', plugin_dir_url(__FILE__) );
}

if (!defined('AIOS_MOBILE_HEADER_THEME_LOCATIONS')) {
	define('AIOS_MOBILE_HEADER_THEME_LOCATIONS', serialize( array (
		AIOS_MOBILE_HEADER_DIRECTORY . 'views' . DIRECTORY_SEPARATOR . 'frontend'
	)));
}

//Include classes

include ( AIOS_MOBILE_HEADER_DIRECTORY . 'models/class-aios-mobile-header-theme.php' );
include ( AIOS_MOBILE_HEADER_DIRECTORY . 'models/class-aios-mobile-header-theme-manager.php' );
include ( AIOS_MOBILE_HEADER_DIRECTORY . 'models/class-aios-mobile-header-menu.php' );
include ( AIOS_MOBILE_HEADER_DIRECTORY . 'controllers/class-aios-mobile-header-widget.php' );
include ( AIOS_MOBILE_HEADER_DIRECTORY . 'controllers/class-aios-mobile-header-controller.php' );

//Run plugin

new AIOS_Mobile_Header_Controller();
