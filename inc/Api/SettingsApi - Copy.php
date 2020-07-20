<?php
namespace Inc\Api;
use \Inc\Pages\Admin;

class SettingsApi {

	 public $admin_pages = array();
	 public $admin_subpages = array();


	 public function register() {
	 	if ($this->admin_pages != null){
	 		add_action ('admin_menu' , array($this, 'addAdminMenu'));
	 	}
	 }

	 public function addPages (array $pages){
	 
	 	$this->admin_pages = $pages;
	 	return $this;
	 }

	public function withSubpage(string $title = null){
		if (empty($this->admin_pages)){
			return $this;
		}
		
		$dashboard_view = function () {echo '<h1 style="text-align:center">Dashboard View</h1>';};
		$admin_page = $this->admin_pages[0];
		$subpage = [
			[	
				'parent_slug' => $admin_page['menu_slug'],
				'page_title' => $admin_page['page_title'],
				'menu_title' =>	($title) ? $title : $admin_page['menu_title'],
				'capability' =>	$admin_page['capability'],
				'menu_slug' =>	$admin_page['menu_slug'],
				'callback' => Admin::admin_index(),
			],
		];

		$this->admin_subpages = $subpage;
		return $this;

	}

	// public function addSubPages(array $subpages) {
	// 	$this->admin_subpages = array_merge($this->admin_subpages, $subpages);
	// 	return $this;
	// }

	public function addAdminMenu() {
	 	foreach ($this->admin_pages as $page){
	 		add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'] , $page['icon_url'], $page['position']);
	 	}
	 	var_dump($this->admin_subpages);
	 	foreach ($this->admin_subpages as $subpage){
	 		add_submenu_page( $subpage['parent_slug'], $subpage['page_title'], $subpage['menu_title'], $subpage['capability'], $subpage['menu_slug'], $subpage['callback'] );
	 	}
	 }
}