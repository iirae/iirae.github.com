<?php
echo "
<script>
    alert('사전예약 이벤트가 종료되었습니다.\\n\\n오픈 가입 이벤트 페이지로 이동합니다.');
    location.href='../signup/';
</script>
";

include "../../inc/conf_lib.php";

$sEventBannerNo = ($_REQUEST[bn]>0) ? $_REQUEST[bn] : 99; // 값이 없는 경우
$sTypeMp = (!!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile')) != 1) ? "1" : "2"; // pc or mobile check

/* 어디에서 왔는지 Insert */
// Landing Log Insert
$cDB = cDB("event_db");
$cStmt = $cDB->prepare("insert into event_landing_log set event_banner_num=$sEventBannerNo, page_referrer='".$_SERVER[HTTP_REFERER]."', cookie_id='".$_COOKIE[prof]."', regdate=now(), type_mp=$sTypeMp");
$rDBResult = $cStmt->execute();
$cDB = null;


echo "
<!DOCTYPE html>
<!-- [if lte 8]><html lang='ko' class='ieLow'><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang='ko'><!--<![endif]-->
<head>
    <meta name='viewport' content='user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width, viewport-fit=cover'>
    <link rel='shortcut icon' type='image/x-icon' href='../../images/favicon_48.ico'>
    <meta charset='utf-8'>
    <meta name='format-detection' content='telephone=no'>
    <meta property='og:title' content='바로트럭'>
    <meta property='og:url' content='http://barotruck.com/'>
    <meta property='og:image' content='http://barotruck.com/images/img_forKakao.jpg'>
    <meta property='og:description' content='빠른 운송! 빠른 배차! 바로트럭 입니다'>
    <meta property='og:keyword' content='전국화물,24시콜,24시콜화물,화물운송,운송사,주선사,화물맨,원콜,차주앱,화주,운송,물류,화물,용달,화물차운임,운임정산,운송료,화물운송료,화물운임,퀵서비스,물류회사,스타트업,물류관리업무,물류관리,1톤,1.4톤,5톤,11톤,카고,윙바디,전국화물운송,전국화물,경기도화물,서울화물,서울용달,바닥차,지입차,물류창고,물류배송,한국물류, 물류신문,바로트럭,qkfhxmfjr,바로,바로바로,baro,barotruck,truck,로지스,로지스틱스,바로로지스틱스,씨오디랩스,codlabs,씨오디,정산,화물정산,화물운송실적신고,운송실적신고,물류이알피,물류erp'>
    <meta name='referrer' content='always'>
    <link rel='stylesheet' href='../../css/fonts.css'>
    <link rel='stylesheet' href='../../css/reset.css'>
    <link rel='stylesheet' href='../../css/common.css'>
    <script type='text/javascript' src='../../js/jquery-3.3.1.min.js'></script>
    <script type='text/javascript' src='../../js/common.js'></script>
    <title>바로트럭</title>
</head>
<body class='pEvent'>

    <div class='wrap' id='wrap'>
        <header class='header'>
            <h1><a href='http://www.barotruck.com' target='_blank' title='바로트럭 홈페이지 바로가기'>
                <img src='./images/h1_logo.png' alt='BARO' class='PC' />
                <img src='./images/h1_logo_mo.png' alt='BARO' class='MO' />
            </a></h1>
        </header>

        <div class='container'>

            <section class='section' id='prevSec'>
                <h2 class='blind'>바로트럭 차주용 앱 사전 예약 이벤트</h2>
                <div class='titleArea mb0'>
                    <img src='./images/img_title.png' alt='바로트럭 차주앱 출시! 골드바, 갤럭시노트9 받자!' class='PC' />
                    <img src='./images/img_title_mo.png' alt='바로트럭 차주앱 출시! 골드바, 갤럭시노트9 받자!' class='MO' />
                    <div class='tab eTab PC'>
                        <img src='./images/img_tab_prev.png' alt='사전예약 이벤트 화면입니다.'/>
                        <ul>
                            <li><a href='#prevSec'><span class='blind'>사전예약 이벤트</span></a></li>
                            <li><a href='#openSec'><span class='blind'>오픈 이벤트</span></a></li>
                            <li><a href='#attendSec'><span class='blind'>출석체크 이벤트</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class='infoArea'>
                    <div class='inner'>
                        <h3>
                            <img src='./images/text_prev_h3.png' alt='사전예약만 해도 목쿠션 또는 담요, 칸타타 지급! 사전예약 신청 후, 출시 5일 이내 정회원에 가입하셔야 참여가 인정됩니다.' class='PC'/>
                        </h3>
                        <div class='box'>
                            <div class='formArea'>
                                <div class='select'>
                                    <h4>
                                        <img src='./images/text_prev_h4.png' alt='사전예약 경품을 선택하세요.' class='PC' />
                                        <span class='MO'>사전예약 경품을 선택하세요.</span>
                                    </h4>
                                    <label for='neck' class='fRadio neck'><input type='radio' id='neck' name='sGift' value='1' /><span class='blind'>목쿠션 선택</span></label>
                                    <label for='blanket' class='fRadio blanket'><input type='radio' id='blanket' name='sGift' value='2' /><span class='blind'>담요 선택</span></label>
                                </div>
                                <div class='inputArea'>
                                    <ul>
                                        <li class='phone'>
                                            <input type='text' id='sPhoneNo' name='sPhoneNo' class='fText eIntOnly' placeholder='휴대폰 번호 입력' maxlength='11' />
                                            <a href='javascript:void(0);' onClick='javascript:goCertifyNo();' class='button'><span class='pcHide'>인증번호 받기</span></a>
                                        </li>
                                        <li class='code'>
                                            <input type='text' id='sCheckNo' name='sCheckNo' class='fText eIntOnly' placeholder='인증번호 입력' maxlength='4' />
                                            <a href='javascript:void(0);' onClick='javascript:goCheckCertify();' class='button'><span class='pcHide'>인증하기</span></a>
                                        </li>
                                    </ul>
                                    <div class='agree'>
                                        <ul>
                                            <li>
                                                <label for='sAgreePerson' class='fChk privacy'>
                                                    <input type='checkbox' id='sAgreePerson' />
                                                    <span class='MOI'>[필수] 개인정보 수집 및 이용 동의</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label for='sAgreeEvent' class='fChk marketing'>
                                                    <input type='checkbox' id='sAgreeEvent' />
                                                    <span class='MOI'>[필수] 사전예약 이벤트 정보 수신동의</span>
                                                </label>
                                            </li>
                                        </ul>
                                        <a href='#layerPrivacy' class='detail eModal'>
                                            <img src='./images/btn_agree.png' alt='개인정보 동의 내용보기' class='PC' />
                                            <span class='MO'>개인정보 동의 내용 보기</span>
                                        </a>
                                    </div>
                                        <a href='javascript:void(0);' onClick='javascript:goRegistration();' class='btnSubmit'>
                                        <img src='./images/btn_register.png' alt='사전예약 등록하기' class='PC' />
                                        <span class='MO'>사전예약 등록하기</span></a>
                                    <div class='info PC'>
                                        <img src='./images/text_prev_info.png' alt='' />
                                        <ul class='blind'>
                                            <li>* 사전예약 기간은 상황에 따라 변경될 수 있습니다.</li>
                                            <li>* 사전알림을 신청하면 카카오톡 문자 메시지(또는 SMS)를 통해 알려드립니다.</li>
                                            <li>* 기타 이벤트 관련 문의는 고객센터($gCompanyPhoneNo)로 문의해주시면 친절히 안내해드리겠습니다.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class='gift'>
                                <ul class='blind'>
                                    <li>차량용 목쿠션 또는 면 쿠션 담요 <em>경품을 선택하지 않은 경우, 랜덤 발송됩니다.</em></li>
                                    <li>칸타타 기프티콘</li>
                                </ul>
                                <div class='event1 MO'>
                                    <img src='./images/text_prev_h3_mo.png' alt='사전예약만 해도 목쿠션 또는 담요, 칸타타 지급! 사전예약 신청 후, 출시 5일 이내 정회원에 가입하셔야 참여가 인정됩니다.' />
                                </div>
                                <img src='./images/img_prev_gift.png' alt='경품 이미지' class='PC' />
                                <div class='MO'>
                                    <p><img src='./images/img_prev_gift_mo01.png' alt='차량용 목쿠션 또는 면 쿠션 담요'/></p>
                                    <p class='txtInfo'>※ 혜택을 선택하지 않은 경우, 랜덤 발송됩니다.</p>
                                    <p><img src='./images/img_prev_gift_mo02.png' alt='칸타타 기프티콘'/></p>
                                </div>
                            </div>
                            <div class='info MO'>
                                <ul>
                                    <li>* 사전예약 기간은 상황에 따라 변경될 수 있습니다.</li>
                                    <li>* 사전알림을 신청하면 카카오톡 문자 메시지(또는 SMS)를 통해 알려드립니다.</li>
                                    <li>* 기타 이벤트 관련 문의는 고객센터($gCompanyPhoneNo)로 문의해주시면 친절히 안내해드리겠습니다.</li>
                                </ul>
                            </div>
                        </div>

                        <div class='service PC'>
                            <img src='./images/img_service.png' alt='바로트럭 서비스 설명'  />
                            <ul class='blind'>
                                <li><strong>운송료, 일하고 바로 받는 바로지급</strong><span>일반경제는 최대 45일 소요되며, 바로지급은 영업일 기준 3일 이내 지급됩니다.</span></li>
                                <li><strong>검증된 화주와 검증된 오더</strong><span>안정적이고 확실한 일감, 믿을 수 있는 운송료 결제 과정으로 가치를 더합니다.</span></li>
                                <li><strong>우편, 팩스 필요없이 앱 하나로 OK</strong><span>종이서류 그만, 잦은 전화통화도 그만! 앱으로 모든 업무가 가능합니다.</span></li>
                            </ul>
                        </div>

                        <div class='warnArea'>
                            <h4>이벤트 유의사항</h4>
                            <ul>
                                <li>※ 사전예약 경품으로 목쿠션, 담요 중 하나를 선택하셔야 하며, 사전예약 등록 후 경품 변경은 불가능합니다. <strong>(선택하지 않을 시 랜덤발송 됩니다.)</strong></li>
                                <li>※ 캔 커피는 기프티콘으로 발송되며, 기업경품/사은품으로 제공되는 기프티콘은 환불 및 기간연장이 불가능 합니다. 쿠폰 상세화면에서 유의사항 및 환불 기준을 확인 후 사용하세요.</li>
                                <li>※ 설치 후 정회원 가입완료 후 로그인을 진행해야 이벤트에 응모됩니다.  <strong>준회원(간편회원) 가입자는 추첨대상에서 제외</strong>되니 유의 바랍니다.</li>
                                <li>※ 사전예약 설치 후 <strong>5일 이내 정회원 가입완료자</strong>에 한해서 추첨하며, 당첨자 발표일은 10월 18일 입니다.</li>
                                <li>※ 사전예약 기간은 9월 21일~10월 10일이며, 출시 후 다운로드&정회원 가입기간은 10월 10일~10월 15일 (10월 15일까지 정회원 승인완료 된 회원에 한함) 입니다.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>


            <section class='section' id='openSec' style='display:none;'>
                <h2 class='blind'>바로트럭 차주용 앱 오픈 이벤트</h2>
                <div class='titleArea PC'>
                    <img src='./images/img_title.png' alt='바로트럭 차주앱 출시! 골드바, 갤럭시노트9 받자!' />
                    <div class='tab eTab'>
                        <img src='./images/img_tab_open.png' alt='오픈 이벤트 화면입니다.'/>
                        <ul>
                            <li><a href='#prevSec'><span class='blind'>사전예약 이벤트</span></a></li>
                            <li><a href='#openSec'><span class='blind'>오픈 이벤트</span></a></li>
                            <li><a href='#attendSec'><span class='blind'>출석체크 이벤트</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class='infoArea'>
                    <div class='inner'>
                        <h3>
                            <img src='./images/text_open_h3.png' alt='차주용 앱 오픈 후, 운행완료에 따라 경품 지급! 차주용 앱 오픈 후, 운행 완료와 바로지급 진행 시 추첨을 통해 경품을 드립니다.' class='PC' />
                            <img src='./images/text_open_h3_mo.png' alt='차주용 앱 오픈 후, 운행완료에 따라 경품 지급! 차주용 앱 오픈 후, 운행 완료와 바로지급 진행 시 추첨을 통해 경품을 드립니다.' class='MO' />
                        </h3>
                        <div class='giftBox'>
                            <img src='./images/img_open_gift.png' alt='경품 목록: 요소수 10L 5통 100명, 타이어 상품권 10만원권 20명, 갤럭시S9 또는 골드바 1명' class='PC' />
                            <ul class='blind'>
                                <li>바로트럭 차주앱 가입 후 4주 이내 첫 운행 완료 시 100명 추첨하여 요소수 10L 5통 증정</li>
                                <li>바로트럭 차주앱 가입 후 4주 이내 3회 이상 운행 완료 시 20명 추첨하여 타이어 상품권 10만원권 증정</li>
                                <li>바로트럭 차주앱 가입 후 8주 이내 바로지급 1회 완료 증정</li>
                            </ul>
                            <ul class='MO'>
                                <li><img src='./images/img_open_gift_mo01.png' alt='바로트럭 차주앱 가입 후 4주 이내 첫 운행 완료 시 100명 추첨하여 요소수 10L 5통 증정' /></li>
                                <li><img src='./images/img_open_gift_mo02.png' alt='바로트럭 차주앱 가입 후 4주 이내 3회 이상 운행 완료 시 20명 추첨하여 타이어 상품권 10만원권 증정' /></li>
                                <li><img src='./images/img_open_gift_mo03.png' alt='바로트럭 차주앱 가입 후 8주 이내 바로지급 1회 완료 증정' /></li>
                            </ul>
                        </div>

                        <div class='warnArea'>
                            <h4>이벤트 유의사항</h4>
                            <ul>
                                <li>※ 배차 취소, 인수승인 보류 등 <strong>운행이 정상적으로 완료되지 않은 경우에는 추첨대상자에 포함되지 않으니</strong> 유의 바랍니다.</li>
                                <li>※ 바로트럭 내에서 로그인 후 <strong>‘배차요청’</strong>버튼을 통해 정상적으로 운행 내역이 남아있어야 하며, <strong>‘운행완료’</strong>까지 정상 처리된 오더만 인정됩니다.</li>
                                <li>※ 바로지급 서비스는 운송료 선지급 서비스로, 이용시 소정의 이용료가 발생하는 유료 서비스입니다.</li>
                                <li>※ 첫 운행완료, 3회 이상 운행완료 이벤트 참여 기간은 10월 10일~11월 10일 (11월 10일까지 운행 완료 처리된 건에 한함) 이며, 당첨자 발표일은 11월 12일입니다.</li>
                                <li>※ 바로지급 1회 완료 이벤트 참여 기간은 10월 10일~12월 10일 (12월 10일까지 바로지급을 통해 운송료 입금완료 처리된 건에 한함. 당첨자 발표일은 12월 12일입니다.</li>
                                <li>※ 바로지급 1회 완료 이벤트 당첨자는 경품으로 갤럭시노트9 또는 골드바(150만원 상당)중 한가지를 선택하여야 합니다. (제세공과금 22% 당첨자 부담)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section class='section' id='attendSec' style='display:none;'>
                <h2 class='blind'>바로트럭 차주용 앱 출석 이벤트</h2>
                <div class='titleArea PC'>
                    <img src='./images/img_title.png' alt='바로트럭 차주앱 출시! 골드바, 갤럭시노트9 받자!' />
                    <div class='tab eTab'>
                        <img src='./images/img_tab_attend.png' alt='출석체크 이벤트 화면입니다.'/>
                        <ul>
                            <li><a href='#prevSec'><span class='blind'>사전예약 이벤트</span></a></li>
                            <li><a href='#openSec'><span class='blind'>오픈 이벤트</span></a></li>
                            <li><a href='#attendSec'><span class='blind'>출석체크 이벤트</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class='infoArea'>
                    <div class='inner'>
                        <h3>
                            <img src='./images/text_attend_h3.png' alt='출석만 해도, 최대 3만 5천원 바로지급 이용료 할인! 차주용 앱 오픈 후, 8주 동안 출석만 해도 이용료 할인 쿠폰을 드립니다.' class='PC' />
                            <img src='./images/text_attend_h3_mo.png' alt='출석만 해도, 최대 3만 5천원 바로지급 이용료 할인! 차주용 앱 오픈 후, 8주 동안 출석만 해도 이용료 할인 쿠폰을 드립니다.' class='MO' />
                        </h3>
                        <div class='giftBox'>
                            <img src='./images/img_attend_gift.png' alt='10일 출석 시 이용료 5천원 할인 쿠폰 1장, 20일 출석 시 이용료 5천원 할인 쿠폰 1장, 30일 출석 시 이용료 5천원 할인 쿠폰 2장, 40일 출석 시 이용료 5천원 할인 쿠폰 3장' class='PC' />
                            <img src='./images/img_attend_gift_mo.png' alt='10일 출석 시 이용료 5천원 할인 쿠폰 1장, 20일 출석 시 이용료 5천원 할인 쿠폰 1장, 30일 출석 시 이용료 5천원 할인 쿠폰 2장, 40일 출석 시 이용료 5천원 할인 쿠폰 3장' class='MO' />
                            <ul class='blind'>
                                <li>10일 출석 시 이용료 5천원 할인 쿠폰 1장</li>
                                <li>20일 출석 시 이용료 5천원 할인 쿠폰 1장</li>
                                <li>30일 출석 시 이용료 5천원 할인 쿠폰 2장</li>
                                <li>40일 출석 시 이용료 5천원 할인 쿠폰 3장</li>
                            </ul>
                        </div>

                        <div class='warnArea'>
                            <h4>이벤트 유의사항</h4>
                            <ul>
                                <li>※ 오픈 후 8주 동안 앱을 실행하고 로그인(비연속 인정) 한 일수를 합산하여, 차주분께 일괄 지급됩니다.</li>
                                <li>※ 정상 로그인의 경우만 출석으로 인정됩니다. <strong>앱 내의 ‘출석’ 페이지를 꼭 확인</strong>해주세요.</li>
                                <li>※ 이용료 쿠폰의 유효기간은 발행일로부터 1년이며, 바로지급 1회 요청 당 1장만 사용 가능합니다.</li>
                                <li>※ 이벤트 참여 기간은 10월 10일~12월 10일 (12월 10일까지 정상 로그인건에 한해 출석인수 인정) 이며, 쿠폰 지급 대상자 발표일은 12월 12일 입니다.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <a href='http://www.barotruck.com' class='btnHome MO'>바로트럭 홈페이지 바로가기</a>

        </div>

    </div>

    <!-- layer -->
    <section class='layer' id='layerPrivacy' style='display:none;'>
        <div class='inner'>
            <header class='head'>
                <h2>개인 정보 동의 내용 보기</h2>
            </header>
            <div class='content'>
                <h3>· 개인정보 수집/이용 및 문자 수신동의 안내</h3>
                <p>㈜씨오디랩스는 바로트럭 서비스 출시 및 이벤트 정보 전송을 위해 개인정보를 수집 및 이용하고 있습니다. 귀하는 개인정보 수집 및 이용에 동의하지 않을 수 있으며, 동의 거부 시에는 사전예약 및 사전예약 이벤트에 참여하실 수 없습니다.</p>
                <ul>
                    <li>- 개인정보의 수집 및 이용 목적 : 사전예약 참여 및 앱 출시 안내 SMS발송, 이벤트 경품 발송과 고객문의 대응 </li>
                    <li>- 수집하는 개인정보의 항목 : 휴대폰번호</li>
                    <li>- 개인정보의 보유 및 이용 기간 : 이벤트 종료 후 6개월 이내 파기</li>
                </ul>
                <p>※ 앱 출시  이벤트 정보 전송 이력은 전송일로부터 6개월간 보관 할 수 있습니다.</p>

                <h3>· 개인정보 처리위탁 안내</h3>
                <p>㈜씨오디랩스는 다음과 같이 개인정보를 위탁하고 있습니다.</p>
                <ul>
                    <li>- 수탁업체명 : ㈜웅진</li>
                    <li>- 개인정보수집 항목 : 휴대폰번호</li>
                    <li>- 개인정보 처리위탁 업무 내용</li>
                </ul>
                <p>㈜웅진 : 사전예약 이벤트 안내 및 고객문의 대응</p>
            </div>
            <a href='javascript:;' class='btnClose eClose'><img src='./images/btn_close.png' alt='레이어 닫기'/></a>
        </div>
        <span class='blank'></span>
    </section>



</body>
</html>

<input type='hidden' id='sCheckVal' name='sCheckVal' value='' />
<input type='hidden' id='sBn' name='sBn' value='$sEventBannerNo' />
<input type='hidden' id='sTypeMp' name='sTypeMp' value='$sTypeMp' />
";
?>
<script type="text/javascript">
$(function(){
    //레이어 열기
    $('.eModal').on('click', function(e){
        var targetLayer = $($(e.currentTarget).attr('href'));
        layerOpen(targetLayer);
        e.preventDefault();
    });

    // layer close click
    $('.layer').on('click', ' .eClose', function (e) {
        layerClose($(this));
        e.preventDefault();
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


});



function goCertifyNo () {
    if (  ($("#sPhoneNo").val().length > 11) || ($("#sPhoneNo").val().length < 10)  ) {
        alert ("휴대폰번호를 정확히 입력해 주세요.");
        $("#sPhoneNo").focus();
        return false;
    }

    var url = './proc.php';
    var params = 'mode=getCertifyNo&phone_no='+$("#sPhoneNo").val();
    $.ajax({
        type:'POST',url:url,data:params,dataType:'json',
        success:function(args){
            obj = eval(args);
            if (obj.Status_Code==200) {
                alert("인증번호가 전송되었습니다.\n인증번호를 입력해 주세요.");
                $("#sPhoneNo").attr("readonly", true);
                return true;
            } else {
                if (obj.Status_Msg) window.alert(obj.Status_Msg);
                location.reload();
                return false;
            }
        }
    });
    return true;
}

function goCheckCertify() {
    if (  !$("#sPhoneNo").val() || $("#sPhoneNo").val()==""  ) {
        alert ("휴대폰번호를 입력해 주세요.");
        $("#sPhoneNo").focus();
        return false;
    }
    if (  ($("#sPhoneNo").val().length > 11) || ($("#sPhoneNo").val().length < 10)  ) {
        alert ("휴대폰번호를 정확히 입력해 주세요.");
        $("#sPhoneNo").focus();
        return false;
    }
    if ( !$("#sCheckNo").val() || $("#sCheckNo").val() == "" ) {
        alert ("인증번호를 입력해 주세요.");
        $("#sCheckNo").focus();
        return false;
    }

    var url = './proc.php';
    var params = 'mode=checkCertifyNo&phone_no='+$("#sPhoneNo").val()+"&auth_key="+$("#sCheckNo").val();
    $.ajax({
        type:'POST',url:url,data:params,dataType:'json',
        success:function(args){
            obj = eval(args);
            if (obj.Status_Code==200) {
                alert("휴대폰인증이 완료 되었습니다.\n이벤트 사전예약을 신청해 주세요.");
                $("#sPhoneNo").attr("readonly", true);
                $("#sCheckNo").attr("readonly", true);
                $("#sCheckVal").val("Y");
                return true;
            } else if (obj.Status_Code==526) {
                if (obj.Status_Msg) window.alert(obj.Status_Msg);
                $("#sPhoneNo").attr("readonly", true);
                $("#sCheckNo").val("");
                $("#sCheckNo").focus();
                return false;
            } else {
                if (obj.Status_Msg) window.alert(obj.Status_Msg);
                location.reload();
                return false;
            }
        }
    });
    return true;
}

function goRegistration() {
    if ($("#sCheckVal").val() != "Y") {
        alert("인증을 먼저 진행해 주세요.");
        $("#sPhoneNo").focus();
        return false;
    }
    if( $("#sAgreePerson").prop("checked") != true ) {
        alert("개인정보 수집 및 이용에 동의해 주셔야 합니다.");
        return false;
    }
    if( $("#sAgreeEvent").prop("checked") != true ) {
        alert("사전예약 이벤트 정보 수신에 동의해 주셔야 합니다.");
        return false;
    }

    var url = './proc.php';
    var params = "mode=setRegistration&event_banner_num="+$("#sBn").val()+"&type_mp="+$("#sTypeMp").val()+"&phone_no="+$("#sPhoneNo").val()+"&gift="+$("input:radio[name='sGift']:checked").val();
    $.ajax({
        type:'POST',url:url,data:params,dataType:'json',
        success:function(args){
            obj = eval(args);
            if (obj.Status_Code==200) {
                alert("사전예약 이벤트에 성공적으로 신청되었습니다.");
                location.reload();
                return true;
            } else {
                if (obj.Status_Msg) window.alert(obj.Status_Msg);
                location.reload();
                return false;
            }
        }
    });
    return true;
}

</script>
