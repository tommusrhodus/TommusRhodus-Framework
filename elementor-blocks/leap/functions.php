<?php 

function tommusrhodus_framework_add_elementor_widget_categories( $elements_manager ) {
	
	$elements_manager->add_category(
		'leap-elements',
		array(
			'title' => 'Leap Elements'
		)
	);

}
add_action( 'elementor/elements/categories_registered', 'tommusrhodus_framework_add_elementor_widget_categories', 10, 1 );

/**
 * Add option for parallax settings to Sections
 */
add_action('elementor/element/section/section_typo/after_section_end', function( $section, $args ) {
	$section->start_controls_section(
		'section_custom_class',
		[
			'label' => __( 'Parallax', 'tr-framework' ),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]
	);

	$section->add_control(
		'enable_parallax',
		[
			'label'        => __( 'Add Parallax Effect?', 'tr-framework' ),
			'type'         => Elementor\Controls_Manager::SWITCHER,
			'return_value' => 'yes',
			'default' => 'no',
		]
	);

	$section->end_controls_section();
}, 10, 2 );

/**
 * Render if parallax is enabled
 */
add_action( 'elementor/frontend/section/before_render', function( $element ) {
	// Make sure we are in a section element
	if( 'section' !== $element->get_name() ) {
		return;
	}

	$settings = $element->get_settings();

	if( 'yes' == $settings['enable_parallax'] && !empty( $settings['background_video_link'] ) ) {

		$element->add_render_attribute( '_wrapper', 'data-jarallax-video', $settings['background_video_link'] );
		$element->add_render_attribute( '_wrapper', 'data-speed', "0.5");
		$element->add_render_attribute( '_wrapper', 'class', 'jarallax' );	

	} elseif( 'yes' == $settings['enable_parallax'] ) {

		$element->add_render_attribute( '_wrapper', 'data-jarallax' );
		$element->add_render_attribute( '_wrapper', 'data-speed', "0.5");
		$element->add_render_attribute( '_wrapper', 'class', 'jarallax' );	

	}
	
});

/**
 * Login Shortcode
 */
if(!( function_exists('tommusrhodus_login_shortcode') )) {
	function tommusrhodus_login_shortcode( $atts ) {
		$find = array(
			'button button-primary'
		);
		
		$replace = array(
			'btn-block btn btn-primary'
		);
		
		return str_replace($find, $replace, wp_login_form( array( 'echo' => false ) ));
	}
	add_shortcode( 'leap_login', 'tommusrhodus_login_shortcode' );
}

/**
 * Login Shortcode
 */
if(!( function_exists('tommusrhodus_stars_shortcode') )) {
	function tommusrhodus_stars_shortcode( $atts ) {

	    $values = shortcode_atts( 
	    	array(
	        	'number_of_stars' => '5',
	    	), 
    	$atts );

	    $icon = '<svg class="icon bg-warning" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3616 17.7407L8.27722 19.888C7.78838 20.145 7.18375 19.957 6.92675 19.4682C6.82441 19.2735 6.7891 19.0505 6.82627 18.8338L7.60632 14.2858L4.30199 11.0648C3.90651 10.6793 3.89841 10.0462 4.28391 9.65073C4.43742 9.49325 4.63856 9.39076 4.8562 9.35913L9.42268 8.69559L11.4649 4.55766C11.7093 4.0624 12.3089 3.85906 12.8042 4.10349C13.0014 4.20082 13.161 4.36044 13.2583 4.55766L15.3005 8.69559L19.867 9.35913C20.4136 9.43855 20.7922 9.94599 20.7128 10.4925C20.6812 10.7102 20.5787 10.9113 20.4212 11.0648L17.1169 14.2858L17.8969 18.8338C17.9903 19.3781 17.6247 19.8951 17.0804 19.9884C16.8636 20.0256 16.6406 19.9903 16.446 19.888L12.3616 17.7407Z" fill="#212529"></path>
                </svg>';

	    $output = '<div class="d-flex mr-2">';

	    	$output .= str_repeat( $icon, $values['number_of_stars']);

	    $output .= '</div>';
	     
	    return $output;
	 
	}
	add_shortcode( 'leap_stars', 'tommusrhodus_stars_shortcode' );
}