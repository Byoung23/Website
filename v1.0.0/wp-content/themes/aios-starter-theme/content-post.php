<?php if(have_posts()) : ?>
		
	<?php while(have_posts()) : the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
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