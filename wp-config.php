<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'chatbot');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('CHAT_URL', 'http://chatbot.com.au/chatbot/chatbot/talk.php');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '7hRo?/jw>am}D!+6mN;o8Pdi;{CaJD6AM+]R]|)5ehT:$]IJX5jFkn}.ri:jnR`=');
define('SECURE_AUTH_KEY',  '98i=m37; ^lrn-5uF-F7z?b=AtMn+F!N=]/@zu+OKg,`y!aVv!sf:&syU]PYIh W');
define('LOGGED_IN_KEY',    '|nruLlOWPRXA^<>R8nB|6|h@9H&PN}CAlrv~D.p>H)Lm4IkY,Mc!{~hVzcGZ4eL$');
define('NONCE_KEY',        'R@!@K8wqWqV?*Bhh_|ZhD/e0m*Y3jWPhWxP$=wzt^OvJzyq{>d[4Ba+<*POT8is,');
define('AUTH_SALT',        'QRf:w>c{z-k.@XOViAF9.:EZW&y<>4?7.Tq%OU(I/SWqcpHd+?(8ZY9+#/|apOEu');
define('SECURE_AUTH_SALT', '*|TU8K+5LB5H51jp1zg&,6.P&8ySZ-k>-t$Isuo2PPz!D6c-P-LH(>t+#!BJMEr|');
define('LOGGED_IN_SALT',   '|2T=gL&t*e)!t-kgjO9z]@RDZ-LS)J9S<uthx<uNI2!mJEwady%;r)GJI0#ZLZ|U');
define('NONCE_SALT',       'DTu:+sJSS5~m>Mc~_rG]|~8T)y?F_w<sXmdtd+qcvH@7*^KB`rb)reP:x-/h :#6');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
