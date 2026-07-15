<?php
/**
 * Title: Lumina Columns Map Static
 * Description: Columns Map Static
 * Slug: lumina/columns-map-static
 * Categories: lumina, column, image
 */
 $theme_image_url = esc_url( get_theme_file_uri( 'assets/images/image-static-map.jpg' ) );
?>
<!-- wp:columns {"verticalAlignment":"top","align":"full","style":{"spacing":{"blockGap":{"top":"0","left":"0"},"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"0"}}},"backgroundColor":"dark","className":"alignfull is-style-no-gap"} -->
<div class="wp-block-columns alignfull are-vertically-aligned-top is-style-no-gap has-dark-background-color has-background" id="static-map-and-address" style="margin-top:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:column {"verticalAlignment":"top","width":"66.66666%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:66.66666%"><!-- wp:image {"sizeSlug":"large","linkDestination":"custom","style":{"color":{}}} -->
<figure class="wp-block-image size-large"><a href="https://www.google.com/maps/@41.9677379,-71.487411,15z"><img src="<?php echo $theme_image_url; ?>" alt="map"/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","right":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60"}}},"backgroundColor":"dark","className":"is-style-default"} -->
<div class="wp-block-column is-vertically-aligned-top is-style-default has-dark-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)"><!-- wp:heading {"level":3,"placeholder":"ADDRESS"} -->
<h3 class="wp-block-heading" id="address">ADDRESS</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">US Corporate Office</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">1234 US Highway 99</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Anytown, USA 55555</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="is-style-link-no-underline" style="margin-top:0;margin-bottom:0"><a href="tel:555-867-5309">(555) 867-5309</a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline","style":{"spacing":{"margin":{"top":"0"}}}} -->
<p class="is-style-link-no-underline" style="margin-top:0"><a href="mailto:#">mail@example.com</a></p>
<!-- /wp:paragraph -->

<!-- wp:template-part {"slug":"theme-tagline","className":"is-style-link-no-underline"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->