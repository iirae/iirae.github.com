$(function() {
    var _body = $("body");

    // pinch zoom 끄기
    /*document.documentElement.addEventListener('touchmove', function (event) {
        event.preventDefault();
    }, false);*/

    _body.on("click", ".e-tab a", function(e){
        var _li = $(this).parent('li').addClass('selected').siblings().removeClass('selected'),
            _target = $(this).attr('href'),
            _siblings = $(_target).attr('class');
        if(_siblings){
            var _arr = _siblings.split(" "),
                _classSiblings = '.'+_arr[0];
            $(_target).show().siblings(_classSiblings).hide();
        }
        e.preventDefault();
    });

    // textarea 자동 높이
    $('textarea.e-autosize').on({
        keyup: function () {
            var h = this.scrollHeight;

            textareaAutoH($(this), h);
        }, focusout: function () {
            var _self = this,
                selfHeight = this.scrollHeight;

            setTimeout(function(){
                $(_self).css('height', '80px');
                $(_self).scrollTop(selfHeight);
            }, 100);

        }, focusin: function () {
            if( $(this).val().length !== 0 ) {
                var h = this.scrollHeight;

                textareaAutoH($(this), h);
                $(this).scrollTop(h);
                //console.log($(this).scrollTop());
            }
        }
    });

    $(".form-text").each(function() {
        var $input = $(this).find("input"),
              $btnDel = $(this).find(".clear");

        if($btnDel !== null) {
            $btnDel.on("click", function(){
                $input.val("");
                $btnDel.hide();
            });

        }
    });

    // textarea count
    _body.on('keyup', '.form-textarea textarea', function () {
        var charLimit = $(this).attr("maxlength"),
            len = $(this).val().length,
            _count = $(this).parents('.area-input').find('.count .now');

        _count.text(len);
        return false;
    });

    // input clearable
    $( "#wrap .form-text input" ).on({
        focus:  function() {
            var elem = $(this).siblings(".clear");

            if($(this).val().length !== 0) {
                elem.show();
            }

            $(this).keyup(function() {
                if($(this).val().length !== 0) {
                    elem.show();
                }
            });
        },
        blur: function() {
            var elem = $(this).siblings(".clear");
            setTimeout(function() {
                elem.hide();
            }, 0);
        }
    });

    _body.on('click', '.e-tab a', function(e){
        var _target = $(this).attr('href'),
            _siblings = '.' + $(_target).attr('class');

        $(this).parent('li').addClass('selected').siblings().removeClass('selected');
        $(_target).show().siblings(_siblings).hide();
        e.preventDefault();
    });

    // 첨부 사진 이미지 사이즈 조절
    attachImgSize();

    $( window ).resize(function() {
        attachImgSize();
    });

    //레이어 주변 클릭 시 레이어 닫기
    /*_body.on("click", '.layer', function(e) {
        var _layer = $(".layer");

        if( _layer.css("opacity") === "1" && !(_layer.hasClass("only")) ) {
            if( !_layer.find(".inner").has(e.target).length ) {
                layer_close(_layer.find(".content"));
            }
        }
    });*/

}); //document.ready

var didScroll,
    isScrolling;

// scroll event
$(window).scroll(function(event){
    didScroll = true;

    var d = document.documentElement,
        offset = d.scrollTop + window.innerHeight,
        height = d.offsetHeight,
        _button = $('.eBtnWrite'),
        _buttonWrite = $('.eEvaluate'),
        _buttonWriteFix = $('.eEvaluateFix');

    clearTimeout($.data(this, 'scrollTimer'));

    _button.css('opacity', '0');

    $.data(this, 'scrollTimer', setTimeout(function() {
        //글쓰기 버튼
        _button.css('opacity', '1');

    }, 250));

    //평가하기 버튼 위치 조절
    if ( window.scrollY  >= 70 ) {
        _buttonWrite.css('opacity', '1');
    } else {
        _buttonWrite.css('opacity', '0');
    }

    $.data(this, 'scrollTimer', setTimeout(function() {

        _buttonWrite.css('opacity', '1');
        if( window.scrollY >= 80 ) {
            _buttonWrite.addClass('posFixed');
        } else {
            _buttonWrite.removeClass('posFixed');
        }

    }, 50));

});  // window scroll

$(window).resize(function(){
    //visualHeight();
}).resize(); // 브라우저 리사이징


// input value를 가지고 있을 경우
function checkForInput(element) {
    var $label = $(element).parent();

    if ($(element).val().length > 0) {
        $label.addClass("hasValue");
    } else {
        $label.removeClass("hasValue");
    }
}

//글쓰기 사진 첨부 미리보기 사이즈 체크
function attachImgSize() {
    var winWidth = $(window).width(),
        _body = $("body");
    if(winWidth <= 414) {
        if( _body.hasClass('pWrite') || _body.hasClass('pReputWrite') ){
            var imgWidth = $(".eImgSize li .btnAdd").outerWidth(true);
            $(".eImgSize li").each(function(){
                $(this).css('height', imgWidth);
            });

        }
    }
}

//textarea height control
function textareaAutoH(el, h) {
    el.css('height', 'auto');
    el.height(h);
}


// layer close
function layer_close(target) {
    var findParent = target.parents('.layer:first');

    $("body").removeClass("overlay");
    findParent.hide().css("opacity", 0);
}

//modal layer open
function modalLayerOpen(targetLayer) {
    var findLayer = targetLayer;

    $("body").addClass("overlay");
    $(findLayer).show().css("opacity", 1);
}

// vertical 슬라이딩
function verticalSlide(slideItem, sec) {
    var addn = 0;
    var arr = [];
    var interval = null;
    var itemHeight = slideItem.height() + 10;
    var items = slideItem.find(".item");
    var len = items.length;
    noticeSlide();

    function noticeSlide(){
        for(var i=0; i<len; i++){
            this["target"+i] = items.get(i);
            arr.push(this["target"+i]);
        }
        intervalStart();
    }
    function intervalStart(){
        interval = setInterval(function() {noticeRolling();}, sec);
    }
    function noticeRolling(){
        if(interval){
            clearInterval(interval);
            intervalStart();
        }

        if(addn >= (len-1)){
            addn = -1;
        }
        addn++;

        items.animate(
            {"top":"-=" + (itemHeight - 5) + "px"},
            { duration: 250,
                specialEasing: { width: "linear", height: "easeOutBounce" },
                complete : function() {
                    initcul(itemHeight, "click");
                }
            }
        );
    }
    function initcul(num, str){
        var pn = 0;
        for(var i=0; i<len; i++){
            if(str === "click"){
                var cul = (addn*-itemHeight)-itemHeight;
                if(addn <= i){
                    pn = cul;
                }else{
                    pn = (len*itemHeight)-((addn*itemHeight)+itemHeight);
                }
            }
            $(arr[i]).stop(true,true).css("top",(pn+num));
        }
    }
}

// 특정 영역 포커스
function twingkle(el, target) {
    $('html, body').animate({
        scrollTop: $(el).offset().top - 100
    }, 500, function(){});

    $(target).addClass('this');

    setTimeout(function() {
        $(target).removeClass('this');
    }, 3000);
}
