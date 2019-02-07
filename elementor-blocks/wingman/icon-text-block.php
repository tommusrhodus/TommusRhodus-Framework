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
		return 'eicon-call-to-action';
	}
	
	public function get_categories() {
		return [ 'wingman-elements' ];
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
				'label'   => __( 'Tabs Layout', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'tiny',
				'options' => [
					'tiny'      => esc_html__( 'Tiny Side Icon', 'tr-framework' ),
					'tiny-card' => esc_html__( 'Tiny Side Icon [Boxed]', 'tr-framework' ),
					'large'     => esc_html__( 'Large Top Icon', 'tr-framework' )
				],
			]
		);
		
		$this->add_control(
			'color', [
				'label'   => __( 'Icon Color', 'tr-framework' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content', [
				'label' => esc_html__( 'Icon & Text Content', 'tr-framework' ),
			]
		);
		
		$this->add_control(
			'icon', [
				'label'   => __( 'Icon', 'tr-framework' ),
				'type'    => Controls_Manager::ICON,
				'default' => 'fa fa-rocket',
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
		
		$settings = $this->get_settings_for_display();
		
		if( 'tiny' == $settings['layout'] ){
		
			echo '
				<ul class="feature-list feature-list-sm">
					<li>
					    <div class="media">
					        <i class="'. esc_attr( $settings['icon'] ).' mr-2" style="color: '. $settings['color'] .';"></i>
					        <div class="media-body">'. $settings['content'] .'</div>
					    </div>
					</li>
				</ul>
			';
		
		} elseif( 'tiny-card' == $settings['layout'] ) {
			
			echo '
				<div class="card">
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
						    <div class="media">
						        <i class="'. esc_attr( $settings['icon'] ).' mr-2" style="color: '. $settings['color'] .';"></i>
						        <div class="media-body">'. $settings['content'] .'</div>
						    </div>
						</li>
					</ul>
				</div>
			';
			
		} else {
		
			echo '
				<ul class="feature-list">
				    <li>
				        <i class="'. esc_attr( $settings['icon'] ).' h1" style="color: '. $settings['color'] .';"></i>
				        '. $settings['content'] .'
				    </li>
				</ul>
			';
		
		}
		
	}

	protected function _content_template() {
		?>
		
		<# if ( 'tiny' == settings.layout ) { #>
		
			<ul class="feature-list feature-list-sm">
				<li>
				    <div class="media">
				        <i class="{{ settings.icon }} mr-2" style="color: {{ settings.color }};"></i>
				        <div class="media-body">{{{ settings.content }}}</div>
				    </div>
				</li>
			</ul>
			
		<# } else if ( 'tiny-card' == settings.layout ) { #>
		
			<div class="card">
				<ul class="list-group list-group-flush">
					<li class="list-group-item">
					    <div class="media">
					        <i class="{{ settings.icon }} mr-2" style="color: {{ settings.color }};"></i>
					        <div class="media-body">{{{ settings.content }}}</div>
					    </div>
					</li>
				</ul>
			</div>
		
		<# } else { #>
		
			<ul class="feature-list">
			    <li>
			        <i class="{{ settings.icon }} h1" style="color: {{ settings.color }};"></i>
			        {{{ settings.content }}}
			    </li>
			</ul>
		
		<# } #>
		
		<?php
	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Icon_Text_Block() );