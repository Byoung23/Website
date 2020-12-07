<?php
/** Exit if accessed directly **/
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * This class will return require files
 *
 * @since 3.0.9
 */

if ( !class_exists( 'AIOS_Initial_Setup_Activity_Logs_Taxonomy' ) ) {
	class AIOS_Initial_Setup_Activity_Logs_Taxonomy {

		/**
		 * Constructor
		 *
		 * @since 3.0.9
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {
			$this->add_actions();
		}

		/**
		 * Add Actions.
		 *
		 * @since 3.0.9
		 *
		 * @access protected
		 * @return void
		 */
		protected function add_actions() {
			add_action( 'created_term', array( $this, 'hooks_created_edited_deleted_term' ), 10, 3 );
			add_action( 'edited_term', array( $this, 'hooks_created_edited_deleted_term' ), 10, 3 );
			add_action( 'delete_term', array( $this, 'hooks_created_edited_deleted_term' ), 10, 4 );
		}

		public function hooks_created_edited_deleted_term( $term_id, $tt_id, $taxonomy, $deleted_term = null ) {
			// Make sure do not action nav menu taxonomy.
			if ( 'nav_menu' === $taxonomy )
				return;

			if ( 'delete_term' === current_filter() ){
				$term = $deleted_term;
			} else {
				$term = get_term( $term_id, $taxonomy );
			}

			if ( $term && ! is_wp_error( $term ) ) {
				if ( 'edited_term' === current_filter() ) {
					$action = 'Updated';
				} elseif ( 'delete_term' === current_filter() ) {
					$action  = 'Deleted';
					$term_id = '';
				} else {
					$action = 'Created';
				}

				aios_insert_activity_logs(
					array(
						'action' 		=>  ucfirst( str_replace( '_', ' ', $taxonomy ) ) . ' ' . $action,
						'activity'		=> 'Term ID: <strong>' . $term_id . '</strong> | Term Name: <strong>' . $term->name . '</strong>',
						'object-type'	=> 'Taxonomy'
					)
				);
			}
		}

	}
}

$aios_initial_setup_Activity_Logs_Taxonomy = new AIOS_Initial_Setup_Activity_Logs_Taxonomy();