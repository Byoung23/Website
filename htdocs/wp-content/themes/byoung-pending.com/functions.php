<?php
/*
 * Register sidebars
 */
function register_ai_child_starter_theme_sidebars() {
	
	register_sidebar(array( 
	   'name' => 'Get Connected',
	   'id'=>'get_connected',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'Subscribe to Our Newsletter',
	   'id'=>'ston',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'Header Logo',
	   'id'=>'hdr_logo',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'Header Button',
	   'id'=>'hdr_btn',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'HP Slideshow',
	   'id'=>'hp_slide',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'HP Quick Search',
	   'id'=>'hp_qs',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'HP Call To Action',
	   'id'=>'hp_cta',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'HP Welcome Text',
	   'id'=>'hp_welc',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'HP Agent Photo 1',
	   'id'=>'hp_ap1',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'HP Areas of Expertise',
	   'id'=>'hp_aoe',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'HP Featured Communities',
	   'id'=>'hp_fc',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'HP Featured Properties',
	   'id'=>'hp_fp',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'HP Testimonials',
	   'id'=>'hp_testi',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'HP Agent Photo 2',
	   'id'=>'hp_ap2',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'Footer Get In Touch',
	   'id'=>'ftr_git',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));

    register_sidebar(array( 
	   'name' => 'Footer Logo',
	   'id'=>'ftr_logo',
	   'before_widget' => '',
	   'after_widget' => '',
	   'before_title' => '',
	   'after_title' => ''
    ));
	
}

add_action( 'widgets_init', 'register_ai_child_starter_theme_sidebars', 11 );

/*
 * Enqueue theme styles and scripts
 */
function ai_starter_theme_enqueue_child_assets() {
	
	/* Enqueue my scripts */
	wp_enqueue_script('aios-starter-theme-child-script', get_stylesheet_directory_uri(). '/js/scripts.js');


	/* Enqueue my styles */
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i');
	
}

add_action( 'wp_enqueue_scripts', 'ai_starter_theme_enqueue_child_assets', 11 );
add_action( 'wp_enqueue_scripts', 'ai_starter_theme_remove_media_queries_from_child_stylesheet', 13 );

/*
 * Add custom data attributes to menu items
 */
function ai_starter_theme_add_menu_link_attributes( $atts, $item, $args ) {
	$atts['data-title'] = $item->title;
	return $atts;
}

add_filter( 'nav_menu_link_attributes', 'ai_starter_theme_add_menu_link_attributes', 10, 3 );

/*
 * Add image sizes
 */
//add_image_size('cyclone-slide', 1024, 768, true);
 
/*
 * Define content width
 */
if ( ! isset( $content_width ) ) {
	$content_width = 960;
}

/**
 * Register all the modules included on the module directory
 */
add_action( 'after_setup_theme', 'modules_require' );
function modules_require() {
    $modules = glob( plugin_dir_path( __FILE__ ) . 'modules/' . '*' , GLOB_ONLYDIR );

    if( $modules ) {
        foreach( $modules as $module ) {
            if( file_exists( $module . '/module.php' ) ) {
                require_once( $module . '/module.php' );
            }
        }
    }
}