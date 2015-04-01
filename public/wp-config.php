<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// Define Environments - may be a string or array of options for an environment
$environments = array(
	'local'       => array('.local', 'local.'),
	'development' => '.dev',
	'staging'     => 'stage.',
	'preview'     => 'preview.',
);

// Get Server name
$server_name = $_SERVER['SERVER_NAME'];
foreach($environments AS $key => $env) {
	if(is_array($env)) {
		foreach ($env as $option) {
			if(stristr($server_name, $option)) {
				define('ENVIRONMENT', $key);
				break 2;
			}
		}
	} else {
		if(stristr($server_name, $env)){
			define('ENVIRONMENT', $key);
			break;
		}
		
	}
}
// If no environment is set default to production
if(!defined('ENVIRONMENT')) define('ENVIRONMENT', 'production');

switch(ENVIRONMENT) {
	
	case 'local':
	case 'development':
		define('DB_NAME', 'wp-composer');
		define('DB_USER', 'root');
		define('DB_PASSWORD', 'root');
		define('DB_HOST', 'localhost');
		define('WP_DEBUG', true);
		//define('WP_SITEURL', 'http://wp-composer.dev');
		
		define('WP_HOME', 'http://wp-composer.dev');
		break;

	case 'staging':
	case 'preview':
		define('DB_NAME', 'database_name_here');
		define('DB_USER', 'username_here');
		define('DB_PASSWORD', 'password_here');
		define('DB_HOST', 'localhost');
		break;
	
	default: // Production
		define('DB_NAME', 'database_name_here');
		define('DB_USER', 'username_here');
		define('DB_PASSWORD', 'password_here');
		define('DB_HOST', 'localhost');

		$url = 'http://wp-composer.dev';

		define('WP_SITEURL', "$url/wp");
		define('WP_HOME', "$url");

		define('WP_CONTENT_DIR', dirname(__FILE__) ."/content");
		define('WP_CONTENT_URL', "$url/content");

		break;
}

/** Database Charset to use in creating database tables. */
if ( !defined('DB_CHARSET') )
	define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
if ( !defined('DB_COLLATE') )
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
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
if ( !defined('WP_DEBUG') )
	define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');