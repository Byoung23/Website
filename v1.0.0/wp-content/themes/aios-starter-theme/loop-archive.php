<?php if(have_posts()) : ?>

	<?php while(have_posts()) : the_post(); ?>
			
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry">
				<?php if ( has_post_thumbnail() ) : ?>
                    <div class="archive-thumbnail">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                    </div>
                <?php endif ?>
				<div class="archive-content <?php echo has_post_thumbnail() ? "archive-has-thumbnail" : "" ?>">
					<h2 class="archive-subtitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php if ( has_excerpt( get_the_ID() ) ) : ?>
						<?php the_excerpt(); ?>
					<?php else: ?>
						<?php echo ai_starter_theme_truncate_string( strip_tags( strip_shortcodes( get_the_content() ) ), 244, "..." ) ?>
					<?php endif ?>
					<p><a class="archive-more" href="<?php the_permalink() ?>">Read more</a></p>
				</div>
				<div class="clearfix"></div>

			</div>

		</article>
		
	<?php endwhile; ?>

	<div class="page-links">
		<?php echo paginate_links(); ?>
	</div>

<?php else: ?>
	<p>Coming soon...</p>
<?php endif ?>