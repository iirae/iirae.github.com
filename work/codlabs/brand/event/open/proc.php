<?php
include "../../inc/conf_lib.php";


$aHtmlReturnCode = Array(
    "100" => Array("Status_Code"=>"100", "Status_Msg"=>"서버에 문제가 있습니다. 잠시후 다시 시도해 주세요."),
    "101" => Array("Status_Code"=>"101", "Status_Msg"=>"서버에 문제가 있습니다. 잠시후 다시 시도해 주세요."),
    "200" => Array("Status_Code"=>"200", "Status_Msg"=>"사전예약 이벤트에 성공적으로 신청되었습니다."),
    "201" => Array("Status_Code"=>"201", "Status_Msg"=>"이벤트에 이미 신청한 사용자입니다."),
    "202" => Array("Status_Code"=>"202", "Status_Msg"=>"사전예약 이벤트 신청에 실패하였습니다.\n잠시 후 다시 시도해 주세요."),
);



switch ($_REQUEST[mode]) {





    // 인증번호 받기
    case ("getCertifyNo") :
        $cDB = cDB("event_db");
        $cStmt = $cDB->prepare("select * from event_registration where phone_no=$_POST[phone_no]"); // 등록되어있는지 체크
        $cStmt->execute();
        if ($cStmt->rowCount()>0) { echo json_encode($aHtmlReturnCode[201]); exit; } // 이미 등록되었을 경우

        // API -- http://wiki.codlabs.com:8090/pages/viewpage.action?pageId=16220176
        $sUrl = "$gApiExternalUrl/auth";
        $sMethod = "post";
        $sParam = "phone_no=$_POST[phone_no]";
        $rResult = getCurl($sUrl,$sMethod,$sParam);
        echo (!$rResult) ? json_encode($aHtmlReturnCode[100]) : $rResult;
        exit;
    break;





    // 인증번호 확인
    case ("checkCertifyNo") :
        // API -- http://wiki.codlabs.com:8090/pages/viewpage.action?pageId=19169386
        $sUrl = "$gApiExternalUrl/auth_confirm";
        $sMethod = "post";
        $sParam = "phone_no=$_POST[phone_no]&auth_key=$_POST[auth_key]";
        $rResult = getCurl($sUrl,$sMethod,$sParam);
        echo (!$rResult) ? json_encode($aHtmlReturnCode[100]) : $rResult;
        exit;
    break;





    // 사전예약 등록하기
    case ("setRegistration") :
        $cDB = cDB("event_db");
        $cStmt = $cDB->prepare("select * from event_registration where phone_no=$_POST[phone_no]"); // 등록되어있는지 체크
        $cStmt->execute();
        if ($cStmt->rowCount()>0) { echo json_encode($aHtmlReturnCode[201]); exit; } // 이미 등록되었을 경우

        $rGift = ($_POST[gift]=="undefined") ? "9" : $_POST[gift];
        $cStmt = $cDB->prepare("insert into event_registration (event_banner_num, type_mp, phone_no, cookie_id, gift, regdate) values ('".$_POST[event_banner_num]."', '".$_POST[type_mp]."', '".$_POST[phone_no]."', '".$_COOKIE[prof]."', '".$rGift."', now())");
        $rDBResult = $cStmt->execute();
		if ($rDBResult == false) { // DB Insert 실패
            echo json_encode($aHtmlReturnCode[202]); exit;
        } else { // 성공
            echo json_encode($aHtmlReturnCode[200]); exit;
        }
        $cDB = null;
    break;






}





?>
