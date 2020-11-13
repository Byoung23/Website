<?php if(!defined('ABSPATH')) die('Direct access denied.'); ?>

<?php
// For description of variables go to: http://www.codefleet.net/cyclone-slider-2/#template-variables
?>
<div class="cycloneslider cycloneslider-template-fixed cycloneslider-width-<?php echo esc_attr( $slider_settings['width_management'] ); ?>"
    id="<?php echo esc_attr( $slider_html_id ); ?>"
    >
    <div class="cycloneslider-fixed-slides cycle-slideshow"
        data-cycle-allow-wrap="<?php echo esc_attr( $slider_settings['allow_wrap'] ); ?>"
        data-cycle-auto-height="false"
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
                <div class="cycloneslider-fixed-slide cycloneslider-slide-image" <?php echo cyclone_slide_settings($slide, $slider_settings); ?>>
                    <?php if( 'lightbox' == $slide['link_target'] ): ?>
                        <a class="cycloneslider-caption-more magnific-pop" href="<?php echo esc_url( $slide['full_image_url'] ); ?>" alt="<?php echo $slide['img_alt'];?>">
                    <?php elseif ( '' != $slide['link'] ) : ?>
                        <?php if( '_blank' == $slide['link_target'] ): ?>
                            <a class="cycloneslider-caption-more" target="_blank" href="<?php echo esc_url( $slide['link'] );?>">
                        <?php else: ?>
                            <a class="cycloneslider-caption-more" href="<?php echo esc_url( $slide['link'] );?>">
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php $image = wp_get_attachment_image_src($slide['id'], 'full') ?>
                    <img src="<?php echo $image[0] ?>" alt="<?php echo $slide['img_alt'];?>" title="<?php echo $slide['img_title'];?>" />
                    
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
                <div class="cycloneslider-slide cycloneslider-slide-custom" <?php echo cyclone_slide_settings($slide, $slider_settings); ?>>
                    <p><?php _e('Slide type not supported.', 'cycloneslider'); ?></p>
                </div>
            <?php elseif ( 'vimeo' == $slide['type'] ) : ?>
                <div class="cycloneslider-slide cycloneslider-slide-custom" <?php echo cyclone_slide_settings($slide, $slider_settings); ?>>
                    <p><?php _e('Slide type not supported.', 'cycloneslider'); ?></p>
                </div>
            <?php elseif ( 'video' == $slide['type'] ) : ?>
                <div class="cycloneslider-slide" <?php echo cyclone_slide_settings($slide, $slider_settings); ?>>
                    <p><?php _e('Slide type not supported.', 'cycloneslider'); ?></p>
                </div>
            <?php elseif ( 'custom' == $slide['type'] ) : ?>
                <div class="cycloneslider-slide cycloneslider-slide-custom" <?php echo cyclone_slide_settings($slide, $slider_settings); ?>>
                    <?php echo wp_kses_post( $slide['custom'] ); ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php if ($slider_settings['show_nav']) : ?>
    <div class="cycloneslider-pager"></div>
    <?php endif; ?>
    <?php if ($slider_settings['show_prev_next']) : ?>
    <a href="#" class="cycloneslider-prev"></a>
    <a href="#" class="cycloneslider-next"></a>
    <?php endif; ?>
	<div class="cyclone-slider-preview-metabox-only">Preview is unavailable</div>
</div>

<script type="text/javascript">

jQuery(document).ready(function(){
	
	/* Define slider function */
	
	var AIOSCycloneSliderFixedSlideshow = function(elem) {
		
		var that = this;
		that.target = jQuery(elem);
		
		that.replaceImagesWithCanvas();
		that.fixSize();
		that.hideUnnecessaryAdminOptions();
		
	};
	
	AIOSCycloneSliderFixedSlideshow.prototype.replaceImagesWithCanvas = function() {
		
		var that = this;
		
		that.target.find("img").each( function(i,v) {
			var img = jQuery(v);
			img.addClass("hidden");
			img.after("<div class='cycloneslider-fixed-slide-image' style='background-image:url("+img.attr("src")+")'></div>");
		});
		
	};
	
	AIOSCycloneSliderFixedSlideshow.prototype.fixSize = function() {
		
		var that = this;

		jQuery(window)
			.on("resize", function() {
				var targetHeight = jQuery(window).height() > screen.height ? jQuery(window).height() : screen.height;
				that.target.height(targetHeight);
			})
			.trigger("resize");
		
	};
	
	AIOSCycloneSliderFixedSlideshow.prototype.hideUnnecessaryAdminOptions = function() {
		
		if ( jQuery(".wp-admin.post-type-cycloneslider .cycloneslider-template-fixed").length > 0 ) {
			jQuery(".wp-admin.post-type-cycloneslider #cycloneslider_settings_width_management").parents(".cycloneslider-field").hide();
			jQuery(".wp-admin.post-type-cycloneslider #cycloneslider_settings_resize").parents(".cycloneslider-field").hide();
			jQuery(".wp-admin.post-type-cycloneslider #cycloneslider_settings_width").parents(".cycloneslider-field").hide();
			jQuery(".wp-admin.post-type-cycloneslider #cycloneslider_settings_height").parents(".cycloneslider-field").hide();
		}
		
	};
	
	/* Initialize slideshow */

	new AIOSCycloneSliderFixedSlideshow("#"+"<?php echo esc_attr( $slider_html_id ); ?>");
	
});

</script>