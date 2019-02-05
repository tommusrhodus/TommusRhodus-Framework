<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_tommusrhodus_card_image_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-card-image-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Image Card', 'wingman' );
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
			'image',
			[
				'label'      => __( 'Card Image', 'plugin-domain' ),
				'type'       => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		
		$this->add_control(
			'url', [
				'label'         => esc_html__( 'Card Image URL', 'lima' ),
				'type'          => Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				],
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
		$target   = $settings['url']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['url']['nofollow']    ? ' rel="nofollow"'  : '';
		$link     = 'href="'. esc_url( $settings['url']['url'] ) .'"' . $target . $nofollow;
		
		echo '
			<ul class="row feature-list feature-list-sm">
				<li class="col-12">
				
					<a '. $link .' class="card">
						'. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'img-fluid rounded' ) ) .'
					</a>
					
					'. $settings['content'] .'
					
				</li>
			</ul>
		';
		
	}

	protected function _content_template() {
		?>
		
		<ul class="row feature-list feature-list-sm">
			<li class="col-12">
				<a href="{{ settings.url.url }}" class="card">
					<img src="{{ settings.image.url }}" alt="" class="img-fluid rounded">
				</a>
				{{{ settings.content }}}
			</li>
		</ul>
		
		<?php
	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_tommusrhodus_card_image_Block() );