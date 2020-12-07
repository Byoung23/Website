<?php

/* Define paths */
define( 'ASIS_SIMPLEPIE_FILTERS_DIR', plugin_dir_path( __FILE__ ) );

/* Include required files */
require_once( ABSPATH . WPINC . '/class-simplepie.php' );
require_once( ASIS_SIMPLEPIE_FILTERS_DIR . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'class-asis-simplepie-parser-main.php' );
require_once( ASIS_SIMPLEPIE_FILTERS_DIR . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'class-asis-simplepie-parser.php' );

/* Init module */
$aios_initial_setup_module_instances_object['aios_initial_setup_simplepie_filters_module'] = new AIOS_Initial_Setup_SimplePie_Main();