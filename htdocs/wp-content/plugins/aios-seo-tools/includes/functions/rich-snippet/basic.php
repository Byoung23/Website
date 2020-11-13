<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Type</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<label for="aios-seotools[rs-property]"></label>
			<select name="aios-seotools[rs-property]" id="aios-seotools[rs-property]">
				<option value="RealEstateAgent" <?=( $rs_property == 'RealEstateAgent' ? 'selected="selected"' : '' ) ?>>RealEstateAgent</option>
				<option value="Organization" <?=( $rs_property == 'Organization' ? 'selected="selected"' : '' ) ?>>Organization</option>
			</select>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Name</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[rs-name]" id="aios-seotools[rs-name]" value="<?=$rs_name?>">
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Street Address</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[rs-address]" id="aios-seotools[rs-address]" value="<?=$rs_address?>" placeholder="e.g. 1600 Amphitheatre Pkwy">
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Locality</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[rs-locality]" id="aios-seotools[rs-locality]" value="<?=$rs_locality?>" placeholder="City/Town/Municipality(e.g. Los Angeles)">
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Region</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[rs-region]" id="aios-seotools[rs-region]" value="<?=$rs_region?>" placeholder="Region Abb(e.g. CA)">
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Postal Code</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[rs-postal-code]" id="aios-seotools[rs-postal-code]" value="<?=$rs_postal_code?>">
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Contact Type</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<select name="aios-seotools[rs-contact-type]" id="aios-seotools[rs-contact-type]">
				<option value="Sales" <?=($rs_contact_type == 'Sales' ? 'selected="selected"' : '')?>>Sales</option>
				<option value="Customer Support" <?=($rs_contact_type == 'Customer Support' ? 'selected="selected"' : '')?>>Customer Support</option>
				<option value="Billing Support" <?=($rs_contact_type == 'Billing Support' ? 'selected="selected"' : '')?>>Billing Support</option>
				<option value="Bill Payment" <?=($rs_contact_type == 'Bill Payment' ? 'selected="selected"' : '')?>>Bill Payment</option>
				<option value="Reservations" <?=($rs_contact_type == 'Reservations' ? 'selected="selected"' : '')?>>Reservations</option>
				<option value="Credit Card Support" <?=($rs_contact_type == 'Credit Card Support' ? 'selected="selected"' : '')?>>Credit Card Support</option>
			</select>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Telephone</span> Must have country code</p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[rs-telephone]" id="aios-seotools[rs-telephone]" value="<?=$rs_telephone?>" placeholder="+1-877-746-0909">
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Email Address</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="email" name="aios-seotools[rs-email]" id="aios-seotools[rs-email]" value="<?=$rs_email?>">
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Reference Web page(Social Media, Blog, App Site)</span> Enter Site separated by new lines</p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<textarea name="aios-seotools[rs-reference]" id="aios-seotools[rs-reference]" placeholder=""><?=$rs_reference?></textarea>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Site Description</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<textarea name="aios-seotools[rs-description]" id="aios-seotools[rs-description]" placeholder="Short Description"><?=$rs_description?></textarea>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Photo</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<div class="setting-content setting-container setting-container-logo setting-container-parent float-left w-100">
				<div class="setting-logo-preview setting-image-preview">
					<?php 
						if ( !empty ( $rs_photo ) ) {
							echo '<img src="' . $rs_photo . '">';
						} else {
							echo '<p>No image uploaded</p>';
						}
					?>
				</div>
				<input type="text" class="setting-image-input" name="aios-seotools[rs-photo]" id="aios-seotools[rs-photo]" value="<?=$rs_photo; ?>" style="display:none">
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