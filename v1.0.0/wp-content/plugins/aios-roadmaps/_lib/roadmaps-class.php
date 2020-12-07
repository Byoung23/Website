<?php
/*
Class and Functions for the Roadmaps Plugin
*/

add_shortcode("Buyer", "buyer_content");
add_shortcode("Seller", "seller_content");
add_shortcode("Financing", "financing_content");

//Plugin Initialization
$connect=get_option('Roadmap_UseTitle');

function create_post(){
	//add color options when plugin initialized
	add_option('buyer_color', '#969393');
	add_option('seller_color', '#969393');
	add_option('financing_color', '#969393');
	
	add_option('buyer_color_hover', '#000000');
	add_option('seller_color_hover', '#000000');
	add_option('financing_color_hover', '#000000');
}

//Plugin Deactivation
function delete_options(){
	delete_option('Buyer_Resources');
	delete_option('Seller_Resources');
	delete_option('Financing_Resources');
}

//Redirect landing page to first pages
function aios_roadmaps_redirect_landing_pages() {
	
	//Get current page
	global $wp_query; 
	$current_page = $wp_query->post->ID;
	
	//Get first pages
	$first_pages = array();
	$buyers_roadmap = unserialize(get_option('Buyer_Resources'));
	$sellers_roadmap = unserialize(get_option('Seller_Resources'));
	$financing_roadmap = unserialize(get_option('Financing_Resources'));
	
	if ( $buyers_roadmap ) { if ( isset( $buyers_roadmap[0] ) ) { $first_pages[] = get_post( $buyers_roadmap[0] ); } }
	if ( $sellers_roadmap ) { if ( isset( $sellers_roadmap[0] ) ) { $first_pages[] = get_post( $sellers_roadmap[0] ); } }
	if ( $financing_roadmap ) { if ( isset( $financing_roadmap[0] ) ) { $first_pages[] = get_post( $financing_roadmap[0] ); } }

	//Redirect if current page is same as parent page of any first page
	foreach( $first_pages as $first_page ) {
		$first_page_id = $first_page->ID;
		$first_page_url = get_permalink( $first_page_id );
		$landing_page_id = $first_page->post_parent;
		
		if ( $landing_page_id == $current_page && $landing_page_id != 0 ) {
			wp_redirect( $first_page_url, 301 );
			exit;
		}
	}
	
}

add_action( 'get_header', 'aios_roadmaps_redirect_landing_pages' );

//Buyer Resources View
function buyer_content(){
	global $post;
	$dir=AIOS_ROADMAPS_URL;
	$buyer_resources=get_option('Buyer_Resources');
	$unserialize_buyer=unserialize($buyer_resources);
	$res = array();
	$buyer_output = '';
	
	$connect=get_option('Roadmap_UseTitle');
	if(!empty($connect)){
		$title=array();
	}
	else{
		$title=array('<br>Deciding To<br> Buy','<br>Preparing <br>To Buy','Choosing A<br> Real Estate<br> Agent',' Time to<br /> Go Shopping','Escrow<br> Inspections &amp;<br> Appraisals','<br>Moving In');
	}
	foreach($unserialize_buyer as $key=>$results){
		$res[]=$results;
		if(!empty($connect)){
			array_push($title,get_the_title($results));
		}
	}

	$buyer_theme = strtolower( get_option( 'buyer_img_color','White' ) );
	$buyer_theme = $buyer_theme == 'black' ? 'white' : 'black';

	$buyer_style = get_option('buyer_style', 'Without Border') == 'Without Border' ? 'no-border' : '';

	$buyer_page = get_the_ID();

	$title_class = array();

	foreach ( $title as $t ){
		$count = count ( explode ( '<br>', $t ) );

		if ( $count == 1 ){
			$title_class[] = 'single-line';
		}

		else if ( $count == 3 ){
			$title_class[] = 'three-line';
		}
	}
	
	$landing_page = get_post($res[0]);
	$landing_page_id = $landing_page->post_parent;

	$buyer_output .= '<div class="aios-roadmaps buyers-roadmap ' . $buyer_theme . ' ' . $buyer_style . '">'
		. '<a class="aios-roadmap-link ' . ( isset( $title_class[0] ) ? $title_class[0] : '' ) . ( ($buyer_page == $res[0] || $buyer_page == $landing_page_id) ? ' active-link' : '' ) . '" href="' . get_permalink($res[0]) . '">'
			. '<span class="aios-roadmap-icon ai-font-question-o"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[0]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . ( isset( $title_class[0] ) ? $title_class[0] : '' ) . ( $buyer_page == $res[1] ? ' active-link' : '' ) . '" href="' . get_permalink($res[1]) . '">'
			. '<span class="aios-roadmap-icon ai-font-check-a"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[1]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . ( isset( $title_class[2] ) ? $title_class[2] : '' ) . ( $buyer_page == $res[2] ? ' active-link' : '' ) . '" href="' . get_permalink($res[2]) . '">'
			. '<span class="aios-roadmap-icon ai-font-user"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[2]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . ( isset( $title_class[3] ) ? $title_class[3] : '' ) . ( $buyer_page == $res[3] ? ' active-link' : '' ) . '" href="' . get_permalink($res[3]) . '">'
			. '<span class="aios-roadmap-icon ai-font-house"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[3]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . ( isset( $title_class[4] ) ? $title_class[4] : '' ) . ( $buyer_page == $res[4] ? ' active-link' : '' ) . '" href="' . get_permalink($res[4]) . '">'
			. '<span class="aios-roadmap-icon ai-font-house-i"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[4]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . ( isset( $title_class[5] ) ? $title_class[5] : '' ) . ( $buyer_page == $res[5] ? ' active-link' : '' ) . '" href="' . get_permalink($res[5]) . '">'
			. '<span class="aios-roadmap-icon ai-font-check-o"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[5]
			. '</span></div>'
		. '</a>'
	. '</div>';
	return $buyer_output;
}

function seller_content(){
	global $post;
	$dir=AIOS_ROADMAPS_URL;
	$seller_resources=get_option('Seller_Resources');
	$unserialize_seller=unserialize($seller_resources);
	$seller_output = '';
	
	$connect=get_option('Roadmap_UseTitle');
	if(!empty($connect)){
		$title=array();
	}
	else{
		$title=array('<br> Decide<br> To Sell','<br> Select an<br> Agent &amp; Price','<br> Prepare<br> To Sell','<br> Accepting<br> An Offer','Escrow<br> Inspections<br> &amp; Appraisals', '<br> Close Of<br> Escrow');
	}
	foreach($unserialize_seller as $key=>$results){
		$seller[]=$results;
		if(!empty($connect)){
			array_push($title,get_the_title($results));
		}
	}
	
	$seller_theme = strtolower( get_option( 'seller_img_color','White' ) );
	$seller_theme = $seller_theme == 'black' ? 'white' : 'black';

	$seller_style = get_option('seller_style', 'Without Border') == 'Without Border' ? 'no-border' : '';

	$title_class = array();

	$seller_page = get_the_ID();

	foreach ( $title as $t ){
		$count = count ( explode ( '<br>', $t ) );

		if ( $count == 1 ){
			$title_class[] = 'single-line';
		}

		else if ( $count == 3 ){
			$title_class[] = 'three-line';
		}
	}

	$seller_output .= '<div class="aios-roadmaps sellers-roadmap ' . $seller_theme . ' ' . $seller_style . '">'
		. '<a class="aios-roadmap-link ' . $title_class[0] . ( $seller_page == $seller[0] ? ' active-link' : '' ) . '" href="' . get_permalink($seller[0]) . '">'
			. '<span class="aios-roadmap-icon ai-font-question-o"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[0]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . $title_class[1] . ( $seller_page == $seller[1] ? ' active-link' : '' ) . '" href="' . get_permalink($seller[1]) . '">'
			. '<span class="aios-roadmap-icon ai-font-user"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[1]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . $title_class[2] . ( $seller_page == $seller[2] ? ' active-link' : '' ) . '" href="' . get_permalink($seller[2]) . '">'
			. '<span class="aios-roadmap-icon ai-font-coin"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[2]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . $title_class[3] . ( $seller_page == $seller[3] ? ' active-link' : '' ) . '" href="' . get_permalink($seller[3]) . '">'
			. '<span class="aios-roadmap-icon ai-font-check-a"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[3]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . $title_class[4] . ( $seller_page == $seller[4] ? ' active-link' : '' ) . '" href="' . get_permalink($seller[4]) . '">'
			. '<span class="aios-roadmap-icon ai-font-house-i"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[4]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . $title_class[6] . ( $seller_page == $seller[5] ? ' active-link' : '' ) . '" href="' . get_permalink($seller[5]) . '">'
			. '<span class="aios-roadmap-icon ai-font-check-o"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[5]
			. '</span></div>'
		. '</a>'
	. '</div>';
	return $seller_output;
}

function financing_content(){
	global $post;
	$dir=AIOS_ROADMAPS_URL;
	$financing_resources=get_option('Financing_Resources');
	$unserialize_financing=unserialize($financing_resources);
	$financing_output = '';
	
	$connect=get_option('Roadmap_UseTitle');
	if(!empty($connect)){
		$title=array();
	}
	else{
		$title=array('<br> Getting<br> Started','<br> Shop For A<br> Loan','<br> Know The <br> Numbers','<br> Get Pre-<br> Approved','<br> Applications<br> &amp; Processing','<br> Funding<br> &nbsp;');
	}
	foreach($unserialize_financing as $key=>$results){
		$financing[]=$results;
		if(!empty($connect)){
			array_push($title,get_the_title($results));
		}
	}

	$financing_theme = strtolower( get_option( 'financing_img_color','White' ) );
	$financing_theme = $financing_theme == 'black' ? 'white' : 'black';

	$financing_style = get_option('financing_style', 'Without Border') == 'Without Border' ? 'no-border' : '';

	$title_class = array();

	$financing_page = get_the_ID();

	foreach ( $title as $t ){
		$count = count ( explode ( '<br>', $t ) );

		if ( $count == 1 ){
			$title_class[] = 'single-line';
		}

		else if ( $count == 3 ){
			$title_class[] = 'three-line';
		}
	}

	$financing_output .= '<div class="aios-roadmaps financing-roadmap ' . $financing_theme . ' ' . $financing_style . '">'
		. '<a class="aios-roadmap-link ' . $title_class[0] . ( $financing_page == $financing[0] ? ' active-link' : '' ) . '" href="' . get_permalink($financing[0]) . '">'
			. '<span class="aios-roadmap-icon ai-font-file-text-r"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[0]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . $title_class[1] . ( $financing_page == $financing[1] ? ' active-link' : '' ) . '" href="' . get_permalink($financing[1]) . '">'
			. '<span class="aios-roadmap-icon ai-font-dollar-o"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[1]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . $title_class[2] . ( $financing_page == $financing[2] ? ' active-link' : '' ) . '" href="' . get_permalink($financing[2]) . '">'
			. '<span class="aios-roadmap-icon ai-font-file-image-p"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[2]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . $title_class[3] . ( $financing_page == $financing[3] ? ' active-link' : '' ) . '" href="' . get_permalink($financing[3]) . '">'
			. '<span class="aios-roadmap-icon ai-font-check-list"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[3]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . $title_class[4] . ( $financing_page == $financing[4] ? ' active-link' : '' ) . '" href="' . get_permalink($financing[4]) . '">'
			. '<span class="aios-roadmap-icon ai-font-folder"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[4]
			. '</span></div>'
		. '</a>'
		. '<a class="aios-roadmap-link ' . $title_class[5] . ( $financing_page == $financing[5] ? ' active-link' : '' ) . '" href="' . get_permalink($financing[5]) . '">'
			. '<span class="aios-roadmap-icon ai-font-funds"><!-- icon --></span>'
			. '<div><span class="aios-roadmap-name">'
				. $title[5]
			. '</span></div>'
		. '</a>'
	. '</div>';
	return $financing_output;
}

function aios_roadmaps_create_page( $data ) {
	
	/* Check if page with same URL exists */
	if ( isset( $data['page_name'] ) ) {
		
		/* Get parent slug */
		$slug = '';
		if ( isset( $data['post_parent'] ) ) {
			$parent = get_post( $data['post_parent'] );
			$slug = $parent->post_name . ' /';
		}
		
		$existing_page_id = aios_roadmaps_get_id_by_slug( $slug . $data['page_name'] );
		
	}
	
	/* If page already exists, update it */
	if ( isset( $existing_page_id ) ) {
		$data['ID'] = $existing_page_id;
		return wp_update_post( $data );
	}
	
	/* If it doesn't exist, create it */
	else {
		return wp_insert_post( $data );
	}
	
}	

function aios_roadmaps_get_id_by_slug( $slug ) {
	
	$args = array (
		'pagename' => $slug
	);
	
	$query = new WP_Query( $args );
	
	if ( count( $query->posts ) ) {
		return $query->posts[0]->ID;
	}
	else {
		return null;
	}
	
}

//Set Admin Options
include('admin_content.php');
