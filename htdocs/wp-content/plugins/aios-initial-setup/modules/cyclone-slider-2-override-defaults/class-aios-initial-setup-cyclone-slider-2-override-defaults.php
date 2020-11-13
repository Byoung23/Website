<?php

class AIOS_Initial_Setup_Cyclone_Slider_2_Override_Defaults {
	
	function __construct() {
		
		add_filter('cycloneslider_get_slider_settings', array( $this, 'cycloneslider_get_slider_settings_filter') );
		
	}

	/*
	 * Set default invidividual slider settings
	 */
	function cycloneslider_get_slider_settings_filter($slider_settings) {
		
		global $post;
		
		$meta = get_post_custom( $post->post_id );
		
		$key = '_cycloneslider_metas';
		$saved_settings = array();
		if ( isset( $meta[ $key ][0] ) and ! empty( $meta[ $key ][0] ) ) {
			$saved_settings = maybe_unserialize( $meta[ $key ][0] );
		}
		
		if ( empty( $saved_settings ) ) {
			
			/* Set width management to 'full' by default */
			$slider_settings['width_management'] = 'full';
			
		}
		
		return $slider_settings;

	}

}