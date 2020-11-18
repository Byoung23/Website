<?php
	$aiis_ci_logo = isset( $aiis_ci[ 'logo' ] ) ? $aiis_ci[ 'logo' ] :  '';
	$aiis_ci_ip_logo = isset( $aiis_ci[ 'ip-logo' ] ) ? $aiis_ci[ 'ip-logo' ] :  '';
?>
<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Primary Logo</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<div class="setting-content setting-container setting-container-logo setting-container-parent float-left w-100">
				<div class="setting-logo-preview setting-image-preview">
					<?php 
						if ( !empty( $aiis_ci_logo ) ) {
							echo '<img src="' . $aiis_ci_logo . '">';
						} else {
							echo '<p class="mt-0">No image uploaded</p>';
						}
					?>
				</div>
				<input type="text" class="setting-image-input" name="aiis_ci[logo]" id="aiis_ci[logo]" value="<?=$aiis_ci_logo; ?>" style="display: none;">
				<div class="setting-button">
					<input type="button" class="setting-upload wpui-secondary-button" value="Upload">
					<input type="button" class="setting-remove wpui-default-button" value="Remove">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Secondary Logo</span> Use logo for Inner Pages/Footer/Sotheby's</p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<div class="setting-content setting-container setting-container-ip-logo setting-container-parent float-left w-100">
				<div class="setting-ip-logo-preview setting-image-preview">
					<?php 
						if ( !empty( $aiis_ci_ip_logo ) ) {
							echo '<img src="' . $aiis_ci_ip_logo . '">';
						} else {
							echo '<p class="mt-0">No image uploaded</p>';
						}
					?>
				</div>
				<input type="text" class="setting-image-input" name="aiis_ci[ip-logo]" id="aiis_ci[ip-logo]" value="<?=$aiis_ci_ip_logo; ?>" style="display: none;">
				<div class="setting-button">
					<input type="button" class="setting-upload wpui-secondary-button" value="Upload">
					<input type="button" class="setting-remove wpui-default-button" value="Remove">
				</div>
			</div>
		</div>
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