<?php get_header(); ?>

<div class="navigate-sections">
	<ul class="nav-dots-list">
		<li class="nav-dot active" data-id="#slideshow">
			<a href="#slideshow" data-offset="0" data-speed="400" class="aios-scroll-to">
				<i class="nav-dot-icon"></i>
				<span class="nav-dot-text">Home</span>
			</a>
		</li>
		<li class="nav-dot" data-id="#welcome">
			<a href="#welcome" data-offset="59" data-speed="400" class="aios-scroll-to">
				<i class="nav-dot-icon"></i>
				<span class="nav-dot-text">Welcome</span>
			</a>
		</li>
		<li class="nav-dot" data-id="#map">
			<a href="#map" data-offset="59" data-speed="400" class="aios-scroll-to">
				<i class="nav-dot-icon"></i>
				<span class="nav-dot-text">Areas of Expertise</span>
			</a>
		</li>
		<li class="nav-dot" data-id="#featured-communities">
			<a href="#featured-communities" data-offset="59" data-speed="400" class="aios-scroll-to">
				<i class="nav-dot-icon"></i>
				<span class="nav-dot-text">Featured Communities</span>
			</a>
		</li>
		<li class="nav-dot" data-id="#featured-properties">
			<a href="#featured-properties" data-offset="59" data-speed="400" class="aios-scroll-to">
				<i class="nav-dot-icon"></i>
				<span class="nav-dot-text">Featured Properties</span>
			</a>
		</li>
		<li class="nav-dot" data-id="#testimonials">
			<a href="#testimonials" data-offset="59" data-speed="400" class="aios-scroll-to">
				<i class="nav-dot-icon"></i>
				<span class="nav-dot-text">Client Testimonials</span>
			</a>
		</li>
		<li class="nav-dot" data-id=".footer-wrapper">
			<a href=".footer-wrapper" data-offset="59" data-speed="400" class="aios-scroll-to">
				<i class="nav-dot-icon"></i>
				<span class="nav-dot-text">Get In Touch</span>
			</a>
		</li>
	</ul>
	<span>Scroll Down</span>
</div>

<section class="section-1">
	<h2 class="hidden">Section 1</h2>
	<article id="slideshow">
		<h2 class="hidden">Slideshow</h2>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("hp_slide") ) : ?><?php endif ?>
	</article>
	<article id="quick-search">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("hp_qs") ) : ?><?php endif ?>

	</article>
</section>

<section class="section-2 zindex">
	<h2 class="hidden">Section 2</h2>
	<article id="call-to-action">
		<h3 class="hidden">Call to Action</h3>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("hp_cta") ) : ?><?php endif ?>

	</article>
	<div id="welcome">
		<div class="welcome-top">
			<div class="container">
				<div class="row">
					<div class="col-md-8 welcome-left">
						<div class="welcome-content">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("hp_welc") ) : ?><?php endif ?>

						</div>
					</div>
					<div class="col-md-4 welcome-right">
						<div class="agent-photo">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("hp_ap1") ) : ?><?php endif ?>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-gap"></div>
	</div>
	<article id="map">
		<div class="container">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("hp_aoe") ) : ?><?php endif ?>

		</div>
	</article>
	<div class="section-gap"></div>
	<article id="featured-communities">
		<div class="container">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("hp_fc") ) : ?><?php endif ?>

		</div>
	</article>

	<article id="featured-properties">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("hp_fp") ) : ?><?php endif ?>

	</article>

	<article id="testimonials">
		<div class="container">
			<div class="row">
				<div class="testi-photo col-md-4">
					<div class="testi-agent">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("hp_ap2") ) : ?><?php endif ?>
						
					</div>					
				</div>
				<div class="testi-box col-md-8">
					<div class="testi-inner">
						<div class="testi-container">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("hp_testi") ) : ?><?php endif ?>

						</div>
					</div>
				</div>				
			</div>
		</div>
	</article>
	<div class="section-gap-2"></div>

</section>

<?php get_footer(); ?>
