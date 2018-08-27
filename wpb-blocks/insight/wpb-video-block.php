<?php 

/**
 * tommusrhodus_video_shortcode()
 * 
 * @documentation https://codex.wordpress.org/Function_Reference/add_shortcode/
 * @documentation https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_video_shortcode' ) )){
	function tommusrhodus_video_shortcode( $atts, $content = null ){
	
		extract( 
			shortcode_atts( 
				array(
					'image'            => '',
					'embed'            => '',
					'custom_css_class' => ''
				), $atts 
			) 
		);
		
		if(!( '' == $embed )){
			
			$cache_key = 'tr-oembed-' . md5( $embed );
			$result    = get_transient( $cache_key );

			if( !$result ){
			
				// Cache is empty, resolve oEmbed
				$result = wp_oembed_get( $embed );
				
				// Cache 4 hours for standard and 5 min for failed
				$ttl = $result ? 14400 : 300;
				
				set_transient( $cache_key, $result, $ttl );
				
			}
		
		}
		
		$output = '
			<div class="row justify-content-around '. $custom_css_class .'">
				
				<div class="col-lg-5 align-self-center mb-3 mb-lg-0">
					<div class="pr-lg-4">'. do_shortcode( $content ) .'</div>
				</div>
				
				<div class="col-lg-6">
					<div class="video-cover rounded">
						'. wp_get_attachment_image( $image, 'large', 0, array( 'class' => 'bg-image' ) ) .'
						<div class="video-play-icon"></div>
						<div class="embed-responsive embed-responsive-16by9">'. $result .'</div>
					</div>
				</div>
				
			</div>
		';
		
		return $output;
		
	}
	add_shortcode( 'tommusrhodus_video', 'tommusrhodus_video_shortcode' );
}

/**
 * tommusrhodus_video_shortcode_vc()
 * 
 * @documentation https://kb.wpbakery.com/docs/inner-api/vc_map/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_video_shortcode_vc' ) )){
	function tommusrhodus_video_shortcode_vc(){
		vc_map( 
			array(
				"icon"     => 'tommusrhodus-vc-block',
				"name"     => __( "Video", 'tommusrhodus' ),
				"base"     => "tommusrhodus_video",
				"category" => __( 'Insight WP Theme', 'tommusrhodus' ),
				"params"   => array(
					array(
						"type"        => "textarea_html",
						"heading"     => __( "Block Content", 'tommusrhodus' ),
						"param_name"  => "content"
					),
					array(
						"type"        => "attach_image",
						"heading"     => __( "Video Still Image", 'tommusrhodus' ),
						"param_name"  => "image"
					),
					array(
						"type"        => "textfield",
						"heading"     => __( "Video Embed", 'tommusrhodus' ),
						"param_name"  => "embed",
						'description' => __( 'Enter link to video <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F">(Note: read more about available formats at WordPress codex page).</a>', 'tommusrhodus' )
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
	add_action( 'vc_before_init', 'tommusrhodus_video_shortcode_vc' );
}