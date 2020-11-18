<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Tracking Code</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[ga-tracking-code]" id="aios-seotools[ga-tracking-code]" value="<?=$google_analytics_code?>" placeholder="UA-XXXXXXXX-YY">
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
			<input type="text" name="aios-seotools[ga-account-used]" id="aios-seotools[ga-account-used]" value="<?=$ga_account_used?>" placeholder="ai-console-1@august99.com">
			<p class="mb-0">List the email address associated with the Google Analytics account. If no email is provided, please specify as Client Account, and any accompanying reference link.</p>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Additional UA Code</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<textarea name="aios-seotools[ga-additional-code]" id="aios-seotools[ga-additional-code]" style="height: 250px;"><?=$google_analytics_additional_code?></textarea>
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