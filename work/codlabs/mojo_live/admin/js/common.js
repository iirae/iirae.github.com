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
$( "document" ).on("load", ".e-pick_date", function(){
     $(this).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1
        });
});
$(function(){
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
    $('.form-check').on('keydown', function (e) {
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

    // 엔터키 클릭이벤트
    $("#admin_pwd").keyup(function(event) {
        if (event.keyCode === 13) {
            adminLogin();
        }
    });

    // 직접입력 선택 시 입력폼 활성화
    $('.list-reason').on('click', 'input[type*="radio"]', function(){
        var thisReason = $(this).hasClass('inPerson');
        if(thisReason === true){
            $(".type-reason").attr("readonly",false).removeClass('readonly').focus();
        } else {
            $(".type-reason").attr("readonly",true).addClass('readonly');
        }
    });
    $('.email-form').change(function(){
        $(".email-form option:selected").each(function () {
            var inputText = $(this).parents(".form-select").siblings(".form-text.domain");

            if($(this).val() === '1'){
                inputText.val('').attr("readonly",false).focus();
            } else {
                inputText.attr("readonly",true);
            }
        });
    });

    $.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        monthNamesShort: [ '1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월' ],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토']
    });

    // 날짜선택
    $( ".e-pick_date" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
    });

    //파일 첨부
    $(document).on('change','.e-file', function(e) {
        var filename;

        if(window.FileReader) {
            filename = $(this)[0].files[0].name;
        } else {
            filename = $(this).val().split('/').pop().split('\\').pop();
        }

        var $buttonFile = $(this).parents(".form-file");
        //console.log(filename);

        $buttonFile.find(".name").val(filename);

        e.preventDefault();
    });

    // 테이블을 탭처럼
    $(".table-layout.type-tab").on("click", ".e-tab", function(e){
        $(this).parent("td").siblings("td").removeClass("selected");
        $(this).parent("td").addClass("selected");
        e.preventDefault();
    });

    // 탭
    $(".e-tab").on("click", "a", function(e){
        $(this).parent("li").siblings().removeClass("selected");
        $(this).parent("li").addClass("selected");
        e.preventDefault();
    });

    $(".e-tab-section").on("click", "a", function(e){
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

    // area-toggle
    $('body').on('click', '.area-toggle > .area-title', function(){
        var _open =$(this).parent().hasClass('open');
        if(_open){
            $(this).parent().removeClass('open');
            $(this).parent().find('.content').slideUp('fast');
        } else {
            $(this).parent().addClass('open');
            $(this).parent().find('.content').slideDown('fast');
        }
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
