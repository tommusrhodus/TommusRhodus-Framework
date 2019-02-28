<?php 

/**
 * First we need to include the SCSS compiler
 * 	
 * @docs http://leafo.github.io/scssphp/docs/
 */
require_once TommusRhodus_Framework()->path . 'skin-builder/scssphp/scss.inc.php';

// Get into correct namespace
use Leafo\ScssPhp\Compiler;

/**
 * Exception handling, stops us printing issues to the front end
 */
try {
	
	// Fire up the compiler
	$scss = new Compiler();
	
	// Set the import path to work with this theme
	$scss->setImportPaths( array( 
		TommusRhodus_Framework()->path . 'skin-builder/themes/insight/'	
	) );
	
	// Begin compiling
	$compiled = $scss->compile('@import "theme.scss";');

} catch( \Exception $e ){

    error_log( 'scssphp: Unable to compile content' );
    
    // Quit out early with we have an error
    return;
    
}

/**
 * If we've made it this far, there's no errors in generating our SCSS
 */
 
/**
 * Strip out all @import mentions from returned CSS
 */
//$compiled_no_import = preg_replace( '/\s*@import.*;\s*/iU', '', $compiled );

// Init WP Filesystem
WP_Filesystem();

// Ensure we have the global called
global $wp_filesystem;

// If the global is not set, return
if( !isset( $wp_filesystem ) ){
	return;
}

// Set dirs
$upload_dir = wp_upload_dir();
$css_dir    = trailingslashit( $upload_dir['basedir'] ) . 'insight-css';

// Check for our CSS dir
if( !$wp_filesystem->is_dir( $css_dir ) ) {
	
	// If it doesn't exist, create it
	$wp_filesystem->mkdir( $css_dir );
	
}

// Make our CSS file
$filename = trailingslashit( $css_dir ) . 'insight.css';
 
// by this point, the $wp_filesystem global should be working, so let's use it to create a file
if ( !$wp_filesystem->put_contents( $filename, $compiled, FS_CHMOD_FILE) ) {
    error_log( 'TRFramework: Could not write compiled CSS to file.' );
}