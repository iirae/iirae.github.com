<?php

    switch ($_SERVER[PHP_SELF]) {
        case ("/drivers.html") : // 차주
            $sDivClass = "pDriver";
            $sPageTitle = " 차주";
        break;

        case ("/partners.html") : // 화주
            $sDivClass = "pPartners";
            $sPageTitle = " 화주";
        break;

        case ("/use.html") : // 이용안내
            $sDivClass = "pUse";
            $sPageTitle = " 이용안내";
        break;

        case ("/drivers_faq.html") : // 차주faq -- faq는 같이 씀
            $sDivClass = "pFaq";
            $sPageTitle = " 차주 FAQ";
        break;

        case ("/partners_faq.html") : // 화주faq
            $sDivClass = "pFaq";
            $sPageTitle = " 화주 FAQ";
        break;

        case ("/privacy_policy.html") : // 개인정보처리방침
            $sDivClass = "pPolicy";
            $sPageTitle = " 개인정보처리방침";
        break;

        case ("/drivers_policy.html") : // 차주이용약관
            $sDivClass = "pPolicy";
            $sPageTitle = " 차주 이용약관";
        break;

        case ("/partners_policy.html") : // 화주이용약관
            $sDivClass = "pPolicy";
            $sPageTitle = " 화주 이용약관";
        break;

        default :
            $sDivClass = "pIntro";
            $sPageTitle = "";
        break;

    }
?><!DOCTYPE html>
<!-- [if lte 8]><html lang="ko" class="ieLow"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="ko"><!--<![endif]-->
<head>
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="./images/favicon_48.ico">
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="빠른 운송! 빠른 배차! 바로트럭 입니다">
    <meta name="keywords" content="바로트럭,전국화물,24시콜,24시콜화물,화물운송,운송사,주선사,화물맨,원콜,차주앱,화주,운송,물류,화물,용달,화물차운임,운임정산,운송료,화물운송료,화물운임,퀵서비스,물류회사,스타트업,물류관리업무,물류관리,1톤,1.4톤,5톤,11톤,카고,윙바디,전국화물운송,전국화물,경기도화물,서울화물,서울용달,바닥차,지입차,물류창고,물류배송,한국물류, 물류신문,qkfhxmfjr,바로,바로바로,baro,barotruck,truck,로지스,로지스틱스,바로로지스틱스,씨오디랩스,codlabs,씨오디,정산,화물정산,화물운송실적신고,운송실적신고,물류이알피,물류erp">
    <meta name="robots" content="index,follow">
    <meta property="og:title" content="바로트럭">
    <meta property="og:url" content="http://barotruck.com/">
    <meta property="og:image" content="http://barotruck.com/images/img_forKakao.jpg">
    <meta property="og:description" content="빠른 운송! 빠른 배차! 바로트럭 입니다">
    <meta name="referrer" content="always">
    <meta name="naver-site-verification" content="ba9686cc431b93f9b9733d94dbbd3f754c5c11dc"/>
    <meta name="google-site-verification" content="nDRKoO8FNxD3Tqvxa9n0ZxXH3avdFnp0W-t03RSSIEw" />
    <link rel="canonical" href="http://barotruck.com/">
    <link rel="stylesheet" href="./css/fonts.css" type="text/css">
    <link rel="stylesheet" href="./css/reset.css" type="text/css">
    <link rel="stylesheet" href="./css/common.css" type="text/css">
    <script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./js/common.js"></script>
    <title>바로트럭<?=$sPageTitle?></title>

    <!-- naver Analytics -->
    <script type="text/javascript" src="https://wcs.naver.net/wcslog.js"></script>
    <script type="text/javascript">
        if(!wcs_add) var wcs_add = {};
        wcs_add["wa"] = "bb6e843a720ac0";
        wcs_do();
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-59343644-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-59343644-2');
    </script>
</head>
<body class="<?=$sDivClass?>">
    <div class='wrap' id='wrap'>
<?php
    if ($_SERVER[PHP_SELF] == "$gDriversPageURL" || $_SERVER[PHP_SELF] == "$gPartnersPageURL" || $_SERVER[PHP_SELF] == "$gUsePageURL" || $_SERVER[PHP_SELF] == "$gDriversFAQPageURL" || $_SERVER[PHP_SELF] == "$gPartnersFAQPageURL") { // 개별 페이지
        echo "
        <header class='header' id='header'>
            <h1>
                <a href='/'>
                    <span class='PC'><img src='./images/h1_logo.png' alt='BARO'/></span>
                    <span class='MO'><img src='./images/h1_logo.svg' alt='BARO'/></span>
                </a>
            </h1>

            <nav class='nav'>
                <ul>
                    <li".(($_SERVER[PHP_SELF] == "$gDriversPageURL"||$_SERVER[PHP_SELF] == "$gDriversFAQPageURL")?" class='selected'":"")."><a href='$gDriversPageURL'>차주용</a></li>
                    <li".(($_SERVER[PHP_SELF] == "$gPartnersPageURL"||$_SERVER[PHP_SELF] == "$gPartnersFAQPageURL")?" class='selected'":"")."><a href='$gPartnersPageURL'>화주용</a></li>
                    <li".(($_SERVER[PHP_SELF] == "$gUsePageURL")?" class='selected'":"")."><a href='$gUsePageURL'>이용안내</a></li>
                </ul>
            </nav>
        </header>
        ";
    } else if ($_SERVER[PHP_SELF] == "$gPrivacyPolicyPageURL") { // 개인정보 처리방침
        echo "
        <header class='header' id='header'>
            <h1>개인정보처리방침</h1>
        </header>
        ";
    } else if ($_SERVER[PHP_SELF] == "$gDriversPolicyPageURL" || $_SERVER[PHP_SELF] == "$gPartnersPolicyPageURL") { // 7 : 차주, 8 : 화주 이용약관
        echo "
        <header class='header' id='header'>
            <h1 class='blind'>바로트럭 서비스 이용약관</h1>
            <div class='tab'>
                <ul>
                    <li".(($_SERVER[PHP_SELF] == "$gDriversPolicyPageURL")?" class='selected'":"")."><a href='$gDriversPolicyPageURL'>차주 이용약관</a></li>
                    <li".(($_SERVER[PHP_SELF] == "$gPartnersPolicyPageURL")?" class='selected'":"")."><a href='$gPartnersPolicyPageURL'>화주 이용약관</a></li>
                </ul>
            </div>
        </header>
        ";
    } else { // index page
        echo "
        <div class='container'>
            <header class='header' id='header'>
                <h1>
                    <a href='/'>
                        <span class='PC'><img src='./images/h1_logo_white.png' alt='BARO'/></span>
                        <span class='MO'><img src='./images/h1_logo_white.svg' alt='BARO'/></span>
                    </a>
                </h1>

                <nav class='nav'>
                    <ul>
                        <li><a href='$gDriversPageURL'>차주용</a></li>
                        <li><a href='$gPartnersPageURL'>화주용</a></li>
                        <li><a href='$gUsePageURL'>이용안내</a></li>
                    </ul>
                </nav>
            </header>
        ";
    }

?>
