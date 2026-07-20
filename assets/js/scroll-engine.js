/**
 * File: scroll-engine.js
 * Unified Intersection Observer for element reveals and header states.
 */
document.addEventListener('DOMContentLoaded', () => {

    // 1. ELEMENT REVEAL ENGINE (Lists, Blocks, Heroes)
    const revealOptions = {
        root: null, // Default to browser viewport
        rootMargin: '0px 0px -8% 0px', // Triggers slightly before element enters center frame
        threshold: 0.1
    };

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                // Disconnect target once visible so the browser stops processing it
                observer.unobserve(entry.target);
            }
        });
    }, revealOptions);

    // Watch both our custom Ordered List styles and the global fade utility class
    const elementsToAnimate = document.querySelectorAll('.is-style-large-numbers li, .animate-fadein');
    elementsToAnimate.forEach(el => revealObserver.observe(el));


    // 2. FIXED / STICKY HEADER STATE ENGINE
    // Swap selector to match your custom theme header container class if needed
    const headerElement = document.querySelector('.site-header, .wp-block-template-part-header'); 
    
    if (headerElement) {
        // Inject an invisible 1px sentinel node at the absolute top of the document body
        const sentinel = document.createElement('div');
        sentinel.className = 'header-scroll-sentinel';
        sentinel.style.cssText = 'position:absolute; top:0; left:0; width:1px; height:1px; visibility:hidden; pointer-events:none;';
        document.body.prepend(sentinel);

        const headerObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                // If the sentinel leaves the viewport at the top, lock the header state
                if (!entry.isIntersecting) {
                    headerElement.classList.add('is-fixed-compact');
                } else {
                    headerElement.classList.remove('is-fixed-compact');
                }
            });
        }, { root: null, threshold: 0 });

        headerObserver.observe(sentinel);
    }
});