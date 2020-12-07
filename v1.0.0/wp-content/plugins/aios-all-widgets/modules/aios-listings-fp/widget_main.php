<?php

class Aios_Featured_Properties extends WP_Widget {
	
	protected $_documentation_url;
	
	// constructor
	function __construct() {
		/* ... */
		parent::__construct(
					false, // Base ID
					__( 'AIOS Listings FP', 'text_domain' ), // Name
					array( 'description' => __( 'This widget displays AIOS Listings Featured Properties based on the selected category and parses it into a series of shortcodes for easy customization. ', 'text_domain' ), ) 
		);
		
		$this->_documentation_url = AIOS_ALL_WIDGETS_URL . "modules/aios-listings-fp/documentation.html";
		
	}
	// widget form creation
	public function form( $instance ) {
		// outputs the options form on admin		
		// Check values 
		if( $instance) { 
			$title           		= esc_attr($instance['title']); 
			$fp_type	  	  		= esc_attr($instance['fp_type']); 
			$version	  	  		= esc_attr($instance['version']); 
			$property_limit  		= esc_attr($instance['property_limit']); 
			$image_size	  			= esc_attr($instance['image_size']); 
			$no_image	  	  		= esc_attr($instance['no_image']); 
			$html_layout 	  		= esc_attr($instance['html_layout']); 
			$html_layout_nav  		= esc_attr($instance['html_layout_nav']); 
			$field_name  	  		= esc_attr($instance['field_name']); 
			$order_setting  		= esc_attr($instance['order_setting']);
			// Slick
			$slick_enable			= esc_attr( $instance[ 'slick_enable' ] );
			$slick_target_id		= esc_attr( $instance[ 'slick_target_id' ] );
			$slick_to_show			= esc_attr( $instance[ 'slick_to_show' ] );
			$slick_to_scroll		= esc_attr( $instance[ 'slick_to_scroll' ] );
			$slick_autoplay			= esc_attr( $instance[ 'slick_autoplay' ] );
			$slick_duration			= esc_attr( $instance[ 'slick_duration' ] );
			$slick_effect			= esc_attr( $instance[ 'slick_effect' ] );
			$slick_arrow 			= esc_attr( $instance[ 'slick_arrow' ] );
			$slick_dots 			= esc_attr( $instance[ 'slick_dots' ] );
			// Slick for navigating another slick
			$slick_nav_enable		= esc_attr( $instance[ 'slick_nav_enable' ] );
			$slick_nav_target_id	= esc_attr( $instance[ 'slick_nav_target_id' ] );
			$slick_nav_to_show		= esc_attr( $instance[ 'slick_nav_to_show' ] );
			$slick_nav_to_scroll	= esc_attr( $instance[ 'slick_nav_to_scroll' ] );
			$slick_nav_autoplay		= esc_attr( $instance[ 'slick_nav_autoplay' ] );
			$slick_nav_duration		= esc_attr( $instance[ 'slick_nav_duration' ] );
			$slick_nav_effect		= esc_attr( $instance[ 'slick_nav_effect' ] );
			$slick_nav_arrow 		= esc_attr( $instance[ 'slick_nav_arrow' ] );
			$slick_nav_dots 		= esc_attr( $instance[ 'slick_nav_dots' ] );
			// End Slick
		} else { 
			$title          		= '';  
			$image_size     		= '';  
			$property_limit 		= '';  
			$no_image       		= '';  
			$fp_type        		= '';  
			$version        		= '';  
			$html_layout    		= '';
			$html_layout_nav		= '';
			$field_name      		= ''; 
			$order_setting  		= '';
			// Slick
			$slick_enable			= '';
			$slick_target_id			= '';
			$slick_to_show			= '';
			$slick_to_scroll		= '';
			$slick_autoplay			= '';
			$slick_duration			= '';
			$slick_effect			= '';
			$slick_arrow			= '';
			$slick_dots				= '';
			// Slick for navigating another slick
			$slick_nav_target_id	= '';
			$slick_nav_enable		= '';
			$slick_nav_to_show		= '';
			$slick_nav_to_scroll	= '';
			$slick_nav_autoplay		= '';
			$slick_nav_duration		= '';
			$slick_nav_effect		= '';
			$slick_nav_arrow		= '';
			$slick_nav_dots			= '';
			// End Slick
		} 
		$args 			= array('hide_empty' => FALSE);
		$all_categories = get_categories( $args );
		
		echo '<div class="aios-all-widgets-help ">';
		echo '<a class="thickbox" href="' . $this->_documentation_url  . '?TB_iframe=true&width=600&height=550"><span class="ai-question-o"></span>How do I use this widget?</a>';
		echo '</div>';
		
		echo '<p>';
		echo '<label for="'.$this->get_field_id("title").'">Title:  </label>' ;
		echo ' <input id="'.$this->get_field_id("title").'" class="widefat" name="'.$this->get_field_name("title").'" type="text" value="'.$title.'" placeholder="Enter title here"/>';
		echo '</p>';

		echo '<p>';
		echo '<label>Version:</label>';
		echo '<br />';
		echo '</p>';
		echo '<p>';
		echo '<select name="'.$this->get_field_name("version").'" id="'.$this->get_field_id("version").'" class="widefat">';		
		echo '<option value="six_above" id="six_above"', $version == 'six_above'? ' selected="selected"' : '', '>0.6.0 and Above</option>';		
		echo '<option value="below_six" id="below_six"', $version == 'below_six'? ' selected="selected"' : '', '>Below 0.6.0</option>';		
		echo '</select>';

		echo '<p>';
		echo '<label>Category:</label>';
		echo '<br />';
		echo '</p>';
		echo '<p>';
		echo '<select name="'.$this->get_field_name("fp_type").'" id="'.$this->get_field_id("fp_type").'" class="widefat">';
		$option = "Checked Featured Property";
		echo '<option value="' . $option . '" id="' . $option . '"', $fp_type == $option ? ' selected="selected"' : '', '>', $option, '</option>';		
		foreach( $all_categories as $category ) {
			echo '<option value="' . $category->slug . '" id="' . $category->slug. '"', $fp_type == $category->slug ? ' selected="selected"' : '', '>', $category->name, '</option>';
		}
		echo '</select>';
		echo '</p>';
		
		echo '<p>';
		echo '<label>Number. of properties to show:</label>';
		echo '<br />';
		echo '</p>';
		echo '<p>';
		echo ' <input id="'.$this->get_field_id("property_limit").'" class="widefat" name="'.$this->get_field_name("property_limit").'" type="number" min="1" max="30" value="'.$property_limit.'" />';	
		echo '</p>';
		
		/* start of sort setting */
		echo '<p>';
		echo '<label>Sort by:</label>';
		echo '<br />';
		echo '</p>';
		echo '<p>';
		echo '<select name="'.$this->get_field_name("field_name").'" id="'.$this->get_field_id("field_name").'" class="widefat">';
		$options = array('List Price', 'Title' ,'Date Published');
		foreach ( $options as $option ) {
			echo '<option value="' . $option . '" id="' . $option . '"', $field_name == $option ? ' selected="selected"' : '', '>', $option, '</option>';
		}
		echo '</select>';
		echo '</p>';
		echo '<p>';
		echo '<label>Order by:</label>';
		echo '<br />';
		echo '</p>';
		echo '<p>';
		echo '<select name="'.$this->get_field_name("order_setting").'" id="'.$this->get_field_id("order_setting").'" class="widefat">';
		$order_setting_options = array( 'Ascending', 'Descending' );
		foreach ( $order_setting_options as $order_setting_option ) {
			echo '<option value="' . $order_setting_option . '" id="'. $order_setting_option .'"', $order_setting == $order_setting_option ? ' selected="selected"' : '', '>', $order_setting_option, '</option>';
		}
		echo '</select>';
		/* end of sort setting */
		echo '<p>';
		echo '<label>Image Size:</label>';
		echo '<br />';
		echo '</p>';
		echo '<p>';
		echo '<select name="'.$this->get_field_name("image_size").'" id="'.$this->get_field_id("image_size").'" class="widefat">';
		$options_val = array( 'Thumbnail', 'Medium', 'Large' );
		$options	 = array( 'thumbnail', 'medium', 'large' );
		$ctr    	 = 0;
		foreach ( $options as $option ) {
			echo '<option value="' . $option . '" id="' . $option . '"', $image_size == $option ? ' selected="selected"' : '', '>', $options_val[$ctr], '</option>';
			$ctr++;
		}
		echo '</select>';
		echo '</p>';
		
		echo '<p>';
		echo '<p>';
		echo '<input id="'.$this->get_field_id("no_image").'" name="'.$this->get_field_name("no_image").'" type="checkbox" value="yes" ';  checked( "yes", $no_image ); echo' />'; 
		echo '<label for="'.$this->get_field_id("no_image").'">Add default no image placeholder</label>';
		echo '</p>';
		// End Place Holder

		// Start Slick Parent
		echo '<p class="slick-enabler">';
			echo '<input id="'.$this->get_field_id("slick_enable").'" name="'.$this->get_field_name("slick_enable").'" type="checkbox" value="yes" ';  checked( "yes", $slick_enable ); echo' />'; 
			echo '<label for="'.$this->get_field_id("slick_enable").'">Enable Slick Carousel/Slider</label>';
			echo '<span class="aios-must-note"><br><strong>Note: Remove the ID/Class that triggers Slick to run on it. If this doesn\'t work try to enable slick.js from this <a href="' . get_admin_url() . 'options-general.php?page=aios-all-widgets-options" target="_blank">page</a>.</strong></span>';
		echo '</p>';
		// If enable show code below
		echo '<div class="'.$this->get_field_id("slick_enable").( $slick_enable !== "yes" ? ' slick-enabler-hide' : '' ).'">';
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_target_id").'">Target ID/Class:</label>';
				echo ' <input id="'.$this->get_field_id("slick_target_id").'" class="widefat" name="'.$this->get_field_name("slick_target_id").'" type="text" value="'.$slick_target_id.'" placeholder="#featured-properties/.featured-properties"/>';
			echo '</p>';
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_to_show").'">Slide to Show:</label>';
				echo ' <input id="'.$this->get_field_id("slick_to_show").'" class="widefat" name="'.$this->get_field_name("slick_to_show").'" type="number" value="'.$slick_to_show.'" placeholder="Default: 1"/>';
			echo '</p>';
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_to_scroll").'">Slide to Scroll:</label>';
				echo ' <input id="'.$this->get_field_id("slick_to_scroll").'" class="widefat" name="'.$this->get_field_name("slick_to_scroll").'" type="number" value="'.$slick_to_scroll.'" placeholder="Default: 1"/>';
			echo '</p>';			
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_autoplay").'">Auto Play:</label>';
				echo '<select id="'.$this->get_field_id("slick_autoplay").'" class="widefat" name="'.$this->get_field_name("slick_autoplay").'">';
					$select_slick_autoplays = array(
						'false'		=> 'false',
						'true'	=> 'true'
					);
					foreach ( $select_slick_autoplays as $select_slick_autoplay => $value ) {
						$this_value =  $select_slick_autoplay == $slick_autoplay ? 'selected="selected"' : '';
						echo '<option value="' . $select_slick_autoplay . '" ' . $this_value . '>' . $value . '</option>';
						$select_slick_autoplay;
					}
				echo '</select>';
			echo '</p>';
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_duration").'">Duration:</label>';
				echo ' <input id="'.$this->get_field_id("slick_duration").'" class="widefat" name="'.$this->get_field_name("slick_duration").'" type="number" value="'.$slick_duration.'" placeholder="Default: 1000/1 Secs"/>';
			echo '</p>';
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_effect").'">Effect:</label>';
				echo '<select id="'.$this->get_field_id("slick_effect").'" class="widefat" name="'.$this->get_field_name("slick_effect").'">';
					$select_slick_effects = array(
						'false'	=> 'Default',
						'true'	=> 'Fade'
					);
					foreach ( $select_slick_effects as $select_slick_effect => $value ) {
						$this_value =  $select_slick_effect == $slick_effect ? 'selected="selected"' : '';
						echo '<option value="' . $select_slick_effect . '" ' . $this_value . '>' . $value . '</option>';
					}
				echo '</select>';
			echo '</p>';
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_arrow").'">Show Arrow:</label>';
				echo '<select id="'.$this->get_field_id("slick_arrow").'" class="widefat" name="'.$this->get_field_name("slick_arrow").'">';
					$select_slick_arrows = array(
						'false'		=> 'false',
						'true'	=> 'true'
					);
					foreach ( $select_slick_arrows as $select_slick_arrow => $value ) {
						$this_value =  $select_slick_arrow == $slick_arrow ? 'selected="selected"' : '';
						echo '<option value="' . $select_slick_arrow . '" ' . $this_value . '>' . $value . '</option>';
					}
				echo '</select>';
			echo '</p>';
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_dots").'">Show Dots:</label>';
				echo '<select id="'.$this->get_field_id("slick_dots").'" class="widefat" name="'.$this->get_field_name("slick_dots").'">';
					$select_slick_dots = array(
						'false'		=> 'false',
						'true'	=> 'true'
					);
					foreach ( $select_slick_dots as $select_slick_dot => $value ) {
						$this_value =  $select_slick_dot == $slick_dots ? 'selected="selected"' : '';
						echo '<option value="' . $select_slick_dot . '" ' . $this_value . '>' . $value . '</option>';
					}
				echo '</select>';
			echo '</p>';
		echo '</div>';
		// End Slick Parent

		// Start HTML layout
		echo '<p>';
		echo '<label>Featured Property HTML Layout:</label>';
		echo '<br />';
		echo '<textarea id="'.$this->get_field_id("html_layout").'" name="'.$this->get_field_name("html_layout").'"  rows="15" style="width:100%;" >'.$html_layout.'</textarea>'; 
		echo '</p>';


		// Slick Navigate others
		echo '<p class="slick-enabler">';
			echo '<input id="'.$this->get_field_id("slick_nav_enable").'" name="'.$this->get_field_name("slick_nav_enable").'" type="checkbox" value="yes" ';  checked( "yes", $slick_nav_enable ); echo' />'; 
			echo '<label for="'.$this->get_field_id("slick_nav_enable").'">Enable Navigation from carousel above</label>';
			echo '<span class="aios-must-note"><br><strong>Note: Remove the ID/Class that triggers Slick to run on it.</strong></span>';
		echo '</p>';
		// If enable show code below
		echo '<div class="'.$this->get_field_id("slick_nav_enable").( $slick_nav_enable !== "yes" ? ' slick-enabler-hide' : '' ).'">';
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_nav_target_id").'">Navigation Target ID/Class:</label>';
				echo ' <input id="'.$this->get_field_id("slick_nav_target_id").'" class="widefat" name="'.$this->get_field_name("slick_nav_target_id").'" type="text" value="'.$slick_nav_target_id.'" placeholder="#featured-properties/.featured-properties"/>';
			echo '</p>';
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_nav_to_show").'">Navigation Slide to Show:</label>';
				echo ' <input id="'.$this->get_field_id("slick_nav_to_show").'" class="widefat" name="'.$this->get_field_name("slick_nav_to_show").'" type="number" value="'.$slick_nav_to_show.'" placeholder="Default: 1"/>';
			echo '</p>';
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_nav_to_scroll").'">Navigation Slide to Scroll:</label>';
				echo ' <input id="'.$this->get_field_id("slick_nav_to_scroll").'" class="widefat" name="'.$this->get_field_name("slick_nav_to_scroll").'" type="number" value="'.$slick_nav_to_scroll.'" placeholder="Default: 1"/>';
			echo '</p>';			
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_nav_autoplay").'">Navigation Auto Play:</label>';
				echo '<select id="'.$this->get_field_id("slick_nav_autoplay").'" class="widefat" name="'.$this->get_field_name("slick_nav_autoplay").'">';
					$select_slick_nav_autoplays = array(
						'false'		=> 'false',
						'true'	=> 'true'
					);
					foreach ( $select_slick_nav_autoplays as $select_slick_nav_autoplay => $value ) {
						$this_value =  $select_slick_nav_autoplay == $slick_nav_autoplay ? 'selected="selected"' : '';
						echo '<option value="' . $select_slick_nav_autoplay . '" ' . $this_value . '>' . $value . '</option>';
					}
				echo '</select>';
			echo '</p>';
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_nav_duration").'">Navigation Duration:</label>';
				echo ' <input id="'.$this->get_field_id("slick_nav_duration").'" class="widefat" name="'.$this->get_field_name("slick_nav_duration").'" type="number" value="'.$slick_nav_duration.'" placeholder="Default: 1000/1 Secs"/>';
			echo '</p>';
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_nav_effect").'">Navigation Effect:</label>';
				echo '<select id="'.$this->get_field_id("slick_nav_effect").'" class="widefat" name="'.$this->get_field_name("slick_nav_effect").'">';
					$select_slick_nav_effects = array(
						'true'	=> 'Fade',
						'false'	=> 'Default'
					);
					foreach ( $select_slick_nav_effects as $select_slick_nav_effect => $value ) {
						$this_value =  $select_slick_nav_effect == $slick_nav_effect ? 'selected="selected"' : '';
						echo '<option value="' . $select_slick_nav_effect . '" ' . $this_value . '>' . $value . '</option>';
					}
				echo '</select>';
			echo '</p>';
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_nav_arrow").'">Navigation Show Arrow:</label>';
				echo '<select id="'.$this->get_field_id("slick_nav_arrow").'" class="widefat" name="'.$this->get_field_name("slick_nav_arrow").'">';
					$select_slick_nav_arrows = array(
						'false'		=> 'false',
						'true'	=> 'true'
					);
					foreach ( $select_slick_nav_arrows as $select_slick_nav_arrow => $value ) {
						$this_value =  $select_slick_nav_arrow == $slick_nav_arrow ? 'selected="selected"' : '';
						echo '<option value="' . $select_slick_nav_arrow . '" ' . $this_value . '>' . $value . '</option>';
					}
				echo '</select>';
			echo '</p>';
			echo '<p>';
				echo '<label for="'.$this->get_field_id("slick_nav_dots").'">Navigation Show Dots:</label>';
				echo '<select id="'.$this->get_field_id("slick_nav_dots").'" class="widefat" name="'.$this->get_field_name("slick_nav_dots").'">';
					$select_slick_nav_dots = array(
						'false'		=> 'false',
						'true'	=> 'true'
					);
					foreach ( $select_slick_nav_dots as $select_slick_nav_dot => $value ) {
						$this_value =  $select_slick_nav_dot == $slick_nav_dots ? 'selected="selected"' : '';
						echo '<option value="' . $select_slick_nav_dot . '" ' . $this_value . '>' . $value . '</option>';
					}
				echo '</select>';
			echo '</p>';
			// Start HTML layout
			echo '<p>';
			echo '<label>HTML Layout for Navigation:</label>';
			echo '<br />';
			echo '<textarea id="'.$this->get_field_id("html_layout_nav").'" name="'.$this->get_field_name("html_layout_nav").'"  rows="15" style="width:100%;" >'.$html_layout_nav.'</textarea>'; 
			echo '</p>';

		echo '</div>';
		// End Slick Navigate others
	}
	// update widget
	function update( $new_instance, $old_instance ) {
		$instance                    		= $old_instance;
		$instance['title']     		 		= strip_tags($new_instance['title']);
		$instance['fp_type']     	 		= strip_tags($new_instance['fp_type']);
		$instance['version']     	 		= strip_tags($new_instance['version']);
		$instance['property_limit']  		= strip_tags($new_instance['property_limit']);
		$instance['image_size']      		= strip_tags($new_instance['image_size']);
		$instance['no_image']     	 		= strip_tags($new_instance['no_image']);
		$instance['html_layout']     		= $new_instance['html_layout'];
		$instance['html_layout_nav']     	= $new_instance['html_layout_nav'];
		$instance['field_name'] 	 		= strip_tags($new_instance['field_name']);
		$instance['order_setting']   		= strip_tags($new_instance['order_setting']);
		// Slick
		$instance[ 'slick_enable' ]			= strip_tags( $new_instance[ 'slick_enable' ] );
		$instance[ 'slick_target_id' ]		= strip_tags( $new_instance[ 'slick_target_id' ] );
		$instance[ 'slick_to_show' ]		= strip_tags( $new_instance[ 'slick_to_show' ] );
		$instance[ 'slick_to_scroll' ]		= strip_tags( $new_instance[ 'slick_to_scroll' ] );
		$instance[ 'slick_autoplay' ]		= strip_tags( $new_instance[ 'slick_autoplay' ] );
		$instance[ 'slick_duration' ]		= strip_tags( $new_instance[ 'slick_duration' ] );
		$instance[ 'slick_effect' ]			= strip_tags( $new_instance[ 'slick_effect' ] );
		$instance[ 'slick_arrow' ]			= strip_tags( $new_instance[ 'slick_arrow' ] );
		$instance[ 'slick_dots' ]			= strip_tags( $new_instance[ 'slick_dots' ] );
		// Slick for navigating another slick
		$instance[ 'slick_nav_enable' ]		= strip_tags( $new_instance[ 'slick_nav_enable' ] );
		$instance[ 'slick_nav_target_id' ]	= strip_tags( $new_instance[ 'slick_nav_target_id' ] );
		$instance[ 'slick_nav_to_show' ]	= strip_tags( $new_instance[ 'slick_nav_to_show' ] );
		$instance[ 'slick_nav_to_scroll' ]	= strip_tags( $new_instance[ 'slick_nav_to_scroll' ] );
		$instance[ 'slick_nav_autoplay' ]	= strip_tags( $new_instance[ 'slick_nav_autoplay' ] );
		$instance[ 'slick_nav_duration' ]	= strip_tags( $new_instance[ 'slick_nav_duration' ] );
		$instance[ 'slick_nav_effect' ]		= strip_tags( $new_instance[ 'slick_nav_effect' ] );
		$instance[ 'slick_nav_arrow' ]		= strip_tags( $new_instance[ 'slick_nav_arrow' ] );
		$instance[ 'slick_nav_dots' ]		= strip_tags( $new_instance[ 'slick_nav_dots' ] );
		// End Slick
		return $instance;
	}

	// display widget
	private function get_featured_properties_checked( $instance ) {
		// get checked featured property id 
		global $wpdb;
		$field_name    	= $instance['field_name'];
	    $order_setting 	= $instance['order_setting'];
	    $property_limit = $instance['property_limit'];
	    $version 		= $instance['version'];
	    if( $version == "six_above" ){
	    	$listing_meta = 'listing_info';
	    } else{
	    	$listing_meta = 'aios_listings_data';
	    }

		if ( $field_name == "Date Published" || $field_name == "Title" ) {
			if ( $order_setting == "Ascending" ) {
				$order = 'ASC';
			} else {
				$order = 'DESC';
			}
			if ( $field_name == "Title" ){
				$field = "post_title";
			} else if ( $field_name == "Date Published" ){
				$field = "post_date";
			}

			$query = $wpdb->prepare( "
						SELECT
							`". $wpdb->postmeta . "`.`meta_value`,`". $wpdb->posts . "`.`ID`
						FROM
							`". $wpdb->postmeta . "`
						INNER JOIN
							`". $wpdb->posts . "`
						ON
							`". $wpdb->posts . "`.`ID` = `". $wpdb->postmeta . "`.`post_id`
						WHERE
							`". $wpdb->postmeta . "`.`meta_key` = '$listing_meta'
						AND
							`". $wpdb->posts . "`.`post_status` = 'publish'
						AND
							`". $wpdb->posts . "`.`post_type` = 'listing'	
						ORDER BY `". $wpdb->posts . "`.`$field`  $order
						" , null);
		} else {
			$query 	= $wpdb->prepare( "
						SELECT
							`". $wpdb->postmeta . "`.`meta_value`,`". $wpdb->posts . "`.`ID`
						FROM
							`". $wpdb->postmeta . "`
						INNER JOIN
							`". $wpdb->posts . "`
						ON
							`". $wpdb->posts . "`.`ID` = `". $wpdb->postmeta . "`.`post_id`
						WHERE
							`". $wpdb->postmeta . "`.`meta_key` = '$listing_meta'
						AND
							`". $wpdb->posts . "`.`post_status` = 'publish'
						AND
							`". $wpdb->posts . "`.`post_type` = 'listing'	
						
						" , null);
		}
		
		$raw_listings 	= $wpdb->get_results( $query, ARRAY_A );
		$ctr 			= 0;
		$property_count	= 0;
		foreach( $raw_listings as $listing ) {
			if ( function_exists( 'maybe_unserialize' ) ) {
				$listing['meta_value'] = maybe_unserialize( $listing['meta_value'] );
			} else {
				$listing['meta_value'] = @unserialize( $listing['meta_value'] );
			}
			if ( $listing['meta_value']['featured_property'] ) {	
				if( $ctr == $property_limit ){
					break;
				}		
				if( $version == "six_above" ){
			    	$featured_property_data[$ctr]['ID'] = $listing['ID'];
			    } else{
			    	$featured_property_data[$ctr]['ID'] = $listing['meta_value']['ID'];
			    }

				$featured_property_data[$ctr]['list_price'] = $listing['meta_value']['list_price'];				
				$ctr++;
			}
			
		}		
		
		
		if ( $field_name == "List Price" ) {
			if ( $order_setting == "Ascending" ) {
				$order = SORT_ASC;
			} else {
				$order = SORT_DESC;
			}
			$field = "list_price";
			foreach ( $featured_property_data   as $row ) {   
				$featured_listings[] = $row[$field];
			} 	
			//sort array
			array_multisort( $featured_listings, $order, $featured_property_data  );
			
		}
		$featured_listings_id = array();
		foreach ( $featured_property_data   as $row ) {   
				$featured_listings_id[] = $row['ID'];
		}  
		return $featured_listings_id;
	}
	private function get_featured_properties_category( $instance) {
		// get featured property category id 
		$field_name    	   = $instance['field_name'];
	    $order_setting 	   = $instance['order_setting'];
		$property_limit	   = $instance['property_limit'];
		$category_slug	   = $instance['fp_type'];
		$version   		 = $instance['version'];	
	    
		if ( $order_setting == "Ascending" ) {
			$order = 'ASC';
		} else {
			$order = 'DESC';
		}
		
		if ( $field_name == "List Price" ) {
			if( $version == "six_above" ){
	    		$field = "list_price";
		    } else{
		    	$field = "aios_listings_list_price";
		    }
			
		} else if ( $field_name == "Title" ){
			$field = "title";
		} else if ( $field_name == "Date Published" ){
			$field = "Date Published";
		}
		if( $field == 'title' ) {
			$queryArgs 		   = array( 'post_type' 	=> 'listing', 
										'category_name' => $category_slug , 
										'posts_per_page'=> $property_limit , 
										'orderby' 		=> $field, 
										'order' 		=> $order );	
		} else if(  $field == 'aios_listings_list_price' || $field == 'list_price' ){
			$queryArgs 		   = array( 'post_type'		=> 'listing', 
										'category_name' => $category_slug , 
										'posts_per_page'=> $property_limit,
										'meta_key'		=> $field,
										'orderby' 		=> 'meta_value_num',
										'order' =>  $order );
		} else if(  $field == 'Date Published' ){
			$queryArgs 		   = array( 'post_type'		=> 'listing', 
										'category_name' => $category_slug , 
										'posts_per_page'=> $property_limit,
										'order' 		=>  $order );			
		}
		$featured_listings = new WP_Query($queryArgs);
		return $featured_listings;
		 
	}
	function widget( $args, $instance ) {
		
	   	echo $args['before_widget'];
		$fp_type     	 = $instance['fp_type'];
		$image_size    	 = $instance['image_size'];
		$no_image    	 = $instance['no_image'];
		$html_layout  	 = $instance['html_layout'];
		$html_layout_nav = $instance['html_layout_nav'];
		$field_name      = $instance['field_name'];
	    $order_setting   = $instance['order_setting'];	
	    $version   		 = $instance['version'];	
	    if( $version == "six_above" ){
	    	$listing_meta = 'listing_info';
	    } else{
	    	$listing_meta = 'aios_listings_data';
	    }
		if ( $order_setting == "Ascending" ) {
			$order = SORT_ASC;
		} else {
			$order = SORT_DESC;
		}
		
		if ( $field_name == "List Price" ) {
			$field = "list_price";
		} else {
			$field = "street_number";
		}		
		
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		if( $fp_type == "Checked Featured Property"){
			$featured_property_id = $this->get_featured_properties_checked( $instance );
			
		} else{
			$featured_property_id   = array();
			$featured_property_data = $this->get_featured_properties_category(  $instance );

			if( $featured_property_data->have_posts()) : ?><?php while( $featured_property_data->have_posts()) : $featured_property_data->the_post(); 
				$featured_property_id[] = get_the_ID();				
			endwhile;
			endif;
		}
		
		if ( count( $featured_property_id ) > 0 ) {
			$return_val = substr($html_layout, 0, strpos($html_layout, '[aios_start_loop]'));
			$return_val_child = substr($html_layout_nav, 0, strpos($html_layout_nav, '[aios_start_loop]'));
			
			preg_match( "/\[aios_start_loop\](.*)\[aios_end_loop\]/s", $html_layout, $html_layout_loop );
			preg_match( "/\[aios_start_loop\](.*)\[aios_end_loop\]/s", $html_layout_nav, $html_layout_loop_child );
			foreach( $featured_property_id   as $property_id ) {;
				$property_data  = get_post_meta( $property_id , $listing_meta , true );
				$listing_title  = get_the_title( $property_id );
				$image          = wp_get_attachment_image_src(  get_post_thumbnail_id( $property_id ) , $image_size) ;
				$featured_image = $image[0];
				$currency 		= $property_data['currency'];
				if( $currency == 'Dollar' ){
					 $currency_symbol = '$';
				} else if( $currency == 'Cent' ){
					 $currency_symbol = '¢';
				} else if( $currency == 'Pound' ){
					 $currency_symbol = '£';
				} else if( $currency == 'Yen' ){
					 $currency_symbol = '¥';
				} else if( $currency == 'Euro' ){
					 $currency_symbol = '€';
				} else if( $currency == 'Lira' ){
					 $currency_symbol = '₤';
				} else if( $currency == 'Peseta' ){
					 $currency_symbol = '₧';
				}
				$new_list_price 	 = str_replace( ',' ,'' , $property_data['list_price'] ) ;
				$new_sold_price 	 = str_replace( ',' ,'' , $property_data['sold_price'] ) ;
				
				$list_price    		 = $currency_symbol . number_format( (float)$new_list_price ) ;
				$sold_price     	 = $currency_symbol . number_format( (float)$new_sold_price ) ;
				$listing_url    	 = get_permalink( $property_id );
				$content_post        = get_post( $property_id );
				$listing_description = $content_post->post_content;
				if( strlen($listing_description) > 200 ){
					$listing_description = substr( $listing_description , 0 , 200 ) . '...';
				} else if( empty( $listing_description ) ) {
					$listing_description = "Coming Soon..";
				}
				$building_size_unit  = $property_data['building_size_unit'];
				$lot_size_unit		 = $property_data['building_size_unit'];
				
				if( $building_size_unit == 'Acres' || $lot_size_unit == 'Acres'){
					 $building_size_unit = 'acres';
					 $lot_size_unit		 = 'acres';
				} else if( $building_size_unit == 'Square Feet' || $lot_size_unit == 'Acres'){
					 $building_size_unit = 'sq. ft.';
					 $lot_size_unit		 = 'sq. ft.';
				} else if( $building_size_unit == 'Square Meters' || $lot_size_unit == 'Acres'){
					 $building_size_unit = 'sq. meters';
					 $lot_size_unit		 = 'sq. meters';
				} 
				if( !empty( $property_data['building_size'] )){
					$building_size		  = $property_data['building_size'] . ' ' . $building_size_unit;
				} else {
					$building_size		  = $property_data['building_size'];
				}
				if( !empty( $property_data['lot_size'] )){
					$lot_size			  = $property_data['lot_size'] . ' ' . $lot_size_unit;
				} else {
					$lot_size			  = $property_data['lot_size'];
				}
				if( !empty( $property_data['openhouse_date_1'] ) ) {
					$openhouse_datetime_1 = $property_data['openhouse_date_1'] . ' ' . $property_data['openhouse_from_hour_1']. ':' . $property_data['openhouse_from_min_1'] .
											' ' . $property_data['openhouse_from_ampm_1'] . '-' . $property_data['openhouse_to_hour_1']. ':' . $property_data['openhouse_to_min_1'] .
											' ' . $property_data['openhouse_to_ampm_1'];
				} else {
					$openhouse_datetime_1 = '';
				}
				if( !empty( $property_data['openhouse_date_2'] ) ) {
					$openhouse_datetime_2 = $property_data['openhouse_date_2'] . ' ' . $property_data['openhouse_from_hour_2']. ':' . $property_data['openhouse_from_min_2'] .
											' ' . $property_data['openhouse_from_ampm_2'] . '-' . $property_data['openhouse_to_hour_2']. ':' . $property_data['openhouse_to_min_2'] .
											' ' . $property_data['openhouse_to_ampm_2'];
				} else {
					$openhouse_datetime_2 = '';
				}
				if( !empty( $property_data['openhouse_date_3'] ) ) {
					$openhouse_datetime_3 = $property_data['openhouse_date_3'] . ' ' . $property_data['openhouse_from_hour_3']. ':' . $property_data['openhouse_from_min_3'] .
											' ' . $property_data['openhouse_from_ampm_3'] . '-' . $property_data['openhouse_to_hour_3']. ':' . $property_data['openhouse_to_min_3'] .
											' ' . $property_data['openhouse_to_ampm_3'];
				} else {
					$openhouse_datetime_3 = '';
				}
				$property_type = '';
				$property_type_arr    = get_the_terms( $property_id, 'aios_tax_property_type' );
				if( !empty( $property_type_arr ) ){
					foreach(  $property_type_arr as $p_type ) {
						$listing['property_type'] = $p_type->name;
						$property_type .= $listing['property_type'] . ', ';
					}				
					$property_type = substr( $property_type , 0 , -2);	
				} else{
					$property_type = '';
				}
				$property_status = '';
				$property_status_arr    = get_the_terms( $property_id, 'aios_tax_property_status' );
				if( !empty( $property_status_arr ) ){
					foreach(  $property_status_arr as $p_status ) {
						$listing['property_status'] = $p_status->name;
						$property_status .= $listing['property_status'] . ', ';
					}
					$property_status = substr( $property_status , 0 , -2);
				}  else{
					$property_status = '';
				}
				$property_features = '';
				$property_features_arr    = get_the_terms( $property_id, 'aios_tax_property_feature' );
				if( !empty( $property_features_arr ) ){
					foreach(  $property_features_arr as $p_features ) {
						$listing['property_features'] = $p_features->name;
						$property_features .= $listing['property_features'] . ', ';
					}
					$property_features = substr( $property_features , 0 , -2);
				}  else{
					$property_features = '';
				}
				if( $no_image == 'yes' ){
					if ( empty ( $featured_image ) ){
						$featured_image = AIOS_ALL_WIDGETS_URL . '/modules/aios-listings-fp/images/no-photo.jpg';
					}
				}
				$shortcode      = array('[listing_title]' , 
										'[listing_list_price]' , 
										'[listing_sold_price]',
										'[listing_featured_image]' ,
										'[listing_url]', 
										'[listing_description]',
										'[listing_street_no]', 
										'[listing_street_name]', 
										'[listing_city]', 
										'[listing_state]',
										'[listing_province]',
										'[listing_zipcode]',
										'[listing_country]',
										'[listing_mls_no]', 
										'[listing_bedrooms]',
										'[listing_bathrooms]', 
										'[listing_garage_spaces]', 
										'[listing_year_built]',
										'[listing_building_size]', 
										'[listing_lot_size]', 
										'[listing_open_house_date_1]', 
										'[listing_open_house_datetime_1]' , 
										'[listing_open_house_date_2]', 
										'[listing_open_house_datetime_2]', 
										'[listing_open_house_date_3]', 
										'[listing_open_house_datetime_3]', 
										'[listing_property_type]', 
										'[listing_property_status]' , 
										'[listing_property_features]');
				$listing_val    = array($listing_title ,
										$list_price ,
										$sold_price ,
										$featured_image ,
										$listing_url, 
										$listing_description ,	
										$property_data['street_number'] ,
										$property_data['street_name'],
										$property_data['city'] ,
										$property_data['state'],
										$property_data['province'] , 
										$property_data['zip_code'], 
										$property_data['country'],  
										$property_data['mls_number'], 
										$property_data['bedrooms'] , 
										$property_data['bathrooms'],
										$property_data['garage_spaces'], 
										$property_data['year_built'], 
										$building_size, $lot_size, 
										$property_data['openhouse_date_1'] ,
										$openhouse_datetime_1, 
										$property_data['openhouse_date_2'] ,
										$openhouse_datetime_2,
										$property_data['openhouse_date_3'] , 
										$openhouse_datetime_3 ,
										$property_type,
										$property_status,
										$property_features);
				
				//replace shortcode with AIOS listing value
				$return_val.= str_replace( $shortcode, $listing_val, $html_layout_loop[1] );

				// for navigation html
				$return_val_child .= str_replace( $shortcode, $listing_val, $html_layout_loop_child[1] );
				
			}
			//footer
			$position		= strpos( $html_layout, '[aios_end_loop]' );
			$return_val    .= substr( $html_layout, $position + strlen('[aios_end_loop]'), strlen( $html_layout ) -1 );

			// for navigation html
			$position_nav			= strpos( $html_layout_nav, '[aios_end_loop]' );
			$return_val_child    	.= substr( $html_layout_nav, $position_nav + strlen('[aios_end_loop]'), strlen( $html_layout_nav ) -1 );

			// Slick
			$slick_enable			= $instance[ 'slick_enable' ];
			$slick_target_id		= $instance[ 'slick_target_id' ];
			$slick_target_id_func	= preg_replace( '/(\#|\.|\-)/', '', $slick_target_id );
			$slick_to_show			= ( empty( $instance[ 'slick_to_show' ] ) ? 1 : $instance[ 'slick_to_show' ] );
			$slick_to_scroll		= ( empty( $instance[ 'slick_to_scroll' ] ) ? 1 : $instance[ 'slick_to_scroll' ] );
			$slick_autoplay			= $instance[ 'slick_autoplay' ];
			$slick_duration			= ( empty( $instance[ 'slick_duration' ] ) ? 1 : $instance[ 'slick_duration' ] );
			$slick_effect			= $instance[ 'slick_effect' ];
			$slick_arrow 			= $instance[ 'slick_arrow' ];
			$slick_dots 			= $instance[ 'slick_dots' ];
			$slick_nav_enable		= $instance[ 'slick_nav_enable' ];
			$slick_nav_target_id	= $instance[ 'slick_nav_target_id' ];
			$slick_nav_target_id_func	= preg_replace( '/(\#|\.|\-)/', '', $slick_nav_target_id );
			$slick_nav_to_show		= ( empty( $instance[ 'slick_nav_to_show' ] ) ? 1 : $instance[ 'slick_nav_to_show' ] );
			$slick_nav_to_scroll	= ( empty( $instance[ 'slick_nav_to_scroll' ] ) ? 1 : $instance[ 'slick_nav_to_scroll' ] );
			$slick_nav_autoplay		= $instance[ 'slick_nav_autoplay' ];
			$slick_nav_duration		= ( empty( $instance[ 'slick_nav_duration' ] ) ? 1 : $instance[ 'slick_nav_duration' ] );
			$slick_nav_effect		= $instance[ 'slick_nav_effect' ];
			$slick_nav_arrow 		= $instance[ 'slick_nav_arrow' ];
			$slick_nav_dots 		= $instance[ 'slick_nav_dots' ];
			$script_val 			= '';

			// Responsive Scripts to add inside slick initialize
			if ( !empty( $slick_enable ) ) {
				$script_val_responsive = 'responsive: [';

					if ( $slick_to_show > 3 ) {
						$script_val_responsive .= '{
			                breakpoint: 992,
			                settings: {
			                    slidesToShow: 3,
								slidesToScroll: 3
							}
						},';
					}

					if ( $slick_to_show > 2 ) {
						$script_val_responsive .= '{
			                breakpoint: 768,
			                settings: {
			                    slidesToShow: 2,
			                    slidesToScroll: 2
			                }
			            },';
					}

					$script_val_responsive .= '{
		                breakpoint: 600,
		                settings: {
		                    slidesToShow: 1,
		                    slidesToScroll: 1
		                }
		            }';
				$script_val_responsive .= ']';

				$script_val .= '<script type="text/javascript">';
					$script_val .= '( function( $ ) {';

						$script_val .= 'function aios_all_listings_' . $slick_target_id_func . '() {';
							$script_val .= 'function getCarouselSetting_' . $slick_target_id_func . '() {';
								$script_val .= 'return {
									slidesToShow: ' . $slick_to_show . ',
									slidesToScroll: ' . $slick_to_scroll . ',
									autoplay:  ' . $slick_autoplay . ',
									autoplaySpeed: ' . $slick_duration . ',
									fade: ' . $slick_effect . ',
									arrows:  ' . $slick_arrow . ',
									dots: ' . $slick_dots . ',
									infinite: true';

									if ( !empty( $slick_nav_enable ) ) {
										$script_val .= ',asNavFor: "' . $slick_nav_target_id . '"';
									}

									if ( $slick_to_show > 2 ) {
										$script_val .= ',' . $script_val_responsive;
									}

								$script_val .= '}';
							$script_val .= '}';
							// End sub function

							$script_val .= '
								$( "' . $slick_target_id . '" ).slick( getCarouselSetting_' . $slick_target_id_func . '() );
								$( window ).on( "load", function() {
						            $( "' . $slick_target_id . '" ).slick( "unslick" );
						            $( "' . $slick_target_id . '" ).slick( getCarouselSetting_' . $slick_target_id_func . '() );
						        } );
							';
							// End Call function to destro and run again
						$script_val .= '}';
						// End main function

						$script_val .= '$( document ).ready( function() { aios_all_listings_' . $slick_target_id_func . '(); } );';
					$script_val .= '} )( jQuery );';

					// If navigation is enable
					if ( !empty( $slick_nav_enable ) ) {
						$script_nav_val_responsive = 'responsive: [';

						if ( $slick_nav_to_show > 3 ) {
							$script_nav_val_responsive .= '{
				                breakpoint: 992,
				                settings: {
				                    slidesToShow: 3,
									slidesToScroll: 3
								}
							},';
						}

						if ( $slick_nav_to_show > 2 ) {
							$script_nav_val_responsive .= '{
				                breakpoint: 768,
				                settings: {
				                    slidesToShow: 2,
				                    slidesToScroll: 2
				                }
				            },';
						}

						$script_nav_val_responsive .= '{
			                breakpoint: 600,
			                settings: {
			                    slidesToShow: 1,
			                    slidesToScroll: 1
			                }
			            }';

					$script_val .= '( function( $ ) {';

						$script_val .= 'function aios_all_listings_nav_' . $slick_nav_target_id_func . '() {';
							$script_val .= 'function getCarouselSetting_' . $slick_nav_target_id_func . '() {';
								$script_val .= 'return {
									slidesToShow: ' . $slick_nav_to_show . ',
									slidesToScroll: ' . $slick_nav_to_scroll . ',
									autoplay:  ' . $slick_nav_autoplay . ',
									autoplaySpeed: ' . $slick_nav_duration . ',
									fade: ' . $slick_nav_effect . ',
									arrows:  ' . $slick_nav_arrow . ',
									dots: ' . $slick_nav_dots . ',
									infinite: true';									
									$script_val .= ',asNavFor: "' . $slick_target_id . '"';							

									if ( $slick_nav_to_show > 2 ) {
										$script_val .= ',' . $script_nav_val_responsive;
									}

								$script_val .= '}';
							$script_val .= '}';
							// End sub function

							$script_val .= '
								$( "' . $slick_nav_target_id . '" ).slick( getCarouselSetting_' . $slick_nav_target_id_func . '() );
								$( window ).on( "load", function() {
						            $( "' . $slick_nav_target_id . '" ).slick( "unslick" );
						            $( "' . $slick_nav_target_id . '" ).slick( getCarouselSetting_' . $slick_nav_target_id_func . '() );
						        } );
							';
							// End Call function to destro and run again
						$script_val .= '}';
						// End main function

						$script_val .= '$( document ).ready( function() { aios_all_listings_nav_' . $slick_nav_target_id_func . '(); } );';
					$script_val .= '} )( jQuery );';
					} // End if of navigation enable
				$script_val .= '</script>';
			}
			if ( empty( $slick_nav_enable ) ) { $return_val_child = ''; }
			// End Slick
			echo $return_val . $return_val_child . $script_val;
		}  else {
			echo "<div>No Property Available.</div>";
		}	
		echo $args['after_widget'];	
	} 
}
// register widget
add_action( 'widgets_init', create_function( '', 'return register_widget("aios_featured_properties");' ) );