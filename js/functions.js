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
    /**
     * Scroll to top
     */
    $('.back2top').hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $('.back2top').fadeIn(200)
        } else {
            $('.back2top').fadeOut(200)
        }
        if ($(this).scrollTop() > 360) $('#index').addClass('fix');
        else $('#index').removeClass('fix');
    });
    $('.back2top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false
    });

});