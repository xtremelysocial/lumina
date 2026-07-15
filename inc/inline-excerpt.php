<?php 

/**
 * Hook the Shadow Excerpt Block into the Core Block Editor.
 */

add_action( 'init', function() {
    // 1. Register the script asset first with explicit core dependencies
    wp_register_script(
        'lumina-inline-excerpt-js',
        get_theme_file_uri( '/assets/js/inline-excerpt.js' ),
        array( 'wp-blocks', 'wp-element', 'wp-data', 'wp-core-data', 'wp-components', 'wp-editor' ),
        '1.2',
        true
    );

    // 2. Register the block type and tightly bind it to the script handle
    register_block_type( 'lumina/inline-excerpt', array(
        'editor_script'   => 'lumina-inline-excerpt-js',
        'render_callback' => '__return_empty_string', // Invisible on front-end execution
    ) );
} );

/**
 * Dynamically inject the shadow input block into the REST API editor stream.
 */
function lumina_inject_shadow_excerpt( $response, $post, $request ) {
    if ( ! empty( $request['context'] ) && 'edit' === $request['context'] ) {
        if ( isset( $response->data['content']['raw'] ) ) {
            $raw_content = $response->data['content']['raw'];
            
            // Bulletproof check for both standard HTML comments and escaped layout tokens
            if ( false === strpos( $raw_content, 'wp:lumina/inline-excerpt' ) ) {
                // Prepend with the exact namespaced slash token match
                $response->data['content']['raw'] = '<!-- wp:lumina/inline-excerpt /-->' . $raw_content;
            }
        }
    }
    return $response;
}
add_filter( 'rest_prepare_post', 'lumina_inject_shadow_excerpt', 10, 3 );
add_filter( 'rest_prepare_page', 'lumina_inject_shadow_excerpt', 10, 3 );