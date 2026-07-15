<?php
/**
 * File:        add-body-classes.php
 * Theme:       Shared Media Engine
 *
 * Centralized Document Layout Engine (Pure Luminance Universal Format Edition).
 * Directly queries the global styles engine for the active background color
 * and calculates human-eye relative luminance to apply theme classes.
 * Supports Hex, RGB/RGBA, and HSL/HSLA color strings.
 *
 * @package    XtremelySocial
 */

namespace XtremelySocial;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// -------------------------------------------------------------------------
// CACHE ENGINE CONFIGURATION MATRIX
// -------------------------------------------------------------------------
// Change this slug per theme/child theme deployment to prevent cross-theme 
// cache bleeding.
const LUMINANCE_TRANSIENT = 'lumina_dark_or_light_theme';


// Hook 1: Document Class Append Matrix
add_filter( 'body_class', __NAMESPACE__ . '\add_body_classes', 10, 1 );

/**
 * HELPER: Converts HSL/HSLA color channels down to baseline RGB values.
 */
function hsl_to_rgb( $h, $s, $l ) {
	$h /= 360;
	$s /= 100;
	$l /= 100;

	if ( 0 == $s ) {
		$r = $g = $b = $l; // Achromatic (gray)
	} else {
		$q = $l < 0.5 ? $l * ( 1 + $s ) : $l + $s - $l * $s;
		$p = 2 * $l - $q;

		$r = hue_to_rgb( $p, $q, $h + 1/3 );
		$g = hue_to_rgb( $p, $q, $h );
		$b = hue_to_rgb( $p, $q, $h - 1/3 );
	}

	return array(
		round( $r * 255 ),
		round( $g * 255 ),
		round( $b * 255 )
	);
}

/**
 * Helper helper for HSL conversion steps.
 */
function hue_to_rgb( $p, $q, $t ) {
	if ( $t < 0 ) { $t += 1; }
	if ( $t > 1 ) { $t -= 1; }
	if ( $t < 1/6 ) { return $p + ( $q - $p ) * 6 * $t; }
	if ( $t < 1/2 ) { return $q; }
	if ( $t < 2/3 ) { return $p + ( $q - $p ) * ( 2/3 - $t ) * 6; }
	return $p;
}

if ( ! function_exists( __NAMESPACE__ . '\add_body_classes' ) ) :
 
	function add_body_classes( $classes ) {
		// DEVELOPER SWITCH: Set to true during active styling tests to bypass transient cache
		$bypass_cache = false; 

		$theme_mode = $bypass_cache ? false : get_transient( LUMINANCE_TRANSIENT );

		if ( false === $theme_mode ) {
			// 1. QUERY THE ENGINE: Tell WordPress to completely resolve the background color value
			$bg_color = wp_get_global_styles( 
				array( 'color', 'background' ), 
				array( 'transforms' => array( 'resolve-variables' ) ) 
			);
		
			// Default to white if styles are completely unassigned
			if ( empty( $bg_color ) || ! is_string( $bg_color ) ) {
				$bg_color = '#ffffff';
			}

			$r = 255; $g = 255; $b = 255;
			$bg_color = trim( $bg_color );

			// 2. PARSE THE COLOR: Extract RGB values regardless of format syntax
			
			// Case A: Hex Format (#ffffff or #fff)
			if ( 0 === strpos( $bg_color, '#' ) ) {
				$hex = str_replace( '#', '', $bg_color );
				if ( strlen( $hex ) === 3 ) {
					$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
					$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
					$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
				} elseif ( strlen( $hex ) === 6 ) {
					$r = hexdec( substr( $hex, 0, 2 ) );
					$g = hexdec( substr( $hex, 2, 2 ) );
					$b = hexdec( substr( $hex, 4, 2 ) );
				}
			} 
			// Case B: RGB / RGBA Format
			elseif ( preg_match( '/rgba?\(\s*([\d.]+)\s*[\s,]\s*([\d.]+)\s*[\s,]\s*([\d.]+)/i', $bg_color, $matches ) ) {
				$r = intval( $matches[1] );
				$g = intval( $matches[2] );
				$b = intval( $matches[3] );
			}
			// Case C: HSL / HSLA Format
			elseif ( preg_match( '/hsla?\(\s*([\d.]+)\s*[\s,]\s*([\d.]+)%\s*[\s,]\s*([\d.]+)%/i', $bg_color, $matches ) ) {
				$hsl_h = floatval( $matches[1] );
				$hsl_s = floatval( $matches[2] );
				$hsl_l = floatval( $matches[3] );

				// Run conversion helper to populate standard RGB targets
				list( $r, $g, $b ) = hsl_to_rgb( $hsl_h, $hsl_s, $hsl_l );
			}
		
			// 3. RUN LUMINOSITY FORMULA: Standard human eye relative luminance algorithm
			$rc = $r / 255; $gc = $g / 255; $bc = $b / 255;
			$rc = ( $rc <= 0.03928 ) ? $rc / 12.92 : pow( ( $rc + 0.055 ) / 1.055, 2.4 );
			$gc = ( $gc <= 0.03928 ) ? $gc / 12.92 : pow( ( $gc + 0.055 ) / 1.055, 2.4 );
			$bc = ( $bc <= 0.03928 ) ? $bc / 12.92 : pow( ( $bc + 0.055 ) / 1.055, 2.4 );
			$luminance = 0.2126 * $rc + 0.7152 * $gc + 0.0722 * $bc;
		
			$theme_mode = ( $luminance < 0.5 ) ? 'is-dark-theme' : 'is-light-theme';
			
			// -------------------------------------------------------------------------
			// LIVE URL DIAGNOSTIC INTERCEPT
			// -------------------------------------------------------------------------
// 			if ( isset( $_GET['debug'] ) ) {
// 				echo '<div style="background:#000; color:#0f0; padding:30px; font-family:monospace; font-size:16px; line-height:1.5; z-index:999999; position:relative; border-bottom:5px solid #0f0;">';
// 				echo '<h2>--- XTREAMLYSOCIAL THEME ENGINE DIAGNOSTICS ---</h2>';
// 				echo '<strong>Active Cache Slug Constant:</strong> <span style="color:#ff0;">' . esc_html( LUMINANCE_TRANSIENT ) . '</span><br>';
// 				echo '<strong>Raw Value Returned by WordPress:</strong> <span style="color:#fff; background:#222; padding:2px 6px; border-radius:3px;">' . esc_html( $bg_color ) . '</span><br>';
// 				echo '<strong>Parsed RGB Conversion Array:</strong> R: ' . $r . ' | G: ' . $g . ' | B: ' . $b . '<br>';
// 				echo '<strong>Calculated Eye Luminance:</strong> ' . round( $luminance, 4 ) . ' (Threshold: < 0.5 is Dark)<br>';
// 				echo '<strong>ASSIGNED THEME CLASS:</strong> <span style="color:#0f0; font-weight:bold;">' . $theme_mode . '</span><br>';
// 				echo '</div>';
// 				exit;
// 			}

			if ( ! $bypass_cache ) {
				set_transient( LUMINANCE_TRANSIENT, $theme_mode, 12 * HOUR_IN_SECONDS );
			}
		}

		$classes[] = $theme_mode;
	
		return $classes;
	}
	
endif;

// -------------------------------------------------------------------------
// 2. AUTOMATED TRANSIENT CACHE FLUSHING REGISTRY
// -------------------------------------------------------------------------
add_action( 'after_switch_theme', __NAMESPACE__ . '\clear_luminance_transient' );
add_action( 'clean_theme_cache', __NAMESPACE__ . '\clear_luminance_transient' );
add_action( 'save_post_wp_global_styles', __NAMESPACE__ . '\clear_luminance_transient' );

if ( ! function_exists( __NAMESPACE__ . '\clear_luminance_transient' ) ) :
	function clear_luminance_transient() {
		delete_transient( LUMINANCE_TRANSIENT );
	}
endif;