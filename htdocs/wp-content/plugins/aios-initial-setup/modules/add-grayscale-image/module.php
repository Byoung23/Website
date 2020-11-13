<?php

class AIOS_Initial_Setup_Add_Grayscale_Image {
	
	function __construct() {
		
		if ( get_option('aios_initial_setup_add_grayscale_image') == 'true' ) {
			add_action('after_setup_theme',array($this,'setup_image_size'));
			add_filter('wp_generate_attachment_metadata',array($this,'grayscale_filter'));
		}
		
	}

	function setup_image_size() {
		add_image_size('aios-initial-setup-grayscale-image', 17, 1, true);
	}

	function grayscale_filter($meta) {
		try {
			$file = wp_upload_dir();
			
			$destination_file = trailingslashit($file['path']).$meta['sizes']['aios-initial-setup-grayscale-image']['file'];
			$source_file = $file['basedir'].'/'.$meta['file']; 
			
			list($orig_w, $orig_h, $orig_type) = @getimagesize($source_file);
			
			/* 	Make sure that the grayscale image doesn't collide with the original image.
				If it does, abort. */
			
			if ( $orig_w === 17 and $orig_h === 1 ) { return $meta; }
			
			$image = wp_load_image($source_file);
			imagefilter($image, IMG_FILTER_GRAYSCALE);
			
			switch ($orig_type) {
				case IMAGETYPE_GIF:
					imagegif( $image, $destination_file );
					break;
				case IMAGETYPE_PNG:
					imagepng( $image, $destination_file );
					break;
				case IMAGETYPE_JPEG:
					imagejpeg( $image, $destination_file );
					break;
			}
			
			return $meta;
		}
		catch (Exception $e) {
			return $meta;
		}
	}

	
}

$aios_initial_setup_module_instances_object['aios_initial_setup_add_grayscale_image_module'] = new AIOS_Initial_Setup_Add_Grayscale_Image();

