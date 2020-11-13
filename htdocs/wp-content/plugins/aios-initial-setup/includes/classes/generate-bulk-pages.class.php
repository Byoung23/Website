<?php
/**
 * This will generate default pages
 *
 * @since 2.8.6
 */
if ( !class_exists( 'aios_initial_setup_generate_bulk_pages' ) ) {

	class aios_initial_setup_generate_bulk_pages{

		public function generate_bulk_pages( $pages, $page_content, $page_status, $page_parent, $page_template ) {
			$pageTitles = explode( "\n", $pages );

			foreach($pageTitles as $pageTitle){
				if( trim($pageTitle) != '' ) {
					$toInsert = array(	
						'post_title'    => trim($pageTitle),
						'post_content'  => $page_content,
						'post_type'	 	=> 'page',	
						'post_status'   => $page_status,
						'post_author'   => 1,
						'post_parent' 	=> $page_parent,
					);

					if( !empty($page_template) ) $toInsert['page_template'] = $page_template;

					wp_insert_post( $toInsert );
				}
			}

		}

    }
    
    $aios_initial_setup_generate_bulk_pages = new aios_initial_setup_generate_bulk_pages();

}