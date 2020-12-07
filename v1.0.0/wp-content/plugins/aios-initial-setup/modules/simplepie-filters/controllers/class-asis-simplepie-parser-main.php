<?php

class AIOS_Initial_Setup_SimplePie_Main {
	
	function __construct() {
		add_action('wp_feed_options', array( $this, 'set_options'), 100, 2);
	}
	
	function set_options(&$feed,$url) {
		$feed->set_parser_class('AIOS_Initial_Setup_SimplePie_Parser');
	}
	
}