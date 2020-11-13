<?php 
class AIOS_Customer_Reviews_To_Widget extends WP_Widget{
	
	private $args_t;
	protected $_documentation_url;
	
	public function __construct() {
		
		parent::__construct(
			'testimonial_reviews', // Base ID
			__( 'AIOS Customer Reviews To Widget', 'text_domain' ), // Name
			array( 'description' => __( 'This widget displays Reviews submitted through the WP Customer Reviews Plugin.', 'text_domain' ), ) // Args
		);	
		
		$this->_documentation_url = AIOS_ALL_WIDGETS_URL . "modules/aios-customer-reviews-to-widget/documentation.html";
		
	}
	
	public function form($instance){

		if ( $instance ) {
			$title				= esc_attr( $instance['title'] );
			$limit 				= esc_attr( $instance['limit' ] );
			$excerpt_limit 		= esc_attr( $instance['excerpt_limit' ] );
			$html 				= $instance['html'];
		}
		
		else {
			$title 				= '';
			$limit 				= '';
			$excerpt_limit 		= '';
			$html 				= '';
		}	

		echo 
		'<div class="aios-all-widgets-help ">
			<a class="thickbox" href="' . $this->_documentation_url . '?TB_iframe=true&width=600&height=550"><span class="ai-question-o"></span>How do I use this widget?</a>
		</div>
		<p>
			<label for="'.$this->get_field_id('title').'">Title:</label><br />
			<input id="'.$this->get_field_id('title').'" class="widefat" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'"/>
		</p>
		<p>
			<label for="'.$this->get_field_id('limit').'">Limit:</label><br />
			<input id="'.$this->get_field_id('limit').'" class="widefat" name="'.$this->get_field_name('limit').'" type="number" value="'.$limit.'" />
		</p>
		<p>
			<label for="'.$this->get_field_id('excerpt_limit').'">Excerpt Limit:</label><br />
			<input id="'.$this->get_field_id('excerpt_limit').'" class="widefat" name="'.$this->get_field_name('excerpt_limit').'" type="number" value="'.$excerpt_limit.'" />
		</p>
		<p>
			<lable for="'.$this->get_field_id('fp_html').'">HTML:</label><br />
			<textarea id="'.$this->get_field_id('fp_html').'" style="width:100%; height:300px;" name="'.$this->get_field_name('html').'">'.$html.'</textarea>
		</p>
		';
	}
	
	public function update( $new_instance, $old_instance ){
		$instance = $old_instance;
		
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['limit']			= strip_tags($new_instance['limit']);
		$instance['excerpt_limit']	= strip_tags($new_instance['excerpt_limit']);
		$instance['html']			= $new_instance['html'];
		
		return $instance;
	}
	
	public function widget( $args, $instance ){
		$this->args_t = $args;
	
		extract( $args );
		
		$static = $instance['html'];
		preg_match('/\[review_loopstart]([^#]+)\[review_loopend]/', $static, $match);
		
		$review_listings = '';
		$count = 1;
					
		$instance['limit'] = empty ( $instance['limit'] ) ? count($response) : $instance['limit'];

		$excerpt_limit = !empty ( $instance['excerpt_limit'] ) ? $instance['excerpt_limit'] : 150;
		
		$r_args = array(
				'post_type'			=> 'wpcr3_review',
				'post_per_page'		=> -1,
				'orderby'			=> 'date',
				'order'				=> 'desc'
			);

		$review_query = new WP_Query ( $r_args );


		if ( $review_query->have_posts() ){
			while ( $review_query->have_posts() ){
				$review_query->the_post();

				$full_content 	= get_the_content();
				$excerpt 		= substr ( strip_tags( get_the_content() ), 0, $excerpt_limit );

				$dots			= strlen ( $full_content ) > $excerpt_limit ? '...' : '';

				$rate_value 	=  get_post_meta ( get_the_ID(), 'wpcr3_review_rating', true );

				switch ( $rate_value ){
					case '1'	: $width = '20%';
								break;
					case '2'	: $width = '40%';
								break;
					case '3'	: $width = '60%';
								break;
					case '4'	: $width = '80%';
								break;
					case '5'	: $width = '100%';
								break;
					default 	: $width = '0%';
				}

				$rating 		= '<div class="wpcr3_review_ratingValue"><div class="wpcr3_rating_style1"><div class="wpcr3_rating_style1_base "><div class="wpcr3_rating_style1_average" style="width:'.$width.';"></div></div></div></div>';
				
				$parent = get_post_meta ( get_the_ID(), 'wpcr3_review_post', true );
				$parent_permalink = get_permalink($parent);
				$review_jumplink = $parent_permalink . '#wpcr3_id_' . get_the_ID();
					
				$to_loop = $match[1];

				$review_arr = array(
					'[review_title]' 		=> get_post_meta ( get_the_ID(), 'wpcr3_review_title', true ),
					'[review_name]'			=> get_post_meta ( get_the_ID(), 'wpcr3_review_name', true ),
					'[review_email]'		=> get_post_meta ( get_the_ID(), 'wpcr3_review_email', true ),
					'[review_link]'			=> $review_jumplink,
					'[review_rating]'		=> $rating,
					'[review_website]'		=> get_post_meta ( get_the_ID(), 'wpcr3_review_website', true ),
					'[full_content]'		=> $full_content,
					'[excerpt]'				=> $excerpt . $dots
				);

				$review_listings .= strtr($to_loop, $review_arr);

				//limit
				if ( $count == $instance['limit'] ) {
					break;
				}
				
				$count++;
			}

			$before_html = explode('[review_loopstart]', $instance['html']);
			$after_html = explode('[review_loopend]', $instance['html']);
			
			echo $before_widget . $before_html[0] . $review_listings . $after_html[1] . $after_widget;
		}
		else {
			echo 'No Reviews Found.';
		}	
	}
}
add_action('widgets_init', create_function('', 'return register_widget("AIOS_Customer_Reviews_To_Widget");'));