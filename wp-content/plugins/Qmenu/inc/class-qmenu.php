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
		
		add_action( 'wp_ajax_editMenu', array( $this, 'editMenu' ) );
		//if ( isset( $_REQUEST['page'] ) && 'qmenu' == $_REQUEST['page'] || $_REQUEST['action'] == 'editMenu') { 
			add_action ( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ));
		//}

		if ( isset( $_POST['del_option'] )  ) {
			$this->delOption();
		}


		add_action( 'admin_menu', array( $this, 'setShortcodePage' ) );

		add_shortcode('print_qmenu', array( $this, 'render_qmenu_template' ) );
	}



	public function editMenu() {

   		if( ! DOING_AJAX ){
			return $this->return_json( 'error' );
		}
		
		//print_r($_POST);
		$input = $_POST;

		unset($input['option_page'], $input['action'], $input['_wpnonce'], $input['_wp_http_referer'], $input['qmenu-subitems-settings-nonce']);

		$review_insert = $this->cptSanitize($input);//var_dump(get_option('qmenu_options'));
		//send response
		if ( ! $review_insert ){
			return $this->return_json( 'error' );
		}

		return $this->return_json( 'success' );
	}

	public function return_json( $status )
	{
		$response = array(
			'status' => $status,
		);

		wp_send_json( $response );
		wp_die();
	}

	public function render_qmenu_template()
	{
		ob_start();
		echo '<link rel="stylesheet" href="' . QMENU_ASSETS_URL . '/frontend-style.css" >';
		require( QMENU_PATH . 'template/qmenu_template.php');
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

		//wp_deregister_script('jquery');
		//wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
    
		wp_enqueue_media();

		wp_enqueue_script('bootstrap_js', '//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',array('jquery'), null, true);

		wp_enqueue_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
        wp_register_script( 'form-handle', QMENU_ASSETS_URL . 'form-handle.js', array('jquery'), '', true);

        wp_localize_script( 'form-handle', 'jsData',[
	        'ajaxurl' => admin_url('admin-ajax.php')
	    ]);

		wp_enqueue_script( 'form-handle' );

	}

	public function backend() 
	{	
		ob_start();
		echo '<link rel="stylesheet" href="' . QMENU_ASSETS_URL . '/backend-style.css" >';
		// echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';//(2)
		// echo '<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';//(2)
		require_once ('backend.php');
		return ob_get_flush();

	}

	public function registerCustomFields(){

		//register_setting
		$option_group = 'qmenu_option_group';
		$option_name = 'qmenu_options';
		$args = array( 'sanitize_callback' => array( $this, 'cptSanitize') );

		register_setting( $option_group, $option_name, $args );
	}


	public function cptSanitize( $input )
	{	
		
		if( in_array_r('menu_id', $input) ){
			$menu_id = sanitize_text_field(array_shift($input));
			//pr ($menu_id);die;
		}
		//pr ($menu_id);die;
		$input = customizeArray($input);
		//print_r ($input);//die;
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
			$menu_id_arr = [];
			foreach ($options as $k => $v){
			  $menu_id_arr[] = $k;
			}
			//pr($menu_id);
			while( in_array($menu_id, $menu_id_arr) ) $menu_id = generateRandomString();
		}
		//pr ($menu_id);die;
		if ( $output == array() ) 
		{	// add to wp_options the first time
			$output = array(  $menu_id => $input  );
			//var_dump ($output);die;
			return array_filter( $output ) ;
		}
		else{
			foreach ($output as $key => $value){
			 	if( $key == $menu_id )
			 	{// update current value to wp_options
			 		$output[$key] = $input;
			 	} else 
			 	{// add new value to wp_options
			 		$output[ $menu_id ] = $input;
			 	}
			}
			//(3)
			if( ! DOING_AJAX ){
				return array_filter( $output ) ;
			}
			//var_dump ($output);die;
			$update = update_option( 'qmenu_options', $output );
			//var_dump(get_option('qmenu_options'));
			if( $update ) {
			 	return true;
			}
			else {
				return false;
			}
			
			
			
		}			
		
	}

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
//(3): if it is ajax update, then use update_option as "return array_filter( $output )"" only works in api setting circumstance