        <footer class="footer">
            <div class="inner">
                <div class="gFlow">
                    <h2 class="copy">&copy; 2018. (주)씨오디랩스</h2>
                    <ul>
                        <li>(주)씨오디랩스</li>
                        <li>사업자 등록번호: <span class="txtNum"><?=$gCompanyBizNo?></span></li>
                        <li>대표이사: 박진홍</li>
                    </ul>
                    <ul>
                        <li>통신판매업신고번호: <?=$gCompanyComNo?></li>
                        <li>화물자동차운송주선사업허가증: <?=$gCompanyBrokerNo?></li>
                        <li>개인정보보호책임자: 강다혁</li>
                    </ul>
                    <p class="address"><?=$gCompanyAddress?></p>
                    <ul class="contact">
                        <li>대표전화: <a href="tel:18999585" class="txtNum"><?=$gCompanyPhoneNo?></a></li>
                        <li>팩스: <span class="txtNum"><?=$gCompanyWebFaxNo?></span></li>
                    </ul>
                </div>
                <div class="gReverse">
                    <ul>
                        <li><a href="<?=$gPrivacyPolicyPageURL?>" target="_blank" title="새창에서 보기"><strong>개인정보 처리방침</strong></a></li>
                        <li><a href="<?=$gDriversPolicyPageURL?>" target="_blank" title="새창에서 보기">이용약관</a></li>
                        <li><a href="tel:<?=$gCompanyPhoneNo?>" title="고객센터에 문의하기">고객센터</a></li>
                    </ul>
                </div>
            </div>
        </footer>

    </div>

</body>
</html>

<?php
if ($_SERVER[PHP_SELF] == "/index.html") { // 인덱스 일때만
        echo "
        <!-- layer -->
        <section class='layer layerEvent' id='layerEvent'>
            <div class='inner'>
                <div class='content'>
                    <a href='http://www.barotruck.com/event/signup/' class=''>
                        <img src='../images/popup/img_event_signup.png' alt='바로트럭 차주앱 오픈 이벤트 골드바, 갤럭시노트9 받자!' class='PC' />
                        <img src='../images/popup/img_event_signup_mo.png' alt='바로트럭 차주앱 오픈 이벤트 골드바, 갤럭시노트9 받자!' class='MO' />
                    </a>
                </div>

                <div class='footer'>
                    <a href='javascript:;' class='btnClose eClose'><img src='./images/btn_close_wh.png' alt='레이어 닫기'/></a>
                </div>
            </div>
            <span class='blank'></span>
        </section>

        <script>
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
            });

        </script>
        ";
}
?>
