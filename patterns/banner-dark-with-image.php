<?php
/**
 * Title: Lumina Hero Banner Dark w/Image
 * Slug: lumina/banner-dark-with-image
 * Categories: lumina, banner, image, featured
 * Description: Dark full-width hero banner with media-text layout, dynamic theme image, and translatable strings.
 */

$theme_image_url = esc_url( get_theme_file_uri( 'assets/images/samples/image-city-night.webp' ) );
?>
<!-- wp:media-text {"align":"full","mediaPosition":"right","mediaId":6131,"mediaLink":"https://test.xtremelysocial.com/2016/go-wordpress-themes/photo-1451866961142-cd9f8c737e8b/","mediaType":"image","mediaWidth":45,"mediaSizeSlug":"full","imageFill":false,"metadata":{"name":"Hero Banner"},"className":"is-style-image-border","backgroundColor":"dark-alt"} -->
<div class="wp-block-media-text alignfull has-media-on-the-right is-stacked-on-mobile is-style-image-border has-dark-alt-background-color has-background" style="grid-template-columns:auto 45%"><div class="wp-block-media-text__content"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Lumina WordPress Theme', 'lumina' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:heading {"fontSize":"large"} -->
<h2 class="wp-block-heading has-large-font-size"><?php esc_html_e( 'A modern evolution of Full-Site Editing. Engineered with colors drawn from nature, tactile visual depth, and responsive interactive cards.', 'lumina' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"flex","justifyContent":"left"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:button {"style":{"color":{"text":"var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dcolor\u002d\u002dforeground-alt)"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-text-color wp-element-button" href="#content-start" style="color:var(--wp--preset--color--foreground-alt)"><?php esc_html_e( 'Explore Lumina', 'lumina' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div><figure class="wp-block-media-text__media"><img src="<?php echo $theme_image_url; ?>" alt="" class="wp-image-6131 size-full"/></figure></div>
<!-- /wp:media-text -->

<!-- wp:group {"lock":{"move":true,"remove":true},"metadata":{"name":"Content Start"},"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"},"anchor":"content-start"} -->
<div id="content-start" class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"></div>
<!-- /wp:group -->