<?php
/**
 * This will containt all the contact form 7 content and pages.
 *
 * @since 2.8.6
 */
if ( !class_exists( 'aios_initial_setup_generate_default_pages_content' ) ) {

	class aios_initial_setup_generate_default_pages_content{

		public function shortCodeToAdd( $cf7Shortcode ) {
			$site_name = get_bloginfo('name');
			$site_url = get_bloginfo('url');

			$toReturn				= array();
			$toReturn['messages'] 	= array(
				'mail_sent_ok' 				=> 'Your message was sent successfully. Thanks.',
				'mail_sent_ng' 				=> 'Failed to send your message. Please try later or contact the administrator by another method.',
				'validation_error' 			=> 'Validation errors occurred. Please confirm the fields and submit it again.',
				'spam' 						=> 'Failed to send your message. Please try later or contact the administrator by another method.',
				'accept_terms' 				=> 'Please accept the terms to proceed.',
				'invalid_required' 			=> 'Please fill the required field.',
				'captcha_not_match' 		=> 'Your entered code is incorrect.',
				'invalid_number' 			=> 'Number format seems invalid.',
				'number_too_small' 			=> 'This number is too small.',
				'number_too_large' 			=> 'This number is too large.',
				'invalid_email' 			=> 'Email address seems invalid.',
				'invalid_url' 				=> 'URL seems invalid.',
				'invalid_tel' 				=> 'Telephone number seems invalid.',
				'quiz_answer_not_correct' 	=> 'Your answer is not correct.',
				'invalid_date' 				=> 'Date format seems invalid.',
				'date_too_early' 			=> 'This date is too early.',
				'date_too_late' 			=> 'This date is too late.',
				'upload_failed' 			=> 'Failed to upload file.',
				'upload_file_type_invalid' 	=> 'This file type is not allowed.',
				'upload_file_too_large' 	=> 'This file is too large.',
				'upload_failed_php_error' 	=> 'Failed to upload file. Error occurred.'
			);

			if ( $cf7Shortcode == 0 ) {

				$toReturn['mail'] = array(
					'subject' => 'Seller Inquiry from your Agent Image website',
					'sender' => '[your-name] <[your-email]>',
					'body' => '<table width="600" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="2" style="font-size: 16px; font-weight: 700;">PERSONAL INFORMATION</td>
	</tr>
	<tr>
		<td width="200"><strong>Name:</strong></td>
		<td>[your-name]</td>
	</tr>
	<tr>
		<td width="200"><strong>Phone:</strong></td>
		<td>[Phone]</td>
	</tr>
	<tr>
		<td width="200"><strong>Address:</strong></td>
		<td>[youraddress]</td>
	</tr>
	<tr>
		<td width="200"><strong>City:</strong></td>
		<td>[city]</td>
	</tr>
	<tr>
		<td width="200"><strong>State:</strong></td>
		<td>[state]</td>
	</tr>
	<tr>
		<td width="200"><strong>Zip:</strong></td>
		<td>[zip]</td>
	</tr>
	<tr>
		<td width="200"><strong>Preferred Method of Contact:</strong></td>
		<td>[PreferredMethodofContact]</td>
	</tr>
	<tr>
		<td width="200"><strong>Approximate Date of Move:</strong></td>
		<td>[datemove]</td>
	</tr>
	<tr>
		<td colspan="2" style="padding-top: 20px; font-size: 16px; font-weight: 700;">PROPERTY INFORMATION</td>
	</tr>
	<tr>
		<td><strong>Type of Property:</strong></td>
		<td>[typeofproperty]</td>
	</tr>
	<tr>
		<td><strong>Bedrooms:</strong></td>
		<td>[beds]</td>
	</tr>
	<tr>
		<td><strong>Baths:</strong></td>
		<td>[baths]</td>
	</tr>
	<tr>
		<td><strong>Approximate Sq. Ft.:</strong></td>
		<td>[sqft]</td>
	</tr>
	<tr>
		<td><strong>Additional Comments:</strong></td>
		<td>[comments]</td>
	</tr>
</table>',
					'recipient' => get_bloginfo('admin_email'),
					'additional_headers' => 'Reply-To: [your-email]',
					'attachments' => '',
					'use_html' => true,
					'exclude_blank' => false
				);

				$toReturn['form'] = '<div class="aidefcf-title">
	<span>Selling your home?</span>
	We’re here to help you price it right – get a comparative market analysis today.
</div>

<div class="ai-default-cf7wrap">
	<div class="aidefcf-left">
		<div class="aidefcf-subtitle">
			<span>Contact Information</span>
			Required fields are marked  *
		</div>

		[text* your-name placeholder "Name *"]
		[email* your-email placeholder "Email *"]
		[tel* Phone placeholder "Phone *"]
		[text youraddress placeholder "Address"]
		<div class="aidefcf-cl3">[text city placeholder "City"] [text state placeholder "State"] [text zip placeholder "Zip"]</div>
		[text datemove placeholder "Approximate Date of Move"]
		<div class="wpcf7-form-control-wrap">[select PreferredMethodofContact "Preferred Method of Contact" "Phone" "Email" "Phone or Email"]</div>
	</div>

	<div class="aidefcf-right">
		<div class="aidefcf-subtitle">
			<span>Home specifications</span>
		</div>

		[select typeofproperty "Property Type" "Single Family Home" "Condominium / Townhouse" "Income Property"]
		<div class="aidefcf-cl2">[select beds "Bedrooms" "1" "2" "3" "4" "5+"] [select baths "Bathrooms" "1" "2" "3" "4" "5+"]</div>
		[text sqft placeholder "Square Footage"]
		[textarea comments placeholder "Additional Comments"]
		[submit "Submit"]
	</div>
</div>';

				$toReturn['shotcodeTitle'] = 'What is My Home Worth? (Auto-generated by AIOS Initial Setup)';
				$toReturn['pageSlug'] = 'what-is-my-home-worth';

				$toReturn['pageContent'] = '';

			} else if ( $cf7Shortcode == 1 ) {

				$toReturn['mail'] = array(
					'subject' => 'Buyer Inquiry from your Agent Image website',
					'sender' => '[your-name] <[your-email]>',
					'body' => '<table width="600" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="2" style="font-size: 16px; font-weight: 700;">CONTACT INFORMATION</td>
	</tr>
	<tr>
		<td width="200"><strong>Name:</strong></td>
		<td>[your-name]</td>
	</tr>
	<tr>
		<td width="200"><strong>Phone:</strong></td>
		<td>[Phone]</td>
	</tr>
	<tr>
		<td width="200"><strong>Address:</strong></td>
		<td>[youraddress]</td>
	</tr>
	<tr>
		<td width="200"><strong>City:</strong></td>
		<td>[city]</td>
	</tr>
	<tr>
		<td width="200"><strong>State:</strong></td>
		<td>[state]</td>
	</tr>
	<tr>
		<td width="200"><strong>Zip:</strong></td>
		<td>[zip]</td>
	</tr>
	<tr>
		<td width="200"><strong>Preferred Method of Contact:</strong></td>
		<td>[PreferredMethodofContact]</td>
	</tr>
	<tr>
		<td colspan="2" style="padding-top: 20px; font-size: 16px; font-weight: 700;">I AM LOOKING FOR THIS TYPE OF PROPERTY</td>
	</tr>
	<tr>
		<td><strong>Approximate Date of Move:</strong></td>
		<td>[datemove]</td>
	</tr>
	<tr>
		<td><strong>Preferred Method of Contact:</strong></td>
		<td>[PreferredMethodofContact]</td>
	</tr>
	<tr>
		<td colspan="2" style="padding-top: 20px; font-size: 16px; font-weight: 700;">DESIRED HOME</td>
	</tr>
	<tr>
		<td><strong>Type of Property:</strong></td>
		<td>[typeofproperty]</td>
	</tr>
	<tr>
		<td><strong>Min. Bedrooms:</strong></td>
		<td>[beds]</td>
	</tr>
	<tr>
		<td><strong>Min. Baths:</strong></td>
		<td>[baths]</td>
	</tr>
	<tr>
		<td><strong>Approximate Sq. Ft.:</strong></td>
		<td>[sqft]</td>
	</tr>
	<tr>
		<td><strong>Additional Comments:</strong></td>
		<td>[comments]</td>
	</tr>
</table>',
					'recipient' => get_bloginfo('admin_email'),
					'additional_headers' => 'Reply-To: [your-email]',
					'attachments' => '',
					'use_html' => true,
					'exclude_blank' => false
				);

				$toReturn['form'] = '<div class="aidefcf-title">
	<span>Are you ready to find your dream home?</span>
	Tell us what you’re looking for! Get the latest listings delivered straight to your inbox.
</div>

<div class="ai-default-cf7wrap">
	<div class="aidefcf-left">
		<div class="aidefcf-subtitle">
			<span>Contact Information</span>
			Required fields are marked  *
		</div>

		[text* your-name placeholder "Name *"]
		[email* your-email placeholder "Email *"]
		[tel* Phone placeholder "Phone *"]
		[text youraddress placeholder "Address"]
		<div class="aidefcf-cl3">[text city placeholder "City"] [text state placeholder "State"] [text  zip placeholder "Zip"]</div>
		[text datemove placeholder "Approximate Date of Move"]
		<div class="wpcf7-form-control-wrap">[select PreferredMethodofContact "Preferred Method of Contact" "Phone" "Email" "Phone or Email"]</div>
	</div>

	<div class="aidefcf-right">
		<div class="aidefcf-subtitle">
		<span>Desired Home</span>
		</div>

		[select typeofproperty "Property Type" "Single Family Home" "Condominium / Townhouse" "Income Property"]
		<div class="aidefcf-cl2">[select beds "Bedrooms" "1" "2" "3" "4" "5+"] [select baths "Bathrooms" "1" "2" "3" "4" "5+"]</div>
		[text sqft placeholder "Square Footage"]
		[textarea comments placeholder "Additional Comments"]
		[submit "Submit"]
	</div>
</div>';

				$toReturn['shotcodeTitle'] = 'Find My Dream Home! (Auto-generated by AIOS Initial Setup)';
				$toReturn['pageSlug'] = 'find-my-dream-home';

				$toReturn['pageContent'] = '';
			} else if ( $cf7Shortcode == 2 ) {

				$toReturn['mail']          = array(
					'subject' => 'Relocation Inquiry from your Agent Image website',
					'sender' => '[your-name] <[your-email]>',
					'body' => '<table width="600" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="2" style="font-size: 16px; font-weight: 700;">PERSONAL INFORMATION </td>
	</tr>
	<tr>
		<td width="200"><strong>Name:</strong></td>
		<td>[your-name]</td>
	</tr>
	<tr>
		<td width="200"><strong>Phone:</strong></td>
		<td>[Phone]</td>
	</tr>
	<tr>
		<td width="200"><strong>Address:</strong></td>
		<td>[youraddress]</td>
	</tr>
	<tr>
		<td width="200"><strong>City:</strong></td>
		<td>[preferredcity]</td>
	</tr>
	<tr>
		<td width="200"><strong>State:</strong></td>
		<td>[state]</td>
	</tr>
	<tr>
		<td width="200"><strong>Zip:</strong></td>
		<td>[zip]</td>
	</tr>
	<tr>
		<td width="200"><strong>Approximate Date of Move:</strong></td>
		<td>[ApproximateDateofMove]</td>
	</tr>
	<tr>
		<td width="200"><strong>Preferred Method of Contact:</strong></td>
		<td>[PreferredMethodofContact]</td>
	</tr>
	<tr>
		<td colspan="2" style="padding-top: 20px; font-size: 16px; font-weight: 700;">DESIRED HOME</td>
	</tr>
	<tr>
		<td><strong>Type of Property:</strong></td>
		<td>[typeofproperty]</td>
	</tr>
	<tr>
		<td><strong>Bedrooms:</strong></td>
		<td>[minbedrooms]</td>
	</tr>
	<tr>
		<td><strong>Baths:</strong></td>
		<td>[baths]</td>
	</tr>
	<tr>
		<td><strong>Approximate Sq. Ft.:</strong></td>
		<td>[sqft]</td>
	</tr>
	<tr>
		<td><strong>Additional Comments:</strong></td>
		<td>[comments]</td>
	</tr>
</table>',
					'recipient' => get_bloginfo('admin_email'),
					'additional_headers' => 'Reply-To: [your-email]',
					'attachments' => '',
					'use_html' => true,
					'exclude_blank' => false
				);

				$toReturn['form'] = '<div class="aidefcf-title">
	<span>Want a smooth, stress-free move?</span>
	Of course you do! Find out how we can help you today.
</div>

<div class="ai-default-cf7wrap">
	<div class="aidefcf-left">
		<div class="aidefcf-subtitle">
			<span>Contact Information</span>
			Required fields are marked  *
		</div>

		[text* your-name placeholder "Name *"]
		[email* your-email placeholder "Email *"]
		[tel* Phone placeholder "Phone *"]
		[text youraddress placeholder "Address"]
		<div class="aidefcf-cl3">[text preferredcity placeholder "City"] [text state placeholder "State"] [text zip placeholder "Zip"]</div>
		[text ApproximateDateofMove placeholder "Approximate Date of Move"]
		<div class="wpcf7-form-control-wrap">[select PreferredMethodofContact "Preferred Method of Contact" "Phone" "Email" "Phone or Email"]</div>
	</div>

	<div class="aidefcf-right">
		<div class="aidefcf-subtitle">
			<span>Desired Home</span>
		</div>

		[select typeofproperty "Property Type" "Single Family Home" "Condominium / Townhouse" "Income Property"]
		<div class="aidefcf-cl2">[select minbedrooms "Bedrooms" "1" "2" "3" "4" "5+"] [select baths "Bathrooms" "1" "2" "3" "4" "5+"]</div>
		[text sqft placeholder "Square Footage"]
		[textarea comments placeholder "Additional Comments"]
		[submit "Submit"]
	</div>
</div>';
				$toReturn['shotcodeTitle'] = 'Help Me Relocate! (Auto-generated by AIOS Initial Setup)';
				$toReturn['pageSlug'] = 'help-me-relocate';
				$toReturn['pageContent'] = '';

			} else if ( $cf7Shortcode == 4 ) {

				$toReturn['mail'] = array(
				'subject' => 'Inquiry from your Agent Image website',
				'sender' => '[fname] [lname] <[your-email]>',
				'body' => '<table width="600" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="200"><strong>First Name:</strong></td>
		<td>[fname]</td>
	</tr>
	<tr>
		<td width="200"><strong>Last Name:</strong></td>
		<td>[lname]</td>
	</tr>
	<tr>
		<td width="200"><strong>Email Address:</strong></td>
		<td>[your-email]</td>
	</tr>
	<tr>
		<td width="200"><strong>Phone Number:</strong></td>
		<td>[Phone]</td>
	</tr>
	<tr>
		<td width="200"><strong>Additional Comments:</strong></td>
		<td>[comments]</td>
	</tr>
</table>',
					'recipient' => get_bloginfo('admin_email'),
					'additional_headers' => 'Reply-To: [your-email]',
					'attachments' => '',
					'use_html' => true,
					'exclude_blank' => false
				);
				$toReturn['form']          = '<div class="ai-default-cf7wrap ai-contact-wrap">
	Required fields are marked  *
	[text* fname placeholder "First Name *"]
	[text* lname placeholder "Last Name *"]
	<div class="aidefcf-cl2">[email* your-email placeholder "Email Address *"] [tel* Phone placeholder "Phone Number *"]</div>
	[textarea comments placeholder "Additional Comments"]
	[submit "Send"]
</div>';
				$toReturn['shotcodeTitle'] = 'Contact Us (Auto-generated by AIOS Initial Setup)';
				$toReturn['pageSlug'] = 'contact-us';

				$toReturn['pageContent'] = '<div class="ai-default-cf7wrap">
<div class="aidefcf-title"><span>We would love to hear from you!</span>Send us a message and we’ll get right back in touch.</div>
<div class="ai-contact-wrap"><span class="content-title">AgentImage</span><br><span class="context-mob"><em class="ai-font-phone"></em>[ai_phone href="877.317.4111"]877.317.4111[/ai_phone]</span><br><span class="context-email"><em class="ai-font-envelope"></em>[mail_to email="support@agentimage.com"]support@agentimage.com[/mail_to]</span></div>
</div>';

			} else if( $cf7Shortcode == 5 ) {
				$toReturn['mail']          = array(
					'subject' => '404 Page Inquiry from your Agent Image website',
					'sender' => '[first-name] [last-name] <[email-address]>',
					'body' => '<table width="600" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="200"><strong>First Name:</td>
		<td>[first-name]</td>
	</tr>
	<tr>
		<td width="200"><strong>Last Name:</td>
		<td>[last-name]</td>
	</tr>
	<tr>
		<td width="200"><strong>Email Address:</td>
		<td>[email-address]</td>
	</tr>
	<tr>
		<td width="200"><strong>Phone Number:</td>
		<td>[phone]</td>
	</tr>
	<tr>
		<td width="200"><strong>Additional Comments:</td>
		<td>[message]</td>
	</tr>
</table>',
					'recipient' => get_bloginfo('admin_email'),
					'additional_headers' => 'Reply-To: [email-address]',
					'attachments' => '',
					'use_html' => true,
					'exclude_blank' => false
				);
	$toReturn['form'] = '<div class="error-form-wrapper">
	<h4>Need Assistance?</h4>
	<div class="error-forms">

		<div class="error-col">
			<div class="error-row">
				<p>[text* first-name placeholder "First Name *"]</p>
			</div>
			<div class="error-row">
				<p>[text* last-name placeholder "Last Name *"]</p>
			</div>
			<div class="error-row">
				<p>[email* email-address placeholder "Email Address *"]</p>
			</div>
			<div class="error-row">
				<p>[text phone placeholder "Phone Number"]</p>
			</div>
		</div>
		<div class="error-col">
			<div class="error-row">
				<p>[textarea message placeholder "Your Message"]</p>
			</div>
			<div class="error-row">
				<p>[submit "Send"]</p>
			</div>
		</div>
	</div>
</div>';

				$toReturn['shotcodeTitle'] = '404 Page Form (Auto-generated by AIOS Initial Setup)';
				$toReturn['pageSlug'] = '404-page';
				$toReturn['pageContent'] = '';
			}

			return $toReturn;
		}
	}
}