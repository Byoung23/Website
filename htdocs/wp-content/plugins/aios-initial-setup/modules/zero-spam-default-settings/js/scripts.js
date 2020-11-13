jQuery(document).ready( function() {
	
	var settings = 	"body.settings_page_zerospam input#wp_generator_remove," +
					"body.settings_page_zerospam input#log_spammers," + 
					"body.settings_page_zerospam input#comment_support," +
					"body.settings_page_zerospam input#registration_support," +
					"body.settings_page_zerospam input#cf7_support";
	
	jQuery(settings).attr("disabled","disabled");
	
});