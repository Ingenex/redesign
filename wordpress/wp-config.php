<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'snaper9');

/** MySQL database password */
define('DB_PASSWORD', 'jyd9420');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'lqDNRjOql/YMIodbN|_w1&^U5kUJHCos+>]-&p%{bp(!Zw5?-3zaMgp!QBI|]#h+');
define('SECURE_AUTH_KEY',  '/?3^t Qo>1 #OrBJ|<4YVK4B&0a-L-,.-sMVp%E!OH^5#. @$}:VuV,!PXOgeAV%');
define('LOGGED_IN_KEY',    '5L-2D5ZX 8JqE<9UYW$R~.W3h*^!d5L/}{1dHBTM$4a5CE9G3dP;|bm%*~vK+|8d');
define('NONCE_KEY',        'GoxuZm0L}fKu1,qyiOOX]uI V-3DwHmQW0=d[c@R6_Y-2r-nOZCj-IP1_w;seR|N');
define('AUTH_SALT',        '9HRIB#|zcs;R^KvI/po]#}b}D{%lUY;3Y,^7GxvC)u0&+X2NDokh%mra KEh9.WL');
define('SECURE_AUTH_SALT', '-qu-kl-O&zXtq2ZI~h7by-em86-vBQ$[ivz5eS9*o8i;|V8[Tx?AJBxm#X?qSB1-');
define('LOGGED_IN_SALT',   'S-LrM|2:669:lVf|b8O-4YX}y3i=ZV[Vd=;fwT&,RFZfp!/:+E9M!~.XgA@yg@|=');
define('NONCE_SALT',       '@]}t|ts^#^47DUH@pgQL^{/|0x|hDQLe# ,s=;;UGeM<j?Qv@d-~aX$2F#0o;dQ#');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'sandbox_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
