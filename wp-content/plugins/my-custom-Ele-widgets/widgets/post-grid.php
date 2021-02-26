<?php
namespace MyCustomEleWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; 

class Post_Grid extends Widget_Base {

	public function get_name() {
		return 'elementor-blog-post';
	}

	public function get_title() {
		return __( 'Post Grid', 'elementor' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'Q_Widgets_Collection' ];
	}

	protected function _register_controls() {
		$this->content_layout_options();
	}

	private function content_layout_options() {

		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Layout', 'elementor' )
			]
		);

		$this->add_control(
			'grid_style',
			[
				'label' => __( 'Border Style', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1'  => __( 'Layout 1', 'elementor' ),
				],
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => __( 'Columns', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'desktop_default' => '1',
				'default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options' => [
					'1'  => '1',
					'2'  => '2',
					'3'  => '3',
					'4'  => '4'
				],
			]
		);
	}
}