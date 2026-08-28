<?php
/**
 * Title: Frequently Asked Questions (Faq)
 * Description: Frequently Asked Questions (Faq)
 * Slug: lumina/text-faq
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

<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.5"}},"textColor":"contrast"} -->
<p class="has-contrast-color has-text-color" style="line-height:1.5"><?php esc_html_e("Have questions about our services or theme features? Find quick answers to common inquiries below, or reach out to our team directly.", "lumina"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:details {"showContent":true} -->
<details class="wp-block-details" open><summary><?php esc_html_e("Why are the default post featured images so wide and slim?", "lumina"); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e("The default images are half-height wide (16:4.5) format. This provides visual interest to your pages and posts, but without filling the users screen with the image. They will be able to easily see the title, subtitle, image, and lead-in text \"above the fold\" on laptops and desktops.", "lumina"); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e("Won't the auto play videos drain mobile device batteries?", "lumina"); ?></summary><!-- wp:paragraph {"placeholder":"Type / to add a hidden block"} -->
<p><?php esc_html_e("Not at all. The included \"videos\" are actually not videos at all. They are small static images, with a \"Ken Burns effect\" applied via simple CSS. The method takes and image larger than the frame you are viewing and slowly zooms and pans while adjusting brightness to simulate moving a camera around at different angles. This takes 1/10th the GPU processing of what an actual auto-play video would take.", "lumina"); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e("What is included in the Lumina theme license?", "lumina"); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e("Lumina includes full access to all block patterns, template parts, custom block styles, and regular updates. You also receive access to complete documentation and direct support.", "lumina"); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e("Can I customize typography and global styles without coding?", "lumina"); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e("Yes. Lumina is built for Full Site Editing. You can change colors, block spacing, border radius, and choose from over a dozen font combinations directly in the Site Editor under Global Styles.", "lumina"); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e("Is Lumina optimized for mobile devices and fast page loads?", "lumina"); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e("Absolutely. Lumina uses zero heavy JavaScript libraries and relies on native CSS grid and flexbox engines to ensure lightning-fast rendering across desktop and mobile screens.", "lumina"); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e("How do updates work when WordPress releases new versions?", "lumina"); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e("Because Lumina relies on native core WordPress blocks and standard `theme.json` architecture, updates integrate seamlessly without breaking custom page layouts or overrides.", "lumina"); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->