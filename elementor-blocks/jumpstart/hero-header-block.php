<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Hero_Header_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-hero-header-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Hero Header', 'tr-framework' );
	}
	
	//Return Block Icon (for blocks list)
	public function get_icon() {
		return 'eicon-call-to-action';
	}
	
	public function get_categories() {
		return [ 'jumpstart-elements' ];
	}

	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_layout', [
				'label' => esc_html__( 'Layout', 'tr-framework' ),
			]
		);
		
		$this->add_control(
			'layout', [
				'label'   => __( 'Hero Header', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'standard',
				'label_block' => true,
				'options' => [
					'standard' => esc_html__( 'Standard', 'tr-framework' ),
				],
			]
		);
		
		$this->add_control(
			'divider', [
				'label'       => __( 'Bottom Divider Shape', 'tr-framework' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'none',
				'options'     => tommusrhodus_get_divider_layouts(),
				'label_block' => true
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content', [
				'label' => esc_html__( 'Content', 'tr-framework' ),
			]
		);
		
		$this->add_control(
			'image', [
				'label'      => __( 'Image', 'tr-framework' ),
				'type'       => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
			]
		);
		
		$this->add_control(
			'content', [
				'label'       => __( 'Content', 'tr-framework' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => ''
			]
		);

		$this->add_control(
			'lower_content', [
				'label'       => __( 'Lower Content', 'tr-framework' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => ''
			]
		);

		$this->end_controls_section();

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

	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		if( 'standard' == $settings['layout'] ){
		
			echo '
				<div data-overlay class="o-hidden">
					<section class="pb-0">
					<div class="container">
						<div class="row justify-content-center text-center min-vh-40 d-flex flex-column align-items-center">
							<div class="col-md-10 col-lg-9 col-xl-8" data-aos="fade-up">
								'. $settings['content'] .'
								<div class="d-flex flex-column flex-sm-row mt-4 mt-md-5 justify-content-center" data-aos="fade-up" data-aos-delay="300">
									'. $settings['lower_content'] .'
								</div>
							</div>
						</div>
					</div>
						<div class="position-absolute bottom left w-50 h-50 d-none d-md-block" data-jarallax-element="-24 48">
							<div class="blob bg-gradient w-50 h-100 bottom left"></div>
						</div>
						<div class="position-absolute top right w-50 h-50 d-none d-md-block" data-jarallax-element="48">
							<div class="blob blob-2 bg-gradient w-50 h-50 top right"></div>
						</div>';
						
						if(!( 'none' == $settings['divider'] )){	
							echo tommusrhodus_svg_dividers_pluck( $settings['divider'], '' );		
						}

					echo '
					</section>
				</div>
			';
		
		}
		
	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Hero_Header_Block() );