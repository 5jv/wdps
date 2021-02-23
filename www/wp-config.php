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
define( 'DB_NAME', '' );

/** MySQL database username */
define( 'DB_USER', '' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', '' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'TAL7KtPBUIq6N7yvWb2WmBTvflsyHbGhdTUnio+HhxbY0SGdx6h1/MR5se1Ce7yAQ/XmYQLac9nJ2Uct2x4FAw==');
define('SECURE_AUTH_KEY',  'toapnar7wXQQOS5+rBwHXeDosDTlj23R5eYe5L2NqjSoGy+mPyAC32c61tYDwEA+5lmVtWXlXDPnTDZI5X1xfw==');
define('LOGGED_IN_KEY',    'gigVe0RHN4xC+MOajyyaNZWuLOmWyWCnYNnFzNFLeYMZtwtd/6/6b2e34raFG33FsV3dJqXEvNsr7H+qEoWRqw==');
define('NONCE_KEY',        'mvd2Cz0IzK7hF8acf2nGAk2igq3z8PHRFwUPNkucYdziMtQFOwOxwlhaweGzxGo+3joybsN2+CJMv1kOrPjo9A==');
define('AUTH_SALT',        '1EHs8N7DDgfkoezfSHZgC2wwdbNP3k8ZUpEUsRh+jOR+phExXiCVsNfG2rb7TeWsz37sBV3vwwB9wyz4M5BDeA==');
define('SECURE_AUTH_SALT', 'fGu6ZGF0knEbBPLiQnGS2DT/8kfJK00Cfx1ipSmbvrIkWBGUUY9e+w5/nISFOJRwZ9I6OHWVwpAoMPgsn2QNKg==');
define('LOGGED_IN_SALT',   'Hlhae4jn7edbkP7FC0AOxHbqk/bfB60gLul6lI5845i+7pOfcGLigMGudZBjLFe0N6ZU3odjWkZMT1xCLMlXvA==');
define('NONCE_SALT',       '/05RDzWBCDgsOWVlBHllRLDIaS0AXpXresArfx5OSctz1MSe1q3yii4XgH2BM8ZfccZ1kmW5bSMBoCcVBjzi1w==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
