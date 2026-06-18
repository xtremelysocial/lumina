/**
 * File:	atmos-physics.js
 * Theme: 	Atmos Blocks
 * * Javascript for turning cards with a single link or button into a click target.
 *
 * @package atmos-blocks
 * @since	1.0
 */
 
( function( $ ) {
	
	$(document).ready(function() {

		/*
		 * If an animated card only has one link or one button, then link the 
		 * entire card.
		 */
	
		// 1. INITIALIZATION: Set the cursor for everything that qualifies
		const $interactiveCards = $('[class*="wp-block-"]:is(.has-background, .is-style-rounded-border, .is-style-thick-rounded-border, .is-style-rounded-corners, .wp-block-cover):not(.alignfull)');

		// 2. GET TARGET: Returns the target link/button if the card is "valid"
		function getValidTarget($card) {
			var $buttons = $card.find('.wp-element-button');
			var $links = $card.find('a').not('.wp-element-button');

			// Return link or button or nothing if neither found			
			if ($buttons.length === 1 && $links.length === 0) return $buttons.first();
			if ($buttons.length === 0 && $links.length === 1) return $links.first();
			
			return null;
		}

		// 3. CURSOR: Set only if the helper finds a valid target
		$interactiveCards.each(function() {
			if (getValidTarget($(this)) !== null) {
				$(this).css('cursor', 'pointer');
			}
		});
	
		// 4. ACTION: Mobile-optimized click/navigation listener
		$interactiveCards.on('click', function(e) {
			
			// Check if the user tapped an actual interactive element OR any of its nested children
			if ($(e.target).closest('button, a, .wp-element-button, input, select').length) {
				return;
			}
	
			var $target = getValidTarget($(this));
	
			if ($target !== null) {
				if ($target.is('a')) {
					var href = $target.attr('href');
					var targetAttr = $target.attr('target');

					if (href) {
						// DETECT INTERNAL ANCHOR: Check if the link is a same-page hash link
						var isAnchor = href.indexOf('#') === 0 || (href.indexOf('#') > -1 && href.split('#')[0] === window.location.href.split('#')[0]);

						if (isAnchor) {
							// Pass control directly to smoothscroll.js to execute your header padding subtractions
							$target.trigger('click');
						} else if (targetAttr === '_blank') {
							window.open(href, '_blank');
						} else {
							window.location.href = href;
						}
					}
				} else {
					// If it's a physical form submission button, programmatic click is safe
					$target[0].click();
				}
			}
		});
			
	});
	
} )( jQuery );