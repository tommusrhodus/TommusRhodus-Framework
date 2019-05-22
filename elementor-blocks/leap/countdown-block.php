<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Countdown_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-countdown-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Countdown', 'tr-framework' );
	}
	
	//Return Block Icon (for blocks list)
	public function get_icon() {
		return 'eicon-call-to-action';
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
					'basic'          	=> esc_html__( 'Basic', 'tr-framework' ),
					'labels'         	=> esc_html__( 'Labels', 'tr-framework' ),
				],
			]
		);

		$this->add_control(
			'date', [
				'label'       => __( 'Date - EG 2019/08/06', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '2019/08/06',
				'label_block' => true
			]
		);

		$this->add_control(
			'fallback_text', [
				'label'       => __( 'Fallback Text', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'This is the fallback for when the countdown is elapsed',
				'label_block' => true
			]
		);		

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings                = $this->get_settings_for_display();
		$user_selected_animation = (bool) $settings['_animation'];
		$now 					 = time();

		if ( strtotime( $settings['date'] ) > $now ) {

			if( 'basic' == $settings['layout'] ) {

				echo '<h1 data-countdown-date="'. $settings['date'] .'"></h1>';

			} elseif( 'labels' == $settings['layout'] ) {

				echo '
					<div class="col-12" data-countdown-date="'. $settings['date'] .'" data-detailed>
						<div data-active class="row text-center">
						  <div class="col">
						    <div class="card card-body shadow-3d">
						      <span class="h1 text-primary mb-2" data-weeks data-format="%w"></span>
						      <span class="h6 mb-0" data-weeks-label></span>
						    </div>
						  </div>

						  <div class="col">
						    <div class="card card-body shadow-3d">
						      <span class="h1 text-primary mb-2" data-days data-format="%d"></span>
						      <span class="h6 mb-0" data-days-label></span>
						    </div>
						  </div>

						  <div class="col">
						    <div class="card card-body shadow-3d">
						      <span class="h1 text-primary mb-2" data-hours></span>
						      <span class="h6 mb-0" data-hours-label></span>
						    </div>
						  </div>

						  <div class="col">
						    <div class="card card-body shadow-3d">
						      <span class="h1 text-primary mb-2" data-minutes></span>
						      <span class="h6 mb-0" data-minutes-label></span>
						    </div>
						  </div>

						  <div class="col">
						    <div class="card card-body shadow-3d">
						      <span class="h1 text-primary mb-2" data-seconds></span>
						      <span class="h6 mb-0" data-seconds-label></span>
						    </div>
						  </div>
						</div>
						<div data-elapsed style="display: none;">
						  <h1>'. $settings['fallback_text'] .'</h1>
						</div>
					</div>
				';

			}	

		} else {

			echo '<div data-countdown-date="2018/12/12" data-detailed>
              		<div data-elapsed-state class="d-none alert alert-danger">'. $settings['fallback_text'] .'</div>
            	</div>';

		}	
		
	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Countdown_Block() );