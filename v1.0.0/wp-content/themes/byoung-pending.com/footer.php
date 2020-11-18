		<?php if ( !is_home() ) : ?>
			<div class="clearfix"></div>
			</div><!-- end of #inner-page-wrapper .inner -->
			</div><!-- end of #inner-page-wrapper -->
		<?php endif ?>
	</main>
	
	<footer class="footer-wrapper">
		<div class="footer-top">
			<div class="ftr-half ftr-git">
				<div class="git-wrap">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("ftr_git") ) : ?><?php endif ?>

				</div>
			</div>
			<div class="ftr-half ftr-right-bg"></div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="ftr-logo">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("ftr_logo") ) : ?><?php endif ?>

				</div>
				<div class="ftr-last">
					<div class="ftr-nav">
						<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_class' => 'footernav', 'theme_location' => 'secondary-menu','depth'=>1 ) ); ?>		
					</div>
					<div class="ftr-credits">
						&copy; <?php echo date('Y') ?>. <strong>BENJAMIN YOUNG</strong>. All rights reserved. <a href="<?php echo home_url(); ?>/sitemap/">Sitemap</a> | <?php echo do_shortcode('[agentimage_credits credits="Real Estate Website Design by <a target="_blank" href="https://www.agentimage.com" style="text-decoration:underline;font-weight:bold">Agent Image</a>"]') ?>
						<span class="ftr-icons">
							<i class="ai-font-eho"></i>
							<i class="ai-font-mls"></i>
							<i class="ai-font-realtor"></i>
						</span>
					</div>
				</div>
			</div>
		</div>
	</footer>

	</div><!-- end of #main-wrapper -->


	<?php wp_footer(); ?>
</body>
</html>
