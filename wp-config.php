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
define('DB_NAME', 'drl1534204315683');

/** MySQL database username */
define('DB_USER', 'drl1534204315683');

/** MySQL database password */
define('DB_PASSWORD', 'Javier3000!');

/** MySQL hostname */
define('DB_HOST', 'drl1534204315683.db.8478671.hostedresource.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '=q&XB-As%gU!YxIyg5+2');
define('SECURE_AUTH_KEY',  'Md!(7!OR#@#)EK=&KF/ ');
define('LOGGED_IN_KEY',    's*3_E_w@6Lzv83vGUwg6');
define('NONCE_KEY',        's_QHHtyxVR02(*!W0j6g');
define('AUTH_SALT',        'T7671M_WbtJ_Nqj(As81');
define('SECURE_AUTH_SALT', '6yFQ/&d993aMsVd8*CRq');
define('LOGGED_IN_SALT',   '-fzU=a6C4gUxIa8m#6f8');
define('NONCE_SALT',       'BL3+EdMHdpZH$14E9z5j');

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
