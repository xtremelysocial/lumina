<?php
/**
 * File:	functions.php
 * Theme:	Lumina 
 * 
 * Lumina functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lumina
 * @since	1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
add_action( 'after_setup_theme', 'lumina_theme_support' );

if ( ! function_exists( 'lumina_theme_support' ) ) :

	function lumina_theme_support() {

		// Standard post thumbnail image size (16:9 aspect ratio)
		set_post_thumbnail_size( 1100, 619, array( 'left', 'top' ) );
				
		// Selectable image sizes in the Block Editor
		add_image_size( 'cropped-large', 1100, 619, array( 'left', 'top' ) );
		add_image_size( 'cropped-thumbnail', 760, 428, array( 'left', 'top' ) );
		add_image_size( 'cropped-slim', 1100, 309, true );

		// Enqueue global styles needed for the editor iframe.
		add_theme_support( 'editor-styles' );

		// Determine mode dynamically for the Site Editor canvas
		$mode_css = ( lumina_get_active_theme_mode() === 'dark' ) 
			? '/assets/css/lumina-dark-mode.css' 
			: '/assets/css/lumina-light-mode.css';
		
		$editor_styles = array(
			'/assets/css/lumina-theme.css',
			$mode_css,
			'/assets/css/lumina-engine.css',
			'/assets/css/editor-styles.css',
		);

		// Allow child themes to override the list of editor styles to load
		$editor_styles = apply_filters( 'lumina_editor_styles', $editor_styles );

		// Load the editor styles
		add_editor_style( $editor_styles ); 

		// Allow excerpts on pages
		if ( apply_filters( 'lumina_allow_page_excerpts', true ) ) {
			add_post_type_support( 'page', 'excerpt' );		
		}
	}
endif;

/**
 * Load the theme's PHP include files
 */
$includes = array (
	'/inc/add-body-classes.php',
	'/inc/default-image.php',
	'/inc/parent-theme.php',
	'/inc/block-variations.php',
	'/inc/remove-core-patterns.php',
);

$includes = apply_filters( 'lumina_load_includes', $includes );

foreach ( $includes as $include ) {
	if ( file_exists( get_stylesheet_directory() . $include ) ) {
		include_once get_stylesheet_directory() . $include;
	}
}

/**
 * Load main stylesheets and scripts on front-end
 */
add_action( 'wp_enqueue_scripts', 'lumina_load_styles', 20 );

if ( ! function_exists( 'lumina_load_styles' ) ) :

	function lumina_load_styles() {

		// Dynamically get parent theme slug ('flat-blocks') only when active as a child theme
		$deps = array();
		if ( is_child_theme() ) {
			$deps[] = get_template(); 
		}

		// 1. Core Theme CSS
		lumina_enqueue_style( 
			get_stylesheet_directory() . '/assets/css/lumina-theme.css',
			$deps
		);

		// 2. Conditionally Enqueue Light or Dark Mode
		$active_mode = lumina_get_active_theme_mode();
		$mode_file   = ( $active_mode === 'dark' ) ? 'lumina-dark-mode.css' : 'lumina-light-mode.css';

		lumina_enqueue_style( 
			get_stylesheet_directory() . '/assets/css/' . $mode_file, 
			array( 'lumina-theme' )
		);

		// 3. Lumina Engine Resting State CSS
		lumina_enqueue_style( 
			get_stylesheet_directory() . '/assets/css/lumina-engine.css', 
			array( 'lumina-theme' ) 
		);

		// 4. Lumina Engine Interactive State CSS (Front-end only)
		if ( ! is_admin() ) {
			lumina_enqueue_style( 
				get_stylesheet_directory() . '/assets/css/lumina-interactions.css', 
				array( 'lumina-engine' ) 
			);
		}

		// 5. Lumina Physics / Gravity JS (Front-end only)
		if ( ! is_admin() 
			AND apply_filters( 'lumina_card_link_js', true ) 
			AND file_exists( get_stylesheet_directory() . '/assets/js/lumina-physics.js' ) ) {

			$theme_version = wp_get_theme()->get( 'Version' ) ?? false;			
			wp_enqueue_script( 
				'lumina-physics', 
				get_stylesheet_directory_uri() . '/assets/js/lumina-physics.js', 
				array( 'jquery' ), 
				$theme_version, 
				true 
			);
		}
	}
endif;

/**
 * Load INDIVIDUAL Block CSS styles on 'init' (Applies to Front-End and Editor)
 * Strictly scans local Lumina child directory to prevent duplicate parent enqueues.
 */
add_action( 'init', 'lumina_load_block_styles' );

if ( ! function_exists( 'lumina_load_block_styles' ) ) :

	function lumina_load_block_styles() {

		$block_path = '/assets/css/blocks/';
		$main_asset = get_stylesheet_directory() . '/assets/css/lumina-theme.asset.php';

		// 1. Get build version
		if ( file_exists( $main_asset ) ) {
			$asset_data        = include $main_asset;
			$block_css_version = $asset_data['version'] ?? wp_get_theme()->get( 'Version' );
		} else {
			$block_css_version = wp_get_theme()->get( 'Version' );
		}

		// 2. REGISTER main handle early on 'init' so it exists as a valid dependency
		if ( ! wp_style_is( 'lumina-theme', 'registered' ) ) {
			$main_css_path = get_stylesheet_directory() . '/assets/css/lumina-theme.css';
			if ( file_exists( $main_css_path ) ) {
				wp_register_style(
					'lumina-theme',
					get_stylesheet_directory_uri() . '/assets/css/lumina-theme.css',
					array(),
					$block_css_version
				);
			}
		}

		// 3. Discover block CSS files strictly in Lumina child folder
		$child_dir    = get_stylesheet_directory() . $block_path;
		$block_styles = glob( $child_dir . '*.css' ); 

		if ( empty( $block_styles ) ) {
			return;
		}

		foreach ( $block_styles as $file_path ) {

			$file_slug = str_replace( array( $child_dir, '.css' ), '', $file_path );

			if ( strpos( $file_slug, 'block-styles' ) !== false || strpos( $file_slug, '-rtl' ) !== false ) {
				continue;
			}

			$parts      = explode( '_', $file_slug );
			$block_name = $parts[0];
			$handle     = "lumina-block-{$file_slug}";

			wp_enqueue_block_style( "core/{$block_name}", array(
				'handle' => $handle,
				'src'    => get_stylesheet_directory_uri() . $block_path . "{$file_slug}.css",
				'path'   => $file_path,
				'deps'	 => array(),
				'ver'	 => $block_css_version
			) );

			wp_style_add_data( $handle, 'rtl', 'replace' );
		}
	}
endif;

/**
 * Register additional block pattern categories
 */
add_action( 'init', 'lumina_register_pattern_categories' );

if ( ! function_exists( 'lumina_register_pattern_categories' ) ) :

	function lumina_register_pattern_categories() {

		$block_pattern_categories = array(
			'lumina' => array( 'label' => __( 'All Lumina', 'lumina' ) ),
		);

		$block_pattern_categories = apply_filters( 'lumina_block_pattern_categories', $block_pattern_categories );

		foreach ( $block_pattern_categories as $name => $properties ) {
			if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
				register_block_pattern_category( $name, $properties );
			}
		}	
	}
endif;

/**
 * Custom Template Part Areas
 */
add_filter( 'default_wp_template_part_areas', 'lumina_template_part_areas' );

if ( ! function_exists( 'lumina_template_part_areas' ) ) :
	function lumina_template_part_areas( array $areas ) {

		$new_areas = array( 
			array(
				'area'        => 'title',
				'area_tag'    => 'section',
				'label'       => __( 'Title', 'lumina' ),
				'description' => __( 'Page and post titles plus home page content top', 'lumina' ),
				'icon'        => ''
			),
			array(
				'area'        => 'content',
				'area_tag'    => 'section',
				'label'       => __( 'Content', 'lumina' ),
				'description' => __( 'Content section such as cover and post meta', 'lumina' ),
				'icon'        => ''
			),
			array(
				'area'        => 'menu',
				'area_tag'    => 'section',
				'label'       => __( 'Menu', 'lumina' ),
				'description' => __( 'Navigation Menus', 'lumina' ),
				'icon'        => ''
			)
		);
		return array_merge( $areas, $new_areas );
	}
endif;

/**
 * Image Size Chooser Options
 */
add_filter( 'image_size_names_choose', 'lumina_image_sizes' );

if ( ! function_exists( 'lumina_image_sizes' ) ) :
	function lumina_image_sizes( $sizes ) {
		return array_merge( $sizes, array(
			'medium-large'      => __( 'Medium Large', 'lumina' ),
			'cropped-thumbnail' => __( 'Post Thumbnail Medium (cropped)', 'lumina' ),
			'cropped-large'     => __( 'Post Thumbnail Large (cropped)', 'lumina' ),
			'cropped-slim'      => __( 'Lumina Slim Banner 16:4.5 (cropped)', 'lumina' ),
		) );
	}
endif;

/**
 * Anchor Tags for Scroll-To-Top
 */
add_action( 'wp_body_open', 'lumina_body_open' );

if ( ! function_exists( 'lumina_body_open' ) ) :
	function lumina_body_open() { 
		echo '<a id="page"></a><a id="wrapper"></a>'; 
	}
endif;

/**
 * Clean up legacy admin pages in Block Theme mode
 */
add_action( 'admin_menu', 'lumina_adjust_admin_menu', 999 );

if ( ! function_exists( 'lumina_adjust_admin_menu' ) ) :
	function lumina_adjust_admin_menu() {
		remove_submenu_page( 'themes.php', 'nav-menus.php' );
		remove_submenu_page( 'themes.php', 'widgets.php' );
	}
endif;

/**
 * Helper utility function to enqueue CSS styles with asset file versions
 */
if ( ! function_exists( 'lumina_enqueue_style' ) ) :

	function lumina_enqueue_style( $style, $custom_deps = array() ) {

		$version = wp_get_theme()->get( 'Version' ) ?? false;
		$asset   = str_replace( '.css', '.asset.php', $style );

		if ( file_exists( $asset ) ) {
			$asset_file = include( $asset );
			if ( ! empty( $asset_file['version'] ) ) {
				$version = $asset_file['version'];
			}
		}

		$uri = str_replace( 
			array( get_template_directory(), get_stylesheet_directory() ),
			array( get_template_directory_uri(), get_stylesheet_directory_uri() ), 
			$style 
		);
		
		$handle = str_replace( 
			array( get_template_directory(), get_stylesheet_directory(), '/assets/css/', 'blocks/', '.css' ), 
			'', 
			$style 
		);
		
		if ( ! empty( $custom_deps ) ) {
			$deps = $custom_deps;
		} else {
			$deps = $handle === 'lumina-theme' ? array() : array( 'lumina-theme' );
		}
		
		if ( file_exists( $style ) ) {
			wp_enqueue_style( 
				$handle, 
				$uri, 
				$deps, 
				$version
			);

			$rtl = str_replace( '.css', '-rtl.css', $style );
			if ( file_exists( $rtl ) ) {
				wp_style_add_data( $handle, 'rtl', 'replace' );
			}
		}
	} 
endif;

/**
 * Detect active theme canvas mode ('dark' vs 'light') from global settings or calculated luminance
 */
if ( ! function_exists( 'lumina_get_active_theme_mode' ) ) :

	function lumina_get_active_theme_mode() {

		$mode_setting = wp_get_global_settings( array( 'custom', 'color', 'theme', 'mode' ) );
		if ( ! empty( $mode_setting ) && is_string( $mode_setting ) ) {
			return ( strpos( $mode_setting, 'dark' ) !== false ) ? 'dark' : 'light';
		}

		$transient_key = 'xs_theme_meta_' . get_stylesheet();
		$theme_meta    = get_transient( $transient_key );

		if ( is_array( $theme_meta ) ) {
			if ( ! empty( $theme_meta['mode_class'] ) && strpos( $theme_meta['mode_class'], 'dark' ) !== false ) {
				return 'dark';
			}
			if ( ! empty( $theme_meta['bg_class'] ) && $theme_meta['bg_class'] === 'is-dark-background' ) {
				return 'dark';
			}
		}

		return 'light';
	}
endif;