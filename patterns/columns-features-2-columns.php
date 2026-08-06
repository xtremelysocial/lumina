<?php
/**
 * Title: Lumina Features 2 Columns
 * Description: Lumina Features 2 Columns
 * Slug: lumina/columns-features-2-columns
 * Categories: lumina, column
 * Block Types: core/columns
 */
?>
<!-- wp:group {"align":"full","backgroundColor":"primary","className":"alignfull","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-primary-background-color has-background" id="features-2-columns"><!-- wp:heading {"textAlign":"center","placeholder":"Features 2 Columns"} -->
<h2 class="has-text-align-center" id="features-2-columns"><?php esc_html_e("Features 2 Columns", "lumina"); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"align":"center","width":100,"height":100,"sizeSlug":"thumbnail","linkDestination":"none","className":"is-style-image-round-border"} -->
<figure class="wp-block-image aligncenter size-thumbnail is-resized is-style-image-round-border"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/thumbnails/thumbnail-gears.jpg" ) ); ?>" alt="photo of golden cogwheel on black background" width="100" height="100"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="has-text-align-center " id="column-1"><?php esc_html_e("Lorem Ipsum", "lumina"); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center "><?php esc_html_e("Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.", "lumina"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"align":"center","width":100,"height":100,"sizeSlug":"thumbnail","linkDestination":"none","className":"is-style-image-round-border"} -->
<figure class="wp-block-image aligncenter size-thumbnail is-resized is-style-image-round-border"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/thumbnails/thumbnail-hands.jpg" ) ); ?>" alt="crop psychologist supporting patient during counseling indoors" width="100" height="100"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":3} -->
<h3 class="has-text-align-center " id="column-2"><?php esc_html_e("Dolor Sit Amet", "lumina"); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center "><?php esc_html_e("Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.", "lumina"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->