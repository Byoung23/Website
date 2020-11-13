<?php
/** HELPER for Front End */

/**
 * Check if Custom Metabox Banner is Enabled
 * 
 * @param $obj - this need to be a queried object
 * @return boolen
 */
function is_custom_field_banner( $obj ) {
    /** Check if from 404 page */
    $aios_banner_not_found = get_option( 'aios-metaboxes-banner-not-found', '' );
    if( $aios_banner_not_found == '404 Pages' && is_404() ) return true;

    if( !is_object( $obj ) ) return false; /** Check if obj is object, only post type and taxonomy will return object */

    /** Get Object Type then return false if empty */
    $object_type = !is_null( $obj->post_type ) ? $obj->post_type : ( !is_null( $obj->taxonomy ) ? $obj->taxonomy : '' );
    if( !empty( $object_type ) ) { 
        $aios_banner_post_types = get_option( 'aios-metaboxes-banner-post-types', [] );
        $aios_banner_taxonomies = get_option( 'aios-metaboxes-banner-taxonomies', [] );
    
        $aios_banner_post_types = ( !empty( $aios_banner_post_types ) ? assoc_array_flip( $aios_banner_post_types ) : $aios_banner_post_types );
        $aios_banner_taxonomies = ( !empty( $aios_banner_taxonomies ) ? assoc_array_flip( $aios_banner_taxonomies ) : $aios_banner_taxonomies );
    
        $banner_metaboxes = array_merge_recursive( (array)$aios_banner_post_types, (array)$aios_banner_taxonomies ); /** force empty var to array */
        $banner_metaboxes = array_filter( (array) $banner_metaboxes );
        
        if( array_key_exists( $object_type, $banner_metaboxes ) ) return true;
    }

    return false;
}