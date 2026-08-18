<?php
/**
 * Title: Post Excerpt as Heading
 * Slug: lumina/text-excerpt-heading
 * Categories: lumina, text
 * viewportWidth: 760
 * Description: Displays the post excerpt as an H3 heading for hero styling.
 */

$excerpt_raw = get_the_excerpt();
$post_excerpt = ! empty( $excerpt_raw ) 
    ? esc_html( wp_trim_words( $excerpt_raw, 20, '…' ) ) 
    : 'Sample post excerpt content goes here for editor preview…';

echo sprintf( 
    '<!-- wp:heading {"level":3} --><h3 class="wp-block-heading">%s</h3><!-- /wp:heading -->',
    $post_excerpt
);