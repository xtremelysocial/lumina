<?php
/**
 * Title: Image w/Left And Right Text (Fashion)
 * Description: Spotlight block layout focused on editorial collection lookbooks.
 * Slug: lumina/image-left-and-right-text-fashion
 * Categories: lumina, image, media, text
 * Block Types: core/image, core/columns
 */
?>
<!-- wp:group {"metadata":{"categories":["lumina","image"],"name":"Image with Left and Right Text"},"align":"full","className":"is-style-default","backgroundColor":"secondary-alt","layout":{"type":"constrained"},"anchor":"image-left-and-right-text"} -->
<div class="wp-block-group alignfull is-style-default has-secondary-alt-background-color has-background" id="image-left-and-right-text"><!-- wp:heading {"style":{"typography":{"textAlign":"center"}}} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e("Collection Spotlight", "lumina"); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center","width":"25%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:25%"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e("Textile Fluidity", "lumina"); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Garments using intentional weave selections respond fluidly to natural movement, introducing clean drape weights and soft tracking movement across editorial profiles.", "lumina"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%"><!-- wp:image {"lightbox":{"enabled":false},"aspectRatio":"16/9","scale":"cover","sizeSlug":"large","linkDestination":"none","align":"center","className":"is-style-image-computer-screen"} -->
<figure class="wp-block-image aligncenter size-large is-style-image-computer-screen"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/samples/screenshots/01.webp" ) ); ?>" alt="screenshot" style="aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"25%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:25%"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e("Atelier Sourcing", "lumina"); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Curate, assemble, and alternate runway profiles directly within lookbook grids. Easily keep apparel presentations striking, timeless, and completely modern.", "lumina"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->