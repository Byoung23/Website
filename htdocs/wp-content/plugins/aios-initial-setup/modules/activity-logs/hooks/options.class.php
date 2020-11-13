<?php
/**
 * Insert logs into custom post type
 * 
 */

use AIOS\Services\ArrayHelper;

if ( !class_exists( 'AIOS_Initial_Setup_Activity_Logs_Options' ) ) {
	class AIOS_Initial_Setup_Activity_Logs_Options {

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
			add_action( 'updated_option', array( $this, 'hooks_updated_option' ), 10, 3 );
		}

		public function hooks_updated_option( $option, $oldvalue, $_newvalue ) {
			$whitelist_options = apply_filters( 'aal_whitelist_options', array(
				/** General */
				'blogname',
				'blogdescription',
				'siteurl',
				'home',
				'admin_email',
				'users_can_register',
				'default_role',
				'timezone_string',
				'date_format',
				'time_format',
				'start_of_week',

				/** Writing */
				'use_smilies',
				'use_balanceTags',
				'default_category',
				'default_post_format',
				'mailserver_url',
				'mailserver_login',
				'mailserver_pass',
				'default_email_category',
				'ping_sites',

				/** Reading */
				'show_on_front',
				'page_on_front',
				'page_for_posts',
				'posts_per_page',
				'posts_per_rss',
				'rss_use_excerpt',
				'blog_public',

				/** Discussion */
				'default_pingback_flag',
				'default_ping_status',
				'default_comment_status',
				'require_name_email',
				'comment_registration',
				'close_comments_for_old_posts',
				'close_comments_days_old',
				'thread_comments',
				'thread_comments_depth',
				'page_comments',
				'comments_per_page',
				'default_comments_page',
				'comment_order',
				'comments_notify',
				'moderation_notify',
				'comment_moderation',
				'comment_whitelist',
				'comment_max_links',
				'moderation_keys',
				'blacklist_keys',
				'show_avatars',
				'avatar_rating',
				'avatar_default',

				/** Media */
				'thumbnail_size_w',
				'thumbnail_size_h',
				'thumbnail_crop',
				'medium_size_w',
				'medium_size_h',
				'large_size_w',
				'large_size_h',
				'uploads_use_yearmonth_folders',

				/** Permalinks */
				'permalink_structure',
				'category_base',
				'tag_base',

				/** Widgets */
				'sidebars_widgets',

				/** Custom */
				'aios_uc_activation',
			) );

			if ( !in_array( $option, $whitelist_options ) ) return;

			$oldvalue = ( ArrayHelper::is_array_recursive( $oldvalue ) ? ArrayHelper::implode_recursive( $oldvalue, ', ' ) : $oldvalue );
            $newvalue = ( ArrayHelper::is_array_recursive( $_newvalue ) ? ArrayHelper::implode_recursive( $_newvalue, ', ' ) : $_newvalue );
            
            $oldvalue = empty( $oldvalue ) ? '' : 'Old: <strong>' . $oldvalue .  '</strong> -> ';
            $newvalue = empty( $newvalue ) ? 'Empty Value' : $oldvalue . 'New: <strong>' . $newvalue .  '</strong>';

			aios_insert_activity_logs(
				array(
					'action' 		=> 'Option Updated',
					'activity'		=> 'Name: <strong>' . $option . '</strong> | ' . $newvalue,
					'object-type'	=> 'Options'
				)
			);
		}

	}
}

$aios_initial_setup_Activity_Logs_Options = new AIOS_Initial_Setup_Activity_Logs_Options();