$(function() {

    'use strict';

    const $window = window.$window || $(window);
    const $body = $('body');
    const userAgent = window.navigator.userAgent.toLowerCase();

const browser = isBrowserCheck();

    let all = $('.section-terms_agree');
    $('.all-check').on('click' , function () {
        if (this.checked) {
            $(':checkbox').prop('checked', true);
            $('.btn-primary').removeClass('disabled');
        }else {
            $(':checkbox').prop('checked', false);
            $('.btn-primary').addClass('disabled');
        }
    });

    $(':checkbox:not(:first)', all).on('click', function(){
        let allCnt = $(":checkbox:not(:first)", all).length;
        let checkedCnt = $(":checkbox:not(:first)", all).filter(":checked").length;
        let requiredCheck = $(":checkbox:not(:first)", all).filter(":visible[required]");
        let  count = 0;

        $.each(requiredCheck, function(index, checkbox) {
            let checked = $(checkbox).prop('checked');
            count = checked ? count+= 1 : count;

            if (requiredCheck.length === count) {
            $('.btn-primary').removeClass('disabled');
            } else {
            $('.btn-primary').addClass('disabled');
            }
        });

        if(allCnt === checkedCnt) {
            $(':checkbox:first', all).prop('checked', true);
        }
        else{
            $(':checkbox:first', all).prop('checked', false);
        }

    });

    // layer
    let scrollTop;
    
    $body.on('click', '.e-layer', function (e) {
        e.preventDefault();
        let targetLayer = $($(e.currentTarget).attr("href"));
            scrollTop = window.pageYOffset;
        
        $body.addClass("overlay indicator");

        setTimeout(function(){
            $body.removeClass('indicator');
        }, 200);

        if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i)) {
            // alert('ios safari!');
            $window.scrollTop(0);
         }
        $(targetLayer).fadeIn();

    });

    $body.on('click', '.layer .e-close, .layer .dimmed', function (e) {
        e.preventDefault();
        let findParent = $(this).parents('.layer');

        $body.removeClass("overlay");

        if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i)) {
            $window.scrollTop(scrollTop);
         }
        findParent.fadeOut();
    });

});

function isBrowserCheck(){ 
	const agt = navigator.userAgent.toLowerCase(); 
	if (agt.indexOf("msie") != -1) { 
    	let rv = -1; 
		if (navigator.appName == 'Microsoft Internet Explorer') { 
            let ua = navigator.userAgent; 
            let re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})"); 
		if (re.exec(ua) != null) 
			rv = parseFloat(RegExp.$1); 
		} 
		return 'Internet Explorer '+rv; 
	} 
}
