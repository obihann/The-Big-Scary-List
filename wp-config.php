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
define('DB_NAME', 'list');

/** MySQL database username */
define('DB_USER', 'list');

/** MySQL database password */
define('DB_PASSWORD', 'bigscary');

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
define('AUTH_KEY',         'g;L32EX$ckZ1#5vw,ivK*(g7ONm009CT0WV5+xeXanqm2Vb%bUvL-v94hqYvd9__');
define('SECURE_AUTH_KEY',  'Q]u:d-F2]t=4E2{5yAtOSXx8}s+vn<bHp!C.&v[/CJZmSjTTCd7IzS_:l=WIX*%|');
define('LOGGED_IN_KEY',    ' }q-6@Y$|&5&78biY@oZh|+c(+kSV_H+(W)a;7RvLQ-zr 1|9oi3*kT=%^qa;_|+');
define('NONCE_KEY',        '%idS5,}S;H&GQU+7GY#|WN#BinC[Jpl-XQ}JXZ$FWYC$2lqfeE lSm^W(jbP*aGf');
define('AUTH_SALT',        'qEF&./hjCcSIj/t7eGIyz|G+NwaIkcU@e~ja1Op/.T1m^y-T;FRAq+&E??{GM`-c');
define('SECURE_AUTH_SALT', 'k9[ $H4fF:.+cUYkr?q[eu/RQYL4bh>Fmzm_$jz2A7x5am.u2c*U@B(V_ks%Z~?W');
define('LOGGED_IN_SALT',   'JOTo(BJI0-a~uLiEGCHXO/kx?e|HqRE.7ng3_iP2;~IIe*u78!SpC|93Iybe-BG$');
define('NONCE_SALT',       ')_ni<G(J+V?FRGOt pmttd}8la4|[#| F%7dWb&EwLD8N.EZnv?R>Bb]8B~8s+<i');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to Canadian English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * en_CA.mo to wp-content/languages and set WPLANG to 'en_CA' to enable Canadian
 * English language support.
 */
define('WPLANG', 'en_CA');

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
