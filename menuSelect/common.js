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
    var topParent;

    var navHtml = "";
    var snbHtml = "";

    var urlPath = window.location.pathname;
    var path = urlPath.split("/");
    var lastPath = path[path.length - 1];

    $.getJSON(dataUrl, function(data){
        //메뉴 플랫구조로 담아두기
        $.each(data.menu, function (index, depth1) {
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

        //메뉴 플랫구조로 담아두기
        $.each(data.menu, function (index, depth1) {
            if(depth1.id === topParent){
                console.log(depth1.id);
                snbHtml += "<ul class='depth2' data-parent-id='" + depth1.id +"'>";

                $.each(depth1.children, function (index2, depth2) {
                    // 소메뉴가 있다면 snb에 아래와 같이 그려라
                    if(depth2.children !== undefined) {
                        snbHtml += "<li class='expandable'><a href='#'>" + depth2.title + "</a>";

                        snbHtml += "<ul class='depth3'>";
                        $.each(depth2.children, function(index3, depth3) {
                            snbHtml += "<li><a href='" + depth3.link + "'>" + depth3.title + "</a>";
                        });
                        snbHtml += "</ul>";
                    } else {    //소메뉴가 없다면 아래와 같이 그려라
                        snbHtml += "<li><a href='" + depth2.link + "'>" + depth2.title + "</a>";
                    }
                    snbHtml += "</li>";
                });
                snbHtml += "</ul>";
            }
        });
    });
    //$("#nav").children("ul").html("").append(navHtml);
    $("#snb").children("ul").html("").append(snbHtml);

    /*menuArr.filter(function(item){
        return item.url === lastPath;
        console.log('1');
    });*/

    //GNB그리기
    /*$.getJSON(dataUrl, function(data){
                $.each(data.menu, function (index, depth1) {
                    // 대메뉴는 nav에 그려라
                    navHtml += "<li data-id='" + depth1.id + "'><a href='" + depth1.link + "'>" + depth1.title + "</a>";

                    // 중메뉴가 있다면 nav에 그려라
                    if(depth1.children !== undefined){
                        navHtml += "<ul class='depth2'>";

                        $.each(depth1.children, function (index2, depth2) {
                            navHtml += "<li><a href='" + depth2.link + "'>" + depth2.title + "</a></li>";
                        });

                        navHtml += "</ul>";
                    }
                    navHtml += "</li>";
                });

                //SNB그리기
                $.each(data.menu, function (index, depth1) {
                    if(depth1.children !== undefined){
                        snbHtml += "<ul class='depth2' data-parent-id='" + depth1.id +"' style='display:none;'>";

                        $.each(depth1.children, function (index2, depth2) {
                            // 소메뉴가 있다면 snb에 아래와 같이 그려라
                            if(depth2.children !== undefined) {
                                snbHtml += "<li class='expandable'><a href='#'>" + depth2.title + "</a>";

                                snbHtml += "<ul class='depth3'>";
                                $.each(depth2.children, function(index3, depth3) {
                                    snbHtml += "<li><a href='" + depth3.link + "'>" + depth3.title + "</a>";
                                });
                                snbHtml += "</ul>";
                            } else {    //소메뉴가 없다면 아래와 같이 그려라
                                snbHtml += "<li><a href='" + depth2.link + "'>" + depth2.title + "</a>";
                            }
                            snbHtml += "</li>";
                        });
                        snbHtml += "</ul>";
                    }
                });

        $("#nav").children("ul").html("").append(navHtml);
        $("#snb").children("ul").html("").append(snbHtml);
        checkCurrentMenu();
        findSubMenu();
    });*/
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

    $("#nav a").each(function () {
        var thisHref = $(this).attr('href');

        if(thisHref === lastPath){
            topMenu = $(this).parents('li');
            topMenu.addClass('selected');
            return false;
            console.log(topMenu);
        }
    });


    /*if(topMenu.data('id') === subMenu.data('parent-id')){
        topMenu.addClass('selected');
    }*/
}

//대메뉴에 해당하는 중메뉴 뿌려주기
function findSubMenu(){
    var thisSub, thisSubUl, thisId;

    $("#nav li").each(function () {
        if($(this).hasClass('selected')){
            thisId = $(this).data('id');
        }
    });

    $("#snb li").each(function () {
        thisSub = $(this).hasClass('selected');
        if(thisSub){
            thisSubUl = $(this).parent('ul').data('parent-id');

            if(thisId === thisSubUl){
                $(this).parents('.depth2').show();
                return false;
            }
        }
    });
}






























