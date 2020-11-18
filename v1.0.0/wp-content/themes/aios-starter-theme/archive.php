<?php get_header(); ?>
<div id="<?php echo ai_starter_theme_get_content_id('content-sidebar') ?>">
	<section id="content" class="hfeed">
		
		<?php do_action('aios_starter_theme_before_inner_page_content') ?>

		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			<?php /* If this is a category archive */ if (is_category()) { ?>
				<h1 class="archive-title"><?php single_cat_title(); ?></h1>
			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h1 class="archive-title">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h1 class="archive-title">Archive for <?php the_time( get_option( 'date_format' ) ); ?></h1>
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h1 class="archive-title">Archive for <?php the_time( get_option( 'date_format' ) ); ?></h1>
			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h1 class="archive-title">Archive for <?php the_time( get_option( 'date_format' ) ); ?></h1>
			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h1 class="archive-title">Author Archive</h1>
			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1 class="archive-title">Blog Archives</h1>
		<?php } ?>
	
		<?php get_template_part('loop','archive') ?>
		
		<?php do_action('aios_starter_theme_after_inner_page_content') ?>
		
    </section><!-- end #content -->

<?php get_sidebar(); ?>	
</div><!-- end #content-sidebar -->

<?php get_footer(); ?>