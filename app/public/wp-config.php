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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'bH(<pk/{8%;KT4`9Y}WY7*C02.#2<i%Wn(|S[M)u36;pu2_rWDSa4dE!I>DWZNF<' );
define( 'SECURE_AUTH_KEY',   'LQXNZ+`<[n,lUA>9Q%SV3}BShPXBI(VR>ToZ9&DVuB4Tc HK{I/I1$(lp9|kD=E5' );
define( 'LOGGED_IN_KEY',     '}mGw(*N=aE3Vgn+RI!+f-8Vs,pxpDx)gV[mm%9n_xAT)Be6(^z`e Q2lWF`k-dOt' );
define( 'NONCE_KEY',         'k>&M,QcqR6EfZUj+UJ&bH{#;XBA[%^ jjt4?yb(jER.i&G._jZv):#Z+MKajk}21' );
define( 'AUTH_SALT',         '+ttN5]sYOCAe koZ8U6F:b3[bh8@OF>[H5,y.6&C$!lr}%ZXFZf)sI&}o2A#+iIt' );
define( 'SECURE_AUTH_SALT',  'h~.^dObXTs`PuR:yC;2-{Dr.PthrQR3]h%QZV+>1w@r8<K$lS8Gu/>kB-xr_Spk;' );
define( 'LOGGED_IN_SALT',    ';xbws)oOM2&vRB<LD}v%i{FeaF^9q0QhhEni7Xx,Df8=`,.)6[Ip{i[,?8Ofx:-r' );
define( 'NONCE_SALT',        '-mva@a@3]$17L3*utw.5!1*|TLF={Bx8-Z).y]yxTC6UWB]a{ 2Fq (yMi!AQyP7' );
define( 'WP_CACHE_KEY_SALT', '7u5,~9ic& C0@(G(nNrTat<mr8L4:SyZWxWJm|[bFKp?<L|%`=?CL!HeX?9R#t@u' );


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

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
