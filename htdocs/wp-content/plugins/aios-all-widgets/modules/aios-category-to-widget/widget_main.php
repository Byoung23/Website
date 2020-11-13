<?php
class AIOS_Category_To_Widget extends WP_Widget {
	
	protected $_documentation_url;
	
	/**
	 * Sets up the widgets name etc
	 */
	function __construct() {
		
		parent::__construct(
			'aios_post_information_by_category', // Base ID
			__( 'AIOS Category To Widget', 'text_domain' ), // Name
			array( 'description' => __( 'This widget allows users to retrieve Post information based on a Category.', 'text_domain' ), ) // Args
		);
		
		$this->_documentation_url = AIOS_ALL_WIDGETS_URL . "modules/aios-category-to-widget/documentation.html";
		
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		extract( $args );

		$pbcw_title				= esc_attr($instance['pbcw_title']);
		$pbcw_category			= esc_attr($instance['pbcw_category']);
		$pbcw_post_type			= esc_attr($instance['pbcw_post_type']);
		$pbcw_limit 			= esc_attr($instance['pbcw_limit']);
		$pbcw_order_by			= esc_attr($instance['pbcw_order_by']);
		$pbcw_order				= esc_attr($instance['pbcw_order']);
		$pbcw_readmore_length	= esc_attr($instance['pbcw_readmore_length']);
		$pbcw_readmore_text		= esc_attr($instance['pbcw_readmore_text']);
		$pbcw_readmore_added	= esc_attr($instance['pbcw_readmore_added']);

		$pbcw_shortcode_support	= esc_attr($instance['pbcw_shortcode_support']);

		$pbcw_photoholder		= esc_attr($instance['pbcw_photoholder']);
		$pbcw_photoholder_flag	= esc_attr($instance['pbcw_photoholder_flag']);
		$pbcw_html				= $instance['pbcw_html'];
		
		echo $args['before_widget'];

		if(! empty ($pbcw_title)){
			echo $args['before_title'].apply_filters('widget_title',$pbcw_title).
			$args['after_title'];
		}

		$pattern = '/\[loop_start\](?s)(.*?)\[loop_end\]/';
		preg_match($pattern, $pbcw_html, $matches);
		$inside_loop = "";
		if( $pbcw_category == "All" ) {
			//get all categories
			$args = array(
			  'orderby' => 'name',
			  'order' => 'ASC',
			  'hide_empty' => 0,
			);
			$categories = get_categories($args);
			$all_post = array();
			foreach($categories as $category) { 
				$posts = get_post_by_category_and_post_type($category->term_id,$pbcw_post_type,$pbcw_order_by,$pbcw_order,$pbcw_limit, $pbcw_readmore_length, $pbcw_readmore_text, $pbcw_readmore_added, $pbcw_photoholder, $pbcw_photoholder_flag);	
				array_push($all_post, $posts);
			}
			$merged_posts = call_user_func_array('array_merge', $all_post);
			$inside_loop .= display_result( array_slice($merged_posts,0,$pbcw_limit), $pbcw_html, $matches, $pbcw_shortcode_support );
			
		} else {
			$posts = get_post_by_category_and_post_type($pbcw_category,$pbcw_post_type,$pbcw_order_by,$pbcw_order,$pbcw_limit, $pbcw_readmore_length, $pbcw_readmore_text, $pbcw_readmore_added, $pbcw_photoholder, $pbcw_photoholder_flag);

			$inside_loop .= display_result( $posts, $pbcw_html, $matches, $pbcw_shortcode_support );
		}
		
		echo str_replace($matches[0],$inside_loop,$pbcw_html);
		
   		echo $args['after_widget'];

	}
	

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// set defaults array
		$defaults = array(
			'pbcw_title'	 		=> '',
			'pbcw_category'  		=> 'All',
			'pbcw_post_type' 		=> 'All',
			'pbcw_limit'     		=> '10',
			'pbcw_order_by'  		=> '',
			'pbcw_order'     		=> '',
			'pbcw_readmore_length'  => '55',
			'pbcw_readmore_text'  	=> '',
			'pbcw_readmore_added'  	=> '',
			'pbcw_shortcode_support'=> '',
			'pbcw_photoholder'  	=> '',
			'pbcw_photoholder_flag' => '',
		);
		// set defaults
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		// Check values
		if( $instance) {
			 $pbcw_title			= esc_attr($instance['pbcw_title']);
			 $pbcw_category			= esc_attr($instance['pbcw_category']);
			 $pbcw_post_type		= esc_attr($instance['pbcw_post_type']);
			 $pbcw_limit 			= esc_attr($instance['pbcw_limit']);
			 $pbcw_order_by			= esc_attr($instance['pbcw_order_by']);
			 $pbcw_order			= esc_attr($instance['pbcw_order']);
			 $pbcw_readmore_length	= esc_attr($instance['pbcw_readmore_length']);
			 $pbcw_readmore_text	= esc_attr($instance['pbcw_readmore_text']);
			 $pbcw_readmore_added	= esc_attr($instance['pbcw_readmore_added']);
			 $pbcw_shortcode_support= esc_attr($instance['pbcw_shortcode_support']);
			 $pbcw_photoholder		= esc_attr($instance['pbcw_photoholder']);
			 $pbcw_photoholder_flag	= esc_attr($instance['pbcw_photoholder_flag']);
			 $pbcw_html				= $instance['pbcw_html'];
		} 
		//get dropdown value
		$pbcw_category_data = array();
		$pbcw_category_data[$pbcw_category] = " selected='selected'";
		$pbcw_order_by_data = array();
		$pbcw_order_by_data[$pbcw_order_by] = " selected='selected'";
		$pbcw_order_data = array();

		$pbcw_order_data[$pbcw_order] = " selected='selected'";
		$pbcw_post_type_data = array();
		$pbcw_post_type_data[$pbcw_post_type] = " selected='selected'";
		
		if( !empty($pbcw_readmore_added) ) {
			$pbcw_readmore_added = "checked";
		}

		if( !empty($pbcw_photoholder_flag) ) {
			$pbcw_photoholder_flag = "checked";
		}


		if( !empty($pbcw_shortcode_support) ) {
			$pbcw_shortcode_support = "checked";
		}
		
		//get all post types
		$all_post_types = get_post_types( '', 'names' ); 
		$remove_post_type = array('page', 'attachment', 'revision', 'nav_menu_item');
		$post_types = unset_post_type( $remove_post_type, $all_post_types );
		array_push($post_types,'All');
				
		//get all categories
		$args = array(
		  'orderby' => 'name',
		  'order' => 'ASC',
		  'hide_empty' => 0,
		);
		$categories = get_categories($args);
		
		echo '<div class="aios-all-widgets-help ">';
		echo '<a class="thickbox" href="' . $this->_documentation_url  . '?TB_iframe=true&width=600&height=550"><span class="ai-question-o"></span>How do I use this widget?</a>';
		echo '</div>';
		
		echo "<br />";
		echo '<p>
				<label for="' . $this->get_field_id('pbcw_title') .'">Title:</label>
				<input class="widefat" 
				id="'. $this->get_field_id('pbcw_title') .'" 
				name="'. $this->get_field_name('pbcw_title') .'" 
				type="text" 
				value="'. $pbcw_title .'" />
			</p>';
		echo '<p>
				<label for="' . $this->get_field_id('pbcw_category') .'">Category:</label>
				<select
				class="widefat" 
				id="'. $this->get_field_id('pbcw_category') .'" 
				name="'. $this->get_field_name('pbcw_category') .'">';
					 foreach($categories as $category) { 
						echo '<option value="'.$category->term_id.'" '.$pbcw_category_data[$category->term_id].'>'.$category->name.'</option>';
					  }
					  echo '<option value="All" '.$pbcw_category_data['All'].'>All</option>';
		echo '	</select>
			</p>';
		echo '<p>
				<label for="' . $this->get_field_id('pbcw_post_type') .'">Post Type:</label>
				<select
				class="widefat" 
				id="'. $this->get_field_id('pbcw_post_type') .'" 
				name="'. $this->get_field_name('pbcw_post_type') .'">';
					foreach( $post_types as $post_name ) {
						echo '<option value="'.$post_name.'" '.$pbcw_post_type_data[$post_name].'>'.$post_name.'</option>';
					}	
		echo '	</select>
			</p>';
		echo '<p>
				<label for="' . $this->get_field_id('pbcw_limit') .'">Limit:</label>
				<input class="widefat" 
				id="'. $this->get_field_id('pbcw_limit') .'" 
				name="'. $this->get_field_name('pbcw_limit') .'" 
				type="number" 
				min="1"
				onkeypress="return pbcw_isNumberKey(event)"
				value="'. $pbcw_limit .'" />
			</p>';

		echo '<p>
				<label for="' . $this->get_field_id('pbcw_order_by') .'">Order By:</label>
				<select 
				class="widefat" 
				id="'. $this->get_field_id('pbcw_order_by') .'" 
				name="'. $this->get_field_name('pbcw_order_by') .'">
					<option value="none" '. $pbcw_order_by_data['none'] .'>None</option>
					<option value="ID" '. $pbcw_order_by_data['ID'] .'>ID</option>
					<option value="author" '. $pbcw_order_by_data['author'] .'>Author</option>
					<option value="title" '. $pbcw_order_by_data['title'] .'>Title</option>
					<option value="date" '. $pbcw_order_by_data['date'] .'>Date</option>
					<option value="modified" '. $pbcw_order_by_data['modified'] .'>Modified</option>
					<option value="rand" '. $pbcw_order_by_data['rand'] .'>Random</option>
					<option value="menu_order" '. $pbcw_order_by_data['menu_order'] .'>Menu Order</option>
					<option value="meta_value" '. $pbcw_order_by_data['meta_value'] .'>Meta Value</option>
					<option value="meta_value_num" '. $pbcw_order_by_data['meta_value_num'] .'>Meta Value Num</option>
				</select>
			</p>';
		echo '<p>
				<label for="' . $this->get_field_id('pbcw_order') .'">Order:</label>
				<select 
				class="widefat" 
				id="'. $this->get_field_id('pbcw_order') .'" 
				name="'. $this->get_field_name('pbcw_order') .'">
					<option value="ASC" '. $pbcw_order_data['ASC'] .'>Ascending</option>
					<option value="DESC" '. $pbcw_order_data['DESC'] .'>Descending</option>
				</select>
			</p>';
		echo '<p>
				<label for="' . $this->get_field_id('pbcw_photoholder') .'">Featured Image Placeholder URL:</label>
				<input class="widefat" 
				id="'. $this->get_field_id('pbcw_photoholder') .'" 
				name="'. $this->get_field_name('pbcw_photoholder') .'" 
				type="text" 
				value="'. $pbcw_photoholder .'" />
				
				<input class="widefat" 
				id="'. $this->get_field_id('pbcw_photoholder_flag') .'" 
				name="'. $this->get_field_name('pbcw_photoholder_flag') .'" 
				type="checkbox" '. $pbcw_photoholder_flag .' /><em>Hide Placeholder Photo?</em>
			</p>';
		echo '<p>
				<label for="' . $this->get_field_id('pbcw_readmore_length') .'">Excerpt Length:</label>
				<input class="widefat" 
				id="'. $this->get_field_id('pbcw_readmore_length') .'" 
				name="'. $this->get_field_name('pbcw_readmore_length') .'" 
				type="text" 
				value="'. $pbcw_readmore_length .'" />
			</p>';
		echo '<p>
				<label for="' . $this->get_field_id('pbcw_readmore_text') .'">Readmore Text:</label>
				<input class="widefat" 
				id="'. $this->get_field_id('pbcw_readmore_text') .'" 
				name="'. $this->get_field_name('pbcw_readmore_text') .'" 
				type="text" 
				value="'. $pbcw_readmore_text .'" />
			</p>';
		echo '<p>
				
				<input class="widefat" 
				id="'. $this->get_field_id('pbcw_readmore_added') .'" 
				name="'. $this->get_field_name('pbcw_readmore_added') .'" 
				type="checkbox" '. $pbcw_readmore_added .' />
				<label for="' . $this->get_field_id('pbcw_readmore_added') .'">Check to show readmore text even if the content is fully shown</label>
			</p>';


		echo '<p>
				
				<input class="widefat" 
				id="'. $this->get_field_id('pbcw_shortcode_support') .'" 
				name="'. $this->get_field_name('pbcw_shortcode_support') .'" 
				type="checkbox" '. $pbcw_shortcode_support .' />
				<label for="' . $this->get_field_id('pbcw_shortcode_support') .'">Check to strip shortcodes:</label>
			</p>';

		echo '<p>
				<label for="' . $this->get_field_id('pbcw_html') .'">HTML:</label>
				<textarea class="widefat" 
					rows="7"
					id="'. $this->get_field_id('pbcw_html') .'" 
					name="'. $this->get_field_name('pbcw_html') .'">'. $pbcw_html .'</textarea>
			</p>';
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		// Fields
		 $instance['pbcw_title']			= $new_instance['pbcw_title'];
		 $instance['pbcw_category']			= $new_instance['pbcw_category'];
		 $instance['pbcw_post_type']		= $new_instance['pbcw_post_type'];
		 $instance['pbcw_limit']	 		= $new_instance['pbcw_limit'];
		 $instance['pbcw_order_by']			= $new_instance['pbcw_order_by'];;
		 $instance['pbcw_order']			= $new_instance['pbcw_order'];
		 $instance['pbcw_readmore_length']	= $new_instance['pbcw_readmore_length'];
		 $instance['pbcw_readmore_text']	= $new_instance['pbcw_readmore_text'];
		 $instance['pbcw_readmore_added']	= $new_instance['pbcw_readmore_added'];
		 $instance['pbcw_shortcode_support']	= $new_instance['pbcw_shortcode_support'];
		 $instance['pbcw_photoholder']		= $new_instance['pbcw_photoholder'];
		 $instance['pbcw_photoholder_flag']	= $new_instance['pbcw_photoholder_flag'];
		 $instance['pbcw_html']				= $new_instance['pbcw_html'];
				
		return $instance;
	}
}
//filter post types to generate on dropdown
function unset_post_type( $to_remove, $post_types ) {
	foreach( $to_remove as $post_name ) {
		unset($post_types[$post_name]);
	}	
	return $post_types;
}

//filter posts by category and post type
function get_post_by_category_and_post_type( $category_id, $post_type, $orderby, $order, $limit, $pbcw_readmore_length, $pbcw_readmore_text, $pbcw_readmore_added,$pbcw_photoholder,$pbcw_photoholder_flag) {
	
	if($post_type == 'All') {
		$all_post_types = get_post_types( '', 'names' ); 
		$remove_post_type = array('page', 'attachment', 'revision', 'nav_menu_item');
		$post_type = unset_post_type( $remove_post_type, $all_post_types );
	}
	
	if( empty($pbcw_readmore_length) ) {
		$pbcw_readmore_length == 55;
	}
	
	$args = array(
	'posts_per_page'   => $limit,
	'category'         => $category_id,
	'post_type'        => $post_type,
	'orderby'          => $orderby,
	'order'            => $order );
	$all_posts = array();
	$myposts = get_posts( $args );
	foreach ( $myposts as $post ) : 
		setup_postdata( $post ); 
		$readmore_text = $pbcw_readmore_text;
		$excerpt_count = str_word_count( strip_tags($post->post_content) );
		
		if ( $pbcw_readmore_length >= $excerpt_count ) {
			if( empty( $pbcw_readmore_added ) ) {
				$readmore_text = "";
			} else {
				$readmore_text = $pbcw_readmore_text;
			}
		}


		
		$image = get_the_post_thumbnail($post->ID);
		
		//If post has featured image
		if( !empty( $image ) ) {
			$image_thumb 	= get_the_post_thumbnail( $post->ID, 'thumbnail' );
			$image_med 		= get_the_post_thumbnail( $post->ID, 'medium' );
			$image_large 	= get_the_post_thumbnail( $post->ID, 'large' );
			$image_full 	= get_the_post_thumbnail( $post->ID, 'full' );
			$thumbsrc	= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'thumbnail'); //$thumbsrc = $thumbsrc[0];
			$medsrc 	= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'medium'); //$medsrc = $medsrc[0];
			$largesrc 	= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large'); //$largesrc = $largesrc[0];
			$fullsrc 	= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'full'); //$fullsrc = $fullsrc[0];

		//If post has NO featured image
		} else {
			$data = htmlspecialchars($post->post_content);  
			$txt = str_replace('&quot;', '#', $data);
			$content_image = "";
			//Get first image in content if available
			if( preg_match_all('/img src=#(.*?)#/', $txt, $match) ) {
				foreach( $match[1] as $image ) {
					$content_image = $image;
					break;
				}
			}
			//If image in content is NOT available
			if( empty($content_image) ) {
				
				//If placeholder image is set to display
				if ( empty($pbcw_photoholder_flag) ) {
					$image_thumb 	= $image_med = $image_large = $image_full = "<img src='" . $pbcw_photoholder . "' alt='".$post->post_title."'/>";
					$thumbsrc = $medsrc = $largesrc = $fullsrc = $pbcw_photoholder;
				//If placeholder image is set to hide
				}else {
					$image_thumb 	= $image_med = $image_large = $image_full = '';
					$thumbsrc = $medsrc = $largesrc = $fullsrc = '';
				}

					

				
			//If image in content is available, find its attachment ID
			} else {
				global $wpdb;
				$content_image = preg_replace('/-\d+[Xx]\d+\./', '.', $content_image);
				$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $content_image )); 
				
				//If it is an attachment
				if( !empty( $attachment ) ) {
					$thumbsrc	= wp_get_attachment_image_src($attachment[0],'thumbnail');
					$medsrc 	= wp_get_attachment_image_src($attachment[0],'medium');
					$largesrc 	= wp_get_attachment_image_src($attachment[0],'large');
					$fullsrc 	= wp_get_attachment_image_src($attachment[0],'full');

					$image_thumb 	= "<img src='" . $thumbsrc[0] . "' alt='".$post->post_title."' />";
					$image_med 		= "<img src='" . $medsrc[0] . "' alt='".$post->post_title."' />";
					$image_large 	= "<img src='" . $largesrc[0] . "' alt='".$post->post_title."' />";
					$image_full 	= "<img src='" . $fullsrc[0] . "' alt='".$post->post_title."' />";
				//If it is a third-party image
				} else {
					$image_thumb 	= 	$image_med 	= $image_large 	= $image_full = "<img src='" . $content_image . "' alt='".$post->post_title."'/>";
					$thumbsrc = $medsrc = $largesrc = $fullsrc = $content_image;
				}
			}	
	
		}
		
		$excerpt = wp_trim_words( strip_tags($post->post_content), $pbcw_readmore_length, '');
		array_push($all_posts, array(
			'post_title' => $post->post_title,
			'post_date' => $post->post_date,
			'post_date_year_full' => date('Y', strtotime($post->post_date)),
			'post_date_year_short' => date('y', strtotime($post->post_date)),
			'post_date_month' => date('F', strtotime($post->post_date)),
			'post_date_month_abbr' => date('M', strtotime($post->post_date)),
			'post_date_month_num' => date('m', strtotime($post->post_date)),
			'post_date_month_num_nozero' => date('n', strtotime($post->post_date)),
			'post_date_day' => date('d', strtotime($post->post_date)),
			'post_date_day_nozero' => date('j', strtotime($post->post_date)),
			'post_date_day_text' => date('l', strtotime($post->post_date)),
			'post_date_day_text_abbr' => date('D', strtotime($post->post_date)),
			'post_content' => $post->post_content,
			'post_excerpt' => $excerpt,
			'post_readmore' => $readmore_text,
			'post_name' => $post->post_name,
			'post_author' => get_the_author_meta( 'nickname', $post->post_author ),
			'permalink' => get_permalink($post->ID),
			'featured_img_small' => $image_thumb,
			'featured_img_medium' => $image_med,
			'featured_img_large' => $image_large,
			'featured_img_full' => $image_full,
			'featured_img_small_url' => $thumbsrc[0],
			'featured_img_medium_url' => $medsrc[0],
			'featured_img_large_url' => $largesrc[0],
			'featured_img_full_url' => $fullsrc[0]
		));
	endforeach;
	wp_reset_postdata();
	
	return $all_posts;
}

function display_result( $posts, $pbcw_html, $matches, $pbcw_shortcode_support ) {	

	

		$patterns = array();
		$replacements = array();
						
		foreach( $posts as $post_data ) {
			$pattern_to_add = array();
			$replacement_to_add = array();
			$newArray = array_keys($posts[0]);
			foreach( $newArray as $arrayKey ) {
				array_push($pattern_to_add,"/\[".$arrayKey."\]/");
				array_push($replacement_to_add, $post_data[$arrayKey]);
			}
			array_push($patterns,$pattern_to_add);
			array_push($replacements,$replacement_to_add);
		}

		$count = 0;
		$inside_loop = "";
		foreach( $posts as $post_data ) {
			$inside_loop .= preg_replace($patterns[$count], $replacements[$count], $matches[1]);
			$count++;
		}	

		if ( $pbcw_shortcode_support == "on" ) {
			$inside_loop = strip_shortcodes( $inside_loop );
		}else {
			$inside_loop = do_shortcode( $inside_loop );
		}

		
		
		return $inside_loop;
}

add_action( 'widgets_init', function(){
     register_widget( 'AIOS_Category_To_Widget' );
});

function enqueue_admin_scripts($hook) {
    if ( 'widgets.php' != $hook ) {
        return;
    }
	wp_enqueue_script( 'pbcw-js', plugins_url( '', __FILE__ ) . '/pbcw.js' );
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_scripts' );

