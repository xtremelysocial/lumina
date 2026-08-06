<?php
/**
 * Title: Cover Scroll Page Header
 * Description: Cover Scroll Page Header
 * Slug: lumina/cover-scroll-page-header
 * Categories: lumina, banner
 * Block Types: core/page
 */
?>
<!-- wp:cover {"useFeaturedImage":true,"dimRatio":60,"overlayColor":"primary","minHeight":480,"isDark":false,"align":"full","style":{"spacing":{"margin":{"top":"0"}}}} -->
<div id="cover-scroll-page-header" class="wp-block-cover alignfull is-light " style="min-height:480px;margin-top:0;"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container">
<!-- wp:post-title {"textAlign":"center","level":1,"align":"wide","className":"entry-title","fontSize":"huge"} /-->

<!-- wp:post-excerpt {"textAlign":"center","fontSize":"x-large","excerptLength":"30","className":"is-style-no-readmore"} /-->

<!-- wp:paragraph {"align":"center","placeholder":"Scroll Down","style":{"elements":{"link":{"color":{"text":"inherit"}}}},"className":"is-style-icon-arrow-down-alt2-no-text","fontSize":"x-large"} -->
<p class="has-text-align-center is-style-icon-arrow-down-alt2-no-text has-link-color has-x-large-font-size"><a href="#content-start" rel="nofollow"><?php esc_html_e("Scroll Down", "lumina"); ?></a></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"metadata":{"name":"Content Start"},"align":"full","className":"is-style-default","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-group alignfull is-style-default" id="content-start" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0"></div>
<!-- /wp:group -->