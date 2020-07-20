<?php
/**
  Plugin Name: AlecaddPlugin
  Plugin URI: https://wordpress.org/plugins/AlecaddPlugin-quyle92
  Description: Manage your WP files.
  Author: quyle92
  Vers	ion: 1.0
  Author URI: https://profiles.wordpress.org/quyle92
  License: GPLv2
 **/
  //cách 1
if (!defined ('ABSPATH')) {
	die;
}
//cách 2: defined ('ABSPATH') or die('Go way!');
if ( file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
  require_once dirname(__FILE__) . '/vendor/autoload.php';
}

if ( ! function_exists('add_action')) {
	echo "Stop! Don't try to break into my site!";
	exit;
}

//define('PLUGIN_PATH' , plugin_dir_path( __FILE__ ));
//define('PLUGIN_URL' , plugin_dir_url( __FILE__ ));
//define('PLUGIN' , plugin_basename( __FILE__ ));

function activate_alecadd_plugin(){
  Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__ , 'activate_alecadd_plugin');

function deactivate_alecadd_plugin(){
  Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__ , 'deactivate_alecadd_plugin');


if ( class_exists('Inc\\Init') ) {
    Inc\Init::register_services();
}

