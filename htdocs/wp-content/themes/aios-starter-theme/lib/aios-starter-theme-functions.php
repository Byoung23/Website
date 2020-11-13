<?php

	/*
	 * Function Name: AIOS Starter Theme Classes
	 * Description: Custom Functions for Starter Theme
	 * Author: AgentImage OS
	 * Author URI: http://www.agentimageos.com
	 * License: Proprietary
	 */
	
    // Define Tempate Directory
    if ( !defined( 'CUSTOM_FUNCTION_URL' ) ) {
      define( 'CUSTOM_FUNCTION_URL', get_template_directory().'/lib/' );
    }


    $ai_functions_dir  = CUSTOM_FUNCTION_URL . 'class';



    /**
      * Scan /class/ directory and require the files match with the condition.
      * File name must start with function- with php format
    **/


    if (is_dir($ai_functions_dir)) {

        $ai_func_files_list = preg_grep('/^([^.])/', scandir($ai_functions_dir));

        foreach ($ai_func_files_list as $ai_function_files) {

            // build full file path

            $filepath = $ai_functions_dir . '/' . $ai_function_files;

            // Is it a file? If so, get the extension using some function you created
            if(is_file($filepath)) {

                $file_extension = pathinfo($ai_function_files, PATHINFO_EXTENSION);

                if( substr($ai_function_files, 0, 9) == "function-" && $file_extension == "php") {
                    require($ai_functions_dir.'/'.$ai_function_files);
                }

            }

        }

    }


	


?>