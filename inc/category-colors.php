<?php
/**
 * File:        category-colors.php
 * Theme:       Shared Media Engine
 *
 * Fluid Theme Variation Architecture for Categories (Universal HSL Edition).
 *
 * @package     XtremelySocial
 */

namespace XtremelySocial;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*-----------------------------------------------------------------------------
# Lumina Post Category Colors - ADD THIS TO CSS STYLESHEET FOR THIS TO WORK
-----------------------------------------------------------------------------*/

/* Force the heading separator variable to inherit the active category token */
// .has-category-accent {
//     --wp--custom--color--heading--separator: var(--current-category-color);
// }

/* Add a smooth accent bar on top of your slim banner layouts */
// .has-category-accent .wp-block-template-part .wp-block-cover {
//     border-top: 3px solid var(--current-category-color);
// }

// -------------------------------------------------------------------------
// 1. BACKEND & FRONTEND DIAGNOSTIC INTERCEPTOR
// -------------------------------------------------------------------------
// add_action( 'admin_init', function() {
// 	if ( isset( $_GET['debug'] ) ) {
// 		echo '<div style="background:#111; color:#fff; padding:30px; font-family:monospace; font-size:16px; border:4px solid #ffb700; z-index:999999; position:relative; max-width:800px; margin:50px auto; box-shadow:0 20px 40px rgba(0,0,0,0.5); border-radius:8px;">';
// 		echo '<h2 style="color:#ffb700; margin-top:0;">--- XTREMELYSOCIAL CATEGORY ENGINE (HSL EDITION) ---</h2>';
// 		echo '<strong>File Execution Status:</strong> <span style="color:#0f0;">ACTIVE & RUNNING</span><br>';
// 		echo '<strong>Current Namespace:</strong> ' . __NAMESPACE__ . '<br><br>';
// 		echo '<strong>Hooks Status:</strong><ul style="line-height:1.8;">';
// 		echo '<li>Column Registration: ' . ( has_filter( 'manage_edit-category_columns', __NAMESPACE__ . '\register_category_color_column' ) ? '✅ ONLINE' : '❌ OFFLINE' ) . '</li>';
// 		echo '<li>Column Population: ' . ( has_filter( 'manage_category_custom_column', __NAMESPACE__ . '\populate_category_color_column' ) ? '✅ ONLINE' : '❌ OFFLINE' ) . '</li>';
// 		echo '</ul>';
// 		echo '</div>';
// 		exit;
// 	}
// });

// -------------------------------------------------------------------------
// 2. STATIC HELPER: RUN CONTEXT QUERIES EXACTLY ONCE PER PAGE LOAD
// -------------------------------------------------------------------------
function get_layout_context_data() {
	static $context = null;

	if ( null !== $context ) {
		return $context;
	}

	$slug  = null;
	$color = 'hsl(0, 0%, 100%)';

	if ( is_singular() ) {
		$slug  = get_post_primary_category_slug();
		$color = get_post_primary_category_color();
	} elseif ( is_category() ) {
		$cat_id = get_queried_object_id();
		$slug   = get_category_slug( $cat_id );
		$color  = get_category_color( $cat_id );
	}

	$context = array( 'slug' => $slug, 'color' => $color );
	return $context;
}

// -------------------------------------------------------------------------
// 3. STANDALONE FRONT-END INJECTION HOOKS
// -------------------------------------------------------------------------
add_filter( 'body_class', __NAMESPACE__ . '\category_add_body_classes', 11, 1 );
function category_add_body_classes( $classes ) {
	$context = get_layout_context_data();
	$slug    = $context['slug'];

	if ( $slug && 'white' !== $slug ) {
		$classes[] = 'has-category-accent';
		$classes[] = 'category-accent-' . sanitize_html_class( $slug );
	}

	return $classes;
}

add_action( 'wp_head', __NAMESPACE__ . '\inject_category_css_properties', 100 );
function inject_category_css_properties() {
	$context      = get_layout_context_data();
	$slug         = $context['slug'];
	$custom_color = $context['color'];
	
// 	if ( isset( $_GET['debug'] ) && ! is_admin() ) {
// 		echo '<!-- !!! XTREMELYSOCIAL FRONTEND DIAGNOSTIC MAPPING !!! -->';
// 		echo '<div style="background:#222; color:#fff; padding:20px; border-left:5px solid #0073aa; font-family:monospace; font-size:14px; margin:20px; position:relative; z-index:99999;">';
// 		echo '<strong>[Category Style Debug]</strong><br>';
// 		echo 'Active Page Context Slug: <span style="color:#ffb700;">' . esc_html( var_export( $slug, true ) ) . '</span><br>';
// 		echo 'Active Page Context Color: <span style="color:#0f0;">' . esc_html( $custom_color ) . '</span><br>';
// 		echo '</div>';
// 	}

	if ( ! $slug || 'white' === $slug ) {
		return;
	}
	
	echo '<style id="xtremelysocial-category-accent-cascade">';
	if ( 'custom' !== $slug ) {
		printf( ':root { --current-category-color: var(--wp--preset--color--%s); }', esc_attr( $slug ) );
	} else {
		printf( ':root { --current-category-color: %s; }', esc_attr( $custom_color ) );
	}
	echo '</style>';
}

/**
 * 4. THE PALETTE MAPPING ENGINE (UPDATED FOR DYNAMIC HSL VALUE STRINGS)
 */
function get_theme_palette_mapping() {
	// Replaced 'dark' and 'dark-alt' with your clean dark-mode friendly targets
	$target_slugs = [
		'primary',
		'primary-alt',
		'secondary',
		'secondary-alt',
		'tertiary',
		'tertiary-alt',
		'primary-subtle-alt',
		'secondary-subtle-alt'
	];
	
	$palette_by_slug  = [];
	$slug_by_palette  = [];

	if ( function_exists( 'wp_get_global_settings' ) ) {
		$theme_palette  = wp_get_global_settings( array( 'color', 'palette', 'theme' ) );
		$custom_palette = wp_get_global_settings( array( 'color', 'palette', 'custom' ) );
		
		$merged_palette = array_merge( 
			is_array( $custom_palette ) ? $custom_palette : [], 
			is_array( $theme_palette ) ? $theme_palette : [] 
		);

		if ( ! empty( $merged_palette ) ) {
			foreach ( $merged_palette as $color_node ) {
				if ( ! empty( $color_node['color'] ) && is_string( $color_node['color'] ) && ! empty( $color_node['slug'] ) ) {
					// Universal string parsing: removes strict hex checks to capture raw HSL configurations
					$normalized_color = strtolower( trim( $color_node['color'] ) );
					$palette_by_slug[ $color_node['slug'] ] = $color_node['color'];
					$slug_by_palette[ $normalized_color ] = $color_node['slug'];
				}
			}
		}
	}

	$final_slug_to_color = [];
	$final_color_to_slug = [];

	foreach ( $target_slugs as $slug ) {
		if ( isset( $palette_by_slug[ $slug ] ) ) {
			$final_slug_to_color[ $slug ] = $palette_by_slug[ $slug ];
			$final_color_to_slug[ strtolower( trim( $palette_by_slug[ $slug ] ) ) ] = $slug;
		}
	}

	if ( count( $final_slug_to_color ) < 8 && ! empty( $slug_by_palette ) ) {
		foreach ( $slug_by_palette as $color_val => $slug ) {
			if ( count( $final_slug_to_color ) >= 8 ) {
				break;
			}
			if ( ! isset( $final_slug_to_color[ $slug ] ) ) {
				$final_slug_to_color[ $slug ] = $color_val;
				$final_color_to_slug[ strtolower( trim( $color_val ) ) ] = $slug;
			}
		}
	}

	// Structural Fallbacks systematically refactored down to pure semantic HSL values
	if ( empty( $final_slug_to_color ) ) {
		$fallbacks = [
			'primary'              => 'hsl(243, 75%, 59%)',
			'primary-alt'          => 'hsl(199, 89%, 48%)',
			'secondary'            => 'hsl(187, 92%, 38%)',
			'secondary-alt'        => 'hsl(161, 84%, 39%)',
			'tertiary'             => 'hsl(84, 81%, 44%)',
			'tertiary-alt'         => 'hsl(45, 93%, 47%)',
			'primary-subtle-alt'   => 'hsl(243, 30%, 25%)',
			'secondary-subtle-alt' => 'hsl(187, 30%, 25%)'
		];
		foreach ( $fallbacks as $s => $c ) {
			$final_slug_to_color[ $s ] = $c;
			$final_color_to_slug[ strtolower( $c ) ] = $s;
		}
	}

	return [
		'slug_to_hex'   => $final_slug_to_color, 
		'hex_to_slug'   => $final_color_to_slug,
		'ordered_slugs' => array_keys( $final_slug_to_color ),
		'ordered_hexes' => array_values( $final_slug_to_color )
	];
}

/**
 * 5. RESOLUTION ENGINE (THE ABSTRACTION LAYER)
 */
function get_category_default_slug( $term_id ) {
	$mapping = get_theme_palette_mapping();
	$slugs   = $mapping['ordered_slugs'];
	$index   = abs( intval( $term_id ) ) % count( $slugs );
	return $slugs[ $index ];
}

function get_category_default_color( $term_id ) {
	$mapping      = get_theme_palette_mapping();
	$default_slug = get_category_default_slug( $term_id );
	return isset( $mapping['slug_to_hex'][ $default_slug ] ) ? $mapping['slug_to_hex'][ $default_slug ] : 'hsl(0, 0%, 100%)';
}

function get_category_color( $term_id ) {
	if ( ! $term_id ) {
		return 'hsl(0, 0%, 100%)';
	}
	
	$raw_meta = get_term_meta( $term_id, 'lumina_category_color', true );
	$mapping  = get_theme_palette_mapping();

	if ( ! $raw_meta ) {
		return get_category_default_color( $term_id );
	}

	// Format Matcher A: Accept Standard Hex color definitions
	if ( preg_match( '/^#[a-f0-9]{3,6}$/i', $raw_meta ) ) {
		return $raw_meta;
	}

	// Format Matcher B: Accept functional HSL or RGB structural color strings
	if ( preg_match( '/^(hsl|rgb)a?\(.*\)$/i', $raw_meta ) ) {
		return $raw_meta;
	}

	if ( isset( $mapping['slug_to_hex'][ $raw_meta ] ) ) {
		return $mapping['slug_to_hex'][ $raw_meta ];
	}

	return 'hsl(0, 0%, 100%)';
}

function get_category_slug( $term_id ) {
	if ( ! $term_id ) {
		return 'white';
	}
	
	$raw_meta = get_term_meta( $term_id, 'lumina_category_color', true );
	if ( ! $raw_meta ) {
		return get_category_default_slug( $term_id );
	}

	// Identifies custom color definitions regardless of HSL or HEX notation syntax
	if ( 0 === strpos( $raw_meta, '#' ) || preg_match( '/^(hsl|rgb)a?\(.*\)$/i', $raw_meta ) ) {
		return 'custom'; 
	}

	return $raw_meta;
}

/**
 * 6. ADMIN INTERFACE & ENQUEUES
 */
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\enqueue_category_color_picker' );
function enqueue_category_color_picker( $hook ) {
	$screen = get_current_screen();
	
	if ( isset( $screen->taxonomy ) && 'category' === $screen->taxonomy ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		
		$mapping = get_theme_palette_mapping();
		
		$inline_js = sprintf(
			"jQuery(document).ready(function($){
				$('.xtremelysocial-color-field').wpColorPicker({
					palettes: %s
				});
			});",
			json_encode( $mapping['ordered_hexes'] )
		);
		
		wp_add_inline_script( 'wp-color-picker', $inline_js );
	}
}

/**
 * 7. ADMIN INTERFACE FORM FIELDS
 */
add_action( 'category_add_form_fields', __NAMESPACE__ . '\add_category_color_field', 10, 1 );
function add_category_color_field( $taxonomy ) {
	$mapping = get_theme_palette_mapping();
	$default_hex = ! empty( $mapping['ordered_hexes'] ) ? $mapping['ordered_hexes'][0] : 'hsl(0, 0%, 100%)';
	?>
	<div class="form-field term-color-wrap">
		<label for="lumina_category_color"><?php _e( 'Category Color Accent', 'lumina' ); ?></label>
		<input type="text" name="lumina_category_color" id="lumina_category_color" class="xtremelysocial-color-field" value="" data-default-color="<?php echo esc_attr( $default_hex ); ?>" />
		<p class="description"><?php _e( 'Choose a signature accent color for this category label. Leave blank to use automated palette distribution.', 'lumina' ); ?></p>
	</div>
	<?php
}

add_action( 'category_edit_form_fields', __NAMESPACE__ . '\edit_category_color_field', 10, 2 );
function edit_category_color_field( $term, $taxonomy ) {
	$resolved_hex     = get_category_color( $term->term_id );
	$true_default_hex = get_category_default_color( $term->term_id );
	?>
	<tr class="form-field term-color-wrap">
		<th scope="row"><label for="lumina_category_color"><?php _e( 'Category Color Accent', 'lumina' ); ?></label></th>
		<td>
			<input type="text" name="lumina_category_color" id="lumina_category_color" class="xtremelysocial-color-field" value="<?php echo esc_attr( $resolved_hex ); ?>" data-default-color="<?php echo esc_attr( $true_default_hex ); ?>" />
			<p class="description"><?php _e( 'Choose a signature accent color from your theme palette. Hitting "Clear" or "Default" restores your theme\'s automated ID calculation.', 'lumina' ); ?></p>
		</td>
	</tr>
	<?php
}

/**
 * 8. DATABASE INTERCEPT (PROTECTS HSL FUNCTIONAL STRING STRIPPING)
 */
add_action( 'created_category', __NAMESPACE__ . '\save_category_color', 10, 1 );
add_action( 'edited_category', __NAMESPACE__ . '\save_category_color', 10, 1 );
function save_category_color( $term_id ) {
	if ( isset( $_POST['lumina_category_color'] ) ) {
		$raw_input   = trim( $_POST['lumina_category_color'] );
		$mapping     = get_theme_palette_mapping();
		$clean_input = strtolower( $raw_input );
		
		// If input matches an internal value mapping from global palette trees
		if ( isset( $mapping['hex_to_slug'][ $clean_input ] ) ) {
			update_term_meta( $term_id, 'lumina_category_color', sanitize_key( $mapping['hex_to_slug'][ $clean_input ] ) );
			return;
		}
		
		// Intercept raw styling codes without destroying functional parameters
		if ( 0 === strpos( $raw_input, '#' ) ) {
			update_term_meta( $term_id, 'lumina_category_color', sanitize_hex_color( $raw_input ) );
		} elseif ( preg_match( '/^(hsl|rgb)a?\(.*\)$/i', $raw_input ) ) {
			// Protects HSL strings from sanitize_key string truncation drops
			update_term_meta( $term_id, 'lumina_category_color', sanitize_text_field( $raw_input ) );
		} else {
			update_term_meta( $term_id, 'lumina_category_color', sanitize_key( $raw_input ) );
		}
	}
}

/**
 * 9. FRONT-END LOOP INTEGRATION HELPERS
 */
function get_post_primary_category_id( $post_id = null ) {
	$pid = $post_id ? $post_id : get_the_ID();
	if ( ! $pid ) {
		return null;
	}

	$yoast_primary = get_post_meta( $pid, '_yoast_wpseo_primary_category', true );
	if ( $yoast_primary ) {
		return intval( $yoast_primary );
	}

	$rank_math_primary = get_post_meta( $pid, 'rank_math_primary_category', true );
	if ( $rank_math_primary ) {
		return intval( $rank_math_primary );
	}

	$categories = get_the_category( $pid );
	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
		return $categories[0]->term_id;
	}

	return null;
}

function get_post_primary_category_color( $post_id = null ) {
	$category_id = get_post_primary_category_id( $post_id );
	return $category_id ? get_category_color( $category_id ) : 'hsl(0, 0%, 100%)';
}

function get_post_primary_category_slug( $post_id = null ) {
	$category_id = get_post_primary_category_id( $post_id );
	return $category_id ? get_category_slug( $category_id ) : 'white';
}

/**
 * 10. ADMIN DASHBOARD LIST COLUMNS
 */
add_filter( 'manage_edit-category_columns', __NAMESPACE__ . '\register_category_color_column' );
function register_category_color_column( $columns ) {
	$new_columns = [];
	foreach ( $columns as $key => $title ) {
		$new_columns[$key] = $title;
		if ( 'name' === $key ) {
			$new_columns['xtremelysocial_color'] = __( 'Color', 'lumina' );
		}
	}
	return $new_columns;
}

add_filter( 'manage_category_custom_column', __NAMESPACE__ . '\populate_category_color_column', 10, 3 );
function populate_category_color_column( $content, $column_name, $term_id ) {
	if ( 'xtremelysocial_color' === $column_name ) {
		$color = get_category_color( $term_id );
		$slug  = get_category_slug( $term_id );
		
		$hover_label = ( $slug && 'custom' !== $slug ) ? sprintf( 'Slug Token: %s (%s)', $slug, $color ) : 'Custom Value: ' . $color;

		return sprintf(
			'<span class="xtremelysocial-admin-color-dot" style="display:inline-block; width:14px; height:14px; border-radius:50%%; background-color:%1$s; border:1px solid rgba(0,0,0,0.15); vertical-align:middle;" title="%2$s"></span>',
			esc_attr( $color ),
			esc_attr( $hover_label )
		);
	}
	return $content;
}

add_action( 'admin_head', __NAMESPACE__ . '\category_color_column_styles' );
function category_color_column_styles() {
	$screen = get_current_screen();
	if ( isset( $screen->taxonomy ) && 'category' === $screen->taxonomy ) {
		echo '<style>
			.wp-list-table .column-xtremelysocial_color { width: 65px; text-align: center; }
			.wp-list-table .column-xtremelysocial_color .xtremelysocial-admin-color-dot { margin: 0 auto; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
		</style>';
	}
}