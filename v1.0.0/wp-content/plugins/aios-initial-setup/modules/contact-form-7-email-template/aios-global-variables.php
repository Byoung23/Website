<?php
	global $aios_cf7_var;
	$aios_cf7_var = array(
        'user_confirmation'         => 'aios-cf7-template-disabled-user-confirmation',
        'client_confirmation'       => 'aios-cf7-template-disabled-client-confirmation',
        'opt_user_confirmation'     => get_option( 'aios-cf7-template-disabled-user-confirmation', '' ),
        'opt_client_confirmation'   => get_option( 'aios-cf7-template-disabled-client-confirmation', '' ),

		'name_fonts_user' 			=> 'aios-cf7-template-fonts-user',
		'name_fonts_size_user' 		=> 'aios-cf7-template-fonts-size-user',
		'name_fonts_color_user'		=> 'aios-cf7-template-fonts-color-user',
		'name_header_user' 			=> 'aios-cf7-template-header-user',
		'name_intro_user' 			=> 'aios-cf7-template-intro-user',
		'name_closing_user' 		=> 'aios-cf7-template-closing-user',
		'name_footer_user' 			=> 'aios-cf7-template-footer-user',
		'subject_user' 				=> 'Thank you for contacting ' . get_bloginfo( 'name' ) . '!',
		'fonts_user' 				=> get_option( 'aios-cf7-template-fonts-user', 'Arial, sans-serif' ),
		'fonts_size_user' 			=> get_option( 'aios-cf7-template-fonts-size-user', '14' ),
		'fonts_color_user'			=> get_option( 'aios-cf7-template-fonts-color-user', '#000' ),
		'header_user' 				=> stripslashes_deep( get_option( 'aios-cf7-template-header-user', '<img src="[ai_client_logo]" alt="' . get_bloginfo( 'name' ) . '" width="200" />' ) ),
		'intro_user' 				=> stripslashes_deep( get_option( 'aios-cf7-template-intro-user', 'Here is a copy of your inquiry below:' ) ),
		'closing_user' 				=> stripslashes_deep( get_option( 'aios-cf7-template-closing-user', 'We will be in touch shortly to get started!' ) ),
		'footer_user' 				=> stripslashes_deep( get_option( 'aios-cf7-template-footer-user', '<div style="display: block; font-size: 12px; margin-top: 15px;">
	<strong>Email</strong> [ai_client_email_text] | <strong>Phone</strong> [ai_client_phone_text]
</div>
<div style="display: block; font-size: 11px; margin-top: 7px;">
	This e-mail was sent from a contact form on The ' . get_bloginfo( 'name' ) . '.<br><strong>' . get_site_url() . '</strong>
</div>' ) ),

		'name_subject_client' 		=> 'aios-cf7-template-subject-client',
		'name_fonts_client' 		=> 'aios-cf7-template-fonts-client',
		'name_fonts_size_client' 	=> 'aios-cf7-template-fonts-size-client',
		'name_fonts_color_client'	=> 'aios-cf7-template-fonts-color-client',
		'name_header_client' 		=> 'aios-cf7-template-header-client',
		'name_intro_client' 		=> 'aios-cf7-template-intro-client',
		'name_closing_client' 		=> 'aios-cf7-template-closing-client',
        'name_footer_client' 		=> 'aios-cf7-template-footer-client',
        
        
		'fonts_client' 				=> get_option( 'aios-cf7-template-fonts-client', 'Arial, sans-serif' ),
		'fonts_size_client' 		=> get_option( 'aios-cf7-template-fonts-size-client', '14' ),
		'fonts_color_client'		=> get_option( 'aios-cf7-template-fonts-color-client', '#000' ),
		'header_client' 			=> stripslashes_deep( get_option( 'aios-cf7-template-header-client', '<img src="[ai_client_logo]" alt="' . get_bloginfo( 'name' ) . '" width="200" />' ) ),
		'intro_client' 				=> stripslashes_deep( get_option( 'aios-cf7-template-intro-client', '' ) ),
		'closing_client' 			=> stripslashes_deep( get_option( 'aios-cf7-template-closing-client', '' ) ),
		'footer_client' 			=> stripslashes_deep( get_option( 'aios-cf7-template-footer-client', '<div style="display: block; font-size: 11px; margin-top: 15px;">
		This e-mail was sent from a contact form on The ' . get_bloginfo( 'name' ) . '.<br><strong>' . get_site_url() . '</strong>
</div>' ) ),

		'user_font_style'			=> 'font-family: ' . get_option( 'aios-cf7-template-fonts-user', 'Arial, sans-serif' ) . '; font-size: ' . get_option( 'aios-cf7-template-fonts-size-user', '14' ) . '; line-height: 22px; color:' . get_option( 'aios-cf7-template-fonts-color-user', '#000' ) . '; text-decoration:none; font-weight:normal; margin:0 !important; letter-spacing:0;',
		'client_font_style'			=> 'font-family: ' . get_option( 'aios-cf7-template-fonts-client', 'Arial, sans-serif' ) . '; font-size: ' . get_option( 'aios-cf7-template-fonts-size-client', '14' ) . '; line-height: 22px; color:' . get_option( 'aios-cf7-template-fonts-color-client', '#000' ) . '; text-decoration:none; font-weight:normal; margin:0 !important; letter-spacing:0;',
	);
?>