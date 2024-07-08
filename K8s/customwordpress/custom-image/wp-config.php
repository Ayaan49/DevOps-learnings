<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'password' );

/** Database hostname */
define( 'DB_HOST', 'mysql' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'K/0gw]K;WguIM.>2D:i%+i.n]=e,*upY1f8[:zsxCq[l`L,`HIb@?{mqrbb0jc@s' );
define( 'SECURE_AUTH_KEY',  'Sg~*y]qQNCh%Www7PQS4RZ0KL-osg&l:}H`A1R*7-cJg46?qr~N(zVj2xr;.73GG' );
define( 'LOGGED_IN_KEY',    'QoK$#F:_/ebv4qxfN!+qD^e>L*bxt)n]gzDV5}vjDHI{i{u(@(|On^7Xno0I0?WQ' );
define( 'NONCE_KEY',        '5kxBYdIYG#A]Q%mI]vP`*?^j)9[P[9V4(?dYU;+RbwR=%a>5E 0r+(>wug#*PD]M' );
define( 'AUTH_SALT',        'QpXO op*}gpm#B)IcTLJNE!!(RSTFS|A?Oi ![^kvj9+D18g;~5:qW8|oe^mTh` ' );
define( 'SECURE_AUTH_SALT', '9THlP<10S<t5_J._E{~G5fj_fnFDPWjzS:%KLY%$T:14W9Ue9WXg^L~6{Er/!h+C' );
define( 'LOGGED_IN_SALT',   's<7B%xG[s,n 1:+))U./_P4x4CD{LHYrOD+4(@F#>]+>]ooU0-G{=jO:)kz@<d]*' );
define( 'NONCE_SALT',       'f_?;e)v|/LPZSo:C+Z=JVe6P}&}$_~6BkaW08IKia|Lnb:FUJv5HB;@aVL! V+oF' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
	$_SERVER['HTTPS'] = 'on';
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';