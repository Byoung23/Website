<?php
/*
Plugin Name: AI Amazon SES Mailer
Plugin URI:  http://www.agentimage.com
Description: This Must-Use plugin uses Amazon SES Mail system.
Version:     1.0
Author:      Christopher Alabada <christopher.alabada@thedesignpeople.com>
Author URI:  http://www.agentimage.com
*/
// THIS ONLY WORKS WHILE HOSTED WITH AGENT IMAGE

// defines
define('AI_AWS_SES_MAILER', '/var/www/php_includes/AI_Mailer');

// make sure main exists
if (is_file(AI_AWS_SES_MAILER . '/main.php')) {
    require_once(AI_AWS_SES_MAILER . '/main.php');
}
