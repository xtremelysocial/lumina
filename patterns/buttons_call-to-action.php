<?php
/**
 * Title: Buttons Call To Action
 * Description: Buttons Call To Action
 * Slug: lumina/buttons_call-to-action
 * Categories: lumina, buttons, call-to-action
 * Block Types: core/buttons
 */
?>
<!-- wp:group {"metadata":{"name":"Call-to-Action"},"align":"wide","className":"is-style-rounded-border","style":{"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"secondary","layout":{"type":"constrained"},"anchor":"call-to-action-2-column"} -->
<div class="wp-block-group alignwide is-style-rounded-border has-secondary-background-color has-background" id="call-to-action-2-column" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"70%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:70%"><!-- wp:heading {"className":"wp-block-heading has-foreground-alt-color has-text-color"} -->
<h2 class="wp-block-heading has-foreground-alt-color has-text-color"><strong><?php esc_html_e("Illuminate", "lumina"); ?></strong><?php esc_html_e("your Website Today", "lumina"); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e("Hover this card or tap it on mobile and it lifts further towards you, visually indicating there is a link or button on this card. You can actually click anywhere on the card and this one will scroll back to the features above.", "lumina"); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"30%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:30%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" href="#content-start" target="_blank" rel="noreferrer noopener"><?php esc_html_e("Get Started", "lumina"); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->