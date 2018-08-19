// -----------------------------

//   js index
/* =================== */
/*  
    -preloader
    -sticky
    -scroll-up
    -jQuery MeanMenu
    -meanmenu 
    -countdown
    -slider
    -waypoint js active
    -scroll Reval
    -Testimonial Area show 
    -new-pro-carousel
    -featured-pro-carousel
    -related-pro-carousel
    -brand-carousel
    -price-slider
    -cart-plus-minus-button 
    -Ajax Contact Form
*/
// -----------------------------


(function($) {
    "use strict";


    /*---------------------
    preloader
    --------------------- */

    $(window).on('load', function() {
        $('#preloader').fadeOut('slow', function() { $(this).remove(); });
    });

    /*-----------------
    sticky
    -----------------*/
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 170) {
            $('.menus').addClass('navbar-fixed-top');
        } else {
            $('.menus').removeClass('navbar-fixed-top');
        }
    });

    /*-----------------
    scroll-up
    -----------------*/
    $.scrollUp({
        scrollText: '<i class="fa fa-arrow-up" aria-hidden="true"></i>',
        easingType: 'linear',
        scrollSpeed: 1500,
        animation: 'fade'
    });

    /*----------------------------
     jQuery MeanMenu
    ------------------------------ */
    $('nav#dropdown').meanmenu();

    /*-----------------
    meanmenu 
    -----------------*/
    $('nav#mobile_menu_active').meanmenu({
        meanScreenWidth: "991",
        meanMenuContainer: '.mobile-menu-area .container',
    });

    /*---------------------
    countdown
    --------------------- */
    $('[data-countdown]').each(function() {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('<span class="cdown days"><span class="time-count">%-D</span> <p>Days</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>Hour</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>Min</p></span> <span class="cdown second"> <span><span class="time-count">%S</span> <p>Sec</p></span>'));
        });
    });


    /*----------------------------
        slider
    ------------------------------ */
    $('#mainslider').nivoSlider({
        effect: 'random',
        slices: 15,
        boxCols: 12,
        boxRows: 4,
        animSpeed: 600,
        pauseTime: 5000,
        startSlide: 0,
        controlNav: true,
        controlNavThumbs: false,
        pauseOnHover: false,
        manualAdvance: false,
        prevText: '<i class="fa fa-arrow-left nivo-prev-icon"></i>',
        nextText: '<i class="fa fa-arrow-right nivo-next-icon"></i>'

    });

    /*----------------------------
     waypoint js active
    ------------------------------ */
    $('#waypoint').waypoint(function() {
        $(this).toggleClass('animated');
    }, { offset: 'bottom-in-view' });


    /*----------------------------------
     scroll Reval
    ------------------------------------*/
    window.sr = ScrollReveal({ duration: 800 });
    sr.reveal('.foo');
    sr.reveal('.bar');

    /*----------------------------------
        Testimonial Area show 
    ------------------------------------*/
    $(".testimonial-carousel").owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items: 1,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 1],
        itemsTablet: [768, 1],
        controlNav: true,
    });

    /*------------------------------
     new-pro-carousel
    ------------------------------ */
    $(".new-pro-carousel").owlCarousel({
        autoPlay: false,
        slideSpeed: 2000,
        pagination: false,
        navigation: true,
        items: 4,
        /* transitionStyle : "fade", */
        /* [This code for animation ] */
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [980, 3],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],
    });

    /*------------------------------
     featured-pro-carousel
    ------------------------------ */
    $(".featured-pro-carousel").owlCarousel({
        autoPlay: false,
        slideSpeed: 2000,
        pagination: false,
        navigation: true,
        items: 4,
        /* transitionStyle : "fade", */
        /* [This code for animation ] */
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [980, 3],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],
    });

    /*------------------------------
     related-pro-carousel
    ------------------------------ */
    $(".related-pro-carousel").owlCarousel({
        autoPlay: false,
        slideSpeed: 2000,
        pagination: false,
        navigation: true,
        items: 4,
        /* transitionStyle : "fade", */
        /* [This code for animation ] */
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [980, 3],
        itemsTablet: [768, 2],
        itemsMobile: [479, 1],
    });

    /*------------------------------
    brand-carousel
    ------------------------------ */
    $(".brand-carousel").owlCarousel({
        autoPlay: false,
        slideSpeed: 2000,
        pagination: false,
        navigation: true,
        items: 6,
        /* transitionStyle : "fade", */
        /* [This code for animation ] */
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        itemsDesktop: [1199, 6],
        itemsDesktopSmall: [980, 5],
        itemsTablet: [768, 3],
        itemsMobile: [479, 1],
    });


    /*----------------------------------
        price-slider
    ------------------------------------*/
    $(function() {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 500,
            values: [75, 300],
            slide: function(event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            }
        });
        $("#amount").val("$" + $("#slider-range").slider("values", 0) +
            " - $" + $("#slider-range").slider("values", 1));
    });

    /*-----------------------
    cart-plus-minus-button 
    -------------------------*/
    $(".cart-plus-minus").append('<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>');
    $(".qtybutton").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);
    });

    /*---------------------
    // Ajax Contact Form
    --------------------- */

    $('.cf-msg').hide();
    $('form#cf button#submit').on('click', function() {
        var fname = $('#fname').val();
        var subject = $('#subject').val();
        var email = $('#email').val();
        var msg = $('#msg').val();
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!regex.test(email)) {
            alert('Please enter valid email');
            return false;
        }

        fname = $.trim(fname);
        subject = $.trim(subject);
        email = $.trim(email);
        msg = $.trim(msg);

        if (fname != '' && email != '' && msg != '') {
            var values = "fname=" + fname + "&subject=" + subject + "&email=" + email + " &msg=" + msg;
            $.ajax({
                type: "POST",
                url: "mail.php",
                data: values,
                success: function() {
                    $('#fname').val('');
                    $('#subject').val('');
                    $('#email').val('');
                    $('#msg').val('');

                    $('.cf-msg').fadeIn().html('<div class="alert alert-success"><strong>Success!</strong> Email has been sent successfully.</div>');
                    setTimeout(function() {
                        $('.cf-msg').fadeOut('slow');
                    }, 4000);
                }
            });
        } else {
            $('.cf-msg').fadeIn().html('<div class="alert alert-danger"><strong>Warning!</strong> Please fillup the informations correctly.</div>')
        }
        return false;
    });

}(jQuery));
