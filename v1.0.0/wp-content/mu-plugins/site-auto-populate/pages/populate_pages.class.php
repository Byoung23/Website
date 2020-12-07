<?php
class PopulatePages{
	function __construct( ) {
		//create roadmap pages
		$this->create_pages( );
	}

	function create_pages( ){

    	$args = array(
		    'timeout'     => 5,
		    'redirection' => 5,
		    'httpversion' => '1.0',
		    'user-agent'  => 'WordPress/' . $wp_version . '; ' . get_bloginfo( 'url' ),
		    'blocking'    => true,
		    'headers'     => array( 'Content-Type: application/json' ),
		    'cookies'     => array(),
		    'body'        => null,
		    'compress'    => false,
		    'decompress'  => true,
		    'sslverify'   => true,
		    'stream'      => false,
		    'filename'    => null
		); 
    	$response = wp_remote_get( content_url().'/mu-plugins/site-auto-populate/pages/pages.json', $args );
    	if( is_array($response) ) {
			$header = $response['headers']; // array of http header lines
		  	$json 	= $response['body']; // use the content
		  	$json_arr = (Array)json_decode( $json );

		  	//create pages with contact forms
		  	$replace_with_arr = get_option( 'auto-contact-forms', array( ) );
		  	foreach( $json_arr['forms'] as $json_data ){
		  		$json_data->post_content = '[contact-form-7 id="'.$replace_with_arr[$json_data->matching_id].'" title="'.$json_data->post_title.'"]';
		  		$page_id = wp_insert_post( $json_data );
		  	}	

		  	//create pages
		  	foreach( $json_arr['pages'] as $json_data ){
		  		$json_data->post_content = base64_decode( $json_data->post_content );
		  		$page_id = wp_insert_post( $json_data );
		  	}	

		  	//create posts
		  	foreach( $json_arr['posts'] as $json_data ){
		  		$json_data->post_content = base64_decode( $json_data->post_content );
		  		$page_id = wp_insert_post( $json_data );
		  	}
		}
    }


}

?>