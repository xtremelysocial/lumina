<?php
/**
 * Title: Contact Info
 * Description: Contact Info
 * Slug: lumina/text-contact-info
 * Categories: lumina, text
 * BlockTypes: core/paragraph
 */
?>
<!-- wp:group {"metadata":{"name":"Contact Info"},"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
<!-- wp:paragraph {"className":"is-style-link-no-underline"} -->
<p class="is-style-link-no-underline"><?php esc_html_e("1234 US Highway 99", "lumina"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}}} -->
<p class="is-style-link-no-underline" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--20)"><?php esc_html_e("Anytown, USA 55555", "lumina"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline"} -->
<p class="is-style-link-no-underline"><a href="tel:555-867-5309">(555) 867-5309</a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}}} -->
<p class="is-style-link-no-underline" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--20)"><a href="mailto:#"><?php esc_html_e("mail@example.com", "lumina"); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:template-part {"slug":"social-icons-neutral","theme":"lumina"} /--></div>
<!-- /wp:group -->