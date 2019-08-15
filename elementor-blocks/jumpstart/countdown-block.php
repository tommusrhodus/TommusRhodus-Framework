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
		return 'eicon-countdown';
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
				'default' => 'labels',
				'label_block' => true,
				'options' => [
					'labels'          	=> esc_html__( 'Simple', 'tr-framework' ),
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

			if( 'labels' == $settings['layout'] ) {

				echo '
					<div class="card card-body bg-white flex-row flex-wrap justify-content-around add-countdown-time" data-countdown-date="'. $settings['date'] .'" data-detailed>
		                <div class="mx-4 my-4 my-md-0 text-center">
		                  <div class="h1 mb-2" data-days></div>
		                  <span>Days</span>
		                </div>
		                <div class="mx-4 my-4 my-md-0 text-center">
		                  <div class="h1 mb-2" data-hours></div>
		                  <span>Hours</span>
		                </div>
		                <div class="mx-4 my-4 my-md-0 text-center">
		                  <div class="h1 mb-2" data-minutes></div>
		                  <span>Minutes</span>
		                </div>
		                <div class="mx-4 my-4 my-md-0 text-center">
		                  <div class="h1 mb-2" data-seconds></div>
		                  <span>Seconds</span>
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