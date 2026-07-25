<?php
/**
 * File:        remove-core-patterns.php
 * Theme:       Shared Pattern Removal Logic
 *
 * @package    XtremelySocial
 */

/**
 * Remove core WordPress block patterns so they don't conflict with ours.
 */
if ( ! function_exists( 'lumina_remove_core_block_patterns' ) ) :

	function lumina_remove_core_block_patterns() {
		
		// Remove core WordPress block patterns
		remove_theme_support( 'core-block-patterns' );

		// Above still doesn't remove core/query, core/social-links, headers or
		// footers, so get rid of them too.
		$core_patterns = WP_Block_Patterns_Registry::get_instance()->get_all_registered();
		foreach ( $core_patterns as $pattern ) {
			if (
				! empty( $pattern['blockTypes'] ) &&
				is_array( $pattern['blockTypes'] )
				) {

				if (
					in_array( 'core/query', $pattern['blockTypes'] ) ||
					in_array( 'core/social-links', $pattern['blockTypes'] ) ||
					in_array( 'core/template-part/header', $pattern['blockTypes'] ) ||
					in_array( 'core/template-part/footer', $pattern['blockTypes'] )
				) {
					unregister_block_pattern( $pattern['name'] );
				}
			}	
		}			
	}
endif;
