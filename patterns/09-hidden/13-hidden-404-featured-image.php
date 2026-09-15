<?php
/**
 * Title: Lumina 404 Hero Banner
 * Slug: lumina/hidden-404-featured-image
 * Categories: lumina, image
 * Inserter: false
 * Description: 404 Slim Featured Image
 */
$theme_image_url = esc_url( get_theme_file_uri( 'assets/images/lumina/lumina/04.webp' ) );
?>
<!-- wp:image {"sizeSlug":"large","aspectRatio":"16/4.5","scale":"cover","className":"is-style-default","style":{"border":{"radius":"var:preset|border-radius|sm","width":"1px","color":"var:preset|color|neutral-alt"}}} -->
<figure class="wp-block-image size-large has-custom-border is-style-default"><img src="<?php echo $theme_image_url; ?>" alt="" class="has-border-color has-neutral-alt-border-color" style="border-width:1px;border-top-left-radius:var(--wp--preset--border-radius--sm);border-top-right-radius:var(--wp--preset--border-radius--sm);border-bottom-left-radius:var(--wp--preset--border-radius--sm);border-bottom-right-radius:var(--wp--preset--border-radius--sm);aspect-ratio:16/4.5;object-fit:cover"/></figure>
<!-- /wp:image -->
