<?php 

/**
 * tommusrhodus_header_slider_shortcode_vc()
 * 
 * @documentation https://codex.wordpress.org/Function_Reference/add_shortcode/
 * @documentation https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_header_slider_shortcode' ) )){
	function tommusrhodus_header_slider_shortcode( $atts, $content = null ) {

		extract( 
			shortcode_atts( 
				array(
					'image' => '',
					'layout' => 'light-image-left',
					'opacity' => '',
					'custom_css_class' => '',
					'height' => '',
					'timing' => '7000',
					'arrows' => 'true'
				), $atts 
			) 
		);
		
		$image = explode(',', $image);
		$height = ( '' == $height ) ? '70' : $height;
		
		$output = '<section data-arrows="'. $arrows .'" data-timing="'. esc_attr($timing) .'" class="'. esc_attr($custom_css_class) .' cover height-'. $height .' imagebg text-center slider slider--ken-burns" data-arrows="true" data-paging="true"><ul class="slides">'. do_shortcode(htmlspecialchars_decode($content)) .'</ul></section>';

		return $output;
	}

	add_shortcode( 'tommusrhodus_tommusrhodus_header_slider', 'tommusrhodus_header_slider_shortcode' );

}

if(!( function_exists( 'tommusrhodus_header_slider_content_shortcode' ) )){
	function tommusrhodus_header_slider_content_shortcode( $atts, $content = null ) {
		extract( 
			shortcode_atts( 
				array(
					'image' => '',
					'opacity' => '4'
				), $atts 
			) 
		);
		
		$output = '
		    <li class="imagebg" data-overlay="'. $opacity .'">
		        <div class="background-image-holder background--top">
		            '. wp_get_attachment_image( $image, 'full' ) .'
		        </div>
		        <div class="container pos-vertical-center">
		            <div class="row">
		                <div class="col-sm-12">'. do_shortcode(htmlspecialchars_decode($content)) .'</div>
		            </div>
		        </div>
		    </li>
		';
		
		return $output;
	}

	add_shortcode( 'tommusrhodus_tommusrhodus_header_slider_content', 'tommusrhodus_header_slider_content_shortcode' );

}

/**
 * The VC Functions
 */
function tommusrhodus_header_slider_shortcode_vc() {

	vc_map( 
		array(
			"icon" 						=> 'tommusrhodus-vc-block',
			"name" 						=> __( 'Header Slider' , 'tommusrhodus' ),
			"base" 						=> "tommusrhodus_header_slider",
			"category" 					=> __( 'tommusrhodus WP Theme', 'tommusrhodus' ),
			'as_parent'               	=> array('only' => 'tommusrhodus_header_slider_content'),
			'content_element'         	=> true,
			'show_settings_on_create' 	=> true,
			"js_view" 					=> 'VcColumnView',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Hero Height", 'tommusrhodus'),
					"param_name" => "height",
					"description" => 'Leave blank for default height, enter 10, 20, 30, 40, 50, 60, 70, 80, 90 or 100 for custom height (percentage of window height)',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Timing", 'tommusrhodus'),
					"param_name" => "timing",
					'value' => '7000',
					"description" => 'Timing speed for switching slides, in milliseconds. Default 7000 (7 seconds)',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Show Arrows?", 'tommusrhodus'),
					"param_name" => "arrows",
					'value' => 'true',
					"description" => 'Show navigation arrows? <code>true</code> to show arrows, <code>false</code> to hide them',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra CSS Class Name", 'tommusrhodus'),
					"param_name" => "custom_css_class",
					"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=yoWmatY3jNU">Video Tutorial</a></div>',
				),
			)
		) 
	);
	
}
add_action( 'vc_before_init', 'tommusrhodus_header_slider_shortcode_vc' );

// Nested Element
function tommusrhodus_header_slider_content_shortcode_vc() {
	vc_map( 
		array(
			"icon" 					=> 'tommusrhodus-vc-block',
		    'name'            		=> __( 'Header Slider Content' , 'tommusrhodus' ),
		    'base'            		=> 'tommusrhodus_header_slider_content',
		    'description'     		=> __( 'A slide for the header slider.', 'tommusrhodus' ),
		    "category" 				=> __( 'tommusrhodus WP Theme', 'tommusrhodus' ),
		    'content_element' 		=> true,
		    'as_child'        		=> array('only' => 'tommusrhodus_header_slider'),
		    'params'          => array(
	            array(
	            	"type" => "attach_image",
	            	"heading" => esc_html__("Slide Background Image", 'stack'),
	            	"param_name" => "image"
	            ),
	            array(
		    		"type" => "dropdown",
		    		"heading" => __("Slide Background Image Overlay Opacity (Default 40%)", 'stack'),
		    		"param_name" => "opacity",
		    		"value" => array(
		    			'40%' => '4',
		    			'90%' => '9',
		    			'80%' => '8',
		    			'70%' => '7',
		    			'60%' => '6',
		    			'50%' => '5',
		    			'30%' => '3',
		    			'20%' => '2',
		    			'10%' => '1',
		    			'0%' => '0',
		    		)
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Slide Content", 'stack'),
	            	"param_name" => "content",
	            	'holder' => 'div'
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'tommusrhodus_header_slider_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_tommusrhodus_header_slider extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_tommusrhodus_header_slider_content extends WPBakeryShortCode {

    }
}