<div class="wrap" style="clear:both;">
	<div class="wrap aios-seo-setting">
		<h1>SEO Tools</h1>
		<?php
			//we check if the page is visited by click on the tabs or on the menu button.
			//then we get the active tab.
			$active_tab = "general";
			if( isset( $_GET["tab"] ) ) {
				if( $_GET["tab"] == "rich-snippet" ) {
					$active_tab = "rich-snippet";
				} elseif( $_GET["tab"] == "goal-cf7" ) {
					$active_tab = "goal-cf7";
				} else {
					$active_tab = "general";
				}
			}


			$seo_option 	= get_option( 'aios-seotools' );
			// Check if SEO client
			$seo_spr 		= !empty( $seo_option[ 'seo-product-verification' ] ) ? 'seoclient' : 'seoclient';
			$seo_client 	= $seo_spr == 'seoclient' ? 'checked="checked"' : '';
			$seo_fields 	= $seo_spr != 'seoclient' ? 'style="display: none;"' : '';

			// Check if GTAG
			$seo_gtag 				= !empty( $seo_option[ 'gtag' ] ) ? 'gtag' : 'gtag';
			$seo_use_gtag 			= $seo_gtag == 'gtag' ? 'checked="checked"' : '';
		?>
		<!-- wordpress provides the styling for tabs. -->
		<h2 class="nav-tab-wrapper">
			<a href="?page=aios-seo-tools&tab=general" class="nav-tab <?php if($active_tab == 'general'){echo 'nav-tab-active';} ?> ">
				General
			</a>
			<a href="?page=aios-seo-tools&tab=rich-snippet" class="nav-tab <?php if($active_tab == 'rich-snippet'){echo 'nav-tab-active';} ?>" <?=$seo_fields?>>
				Rich Snippet
			</a>
			<a href="?page=aios-seo-tools&tab=goal-cf7" class="nav-tab <?php if($active_tab == 'goal-cf7'){echo 'nav-tab-active';} ?>" <?=$seo_fields?>>
				Goals
			</a>
		</h2>
		<?php 
			if ( $active_tab == "general" ) {
				echo '<style>#seo-tab-general{display:block;}</style>';
	    	} elseif ( $active_tab == "rich-snippet" ) {
				echo '<style>#seo-tab-rich-snipper{display:block;}</style>';
			}

			if ( $active_tab == "goal-cf7" ) {
				echo '<style>#seo-tab-goals{display:block;}</style>';
			?>
				<div id="seo-tab-goals">
					<h2>Google Analytics Goals(Contact Form 7 - <?php echo get_plugin_data( ABSPATH . 'wp-content/plugins/contact-form-7/wp-contact-form-7.php' )['Version']; ?>)</h2>
					<div class="aios-clear"></div>
					<div class="aios-wrap-column" <?php echo $seo_fields ?>>
						<div class="aios-ga-goals aios-seotools-wrapper">
							<?php require_once( 'display/wpcf7-additional-settings.php' ); ?>
						</div>			
						<!-- End Contact Form 7 Wrapper -->
					</div>
					<!-- End Column -->
				</div>
			<?php
			} else {
			?>
				<form method="post" action="options.php">
			    <?php 
			    	settings_fields( 'aios-seotools-setting' );
			    	do_settings_sections( 'aios-seotools-setting' ); 
	   			?>
	   			<div id="seo-tab-general">
					<h2>General</h2>
					<div class="aios-clear"></div>
					<div class="seo-product-verification">
						<label for="aios-seotools[seo-product-verification]">
					    	<input type="checkbox" name="aios-seotools[seo-product-verification]" id="aios-seotools[seo-product-verification]" 
					    	<?=$seo_client?>> SEO Client							
						</label>
				    </div>
					<div class="seo-product-verification">
						<label for="aios-seotools[gtag]">
					    	<input type="checkbox" name="aios-seotools[gtag]" id="aios-seotools[gtag]" 
							<?=$seo_use_gtag?>> Use Google Tag Manager
						</label>
				    </div>
				    <!-- End SEO Product verification -->
					<div class="aios-wrap-column">
						<div class="aios-webmaster aios-seotools-wrapper">
							<?php require_once( 'display/site-verification.php' ); ?>
						</div>
						<hr>
						<!-- End Site Verification -->
						<?php
							if ( $seo_gtag == 'gtag' ) {
								?>
									<div class="aios-gtag aios-seotools-wrapper">
										<?php require_once( 'display/google-tag-manager.php' ); ?>
									</div>
								<?php
							} else {
								?>
									<div class="aios-google-analytics aios-seotools-wrapper">
										<?php require_once( 'display/google-analytics.php' ); ?>
									</div>
								<?php
							}
						?>
						<hr <?=$seo_fields ?>>
						<!-- End Google Analytics -->
						<div class="aios-google-plus-publisher aios-seotools-wrapper" <?=$seo_fields ?>>
							<?php require_once( 'display/google-plus-publisher.php' ); ?>
						</div>
						<hr <?=$seo_fields ?>>
						<!-- End Google Plus Publisher -->
					</div>
					<!-- End Column -->
				</div>
	   			<div id="seo-tab-rich-snipper" <?=$seo_fields?>>
					<h2>Rich Snippet</h2>
					<div class="aios-clear"></div>
					<div class="aios-rich-snippet aios-seotools-wrapper" <?=$seo_fields ?>>
						<?php require_once( 'display/rich-snippet.php' ); ?>
					</div>
					<!-- End Rich Snippet -->
				</div>
				<div class="aios-seotools-submit">
					<?php submit_button(); ?>
				</div>
				<!-- End Submit -->
			</form>
			<!-- End Form -->
			<?php
			}
		?>
	</div>
</div>
<!-- End Wrap -->