jQuery(document).ready(function ($) {

    "use strict";

    // Mobile search
    $('#top-search i.search-toggle').on('click', function (e) {
        e.preventDefault();
        $('.show-search').slideToggle('fast');
    });

    // Menu
    $('#nav-wrapper .menu').slicknav({
        prependTo: '.menu-mobile',
        label: '',
        allowParentLinks: true
    });

    // Fitvids
    $(document).ready(function () {
        // Target your .container, .wrapper, .post, etc.
        $(".container").fitVids();
    });


});
