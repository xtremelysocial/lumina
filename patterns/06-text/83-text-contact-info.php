<?php
/**
 * Title: Contact Info
 * Description: Contact Info with Site Title
 * Slug: lumina/text-contact-info
 * Categories: lumina, text
 * Block Types: core/paragraph
 */
?>
<!-- wp:group {"metadata":{"name":"Contact Info"},"className":"is-style-default"} -->
<div class="wp-block-group is-style-default">

<!-- wp:site-title {"level":3,"isLink":false} /-->

<!-- wp:paragraph {"className":"is-style-link-no-underline"} -->
<p class="is-style-link-no-underline"><?php esc_html_e("1234 US Highway 99", "lumina"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline"} -->
<p class="is-style-link-no-underline"><?php esc_html_e("Anytown, USA 55555", "lumina"); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline"} -->
<p class="is-style-link-no-underline"><a href="tel:555-867-5309">(555) 867-5309</a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-link-no-underline"} -->
<p class="is-style-link-no-underline"><a href="mailto:#"><?php esc_html_e("mail@example.com", "lumina"); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:pattern {"slug":"lumina/text-social-icons-neutral"} /-->

</div>
<!-- /wp:group -->