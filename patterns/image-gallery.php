<?php
/**
 * Title: Image Gallery
 * Description: Image Gallery
 * Slug: lumina/image-gallery
 * Categories: lumina, media, featured
 * Block Types: core/gallery
 */
?>
<!-- wp:group {"metadata":{"name":"Image Gallery"},"align":"wide","layout":{"type":"constrained"},"anchor":"image-gallery-1"} -->
<div class="wp-block-group alignwide" id="image-gallery-1"><!-- wp:heading {"style":{"typography":{"textAlign":"center"}}} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e("Image Gallery", "lumina"); ?></h2>
<!-- /wp:heading -->

<!-- wp:gallery {"columns":4,"randomOrder":true,"linkTo":"none","sizeSlug":"cropped-thumbnail","align":"wide","className":"is-style-default","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|20","left":"var:preset|spacing|20"}}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-4 is-cropped is-style-default"><!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/01.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/02.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/03.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/04.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/05.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/06.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/07.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/08.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/09.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:image {"lightbox":{"enabled":true},"sizeSlug":"cropped-thumbnail","linkDestination":"none"} -->
<figure class="wp-block-image size-cropped-thumbnail"><img src="<?php echo esc_url( get_theme_file_uri( "assets/images/lumina/10.webp" ) ); ?>" alt=""/></figure>
<!-- /wp:image --><figcaption class="blocks-gallery-caption wp-element-caption">Image Gallery (Rounded)</figcaption></figure>
<!-- /wp:gallery --></div>
<!-- /wp:group -->