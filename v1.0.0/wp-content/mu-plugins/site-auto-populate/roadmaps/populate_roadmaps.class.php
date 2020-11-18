<?php
class PopulateRoadmaps{
	function __construct( ) {
		//create roadmap pages
		$this->create_roadmaps( );
	}

	function create_roadmaps( ){

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
    	$response = wp_remote_get( content_url().'/mu-plugins/site-auto-populate/roadmaps/roadmaps.json', $args );
    	if( is_array($response) ) {
			$header = $response['headers']; // array of http header lines
		  	$json 	= $response['body']; // use the content
		  	$json_arr = (Array)json_decode( $json );

		  	//option arrays
		  	$buyers = array( );
		  	$sellers = array( );
		  	$finance = array( );

		  	//create buyers
		  	$indx = 0;
		  	foreach( $json_arr['buyers'] as $json_data ){
		  		$json_data->post_content = base64_decode( $json_data->post_content  );
		  		if( $indx == 0 ){
		  			$page_id = wp_insert_post( $json_data );
		  			$page_parent_id = $page_id;
		  		}else{
		  			$json_data->post_parent = $page_parent_id;
		  			$page_id = wp_insert_post( $json_data );
		  		}
		  		$indx++;
		 		$buyers[] = $page_id;
		  	}	
		  	update_option( 'Buyer_Resources', maybe_serialize( $buyers ) );

		  	//create sellers
		  	$indx = 0;
		  	foreach( $json_arr['sellers'] as $json_data ){
		  		$json_data->post_content = base64_decode( $json_data->post_content  );
		  		if( $indx == 0 ){
		  			$page_id = wp_insert_post( $json_data );
		  			$page_parent_id = $page_id;
		  		}else{
		  			$json_data->post_parent = $page_parent_id;
		  			$page_id = wp_insert_post( $json_data );
		  		}
		  		
		  		$indx++;
		 		$sellers[] = $page_id;
		  	}	
		  	update_option( 'Seller_Resources', maybe_serialize( $sellers ) );

		  	//create finance
		  	$indx = 0;
		  	foreach( $json_arr['finance'] as $json_data ){
		  		$json_data->post_content = base64_decode( $json_data->post_content  );

		  		if( $indx == 0 ){
		  			$page_id = wp_insert_post( $json_data );
		  			$page_parent_id = $page_id;
		  		}else{
		  			$json_data->post_parent = $page_parent_id;
		  			$page_id = wp_insert_post( $json_data );
		  		}

		  		$indx++;
		 		$finance[] = $page_id;
		  	}	
		  	update_option( 'Financing_Resources', maybe_serialize( $finance ) );
		}
    }


    function roadmap_generator( ){
		//Road Maps
		$b_to_json = array();
		$buyers = maybe_unserialize( get_option('Buyer_Resources') );

		foreach( $buyers as $b ){
			$b_arr = get_post( $b, ARRAY_A, 'raw' );
			$b_to_print['post_title'] = $b_arr['post_title'];
			$b_to_print['post_name'] = $b_arr['post_name'];
			$b_to_print['post_type'] = $b_arr['post_type'];
			$b_to_print['post_status'] = $b_arr['post_status'];
			$b_to_print['post_content'] = base64_encode( $b_arr['post_content'] );

			$b_to_json['buyers'][] = $b_to_print;
		}

		$sellers = maybe_unserialize( get_option('Seller_Resources') );
		foreach( $sellers as $b ){
			$b_arr = get_post( $b, ARRAY_A, 'raw' );
			$b_to_print['post_title'] = $b_arr['post_title'];
			$b_to_print['post_name'] = $b_arr['post_name'];
			$b_to_print['post_type'] = $b_arr['post_type'];
			$b_to_print['post_status'] = $b_arr['post_status'];
			$b_to_print['post_content'] = base64_encode( $b_arr['post_content'] );

			$b_to_json['sellers'][] = $b_to_print;
		}

		$finance = maybe_unserialize( get_option('Financing_Resources') );
		foreach( $finance as $b ){
			$b_arr = get_post( $b, ARRAY_A, 'raw' );
			$b_to_print['post_title'] = $b_arr['post_title'];
			$b_to_print['post_name'] = $b_arr['post_name'];
			$b_to_print['post_type'] = $b_arr['post_type'];
			$b_to_print['post_status'] = $b_arr['post_status'];
			$b_to_print['post_content'] = base64_encode( $b_arr['post_content'] );

			$b_to_json['finance'][] = $b_to_print;
		}

		echo json_encode( $b_to_json );
		
	}
}

?>