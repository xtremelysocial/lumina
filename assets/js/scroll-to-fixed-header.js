/**
 * File:    pro-custom-styles.js
 * Theme:   Flat Blocks PRO
 *
 * jQuery script for scrolling fixed header with dynamic element triggers
 */

( function( $ ) {
    const scrollHeader = $( '.is-style-scroll-header' );

    if ( scrollHeader.length > 0 ) {
        const activeClass = 'header-active';
        const scrollInterval = 250;
        let triggerThreshold = 88;

        // Function to dynamically calculate where the scroll trigger lives
        function calculateThreshold() {
            const contentStart = $( '#content-start' );
            
            if ( contentStart.length > 0 ) {
                // Trigger exactly when #content-start hits the top of the viewport
                triggerThreshold = contentStart.offset().top;
            } else {
                // Fallback to header height or default baseline
                triggerThreshold = scrollHeader.outerHeight() ?? 88;
            }
        }

        // Run initial calculation on load
        calculateThreshold();

        // Recalculate if the layout changes on window resize
        $( window ).on( 'resize', function() {
            calculateThreshold();
        } );

        // Monitor scroll activity using your performance throttle loop
        let didScroll = false;
        $( window ).scroll( function() {
            didScroll = true;
        } );

        setInterval( function() {
            if ( didScroll ) {
                didScroll = false;
                const currentScroll = $( window ).scrollTop();
                
                if ( currentScroll >= triggerThreshold ) {
                    scrollHeader.addClass( activeClass );
                } else {
                    scrollHeader.removeClass( activeClass );
                }
            }
        }, scrollInterval );
    }
}( jQuery ) );