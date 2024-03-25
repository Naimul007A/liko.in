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
define( 'DB_NAME', 'bcsaidco_wp582' );

/** MySQL database username */
define( 'DB_USER', 'bcsaidco_wp582' );

/** MySQL database password */
define( 'DB_PASSWORD', 'c6pGS8d7.[' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'opgp7ehujhvsnz9tok9iyr5d6axnn4ajbjj4hezbou10ayqqvtgwa2kpv7hlxigx' );
define( 'SECURE_AUTH_KEY',  'pjxms0jenhpsosfigbdxeifcwzhhxeimvuc0cwg33u4eslbtjud57g95wf3d9ddd' );
define( 'LOGGED_IN_KEY',    'wd2ekq4xvas2mrp99urjxv5mvhsfk4ponfue2jb2xtzovokvqjqa9pr1a55wi982' );
define( 'NONCE_KEY',        '07v4ilzaefhappugvidlvz31xxxfkprihjhsgif0yww05uuheexrau9d6rrhiwia' );
define( 'AUTH_SALT',        'inxu7y1qwbaq8hbix55vintxovvpykyyqu6j5pnlhygpicazcigmfjcaeo3ift0i' );
define( 'SECURE_AUTH_SALT', '5ovpagfap2hn5guc1citcoa8uo3zgvl3aznbldpf0cuhxercrp0lo2bn436picn5' );
define( 'LOGGED_IN_SALT',   '44avpodemaoeg6xeouunemvn9ri7icsn8o2iy20gslgt6ddg2i24ghycs2pwvbzf' );
define( 'NONCE_SALT',       's8ggwx7ichihslljncloolip2catkwuwll9ns817eifcej6lgykehieextvdiq9d' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpdb_';

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
