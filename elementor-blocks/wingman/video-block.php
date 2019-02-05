<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_tommusrhodus_video_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-video-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Video Block', 'wingman' );
	}
	
	//Return Block Icon (for blocks list)
	public function get_icon() {
		return 'eicon-call-to-action';
	}
	
	public function get_categories() {
		return [ 'wingman-elements' ];
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
				'label' => esc_html__( 'Page Heading', 'wingman' ),
			]
		);
		
		$this->add_control(
			'image', [
				'label'      => __( 'Video Cover Image', 'plugin-domain' ),
				'type'       => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		
		$this->add_control(
			'video', [
				'label'       => __( 'Video URL', 'wingman' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		if( $settings['video'] ){
					
			$cache_key = 'tr-oembed-' . md5( $settings['video'] );
			$result    = get_transient( $cache_key );

			if( !$result ){
			
				// Cache is empty, resolve oEmbed
				$result = wp_oembed_get( $settings['video'], array( 'video-block' => 'true' ) );
				
				// Cache 4 hours for standard and 5 min for failed
				$ttl = $result ? 14400 : 300;
				
				set_transient( $cache_key, $result, $ttl );
				
			}
		
		}
		
		echo '
			<div class="video-cover rounded">
			    '. wp_get_attachment_image( $settings['image']['id'], 'large', 0, array( 'class' => 'bg-image' ) ) .'
			    <div class="video-play-icon">
			        <i class="icon-controller-play"></i>
			    </div>
			    <div class="embed-responsive embed-responsive-16by9">
			        '. $result .'
			    </div>
			</div>
		';
		
	}

	protected function _content_template() {}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_tommusrhodus_video_Block() );