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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

 

// if(empty($_SERVER['SERVER_NAME'])) $_SERVER['SERVER_NAME']='www.wpdemoloop.com';
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wpdemo-loop' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

// Please configure SMTP credentials

define( 'SMTP_HOST', '' );
define( 'SMTP_USER_NAME', '' );
define( 'SMTP_PASSWORD', '' );
define( 'SMTP_PORT', '' );


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
define( 'AUTH_KEY',          'F:)_<LF&yc<G#)R!mBc#IOS.haDF*K!$ntPEl{3Ymnu~17ovK)mrpp`)AR73L/LP' );
define( 'SECURE_AUTH_KEY',   'NA77Sw#](I*7nD`XB<VBoJ=>ShcOwPBY)Q62(XKV],U[0zB&7/W2?TG}/_:jO>[F' );
define( 'LOGGED_IN_KEY',     ':?aE_n& >#jk,MnDmLd1$5.!/`y8qh<p[/D)ic->{,`E@H+)=ty9V@O3[~E7[seg' );
define( 'NONCE_KEY',         '^pKoB*TI;+y-v:[rpQg>!iRb|Y)ZO9oK<0!Owj7ZpRDu>l,!ac<dJWTAPuiF5*8l' );
define( 'AUTH_SALT',         'Al+F~8@y7Ty2ih.1MG0ld)t#hd{*Z2A$=6(F)-*vN8%#zYKJQG&KM+S5s>}w%U^l' );
define( 'SECURE_AUTH_SALT',  '-E3U4=6fJ#b;5f3LHc,Yu@Phf=3s=<pL2W]4OVbFa1!=e1YTcdHMtY}QDC23vX(Y' );
define( 'LOGGED_IN_SALT',    'KNG/fVC}+(n6D.0k@:;FH#X4UEYVh..JoW&0-a.vguzDAh+iE).Gfb;rcNk2Z4Au' );
define( 'NONCE_SALT',        'P2N,`3ufRbe>Vf2i>NE7H!} Mawk PfB*h~E*DTK-}-80D|D4<(ghJG3xf]F{D|+' );
define( 'WP_CACHE_KEY_SALT', 'jCok%]!;?AHi7[_8rBHR4HjQ^YPKOGi@rdvrYefZ^A%APlm>33Yw_`Gs~$sp-TW(' );


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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
