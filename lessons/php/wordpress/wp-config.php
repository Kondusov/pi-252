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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'J!H3*K&{z0EMC~}q<gy|M&A7dnA:L%,/K8]=2HBr`m]nAAIm<$<S#-~)b=!0sdjU' );
define( 'SECURE_AUTH_KEY',  'qbmOsyGLjKOY--;NeZg43E_h&P)V{u?fQdD+nV#nc<KxulCd{`u0Oc18<(=bt!~R' );
define( 'LOGGED_IN_KEY',    'gKw(k <B6R&e?#^6St=5Z)Z?UBH$VsArsGJk>WLFK*$6x.6eMm6s;3n$Jjxtx/^$' );
define( 'NONCE_KEY',        'v.=/,aSfCb6]eQlVv}Y>[:^5m}.O(~KjC20j^.Dr+!z&XqEpK$#e|^bckml2gY&=' );
define( 'AUTH_SALT',        'Kq=`*&T(f[L%|bd:wLrJc$%:jL]eW#3t-bOrnAomIQ19Ox-UjMWR@3M7mx!{oJP:' );
define( 'SECURE_AUTH_SALT', 'f>`hGFN^#=c)8t(Yz.vY GHTl-3Ead7}no:)pG{]Wk-JC=_=Bb#C%h-8y&= 4qN%' );
define( 'LOGGED_IN_SALT',   'dAz4T~W>44_vMXvy!hEm7>U }jcRTgSqO)ZIdMf!;m>!N_:?)i6|.1]*BvU5-1@;' );
define( 'NONCE_SALT',       'kll/Gre~q)bdDXAtH}_yRuZ2t5+LBwuK/fUpko4<$!l^<25C]Xi?}G3pzIVz/[y/' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
