<?php

new aws_deactivate_plugin();
class aws_deactivate_plugin{

	function __construct() {
		if ( is_admin() ) {
			// ajax enqueue under add-menu-page
			add_action( 'wp_ajax_deactivate_files', array( $this, 'aws_files_deactivate_resources' ) );
			add_action( 'wp_ajax_nopriv_deactivate_files', array( $this, 'aws_files_deactivate_resources' ) );
		}
	}

	function aws_files_deactivate_resources() {
		$parentfile = $_POST[ 'parentfile' ];

		$plugin = deactivate_plugins( $parentfile );
		$status_change[] = 'Deactivated';

		echo json_encode( $status_change );
		wp_die();
	}

}