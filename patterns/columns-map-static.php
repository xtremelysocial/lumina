<?php
/**
 * Title: Static Map & Contact Info
 * Description: Static map, contact info, social icons
 * Slug: lumina/columns-map-static
 * Categories: lumina, column, media
 * Block Types: core/columns
 */
?>
<!-- wp:media-text {"align":"full","mediaLink":"#content-start","linkDestination":"custom","mediaType":"image","mediaWidth":67,"imageFill":false,"metadata":{"name":"Static Map \u0026 Contact Info"},"className":"is-style-no-gap is-style-default","style":{"spacing":{"margin":{"bottom":"0"}}},"backgroundColor":"secondary-alt","anchor":"static-map-and-contact-info-full"} -->
<div class="wp-block-media-text alignfull is-stacked-on-mobile is-style-no-gap is-style-default has-secondary-alt-background-color has-background" style="margin-bottom:0;grid-template-columns:67% auto" id="static-map-and-contact-info-full"><figure class="wp-block-media-text__media"><a href="#content-start"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/about/map.webp" ) ); ?>" alt=""/></a></figure><div class="wp-block-media-text__content"><!-- wp:group {"metadata":{"name":"Contact Info","categories":["lumina","text"]},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"is-style-link-no-underline"} -->
<p class="is-style-link-no-underline"><?php esc_html_e("1234 US Highway 99", "lumina"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}}} -->
<p class="is-style-link-no-underline" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--20)"><?php esc_html_e("Anytown, USA 55555", "lumina"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline"} -->
<p class="is-style-link-no-underline"><a href="tel:555-867-5309">(555) 867-5309</a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}}} -->
<p class="is-style-link-no-underline" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--20)"><a href="mailto:#"><?php esc_html_e("mail@example.com", "lumina"); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:template-part {"slug":"social-icons-neutral","theme":"lumina"} /--></div>
<!-- /wp:group --></div></div>
<!-- /wp:media-text -->

<!-- wp:group {"metadata":{"name":"Content Start"},"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"},"anchor":"content-start"} -->
<div id="content-start" class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"></div>
<!-- /wp:group -->