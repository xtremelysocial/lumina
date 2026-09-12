<?php
/**
 * File:        parent-theme.php
 * Theme:       Shared Parent Theme & Child Theme Exclusions
 *
 * @package     XtremelySocial
 */

namespace XtremelySocial;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ============================================================================
 * EXCLUSION CONFIGURATION
 * ============================================================================
 */

/**
 * Parent Custom Block Styles to unregister.
 */
function get_excluded_block_styles() {
// 	return 'parent';
// 	return array( 'no-padding', 'no-gap', 'thick-gap' ); //TEST
// 	return array( 'no-gap', 'thick-gap' ); //TEST
	return array( 'no-gap' ); //TEST
// 	return array(); 
}

/**
 * Parent Block Patterns to unregister.
 */
function get_excluded_block_patterns() {
// 	return array( 'page-about', 'page-home', 'page-portfolio', 'page-services', 'buttons-call-to-action-2-columns' ); //TEST
	return 'parent';
}

/**
 * Parent Global Style Variations (Color Schemes) to exclude from the Site Editor.
 */
function get_excluded_style_variations() {
	return 'parent';
// 	return array( 'Dark - Midnight Blue', 'Default w/Blue Links', 'Drop Shadows' );  //TEST
}


/**
 * ============================================================================
 * UNREGISTER FUNCTIONS
 * ============================================================================
 */

/**
 * 1. UNREGISTER PARENT BLOCK STYLES (PHP Registry)
 * Handles block styles registered via register_block_style() in PHP.
 */
function remove_parent_block_styles() {
	$excluded = get_excluded_block_styles();

	if ( empty( $excluded ) ) {
		return;
	}

	$registry       = \WP_Block_Styles_Registry::get_instance();
	$all_registered = $registry->get_all_registered();

	if ( empty( $all_registered ) ) {
		return;
	}

	$child_slug = get_stylesheet(); // e.g. 'lumina'

	foreach ( $all_registered as $block_name => $styles ) {
		foreach ( $styles as $style_name => $properties ) {
			$label = isset( $properties['label'] ) ? $properties['label'] : '';

			// CHILD SHIELD: Skip and protect child theme styles
			if ( ! empty( $child_slug ) && ( false !== stripos( $style_name, $child_slug ) || false !== stripos( $label, $child_slug ) ) ) {
				continue;
			}

			$should_unregister = false;

			if ( 'parent' === $excluded || 'all_parent' === $excluded || 'all' === $excluded || true === $excluded ) {
				$should_unregister = true;
			} elseif ( is_array( $excluded ) ) {
				foreach ( $excluded as $target ) {
					$clean_target = str_replace( '.json', '', $target );

					if ( $style_name === $clean_target || false !== stripos( $style_name, $clean_target ) || false !== stripos( $label, $clean_target ) ) {
						$should_unregister = true;
						break;
					}
				}
			}

			if ( $should_unregister ) {
				unregister_block_style( $block_name, $style_name );
			}
		}
	}
}

/**
 * 2. UNREGISTER PARENT BLOCK PATTERNS
 */
function remove_parent_block_patterns() {
	$excluded = get_excluded_block_patterns();

	if ( empty( $excluded ) ) {
		return;
	}

	$parent_slug  = get_template(); // e.g. 'flat-blocks'
	$registry     = \WP_Block_Patterns_Registry::get_instance();
	$all_patterns = $registry->get_all_registered();

	foreach ( $all_patterns as $pattern ) {
		if ( ! isset( $pattern['name'] ) ) {
			continue;
		}

		// PLUGIN & CORE SHIELD
		if ( isset( $pattern['source'] ) && in_array( $pattern['source'], array( 'plugin', 'core' ), true ) ) {
			continue;
		}

		$name              = $pattern['name'];
		$is_parent_pattern = ( 0 === strpos( $name, $parent_slug . '/' ) || 0 === strpos( $name, str_replace( '-', '', $parent_slug ) . '/' ) );

		if ( ! $is_parent_pattern ) {
			continue;
		}

		$should_unregister = false;

		if ( 'parent' === $excluded || 'all_parent' === $excluded || 'all' === $excluded || true === $excluded ) {
			$should_unregister = true;
		} elseif ( is_array( $excluded ) ) {
			foreach ( $excluded as $target ) {
				if ( $name === $target || false !== stripos( $name, $target ) ) {
					$should_unregister = true;
					break;
				}
			}
		}

		if ( $should_unregister ) {
			unregister_block_pattern( $name );
		}
	}
}

/**
 * 3. FILTER GLOBAL STYLE VARIATIONS (COLOR SCHEMES & SECTION STYLES)
 * Restored to exact working version from parent-theme_2.php.
 */
function remove_parent_style_variations( $response, $handler, $request ) {
	$route = $request->get_route();

	if ( false !== strpos( $route, '/global-styles/themes/' ) && false !== strpos( $route, '/variations' ) ) {
		$excluded   = get_excluded_style_variations();
		$child_slug = get_stylesheet();

		if ( empty( $excluded ) ) {
			return $response;
		}

		$data = $response->get_data();

		if ( ! is_array( $data ) ) {
			return $response;
		}

		$filtered = array_filter( $data, function( $variation ) use ( $excluded, $child_slug ) {
			$var_title = '';
			if ( isset( $variation['title'] ) ) {
				$var_title = is_array( $variation['title'] ) 
					? ( isset( $variation['title']['rendered'] ) ? $variation['title']['rendered'] : '' ) 
					: $variation['title'];
			}

			if ( ! empty( $child_slug ) && false !== stripos( $var_title, $child_slug ) ) {
				return true;
			}

			if ( 'parent' === $excluded || 'all_parent' === $excluded || 'all' === $excluded || true === $excluded ) {
				return false;
			}

			if ( is_array( $excluded ) ) {
				foreach ( $excluded as $target ) {
					if ( false !== stripos( $var_title, $target ) ) {
						return false;
					}
				}
			}

			return true;
		});

		$response->set_data( array_values( $filtered ) );
	}

	return $response;
}

/**
 * 4. FILTER THEME JSON BLOCK STYLE VARIATIONS (WP 6.6+)
 * Unregisters parent JSON block styles while shielding Lumina block styles.
 */
function remove_parent_theme_json_block_styles( $theme_json ) {
	$excluded_blocks = get_excluded_block_styles();

	if ( empty( $excluded_blocks ) ) {
		return $theme_json;
	}

	$data = $theme_json->get_data();

	if ( empty( $data['styles']['blocks'] ) || ! is_array( $data['styles']['blocks'] ) ) {
		return $theme_json;
	}

	// Helper to extract variation slugs strictly from Lumina (Child Theme)
	$get_child_slugs = function() {
		$slugs     = array();
		$child_dir = get_stylesheet_directory();

		// 1. Scan lumina/styles/ AND lumina/styles/blocks/ (and subfolders) for .json partials
		$styles_dirs = array(
			$child_dir . '/styles',
			$child_dir . '/styles/blocks',
		);

		foreach ( $styles_dirs as $dir ) {
			if ( is_dir( $dir ) ) {
				$files = glob( $dir . '/*.json' );
				if ( $files ) {
					foreach ( $files as $file ) {
						$contents = file_get_contents( $file );
						// Extract "slug": "my-slug" via regex
						if ( preg_match( '/"slug"\s*:\s*"([^"]+)"/', $contents, $matches ) ) {
							$slugs[] = $matches[1];
						}
						// Fallback to cleaned filename (strip leading numbers like 020-)
						$clean_name = preg_replace( '/^\d+[\-_]?/', '', basename( $file, '.json' ) );
						$slugs[]    = $clean_name;
					}
				}
			}
		}

		// 2. Scan lumina/theme.json
		$theme_json_file = $child_dir . '/theme.json';
		if ( file_exists( $theme_json_file ) ) {
			$contents = file_get_contents( $theme_json_file );
			if ( preg_match_all( '/"variations"\s*:\s*\{([^}]+)\}/s', $contents, $matches ) ) {
				foreach ( $matches[1] as $block_variations ) {
					if ( preg_match_all( '/"([^"]+)"\s*:/', $block_variations, $slug_matches ) ) {
						foreach ( $slug_matches[1] as $s ) {
							if ( ! in_array( $s, array( 'ref', 'title', 'slug', 'css' ), true ) ) {
								$slugs[] = $s;
							}
						}
					}
				}
			}
		}

		return array_unique( array_filter( $slugs ) );
	};

	$child_slugs = $get_child_slugs(); // Lumina block style slugs to keep

	foreach ( $data['styles']['blocks'] as $block_type => $block_config ) {
		if ( ! empty( $block_config['variations'] ) && is_array( $block_config['variations'] ) ) {
			foreach ( $block_config['variations'] as $var_slug => $var_data ) {

				// LUMINA SHIELD: Protect any block style defined in Lumina
				if ( in_array( $var_slug, $child_slugs, true ) ) {
					continue;
				}

				$should_remove = false;

				// Option A: Drop all parent JSON block styles
				if ( 'parent' === $excluded_blocks || 'all_parent' === $excluded_blocks || 'all' === $excluded_blocks || true === $excluded_blocks ) {
					$should_remove = true;
				} 
				// Option B: Drop targeted JSON block styles by slug (e.g. 'rounded-border')
				elseif ( is_array( $excluded_blocks ) ) {
					foreach ( $excluded_blocks as $target ) {
						$clean_target = str_replace( '.json', '', $target );
						if ( $var_slug === $clean_target || false !== stripos( $var_slug, $clean_target ) ) {
							$should_remove = true;
							break;
						}
					}
				}

				if ( $should_remove ) {
					unset( $data['styles']['blocks'][ $block_type ]['variations'][ $var_slug ] );
				}
			}

			// Clean up empty variation containers
			if ( empty( $data['styles']['blocks'][ $block_type ]['variations'] ) ) {
				unset( $data['styles']['blocks'][ $block_type ]['variations'] );
			}
		}
	}

	return new \WP_Theme_JSON_Data( $data, 'theme' );
}

/**
 * ============================================================================
 * CONTEXT-AWARE HOOK REGISTRATIONS
 * ============================================================================
 */

// A. BLOCK STYLES & PATTERNS
add_action( 'init', __NAMESPACE__ . '\remove_parent_block_styles', 9999 );

$is_rest_request = ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || ( isset( $_SERVER['REQUEST_URI'] ) && false !== strpos( $_SERVER['REQUEST_URI'], '/wp-json/' ) );

if ( is_admin() || $is_rest_request ) {
	add_action( 'init', __NAMESPACE__ . '\remove_parent_block_patterns', 99 );
}

// B. STYLE VARIATIONS & JSON BLOCK STYLES
add_action( 'rest_api_init', function() {
	add_filter( 'rest_request_after_callbacks', __NAMESPACE__ . '\remove_parent_style_variations', 10, 3 );
} );

// C. THEME JSON BLOCK STYLE VARIATIONS (WP 6.6+)
add_filter( 'wp_theme_json_data_theme', __NAMESPACE__ . '\remove_parent_theme_json_block_styles', 10 );
