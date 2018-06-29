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
define('DB_NAME', 'eldile5_edd_blog');

/** MySQL database username */
define('DB_USER', 'root'); // eldile5_edd_user

/** MySQL database password */
define('DB_PASSWORD', ''); // 3n0ur4NC3! 

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
define('AUTH_KEY',         'jLUz1<U|;./j)UNR6-##8=,TXv]slo*f~`lZ4YwPUH A267(%btq$:}.l9YDNq/z');
define('SECURE_AUTH_KEY',  '.<;vob0;%aMIofE> g+DyvA&3DfPqT 7s+Auw71/2:@S|-?L+@o%r}SlXctO14<%');
define('LOGGED_IN_KEY',    '[p.I?9XWp~J~;<7EhK`%-<+O8j=K(W7HKNjeak|4T.Nb_7NsO528LHdr%Jh>0xPT');
define('NONCE_KEY',        '4E/D82|WKE^W?Hs$QV-! 6BNhsky#m.g|xWjc;0-@<c$[y+iM+C86$+3idtLsq9$');
define('AUTH_SALT',        'eEoI2:Ltgm,h` |M!)kv]fvErv[}2 1lUc(bM;;JE-pdbN_7t8LN3fn*X>G>BDjj');
define('SECURE_AUTH_SALT', '1]aQ]5xzwB8d%v7eFqK9U1v|C|kt{Z(H-P1)Qm]5a+9+tX_WW<tM4>Da2h!C5MB:');
define('LOGGED_IN_SALT',   'hH0%^+{41N|NvK;t8/eoqG,]5)k~ :-SD[)`]nhV!Z8A>Y-AxCt@&Qb#Oa(]nb!{');
define('NONCE_SALT',       'uVM{Bu{`}^,A@-VMFoekx4wE<qSoBP@OUMJy6bs>1qH,0au~$N=:9e3.EriP&E8a');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'edd_';

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
