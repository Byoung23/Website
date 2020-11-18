<?php
/**
 * Name: Disable Post Embeds 
 * Description: Disable wp-embed will convert URL to oEmbed oEmbed is a format for allowing an embedded representation of a URL on third party sites. The simple API allows a website to display embedded content (such as photos or videos) when a user posts a link to that resource, without having to parse the resource directly. https://oembed.com/
 */
class AIOS_Initial_Setup_Disable_WP_Embed {
	
	function __construct() {
		add_action( 'wp_footer', array( $this, 'deregister_scripts' ) );
	}

	function deregister_scripts() {
		wp_deregister_script( 'wp-embed' );
	}
	
}

$aios_initial_setup_module_instances_object['aios_initial_setup_module_disable_wp_embed_module'] = new AIOS_Initial_Setup_Disable_WP_Embed();