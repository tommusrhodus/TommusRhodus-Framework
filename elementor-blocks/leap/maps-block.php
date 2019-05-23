<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Maps_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-maps-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Map', 'tr-framework' );
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
				'label' => esc_html__( 'Map Details', 'tr-framework' ),
			]
		);

		$this->add_control(
			'api_key', [
				'label'       => __( 'Google API Key', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true
			]
		);

		$this->add_control(
			'layout', [
				'label'   => __( 'Card Layout', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'basic',
				'label_block' => true,
				'options' => [
					'basic'          	=> esc_html__( 'Basic', 'tr-framework' ),
					'styled'         	=> esc_html__( 'Styled Map', 'tr-framework' ),
				],
			]
		);

		$this->add_control(
			'address', [
				'label'       => __( 'Address', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'South Wharf, Melbourne Australia',
				'label_block' => true
			]
		);

		$this->add_control(
			'latlong', [
				'label'       => __( 'Latitude & Logitude (eg 40.713750,-74.007590) - Use this if your using "styled" maps.', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '40.713750,-74.007590',
				'label_block' => true
			]
		);

		$this->add_control(
			'content', [
				'label'       => __( 'Marker Info', 'tr-framework' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => ''
			]
		);

		$this->add_control(
			'style_code', [
				'label'       => __( 'Map Colour Code - Available from <a href="https://snazzymaps.com/" target="_blank">here</a>', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true
			]
		);

		$this->add_control(
			'show_zoom', [
				'label' 		=> __( 'Show Zoom Controls', 'tr-framework' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'tr-framework' ),
				'label_off' 	=> __( 'Hide', 'tr-framework' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings                = $this->get_settings_for_display();
		$user_selected_animation = (bool) $settings['_animation'];

		if( 'yes' == $settings['show_zoom'] ) {
			$zoom = 'data-zoom-controls="RIGHT_BOTTOM"';
		} else {
			$zoom = '';
		}		
		
		if( 'basic' == $settings['layout'] ) {

			echo '
				<div class="min-vh-50 w-100 rounded" data-marker-image="'. get_template_directory_uri() .'/style/img/map-marker-2.svg" data-maps-api-key="'. $settings['api_key'] .'" data-address="'. $settings['address'] .'" data-map-zoom="14" '. $zoom .'>
					<div class="map-marker" data-address="'. $settings['address'] .'">
						<div class="info-window" data-max-width="400">
							<div class="container">
								<div class="row">
									<div class="col-12">
									'. $settings['content'] .'
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
	    	';
			
		} elseif( 'styled' == $settings['layout'] ) {

			echo '
				<div class="min-vh-50 w-100 rounded" data-marker-image="'. get_template_directory_uri() .'/style/img/map-marker-2.svg" data-maps-api-key="'. $settings['api_key'] .'" data-latlong="'. $settings['latlong'] .'" data-map-zoom="14" '. $zoom .'>
					<div class="map-marker" data-latlong="'. $settings['latlong'] .'">
						<div class="info-window" data-max-width="400">
							<div class="container">
								<div class="row">
									<div class="col-12">
										'. $settings['content'] .'
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="map-style">
						'. $settings['style_code'] .'
					</div>
				</div>
	    	';
			
		}

	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Maps_Block() );