<?php
/**
 * Name: Fix Yoast Breadcrumbs
 * Description: Refactor breadcrumbs
 */
class AIOS_Initial_Setup_Yoast_Breadcrumbs_Fix {
	
	private $_link_depth;
	
	function __construct() {
		$this->_link_depth = 1;
		add_filter('wpseo_breadcrumb_single_link', array($this,'format_breadcrumb_item'), 10, 2 );
		add_filter('wpseo_breadcrumb_output', array($this,'change_breadcrumbs_wrapper') );
	}
	
	function change_breadcrumbs_wrapper($output) {
		/** Use BreadcrumbList schema */
		return str_replace(' xmlns:v="http://rdf.data-vocabulary.org/#"',' vocab="http://schema.org/" typeof="BreadcrumbList"', $output);
	}
	
	function format_breadcrumb_item($link_output,$link) {
		
		/** Google accepts the following format https://developers.google.com/structured-data/breadcrumbs?hl=en */
		if ( ! isset( $link['allow_html'] ) || $link['allow_html'] !== true ) {
			$link['text'] = esc_html( $link['text'] );
		}
		
		if ( !$this->is_last_item($link_output) ) {
			$link_output = '<span property="itemListElement" typeof="ListItem">' . 
                '<a property="item" typeof="WebPage" href="' . $link['url'] . '">' .
                '<span property="name">' . $link['text'] . '</span></a>' .
                '<meta property="position" content="' . $this->_link_depth . '">' .
            '</span>';
		}
		else {
			
			if ( $this->is_last_item_bold($link_output) ) {
				$inner_element = 'strong';
			} else {
				$inner_element = 'span';
			}
			
			$link_output = '<span class="breadcrumb_last" property="itemListElement" typeof="ListItem">' . 
                '<' . $inner_element . ' property="name">' . $link['text'] . '</' . $inner_element . '>' .
                '<meta property="position" content="' . $this->_link_depth . '">' .
            '</span>';
		}

		$this->_link_depth += 1;
		return $link_output;
	}
	
	function is_last_item($html) {
		if ( strpos($html, 'breadcrumb_last') === false ) {
			return false;
		}
		return true;
	}
	
	function is_last_item_bold($html) {
		if ( strpos($html, '<strong class="breadcrumb_last') === false) {
			return false;
		}
		return true;
	}
	
}

$aios_initial_setup_module_instances_object['aios_initial_setup_yoast_breadcrumbs_fix_module'] = new AIOS_Initial_Setup_Yoast_Breadcrumbs_Fix();