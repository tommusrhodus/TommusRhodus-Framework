<?php

/**
 * The Shortcode
 */
function tommusrhodus_flex_list_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'custom_css_class' => ''
			), $atts 
		) 
	);
	
	$output = '<ul class="list-group d-flex flex-fill '. esc_attr($custom_css_class) .'">'. do_shortcode($content) .'</ul>';

	return $output;
}
add_shortcode( 'insight_flex_list', 'tommusrhodus_flex_list_shortcode' );

/**
 * The Shortcode
 */
function tommusrhodus_flex_list_content_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'title' => '',
				'layout' => 'icon_title',
				'icon' => '',
				'custom_css_class' => ''
			), $atts 
		) 
	);

	$output = false;
		
	if( 'icon_title' == $layout ){
	
		$output = '
			<a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center flex-fill '. esc_attr($custom_css_class) .'">
			    <div class="d-flex align-items-center remove-p-margin">
			      	<i class="'. $icon .' insight-large d-block mr-3 icon"></i>
			      	<span class="mb-0 h6 mb-0">'. htmlspecialchars_decode($title) .'</span>
			    </div>
			    <i class="material-icons d-block">keyboard_arrow_right</i>
		  	</a>
		';

	} elseif( 'text_title' == $layout ){

		$output = '
			<a class="list-group-item list-group-item-action d-flex align-items-center w-100 flex-fill '. esc_attr($custom_css_class) .'" href="#">
				<div class="d-flex align-items-center">
					<div class="py-2 px-3 mr-2 text-center remove-p-margin">
						'. wpautop(do_shortcode(htmlspecialchars_decode($content))) .'
					</div>
					<span class="mb-0 h6 text-primary">'. htmlspecialchars_decode($title) .'</span>
				</div>
			</a>
		';

	}

	return $output;
}
add_shortcode( 'insight_flex_list_content', 'tommusrhodus_flex_list_content_shortcode' );

// Parent Element
function tommusrhodus_flex_list_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'insight-vc-block',
		    'name'                    => esc_html__( 'Flex List' , 'tommusrhodus' ),
		    'base'                    => 'insight_flex_list',
		    'as_parent'               => array('only' => 'insight_flex_list_content'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'         => true,
		    'show_settings_on_create' => true,
		    "js_view" => 'VcColumnView',
		    "category" => esc_html__('Insight WP Theme', 'tommusrhodus'),
		    'params'          => array(
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Extra CSS Class Name", 'tommusrhodus'),
		    		"param_name" => "custom_css_class",
		    		"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.',
		    	),
		    )
		) 
	);
}
add_action( 'vc_before_init', 'tommusrhodus_flex_list_shortcode_vc' );

// Nested Element
function tommusrhodus_flex_list_content_shortcode_vc() {

	$icons = array('Install TommusRhodus Framework' => 'Install TommusRhodus Framework');
		
	if( function_exists('tommusrhodus_get_icons') ){
		$icons = tommusrhodus_get_icons();	
	}

	vc_map( 
		array(
			"icon" => 'insight-vc-block',
		    'name'            => esc_html__('Flex List Item', 'tommusrhodus'),
		    'base'            => 'insight_flex_list_content',
		    "category" => esc_html__('Insight WP Theme', 'tommusrhodus'),
		    'content_element' => true,
		    'as_child'        => array('only' => 'insight_flex_list'), // Use only|except attributes to limit parent (separate multiple values with comma)
		    'params'          => array(
		    	array(
					"type"       => "dropdown",
					"heading"    => __( "Item Type", 'tommusrhodus' ),
					"param_name" => "layout",
					"value"      => array(
						'Icon Left and Title'  								=> 'icon_title',
						'Text Left and TItle'     							=> 'text_title',
					)
				),
				array(
					"type" => "tommusrhodus_icons",
					"heading" => esc_html__( "Click an Icon to choose", 'tommusrhodus' ),
					"param_name" => "icon",
					"value" => $icons,
					'description' => 'Type "none" or leave blank to hide icons.'
				),
		    	array(
		    		"type" => "textfield",
		    		"heading" => esc_html__("Title", 'tommusrhodus'),
		    		"param_name" => "title",
		    		'holder' => 'div'
		    	),
	            array(
	            	"type" => "textarea_html",
	            	"heading" => esc_html__("Block Content", 'tommusrhodus'),
	            	"param_name" => "content"
	            ),
	            array(
	            	"type" => "textfield",
	            	"heading" => esc_html__("Extra CSS Class Name", 'tommusrhodus'),
	            	"param_name" => "custom_css_class",
	            	"description" => '<code>DEVELOPERS ONLY</code> - Style particular content element differently - add a class name and refer to it in custom CSS.<br><br><div class="wpb_element_label">Need help with this block? Check out the <a target="_blank" href="https://www.youtube.com/watch?v=YHRpDbuybXw">Video Tutorial</a></div>',
	            ),
		    ),
		) 
	);
}
add_action( 'vc_before_init', 'tommusrhodus_flex_list_content_shortcode_vc' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_insight_flex_list extends WPBakeryShortCodesContainer {}
}

// Replace Wbc_Inner_Item with your base name from mapping for nested element
if(class_exists('WPBakeryShortCode')){
    class WPBakeryShortCode_insight_flex_list_content extends WPBakeryShortCode {}
}