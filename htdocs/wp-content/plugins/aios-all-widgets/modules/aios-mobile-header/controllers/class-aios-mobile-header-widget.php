<?php
/**
 * 
 * $this->id : Get current widget ID
 * $this->id_base : Get current widget ID Base
 */
class AIOS_Mobile_Header_Widget extends WP_Widget {

	private $_theme_manager;
	protected $_documentation_url;
	
	function __construct() {
		parent::__construct(
			'aios-mobile-header', /** Base ID */
			'AIOS Mobile Header', /** Name */
			array( 'description' => 'This widget allows users to customize the recommended header format for mobile devices.' ) /** Args */
		);
		
		/** Initialize theme manager */
		$this->_theme_manager = new AIOS_Mobile_Header_Theme_Manager();
		$this->_documentation_url = AIOS_ALL_WIDGETS_URL . "modules/aios-mobile-header/documentation.html";
		
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_footer-widgets.php', array( $this, 'print_scripts' ), 9999 );
	}
	
	public function widget( $args, $instance ) {
		/** Create unique ID */
		$instance_id = uniqid();
		
		/** Get available menus */
		$menus = wp_get_nav_menus();

		/** Determine default menu */
		if ( isset( $instance['menu_id'] ) ) {
			$menu_id = $instance['menu_id'];
		} else if ( isset( $instance['menu'] ) ) {
			$theme_location = $instance['menu'];
			$menu_object = wp_get_nav_menu_object( $theme_location );
			$menu_id = $menu_object->term_id;
		} else {
			$menu_id = $menus[0]->term_id;
		}		
		
		$menu_id = apply_filters("aios_mobile_header_menu_id", $menu_id);
		
		/** Get selected menu theme */
		$selected_theme = apply_filters("aios_mobile_header_theme", $instance['theme']);
		
		/** Get theme object */
		$theme = new AIOS_Mobile_Header_Theme($selected_theme);
		
		/** Get variables */
		$phone_hide 	= apply_filters("aios_mobile_header_phone_hide", $instance['phone_hide']);
		$phone 			= apply_filters("aios_mobile_header_phone", $instance['phone']);
		$email_hide 	= apply_filters("aios_mobile_header_email_hide", $instance['email_hide']);
		$email 			= apply_filters("aios_mobile_header_email", $instance['email']);
		$behavior 		= apply_filters("aios_mobile_header_behavior", $instance['behavior']);
		$logo_url_hide 	= apply_filters("aios_mobile_header_logo_url_hide", $instance['logo_url_hide']);
		$logo_url 		= apply_filters("aios_mobile_header_logo_url", $instance['logo_url']);
		
		$breakpoint 	= isset( $instance['breakpoint'] ) ? $instance['breakpoint'] : '992';
		$breakpoint 	= apply_filters("aios_mobile_header_breakpoint", $breakpoint);
		
		$use_custom_color = !empty( $instance['use_custom_color'] ) ? $instance['use_custom_color'] : 0;
		
		$background 	= !empty( $instance['background'] ) ? $instance['background'] : '#FFFFFF';
		$icon_color 	= !empty( $instance['icon_color'] ) ? $instance['icon_color'] : '#000000';

		$parent_background 			= !empty( $instance['parent_background'] ) ? $instance['parent_background'] : '#FFFFFF';
		$parent_background_hover 	= !empty( $instance['parent_background_hover'] ) ? $instance['parent_background_hover'] : '#3c3c3c';
		$parent_border 				= !empty( $instance['parent_border'] ) ? $instance['parent_border'] : '#f7f7f7';
		$parent_text_color 			= !empty( $instance['parent_text_color'] ) ? $instance['parent_text_color'] : '#858585';
		$parent_text_color_hover 	= !empty( $instance['parent_text_color_hover'] ) ? $instance['parent_text_color_hover'] : '#FFFFFF';

		$submenu_background 		= !empty( $instance['submenu_background'] ) ? $instance['submenu_background'] : '#232323';
		$submenu_background_hover 	= !empty( $instance['submenu_background_hover'] ) ? $instance['submenu_background_hover'] : '#3c3c3c';
		$submenu_border 			= !empty( $instance['submenu_border'] ) ? $instance['submenu_border'] : '#f7f7f7';
		$submenu_text_color 		= !empty( $instance['submenu_text_color'] ) ? $instance['submenu_text_color'] : '#FFFFFF';
		$submenu_text_color_hover 	= !empty( $instance['submenu_text_color_hover'] ) ? $instance['submenu_text_color_hover'] : '#FFFFFF';

		$subsubmenu_background 			= !empty( $instance['subsubmenu_background'] ) ? $instance['subsubmenu_background'] : '#232323';
		$subsubmenu_background_hover 	= !empty( $instance['subsubmenu_background_hover'] ) ? $instance['subsubmenu_background_hover'] : '#3c3c3c';
		$subsubmenu_border 				= !empty( $instance['subsubmenu_border'] ) ? $instance['subsubmenu_border'] : '#f7f7f7';
		$subsubmenu_text_color 			= !empty( $instance['subsubmenu_text_color'] ) ? $instance['subsubmenu_text_color'] : '#FFFFFF';
		$subsubmenu_text_color_hover	= !empty( $instance['subsubmenu_text_color_hover'] ) ? $instance['subsubmenu_text_color_hover'] : '#FFFFFF';

		if ( $use_custom_color == 1 ) {
			echo '<script>
		jQuery( document ).ready( function() {
			jQuery( "head" ).append("<style type=\"text/css\">\
				.' . $this->id . ' .amh-header-buttons{background: ' . $background . '; color: ' . $icon_color . ' !important;}\
					.' . $this->id . ' .amh-header-buttons .amh-phone .amh-phone-text{color: ' . $icon_color . ';}\
					.' . $this->id . ' .amh-header-buttons .amh-navigation-trigger span{color: ' . $icon_color . ';}\
				.' . $this->id . ' .amh-navigation{background: ' . $parent_background . ';}\
				.' . $this->id . ' .amh-navigation .amh-menu li{border-color: ' . $parent_border . ';}\
					.' . $this->id . ' .amh-navigation .amh-menu li a{color: ' . $parent_text_color . ';}\
						.' . $this->id . ' .amh-navigation .amh-menu li:hover > a,\
						.' . $this->id . ' .amh-navigation .amh-menu li.open > a{background: ' . $parent_background_hover . '; color: ' . $parent_text_color_hover . ';}\
				.' . $this->id . ' .amh-navigation .amh-menu li ul{background: ' . $submenu_background . ';}\
					.' . $this->id . ' .amh-navigation .amh-menu li ul li{border-color: ' . $submenu_border . ';}\
						.' . $this->id . ' .amh-navigation .amh-menu li ul li a{background: ' . $submenu_background . '; color: ' . $submenu_text_color . ';}\
							.' . $this->id . ' .amh-navigation .amh-menu li ul li:hover a,\
							.' . $this->id . ' .amh-navigation .amh-menu li ul li.open a{background: ' . $submenu_background_hover . '; color: ' . $submenu_text_color_hover . ';}\
				.' . $this->id . ' .amh-navigation .amh-menu li li.open ul{background: ' . $subsubmenu_background . ';}\
					.' . $this->id . ' .amh-navigation .amh-menu li li.open ul li{border-color: ' . $subsubmenu_border . ';}\
						.' . $this->id . ' .amh-navigation .amh-menu li li.open ul li a{background: ' . $subsubmenu_background . '; color: ' . $subsubmenu_text_color . ';}\
							.' . $this->id . ' .amh-navigation .amh-menu li li.open ul li:hover a,\
							.' . $this->id . ' .amh-navigation .amh-menu li li.open ul li.open a{background: ' . $subsubmenu_background_hover . '; color: ' . $subsubmenu_text_color_hover . ';}\
			</style>");
		} );
	</script>';
		}

		/** Load template */
		include AIOS_MOBILE_HEADER_DIRECTORY . 'views' . 
				DIRECTORY_SEPARATOR . 'frontend' . 
				DIRECTORY_SEPARATOR . $selected_theme . 
				DIRECTORY_SEPARATOR . 'widget.php';
	}

	public function form( $instance ) {
		/** Get available menus */
		$menus = wp_get_nav_menus();
		
		/** Get themes */
		$themes = $this->_theme_manager->get_themes();
		
		/** Get selected theme */
		$selected_theme = !empty( $instance['theme'] ) ? $instance['theme'] : 'header3a';
		$theme 			= new AIOS_Mobile_Header_Theme($selected_theme);
		$email 			= !empty( $instance['email'] ) ? $instance['email'] : 'support@agentimage.com';
		$email_hide 	= isset( $instance['email_hide'] ) ? (int) $instance['email_hide'] : 0;
		$logo_url 		= !empty( $instance['logo_url'] ) ? $instance['logo_url'] : $theme->get_url() . '/images/icon-logo.png';
		$logo_url_hide 	= isset( $instance['logo_url_hide'] ) ? (int) $instance['logo_url_hide'] : 0;
		$phone 			= !empty( $instance['phone'] ) ? $instance['phone'] : '310.595.9033';
		$phone_hide 	= isset( $instance['phone_hide'] ) ? (int) $instance['phone_hide'] : 0;
		$menu_id 		= !empty( $instance['menu_id'] ) ? $instance['menu_id'] : '';

		$behavior 		= !empty( $instance['behavior'] ) ? $instance['behavior'] : 'bottom';
		$breakpoint 	= !empty( $instance['breakpoint'] ) ? $instance['breakpoint'] : '992';

		$use_custom_color = !empty( $instance['use_custom_color'] ) ? $instance['use_custom_color'] : 0;
		
		$background 	= !empty( $instance['background'] ) ? $instance['background'] : '#FFFFFF';
		$icon_color 	= !empty( $instance['icon_color'] ) ? $instance['icon_color'] : '#000000';

		$parent_background 			= !empty( $instance['parent_background'] ) ? $instance['parent_background'] : '#FFFFFF';
		$parent_background_hover 	= !empty( $instance['parent_background_hover'] ) ? $instance['parent_background_hover'] : '#3c3c3c';
		$parent_border 				= !empty( $instance['parent_border'] ) ? $instance['parent_border'] : '#f7f7f7';
		$parent_text_color 			= !empty( $instance['parent_text_color'] ) ? $instance['parent_text_color'] : '#858585';
		$parent_text_color_hover 	= !empty( $instance['parent_text_color_hover'] ) ? $instance['parent_text_color_hover'] : '#FFFFFF';

		$submenu_background 		= !empty( $instance['submenu_background'] ) ? $instance['submenu_background'] : '#232323';
		$submenu_background_hover 	= !empty( $instance['submenu_background_hover'] ) ? $instance['submenu_background_hover'] : '#3c3c3c';
		$submenu_border 			= !empty( $instance['submenu_border'] ) ? $instance['submenu_border'] : '#f7f7f7';
		$submenu_text_color 		= !empty( $instance['submenu_text_color'] ) ? $instance['submenu_text_color'] : '#FFFFFF';
		$submenu_text_color_hover 	= !empty( $instance['submenu_text_color_hover'] ) ? $instance['submenu_text_color_hover'] : '#FFFFFF';

		$subsubmenu_background 			= !empty( $instance['subsubmenu_background'] ) ? $instance['subsubmenu_background'] : '#232323';
		$subsubmenu_background_hover 	= !empty( $instance['subsubmenu_background_hover'] ) ? $instance['subsubmenu_background_hover'] : '#3c3c3c';
		$subsubmenu_border 				= !empty( $instance['subsubmenu_border'] ) ? $instance['subsubmenu_border'] : '#f7f7f7';
		$subsubmenu_text_color 			= !empty( $instance['subsubmenu_text_color'] ) ? $instance['subsubmenu_text_color'] : '#FFFFFF';
		$subsubmenu_text_color_hover	= !empty( $instance['subsubmenu_text_color_hover'] ) ? $instance['subsubmenu_text_color_hover'] : '#FFFFFF';
		
		ob_start();
		
		include AIOS_MOBILE_HEADER_DIRECTORY . "views/admin/form.php";
		
		$form = ob_get_contents();
		$form = apply_filters("aios_mobile_header_form_html", $form);
		
		ob_end_clean();

		echo $form;
	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		
		$instance['logo_url'] 		= ( ! empty( $new_instance['logo_url'] ) ) ? strip_tags( $new_instance['logo_url'] ) : '';
		$instance['logo_url_hide']  = isset( $new_instance['logo_url_hide'] ) ? (int) $new_instance['logo_url_hide'] : 0;

		$instance['email'] 			= ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
		$instance['email_hide'] 	= isset( $new_instance['email_hide'] ) ? (int) $new_instance['email_hide'] : 0;

		$instance['phone'] 			= ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
		$instance['phone_hide'] 	= isset( $new_instance['phone_hide'] ) ? (int) $new_instance['phone_hide'] : 0;
		$instance['theme'] 			= ( ! empty( $new_instance['theme'] ) )? strip_tags ( $new_instance['theme'] ) : '';
		
		$instance['menu_id'] 		= !empty( $new_instance['menu_id'] ) ? $new_instance['menu_id'] : '';
		$instance['behavior'] 		= ( ! empty( $new_instance['behavior'] ) ) ? strip_tags( $new_instance['behavior'] ) : 'bottom';
		$instance['breakpoint'] 	= ( ! empty( $new_instance['breakpoint'] ) ) ? strip_tags( $new_instance['breakpoint'] ) : '992';
		
		$instance['use_custom_color'] = ( ! empty( $new_instance['use_custom_color'] ) ) ? $new_instance['use_custom_color'] : 0;

		$instance['background'] 	= ( ! empty( $new_instance['background'] ) ) ? $new_instance['background'] : '#FFFFFF';
		$instance['icon_color'] 	= ( ! empty( $new_instance['icon_color'] ) ) ? $new_instance['icon_color'] : '#000000';

		$instance['parent_background'] 			= !empty( $new_instance['parent_background'] ) ? $new_instance['parent_background'] : '#FFFFFF';
		$instance['parent_background_hover'] 	= !empty( $new_instance['parent_background_hover'] ) ? $new_instance['parent_background_hover'] : '#3c3c3c';
		$instance['parent_border'] 				= !empty( $new_instance['parent_border'] ) ? $new_instance['parent_border'] : '#f7f7f7';
		$instance['parent_text_color'] 			= !empty( $new_instance['parent_text_color'] ) ? $new_instance['parent_text_color'] : '#858585';
		$instance['parent_text_color_hover'] 	= !empty( $new_instance['parent_text_color_hover'] ) ? $new_instance['parent_text_color_hover'] : '#FFFFFF';

		$instance['submenu_background'] 		= !empty( $new_instance['submenu_background'] ) ? $new_instance['submenu_background'] : '#232323';
		$instance['submenu_background_hover'] 	= !empty( $new_instance['submenu_background_hover'] ) ? $new_instance['submenu_background_hover'] : '#3c3c3c';
		$instance['submenu_border'] 			= !empty( $new_instance['submenu_border'] ) ? $new_instance['submenu_border'] : '#f7f7f7';
		$instance['submenu_text_color'] 		= !empty( $new_instance['submenu_text_color'] ) ? $new_instance['submenu_text_color'] : '#FFFFFF';
		$instance['submenu_text_color_hover'] 	= !empty( $new_instance['submenu_text_color_hover'] ) ? $new_instance['submenu_text_color_hover'] : '#FFFFFF';

		$instance['subsubmenu_background'] 			= !empty( $new_instance['subsubmenu_background'] ) ? $new_instance['subsubmenu_background'] : '#232323';
		$instance['subsubmenu_background_hover'] 	= !empty( $new_instance['subsubmenu_background_hover'] ) ? $new_instance['subsubmenu_background_hover'] : '#3c3c3c';
		$instance['subsubmenu_border'] 				= !empty( $new_instance['subsubmenu_border'] ) ? $new_instance['subsubmenu_border'] : '#f7f7f7';
		$instance['subsubmenu_text_color'] 			= !empty( $new_instance['subsubmenu_text_color'] ) ? $new_instance['subsubmenu_text_color'] : '#FFFFFF';
		$instance['subsubmenu_text_color_hover']	= !empty( $new_instance['subsubmenu_text_color_hover'] ) ? $new_instance['subsubmenu_text_color_hover'] : '#FFFFFF';
		
		return $instance;
		
	}

	/**
	 * Enqueue scripts.
	 *
	 * @since 1.0
	 *
	 * @param string $hook_suffix
	 */
	public function enqueue_scripts( $hook_suffix ) {
		if ( 'widgets.php' !== $hook_suffix ) return;

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
	}

	/**
	 * Print scripts.
	 *
	 * @since 1.0
	 */
	public function print_scripts() {
		?>
			<script>
				(function(){
					function initColorPicker( widget ) {
						widget.find( '.color-picker' ).wpColorPicker( {
							change: function (event, ui) {
								var element = event.target,
									color = ui.color.toString();

								$( element ).val( color );
								$( element ).trigger( 'change' );
							}
						});

						widget.find( '.aios-all-widgets-btn' ).on( 'click', function(e) {
							var useColor = jQuery( this ).parent().parent().find( '.use_custom_color' ),
								useColorDesc = jQuery( this ).parent().parent().find( '.use_custom_color_span' );
							if( useColor.is( ':checked' ) ) {
								jQuery( this ).toggleClass( 'aios-all-widgets-active' );
								jQuery( this ).parent().find( '.aios-all-widgets-color-container' ).slideToggle( 'fast' );
							} else {
								if ( useColorDesc.length == 0 ) useColor.parent().append( '<span class="use_custom_color_span" style="display: block; color: red;">Enable this to edit colors.</spa>' );
							}
						} );
					}

					function onFormUpdate( event, widget ) {
						initColorPicker( widget );
					}

					jQuery( document ).on( 'widget-added widget-updated', onFormUpdate );

					jQuery( document ).ready( function() {
						jQuery( '#widgets-right .widget:has(.color-picker)' ).each( function ( i, v ) {
							initColorPicker( jQuery( v ) );
						} );
					} );
				})();
			</script>
		<?php
	}
	
} 
