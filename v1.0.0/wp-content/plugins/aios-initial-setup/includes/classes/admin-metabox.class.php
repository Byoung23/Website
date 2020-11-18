<?php

if ( !class_exists( 'aios_admin_metabox' ) ) {

	class aios_admin_metabox {

		/**
		 * Add Actions.
		 *
		 * @since 1.0.0
		 *
		 * @access protected
		 * @return null
		 */
		public function __construct() {
            $this->add_actions();
		}

		/**
		 * Add Actions.
		 *
		 * @since 3.1.5
		 *
		 * @access protected
		 * @return void
		 */
		protected function add_actions() {
            add_action( 'admin_init', array( $this, 'init_custom_metaboxes' ) );
        }

        /**
         * Initialize Metaboxes
         * 
         * @return null
         */
        public function init_custom_metaboxes() {
            /**
             * Metaboxes for post types
             * This will also change the layout
             */
            $aios_custom_title_post_types = get_option( 'aios-metaboxes-custom-title-post-types', [] );
            $aios_banner_post_types = get_option( 'aios-metaboxes-banner-post-types', [] );

            $aios_custom_title_post_types = ( !empty( $aios_custom_title_post_types ) ? assoc_array_flip( $aios_custom_title_post_types ) : $aios_custom_title_post_types );
            $aios_banner_post_types = ( !empty( $aios_banner_post_types ) ? assoc_array_flip( $aios_banner_post_types ) : $aios_banner_post_types );
            
            $post_type_metaboxes = array_merge_recursive( (array)$aios_custom_title_post_types, (array)$aios_banner_post_types ); /** force empty var to array */
            $post_type_metaboxes = array_filter( $post_type_metaboxes );

            if( !is_null( $post_type_metaboxes ) ) {
                foreach ( $post_type_metaboxes as $k => $v ) {
                    $is_editor_support = post_type_supports( $k, 'editor' );
                    new aios_admin_post_type_metabox( $k, (array)$v, $is_editor_support );
                }
            }
            
            /**
             * Metaboxes for taxonomies
             * This will also change the layout
             */
            $aios_custom_title_taxonomies = get_option( 'aios-metaboxes-custom-title-taxonomies', [] );
            $aios_banner_taxonomies = get_option( 'aios-metaboxes-banner-taxonomies', [] );

            $aios_custom_title_taxonomies = ( !empty( $aios_custom_title_taxonomies ) ? assoc_array_flip( $aios_custom_title_taxonomies ) : $aios_custom_title_taxonomies );
            $aios_banner_taxonomies = ( !empty( $aios_banner_taxonomies ) ? assoc_array_flip( $aios_banner_taxonomies ) : $aios_banner_taxonomies );
            
            $taxonomies_metaboxes = array_merge_recursive( (array)$aios_custom_title_taxonomies, (array)$aios_banner_taxonomies ); /** force empty var to array */
            $taxonomies_metaboxes = array_filter( $taxonomies_metaboxes );

            if( !is_null( $taxonomies_metaboxes ) ) {
                foreach ( $taxonomies_metaboxes as $k => $v ) {
                    new aios_admin_taxonomy_metabox( $k, (array)$v );
                }
            }

        }

    }

    $aios_admin_metabox = new aios_admin_metabox();

}