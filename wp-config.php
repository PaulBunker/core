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
define('AUTH_KEY',         't[?@t;s&s:u/[(1;/uT;jzK/xpg-~>^aysiN[`d}*)9N0jPrP!$gA/r9}r^mU&|;');
define('SECURE_AUTH_KEY',  ' Fz:%2TiWL_>}d+0X^}Rm>GW^~NAGyQ[[>z0d8O:CJ$+o@i>6?;vWod6fyUI5i}[');
define('LOGGED_IN_KEY',    'nwsAbsr w `@.%n];zHH!X!g$e6)%3_p8<C_#7^i@s*LANF3HcOhyr.<n#JZ!L=+');
define('NONCE_KEY',        '|sz8%AcSrx!+AXoQ+>}X$_.{buU(q)+ -|#(`vPPx/#*9#aMzrPCQxPfFPMu&{-j');
define('AUTH_SALT',        'vR]KSK+{u.f_a%!K]=oKKh-*$eeP+@kfAE+ass&+Lk!Tq{l|MqGHM6WJNJT;r l;');
define('SECURE_AUTH_SALT', '%3I1o 7%l>_2TrUZlfH&_xMtUwl#(Cb7)S((VZ8Srw%V3YC1Nm?G +x21kgx-XH/');
define('LOGGED_IN_SALT',   'n^1v/<$g+<*Q_ObdI;rIC]T1T,{o<ctn)!LfR@l:8I=B6JoRHcX=7]>H8Q:_j9ny');
define('NONCE_SALT',       'wqIP}L[ 2_sJ /$[op`G;Q7eRg(WeWE9x6:PY24#SdB$bBB)x%.dKk|KTCNTF[4a');

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
