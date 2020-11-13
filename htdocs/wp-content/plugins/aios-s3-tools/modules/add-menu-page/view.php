<div class="wrap">
	<h1 class="wp-heading-inline">AIOS S3 Tools</h1>
	<?php echo !empty($user_access_name) ? '<div class="s3-subtitle"><strong>Access Level:</strong> '.$user_access_name.'</div>' : "" ?>
	<div class="aios-s3-wrap">

		<div class="aios-s3-notice">
			<strong>Note: </strong><br>
			<ul>
				<li>Backup existing plugin, themes and database first before proceeding with the updates. (You can use <a target="_blank" href="https://wordpress.org/plugins/updraftplus/" target="_blank">WP Updraft</a> a fastest way to backup Database and Theme Files)</li>
				<li>You can update multiple plugins at the same time.</li>
				<li>Plugin activation can only accomodate one plugin at a time.</li>
				<li>Themes: Donwload the required themes only. do not download Themes that is not part of the setup</li>
				<li>Child Themes requires it's parent to be installed first before you can download them.</li>
			</ul>
		</div>
		<div class="aios-s3-notice">
			<div class="aios-s3-legends">
				<div class="aios-legend-entry" data-legend="active">
					<span class="ale-mark"></span>
					<span>Active Plugin</span>
				</div>
				<div class="aios-legend-entry" data-legend="inactive">
					<span class="ale-mark"></span>
					<span>Inactive Plugin</span>
				</div>
				<div class="aios-legend-entry" data-legend="not-installed">
					<span class="ale-mark"></span>
					<span>Not Installed</span>
				</div>
				<div class="aios-legend-entry" data-legend="custom">
					<span class="ale-mark"></span>
					<span>Customized Plugin</span>
				</div>
			</div>
		</div>
		
		<div class="tab-main-holder">
			<div class="tab-button-wrap">
				<a href="#" class="tab-button active" data-link="tab-plugins" <?php echo !in_array("plugins", $user_folders) ? 'style="display:none"' : "" ?> >
					<span class="dashicons dashicons-admin-plugins"></span>
					<span>Plugins</span>
				</a>
				<a href="#" class="tab-button" data-link="tab-themes" <?php echo !in_array("themes", $user_folders) ? 'style="display:none"' : "" ?>>
					<span class="dashicons dashicons-admin-appearance"></span>
					<span>Themes</span>
				</a>
			</div>
			<div class="tab-content-wrap">
				<?php if ( in_array("plugins", $user_folders) ) { ?>
					<div class="tab-content tab-plugins active">
						<!-- START -->
						<table class="wp-list-table widefat plugins">
							<thead>
								<tr>
									<th scope="col" class="manage-column column-name column-primary">Plugin</th>
									<th scope="col" class="manage-column column-description">Description</th>
									<th scope="col" class="manage-column column-name">Actions</th>
								</tr>
							</thead>
							<tbody id="the-list">

								<?php 

									/**
									 * List all non-existing and existing plugins under s3
									 * @param array $plugins_list - this will get all the themes registered in wordpress
									 * @param array $all_plugins[ $file ] - list of plugins in s3
									 */

									if ( count($plugins_list) > 0 ) {
										foreach ( $plugins_list as $file => $plugin_data ) {

											$active_status = is_plugin_active( $file );
											$customized_status = strpos( strtolower($all_plugins[ $file ][ 'Name' ]), 'customized');

											if ( !empty( $all_plugins[ $file ] ) ) {
												
												/*
												 * Plugin is installed
												 */

												$outp =  '
													<tr class="'. ( !$active_status ? "aios-inactive" : 'aios-active' ). ' ' . ( $customized_status == false ? '' : 'aios-customized' ) . '">
													   <td class="plugins-title column-primary">
														  <strong>'.$all_plugins[ $file ][ 'Name' ].'</strong>
														  <div class="active second plugin-version-author-uri">Version '.$all_plugins[ $file ][ 'Version' ].'</div>
													   </td>
													   <td class="column-description desc">
														  <div class="plugin-description">
															 <p>'.$all_plugins[ $file ][ 'Description' ].'</p>
														  </div>
														 
													   </td>
													   <td>
														<div class="aios-s3-entry-actions">
														';	

															if ( version_compare( $all_plugins[ $file ][ 'Version' ], $plugin_data[ 'Version' ] ) < 0 ) { // Compare plugin version
																
																// Check if plugin has customized description
																if ( $customized_status == false ) {

																	// If plugin is outdated show update button
																	$outp.= '<button class="button button-primary button-large" is-button="update" bucket="' . $plugin_data[ 'Bucket' ] . '" parentfile="' . $plugin_data[ 'Slug' ] . '/' . $plugin_data[ 'File' ] . '" version="'.$plugin_data[ 'Version' ].'">
																			<span class="dashicons dashicons-update"></span> <span>Update to v'.$plugin_data[ 'Version' ].'</span>
																		</button>';
																	
																}else {
																	$outp.= "No actions available.";
																}


																

															} else { 

																// Check if plugin is active or not.  If active show disabled button else show activate button
																if ( $plugin_data[ 'File' ] == "seo-tools-main.php" && $access_level != "admin") {
																	$outp.= ( !$active_status ? '<button class="button button-primary button-large" is-button="not-activate" parentfile="' . $plugin_data[ 'Slug' ] . '/' . $plugin_data[ 'File' ] . '"><span class="dashicons dashicons-migrate"></span> <span>Activate</span></button>' : '' );
																} else {
																	$outp.= ( !$active_status ? '<button class="button button-primary button-large" is-button="not-activate" parentfile="' . $plugin_data[ 'Slug' ] . '/' . $plugin_data[ 'File' ] . '"><span class="dashicons dashicons-migrate"></span> <span>Activate</span></button>' : '<button class="button button-primary button-large" is-button="deactivate" parentfile="' . $plugin_data[ 'Slug' ] . '/' . $plugin_data[ 'File' ] . '"><span class="dashicons dashicons-minus"></span> <span>Deactivate</span></button>');
																}

															}

			
												$outp.= '
														</div>
													   </td>
													</tr>
												';

												echo $outp;

											} else {

												/*
												 * If plugin is not yet installed/not-existing, download button will show up
												 */

												$outp =  '
													<tr class="'. ( !$active_status ? "aios-inactive" : 'aios-active' ).' not-installed">
														<td class="plugins-title column-primary">
															<strong>'.$plugin_data['Name'].'</strong>
															<div class="active second plugin-version-author-uri">Version '.$plugin_data[ 'Version' ].'</div>
														</td>
														<td class="column-description desc">
															<div class="plugin-description">
																<p></p>
														  	</div>
														</td>
														<td>
															<div class="aios-s3-entry-actions">';	
															$outp .= '<button class="button button-primary button-large" is-button="download" bucket="' . $plugin_data[ 'Bucket' ] . '" parentfile="' . $plugin_data[ 'Slug' ] . '/' . $plugin_data[ 'File' ] . '">
																		<span class="dashicons dashicons-download"></span> <span>Download</span>
																	</button>';
															$outp.= '</div>
													   </td>
													</tr>
												';

												echo $outp;
											
											}

										}
									}else {
										echo "<tr>
												<td>No Plugin stored in S3</td>
												<td></td>
												<td></td>
											</tr>";
									}

								?>

							</tbody>
							<tfoot>
								<tr>
									<th scope="col" class="manage-column column-name column-primary">Plugin</th>
									<th scope="col" class="manage-column column-description">Description</th>
									<th scope="col" class="manage-column column-name">Actions</th>
								</tr>
							</tfoot>
						</table>
						<!-- END -->
					</div>
				<?php 
				}

				if ( in_array("themes", $user_folders) ) {
				?>
					<div class="tab-content tab-themes">
						<!-- START -->
						<table class="wp-list-table widefat plugins themes">
							<thead>
								<tr>
									<th scope="col" class="manage-column column-name column-primary">Themes</th>
									<th scope="col" class="manage-column column-description">&nbsp;</th>
									<th scope="col" class="manage-column column-name">Actions</th>
								</tr>
							</thead>
							<tbody id="the-list">
								
							  <?php 

							  	/**
							  	 * List all non-existing and existing theme under s3
							  	 * Check themes if AIOS Starter Theme is existing
							  	 * @param string $all_themes - this will get all the themes registered in wordpress
							  	 * @param array $themes_list - list of theme in s3
							  	 *
							  	 */


							  	if ( count($themes_list) > 0 ) {

							  		$themes_list = admin_add_page::sortArrayByArray($themes_list, $all_themes);

							  		foreach ( $themes_list as $file => $theme_data ) {

							  			$outp = '
							  				<tr>
							  				   <td class="theme-title column-primary">
							  					  <strong>'.$theme_data[ 'Name' ].'</strong>
							  					  <div class="active second theme-version-author-uri">Version '. ( !empty( $all_themes[ $theme_data[ 'Slug' ] ][ 'Version' ] ) ? $all_themes[ $theme_data[ 'Slug' ] ][ 'Version' ] : $theme_data[ 'Version' ] ) .'</div>
							  				   </td>
							  				   <td class="column-description desc">
							  					  <div class="plugin-description">
							  						 <p>'.( !empty( $theme_data[ 'Parent' ] ) ? 'Requires <strong>'. admin_add_page::get_theme_name($theme_data[ 'Parent' ], $themes_list) .'</strong> '. ( !empty( $all_themes[ $theme_data[ 'Parent' ] ] ) ? '<span style="color:green">(Installed)<span>' : '<span style="color:red">(Not Installed)<span>')  : '').'</p>
							  					  </div>
							  					 
							  				   </td>
							  				   <td>
							  					<div class="aios-s3-entry-actions">
							  					';	

				  						  			if ( !empty( $all_themes[ $theme_data[ 'Slug' ] ] ) ) { 
				  						  				
				  						  				if ( version_compare( $all_themes[ $theme_data[ 'Slug' ] ][ 'Version' ], $theme_data[ 'Version' ] ) ) { // Compare theme version
				  							  				$outp.= '<span style="color:green">Installed (Outdated) - '.$theme_data[ 'Version' ].'<span>';
				  							  			}else {
				  							  				$outp.= '<span style="color:green">Latest Version!<span>';
				  							  			}

				  						  			} else {


				  						  				if( empty( $theme_data[ 'Parent' ] ) ) {

				  						  					$outp .= '<button class="button button-primary button-large" is-button="download" bucket="' . $theme_data[ 'Bucket' ] . '" parentfile="' . $theme_data[ 'Slug' ] . '/' . $theme_data[ 'File' ] . '">
				  						  								<span class="dashicons dashicons-download"></span> <span>Download</span>
				  						  							</button>';
				  						  				
				  						  				}else {

				  						  					if( !empty( $all_themes[ $theme_data[ 'Parent' ] ] ) ) {
				  						  						$outp .= '<button class="button button-primary button-large" is-button="download" bucket="' . $theme_data[ 'Bucket' ] . '" parentfile="' . $theme_data[ 'Slug' ] . '/' . $theme_data[ 'File' ] . '">
				  						  									<span class="dashicons dashicons-download"></span> <span>Download</span>
				  						  								</button>';
				  						  					}
				  						  					
				  						  				}

				  						  				
				  						  			}

							  			
							  			$outp.= '
							  					</div>
							  				   </td>
							  				</tr>
							  			';

							  			echo $outp;

							  		}
							  	}else {
							  		echo "<tr>
							  				<td>No Theme stored in S3</td>
							  				<td></td>
							  				<td></td>
							  			</tr>";
							  	}

							  ?>

							</tbody>
							<tfoot>
								<tr>
									<th scope="col" class="manage-column column-name column-primary">Themes</th>
									<th scope="col" class="manage-column column-description">&nbsp;</th>
									<th scope="col" class="manage-column column-name">Actions</th>
								</tr>
						   </tfoot>
						</table>
						<!-- END -->
					</div>
				<?php } ?>
			</div>
		</div>

	</div>
</div>