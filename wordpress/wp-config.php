<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', 'wordpress' );

/** Database hostname */
define( 'DB_HOST', 'db' );

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
define('AUTH_KEY',         'oM3!R#UnI1N+x<%3KR2kB/UsB i,uQMEA,`!$DMz9f~T#7+-qYeOnQ21fs6<&~[H');
define('SECURE_AUTH_KEY',  'Jy-WJp,[>vNWiSzMQ%GC`fdU5%F7%@|B6!N4*Jx-e3mZ== `NC7yO6EIyp|BTZ n');
define('LOGGED_IN_KEY',    '@8yQ2TF|noFC;u7FU-tU8(T+TkyBIi+f-V]L{+!_zm)-rq*W(AK-BZ:WemOmM|jM');
define('NONCE_KEY',        'y+cG_.#@MgM14(+$nfK-<*VBsi^:2 >[UlTyVO_=7~^ K)7VF[aL|rI0NZ(ic20]');
define('AUTH_SALT',        ';xSZ?G;(+tVRanzOu#XJ8qeiC?cmM,NX_zF;l`A^M>Rf@A5R]L#puabVU$+zKJ33');
define('SECURE_AUTH_SALT', '>eYI>*F1iK[? YN% :_q~kRg@w@>}S8XbMt%_u>MXFmWYXlm$1rAt9?+XU5Sw?!*');
define('LOGGED_IN_SALT',   '<Bah+OT5+!$pf6JXcN43j9A-,5Fh3_7-LNbk=oNcH5>|f$`2R&}qLB%IL<-W|ajo');
define('NONCE_SALT',       ',b:q4|s/-_*=U/<;cr7@O02.Ue9eR}*kX(XC&+OMU=ka?d[-i/rs4G(NhdIExG[+');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
