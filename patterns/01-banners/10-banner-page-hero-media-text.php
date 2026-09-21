<?php
/**
 * Title: Banner Page Hero Media & Text
 * Description: Banner Page Hero Media & Text
 * Slug: lumina/banner-page-hero-media-text
 * Categories: lumina, banner, media, featured
 * Block Types: core/group, core/media-text
 */
?>

<!-- wp:group {"metadata":{"name":"Banner Page Hero Media \u0026 Text"},"align":"full","gradient":"secondary","layout":{"type":"constrained"},"anchor":"banner-page-hero-media-text"} -->
<div class="wp-block-group alignfull has-secondary-gradient-background has-background" id="banner-page-hero-media-text"><!-- wp:media-text {"align":"wide","mediaPosition":"right","linkDestination":"none","mediaType":"image","mediaWidth":45,"mediaSizeSlug":"cropped-large","imageFill":false,"className":"is-style-pan-zoom"} -->
<div class="wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile is-style-pan-zoom" style="grid-template-columns:auto 45%"><div class="wp-block-media-text__content">
<!-- wp:post-title {"level":1,"align":"wide","className":"entry-title","style":{"typography":{"lineHeight":"1.2"}},"fontSize":"huge"} /-->

<!-- wp:post-excerpt {"excerptLength":20,"className":"is-style-no-readmore","style":{"typography":{"lineHeight":"1.2"}},"fontSize":"x-large"} /-->

<!-- wp:pattern {"slug":"lumina/text-scroll-down"} /-->

</div><figure class="wp-block-media-text__media"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/pages/portfolio-hero.webp" ) ); ?>" alt="portfolio image"/></figure></div>
<!-- /wp:media-text --></div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/hidden-content-start"} /-->