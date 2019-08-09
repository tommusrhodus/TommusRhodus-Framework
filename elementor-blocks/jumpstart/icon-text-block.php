<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Icon_Text_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-icon-text-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Icon & Text', 'tr-framework' );
	}
	
	//Return Block Icon (for blocks list)
	public function get_icon() {
		return 'eicon-icon-box';
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
			'layout_section', [
				'label' => __( 'Icon Styling', 'tr-framework' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'layout', [
				'label'   => __( 'Icon & Text Layout', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tiny',
				'options' => [				
					'medium-side'      		=> esc_html__( 'Medium Side Icon Card', 'tr-framework' ),	
					'medium-side-simple'	=> esc_html__( 'Medium Side Icon', 'tr-framework' ),	
				],
			]
		);
		
		$this->add_control(
			'icon', [
				'label'   => __( 'Icon', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => array_keys( tommusrhodus_get_svg_icons() ),
			]
		);

		$this->add_control(
			'icon_colour', [
				'label'   => __( 'Icon Colour', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bg-primary',
				'options' => [
					'bg-primary'      => esc_html__( 'Primary Colour', 'tr-framework' ),					
					'bg-white'        => esc_html__( 'White', 'tr-framework' )
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content', [
				'label' => esc_html__( 'Icon & Text Content', 'tr-framework' ),
			]
		);

		$this->add_control(
			'content',
			[
				'label'       => __( 'Content', 'tr-framework' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => ''
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings                = $this->get_settings_for_display();
		$user_selected_animation = (bool) $settings['_animation'];
		
		if( !$user_selected_animation ){
			echo '<div data-aos="fade-up" data-aos-delay="100">';
		}
		
		if( 'medium-side' == $settings['layout'] ){
			
			echo '
				<div class="card card-body bg-white align-items-start flex-sm-row h-100">
					'. tommusrhodus_svg_icons_pluck( $settings['icon'], 'icon mb-4 mb-sm-0 '. $settings['icon_colour'] ) .'
					<div class="ml-sm-3 ml-md-4">
						'. $settings['content'] .'						
					</div>
				</div>
			';
		
		} elseif( 'medium-side-simple' == $settings['layout'] ){
			
			echo '
				<div class="my-4">
					<div class="d-flex">
						<div class="mr-3 mr-md-4">
							'. tommusrhodus_svg_icons_pluck( $settings['icon'], 'icon '. $settings['icon_colour'] ) .'
						</div>
						<div>
							'. $settings['content'] .'
						</div>
					</div>
                </div>
			';
		
		}
		
		if( !$user_selected_animation ){
			echo '</div>';
		}
		
	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Icon_Text_Block() );