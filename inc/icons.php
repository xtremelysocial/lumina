<?php
/**
 * File:        icons.php
 * Theme:       Shared Icon Block Functions
 *
 * Auto-register theme SVG icons using WP 7.1 Icon API.
 *
 * @package    XtremelySocial
 */

namespace XtremelySocial;

if ( ! defined( 'THEME_SLUG' ) ) {
	define( 'THEME_SLUG', 'lumina' );
}

if ( ! defined( 'ICON_REGISTRATION_DIR' ) ) {
	define( 'ICON_REGISTRATION_DIR', 'assets/icons/theme' );
}

add_action( 'init', __NAMESPACE__ . '\register_theme_svg_icons' );

/**
 * Register custom SVG icons using the WP 7.1 Icon API.
 */
function register_theme_svg_icons() {
	// Guard clause: check for official WP 7.1 Icon API functions
	if ( ! function_exists( 'wp_register_icon_collection' ) || ! function_exists( 'wp_register_icon' ) ) {
		return;
	}

	$icon_dir = get_theme_file_path( ICON_REGISTRATION_DIR );
	if ( ! is_dir( $icon_dir ) ) {
		return;
	}

	// 1. Register the collection using THEME_SLUG
	wp_register_icon_collection(
		THEME_SLUG,
		array(
			'label'       => __( 'Theme Icons', 'lumina' ),
			'description' => __( 'Custom icons provided by the Lumina theme.', 'lumina' ),
		)
	);

	// 2. Discover all SVG files directly from the directory
	$files = glob( trailingslashit( $icon_dir ) . '*.svg' );
	if ( empty( $files ) ) {
		return;
	}

	foreach ( $files as $file_path ) {
		$filename  = basename( $file_path, '.svg' );
		$icon_name = THEME_SLUG . '/' . sanitize_key( $filename );

		// 3. Register icon passing 'file_path' directly (lazy loaded by WP 7.1)
		wp_register_icon(
			$icon_name,
			array(
				'label'     => ucwords( str_replace( array( '-', '_' ), ' ', $filename ) ),
				'file_path' => $file_path,
			)
		);
	}
}