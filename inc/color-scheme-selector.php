<?php
/**
 * Plugin Name:  Color Scheme Demo Switcher
 * Description:  Allows visitors to demo theme color schemes via ?color-scheme=slug parameter with persistent cookie storage.
 * Version:      1.0.0
 * Author:       XtremelySocial
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class WP_Color_Scheme_Demo {

	/**
	 * Cookie key for session persistence.
	 */
	private static $cookie_name = 'wp_demo_color_scheme';

	public static function init() {
		add_action( 'init', array( __CLASS__, 'handle_scheme_session' ) );
		add_filter( 'wp_theme_json_data_user', array( __CLASS__, 'merge_demo_theme_json' ), 20 );
		add_filter( 'body_class', array( __CLASS__, 'add_scheme_body_class' ) );
	}

	/**
	 * Listen for ?color-scheme=slug parameter and manage persistent cookie.
	 */
	public static function handle_scheme_session() {
		if ( ! isset( $_GET['color-scheme'] ) ) {
			return;
		}

		$scheme = sanitize_key( $_GET['color-scheme'] );

		if ( 'reset' === $scheme || empty( $scheme ) ) {
			setcookie( self::$cookie_name, '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN );
			unset( $_COOKIE[ self::$cookie_name ] );
		} else {
			// Persist for 7 days across site navigation
			setcookie( self::$cookie_name, $scheme, time() + ( 7 * DAY_IN_SECONDS ), COOKIEPATH, COOKIE_DOMAIN );
			$_COOKIE[ self::$cookie_name ] = $scheme;
		}
	}

	/**
	 * Get active scheme slug from GET parameter or Cookie state.
	 */
	public static function get_active_scheme() {
		if ( ! empty( $_GET['color-scheme'] ) ) {
			return sanitize_key( $_GET['color-scheme'] );
		}
		if ( ! empty( $_COOKIE[ self::$cookie_name ] ) ) {
			return sanitize_key( $_COOKIE[ self::$cookie_name ] );
		}
		return '';
	}

	/**
	 * Locate the corresponding variation JSON file in the active block theme.
	 */
	private static function locate_variation_json( $scheme ) {
		$theme_styles_dir = get_stylesheet_directory() . '/styles/';

		if ( ! is_dir( $theme_styles_dir ) ) {
			return false;
		}

		// Direct lookup: e.g. /styles/sol.json
		$exact_path = $theme_styles_dir . $scheme . '.json';
		if ( file_exists( $exact_path ) ) {
			return $exact_path;
		}

		// Fuzzy glob lookup for prefixed schemes: e.g. /styles/520-sol.json
		$matches = glob( $theme_styles_dir . '*' . $scheme . '.json' );
		if ( ! empty( $matches ) && file_exists( $matches[0] ) ) {
			return $matches[0];
		}

		return false;
	}

	/**
	 * Non-destructively merge the target JSON variation into runtime global styles.
	 */
	public static function merge_demo_theme_json( $theme_json ) {
		$scheme = self::get_active_scheme();

		if ( empty( $scheme ) || 'reset' === $scheme ) {
			return $theme_json;
		}

		$json_file = self::locate_variation_json( $scheme );

		if ( $json_file && is_readable( $json_file ) ) {
			$variation_data = json_decode( file_get_contents( $json_file ), true );

			if ( is_array( $variation_data ) ) {
				// Core WP_Theme_JSON method to apply delta settings/styles on top of main theme.json
				$theme_json->update_with( $variation_data );
			}
		}

		return $theme_json;
	}

	/**
	 * Append active variation class to <body> for targeted styling overrides.
	 */
	public static function add_scheme_body_class( $classes ) {
		$scheme = self::get_active_scheme();
		if ( $scheme && 'reset' !== $scheme ) {
			$classes[] = 'wp-color-scheme-' . esc_attr( $scheme );
		}
		return $classes;
	}
}

WP_Color_Scheme_Demo::init();