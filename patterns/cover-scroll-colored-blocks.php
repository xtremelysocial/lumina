<?php
/**
 * Title: Cover Scroll Colored Blocks
 * Description: Cover Scroll Colored Blocks
 * Slug: lumina/cover-scroll-colored-blocks
 * Categories: lumina, banner
 */
?>
<!-- wp:cover {"url":"<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/17.jpg" ) ); ?>","dimRatio":40,"overlayColor":"primary","minHeight":480,"isDark":true,"align":"full","style":{"spacing":{"margin":{"top":"0"}}}} -->
<div class="wp-block-cover alignfull is-dark" style="min-height:480px;margin-top:0;" id="cover-scroll-colored-blocks"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-40 has-background-dim"></span><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/17.jpg" ) ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container">
<!-- wp:group -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","placeholder":"Cover Image Title","fontSize":"huge"} -->
<h2 class="wp-block-heading has-text-align-center has-huge-font-size" id="title"><?php esc_html_e("Cover Scroll Colored Blocks", "lumina"); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","level":3,"placeholder":"Cover Image Subtitle","fontSize":"x-large"} -->
<h3 class="wp-block-heading has-text-align-center has-x-large-font-size" id="subtitle"><?php esc_html_e("Cover Image Subtitle", "lumina"); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","placeholder":"Scroll Down","style":{"elements":{"link":{"color":{"text":"inherit"}}}},"className":"is-style-icon-arrow-down-alt2-no-text","fontSize":"x-large"} -->
<p class="has-text-align-center is-style-icon-arrow-down-alt2-no-text has-link-color has-x-large-font-size"><a href="#content-start" rel="nofollow"><?php esc_html_e("Scroll Down", "lumina"); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"metadata":{"name":"Content Start"},"align":"full","className":"is-style-default","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-group alignfull is-style-default" id="content-start" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0"></div>
<!-- /wp:group -->