<?php
/**
 * File:        parent-theme.php
 * Theme:       Shared Parent Theme Overrides
 *
 * @package    XtremelySocial
 */

/* Remove the parent's theme HTML patterns (no way to remove the PHP ones) */
add_filter('flatblocks_block_patterns', 'flatblocks_pro_block_patterns' );

function flatblocks_pro_block_patterns( $block_patterns ) {

	$pro_patterns = array();
	
	return  $pro_patterns;	
}

/**
 * Intercepts the block editor template discovery engine and unloads legacy file-based
 * template parts inherited from the parent theme by validating local file existence.
 */

// add_filter( 'get_block_templates', 'lumina_unload_parent_template_parts', 10, 3 );

// function lumina_unload_parent_template_parts( $query_result, $query, $template_type ) {
// 	// Only apply the filter when WordPress is gathering Template Parts
// 	if ( 'wp_template_part' !== $template_type ) {
// 		return $query_result;
// 	}
// 
// 	// Anchor to Lumina's local template parts path
// 	$child_parts_dir = get_stylesheet_directory() . '/parts/';
// 
// 	$filtered_parts = array_filter( $query_result, function( $template_part ) use ( $child_parts_dir ) {
// 		// Identify if the template part is a raw file-based theme asset
// 		if ( isset( $template_part->source ) && 'theme' === $template_part->source ) {
// 			// Construct the exact filename layout WordPress looks for
// 			$local_file = $child_parts_dir . $template_part->slug . '.html';
// 
// 			// If the file does not exist inside Lumina, it's an inherited parent file—drop it!
// 			if ( ! file_exists( $local_file ) ) {
// 				return false;
// 			}
// 		}
// 		return true;
// 	});
// 
// 	// Re-index the array values cleanly to protect the REST API collection loop
// 	return array_values( $filtered_parts );
// }

