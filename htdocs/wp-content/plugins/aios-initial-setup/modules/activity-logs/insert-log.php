<?php
/**
 * Insert logs to aios-activity-logs
 */

use AIOS\Services\IPS;

if ( !class_exists( 'AIOS_Initial_Setup_Activity_Logs_Insert_Log' ) ) {
	class AIOS_Initial_Setup_Activity_Logs_Insert_Log {

		/**
		 * Insert Logs.
		 *
		 * @param string $directory_name
		 * @access public
		 * @return void
		 */
		public function insert_logs( $args = array() ) {
            global $wpdb;
            $network_ip = explode( ',', IPS::network_ip() );
            $local_ip = IPS::local_ip();

            date_default_timezone_set('Asia/Manila');
            $wpdb->insert( $wpdb->prefix . AIOS_AUDIT_LOGS_NAME, [
                'date'          => date( "M d h:iA", time() ),
                'action'        => $args['action'],
                'object_type'   => $args['object-type'],
                'network_ip'    => $network_ip[0],
                'local_ip'      => $local_ip,
                'author'        => wp_get_current_user()->ID,
                'content'       => $args['activity'],
                'created_at'    => date("Y-m-d H:i:s"),
                'expires_at'    => date( 'Y-m-d H:i:s', strtotime(' + 30 days') )
            ] );
		}

	}
}

function aios_insert_activity_logs( $args = array() ) {
	$aios_initial_setup_Activity_Logs_Insert_Log = new AIOS_Initial_Setup_Activity_Logs_Insert_Log();
	$aios_initial_setup_Activity_Logs_Insert_Log->insert_logs($args);
}