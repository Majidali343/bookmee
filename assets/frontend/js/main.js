(function($) {
    "use strict";

    $(document).ready(function() {
        // JS for rtl
        var rtlEnable = $('html').attr('dir');
        var sliderRtlValue = !(typeof rtlEnable === 'undefined' || rtlEnable === 'ltr');
        var OwlRtlValue = !(typeof rtlEnable === 'undefined' || rtlEnable === 'ltr');

        /*--------------------
            wow js init
        ---------------------*/
        new WOW().init();

        /* 
        ========================================
            Navbar Toggler button
        ========================================
        */
        $(document).on('click', '.navbar-toggler-icon', function() {
            $(".navbar-toggler-icon").toggleClass("active");
        });
        /* Navbar Right btn */
        $(document).on('click', '.show-nav-right-contents', function() {
            $(".nav-right-content").toggleClass("active");
        });



        /* 
        ----------------------------------------
            Location click
        ----------------------------------------
        */

        $('.overview-location, .date-time-list').on('click', '.single-location, .list', function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });


        /* 
        ========================================
            Dashboard Responsive Sidebar
        ========================================
        */

        $('.close-bars, .body-overlay').on('click', function() {
            $('.dashboard-close, .dashboard-close-main, .body-overlay').removeClass('active');
        });
        $('.sidebar-icon').on('click', function() {
            $('.dashboard-close, .dashboard-close-main, .body-overlay').addClass('active');
        });


        /* 
        ========================================
            Cart Click 
        ========================================
        */

        $('.overlays').on('click', function() {
            $(".overlays, .cart-icon").removeClass("active");
        });
        $('.cart-icon').on('click', function() {
            $(".cart-icon, .overlays").addClass("active");
        });

        /*----------------------
            Category Slider
        -----------------------*/

        $('.category-slider').slick({
            slidesToShow: 5,
            rtl: OwlRtlValue,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            prevArrow: '<div class="prev-icon"><i class="las la-angle-left"></i></div>',
            nextArrow: '<div class="next-icon"><i class="las la-angle-right"></i></div>',
            infinite: true,
            autoplay: false,
            pauseOnHover: true,
            swipeToSlide: true,
            responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 425,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });

        /*----------------------
            Service Slider
        -----------------------*/

        $('.services-slider').slick({
            slidesToShow: 3,
            rtl: OwlRtlValue,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            prevArrow: '<div class="prev-icon"><i class="las la-angle-left"></i></div>',
            nextArrow: '<div class="next-icon"><i class="las la-angle-right"></i></div>',
            infinite: true,
            autoplay: false,
            pauseOnHover: true,
            swipeToSlide: true,
            responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });

        /*----------------------
            Professional Slider
        -----------------------*/

        $('.professional-slider').slick({
            slidesToShow: 5,
            rtl: OwlRtlValue,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            prevArrow: '<div class="prev-icon"><i class="las la-angle-left"></i></div>',
            nextArrow: '<div class="next-icon"><i class="las la-angle-right"></i></div>',
            infinite: true,
            autoplay: false,
            pauseOnHover: true,
            swipeToSlide: true,
            responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2,
                    }
                }
            ]
        });

        /*----------------------
            Clientlogo Slider
        -----------------------*/

        $('.clientlogo-slider').slick({
            slidesToShow: 4,
            rtl: OwlRtlValue,
            slidesToScroll: 1,
            arrows: false,
            dots: true,
            prevArrow: '<div class="prev-icon"><i class="las la-angle-left"></i></div>',
            nextArrow: '<div class="next-icon"><i class="las la-angle-right"></i></div>',
            infinite: true,
            autoplay: true,
            pauseOnHover: true,
            swipeToSlide: true,
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2,
                    }
                }
            ]
        });

        /*----------------------
            Service Details Slider
        -----------------------*/

        $('.service-details-slider').slick({
            slidesToShow: 1,
            rtl: OwlRtlValue,
            slidesToScroll: 1,
            arrows: true,
            dots: true,
            prevArrow: '<div class="prev-icon"><i class="las la-angle-left"></i></div>',
            nextArrow: '<div class="next-icon"><i class="las la-angle-right"></i></div>',
            infinite: true,
            autoplay: true,
            autoplayspeed: 1500,
            speed: 1200,
            pauseOnHover: true,
            swipeToSlide: true,
        });

        /*
        ========================================
            accordion
        ========================================
        */

        $('.faq-contents .faq-title').on('click', function(e) {
            var element = $(this).parent('.faq-item');
            if (element.hasClass('open')) {
                element.removeClass('open');
                element.find('.faq-panel').removeClass('open');
                element.find('.faq-panel').slideUp(300, "swing");
            } else {
                element.addClass('open');
                element.children('.faq-panel').slideDown(300, "swing");
                element.siblings('.faq-item').children('.faq-panel').slideUp(300, "swing");
                element.siblings('.faq-item').removeClass('open');
                element.siblings('.faq-item').find('.faq-title').removeClass('open');
                element.siblings('.faq-item').find('.faq-panel').slideUp(300, "swing");
            }
        });

       

        /* 
        ========================================
            Tab
        ========================================
        */
        $('ul.tabs li').click(function() {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('active');
            $('.another-tab-content').removeClass('active');
            // $('.tab-content').removeClass('active');

            $(this).addClass('active');
            $("#" + tab_id).addClass('active');
        });

        /* 
        ========================================
            Pagination 
        ========================================
        */
        $('.pagination-list li').on('click', function() {
            $(this).siblings().removeClass("active");
            $(this).addClass("active");
        });

        /*-----------------
            Multi step Form
        ------------------*/

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        $(".previous").click(function() {
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();
            //Remove class active
            $(".step-list li, .step-list-two li").eq($("fieldset").index(current_fs)).removeClass("active");
            //show the previous fieldset
            previous_fs.show();
            //hide the current fieldset with style
            current_fs.animate({ opacity: 0 }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({ 'opacity': opacity });
                },
                duration: 500
            });
        });
        $(".submit").click(function() {
            return false;
        })

        /*------------------
            back to top
        ------------------*/
        $(document).on('click', '.back-to-top', function() {
            $("html,body").animate({
                scrollTop: 0
            }, 1500);
        });

    });

    /*------------------
        back to top
    ------------------*/
    $(window).on('scroll', function() {
        //back to top show/hide
        var ScrollTop = $('.back-to-top');
        if ($(window).scrollTop() > 300) {
            ScrollTop.fadeIn(300);
        } else {
            ScrollTop.fadeOut(300);
        }
    });

    /*------------------
        Preloader
    ------------------*/
    $(window).on('load', function() {
        $('#preloader').delay(300).fadeOut('fast');
        $('body').delay(300).css({
            'overflow': 'visible'
        });
    });

})(jQuery);