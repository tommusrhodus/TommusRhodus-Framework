<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Testimonial_Carousel_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-testimonial-carousel-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Testimonial Carousel', 'tr-framework' );
	}
	
	//Return Block Icon (for blocks list)
	public function get_icon() {
		return 'eicon-blockquote';
	}
	
	public function get_categories() {
		return [ 'leap-elements' ];
	}

	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_my_custom', [
				'label' => esc_html__( 'Testimonial Carousel Layout', 'tr-framework' ),
			]
		);

		$this->add_control(
			'layout', [
				'label'   => __( 'Layout', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'card-3',
				'label_block' => true,
				'options' => [
					'card-3'          		=> esc_html__( 'Card Carousel 3', 'tr-framework' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_items_section', [
				'label' => __( 'Slider Slides', 'tr-framework' )
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image', [
				'label'      => __( 'Slide Image', 'tr-framework' ),
				'type'       => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'content', [
				'label'       => __( 'Testimonial Content', 'tr-framework' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => ''
			]
		);

		$repeater->add_control(
			'author', [
				'label'       => __( 'Author/Role', 'tr-framework' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => ''
			]
		);

		$this->add_control(
			'list', [
				'label'   => __( 'Slide Content', 'tr-framework' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [],
				'title_field' => __( 'Slide Content', 'tr-framework' ),
			]
		);		

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings                = $this->get_settings_for_display();
		$user_selected_animation = (bool) $settings['_animation'];
		
		if( 'card-3' == $settings['layout'] ) {

			echo '
				 <div data-flickity=\'{ "autoPlay": true, "imagesLoaded": true, "wrapAround": true, "prevNextButtons": false }\'>';

					foreach( $settings['list'] as $item ){

						echo '
							<div class="carousel-cell mx-3 pb-1">
				                <div class="card card-body">
				                  	<div class="d-flex mb-3">
										'. tommusrhodus_svg_icons_pluck( 'Star', $class = 'icon bg-warning' ) .'
										'. tommusrhodus_svg_icons_pluck( 'Star', $class = 'icon bg-warning' ) .'
										'. tommusrhodus_svg_icons_pluck( 'Star', $class = 'icon bg-warning' ) .'
										'. tommusrhodus_svg_icons_pluck( 'Star', $class = 'icon bg-warning' ) .'
										'. tommusrhodus_svg_icons_pluck( 'Star', $class = 'icon bg-warning' ) .'
				                  	</div>
				                  	<div class="my-md-2 flex-grow-1">
				                    	'. do_shortcode( $item['content'] ) .'
				                  	</div>
				                  	<div class="avatar-author align-items-center">
				                  		'. wp_get_attachment_image( $item['image']['id'], 'Thumbnail', 0, array( 'class' => 'round avatar' ) ) .'
				                    	<div class="ml-2">
				                      		'. do_shortcode( $item['author'] ) .'
				                    	</div>
				                  	</div>
				                </div>
			             	 </div>
						';

					}

					echo '
				</div>
			';
		
		}

	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Testimonial_Carousel_Block() );