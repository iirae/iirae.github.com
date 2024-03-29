//for upper jquery version 1.9($.browser method has been removed as of jQuery 1.9.)
jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();

$(function(){
    var _body =  $("body");

    //snb 접고 펼치기
    $('li > a').click("#snb", function(){
        var menu = $(this).parent('li');
        if ( menu.hasClass('collapsible') ){
            menu.children('ul').slideUp('fast');
            menu.removeClass('collapsible').addClass('expandable');
        } else if ( menu.hasClass('expandable') ){
            menu.children('ul').slideDown('fast');
            menu.removeClass('expandable').addClass('collapsible');
        }
    });

    //키보드 체크
    $('.fChk').on('keydown', function (e) {
        if (window.event) {
            myKeyCode = event.keyCode;
        } else if (e.which) {
            myKeyCode = e.which;
        }

        if (myKeyCode === 32) {
            var checked = !$(this).children('input').prop('checked');
            $(this).children('input').prop('checked', checked);
            return false;
        }
        return true;
    });

    $(_body).on("click", ".allChk input[type=checkbox]", function(){
        var chkBoxes = $(this).parents(".chkWrap").find(".eachChk input[type=checkbox]");
        if($(this).prop("checked")) {
            chkBoxes.prop("checked",true);
        } else {
            chkBoxes.prop("checked", false);
        }
    });
    $(_body).on("click", ".eachChk input[type=checkbox]", function(){
        var chkParent = $(this).parents(".chkWrap");
        var allChk = chkParent.find(".allChk input[type=checkbox]");
        var eachChk = chkParent.find(".eachChk input[type=checkbox]");
        var eachChkLength = 0;

        if(allChk.prop("checked") === true){
            allChk.prop("checked", false);
        } else {
            for(var i = 0; i < eachChk.length; i++){
                if($(eachChk.get(i)).prop("checked") === true){
                    eachChkLength++;
                } else {
                    eachChkLength--;
                }
            }
            if(eachChk.length === eachChkLength){
                allChk.prop("checked", true);
            }
        }
    });

    // 로그인 버튼 엔터키 누를 시 클릭이벤트
    $("#btnLogin").keyup(function(event) {
        if (event.keyCode === 13) {
            $("#btnLogin").click();
        }
    });

    // 직접입력 선택 시 입력폼 활성화
    $('.reasonList').on('click', 'input[type*="radio"]', function(){
        var thisReason = $(this).hasClass('inPerson');
        if(thisReason === true){
            $(".typeReason").attr("readonly",false).removeClass('readonly').focus();
        } else {
            $(".typeReason").attr("readonly",true).addClass('readonly');
        }
    });
    $('.eEmailForm').change(function(){
        $(".eEmailForm option:selected").each(function () {
            var inputText = $(this).parents(".fSelect").siblings(".fText.domain");

            if($(this).val() === '1'){
                inputText.val('').attr("readonly",false).focus();
            } else {
                inputText.attr("readonly",true);
            }
        });
    });

    //날짜 선택
    $( ".ePickDate" ).datepicker({
        dateFormat: "yy-mm-dd"
    });

    //파일 첨부
    $(document).on('change','.eFile', function(e) {
        var filename;

        if(window.FileReader) {
            filename = $(this)[0].files[0].name;
        } else {
            filename = $(this).val().split('/').pop().split('\\').pop();
        }

        var $buttonFile = $(this).parents(".fFile");
        //console.log(filename);

        $buttonFile.children(".name").val(filename);

        e.preventDefault();
    });

    // 테이블을 탭처럼
    $(".tableLayout.typeTab").on("click", ".eTab", function(e){
        $(this).parent("td").siblings("td").removeClass("selected");
        $(this).parent("td").addClass("selected");
        e.preventDefault();
    });

    // 탭
    $(".eTab").on("click", "a", function(e){
        $(this).parent("li").siblings().removeClass("selected");
        $(this).parent("li").addClass("selected");
        e.preventDefault();
    });

    $(".eTabSection").on("click", "a", function(e){
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

});

//날짜 선택
function getDate( element ) {
    var date;
    try {
        date = $.datepicker.parseDate( dateFormat, element.value );
    } catch( error ) {
        date = null;
    }

    return date;
}

// layer close
function mLayer_close(target) {
    var findParent = target.parents('.layer:first');
    var findDimmed = $('#dimmed_' + findParent.attr('id'));
    findParent.hide();
    findDimmed.remove();
}

//layer open
function layerOpen(targetLayer, currentButton) {
    var findLayer = targetLayer,
        propBtnTopPosition = currentButton.offset().top,
        propBtnLeftPosition = currentButton.offset().left;

    findLayer.css({ 'left': propBtnLeftPosition, 'top': propBtnTopPosition+20 });

    $(targetLayer).show();
}

//modal layer open
function modalLayerOpen(targetLayer, currentButton) {
    var findLayer = targetLayer;

    if($('.dimmed').length >= 1 ){
        $('.dimmed').addClass('hide');
        var propZIndex = 510 + $('.dimmed').length;
        $(targetLayer).css({'zIndex':propZIndex+5});
        $(targetLayer).parent().append('<div id="dimmed_' + $(targetLayer).attr('id') + '" class="dimmed"></div>');
        $('#dimmed_'+ targetLayer.attr('id')).css({ 'zIndex' : propZIndex }).removeClass('hide');
    } else {
        $(targetLayer).parent().append('<div id="dimmed_' + $(targetLayer).attr('id') + '" class="dimmed"></div>');
    }

    $(targetLayer).show();
}