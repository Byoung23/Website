<?php

class AIOS_Mobile_Header_Controller {
	
	protected $_theme_manager;
	
	function __construct() {
		
		/* Initialize theme manager */
		$this->_theme_manager = new AIOS_Mobile_Header_Theme_Manager();
		
		/* Add actions */
		add_action( 'widgets_init', array( $this,'initialize_widget' ) );
		
		/* @since Since 2.1.5, scripts are enqueued in wp_footer() to become compatible with iHomefinder Eureka */
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ), 9999 );
		
	}
	
	function initialize_widget() {	
		
		/* Register widget */
		
		register_widget( 'AIOS_Mobile_Header_Widget' );
		
		/* Use 977 as the default breakpoint if plugin is upgraded */
		
		$widgets = get_option( 'widget_aios-mobile-header' );
		
		if ( is_array( $widgets ) ) {
			foreach( $widgets as &$widget ) {
				if ( isset( $widget['theme'] ) && !isset ( $widget['breakpoint'] ) ) {
					$widget['breakpoint'] = 977;
				}
			}
		}
		
		update_option('widget_aios-mobile-header',$widgets);
		
	}
	
	function enqueue_assets() {
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'aios-mobile-header-widget-navigation', AIOS_MOBILE_HEADER_URL. '/views/lib/js/aios-mobile-header-navigation.js', array(), false, true );
		wp_enqueue_script( 'aios-mobile-header-main', AIOS_MOBILE_HEADER_URL. '/views/lib/js/aios-mobile-header.js', array(), false, true );
		
		wp_enqueue_style( 'aios-mobile-header-lato', "https://fonts.googleapis.com/css?family=Lato:400,700");
		wp_enqueue_style( 'aios-mobile-header-main', AIOS_MOBILE_HEADER_URL . '/views/lib/css/style.css');
		wp_enqueue_style( 'aios-mobile-header-main-print', AIOS_MOBILE_HEADER_URL . '/views/lib/css/style-print.css', array(), false, 'print');
		
		wp_enqueue_style("agentimage-font", "https://cdn.thedesignpeople.net/agentimage-font/fonts/agentimage.font.icons.css");
		
		/* Enqueue theme styles */
		
		$this->_theme_manager->enqueue_styles();
		
	}
	
}