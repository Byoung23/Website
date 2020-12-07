<?php
new admin_add_page();

class admin_add_page{

	function __construct() {
		add_action( 'admin_menu', array( $this, 'register_aios_resources' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_aios_resources' ) );
		add_action( 'wp_ajax_set_access_session', array( $this, 'set_access_session' ) );
		add_action( 'wp_ajax_nopriv_set_access_session', array( $this, 'set_access_session' ) );
	}

	function register_aios_resources() {
		/*
		 * Create Menu Item under Plugin
		 */
		add_submenu_page(
	        'plugins.php',
	        'AIOS S3 Tools',
			'AIOS S3 Tools', 
			'manage_options', 
			'aios-s3-tools',
			array( $this, 'content_aios_resources' )
	    );
	}

	/**
	 * Display on wordpress backend list of plugin and themes
	 */
	function content_aios_resources() {

		/**
		 * Access S3 Files and Display in WP Backend
		 * @param $_COOKIE["wordpress_QWdlbnRJbWFnZQ"] - Contains the S3 Access including the user access level by Access Code
		 * @param $_COOKIE["wordpress_QWdlbnRJbWFnZQ"] - access_key, secret_key, bucket, path, access_level, folders, access_name
		 */

		if ( isset( $_COOKIE["wordpress_QWdlbnRJbWFnZQ"] ) && !empty( $_COOKIE["wordpress_QWdlbnRJbWFnZQ"] ) ) {

			/*
			 * Show Data view.php
			 */

		    // Create count for associate array
		    $file_count = 0;

		    // Create associate array
			$themes_list 		= [];
			$plugins_list 		= [];

			$all_plugins		= get_plugins();

			$all_themes 		= wp_get_themes();
			$current_theme 		= wp_get_theme();

			$access_details 	= str_replace( 'TmVxdWUgcG9ycm8gcXVpc3F1YW0gZXN0IHF1aSBkb2xvcmVt', '', $_COOKIE["wordpress_QWdlbnRJbWFnZQ"] );
			$access_details 	= '[' . str_replace( '\\', '', $access_details ) . ']';
			$access_details		= json_decode( $access_details, true )[0];

			$access_key 		= !empty($access_details['access_key']) ? $access_details['access_key'] : '';
			$secret_key 		= !empty($access_details['secret_key']) ? $access_details['secret_key'] : '';

			$s3_bucket 			= !empty($access_details['bucket']) ? $access_details['bucket'] : '';
			$s3_path 			= !empty($access_details['path']) ? $access_details['path'] : '';

			$access_level 		= !empty($access_details['access_level']) ? $access_details['access_level'] : '';

			$user_folders 		= !empty($access_details['folders']) ? $access_details['folders'] : '';
			$user_access_name 	= !empty($access_details['access_name']) ? $access_details['access_name'] : '';

			$s3_furl 			= !empty($access_details['furl']) ? $access_details['furl'] : '';
			
			define( 'FURL', $s3_furl );

			//instantiate the class
			$s3 = new S3( $access_key, $secret_key);

			// Get the contents of the bucket
		    $bucket_contents = $s3->getBucket( $s3_bucket, $s3_path );
		   

			/**
			 * Get all zip files in S3 Bucket  (Plugins and Themes)
			 * @return loop through each file in bucket key and push list to array
			 */

			if ( $bucket_contents ) {
				foreach ( $bucket_contents as $key ) {

					if ( $key[ 'size' ] > 0 ) {

						$fname = $key[ 'name' ];
						$furl = $s3_furl . $fname;
						$metadata = $s3->getObjectInfo( $s3_bucket, $fname );
						$fthemes = $s3_path . '/themes/';
						$fplugin = $s3_path . '/plugins/';

						// Generate Slug
						$searched_for = array( $fplugin, $fthemes, '.zip' );
						$replace_for = array( '', '', '' );
						$slug = str_replace( $searched_for, $replace_for, $fname );

						// Generate folder
						$f_searched_for = array( $fplugin, $fthemes, '.zip' );
						$f_replace_for = array( '', '', '' );
						$folder_name = str_replace( $f_searched_for, $f_replace_for, $fname );

						// Populate associate array				
						$arr_parent_name = $folder_name . '/' . $metadata[ 'x-amz-meta-mainfile' ];
						if ( strpos( $fname, $fthemes ) !== false ) {
							$themes_list[ $arr_parent_name ][ 'Name' ] 		= 	$metadata[ 'x-amz-meta-basename' ];
							$themes_list[ $arr_parent_name ][ 'Slug' ] 		= 	$slug;
							$themes_list[ $arr_parent_name ][ 'File' ] 		= 	$metadata[ 'x-amz-meta-mainfile' ];
							$themes_list[ $arr_parent_name ][ 'Category' ] 	= 	'Themes';
							$themes_list[ $arr_parent_name ][ 'Bucket' ] 	= 	$fname;
							$themes_list[ $arr_parent_name ][ 'Link' ] 		= 	$furl;
							$themes_list[ $arr_parent_name ][ 'Version' ] 	=	$metadata[ 'x-amz-meta-version' ];
							$themes_list[ $arr_parent_name ][ 'Parent' ] 	= 	$metadata[ 'x-amz-meta-parent' ];
						} elseif( strpos( $fname, $fplugin ) !== false ) {
							$plugins_list[ $arr_parent_name ][ 'Name' ] 	= 	$metadata[ 'x-amz-meta-basename' ];
							$plugins_list[ $arr_parent_name ][ 'Slug' ] 	= 	$slug;
							$plugins_list[ $arr_parent_name ][ 'File' ] 	= 	$metadata[ 'x-amz-meta-mainfile' ];
							$plugins_list[ $arr_parent_name ][ 'Category' ] = 	'Plugins';
							$plugins_list[ $arr_parent_name ][ 'Bucket' ] 	= 	$fname;
							$plugins_list[ $arr_parent_name ][ 'Link' ] 	= 	$furl;
							$plugins_list[ $arr_parent_name ][ 'Version' ] 	= 	$metadata[ 'x-amz-meta-version' ];
						}
						$file_count++;

					}
				
				}

			}else {
				/*
				 * When failed to retreive data in S3 due to error in access. empty bucket will still return Array obj value.
				 */
				echo '<div style="display:block" class="update-nag">Warning: Please double check Amazon S3 Configuration [Access Key, Secret Key, Bucket and Path].</div>';
			}

			require('view.php');

		} else {
			/*
			 * Field for Access Code entry.
			 * UI will show if the session department_access is not exist.
			 */
			echo '
				<div class="wrap">
					<h1 class="wp-heading-inline">AIOS S3 Tools</h1>
					<div class="s3-subtitle"><strong>For Developers Only</strong></div>
					<div class="aios-s3-wrap">

						<div class="aios-s3-notice">
							<div class="s3-field-holder">
								<input type="password" name="access-lvl" class="access-lvl" placeholder="Access Code"/>
								<input class="button button-primary button-large confirm-access-lvl" type="submit" value="Submit">
								<span class="s3-loading">Sending Request...</span>
								<span class="s3-response-message">Access Denied!</span>
							</div>
						</div>

					</div>
				</div>
			';
		}
		
	}

	/*
	 * AJAX function - set the returned result to session.
	 * This contains the S3 Access
	 */
	function set_access_session() {

		$access_details = $_POST[ 'access_details' ];

		echo json_encode( $access_details );

		wp_die();

	}

	/*
 	 * Sort Theme by Installed First
	 */
	function sortArrayByArray( $needle, $stack ) {

		$current_installed = [];
		$not_installed = [];

		$stack_keys = [];
		foreach ($stack as $key => $value) {
			$stack_keys[] = $key;
		}

		$set = array();

		foreach ($needle as $key => $value) {

			$str = str_replace("/style.css", '', $key);

			if( in_array($str, $stack_keys) ) {
				//$current_installed[] = $str.'/style.css';
				$current_installed[$str] = $needle[$str.'/style.css'];
			}else {
				//$not_installed[] = $str.'/style.css';
				$not_installed[$str] = $needle[$str.'/style.css'];
			}

		}

		return array_merge($current_installed,$not_installed);
	  
	}

	/*
	 * Return Theme name of objIndex
	 */
	function get_theme_name( $needle, $stack ) {
		foreach ($stack as $key => $value) {
			if ( $key == $needle ) {
				return $stack[$needle]['Name'];
			}
		}
	}


	/*
	 * Enqueue Backend Assets
	 */
	function enqueue_aios_resources() {
	    wp_enqueue_style( 'ai-resources-css', AIOS_AWS_URL . 'assets/css/aios-resources.css' );
		wp_enqueue_script( 'ai-resources-ajax', AIOS_AWS_URL . 'assets/js/aios-resources.js', array(), '1.8.9.9' );
	    wp_localize_script( 'ai-resources-ajax', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
	}

}