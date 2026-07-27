<?php
/**
 * File:        remove-core-patterns.php
 * Theme:       Shared Pattern Removal Logic
 *
 * @package     XtremelySocial
 */

namespace XtremelySocial;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 1. Disable remote pattern fetching from WordPress.org pattern directory
 */
add_filter( 'should_load_remote_block_patterns', '__return_false' );

/**
 * 2. Remove core WordPress block patterns so they don't clutter the editor design tab.
 */
function remove_core_block_patterns() {
	
	// Remove core WordPress bundled patterns (wireframes, multi-column layouts)
	remove_theme_support( 'core-block-patterns' );

	// Retrieve all currently registered pattern instances
	$registry      = \WP_Block_Patterns_Registry::get_instance();
	$core_patterns = $registry->get_all_registered();

	foreach ( $core_patterns as $pattern ) {
		$name        = $pattern['name'] ?? '';
		$categories  = $pattern['categories'] ?? [];
		$block_types = $pattern['blockTypes'] ?? [];

		// CRITICAL GUARD: Only target patterns originating strictly from core ('core/...')
		if ( 0 === strpos( $name, 'core/' ) ) {

			$is_header = in_array( 'header', $categories, true ) || 
			             in_array( 'core/template-part/header', $block_types, true ) || 
			             false !== strpos( $name, 'header' );

			$is_footer = in_array( 'footer', $categories, true ) || 
			             in_array( 'core/template-part/footer', $block_types, true ) || 
			             false !== strpos( $name, 'footer' );

			$is_query  = in_array( 'query', $categories, true ) || 
			             in_array( 'core/query', $block_types, true ) || 
			             false !== strpos( $name, 'query' );

			$is_social = in_array( 'core/social-links', $block_types, true );

			if ( $is_header || $is_footer || $is_query || $is_social ) {
				unregister_block_pattern( $name );
			}
		}
	}			
}
// Run at priority 99 to ensure core patterns finish registering first
add_action( 'init', __NAMESPACE__ . '\remove_core_block_patterns', 99 );