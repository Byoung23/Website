<div class="aios-wrap-column">
    <p>
        <label for="aios-seotools[rs-property]">Type:</label>
        <select name="aios-seotools[rs-property]" id="aios-seotools[rs-property]">
            <option value="RealEstateAgent" <?php if ( esc_attr( $seo_option[ 'rs-property' ]=='RealEstateAgent' ) ) echo 'selected="selected"'; ?>>RealEstateAgent</option>
            <option value="Organization" <?php if ( esc_attr( $seo_option[ 'rs-property' ]=='Organization' ) ) echo 'selected="selected"'; ?>>Organization</option>
        </select>
    </p>
    <p>
        <label for="aios-seotools[rs-name]">Name:</label>
        <input type="text" name="aios-seotools[rs-name]" id="aios-seotools[rs-name]" value="<?php echo esc_attr( $seo_option[ 'rs-name' ] ); ?>">
    </p>
    <p>
        <label for="aios-seotools[rs-address]">Street Address:</label>
        <input type="text" name="aios-seotools[rs-address]" id="aios-seotools[rs-address]" value="<?php echo esc_attr( $seo_option[ 'rs-address' ] ); ?>" placeholder="e.g. 1600 Amphitheatre Pkwy">
    </p>
    <p>
        <label for="aios-seotools[rs-locality]">Locality:</label>
        <input type="text" name="aios-seotools[rs-locality]" id value="<?php echo esc_attr( $seo_option[ 'rs-locality' ] ); ?>" placeholder="City/Town/Municipality(e.g. Los Angeles)">
    </p>
    <p>
        <label for="aios-seotools[rs-region]">Region:</label>
        <input type="text" name="aios-seotools[rs-region]" id="aios-seotools[rs-region]" value="<?php echo esc_attr( $seo_option[ 'rs-region' ] ); ?>" placeholder="Region Abb(e.g. CA)">
    </p>
    <p>
        <label for="aios-seotools[rs-postal-code]">Postal Code:</label>
        <input type="text" name="aios-seotools[rs-postal-code]" id="aios-seotools[rs-postal-code]" value="<?php echo esc_attr( $seo_option[ 'rs-postal-code' ] ); ?>">
    </p>
    <p>
        <label for="aios-seotools[rs-contact-type]">Contact Type:</label>
        <select name="aios-seotools[rs-contact-type]" id="aios-seotools[rs-contact-type]">
            <option value="Sales" <?php if ( esc_attr( $seo_option[ 'rs-contact-type' ]=='Sales' ) ) echo 'selected="selected"'; ?>>Sales</option>
            <option value="Customer Support" <?php if ( esc_attr( $seo_option[ 'rs-contact-type' ]=='Customer Support' ) ) echo 'selected="selected"'; ?>>Customer Support</option>
            <option value="Billing Support" <?php if ( esc_attr( $seo_option[ 'rs-contact-type' ]=='Billing Support' ) ) echo 'selected="selected"'; ?>>Billing Support</option>
            <option value="Bill Payment" <?php if ( esc_attr( $seo_option[ 'rs-contact-type' ]=='Bill Payment' ) ) echo 'selected="selected"'; ?>>Bill Payment</option>
            <option value="Reservations" <?php if ( esc_attr( $seo_option[ 'rs-contact-type' ]=='Reservations' ) ) echo 'selected="selected"'; ?>>Reservations</option>
            <option value="Credit Card Support" <?php if ( esc_attr( $seo_option[ 'rs-contact-type' ]=='Credit Card Support' ) ) echo 'selected="selected"'; ?>>Credit Card Support</option>
        </select>    
    </p>
    <p>
        <label for="aios-seotools[rs-telephone]">Telephone: (must have country code)</label>
        <input type="text" name="aios-seotools[rs-telephone]" id="aios-seotools[rs-telephone]" value="<?php echo esc_attr( $seo_option[ 'rs-telephone' ] ); ?>" placeholder="+1-877-746-0909">
    </p>
    <p>
        <label for="aios-seotools[rs-email]">Email:</label>
        <input type="email" name="aios-seotools[rs-email]" id="aios-seotools[rs-email]" value="<?php echo esc_attr( $seo_option[ 'rs-email' ] ); ?>">
    </p>
    <p>
        <label for="aios-seotools[rs-reference]">Reference Web page(Social Media, Blog, App Site): <em>Enter Site separated by new lines.</em>
        </label>
        <textarea name="aios-seotools[rs-reference]" id="aios-seotools[rs-reference]" placeholder=""><?php echo esc_attr( $seo_option[ 'rs-reference' ] ); ?></textarea>
    </p>
    <p>
        <label for="aios-seotools[rs-description]">Site Description:</label>
        <textarea name="aios-seotools[rs-description]" id="aios-seotools[rs-description]" placeholder="Short Description"><?php echo esc_attr( $seo_option[ 'rs-description' ] ); ?></textarea>
    </p>
    <p>
        <label for="aios-seotools-photo-button">Photo:</label>
        <input type="text" name="aios-seotools[rs-photo]" id="aios-seotools[rs-photo]" value="<?php echo esc_attr( $seo_option[ 'rs-photo' ] ); ?>">
        <input type="button" class="button" value="Upload Logo" id="aios-seotools-photo-button">
    </p>
    <p>
        <label>Photo Preview:</label><br>
        <img src="<?php echo esc_attr( $seo_option[ 'rs-photo' ] ); ?>" class="aios-seotools-photo-preview">
    </p>
</div>

<div class="aios-wrap-column">
    <div class="non-organization">
        <p>
            <strong>Google Coordinates(for better location)</strong>
        </p>
        <p>
            <label for="aios-seotools[rs-geo-url]">Include Map:</label><br>
            <em>How to obtain a Google map URL of your business:<br> Go to google.com/maps and search for your business by name. Select "Share and embed map", Then copy and paste the URL or use the short URL.</em>
            <input type="text" name="aios-seotools[rs-geo-url]" id="aios-seotools[rs-geo-url]" value="<?php echo esc_attr( $seo_option[ 'rs-geo-url' ] ); ?>" placeholder="https://www.google.com/maps/">
        </p>
        <p>
            <label for="aios-seotools[rs-geo-latitude]">Latitude:</label>
            <input type="text" name="aios-seotools[rs-geo-latitude]" id="aios-seotools[rs-geo-latitude]" value="<?php echo esc_attr( $seo_option[ 'rs-geo-latitude' ] ); ?>" placeholder="33.9287294" readonly>
        </p>
        <p>
            <label for="aios-seotools[rs-geo-longitude]">Longitude:</label>
            <input type="text" name="aios-seotools[rs-geo-longitude]" id="aios-seotools[rs-geo-longitude]" value="<?php echo esc_attr( $seo_option[ 'rs-geo-longitude' ] ); ?>" placeholder="-118.3977663" readonly>
        </p>
        <p>
            <label for="aios-seotools[rs-opening-hours]">Opening Hours:</label>
            <input type="text" name="aios-seotools[rs-opening-hours]" id="aios-seotools[rs-opening-hours]" value="<?php echo esc_attr( $seo_option[ 'rs-opening-hours' ] ); ?>" placeholder="e.g. Mo-Su" readonly>
            <ul class="rs-opening-hours-checklist">
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
                        $day_check = esc_attr( $seo_option[ 'rs-oh-' . $day ] );

                        $days_output .= '<li>';
                            $days_output .= '<input type="checkbox" value="' . $day_acr . '" name="aios-seotools[rs-oh-' . $day . ']" id="aios-seotools[rs-oh-' . $day . ']" class="rs-oh-' . $day . '" ' . ( !empty( $day_check ) ? 'checked="checked"' : '' ) . '><span>' . ucfirst( $day ) . '</span>';
                            $days_output .= '<div class="rs-opening-hours-selector" ' . ( !empty( $day_check ) ? 'style="display: inline-block;"' : '' ) . '>';

                                // Open Time
                                $days_output .= '<select class="opening-hour" name="aios-seotools[' . $day . '-open-time]" id="aios-seotools[' . $day . '-open-time]">';
                                    $days_output .= '<option value="" ' . esc_attr( $seo_option[ $day . '-open-time' ]=='' ? 'selected="selected"' : '' ) . '>Open</option>';
                                    while ( $ot_now <= $ot_end ) {
                                         $days_output .=  '<option value="' . date( "H:i", $ot_now ) . '" ' . esc_attr( $seo_option[ $day . '-open-time' ]==date( "H:i", $ot_now ) ? 'selected="selected"' : '' ) . '>' . date( "H:i", $ot_now ) . '</option>' . date( "H:i", $ot_now );
                                        $ot_now = strtotime( '+30 minutes', $ot_now );
                                    }
                                $days_output .= '</select>';

                                // Close Time
                                $days_output .= '<select class="closing-hour" name="aios-seotools[' . $day . '-close-time]" id="aios-seotools[' . $day . '-close-time]">';
                                    $days_output .= '<option value="" ' . esc_attr( $seo_option[ $day . '-close-time' ]=='' ? 'selected="selected"' : '' ) . '>Close</option>';
                                    while ( $oc_now <= $oc_end ) {
                                         $days_output .=  '<option value="' . date( "H:i", $oc_now ) . '" ' . esc_attr( $seo_option[ $day . '-close-time' ]==date( "H:i", $oc_now ) ? 'selected="selected"' : '' ) . '>' . date( "H:i", $oc_now ) . '</option>' . date( "H:i", $oc_now );
                                        $oc_now = strtotime( '+30 minutes', $oc_now );
                                    }
                                $days_output .= '</select>';

                            $days_output .= '</div>';
                        $days_output .= '</li>';
                    }

                    $all_week = esc_attr( $seo_option[ 'rs-oh-all-week' ] );

                    $days_output .= '<li><input type="checkbox" value="Mo-Su" name="aios-seotools[rs-oh-all-week]" id="aios-seotools[rs-oh-all-week]" class="rs-oh-24-7" ' . ( !empty( $all_week ) ? 'checked="checked"' : '' ) . '>24/7</li>';
                    echo $days_output;
                ?>                
            </ul>
        </p>
        <p>Note: To claim an existing physical business or create a new one, use <a href="http://business.google.com" target="_blank">Google My Business</a>.  Once you verify yourself as the owner of a listing, you can provide and edit your address, contact info, business type, and photos. This enables your local business information to show up in Google Maps and in Knowledge Graph cards.</p>
    </div>
</div>