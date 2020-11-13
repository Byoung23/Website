<div id="aios-mobile-header-wrapper-<?php echo $instance_id ?>" class="<?=$args['widget_id']?> aios-mobile-header-wrapper <?php echo "aios-mobile-header-wrapper-breakpoint-" . $breakpoint ?>">
		
	<div class="amh-fixed-header-nav amh-area-wrap">
		<div class="amh-header-buttons amh-3a amh-clearfix">

			<div class="amh-navigation-trigger"><div class="ai-menu"></div></div>
			<div class="amh-center">
				<?php if ( !$phone_hide ) : ?>
					<a href="tel:<?php echo do_shortcode( $phone ) ?>" class="amh-phone"><span class="ai-phone"><span class="amh-phone-text-hide"><?php echo do_shortcode( $phone ) ?></span></span></a>
				<?php endif ?>
			</div>
			
			<div class="amh-header-right-btn">
				<?php if ( !$email_hide ) : ?>
					<?php if ( !shortcode_exists('mail_to') ) : ?>
						<a class="amh-email" href="mailto:<?php echo do_shortcode( $email )?>"><span class="ai-envelope-f"><span class="amh-email-text-hide"><?php echo do_shortcode( $email )?></span></span></a>
					<?php elseif ( shortcode_exists('mail_to') ) : ?>
						<?php echo do_shortcode( '[mail_to email="' . do_shortcode( $email ) . '"]<span class="amh-email"><span class="ai-envelope-f"><span class="amh-email-text-hide">' . do_shortcode( $email ) . '</span></span></span>[/mail_to]' ) ?>
					<?php endif ?>
				<?php endif ?>
			</div>
			

		</div><!-- end of buttons -->

		<div class="amh-navigation amh-nav-1">
			<?php
			
			wp_nav_menu( array( 
				'menu'=>$menu_id,
				'menu_id'=>('amh-menu' . $instance_id),
				'menu_class'=>'amh-menu',
				'walker'=>new AIOS_Mobile_Header_Menu()
			));
			
		?>
		</div><!-- end of navigation -->

	</div><!-- end of fixed header and anv -->
	
	<!-- SCRIPTS -->
	
	<script>
	
		jQuery(document).ready( function() {
			
			var instanceId = 'aios-mobile-header-wrapper-<?php echo $instance_id ?>';
			var header = jQuery("#" + instanceId);
			var trigger = header.find(".amh-navigation-trigger");
			var nav = header.find(".amh-navigation");
			var position = '<?php echo $behavior == '' ? 'bottom' : $behavior ?>';
			
			nav.aiosMobileHeaderNavigation({
				trigger: trigger,
				attachment: header,
				position: position
			});
			
			header.find(".amh-fixed-header-nav").aiosMobileHeader();
			
		});
		
	</script>
	
	<!-- END SCRIPTS -->
	

</div><!-- end of ampl wrapper -->