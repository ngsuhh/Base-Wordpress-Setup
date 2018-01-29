<?php
/**
 * Development environment config settings
 *
 * Enter any WordPress config settings that are specific to this environment 
 * in this file.
 * 
 * @package    Studio 24 WordPress Multi-Environment Config
 * @version    1.0
 * @author     Studio 24 Ltd  <info@studio24.net>
 */
  

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'dbname');

/** MySQL database username */
define('DB_USER', 'dbuser');

/** MySQL database password */
define('DB_PASSWORD', 'dbpassword');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
$debugOption = false;

// Turns WordPress debugging on
define('WP_DEBUG', $debugOption);

// Tells WordPress to log everything to the /wp-content/debug.log file
define('WP_DEBUG_LOG', $debugOption);

// Doesn't force the PHP 'display_errors' variable to be on
define('WP_DEBUG_DISPLAY', $debugOption);

// Hides errors from being displayed on-screen
@ini_set('display_errors', 0);
