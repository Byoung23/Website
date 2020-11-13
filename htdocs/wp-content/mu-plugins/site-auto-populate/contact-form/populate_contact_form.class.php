<?php

class PopulateContactForm{

	function __construct( ) {
		$this->create_contact_forms( );
	}


	function create_contact_forms( ){
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

    	$response = wp_remote_get( content_url().'/mu-plugins/site-auto-populate/contact-form/contact-form.json', $args );
    	if( is_array($response) ) {
			$header = $response['headers']; // array of http header lines
		  	$json 	= $response['body']; // use the content
		  	$json_arr  = (Array)json_decode( $json );
		  	$option_arr = array( );

			foreach( $json_arr as $json_data ){
		  		$json_data->post_content = base64_decode( $json_data->post_content  );
		  		$page_id = wp_insert_post( $json_data );
		  		update_post_meta( $page_id, '_message', $json_data->_message );
		  		update_post_meta( $page_id, '_form', 	base64_decode( $json_data->_form ) );
		  		$json_data->_mail->body = base64_decode( $json_data->_mail->body );
		  		update_post_meta( $page_id, '_mail', $json_data->_mail );
		  		$option_arr[$json_data->matching_id] = $page_id;
		  	}

		  	update_option( 'auto-contact-forms', $option_arr );  	
		} 	
	}

	function contact_form_generator( ){
		$to_print = array( );
		$data = array( );
		$args = array(
			'post_type'        => 'wpcf7_contact_form',
			'post_status'      => 'publish',
		);
		$posts_array = get_posts( $args );
		foreach( $posts_array  as $post_data ){
			$data['post_title'] = $post_data->post_title;
			$data['post_type'] = $post_data->post_type;
			$data['post_status'] = $post_data->post_status;
			$data['post_content'] = base64_encode( $post_data->post_content );

			//meta data
			$data['_messages'] =  get_post_meta( $post_data->ID, '_messages', true ) ;
			
			$mail_arr = get_post_meta( $post_data->ID, '_mail', true ) ;
			$data['_mail']['subject'] = $mail_arr['subject']; 
			$data['_mail']['sender'] = $mail_arr['sender'];
			$data['_mail']['body'] = base64_encode( $mail_arr['body'] );
			$data['_mail']['recipient'] = $mail_arr['recipient'];
			$data['_mail']['additional_headers'] = $mail_arr['additional_headers'];
			$data['_mail']['attachments'] = $mail_arr['attachments'];
			$data['_mail']['use_html'] = $mail_arr['use_html'];
			$data['_mail']['exclude_blank'] = $mail_arr['exclude_blank'];

			$data['_form'] =  base64_encode( get_post_meta( $post_data->ID, '_form', true ) ) ;
			$to_print[] = $data;
		}

		
		echo json_encode( $to_print );
		
	}

  
	
}





?>