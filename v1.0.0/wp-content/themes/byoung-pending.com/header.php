<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta id="viewport-tag" name="viewport" content="width=device-width, initial-scale=1"/>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php if ( has_action( 'aios_seotools_gtm_body' ) ) { do_action('aios_seotools_gtm_body'); } ?>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Mobile Header") ) : ?><?php endif ?>
	
	<div id="main-wrapper">
	
	
	<header class="header-wrapper">
		<div class="container">
			<div class="hdr-top">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("hdr_btn") ) : ?><?php endif ?>

			</div>
			<div class="hdr-bottom">
				<div class="hdr-logo">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("hdr_logo") ) : ?><?php endif ?>

				</div>
				<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_id' => 'nav', 'menu_class' => 'nav-menu', 'theme_location' => 'primary-menu' ) ); ?>
			</div>
		</div>
	</header>

	<div class="fixed-header-wrapper mob_hidden">
		<div class="container">
			<div class="f-hdr-logo">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("hdr_logo") ) : ?><?php endif ?>

			</div>
			<div class="f-hdr-navs">
				<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_id' => 'nav_fixed', 'menu_class' => 'nav', 'theme_location' => 'primary-menu' ) ); ?>
			</div>
			<div class="f-hdr-btn">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("hdr_btn") ) : ?><?php endif ?>
				
			</div>
		</div>
	</div>
	
	<main>

		<!-- <div class="ppop-wrap">
			<?php // if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("ston") ) : ?><?php //endif ?>

		</div> -->

		<div class="gc-wrap">
			<div class="gc-inner">
				<div class="gc-menu">
					<div class="gc-logo">
						<a href="<?php echo home_url(); ?>">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo-popup.png" alt="Benjamin the Broker">
						</a>
					</div>
				</div>
				<div class="gc-content">
					<div class="container">
						<div class="row">
							<div class="col-md-7 col-md-offset-5">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("get_connected") ) : ?><?php endif ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<h2 class="aios-starter-theme-hide-title">Main Content</h2>
		<?php if ( !is_home() ) : ?>
		
		<div class="ip-banner">
			<canvas width="1600" height="361"></canvas>
		</div>

		<div id="inner-page-wrapper">
			<div class="container">
		<?php endif ?>