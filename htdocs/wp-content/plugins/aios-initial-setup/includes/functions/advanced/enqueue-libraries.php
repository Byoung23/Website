<?php 
	$enqueue_cdn 					= get_option( 'aios-enqueue-cdn' );
	$use_local_libraries 			= isset( $enqueue_cdn['use_local_libraries'] ) ?			$enqueue_cdn['use_local_libraries'] : '';
	$bootstrap_no_components_css	= isset( $enqueue_cdn['bootstrap_no_components_css'] ) ? 	$enqueue_cdn['bootstrap_no_components_css'] : '';
	$utilities 						= isset( $enqueue_cdn['utilities'] ) ? 						$enqueue_cdn['utilities'] : '';
	$animate 						= isset( $enqueue_cdn['animate'] ) ? 						$enqueue_cdn['animate'] : '';
	$autosize 						= isset( $enqueue_cdn['autosize'] ) ? 						$enqueue_cdn['autosize'] : '';
	$chainHeight 					= isset( $enqueue_cdn['chainHight'] ) ? 					$enqueue_cdn['chainHight'] : '';
	$elementpeek 					= isset( $enqueue_cdn['elementpeek'] ) ? 					$enqueue_cdn['elementpeek'] : '';
	$splitNav 						= isset( $enqueue_cdn['splitNav'] ) ? 						$enqueue_cdn['splitNav'] : '';
	$slick 							= isset( $enqueue_cdn['slick'] ) ? 							$enqueue_cdn['slick'] : '';
	$simplebar 						= isset( $enqueue_cdn['simplebar'] ) ? 						$enqueue_cdn['simplebar'] : '';
	$sidebar_navigation 			= isset( $enqueue_cdn['sidebar_navigation'] ) ?				$enqueue_cdn['sidebar_navigation'] : '';
	$videoPlyr 						= isset( $enqueue_cdn['videoPlyr'] ) ? 						$enqueue_cdn['videoPlyr'] : '';
	$aios_minified_resources 		= isset( $enqueue_cdn['aios_minified_resources'] ) ?		$enqueue_cdn['aios_minified_resources'] : '';
	$expiration 					= isset( $enqueue_cdn['expiration'] ) ?						$enqueue_cdn['expiration'] : '';
?>
<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p class="mt-2"><span class="wpui-settings-title">Local Libraries</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group mt-1">
			<div class="form-checkbox-group">
				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-enqueue-cdn[use_local_libraries]" value="1" <?= $use_local_libraries == 1 ? 'checked=checked' : '' ?>> 
						Use Local Libraries
					</label>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: Row Box -->
<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p class="mt-0"><span class="wpui-settings-title">Enqueue Libraries</span> Libraries will be enqueue on Front End</p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<div class="form-checkbox-group">

				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-enqueue-cdn[bootstrap_no_components_css]" id="bootstrap_no_components_css" value="1" <?= $bootstrap_no_components_css == 1 ? 'checked=checked' : '' ?>> 
						<strong>CSS Bootstrap without Components</strong>
						<span class="form-group-description"><em>(handler: </em>aios-starter-theme-bootstrap<em>)</em> - This will have only common css such as Grid system Tables, Forms, Buttons, Responsive utilities</span>
					</label>
				</div>
				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-enqueue-cdn[utilities]" id="utilities" value="1" <?= $utilities == 1 ? 'checked=checked' : '' ?>> 
						Utilities 
						<span class="form-group-description"><strong>CSS</strong> <em>(handler: </em>aios-utilities-style<em>)</em> - <a href="https://im-demo.agentimage.com/aios-utilities/" target="_blank">Demo</a></span>
					</label>
				</div>
				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-enqueue-cdn[animate]" id="animate" value="1" <?= $animate == 1 ? 'checked=checked' : '' ?>> 
						Animate
						<span class="form-group-description"><strong>CSS</strong> <em>(handler: </em>aios-animate-style<em>)</em> - <a href="https://daneden.github.io/animate.css/" target="_blank">Demo</a></span>
					</label>
				</div>
				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-enqueue-cdn[autosize]" id="autosize" value="1" <?= $autosize == 1 ? 'checked=checked' : '' ?>> 
						Autosize 
						<span class="form-group-description"><strong>JavaScript</strong> <em>(handler: </em>aios-autosize-script<em>)</em></span>
					</label>
				</div>
				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-enqueue-cdn[chainHight]" id="chainHight" value="1" <?= $chainHeight == 1 ? 'checked=checked' : '' ?>> 
						Chain Height 
						<span class="form-group-description"><strong>JavaScript</strong> <em>(handler: </em>aios-chain-height-script<em>)</em></span>
					</label>
				</div>
				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-enqueue-cdn[elementpeek]" id="elementpeek" value="1" <?= $elementpeek == 1 ? 'checked=checked' : '' ?> data-require="animate"> 
						ElementPeek 
						<span class="form-group-description"><strong>JavaScript</strong> <em>(handler: </em>aios-elementpeek-script<em>)</em> - <a href="https://im-demo.agentimage.com/element-peek/" target="_blank">Demo</a></span>
					</label>
				</div>
				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-enqueue-cdn[splitNav]" id="splitNav" value="1" <?= $splitNav == 1 ? 'checked=checked' : '' ?>> 
						Split Nav
						<span class="form-group-description"><strong>JavaScript</strong> <em>(handler: </em>aios-splitNav-script<em>)</em></span>
					</label>
				</div>
				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-enqueue-cdn[slick]" id="slick" value="1" <?= $slick == 1 ? 'checked=checked' : '' ?>> 
						Slick v1.9.0 
						<span class="form-group-description"><strong>CSS & JavaScript</strong> <em>(handler: </em>aios-slick-style AND aios-slick-script<em>)</em> - <a href="http://kenwheeler.github.io/slick/" target="_blank">Demo</a></span>
					</label>
				</div>
				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-enqueue-cdn[simplebar]" id="simplebar" value="1" <?= $simplebar == 1 ? 'checked=checked' : '' ?>> 
						Simplebar v2.6.1 
						<span class="form-group-description"><strong>CSS & JavaScript</strong> <em>(handler: </em>aios-simplebar-style AND aios-simplebar-script<em>)</em> - <a href="https://grsmto.github.io/simplebar/" target="_blank">Demo</a></span>
					</label>
				</div>
				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-enqueue-cdn[videoPlyr]" id="videoPlyr" value="1" <?= $videoPlyr == 1 ? 'checked=checked' : '' ?>> 
						Video Player 
						<span class="form-group-description"><strong>JavaScript</strong> <em>(handler: </em>aios-videoPlyr-script<em>)</em></span>
					</label>
				</div>
				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-enqueue-cdn[sidebar_navigation]" id="sidebar_navigation" value="1" <?= $sidebar_navigation == 1 ? 'checked=checked' : '' ?>> 
						Sidebar Navigation v1.0.1 
						<span class="form-group-description"><strong>JavaScript</strong> <em>(handler: </em>aios-sidebar-navigation-script<em>)</em></span>
					</label>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: Row Box -->
<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-box">
	<div class="wpui-col-md-3">
		<p class="mt-2"><span class="wpui-settings-title">Minified Resources</span></p>
	</div>
	<div class="wpui-col-md-9">
		<div class="form-group">
			<div class="form-checkbox-group">
				<div class="form-checkbox">
					<label>
						<input type="checkbox" name="aios-enqueue-cdn[aios_minified_resources]" value="1" <?= $aios_minified_resources == 1 ? 'checked=checked' : '' ?>> 
						Enable Resources Minifier
					</label>
				</div>
			</div>
		</div>
		<?php
			echo AIOS_CREATE_FIELDS::select( [
				'row'               => false,
				'name'              => 'aios-enqueue-cdn[expiration]',
				'label'             => true,
				'label_value'       => 'Expiration',
				'options' 			=> [
										'999' => 'No Expiration',
										'WEEK_IN_SECONDS' => '1 week',
										'2 * WEEK_IN_SECONDS' => '2 weeks',
										'3 * WEEK_IN_SECONDS' => '3 weeks',
										'MONTH_IN_SECONDS' => '1 months'
									],
				'value' 			=> $expiration
			] );
		?>
		<input id="refresh-minified-resources" type="submit" class="wpui-default-button text-uppercase wpui-min-width-initial mt-3" value="Refresh Minified Resources">
	</div>
</div>
<!-- END: Row Box -->
<!-- BEGIN: Row Box -->
<div class="wpui-row wpui-row-submit">
	<div class="wpui-col-md-12">
		<div class="form-group">
			<input type="submit" class="save-option-ajax wpui-secondary-button text-uppercase" value="Save Changes">
		</div>
	</div>
</div>
<!-- END: Row Box -->