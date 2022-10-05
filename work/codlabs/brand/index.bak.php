<?php
include "./inc/conf_lib.php";

if ($_REQUEST[md] >= "6" && $_REQUEST[md] <= "8") { // 약관에만 사용됨
    if ($_REQUEST[md] == "6") { // 개인정보 처리방침
        $sSubUrl = "cod/terms/driver";
        $sParam = "terms_type=2";
    } else if ($_REQUEST[md] == "7") { // 차주 이용약관
        $sSubUrl = "cod/terms/driver";
        $sParam = "terms_type=1";
    } else if ($_REQUEST[md] == "8") { // 화주 이용약관
        $sSubUrl = "cod/terms/owner";
        $sParam = "terms_type=1";
    } else { // 개인정보 처리방침
        $sSubUrl = "cod/terms/driver";
        $sParam = "terms_type=2";
    }
    // API -- http://wiki.codlabs.com:8090/pages/viewpage.action?pageId=31293527
    $sUrl = "$gApiExternalUrl/$sSubUrl";
    $sMethod = "post";
    $sParam = $sParam;
    $rResult = getCurl($sUrl,$sMethod,$sParam);
    if (!$rResult) {
        echo json_encode($aHtmlReturnCode[100]);
    } else {
        $aApiReturn = json_decode($rResult,true);
        if ($aApiReturn[Status_Code] != "200") {
            echo alertMsgFunction("", "M", "./?md=6"); exit;
        } else {
            $rResult = $aApiReturn[Result_Data][0];
        }
    }
} // if end

include "./inc/header.php";


/* $_REQUEST[md] 값에 의한 분기
/* 1 : drivers.html
/* 2 : partners.html
/* 3 : use.html
/* 4 : drivers_faq.html
/* 5 : partners_faq.html
/* 6 : drivers_policy.html
/* 7 : partners_policy.html
/* default : index.html
*/

switch ($_REQUEST[md]) {




    // drivers.html
    case ("1") :
        echo "
        <section class='section bg'>
            <div class='contents'>
                <div class='inner'>
                    <h2 class='slogan'>운송은 빨라지고,<br>정산은 쉬워집니다.</h2>
                    <a href='$gDriversAppDownload' target='_blank' class='button icoApp'>차주용 앱 다운로드</a>
                </div>
            </div>
        </section>

        <section class='section effect moShow'>
            <div class='contents'>
                <div class='inner'>
                    <div class='text'>
                        <strong class='title'>배차</strong>
                        <h2 class='slogan'>배차는 빨라지고,<br />정산은 쉬워집니다.</h2>
                        <p class='desc'>더 이상 전화통화로 시간 낭비하지 마세요.<br>
                        배차부터 운행, 정산까지 모두 앱으로 가능합니다.</p>
                    </div>
                    <div class='image'>
                        <img src='./images/img_driver_cargo.png' alt='바로트럭의 화물목록' class='PC' />
                        <img src='./images/img_driver_cargo_mo.png' alt='바로트럭의 화물목록' class='MO' />
                    </div>
                </div>
            </div>
        </section>

        <section class='section effect color'>
            <div class='contents'>
                <div class='inner'>
                    <div class='image PC'>
                        <img src='./images/img_driver_empty.png' alt='바로트럭의 공차 스케줄 등록 시스템' class='PC' />
                    </div>
                    <div class='text'>
                        <strong class='title'>공차 등록</strong>
                        <h2 class='slogan'>공차 스케줄 등록으로,<br />효율적인 배차.</h2>
                        <p class='desc'>회차 일정부터, 운행이 없는 날까지 공차 스케줄만 등록하세요.<br />
                        화주가 화물 등록 시 우선적으로 매칭 됩니다.<br />
                        배차시간과 공차율을 최소화하세요.</p>
                    </div>
                    <div class='image MO'>
                        <img src='./images/img_driver_empty_mo.png' alt='바로트럭의 공차 스케줄 등록 시스템' />
                    </div>
                </div>
            </div>
        </section>

        <section class='section effect'>
            <div class='contents'>
                <div class='inner'>
                    <div class='text'>
                        <strong class='title'>정산</strong>
                        <h2 class='slogan'>번거로운 정산은 끝,<br />빠른 선지급.</h2>
                        <p class='desc'>운송료 지급 방식 개선을 통해<br />
                        기존 대비 최대 50일까지 단축된 기간으로 정산이 가능합니다.</p>
                    </div>
                    <div class='image'>
                        <img src='./images/img_driver_pay.png' alt='바로트럭의 바로지급' class='PC' />
                        <img src='./images/img_driver_pay_mo.png' alt='바로트럭의 바로지급' class='MO' />
                    </div>
                </div>
            </div>
        </section>

        <article class='bgGray'>
            <section class='section tax effect'>
                <div class='contents'>
                    <div class='inner'>
                        <div class='text'>
                            <strong class='title'>모바일 세금계산서</strong>
                            <h2 class='slogan'>종이, 우편없이<br /> 모바일로 간편하게.</h2>
                            <p class='desc'>번거로운 종이 세금계산서,<br />
                            이제는 모바일로 간편하게 발급하세요.<br />
                            인수증 전송도 가능합니다.</p>
                        </div>
                        <div class='image'>
                            <img src='./images/img_driver_tax.png' alt='바로트럭의 바로지급' class='PC' />
                            <img src='./images/img_driver_tax_mo.png' alt='바로트럭의 바로지급' class='MO' />
                        </div>
                    </div>
                </div>
            </section>

            <section class='section effect'>
                <div class='inner'>
                    <div class='box gFlow'>
                        <div class='text'>
                            <strong class='title'>운송료 제안</strong>
                            <h2 class='slogan'>내가 선택하는<br />합리적인 운임 제안.</h2>
                            <p class='desc'>운행하기에 적정한 운송료가 아니라면,<br />직접 원하는 운임 가격을 제안해보세요.</p>
                        </div>
                        <div class='image'>
                            <img src='./images/img_driver_myoffer.png' alt='바로트럭의 운송료 제안' class='PC' />
                            <img src='./images/img_driver_myoffer_mo.png' alt='바로트럭의 운송료 제안' class='MO' />
                        </div>
                    </div>
                    <div class='box gReverse'>
                        <div class='text'>
                            <strong class='title'>운행일정 관리</strong>
                            <h2 class='slogan'>일정부터 정산까지<br />알아서 똑똑하게.</h2>
                            <p class='desc'>운행시간부터 깜빡하기 쉬운 정산까지<br />바로트럭이 스마트하게 관리합니다.</p>
                        </div>
                        <div class='image'>
                            <img src='./images/img_driver_schedule.png' alt='바로트럭의 운행일정 관리' class='PC' />
                            <img src='./images/img_driver_schedule_mo.png' alt='바로트럭의 운행일정 관리' class='MO' />
                        </div>
                    </div>
                </div>
            </section>

            <section class='section partners effect'>
                <div class='contents'>
                    <div class='inner'>
                        <div class='image PC'>
                            <img src='./images/img_driver_partners.png' alt='바로트럭의 바로지급' class='pcL' />
                            <img src='./images/img_driver_partners_pc_s.png' alt='바로트럭의 바로지급' class='pcS' />
                        </div>
                        <div class='text'>
                            <strong class='title'>화주 웹</strong>
                            <h2 class='slogan'>화물 배차, 운행 관리<br />운임정산을 가장 쉽게 하는 방법.</h2>
                            <p class='desc'>매번 반복되는 배차, 정산 업무<br>바로트럭의 스마트한 시스템으로 업무 시간을 절약하세요.</p>
                        </div>
                        <div class='image MO'>
                            <img src='./images/img_driver_partners_mo.png' alt='바로트럭의 바로지급' />
                        </div>
                    </div>
                </div>
            </section>

        </article>
        ";
    break;




    // partners.html
    case ("2") :
        echo "
        <section class='section bg'>
            <div class='contents'>
                <div class='inner'>
                    <h2 class='slogan'>화물 배차, 운행 관리<br>운임정산을 가장 쉽게 하는 방법.</h2>
                    <div class='btnArea'>
                        <a href='$gPartnersRegistration' target='_blank' class='button'>가입하기</a>
                        <a href='$gPartnersAppDownload' target='_blank' class='button icoApp'>화주용 앱 다운로드</a>
                    </div>
                    <div class='tel'><strong>가입 및 이용문의</strong> <a href='tel:1899-9585' class='txtNum'>1899-9585</a></div>
                </div>
            </div>
        </section>

        <section class='section effect left moShow'>
            <div class='contents'>
                <div class='inner'>
                    <div class='text'>
                        <strong class='title'>대시보드</strong>
                        <h2 class='slogan'>배차 통계부터<br />정산 할 운송료까지.</h2>
                        <p class='desc'>더 이상 전화통화로 시간 낭비하지 마세요.<br>
                        배차부터 운행, 정산까지 모두 앱으로 가능합니다.</p>
                    </div>
                    <div class='image'>
                        <img src='./images/img_partners_dashboard.png' alt='바로트럭의 대시보드' class='PC' />
                        <img src='./images/img_partners_dashboard_mo.png' alt='바로트럭의 대시보드' class='MO' />
                    </div>
                </div>
            </div>
        </section>

        <section class='section effect color'>
            <div class='contents'>
                <div class='inner'>
                    <div class='image PC'>
                        <img src='./images/img_partners_registe.png' alt='바로트럭의 화물 등록' class='PC' />
                    </div>
                    <div class='text'>
                        <strong class='title'>화물 등록</strong>
                        <h2 class='slogan'>화물 등록 한 번으로<br />간편해진 배차 업무.</h2>
                        <p class='desc'>화물 등록 후에도 전화로 배차 업무를 보던<br /> 불편함을 최소화했습니다. <br />이제 한 번만 등록해놓으면, 인수증 확인까지 가능합니다.</p>
                    </div>
                    <div class='image MO'>
                        <img src='./images/img_partners_registe_mo.png' alt='바로트럭의 화물 등록' />
                    </div>
                </div>
            </div>
        </section>

        <section class='section effect left'>
            <div class='contents'>
                <div class='inner'>
                    <div class='text'>
                        <strong class='title'>정산</strong>
                        <h2 class='slogan'>번거로운 정산은 끝,<br />한 달에 한 번만 정산.</h2>
                        <p class='desc'>한 번 운행 할 때마다 반복되는 정산 업무.<br /> 한 달에 한 번만 모아서 정산하세요.</p>
                    </div>
                    <div class='image'>
                        <img src='./images/img_partners_pay.png' alt='바로트럭의 바로지급' class='PC' />
                        <img src='./images/img_partners_pay_mo.png' alt='바로트럭의 바로지급' class='MO' />
                    </div>
                </div>
            </div>
        </section>

        <article class='bgGray'>
            <section class='section process effect'>
                <div class='contents'>
                    <div class='inner'>
                        <h2 class='slogan'>화주 가입 프로세스</h2>
                        <ol>
                            <li class='step1'><span class='txtNum'>1</span><p class='step'>가입 신청</p></li>
                            <li class='step2'><span class='txtNum'>2</span><p class='step'>서류 제출</p></li>
                            <li class='step3'><span class='txtNum'>3</span><p class='step'>서류 검토</p></li>
                            <li class='step4'><span class='txtNum'>4</span><p class='step'>등록 승인</p></li>
                            <li class='step5'><span class='txtNum'>5</span><p class='step'>서비스 이용</p></li>
                        </ol>
                    </div>
                </div>
            </section>

            <section class='section'>
                <div class='inner effect'>
                    <div class='box gFlow receipt'>
                        <div class='text'>
                            <strong class='title'>인수증</strong>
                            <h2 class='slogan'>인수증 팩스, 기다리지 말고<br />웹에서 바로 확인</h2>
                        </div>
                        <div class='image'>
                            <img src='./images/img_partners_reciept.png' alt='바로트럭의 인수증 처리' class='PC' />
                            <img src='./images/img_partners_reciept_mo.png' alt='바로트럭의 인수증 처리' class='MO' />
                        </div>
                    </div>
                    <div class='box gReverse print'>
                        <div class='text'>
                            <strong class='title'>운행내역</strong>
                            <h2 class='slogan'>운행내역 확인 문서,<br />이제는 간단하게 인쇄.</h2>
                        </div>
                        <div class='image'>
                            <img src='./images/img_partners_print.png' alt='바로트럭의 운행내역 편리성'class='PC' />
                            <img src='./images/img_partners_print_mo.png' alt='바로트럭의 운행내역 편리성' class='MO' />
                        </div>
                    </div>
                </div>

                <div class='inner effect'>
                    <div class='box gFlow matching'>
                        <div class='text'>
                            <strong class='title'>공차 매칭</strong>
                            <h2 class='slogan'>획기적인 공차 매칭으로<br />배차 효율화 실현.</h2>
                        </div>
                        <div class='image'>
                            <img src='./images/img_partners_matching.png' alt='바로트럭의 공차매칭 시스템' class='PC' />
                            <img src='./images/img_partners_matching_mo.png' alt='바로트럭의 공차매칭 시스템' class='MO' />
                        </div>
                    </div>
                    <div class='box gReverse flex'>
                        <div class='text'>
                            <strong class='title'>변동 운송료</strong>
                            <h2 class='slogan'>변동 운송료 도입으로<br />시장 가격 변화에 대응.</h2>
                        </div>
                        <div class='image'>
                            <img src='./images/img_partners_flex.png' alt='바로트럭의 변동 운송료' class='PC' />
                            <img src='./images/img_partners_flex_mo.png' alt='바로트럭의 변동 운송료' class='MO' />
                        </div>
                    </div>
                </div>
            </section>

        </article>
        ";
    break;




    // use.html
    case ("3") :
        echo "
        <section class='section bg'>
            <div class='contents'>
                <div class='inner'>
                    <h2 class='head'>바로트럭 이용안내</h2>
                </div>
            </div>
        </section>

        <article class='contents' id='contents'>

            <section class='divide'>
                <div class='inner'>
                    <h3 class='dt'>차주회원 제출서류</h3>
                    <div class='info'>
                        <ul>
                            <li>1. 사업자등록증</li>
                            <li>2. 운전면허증</li>
                            <li>3. 자동차등록증</li>
                            <li>4. 화물운송 종사자 자격증</li>
                            <li>5. 적재물 배상책임 보험가입증서 (5톤 이상)</li>
                            <li>6. 통장 사본</li>
                        </ul>
                    </div>
                </div>
                <div class='btnArea'>
                    <a href='$gDriversAppDownload' target='_blank' class='btnBasic icoApp'>차주 앱 다운로드</a>
                    <a href='./?md=4' class='btnBasic'>차주 <span class='txtEn'>FAQ</span></a>
                </div>
            </section>

            <section class='divide'>
                <div class='inner'>
                    <h3 class='dt'>화주회원 제출서류</h3>
                    <div class='info'>
                        <ul>
                            <li>1. 사업자등록증</li>
                            <li>2. 운송사 허가증 (운송사 가입 시)</li>
                            <li>3. 주선사 허가증 (주선사 가입 시)</li>
                        </ul>
                    </div>
                </div>
                <div class='btnArea'>
                    <a href='$gPartnersRegistration' target='_blank' class='btnBasic icoSignup'>가입하기</a>
                    <a href='$gPartnersAppDownload' target='_blank' class='btnBasic icoApp'>화주 앱 다운로드</a>
                    <a href='./?md=5' class='btnBasic'>화주 <span class='txtEn'>FAQ</span></a>
                </div>
            </section>

            <section class='divide'>
                <h3 class='dt'>서류제출처</h3>
                <ul class='sub'>
                    <li><span class='txtEn'>FAX.</span> <span class='txtNum'>0303-3446-9585</span></li>
                    <li>가입 및 이용문의. <a href='tel:1899-9585' class='txtNum'>1899-9585</a></li>
                </ul>
            </section>

        </article>
        ";
    break;




    // drivers_faq.html
    case ("4") :
        echo "
        <section class='section bg'>
            <div class='contents'>
                <div class='inner'>
                    <h2 class='head'>자주묻는 질문</h2>
                </div>
            </div>
        </section>

        <article class='container' id='container'>
            <div class='tab'>
                <ul>
                    <li class='selected'><a href='./?md=4'>차주 <span class='txtEn'>FAQ</span></a></li>
                    <li><a href='./?md=5'>화주 <span class='txtEn'>FAQ</span></a></li>
                </ul>
            </div>

            <section class='boardList eToggleSlide'>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>회원가입은 어떻게 하나요?</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>1. 구글 스토어에 '바로트럭'을 검색하여 '바로트럭-차주용' 애플리케이션을 다운로드합니다.</p>
                        <p>2. 앱에서 요청하는 기능들에 대한 권한 승인을 해주세요. (동의하지 않을 시 가입이 불가한 점 양해 바랍니다.)</p>
                        <p>3. 다운로드된 메인 화면에서 가입하고자 하는 유형에 따라 '카카오 계정으로 시작' 또는 '전화번호로 가입'을 선택해 회원가입을 진행합니다.</p>
                    </div>
                </div>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>회원가입을 하려고 하는데 '이미 가입된 사용자입니다. 로그인해주세요' 라고 뜹니다.</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>혹시 카카오 계정 또는 전화번호로 가입하지는 않으셨나요?</p>
                        <p>비밀번호를 잊어버렸을 경우, '기존 사용자 로그인' 선택 후 하단의 '비밀번호 찾기'를 선택하여 비밀번호를 변경 후 로그인해주세요.</p>
                        <br />
                        <p>가입하지 않았을 경우, 고객센터로 문의 부탁드립니다.</p>
                        <p>고객센터 : <span class='txtNum'>1899-9585</span></p>
                    </div>
                </div>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>가입 신청 제출서류를 잘못 등록했어요! 어떻게 변경하나요?</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>등록된 서류가 식별이 불가능 한 경우, 입력한 내용과 동일하지 않은 경우 가입이 승인되지 않을 수 있습니다.</p>
                        <p>서류 변경을 원하는 경우, 고객센터로 문의해주세요.</p>
                        <br />
                        <p>고객센터 : <span class='txtNum'>1899-9585</span></p>
                    </div>
                </div>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>'로그인을 했는데, 추가정보를 입력하라고 나옵니다.</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>제출서류를 등록하지 않고 회원가입을 완료한 경우, 정식 가입이 되지 않은 상태로써 제출서류를 등록 후 가입 승인이 필요합니다.</p>
                        <br />
                        <p>마이페이지 &gt; '추가 정보 등록'을 선택하여 나머지 정보를 입력해주세요.</p>
                        <p>이미 등록한 경우라면, 정회원 승인이 완료될 경우 완료안내 푸시 알림을 통해 알려드립니다.</p>
                    </div>
                </div>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>비밀번호를 잊어버렸어요.</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>1. 앱을 실행 한 후 화면에서 '기존사용자 로그인'을 선택합니다.</p>
                        <p>2. 화면 하단의 '비밀번호 찾기'를 선택하여 비밀번호 찾기 SMS인증을 진행합니다.</p>
                        <p>3. 인증을 완료 한 후, 비밀번호 변경창에서 새로운 비밀번호를 입력합니다.</p>
                    </div>
                </div>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>휴대폰 번호가 바뀌었어요. 어떻게 변경하나요?</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>이미 등록된 핸드폰 번호의 변경을 원하는 경우, 고객센터로 문의해주세요.</p>
                        <br />
                        <p>고객센터 : <span class='txtNum'>1899-9585</span></p>
                    </div>
                </div>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>'회원탈퇴는 어떻게 하나요?</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>1. 메뉴에서 '설정'을 선택한 후 '서비스 탈퇴'를 선택합니다.</p>
                        <p>2. 서비스 탈퇴 사유를 선택 후. '확인'을 선택합니다.</p>
                    </div>
                </div>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>화물오더 배차는 어떻게 하나요?</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>'화물 목록에서 원하는 화물을 선택한 후, '배차 요청' 버튼을 눌러 배차를 요청합니다.</p>
                        <p>완료된 배차 운행 건은 '운행 일정'목록에서 볼 수 있습니다.</p>
                    </div>
                </div>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>'차주제안'은 무엇인가요?</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>'배차 요청 왼쪽에 '차주 제안'버튼이 있는 경우, 화주에게 적절하다고 생각되는 운송료를 제안할 수 있습니다.</p>
                        <p>화주가 수락한 경우, 배차가 체결됩니다.</p>
                    </div>
                </div>

            </section>

        </article>
        ";
    break;




    // partners_faq.html
    case ("5") :
        echo "
        <section class='section bg'>
            <div class='contents'>
                <div class='inner'>
                    <h2 class='head'>자주묻는 질문</h2>
                </div>
            </div>
        </section>

        <article class='container' id='container'>
            <div class='tab'>
                <ul>
                    <li><a href='./?md=4'>차주 <span class='txtEn'>FAQ</span></a></li>
                    <li class='selected'><a href='./?md=5'>화주 <span class='txtEn'>FAQ</span></a></li>
                </ul>
            </div>

            <section class='boardList eToggleSlide'>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>회원가입은 어떻게 하나요?</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>1. <a href='$gPartnersRegistration' target='_blank'>http://partners.barotruck.com/</a> 에서 로그인 버튼 하단의 '회원가입'을 클릭합니다.</p>
                        <p>2. 가입 유형을 선택 후, 사업자 정보, 개인 정보, 법인 계좌 정보 등, 화면의 안내에 따라 입력 후 '다음'을 클릭 합니다.</p>
                        <p>3. 제출서류를 스캔또는 촬영하여 업로드 후, 등록 완료버튼을  눌러 가입 신청을 완료합니다.</p>
                    </div>
                </div>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>가입 신청 제출서류를 잘못 등록했어요! 어떻게 변경하나요?</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>등록된 서류가 식별이 불가능 한 경우, 입력한 내용과 동일하지 않은 경우 가입이 승인되지 않을 수 있습니다.</p>
                        <p>서류 변경을 원하는 경우, 고객센터로 문의해주세요.</p>
                        <br />
                        <p>고객센터 : <span class='txtNum'>1899-9585</span></p>
                    </div>
                </div>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>'로그인을 했는데, '정상적인 서비스 이용을 위해 증빙서류를 제출 해 주시기 바랍니다.'라고 나와요.</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>제출서류를 등록하지 않고 회원가입을 완료한 경우, 정식 가입이 되지 않은 상태로써 제출서류를 등록 후 가입 승인이 필요합니다.</p>
                        <p>제출서류를 스캔 또는 촬영하여 업로드 후, 등록 완료 버튼을 눌러 서류 제출을 완료해 주시기 바랍니다.</p>
                    </div>
                </div>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>비밀번호를 잊어버렸어요.</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>1. <a href='$gPartnersWeb' target='_blank'>http://partners.barotruck.com/</a> 에서 로그인 버튼 하단의 '비밀번호 찾기'를 클릭합니다.</p>
                        <p>2. 핸드폰 번호로 인증하기/이메일 주소로 인증하기 중 하나를 선택하여, 인증번호를 전송합니다.</p>
                        <p>3. 핸드폰/이메일로 도착한 인증번호를 확인한 후, '확인'을 선택합니다.</p>
                        <p>4. 인증번호를 입력 후, '비밀번호 재설정' 화면에서 비밀번호를 입력하여 변경하실 수 있습니다.</p>
                        <p>* 변경이 안될 경우, 고객센터로 문의해주세요.</p>
                        <br />
                        <p>고객센터 : <span class='txtNum'>1899-9585</span></p>
                    </div>
                </div>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>휴대폰 번호가 바뀌었어요. 어떻게 변경하나요?</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>이미 등록된 핸드폰 번호의 변경을 원하는 경우, 고객센터로 문의해주세요.</p>
                        <br />
                        <p>고객센터 : <span class='txtNum'>1899-9585</span></p>
                    </div>
                </div>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>'회원탈퇴는 어떻게 하나요?</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>1. 메뉴에서 '계정'을 선택한 후 '계약 해지'를 클릭합니다.</p>
                        <p>2. 계약 해지 유의사항을 읽어본 후, 신청 사유를 작성합니다.</p>
                        <p>3. 비밀번호 확인 란에 현재 사용 중인 비밀번호를 입력하고 '계약 해지 신청'을 클릭합니다.</p>
                        <br />
                        <p>등록하신 계약 해지 신청서는 확인 후, 계약 해지 사항에 대한 안내 또는 처리 완료 사항을 개별 안내드립니다.</p>
                    </div>
                </div>

                <div class='item'>
                    <h4 class='title'><span class='icon'>Q.&nbsp;</span><em>화물오더 등록은 어떻게 하나요?</em></h4>
                    <div class='detail' style='display:none;'>
                        <p>'화물등록'버튼을 선택합니다.</p>
                        <p>또는 왼쪽 메뉴의 '화물 등록' 메뉴를 선택하여 원하는 등록 방법을 선택하여 등록을 진행합니다.</p>
                    </div>
                </div>

            </section>

        </article>
        ";
    break;




    // privacy_policy.html
    case ("6") :
        echo "
        <div class='contents' id='contents'>
            $rResult[CONT]
        </div>
        ";
    break;




    // drivers_policy.html
    case ("7") :
        echo "
        <div class='contents' id='contents'>
            $rResult[CONT]
        </div>
        ";
    break;




    // partners_policy.html
    case ("8") :
        echo "
        <div class='contents' id='contents'>
            $rResult[CONT]
        </div>
        ";
    break;




    // index.html
    default :
        echo "
            <div class='contents' id='contents'>
                <ul class='who'>
                    <li class='drivers'>
                        <a href='./?md=1'>
                            <div class='desc'>
                                <div class='heading'>
                                    <h2>차주용</h2>
                                </div>
                                <p class='PC'>배차는 빠르게, 정산은 간편하게<br /> 공차가 줄어들수록 우리가 만드는<br /> 가치는 더욱 늘어납니다.</p>
                                <p class='MO'>배차는 빠르게, 정산은 간편하게</p>
                                <span class='button'>자세히 보기</span>
                            </div>
                        </a>
                    </li>
                    <li class='partners'>
                        <a href='./?md=2'>
                            <div class='desc'>
                                <div class='heading'>
                                    <h2>화주용</h2>
                                </div>
                                <p class='PC'>모두를 위한 물류 플랫폼<br /> 배차는 빨라지고,<br /> 번거로운 정산은 쉬워집니다.</p>
                                <p class='MO'>모두를 위한 물류 플랫폼</p>
                                <span class='button'>자세히 보기</span>
                            </div>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
        ";
    break;




}




if ($_REQUEST[md] < 6 || $_REQUEST[md]=="") { // 약관 쪽에는 footer가 없음
    include "./inc/footer.php";
}
?>
