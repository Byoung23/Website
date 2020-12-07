<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Disable User Confirmation</span></p>
	</div>
	<div class="wpui-col-md-9">
        <div class="form-group">
            <div class="form-checkbox-group">
                <div class="form-checkbox">
                    <label><input id="<?=$user_confirmation?>" name="<?=$user_confirmation?>" type="checkbox" value="1" <?=checked($opt_user_confirmation, '1', false)?>> Disabled</label>
                </div>
            </div>
        </div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Font family, size, and color</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="wpui-row">
			<div class="wpui-col-md-6">
				<div class="form-group">
					<select name="<?=$name_fonts_user?>" id="<?=$name_fonts_user?>" class="w-100">
						<?php
							foreach ( $safe_fonts as $fonts_cat => $fonts) {
								echo '<optgroup label="' . ucwords( str_replace( '-', ' ', $fonts_cat ) ) . '">';
									foreach ( $fonts as $font ) {
										$ofont = $font . ', ' . $fonts_cat;
										echo '<option value="' . $ofont . '" ' . ( selected( $fonts_user, $ofont, false ) ) . ' style="font-family: ' . $font . ';">' . $font . '</option>';
									}
								echo '</optgroup>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="wpui-col-md-2">
				<div class="form-group">
					<select name="<?php echo $name_fonts_size_user; ?>" id="<?php echo $name_fonts_size_user; ?>" class="w-100">
						<?php
							foreach ( $font_sizes as $font_size ) {
								echo '<option value="' . $font_size . '" ' . ( selected( $fonts_size_user, $font_size, false ) ) . ' style="font-size: ' . $font_size . 'px;">' . $font_size . 'px</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="wpui-col-md-4">
				<div class="form-group">
					<input type="text" class="aios-color-picker" data-alpha="false" data-default-color="#000" name="<?php echo $name_fonts_color_user; ?>" id="<?php echo $name_fonts_color_user; ?>" value="<?php echo $fonts_color_user; ?>">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Header</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<?php
				$custom_header_content = $header_user;
				$custom_header_id = $name_header_user;
				$custom_header_setting = array(
					'wpautop'		=> false,
					'media_buttons' => true,
					'tinymce' 		=> false,
					'textarea_rows' => 5,
					'tabindex' 		=> 1,
					'textarea_name' => $custom_header_id, // Editor #ID
				);

				wp_editor( 
					$custom_header_content, 
					$custom_header_id, 
					$custom_header_setting
				);
			?>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Intro Text</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<?php
				$custom_header_content = $intro_user;
				$custom_header_id = $name_intro_user;
				$custom_header_setting = array(
					'wpautop'		=> false,
					'media_buttons' => true,
					'tinymce' 		=> false,
					'textarea_rows' => 5,
					'tabindex' 		=> 1,
					'textarea_name' => $custom_header_id, // Editor #ID
				);

				wp_editor( 
					$custom_header_content, 
					$custom_header_id, 
					$custom_header_setting
				);
			?>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Closing Text</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<?php
				$custom_header_content = $closing_user;
				$custom_header_id = $name_closing_user;
				$custom_header_setting = array(
					'wpautop'		=> false,
					'media_buttons' => true,
					'tinymce' 		=> false,
					'textarea_rows' => 5,
					'tabindex' 		=> 1,
					'textarea_name' => $custom_header_id, // Editor #ID
				);

				wp_editor( 
					$custom_header_content, 
					$custom_header_id, 
					$custom_header_setting
				);
			?>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Footer</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<?php
				$custom_footer_content = $footer_user;
				$custom_footer_id = $name_footer_user;
				$custom_footer_setting = array(
					'wpautop'		=> false,
					'media_buttons' => true,
					'tinymce' 		=> false,
					'textarea_rows' => 10,
					'tabindex' 		=> 2,
					'textarea_name' => $custom_footer_id, // Editor #ID
				);

				wp_editor( 
					$custom_footer_content, 
					$custom_footer_id, 
					$custom_footer_setting
				);
			?>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Preview</span></p>
	</div>
	<div class="wpui-col-md-9">
		<?php include_once( 'user-preview.php' ); ?>
	</div>
</div>
<!-- END: Row Box -->

<div class="wpui-row wpui-row-submit">
	<div class="wpui-col-md-12">
		<div class="form-group">
			<input type="submit" class="save-option-ajax wpui-secondary-button text-uppercase" value="Save Changes">
		</div>
	</div>
</div>