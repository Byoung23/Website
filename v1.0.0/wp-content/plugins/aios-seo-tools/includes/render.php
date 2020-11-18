<?php
/**
 * Displays page and sub-pages and contents
 *
 * @since 3.0.0
 */
?>
<!-- BEGIN: Main Container -->
<div id="wpui-container-minimalist">
	<!-- BEGIN: Container -->
	<div class="wpui-container">
		<h4>SEO Settings</h4>
		<!-- BEGIN: Tabs -->
		<div class="wpui-tabs">
			<!-- BEGIN: Header -->
			<div class="wpui-tabs-header">
				<?php
					/** Get array of options **/
					$tabs = $this->asis_options();

					/** List of Options **/
					$aios_seo_tools_options 	= new aios_seo_tools_options();
					$aios_seo_tools_settings 	= $aios_seo_tools_options->options();
					extract( $aios_seo_tools_settings );

					/** Create main tabs **/
					echo '<ul>'; foreach ( $tabs as $tab ) echo '<li><a data-id="' . $tab['url'] . '">' . $tab['title'] . '</a></li>'; echo '</ul>';
				?>
			</div>
			<!-- END: Header -->
			<!-- BEGIN: Body -->
			<div class="wpui-tabs-body">
				<!-- Loader -->
				<div class="wpui-tabs-body-loader"><i class="ai-font-loading-b"></i></div>
				<!-- Contents -->
				<?php
					foreach ( $tabs as $tab ) {
						echo '<div data-id="' . $tab['url'] . '" class="wpui-tabs-content">';;
							/** Title **/ 
							echo '<div class="wpui-tabs-title">' . $tab['title'] . '</div>';
							/** Check if child is an array to create a child sub pages else only main page will be created. **/
							if ( isset( $tab['child'] ) ) {
								/** Display Child Tab **/
								echo '<ul class="wpui-child-tabs">';
								foreach ( $tab['child'] as $tabChild) {
										echo '<li><a data-child-id="' . $tabChild['url'] . '">' . $tabChild['title'] . '</a></li>';
								}
								echo '</ul>';

								/** Display Child Content **/
								foreach ( $tab['child'] as $tabChild) {
									echo '<div data-child-id="' . $tabChild['url'] . '" class="wpui-child-tabs-content">';
										echo '<div class="wpui-tabs-container">';
											/** Check if function is not empty to display forms **/
											if ( !empty( $tabChild['function'] ) ) {
												require_once( 'functions/' . $tabChild['function'] );
											} else {
												echo '<p>Error: Array[function] is empty.</p>';
											}
										echo '</div>';
									echo '</div>';
								}
							} else {
								echo '<div class="wpui-tabs-container">';
									/** Check if function is not empty to display forms **/
									if ( !empty( $tab['function'] ) ) {
										require_once( 'functions/' . $tab['function'] );
									} else {
										echo '<p>Error: Array[function] is empty.</p>';
									}
								echo '</div>';
							}
						echo '</div>';
					}
				?>
			</div>
			<!-- END: Body -->
		</div>
		<!-- END: Tabs -->
	</div>
	<!-- END: Container -->
</div>
<!-- END: Main Container -->