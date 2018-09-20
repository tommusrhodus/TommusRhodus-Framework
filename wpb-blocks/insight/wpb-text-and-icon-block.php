<?php 

/**
 * tommusrhodus_text_icon_shortcode()
 * 
 * @documentation https://codex.wordpress.org/Function_Reference/add_shortcode/
 * @documentation https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_text_icon_shortcode' ) )){
	function tommusrhodus_text_icon_shortcode( $atts, $content = null ) {
	
		extract( 
			shortcode_atts( 
				array(
					'icon'             => 'insight-insight-1',
					'layout'           => 'card-left',
					'custom_css_class' => ''
				), $atts 
			) 
		);
		
		$output = false;
		
		if( 'card-left' == $layout ){
			
			$output = '
				<div class="card '. $custom_css_class .'">
					<div class="card-body d-sm-flex py-4">
						<i class="'. $icon .' insight-large mr-sm-3 flex-shrink-0 text-primary"></i>
						<div>'. do_shortcode( $content ) .'</div>
					</div>
				</div>
			';
			
		} elseif( 'card-top' == $layout ){
			
			$output = '
				<div class="'. $custom_css_class .' card">
					<div class="card-body py-4">
						<i class="'. $icon .' insight-large flex-shrink-0 text-primary mb-2"></i>
						<div>'. do_shortcode( $content ) .'</div>
					</div>
				</div>
			';
			
		} elseif( 'inline' == $layout ){
			
			$output = '
				<ul class="list-unstyled">
					<li class="d-flex align-items-center my-2">
						<i class="'. $icon .' insight-medium mr-3 text-primary"></i>'. do_shortcode( $content ) .'</li>
				</ul>
			';
			
		}
		
		return $output;
		
	}
	add_shortcode( 'tommusrhodus_text_icon', 'tommusrhodus_text_icon_shortcode' );
}

/**
 * tommusrhodus_text_icon_shortcode_vc()
 * 
 * @documentation https://kb.wpbakery.com/docs/inner-api/vc_map/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_text_icon_shortcode_vc' ) )){

	function tommusrhodus_text_icon_shortcode_vc() {
		
		vc_map( 
			array(
				"icon"                    => 'tommusrhodus-vc-block',
			    'name'                    => __( 'Text + Icon' , 'tommusrhodus' ),
			    'base'                    => 'tommusrhodus_text_icon',
			    'description'             => __( 'Create fancy images & text', 'tommusrhodus' ),
			    "category"                => __( 'tommusrhodus WP Theme', 'tommusrhodus' ),
			    'params'                  => array(
			    	array(
			    		"type"        => "textarea_html",
			    		"heading"     => __( "Block Content", 'tommusrhodus' ),
			    		"param_name"  => "content",
			    		'holder'      => 'div'
			    	),
			    	array(
			    		"type"       => "textfield",
			    		"heading"    => __( "Icon", 'tommusrhodus' ),
			    		"param_name" => "icon",
			    		'value'      => 'insight-insight-1'
			    	),
			    	array(
			    		"type"       => "dropdown",
			    		"heading"    => __( "Image & Text Display Type", 'tommusrhodus' ),
			    		"param_name" => "layout",
			    		"value"      => array(
			    			'Card with Icon Left'      => 'card-left',
			    			'Card with Icon Top'       => 'card-top',
			    			'Inline Icon with Heading' => 'inline'
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
	add_action( 'vc_before_init', 'tommusrhodus_text_icon_shortcode_vc' );

}