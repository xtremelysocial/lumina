<?php
/**
 * Title: Lumina CTA 2 Columns
 * Slug: lumina/buttons-columns-cta-2-columns
 * Categories: lumina, call-to-action, featured
 * Block Types: core/columns
 */
?>
<!-- wp:group {,"align":"wide","backgroundColor":"primary","className":"is-style-rounded-border","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide is-style-rounded-border has-primary-background-color has-background" id="call-to-action-2-columns">
	<!-- wp:heading {"textAlign":"left","placeholder":"Call to Action 2 Columns","align":"wide"} -->
	<h2 class="wp-block-heading alignwide has-text-align-left" id="call-to-action-2-columns">Call to Action 2 Columns</h2>
	<!-- /wp:heading -->

	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"66.66666%"} -->
		<div class="wp-block-column" style="flex-basis:66.66666%">
			<!-- wp:paragraph {"align":"left"} -->
			<p class="has-text-align-left">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"bottom"} -->
		<div class="wp-block-column is-vertically-aligned-bottom">
			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
			<div class="wp-block-buttons">
				<!-- wp:button {"className":"is-style-outline"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#content-start">Click Me</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
