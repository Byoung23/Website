<?php

new aws_activate_plugin();
class aws_activate_plugin{

	function __construct() {
		if ( is_admin() ) {
			// ajax enqueue under add-menu-page
			add_action( 'wp_ajax_activate_files', array( $this, 'aws_files_activate_resources' ) );
			add_action( 'wp_ajax_nopriv_activate_files', array( $this, 'aws_files_activate_resources' ) );
		}
	}

	function aws_files_activate_resources() {
		$parentfile = $_POST[ 'parentfile' ];
		$is_file	= strtolower( $_POST[ 'is_file' ] );

		if ( $is_file == 'plugins' ) {
			$plugin = activate_plugin( $parentfile );
			if ( is_wp_error( $plugin ) ) {
			    $status_change[] = 'The plugin does not have a valid header';
			} else {
				$status_change[] = 'Activated';
			}
		} else {
			switch_theme( $parentfile );
			$status_change[] = 'Activated';
		}

		echo json_encode( $status_change );
		wp_die();
	}

}