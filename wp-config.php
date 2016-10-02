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
define('DB_NAME', 'haraj');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '4A/6+JTDYW-vxN7Uc*w31CD+>vFJqR+H]Z;?`--u`p1Pr$4mm,,nCpJ?o<.FEzZC');
define('SECURE_AUTH_KEY',  'c//l</>}pK!gjq(@F#-U06,p-~:]mlV#7@ob<+i9{iiG|2#JYto,aT$Uz.f-1M*M');
define('LOGGED_IN_KEY',    'RiRy7&#.!+>znstyRRVp:pQw/0*<Z(hTkc<W,d6-)l4%JOh?HG/ a*j:Ej:twhVf');
define('NONCE_KEY',        'G}]kb5%$JaGls|LiZuqE6a5jI70t.$,B1L=ho d{l<sRJuf-l-2oq 6x/H4BE5`f');
define('AUTH_SALT',        '-I%*F_G6[^WQt%~&!SVjDH757u:pB2XL6)8X@@_v:{G)v`}B_34.N~@4 56|)fhD');
define('SECURE_AUTH_SALT', 'N;R<Wb?$K,.3qX>ea[dx0NgWkj8OoGQ0x(@%0#-2<FkVIk#7n_>&lad5LY-I$A6=');
define('LOGGED_IN_SALT',   'N$#2[7)9{/y!zteVp `%#QVSs}7Uo)W3rh)3nT3Qp|@tJx? .x+U{If4UG?^y,ME');
define('NONCE_SALT',       'k)H))e@p;)/DQFG*Fy=.oRZLx(cLIDYn6~698maqv(?Qf,gg^XSnr%t;Xl*|:NxP');

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
