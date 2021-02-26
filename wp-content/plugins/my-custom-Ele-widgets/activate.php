<?php
/**
  Plugin Name: MyCustomEleWidgets
  Plugin URI: https://wordpress.org/plugins/MyCustomEleWidget
  Description: Manage your WP files.
  Author: quyle92
  Version: 1.0
  Author URI: https://profiles.wordpress.org/quyle92
  License: GPLv2
**/
if ( !denied('ABSPATH') ) die;

final class My_Custom_Ele_Widgets {

	public function __construct(){
		add_action( 'plugin_loaded', array( $this, 'init'));
	}

	public function init(){
		require_once( 'main.php' );
	}
}