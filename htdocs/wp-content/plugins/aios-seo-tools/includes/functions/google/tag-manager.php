<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Google Tag Manager ID</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[gtag-id]" id="aios-seotools[gtag-id]" value="<?=$google_tag_manager_id?>" placeholder="GTM-XXXXXXX">
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Account Used</span><em>Reference</em></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[gtag-account-used]" id="aios-seotools[gtag-account-used]" value="<?=$gtag_account_used?>" placeholder="ai-console-1@august99.com">
			<p class="mb-0">List the email address associated with the Google Tag Manager account. If no email is provided, please specify as Client Account, and any accompanying reference link.</p>
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