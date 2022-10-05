$(document).ready(function(e) {
    var _body = $("body");

    _body.on("click", "#lang", function(){
        $(this).parent().find(".pop").addClass("show");
    });

    _body.on("click", function(e) {
        var _target = $(e.target);
        var _pop = _target.parent().hasClass("pop");
        var _trigger = _target.hasClass("default");


        if( !_pop && ! _trigger) {
            $("#lang").parent().find(".pop").removeClass("show");
            //console.log(_pop);
        }
    });

    var didScroll;

    var lastScrollTop = $(document).scrollTop();

    $(window).scroll(function(e){

        if (lastScrollTop > $(document).scrollTop()) {
            didScroll = false;
        } else {
            didScroll = true;
        }
        lastScrollTop =  $(document).scrollTop();

    });

    setInterval(function() {
        if (didScroll) {
            onScroll();
            scrollEffect();
            didScroll = false;
        }
    }, 50);

    _body.on("click", "#menu", function(){
        $(this).parent().toggleClass("show");
    });

    $('.nav li').on('click', 'a', function(e){
        didScroll = false;
        if (this.hash !== "") {
            e.preventDefault();

            var hash = this.hash;
            var sectionTop;

            var winWidth =  $(document).width();

            if( winWidth >= 1150 ){
                sectionTop = $(hash).offset().top - 61;
            } else {
                sectionTop = $(hash).offset().top - 54;
            }

            $('html, body').animate({
                scrollTop: sectionTop
            }, 500, function(){});
        }
        $('.nav').removeClass('show');
        /*
        $('.nav li').each(function () {
            $(this).removeClass('this');
        });
        $(this).parent('li').addClass('this');*/

    });

    var timer;
    $(document).on("scroll", function(){
        clearTimeout(timer);
        timer = setTimeout( onScroll , 50 );
    });
});

function onScroll(event){
    var scrollPos = $(document).scrollTop();

    $('.nav ul a').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        var winWidth =  $(document).width();

        if( winWidth >= 1150 ){
            scrollPos = (scrollPos + 61);
        } else {
            scrollPos = (scrollPos + 54);
        }

        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('.nav li').removeClass("this");
            currLink.parent().addClass("this");
        } else {
            currLink.parent().removeClass("this");
        }
    });
}

function scrollEffect() {
    var sectionTop, sectionHeight, scrollTop, section;
    var arrSectionTop = [];
    var arrSectionHeight = [];
    var sectionList = [];

    scrollTop = $(document).scrollTop();

    $(".section").each(function(i) {
        sectionTop = Math.round($(this).offset().top);
        sectionHeight = Math.round($(this).height());
        section = $(this);

        arrSectionTop[i] = sectionTop;
        arrSectionHeight[i] = sectionHeight;
        sectionList[i] = section;
    });

    for(var i = 0; i < arrSectionHeight.length; i++) {

        if(scrollTop >= arrSectionTop[i]-500) {
            $(sectionList[i]).addClass('animated');
        }

        if(scrollTop >= 155 && scrollTop < 325) {
            //scrollAnimate(arrSectionTop[i]);
          break;
        } else if( scrollTop >= (arrSectionTop[i] - 155) && scrollTop < (arrSectionTop[i] - 61) ) {
            //scrollAnimate(arrSectionTop[i]);
          break;
        }
    }

}

function scrollAnimate (section) {
    $("html,body").animate({
        scrollTop:(section - 61)
    },function(){  });
}
















