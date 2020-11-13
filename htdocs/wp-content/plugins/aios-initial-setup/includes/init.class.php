<?php
/**
 * This will initialize the plugin
 *
 * @since 2.8.6
 */

if ( !class_exists( 'aios_initial_setup_init' ) ) {
	
	class aios_initial_setup_init extends asis_initial_config{

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function __construct() {
			$this->add_actions();
		}

		/**
		 * Add Actions.
		 *
		 * @since 1.0.0
		 *
		 * @access protected
		 */
		protected function add_actions() {
			add_action( 'admin_menu', array( $this,'render_sub_pages' ), 10 );
			add_action( 'admin_footer', array( $this, 'insert_shortcode' ), 101 );
		}
		/**
		 * Add sub menu page.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function render_sub_pages() {
			/** Initial Setup **/
			add_submenu_page( 
				'aios-all-in-one',
				'Initial Setup - AIOS All in One', 
				'Initial Setup', 
				'manage_options', 
				'init-setup', 
				array($this,'render_backend')
			);

            /** Site Info */
			add_menu_page( 
				'AIOS Site Info - AIOS Plugins', 
				'AIOS Site Info',
				'manage_options', 
				'aios-site-info', 
				array( $this, 'render_site_info' ),
				'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE2LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjMxLjkzOXB4IiBoZWlnaHQ9IjMxLjkzOXB4IiB2aWV3Qm94PSIwIDAgMzEuOTM5IDMxLjkzOSIgc3R5bGU9ImZpbGw6IzgyODc4YyINCgkgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+DQo8Zz4NCgk8Zz4NCgkJPHBhdGggZD0iTTE1LjU4LDE4LjMzMmgtMC43NzdjLTAuNDAzLDAtMC43My0wLjMyNi0wLjczLTAuNzI5YzAtMC4xNDksMC4wNi0wLjI5MywwLjE2Ny0wLjM5N2MwLjQ1Mi0wLjQzOSwwLjgzMi0xLjAzLDEuMTA3LTEuNjY3DQoJCQljMC4wNTYsMC4wNDEsMC4xMTYsMC4wNzEsMC4xODQsMC4wNzFjMC40MzYsMCwwLjk1LTAuOTY0LDAuOTUtMS42MjFjMC0wLjY1Ny0wLjA2MS0xLjE5LTAuNDk4LTEuMTkNCgkJCWMtMC4wNTIsMC0wLjEwNiwwLjAwOS0wLjE2MiwwLjAyM2MtMC4wMzEtMS43ODItMC40ODEtNC4wMDUtMy4yMDItNC4wMDVjLTIuODM5LDAtMy4xNywyLjIxOS0zLjIwMiwzLjk5OQ0KCQkJYy0wLjA0LTAuMDA4LTAuMDgtMC4wMTctMC4xMTctMC4wMTdjLTAuNDM3LDAtMC40OTcsMC41MzMtMC40OTcsMS4xOWMwLDAuNjU3LDAuNTEyLDEuNjIxLDAuOTQ5LDEuNjIxDQoJCQljMC4wNTQsMCwwLjEwNC0wLjAxNSwwLjE1MS0wLjA0MmMwLjI3NCwwLjYyNywwLjY0OSwxLjIwNiwxLjA5NCwxLjY0MWMwLjEwNywwLjEwNCwwLjE2NywwLjI0NiwwLjE2NywwLjM5Ng0KCQkJYzAsMC40MDMtMC4zMjcsMC43My0wLjczLDAuNzNIOS42NTZjLTEuNjYyLDAtMy4wMDksMS4zNDctMy4wMDksMy4wMDl2MC44MzRjMCwwLjUyNCwwLjQyNSwwLjk1LDAuOTUsMC45NWgxMC4wNDINCgkJCWMwLjUyNCwwLDAuOTQ5LTAuNDI2LDAuOTQ5LTAuOTV2LTAuODM0QzE4LjU4OSwxOS42OCwxNy4yNDIsMTguMzMyLDE1LjU4LDE4LjMzMnoiLz4NCgkJPHBhdGggZD0iTTI0LjU4OSwxMC4wNzdoLTguNDIxYzAuMjQzLDAuNTM4LDAuNDE3LDEuMiwwLjQ4OSwyLjAxOWMwLjE4LDAuMTExLDAuMzE1LDAuMjksMC40MjUsMC41MDZoNy41MDcNCgkJCWMwLjM5LDAsMC43MDQtMC4zMTUsMC43MDQtMC43MDR2LTEuMTE3QzI1LjI5MywxMC4zOTMsMjQuOTc5LDEwLjA3NywyNC41ODksMTAuMDc3eiIvPg0KCQk8cGF0aCBkPSJNMjQuNTg5LDE0LjY3OGgtNy4zMzVjLTAuMTk5LDAuNzUyLTAuNjg5LDEuNTM5LTEuMzY4LDEuNzQ5Yy0wLjAyLDAuMDM3LTAuMDQzLDAuMDY5LTAuMDY0LDAuMTA2djAuNjdoOC43NjYNCgkJCWMwLjM4OSwwLDAuNzA0LTAuMzE1LDAuNzA0LTAuNzA1di0xLjExNkMyNS4yOTMsMTQuOTkzLDI0Ljk3OSwxNC42NzgsMjQuNTg5LDE0LjY3OHoiLz4NCgkJPHBhdGggZD0iTTI0LjU4OSwxOS4yNzloLTUuNzI2YzAuMzc4LDAuNTk4LDAuNiwxLjMwMywwLjYsMi4wNjJ2MC40NjNoNS4xMjZjMC4zOSwwLDAuNzA0LTAuMzE1LDAuNzA0LTAuNzA0di0xLjExNw0KCQkJQzI1LjI5MywxOS41OTQsMjQuOTc5LDE5LjI3OSwyNC41ODksMTkuMjc5eiIvPg0KCQk8cGF0aCBkPSJNMjcuNjE1LDMuMDU3SDQuMzI1QzEuOTM2LDMuMDU3LDAsNC45OTMsMCw3LjM4MnYxNy4xNzZjMCwyLjM5LDEuOTM2LDQuMzI1LDQuMzI1LDQuMzI1aDIzLjI5DQoJCQljMi4zODksMCw0LjMyNC0xLjkzNiw0LjMyNC00LjMyNVY3LjM4MkMzMS45MzksNC45OTMsMzAuMDA0LDMuMDU3LDI3LjYxNSwzLjA1N3ogTTI5Ljg5OCwyNC41NThjMCwxLjI1OS0xLjAyNCwyLjI4My0yLjI4MywyLjI4Mw0KCQkJSDQuMzI1Yy0xLjI1OSwwLTIuMjgzLTEuMDI0LTIuMjgzLTIuMjgzVjcuMzgyYzAtMS4yNTksMS4wMjQtMi4yODMsMi4yODMtMi4yODNoMjMuMjljMS4yNTksMCwyLjI4MywxLjAyNCwyLjI4MywyLjI4M1YyNC41NTh6Ig0KCQkJLz4NCgk8L2c+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8L3N2Zz4NCg==',
				92
            );
		}
			public function render_backend() {
				require( 'render.php' );
			}
			public function render_site_info() {
				require( 'render-site-info.php' );
			}

		/**
		 * Insert list of shortcode in widgets.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function insert_shortcode() {
			$admin_page_id = get_current_screen()->id;
			$admin_page_contains = 'widgets';
			if ( strpos($admin_page_id, $admin_page_contains) !== false ) {
				echo '<div id="aios-shortcode-popup">
						<div class="_overlay"></div>
						<div class="aios-shortcode-popup-container">
							<div id="wpui-container">
								<div class="wpui-container">
									<h4>AIOS Shortcode <div class="_close"><em class="ai-font-x-sign""></em></div></h4>';
									require_once('functions/shortcodes/shortcodes.php');
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		}

	}
}

$aios_initial_setup_init = new aios_initial_setup_init();

?>