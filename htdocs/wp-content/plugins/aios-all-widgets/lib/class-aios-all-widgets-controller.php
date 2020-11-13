<?php 

class AIOS_All_Widgets_Controller{
	
	function __construct() {

		//Initialize all widgets under the lib/tdp-shared-widgets directory
		$this->getWidgets();
		
		// Add menu for this plugin
		add_action( 'admin_menu', array( $this, 'admin_options_page' ) );

		// Save options menu
		add_action( 'admin_init', array( $this, 'admin_options_save' ) );

		//Enqueue admin assets
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ) );

		
	}
	
	function getWidgets(){
		
		foreach ( glob( AIOS_ALL_WIDGETS_DIR . 'modules' . DIRECTORY_SEPARATOR . '*' ) as $file ) {
			include $file.'/widget_main.php';
		}
		
	}

	function admin_options_page() {

		add_options_page(
			'AIOS All Widgets Options', //$page_title
			'AIOS All Widgets Options', //$menu_title
			'manage_options', //$capability https://codex.wordpress.org/Roles_and_Capabilities
			'aios-all-widgets-options', //$menu_slug
			array( $this, 'admin_options_html' ) //$function
		);

	}

	function admin_options_html() {
		?>
		<form method="post" action="options.php" class="aios-all-widgets-setting">

			<?php
				settings_fields( 'aios-all-widgets-setting' );
				do_settings_sections( 'aios-all-widgets-setting' );
				$aios_all_widgets = get_option( 'aios-all-widgets-setting-fields' );
			?>
			
			<h3>AIOS All Widgets Options</h3>
			<div class="aios-all-widgets-sections">
				<input type="checkbox" name="aios-all-widgets-setting-fields[enqueue-scripts]" id="aios-all-widgets-setting-fields[enqueue-scripts]" <?php echo !empty( $aios_all_widgets[ 'enqueue-scripts' ] ) ? 'checked="checked"' : ''; ?>>
				<label for="aios-all-widgets-setting-fields[enqueue-scripts]">Enqueue Slick Style and Slick(v1.6.0)</label>
			</div>

			<?php submit_button(); ?>

		</form>
		<?php
	}

	function admin_options_save() {

		register_setting( 'aios-all-widgets-setting', 'aios-all-widgets-setting-fields' );

	}

	function enqueue_frontend_assets() {

		$aios_all_widgets = get_option( 'aios-all-widgets-setting-fields' );
		if ( !empty( $aios_all_widgets[ 'enqueue-scripts' ] ) ) {
			wp_enqueue_style( 'aios-all-widgets-frontend-slick', AIOS_ALL_WIDGETS_URL . 'assets/slick/front-slick-style.css' );
			wp_enqueue_script( 'aios-all-widgets-frontend-slick-js', AIOS_ALL_WIDGETS_URL . 'assets/slick/front-slick-script.js' );
		}

	}
	
	function enqueue_admin_assets() {

		add_thickbox();
		wp_enqueue_style("agentimage-font", "https://cdn.thedesignpeople.net/agentimage-font/fonts/agentimage.font.icons.css");
		wp_enqueue_style("aios-all-widgets-admin-widgets", AIOS_ALL_WIDGETS_URL . 'assets/css/admin-widgets.css');
		wp_enqueue_script("aios-all-widgets-admin-widgets", AIOS_ALL_WIDGETS_URL . 'assets/js/admin-widgets.js', false, false, true );

	}
	
	
}
?>