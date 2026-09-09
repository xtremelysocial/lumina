<?php
/**
 * Title: Cover Scroll Home Header
 * Description: Cover Scroll Home Header
 * Slug: lumina/cover-scroll-home-header
 * Categories: lumina, banner
 * Block Types: core/template-part/header
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/01.webp" ) ); ?>","dimRatio":30,"isUserOverlayColor":true,"focalPoint":{"x":0.5,"y":0.5},"minHeight":100,"minHeightUnit":"vh","contentPosition":"center center","sizeSlug":"large","metadata":{"name":"Cover Scroll Home Header"},"align":"full","className":"is-dark is-style-pan-zoom","style":{"spacing":{"margin":{"top":"0"}}},"anchor":"cover-scroll-home-header"} -->
<div class="wp-block-cover alignfull is-dark is-style-pan-zoom" style="margin-top:0;min-height:100vh" id="cover-scroll-home-header"><img class="wp-block-cover__image-background size-large" alt="" src="<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/01.webp" ) ); ?>" style="object-position:50% 50%" data-object-fit="cover" data-object-position="50% 50%"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:site-title {"isLink":false,"style":{"typography":{"textAlign":"center","lineHeight":"1.2"}},"fontSize":"huge"} /-->

<!-- wp:site-tagline {"style":{"typography":{"textAlign":"center","lineHeight":"1.2"}},"fontSize":"x-large"} /-->

<!-- wp:paragraph {"style":{"typography":{"textAlign":"center","lineHeight":"1.2"}},"fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size" style="line-height:1.2"><?php esc_html_e("Lumina is a refined modern theme inspired by the colors, light, depth and motion of the environment around us", "lumina"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"placeholder":"Scroll Down","metadata":{"name":"Scroll to Content Start"},"className":"is-style-icon-arrow-down-alt2-no-text","style":{"elements":{"link":{"color":{"text":"inherit"}}},"typography":{"textAlign":"center"}},"fontSize":"x-large"} -->
<p class="has-text-align-center is-style-icon-arrow-down-alt2-no-text has-link-color has-x-large-font-size"><a href="#content-start" rel="nofollow"><?php esc_html_e("Scroll Down", "lumina"); ?></a></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"metadata":{"name":"Content Start"},"align":"full","className":"is-style-default","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0"}}},"anchor":"content-start"} -->
<div class="wp-block-group alignfull is-style-default" id="content-start" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0"></div>
<!-- /wp:group -->