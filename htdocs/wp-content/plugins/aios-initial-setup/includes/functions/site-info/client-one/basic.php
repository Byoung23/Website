<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Name</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aiis_ci[name]" id="aiis_ci[name]" 
			value="<?php echo isset( $aiis_ci[ 'name' ] ) ? $aiis_ci[ 'name' ] : '' ?>" 
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
			<input type="text" name="aiis_ci[address]" id="aiis_ci[address]" 
			value="<?php echo isset( $aiis_ci[ 'address' ] ) ? $aiis_ci[ 'address' ] : '' ?>" 
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
			<input type="text" name="aiis_ci[email]" id="aiis_ci[email]" 
			value="<?php echo isset( $aiis_ci[ 'email' ] ) ? $aiis_ci[ 'email' ] : '' ?>" 
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
			<input type="text" name="aiis_ci[phone]" id="aiis_ci[phone]" 
			value="<?php echo isset( $aiis_ci[ 'phone' ] ) ? $aiis_ci[ 'phone' ] : '' ?>" 
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
			<input type="text" name="aiis_ci[cell]" id="aiis_ci[cell]" 
			value="<?php echo isset( $aiis_ci[ 'cell' ] ) ? $aiis_ci[ 'cell' ] : '' ?>" 
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
			<input type="text" name="aiis_ci[fax]" id="aiis_ci[fax]" 
			value="<?php echo isset( $aiis_ci[ 'fax' ] ) ? $aiis_ci[ 'fax' ] : '' ?>" 
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