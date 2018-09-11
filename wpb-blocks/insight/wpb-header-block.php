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
			    			'Standard Header Text Left'  => 'standard',
			    			'Standard Header Text Right' => 'standard-right',
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