<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Card_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-card-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Card', 'tr-framework' );
	}
	
	//Return Block Icon (for blocks list)
	public function get_icon() {
		return 'eicon-info-box';
	}
	
	public function get_categories() {
		return [ 'jumpstart-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_layout', [
				'label' => esc_html__( 'Layout', 'tr-framework' ),
			]
		);
		
		$this->add_control(
			'layout', [
				'label'   => __( 'Card Layout', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'basic',
				'label_block' => true,
				'options' => [
					'image-and-title'			=> esc_html__( 'Image + Title', 'tr-framework' ),
					'image-left-text-right'		=> esc_html__( 'Image Left + Text Right', 'tr-framework' ),
					'customer'					=> esc_html__( 'Customer', 'tr-framework' ),	
					'customer-small'			=> esc_html__( 'Customer Small', 'tr-framework' ),					
					'text-feature'				=> esc_html__( 'Text Feature', 'tr-framework' ),
				],
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_my_custom', [
				'label' => esc_html__( 'Card Content', 'tr-framework' ),
			]
		);

		$this->add_control(
			'image', [
				'label'      => __( '<strong>Fields are used on a per-layout basis, if you find a URL or such us not effecting the card, choose another layout.</strong><br><br>Card Image', 'tr-framework' ),
				'type'       => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
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
			'title',
			[
				'label'       => __( 'Title', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true
			]
		);
		
		$this->add_control(
			'content', [
				'label'       => __( 'Content', 'tr-framework' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => ''
			]
		);

		$this->add_control(
			'url', [
				'label'         => esc_html__( 'Card URL', 'tr-framework' ),
				'type'          => Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url'         => '',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);

		$this->add_control(
			'link_text',
			[
				'label'       => __( 'Link Text (Where applicable)', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Learn more',
				'label_block' => true
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings = $this->get_settings_for_display();
		$target   = $settings['url']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['url']['nofollow']    ? ' rel="nofollow"'  : '';
		$link     = 'href="'. esc_url( $settings['url']['url'] ) .'"' . $target . $nofollow;
		
		if( 'image-and-title' == $settings['layout'] ) {

			if( !empty( $settings['url']['url'] ) ) {

				echo '
					<div class="mb-4 mb-md-5">
						<a '. $link .' class="d-block fade-page">
							'. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'img-fluid rounded hover-box-shadow' ) ) .'
	                		<h6 class="mb-0 mt-2 mt-sm-3">'. $settings['title'] .'</h6>
	              		</a>
	              	</div>
				';

			} else {

				echo '
					<div class="mb-4 mb-md-5">
						'. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'img-fluid rounded hover-box-shadow' ) ) .'
                		<h6 class="mb-0 mt-2 mt-sm-3">'. $settings['title'] .'</h6>
					</div>
				';

			}			

		} elseif( 'image-left-text-right' == $settings['layout'] ) {

			echo '
				<div class=" mb-3 mb-lg-5">
					<div class="row align-items-center">
						<div class="col-sm-4 mb-3 mb-sm-0">
							'. wp_get_attachment_image( $settings['image']['id'], 'medium', 0, array( 'class' => 'img-fluid rounded' ) ) .'
						</div>
						<div class="col">
							<h4>'. $settings['title'] .'</h4>
							'. $settings['content'] .'';

							if( !empty( $settings['url']['url'] ) ) {						
								echo '<a '. $link .'>'. $settings['link_text'] .'</a>';
							}

							echo '
						</div>
					</div>
				</div>
			';

		} elseif( 'customer' == $settings['layout'] ) {

			echo '
				<div class="card card-body">
					<div class="d-flex">
						<p class="lead">'. $settings['title'] .'</p>
					</div>
					<div class="d-flex">
						'. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'avatar avatar-sm' ) ) .'
						<div class="ml-3">
							'. $settings['content'] .'
						</div>
					</div>
				</div>
			';			

		} elseif( 'customer-small' == $settings['layout'] ) {

			echo '
				<div class="d-flex m-2">
					<div class="media rounded align-items-center pl-3 pr-3 pr-md-4 py-2 shadow-sm bg-white">
					'. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'avatar avatar-sm flex-shrink-0 mr-3' ) ) .'
						<div class="text-dark mb-0">'. $settings['content'] .'</div>
					</div>
	            </div>
			';			

		} elseif( 'text-feature' == $settings['layout'] ) {

			echo '
				<div class="mb-3 mb-md-4" data-aos="fade-up" data-aos-delay="10">
					<div class="card card-body bg-white min-vh-md-30 hover-box-shadow">
						<div class="flex-fill">
							<h4 class="h3">'. $settings['title'] .'</h4>
							'. $settings['content'] .'
						</div>';

						if( !empty( $settings['url']['url'] ) ) {						
							echo '<a '. $link .' class="stretched-link">'. $settings['link_text'] .'</a>';
						}

						echo '
					</div>
				</div>
			';
		}
		
	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Card_Block() );