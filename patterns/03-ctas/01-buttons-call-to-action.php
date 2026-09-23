<?php
/**
 * Title: Buttons Call To Action
 * Description: Buttons Call To Action
 * Slug: lumina/buttons-call-to-action
 * Categories: lumina, buttons, call-to-action
 * Block Types: core/buttons
 */
?>
<!-- wp:group {"metadata":{"name":"Call-to-Action"},"align":"wide","className":"is-style-rounded-border","backgroundColor":"secondary","layout":{"type":"constrained"},"anchor":"call-to-action-2-column"} -->
<div class="wp-block-group alignwide is-style-rounded-border has-secondary-background-color has-background" id="call-to-action-2-column">
	<!-- wp:columns {"verticalAlignment":"center","align":"wide","className":"is-style-center-on-mobile"} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center is-style-center-on-mobile">
		<!-- wp:column {"verticalAlignment":"center","width":"70%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:70%">
			<!-- wp:heading -->
			<h2 class="wp-block-heading"><strong><?php esc_html_e("Tell Your Story", "lumina"); ?></strong> <?php esc_html_e(" With Lumina Studio", "lumina"); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?php esc_html_e("Bring people together through intentional visual storytelling. Let us illuminate your narrative across print and digital media with timeless composition, light, and depth.", "lumina"); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"30%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:30%">
			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-fill"} -->
				<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" href="#content-start" rel="noreferrer noopener"><?php esc_html_e("Start a Project", "lumina"); ?></a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->