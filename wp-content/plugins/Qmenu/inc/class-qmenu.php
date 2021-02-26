<?php
final class QMENU {

	protected static $instance = null;

	public static function instance() {

		if (self::$instance == null){
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'init_hooks') );
		$this->includeFile();
		$this->setDefaultOptions();
	}

	public function setDefaultOptions(){
		$default = array();

		if ( ! get_option( 'qmenu_options' ) ) {
			update_option( 'qmenu_options', $default );
		}
	}

	public function includeFile() {
		include_once(__DIR__ . '/../helper/custom-function.php');
	}

	public function init_hooks() {

		add_action ('admin_menu', array( $this, 'menu') );
		

		if ( isset( $_REQUEST['page'] ) && 'qmenu' == $_REQUEST['page'] ) { 
			add_action ( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ));
		}

		if ( isset( $_POST['del_option'] )  ) {
			$this->delOption();
		}

		add_action ('admin_init', array($this, 'registerCustomFields'));
		add_action( 'admin_menu', array( $this, 'setShortcodePage' ) );

		add_shortcode('print_qmenu', array( $this, 'render_qmenu_template' ) );
	}

	public function render_qmenu_template()
	{
		ob_start();
		echo '<link rel="stylesheet" href="' . QMENU_ASSETS_URL . '/frontend-style.css" >';
		require_once( QMENU_PATH . 'template/qmenu_template.php');
		return ob_get_clean();
	}

	public function menu() {
		if ( current_user_can( 'manage_options' ) )
		{
			$title = esc_html( 'QMenu' );
			$cap = 'manage_options';
			$slug = 'qmenu';
			$callback = array( $this, 'backend' );
			$icon = QMENU_ASSETS_URL . 'images/mega-menu1.png';
			$position = 300;

			add_menu_page( $title, $title, $cap, $slug, $callback, $icon, $position );
		}
	}

	public function setShortcodePage()
	{
		add_submenu_page(
		    'qmenu', //(1)
		    __( 'Shortcodes', 'qmenu' ),
		    __( 'Shortcodes', 'qmenu' ),
		    'manage_options',
		    'qmenu_shortcode',
		    'render_qmenu_shortcode_page'
		);

		function render_qmenu_shortcode_page() 
		{	
			return require_once( __DIR__ .'/../template/shortcode.php' );
	    }
	}

	

	public function admin_enqueue_scripts(){
		wp_enqueue_media();
		//wp_enqueue_style( 'backend_style', QMENU_ASSETS_URL . '/backend-style.css', array(), QMENU_ASSETS_URL);
		//wp_deregister_script('jquery');

		wp_enqueue_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
        
        
	}

	public function backend() 
	{	
		ob_start();
		echo '<link rel="stylesheet" href="' . QMENU_ASSETS_URL . '/backend-style.css" >';
		echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';//(2)
		echo '<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';//(2)
		require_once ('backend.php');
		ob_get_flush();

	}


	public function setFields() 
    {	
    	$args = array();
    	$args = array(
        		[
        			'id' => 'menu_item', 
        			'title' => 'Item', 
        			'callback' => array( $this, 'textFieldItem'),
        			'page' => 'qmenu', //the page where the content from above callback is printed
        			'section' => 'add-edit-subitems', //same as id in setSections()
        			'args' => array(
                        'option_name' => 'qmenu_options',//option name MUST be the same throughtout this $args, else it will return NULL in "sanitize_callback" of register_setting()
        				'label_for' => 'menu_item',
        				//'placeholder' => 'eg. product'
        			)
        		],
        		[
        			'id' => 'menu_subitem', 
        			'title' => 'Subitem', 
        			'callback' => array( $this, 'textFieldSubitem'),
        			'page' => 'qmenu', //the page where the content from above callback is printed
        			'section' => 'add-edit-subitems', //same as id in setSections()
        			'args' => array(
                        'option_name' => 'qmenu_options',//option name MUST be the same throughtout this $args, else it will return NULL in 
        				'label_for' => 'menu_subitem',
        				//'placeholder' => 'eg. Product'
        			)
        		],
        );

        return $args;
    }


	public function textFieldItem ( $args )
	{
		$option_name = $args['option_name'];
		$name = $args['label_for'];
		$value = "";
		$id_item = stripSpecial( stripUnicode( $_POST['edit_menu'] ) );

		if( isset($_POST['edit_menu']) )
		{
			$value = get_option( 'qmenu_options')[$id_item][$name];

			
		}

		echo '<input type="text" class="regular-text" id="'. $name. '" name="'. $option_name .'[' . $name . ']"  value="'. $value .'" 
			/>';

		
	}

	public function textFieldSubitem( $args )
	{
		$option_name = $args['option_name'];
		$name = $args['label_for'];
		
		$id_item = stripSpecial( stripUnicode( $_POST['edit_menu'] ) );

		if( isset($_POST['edit_menu']) ){
			$menu_subitems =  get_option( 'qmenu_options' )[$id_item][$name];
			foreach ( $menu_subitems as $subitem )
			{
			echo '<input type="text" class="regular-text" id="'. $name. '" name="'. $option_name .'[' . $name . ']"  value="'. $subitem .'" 
				/>';
			}
		}
		
		echo '<input type="text" class="regular-text" id="'. $name. '" name="'. $option_name .'[' . $name . ']"  value="" 
			/>'; 
	
	}


	public function registerCustomFields(){

		//register_setting
		$option_group = 'qmenu_option_group';
		$option_name = 'qmenu_options';
		$args = array( 'sanitize_callback' => array( $this, 'cptSanitize') );

		register_setting( $option_group, $option_name, $args );


		//add_settings_section
		// $id = 'add-subitems';
		// $title = 'Add Subitems';
		// $callback = array( $this, 'setting_section_callback_function_Add');
		// $page = 'qmenu';



	}
	

	public function cptSanitize( $input )
	{	
		// pr ($input);die;
		if( in_array_r('menu_id', $input) ){
			$menu_id = sanitize_text_field(array_shift($input));
			//pr ($menu_id);die;
		}
		//pr ($input);die;
		$input = customizeArray($input);
		
		$output = get_option('qmenu_options');

		if( isset($_POST['del_menu']) ){
			unset( $output[$_POST['del_menu']] );
			return array_filter( $output ) ;
		}

		//$menu_id = stripSpecial( stripUnicode( $input['menu_item'] ) );
		if( ! isset($menu_id) )
		{
			$menu_id = generateRandomString();
			$options = get_option('qmenu_options');
			$menu_id = [];
			foreach ($options as $k => $v){
			  $menu_id[] = $k;
			}
			//pr($menu_id);
			while( in_array($menu_id, $menu_id) ) $menu_id = generateRandomString();
		}

		if ( $output == array() ) 
		{
			$output = array(  $menu_id => $input  );
			//var_dump ($output);die;
			return array_filter( $output ) ;
		}
		else{
			foreach ($output as $key => $value){//var_dump ($key);var_dump ($menu_id);die;($input['post_type']);die;
			 	if( $key == $menu_id )
			 	{//var_dump ($menu_id);die;
			 		$output[$key] = $input;
			 	} else 
			 	{
			 		$output[ $menu_id ] = $input;
			 	}
			}
			return array_filter( $output ) ;
		}			
		
	}

	public function save()
	{	
		if ( ! isset( $_POST['qmenu-subitems-settings-nonce'] ) || ! wp_verify_nonce( $_POST['qmenu-subitems-settings-nonce'], 'qmenu-subitems-settings' ) ) 
		{	
			return;
		}
		//var_dump($input);die;
		$output = get_option('qmenu_options');
		$menu_item = stripSpecial( stripUnicode($_POST['menu_item']) );
		$menu_subitems = $_POST['menu_subitem'];
		//var_dump ($menu_subitems);echo"<hr>";die;
		if ( $output == array() ) 
		{
			$output = array(  $menu_item => array(
				"menu_item" => $_POST['menu_item'],
				"menu_subitems" => $menu_subitems
			)  );
			//var_dump ($output);die;
			update_option('qmenu_options', $output);
		}
		else{
			foreach ($output as $key => $value){//var_dump ($key);var_dump ($input);var_dump ($input['post_type']);die;
			 	if( $key == $menu_item )
			 	{//var_dump ($output[$key]);var_dump ($new_input[$key]);
			 		$output[$key] = array(
						"menu_item" => $_POST['menu_item'],
						"menu_subitems" => $menu_subitems
					);
			 	} else 
			 	{
			 		$output[ $menu_item ] = array(
						"menu_item" => $_POST['menu_item'],
						"menu_subitems" => $menu_subitems
					);
			 	}
			}
			update_option('qmenu_options', $output);
		}

			
		
	}

	// public function setting_section_callback_function_Add( $arg )
	// {
	// 	echo '<p>Title: ' . $arg['title'] . '</p>';
	// }

	public function delOption(){
		delete_option( 'qmenu_options' );
		delete_option( 'qmenu_options' );
	}


	//check if all values in multidimensional array are empty
	function emptyArray($array) 
	{

	  $empty = TRUE;

	  if ( is_array($array) ) {
	    foreach ( $array as $value ) {
	      if ( !empty($value) ) {
	        $empty = FALSE;
	      }
	    }
	  }
	  elseif ( !empty($array) ) {
	    $empty = FALSE;
	  }

	  return $empty;
	}


	
}

/**
 * Note
 */
//add_settings_field only use when there is a need to create fields using add_settings_field, if you create fields yourself then no need.
//(1)parent là qmenu, ko phải admin.php?page=qmenu vì: ref: https://developer.wordpress.org/reference/functions/add_submenu_page/?replytocom=1404#feedback-editor-1404 . You can refer to CustomPostTypeController.php at AlecaddPlugin
//(2): phải để đó, chứ enqueue thì nó chạy ko đúng lúc làm deep linking cho tab boostrap 