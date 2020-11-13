<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Include Map(Required)</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[rs-geo-url]" id="aios-seotools[rs-geo-url]" value="<?=$rs_geo_url?>" placeholder="https://www.google.com/maps/">
			<span class="form-group-description">
				<strong>How to obtain a Google map URL of your business:</strong><br>
				1. Go to google.com/maps and search for your business by name.<br>
				2. Next, click on the “hamburger menu” in the search field.<br>
				3. Select “Share or embed map”<br>
				4. Then copy and paste the URL or use the short URL.<br>
				<strong>Sample URL</strong>: https://goo.gl/maps/jV5ZXJJ5oaP2</span>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<!-- <div class="wpui-row wpui-row-box wpui-temporary-hide">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Latitude(Optional)</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[rs-geo-latitude]" id="aios-seotools[rs-geo-latitude]" value="< ?=$rs_geo_latitude?>" placeholder="33.9287294" readonly>
		</div>
	</div>
</div> -->
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<!-- <div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Longitude(Optional)</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[rs-geo-longitude]" id="aios-seotools[rs-geo-longitude]" value="< ?=$rs_geo_longitude?>" placeholder="-118.3977663" readonly>
		</div>
	</div>
</div> -->
<!-- END: Row Box -->

<div class="wpui-row wpui-row-submit">
	<div class="wpui-col-md-12">
		<div class="form-group">
			<input type="submit" class="save-option-ajax wpui-secondary-button text-uppercase" value="Save Changes">
		</div>
	</div>
</div>