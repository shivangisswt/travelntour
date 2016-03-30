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
define('DB_NAME', 'dbname');

/** MySQL database username */
define('DB_USER', 'dbuser');

/** MySQL database password */
define('DB_PASSWORD', 'dbpass');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'rgmwo1jptn3kwffcluoxihdkviq8xbfgng1elifnnn00jghk7jboidv3f6kke6sj');
define('SECURE_AUTH_KEY',  'ojajadarqksxuofa8wxcklccmcmjntdxx2rjzcrfdqrkwilanx1ykd32qoayq6mx');
define('LOGGED_IN_KEY',    'xde3hkul5ilnolhco7hy1grujnvutqloadjnpbeuntkbazaywbc7v6murw9utgba');
define('NONCE_KEY',        'sojxotqac3ql0aj6ojsmeq1joikv5jqmele7bmsdorvfub7stigz44nmwmzxfqsg');
define('AUTH_SALT',        'h1qkfktmxhxzxyoqce7kdidnmezvsyxvovgjmjm5lk4asi62hixzt6s6xdvh1jo0');
define('SECURE_AUTH_SALT', 'ofhznbwhwlg67tembmgz64iwqclhh5nz6wvlde69hryymvuwkcukhgzd2bg309mf');
define('LOGGED_IN_SALT',   'unsvr68i4pjqwh7l8hijuu4jo6cuxk8om9jbjenm7fbvtqkciocfvw3jyxmn93wg');
define('NONCE_SALT',       'jipipj4q2qnkizjkjtqle5dcexojseeab7ybylh0ma7axbj9qnwg9or6oyx7g9uc');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpbt_';

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
