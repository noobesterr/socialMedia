$(document).ready(function() {
    "use strict";

    function handlePreloader() {
        if ($('.preloader').length > 0) {
            $('.preloader').delay(200).fadeOut(500);
        }
    }

    function PageLoad() {
      $( window ).on( "load", function() {
            setInterval(function(){ 
                $('.preloader-wrap').fadeOut(300);
            }, 400);
            setInterval(function(){ 
                $('body').addClass('loaded');
            }, 600); 
      });
    }


    handlePreloader();
    PageLoad();

    

    $('.dropdown-menu-icon').on('click', function() {
        $('.dropdown-menu-settings').toggleClass('active');
    });

    $(window).scroll(function(){
        if ($(this).scrollTop() > 10) {
           $('.scroll-header').addClass('bg-white shadow-xss');
        } else {
           $('.scroll-header').removeClass('bg-white shadow-xss');
        }
    });

    $(window).scroll(function(){
        if ($(this).scrollTop() > 10) {
           $('.middle-sidebar-header').addClass('scroll');
        } else {
           $('.middle-sidebar-header').removeClass('scroll');
        }
    });

    $('[data-toggle="tab"]').click(function (){
        $('.tab-pane').removeClass('active show');
        $('[data-toggle="tab"]').removeClass('active');
        $(this).addClass('active');
        $($(this).attr('href')).addClass('active show');
    });
});

