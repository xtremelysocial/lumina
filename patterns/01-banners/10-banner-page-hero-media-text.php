<?php
/**
 * Title: Banner Page Hero Media & Text
 * Description: Banner Page Hero Media & Text
 * Slug: lumina/banner-page-hero-media-text
 * Categories: lumina, banner, media, featured
 * Block Types: core/group, core/media-text
 */
?>

<!-- wp:group {"metadata":{"name":"Banner Page Hero Media \u0026 Text"},"align":"full","backgroundColor":"secondary-alt","layout":{"type":"constrained"},"anchor":"banner-hero-media-text"} -->
<div class="wp-block-group alignfull has-secondary-alt-background-color has-background" id="banner-hero-media-text"><!-- wp:media-text {"align":"wide","mediaPosition":"right","linkDestination":"none","mediaType":"image","mediaWidth":45,"mediaSizeSlug":"cropped-large","imageFill":false,"className":"is-style-pan-zoom"} -->
<div class="wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile is-style-pan-zoom" style="grid-template-columns:auto 45%"><div class="wp-block-media-text__content">
<!-- wp:post-title {"level":1,"align":"wide","className":"entry-title","style":{"typography":{"textAlign":"center","lineHeight":"1.2"}},"fontSize":"huge"} /-->

<!-- wp:post-excerpt {"excerptLength":20,"className":"is-style-no-readmore","style":{"typography":{"textAlign":"center","lineHeight":"1.2"}},"fontSize":"x-large"} /-->

<!-- wp:paragraph {"placeholder":"Scroll Down","metadata":{"name":"Scroll to Content Start"},"className":"is-style-icon-scroll-down-no-text","style":{"elements":{"link":{"color":{"text":"inherit"}}},"typography":{"textAlign":"center"}},"fontSize":"x-large"} -->
<p class="has-text-align-center is-style-icon-scroll-down-no-text has-link-color has-x-large-font-size"><a href="#content-start" rel="nofollow"><?php esc_html_e("Scroll Down", "lumina"); ?></a></p>
<!-- /wp:paragraph --></div><figure class="wp-block-media-text__media"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/pages/portfolio-hero.webp" ) ); ?>" alt="" class="size-cropped-large"/></figure></div>
<!-- /wp:media-text --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Content Start"},"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"},"anchor":"content-start"} -->
<div id="content-start" class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"></div>
<!-- /wp:group -->