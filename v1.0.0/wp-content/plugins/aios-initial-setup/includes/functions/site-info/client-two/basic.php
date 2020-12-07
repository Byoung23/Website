
<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Name</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aiis_ci[partner-name]" id="aiis_ci[partner-name]" 
			value="<?php echo isset( $aiis_ci[ 'partner-name' ] ) ? $aiis_ci[ 'partner-name' ] : ''; ?>" 
			placeholder="Agent Image">
		</div>
	</div>
</div>
<!-- END: Row Box -->
<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Address</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aiis_ci[partner-address]" id="aiis_ci[partner-address]" 
			value="<?php echo isset( $aiis_ci[ 'partner-address' ] ) ? $aiis_ci[ 'partner-address' ] : ''; ?>" 
			placeholder="1700 E. Walnut Avenue, Suite 400, El Segundo, CA 90245">
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
			<input type="text" name="aiis_ci[partner-email]" id="aiis_ci[partner-email]" 
			value="<?php echo isset( $aiis_ci[ 'partner-email' ] ) ? $aiis_ci[ 'partner-email' ] : ''; ?>" 
			placeholder="info@agentimage.com">
		</div>
	</div>
</div>
<!-- END: Row Box -->
<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Phone Number</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aiis_ci[partner-phone]" id="aiis_ci[partner-phone]" 
			value="<?php echo isset( $aiis_ci[ 'partner-phone' ] ) ? $aiis_ci[ 'partner-phone' ] : ''; ?>" 
			placeholder="1.800.979.5799">
		</div>
	</div>
</div>
<!-- END: Row Box -->
<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Cell Number</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aiis_ci[partner-cell]" id="aiis_ci[partner-cell]" 
			value="<?php echo isset( $aiis_ci[ 'partner-cell' ] ) ? $aiis_ci[ 'partner-cell' ] : ''; ?>" 
			placeholder="1.800.979.5799">
		</div>
	</div>
</div>
<!-- END: Row Box -->
<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Fax</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aiis_ci[partner-fax]" id="aiis_ci[partner-fax]" 
			value="<?php echo isset( $aiis_ci[ 'partner-fax' ] ) ? $aiis_ci[ 'partner-fax' ] : ''; ?>" 
			placeholder="1.310.301.4449">
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