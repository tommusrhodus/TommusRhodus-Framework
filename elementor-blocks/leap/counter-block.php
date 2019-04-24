<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Counter_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-counter-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Counter', 'tr-framework' );
	}
	
	//Return Block Icon (for blocks list)
	public function get_icon() {
		return 'eicon-call-to-action';
	}
	
	public function get_categories() {
		return [ 'leap-elements' ];
	}

	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_my_custom', [
				'label' => esc_html__( 'Content', 'tr-framework' ),
			]
		);

		$this->add_control(
			'title', [
				'label'       => __( 'Title', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true
			]
		);
		
		$this->add_control(
			'start', [
				'label'       => __( 'Counter Start', 'tr-framework' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '4567',
				'label_block' => true
			]
		);
		
		$this->add_control(
			'finish', [
				'label'       => __( 'Counter Finish', 'tr-framework' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '73000',
				'label_block' => true
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings                = $this->get_settings_for_display();
		$user_selected_animation = (bool) $settings['_animation'];
		
		if( !$user_selected_animation ){
			echo '<div data-aos="fade-up" data-aos-delay="NaN">';
		}
		
		echo '<div class="mb-lg-0">';
		
		if ( Plugin::$instance->editor->is_edit_mode() ) {
		
			echo '<span class="display-4 text-primary d-block"">'. $settings['finish'] .'</span>';
			
		} else {
		
			echo '<span class="display-4 text-primary d-block" data-countup data-start="'. $settings['start'] .'" data-end="'. $settings['finish'] .'" data-duration="3" data-grouping="true"></span>';
			
		}
				
		echo '<span class="h6">'. $settings['title'] .'</span></div>';
		
		if( !$user_selected_animation ){
			echo '</div>';
		}
		
	}

	protected function _content_template() {
		?>
		
		<div class="mb-lg-0">
			<span class="display-4 text-primary d-block">{{{ settings.finish }}}</span>
			<span class="h6">{{{ settings.title }}}</span>
		</div>
		
		<?php
	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Counter_Block() );