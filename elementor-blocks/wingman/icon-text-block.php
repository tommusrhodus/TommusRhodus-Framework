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
		return esc_html__( 'Icon & Text', 'wingman' );
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
			'section_my_custom', [
				'label' => esc_html__( 'Page Heading', 'wingman' ),
			]
		);
		
		$this->add_control(
			'icon', [
				'label'   => __( 'Icon', 'plugin-domain' ),
				'type'    => Controls_Manager::ICON,
				'default' => 'fa fa-rocket',
			]
		);

		$this->add_control(
			'content',
			[
				'label'       => __( 'Content', 'plugin-domain' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => ''
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		echo '
			<ul class="feature-list feature-list-sm">
				<li>
				    <div class="media">
				        <i class="'. esc_attr( $settings['icon'] ).' mr-2"></i>
				        <div class="media-body">'. $settings['content'] .'</div>
				    </div>
				</li>
			</ul>
		';
		
	}

	protected function _content_template() {
		?>
		
		<ul class="feature-list feature-list-sm">
			<li>
			    <div class="media">
			        <i class="{{ settings.icon }} mr-2"></i>
			        <div class="media-body">{{{ settings.content }}}</div>
			    </div>
			</li>
		</ul>
		
		<?php
	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Icon_Text_Block() );