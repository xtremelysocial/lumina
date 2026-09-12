<?php
/**
 * Title: Frequently Asked Questions (Artisan FAQ)
 * Description: Accordion block layout for raw studio materials and commissions.
 * Slug: lumina/text-faq-artisan
 * Categories: lumina, text
 * Block Types: core/details
 */
?>
<!-- wp:group {"metadata":{"name":"FAQ 2 Columns"},"align":"full","layout":{"type":"constrained"},"anchor":"faq-2-columns"} -->
<div class="wp-block-group alignfull" id="faq-2-columns"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"33.33%","className":"is-style-first-on-mobile","style":{"spacing":{"padding":{"right":"var:preset|spacing|40"}}}} -->
<div class="wp-block-column is-style-first-on-mobile" style="padding-right:var(--wp--preset--spacing--40);flex-basis:33.33%"><!-- wp:heading {"className":"is-style-separator"} -->
<h2 class="wp-block-heading is-style-separator"><?php esc_html_e("Frequently Asked Questions (FAQ)", "lumina"); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.5"}}} -->
<p style="line-height:1.5"><?php esc_html_e("Have queries regarding raw material sourcing, shipping guidelines, or studio commissions? Find clear answers to common inquiries below, or reach out to our workshop directly.", "lumina"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:details {"showContent":true} -->
<details class="wp-block-details" open><summary><?php esc_html_e("Why do handmade clay glazes vary slightly in surface coloration?", "lumina"); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e("Every individual piece is fired inside small-batch studio kilns where organic thermal currents dictate final surface variation. This provides deep visual interest to functional objects, ensuring your selected asset remains completely unique.", "lumina"); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e("Will outdoor weather environments erode raw untreated timber over time?", "lumina"); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e("Not at all. We utilize dense heartwood cuts paired with food-safe organic protective oils. This natural barrier prevents decay while allowing the timber substrate to develop a beautiful structural patina as it ages.", "lumina"); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->