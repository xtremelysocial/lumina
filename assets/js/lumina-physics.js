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
		 * 01. DETAIL OPEN / CLOSE: Retains user setting
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
		 * 02. MEDIA FRAME ENGINE & VIEWPORT AUTO-WRAPPER
		 */

		// A. Unified Mat Targets: Auto-wraps unlinked framed/pan-zoom images in a static viewport
		var matContainersSelector = [
			'.wp-block-media-text.is-style-image-border .wp-block-media-text__media',
			'.wp-block-media-text.is-style-pan-zoom .wp-block-media-text__media',
			'.wp-block-image.is-style-image-border',
			'.wp-block-image.is-style-pan-zoom',
			'.wp-block-post-featured-image.is-style-image-border',
			'.wp-block-post-featured-image.is-style-pan-zoom'
		].join( ', ' );

		$( matContainersSelector ).each( function() {
			var $container = $( this );

			// Skip if the image is already wrapped in an <a> tag (link/lightbox handles its own viewport)
			if ( $container.children( 'a' ).length > 0 ) {
				return;
			}

			var $img = $container.children( 'img' );

			if ( $img.length && !$img.parent().hasClass( 'lumina-image-viewport' ) ) {
				$img.wrap( '<div class="lumina-image-viewport"></div>' );
			}
		} );

		// B. Radius & Border Sync: Transfers Gutenberg inline styles from <img> to outer <figure> mask
		var matFiguresSelector = [
			'.wp-block-image.is-style-pan-zoom',
			'.wp-block-post-featured-image.is-style-pan-zoom',
			'.wp-block-image.is-style-image-border',
			'.wp-block-post-featured-image.is-style-image-border'
		].join( ', ' );

		$( matFiguresSelector ).each( function() {
			var $figure = $( this );
			var $img    = $figure.find( 'img' );

			if ( $img.length ) {
				var borderRadius = $img.css( 'border-top-left-radius' );
				
				if ( borderRadius && borderRadius !== '0px' ) {
					var outerPx = parseFloat( borderRadius ) || 9;
					
					// Concentric Math: Outer Radius (9px) - Padding (6px) - Border (1px) = 2px
					var innerPx = Math.max( 0, outerPx - 6 - 1 ) + 'px';

					// Inject both CSS variables onto <figure> inline style
					$figure[0].style.setProperty( '--outer-radius', borderRadius );
					$figure[0].style.setProperty( '--inner-border-radius', innerPx );

					$figure.css( {
						'border-radius': borderRadius,
						'border-top-left-radius': $img.css( 'border-top-left-radius' ),
						'border-top-right-radius': $img.css( 'border-top-right-radius' ),
						'border-bottom-left-radius': $img.css( 'border-bottom-left-radius' ),
						'border-bottom-right-radius': $img.css( 'border-bottom-right-radius' )
					} );

					// Zero out inner image radius & border so scaling stays inside the mask
					$img.css( {
						'border-radius': '0',
						'border': 'none'
					} );
				}
			}
		} );

		/*
		 * 03. DYNAMIC CARD ENGINE: Turn single-link cards into unified click targets
		 */
	
		// Selector string matching any WP Core Lightbox trigger or container element
		const lightboxSelector = '.lightbox-trigger, .wp-block-image__lightbox-trigger, .wp-lightbox-container, [data-wp-interactive="core/image"], [aria-haspopup="dialog"]';

		// Helper to verify if an element or its parent is part of WP Core Lightbox
		function isLightboxElement(el) {
			var $el = $(el);
			if ($el.is(lightboxSelector)) {
				return true;
			}
			if (($el.attr('data-wp-on--click') || '').indexOf('showLightbox') !== -1) {
				return true;
			}
			if ($el.closest(lightboxSelector).length > 0) {
				return true;
			}
			return false;
		}

		// 1. INITIALIZATION: Target selector for candidate interactive cards (excludes full-width sections)
		const $interactiveCards = $('[class*="wp-block-"]:not(.alignfull):is(.has-background, .is-style-rounded-border, .is-style-thick-rounded-border, .is-style-rounded-corners, .wp-block-cover)');

		// 2. GET TARGET: Returns the target link/button if the card is "valid"
		function getValidTarget($card) {
			// Disqualify cards containing form controls
			if ($card.find('form, input:not([type="hidden"]), textarea, select').length > 0) {
				return null;
			}
		
			// Find all candidate links and buttons inside the card (filtering out Lightbox elements)
			var $candidates = $card.find('a, button, .wp-element-button').filter(function() {
				return !isLightboxElement(this);
			});

			if ($candidates.length === 0) {
				return null;
			}

			var urls = [];
			var validCandidates = [];

			$candidates.each(function() {
				var $el = $(this);
				var href = $el.attr('href');

				if ($el.is('a') && href) {
					urls.push(href.trim().replace(/\/+$/, ''));
					validCandidates.push($el);
				} else if ($el.is('.wp-element-button') && href) {
					urls.push(href.trim().replace(/\/+$/, ''));
					validCandidates.push($el);
				}
			});

			if (urls.length === 0) {
				return null;
			}

			// Verify all non-lightbox links/buttons share the EXACT same target URL
			var firstUrl = urls[0];
			var allMatch = urls.every(function(url) {
				return url === firstUrl;
			});

			if (!allMatch) {
				return null; // Differing destinations -> disqualifies card
			}

			// Return preferred target (prefer explicit button over simple link)
			var $button = $(validCandidates).filter('.wp-element-button').first();
			return $button.length ? $button : validCandidates[0];
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
		$('.is-interactive-card').each(function() {
			var $this = $(this);
			var $parentCard = $this.parents('.is-interactive-card').first();
			if ($parentCard.length) {
				$this.removeClass('is-interactive-card');
			}
		});

		// Pass C: Inject arrow overlays and set cursor on surviving (outer) cards
		$('.is-interactive-card').each(function() {
			var $card = $(this);
			var $target = getValidTarget($card);
		
			if ($target !== null) {
				$card.css('cursor', 'pointer');

				if ($card.find('> .lumina-card-arrow-overlay').length === 0) {
					var href = $target.attr('href') || '';
					var isAnchor = href.indexOf('#') === 0 || (href.indexOf('#') > -1 && href.split('#')[0] === window.location.href.split('#')[0]);
					var isExternal = $target.get(0).hostname && $target.get(0).hostname !== window.location.hostname;
		
					// Default: Standard Internal Link (→︎ \u2192\uFE0E)
					var arrowSymbol = '\u2192\uFE0E';
		
					if (isExternal) {
						// External Link (↗︎ \u2197\uFE0E)
						arrowSymbol = '\u2197\uFE0E';
					} else if (isAnchor) {
						var hashIndex = href.indexOf('#');
						var hash = hashIndex !== -1 ? href.substring(hashIndex) : '';
		
						if (hash.length > 1) {
							try {
								var $anchorTarget = $(hash);
								if ($anchorTarget.length) {
									var cardTop = $card.offset().top;
									var targetTop = $anchorTarget.offset().top;
		
									// \u2934\uFE0E = ⤴︎ (Curved Up) | \u2935\uFE0E = ⤵︎ (Curved Down)
									arrowSymbol = (targetTop < cardTop) ? '\u2934\uFE0E' : '\u2935\uFE0E';
								}
							} catch (err) {
								// Fallback for invalid selector strings (e.g. #/path)
								arrowSymbol = '\u2192\uFE0E';
							}
						}
					}
		
					var $overlay = $('<span class="lumina-card-arrow-overlay" aria-hidden="true">' + arrowSymbol + '</span>');
		
					if ($card.css('position') === 'static') {
						$card.css('position', 'relative');
					}
		
					$card.append($overlay);
				}
			}
		});

		// 04. MOBILE TOUCH HANDLER (Clean Card-Only Target)
		$(document).on('touchstart', '.is-interactive-card', function(e) {
			var $card = $(this);
		
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
	
		// 05. ACTION: Click / Navigation Handler
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

			// Don't intercept clicks if the user clicked directly on a button, link, form element, or Lightbox trigger
			if ($(e.target).closest('button, a, .wp-element-button, input, select, textarea, ' + lightboxSelector).length) {
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