<?php
/**
 * Title: 404 Hero Banner
 * Slug: atmos-blocks/atmos-hidden-404-featured-image
 * Categories: text
 * Inserter: false
 * Description: 404 Slim Featured Image
 */
$theme_image_url = esc_url( get_theme_file_uri( 'assets/images/cover-bokeh.jpg' ) );
?>
<figure class="wp-block-image size-large has-custom-border is-style-default"><img src="<?php echo $theme_image_url; ?>" alt="" class="has-border-color has-neutral-alt-border-color" style="border-width:1px;border-top-left-radius:var(--wp--preset--border-radius--sm);border-top-right-radius:var(--wp--preset--border-radius--sm);border-bottom-left-radius:var(--wp--preset--border-radius--sm);border-bottom-right-radius:var(--wp--preset--border-radius--sm);aspect-ratio:16/4.5;object-fit:cover"/></figure>