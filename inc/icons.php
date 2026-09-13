<?php
/**
 * File:        icons.php
 * Theme:       Shared Icon Block Functions
 *
 * Auto-register theme SVG icons using WP 7.1 Icon API.
 * Auto-discovers sub-folders as distinct collections (e.g., /sets/general -> "Lumina General").
 *
 * @package    XtremelySocial
 */

namespace XtremelySocial;

if ( ! defined( 'THEME_SLUG' ) ) {
	define( 'THEME_SLUG', 'lumina' );
}

if ( ! defined( 'ICON_REGISTRATION_DIR' ) ) {
	define( 'ICON_REGISTRATION_DIR', 'assets/icons/sets' );
}

add_action( 'init', __NAMESPACE__ . '\register_theme_svg_icons' );

/**
 * Register custom SVG icons using the WP 7.1 Icon API across sub-folder sets.
 */
function register_theme_svg_icons() {
	// Guard clause: check for official WP 7.1 Icon API functions
	if ( ! function_exists( 'wp_register_icon_collection' ) || ! function_exists( 'wp_register_icon' ) ) {
		return;
	}

	$base_dir = get_theme_file_path( ICON_REGISTRATION_DIR );
	if ( ! is_dir( $base_dir ) ) {
		return;
	}

	// 1. Discover all sub-directories (icon sets) inside the base directory
	$set_dirs = glob( trailingslashit( $base_dir ) . '*', GLOB_ONLYDIR );

	// Fallback: If no sub-folders exist, treat the root sets directory as the default set
	if ( empty( $set_dirs ) ) {
		$set_dirs = array( $base_dir );
	}

	$theme_prefix = ucfirst( THEME_SLUG );

	foreach ( $set_dirs as $dir_path ) {
		$folder_name = basename( $dir_path );

		// Determine collection slug and human-readable label
		if ( $dir_path === $base_dir ) {
			$collection_slug  = THEME_SLUG;
			$collection_label = sprintf( __( '%s Icons', 'lumina' ), $theme_prefix );
		} else {
			$sanitized_folder = sanitize_key( $folder_name );
			$collection_slug  = THEME_SLUG . '-' . $sanitized_folder;
			$readable_folder  = ucwords( str_replace( array( '-', '_' ), ' ', $folder_name ) );
			$collection_label = sprintf( '%s %s', $theme_prefix, $readable_folder );
		}

		// Discover all SVG files in this specific set folder
		$files = glob( trailingslashit( $dir_path ) . '*.svg' );
		if ( empty( $files ) ) {
			continue;
		}

		// 2. Register the collection for this sub-folder set
		wp_register_icon_collection(
			$collection_slug,
			array(
				'label'       => $collection_label,
				'description' => sprintf(
					/* translators: %s: Collection label */
					__( 'Custom %s icon set.', 'lumina' ),
					$collection_label
				),
			)
		);

		// 3. Register each SVG icon under this collection slug
		foreach ( $files as $file_path ) {
			$filename  = basename( $file_path, '.svg' );
			$icon_name = $collection_slug . '/' . sanitize_key( $filename );

			wp_register_icon(
				$icon_name,
				array(
					'label'     => ucwords( str_replace( array( '-', '_' ), ' ', $filename ) ),
					'file_path' => $file_path,
				)
			);
		}
	}
}