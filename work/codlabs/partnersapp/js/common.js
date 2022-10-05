$(function(){

    // top button action
    goTop();
    layerGoTop();

    // 전체메뉴
    $("#nav").on("click", ".trigger", function(){
        $(this).parent().toggleClass("collapsible");
        $(this).siblings("ul").slideToggle("fast");
    });

    // 전체메뉴
    $("#header").on("click", ".eOpenNav", function(){
        $(this).parent('.slideNav').find('.information').addClass("expand");
        $('body').addClass('overlay');
    });
    $("#header").on("click", ".eCloseNav", function(){
        $(this).parents('.slideNav').find('.information').removeClass("expand");
        $('body').removeClass('overlay');
    });

    $("#header").on("click", ".eHasChild > span", function(){
        $(this).parent().toggleClass("expand");
        $(this).siblings('ul').slideToggle("fast");
    });

    // cargo list nav
    var $navDiv = $("<div class='bg'></div>");

    $("#nav").on("click", ".buttonTrigger", function(){
        $(this).siblings(".list").slideToggle(50);
        $("html").toggleClass("open");
        $(this).parent().append($navDiv);
    });
    $("#nav").on("click", ".bg", function(e) {
          $("#nav .list").slideUp(50);
          e.preventDefault();
          $(this).remove();
    });

    // input focus 시 class추가
    $(".fText input").on({
        focus: function() {
            if(!$(this).context.readOnly){
                $(this).parent().addClass("focus");
            }
        }, focusout: function() {
            if(!$(this).context.readOnly){
                $(this).parent().removeClass("focus");
            }
        }, change: function() {
            if(!$(this).context.readOnly){
                checkForInput(this);
            }
        }, keyup: function() {
            if(!$(this).context.readOnly){
                checkForInput(this);
            }
        }
    });

    $(".setPrice input").on({
        focus: function() {
            if(!$(this).context.readOnly){
                $(this).parent().addClass("focus");
            }
        }, focusout: function() {
            if(!$(this).context.readOnly){
                $(this).parent().removeClass("focus");
            }
        }, change: function() {
            if(!$(this).context.readOnly){
                checkForInput(this);
            }
        }, keyup: function() {
            if(!$(this).context.readOnly){
                checkForInput(this);
            }
        }
    });

    $(".setPrice input").each(function() {
         checkForInput(this);
    });

    // 체크박스, 라디오 체크상태 판별 (최초 1회만 실행)
    $(".fChk input").each(function() {
        var $input = $(this);
        var $fChk = $input.parent(".fChk");

        if( !$input.prop("checked") ) {
            $fChk.removeClass("checked");
            $input.prop("checked", false);
        } else {
            $fChk.addClass("checked");
            $input.prop("checked", true);
        }
    });

    $(".buttonChk input").each(function() {
        var $input = $(this);
        var $fChk = $input.parent(".buttonChk");

        if( !$input.prop("checked") ) {
            $fChk.removeClass("checked");
            $input.prop("checked", false);
        } else {
            $fChk.addClass("checked");
            $input.prop("checked", true);
        }
    });

    $(".fRadio input").each(function() {
        var $input = $(this);
        var $fChk = $input.parent(".fChk");

        if( !$input.prop("checked") ) {
            $fChk.removeClass("checked");
            $input.prop("checked", false);
        } else {
            $fChk.addClass("checked");
            $input.prop("checked", true);
        }
    });

    //  라디오 동작 (이벤트 발생시 수시로 실행)
    $(".fRadio label").on("click", function() {
         var $fRadio = $(this).parent(".fRadio"),
            $input = $(this).siblings("input"),
            rdAllName = '';

         rd($fRadio, $input, rdAllName);
         return false;
    });

    // 체크박스 동작 (이벤트 발생시 수시로 실행)
    $(".fChk label").on("click", function() {
         var $fChk = $(this).parent(".fChk"),
              $input = $(this).siblings("input"),
             $checkBoxes;

         if( !$fChk.hasClass("allChk") && ( !$fChk.hasClass("eachChk") ) ) {

             ch($fChk, $input);

         } else if(( $fChk.hasClass("allChk") )) {

             $checkBoxes = $(".eachChk input");

             ch($fChk, $input);
             agreeAll($input, $checkBoxes);

         } else if(( $fChk.hasClass("eachChk") )) {
             var $allChk = $(".allChk input");
             $checkBoxes = $(".eachChk input");

             ch($fChk, $input);
             checkEach($allChk, $checkBoxes, $input);
         }
         return false;
    });

    $(".buttonChk label").on("click", function() {
         var $btnChk = $(this).parent(".buttonChk"),
              $input = $(this).siblings("input");
        ch($btnChk, $input);
        //console.log($(this).attr("for") + ": "+ $($input).prop("checked"));
         return false;
    });


    // input 숫자만 입력가능 하도록 제한
    $('.eIntOnly').keydown(function (event) {
        valKeyDown = this.value;
    });

    $('.eIntOnly').keyup(function (event) {
        valKeyUp = this.value;
        if (!new RegExp('^[0-9]*$').test(valKeyUp)) {
            $(this).val(valKeyDown);
        }
    });

    $('.eIntOnly').bind('input propertychange', function(e) {
        valKeyUp = this.value;
        if (!new RegExp('^[0-9]*$').test(valKeyUp)) {
            $(this).val(valKeyDown);
        }
    });

    // radio tab
    $(".eAddContChk label").on("click", function(){
        console.log($(this));
        var $parentWrap = $(this).parents(".certifyArea");
        $parentWrap.siblings(".certifyArea").removeClass("selected").find(".formBox").slideUp("fast");
        $parentWrap.addClass("selected");

        if($parentWrap.find("formBox")){
            $parentWrap.find(".formBox").slideDown("fast");
        }
    });

    // 이메일 선택
    $('.eSelectEmail').change(function(){
        $(".eSelectEmail option:selected").each(function () {
            var inputText = $(this).parents(".static").siblings(".inperson");

            if($(this).val() === '1'){
                inputText.slideDown("fast").find("input").focus();
            } else {
                inputText.slideUp("fast").find("input").hide();
            }
        });
    });

    // textarea 자동 높이
    $('textarea.eAutosize').on('keydown keyup', function () {
        $(this).css('height', 'auto' );
        $(this).height( this.scrollHeight );
    });

    $('.fTArea textarea').on({
        focus: function () {
            $(this).parent().addClass('focus');
        },
        focusout: function () {
            $(this).parent().removeClass('focus');
        }
    });

    // select option선택 시 input 열기
    $('.eOpenInput').change(function(){
        $(".eOpenInput option:selected").each(function () {
            var inputText = $(this).parents(".fSelect").siblings(".eInput");
            if($(this).val() === '1'){
                $(this).parents(".fSelect").addClass("inperson");
                inputText.val('').slideDown("fast").focus();
            } else {
                $(this).parents(".fSelect").removeClass("inperson");
                inputText.val($(this).text()).slideUp("fast");
            }
        });
    });

    // input clearable
    $( "#contents input, .layer input" ).on({
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

    $(".fText").each(function() {
        var $input = $(this).find("input"),
              $btnDel = $(this).find(".clear");

        if($btnDel !== null) {
            $btnDel.on("click", function(){
                $input.val("");
                $btnDel.hide();
            });

        }
    });

    //mTab
    $('.eTab').each(function(){
        var selected = $(this).find('> li.selected > a');
        if(selected.siblings('ul').length <= 0){
            $(this).removeClass('gExtend');
        }
    });
    $('body').on('click', '.eTab a', function(e){
        var _li = $(this).parent('li').addClass('selected').siblings().removeClass('selected'),
            _target = $(this).attr('href'),
            _siblings = '.' + $(_target).attr('class');
        $(_target).fadeIn(150).siblings(_siblings).fadeOut(150);
        e.preventDefault();
    });

    $('body').on('click', '.eToggle', function(e){
        var _toggleParent = $(this).parents(".mToggle");

        _toggleParent.toggleClass("open");
        _toggleParent.find(".detail").slideToggle("fast");

        if(_toggleParent.hasClass("open")){
            _toggleParent.find(".buttonToggle").text("접기");
        } else {
            _toggleParent.find(".buttonToggle").text("펼치기");
        }
        e.preventDefault();
    });



});

// btnTop
function goTop() {
    var btnTop = $("#buttonTop");
    $(window).scroll(function() {
        var scrolltop = $(window).scrollTop();

        if(scrolltop < 200){
            btnTop.fadeOut();
        }else {
            btnTop.fadeIn();
        }
    });

    $( "#buttonTop" ).on("click", function() {
         $("html, body" ).animate( { scrollTop : 0 }, 400 );
         return false;
    } );

}

function layerGoTop() {
$(".layer .content").scroll(function() {
    var scrolltop = $(this).scrollTop(),
        btnTop = $(this).siblings(".eTop");

    //btnTop.fadeIn();

    if(scrolltop === 0){
        btnTop.fadeOut();
    }else {
        btnTop.fadeIn();
    }
});
$(".eTop").on("click", function() {
    var pDiv = $(this).siblings(".content");

    pDiv.animate( { scrollTop : 0 }, 400 );
     return false;
} );
}

// 라디오버튼
function rd($fChk, $input, rdAllName) {
    rdAllName = $input.attr("name");
    var siblings = $('input:radio[name="'+ rdAllName +'"]');

    if( !$input.prop("checked") ) {
        siblings.each(function() {
            var $targetInput = $(this);
            var $targetFChk = $targetInput.parent(".fRadio");

            $targetFChk.removeClass("checked");
        });
        $fChk.addClass("checked");
        $input.prop("checked", true);
    }
}

// 체크박스
function ch($fChk, $input) {
    //console.log($input.prop('checked'));

    if($input.prop("checked")) {
        $input.prop("checked", false);
        $fChk.removeClass('checked');
    } else {
        $input.prop("checked", true);
        $fChk.addClass('checked');
    }

    return false;
}

//전체 선택
function agreeAll(allChk, chkBoxes) {
    $input = allChk.parent(".fChk");

    if(allChk.prop("checked")) {
        chkBoxes.prop("checked", true);
        chkBoxes.parent(".eachChk").addClass('checked');
    } else {
        chkBoxes.prop("checked", false);
        chkBoxes.parent(".eachChk").removeClass('checked');
    }
}
function checkEach(allChk, eachChk, targetInput) {
    var eachChkLength = 0,
        $input = targetInput;

    if(allChk.prop("checked") === true){
        allChk.prop("checked", false);
        allChk.parent(".fChk").removeClass('checked');
    } else {
        for(var i = 0; i < eachChk.length; i++){
            if($(eachChk.get(i)).prop("checked") === true){
                eachChkLength++;
            }
        }
        if(eachChk.length === eachChkLength){
            allChk.prop("checked", true);
            allChk.parent(".fChk").addClass('checked');
        }
    }
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

// input value를 가지고 있을 경우
function checkForInput(element) {
    var $label = $(element).parent();

    if ($(element).val().length > 0) {
        $label.addClass("hasValue");
    } else {
        $label.removeClass("hasValue");
    }
}
