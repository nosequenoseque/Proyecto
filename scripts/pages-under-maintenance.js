/**
 * @author Batch Themes Ltd.
 */
(function() {
    'use strict';
    $(function() {
        var config = $.localStorage.get('config');
        $('body').attr('data-layout', 'fullsize-background-image');
        $('body').attr('data-palette', config.theme);
        $('body').attr('data-direction', config.direction);
        var searchForPage = $('.under-maintenance #search-for-page');
        searchForPage.floatingLabels();
        var now = new Date();
        now.setDate(now.getDate() + 30);
        $('#under-maintenance-counter').countdown(now).on('update.countdown', function(event) {
            $(this).html(event.strftime(
                '<div class="table-responsive"><table class="table"><tr>' +
                '<td><span class="number">%D</span></br><span class="unit">days</span></td>' +
                '<td><span class="dots">:</span></td> ' +
                '<td><span class="number">%H</span></br><span class="unit">hours</span></td>' +
                '<td><span class="dots">:</span></td> ' +
                '<td><span class="number">%M</span></br><span class="unit">minutes</span></td>' +
                '<td><span class="dots">:</span></td> ' +
                '<td><span class="number">%S</span></br><span class="unit">seconds</span></td>' +
                '</tr></table></div>'
            ));
        });
    });
})();
