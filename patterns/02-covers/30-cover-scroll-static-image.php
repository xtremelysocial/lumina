<?php
/**
 * Title: Cover Scroll Static Image
 * Description: Cover Scroll Static Image
 * Slug: lumina/cover-scroll-static-image
 * Categories: lumina, banner, media
 * Block Types: core/image
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( "assets/images/pages/portfolio-hero.webp" ) ); ?>","dimRatio":30,"isUserOverlayColor":true,"minHeight":480,"sizeSlug":"large","metadata":{"name":"Cover Scroll Static Image"},"align":"full","className":"is-dark is-style-pan-zoom","style":{"spacing":{"margin":{"top":"0"}}},"anchor":"cover-scroll-static-image"} -->
<div class="wp-block-cover alignfull is-dark is-style-pan-zoom" style="margin-top:0;min-height:480px" id="cover-scroll-static-image"><img class="wp-block-cover__image-background size-large" alt="" src="<?php echo esc_url( get_theme_file_uri( "assets/images/pages/portfolio-hero.webp" ) ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"placeholder":"Cover Image Title","style":{"typography":{"textAlign":"center"}},"fontSize":"huge","anchor":"title"} -->
<h2 class="wp-block-heading has-text-align-center has-huge-font-size" id="title"><?php esc_html_e("Cover Scroll to Content", "lumina"); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"metadata":{"name":"Subtitle"},"style":{"typography":{"textAlign":"center","lineHeight":"1.2"}},"fontSize":"x-large"} -->
<p class="has-text-align-center has-x-large-font-size" style="line-height:1.2"><?php esc_html_e("Cover Image Subtitle", "lumina"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"placeholder":"Scroll Down","metadata":{"name":"Scroll to Content Start"},"className":"is-style-icon-arrow-down-alt2-no-text","style":{"elements":{"link":{"color":{"text":"inherit"}}},"typography":{"textAlign":"center"}},"fontSize":"x-large"} -->
<p class="has-text-align-center is-style-icon-arrow-down-alt2-no-text has-link-color has-x-large-font-size"><a href="#content-start" rel="nofollow"><?php esc_html_e("Scroll Down", "lumina"); ?></a></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"lock":{"move":false,"remove":true},"metadata":{"name":"Content Start"},"align":"full","className":"is-style-default","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0"}}},"anchor":"content-start"} -->
<div class="wp-block-group alignfull is-style-default" id="content-start" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0"></div>
<!-- /wp:group -->