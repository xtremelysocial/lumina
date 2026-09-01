<?php
/**
 * Title: Image Computer Screen
 * Description: Image Computer Screen
 * Slug: lumina/image-computer-screen
 * Categories: lumina, media
 * Block Types: core/image
 */
?>
<!-- wp:group {"metadata":{"categories":["lumina","media"],"name":"Image Computer Screen"},"align":"wide","style":{"spacing":{"padding":{"bottom":"0px"}}},"layout":{"type":"constrained"},"anchor":"computer-screen"} -->
<div class="wp-block-group alignwide" id="computer-screen" style="padding-bottom:0px"><!-- wp:heading {"placeholder":"Image Computer Screen with Title and Text Above","className":"is-style-separator","style":{"typography":{"textAlign":"center"}}} -->
<h2 class="wp-block-heading has-text-align-center is-style-separator"><?php esc_html_e("Showcase Your Screenshots", "lumina"); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var|preset|spacing|40"}},"typography":{"textAlign":"center"}}} -->
<p class="has-text-align-center" style="margin-bottom:var|preset|spacing|40"><?php esc_html_e("With the click of a button you can add a frame to simulate a computer or mobile device screen. No photo editing software required.", "lumina"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:image {"aspectRatio":"16/9","scale":"cover","align":"center","className":"is-resized size-large is-style-image-computer-screen"} -->
<figure class="wp-block-image aligncenter is-resized size-large is-style-image-computer-screen"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/samples/screenshots/01.webp" ) ); ?>" alt="screenshot" style="aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->