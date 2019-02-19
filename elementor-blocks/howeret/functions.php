<?php 

function add_elementor_widget_categories( $elements_manager ) {
	
	$elements_manager->add_category(
		'howeret-elements',
		array(
			'title' => 'Howeret Elements'
		)
	);

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );