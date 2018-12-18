<?php 

/**
 * tommusrhodus_header_shortcode()
 * 
 * @documentation https://codex.wordpress.org/Function_Reference/add_shortcode/
 * @documentation https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_header_shortcode' ) )){
	function tommusrhodus_header_shortcode( $atts, $content = null ) {
	
		extract( 
			shortcode_atts( 
				array(
					'image'            => '',
					'layout'           => 'standard',
					'custom_css_class' => ''
				), $atts 
			) 
		);
		
		$output = false;
		
		if( 'standard' == $layout ){
			
			$output = '
				<div class="p-0 bg-dark '. $custom_css_class .'">
					
					'. wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'bg-image position-md-absolute opacity-80' ) ) .'
				
					<div class="container py-4 height-md-60">
						<div class="row">
							<div class="col-md-7 col-lg-6 spacer-y-3">'. do_shortcode( $content ) .'</div>
						</div>
					</div>
				
				</div>
			';
			
		} elseif( 'standard-right' == $layout ){
			
			$output = '
				<div class="p-0 bg-dark '. $custom_css_class .'">
					
					'. wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'bg-image position-md-absolute opacity-80' ) ) .'
				
					<div class="container py-4 height-md-60">
						<div class="row flex-md-row-reverse">
							<div class="col-md-7 col-lg-6 spacer-y-3">'. do_shortcode( $content ) .'</div>
						</div>
					</div>
				
				</div>
			';
			
		} elseif( 'breadcrumbs' == $layout ){
			
			$output = '
				<section class="bg-dark '. $custom_css_class .'">
					
					'. wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'bg-image opacity-50' ) ) .'

					<div class="container height-lg-30">
						<div class="row">
							<div class="col-md-8 col-lg-7 col-xl-6">
								'. get_tommusrhodus_breadcrumbs( 'breadcrumb p-0 bg-dark bg-transparent' ) .'
								'. do_shortcode( $content ) .'
							</div>
						</div>
					</div>
				
				</section>
			';
			
		} elseif( 'breadcrumbs-dark' == $layout ){
					
			$output = '
				<section class="'. $custom_css_class .'">
					
					'. wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'bg-image' ) ) .'

					<div class="container height-lg-30">
						<div class="row">
							<div class="col-md-8 col-lg-7 col-xl-6">
								'. get_tommusrhodus_breadcrumbs( 'breadcrumb p-0 bg-transparent' ) .'
								'. do_shortcode( $content ) .'
							</div>
						</div>
					</div>
				
				</section>
			';
			
		} elseif( 'gradient' == $layout ){
		
			$output = '
				<section class="bg-gradient-2">
					
					'. wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'bg-image opacity-20' ) ) .'
					
					<div class="container height-lg-50">
						<div class="row justify-content-center text-center">
							<div class="col-lg-10 col-xl-9">
								'. get_tommusrhodus_breadcrumbs( 'breadcrumb p-0 bg-dark bg-transparent justify-content-center' ) .'
								'. do_shortcode( $content ) .'
							</div>
						</div>
					</div>
					
				</section>
			';
		
		} elseif( 'half-text-half-image' == $layout ){
		
			$output = '
				<section class="row no-gutters p-0 bg-white">
					<div class="col-md-5 col-xl-6 d-flex flex-column order-md-2">

					'. wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'flex-grow-1' ) ) .'

					</div>
					<div class="col-md-7 col-xl-6 order-md-1 height-60 height-md-70">
						<div class="row no-gutters justify-content-center py-4">
							<div class="col-md-10 col-lg-9 col-xl-8 p-3">
							'. do_shortcode( $content ) .'
							</div>
						</div>
					</div>
				</section>
			';
		
		} elseif( '60-text-40-image' == $layout ){
		
			$output = '
				<section class="row no-gutters p-0 bg-white">
					<div class="col-md-3 col-lg-4 col-xl-5 d-flex flex-column order-md-2">

					'. wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'flex-grow-1' ) ) .'

					</div>
					<div class="col-md-9 col-lg-8 col-xl-7 order-md-1 height-md-60">
						<div class="row no-gutters justify-content-center w-100 py-3 py-md-4">
							<div class="col-md-11 col-lg-10 p-3">
								'. do_shortcode( $content ) .'
							</div>
						</div>
					</div>
				</section>
			';
		
		} elseif( 'standard-boxed-text' == $layout ){
		
			$output = '
				<section class="p-0 bg-dark">

					'. wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'bg-image position-md-absolute' ) ) .'

					<div class="container">
						<div class="row height-md-60">
							<div class="col-md-8 col-lg-6">
								<div class="card p-0 p-md-3 my-3">
									<div class="card-body py-md-4 py-lg-5 px-md-4">
										'. do_shortcode( $content ) .'
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			';
		
		}
		
		return $output;
		
	}
	add_shortcode( 'tommusrhodus_header', 'tommusrhodus_header_shortcode' );
}

/**
 * tommusrhodus_header_shortcode_vc()
 * 
 * @documentation https://kb.wpbakery.com/docs/inner-api/vc_map/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_header_shortcode_vc' ) )){

	function tommusrhodus_header_shortcode_vc() {
		
		vc_map( 
			array(
				"icon"                    => 'tommusrhodus-vc-block',
			    'name'                    => __( 'Header' , 'tommusrhodus' ),
			    'base'                    => 'tommusrhodus_header',
			    'description'             => __( 'Create fancy images & text', 'tommusrhodus' ),
			    'as_parent'               => array('except' => 'tommusrhodus_tabs_content' ),
			    'content_element'         => true,
			    'show_settings_on_create' => true,
			    "js_view"                 => 'VcColumnView',
			    "category"                => __( 'tommusrhodus WP Theme', 'tommusrhodus' ),
			    'params'                  => array(
			    	array(
			    		"type"       => "attach_image",
			    		"heading"    => __( "Block Image", 'tommusrhodus' ),
			    		"param_name" => "image"
			    	),
			    	array(
			    		"type"       => "dropdown",
			    		"heading"    => __( "Image & Text Display Type", 'tommusrhodus' ),
			    		"param_name" => "layout",
			    		"value"      => array(
			    			'Standard Header Text Left'                            => 'standard',
			    			'Standard Header Text Right'                           => 'standard-right',
			    			'Header with Colour Overlay & Breadcrumbs'             => 'breadcrumbs',
			    			'Header with Colour Overlay & Breadcrumbs (Dark Text)' => 'breadcrumbs-dark',
			    			'Centered Header with Gradient Background'             => 'gradient',
			    			'Half Text & Half Image'             				   => 'half-text-half-image',
			    			'60% Text & 40% Image'             				   	   => '60-text-40-image',
			    			'Standard Header Boxed Text Left'                      => 'standard-boxed-text',
			    		)
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
	add_action( 'vc_before_init', 'tommusrhodus_header_shortcode_vc' );
	
	if( class_exists( 'WPBakeryShortCodesContainer' ) ){
	    class WPBakeryShortCode_tommusrhodus_header extends WPBakeryShortCodesContainer {}
	}

}