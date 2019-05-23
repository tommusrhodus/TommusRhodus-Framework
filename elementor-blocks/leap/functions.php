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
