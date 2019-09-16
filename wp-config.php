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
define( 'DB_NAME', 'depallas' );

/** MySQL database username */
define( 'DB_USER', 'wpuser' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Tmatt2015');

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('FS_METHOD', 'direct');

define('WP_HOME','http://depallas.com.au');
define('WP_SITEURL','http://depallas.com.au');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '0NIhmfyW7F]5u. %a95M*L4Ct4:oDeFRbj{};PZT13p2yQ]rY@`mF`9g$7;rMp(+');
define('SECURE_AUTH_KEY',  '@D[.G|0n7oi%|/A=Pc|-s#hv(K#+Jtj>xcX>1h~bLJ!xw?|fGiU.:%#YPUrGBA5r');
define('LOGGED_IN_KEY',    'O||6+YIsUie4?;Yk<Rxf]G70*Mk}/2Gr8_w*gs#aj~$`ZBdASp0vQ<o+^IG#k4d~');
define('NONCE_KEY',        ')st%0Sr5F^P+p9G_?AmCi_0}-y}k4K<m8JsNjN7T9_PGcN-ngzq(j[obsd1k2X4O');
define('AUTH_SALT',        'uGxtjB+PVZ5P=W*|BPae?oS!edljuU#fMr%}@rR.|~.a0,_*jN!3AbP-m{x&=!w-');
define('SECURE_AUTH_SALT', 'GDj p-a8t*e7j[`??ovg|eCE}~|1;UOmevZ]pB,gEW.02fC)_53UWlML@Twz$OR6');
define('LOGGED_IN_SALT',   '5yCP<+&8/_i+ACoG=ZCiWTwnh?0hw^/]lLH@Z}x}3o|1Q-n.S;{+(WHgwt0WmWBo');
define('NONCE_SALT',       'QJ1bV}-D^rmYvia|4t|,jkCv|`m5sKH(e,.cidB;I^ o{NSp}_a]FD{Q.9+bj5w|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'depallas_';

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
define( 'WP_DEBUG', false );
define( 'WP_MEMORY_LIMIT', '512M' );
define( 'WP_AUTO_UPDATE_CORE', false );


#define( 'WP_ALLOW_MULTISITE', true );
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'depallas.com.au');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
