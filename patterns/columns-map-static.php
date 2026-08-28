<?php
/**
 * Title: Static Map & Contact Info
 * Description: Static map with address, contact info, and social media icons
 * Slug: lumina/columns-map-static
 * Categories: lumina, column, media
 * Block Types: core/media-text
 */
?>
<!-- wp:media-text {"align":"full","mediaLink":"#content-start","linkDestination":"custom","mediaType":"image","mediaWidth":67,"imageFill":false,"metadata":{"name":"Static Map \u0026 Contact Info Full Width"},"className":"is-style-no-gap","style":{"spacing":{"margin":{"bottom":"0"}}},"backgroundColor":"secondary-alt","anchor":"static-map-and-contact-info-full"} -->
<div class="wp-block-media-text alignfull is-stacked-on-mobile is-style-no-gap has-secondary-alt-background-color has-background" style="margin-bottom:0;grid-template-columns:67% auto" id="static-map-and-contact-info-full"><figure class="wp-block-media-text__media"><a href="#content-start"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/01.webp" ) ); ?>" alt="Map"/></a></figure><div class="wp-block-media-text__content">
<!-- wp:heading {"level":3,"placeholder":"Contact","anchor":"contact-info"} -->
<h3 id="contact-info"><?php esc_html_e("Contact", "lumina"); ?></h3>
<!-- /wp:heading -->

<!-- wp:template-part {"slug":"contact-info"} /--></div>
<!-- /wp:group --></div></div>
<!-- /wp:media-text -->