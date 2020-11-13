<?php

if ( !class_exists( 'aios_admin_post_type_metabox' ) ) {

	class aios_admin_post_type_metabox {

        public $post_type;
        public $post_type_metaboxes;
        public $is_editor_support;

		/**
		 * Add Actions.
		 *
		 * @since 3.9.8
		 * @access protected
		 * @return null
		 */
		public function __construct( $post_type = '', $post_type_metaboxes = [], $is_editor_support = false ) {
            if( !empty( $post_type ) && !empty( $post_type_metaboxes ) ) {
                $this->post_type = $post_type;
                $this->post_type_metaboxes = $post_type_metaboxes;
                $this->is_editor_support = $is_editor_support;
                $this->add_actions();
            }
		}

		/**
		 * Add Actions.
		 *
		 * @since 3.9.8
		 * @access protected
		 * @return void
		 */
		protected function add_actions() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_uiux' ), 10 );
			add_action( 'add_meta_boxes_' . $this->post_type, [ $this, 'custom_metaboxes' ] );
            add_action( 'save_post_' . $this->post_type, [ $this, 'custom_metaboxes_saved' ] );
        }

        /**
		 * Enqueue scripts and styles
		 *
		 * @since 3.9.8
		 * @access public
		 */
        public function admin_uiux() {
            if( in_array( 'banner', $this->post_type_metaboxes ) ) {
                /** Enqueue Media Uploader **/
                wp_enqueue_media();
            }
        }

        /**
         * Add Custom Meta Box
		 *
		 * @since 3.9.8
         * @return null
         */
        public function custom_metaboxes() {
            if( $this->is_editor_support ) remove_post_type_support( $this->post_type, 'editor' );

            add_meta_box( 
				$this->post_type . '-custom-meta-box', 
				'Banner',
				[ $this, 'render_custom_metaboxes' ],
				$this->post_type, 
				'normal', 
				'high'
			);
        }

        /**
         * Renders Custom Meta Box
		 *
		 * @since 3.9.8
         * @param WP_Post $post - Page object
         * @return null
         */
        public function render_custom_metaboxes( $post ) {
			/** make sure the form request comes from WordPress **/
            wp_nonce_field( 'aios-' . $this->post_type . '-save-details', 'aios_' . $this->post_type . '_meta_boxes_nonce' );

            $post_id = $post->ID;
            $aios_custom_metabox = get_post_meta( $post_id, 'aios_custom_metabox', true );
            if( !empty( $aios_custom_metabox ) ) extract( $aios_custom_metabox );

            echo '<style>
                    #' . $this->post_type . '-custom-meta-box {
                        background: transparent !important;
                        border: none !important;
                        padding: 0 !important;
                        margin-top: 30px !important;
                    }
                    #' . $this->post_type . '-custom-meta-box h2.hndle,
                    #' . $this->post_type . '-custom-meta-box .handlediv {
                        display: none !important
                    }
                    #' . $this->post_type . '-custom-meta-box .inside {
                        margin-top: 0;
                        padding: 0 !important
                    }
                    #' . $this->post_type . '-custom-meta-box .wpui-container .wpui-tabs .wpui-tabs-body {
                        background: #FFF
                    }
                    #' . $this->post_type . '-custom-meta-box .wpui-container .wpui-tabs .wpui-tabs-body .wpui-tabs-content {
                        padding: 0
                    }
                    #' . $this->post_type . '-custom-meta-box .wpui-container .wpui-tabs .wpui-tabs-body .wpui-tabs-content .wpui-child-tabs {
                        width: 100%;
                        padding: 20px 15px 20px;
                        margin: 0 0 10px;
                        background: #f5f5f5
                    }
                    #wpui-container-minimalist .wp-editor-tabs *{
                        -webkit-box-sizing: content-box !important;
                        -moz-box-sizing: content-box !important;
                        box-sizing: content-box !important;
                    }
                </style>
                <script>
                    jQuery( document ).ready( function() {
                        jQuery( \'#' . $this->post_type . '-custom-meta-box\' ).insertAfter( \'#titlediv\' );
                    } );
                </script>';
            ?>

            <!-- BEGIN: Main Container -->
            <div id="wpui-container-minimalist" class="wpui-tabs-post-type">
                <!-- BEGIN: Container -->
                <div class="wpui-container">
                    <!-- BEGIN: Tabs -->
                    <div class="wpui-tabs">
                        <!-- BEGIN: Header -->
                        <div class="wpui-tabs-header">
                            <ul>
                                <li><a data-id="<?=$this->post_type?>-details">Details</a></li>
                            </ul>
                        </div>
                        <!-- END: Header -->
                        <!-- BEGIN: Body -->
                        <div class="wpui-tabs-body">
                            <!-- Loader -->
                            <div class="wpui-tabs-body-loader"><i class="ai-font-loading-b"></i></div>

                            <!-- BEGIN: Details -->
                            <div data-id="<?=$this->post_type?>-details" class="wpui-tabs-content <?=$this->post_type?>-custom-title">
                                <div class="wpui-tabs-container">

                                    <?php 
                                        if( in_array( 'title', $this->post_type_metaboxes ) ) {
                                            echo AIOS_CREATE_FIELDS::input_field( [
                                                'row_title'         => 'Custom Title',
                                                'name'              => 'aioscm_used_custom_title',
                                                'options'           => [
                                                                        '1' => 'Used Custom Title'
                                                                    ],
                                                'value'             => ( isset($used_custom_title) ? $used_custom_title : '' ),
                                                'type'              => 'checkbox',
                                                'is_single'         => true
                                            ] );
                                            
                                            echo AIOS_CREATE_FIELDS::input_field( [
                                                'row_title'         => 'Main Title',
                                                'name'              => 'aioscm_main_title',
                                                'placeholder'       => 'Main Title',
                                                'value'             => ( isset($main_title) ? $main_title : '' ),
                                            ] );
                                            
                                            echo AIOS_CREATE_FIELDS::input_field( [
                                                'row_title'         => 'Sub Title',
                                                'name'              => 'aioscm_sub_title',
                                                'placeholder'       => 'Sub Title',
                                                'value'             => ( isset($sub_title) ? $sub_title : '' ),
                                            ] );
                                        }
                                        
                                        if( in_array( 'banner', $this->post_type_metaboxes ) ) {
                                            echo AIOS_CREATE_FIELDS::image_upload( [
                                                'row_title'         => 'Banner',
                                                'name' 			    => 'aioscm_banner',
                                                'value' 		    => ( isset($banner) ? $banner : '' ),
                                                'title' 			=> 'Upload Image',
                                                'type'              => 'image',
                                                'button_text' 		=> 'Select Image',
                                                'filter_page_text' 	=> 'Uploaded to this Page',
                                                'no_image' 			=> 'No image upload'
                                            ] );
                                        }

                                        if( $this->is_editor_support ) {
                                            echo '
                                                <div class="wpui-row wpui-row-box">
                                                    <div class="wpui-col-md-3">
                                                        <p><span class="wpui-settings-title">Content</span></p>
                                                    </div>
                                                    <div class="wpui-col-md-9">';
                                                        $post      = get_post( $post_id, OBJECT, 'edit' );
                                                        $content   = $post->post_content;
                                                        $editor_id = 'content';
                                                            
                                                        wp_editor( $content, $editor_id );
                                            echo '</div>
                                            </div>';
                                        }
                                    ?>

                                </div>
                            </div>
                            <!-- END: Background -->

                        </div>
                        <!-- END: Body -->
                    </div>
                    <!-- END: Tabs -->
                </div>
                <!-- END: Container -->
            </div>
            <!-- END: Main Container -->
            <?php
        }


        /**
         * Renders Custom Meta Box
		 *
		 * @since 3.9.8
         * @param WP_Post_Int $post_id - post ID
         * @return null
         */
        public function custom_metaboxes_saved( $post_id ) {
            
            /** Pointless if $_POST is empty (this happens on bulk edit) **/
			if ( empty( $_POST ) ) return $post_id;
			
			/** Verify taxonomies meta box nonce **/
			if ( !isset( $_POST['aios_' . $this->post_type .'_meta_boxes_nonce'] ) || !wp_verify_nonce( $_POST['aios_' . $this->post_type .'_meta_boxes_nonce'], 'aios-' . $this->post_type .'-save-details' ) ) return;
			
			/** Verify quick edit nonce **/
			if ( isset( $_POST['_inline_edit'] ) && ! wp_verify_nonce( $_POST['_inline_edit'], 'inlineeditnonce' ) ) return $post_id;
			
			/** Don't save on autosave **/
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
			
			/** Check the user's permissions. **/
			if ( !current_user_can( 'edit_page', $post_id ) ) return;
			
			/** Check post status **/
			if ( get_post_status( $post_id ) == 'trash'  ) return;
            
			/** Unhook this function to prevent infinite looping **/
            remove_action( 'save_post_' . $this->post_type, 'custom_metaboxes_saved' );
            
            /** Custom meta boxes for page values */
            $used_custom_title  = is_null( $_POST['aioscm_used_custom_title'] ) ? 0 : $_POST['aioscm_used_custom_title'];
            $main_title         = $_POST['aioscm_main_title'];
            $sub_title          = $_POST['aioscm_sub_title'];
            $banner             = $_POST['aioscm_banner'];
            
			/** Save as Array **/
			$aios_custom_metabox = [
                'used_custom_title' => $used_custom_title,
                'main_title'        => $main_title,
                'sub_title'         => $sub_title,
                'banner'            => $banner
            ];
			
			update_post_meta( $post_id, 'aios_custom_metabox', $aios_custom_metabox );
			update_post_meta( $post_id, 'aioscm_used_custom_title', $used_custom_title );
			update_post_meta( $post_id, 'aioscm_main_title', $main_title );
			update_post_meta( $post_id, 'aioscm_sub_title', $sub_title );
            update_post_meta( $post_id, 'aioscm_banner', $banner );

			/** rehook save_post **/
			add_action( 'save_post_' . $this->post_type, 'custom_metaboxes_saved' );
        }

    }

}