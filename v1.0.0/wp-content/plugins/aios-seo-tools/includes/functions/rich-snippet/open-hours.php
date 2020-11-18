<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Opening Hours</span> To claim an existing physical business or create a new one, use <a href="http://business.google.com" target="_blank">Google My Business</a>.  Once you verify yourself as the owner of a listing, you can provide and edit your address, contact info, business type, and photos. This enables your local business information to show up in Google Maps and in Knowledge Graph cards.</p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<input type="text" name="aios-seotools[rs-opening-hours]" id="aios-seotools[rs-opening-hours]" value="<?=$rs_opening_hours?>" placeholder="e.g. Mo-Su" readonly>
		</div>
		<div class="form-group">
			<div class="form-checkbox-group form-opening-hours">
				<?php 
					$days = array(
						'Mo' => 'monday',
						'Tu' => 'tuesday',
						'We' => 'wednesday',
						'Th' => 'thursday',
						'Fr' => 'friday',
						'Sa' => 'saturday',
						'Su' => 'sunday'
					);

					$days_output = '';

					foreach ($days as $day_acr => $day) {
						// Open Time
						$ot_start_time = "00:00";
						$ot_end_time = "23:00";

						$ot_start = strtotime( $ot_start_time );
						$ot_end = strtotime( $ot_end_time );
						$ot_now = $ot_start;

						// Closing Time
						$oc_start_time = "00:30";
						$oc_end_time = "23:30";

						$oc_start = strtotime( $oc_start_time );
						$oc_end = strtotime( $oc_end_time );
						$oc_now = $oc_start;

						// Get checkbox value
						$day_check 	= isset( $seo_option[ 'rs-oh-' . $day ] ) ? $seo_option[ 'rs-oh-' . $day ] : '';
						$open_time 	= isset( $seo_option[ $day . '-open-time' ] ) ? $seo_option[ $day . '-open-time' ] : '';
						$close_time = isset( $seo_option[ $day . '-close-time' ] ) ? $seo_option[ $day . '-close-time' ] : '';

						$days_output .= '<div class="form-checkbox">';

							$days_output .= '<div>';
								$days_output .= '<label><input type="checkbox" value="' . $day_acr . '" name="aios-seotools[rs-oh-' . $day . ']" id="aios-seotools[rs-oh-' . $day . ']" class="rs-oh-' . $day . ' opens-partially" ' . ( !empty( $day_check ) ? 'checked="checked"' : '' ) . '> ' . ucfirst( $day ) . '</label>';
							$days_output .= '</div>';

							$days_output .= '<div class="rs-opening-hours-selector float-left w-100 mb-2" style="' . ( !empty( $day_check ) ? 'display: inline-block;' : 'display: none;' ) . ' padding-left: 34px;">';
								// Open Time
								$days_output .= '<select class="opening-hour float-left" style="width: 120px;" name="aios-seotools[' . $day . '-open-time]" id="aios-seotools[' . $day . '-open-time]">';
									$days_output .= '<option value="" ' . ( $open_time == '' ? 'selected="selected"' : '' ) . '>Open</option>';
									while ( $ot_now <= $ot_end ) {
										 $days_output .=  '<option value="' . date( "H:i", $ot_now ) . '" ' . ( $open_time == date( "H:i", $ot_now ) ? 'selected="selected"' : '' ) . '>' . date( "H:i", $ot_now ) . '</option>' . date( "H:i", $ot_now );
										$ot_now = strtotime( '+30 minutes', $ot_now );
									}
								$days_output .= '</select>';

								// Close Time
								$days_output .= '<select class="closing-hour float-left ml-2" style="width: 120px;" name="aios-seotools[' . $day . '-close-time]" id="aios-seotools[' . $day . '-close-time]">';
									$days_output .= '<option value="" ' . ( $close_time =='' ? 'selected="selected"' : '' ) . '>Close</option>';
									while ( $oc_now <= $oc_end ) {
										 $days_output .=  '<option value="' . date( "H:i", $oc_now ) . '" ' . ( $close_time == date( "H:i", $oc_now ) ? 'selected="selected"' : '' ) . '>' . date( "H:i", $oc_now ) . '</option>' . date( "H:i", $oc_now );
										$oc_now = strtotime( '+30 minutes', $oc_now );
									}
								$days_output .= '</select>';
							$days_output .= '</div>';

						$days_output .= '</div>';
					}

					$all_week = isset( $seo_option[ 'rs-oh-all-week' ] ) ? $seo_option[ 'rs-oh-all-week' ] : '';

					$days_output .= '<div class="form-checkbox">';
						$days_output .= '<label><input type="checkbox" value="Mo-Su" name="aios-seotools[rs-oh-all-week]" id="aios-seotools[rs-oh-all-week]" class="open-fulltime" ' . ( !empty( $all_week ) ? 'checked="checked"' : '' ) . '> 24/7</label>';
					$days_output .= '</div>';

					echo $days_output;
				?> 
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