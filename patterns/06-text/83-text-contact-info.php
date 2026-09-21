<?php
/**
 * Title: Contact Info
 * Description: Contact Info with Site Title
 * Slug: lumina/text-contact-info
 * Categories: lumina, text
 * Block Types: core/paragraph
 */
?>
<!-- wp:group {"metadata":{"name":"Contact Info"},"className":"is-style-default","layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-default">

<!-- wp:site-title {"level":3,"isLink":false} /-->

<!-- wp:group {"metadata":{"name":"Address"},"style":{"spacing":{"blockGap":"0px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
	<!-- wp:paragraph {"className":"is-style-link-no-underline"} -->
	<p class="is-style-link-no-underline"><?php esc_html_e("1234 US Highway 99", "lumina"); ?></p>
	<!-- /wp:paragraph -->
	
	<!-- wp:paragraph {"className":"is-style-link-no-underline"} -->
	<p class="is-style-link-no-underline"><?php esc_html_e("Anytown, USA 55555", "lumina"); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Contact Details"},"style":{"spacing":{"blockGap":"0px","margin":{"top":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--20)">
	<!-- wp:paragraph {"className":"is-style-link-no-underline"} -->
	<p class="is-style-link-no-underline"><a href="tel:555-867-5309">(555) 867-5309</a></p>
	<!-- /wp:paragraph -->
	
	<!-- wp:paragraph {"className":"is-style-link-no-underline"} -->
	<p class="is-style-link-no-underline"><a href="mailto:#"><?php esc_html_e("mail@example.com", "lumina"); ?></a></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:pattern {"slug":"lumina/text-social-icons-neutral"} /-->

</div>
<!-- /wp:group -->