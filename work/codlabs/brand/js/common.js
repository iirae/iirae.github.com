$(function() {

    $(".eToggleSlide").on("click", ".title", function(){
        $(this).parent().toggleClass("show");
        $(this).siblings(".detail").slideToggle("fast");
    });

    $(window).scroll(function(){

        scrollEffect();

    });

    $(".fText").keyup (function () {
        var charLimit = $(this).attr("maxlength"),
            len = $(this).val().length;

        if ( (len >= charLimit-1) || (len === charLimit) ) {
            $(this).siblings(".button").addClass("abled");
            return false;
        } else {
            $(this).siblings(".button").removeClass("abled");
            return false;
        }
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

    $(".fRadio").on("click", function(e) {
         var $fRadio = $(this),
            $input = $(this).find("input"),
            rdAllName = $input.attr("name"),
            siblings = $('input:radio[name="'+ rdAllName +'"]');

        //console.log($fRadio);

        if( !$input.prop("checked") ) {
            siblings.each(function() {
                var $targetInput = $(this),
                    $targetFChk = $targetInput.parent(".fRadio");
                $targetFChk.removeClass("checked");
            });
            $fRadio.addClass("checked");
            $input.prop("checked", true);
        }

        e.preventDefault();
        e.stopPropagation();
    });

    $(".fChk").on("click", function(e) {
         var $fChk = $(this),
            $input = $("#"+$(this).attr("for"));

//console.log($input.prop("checked"));

        if($input.prop("checked")) {
            $input.prop("checked", false);
            $fChk.removeClass('checked');
        } else {
            $input.prop("checked", true);
            $fChk.addClass('checked');
        }

        e.preventDefault();
        e.stopPropagation();
    });


});

function scrollEffect() {
    var  secTop, secHeight, winScrollTop, winHeight, docHeight;

    winHeight = $(window).height();
    docHeight = $(document).height();
    winScrollTop = $(document).scrollTop();

    $(".effect").each(function(i){
        secTop = Math.round( $(this).offset().top );
        secHeight = Math.round( $(this).height() );
        if( (winScrollTop + winHeight) >= (secTop + secHeight / 4) ){
            $(this).addClass("visible moveImg");
        } else if (winScrollTop === 0) {
            $(this).removeClass("visible moveImg");
        } else if (winScrollTop + winHeight > docHeight - 100) {
            $(".effect").addClass("visible moveImg");
        } else {
            $(this).removeClass("moveImg");
        }

    });


    //tab
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
        $(_target).fadeIn(40).siblings(_siblings).fadeOut(70);
        e.preventDefault();
    });


}

// layer close
function layerClose(target) {
    var findParent = target.parents('.layer:first');

    $("body").removeClass("overlay");
    findParent.hide().css("opacity", 0);
}

//modal layer open
function layerOpen(targetLayer) {
    var findLayer = targetLayer;

    $("body").addClass("overlay");
    $(findLayer).show().css("opacity", 1);
}
