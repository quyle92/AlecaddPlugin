<?php
namespace Inc;

final class Init 
{	
	/**
	 * Store all classes inside array
	 * @return [array] [full list of classes]
	 */
	public static function get_services () {
		return [
			Pages\Admin::class,
			Base\Enqueue::class,
			Base\SettingsLinks::class,

		];
	}

	/**
	 * 	Loop thru classes, instantiate them and 
	 * 	call register() method if exists
	 * 	@return 
	 */

	public static function register_services ()	{
		foreach (self::get_services() as $class)
			{
				$service = self::instantiate($class);
				if (method_exists($service, 'register')){
					$service->register();
				}
			}

	}

	/**
	 * Instantiate class
	 * @param class $class 
	 * @return class instance
	 */

	public static function instantiate($class){
		return new $class;
	}
}

// use Inc\Base\Activate; 
// use Inc\Base\Deactivate;
// use Inc\Pages\Admin;

//  class AlecaddPlugin
//  {

//   private $plugin;

//  	function __construct(){
//  		$this->plugin = plugin_basename( __FILE__ );
//  	}

//  	function register(){
// 		add_action( 'admin_enqueue_scripts', array($this, 'enqueue') );

// 		add_action( 'init' , array($this, 'custom_post_type'));

//     add_action( 'admin_menu', array($this, 'add_admin_page'));

//     add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
//  	}

//   function settings_link($links){
//     $settings_link = '<a href="admin.php?page=alecadd_plugin">Settings</a>';
//     array_push( $links, $settings_link);
//     return $links;
//   }

//   function add_admin_page(){
//     add_menu_page( 'AlecaddPlugin', 'AlecaddPlugin', 'manage_options', 'alecadd_plugin', array($this, 'admin_index'), 'dashicons-media-document', 110 );
//   }

//   function admin_index(){
//     require_once plugin_dir_path ( __FILE__ ) . 'templates/admin.php';
//   }

//  	function get_custom_post_type() {
//  		add_action( 'init' , array($this, 'custom_post_type'));
//  	}


//  	function custom_post_type(){
//  		register_post_type( 'book' , ['public' => true, 'label' => 'Books']);
//  	}

//  	function enqueue(){
//  		wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/mystyle.css', __FILE__ ));
//  		wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/myscript.js', __FILE__ ));
//  	}

//  	function activate(){
//  	 		//require_once plugin_dir_path ( __FILE__ ) . 'inc/alecadd-plugin-activate.php';
//       Activate::activate();
//  	}
//  }

//  if ( class_exists( 'AlecaddPlugin')) {
//  	$alecaddPlugin  = new AlecaddPlugin();
//  	$alecaddPlugin->get_custom_post_type();
//  	$alecaddPlugin->register();
//  }

//  //activation
//  register_activation_hook( __FILE__ , array($alecaddPlugin , 'activate'));

//  //deactivation
//  //require_once plugin_dir_path( __FILE__ ) . 'inc/alecadd-plugin-deactivate.php';
//  register_deactivation_hook( __FILE__ , array('Deactivate' , 'deactivate'));