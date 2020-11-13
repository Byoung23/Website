<?php get_header(); ?>
<div id="<?php echo ai_starter_theme_get_content_id('content-sidebar') ?>">
	<article id="content" class="hfeed">
		
		<?php do_action('aios_starter_theme_before_inner_page_content') ?>
		
		<?php if(have_posts()) : ?>
				
			<?php while(have_posts()) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									
					<?php do_action('aios_starter_theme_before_entry_content') ?>
					
					<div class="entry entry-content">	
						<?php the_content(); ?>
					</div>
					
					<?php do_action('aios_starter_theme_after_entry_content') ?>

				</div>

			<?php endwhile; ?>

			<div class="navigation">
				<?php wp_link_pages(); ?>
			</div>

		<?php endif; ?>	

		<?php do_action('aios_starter_theme_after_inner_page_content') ?>
		
    </article><!-- end #content -->
    
    <?php get_sidebar(); ?>	
</div><!-- end #content-sidebar -->

<?php get_footer(); ?>
