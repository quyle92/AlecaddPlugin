<?php
namespace MyCustomEleWidgets;

class My_Widgets_Init()
{
	private static $_instance = null;

	public static function get_instance() {
		if (self::$_instance === null) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function widget_styles(){
		wp_register_style( 'my-custom-ele-widgets-style' , plugins_url( '/assets/css/style.css') );
		wp_enqueue_style( 'my-custom-ele-widgets-style' );
	}

	private function load_widgets_files(){
		require_once( __DIR__ . '/widgets/post-grid.php' );
	}

	public function register_widgets(){
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Post_Grid() );
	}

	public function register_widget_category( $elements_manager ){
		$elements_manager->add_category(
			'Q_Widgets_Collection',
			[
				'title' => __( 'First Category', 'q-widgets-collection' ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	public function __construct() {

		$this->load_widgets_files();

		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		add_action( 'elementor/elements/categories_registered', [ $this, 'register_widget_category' ] );
	}
}

My_Widgets_Init::get_instance();