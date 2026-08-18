<?php
/**
 * Title: Theme Name
 * Slug: lumina/text-theme-name
 * Categories: lumina, text
 * Inserter: false
 * viewportWidth: 760
 * Description: Theme name with link
 */

// Get the theme attributes
$theme = wp_get_theme();

// Display the theme name with link
echo sprintf( 
	'<!-- wp:paragraph --><p>
<a href="%s" target="_blank">%s</a></p>
<!-- /wp:paragraph -->',
	$theme->get( 'ThemeURI' ) ?? 'https://xtremelysocial.com/wordpress/lumina',
	$theme->get( 'Name' ) ?? 'Lumina'
);
