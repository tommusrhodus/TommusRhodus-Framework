<?php 

/**
 * tommusrhodus_carousel_shortcode()
 * 
 * @documentation https://codex.wordpress.org/Function_Reference/add_shortcode/
 * @documentation https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
 * @documentation https://developer.wordpress.org/reference/functions/wp_get_attachment_caption/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_carousel_shortcode' ) )){
	function tommusrhodus_carousel_shortcode( $atts, $content = null ){
	
		extract( 
			shortcode_atts( 
				array(
					'image'           => '',
					'custom_css_class' => ''
				), $atts 
			) 
		);
		
		$output          = '';
		$images_exploded = explode( ',', $image );
		
		if( is_array( $images_exploded ) ){

			$output = '<div data-flickity="{ &quot;cellAlign&quot;: &quot;center&quot;, &quot;autoPlay&quot;: true, &quot;contain&quot;: true, &quot;imagesLoaded&quot;: true, &quot;wrapAround&quot;: true }" class="controls-light slider-highlight-selected '. $custom_css_class .'">';
				
			foreach( $images_exploded as $slide ){
			
				$output .= '
					<div class="col-9 col-md-5 col-lg-4">
						<a href="utility-coming-soon-1.html" class="card bg-transparent hover-effect shadow-sm">
						
							<img class="card-img-top" src="assets/img/pages/utility-coming-soon-1.jpg" alt="Coming Soon 1">
							
							<div class="card-body bg-white">
								<div class="d-flex justify-content-between align-items-center">
									<h6 class="mb-0">Coming Soon 1</h6>
									<i class="material-icons text-dark">keyboard_arrow_right</i>
								</div>
							</div>
							
						</a>
					</div>
				';
				
			}
				
			$output .= '</div>';
		
		}
		
		return $output;
		
	}
	add_shortcode( 'tommusrhodus_carousel', 'tommusrhodus_carousel_shortcode' );
}

/**
 * tommusrhodus_carousel_shortcode_vc()
 * 
 * @documentation https://kb.wpbakery.com/docs/inner-api/vc_map/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_carousel_shortcode_vc' ) )){
	function tommusrhodus_carousel_shortcode_vc(){
		vc_map( 
			array(
				"icon"     => 'tommusrhodus-vc-block',
				"name"     => __( "carousel", 'tommusrhodus' ),
				"base"     => "tommusrhodus_carousel",
				"category" => __( 'Insight WP Theme', 'tommusrhodus' ),
				"params"   => array(
					array(
						"type"        => "attach_images",
						"heading"     => __( "carousel Images", 'tommusrhodus' ),
						"param_name"  => "image"
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
	add_action( 'vc_before_init', 'tommusrhodus_carousel_shortcode_vc' );
}