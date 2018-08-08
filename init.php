<?php
/**
 * Plugin Name:  TommusRhodus Framework
 * Plugin URI:   https://www.tommusrhodus.com/framework/
 * Description:  A modern framework designed and built for themes by TommusRhodus. Adds Post Types, Shortcodes, Additional Functionality etc. on a per-theme basis.
 * Author:       Tom Rhodes
 * Author URI:   https://www.tommusrhodus.com
 * Contributors: Tom Rhodes
 *
 * Version:      1.0.0
 *
 * Text Domain:  trframework
 * Domain Path:  languages
 *
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * https://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * **********************************************************************
 */
 
if( !class_exists( 'TommusRhodus_Framework' ) ){
	class TommusRhodus_Framework {
		
		// This is where we'll hold our theme support array.
		public $theme_support;
		
		/**
		 * __construct()
		 * 
		 * Standard class construction function, from here we'll setup all the actions that the framework
		 * needs to register. Each action will generally setup a theme feature, CPTs, Shortodes etc.
		 * 
		 * @since 1.0.0
		 * @blame Tom Rhodes
		 */
		public function __construct(){
			
			// First, grab the theme support for tommusrhodus-framework for us to process afterward
			add_action( 'init', array( $this, 'gather_theme_support' ), 10 );
			
			// Next, let's process the custom post types
			add_action( 'init', array( $this, 'process_custom_post_types' ), 15 );
			
			// Third, process the custom taxonomies
			add_action( 'init', array( $this, 'process_custom_post_taxonomies' ), 20 );
			
		}
		
		/**
		 * gather_theme_support()
		 * 
		 * Basic function, simply loads the theme support as registered in our theme.
		 * This is hooked to the init event which loads after the after_theme_setup event where theme support is registered.
		 * 
		 * @documentation https://developer.wordpress.org/reference/functions/add_theme_support/
		 * @documentation https://developer.wordpress.org/reference/functions/get_theme_support/
		 * @since 1.0.0
		 * @blame Tom Rhodes
		 */
		public function gather_theme_support(){
			$this->theme_support = get_theme_support( 'tommusrhodus-framework' );
		}
		
		/**
		 * process_custom_post_types()
		 * 
		 * Loops through our post_types array item (checks if it exists first) and then
		 * sends off any found to register_custom_post_type() to turn that into an actual post type registration.
		 * 
		 * @since v1.0.0
		 * @blame Tom Rhodes
		 */
		public function process_custom_post_types(){
			
			// Check that we're actually registering post types in this theme, and that it's an array.
			if( isset( $this->theme_support[0]['post_types'] ) && is_array( $this->theme_support[0]['post_types'] ) ){
				
				// Loop through all post types and send data off to register_custom_post_type()
				foreach( $this->theme_support[0]['post_types'] as $post_type => $args ){
					$this->register_custom_post_type( $post_type, $args );
				}
				
			}
			
		}
		
		/**
		 * process_custom_post_taxonomies()
		 * 
		 * Loops through our post_types taxonomies array item (checks if it exists first) and then
		 * sends off any found to register_custom_post_taxonomy() to turn that into an actual taxonomy registration.
		 * 
		 * @since 1.0.0
		 * @blame Tom Rhodes
		 */
		public function process_custom_post_taxonomies(){
			
			// Check that we're actually registering post types in this theme, and that it's an array.
			if( isset( $this->theme_support[0]['taxonomy_types'] ) && is_array( $this->theme_support[0]['taxonomy_types'] ) ){
				
				// Loop through all post types and send data off to register_custom_post_type()
				foreach( $this->theme_support[0]['taxonomy_types'] as $taxonomy_type => $args ){
					$this->register_custom_post_taxonomy( $taxonomy_type, $args );
				}
				
			}
			
		}
		
		/**
		 * register_custom_post_type()
		 * 
		 * Accepts the arguments from our processed custom post types array, turns those arguments
		 * into living, breathing post types that can be modified directly from the main theme.
		 * 
		 * @documentation https://codex.wordpress.org/Function_Reference/register_post_type
		 * @documentation https://codex.wordpress.org/Function_Reference/register_taxonomy_for_object_type
		 * @since 1.0.0
		 * @blame Tom Rhodes
		 */
		public function register_custom_post_type( $type = false, $args = false ){
			
			// Allow this CPT to use post formats (if needed) 
			register_taxonomy_for_object_type( 'post_format', $type );
			
			// All CPT arguments are registered in the theme via theme support, you can filter these also.
			if( is_array( $args ) ){
				foreach( $args as $key => $value ){
					$cpt_arguments[$key] = $value;
				}
			}
			
			// Register the post type, modify args using filter tommusrhodus_framework_cpt_{post-type}_args
		    register_post_type( $type, apply_filters( 'tommusrhodus_framework_cpt_'. $type .'_args', $cpt_arguments ) ); 
			    
		}
		
		/**
		 * register_custom_post_taxonomy()
		 * 
		 * Accepts the arguments from our processed custom taxonomy types array, turns those arguments
		 * into living, breathing post taxonomies that can be modified directly from the main theme.
		 * 
		 * @documentation https://developer.wordpress.org/reference/functions/register_taxonomy/
		 * @since 1.0.0
		 * @blame Tom Rhodes
		 */
		public function register_custom_post_taxonomy( $type = false, $args = false ){
			
			// All taxonomy arguments are registered in the theme via theme support, you can filter these also.
			if( is_array( $args ) ){
				foreach( $args as $key => $value ){
					$taxonomy_arguments[$key] = $value;
				}
			}
			
			// Register the post type, modify args using filter tommusrhodus_framework_taxonomy_{taxonomy-type}_args
			register_taxonomy( $type, $args['for_post_types'], apply_filters( 'tommusrhodus_framework_taxonomy_'. $type .'_args', $taxonomy_arguments ) );
			    
		}
		
	}
	new TommusRhodus_Framework();
}