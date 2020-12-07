<?php 
	$metaautop 	 						= get_option( 'aios_auto_p_metabox' );
	$aios_initial_modules 				= get_option( 'aios_initial_setup_modules' );
	$aios_disable_email_notifications 	= get_option( 'aios_email_notification_metabox' );
?>
<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Disable Email Changing Notification</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<div class="form-checkbox-group">
				<div class="form-checkbox-group form-toggle-switch">
					<div class="form-checkbox">
						<label><input type="checkbox" value="1" name="aios_email_notification_metabox" <?php if ( $aios_disable_email_notifications == 1 ) echo 'checked="checked"'; ?>> Enable Email Notification</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p><span class="wpui-settings-title">Modules</span> Options with disabled off will automatically switch to on if required plugin is active</p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<div class="form-checkbox-group">
				<div class="form-checkbox-group form-toggle-switch">
					<?php
						// Run default config
						$asis_initial_config 		= new asis_initial_config();

						// Array of modules
						$asis_adv_modules_arr 		= [];
						$asis_adv_modules_default	= $asis_initial_config->aios_initial_setup_advanced_setting_module();

						$asis_adv_modules_count 	= 0;
						$asis_adv_modules_directory = AIOS_INITIAL_SETUP_DIR . 'modules';
						$asis_adv_modules 			= preg_grep('/^([^.])/', scandir( $asis_adv_modules_directory ));
									
						foreach ( $asis_adv_modules as $module ) {
							$module_name 	= ucwords( str_replace( '-', ' ', $module ) );
							$module_folder 	= $module;
							$asis_adv_modules_arr[$asis_adv_modules_count]['name'] = $module_name;
							$asis_adv_modules_arr[$asis_adv_modules_count]['path'] = $module_folder;
							$asis_adv_modules_count++;
						}

						foreach ( $asis_adv_modules_arr as $module_folder => $module ) {
                            /** Get comment lines from module.php files */
                            $module_name = $module['name'];
                            $module_description = '';
                            $handle = fopen( AIOS_INITIAL_SETUP_DIR . 'modules/' . $module['path'] . '/module.php', 'r' );
                            if ($handle) {
                                while (($line = fgets($handle)) !== false) {
                                    /** process the line read. */
                                    /** Get module Name */
                                    $name_line = strpos( $line, ' * Name:' );
                                    if ( $name_line !== false ) {
                                        preg_match("/\s\*\s[nN](?:ame\:)?\s*(.*)/", $line, $name_found);
                                        $module_name = $name_found[1];
                                    }

                                    /** Get module Description */
                                    $description_line = strpos( $line, ' * Description:' );
                                    if ( $description_line !== false ) {
                                        preg_match("/\s\*\s[dD](?:escription\:)?\s*(.*)/", $line, $description_found);
                                        $url = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
                                        $string = preg_replace( $url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $description_found[1] );
                                        $module_description = '<p style="font-weight: 300; font-size: 13px; color: #888; line-height: 22px; padding-left: 68px; margin-top: -3px; margin-bottom: 5px;"> - ' . $string . '</p>';
                                    }
                                }
                                fclose($handle); 
                            } else {
                                /** error opening the file. */
                            } 
                            
							$opening_tag 	= '<div class="form-checkbox"><label>';
							$closing_tag 	= '</label></div>';
							$option_modules = isset( $aios_initial_modules[ $module['path'] ] ) ? $aios_initial_modules[ $module['path'] ] : '';

							if ( isset( $asis_adv_modules_default[ $module['path'] ] ) ) {
								if ( $asis_adv_modules_default[ $module['path'] ]['require-plugin'] == 'yes' ) {
									echo $opening_tag . '<input type="checkbox" disabled>' . $module_name . $module_description . $closing_tag;
								}
							} else {
								$checked = '';
								if ( $option_modules == 'yes' || $option_modules == '1' ) $checked = 'checked="checked"';
								echo  $opening_tag . '<input type="checkbox" value="yes" name="aios_initial_setup_modules[' . $module['path'] . ']" ' . $checked . '>' . $module_name  . $module_description . $closing_tag;
                            }

						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: Row Box -->

<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p class="mt-0"><span class="wpui-settings-title">Wordpress Auto Paragraph</span> This will remove wp_autop for page and post</p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<div class="form-checkbox-group">
				<div class="form-checkbox-group form-toggle-switch">
					<div class="form-checkbox">
						<label><input type="checkbox" value="1" name="aios_auto_p_metabox" <?php if ( $metaautop == 1 ) echo 'checked="checked"'; ?>> Remove auto paragraph</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: Row Box -->


<div class="wpui-row wpui-row-submit">
	<div class="wpui-col-md-12">
		<div class="form-group">
			<input type="submit" class="save-option-ajax wpui-secondary-button text-uppercase" value="Save Changes">
		</div>
	</div>
</div>