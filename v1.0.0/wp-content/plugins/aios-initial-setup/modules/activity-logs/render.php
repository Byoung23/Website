<?php
/**
 * @since 3.0.8
 */
?>
<!-- BEGIN: Main Container -->
<div id="wpui-container-minimalist">
	<!-- BEGIN: Container -->
	<div class="wpui-container">
		<h4>Audit Logs</h4>
		<!-- BEGIN: Tabs -->
		<div class="wpui-tabs">
			<!-- BEGIN: Header -->
			<div class="wpui-tabs-header">
				<?php
					/** Get array of options **/
					$tabs = array(
						'' => array(
							'url' 		=> 'all-logs',
							'title' 	=> 'All Logs',
							'function' 	=> 'all-logs.php'
						),
						'plugins' => array(
							'url' 		=> 'plugin-logs',
							'title' 	=> 'Plugins',
							'function' 	=> 'plugin-logs.php'
						),
						'themes' => array(
							'url' 		=> 'themes-logs',
							'title' 	=> 'Themes',
							'function' 	=> 'theme-logs.php'
						),
						'post-type' => array(
							'url' 		=> 'post-type-logs',
							'title' 	=> 'Post Type',
							'function' 	=> 'post-type-logs.php'
						),
						'taxonomies' => array(
							'url' 		=> 'taxonomies-logs',
							'title' 	=> 'Taxonomies',
							'function' 	=> 'taxonomies-logs.php'
						),
						'attachment' => array(
							'url' 		=> 'attachment-logs',
							'title' 	=> 'attachments',
							'function' 	=> 'attachment-logs.php'
						),
						'menu' => array(
							'url' 		=> 'menu-logs',
							'title' 	=> 'Menus',
							'function' 	=> 'menu-logs.php'
						),
						'option' => array(
							'url' 		=> 'option-logs',
							'title' 	=> 'Options',
							'function' 	=> 'option-logs.php'
						),
						'user' => array(
							'url' 		=> 'user-logs',
							'title' 	=> 'User',
							'function' 	=> 'user-logs.php'
						),
					);

					/** Create main tabs **/
					echo '<ul>';
					foreach ( $tabs as $tab ) {
						echo '<li><a data-id="' . $tab['url'] . '">' . $tab['title'] . '</a></li>';
					}
					echo '</ul>';
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
						echo '<div data-id="' . $tab['url'] . '" class="wpui-tabs-content">';
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
									if ( !empty( $tab['function'] ) ) {
										echo '<div class="wpui-row wpui-row-box list-of-logs-heading">
											<div class="wpui-col-md-2">
												<p><strong>Time</strong></p>
											</div>
											<div class="wpui-col-md-1">
												<p><strong>Local IP</strong></p>
											</div>
											<div class="wpui-col-md-1">
												<p><strong>Network IP</strong></p>
											</div>
											<div class="wpui-col-md-2">
												<p><strong>Action</strong></p>
											</div>
											<div class="wpui-col-md-1">
												<p><strong>User</strong></p>
											</div>
											<div class="wpui-col-md-5">
												<p><strong>Activity</strong></p>
											</div>
										</div>';
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