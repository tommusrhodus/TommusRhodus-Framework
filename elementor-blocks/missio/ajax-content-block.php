<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Ajax_Content_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-ajax-content-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'AJAX Content', 'tr-framework' );
	}
	
	//Return Block Icon (for blocks list)
	public function get_icon() {
		return 'eicon-carousel';
	}
	
	public function get_categories() {
		return [ 'missio-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'carousel_items_section', [
				'label' => __( 'Gallery Content', 'tr-framework' )
			]
		); 

		$this->add_control(
			'layout', [
				'label'   => __( 'Gallery Layout', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'image-and-title-card',
				'label_block' => true,
				'options' => [
					'text-list'					=> esc_html__( 'Text List', 'tr-framework' ),
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image', [
				'label'      => __( 'Gallery Image', 'tr-framework' ),
				'type'       => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'description', [
				'label'       => __( 'Description', 'tr-framework' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => ''
			]
		);

		$repeater->add_control(
			'overlay_caption', [
				'label'       => __( 'Overlay Caption (Used in applicable layouts)', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'See Gallery'
			]
		);

		$repeater->add_control(
			'item_link', [
				'label' => __( 'Link Image to URL? (Used in applicable layouts)', 'tr-framework' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( '#', 'tr-framework' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$repeater->add_control(
			'item_link_target', [
				'label'   => __( 'Link Behaviour', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '_self',
				'label_block' => true,
				'options' => [
					'_self'			=> esc_html__( 'Open in Current Window', 'tr-framework' ),
					'_blank'		=> esc_html__( 'Open in New Window', 'tr-framework' ),
				],
			]
		);

		$repeater->add_control(
			'item_size', [
				'label'   => __( 'Item Size (Custom Grid Only)', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'col-md-4',
				'label_block' => true,
				'options' => [
					'col-md-6'			=> esc_html__( '6/12', 'tr-framework' ),
					'col-md-4'			=> esc_html__( '4/12', 'tr-framework' ),
					'col-md-3'			=> esc_html__( '3/12', 'tr-framework' ),
				],
			]
		);

		$repeater->add_control(
			'bg_color', [
				'label'   => __( 'Background Colour', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bg-white',
				'label_block' => true,
				'options' => [
					'bg-white'					=> esc_html__( 'White Background', 'tr-framework' ),
					'bg-inverse'				=> esc_html__( 'Dark Background', 'tr-framework' ),
					'bg-pastel-default'			=> esc_html__( 'Pastel Background', 'tr-framework' ),
				],
			]
		);

		$repeater->add_control(
			'item_category', [
				'label'       => __( 'Item Category? (Used for filtering)', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => ''
			]
		);

		$this->add_control(
			'list', [
				'label'   => __( 'Carousel Content', 'tr-framework' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [],
				'title_field' => __( 'Carousel Content', 'tr-framework' ),
			]
		);		

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings = $this->get_settings_for_display();

		if( 'text-list' == $settings['layout'] ) {
		
			echo '<div id="cube-inline" class="cbp cbp-text cbp-inline-bg">';

				foreach( $settings['list'] as $item ) {

					echo '
					<div class="cbp-item">
            			<h3 class="text-uppercase"><a href="'. esc_url( $item['item_link']['url'] ) .'" class="cbp-singlePageInline">'. $item['description'] .'</a></h3>
          			</div>';					

				}

			echo '</div>';

		}
		
	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Ajax_Content_Block() );