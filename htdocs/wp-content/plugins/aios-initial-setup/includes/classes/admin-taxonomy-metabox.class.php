<?php

if ( !class_exists( 'aios_admin_taxonomy_metabox' ) ) {

	class aios_admin_taxonomy_metabox {

        public $taxonomy;
        public $taxonomy_metaboxes;
        public $is_editor_support;

		/**
		 * Add Actions.
		 *
		 * @since 3.9.8
		 * @access protected
		 * @return null
		 */
		public function __construct( $taxonomy = '', $taxonomy_metaboxes = [] ) {
            if( !empty( $taxonomy ) && !empty( $taxonomy_metaboxes ) ) {
                $this->taxonomy = $taxonomy;
                $this->taxonomy_metaboxes = $taxonomy_metaboxes;
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
            /** Create fields for new tags and edit tags */
            add_action( $this->taxonomy . '_add_form_fields', array( $this, 'create_extra_category_fields' ) );
            add_action( $this->taxonomy . '_edit_form_fields', array( $this, 'edit_extra_category_fields' ) );

            /** Save tags for new and edited */
            add_action( 'create_' . $this->taxonomy, array( $this, 'save_extra_category_fileds' ) );
            add_action( 'edited_' . $this->taxonomy, array( $this, 'save_extra_category_fileds' ) );
        }

        /**
		 * Enqueue scripts and styles
		 *
		 * @since 3.9.8
		 * @access public
		 */
        public function admin_uiux() {
            if( in_array( 'banner', $this->taxonomy_metaboxes ) ) wp_enqueue_media();
        }

        /**
		 * Create fields.
		 *
		 * @since 3.9.8
		 *
		 * @access public
		 * @return void
		 */
		public function create_extra_category_fields() {
            if( in_array( 'title', $this->taxonomy_metaboxes ) ) {
                echo '<div class="form-field term-cat-wrap">';
                    echo AIOS_CREATE_FIELDS::input_field( [
                        'row'               => false,
                        'name'              => 'term_meta[used_custom_title]',
                        'options'           => [
                                                '1' => 'Use Custom Title'
                                            ],
                        'value'             => '',
                        'type'              => 'checkbox',
                        'is_single'         => true
                    ] );
                    
                    echo '<div class="mt-3">' . AIOS_CREATE_FIELDS::input_field( [
                        'row'               => false,
                        'label'             => true,
                        'label_value'       => 'Main Title',
                        'name'              => 'term_meta[main_title]',
                        'placeholder'       => 'Main Title',
                        'value'             => '',
                    ] ) . '</div>';
                    
                    echo '<div class="mt-3">' . AIOS_CREATE_FIELDS::input_field( [
                        'row'               => false,
                        'label'             => true,
                        'label_value'       => 'Sub Title',
                        'name'              => 'term_meta[sub_title]',
                        'placeholder'       => 'Sub Title',
                        'value'             => '',
                    ] ) . '</div>';
                echo '</div>';
            }
            
            if( in_array( 'banner', $this->taxonomy_metaboxes ) ) {
                echo '<div class="form-field term-cat-wrap">';
                    echo AIOS_CREATE_FIELDS::image_upload( [
                        'row'               => false,
                        'label'             => true,
                        'label_value'       => 'Banner',
                        'name' 			    => 'term_meta[banner]',
                        'value' 		    => '',
                        'title' 			=> 'Upload Image',
                        'type'              => 'image',
                        'button_text' 		=> 'Select Image',
                        'filter_page_text' 	=> 'Uploaded to this Page',
                        'no_image' 			=> 'No image upload'
                    ] );
                echo '</div>';
            }
        }
        
        /**
		 * Edit fields.
		 *
		 * @since 3.9.8
		 *
		 * @access public
		 * @return void
		 */
        public function edit_extra_category_fields( $tag ) {
            $taxonomy_meta = get_option( "term_meta_" . $tag->term_id );
            if( in_array( 'title', $this->taxonomy_metaboxes ) ) {
                ?>
                    <tr class="form-field">
                        <th scope="row" valign="top">
                            <label>Custom Title</label>
                        </th>
                        <td>
                            <?php
                                echo AIOS_CREATE_FIELDS::input_field( [
                                    'row'               => false,
                                    'name'              => 'term_meta[used_custom_title]',
                                    'options'           => [
                                                            '1' => 'Use Custom Title'
                                                        ],
                                    'value'             => $taxonomy_meta['used_custom_title'],
                                    'type'              => 'checkbox',
                                    'is_single'         => true
                                ] );
                                
                                echo '<div class="mt-3">' . AIOS_CREATE_FIELDS::input_field( [
                                    'row'               => false,
                                    'label'             => true,
                                    'label_value'       => 'Main Title',
                                    'name'              => 'term_meta[main_title]',
                                    'placeholder'       => 'Main Title',
                                    'value'             => $taxonomy_meta['main_title'],
                                ] ) . '</div>';
                                
                                echo '<div class="mt-3">' . AIOS_CREATE_FIELDS::input_field( [
                                    'row'               => false,
                                    'label'             => true,
                                    'label_value'       => 'Sub Title',
                                    'name'              => 'term_meta[sub_title]',
                                    'placeholder'       => 'Sub Title',
                                    'value'             => $taxonomy_meta['sub_title'],
                                ] ) . '</div>';
                            ?>
                        </td>
                    </tr>
                <?php
            }
            
            if( in_array( 'banner', $this->taxonomy_metaboxes ) ) {
                ?>
                <tr class="form-field">
                    <th scope="row" valign="top">
                        <label>Banner</label>
                    </th>
                    <td>
                        <?php
                            echo AIOS_CREATE_FIELDS::image_upload( [
                                'row'               => false,
                                'name' 			    => 'term_meta[banner]',
                                'value' 		    => $taxonomy_meta['banner'],
                                'title' 			=> 'Upload Image',
                                'type'              => 'image',
                                'button_text' 		=> 'Select Image',
                                'filter_page_text' 	=> 'Uploaded to this Page',
                                'no_image' 			=> 'No image upload'
                            ] );
                        ?>
                    </td>
                </tr>
                <?php
            }
        }

        /**
		 * Save fields.
		 *
		 * @since 3.9.8
		 *
		 * @access public
		 * @return void
		 */
        function save_extra_category_fileds( $term_id ) {
            if ( isset( $_POST['term_meta'] ) ) {
                $term_meta = [];
                $terms = array_keys( $_POST['term_meta'] );
                foreach ( $terms as $term ) if ( isset( $_POST['term_meta'][$term] ) ) $term_meta[$term] = $_POST['term_meta'][$term];
                update_option( "term_meta_" . $term_id, $term_meta );
            }
        }

    }

}