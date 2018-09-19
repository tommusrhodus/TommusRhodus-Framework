<?php 

/**
 * tommusrhodus_card_wrapper_shortcode()
 * 
 * @documentation https://codex.wordpress.org/Function_Reference/add_shortcode/
 * @documentation https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_card_wrapper_shortcode' ) )){
	function tommusrhodus_card_wrapper_shortcode( $atts, $content = null ){
	
		extract( 
			shortcode_atts( 
				array(
					'custom_css_class' => ''
				), $atts 
			) 
		);
		
		$output = '
			<div class="card justify-content-center flex-grow-1 '. $custom_css_class .'">
				<div class="card-body py-4 flex-grow-0">'. do_shortcode( $content ) .'</div>
			</div>
		';
		
		return $output;
		
	}
	add_shortcode( 'tommusrhodus_card_wrapper', 'tommusrhodus_card_wrapper_shortcode' );
}

/**
 * tommusrhodus_card_wrapper_shortcode_vc()
 * 
 * @documentation https://kb.wpbakery.com/docs/inner-api/vc_map/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_card_wrapper_shortcode_vc' ) )){

	function tommusrhodus_card_wrapper_shortcode_vc(){
		vc_map( 
			array(
				"icon"                    => 'tommusrhodus-vc-block',
				"name"                    => __( "Card Wrapper", 'tommusrhodus' ),
				"base"                    => "tommusrhodus_card_wrapper",
				"category"                => __( 'Insight WP Theme', 'tommusrhodus' ),
				'as_parent'               => array( 'except' => 'tommusrhodus_tabs_content' ),
				'content_element'         => true,
				'show_settings_on_create' => false,
				"js_view"                 => 'VcColumnView',
				"params"                  => array()
			) 
		);
	}
	add_action( 'vc_before_init', 'tommusrhodus_card_wrapper_shortcode_vc' );
	
	if( class_exists( 'WPBakeryShortCodesContainer' ) ){
	    class WPBakeryShortCode_tommusrhodus_card_wrapper extends WPBakeryShortCodesContainer {}
	}
	
}