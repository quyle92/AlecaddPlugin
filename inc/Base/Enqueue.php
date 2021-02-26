<?php
namespace Inc\Base;
use \Inc\Base\BaseController;

if ( !class_exists('Enqueue') )
{
	class Enqueue extends BaseController

	{
		public function register(){
			add_action( 'admin_enqueue_scripts', array($this, 'enqueue') );
		}

		function enqueue(){

			/*this WP built-in script is for media upload purpose (Part 37)*/
			wp_enqueue_script( 'media-upload');
			wp_enqueue_media();
			/*End this WP built-in script is for media upload purpose*/

	 		wp_enqueue_style( 'mypluginstyle', $this->plugin_url  . 'assets/mystyle.css');
	 		wp_enqueue_script( 'mypluginscript', $this->plugin_url  . 'assets/myscript.js');
 		}
	}
}
