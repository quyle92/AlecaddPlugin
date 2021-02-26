<?php
/**
 * Plugin Name: Qmenu
 * Description: Qmenu.
 * Version: 1.0.0
 */
if (! defined( 'ABSPATH' )) die;

define( 'QMENU_VERSION', '1.0.0' );
define( 'QMENU_FILE', __FILE__ );
define( 'QMENU_NAME', basename(QMENU_FILE) );
define( 'QMENU_BASE_NAME', plugin_basename( QMENU_FILE ));
define( 'QMENU_PATH' , plugin_dir_path( QMENU_FILE ));
define( 'QMENU_URL', plugin_dir_url( QMENU_FILE ));
define( 'QMENU_ASSETS_URL', QMENU_URL . 'assets/' );

require_once QMENU_PATH . '/inc/class-qmenu.php';
QMENU::instance();