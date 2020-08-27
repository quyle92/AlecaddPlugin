<?php
namespace Inc\Base;
use \Inc\Base\BaseController;

if ( !class_exists('SettingsLinks') )
{
	class SettingsLinks extends BaseController
	{

		public  function register(){
			add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
		}

		function settings_link($links){
		    $settings_link = '<a href="admin.php?page=alecadd_plugin">Settings</a>';
		    array_push( $links, $settings_link);
		    return $links;
   		}
	}
}