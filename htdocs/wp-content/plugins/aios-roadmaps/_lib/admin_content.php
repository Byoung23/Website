<?php

function buyer_seller_admin() {  
	global $wpdb;
	if(isset($_POST['roadmaps'])){
	?>
	<div id="setting-error-settings_updated" class="updated settings-error">
		<p>
			<strong>Settings saved.</strong>
		</p>
	</div>

	<?php
	
	}
	
	
	if(isset($_POST['roadmaps-create'])){
		global $user_ID;
		include('posts.php');
		update_option('Buyer_Resources',$buyer_serialized);
		update_option('Seller_Resources',$seller_serialized);
		update_option('Financing_Resources',$financing_serialized);

		
		?>
		<div id="setting-error-settings_updated" class="updated settings-error">
			<p>

				<strong>Pages Successfuly Created.</strong>
			</p>
		</div>


		<?php

	}
	
	if(isset($_POST['roadmaps-delete'])){
		$buyer_option=get_option('Buyer_Resources');
		$seller_option=get_option('Seller_Resources');
		$financing_option=get_option('Financing_Resources');
		
		$unserialze1=unserialize ($buyer_option);
		$unserialze2=unserialize ($seller_option);
		$unserialze3=unserialize ($financing_option);
		foreach($unserialze1 as $delete1){
			wp_delete_post($delete1,true);
		}
		foreach($unserialze2 as $delete2){
			wp_delete_post($delete2,true);
		}
		foreach($unserialze3 as $delete3){
			wp_delete_post($delete3,true);
		}
		?>
		<div id="setting-error-settings_updated" class="updated settings-error">
			<p>
				<strong>Pages Successfuly Deleted.</strong>
			</p>
		</div>
		<?php
	}
	
	//Get Color saves on the wp_option
	$buyer_color 			=	get_option('buyer_color', '#969393');
	$seller_color 			=	get_option('seller_color', '#969393');
	$financing_color 		=	get_option('financing_color','#969393');

	$hover1 				=	get_option('buyer_color_hover', '#000000' );
	$hover2 				=	get_option('seller_color_hover', '#000000' );
	$hover3 				=	get_option('financing_color_hover','#000000');

	$connect				=	get_option('Roadmap_UseTitle');
	$use_color				=	get_option('Roadmap_UseColor');

	$buyer_img_color 		= 	get_option( 'buyer_img_color','White' );
	$seller_img_color		=	get_option( 'seller_img_color', 'White' );
	$financing_img_color	=	get_option( 'financing_img_color', 'White' );

	$buyer_text_color		=	get_option( 'buyer_text_color', '#969393' );
	$seller_text_color		=	get_option( 'seller_text_color', '#969393' );
	$financing_text_color	=	get_option( 'financing_text_color', '#969393' );

	$buyer_style			=	get_option( 'buyer_style', 'Without Border' );
	$seller_style			=	get_option( 'seller_style', 'Without Border' );
	$financing_style		=	get_option( 'financing_style', 'Without Border' );

	$buyer_text_hover 		= get_option('buyer_text_hover', '#000000');
	$seller_text_hover 		= get_option('seller_text_hover', '#000000');
	$financing_text_hover 	= get_option('financing_text_hover', '#000000');

?>

<style type="text/css">
	.wp-picker-container{
		position: relative;
	}

</style>
<div id="wpui-container-minimalist">
	<div class="wpui-container">
	<h4>Roadmaps</h4>
	<!-- BEGIN: Tabs -->
		<div class="wpui-tabs">
			<!-- BEGIN: Header -->
			<div class="wpui-tabs-header">
				<ul>
					<li><a data-id="parent-tab-1">Settings</a></li>
				</ul>
			</div>
			<!-- END: Header -->
			<!-- BEGIN: Body -->
			<div class="wpui-tabs-body">
				<!-- Loader -->
				<div class="wpui-tabs-body-loader"><i class="ai-font-loading-b"></i></div>
				<!-- Contents -->
				<div data-id="parent-tab-1" class="wpui-tabs-content">
					<div class="wpui-tabs-title">Settings</div>
					<ul class="wpui-child-tabs">
						<li><a data-child-id="default-pages">Generate Pages</a></li>
						<li><a data-child-id="bulk-page">Color Options</a></li>
					</ul>
					<div data-child-id="default-pages" class="wpui-child-tabs-content">
						<div class="wpui-tabs-container">
							<form name="buyer_seller_form" method="POST" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
								<!-- BEGIN: Row Box -->
								<div class="wpui-row wpui-row-box">
									<div class="wpui-col-md-12">
										<input class="wpui-secondary-button" type="submit" name="roadmaps-create" value="<?php _e('Click Here to Create Pages')?>" id="submitbutton">
										<input class="wpui-default-button ml-md-2" type="submit" name="roadmaps-delete" value="<?php _e('Click Here to Delete Pages')?>" id="submitbutton">
									</div>
								</div>
								<!-- END: Row Box -->
							</form>							
						</div>
					</div>
					<div data-child-id="bulk-page" class="wpui-child-tabs-content">
						<div class="wpui-tabs-container">
<form name="buyer_seller_form" method="POST" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<!-- BEGIN: Row Box -->
	<div class="wpui-row wpui-row-box">
		<div class="wpui-col-md-3">
			<p class="mt-0"><span class="wpui-settings-title">Label Option</span></p>
		</div>
		<div class="wpui-col-md-9">
			<div class="form-group">
				<div class="form-checkbox-group">
					<div class="form-checkbox">
						<label>
							<input type="checkbox" id="rmlabel" name="rmlabel" value="checked" <?php echo ($connect) ? 'checked="checked" ' : '' ?>> Use page title as icon label
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
			<p class="mt-0"><span class="wpui-settings-title">Color Option</span></p>
		</div>
		<div class="wpui-col-md-9">
			<div class="form-group">
				<div class="form-checkbox-group">
					<div class="form-checkbox">
						<label>
							<input type="checkbox" id="rmlabel" name="rmcolor" value="checked" <?php echo ($use_color) ? 'checked="checked" ' : '' ?>> Use custom colors below
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
			<p><span class="wpui-settings-title">Buyer Widget Color</span></p>
		</div>
		<div class="wpui-col-md-9">
			<div class="form-group">
				<label for="buyer_img_color" class="float-left w-100">Theme</label>
				<select id="buyer_img_color" name="buyer_img_color">
					<option value="White" <?php echo ( $buyer_img_color == 'White' )?'selected':''; ?> >Dark</option>
					<option value="Black" <?php echo ( $buyer_img_color == 'Black' )?'selected':''; ?> >Light</option>
				</select>	
			</div>
			<div class="form-group">
				<label for="buyer_style" class="float-left w-100">Style</label>
				<select id="buyer_style" name="buyer_style">
					<option <?php echo ( $buyer_style == 'With Border' )?'selected':''; ?> >With Border</option>
					<option  <?php echo ( $buyer_style == 'Without Border' )?'selected':''; ?> >Without Border</option>
				</select>	
			</div>
			<div class="form-group">
				<label for="buyer_color1"> Border Color</label>
				<input type="text" id="buyer_color1" class="color1" name="buyer_color" value="<?php echo $buyer_color;?>" data-default-color="#969393">
			</div>
			<div class="form-group">
				<label for="buyer_color2"> Border Color Hover</label>
				<input type="text" id="buyer_color2" class="color2" name="buyer_color_hover" value="<?php echo $hover1;?>" data-default-color="#000000">
			</div>
			<div class="form-group">
				<label for="buyer_color3"> Text Color</label>
				<input type="text" id="buyer_color3" class="color3" name="buyer_text_color" value="<?php echo $buyer_text_color; ?>" data-default-color="#969393">
			</div>
			<div class="form-group">
				<label for="buyer_color4"> Text Color Hover</label>
				<input type="text" id="buyer_color4" class="color4" name="buyer_text_hover" value="<?php echo $buyer_text_hover; ?>" data-default-color="#000000">
			</div>
		</div>
	</div>
	<!-- END: Row Box -->

	<!-- BEGIN: Row Box -->
	<div class="wpui-row wpui-row-box">
		<div class="wpui-col-md-3">
			<p><span class="wpui-settings-title">Seller Widget Color</span></p>
		</div>
		<div class="wpui-col-md-9">
			<div class="form-group">
				<label for="seller_bg_theme" class="float-left w-100">Theme</label>
				<select id="seller_bg_theme" name="seller_img_color">
					<option value="White" <?php echo ( $seller_img_color == 'White' )?'selected':''; ?> >Dark</option>
					<option value="Black" <?php echo ( $seller_img_color == 'Black' )?'selected':''; ?> >Light</option>
				</select>	
			</div>
			<div class="form-group">
				<label for="seller_bg_style" class="float-left w-100"> Style </label>
				<select id="seller_bg_style" name="seller_style">
					<option <?php echo ( $seller_style == 'With Border' )?'selected':''; ?> >With Border</option>
					<option <?php echo ( $seller_style == 'Without Border' )?'selected':''; ?> >Without Border</option>
				</select>	
			</div>
			<div class="form-group">
				<label for="seller_color1"> Border Color</label>
				<input type="text" id="seller_color1" class="color5" name="seller_color" value="<?php echo $seller_color;?>" data-default-color="#969393">
			</div>
			<div class="form-group">
				<label for="seller_color2"> Border Color Hover</label>
				<input type="text" id="seller_color2" class="color6" name="seller_color_hover" value="<?php echo $hover2;?>" data-default-color="#000000">
			</div>
			<div class="form-group">
				<label for="seller_color3"> Text Color</label>
				<input type="text" id="seller_color3" class="color7" name="seller_text_color" value="<?php echo $seller_text_color; ?>" data-default-color="#969393">
			</div>
			<div class="form-group">
				<label for="seller_color3"> Text Color Hover</label>
				<input type="text" id="seller_color3" class="color8" name="seller_text_hover" value="<?php echo $seller_text_hover; ?>" data-default-color="#000000">
			</div>
		</div>
	</div>
	<!-- END: Row Box -->

	<!-- BEGIN: Row Box -->
	<div class="wpui-row wpui-row-box">
		<div class="wpui-col-md-3">
			<p><span class="wpui-settings-title">Financing Widget Color</span></p>
		</div>
		<div class="wpui-col-md-9">
			<div class="form-group">
				<label for="financing_bg_theme" class="float-left w-100">Theme</label>
				<select id="financing_bg_theme" name="financing_img_color">
					<option value="White" <?php echo ( $financing_img_color == 'White' )?'selected':''; ?> >Dark</option>
					<option value="Black" <?php echo ( $financing_img_color == 'Black' )?'selected':''; ?> >Light</option>
				</select>	
			</div>
			<div class="form-group">
				<label for="financing_bg_style" class="float-left w-100"> Style </label>
				<select id="financing_bg_style" name="financing_style">
					<option <?php echo ( $financing_style == 'With Border' )?'selected':''; ?> >With Border</option>
					<option  <?php echo ( $financing_style == 'Without Border' )?'selected':''; ?> >Without Border</option>
				</select>	
			</div>
			<div class="form-group">
				<label for="financing__color1">Border Color</label>
				<input type="text" id="financing__color1" class="color9" name="financing_color" value="<?php echo $financing_color;?>" data-default-color="#969393">
			</div>
			<div class="form-group">
				<label for="financing__color2">Border Color Hover</label>
				<input type="text" id="financing__color2" class="color10" name="financing_color_hover" value="<?php echo $hover3;?>" data-default-color="#000000">
			</div>
			<div class="form-group">
				<label for="financing__color3">Text Color</label>
				<input type="text" id="financing__color3" class="color11" name="financing_text_color" value="<?php echo $financing_text_color; ?>" data-default-color="#969393">
			</div>
			<div class="form-group">
				<label for="financing__color4">Text Color Hover</label>
				<input type="text" id="financing__color4" class="color12" name="financing_text_hover" value="<?php echo $financing_text_hover; ?>" data-default-color="#000000">
			</div>
		</div>
	</div>
	<!-- END: Row Box -->

	<!-- BEGIN: Row Box -->
	<div class="wpui-row wpui-row-submit">
		<div class="wpui-col-md-12">
			<input class="wpui-secondary-button text-uppercase" type="submit" name="roadmaps" value="<?php _e('Save Options')?>" id="submitbutton">
		</div>
	</div>
	<!-- END: Row Box -->
</form>	

						</div>
					</div>
				</div>
			</div>
			<!-- END: Body -->
		</div>
		<!-- END: Tabs -->
		
	</div>
</div>
 <?php
}

if(isset($_POST['roadmaps'])){
	//update Options
//color
	$post_buyer = $_POST['buyer_color'];
	$post_seller = $_POST['seller_color'];
	$post_financing = $_POST['financing_color'];

	//hover color
	$post_hover1=$_POST['buyer_color_hover'];
	$post_hover2=$_POST['seller_color_hover'];
	$post_hover3=$_POST['financing_color_hover'];
	
	$rmlabel = isset( $_POST['rmlabel'] ) ? $_POST['rmlabel'] : '';
	$rmcolor = isset( $_POST['rmcolor'] ) ? $_POST['rmcolor'] : '';
	
	update_option('Roadmap_UseTitle',strip_tags($rmlabel));
	update_option('Roadmap_UseColor',strip_tags($rmcolor));


	update_option('buyer_color', $post_buyer);
	update_option('seller_color', $post_seller);
	update_option('financing_color', $post_financing);

	update_option('buyer_color_hover', $post_hover1);
	update_option('seller_color_hover', $post_hover2);
	update_option('financing_color_hover', $post_hover3);
	
	update_option('buyer_img_color', $_POST['buyer_img_color']);
	update_option('seller_img_color', $_POST['seller_img_color']);
	update_option('financing_img_color', $_POST['financing_img_color']);

	update_option('buyer_text_color', $_POST['buyer_text_color']);
	update_option('seller_text_color', $_POST['seller_text_color']);
	update_option('financing_text_color', $_POST['financing_text_color']);

	update_option('buyer_style', $_POST['buyer_style']);
	update_option('seller_style', $_POST['seller_style']);
	update_option('financing_style', $_POST['financing_style']);
	
	update_option('buyer_text_hover', $_POST['buyer_text_hover']);
	update_option('seller_text_hover', $_POST['seller_text_hover']);
	update_option('financing_text_hover', $_POST['financing_text_hover']);
}

	
function buyer_seller_actions() {
	//Register to aios all in one
    add_submenu_page("aios-all-in-one", "Roadmaps", "Roadmaps", 'manage_options', "Buyers-Sellers-Resources", "buyer_seller_admin");  
}  
  
add_action('admin_menu', 'buyer_seller_actions');  

function roadmaps_admin_scripts(){
	wp_enqueue_style( 'wp-color-picker' );        
    wp_enqueue_script( 'wp-color-picker' ); 
	wp_enqueue_script('roadmaps-color', AIOS_ROADMAPS_URL . 'jscolor/roadmaps-admin.js' );
}

add_action( 'admin_enqueue_scripts', 'roadmaps_admin_scripts' );

function roadmaps_frontend_scripts(){
	wp_enqueue_style('roadmaps_style', AIOS_ROADMAPS_URL . 'css/style.css' );
	wp_enqueue_style('roadmaps_style_old', AIOS_ROADMAPS_URL . 'css/roadmap.css' );
}

add_action( 'wp_enqueue_scripts', 'roadmaps_frontend_scripts' );

function insertCSS() {	
	//Set colors
	
	$buyer_color=get_option( 'buyer_color', '#969393' );
	$seller_color=get_option('seller_color', '#969393' );
	$financing_color=get_option('financing_color', '#969393' );

	$hover1=get_option( 'buyer_color_hover', '#000000' );
	$hover2=get_option( 'seller_color_hover', '#000000' );
	$hover3=get_option( 'financing_color_hover', '#000000' );

	$buyer_text = get_option( 'buyer_text_color', '#969393' );
	$seller_text = get_option( 'seller_text_color', '#969393' );
	$financing_text = get_option( 'financing_text_color', '#969393' );

	$buyer_text_hover = get_option( 'buyer_text_hover', '#000000' );
	$seller_text_hover = get_option( 'seller_text_hover', '#000000' );
	$financing_text_hover = get_option( 'financing_text_hover', '#000000' );



	if ( get_option('Roadmap_UseColor') ){
		$custom_style = '<style>';
		if ( get_option( 'buyer_style', 'With Border' ) == 'With Border' ){
			$custom_style .= '
				.buyers-roadmap .aios-roadmap-link { border: 1px solid ' .$buyer_color. ' !important; color:'. $buyer_text .' !important; }
				.buyers-roadmap .aios-roadmap-link:hover { border: 1px solid ' .$hover1. ' !important; color:'. $buyer_text_hover .' !important; }
				.buyers-roadmap .active-link { border: 1px solid ' .$hover1. ' !important; color:'. $buyer_text_hover .' !important; }
				';
		}

		else {
			$custom_style .= '
				.buyers-roadmap .aios-roadmap-link { border: none !important; color:'. $buyer_text .' !important; }
				.buyers-roadmap .aios-roadmap-link:hover { border: none !important; color: '. $buyer_text_hover .' !important; }
				.buyers-roadmap .active-link { border: none !important;  color:'. $buyer_text_hover .' !important; }
				';
		}

		if ( get_option( 'seller_style', 'With Border' ) == 'With Border' ){
			$custom_style .= '
				.sellers-roadmap .aios-roadmap-link { border: 1px solid ' .$seller_color. ' !important; color:'. $seller_text .' !important; }
				.sellers-roadmap .aios-roadmap-link:hover { border: 1px solid ' .$hover2. ' !important; color:'. $seller_text_hover .' !important; }
				.sellers-roadmap .active-link { border: 1px solid ' .$hover2. ' !important; color:'. $seller_text_hover .' !important; }
				';
		}

		else {
			$custom_style .= '
				.sellers-roadmap .aios-roadmap-link { border: none !important; color:'. $seller_text .' !important; }
				.sellers-roadmap .aios-roadmap-link:hover { border: none !important; color: '. $seller_text_hover .' !important; }
				.sellers-roadmap .active-link { border: none !important;  color:'. $seller_text_hover .' !important; }
				';
		}

		if ( get_option( 'financing_style', 'With Border' ) == 'With Border' ){
			$custom_style .= '
				.financing-roadmap .aios-roadmap-linkb { order: 1px solid ' .$financing_color. ' !important; color:'. $financing_text .' !important; }
				.financing-roadmap .aios-roadmap-link:hover { border: 1px solid ' .$hover3. ' !important; color:'. $financing_text_hover .' !important; }
				.financing-roadmap .active-link { border: 1px solid ' .$hover3. ' !important; color:'. $financing_text_hover .' !important; }
				';
		}

		else {
			$custom_style .= '
				.financing-roadmap .aios-roadmap-link { border: none !important; color:'. $financing_text .' !important; }
				.financing-roadmap .aios-roadmap-link:hover { border: none !important; color: '. $financing_text_hover .' !important; }
				.financing-roadmap .active-link { border: none !important;  color:'. $financing_text_hover .' !important; }
				';
		}
		$custom_style .= '</style>';
		echo str_replace("", '', $custom_style);
		

	}
}
add_action('wp_print_styles', 'insertCSS');
