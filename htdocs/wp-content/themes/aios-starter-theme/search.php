<?php get_header(); ?>
<div id="<?php echo ai_starter_theme_get_content_id('content-sidebar') ?>">
	<section id="content" class="hfeed">
	
	<?php do_action('aios_starter_theme_before_inner_page_content') ?>
	
	<h1 class="archive-title">Search Results for &#8216;<?php printf( get_search_query() ); ?>&#8217;</h1>
    
    <?php get_search_form(); ?>
	
	<?php get_template_part('loop','archive') ?>
	
	<?php do_action('aios_starter_theme_after_inner_page_content') ?>
	
    </section><!-- end #content -->

<?php get_sidebar(); ?>	
</div><!-- end #content-sidebar -->

<?php get_footer(); ?>