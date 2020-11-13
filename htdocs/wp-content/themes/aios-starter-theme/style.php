<?php
/*
 * This file removes media queries from style.css of the child theme.
 */
 
/* Be recognized as a css file */
header('content-type: text/css; charset=utf-8');
	
/* Import Wordpress functions */	
define('WP_USE_THEMES', false);
require('../../../wp-load.php');

/* Get theme */
$child_stylesheet = get_stylesheet_directory() . DIRECTORY_SEPARATOR . "style.css";

/* Remove media queries */
echo preg_replace ( "/@media[^\{]+\{([^\{\}]*\{[^\}\{]*\})+[^\}]+\}/" , "", file_get_contents( $child_stylesheet ) );




