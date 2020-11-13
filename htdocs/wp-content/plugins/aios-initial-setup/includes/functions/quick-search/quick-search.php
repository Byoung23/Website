<?php 
	$quick_search 		= get_option( 'aios-quick-search' );
	$enabled 			= isset( $quick_search['enabled'] ) ? $quick_search['enabled'] : '';
	$disabled_bootstrap = isset( $quick_search['disabled_bootstrap'] ) ? $quick_search['disabled_bootstrap'] : '';
	$cid 				= isset( $quick_search['cid'] ) ? $quick_search['cid'] : '';
	$cityId 			= $quick_search['cityId'] == 'cityId' ? 'checked' : '';
	$zip 				= $quick_search['zip'] == 'zip' ? 'checked' : '';
	$neighborhood 		= $quick_search['neighborhood'] == 'neighborhood' ? 'checked' : '';
	$mlsarea 			= $quick_search['mlsarea'] == 'mlsarea' ? 'checked' : '';
	$mls 				= $quick_search['mls'] == 'mls' ? 'checked' : '';
	$address 			= $quick_search['address'] == 'mls' ? 'checked' : '';
	$enable_single_qs   = isset( $quick_search['enable_single_qs'] ) ? $quick_search['enable_single_qs'] : '';
?>
<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p class="mt-0"><span class="wpui-settings-title">Enable Quick Search</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<div class="form-checkbox-group">
				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-quick-search[enabled]" id="enabled" value="1" <?= $enabled == 1 ? 'checked=checked' : '' ?>> Activate options and usage
					</label>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p class="mt-0"><span class="wpui-settings-title">Single Select</span> If not checked, the QS will default to Multiple selection.</p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<div class="form-checkbox-group">
				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-quick-search[enable_single_qs]" id="enable_single_qs" value="1" <?= $enable_single_qs == 1 ? 'checked=checked' : '' ?>> Restrict Auto Complete to single selection only.
						<span class="form-group-description">Recommended option if MLS # or Address search is enabled.</span>
					</label>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: Row Box -->



<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Generate JSON</span> This option is for iHomeFinder clients only.</p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-quick-search[cid]" placeholder="Enter Cleint ID(iHomeFinder)" value="<?=$cid?>">
		</div>
		<div class="form-group">
			<label for=""></label>
			<div class="form-checkbox-group-horizontal pt-1">
				<div class="form-checkbox">
					<label><input type="checkbox" class="aios-quick-search-types"  name="aios-quick-search[cityId]" value="cityId" <?=$cityId?>> City</label>
				</div>
				<div class="form-checkbox">
					<label><input type="checkbox" class="aios-quick-search-types"  name="aios-quick-search[zip]" value="zip" <?=$zip?>> Zip</label>
				</div>
				<div class="form-checkbox">
					<label><input type="checkbox" class="aios-quick-search-types"  name="aios-quick-search[neighborhood]" value="neighborhood" <?=$neighborhood?>> Neighborhood</label>
				</div>
				<div class="form-checkbox">
					<label><input type="checkbox" class="aios-quick-search-types"  name="aios-quick-search[mlsarea]" value="mlsarea" <?=$mlsarea?>> MLS Area</label>
				</div>
				<div class="form-checkbox">
					<label><input type="checkbox" class="aios-quick-search-types"  name="aios-quick-search[mls]" value="mls" <?=$mls?>> MLS #</label>
				</div>

				<div class="form-checkbox" style="margin-left: 0px; clear: both; margin-top: 20px;">
					<label><input type="checkbox" class="aios-quick-search-types"  name="aios-quick-search[address]" value="address" <?=$address?>> Address</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<a href="#" class="wpui-default-button text-uppercase" id="ihf-generate-json">Generate JSON</a>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">JSON String</span> For iHomFinder clients this will be auto-generate the json string but for non-iHomFinder this will need to generate manually.</p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<textarea name="aios-quick-search-option" id="aios-quick-search-option" placeholder='{
	"cityId":
	[
		{ "value": "12313", "text": "Adams", "type": "cityId[]"},
		{ "value": "32122", "text": "Adrian", "type": "cityId[]"}
	],
	"zip":
	[
		{ "value": "87192", "text": "87192", "type": "zip[]"},
		{ "value": "34551", "text": "34551", "type": "zip[]"}
	]
}' style="min-height: 300px; resize: none;"><?=stripslashes( get_option('aios-quick-search-option') )?></textarea>
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