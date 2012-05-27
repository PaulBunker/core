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
define('DB_NAME', 'dave');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         ',1_E4&u*13SGyd(xG#/%Hj{+-%|[S0|^mVhl<#P6+XAea9xSYle~hj@7B/1Bja{0');
define('SECURE_AUTH_KEY',  '&l*S<| OFvNDMJu8Lc }oGW<P3POJw[m$5|Q>xTTDTzocn?&VnX y,}g/ LL$[R8');
define('LOGGED_IN_KEY',    'c16m]MmYI1-xTA:;^}J_zn<,lmRDo!OC]5G&qQ7P/UT5Gc/(rDXZ#v*qM/+;fI<R');
define('NONCE_KEY',        'qYP )o3aS+~`+<Vhgz=aV/f,ldLaRoc^5S7,@vwi0 &tf4GFri<eF1wUQ64R1ZI8');
define('AUTH_SALT',        '{9]_%><feJpXlRZ;xY<Rt08NWeuRad=rat3e.C#&/2Og/StC]=ox`yb4]Y_g.!|+');
define('SECURE_AUTH_SALT', '.JI[-sf3-*9Cwqb^O5zDbP{BIIvE2IqlGqn_RaVJ73>0e^QO~WhLo+s]nacc7zuq');
define('LOGGED_IN_SALT',   'cmOdQ_C!P~TF;yi[Ph5tW_J:Hu3?Wzmv%2t8$ssKcyxnJ}to!PCee0;12m[<F1aM');
define('NONCE_SALT',       '` %vA8h>jH6-k>BR[l*RE=Ov!,QspWm7681`H{VZQItB-= $KsIJK*x4v1&94=jM');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dave_';

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
