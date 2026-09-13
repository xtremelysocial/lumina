<?php
/**
 * Title: Site Motto + Details Columns (Architecture)
 * Description: Layout sheet focused on architectural spatial shifts and terrain blueprints.
 * Slug: lumina/columns-site-motto-details-architect
 * Categories: lumina, column
 * Block Types: core/columns, core/details
 */
?>
<!-- wp:group {"lock":{"move":false,"remove":false},"metadata":{"name":"Site Motto + Details"},"align":"full","layout":{"type":"constrained"},"anchor":"site-motto-details"} -->
<div class="wp-block-group alignfull" id="site-motto-details"><!-- wp:columns {"lock":{"move":false,"remove":false},"metadata":{"name":"Heading \u0026 Content"},"align":"wide","className":"is-style-default","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide is-style-default"><!-- wp:column {"width":"33.33%","metadata":{"name":"Heading"},"className":"is-style-first-on-mobile"} -->
<div class="wp-block-column is-style-first-on-mobile" style="flex-basis:33.33%"><!-- wp:heading {"className":"is-style-separator"} -->
<h2 class="wp-block-heading is-style-separator"><?php esc_html_e("The Tectonic Shift", "lumina"); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"metadata":{"name":"Site Motto Medium"},"fontSize":"medium"} -->
<div class="wp-block-group has-medium-font-size"><!-- wp:paragraph -->
<p><?php esc_html_e("We believe built environments should feel structural and organic—bringing the natural rhythms and geological patterns of the physical world straight into our structural layout.", "lumina"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%","metadata":{"name":"Content"}} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:paragraph {"fontSize":"medium"} -->
<p class="has-medium-font-size"><?php esc_html_e("Our studio bridges physical environmental aesthetics with progressive structural engineering to make every architectural plan feel unified, intentional, and effortlessly premium.", "lumina"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Taking cues from structural minimalist geometry, our practices transform static concrete volumes into dynamic living structures that catch morning light and guide visitor movement naturally through space.", "lumina"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Combined with rich, site-specific materiality mapping and complete spatial customization freedom, you get a structural habitat that performs exceptionally while staying completely integrated with its terrain.", "lumina"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
