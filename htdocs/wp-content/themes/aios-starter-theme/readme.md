## AIOS Starter Theme

This is the standard base theme used on the following products.

* Agent Pro
* Semi-custom
* Imagine Studio

### Maintainer
[rowell.blanca@thedesignpeople.com](rowell.blanca@thedesignpeople.com) is the maintainer of this project. Please forward merge requests and issues to him.

### Usage

1. Understand [Wordpress Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/).
2. Download package.
3. Unzip to `wp-content/themes`.
4. **None** of the contents of this package must be edited. 
5. This theme must be used with the [AIOS Starter Child Theme](http://gitlab.thedesignpeople.net/Themes/aios-starter-theme-child).

### Hooks

* `aios_starter_theme_before_inner_page_content` - prepend text to #content of inner pages

```php
<?php

/* Add this code to functions.php to easily display breadcrumbs on all inner pages */
function aios_starter_theme_add_breadcrumbs() {
	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<p class="yoast-breadcrumbs">','</p>');
	} 
}

add_action('aios_starter_theme_before_inner_page_content','aios_starter_theme_add_breadcrumbs');
```

* `aios_starter_theme_after_inner_page_content` - append text to #content of inner pages

```php
<?php

/* Add this code to functions.php to easily add a 'back to top' link to all inner pages. */
function aios_starter_theme_add_back_to_top() {
	echo '<a href="javascript:void(0)" onclick="window.scrollTo(0,0)">Back to top</a>';
}

add_action('aios_starter_theme_after_inner_page_content','aios_starter_theme_add_back_to_top');
```

### Compatibility

* At least Wordpress 4.4

### Issues

Report bugs to the [issue tracker](http://gitlab.thedesignpeople.net/Themes/aios-starter-theme/issues). Bugs reported elsewhere will not be entertained.