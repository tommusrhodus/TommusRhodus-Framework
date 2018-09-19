<?php 

/**
 * tommusrhodus_team_shortcode()
 * 
 * @documentation https://codex.wordpress.org/Function_Reference/add_shortcode/
 * @documentation https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
 * @documentation https://developer.wordpress.org/reference/functions/wp_get_attachment_caption/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_team_shortcode' ) )){
	function tommusrhodus_team_shortcode( $atts ) {
	
		global $wp_query, $post;
		
		extract( 
			shortcode_atts( 
				array(
					'pppage' => '4',
					'filter' => 'all',
					'layout' => '1',
					'offset' => '0'
				), $atts 
			) 
		);
		
		if( 0 == $pppage || isset( $wp_query->doing_team_shortcode ) ){
			return false;	
		}
		
		/**
		 * Setup post query
		 */
		$query_args = array(
			'post_type'      => 'team',
			'post_status'    => 'publish',
			'posts_per_page' => $pppage,
			'offset'         => $offset
		);
		
		//Hide current post ID from the loop if we're in a singular view
		if( is_single() && isset( $post->ID ) ){
			$query_args['post__not_in']	= array( $post->ID );
		}
		
		if( !$filter == 'all' ){
			
			//Check for WPML
			if( has_filter( 'wpml_object_id' ) ){
			
				global $sitepress;
				
				//WPML recommended, remove filter, then add back after
				remove_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ), 10, 4 );
				
				$filterClass    = get_term_by( 'slug', $filter, 'team_category' );
				$ID             = (int) apply_filters( 'wpml_object_id', (int) $filterClass->term_id, 'team_category', true );
				$translatedSlug = get_term_by( 'id', $ID, 'team_category' );
				$filter         = $translatedSlug->slug;
				
				//Adding filter back
				add_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ), 10, 4 );
				
			}
				
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'team_category',
					'field'    => 'slug',
					'terms'    => $filter
				)
			);	
			
		}
		
		$old_query = $wp_query;
		$old_post  = $post;
		$wp_query  = new WP_Query( $query_args );
	
		$wp_query->{"doing_team_shortcode"} = 'true';
		
		ob_start();
		
		get_template_part( 'loop/loop-team', $layout );
		
		$output = ob_get_contents();
		ob_end_clean();
		
		wp_reset_postdata();
		$wp_query = $old_query;
		$post     = $old_post;
		
		return $output;
		
	}
	add_shortcode( 'tommusrhodus_team', 'tommusrhodus_team_shortcode' );
}

/**
 * tommusrhodus_team_shortcode_vc()
 * 
 * @documentation https://kb.wpbakery.com/docs/inner-api/vc_map/
 * @theme Insight
 * @since 1.0.0
 * @blame Tom Rhodes
 */
if(!( function_exists( 'tommusrhodus_team_shortcode_vc' ) )){
	function tommusrhodus_team_shortcode_vc(){
	
		vc_map( 
			array(
				"icon"        => 'tommusrhodus-vc-block',
				"name"        => __( "Team Feeds", 'tommusrhodus' ),
				"base"        => "tommusrhodus_team",
				"category"    => __( 'tommusrhodus WP Theme', 'tommusrhodus' ),
				'description' => 'Show team posts with layout options.',
				"params"      => array(
					array(
						"type"       => "textfield",
						"heading"    => __( "Show How Many Posts?", 'tommusrhodus' ),
						"param_name" => "pppage",
						"value"      => '4'
					),
					array(
						"type"       => "dropdown",
						"heading"    => __( "Team Display Type", 'tommusrhodus' ),
						"param_name" => "layout",
						"value"      => array_flip( tommusrhodus_get_team_layouts() )
					),
					array(
						"type"        => "textfield",
						"heading"     => __( "Offset Posts?", 'tommusrhodus' ),
						"param_name"  => "offset",
						"value"       => '0',
						"description" => '<code>DEVELOPERS ONLY</code> - Offset posts shown, 0 for newest posts, 5 starts at fifth most recent etc.'
					)
				)
			) 
		);
		
	}
	add_action( 'vc_before_init', 'tommusrhodus_team_shortcode_vc');
}