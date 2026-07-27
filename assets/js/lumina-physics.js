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
		 * DETAIL OPEN / CLOSE: Retains user setting
		 */
		$( 'details' ).each( function( index ) {
			const $details = $( this );
			
			// 1. Resolve a unique identifier for this element
			const elementIdentifier = $details.attr( 'id' ) || $details.closest( '[id]' ).attr( 'id' ) || 'global';
			
			// 2. Scope the storage key to the current page path so states don't bleed
			const pagePath   = window.location.pathname.replace( /[^a-zA-Z0-9]/g, '_' );
			const storageKey = 'details_state_' + pagePath + '_' + elementIdentifier + '_' + index;
		
			// 3. RESTORE STATE: Check if a saved preference exists on page load
			const savedState = localStorage.getItem( storageKey );
			if ( savedState !== null ) {
				$details.prop( 'open', savedState === 'open' );
			}
		
			// HASH DETECTOR OVERRIDE: Force open if URL targets an element inside
			if ( window.location.hash ) {
				try {
					const $targetElement = $details.find( window.location.hash );
					if ( $targetElement.length > 0 ) {
						$details.prop( 'open', true );
					}
				} catch (e) {
					console.warn("Invalid URL hash selector skipped", e);
				}
			}
		
			// 4. SAVE STATE: Listen for the native HTML toggle event
			$details.on( 'toggle', function() {
				localStorage.setItem( storageKey, this.open ? 'open' : 'closed' );
			} );
		} );

		/*
		 * DYNAMIC CARD ENGINE: Turn single-link cards into unified click targets
		 */
	
		// 1. INITIALIZATION: Target selector for candidate interactive cards
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

		// 3. THREE-PASS CARD RESOLUTION (Outer card stays active, inner cards are vetoed)

		// Pass A: Identify all candidate interactive cards
		$interactiveCards.each(function() {
			var $card = $(this);
			var $target = getValidTarget($card);

			if ($target !== null) {
				$card.addClass('is-interactive-card');
			}
		});

		// Pass B: VETO INNER CHILD CARDS
		// If an interactive card is nested inside another interactive card, strip interactivity 
		// from the inner child so only the outer parent card remains the active click target.
		$('.is-interactive-card').each(function() {
			var $this = $(this);
			// Check if this card has an ancestor that is ALSO an interactive card
			var $parentCard = $this.parents('.is-interactive-card').first();
			if ($parentCard.length) {
				// This is an inner card—strip its interactive status so it won't get an arrow or separate click handler
				$this.removeClass('is-interactive-card');
			}
		});

		// Pass C: Inject arrow overlays and set cursor on the surviving (outer) cards
		$('.is-interactive-card').each(function() {
			var $card = $(this);
			var $target = getValidTarget($card);

			if ($target !== null) {
				$card.css('cursor', 'pointer');

				// Append arrow overlay badge to the outer card if not already present
				if ($card.find('> .lumina-card-arrow-overlay').length === 0) {
					var href = $target.attr('href') || '';
					var isAnchor = href.indexOf('#') === 0 || (href.indexOf('#') > -1 && href.split('#')[0] === window.location.href.split('#')[0]);

					// \u2192\uFE0E = →︎ (Neutral Right Arrow) | \u2197\uFE0E = ↗︎ (Up-Right Arrow)
					var arrowSymbol = isAnchor ? '\u2192\uFE0E' : '\u2197\uFE0E';
					var $overlay = $('<span class="lumina-card-arrow-overlay" aria-hidden="true">' + arrowSymbol + '</span>');

					if ($card.css('position') === 'static') {
						$card.css('position', 'relative');
					}

					$card.append($overlay);
				}
			}
		});

		// 4. MOBILE TOUCH HANDLER
		$(document).on('touchstart', '.is-interactive-card', function(e) {
			var $card = $(this);
			var $target = getValidTarget($card);
			if (!$target) return;

			if (!$card.hasClass('is-active')) {
				$('.is-interactive-card').not($card).removeClass('is-active');
				$card.addClass('is-active');
				$card.data('just-activated', true);
			} else {
				$card.data('just-activated', false);
			}
		});

		$(document).on('touchmove', function() {
			$('.is-interactive-card').data('just-activated', false);
		});

		$(document).on('touchstart click', function(e) {
			if (!$(e.target).closest('.is-interactive-card').length) {
				$('.is-interactive-card').removeClass('is-active');
			}
		});
	
		// 5. ACTION: Click / Navigation Handler
		$(document).on('click', '.is-interactive-card', function(e) {
			var $card = $(this);
			var $target = getValidTarget($card);

			if ($target === null) return;

			if ($card.data('just-activated')) {
				e.preventDefault();
				e.stopPropagation();
				$card.data('just-activated', false);
				return;
			}

			if ($(e.target).closest('button, a, .wp-element-button, input, select').length) {
				$card.removeClass('is-active');
				return;
			}

			e.preventDefault();
			e.stopPropagation();
			$card.removeClass('is-active');

			if ($target.is('a')) {
				var href = $target.attr('href');
				var targetAttr = $target.attr('target');

				if (href) {
					var isAnchor = href.indexOf('#') === 0 || (href.indexOf('#') > -1 && href.split('#')[0] === window.location.href.split('#')[0]);

					if (isAnchor) {
						$target.trigger('click');

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
		});
	});
	
} )( jQuery );