<?php




//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL cookie settings

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dual_nationals' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_display', false );
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
define( 'AUTH_KEY',         'm@w@F~t|rB%OS*$AkN.j>8oE_EF{;<AzeRU29wFN_0wMCrdTAv@ {j^M]y.h]4Kx' );
define( 'SECURE_AUTH_KEY',  'Qj& +o<ot9Hxt:,gMzUvA56QF`<l,^|I-3_NHhx] O@]1&^}TSs,l<FO6fI1@vNt' );
define( 'LOGGED_IN_KEY',    '5jwqrRdaSM`IKhg8-X_*2)A0-lz U~-P(Ty SNjxRG}chQ3,sos_K_(y?p!>E8AB' );
define( 'NONCE_KEY',        'QgO!wiT>d(?B>W+5wBx]Hs`qzoy!GmSe_PhH<:@O&)b&9dJa>v37Pe,/|9~s<.|-' );
define( 'AUTH_SALT',        'W3BhtF:x<4}Cg4dHoTQo^)s+-7!zMSYY<!dLpjrAlKV6l8hP58xVO_agD^nna?ly' );
define( 'SECURE_AUTH_SALT', 'fPTr_XdNdcQalDe>Hu:i_]z0+P1ALOjJgJ$h;b1Gm_0gyL(pkUs~{E2^SH5o_$c-' );
define( 'LOGGED_IN_SALT',   'M:K&KzJ}q3,8}SB-/~G]FDb1ViW(hIJpVtE+,_V!lBr+c=2_:hub$pSihu]wzGf^' );
define( 'NONCE_SALT',       'BW_w!F|A{y`!La9oV~8Bp(k.e(w-(u;fHjqzmw[_Pj`TIs0{d-Z_? +g*nafk]Uo' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
