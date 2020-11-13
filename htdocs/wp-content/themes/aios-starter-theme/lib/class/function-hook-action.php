<?php 
if( !class_exists( 'aios_starter_theme_hook_action' ) ) {
	
	class aios_starter_theme_hook_action {

		function __construct() {

			add_action( 'aios_starter_theme_before_inner_page_content', array( $this, 'aios_starter_theme_before_inner_page_content_action' ), 11 );
			add_filter( 'aios_starter_theme_before_inner_page_content_filter', array( $this, 'aios_starter_theme_add_breadcrumbs' ), 10 );

			add_action( 'aios_starter_theme_before_entry', array( $this, 'aios_starter_theme_before_entry_action' ), 11 );
			add_filter( 'aios_starter_theme_before_entry_filter', array( $this, 'ai_starter_theme_add_post_meta' ), 10 );

			add_action( 'aios_starter_theme_after_entry_content', array( $this, 'aios_starter_theme_after_entry_content_action' ), 11 );
			add_filter( 'aios_starter_theme_after_entry_content_filter', array( $this, 'ai_starter_theme_add_comments_section' ), 10 );

		}

		/**
		 * Display before content on innner page.
		 *
		 * @since 1.7.1
		 */
		function aios_starter_theme_before_inner_page_content_action( $content ) {

			echo apply_filters( 'aios_starter_theme_before_inner_page_content_filter', $content );

		}
		
		/**
		 * Add Yoast breadcrumbs on aios_starter_theme_before_inner_page_content_action
		 */
		function aios_starter_theme_add_breadcrumbs() {

			if ( function_exists('yoast_breadcrumb') ) {
				return yoast_breadcrumb( '<p id="breadcrumbs">','</p>', false );
			}

		}

		/**
		 * Display post meta.
		 *
		 * @since 1.7.1
		 */
		function aios_starter_theme_before_entry_action( $content ) {

			echo apply_filters( 'aios_starter_theme_before_entry_filter', $content );

		}


		/*
		 * Add post meta
		 */

		function ai_starter_theme_add_post_meta() {
			
			$output = '<p class="aios-starter-theme-entry-meta">';
				$output .= '<span class="updated">Updated on ' . date('Y-m-d') . '</span>';
				$output .= '<span class="entry-meta-separator"> | </span>';
				$output .= 'Written by <span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>';
			$output .= '</p>';

			return $output;
			
		}

		/**
		 * Display comment section on innner page.
		 *
		 * @since 1.7.1
		 */
		function aios_starter_theme_after_entry_content_action( $content ) {

			echo apply_filters( 'aios_starter_theme_after_entry_content_filter', $content );

		}

		/**
		 * Add comments section
		 */
		function ai_starter_theme_add_comments_section( $content ) {
			
			return '<div class="comments-template">' . comments_template() . '</div>';
			
		}
		
	}

	$aios_starter_theme_hook_action = new aios_starter_theme_hook_action();
}
?>