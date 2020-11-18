<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Choose which Services</span> Use on Tracking Website Traffic</p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<div class="form-radio-group form-toggle-switch" data-choices="true">
				<div class="form-radio">
					<label><input type="radio" name="aios-seo-website-traffic" value="google-analytics" <?=$google_services == 'google-analytics' ? 'checked=checked' : '' ?>> Google Analytics</label>
				</div>
				<div class="form-radio">
					<label><input type="radio" name="aios-seo-website-traffic" value="google-tag-manager" <?=$google_services == 'google-tag-manager' ? 'checked=checked' : '' ?>> Google Tag Manager</label>
				</div>
				<div class="form-radio">
					<label><input type="radio" name="aios-seo-website-traffic" value="google-adwords" <?=$google_services == 'google-adwords' ? 'checked=checked' : '' ?>> Google AdWords</label>
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