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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'hKQMU6{Dx28EM4tDck$FFlTQ,[O6F%]?;|iP3JVitOA`j|kG]Xk dlsGXG$J|aJa');
define('SECURE_AUTH_KEY',  'DnZg$`kC;d-0nj$vC:|pMXWvjd%:Lo_@}2z^2.,QR/O#P^8A<jwJLia{wL^~S1$}');
define('LOGGED_IN_KEY',    '.k!y5C>c;SYL 3g1b=$isC;UGpH{T}D+F0a~Y1ng!5A pD^^q.HY&,5Sx66gw5Xu');
define('NONCE_KEY',        '3,b=AVxNR4KF;7nK1ea?feS_fQM$zKCXr* Unfd;fsjB0Pr@W=N7V.nrDH0}gu45');
define('AUTH_SALT',        'K6$d#gMgO=X%~m}@v(&tcaZpszt0%LWI4bR/{+=Ou(U>zoeCv{$Fr{ol8eqV|n6b');
define('SECURE_AUTH_SALT', '[L/Zub=<F8l0%&VK1/B64dAYBa;16H||wBLY&[H$7Fw]pF;TG)v4$pHyt(k8&j>r');
define('LOGGED_IN_SALT',   'TOcm#wERsY&L.nqmMw.N]i(U;-{!MLRWq^m$4zv*BF)LAYe?JXpoojKY}B3Q-buc');
define('NONCE_SALT',       'GC/gn_kGd=G{Fu27SU~vp#:j1Ky3hQ;MuhfvUdYjDmo[BfJ|c.p#$ p_Jq[m3HwZ');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
