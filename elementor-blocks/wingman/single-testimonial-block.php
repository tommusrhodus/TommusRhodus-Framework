<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Single_Testimonial_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-single-testimonial-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Single Testimonial', 'tr-framework' );
	}
	
	//Return Block Icon (for blocks list)
	public function get_icon() {
		return 'eicon-call-to-action';
	}
	
	public function get_categories() {
		return [ 'wingman-elements' ];
	}

	protected function _register_controls() {
		
		$this->start_controls_section(
			'layout_section', [
				'label' => __( 'Testimonial Layout', 'tr-framework' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'layout', [
				'label'   => __( 'Tabs Layout', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'large',
				'options' => [
					'large'  => esc_html__( 'Large Font', 'tr-framework' ),
					'small'  => esc_html__( 'Small Font', 'tr-framework' )
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content', [
				'label' => esc_html__( 'Testimonial Content', 'tr-framework' ),
			]
		);
		
		$this->add_control(
			'image', [
				'label'      => __( 'Testimonial Image', 'tr-framework' ),
				'type'       => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		
		$this->add_control(
			'testimonial',
			[
				'label'       => __( 'Testimonial Text', 'tr-framework' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => '',
				'label_block' => true
			]
		);

		$this->add_control(
			'author',
			[
				'label'       => __( 'Author', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		if( 'large' == $settings['layout'] ){
		
			echo '
				<div class="row justify-content-center">
				    <div class="col-12 col-lg-10">
				        <div class="media">
				        	 '. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'avatar avatar-lg' ) ) .'
				            <div class="media-body">
				                <p class="h2">'. $settings['testimonial'] .'</p>
				                <span>'. $settings['author'] .'</span>
				            </div>
				        </div>
				    </div>
				</div>
			';
		
		} else {
			
			echo '
				<div class="row justify-content-center">
				    <div class="col-12 col-lg-10">
				        <div class="media">
				        	 '. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'avatar' ) ) .'
				            <div class="media-body">
				                <p class="mb-1">'. $settings['testimonial'] .'</p>
				                <small>'. $settings['author'] .'</small>
				            </div>
				        </div>
				    </div>
				</div>
			';
			
		}
		
	}

	protected function _content_template() {
		?>
		
		<# if ( 'large' == settings.layout ) { #>
		
			<div class="row justify-content-center">
			    <div class="col-12 col-lg-10">
			        <div class="media">
						<img src="{{ settings.image.url }}" alt="" class="avatar avatar-lg">
			            <div class="media-body">
			                <p class="h2">{{{ settings.testimonial }}}</p>
			                <span>{{{ settings.author }}}</span>
			            </div>
			        </div>
			    </div>
			</div>
		
		<# } else { #>
		
			<div class="row justify-content-center">
			    <div class="col-12 col-lg-10">
			        <div class="media">
						<img src="{{ settings.image.url }}" alt="" class="avatar">
			            <div class="media-body">
			                <p class="mb-1">{{{ settings.testimonial }}}</p>
			                <small>{{{ settings.author }}}</small>
			            </div>
			        </div>
			    </div>
			</div>
		
		<# } #>
		
		<?php
	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Single_Testimonial_Block() );