<?php
/**
 * Title: Lumina Columns Map Jetpack
 * Description: Columns Map Jetpack
 * Slug: lumina/columns-map-jetpack
 * Categories: lumina, column, image
 */
?>
<!-- wp:columns {"verticalAlignment":"top","align":"full","style":{"spacing":{"margin":{"top":"0"}}},"backgroundColor":"dark","className":"alignfull is-style-no-gap"} -->
<div class="wp-block-columns alignfull are-vertically-aligned-top is-style-no-gap has-dark-background-color has-background" id="jetpack-map-and-address" style="margin-top:0;"><!-- wp:column {"verticalAlignment":"top","width":"66.66666%","className":"is-style-no-padding"} -->
<div class="wp-block-column is-vertically-aligned-top is-style-no-padding" style="flex-basis:66.66666%"><!-- wp:jetpack/map -->
<div class="wp-block-jetpack-map" data-map-style="default" data-map-details="true" data-points="[]" data-zoom="13" data-map-center="{&quot;longitude&quot;:-122.41941550000001,&quot;latitude&quot;:37.7749295}" data-marker-color="red" data-show-fullscreen-button="true"></div>
<!-- /wp:jetpack/map --></div>
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