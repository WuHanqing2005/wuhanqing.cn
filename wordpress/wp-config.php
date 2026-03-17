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
define( 'DB_NAME', 'wordpress_db' );

/** Database username */
define( 'DB_USER', 'wordpress_db' );

/** Database password */
define( 'DB_PASSWORD', 'whq200501210517' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'fZY^wx6@Gn5-DGT>G&D@6V~[[4eF~4Z/W1;]7N1NeB+?IhPKMFG|h<ko]S F&5Bj' );
define( 'SECURE_AUTH_KEY',  'C%QV#!khMlcFQVY^*!<xQ-gVTtI#iVy5ub$~#?hZaEDOMn>C=<4r&j0SiP6VDD:-' );
define( 'LOGGED_IN_KEY',    'x7w{Dd9H:Ij|B*k mgVV`luw]77q|NBJ/$[W%aP7!q&18H{xEpp}h1K4v_mG-`fG' );
define( 'NONCE_KEY',        '?_TE}/RIZ/MamUOT7GrE2vtXBw6zqy}`y@th)$o3;X*SH5A_[T]cn:):*8`aRY?R' );
define( 'AUTH_SALT',        'm-ZD_Og7LLSV4X1HpvO/FM6[/=SQ(6Ku2K)=JVFA%(.nyoW-p~qUU:89UZ3^m:!(' );
define( 'SECURE_AUTH_SALT', 'fdPq-!!6,fFo%{R<wEi0fR9adT>2OA|@.S&-B4xf+=]r&SlZ7>3{2zF/?#=FfE*F' );
define( 'LOGGED_IN_SALT',   'v&zdh=Q^:*mFht*@T]>JkTpBTQl|#GQ(29OXVPhrB~1_2;eSOk5B$3pc>]eUcuxp' );
define( 'NONCE_SALT',       '}`+tR=MKY#}F37jGzJ0BZK<xehN/m.AYe:^^)NF*=z;6A0P@_y%Q;jz#)H,..+e@' );

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
