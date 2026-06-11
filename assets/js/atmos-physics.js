/**
 * File:	atmos-physics.js
 * Theme: 	Atmos Blocks
 * 
 * Javascript for turning cards with a single link or button into a click target.
 *
 * @package atmos-blocks
 * @since	1.0
 * 
 * Ensure that the $interactiveCards string matches the Atmos Physics Engine
 * wildcard for "cards". e.g. [class*="wp-block-"]:is():has():not()
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

			// Debugging: uncomment these lines to see exactly what is being counted
// 			console.log('Card ID:', $card.attr('id'));
// 			console.log('Buttons found:', $buttons.length);
// 			console.log('Links found:', $links.length);

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
	
		// 4. ACTION: The click listener uses the same helper
		$interactiveCards.on('click', function(e) {
			if ($(e.target).is('button, a, .wp-element-button, input, select')) return;
	
			var $target = getValidTarget($(this));
	
			if ($target !== null) {
				$target[0].click();
			}
		});
			
	});
	
} )( jQuery );