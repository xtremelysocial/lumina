<?php
/**
 * Title: Site Title Paragraph Link
 * Slug: lumina/text-site-title-paragraph
 * Categories: lumina, text
 * Inserter: false
 * viewportWidth: 640
 * Description: Displays the dynamic site title wrapped in a paragraph link for flawless footer alignment.
 */

$site_name = esc_html( get_bloginfo( 'name' ) );
$home_url  = esc_url( home_url( '/' ) );

// Output as a clean block editor paragraph with the home link inside
echo sprintf( 
	'<!-- wp:paragraph --><p><a href="%s" rel="home">%s</a></p><!-- /wp:paragraph -->',
	$home_url,
	$site_name
);