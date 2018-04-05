$(function() {
    drawMenu(); //메뉴 가져오기

    //snb 접고 펼치기
    $('#snb').on("click", "li > a", function(){
        console.log('a');
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
    var urlPath = window.location.pathname;
    var dataUrl = "../json/menu_list.json";
    var navHtml = "";
    var snbHtml = "";

    $.getJSON(dataUrl, function(data){
        $.each(data.menu, function (index, depth1) {
            // 대메뉴는 nav에 그려라
            navHtml += "<li><a href='" + depth1.link + "'>" + depth1.title + "</a>";
            
            // 중메뉴가 있다면 snb에 그려라
            if(depth1.children !== undefined){
                snbHtml += "<ul class='depth2'>";

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
            navHtml += "</li>";
        });
        $("#nav").children("ul").html("").append(navHtml);
        $("#snb").children("ul").html("").append(snbHtml);
    });

    console.log(urlPath);
}