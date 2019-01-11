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
					'custom_css_class' => '',
					'link' 			   => '',
					'image' 		   => ''
				), $atts 
			) 
		);

		$link_output = '#';

		if( function_exists( 'vc_build_link' ) ){
			$built_link  = vc_build_link( $link );
			$link_output = $built_link['url'];
		}
		
		$output = false;
		
		if( 'card-left' == $layout ){

			if( $link ) {

				$output = '
					<a href="'. esc_url( $link_output ) .'" class="card flex-fill hover-effect '. $custom_css_class .'">
						<div>
							<div class="card-body d-sm-flex py-4">';
								if( $image ) {
									$output .= wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'icon mt-2 mb-3 icon' ) );
								} else {
									$output .= '<i class="'. $icon .' insight-large mr-sm-3 flex-shrink-0 text-primary"></i>';
								}						
								$output .= '
								<div class="text-dark">'. do_shortcode( $content ) .'</div>
							</div>
						</div>
					</a>
				';

			} else {

				$output = '
					<div class="card '. $custom_css_class .'">
						<div class="card-body d-sm-flex py-4">';
							if( $image ) {
								$output .= wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'icon mt-2 mb-3 icon' ) );
							} else {
								$output .= '<i class="'. $icon .' insight-large mr-sm-3 flex-shrink-0 text-primary"></i>';
							}						
							$output .= '
							<div class="text-dark">'. do_shortcode( $content ) .'</div>
						</div>
					</div>
				';

			}
		
		} elseif( 'card-top' == $layout ){

			if( $link ) {
				$output = '
					<a href="'. esc_url( $link_output ) .'" class="'. $custom_css_class .' card flex-fill hover-effect">
						<div>
							<div class="card-body py-4">';
								if( $image ) {
									$output .= wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'insight-large flex-shrink-0 text-primary mb-2' ) );
								} else {
									$output .= '<i class="'. $icon .' insight-large flex-shrink-0 text-primary mb-2"></i>';
								}						
								$output .= '						
								<div class="text-dark">'. do_shortcode( $content ) .'</div>
							</div>
						</div>
					</a>
				';
			} else {

				$output = '
					<div class="'. $custom_css_class .' card">
						<div class="card-body py-4">';
							if( $image ) {
								$output .= wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'insight-large flex-shrink-0 text-primary mb-2' ) );
							} else {
								$output .= '<i class="'. $icon .' insight-large flex-shrink-0 text-primary mb-2"></i>';
							}						
							$output .= '						
							<div class="text-dark">'. do_shortcode( $content ) .'</div>
						</div>
					</div>
				';

			}
			
		} elseif( 'card-top-centered' == $layout ){

			if( $link ) {

				$output = '
					<a href="'. esc_url( $link_output ) .'" class="'. $custom_css_class .' card flex-fill hover-effect">
						<div class="text-center">
							<div class="card-body py-4">';
								if( $image ) {
									$output .= wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'insight-large flex-shrink-0 text-primary mb-2' ) );
								} else {
									$output .= '<i class="'. $icon .' insight-large flex-shrink-0 text-primary mb-2"></i>';
								}						
								$output .= '						
								<div class="text-dark">'. do_shortcode( $content ) .'</div>
							</div>
						</div>
					</a>
				';

			} else {

				$output = '
					<div class="'. $custom_css_class .' card text-center">
						<div class="card-body py-4">';
							if( $image ) {
								$output .= wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'insight-large flex-shrink-0 text-primary mb-2' ) );
							} else {
								$output .= '<i class="'. $icon .' insight-large flex-shrink-0 text-primary mb-2"></i>';
							}						
							$output .= '						
							<div class="text-dark">'. do_shortcode( $content ) .'</div>
						</div>
					</div>
				';
			}
	
			
		} elseif( 'inline' == $layout ){

			if( $link ) {
				$output = '<a href="'. esc_url( $link_output ) .'">';
			}
			
			$output = '
				<ul class="list-unstyled">
					<li class="d-flex align-items-center my-2">';
						if( $image ) {
							$output .= wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'insight-medium mr-3 text-primary' ) ) .'<div class="text-dark">'. do_shortcode( $content ) .'</div>';
						} else {
							$output .= '<i class="'. $icon .' insight-medium mr-3 text-primary"></i><div class="text-dark">'. do_shortcode( $content ) .'</div>';
						}						
						$output .= '
					</li>
				</ul>
			';

			if( $link ) {
				$output .= '</a>';
			}
		
		} elseif( 'inline-large-icon' == $layout ){

			if( $link ) {
				$output = '<a href="'. esc_url( $link_output ) .'">';
			}
			
			$output = '
				<ul class="list-unstyled">
					<li class="d-flex align-items-center my-2">';
						if( $image ) {
							$output .= wp_get_attachment_image( $image, 'full', 0, array( 'class' => 'insight-large mr-sm-3 flex-shrink-0 text-primary' ) ) .'<div class="text-dark">'. do_shortcode( $content ) .'</div>';
						} else {
							$output .= '<i class="'. $icon .' insight-large mr-sm-3 flex-shrink-0 text-primary"></i><div class="text-dark">'. do_shortcode( $content ) .'</div>';
						}						
						$output .= '
					</li>
				</ul>
			';

			if( $link ) {
				$output .= '</a>';
			}
		
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

		$icons = array('Install TommusRhodus Framework' => 'Install TommusRhodus Framework');
		
		if( function_exists('tommusrhodus_get_icons') ){
			$icons = tommusrhodus_get_icons();	
		}
		
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
			    		"type"       => "attach_image",
			    		"heading"    => __( "Icon Image", 'tommusrhodus' ),
			    		"param_name" => "image",
			    		"description" => __( 'Will override icon font if an image is set', 'tommusrhodus' ),
			    	),
			    	array(
						"type" => "tommusrhodus_icons",
						"heading" => esc_html__( "Click an Icon to choose", 'tommusrhodus' ),
						"param_name" => "icon",
						"value" => $icons,
						'description' => 'Type "none" or leave blank to hide icons.'
					),
			    	array(
			    		"type"       => "dropdown",
			    		"heading"    => __( "Image & Text Display Type", 'tommusrhodus' ),
			    		"param_name" => "layout",
			    		"value"      => array(
			    			'Card with Icon Left'      			=> 'card-left',
			    			'Card with Icon Top'       			=> 'card-top',
			    			'Card with Icon Top Centered'		=> 'card-top-centered',
			    			'Inline Icon with Heading' 			=> 'inline',
			    			'Inline Large Icon with Heading'	=> 'inline-large-icon'
			    		)
			    	),
			    	array(
						"type"        => "vc_link",
						"heading"     => __( "Link", 'tommusrhodus' ),
						"param_name"  => "link"
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