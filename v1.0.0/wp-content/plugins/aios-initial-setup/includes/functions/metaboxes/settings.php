<!-- Added: Version 3.9.8 -->
<?php 
    $aios_metaboxes_banner_title_layout = get_option( 'aios-metaboxes-banner-title-layout', '' );
	$aios_custom_title_post_types = get_option( 'aios-metaboxes-custom-title-post-types', array() );
	$aios_custom_title_taxonomies = get_option( 'aios-metaboxes-custom-title-taxonomies', array() );
    $aios_banner_not_found = get_option( 'aios-metaboxes-banner-not-found', '' );
    $aios_banner_post_types = get_option( 'aios-metaboxes-banner-post-types', array() );
	$aios_banner_taxonomies = get_option( 'aios-metaboxes-banner-taxonomies', array() );
    $aios_default_banner = get_option( 'aios-metaboxes-default-banner-image', '' );
    $aios_default_banner_size = get_option( 'aios-metaboxes-default-banner-size', '' );

	/** Exclude the ff. post type */
	$post_type_exclude = array(
		'aios-listings',
		'aios-testimonials',
		'aios-agents'
	);

	/** Display all post type exclude builtin but added post and page */
	$post_types_arr = array(
		'post' 	=> 'Posts',
		'page' 	=> 'Pages'
	);
	$post_types_args = array( 'public' => true, '_builtin' => false);
	$post_types_output = 'objects'; /** 'names' or 'objects' (default: 'names') */
	$post_types_operator = 'and'; /** 'and' or 'or' (default: 'and') */
	$post_types = get_post_types( $post_types_args, $post_types_output, $post_types_operator );
	foreach( $post_types as $post_type ) {
		if( !in_array( $post_type->name, $post_type_exclude ) ) {
			$post_types_arr[$post_type->name] = $post_type->label;
		}
	}

	/** Exclude the ff. taxonomies */
	$taxonomies_exclude = array();

	/** Get all taxonomy */
	$taxonomies_arr = array(
		'category' => 'Categories'
	);
	$taxonomies_args = array( 'public' => true, '_builtin' => false);
	$taxonomies_output = 'objects'; /** 'names' or 'objects' (default: 'names') */
	$taxonomies_operator = 'and'; /** 'and' or 'or' (default: 'and') */
	$taxonomies = get_taxonomies( $taxonomies_args, $taxonomies_output, $taxonomies_operator );
	foreach( $taxonomies as $taxonomy ) {
		if ( !in_array( $taxonomy->name, $taxonomies_exclude ) ) {
			$taxonomies_arr[$taxonomy->name] = $taxonomy->label;
		}
	}
?>
<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p>
			<span class="wpui-settings-title">Custom Title</span>
			Note: <em>Add custom title in post type that consist of 3 fields.</em>
		</p>
	</div>
	<div class="wpui-col-md-9">
		<?php
			echo AIOS_CREATE_FIELDS::input_field( array(
				'row'			=> false,
				'label' 		=> true,
				'label_value' 	=> 'Title Layout',
				'name'			=> 'aios-metaboxes-banner-title-layout',
				'options'		=> array( 'Inside Banner' ),
				'value'			=> ( isset( $aios_metaboxes_banner_title_layout ) ? $aios_metaboxes_banner_title_layout : '' ),
				'type' 			=> 'checkbox'
            ) );
            
			echo AIOS_CREATE_FIELDS::input_field( array(
				'row'			=> false,
				'label' 		=> true,
				'label_value' 	=> 'Select post type to display',
				'name'			=> 'aios-metaboxes-custom-title-post-types[title]',
				'options'		=> $post_types_arr,
				'value'			=> ( isset( $aios_custom_title_post_types['title'] ) ? $aios_custom_title_post_types['title'] : '' ),
				'type' 			=> 'checkbox'
			) );
			
			echo AIOS_CREATE_FIELDS::input_field( array(
				'row'			=> false,
				'label' 		=> true,
				'label_value' 	=> 'Select taxonomy to display',
				'name'			=> 'aios-metaboxes-custom-title-taxonomies[title]',
				'options'		=> $taxonomies_arr,
				'value'			=> ( isset( $aios_custom_title_taxonomies['title'] ) ? $aios_custom_title_taxonomies['title'] : '' ),
				'type' 			=> 'checkbox'
			) );
        ?>
        <!-- BEGIN: Filler(save data for one checkbox) -->
        <div class="form-checkbox-group wpui-temporary-hide">
            <div class="form-checkbox">
                <label><input type="checkbox" name="aios-metaboxes-custom-title-taxonomies[title][asiowpfiller]" id="aios-metaboxes-custom-title-taxonomies[title][asiowpfiller]" value="asiowpfiller" checked="checked"> <span style="font-weight: 400">Categories</span></label>
            </div>
            <div class="form-checkbox">
                <label><input type="checkbox" name="aios-metaboxes-custom-title-taxonomies[title][asiowpfiller]" id="aios-metaboxes-custom-title-taxonomies[title][asiowpfiller]" value="asiowpfiller" checked="checked"> <span style="font-weight: 400">Categories</span></label>
            </div>
        </div>
        <!-- END: Filler -->
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p>
			<span class="wpui-settings-title">Banner</span>
			Note: <em>Add custom banner uploader.</em>
		</p>
	</div>
	<div class="wpui-col-md-9">
        <?php
			echo AIOS_CREATE_FIELDS::input_field( array(
				'row'			=> false,
				'label' 		=> true,
				'label_value' 	=> 'Display to 404 Page',
				'name'			=> 'aios-metaboxes-banner-not-found',
				'options'		=> array( '404 Pages' ),
				'value'			=> ( isset( $aios_banner_not_found ) ? $aios_banner_not_found : '' ),
				'type' 			=> 'checkbox'
			) );
        
			echo AIOS_CREATE_FIELDS::input_field( array(
				'row'			=> false,
				'label' 		=> true,
				'label_value' 	=> 'Select post type to display',
				'name'			=> 'aios-metaboxes-banner-post-types[banner]',
				'options'		=> $post_types_arr,
				'value'			=> ( isset( $aios_banner_post_types['banner'] ) ? $aios_banner_post_types['banner'] : '' ),
				'type' 			=> 'checkbox'
			) );
			
			echo AIOS_CREATE_FIELDS::input_field( array(
				'row'			=> false,
				'label' 		=> true,
				'label_value' 	=> 'Select taxonomy to display',
				'name'			=> 'aios-metaboxes-banner-taxonomies[banner]',
				'options'		=> $taxonomies_arr,
				'value'			=> ( isset( $aios_banner_taxonomies['banner'] ) ? $aios_banner_taxonomies['banner'] : '' ),
				'type' 			=> 'checkbox'
            ) );

            /**
             * Get all the registered image sizes along with their dimensions
             *
             * @global array $_wp_additional_image_sizes
             * @return array $image_sizes The image sizes
             */
            function _get_all_image_sizes() {
                global $_wp_additional_image_sizes;

                $default_image_sizes = get_intermediate_image_sizes();

                foreach ( $default_image_sizes as $size ) {
                    $image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
                    $image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
                    $image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
                }

                if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
                    $image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
                }

                return $image_sizes;
            }

            $image_sizes = [];
            foreach ( _get_all_image_sizes() as $k => $v ) $image_sizes[$k] = $k . ' - ' . $v['width'] . 'x' . $v['height'];
            
            echo AIOS_CREATE_FIELDS::select( array(
                'row'               => false,
				'label' 			=> true,
				'label_value' 		=> 'Banner Size',
				'name' 				=> 'aios-metaboxes-default-banner-size',
				'is_name_array' 	=> false,
				'options' 			=> $image_sizes,
				'value' 			=> $aios_default_banner_size,
				'placeholder' 		=> 'Default Full',
            ) );
            
            echo AIOS_CREATE_FIELDS::image_upload( array(
                'row'               => false,
				'label' 		    => true,
				'label_value' 	    => 'Default Banner Image',
				'name' 			    => 'aios-metaboxes-default-banner-image',
				'value' 		    => $aios_default_banner,
				'upload_text' 		=> 'Upload Banner',
				'remove_text' 		=> 'Remove',
				'type' 				=> 'image',
				'title' 			=> 'Media Gallery',
				'button_text' 		=> 'Select',
				'filter_page_text' 	=> 'All',
				'no_image' 			=> 'No image upload'
            ) );
        ?>
        <!-- BEGIN: Filler(save data for one checkbox) -->
        <div class="form-checkbox-group wpui-temporary-hide">
            <div class="form-checkbox">
                <label><input type="checkbox" name="aios-metaboxes-banner-taxonomies[banner][asiowpfiller]" id="aios-metaboxes-banner-taxonomies[banner][asiowpfiller]" value="asiowpfiller" checked="checked"> <span style="font-weight: 400">Categories</span></label>
            </div>
        </div>
        <!-- END: Filler -->
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Submit Button -->
<div class="wpui-row wpui-row-submit">
	<div class="wpui-col-md-12">
		<div class="form-group">
			<input type="submit" class="save-option-ajax wpui-secondary-button text-uppercase" value="Save Changes">
		</div>
	</div>
</div>
<!-- END: Submit Button -->