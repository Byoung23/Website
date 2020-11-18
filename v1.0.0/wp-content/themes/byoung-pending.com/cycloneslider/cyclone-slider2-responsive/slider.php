<?php if(!defined('ABSPATH')) die('Direct access denied.'); ?>

<?php

/* Get template folder */
preg_match('/wp-content(.)*/', $this->view_folder, $aios_cycleslider2responsive_folders);
$aios_cycleslider2responsive_folder = home_url() . "/" . str_replace("\\","/",$aios_cycleslider2responsive_folders[0]);

?>

<div tabindex="0" class="cycloneslider cycloneslider-template-responsive cycloneslider-width-<?php echo esc_attr( $slider_settings['width_management'] ); ?>"
    id="<?php echo esc_attr( $slider_html_id ); ?>"
    <?php echo ( 'responsive' == $slider_settings['width_management'] ) ? 'style="max-width:'.esc_attr( $slider_settings['width'] ).'px"' : ''; ?>
    <?php echo ( 'fixed' == $slider_settings['width_management'] ) ? 'style="width:'.esc_attr( $slider_settings['width'] ).'px"' : ''; ?>
    >
    <div class="cycloneslider-slides"
        data-cycle-allow-wrap="<?php echo esc_attr( $slider_settings['allow_wrap'] ); ?>"
        data-cycle-delay="<?php echo esc_attr( $slider_settings['delay'] ); ?>"
        data-cycle-easing="<?php echo esc_attr( $slider_settings['easing'] ); ?>"
        data-cycle-fx="<?php echo esc_attr( $slider_settings['fx'] ); ?>"
        data-cycle-hide-non-active="<?php echo esc_attr( $slider_settings['hide_non_active'] ); ?>"
        data-cycle-log="false"
        data-cycle-next="#<?php echo esc_attr( $slider_html_id ); ?> .cycloneslider-next"
        data-cycle-pager="#<?php echo esc_attr( $slider_html_id ); ?> .cycloneslider-pager"
        data-cycle-pause-on-hover="<?php echo esc_attr( $slider_settings['hover_pause'] ); ?>"
        data-cycle-prev="#<?php echo esc_attr( $slider_html_id ); ?> .cycloneslider-prev"
        data-cycle-slides="&gt; div"
        data-cycle-speed="<?php echo esc_attr( $slider_settings['speed'] ); ?>"
        data-cycle-swipe="<?php echo esc_attr( $slider_settings['swipe'] ); ?>"
        data-cycle-tile-count="<?php echo esc_attr( $slider_settings['tile_count'] ); ?>"
        data-cycle-tile-delay="<?php echo esc_attr( $slider_settings['tile_delay'] ); ?>"
        data-cycle-tile-vertical="<?php echo esc_attr( $slider_settings['tile_vertical'] ); ?>"
        data-cycle-timeout="<?php echo esc_attr( $slider_settings['timeout'] ); ?>"
        >
        <?php foreach($slides as $slide): ?>
            <?php if ( 'image' == $slide['type'] ) : ?>
                <div class="cycloneslider-slide cycloneslider-slide-image" <?php echo $slide['slide_data_attributes']; ?>>
                    <?php if( 'lightbox' == $slide['link_target'] ): ?>
                        <a class="cycloneslider-caption-more magnific-pop" href="<?php echo esc_url( $slide['full_image_url'] ); ?>" alt="<?php echo $slide['img_alt'];?>">
                    <?php elseif ( '' != $slide['link'] ) : ?>
                        <?php if( '_blank' == $slide['link_target'] ): ?>
                            <a class="cycloneslider-caption-more" target="_blank" href="<?php echo esc_url( $slide['link'] );?>">
                        <?php else: ?>
                            <a class="cycloneslider-caption-more" href="<?php echo esc_url( $slide['link'] );?>">
                        <?php endif; ?>
                    <?php endif; ?>
					
					<img class="cycloneslider-slide-js" src="<?php echo $aios_cycleslider2responsive_folder . "/images/blank.gif" ?>" width="1" height="1" alt="<?php echo $slide['img_alt'];?>"
                        title="<?php echo $slide['img_title'];?>" />

                    <canvas width="<?php echo $slider_settings['width'] ?>" height="<?php echo $slider_settings['height'] ?>" style="background-image: url(<?php echo $slide['image_url']; ?>)"></canvas>
					
					<noscript>
						<img src="<?php echo $slide['image_url']; ?>" alt="<?php echo $slide['img_alt'];?>" title="<?php echo $slide['img_title'];?>" />
                    </noscript>
					
                    <?php if( 'lightbox' == $slide['link_target'] or ('' != $slide['link']) ) : ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if(!empty($slide['title']) or !empty($slide['description'])) : ?>
                        <div class="cycloneslider-caption">
                            <div class="cycloneslider-caption-title"><?php echo wp_kses_post( $slide['title'] );?></div>
                            <div class="cycloneslider-caption-description"><?php echo wp_kses_post( $slide['description'] );?></div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php elseif ( 'youtube' == $slide['type'] ) : ?>
                <div class="cycloneslider-slide cycloneslider-slide-youtube" <?php echo $slide['slide_data_attributes']; ?> style="padding-bottom:<?php echo $slider_settings['height']/$slider_settings['width']*100;?>%">
                    <?php echo $slide['youtube_embed_code']; ?>
                </div>
            <?php elseif ( 'vimeo' == $slide['type'] ) : ?>
                <div class="cycloneslider-slide cycloneslider-slide-vimeo" <?php echo $slide['slide_data_attributes']; ?> style="padding-bottom:<?php echo $slider_settings['height']/$slider_settings['width']*100;?>%">
                    <?php echo $slide['vimeo_embed_code']; ?>
                </div>
            <?php elseif ( 'video' == $slide['type'] ) : ?>
                <div class="cycloneslider-slide" <?php echo $slide['slide_data_attributes']; ?>>
                    <p><?php _e('Slide type not supported.', 'cycloneslider'); ?></p>
                </div>
            <?php elseif ( 'custom' == $slide['type'] ) : ?>
                <div class="cycloneslider-slide cycloneslider-slide-custom" <?php echo $slide['slide_data_attributes']; ?>>
                    <?php echo wp_kses_post( $slide['custom'] ); ?>
                </div>
            <?php elseif ( 'testimonial' == $slide['type'] ) : ?>
                <div class="cycloneslider-slide cycloneslider-slide-testimonial" <?php echo $slide['slide_data_attributes']; ?>>
                    <blockquote>
                        <p><?php echo wp_kses_post($slide['testimonial']); ?></p>
                    </blockquote>
                    <?php if ( '' != $slide['testimonial_author'] ) : ?>
                        <?php if( '_blank' == $slide['testimonial_link_target'] ): ?>
                            <p class="cycloneslider-testimonial-author">
                                <a target="_blank" href="<?php echo esc_url( $slide['testimonial_link'] );?>">-<?php echo esc_attr( $slide['testimonial_author'] );?></a>
                            </p>
                        <?php else: ?>
                            <p class="cycloneslider-testimonial-author">
                                <a href="<?php echo esc_url( $slide['testimonial_link'] );?>">-<?php echo esc_attr( $slide['testimonial_author'] );?></a>
                            </p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php if ($slider_settings['show_nav']) : ?>
    <div class="cycloneslider-pager"></div>
    <?php endif; ?>
    <?php if ($slider_settings['show_prev_next']) : ?>
    <a href="#" class="cycloneslider-prev">
        <span class="arrow"></span>
    </a>
    <a href="#" class="cycloneslider-next">
        <span class="arrow"></span>
    </a>
    <?php endif; ?>
	
	<script>
		
		jQuery(document).ready( function() {
			
			/* Define slider function */
			var AIOSCycloneSliderResponsiveSlideshow = function(elem,settings) {
			
				var that = this;
				
				that.settings = settings;
				that.slideshow = jQuery(elem).find(".cycloneslider-slides");
				that.slideshowInitialized = null;
				
				that.initialize();
				that.lazyLoadImages();
				
			};

			AIOSCycloneSliderResponsiveSlideshow.prototype.initialize = function() {
				
				var that = this;
				
				/* Build slideshow */
				that.slideshowInitialized = that.slideshow.cycle(that.settings.cycleOpts);
				
				/* Adjust slideshow size */
				if ( that.settings.widthManagement == 'fixed' ) {
					that.slideshowInitialized.find(".cycloneslider-slide-js").each( function(i,v) {
						var canvas = jQuery("<canvas></canvas>");
						canvas.addClass("cycloneslider-slide-js");
						canvas.width( that.settings.width );
						canvas.height( that.settings.height );
						canvas.attr("data-src",jQuery(v).attr("data-src"));
						jQuery(v).after(canvas);
						jQuery(v).remove();
					});
				}
				
			};



			AIOSCycloneSliderResponsiveSlideshow.prototype.lazyLoadImages = function() {
				
				var that = this;
				
				that.slideshowInitialized.on("cycle-before", function(event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag) {
					that.loadImage( jQuery(incomingSlideEl).find(".cycloneslider-slide-js") );
				});
				
				that.loadImage( that.slideshowInitialized.find(".cycle-sentinel .cycloneslider-slide-js") );
				that.loadImage( that.slideshowInitialized.find(".cycloneslider-slide-image").not(".cycle-sentinel").find(".cycloneslider-slide-js") );
				
			};

			AIOSCycloneSliderResponsiveSlideshow.prototype.loadImage = function(image) {
				
				var src = jQuery(image).attr("data-src");
				
				if ( jQuery(image).is("canvas") ) {
					jQuery(image).css("background-image","url(" + src + ")");
				}
				else {
					jQuery(image).attr("src",src);
				}
				
			};
			
			/* Set variables */
			var settings = {
				cycleOpts : {},
				widthManagement : "<?php echo $slider_settings['width_management'] ?>",
				width : <?php echo $slider_settings['width'] ?>,
				height : <?php echo $slider_settings['height'] ?>
			};
		
			/* Initialize slideshow */
			new AIOSCycloneSliderResponsiveSlideshow( "#<?php echo esc_attr( $slider_html_id ); ?>", settings );
			
		});
		
	</script>
	
</div>