<?php
/**
 * Auto-register SVG icons from /assets/icons/ using WP 7.1 Icon API.
 */
add_action( 'init', 'lumina_register_theme_svg_icons' );
function lumina_register_theme_svg_icons() {
	if ( ! function_exists( 'wp_register_svg_icon' ) ) {
		return;
	}

	$icon_dir = get_theme_file_path( 'assets/icons/' );
	if ( ! is_dir( $icon_dir ) ) {
		return;
	}

	foreach ( glob( $icon_dir . '*.svg' ) as $file ) {
		$filename = basename( $file, '.svg' );
		$slug     = 'lumina-' . sanitize_key( $filename );
		$svg      = file_get_contents( $file );

		if ( $svg ) {
			wp_register_svg_icon(
				$slug,
				array(
					'label' => ucwords( str_replace( array( '-', '_' ), ' ', $filename ) ),
					'svg'   => $svg,
				)
			);
		}
	}
}