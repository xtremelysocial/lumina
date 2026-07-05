<?php
/**
 * File:        add-body-classes.php
 * Theme:       Lumina Blocks
 *
 * Centralized Document Layout Engine (High-Performance Refactored Edition).
 * Caches heavy global style array tracking via transients and standardizes runtime context execution loops.
 *
 * @package    lumina
 */

// -------------------------------------------------------------------------
// STATIC HELPER: RUN CONTEXT QUERIES EXACTLY ONCE PER PAGE LOAD
// -------------------------------------------------------------------------
// function lumina_get_layout_context_data() {
// 
// 	static $context = null;
// 
// 	if ( null !== $context ) {
// 		return $context;
// 	}
// 
// 	$slug  = null;
// 	$color = '#ffffff';
// 
// 	if ( is_singular() && function_exists( 'lumina_get_post_primary_category_slug' ) ) {
// 		$slug  = lumina_get_post_primary_category_slug();
// 		$color = function_exists( 'lumina_get_post_primary_category_color' ) ? lumina_get_post_primary_category_color() : '#ffffff';
// 	} elseif ( is_category() ) {
// 		$cat_id = get_queried_object_id();
// 		$slug   = function_exists( 'lumina_get_category_slug' ) ? lumina_get_category_slug( $cat_id ) : null;
// 		$color  = function_exists( 'lumina_get_category_color' ) ? lumina_get_category_color( $cat_id ) : '#ffffff';
// 	}
// 
// 	$context = array( 'slug' => $slug, 'color' => $color );
// 	return $context;
// }

// Hook 1: Document Class Append Matrix
add_filter( 'body_class', 'lumina_add_body_classes', 10, 1 );

if ( ! function_exists('lumina_add_body_classes') ) :
 
	function lumina_add_body_classes( $classes ) {
		// -------------------------------------------------------------------------
		// 1. TRANSIENT CONTROLLED LUMINANCE IDENTIFICATION
		// -------------------------------------------------------------------------
		$theme_mode = get_transient( 'lumina_layout_luminance_mode' );

		if ( false === $theme_mode ) {
			// This heavy loop now executes ONLY when the transient cache expires or is cleared
			$bg_color = wp_get_global_styles( array( 'color', 'background' ) );
			if ( empty( $bg_color ) ) { $bg_color = '#ffffff'; }
		
			if ( is_string( $bg_color ) && strpos( $bg_color, 'var(--wp--preset--color--' ) !== false ) {
				preg_match( '/--wp--preset--color--([a-zA-Z0-9_-]+)/', $bg_color, $matches );
				if ( ! empty( $matches[1] ) ) {
					$bg_slug = $matches[1]; 
					$palette = wp_get_global_settings( array( 'color', 'palette', 'theme' ) );
					if ( is_array( $palette ) ) {
						foreach ( $palette as $color_obj ) {
							if ( isset( $color_obj['slug'] ) && $color_obj['slug'] === $bg_slug ) {
								$bg_color = $color_obj['color'];
								break;
							}
						}
					}
				}
			}

			$hex = str_replace( '#', '', $bg_color );
			if ( strlen( $hex ) === 3 ) {
				$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
				$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
				$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
			} elseif ( strlen( $hex ) === 6 ) {
				$r = hexdec( substr( $hex, 0, 2 ) );
				$g = hexdec( substr( $hex, 2, 2 ) );
				$b = hexdec( substr( $hex, 4, 2 ) );
			} else {
				$r = 255; $g = 255; $b = 255;
			}
		
			$rc = $r / 255; $gc = $g / 255; $bc = $b / 255;
			$rc = ( $rc <= 0.03928 ) ? $rc / 12.92 : pow( ( $rc + 0.055 ) / 1.055, 2.4 );
			$gc = ( $gc <= 0.03928 ) ? $gc / 12.92 : pow( ( $gc + 0.055 ) / 1.055, 2.4 );
			$bc = ( $bc <= 0.03928 ) ? $bc / 12.92 : pow( ( $bc + 0.055 ) / 1.055, 2.4 );
			$luminance = 0.2126 * $rc + 0.7152 * $gc + 0.0722 * $bc;
		
			$theme_mode = ( $luminance < 0.5 ) ? 'is-dark-theme' : 'is-light-theme';
			
			// Cache the value for 12 hours to take the strain off page generation loops
			set_transient( 'lumina_layout_luminance_mode', $theme_mode, 12 * HOUR_IN_SECONDS );
		}

		$classes[] = $theme_mode;
		
		// -------------------------------------------------------------------------
		// 2. ACCENT CLASS MAPPING VIA RUNTIME STATIC CACHE
		// -------------------------------------------------------------------------
// 		$context = lumina_get_layout_context_data();
// 		$slug    = $context['slug'];
// 
// 		if ( $slug && 'white' !== $slug ) {
// 			$classes[] = 'has-category-accent';
// 			$classes[] = 'category-accent-' . sanitize_html_class( $slug );
// 		}
	
		return $classes;
	}
	
endif;

// Hook 2: Document Context Custom Property Injection
// add_action( 'wp_head', 'lumina_inject_category_css_properties', 100 );
// if ( ! function_exists( 'lumina_inject_category_css_properties' ) ) :
// 	
// 	function lumina_inject_category_css_properties() {
// 		$context      = lumina_get_layout_context_data();
// 		$slug         = $context['slug'];
// 		$custom_color = $context['color'];
// 		
// 		if ( ! $slug || 'white' === $slug ) {
// 			return;
// 		}
// 		
// 		echo '<style id="lumina-category-accent-cascade">';
// 		if ( 'custom' !== $slug ) {
// 			printf( ':root { --current-category-color: var(--wp--preset--color--%s); }', esc_attr( $slug ) );
// 		} else {
// 			printf( ':root { --current-category-color: %s; }', esc_attr( $custom_color ) );
// 		}
// 		echo '</style>';
// 	}
// 
// endif;

// FLUSH CACHE WHEN GLOBAL THEME STYLES ARE SAVED OR MODIFIED
add_action( 'after_switch_theme', 'lumina_clear_luminance_transient' );
add_action( 'clean_theme_cache', 'lumina_clear_luminance_transient' );
function lumina_clear_luminance_transient() {
	delete_transient( 'lumina_layout_luminance_mode' );
}