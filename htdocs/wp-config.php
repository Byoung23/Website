<?php

/**

 * The base configuration for WordPress

 *

 * The wp-config.php creation script uses this file during the

 * installation. You don't have to use the web site, you can

 * copy this file to "wp-config.php" and fill in the values.

 *

 * This file contains the following configurations:

 *

 * * MySQL settings

 * * Secret keys

 * * Database table prefix

 * * ABSPATH

 *

 * @link https://codex.wordpress.org/Editing_wp-config.php

 *

 * @package WordPress

 */



// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define('DB_NAME', '');



/** MySQL database username */

define('DB_USER', '');



/** MySQL database password */

define('DB_PASSWORD', '');



/** MySQL hostname */

define('DB_HOST', '');



/** Database Charset to use in creating database tables. */

define('DB_CHARSET', 'utf8');



/** The Database Collate type. Don't change this if in doubt. */

define('DB_COLLATE', '');



/**#@+

 * Authentication Unique Keys and Salts.

 *

 * Change these to different unique phrases!

 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}

 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define('AUTH_KEY',         '[;ILLzq!>0]*=]>Z.]UGYCR)=Dfn=wi[s`!sF&{o,)>[[-cHS_09jxY+|SWbH].?');
define('SECURE_AUTH_KEY',  '!|~?~0|/H7*haB.)y->N)p,@FbG-~-!4cB[Tu{:wU3w:yvGyN^f0Zr3#joF@n7-n');
define('LOGGED_IN_KEY',    '-O?y$Q5Jq`mGUWIM|<XGh_va(-{NLc.Adnl?-.2fEU.bi{@w~f+#^/3|Z!1)lfs_');
define('NONCE_KEY',        '0&8{8L8mvuT3Ge!m+<BhG)jU6(/:o<@x-=E=9hsfb) OuAqln%!RSB &u[xI5=v`');
define('AUTH_SALT',        'oH4HKzFEJ?.(*ZQLH4@0g!/UJ ]!&%6& m=zFn5K.DZfyfj:L9NL;eYD8z Y+s3K');
define('SECURE_AUTH_SALT', '=%@8L!K y^G[I#[BoW+4~-kg==iuVv2v+Jzy]|gsHAJgtQPoxf2%b6BP<VtYsQa%');
define('LOGGED_IN_SALT',   '`TUU4RS,X_>NtM0Ww+pyK`7}v!7R1<uKY<Jy3f^0mtVQ$nB^xQ.K9vr38||}JOHx');
define('NONCE_SALT',       '[_Cf4y$5Hwa+/7WCGD(*(e{%OyJ}4bMZ]o}7&3Ab]XYBnt29p02ZU2W)1B5XBu-G');




/**#@-*/



/**

 * WordPress Database Table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix  = 'wp_';



/**

 * For developers: WordPress debugging mode.

 *

 * Change this to true to enable the display of notices during development.

 * It is strongly recommended that plugin and theme developers use WP_DEBUG

 * in their development environments.

 *

 * For information on other constants that can be used for debugging,

 * visit the Codex.

 *

 * @link https://codex.wordpress.org/Debugging_in_WordPress

 */

define('WP_DEBUG', false);



/**

 * Disable Cron

 */

define('DISABLE_WP_CRON', true);



/* That's all, stop editing! Happy blogging. */



/** Absolute path to the WordPress directory. */

if ( !defined('ABSPATH') )

	define('ABSPATH', dirname(__FILE__) . '/');



/** Sets up WordPress vars and included files. */

require_once(ABSPATH . 'wp-settings.php');

