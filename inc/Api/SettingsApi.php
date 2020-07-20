<?php
namespace Inc\Api;
use \Inc\Pages\Admin;

class SettingsApi {

	 public $admin_pages = array();
	 public $admin_subpages = array();
	 public $settings = array();
	 public $sections = array();
	 public $fields = array();


	 public function register() {
	 	if ($this->admin_pages != null){
	 		add_action ('admin_menu' , array($this, 'addAdminMenu'));
	 	}

	 	if ($this->settings != null || $this->sections != null || $this->fields != null){
	 		add_action ('admin_init', array($this, 'registerCustomFields'));
	 	}
	 }

	 public function addPages (array $pages){
	 
	 	$this->admin_pages = $pages;
	 	return $this;
	 }

	 public function withSubpage (string $title = null){
	 	if( $this->admin_pages == null){
	 		return $this;
		}

	 	$admin_page = $this->admin_pages[0];
	 	$alecadd_cpt = function () {echo '<h1 style="text-align:center">alecadd_cpt</h1>';};
		$alecadd_taxonomies = function () {echo '<h1 style="text-align:center">alecadd_taxonomies</h1>';};
		$alecadd_widgets = function () {echo '<h1 style="text-align:center">alecadd_widgets</h1>';};
	 	$subpage = array(
	 		[
	 			'parent_slug' => $admin_page['menu_slug'] ,
	 			'page_title' => ' Dashboard',
	 			'menu_title' => $title,
	 			'capability' => 'manage_options',
	 			'menu_slug' =>  $admin_page['menu_slug'] ,
	 			'callback' =>  $admin_page['callback'] 
	 		],
	 	);

	 	$this->admin_subpages = $subpage;

	 	return $this;	
	 }

	 public function addSubPages( array $pages){
	 	
	 	$this->admin_subpages = array_merge($this->admin_subpages, $pages);

	 	return $this;

	 }

	
	public function addAdminMenu() {
	 	foreach ($this->admin_pages as $page){
	 		add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'] , $page['icon_url'], $page['position']);
	 	}
	 	
	 	foreach ($this->admin_subpages as $page){
	 		add_submenu_page( $page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'] );
	 	}
	 }

	public function setSettings ( array $settings) {
	 	
	 	$this->settings = $settings;

	 	return $this;
	 }

	public function setSections ( array $sections) {
	 	
	 	$this->sections = $sections;

	 	return $this;
	 }

	public function setFields ( array $fields) {
	 	
	 	$this->fields = $fields;

	 	return $this;
	 }

	public function registerCustomFields()
	 {
	 	// register setting
	 	foreach ($this->settings as $setting)
	 	{
	 		register_setting( $setting["option_group"], $setting["option_name"], empty($setting["callback"])? $setting["callback"] : "");
	 	}

	 	//add settings section
	 	foreach ($this->sections as $section)
	 		add_settings_section( $section["id"], $section["title"], $section["callback"] ? $section["callback"] : "" , $section["page"] );
	 	
	 	
	 	//add settings fields
	 	foreach ($this->fields as $field)
	 	{
	 		add_settings_field( $field["id"], $field["title"], $field["callback"] ? $field["callback"] : "" , $field["page"], $field["section"], $field["args"] ? $field["args"] : "");
	 	}
	 }
}