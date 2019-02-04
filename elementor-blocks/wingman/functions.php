<?php 

function add_elementor_widget_categories( $elements_manager ) {
	
	$elements_manager->add_category(
		'wingman-elements',
		array(
			'title' => 'Wingman Elements'
		)
	);

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );