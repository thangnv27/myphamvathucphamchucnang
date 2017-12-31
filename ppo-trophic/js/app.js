jQuery(window).ready(function () {
    /* !Main navigation */
    /* We need to fine-tune timings and do something about the usage of jQuery "animate" function */

    $("#mobile-menu").wrap('<div id="dl-menu" class="dl-menuwrapper" />');
    var $mobileNav = $("#main-nav").clone();
    $mobileNav
            .attr("id", "")
            .attr("class", "dl-menu")
            .find(".sub-menu")
            .addClass("dl-submenu")
            .removeClass("sub-menu");
    $mobileNav.appendTo("#dl-menu");
    $("#dl-menu").prepend('<button class="dl-trigger">Open Menu</button>');
    
    if (!$("html").hasClass("old-ie"))
        $('#dl-menu').dlmenu();

    /* Main navigation: end */
    
    $(".cat-menu-title").mouseover(function () {
        $(".menu-cat").show();
    });
    $(".side-cat-menu").mouseleave(function () {
        $(".menu-cat").hide();
    });

    $(".post-content img").each(function (){
        $(this).parent('a').attr('rel', 'gallery');
    });
    $("a[rel=example_group], a[rel=gallery]").fancybox({
        'transitionIn': 'none',
        'transitionOut': 'none',
        'titlePosition': 'over',
        'titleFormat': function (title, currentArray, currentIndex, currentOpts) {
            return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + ' ' + title + '</span>';
        }
    });
});
