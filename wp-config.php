<?php
define( 'WP_CACHE', true );

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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u148392290_FEsdi' );

/** Database username */
define( 'DB_USER', 'u148392290_KzOsw' );

/** Database password */
define( 'DB_PASSWORD', 'cTecAd6Aup' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '.72lmq7,l{aQ(r[<8|PC3=p%<E(9L2Ik2D2>kiCae6D,a@-j$^j^%rR+/2>P-(P/' );
define( 'SECURE_AUTH_KEY',   'JAg/>VJiO.v:7GdqC=tb_SS`uvp?l .1meYb7>(t<yihR~8]/y.@Qs]AQv)!}H!b' );
define( 'LOGGED_IN_KEY',     'gr?m:SM~MF%Ll;C_TL0)uwb.qA7dPhl0[PU}5;D+p?aht`pF8C:Gt W9lECY>qHU' );
define( 'NONCE_KEY',         's)aQU{D{C0NnC]qB/wCH,VyKVPud(R0uoYyqa2c~)::ZG[*>oC9x(y*tgEl0^vJL' );
define( 'AUTH_SALT',         'Bkgk1Ya3-:XtC~_bWSgokQcmK<@=1kH+>2@p9Vn%44{Mu&UEMkWL=<<tgw&m%Mb6' );
define( 'SECURE_AUTH_SALT',  'px[&S_N|bap$zCo9Km57,aFwK21IVg0qS#0yu;M.e0}T4&5$~bz^[CQ^M QYT~@Y' );
define( 'LOGGED_IN_SALT',    'yX 6y)< }Df2v5NzV;R<yFT%(<ppu}+qvFS]rPc!>EbBuzK!M7&&Wi0#%K9(jH[q' );
define( 'NONCE_SALT',        'xis.dQB:vk{>%ym;;M)Zy;{B!Nrshs1ug+|Xf_jfBXw-Cpn#d7?)l(-CCE1wH1L&' );
define( 'WP_CACHE_KEY_SALT', '5J o{:FfYSXM0/f3UW+*FqZ#oE2U$}*@+vXchMbH9v!aZa]_<Qx|yU`Y={ggJH&T' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '2c8587713e79dd630a285e28f15ab390' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
