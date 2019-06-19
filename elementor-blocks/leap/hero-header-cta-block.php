<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Hero_Header_CTA_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-hero-header-cta-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Hero Header CTA', 'tr-framework' );
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
			'section_layout', [
				'label' => esc_html__( 'Layout', 'tr-framework' ),
			]
		);
		
		$this->add_control(
			'layout', [
				'label'   => __( 'Hero Header Layout', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dark-primary-3',
				'label_block' => true,
				'options' => [
					'dark-primary-3'         	=> esc_html__( 'Dark Primary 3, Text + Form', 'tr-framework' ),					
					'image-bg-text-above'		=> esc_html__( 'Image Background, Text Above Form', 'tr-framework' ),
				],
			]
		);
		
		$this->add_control(
			'divider', [
				'label'       => __( 'Bottom Divider Shape', 'tr-framework' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'none',
				'options'     => tommusrhodus_get_divider_layouts(),
				'label_block' => true
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content', [
				'label' => esc_html__( 'Content', 'tr-framework' ),
			]
		);
		
		$this->add_control(
			'image', [
				'label'      => __( 'Image', 'tr-framework' ),
				'type'       => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
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
			'cta_content', [
				'label'       => __( 'CTA Content', 'tr-framework' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => ''
			]
		);

		$this->end_controls_section();

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

	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		if( 'dark-primary-3' == $settings['layout'] ){
		
			echo '
				<section class="bg-primary-3 has-divider text-light o-hidden">
					<div class="container layer-2">
						<div class="row justify-content-center pt-lg-5">
							<div class="col-xl-5 col-lg-6 col-md-7 text-center text-lg-left mb-5 mb-lg-0">
								'. $settings['content'] .'
							</div>
							<div class="col">
								<div class="row justify-content-center">
									<div class="col-xl-8 col-md-10">
										'. $settings['cta_content'] .'
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="decoration-wrapper d-none d-sm-block">
						<div data-jarallax-element="0 50">
							<div class="decoration top middle-y scale-5">
								<svg class="bg-primary-2" width="183" height="166" viewBox="0 0 183 166" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M2.34805 65.6701C4.02805 62.9901 5.56905 60.211 7.41605 57.652C10.82 52.939 14.734 48.636 18.627 44.322C21.811 40.794 24.9 37.181 28.08 33.65C30.619 30.831 32.879 27.721 36.068 25.554C39.035 23.539 42.066 21.62 45.039 19.616C46.439 18.674 47.812 17.682 49.123 16.624C51.525 14.687 54.035 12.972 56.996 11.982C57.787 11.717 58.5371 11.285 59.2561 10.847C63.3111 8.36802 67.328 5.82603 71.408 3.38703C73.033 2.41503 74.7361 1.53704 76.4881 0.824045C78.4981 0.00604486 80.615 -0.0229468 82.701 0.670053C84.805 1.36905 86.912 2.05405 88.994 2.81205C90.217 3.25705 91.426 3.55605 92.701 3.15705C94.228 2.67905 95.5971 3.14904 96.9921 3.72804C99.4631 4.75604 101.484 6.48703 103.691 7.92603C104.574 8.50203 105.353 9.24603 106.257 9.77903C107.429 10.469 108.624 11.197 109.905 11.604C112.95 12.57 115.751 13.945 118.466 15.634C124.386 19.315 130.482 22.6901 137.122 24.9461C141.015 26.2681 144.968 27.425 148.802 28.897C153.036 30.522 157.224 32.289 161.009 34.866C162.577 35.934 164.195 36.928 165.802 37.937C171.439 41.473 175.253 46.641 178.368 52.335C180.1 55.5 180.626 59.127 181.403 62.633C182.262 66.502 182.116 70.416 181.868 74.311C181.587 78.733 181.095 83.142 180.665 87.554C180.462 89.618 179.534 91.337 178.192 92.927C175.192 96.484 172.45 100.218 170.514 104.504C169.549 106.642 168.932 108.863 168.332 111.109C167.514 114.168 166.631 117.2 165.352 120.117C163.209 124.994 160.215 129.302 156.885 133.411C156.498 133.89 156.188 134.472 155.996 135.057C155.039 137.993 153.416 140.578 151.975 143.28C149.35 148.2 145.637 152.224 142.088 156.405C141.611 156.967 141.123 157.548 140.539 157.985C136.902 160.704 133.254 163.385 128.863 164.86C126.806 165.552 124.752 165.891 122.634 165.534C120.347 165.149 117.966 164.899 115.843 164.048C113.527 163.117 111.435 161.605 109.294 160.267C107.773 159.316 106.386 158.149 104.851 157.226C101.417 155.162 97.923 153.198 94.464 151.177C93.37 150.539 92.3001 149.863 91.2301 149.187C90.7851 148.904 90.4021 148.509 89.9331 148.281C85.2771 146.008 81.023 143.033 76.49 140.568C71.861 138.051 67.103 135.705 61.888 134.538C61.374 134.423 60.837 134.338 60.361 134.126C54.332 131.453 47.812 130.439 41.547 128.568C37.799 127.449 34.072 126.33 30.547 124.58C26.953 122.795 23.2871 121.148 19.6391 119.475C16.4031 117.991 13.774 115.777 11.504 113.057C9.25404 110.358 7.32204 107.492 6.06804 104.188C4.82404 100.913 3.92305 97.569 3.70305 94.057C3.63705 93.004 3.53704 91.946 3.33804 90.912C2.34204 85.728 1.53504 80.525 0.926042 75.276C0.531042 71.872 1.00605 68.7731 2.34805 65.6701ZM57.891 130.289C57.84 130.228 57.791 130.168 57.741 130.107C57.682 130.158 57.5811 130.203 57.5751 130.257C57.5711 130.312 57.657 130.416 57.714 130.422C57.766 130.429 57.83 130.338 57.891 130.289ZM111.725 160.38C111.678 160.322 111.635 160.227 111.582 160.22C111.531 160.213 111.469 160.302 111.412 160.349C111.459 160.406 111.502 160.502 111.555 160.507C111.608 160.512 111.668 160.426 111.725 160.38ZM141.531 85.2951L141.57 85.501L141.736 85.369L141.531 85.2951Z"
								fill="black" />
								</svg>
							</div>
						</div>
					</div>';

					if(!( 'none' == $settings['divider'] )){	
						echo tommusrhodus_svg_dividers_pluck( $settings['divider'], '' );		
					}
				
			echo '</section>';
			
		} elseif( 'image-bg-text-above' == $settings['layout'] ){
		
			echo '
				<section class="bg-primary-3 jarallax min-vh-80 d-flex flex-column justify-content-center pb-0 o-hidden" data-overlay data-jarallax data-speed="0.2">
					
					'. wp_get_attachment_image( $settings['image']['id'], 'full', 0, array( 'class' => 'jarallax-img opacity-30' ) ) .'
			      
					<div class="container py-5 position-relative">
						<div class="row">
							<div class="col-xl-6 col-lg-7 col-md-9">
								'. $settings['content'] .'
							</div>
						</div>
						<div class="row mt-4">
							<div class="col">
								'. $settings['cta_content'] .'
							</div>
						</div>
					</div>';

					if(!( 'none' == $settings['divider'] )){	
						echo tommusrhodus_svg_dividers_pluck( $settings['divider'], '' );		
					}
				
			echo '</section>';
			
		}
		
	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Hero_Header_CTA_Block() );