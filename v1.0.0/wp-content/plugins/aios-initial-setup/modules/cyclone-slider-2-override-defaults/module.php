<?php
/**
 * Name: Cyclone Slider 2 Override Defaults
 * Description: Override default settings per slides
 */

/* Define paths */
define( 'ASIS_CYCLONE_SLIDER_2_OVERRIDE_DEFAULTS', plugin_dir_path( __FILE__ ) );

/* Include required files */
require_once( ASIS_CYCLONE_SLIDER_2_OVERRIDE_DEFAULTS . DIRECTORY_SEPARATOR . 'class-aios-initial-setup-cyclone-slider-2-override-defaults.php' );

/* Hook after theme has loaded */

$aios_initial_setup_cyclone_slider_2_override_defaults = null;

function asis_cyclone_slider_2_override_defaults_init() {
	$aios_initial_setup_module_instances_object['aios_initial_setup_cyclone_slider_2_override_defaults'] = new AIOS_Initial_Setup_Cyclone_Slider_2_Override_Defaults();
}

add_action('after_setup_theme','asis_cyclone_slider_2_override_defaults_init');
