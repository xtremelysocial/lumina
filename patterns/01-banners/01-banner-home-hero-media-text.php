<?php
/**
 * Title: Banner Home Hero Media & Text
 * Description: Banner Home Hero Media & Text
 * Slug: lumina/banner-home-hero-media-text
 * Categories: lumina, banner, media
 * Block Types: core/group, core/media-text
 */
?>
<!-- wp:group {"metadata":{"name":"Home Banner Media \u0026 Text"},"align":"full","gradient":"tertiary","layout":{"type":"constrained"},"anchor":"banner-home-hero-media-text"} -->
<div class="wp-block-group alignfull has-tertiary-gradient-background has-background" id="banner-home-hero-media-text">
	<!-- wp:media-text {"align":"wide","mediaPosition":"right","linkDestination":"none","mediaType":"image","mediaWidth":45,"mediaSizeSlug":"cropped-large","imageFill":false,"className":"is-style-pan-zoom is-style-default"} -->
	<div class="wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile is-style-pan-zoom is-style-default" style="grid-template-columns:auto 45%">
		<div class="wp-block-media-text__content">
			<!-- wp:site-title {"isLink":false,"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"huge"} /-->

			<!-- wp:site-tagline {"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"x-large"} /-->

			<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"large"} -->
			<p class="has-large-font-size" style="line-height:1.2"><?php esc_html_e("Lumina is a refined modern theme inspired by the colors, light, depth and motion of the environment around us.", "lumina"); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"metadata":{"name":"Scroll to Content Start"},"className":"is-style-icon-arrow-down-alt2-no-text","style":{"typography":{"textAlign":"center"}}} -->
			<p class="has-text-align-center is-style-icon-arrow-down-alt2-no-text"><a href="#content-start"><?php esc_html_e("Scroll Down", "lumina"); ?></a></p>
			<!-- /wp:paragraph -->
		</div>
		<figure class="wp-block-media-text__media">
			<img src="<?php echo esc_url( get_theme_file_uri( "assets/images/pages/home-hero.webp" ) ); ?>" alt=""/>
		</figure>
	</div>
	<!-- /wp:media-text -->
</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Content Start"},"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"},"anchor":"content-start"} -->
<div id="content-start" class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"></div>
<!-- /wp:group -->