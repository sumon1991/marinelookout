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
define('DB_NAME', 'epariksha010316');

/** MySQL database username */
define('DB_USER', 'marinepank');

/** MySQL database password */
define('DB_PASSWORD', '{gviFnKGH}-R');

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
define('AUTH_KEY',         'Kb;s.+P>X8;<[ ?KqYnq^vq_(G-U-G>^_R#eEWU+@8d+P$Cr(be;!h7Pu=-&d[$u');
define('SECURE_AUTH_KEY',  '[>&qsz3sKXL?V)gD-1E/DZf>ePbcj/y5MELQv p3gRX3=v|;#*#~1BM}ie0<>CaK');
define('LOGGED_IN_KEY',    'qLFb$AM&XBk2xGh:qPmu|Xp|he|ucP09t]9<Xy=IOk$4Z]E+]pJ*vlF-a/h/@`Ie');
define('NONCE_KEY',        '$ayCM0UvtNDR)+8F-_GckDdhI9kg;G,3 -k/RTVjf(I^+_mgnQI8@2hjE(@m67P`');
define('AUTH_SALT',        'Vo=,:R$pDpAVBJq-o],>p.Yw4a#XExkH8}R!Kc$KCz$&1.GDPa^NS{H.iWO~O+M!');
define('SECURE_AUTH_SALT', 'Cayl-$-(Qwc*4J,V0z>9w[Rc.67& B/~<YlP+ )|jX8n Jt/,(Sc(uZq}PacOfx=');
define('LOGGED_IN_SALT',   '|}}E+C}0]]zrq~}DP[zPUfY)%#E,akaf>_V=8Ip6Z)>?-5-$&DnZqNtlvs7&E=<F');
define('NONCE_SALT',       'UA&fXBt$x*Ugl8u fwb6AHh#zq9E|,r{!3qC|RD=?#Aee>E0+gf]f/i<8ZrQEEs[');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'epwp_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
