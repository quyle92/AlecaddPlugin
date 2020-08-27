<?php
namespace Inc\Pages;
use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;
use \Inc\Api\Callbacks\AdminCallbacks;
/*
**
 */
class Admin extends BaseController
{
	
	public $settings;
	public $pages = array();
	public $subpages = array();
	public $callback;
		
	public function register()
	{
		$this->settings = new SettingsApi;

		$this->callback = new AdminCallbacks;

		$this->setPages();

		$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages($this->pages)->withSubpage('Dashboard')->addSubpages($this->subpages)->register();
	}

	public function setPages()
	{
			$this->pages = [
			[
				'page_title' => 'AlecaddPlugin',
				'menu_title' =>	'AlecaddPlugin',
				'capability' =>	'manage_options',
				'menu_slug' =>	'alecadd_plugin',
				'callback' => array( $this->callback , 'adminDashboard' ),
				'icon_url' => 'dashicons-media-document',
				'position' =>	110
			],
		];
	}

	public function setSubpages()
	{
		$this->subpages = array(
	 		[
	 			'parent_slug' => 'alecadd_plugin'  ,
	 			'page_title' => ' CPT',
	 			'menu_title' => 'CPT ',
	 			'capability' => 'manage_options',
	 			'menu_slug' => 'cpt',
	 			'callback' => array( $this->callback , 'adminCpt' ),
	 			
	 		],
			[	
				'parent_slug' => 'alecadd_plugin'  ,
				'page_title' => 'Custom Taxonomies',
				'menu_title' =>	'Taxonomies',
				'capability' =>'manage_options',
				'menu_slug' =>	'alecadd_taxonomies',
				'callback' => array( $this->callback , 'adminTaxonomy' ),
			],
			[	
				'parent_slug' => 'alecadd_plugin' ,
				'page_title' => 'Custome Widgets',
				'menu_title' =>	'Widgets',
				'capability' =>'manage_options',
				'menu_slug' =>	'alecadd_widgets',
				'callback' => array( $this->callback , 'adminWidget' ),
			],
		);
	}

 	public static function admin_index()
 	{	 
 		parent::__construct();
    	require_once $this->plugin_path . 'templates/admin.php';
    }

    public function setSettings() 
    {
    	$args = array(
    		[
    			'option_group' => 'alecadd_options_group',
    			'option_name' => 'text_example', //will be used at id of the custom field
    			'callback' => array( $this->callback, 'alecaddOptionsGroup')
    		],
    		[
    			'option_group' => 'alecadd_options_group',
    			'option_name' => 'first_name', //will be used at id of the custom field
    			'callback' => array( $this->callback, 'alecaddOptionsGroup')
    		]
    	);

    	$this->settings->setSettings( $args );
    }

    public function setSections() 
    {
    	$args = array(
    		[
    			'id' => 'alecadd_admin_index', //will be used at section in setFields()
    			'title' => 'Settings', 
    			'callback' => array( $this->callback, 'alecaddAdminSection'),//print to the section
    			'page' => 'alecadd_plugin' //the page where the content from above callback is printed
    		]
    	);

    	$this->settings->setSections( $args );
    }

    public function setFields() 
    {
    	$args = array(
    		[
    			'id' => 'text_example', 
    			'title' => 'Text Example', 
    			'callback' => array( $this->callback, 'alecaddTextExample'),
    			'page' => 'alecadd_plugin', //the page where the content from above callback is printed
    			'section' => 'alecadd_admin_index', //same as id in setSections()
    			'args' => array(
    				'label_for' => 'text_example',
    				'class' => 'example_class'
    			)

    		],
    		[
    			'id' => 'first_name', 
    			'title' => 'First Name', 
    			'callback' => array( $this->callback, 'alecaddFirstName'),
    			'page' => 'alecadd_plugin', //the page where the content from above callback is printed
    			'section' => 'alecadd_admin_index', //same as id in setSections()
    			'args' => array(
    				'label_for' => 'first_name',
    				'class' => 'example_class'
    			)

    		]
    	);
    	$this->settings->setFields ( $args );

    }
}