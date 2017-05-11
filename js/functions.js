jQuery(document).ready(function ($) {
    "use strict";
    // Mobile search
    $( '#top-search i.search-toggle' ).on('click', function (e) {
        e.preventDefault();
        $('.show-search').slideToggle('fast');
    });
    /**
     * 手机菜单切换
     */
    var clickEvent = 'ontouchstart' in window ? 'touchstart' : 'click';
    var $body = $( 'body' ),
        $button = $( '#sidebar-toggle' ),
        sidebarClass = 'mobile-sidebar-open';

    // Click to show mobile menu
    $button.on( clickEvent, function ( e ) {
        if ( $body.hasClass( sidebarClass ) ) {
            return;
        }
        e.stopPropagation(); // Do not trigger click event on '.site' below
        $body.addClass( sidebarClass );
        $button.addClass( 'active' );
        $('.mobile-sidebar').removeClass('sidebar-hide');
    } );
    // When mobile menu is open, click on page content will close it
    $( '.site' ).on( clickEvent, function ( e ) {
        if ( ! $body.hasClass( sidebarClass ) ) {
            return;
        }
        e.preventDefault();
        $body.removeClass( sidebarClass );
        $button.removeClass( 'active' );
        $('.mobile-sidebar').addClass('sidebar-hide');
    } );
    /**
     * 一键回到顶部
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

    //语法高亮
    hljs.initHighlightingOnLoad();
    $("pre code").each(function (i, block) {
        hljs.highlightBlock(block);
    });
});
//修复禁用滚动条丢失的问题
var ModalHelper = (function(bodyCls) {
    var scrollTop;
    return {
        afterOpen: function() {
            scrollTop = document.scrollingElement.scrollTop;
            document.body.classList.add(bodyCls);
            document.body.style.top = -scrollTop + 'px';
        },
        beforeClose: function() {
            document.body.classList.remove(bodyCls);
            // scrollTop lost after set position:fixed, restore it back.
            document.scrollingElement.scrollTop = scrollTop;
        }
    };
})('mobile-sidebar-open');