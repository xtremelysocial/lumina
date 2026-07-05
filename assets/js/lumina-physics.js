/**
 * File:        lumina-physics.js
 * Theme:       Lumina Blocks
 *
 * Javascript for turning cards with a single link or button into a click target.
 *
 * @package lumina
 * @since   1.0
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
			if ($card.find('form, input:not([type="hidden"]), textarea, select').length > 0) {
				return null;
			}
		
			var $buttons = $card.find('.wp-element-button');
			var $links = $card.find('a').not('.wp-element-button');
			
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
	
		// 4. ACTION: Clean click/navigation listener
		$interactiveCards.on('click', function(e) {
			
			// If the user clicked a real interactive element inside, let it go natively
			if ($(e.target).closest('button, a, .wp-element-button, input, select').length) {
				return;
			}
	
			var $target = getValidTarget($(this));
	
			if ($target !== null) {
				
				// Kill the parent card highlight state immediately
				e.preventDefault();
				e.stopPropagation();
	
				if ($target.is('a')) {
					var href = $target.attr('href');
					var targetAttr = $target.attr('target');

					if (href) {
						var isAnchor = href.indexOf('#') === 0 || (href.indexOf('#') > -1 && href.split('#')[0] === window.location.href.split('#')[0]);

						if (isAnchor) {
							// Pass control over to smoothscroll.js exactly like a native link click
							$target.trigger('click');

							// SAFETY VALVE: If the user moves their wheel or touches the screen mid-scroll,
							// instantly kill the running animation so it never fights their manual input.
							$('html, body').one('wheel mousewheel touchmove DOMMouseScroll mousedown', function() {
								$('html, body').stop();
							});
						} else if (targetAttr === '_blank') {
							window.open(href, '_blank');
						} else {
							window.location.href = href;
						}
					}
				} else {
					$target[0].click();
				}
			}
		});
	});
	
} )( jQuery );