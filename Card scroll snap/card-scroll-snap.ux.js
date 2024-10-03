class BuildingProsperity {
    constructor() {
        
    }
    init() {
        var sdev_cookie = {};

        var thiselement = $('.block--card-scroll-snap');

        jQuery(function($) {
            
            var headerheight = $('header').outerHeight();
            var elementHeight = thiselement.find('.top-wrapper').outerHeight();
            var stickyposition = parseInt(headerheight);

            thiselement.find('.tab-wrapper').each(function(index, el) {
                if ($(window).width() >= 1200) {
                    $(this).css('top', stickyposition +'px');

                    if (!($(this).attr('id') in sdev_cookie)) {
                        sdev_cookie['#' + $(this).attr('id')] = $(this).offset().top - stickyposition;
                    }
                } else {
                    $(this).css('top', headerheight +'px');
                    
                    if (!($(this).attr('id') in sdev_cookie)) {
                        sdev_cookie['#' + $(this).attr('id')] = $(this).offset().top - headerheight;
                    }
                }

            });


            // anchor click event
            thiselement.find('.top-wrapper a').on('click', function(event) {
                event.preventDefault();
                
                if ($(window).width() >= 1200) {
                    thiselement.find('.tab-wrapper').css('top', stickyposition);
                } else {
                    thiselement.find('.tab-wrapper').css('top', 100);
                }

                var target = $(this).attr('href');

                var targetPosition = $(target).offset().top - stickyposition;


                // push new tab position
                if (Object.keys(sdev_cookie).length !== 0 && sdev_cookie.hasOwnProperty(target)) {
                    targetPosition = sdev_cookie[target];
                } else {
                    targetPosition = targetPosition;
                }

                $('html, body').animate({
                    scrollTop: targetPosition
                }, 100);
            });


            // scroll event
            $(window).on('resize scroll', function() {
                if ($('.block--card-scroll-snap').length && $('.block--card-scroll-snap').isInViewport()) {

                    $('.tab-wrapper').each(function() {
                        var currelement = '#' + $(this).attr('id');

                        var sectionTop = $(currelement).offset().top;
                        var sectionHeight = $(this).outerHeight();
                        var scrollPosition = $(window).scrollTop()  + $('header').outerHeight();
                        var windowHeight = $(window).height();
                        var totalWindowHeight = windowHeight + $('header').outerHeight();

                        if (scrollPosition >= sectionTop && windowHeight < sectionHeight) {
                            $(this).addClass('nostickyplease');
                            

                            var element = $(currelement);
                            var elementBottom = (element.offset().top + element.outerHeight()) + 100;
                            var viewportBottom = $(window).scrollTop() + $(window).height();

                            if (elementBottom <= viewportBottom) {
                                $(this).addClass('tofixedposition').css('top', -100);
                            }
                        }
                    });
                }
            });



        });

        
        $.fn.isInViewport = function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();

            return elementBottom > viewportTop && elementTop < viewportBottom;
        };
    }
}

$(function(){
    let _module = new BuildingProsperity();
    _module.init();
})