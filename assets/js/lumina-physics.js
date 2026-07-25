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

//		/* 
//		 * HEADLINE UNDERLINES: Add class to continue after click
//		 */
		 
// 		// Define the heading link selectors
// 		const headingLinks = '.wp-block-heading a, .wp-block-site-title a, .wp-block-post-title a, .wp-block-latest-posts.is-grid .wp-block-latest-posts__post-title';
// 		
// 		// Slap the loading state class on the clicked link right before page unload
// 		$(headingLinks).on('click', function() {
// 			$(this).addClass('is-loading');
// 		});

		/*
		 * DETAIL OPEN / CLOSE: Retains user setting
		 */

		// Retain open/closed state of HTML details blocks using localStorage
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
		
			// 🚀 HASH DETECTOR OVERRIDE: 
			// If the URL has a hash (e.g., #respond) and that target element is inside this details block, force it open!
			if ( window.location.hash ) {
				try {
					const $targetElement = $details.find( window.location.hash );
					if ( $targetElement.length > 0 ) {
						$details.prop( 'open', true );
					}
				} catch (e) {
					// Defensive catch in case the hash contains invalid selector characters
					console.warn("Invalid URL hash selector skipped", e);
				}
			}
		
			// 4. SAVE STATE: Listen for the native HTML toggle event
			$details.on( 'toggle', function() {
				localStorage.setItem( storageKey, this.open ? 'open' : 'closed' );
			} );
		} );

		// Retain open/closed state of HTML details blocks using localStorage
// 		$( 'details' ).each( function( index ) {
// 			const $details = $( this );
// 			
// 			// 1. Resolve a unique identifier for this element
// 			// Looks for details ID first, then falls back to the closest parent ID, then a default string
// 			const elementIdentifier = $details.attr( 'id' ) || $details.closest( '[id]' ).attr( 'id' ) || 'global';
// 			
// 			// 2. Scope the storage key to the current page path so states don't bleed across different posts/pages
// 			const pagePath   = window.location.pathname.replace( /[^a-zA-Z0-9]/g, '_' );
// 			const storageKey = 'details_state_' + pagePath + '_' + elementIdentifier + '_' + index;
// 		
// 			// 3. RESTORE STATE: Check if a saved preference exists on page load
// 			const savedState = localStorage.getItem( storageKey );
// 			if ( savedState !== null ) {
// 				$details.prop( 'open', savedState === 'open' );
// 			}
// 		
// 			// 4. SAVE STATE: Listen for the native HTML toggle event
// 			$details.on( 'toggle', function() {
// 				localStorage.setItem( storageKey, this.open ? 'open' : 'closed' );
// 			} );
// 		} );

		/*
		 * If an animated card only has one link or one button, then link the 
		 * entire card.
		 */
	
		// 1. INITIALIZATION: Target selector for interactive cards
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

		// 3. CURSOR & BADGE INJECTION: Tag card & mount overlay directly on outer card
		$interactiveCards.each(function() {
			var $card = $(this);
			var $target = getValidTarget($card);

			if ($target !== null) {
				// Mark as an interactive card to scope CSS hover
				$card.addClass('is-interactive-card');
				$card.css('cursor', 'pointer');

				// Append arrow overlay badge to the outer card if not present
				if ($card.find('> .lumina-card-arrow-overlay').length === 0) {
					var href = $target.attr('href') || '';
					var isAnchor = href.indexOf('#') === 0 || (href.indexOf('#') > -1 && href.split('#')[0] === window.location.href.split('#')[0]);

					// \u2192\uFE0E = →︎ (Neutral Right Arrow for Anchor Jump) | \u2197\uFE0E = ↗︎ (Up-Right for Links)
					var arrowSymbol = isAnchor ? '\u2192\uFE0E' : '\u2197\uFE0E';
					var $overlay = $('<span class="lumina-card-arrow-overlay" aria-hidden="true">' + arrowSymbol + '</span>');

					// Ensure position context on the outer card
					if ($card.css('position') === 'static') {
						$card.css('position', 'relative');
					}

					$card.append($overlay);
				}
			}
		});

		// 4. MOBILE TOUCH HANDLER: Tap 1 activates card & shows arrow; Tap 2 follows link
		$(document).on('touchstart', '.is-interactive-card', function(e) {
			var $card = $(this);
			var $target = getValidTarget($card);
			if (!$target) return;

			if (!$card.hasClass('is-active')) {
				// Deactivate any other open cards on the page
				$('.is-interactive-card').not($card).removeClass('is-active');
				
				// Activate this card (reveals arrow overlay via CSS)
				$card.addClass('is-active');
				$card.data('just-activated', true);
			} else {
				$card.data('just-activated', false);
			}
		});

		// Cancel tap-state if the user was actually swiping to scroll
		$(document).on('touchmove', function() {
			$('.is-interactive-card').data('just-activated', false);
		});

		// Reset active cards when user taps anywhere outside
		$(document).on('touchstart click', function(e) {
			if (!$(e.target).closest('.is-interactive-card').length) {
				$('.is-interactive-card').removeClass('is-active');
			}
		});
	
		// 5. ACTION: Clean click/navigation listener
		$(document).on('click', '.is-interactive-card', function(e) {
			var $card = $(this);
			var $target = getValidTarget($card);

			if ($target === null) return;

			// Intercept first touch-tap click on mobile
			if ($card.data('just-activated')) {
				e.preventDefault();
				e.stopPropagation();
				$card.data('just-activated', false);
				return;
			}

			// SAFETY VALVE: If click originated on inner button/link (or from trigger),
			// let native link / smoothscroll handle it naturally without looping!
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
						// Pass control over to smoothscroll.js
						$target.trigger('click');

						// Allow user scroll to interrupt smooth animation
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