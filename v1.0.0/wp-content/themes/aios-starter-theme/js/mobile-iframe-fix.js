jQuery(document).ready( function() {
	
	function MobileIframeFix() {
		
		( function() {
			
			makeIframesScrollableOnIOS();
			
		})();
		
		function makeIframesScrollableOnIOS() {
			if (/iPhone|iPod|iPad/.test(navigator.userAgent)) {		
				jQuery("iframe").wrap(function () {
					var jQuerythis = jQuery(this);
					return jQuery('<div />').css({
						width: "100%",
						height: jQuerythis.attr('height'),
						overflow: 'auto',
						'-webkit-overflow-scrolling': 'touch'
					});
				});
			}
		}
		
	}
	
	MobileIframeFix();
	
});