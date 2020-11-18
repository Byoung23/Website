<h4>Google Tag Manager</h4>
<label for="aios-seotools[gtag-id]">Google Tag Manager ID:</label>
<input type="text" name="aios-seotools[gtag-id]" id="aios-seotools[gtag-id]" value="<?php echo !empty( $seo_option[ 'gtag-id' ] ) ? esc_attr( $seo_option[ 'gtag-id' ] ) : '' ?>" placeholder="GTM-XXXXXXX">
<p>Note: Add the following code on <em>`header.php`</em> after the opening <em>`body`</em> tag.<br>
	Code: &lt;?php if ( has_action( 'aios_seotools_gtm_body' ) ) { do_action('aios_seotools_gtm_body'); } ?></p>