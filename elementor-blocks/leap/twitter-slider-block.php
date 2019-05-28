<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Twitter_Slider_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-twiter-slider-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Twitter Slider', 'tr-framework' );
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
				'label' => esc_html__( 'Slider Settings', 'tr-framework' ),
			]
		);

		$this->add_control(
			'twitter_username', [
				'label'       => __( 'Twitter Username', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'TommusRhodus',
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

		echo ';
			<div data-twitter-fetcher data-username="'. $settings['twitter_username'] .'" data-twitter-flickity=\'{"wrapAround": true, "autoPlay":true}\' class="text-center">
				<div class="carousel-cell">
					<div class="user mb-3"></div>
					<span class="h3 tweet d-block"></span>
					<span class="text-small timePosted"></span>
				</div>
			</div>
         ';
		
		if( !$user_selected_animation ){
			echo '</div>';
		}
		
	}

	protected function _content_template() {
		?>
		
		<div data-twitter-fetcher data-username="{{ settings.twitter_username }}" data-twitter-flickity=\'{"wrapAround": true, "autoPlay":true}\' class="col-lg-10 col-xl-9 text-center">
			<div class="carousel-cell">
				<div class="user mb-3"></div>
				<span class="h3 tweet d-block"></span>
				<span class="text-small timePosted"></span>
			</div>
		</div>
		
		<?php
	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Twitter_Slider_Block() );