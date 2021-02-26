<?php
class My_Elementor_Widget{

	protected static $instance = null;

	public static function get_instance(){
		if ( !isset(static::$instance) ){
			static::$instance = new static;
		}

		return static::$instance;
	}

	private function load_widgets_files(){
		require_once( __DIR__ . '/widget1.php' );
		require_once( __DIR__ . '/Testimonial_Slider.php' );

	}

	public function register_widgets(){
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\My_Widget_1());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Essential_Addons_Elementor\Pro\Elements\Testimonial_Slider());
	}

	// Register Widget Styles

	public function widget_styles() {
 		wp_enqueue_style( 'testimonial-slider-stylesheet',  get_template_directory_uri() . '/custom-widgets/assets/css/testimonial-slider.css' );
 		wp_enqueue_script( 'testimonial-slider-script', get_template_directory_uri() . '/custom-widgets/assets/js/testimonial-slider.js', array( 'jquery' ), '1.0.0', true );
	}

	public function __construct(){
		
		$this->load_widgets_files();
		
		add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
	}
	
}

function my_elementor_widget(){
	My_Elementor_Widget::get_instance();
}
add_action('init', 'my_elementor_widget');

