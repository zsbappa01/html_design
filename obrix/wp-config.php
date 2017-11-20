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
define('DB_NAME', 'obrix');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'lkq5cFhh!Vc8Qp(>OhN0(~ p;VkW21*NW:ECvA.yl_HE] aZ[S6soY<j@,89IQ4W');
define('SECURE_AUTH_KEY',  'vlf?WX#/J PS/LM(iN0fG<>[Xs%mIJZ@TOgZS[;Z8ibVmHEaF*#uc4%soNYQ~A,{');
define('LOGGED_IN_KEY',    'E;:m7A]*-L`S}%a<`54{;8{C^[<sD-~`QmUyH9!a]a/9q[cTp>Q]~J8C[7W*uPKm');
define('NONCE_KEY',        'NujJ EH$vmx5w&#aY?QGj&Sg`i`>TKJw|xZ+:7q(f%s|2w!geS*Xya7AaDF^=.Gs');
define('AUTH_SALT',        'FL?EN)/D3G_35.JVg=jlI3doC,Mh!u,e+W}E4&JeVd4[=Qmx!IcfGi^3-Ums/uTf');
define('SECURE_AUTH_SALT', 'gZlL%B7Jz?yk#WZr,YMl^WD%@kp)YG1TE$!&CFNy(a-&*wSE/rV(++wQbw*d5oc|');
define('LOGGED_IN_SALT',   'E[PspgZ%mXP^? IpM$~g58pj;riO*:(<}ZHTZQRsB`a)MLyFYGNJz(0}O,g7Sv[]');
define('NONCE_SALT',       'd,-XKMH54~D1(&%wk8@j-FMp~xoW],XmVx3JmhEa2Oc7AnH)@gQJ-36*>&MO<aKw');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
