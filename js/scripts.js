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

    $('.delete-post').on('click', function() {
        let post = $(this).closest('.card');
        $.ajax({
            url : "ajax_functions.php",
            method : 'POST',
            dataType : 'JSON',
            data: {
                id: $(this).data('id'),
                action:"delete_post"
            },
            success:function (data){
                if (!data.error){
                    post.remove();
                    Swal.fire({
                        title : data.message,
                        icon: 'success'
                    })
                }else{
                    Swal.fire({
                        title : data.message,
                        icon: 'error'
                    })
                }
            }
        })
    });

    $('.report-post').on('click', function() {
        let post = $(this).closest('.card');
        $.ajax({
            url : "ajax_functions.php",
            method : 'POST',
            dataType : 'JSON',
            data: {
                id: $(this).data('id'),
                action:"report_post"
            },
            success:function (data){
                if (!data.error){
                    Swal.fire({
                        title : data.message,
                        icon: 'success'
                    })
                }else{
                    Swal.fire({
                        title : data.message,
                        icon: 'error'
                    })
                }
            }
        })
    });

    $('.react-post').on('click', function() {
        let button = $(this);
        let post = $(this).closest('.card');
        $.ajax({
            url : "ajax_functions.php",
            method : 'POST',
            dataType : 'JSON',
            data: {
                id: $(this).data('id'),
                reaction: $(this).data('reaction'),
                action: "react_post"
            },
            success:function (data){
                if (!data.error){
                    let dislike_count= parseInt(post.find('.dislike_count').text());
                    let like_count= parseInt(post.find('.like_count').text());
                    if (button.data('reaction') === "dislike"){
                        post.find('[data-reaction="dislike"] i').addClass("text-white bg-red-gradiant");
                        if (post.find('[data-reaction="like"] i').hasClass("bg-primary-gradiant")){
                            post.find('[data-reaction="like"] i').removeClass("text-white bg-primary-gradiant");
                            post.find('.like_count').text(like_count-1);
                        }
                        post.find('.dislike_count').text(dislike_count+1);
                    }else{
                        post.find('[data-reaction="like"] i').addClass("text-white bg-primary-gradiant");
                        if (post.find('[data-reaction="dislike"] i').hasClass("bg-red-gradiant")) {
                            post.find('.dislike_count').text(dislike_count-1);
                            post.find('[data-reaction="dislike"] i').removeClass("text-white bg-red-gradiant");
                        }
                        post.find('.like_count').text(like_count+1);
                    }
                }else{
                    Swal.fire({
                        title : data.message,
                        icon: 'error'
                    })
                }
            }
        })
    });
    $('[data-toggle="tab"]').click(function (){
        $('.tab-pane').removeClass('active show');
        $('[data-toggle="tab"]').removeClass('active');
        $(this).addClass('active');
        $($(this).attr('href')).addClass('active show');
    });
});

