<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Tabs_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-tabs-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Tab', 'tr-framework' );
	}
	
	//Return Block Icon (for blocks list)
	public function get_icon() {
		return 'eicon-tabs';
	}
	
	public function get_categories() {
		return [ 'leap-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'tab_items_section', [
				'label' => __( 'Tab', 'tr-framework' )
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'icon', [
				'label'   => __( 'Tab Icon', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => array_keys( tommusrhodus_get_svg_icons() ),
			]
		);

		$repeater->add_control(
			'title', [
				'label'       => __( 'Tab Title', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => ''
			]
		);

		$repeater->add_control(
			'content', [
				'label'       => __( 'Tab Content', 'tr-framework' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => ''
			]
		);		

		$this->add_control(
			'list', [
				'label'   => __( 'Tab Details', 'tr-framework' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [],
				'title_field' => __( '', 'tr-framework' ),
			]
		);		

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings                	= $this->get_settings_for_display();		
		$user_selected_animation 	= (bool) $settings['_animation'];
		
		echo '

			<div class="row">
			  	<div class="col-lg-3 col-md-4 mb-4 mb-md-0">
			    	<ul class="nav flex-column" role="tablist">';

			    		$i = 0;

			    		foreach( $settings['list'] as $item ){

			    			echo '
					      		<li class="nav-item">
					        		<a class="nav-link btn btn-light p-2 text-left '; if( 0 == $i ) { echo 'active'; } echo '" href="#'. sanitize_title( $item['title'] ) .'" data-toggle="tab" aria-controls="'. sanitize_title( $item['title'] ) .'" aria-selected="true" role="tab">
					        			'. tommusrhodus_svg_icons_pluck( $item['icon'], 'icon bg-primary' ) .'
					          		'. $item['title'] .'</a>
					     		 </li>';

					     	$i++;
			     		}

			     		echo '
			    	</ul>
			  	</div>
			  	<div class="col mb-lg-n7 layer-2">
			    	<div class="tab-content">';

			    		$i = 0;

			    		foreach( $settings['list'] as $item ){

			    			echo '
					      		<div class="tab-pane fade show '; if( 0 == $i ) { echo 'active'; } echo '" id="'. sanitize_title( $item['title'] ) .'" role="tabpanel" aria-labelledby="'. sanitize_title( $item['title'] ) .'">
					      			'. $item['content'] .'
					      		</div>';

					      	$i++;
			      		}

			      		echo '
			    	</div>
			  	</div>
			</div>
		';

	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Tabs_Block() );