<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Ajax_Content_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-ajax-content-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Gallery', 'tr-framework' );
	}
	
	//Return Block Icon (for blocks list)
	public function get_icon() {
		return 'eicon-carousel';
	}
	
	public function get_categories() {
		return [ 'missio-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'carousel_items_section', [
				'label' => __( 'Gallery Content', 'tr-framework' )
			]
		); 

		$this->add_control(
			'layout', [
				'label'   => __( 'Gallery Layout', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text-list',
				'label_block' => true,
				'options' => [
					'text-list'							=> esc_html__( 'Text List', 'tr-framework' ),		
					'filterable-select'					=> esc_html__( 'Filterable Grid, Select Filter Style', 'tr-framework' ),					
					'filterable-image-and-text-list'	=> esc_html__( 'Filterable Image & Text List', 'tr-framework' ),
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image', [
				'label'      => __( 'Gallery Image', 'tr-framework' ),
				'type'       => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'description', [
				'label'       => __( 'Description', 'tr-framework' ),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => ''
			]
		);

		$repeater->add_control(
			'overlay_caption', [
				'label'       => __( 'Overlay Caption/Button Label (Used in applicable layouts)', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'See Gallery',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'item_link', [
				'label' => __( 'Gallery Post URL', 'tr-framework' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( '#', 'tr-framework' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$repeater->add_control(
			'item_size', [
				'label'   => __( 'Item Size (Custom Grid Only)', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'col-md-4',
				'label_block' => true,
				'options' => [
					'col-md-6'			=> esc_html__( '6/12', 'tr-framework' ),
					'col-md-4'			=> esc_html__( '4/12', 'tr-framework' ),
					'col-md-3'			=> esc_html__( '3/12', 'tr-framework' ),
				],
			]
		);

		$repeater->add_control(
			'bg_color', [
				'label'   => __( 'Background Colour', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bg-white',
				'label_block' => true,
				'options' => [
					'bg-white'					=> esc_html__( 'White Background', 'tr-framework' ),
					'bg-inverse'				=> esc_html__( 'Dark Background', 'tr-framework' ),
					'bg-pastel-default'			=> esc_html__( 'Pastel Background', 'tr-framework' ),
				],
			]
		);

		$repeater->add_control(
			'item_category', [
				'label'       => __( 'Item Category? (Used for filtering)', 'tr-framework' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
			]
		);

		$this->add_control(
			'list', [
				'label'   => __( 'Carousel Content', 'tr-framework' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [],
				'title_field' => __( 'Carousel Content', 'tr-framework' ),
			]
		);		

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings = $this->get_settings_for_display();

		if( 'text-list' == $settings['layout'] ) {
		
			echo '<div id="cube-inline" class="cbp cbp-text cbp-inline-bg">';

				foreach( $settings['list'] as $item ) {

					echo '
					<div class="cbp-item">
            			<h3 class="text-uppercase"><a href="'. esc_url( $item['item_link']['url'] ) .'" class="cbp-singlePageInline">'. $item['description'] .'</a></h3>
          			</div>';					

				}

			echo '</div>';

		} elseif( 'filterable-select' == $settings['layout'] ) {

			$filter_categories = array();

			foreach( $settings['list'] as $item ) {

				$filter_categories[] = $item['item_category'];				

			}

			$filters = array_unique(array_filter($filter_categories));

			echo '
			<div class="d-flex flex-row align-items-center">
	          	<div>
	            	<div class="cbp-l-filters-dropdownTitle">Filter By:</div>
	          	</div>
	          	<div>
            		<div id="cube-inline-8-filter" class="cbp-l-filters-dropdown">
	             		<div class="cbp-l-filters-dropdownWrap">
			                <div class="cbp-l-filters-dropdownHeader">All</div>
			                <div class="cbp-l-filters-dropdownList">
			                  	<div data-filter="*" class="cbp-filter-item-active cbp-filter-item">All</div>';

			                  	foreach( $filters as $filter ) {

									echo '<div data-filter=".'. sanitize_file_name( $filter ) .'" class="cbp-filter-item">'. $filter .'</div>';			

								}

								echo '
			                </div>
		              	</div>
		            </div>
	          	</div>
        	</div>
	        <div class="clearfix"></div>
	        <div class="space20"></div>
	        <div id="cube-inline-8" class="cbp cbp-inline-top cube-inline-8">
        	';

        	$i = 0;

        	foreach( $settings['list'] as $item ) {

				echo '
					<div class="cbp-item text-center '. sanitize_file_name( $item['item_category'] ) .'">
		            	<figure class="overlay overlay4 rounded">
		            		<a href="'. esc_url( $item['item_link']['url'] ) .'" class="cbp-singlePageInline">
								'. wp_get_attachment_image( $item['image']['id'], 'large', 0 ) .'
								<figcaption class="d-flex">
				                	<div class="align-self-center mx-auto">
				                  		<h3 class="caption mb-0">'. strip_tags( $item['overlay_caption'] ) .'</h3>
				                	</div>
				              	</figcaption>
							</a>
			            </figure>
		          	</div>
				';			

				$i++;

			}

        	echo '
        	</div>
        	';

		} elseif( 'filterable-image-and-text-list' == $settings['layout'] ) {

			$filter_categories = array();

			foreach( $settings['list'] as $item ) {

				$filter_categories[] = $item['item_category'];				

			}

			$filters = array_unique(array_filter($filter_categories));

			echo '
			<div id="cube-inline-filter" class="cbp-filter-container text-center">
              	<div data-filter="*" class="cbp-filter-item-active cbp-filter-item">All</div>';

              	foreach( $filters as $filter ) {

					echo '<div data-filter=".'. sanitize_file_name( $filter ) .'" class="cbp-filter-item">'. $filter .'</div>';			

				}

				echo '
        	</div>
	        <div class="clearfix"></div>
	        <div class="space20"></div>
	        <div id="cube-inline" class="cbp cube-inline-3">
        	';

        	$i = 0;

        	foreach( $settings['list'] as $item ) {

				echo '
				<div class="cbp-item bordered cbp-item-flex '. sanitize_file_name( $item['item_category'] ) .'">
					<div class="container">
						<div class="cbp-item-inner">
							<div class="row">
								<div class="col-lg-8 offset-lg-2">
									<div class="d-flex flex-column flex-md-row justify-content-start">
										<figure class="rounded">
											'. wp_get_attachment_image( $item['image']['id'], 'large', 0, array( 'class' => 'radius' ) ) .'
										</figure>
										<div class="space30 d-md-none"></div>
										<div class="ml-50">
											'. $item['description'] .'
											<div class="space10"></div>
											<a href="'. esc_url( $item['item_link']['url'] ) .'" class="cbp-singlePageInline btn btn-white shadow">'. strip_tags( $item['overlay_caption'] ) .'</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				';			

				$i++;

			}

        	echo '
        	</div>
        	';

		}
		
	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Ajax_Content_Block() );