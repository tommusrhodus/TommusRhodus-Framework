<?php 

/**
 * tommusrhodus_card_shortcode()
 * 
 * @documentation https://codex.wordpress.org/Function_Reference/add_shortcode/
 * @documentation https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_card_shortcode' ) )){
	function tommusrhodus_card_shortcode( $atts, $content = null ){
	
		extract( 
			shortcode_atts( 
				array(
					'title'            => '',
					'link'             => '',
					'image'            => '',
					'layout'           => 'image',
					'custom_css_class' => ''
				), $atts 
			) 
		);
		
		$link_output = '#';

		if( function_exists( 'vc_build_link' ) ){
			$built_link  = vc_build_link( $link );
			$link_output = $built_link['url'];
		}
		
		if( 'image' == $layout ){
		
			$output = '
				<a href="'. esc_attr( $link_output ) .'" class="card hover-effect '. $custom_css_class .'">
					'. wp_get_attachment_image( $image, 'large', 0, array( 'class' => 'card-img-top' ) ) .'
					<div class="card-body">
						<div class="d-flex justify-content-between align-items-center">
							<h6 class="mb-0">'. $title .'</h6>
							<i class="material-icons text-dark">keyboard_arrow_right</i>
						</div>
					</div>
				</a>
			';
		
		} elseif( 'text' == $layout ){
		
			$output = '
				<div class="card '. $custom_css_class .'">';

				if( $content ) {
					$output .= '<div class="card-body pb-5 pt-4">'. do_shortcode( $content ) .'</div>';					
				}					

				$output .= '
					<div class="card-footer '. $custom_css_class .'">
						<div class="d-flex align-items-center justify-content-between">
							<a href="'. esc_attr( $link_output ) .'">'. $title .'</a>
							<i class="material-icons text-dark">keyboard_arrow_right</i>
						</div>
					</div>
					
				</div>
			';
		
		} elseif( 'image_and_text' == $layout ){
		
			$output = '
				<div class="card '. $custom_css_class .'">

					'. wp_get_attachment_image( $image, 'large', 0, array( 'class' => 'card-img-top' ) ) .'

					<div class="card-body py-3">'. do_shortcode( $content ) .' </div>

					<div class="card-footer">
						<div class="d-flex align-items-center justify-content-between">
							<a href="'. esc_attr( $link_output ) .'">'. $title .'</a>
							<i class="material-icons text-dark">keyboard_arrow_right</i>
						</div>
					</div>

				</div>
			';
		
		}
		
		return $output;
		
	}
	add_shortcode( 'tommusrhodus_card', 'tommusrhodus_card_shortcode' );
}

/**
 * tommusrhodus_card_shortcode_vc()
 * 
 * @documentation https://kb.wpbakery.com/docs/inner-api/vc_map/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_card_shortcode_vc' ) )){
	function tommusrhodus_card_shortcode_vc(){
		vc_map( 
			array(
				"icon"     => 'tommusrhodus-vc-block',
				"name"     => __( "Link Card", 'tommusrhodus' ),
				"base"     => "tommusrhodus_card",
				"category" => __( 'Insight WP Theme', 'tommusrhodus' ),
				"params"   => array(
					array(
						"type"       => "dropdown",
						"heading"    => __( "Image & Text Display Type", 'tommusrhodus' ),
						"param_name" => "layout",
						"value"      => array(
							'Image and Link (No Content)'  => 'image',
							'Text and Link (No Image)'     => 'text',
							'Image, Text and Link'     	   => 'image_and_text'
						)
					),
					array(
						"type"        => "attach_image",
						"heading"     => __( "Card Image", 'tommusrhodus' ),
						"param_name"  => "image"
					),
					array(
						"type"        => "textfield",
						"heading"     => __( "Card Title", 'tommusrhodus' ),
						"param_name"  => "title",
						'holder'      => 'div'
					),
					array(
						"type"        => "vc_link",
						"heading"     => __( "Card Link", 'tommusrhodus' ),
						"param_name"  => "link"
					),
					array(
						"type"        => "textarea_html",
						"heading"     => __( "Block Content", 'tommusrhodus' ),
						"param_name"  => "content"
					),
					array(
						"type"        => "textfield",
						"heading"     => __( "Extra CSS Class Name", 'tommusrhodus' ),
						"param_name"  => "custom_css_class",
						"description" => __( '<code>FOR DEVELOPERS</code> Add a class name and refer to it in custom CSS / JS', 'tommusrhodus' ),
					),
				)
			) 
		);
	}
	add_action( 'vc_before_init', 'tommusrhodus_card_shortcode_vc' );
}