<?php
/**
 * Common methods to create input, select, and textarea
 *
 * @return void
 */
if ( !class_exists( 'aios_create_fields' ) ) {

	class AIOS_CREATE_FIELDS {

		/**
		 * Create Input Field.
		 *
		 * @since 3.9.8
         * @param $defaults
         *          row - Display input fields as a whole in ROW. Default: true (boolean)
         *          row_title - Row Title, row must be true to display. Default: Add Title(string)
         *          row_description - Row description, added below title, row must be true to display. Default: empty(string)
         *          name - use for label for, input name and id. Default: empty(string)
         *          class - class name for input. Default: empty(string)
         *          value - it defines the initial (default) value of the input. Default: empty(string)
         *          placeholder - The short hint is displayed in the input field before the user enters a value. Default: empty(string)
         *          label - Display label above the input tag. Default: false (boolean)
         *          label_value - Label Text. Default: Add Title(string)
		 * 			helper_value - Text below input. Default: Empty(string)
         *          type - Specifies the type <input> element to display. Default: text(string)
         *          autocomplete - Autocomplete allows the browser to predict the value. Default: on(on|off)
         *          options - list of options. Default: empty(array)
         *          is_single - for checkbox only, this not add a bracket[] to name. Default: false(boolean)
		 *
		 * @access public
		 * @return string
		 */
		public static function input_field( $args = [] ) {
			/** Accepted args and default values **/
			$defaults = [
                'row'               => true,
                'row_title'         => 'Add Title',
                'row_description'   => '',
				'name' 			    => 'default-name',
				'class' 		    => '',
				'value' 		    => '',
				'placeholder' 	    => '',
				'label' 		    => false,
				'label_value' 	    => 'Add label',
				'helper_value' 		=> '',
				'type' 			    => 'text',
                'autocomplete' 	    => 'on',
                'readonly' 		    => false,
                
                /** array for radio/checkbox */
				'options' 			=> [],
				'is_single' 		=> false
			];

			$r = wp_parse_args( $args, $defaults );

			extract( $r );
			$html               = '';
            $class              = ( !empty( $class ) ? 'class="' . $class . '"' : '' );
            $row_open_tag       = ( $row ? '<div class="wpui-row wpui-row-box"><div class="wpui-col-md-3"><p><span class="wpui-settings-title">' . $row_title . '</span>' .                                 $row_description . '</p></div><div class="wpui-col-md-9">' : '' );
            $row_closing_tag    = ( $row ? '</div></div>' : '' );

            $html .= '<div class="form-group">';
            $html .= ( $label ? '<label for="' . $name . '">' . $label_value . '</label>' : '' );

            if ( $type == 'checkbox' ) {
                $value = ( is_array( $value ) ? $value : [$value] );
				$options = ( is_array( $options ) ? $options : [$options] );
				$font_weight = ( $label ? '400' : '700' );
                $html .= '<div class="form-checkbox-group">';
                    foreach ( $options as $option => $v ) {
                        $option = ( !empty( $option ) ? $option : $v );
                        $option_name = ( $is_single ? $name : ( is_array( $options ) ? $name . '[' . $option . ']' : $name ) );
                        $is_checked = ( array_search( $option, $value ) !== false ? 'checked="checked"' : '' );
                        $html .= '<div class="form-checkbox">
                            <label><input type="checkbox" 
                                name="' . $option_name . '" 
                                id="' . $option_name . '" 
                                value="' . $option . '" 
                                ' . $is_checked . '
                            > <span style="font-weight: ' . $font_weight . '">' . $v . '</span></label>
                        </div>';
                    }
                $html .= '</div>';
            } elseif ( $type == 'radio' ) {
                $html .= '<div class="form-radio-group">';
                $options = ( is_array( $options ) ? $options : [$options] );
                    foreach ( $options as $option ) {
                        $is_checked = ( $option == $value ? 'checked="checked"' : '' );
                        $html .= '<div class="form-radio">
                            <label><input type="radio" name="' . $name . '" id="' . $name . '" value="' . $option . '" ' . $is_checked . '> ' . $option . '</label>
                        </div>';
                    }
                $html .= '</div>';
            } else {
                $html .= '<input type="' . $type . '" name="' . $name . '" id="' . $name . '" ' . $class . ' value="' . $value . '" placeholder="' . $placeholder . '" autocomplete="' . $autocomplete . '" ' . ( $readonly ? 'readonly' : '' ) . '>';
            }

			$html .= !empty( $helper_value ) ? '<p class="mt-0">' . $helper_value . '</p>' : ''; /** Helper */
			$html .= '</div>';

			return $row_open_tag . $html . $row_closing_tag;
		}

		/**
		 * Create Select.
		 *
		 * @since 3.9.8
         * @param $defaults
         *          row - Display input fields as a whole in ROW. Default: true (boolean)
         *          row_title - Row Title, row must be true to display. Default: Add Title(string)
         *          row_description - Row description, added below title, row must be true to display. Default: empty(string)
         *          name - use for label for, input name and id. Default: empty(string)
         *          class - class name for input. Default: empty(string)
		 * 			is_name_array - this will bracket after the name. Default. false(boolean)
         *          options - list of options. Default: empty(array)
		 *          value - it defines the initial (default) value of the input. Default: empty(string)
		 *          label - Display label above the input tag. Default: false (boolean)
		 *          label_value - Label Text. Default: Add Title(string)
		 *          placeholder - Add first option as placeholder but empty value. Default: empty(string)
         *          type - Specifies the type <input> element to display. Default: text(string)
         *          reverse - flip value and options. Default: false(boolean)
		 *
		 * @access public
		 * @return string
		 */
		public static function select( $args = [] ){
			/** Accepted args and default values **/
			$defaults = [
                'row'               => true,
                'row_title'         => 'Add Title',
                'row_description'   => '',
				'name' 				=> 'default-name',
				'class' 			=> '',
				'is_name_array' 	=> false,
				'options' 			=> [],
				'value' 			=> '',
				'label' 			=> true,
				'label_value' 		=> 'Add label',
				'placeholder' 		=> '',
				'reverse' 			=> false
			];

			$r = wp_parse_args( $args, $defaults );

			extract( $r );
			/** Convert to array if not array */
			
			$html 				= '';
            $row_open_tag       = ( $row ? '<div class="wpui-row wpui-row-box"><div class="wpui-col-md-3"><p><span class="wpui-settings-title">' . $row_title . '</span>' .                                 $row_description . '</p></div><div class="wpui-col-md-9">' : '' );
            $row_closing_tag    = ( $row ? '</div></div>' : '' );
			
			$html .= '<div class="form-group">';
			$html .= ( $label ? '<label for="' . $name . '" class="float-left w-100">' . $label_value . '</label>' : '' );
			
			$html .= '<select name="' . $name . ( $is_name_array ? '[]' : '' ) . '" id="' . $name . '" class="w-100 ' . $class .'">';
				$html .= ( !empty( $placeholder ) ? '<option value="">' . $placeholder . '</option>' : '' );
					$options = ( is_array( $options ) ? $options : [$options] );
					foreach( $options as $option => $v ){
						if ( is_array( $value ) ) {
							$is_checked = ( array_search( $option, $value ) ? 'selected' : '' );
						} else {
							$is_checked = ( $value == $option ? 'selected' : '' );
						}
						/** use below for assoc array */
						if( !empty($option) ) {
							$html .= ( $reverse == true ? '<option ' . $is_checked . ' value="' . $v . '">' . $option . '</option>' :  '<option ' . $is_checked . ' value="' . $option . '">' . $v . '</option>' );
						} else {
							$html .= '<option ' . $is_checked . ' value="' . $v . '">' . $v . '</option>';
						}
					}
				$html .= '</select>';
			$html .= '</div>';

			return $row_open_tag . $html . $row_closing_tag;
		}

		/**
		 * Createimage uploader
		 *
		 * @since 3.9.8
         * @param $defaults
         *          row - Display input fields as a whole in ROW. Default: true (boolean)
         *          row_title - Row Title, row must be true to display. Default: Add Title(string)
         *          row_description - Row description, added below title, row must be true to display. Default: empty(string)
         *          label - Display label above the input tag. Default: false (boolean)
         *          label_value - Label Text. Default: Add Title(string)
         *          name - use for label for, input name and id. Default: empty(string)
         *          value - it defines the initial (default) value of the input field except checkbox. Default: empty(string)
         *          title - Title for media uploader. Default: empty(string)
         *          upload_text - Text for upload button. Default: Upload(string)
		 * 			remove_text - Text for remove button. Default: Remove(string)
         *          title - Title for media uploader. Default: empty(string)
         *          type - Type of file to upload. Default: image(string)
         *          button_text - Button text for media uploader. Default: empty(string)
         *          filter_page_text - Text for filter. Default: empty(string)
         *          no_image - Text if no image. Default: empty(string)
		 *
		 * @access public
		 * @return string
		 */
		public static function image_upload( $args = [] ) {
			/** Accepted args and default values **/
			$defaults = [
                'row'               => true,
                'row_title'         => 'Add Title',
				'row_description'   => '',
				'label' 		    => false,
				'label_value' 	    => 'Add label',
				'name' 			    => 'default-name',
				'value' 		    => '',
				'upload_text' 		=> 'Upload',
				'remove_text' 		=> 'Remove',
				'type' 				=> 'image',
				'title' 			=> 'Media Gallery',
				'button_text' 		=> 'Select',
				'filter_page_text' 	=> 'Uploaded to this Page',
				'no_image' 			=> 'No image upload'
			];

			$r = wp_parse_args( $args, $defaults );

			extract( $r );
			$html               = '';
            $class              = ( !empty( $class ) ? 'class="' . $class . '"' : '' );
            $row_open_tag       = ( $row ? '<div class="wpui-row wpui-row-box"><div class="wpui-col-md-3"><p><span class="wpui-settings-title">' . $row_title . '</span>' .                                 $row_description . '</p></div><div class="wpui-col-md-9">' : '' );
			$row_closing_tag    = ( $row ? '</div></div>' : '' );

			/** Check if value is int or url */
			$convert = ( !is_numeric( $value ) ? $value : ( !empty( $value ) ? wp_get_attachment_image_url( $value, 'full' ) : '' ) );
			$label_value = ( $label ? '<label for="' . $name . '">' . $label_value . '</label>' : '' );
			
			$html .= '<div class="form-group">
				' . $label_value . '
				<div class="wpui-uploader-container-parent float-left w-100" data-type="' . $type . '" data-title="' . $title . '" data-button-text="' . $button_text . '" data-filter-page-text="' . $filter_page_text . '" data-no-image="' . $no_image . '">
					<div class="wpui-uploader-image-preview">
						' . ( !empty( $value ) ? '<img src="' . $convert . '" style="max-width: 100%; margin-bottom: 10px;">' : '<p>' . $no_image  ) . '</p>' . '
					</div>
					<input type="text" class="wpui-uploader-image-input" name="' . $name . '" id="' . $name . '" value="' . $value . '" style="display: none;">
					<div class="wpui-uploader-button">
						<input type="button" class="wpui-uploader-upload wpui-secondary-button aios-secondary-button" value="' . $upload_text . '">
						<input type="button" class="wpui-uploader-remove wpui-default-button wpui-disabled-button aios-disabled-button" value="' . $remove_text . '">
					</div>
				</div>
			</div>';

			return $row_open_tag . $html . $row_closing_tag;
		}

	}

}