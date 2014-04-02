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
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'BlL|Q%}g!]+-:Vpu;rJ}5w-UY9BJXQz1)_p5{OMx&ko`z8b/y?,dG_y;Pa,W+L,{');
define('SECURE_AUTH_KEY',  '+3;onviBQQiPn/n%5]pUebeEPRzz$q$</Ba,>$HbtdDa-~-O E&]M!Klh5VPj/- ');
define('LOGGED_IN_KEY',    '}%ZI1Qh)r<QaEsU#:x?ZUyh4Dq``;QbG2<Tt..q-6%~2+oWOsA<xGa#U7ko6@}c5');
define('NONCE_KEY',        '}<{(&-zXpu5jf0tN&VHlJLv|;($y!fyG.^/_T}G(Y#}kp51vl=|q,YYhyZ cm_YC');
define('AUTH_SALT',        ':?g}s|VpES7V@G_%[H,Iu06 [Xes*2v|Xp9+d@ucb?W/8n2E+CY-M@]oHo103t}m');
define('SECURE_AUTH_SALT', 'gt~dzV3y+-pQlDy:Z]=gV?js._qw}ve/9S/MPA?{}q[PZ]|I?yh;ZUqJsMVqin&=');
define('LOGGED_IN_SALT',   ']eRKjbR;1#9Od*v);JX/@j:jg6p<M+Kpo),t.smEI$ )k0iXUoWW6j>W9*4NJ^!?');
define('NONCE_SALT',       '7iw4S1Vv+S2!zCOFI`;.e-68YnzWLM#-0(z,VC wM$}/8#@v-C,@;X;Li;ODRjk.');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
