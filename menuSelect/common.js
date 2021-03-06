$(function() {
    drawMenu(); //메뉴 가져오기

    //snb 접고 펼치기
    $('#snb').on("click", "li > a", function(){
        var menu = $(this).parent('li');
        if ( menu.hasClass('collapsible') ){
            menu.children('ul').slideUp('fast');
            menu.removeClass('collapsible').addClass('expandable');
        } else if ( menu.hasClass('expandable') ){
            menu.children('ul').slideDown('fast');
            menu.removeClass('expandable').addClass('collapsible');
        }
    });
});

// 메뉴 가져오기
function drawMenu(e){
    var dataUrl = "../json/menu_list.json";
    var menuArr = [];
    var sortMenuArr = [];
    var topParent;

    var navHtml = "";
    var snbHtml = "";

    var urlPath = window.location.pathname;
    var path = urlPath.split("/");
    var lastPath = path[path.length - 1];

    $.getJSON(dataUrl, function(data){
        //메뉴 플랫구조로 담아두기
        $.each(data.menu, function (index, depth1) {
            sortMenuArr.push(depth1);
            menuArr.push(depth1);
            $.each(depth1.children, function (index2, depth2) {
                menuArr.push(depth2);
                $.each(depth2.children, function (index3, depth3) {
                    menuArr.push(depth3);
                });
            });
        });

        //현재 url과 매칭되는 메뉴 찾기
        $.each(menuArr, function(index, menu){
            if(menu.url === lastPath){
                var menuId =  menu.id;
                topParent = menuId.slice(0,2) + '0000';
            }
        });

        //순서 sorting 하기
        sortMenuArr.sort(function(a, b){
            return a.orderNum - b.orderNum;
        });
        $.each(sortMenuArr, function(index, depth1){
            depth1.children.sort(function(a,b){
                return a.orderNum - b.orderNum;
            });
            $.each(depth1.children, function(index, depth2){
                if(depth2.children !== undefined){
                    depth2.children.sort(function(a,b){
                        return a.orderNum - b.orderNum;
                    });
                }
            });
        });


        //현재 페이지에 해당하는 대메뉴 + 하위메뉴를 그려라
        $.each(sortMenuArr, function (index, depth1) {
            if(depth1.id === topParent){
                navHtml += "<li class='selected' data-id='" + depth1.id + "' data-order-num='" + depth1.orderNum + "'><a href='" + depth1.url + "'>" + depth1.title + "</a></li>";
                snbHtml += "<ul class='depth2'>";

                $.each(depth1.children, function (index2, depth2) {
                    // 소메뉴가 있다면 snb에 아래와 같이 그려라
                    if(depth2.children !== undefined) {
                        snbHtml += "<li class='expandable' data-order-num='" + depth2.orderNum + "'><a href='#'>" + depth2.title + "</a>";

                        snbHtml += "<ul class='depth3'>";
                        $.each(depth2.children, function(index3, depth3) {
                            snbHtml += "<li data-order-num='" + depth3.orderNum + "'><a href='" + depth3.url + "'>" + depth3.title + "</a>";
                        });
                        snbHtml += "</ul>";
                    } else {    //소메뉴가 없다면 아래와 같이 그려라
                        snbHtml += "<li data-order-num='" + depth2.orderNum + "'><a href='" + depth2.url + "'>" + depth2.title + "</a>";
                    }
                    snbHtml += "</li>";
                });
                snbHtml += "</ul>";
            } else {
                navHtml += "<li data-id='" + depth1.id + "' data-order-num='" + depth1.orderNum + "'><a href='" + depth1.url + "'>" + depth1.title + "</a></li>";
            }
        });

        $("#nav").children("ul").html("").append(navHtml);
        $("#snb").children("ul").html("").append(snbHtml);
        checkCurrentMenu()
    });
}

// 현재 페이지에 해당하는 메뉴에 selected 클래스 추가하기
function checkCurrentMenu(){
    var urlPath = window.location.pathname;
    var path = urlPath.split("/");
    var lastPath = path[path.length - 1];
    var topMenu, subMenu;

    $("#snb a").each(function () {
        var thisHref = $(this).attr('href');
        var thisMenu = $(this).parent();
        var thisParentMenu = thisMenu.parents('li');
        subMenu = $(this).parents('ul');

        if(thisHref === lastPath){
            thisMenu.addClass('selected');
            if(thisParentMenu.hasClass('expandable')){
                thisParentMenu.addClass('selected');
                thisParentMenu.removeClass('expandable').addClass('collapsible');
            }
        }
    });
}






//전체선택 클릭 이벤트
$(".allChk").on({
    click: function(e) {
        var chkBoxes = $(".eachChk input");
        var allChk = $("#chkAllAgree");
        var $fChk = $(this);
        var $input = $fChk.children("input");

        ch($fChk, $input);
        agreeAll(allChk, chkBoxes);
        return false;
    }, keydown: function (e) {
        var chkBoxes = $(".eachChk input");
        var allChk = $("#chkAllAgree");
        var $fChk = $(this);
        var $input = $fChk.children("input");

        if(window.event) {
            myKeyCode = event.keyCode;
        } else if(e.which) {
            myKeyCode = e.which;
        }

        if(myKeyCode === 32) {
            ch($fChk, $input);
            agreeAll(allChk, chkBoxes);
            return false;
        }
        return true;
    }
});

// 하위 체크박스 선택 시 확인 후 전체선택 checked
$(".eachChk").on({
    click: function(){
        var allChk = $("input#chkAllAgree");
        var eachChk = $(".eachChk input");
        var targetInput = $(this).children("input");

        checkEach(allChk, eachChk, targetInput);
        return false;
    }, keydown: function (e) {
        var allChk = $("#chkAllAgree");
        var eachChk = $(".eachChk input");
        var targetInput = $(this).children("input");

        if(window.event) {
            myKeyCode = event.keyCode;
        } else if(e.which) {
            myKeyCode = e.which;
        }

        if(myKeyCode == 32) {
            checkEach(allChk, eachChk, targetInput);
            return false;
        }
        return true;
    }
});






















