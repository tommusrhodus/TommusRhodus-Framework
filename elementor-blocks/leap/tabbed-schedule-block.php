<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Tabbed_Schedule_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-tabbed-schedule-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Tabbed Schedule', 'tr-framework' );
	}
	
	//Return Block Icon (for blocks list)
	public function get_icon() {
		return 'eicon-type-tool';
	}
	
	public function get_categories() {
		return [ 'leap-elements' ];
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
			'schedule_item_section', [
				'label' => __( 'Schedule Item', 'tr-framework' )
			]
		);

		$this->add_control(
			'workshop_title', [
				'label'       => __( 'Workshop Column Title', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Workshop',
				'label_block' => true
			]
		);

		$this->add_control(
			'time_title', [
				'label'       => __( 'Time Column Title', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Time',
				'label_block' => true
			]
		);

		$this->add_control(
			'presenter_title', [
				'label'       => __( 'Presenter Column Title', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Presenter',
				'label_block' => true
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title', [
				'label'       => __( 'Day/Tab Title', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true
			]
		);

		$repeater->add_control(
			'title', [
				'label'       => __( 'Event Title', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true
			]
		);

		$repeater->add_control(
			'time', [
				'label'       => __( 'Event Time', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true
			]
		);

		$repeater->add_control(
			'author_name', [
				'label'       => __( 'Author Name', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true
			]
		);

		$repeater->add_control(
			'author_image', [
				'label'      => __( 'Author Image', 'tr-framework' ),
				'type'       => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'url', [
				'label'         => esc_html__( 'Item URL', 'tr-framework' ),
				'type'          => Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);

		$this->add_control(
			'list', [
				'label'   => __( 'Schedule Item Content', 'tr-framework' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [],
				'title_field' => __( '', 'tr-framework' ),
			]
		);		

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings                = $this->get_settings_for_display();
		$user_selected_animation = (bool) $settings['_animation'];
		
		echo '
			<div class="row no-gutters d-none d-md-flex bg-white py-3">
				<div class="col-xl-7 col-md-6">
					<span class="h6 mb-0 text-muted">'. $settings['workshop_title'] .'</span>
				</div>
				<div class="col">
					<span class="h6 mb-0 text-muted">'. $settings['time_title'] .'</span>
				</div>
				<div class="col">
					<span class="h6 mb-0 text-muted">'. $settings['presenter_title'] .'</span>
				</div>
			</div>
			<div class="tab-content" data-aos="fade-up">

			</div>
		';

	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Tabbed_Schedule_Block() );