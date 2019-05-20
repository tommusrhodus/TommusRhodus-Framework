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
				'label'   => __( 'Card Layout', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'basic',
				'label_block' => true,
				'options' => [
					'basic'          	=> esc_html__( 'Basic', 'tr-framework' ),
					'icon-1'         	=> esc_html__( 'Icon 1', 'tr-framework' ),
					'icon-1-dark'		=> esc_html__( 'Icon 1 Dark BG', 'tr-framework' ),
					'icon-2'         	=> esc_html__( 'Icon 2', 'tr-framework' ),
					'icon-3'         	=> esc_html__( 'Icon 3', 'tr-framework' ),
					'icon-4'         	=> esc_html__( 'Icon 4', 'tr-framework' ),
					'icon-4-hover'		=> esc_html__( 'Icon 4 + Hover Effect', 'tr-framework' ),
					'customer-1'		=> esc_html__( 'Customer 1', 'tr-framework' ),
					'customer-2'		=> esc_html__( 'Customer 2', 'tr-framework' ),
					'customer-3'		=> esc_html__( 'Customer 3', 'tr-framework' ),
					'customer-4'		=> esc_html__( 'Customer 4', 'tr-framework' ),
					'customer-5'		=> esc_html__( 'Customer 5', 'tr-framework' ),
					'customer-7'		=> esc_html__( 'Customer 7', 'tr-framework' ),
					'customer-8'		=> esc_html__( 'Customer 8', 'tr-framework' ),
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
			'badge_label',
			[
				'label'       => __( 'Badge Label', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true
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

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings = $this->get_settings_for_display();
		$target   = $settings['url']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['url']['nofollow']    ? ' rel="nofollow"'  : '';
		$link     = 'href="'. esc_url( $settings['url']['url'] ) .'"' . $target . $nofollow;
		
		if( 'basic' == $settings['layout'] ) {

			echo '
				<div class="card card-body">
					<div class="mb-3 mb-lg-5 flex-grow-1">
						<span class="h2 mb-0">'. $settings['title'] .'</span>
					</div>
					'. $settings['content'] .'
				</div>
			';

		} elseif( 'icon-1' == $settings['layout'] ) {

			echo '
				<div class="card card-body">
					'. tommusrhodus_svg_icons_pluck( $settings['icon'], 'icon-round mb-3 mb-md-4 bg-primary' ) .'					
					'. $settings['content'] .'
				</div>
			';

		} elseif( 'icon-1-dark' == $settings['layout'] ) {

			echo '
				<div class="card card-body bg-primary text-light">
					'. tommusrhodus_svg_icons_pluck( $settings['icon'], 'icon-round mb-3 mb-md-4 bg-primary' ) .'					
					'. $settings['content'] .'
				</div>
			';

		} elseif( 'icon-2' == $settings['layout'] ) {

			if( !empty( $settings['url']['url'] ) ) {

				echo '
					<a '. $link .' class="card card-icon-2 card-body justify-content-between">
						'. tommusrhodus_svg_icons_pluck( $settings['icon'], 'icon-round mb-3 mb-md-4 bg-primary' ) .'
						<h5 class="mb-0">'. $settings['title'] .'</h5>
					</a>
				';

			} else {

				echo '
					<div class="card card-icon-2 card-body justify-content-between">
						'. tommusrhodus_svg_icons_pluck( $settings['icon'], 'icon-round mb-3 mb-md-4 bg-primary' ) .'
						<h5 class="mb-0">'. $settings['title'] .'</h5>
					</div>
				';

			}
			
		}  elseif( 'icon-3' == $settings['layout'] ) {

			echo '
				<div class="card card-icon-3 card-body justify-content-between">
					'. tommusrhodus_svg_icons_pluck( $settings['icon'], 'icon-round mb-3 mb-md-4 bg-primary' ) .'
			 
					<span class="badge badge-primary">'. $settings['badge_label'] .'</span>
					<div>
						<h3>'. $settings['title'] .'</h3>
						'. $settings['content'] .'
					</div>
				</div>
			';

		} elseif( 'icon-4' == $settings['layout'] ) {

			if( !empty( $settings['url']['url'] ) ) {

				echo '
					<a '. $link .' class="card card-sm card-body flex-row align-items-center hover-shadow-3d">					
						'. tommusrhodus_svg_icons_pluck( $settings['icon'] ) .'
	             	
	                  	<div class="ml-3">
		                    '. $settings['content'] .'
	                  	</div>
	                </a>
				';

			} else {

				echo '
					<div class="card card-sm card-body flex-row align-items-center">
						'. tommusrhodus_svg_icons_pluck( $settings['icon'] ) .'
	             	
	                  	<div class="ml-3">
		                    '. $settings['content'] .'
	                  	</div>
	                </div>
				';

			} 

		} elseif( 'icon-4-hover' == $settings['layout'] ) {

			echo '
				<a '. $link .' class="card card-sm card-body flex-row align-items-center hover-bg-primary-2 hover-shadow-3d">
					'. tommusrhodus_svg_icons_pluck( $settings['icon'], 'icon icon-lg bg-primary-2' ) .'
             	
                  	<div class="ml-3">
	                    '. $settings['content'] .'
                  	</div>
                </a>
			';

		} elseif( 'customer-1' == $settings['layout'] ) {

			if( !empty( $settings['url']['url'] ) ) {

				echo '
					<div class="card card-customer-1 card-body align-items-start">
					  <div class="mb-4 mb-md-5">
					    '. tommusrhodus_svg_icons_pluck( $settings['icon'], 'icon icon-lg bg-primary-2' ) .'
					  </div>
					  <div class="mb-3 mb-md-4">
					    '. $settings['content'] .'
					  </div>
					  <a '. $link .'>'. $settings['badge_label'] .'</a>
					</div>
				';

			} else {

				echo '
					<div class="card card-customer-1 card-body align-items-start">
					  <div class="mb-4 mb-md-5">
					    '. tommusrhodus_svg_icons_pluck( $settings['icon'], 'icon icon-lg bg-primary-2' ) .'
					  </div>
					  <div class="mb-3 mb-md-4">
					    '. $settings['content'] .'
					  </div>
					</div>
				';

			}

		} elseif( 'customer-2' == $settings['layout'] ) {

			if( !empty( $settings['url']['url'] ) ) {

				echo '
					<div class="card">
	                  	<a '. $link .'>
	                  		'. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'card-img-top' ) ) .'
	                  	</a>
	                  	<div class="card-body align-items-start">
	                    	<div class="mb-3">
	                    		'. tommusrhodus_svg_icons_pluck( $settings['icon'], 'icon icon-md' ) .'
	                    	</div>
		                     '. $settings['content'] .'
	                    	<a '. $link .'>'. $settings['badge_label'] .'</a>
	                  	</div>
	                </div>
				';

			} else {

				echo '
					<div class="card">
                    	'. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'card-img-top' ) ) .'
	                  	<div class="card-body align-items-start">
	                    	<div class="mb-3">
	                    		'. tommusrhodus_svg_icons_pluck( $settings['icon'], 'icon icon-md' ) .'
	                    	</div>
		                     '. $settings['content'] .'
	                  	</div>
	                </div>
				';

			}
 
		} elseif( 'customer-3' == $settings['layout'] ) {

			echo '
				<div class="card card-body">
                  	<div class="d-flex mb-3">
                    	<svg class="icon bg-warning" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      	<path fill-rule="evenodd" clip-rule="evenodd" d="M12.3616 17.7407L8.27722 19.888C7.78838 20.145 7.18375 19.957 6.92675 19.4682C6.82441 19.2735 6.7891 19.0505 6.82627 18.8338L7.60632 14.2858L4.30199 11.0648C3.90651 10.6793 3.89841 10.0462 4.28391 9.65073C4.43742 9.49325 4.63856 9.39076 4.8562 9.35913L9.42268 8.69559L11.4649 4.55766C11.7093 4.0624 12.3089 3.85906 12.8042 4.10349C13.0014 4.20082 13.161 4.36044 13.2583 4.55766L15.3005 8.69559L19.867 9.35913C20.4136 9.43855 20.7922 9.94599 20.7128 10.4925C20.6812 10.7102 20.5787 10.9113 20.4212 11.0648L17.1169 14.2858L17.8969 18.8338C17.9903 19.3781 17.6247 19.8951 17.0804 19.9884C16.8636 20.0256 16.6406 19.9903 16.446 19.888L12.3616 17.7407Z"
                      fill="#212529" />
                    	</svg>
	                    <svg class="icon bg-warning" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
	                      <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3616 17.7407L8.27722 19.888C7.78838 20.145 7.18375 19.957 6.92675 19.4682C6.82441 19.2735 6.7891 19.0505 6.82627 18.8338L7.60632 14.2858L4.30199 11.0648C3.90651 10.6793 3.89841 10.0462 4.28391 9.65073C4.43742 9.49325 4.63856 9.39076 4.8562 9.35913L9.42268 8.69559L11.4649 4.55766C11.7093 4.0624 12.3089 3.85906 12.8042 4.10349C13.0014 4.20082 13.161 4.36044 13.2583 4.55766L15.3005 8.69559L19.867 9.35913C20.4136 9.43855 20.7922 9.94599 20.7128 10.4925C20.6812 10.7102 20.5787 10.9113 20.4212 11.0648L17.1169 14.2858L17.8969 18.8338C17.9903 19.3781 17.6247 19.8951 17.0804 19.9884C16.8636 20.0256 16.6406 19.9903 16.446 19.888L12.3616 17.7407Z"
	                      fill="#212529" />
	                    </svg>
	                    <svg class="icon bg-warning" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
	                      <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3616 17.7407L8.27722 19.888C7.78838 20.145 7.18375 19.957 6.92675 19.4682C6.82441 19.2735 6.7891 19.0505 6.82627 18.8338L7.60632 14.2858L4.30199 11.0648C3.90651 10.6793 3.89841 10.0462 4.28391 9.65073C4.43742 9.49325 4.63856 9.39076 4.8562 9.35913L9.42268 8.69559L11.4649 4.55766C11.7093 4.0624 12.3089 3.85906 12.8042 4.10349C13.0014 4.20082 13.161 4.36044 13.2583 4.55766L15.3005 8.69559L19.867 9.35913C20.4136 9.43855 20.7922 9.94599 20.7128 10.4925C20.6812 10.7102 20.5787 10.9113 20.4212 11.0648L17.1169 14.2858L17.8969 18.8338C17.9903 19.3781 17.6247 19.8951 17.0804 19.9884C16.8636 20.0256 16.6406 19.9903 16.446 19.888L12.3616 17.7407Z"
	                      fill="#212529" />
	                    </svg>
	                    <svg class="icon bg-warning" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
	                      <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3616 17.7407L8.27722 19.888C7.78838 20.145 7.18375 19.957 6.92675 19.4682C6.82441 19.2735 6.7891 19.0505 6.82627 18.8338L7.60632 14.2858L4.30199 11.0648C3.90651 10.6793 3.89841 10.0462 4.28391 9.65073C4.43742 9.49325 4.63856 9.39076 4.8562 9.35913L9.42268 8.69559L11.4649 4.55766C11.7093 4.0624 12.3089 3.85906 12.8042 4.10349C13.0014 4.20082 13.161 4.36044 13.2583 4.55766L15.3005 8.69559L19.867 9.35913C20.4136 9.43855 20.7922 9.94599 20.7128 10.4925C20.6812 10.7102 20.5787 10.9113 20.4212 11.0648L17.1169 14.2858L17.8969 18.8338C17.9903 19.3781 17.6247 19.8951 17.0804 19.9884C16.8636 20.0256 16.6406 19.9903 16.446 19.888L12.3616 17.7407Z"
	                      fill="#212529" />
	                    </svg>
	                    <svg class="icon bg-warning" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
	                      <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3616 17.7407L8.27722 19.888C7.78838 20.145 7.18375 19.957 6.92675 19.4682C6.82441 19.2735 6.7891 19.0505 6.82627 18.8338L7.60632 14.2858L4.30199 11.0648C3.90651 10.6793 3.89841 10.0462 4.28391 9.65073C4.43742 9.49325 4.63856 9.39076 4.8562 9.35913L9.42268 8.69559L11.4649 4.55766C11.7093 4.0624 12.3089 3.85906 12.8042 4.10349C13.0014 4.20082 13.161 4.36044 13.2583 4.55766L15.3005 8.69559L19.867 9.35913C20.4136 9.43855 20.7922 9.94599 20.7128 10.4925C20.6812 10.7102 20.5787 10.9113 20.4212 11.0648L17.1169 14.2858L17.8969 18.8338C17.9903 19.3781 17.6247 19.8951 17.0804 19.9884C16.8636 20.0256 16.6406 19.9903 16.446 19.888L12.3616 17.7407Z"
	                      fill="#212529" />
	                    </svg>
                  	</div>
                  	<div class="my-md-2 flex-grow-1">
	                    <h4>'. $settings['title'] .'</h4>
                  	</div>
                  	<div class="avatar-author align-items-center">
                  		'. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'avatar' ) ) .'
                    	<div class="ml-2">
	                      	'. $settings['content'] .'
	                    </div>
                  	</div>
                </div>
			';

		} elseif( 'customer-4' == $settings['layout'] ) {

			echo '
				<div class="card card-body">
					<div class="mb-3 mb-md-4">
						'. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'avatar avatar-lg' ) ) .'
					</div>
					<div class="flex-grow-1 pt-md-3">
						<h4>'. $settings['title'] .'</h4>
					</div>
					<div class="avatar-author d-block">
						'. $settings['content'] .'
					</div>
				</div>
			';

		} elseif( 'customer-5' == $settings['layout'] ) {

			echo '
				<div class="card card-body flex-row py-4">
					'. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'avatar avatar-lg' ) ) .'
					<div class="ml-3">
						<h4>'. $settings['title'] .'</h4>
						<div class="avatar-author d-block">
							'. $settings['content'] .'
						</div>
					</div>
				</div>
			';

		} elseif( 'customer-7' == $settings['layout'] ) {

			echo '
				<div class="card card-body">
					<div class="flex-grow-1 mb-3">
						<p class="lead">'. $settings['title'] .'</p>
					</div>
					<div class="avatar-author align-items-center">
						'. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'avatar' ) ) .'
						<div class="ml-2">
							'. $settings['content'] .'
						</div>
					</div>
				</div>
			';

		} elseif( 'customer-8' == $settings['layout'] ) {

			echo '
				<a '. $link .' class="card card-article-wide flex-md-row no-gutters hover-shadow-3d">
						<div class="col-md-5 col-lg-6">
							'. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'card-img-top' ) ) .'
						</div>
						<div class="card-body d-flex flex-column justify-content-between col-auto p-4 p-lg-5">
						<div>
							'. tommusrhodus_svg_icons_pluck( $settings['icon'], 'icon icon-md mb-4' ) .'
							'. $settings['content'] .'
						</div>
						<p class="lead mb-0 text-primary font-weight-bold">'. $settings['badge_label'] .'</p>
					</div>
				</a>
			';

		}
		
	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Card_Block() );