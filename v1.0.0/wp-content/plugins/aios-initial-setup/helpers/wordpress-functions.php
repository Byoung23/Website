<?php

/**
 * This file contains functions for backwards compatibility.
 */

/**
* Whether a registered shortcode exists named $tag
*
* @since 3.6.0
*
* @global array $shortcode_tags List of shortcode tags and their callback hooks.
*
* @param string $tag Shortcode tag to check.
* @return bool Whether the given shortcode exists.
*/
if ( !function_exists('shortcode_exists') ) {
	function shortcode_exists( $tag ) {
		global $shortcode_tags;
		return array_key_exists( $tag, $shortcode_tags );
	}
}
/** 
 * Check if value is in assoc array
 */
function is_in_array($array, $key, $key_value){
	$within_array = 'no';
	foreach( $array as $k => $v ){
		if( is_array($v) ){
			$within_array = is_in_array( $v, $key, $key_value );
			if( $within_array == 'yes' ){
				break;
			}
		} else {
			if( $v == $key_value && $k == $key ){
				$within_array = 'yes';
				break;
			}
		}
	}
	return $within_array;
}

/** 
 * Flip array this is not same for the array_flip
 * This will make the associative array from value to key and vice versa
 */
if ( !function_exists( 'assoc_array_flip' ) ) {
	function assoc_array_flip( $a ) {
		if( is_string( $a ) ) return;
		$new = [];
		foreach ($a as $k => $v) {
			foreach( $v as $sv ) {
				$new[$sv] = $k;
			}
		}
		return $new;
	}
}

/** 
 * Check if array is recursive or assoc
 */
if ( !function_exists( 'is_assoc_array' ) ) {
	function is_assoc_array(array $array) {
		if( array_keys($array) !== range(0, count($array) - 1) )
			return true;
		return false;
	}
}

if( !function_exists( 'get_image_sizes' ) ) {
	/**
	 * Get size information for all currently-registered image sizes.
	 *
	 * @global $_wp_additional_image_sizes
	 * @uses   get_intermediate_image_sizes()
	 * @return array $sizes Data for all currently-registered image sizes.
	 */
	function get_image_sizes() {
		global $_wp_additional_image_sizes;

		$sizes = array();

		foreach ( get_intermediate_image_sizes() as $_size ) {
			if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
				$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
				$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
				$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}

		return $sizes;
	}

	/**
	 * Get size information for a specific image size.
	 *
	 * @uses   get_image_sizes()
	 * @param  string $size The image size for which to retrieve data.
	 * @return bool|array $size Size data about an image size or false if the size doesn't exist.
	 */
	function get_image_size( $size ) {
		$sizes = get_image_sizes();

		if ( isset( $sizes[ $size ] ) ) {
			return $sizes[ $size ];
		}

		return false;
	}

	/**
	 * Get the width of a specific image size.
	 *
	 * @uses   get_image_size()
	 * @param  string $size The image size for which to retrieve data.
	 * @return bool|string $size Width of an image size or false if the size doesn't exist.
	 */
	function get_image_width( $size ) {
		if ( ! $size = get_image_size( $size ) ) {
			return false;
		}

		if ( isset( $size['width'] ) ) {
			return $size['width'];
		}

		return false;
	}

	/**
	 * Get the height of a specific image size.
	 *
	 * @uses   get_image_size()
	 * @param  string $size The image size for which to retrieve data.
	 * @return bool|string $size Height of an image size or false if the size doesn't exist.
	 */
	function get_image_height( $size ) {
		if ( ! $size = get_image_size( $size ) ) {
			return false;
		}

		if ( isset( $size['height'] ) ) {
			return $size['height'];
		}

		return false;
	}

	/**
	 * Lists all sizes in UL
	 *
	 * @uses   get_image_size()
	 * @param  string $size The image size for which to retrieve data.
	 * @return string output as lists.
	 */
	function get_image_sizes_output() {
		$sizes = get_image_sizes();
		$html = '<ul>';
		foreach ($sizes as $k => $v) {
			$html .= '<li>
				<strong>' . $k . '</strong> (
				Width: ' . $v['width'] . ' | 
				Height: ' . $v['height'] . ' | 
				Crop: ' . ( $v['crop'] == 1 ? 'true' : 'false' ) . ')
			</li>';
		}
		$html .= '</ul>';

		return $html;
	}
}

/**
 * Recursively removes a folder along with all its files and directories
 * 
 * @param String $path 
 */
function rrmdir($path) {
	// Open the source directory to read in files
	$i = new DirectoryIterator($path);
	foreach($i as $f) {
		if($f->isFile()) {
			unlink($f->getRealPath());
		} else if(!$f->isDot() && $f->isDir()) {
			rrmdir($f->getRealPath());
		}
	}
	rmdir($path);
}