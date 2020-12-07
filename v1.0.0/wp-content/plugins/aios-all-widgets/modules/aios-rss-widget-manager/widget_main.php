<?php 


// Creating the widget 
class aios_rss extends WP_Widget {

function __construct() {
	parent::__construct(
	// Base ID of your widget
	'aios_rss', 

	// Widget name will appear in UI
	__('AIOS RSS Manager Widget', 'aios_rss_widget'), 

	// Widget description
	array( 'description' => __( 'This widget pulls data from any RSS Feed and parses it into a series of shortcodes for easy customization.', 'aios_rss_widget' ), ) 
	);

	$this->_documentation_url = AIOS_ALL_WIDGETS_URL . "modules/aios-rss-widget-manager/documentation.html";

}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {

	$title = apply_filters( 'widget_title', $instance['title'] );
	$feedlink = apply_filters( 'widget_title', $instance['feedlink'] );
	$feedcount = apply_filters( 'widget_title', $instance['feedcount'] );
	$descriptioncount = apply_filters( 'widget_title', $instance['descriptioncount'] );
	$feed_html = apply_filters( 'widget_title', $instance['feed_html'] );
	// before and after widget arguments are defined by themes

	echo $args['before_widget'];


	echo $title;
	// This is where you run the rss feed fetching

		$required_num = $feedcount;

		/// declare array from front end 

		$text = $instance['feedfilter'];

		//Convert to array
		$filters = explode(",",$text);

		//Trim spaces
		foreach( $filters as $key => $text ) {
		  $filters[$key] = trim( $text );
		}


		/// get keywords from cdn
		$keyword_arrs = get_transient('aios-rss-widget-manager-keywords');

		if ( !$keyword_arrs ) {
			$keyword_arrs = file_get_contents("https://cdn.thedesignpeople.net/aios-plugins/aios-all-widgets/json/keywords.json");
			set_transient( 'aios-rss-widget-manager-keywords', $keyword_arrs, 60*60*12 );
		}

		$keywords = json_decode($keyword_arrs);


		//Add default keywords

		$filters = array_merge($keywords->keywords ,$filters);

		// check if widget link is empty
		if ( !empty( $instance[ 'feedlink' ] ) ) {
			$feedlink = $instance[ 'feedlink' ];
		}

		// include once 
		include_once(ABSPATH . WPINC . '/feed.php');

		/// fetch declare feed
		$rss = fetch_feed($feedlink);

		/// if error link
	    if ( is_wp_error( $rss ) ){
	    	echo " <h2>No feed found</h2>";
	    	return;
	    }

	    // if rss is not empty
		if( !empty( $rss ) ) {

			///maxium count of items declare
			$maxitems  = $rss->get_item_quantity( 30 );
			$rss_items = $rss->get_items(0, $maxitems);
	
		}
		
		$new_rss_items = array();


		// find competitors keywords
		foreach ( $rss_items as $index => $item ) {

			foreach( $filters as $filter_index => $filter) {

				//Skip if filter is blank
				if ( empty($filter) ) { continue; }

				//Remove item if keyword is found in description
				if( strpos( $item->get_description(), $filter ) ) { unset( $rss_items[$index] ); break; }

				//Remove item if keyword is found in title
				if( strpos( $item->get_title(), $filter ) ) { unset( $rss_items[$index] ); break; }

			}

		}
	
		$static = substr($instance['feed_html'], 0, strpos($instance['feed_html'], '[feed_start_loop]'));
		

		//// check instance
		preg_match( "/\[feed_start_loop\](.*)\[feed_end_loop\]/s", $instance['feed_html'], $html_layout_loop);	

		$indx = 0;


		foreach ( $rss_items as $item ) {
			
			
			preg_match('/<img(.*)src(.*)=(.*)"(.*)"/U', $item->get_content(), $result);
			$image = array_pop($result);
			$enclosure = $item->get_enclosure();
			$image = ( ( $enclosure->link != null ) ? $enclosure->link : $image ); 

			$blog_array = array(
					'[feed_date]',
					'[feed_description]',
					'[feed_permalinks]',
					'[feed_permalink]',
					'[feed_image]',
					'[feed_title]',
			);
			$blog_data = array(
					$item->get_date('M j, Y'),
					substr( html_entity_decode( htmlspecialchars( strip_tags( $item->get_description() ) ) ), 0, $descriptioncount),
					$item->get_permalink(),
					$item->get_permalink(),
					$image,
					html_entity_decode( htmlspecialchars( strip_tags( $item->get_title() ) ) ),
			);

			if($indx < $required_num){

				$static .= str_replace($blog_array,$blog_data, $html_layout_loop[1]);		
			}	

			$indx++;	
		}	

		// loop end 
		$position		= strpos($instance['feed_html'], '[feed_end_loop]');
		$static    .= substr( $instance['feed_html'], $position + strlen('[feed_end_loop]'), strlen( $instance['feed_html'] ) -1 );

	echo $static;
	
	echo $args['after_widget'];
}
	

// Widget Backend 
public function form( $instance ) {


	/// Widget Title 
	if ( !empty( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	}
	else {
		$title = __( '', 'aios_rss_widget' );
	};

	// widget link 
	if ( !empty( $instance[ 'feedlink' ] ) ) {
		$feedlink = $instance[ 'feedlink' ];
	}
	else {
		$feedlink = __( 'https://www.agentimage.com/blog/feed/', 'aios_rss_widget' );
	};

	/// description count 
	if ( !empty( $instance[ 'descriptioncount' ] ) ) {
		$descriptioncount = $instance[ 'descriptioncount' ];
	}
	else {
		$descriptioncount = __( '150', 'aios_rss_widget' );
	};

	//feed count	
	if ( isset( $instance[ 'feedcount' ] ) ) {
		$feedcount = $instance[ 'feedcount' ];
	}
	else {
		$feedcount = __( '5', 'aios_rss_widget' );
	};

	//feed filter
	if ( !empty( $instance[ 'feedfilter' ] ) ) {
		$feedfilter = $instance[ 'feedfilter' ];
	}
	else {
		$feedfilter = __( '', 'aios_rss_widget' );
	};

	//feed html
	if ( !empty( $instance[ 'feed_html' ] ) ) {
		$feed_html = $instance[ 'feed_html' ];
	}
	else {
		$feed_html = __( '', 'aios_rss_widget' );
	};

?>

<div class="aios-all-widgets-help ">
<a class="thickbox" href="<?php  echo $this->_documentation_url ?>?TB_iframe=true&width=600&height=550 "><span class="ai-question-o"></span>How do I use this widget?</a>
</div>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'feedlink' ); ?>"><?php _e( 'Feed Link:' ); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id( 'feedlink' ); ?>" name="<?php echo $this->get_field_name( 'feedlink' ); ?>" type="text" value="<?php echo esc_attr( $feedlink ); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'descriptioncount' ); ?>"><?php _e( 'Description Count:' ); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id( 'descriptioncount' ); ?>" name="<?php echo $this->get_field_name( 'descriptioncount' ); ?>" type="text" value="<?php echo esc_attr( $descriptioncount ); ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'feedcount' ); ?>"><?php _e( 'Feed Count:' ); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id( 'feedcount' ); ?>" name="<?php echo $this->get_field_name( 'feedcount' ); ?>" type="number" value="<?php echo esc_attr( $feedcount ); ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'feedfilter' ); ?>"><?php _e( 'Filters:' ); ?></label> 
	<input class="widefat" id="<?php echo $this->get_field_id( 'feedfilter' ); ?>" name="<?php echo $this->get_field_name( 'feedfilter' ); ?>" type="text" value="<?php echo esc_attr( $feedfilter ); ?>" />
	<small style="font-weight: bold;">Note: Please use comma separated tags</small>
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'feed_html' ); ?>"><?php _e( 'HTML:' ); ?></label> 
	<textarea style="width:100%; height:300px;" id="<?php echo $this->get_field_id( 'feed_html' ); ?>" name="<?php echo $this->get_field_name( 'feed_html' ); ?>"><?php echo $feed_html; ?></textarea>

</p>

<?php 

}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	$instance['title'] 			= strip_tags($new_instance['title']);
	$instance['feedlink']		= strip_tags($new_instance['feedlink']);
	$instance['descriptioncount'] = strip_tags($new_instance['descriptioncount']);
	$instance['feedcount']		= strip_tags($new_instance['feedcount']);
	$instance['feed_html']		= $new_instance['feed_html'];
	$instance['feedfilter']		= strip_tags($new_instance['feedfilter']);

	return $instance;
}
} // Class aios_rss ends here

// Register and load the widget
function aios_rss_widget_manager_widgets_init() {
	register_widget( 'aios_rss' );
}
add_action( 'widgets_init', 'aios_rss_widget_manager_widgets_init' );


?>