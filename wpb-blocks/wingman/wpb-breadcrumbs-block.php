<?php 

/**
 * tommusrhodus_breadcrumbs_shortcode()
 * 
 * @documentation https://codex.wordpress.org/Function_Reference/add_shortcode
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_breadcrumbs_shortcode' ) )){
	function tommusrhodus_breadcrumbs_shortcode( $atts, $content = null ){
	
		extract( 
			shortcode_atts( 
				array(
					'custom_css_class' => ''
				), $atts 
			) 
		);
		
		$class = ( has_excerpt() ) ? 'text-white position-absolute' : 'bg-primary text-white';
		
		return tommusrhodus_breadcrumbs( $class . ' ' . $custom_css_class );
		
	}
	add_shortcode( 'wingman_breadcrumbs', 'tommusrhodus_breadcrumbs_shortcode' );
}

/**
 * tommusrhodus_breadcrumbs_shortcode_vc()
 * 
 * @documentation https://kb.wpbakery.com/docs/inner-api/vc_map/
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_breadcrumbs_shortcode_vc' ) )){
	function tommusrhodus_breadcrumbs_shortcode_vc(){
		vc_map( 
			array(
				"icon"     => 'wingman-vc-block',
				"name"     => esc_html__( "Breadcrumbs", 'wingman' ),
				"base"     => "wingman_breadcrumbs",
				"category" => esc_html__( 'wingman WP Theme', 'wingman' ),
				"params"   => array(
					array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Extra CSS Class Name", 'wingman' ),
						"param_name"  => "custom_css_class",
						"description" => '<code>FOR DEVELOPERS</code> Add a class name and refer to it in custom CSS / JS',
					),
				)
			) 
		);
	}
	add_action( 'vc_before_init', 'tommusrhodus_breadcrumbs_shortcode_vc' );
}