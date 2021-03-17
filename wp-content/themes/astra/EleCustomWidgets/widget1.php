<?php
namespace Elementor;

class My_Widget_1 extends Widget_Base {

	public function get_name() {
		return 'title-subtitle';
	}

	public function get_title() {
		return 'title & subtitle';
	}

	public function get_icon() {
		return 'fa fa-font';
	}

	public function get_categories() {
		return ['basic'];
	}

	protected function _register_controls()
	{
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'elementor' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Your Title', 'elementor' )
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => __( 'Subtitle', 'elementor' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Your Subtitle', 'elementor' )
			]
		);

	
		$this->end_controls_section();

		//  Title Option start
        $this->start_controls_section(
            'title_setting',
            [
                'label' => esc_html__( 'Title Setting', 'elementor' ),
                'condition' => [
                    'title!' => '',
                ]
            ]
        );

        $this->add_control(
                'link',
                [
                    'label' => __( 'Link', 'elementor' ),
                    'type' => Controls_Manager::URL,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'https://your-link.com', 'elementor' ),
                    'default' => [
                        'url' => '',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section(); 

        //  SubTitle Option start
        $this->start_controls_section(
            'subtitle_setting',
            [
                'label' => esc_html__( 'Subtitle Setting', 'elementor' ),
                'condition' => [
                    'subtitle!' => '',
                ]
            ]
        );

        $this->add_control(
                'sublink',
                [
                    'label' => __( 'Link', 'elementor' ),
                    'type' => Controls_Manager::URL,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'placeholder' => __( 'https://your-link.com', 'elementor' ),
                    'default' => [
                        'url' => '',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section(); 
	}

	protected function render(){

		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'section_title' );
		//$this->add_inline_editing_attributes( 'subtitle' );
		$url = $settings['link']['url'];
		$sub_url = $settings['sublink']['url'];
		echo "<a href='{$url}'><div class='title'>{$settings['title']}</div></a>
		<a href='{$sub_url}'><div class='title'>{$settings['subtitle']}</div></a>";
	}
}