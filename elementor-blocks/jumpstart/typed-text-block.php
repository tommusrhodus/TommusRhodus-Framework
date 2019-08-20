<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Typed_Text_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-typed-text-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Typed Text', 'tr-framework' );
	}
	
	//Return Block Icon (for blocks list)
	public function get_icon() {
		return 'eicon-type-tool';
	}
	
	public function get_categories() {
		return [ 'jumpstart-elements' ];
	}

	/**
	 * Whether the reload preview is required or not.
	 *
	 * Used to determine whether the reload preview is required.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return bool Whether the reload preview is required.
	 */
	public function is_reload_preview_required() {
		return true;
	}

	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_my_custom', [
				'label' => esc_html__( 'Content', 'tr-framework' ),
			]
		);

		$this->add_control(
			'layout', [
				'label'   => __( 'Countdown Style', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'basic',
				'label_block' => true,
				'options' => [
					'basic'          		=> esc_html__( 'Basic', 'tr-framework' ),
					'fade'         			=> esc_html__( 'Fade', 'tr-framework' ),
				],
			]
		);

		$this->add_control(
			'heading_size', [
				'label'   => __( 'Heading Size', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'basic',
				'label_block' => true,
				'options' => [
					'h1'          			=> esc_html__( 'H1', 'tr-framework' ),
					'h2'	       			=> esc_html__( 'H2', 'tr-framework' ),
					'h3'	       			=> esc_html__( 'H3', 'tr-framework' ),
					'h4'	       			=> esc_html__( 'H4', 'tr-framework' ),
					'h5'	       			=> esc_html__( 'H5', 'tr-framework' ),
					'h6'	       			=> esc_html__( 'H6', 'tr-framework' ),
				],
			]
		);

		$this->add_control(
			'prefix', [
				'label'       => __( 'Prefix Text', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Use Uptime To',
				'label_block' => true
			]
		);	

		$this->end_controls_section();

		$this->start_controls_section(
			'typed_text_items_section', [
				'label' => __( 'Typed Text Item', 'tr-framework' )
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_text', [
				'label'       => __( 'Typed Text', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'launch your product.',
				'label_block' => true
			]
		);

		$this->add_control(
			'list', [
				'label'   => __( 'Typed Text Content', 'tr-framework' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [],
				'title_field' => __( 'launch your product.', 'tr-framework' ),
			]
		);		

		$this->end_controls_section();

	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Typed_Text_Block() );