<?php
/**
 * Title: Banner Home Hero Video & Text
 * Description: Banner Home Hero Video & Text
 * Slug: lumina/banner-home-hero-video-text
 * Categories: lumina, banner, media
 */
?>
<!-- wp:group {"metadata":{"name":"Home Banner Video \u0026 Text Hero"},"align":"full","backgroundColor":"secondary-alt","layout":{"type":"constrained"},"anchor":"banner-home-hero-video-text"} -->
<div class="wp-block-group alignfull has-secondary-alt-background-color has-background" id="banner-home-hero-video-text"><!-- wp:columns {"metadata":{"name":"Content \u0026 Video"},"align":"wide","className":"is-style-image-border is-style-default"} -->
<div class="wp-block-columns alignwide is-style-image-border is-style-default"><!-- wp:column {"width":"55%","metadata":{"name":"Text"}} -->
<div class="wp-block-column" style="flex-basis:55%"><!-- wp:site-title {"isLink":false,"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"huge"} /-->

<!-- wp:site-tagline {"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"x-large"} /-->

<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.2"}},"fontSize":"large"} -->
<p class="has-large-font-size" style="line-height:1.2"><?php esc_html_e("Lumina is a refined modern theme inspired by the colors, light, depth and motion of the environment around us.", "lumina"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"placeholder":"Scroll Down","metadata":{"name":"Scroll to Content Start"},"className":"is-style-icon-arrow-down-alt2-no-text has-link-color","style":{"elements":{"link":{"color":{"text":"inherit"}}},"typography":{"textAlign":"center"}},"fontSize":"x-large"} -->
<p class="has-text-align-center is-style-icon-arrow-down-alt2-no-text has-link-color has-x-large-font-size"><a href="#content-start" rel="nofollow"><?php esc_html_e("Scroll Down", "lumina"); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"45%","metadata":{"name":"Media"}} -->
<div class="wp-block-column" style="flex-basis:45%"><!-- wp:video {"autoplay":true,"controls":false,"loop":true,"muted":true,"poster":"/wp-content/themes/lumina/assets/videos/01.webp","preload":"auto","className":"is-style-image-border"} -->
<figure class="wp-block-video is-style-image-border"><video autoplay loop muted poster="/wp-content/themes/lumina/assets/videos/01.webp" preload="auto" src="/wp-content/themes/lumina/assets/videos/01.mp4" playsinline></video></figure>
<!-- /wp:video --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Content Start"},"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"},"anchor":"content-start"} -->
<div id="content-start" class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"></div>
<!-- /wp:group -->