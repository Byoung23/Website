jQuery(document).ready(function(){/iPhone|iPod|iPad/.test(navigator.userAgent)&&jQuery("iframe").wrap(function(){var e=jQuery(this);return jQuery("<div />").css({width:"100%",height:e.attr("height"),overflow:"auto","-webkit-overflow-scrolling":"touch"})})});