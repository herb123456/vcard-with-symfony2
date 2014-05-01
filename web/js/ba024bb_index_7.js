if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    window.is_mobile = true;
}else{
    window.is_mobile = false;
}
// for test
// window.is_mobile = true;


$(document).ready(function (){
    // stellar background effect
    $.stellar({
        horizontalScrolling: false,
        verticalOffset: 40
    });

    // nice scroll
    $("html").niceScroll();

    // smooth scroll
    $(".menu a").smoothScroll({
        speed: 800
    });
    $("#link-in-timeline").smoothScroll({
        speed: 800
    });

    // fixed nav position
    if( !window.is_mobile ){
        $("#aboutme").waypoint(function (direction){
            if( direction === "down"){
                $(".menu").css("position", "fixed");
            }else{
                $(".menu").css("position", "absolute");
            }

        },{
            offset: -$("nav").height()-50
        });
    }

    // skills bar effect
    $("#skills").waypoint(function() {
        var all_progress = $(".skill .progress-bar-outer");
        // add in effect
        $("#skills h2, .skills-col1, .skills-col2").addClass("in-effect");
        // skills bar effect
        $.each(all_progress, function (k, v){
            $(v).addClass("in-effect");
        });
    }, {
        offset: 300
    });

    // i use item effect
    $("#iuse").waypoint(function() {
        var all_items = $(".iuse-item");

        $.each(all_items, function(k, v) {
            setTimeout(function() {
                $(v).addClass("in-effect");
            }, parseInt(k) * 80);
        });
    }, {
        offset: 300
    });

    // resume effect
    $(".timeline li").waypoint(function() {
        $(this).addClass("in-effect").children(".timeline-icon").addClass("in-effect");
    },{
        offset: 500
    });

    // mini menu button event
    window.is_click_mini_menu = false;
    $(".min-button").on("click", function() {
        if( window.is_click_mini_menu ){
            $(".menu").removeClass("in-effect");
            $(".menu .min-button").removeClass("in-effect");
            $(".menu li").removeClass("in-effect");

            window.is_click_mini_menu = false;
        }else{
            $(".menu").addClass("in-effect");
            $(".menu .min-button").addClass("in-effect");
            $(".menu li").addClass("in-effect");

            window.is_click_mini_menu = true;
        }
    });

    // auto menu back
    if( window.is_mobile ){
        $(".menu li a").on("click", function() {
            $(".min-button").trigger("click");
        });
    }

    // validate the form
    $("#contact_form").validate({
        rules: {
            'contact[name]': {
                    required: true,
                    maxlength: 100
            },
            'contact[email]': {
                    required: true,
                    maxlength: 200
            },
            'contact[phone]': {
                    maxlength: 100
            },
            'contact[content]': {
                    required: true
            }
        },
        messages: {
            'contact[name]': {
                    required: "請填寫姓名或暱稱",
                    maxlength: "太長摟!"
            },
            'contact[email]': {
                    required: "請填寫電子信箱",
                    maxlength: "太長摟!"
            },
            'contact[phone]': {
                    maxlength: "太長摟!"
            },
            'contact[content]': {
                    required: "請填寫內容"
            }
        },
        submitHandler: function (form){
            form.submit();
        }
    });

});