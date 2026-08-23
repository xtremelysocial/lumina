<?php
/**
 * Title: Image Computer Screen
 * Description: Image Computer Screen
 * Slug: lumina/image-computer-screen
 * Categories: lumina, media
 * Block Types: core/image
 */
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"bottom":"0px"}}},"layout":{"type":"constrained"}} -->
<div id="computer-screen" class="wp-block-group alignwide" style="padding-bottom:0px">
<!-- wp:heading {"textAlign":"center","placeholder":"Image Computer Screen with Title and Text Above"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e("Image Computer Screen with Title and Text Above", "lumina"); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var|preset|spacing|40"}}}} -->
<p class="has-text-align-center" style="margin-bottom:var|preset|spacing|40"><?php esc_html_e("Lorem ipsum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.", "lumina"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:image {"lightbox":{"enabled":true},"width":750,"linkDestination":"none","align":"center","className":"size-large is-style-image-computer-screen"} -->
<figure class="wp-block-image aligncenter size-large is-style-image-computer-screen"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/samples/screenshots/image-computer-screen.png" ) ); ?>" alt="screenshot" width="750"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->
