<?php
/**
 * This will generate default pages
 *
 * @since 2.8.6
 */
if ( !class_exists( 'aios_initial_setup_generate_default_pages' ) ) {

	class aios_initial_setup_generate_default_pages{

		public function generate_default_pages( $ids ) {
			if ( !empty( $ids ) ) {
				$aios_initial_setup_generate_default_pages_content = new aios_initial_setup_generate_default_pages_content();

				$cf7ShortcodeArr = $ids;
				
				foreach ( $cf7ShortcodeArr as $cf7Shortcode ) {
					$cf7Info = array();

					if ( $cf7Shortcode == 0 ) {
						$cf7Info = $aios_initial_setup_generate_default_pages_content->shortCodeToAdd( $cf7Shortcode );
					} else if ( $cf7Shortcode == 1 ) {
						$cf7Info = $aios_initial_setup_generate_default_pages_content->shortCodeToAdd( $cf7Shortcode );
					} else if ( $cf7Shortcode == 2 ) {
						$cf7Info = $aios_initial_setup_generate_default_pages_content->shortCodeToAdd( $cf7Shortcode );
					} else if ( $cf7Shortcode == 4 ) {
						$cf7Info = $aios_initial_setup_generate_default_pages_content->shortCodeToAdd( $cf7Shortcode );
					} else if ( $cf7Shortcode == 5 ) {
						$cf7Info = $aios_initial_setup_generate_default_pages_content->shortCodeToAdd( $cf7Shortcode );
					} else if ( $cf7Shortcode == 3 ) {
						$siteMapPage = array(
							'post_title' => 'Sitemap',
							'post_content' => '[sitemap]',
							'post_type' => 'page',
							'post_status' => 'publish',
							'post_author' => 1
						);

						$page = get_page_by_path( 'sitemap', OBJECT, 'page' );

						if ( isset( $page ) ) {
							$siteMapPage['ID'] = $page->ID;
							wp_update_post($siteMapPage);
						} else {
							wp_insert_post($siteMapPage);
						}
					} else{
						/** Do Nothing **/
					}
						
					if ( $cf7Shortcode != 3 ) {
						$exist_form_id = $this->check_if_form_exist( $cf7Shortcode );

						if ( is_numeric( $exist_form_id ) ) {
							$mail_meta          = get_post_meta( $exist_form_id, '_mail', true );
		 
							$sender             = $mail_meta['sender'];
							$recipient          = $mail_meta['recipient'];
							$additional_headers = $mail_meta['additional_headers'];
		 
							$cf7Info['mail']['sender']                  = $mail_meta['sender'];
							$cf7Info['mail']['recipient']               = $mail_meta['recipient'];
							$cf7Info['mail']['additional_headers']      = $mail_meta['additional_headers'];
		 
							update_post_meta($exist_form_id, '_messages', $cf7Info['messages']);
							update_post_meta($exist_form_id, '_mail', $cf7Info['mail']);
							update_post_meta($exist_form_id, '_form', $cf7Info['form']);
						} else {
							$toInsert = array(
								'post_title'    => $cf7Info['shotcodeTitle'],
								'post_content'  => 'Auto Generated by Initial Setup',
								'post_type'     => 'wpcf7_contact_form',
								'post_status'   => 'publish',
								'post_author'   => 1
							);
							 
							$pageID = wp_insert_post($toInsert);
							 
							if ($pageID) {

								update_post_meta($pageID, '_messages', $cf7Info['messages']);
								update_post_meta($pageID, '_mail', $cf7Info['mail']);
								update_post_meta($pageID, '_form', $cf7Info['form']);
								 
								$pageContent = '<div class="aidefcf-wrapper aidefcf-wrapper-' . strtolower(str_replace(" ", "-", $cf7Info['shotcodeTitle'])) . '"><p>' . $cf7Info['pageContent'] . '</p> [contact-form-7 id="' . $pageID . '" title="' . $cf7Info['shotcodeTitle'] . '" html_class="use-floating-validation-tip"]</div>';
								 
								$toInsertPage = array(
									'post_title'    => str_replace ( ' (Auto-generated by AIOS Initial Setup)', '', $cf7Info['shotcodeTitle'] ),
									'post_name' 	=> $cf7Info['pageSlug'],
									'post_content'  => $pageContent,
									'post_type'     => 'page',
									'post_status'   => 'publish',
									'post_author'   => 1
								); 

							}
						}
					}

					if ( $toInsertPage["post_title"] != "404 Page Form" ) {
						$page = get_page_by_path( $toInsertPage['post_name'], OBJECT, 'page' );

						if ( isset( $page ) ) {
							$toInsertPage['ID'] = $page->ID;
							wp_update_post($toInsertPage);
						} else {
							wp_insert_post($toInsertPage);
						}
					}
					
				}
			}
		}

		public function check_if_form_exist( $id ) {
			wp_reset_query();
			wp_reset_postdata();

			$cf7_args = array(
				'post_type'		 => 'wpcf7_contact_form',
				'posts_per_page' => -1
			);

			$cf7_form = '';

			switch ( $id ) {
				case 0: $cf7_form = 'What is My Home Worth? (Auto-generated by AIOS Initial Setup)'; break;
				case 1: $cf7_form = 'Find My Dream Home! (Auto-generated by AIOS Initial Setup)'; break;
				case 2: $cf7_form = 'Help Me Relocate! (Auto-generated by AIOS Initial Setup)'; break;
				case 4: $cf7_form = 'Contact Us (Auto-generated by AIOS Initial Setup)'; break;
				case 5: $cf7_form = '404 Page Form (Auto-generated by AIOS Initial Setup)'; break;
			}

			$cf7_arr = get_posts( $cf7_args );
			wp_reset_query();

			$cf7_holder = array();

			if ( !empty ( $cf7_arr ) ){
				foreach ($cf7_arr as $cf7_item ) {
					$cf7_holder[$cf7_item->post_title] = $cf7_item->post_title;
				}
			}

			if ( in_array( $cf7_form, $cf7_holder ) ){
				$form_data = get_page_by_title( $cf7_form, '', 'wpcf7_contact_form' );
				return $form_data->ID;
			} else {
				return false;
			}
		}

    }
    
    $aios_initial_setup_generate_default_pages = new aios_initial_setup_generate_default_pages();

}