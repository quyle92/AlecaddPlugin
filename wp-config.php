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

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */


// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'alecadd-plugin' );


/** MySQL database username */

define( 'DB_USER', 'root' );


/** MySQL database password */

define( 'DB_PASSWORD', '' );


/** MySQL hostname */

define( 'DB_HOST', 'localhost' );


/** Database Charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8mb4' );


/** The Database Collate type. Don't change this if in doubt. */

define( 'DB_COLLATE', '' );


/**#@+

 * Authentication Unique Keys and Salts.

 *

 * Change these to different unique phrases!

 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}

 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define( 'AUTH_KEY',         'uhc@X(+MmcI`Ida%cs6Rf)ElteWbLZ;5oC),-;&X7G7||Q~@Kb&?^gwM$k. dVMS' );

define( 'SECURE_AUTH_KEY',  '#I}N;*7g0YB#Huo1<[GPE_1@ K1mYFGB(I!kk{!xl0=45}5&WAK2)/f9X%fF:I},' );

define( 'LOGGED_IN_KEY',    'CXH=~&P@gS~f7AweZj)X+Ib2(!ap,Hmss=lx}J[owMMJ|~w:@[ =L%F;[!#=G]E[' );

define( 'NONCE_KEY',        '8% ]|!W=@]dgR^H`DEI8l+l~crcSVGsQ3Vr|;dm0GkZ[8f2P*Qo8$=[f+hS)$!Jy' );

define( 'AUTH_SALT',        'C~!_GQVZ!BhvMjN#1A6oD9aQwVU8d^H!l,>NJsI&DW,V62zG~rD3q<AEphURWx98' );

define( 'SECURE_AUTH_SALT', 's!hzcWnNqK@<Q?#cEv9jA4!n*x%X^k~M-$o:!ll,>~_cv/OE}ruB%#-tvw#mhLk-' );

define( 'LOGGED_IN_SALT',   'v*2`Fm2xg&o%|k4~C|ZXP@0TLUoID~*/S`PkZY!3/`IQEn?6DO]Q{jRY,6g?CW<J' );

define( 'NONCE_SALT',       'c)]eT).o.kq.=0 ,=[o[O.QD(+Rqrk|:$(pTyyj,5_k8bIxT9K|qz+gu10)M`3Ko' );


/**#@-*/


/**

 * WordPress Database Table prefix.

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

define( 'WP_DEBUG_LOG', true );

define( 'WP_DEBUG', true );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

