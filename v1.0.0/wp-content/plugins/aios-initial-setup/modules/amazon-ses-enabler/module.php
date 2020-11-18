<?php
/**
 * Name: Amazon SES Enabler
 * Description: This script re-enables SES on a per-site basis
 */
class AIOS_Initial_Setup_Amazon_SES_Enabler {
	
	function __construct() {
		/*
		 * On February 2, 2018, all WordPress sites on RS0, RS1, RS2, and RS3 were made to use Amazon SES.
		 * However, we didn't anticipate the amount of spam that would get thru so Amazon SES was disabled on April 2018 globally.
		 * This script re-enables SES on a per-site basis.
		 */
		
		remove_action('phpmailer_init', 'agentimage_ses_mailer_override_83590271cc85', 20);

	}
	
}

$aios_initial_setup_module_instances_object['aios_initial_setup_amazon_ses_enabler_module'] = new AIOS_Initial_Setup_Amazon_SES_Enabler();