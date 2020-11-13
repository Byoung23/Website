<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">AdWords Tag Manager ID</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[adwords-id]" id="aios-seotools[adwords-id]" value="<?=$google_adwords_tag_manager_id?>" placeholder="AW-XXXXXXX">
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
			<input type="text" name="aios-seotools[adwords-account-used]" id="aios-seotools[adwords-account-used]" value="<?=$adwords_account_used?>" placeholder="ai-console-1@august99.com">
			<p class="mb-0">List the email address associated with the Google Adwords account. If no email is provided, please specify as Client Account, and any accompanying reference link.</p>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">AdWords Conversion String</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[adwords-conversion-string]" id="aios-seotools[adwords-conversion-string]" value="<?=$google_adwords_conversion_string?>" placeholder="AW-XXXXXXX/AbC-D_efG-h12_34-567">
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Additional Script for Tracking Event Conversion</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<textarea name="aios-seotools[adwords-additional-code]" id="aios-seotools[adwords-additional-code]" style="height: 250px;"><?=$google_adwords_additional_code?></textarea>
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