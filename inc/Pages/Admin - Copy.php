<?php
namespace Inc\Pages;
use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
/*
**
 */
class Admin //extends BaseController
{
	
	public $settings;
	public $pages = array();
	public $subpages = array();
	

	public function __construct() {
		$this->settings = new SettingsApi;
		$this->pages = [
			[
				'page_title' => 'AlecaddPlugin',
				'menu_title' =>	'AlecaddPlugin',
				'capability' =>	'manage_options',
				'menu_slug' =>	'alecadd_plugin',
				'callback' => array($this, 'admin_index'),
				'icon_url' => 'dashicons-media-document',
				'position' =>	110
			],
		];
	
		$alecadd_cpt = function () {echo '<h1 style="text-align:center">alecadd_cpt</h1>';};
		$alecadd_taxonomies = function () {echo '<h1 style="text-align:center">alecadd_taxonomies</h1>';};
		$alecadd_widgets = function () {echo '<h1 style="text-align:center">alecadd_widgets</h1>';};
		$this->subpages = [
			[	
				'parent_slug' => 'AlecaddPlugin',
				'page_title' => 'Custom Post Types',
				'menu_title' =>	'CPT',
				'capability' =>	'manage_options',
				'menu_slug' =>	'alecadd_cpt',
				'callback' => $alecadd_cpt(),
			],
			// [	
			// 	'parent_slug' =>'AlecaddPlugin',
			// 	'page_title' => 'Custom Taxonomies',
			// 	'menu_title' =>	'Taxonomies',
			// 	'capability' =>'manage_options',
			// 	'menu_slug' =>	'alecadd_taxonomies',
			// 	'callback' => $alecadd_taxonomies(),
			// ],
			// [	
			// 	'parent_slug' => 'AlecaddPlugin',
			// 	'page_title' => 'Custome Widgets',
			// 	'menu_title' =>	'Widgets',
			// 	'capability' =>'manage_options',
			// 	'menu_slug' =>	'alecadd_widgets',
			// 	'callback' => $alecadd_widgets(),
			// ],
		];
	}

	public function register()
	{//var_dump( $this->pages );
		
		$this->settings->addPages($this->pages)->withSubpage('Dashboard')->register();

	}


 	public static function admin_index()
 	{	 
 		$base_controller = new BaseController;
    	require_once $base_controller->plugin_path . 'templates/admin.php';
    	
	}
}