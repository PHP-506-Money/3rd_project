
<div id="go-to-top">
    <a href="javascript:void(0);" onclick="scrollToTop();"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
</div>

<style>
    #go-to-top {
    position: fixed;
    width: 60px;
    height: 60px;
    right: 50px;
    bottom: 50px;
    border-radius: 50%;
    z-index: 500;
    overflow: hidden;
    }

    #go-to-top a {
    opacity: 0.8;
    display: inline-block;
    width: 100%;
    height: 100%;
    background-color: var(--main-color);
    }

    #go-to-top a .fa-chevron-up {
    z-index: 600;
    color: var(--sub-color);
    position: fixed;
    right: 72px;
    bottom: 72px;
    }

</style>

<div id="footer" class="wow fadeInUp">



    <div id="app_footer" class="app_sub_footer" style="display: none;">










        <div class="inner app_footer_ui">
            <ul class="app_footer_ui_list">
                <li onClick="history.back();"><img src="https://www.goobne.co.kr/resources/assets/images/app_icon/icon_05.png"></li>

                <li onClick="location.href='/store/search_store'"><img src="https://www.goobne.co.kr/resources/assets/images/app_icon/icon_04.png"></li>
                <li onClick="location.href='/index'"><img src="https://www.goobne.co.kr/resources/assets/images/app_icon/icon_03.png"></li>

                <li onClick="location.href='/account/login?return_url=/mypage/my_page'"><img src="https://www.goobne.co.kr/resources/assets/images/app_icon/icon_02.png"></li>


                <li class="sub-menu-btn"><img src="https://www.goobne.co.kr/resources/assets/images/app_icon/icon_01.png"></li>
            </ul>
        </div>
        <script>
            var userAgent = navigator.userAgent.toString();
            if ((/iPad|iPhone|iPod/.test(userAgent) || userAgent.toLowerCase().indexOf('android') != -1) && !window
                .MSStream) { // 모바일앱
                $("#app_footer").css("display", "");
                $("#logo").css("display", "none");
                $("#applogo").css("display", "");

            } else {
                $("#app_footer").css("display", "none");
                $("#logo").css("display", "");
                $("#applogo").css("display", "none");
            }

        </script>

    </div>
    <div class="inner">
        <div class="info-box">
            <div class="number">
                <ul class="inline_block">
                    <li>
                        <p class="sub-text">전화문의 </p>
                        
                    </li>
                    <li>
                        <p class="tel">1234-1234</p>

                    </li>
                
                </ul>
            </div>
            <div class="info-btn">
                <a href="#" class="terms">이용약관</a>
                <a href="#" class="privacy">개인정보처리방침</a>
                <a href="#" class="e_mail">이메일 무단수집 거부</a>
                <a href="/directions">찾아오시는 길</a>
            </div>
            <div class="sns-box">
                <a href="#" target="_blank" class="instar"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="#" target="_blank" class="facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                <a href="#" target="_blank" class="youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>

            </div>
            <div class="number">
                <ul class="inline_block">
                    <li>
                        <p class="sub-text">팀 돈맡겨주시조 </p>
                    </li>
                    <li>
                        <p class="sub-text"><a href="https://github.com/EunyoungSin" class="fa fa-github" style="font-size:17px; font-weight:bold;">신은영 </a> <a href="https://github.com/Headh1" class="fa fa-github" style="font-size:17px; font-weight:bold;">김진아 </a> </p>
                    </li>
                    <li>
                        <p class="sub-text"><a href="https://github.com/snoh6839" class="fa fa-github" style="font-size:17px; font-weight:bold;">노수빈 </a> <a href="https://github.com/Choihyukjae" class="fa fa-github" style="font-size:17px; font-weight:bold;">최혁재 </a> </p>



                    </li>

                </ul>
            </div>

        </div>
        <div class="text-box">
            <div class="info-list">
                <p class="text-list">팀 돈맡겨주시조: 신은영 김진아 노수빈 최혁재</p>
                <p class="text-list">주소 대구광역시 그린아트컴퓨터학원</p>
                <p class="text-list">TEL 053-572-1005</p>
                <p class="text-list">FAX 053-422-9122</p>
                <p class="text-list">광고 제휴 문의 fin.matee@gmail.com</p>
            </div>
            <p class="copyright">© 2023 FIN.MATE.ALL RIGHT RESERVED</p>
        </div>
    </div>
    <form name="goBrdFrom" id="goBrdFrom" method="post">
        <input type="hidden" name="seq">
    </form>

    <form name="loginnet" target="gnordernet" method="post">
        <input type="hidden" name="useridxnet" id="useridxnet" value="null" />
        <input type="hidden" name="useridnet" id="useridnet" value="null" />
        <input type="hidden" name="userlevelnet" id="userleveldnet" value="null" />
        <input type="hidden" name="userbranchnet" id="userbranchdnet" value="" />
        <input type="hidden" name="userurl" id="userurl" value="/order/delivery.aspx" />
    </form>

    <form name="goDeliveryFrom" id="goDeliveryFrom" method="get">
        <input type="hidden" id="myloc" name="myloc">
        <input type="hidden" id="m_myloc" name="m_myloc">
        <input type="hidden" id="br_id" name="br_id">
    </form>
    <form name="goCartForm" id="goCartForm" method="get">
        <input type="hidden" id="user_id" name="user_id">
    </form>









    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>FINMATE</title>



    <script type="text/javascript">
        /* 공통코드조회 selectbox*/
        getCodeListSelBox = function(obj, param, firstOpt, defaultVal) {
            jQuery.ajax({
                type: "POST"
                , url: "/code/getAjaxCodeList"
                , data: param
                , dataType: "json"
                , success: function(data) {
                    fnCodeListSettingSelBox(data, obj, firstOpt, defaultVal);
                }
            });
        };

        //selectbox 코드값 셋팅 
        fnCodeListSettingSelBox = function(data, obj, firstOpt, defaultVal) {
            var cdCheck = false;
            var optionObj = "";
            //obj.empty();
            if (firstOpt != "" && firstOpt != null) {
                optionObj += '<option value="">' + firstOpt + '</option>';
            }
            $.each(data, function() {
                optionObj += '<option value="' + this.type_id + '">' + this.type_name + '</option>';
            });
            obj.html(optionObj);
            if (defaultVal != "" && defaultVal != null) {
                obj.val(defaultVal).prop("selected", true);
            }
            obj.niceSelect("update");
        };

        //전체선택 (클릭chk id ,전체선택될 chk name)
        fnAllChk = function(id, name) {
            if ($("#" + id).prop("checked")) {
                //input태그의 name이 chk인 태그들을 찾아서 checked옵션을 true로 정의
                $("input[name=" + name + "]").prop("checked", true);
                //클릭이 안되있으면
            } else {
                //input태그의 name이 chk인 태그들을 찾아서 checked옵션을 false로 정의
                $("input[name=" + name + "]").prop("checked", false);
            }
        };

        //paging html 
        createPagingHTML = function(intThisPage, intTotalCnt, intListCnt, strFunctionName, intPagingCnt) {
            var thisPage = parseInt(intThisPage);
            var LastPage = Math.ceil(intTotalCnt / intListCnt);
            var strPaging = "";

            if (intPagingCnt == '' || intPagingCnt == "undefined" || intPagingCnt == undefined || intPagingCnt ==
                null) {
                intPagingCnt = 10;
            }
            var thisPagingCnt = parseInt(intPagingCnt);


            if (thisPage - 1 > 0) {
                strPaging = '<button type="button" onclick="' + strFunctionName + '(\'' + (thisPage - 1).toString() +
                    '\');"><img src="https://cdn.goob-ne.com/goobne/resources/assets/images/icon/chevron-double-left.svg" style="width:20px;"></button>';
            } else {
                strPaging =
                    '<button type="button"><img src="https://cdn.goob-ne.com/goobne/resources/assets/images/icon/chevron-double-left.svg" style="width:20px;"></button>';
            }
            if (LastPage == 0) {
                strPaging = strPaging + '<button type="button" class="is-active">' + thisPage + '</button>';
                strPaging = strPaging +
                    '<button type="button"><img src="https://cdn.goob-ne.com/goobne/resources/assets/images/icon/chevron-double-right.svg" style="width:20px;"></button>';
            } else {
                var intX = parseInt((thisPage - 1) / thisPagingCnt);
                var intMOD = thisPage;
                if (intMOD == 0) {
                    intX = intX - 1;
                }
                for (var j = 1 + (intX * thisPagingCnt); j < thisPagingCnt + (thisPagingCnt * intX) + 1; j++) {
                    if (j <= LastPage) {
                        if (j == thisPage) {
                            strPaging = strPaging + '<button type="button" class="is-active">' + thisPage + '</button>';
                        } else {
                            strPaging = strPaging + '<button type="button" onclick="' + strFunctionName + '(\'' + j
                                .toString() + '\');">' + j.toString() + '</button>';
                        }
                    }
                }
                if (thisPage + 1 <= LastPage) {
                    strPaging = strPaging + '<button type="button" onclick="' + strFunctionName + '(\'' + (thisPage + 1)
                        .toString() +
                        '\');"><img src="https://cdn.goob-ne.com/goobne/resources/assets/images/icon/chevron-double-right.svg" style="width:20px;"></button>'

                } else {
                    strPaging = strPaging +
                        '<button type="button"><img src="https://cdn.goob-ne.com/goobne/resources/assets/images/icon/chevron-double-right.svg" style="width:20px;"></button>';
                }
            }
            return strPaging;
        }

        toHtml = function(str) {
            var returnText = str;
            returnText = returnText.replace(/&nbsp;/gi, " ");
            returnText = returnText.replace(/&amp;/gi, "&");
            returnText = returnText.replace(/&quot;/gi, '"');

            returnText = returnText.replace(/&lt;/gi, '<');
            returnText = returnText.replace(/&gt;/gi, '>');
            returnText = returnText.replace(/\r\n|\n|\r/g, '<br />');
            return returnText;
        }

        function siteinfo(id, os) {
            var url = "/getAppInfo";
            var obj = new Object();
            obj.site_id = id;
            obj.site_os = os;
            console.log("obj===>>>" + obj);
            var jsonData = JSON.stringify(obj);
            ajaxCall(url, jsonData, siteInfoCallBack, errorCallBack, 'siteinfo'); //alert 
        }

        function siteInfoCallBack(obj) {}

    </script>



    <script type="text/javascript">
        /*gps 전역변수 */
        var lat;
        var lon;
        $(document).ready(function() {
            //위치 표시, 선택한 매장이 없는 경우만 현위치 정보를 호출한다. 
            lat = getCookie("lat");
            lon = getCookie("lon");
            if (lat != null && lat != '' && lat != '""') { //쿠키값이 " 넘어오는 경우가 발생됨
                findLocation(lat, lon);
            } else {
                geoloc.init();
            }

            $(".selectpicker").niceSelect();

            // 이용약관 내용보기 버튼 
            $('.terms').click(function() {
                $(".dimmed-bg").removeClass("l-hidden");
                $(".terms-moadl").removeClass("l-hidden");
            });

            // 개인정보 관련 내용보기 버튼 
            $('.privacy').click(function() {
                $(".dimmed-bg").removeClass("l-hidden");
                $(".privacy-moadl").removeClass("l-hidden");
            });

            // 이메일무단수집거부 내용보기 버튼 
            $('.e_mail').click(function() {
                $(".dimmed-bg").removeClass("l-hidden");
                $(".e_mail-moadl").removeClass("l-hidden");
            });

            // 팝업 닫기 버튼 구현
            function closePopupFunc() {
                $(".dimmed-bg").addClass("l-hidden");
                $(".terms-moadl").addClass("l-hidden");
                $(".privacy-moadl").addClass("l-hidden");
                $(".e_mail-moadl").addClass("l-hidden");
                $(".promo-moadl").addClass("l-hidden");
            }
            // 팝업 닫기 버튼 구현
            function closePopupFunc() {
                $(".dimmed-bg").addClass("l-hidden");
                $(".terms-moadl").addClass("l-hidden");
                $(".privacy-moadl").addClass("l-hidden");
                $(".e_mail-moadl").addClass("l-hidden");
                $(".promo-moadl").addClass("l-hidden");
            }
            var closeBtnElem = document.querySelectorAll(".closeBtn");

            $(closeBtnElem).each(function() {
                this.addEventListener('click', closePopupFunc);
            });
        });

        //현재 위치 받아오기 
        var geoloc = {
            init: function() {
                if ('geolocation' in navigator) {
                    /* 지오로케이션  */
                    navigator.geolocation.getCurrentPosition(geoloc.success, geoloc.error);
                } else {
                    /* 지오로케이션 불가능 */
                    alert('geolocationx');
                    alert('현재  브라우저는 지오로케이션을 지원하지 않습니다. \r배달주소지를 설정해주세요.');
                    $('#myloc').attr('placeholder', '가까운 매장 보기'); //pc
                    $('#m_myloc').attr('placeholder', '가까운 매장 보기'); //모바일 
                }
            }
            , success: function(position) {
                var latitude = position.coords.latitude; //위도
                var longitude = position.coords.longitude; //경도 
                lat = latitude;
                lon = longitude;
                findLocation(latitude, longitude);
            }
            , error: function(err) {
                var userAgent = navigator.userAgent.toString();
                if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) { // iOS
                    //alert('아이폰 > 설정 > 개인정보보호 > 위치서비스 > 굽네치킨의 위치접근허용을 체크해주세요.');
                    $('#myloc').attr('placeholder', '가까운 매장 보기'); //pc
                    $('#m_myloc').attr('placeholder', '가까운 매장 보기'); //모바일 
                    //return;
                } else {
                    //alert('위치접근허용을 승인해주세요.'); 
                    $('#myloc').attr('placeholder', '가까운 매장 보기'); //pc
                    $('#m_myloc').attr('placeholder', '가까운 매장 보기'); //모바일  
                    //return; 
                }
            }
        }

        function findLocation(lat, lon) {
            var url = "/getXyAddr";
            var obj = new Object();
            obj.longitude = lon;
            obj.latitude = lat;
            var jsonData = JSON.stringify(obj);
            ajaxCall(url, jsonData, locationCallBack, errorCallBack, '주소호출'); //alert 
        }

        function locationCallBack(obj) {
            if (obj.result == common._trans_success_code) {
                $('#myloc').attr('placeholder', obj.body.addr); //pc
                $('#m_myloc').attr('placeholder', obj.body.addr); //모바일 
                $('#myloc').val(obj.body.addr);
                $('#m_myloc').val(obj.body.addr);
                $('#myLocMenu').text(obj.body.addr);
            }
        }

        function deliveryStore() {

            location.href = "/account/login?return_url=/delivery/delivery_list";

        }

        function saleStore(xloc, yloc) {
            var url = "/promo/Store";
            var obj = new Object();
            obj.yloc = yloc;
            obj.xloc = xloc;
            obj.distance = 5;
            var jsonData = JSON.stringify(obj);
            ajaxCall(url, jsonData, promoCallBack, errorCallBack, '프로모션매장호출'); //alert
        }

        function promoStore() {
            var url = "/promo/Store";
            var obj = new Object();
            if ((lat != null || lat != '') && lat != '""') { //쿠키값이 " 넘어오는 경우가 발생됨
                obj.yloc = lon;
                obj.xloc = lat;
            }
            obj.distance = 5;
            var jsonData = JSON.stringify(obj);
            ajaxCall(url, jsonData, promoCallBack, errorCallBack, '프로모션매장호출'); //alert
        }

        function promoCallBack(obj) {
            if (obj.result == common._trans_success_code) {
                var promList = obj.body.promostore.promolist;
                var dlvcount = obj.body.dlvcount;
                var promoHtml = "";
                var deliveryHtml = "";
                if (promList.length > 0) {
                    for (var i = 0; i < promList.length; i++) {
                        var promoObj = promList[i];

                        if (promoObj.br_id == '1999991') {



                        } else {

                            var dlv_amt = 0;
                            if (promoObj.distance < 1) {
                                dlv_amt = promoObj.dlv_amt1;
                            } else if (promoObj.distance > 1 && promoObj.distance < 2) {
                                dlv_amt = promoObj.dlv_amt2;
                            } else if (promoObj.distance > 2 && promoObj.distance < 3) {
                                dlv_amt = promoObj.dlv_amt3;
                            } else if (promoObj.distance > 3) {
                                dlv_amt = promoObj.dlv_amt4;
                            }

                            //배달비 설정이 안된 매장은 비노출 
                            if (dlv_amt != null) {
                                promoHtml += "<div class='list'>\n";
                                var offclass = 'red';
                                if (promoObj.off_day == "Y") {
                                    offclass = 'bk';
                                }
                                promoHtml += "<div class='icon " + offclass + "'></div>\n";
                                promoHtml += "<div class='desc'>\n";
                                promoHtml += "<dl>\n";
                                promoHtml += "<dt class='name'>" + promoObj.br_name + " ";
                                if (promoObj.distance != null) promoHtml += "<span class='l-num'>(" + promoObj.distance +
                                    "km)</span>";
                                promoHtml += "</dt>\n";
                                promoHtml += "<dd class='local'>" + promoObj.address + "</dd>\n";
                                promoHtml += "<dd class='num'>" + promoObj.tel1 + "</dd>\n";
                                promoHtml += "</dl>\n";

                                //promoHtml += "<p class='promo'><span class='l-num'>#</span>수요일 방문 포장 <span class='l-num'>50%</span> 할인</p>\n";
                                promoHtml += "<div class='msg'>\n";
                                promoHtml += "<div class='msg-line'>\n";
                                promoHtml += "<span>1km 배달비 : " + numberFormatComma(promoObj.dlv_amt1) + "원</span>\n";
                                promoHtml += "<span class='bar'></span>\n";
                                promoHtml += "<span>포장주문 할인금액 : " + numberFormatComma(promoObj.pack_amt) + "원</span>\n";
                                promoHtml += "</div>\n";
                                promoHtml += "<div class='msg-line'>\n";
                                if (promoObj.dlv_time != null) {
                                    promoHtml += "<span>배달주문 준비시간 : " + promoObj.dlv_time + "분</span>\n";
                                    promoHtml += "<span class='bar'></span>\n";
                                }
                                if (promoObj.pack_time != null) {
                                    promoHtml += "<span>포장주문 준비시간 : " + promoObj.pack_time + "분</span>\n";
                                }
                                promoHtml += "</div>\n";
                                promoHtml += "</div>\n";

                                promoHtml += "<div class='icon-list'>\n"; //이쿠폰, 금액권, 온라인주문 가능 표시
                                var ecouponClass = "disabled";
                                if (promoObj.ecoupon_yn == 'Y') {
                                    ecouponClass = ""
                                }
                                promoHtml += "<button type='button' class='l-coupon " + ecouponClass +
                                    "' alt='e-coupon가능' title='e-coupon'></button>\n";
                                var ecashClass = "disabled";
                                if (promoObj.cashecoupon_yn == 'Y') {
                                    ecashClass = ""
                                }
                                promoHtml += "<button type='button' class='l-receipt " + ecashClass +
                                    "' alt='금액권가능' title='금액권'></button>\n";
                                /* if( promoObj.online_yn == 'Y' ) promoHtml += "<button type='button' class='l-cart' alt='온라인주문가능' title='퀵포장'></button>\n"; */
                                promoHtml += "</div>\n";
                                promoHtml += "</div>\n";
                                if (promoObj.online_yn == 'Y') { //온라인주문이 가능한 매장일때만 노출
                                    promoHtml += "<div class='btn'>\n";

                                    //promoHtml += "<button type='button' class='like is-active' onclick=\"selStore(\'"+promoObj.br_id+"\')\">메뉴보기</button>\n";

                                    //promoHtml += "<button type='button' class='chk' onClick='goDeliverySave()'>배달주문</button>\n";
                                    //promoHtml += "<button type='button' class='like is-active' onClick='packageSave(\"" +  promoObj.br_id + "\",\"" + promoObj.address+ "\")'><i class='star'></i>포장주문</button>\n";

                                    promoHtml += "<button type='button' class='chk' onClick=selectAddr('" + promoObj.br_id +
                                        "');><img src='https://cdn.goob-ne.com/goobne/resources/assets/images/icon/order_icon_01_on.svg' class='order_icon_img'>주문하기</button>\n";
                                    promoHtml += "</div>\n";
                                }
                                promoHtml += "</div>\n";
                            }

                        }

                    }

                    if (dlvcount <= 1) {
                        deliveryHtml =
                            "<div class='delivery_set_get'><div class='delivery_set_text'>배달 받을 주소를 등록 하시면<br> 가까운 매장을 정확하게 설정 할 수 있어요!</div>\n";
                        deliveryHtml +=
                            "<button type='button' onclick='location.href=\"/account/login\"'><img src='https://cdn.goob-ne.com/goobne/resources/assets/images/icon/delivery_set_icon.svg' class='delivery_set-img'>배달주소등록</button></div>\n";
                    }
                }
                $('#promo_bg').removeClass('l-hidden');
                $('#promo').removeClass('l-hidden');
                $('#promoList').empty();
                $('#deliveryArea').empty();
                $('#deliveryArea').html(deliveryHtml);
                $('#promoList').html(promoHtml);
            }
        }

        //배달주문 등록
        function goDeliverySave() {
            document.goDeliveryFrom.myloc.value = $('#myloc').val();
            document.goDeliveryFrom.action = '/delivery/delivery_list';
            document.goDeliveryFrom.submit();
        }

        //포장주문 등록
        function packageSave(br_id, address) {
            var obj = new Object();
            obj.dlv_type = '20';
            obj.br_id = br_id;
            obj.address1 = address;

            var url = '/delivery/deliveryCheck'
            var data = JSON.stringify(obj);

            ajaxCall(url, data, checkCallBack, errorCallBack, "[중복체크]");
        }

        function checkCallBack(obj) {
            var result = obj.body.result;
            var br_id = obj.body.deliveryDTO.br_id;
            var address1 = obj.body.deliveryDTO.address1;
            var dlv_type = obj.body.deliveryDTO.dlv_type;

            var obj = new Object();
            obj.dlv_type = dlv_type;
            obj.br_id = br_id;
            obj.address1 = address1;

            if (result == "1") {
                alert("이미 등록 매장 주소입니다.");
                return;
            }
            if (result == "10") {
                alert("최대 10개까지 등록 가능합니다.");
                return;
            }
            if (dlv_type == '10') {
                if (result == "FAIL") {
                    alert("최대 10개까지 등록 가능합니다.");
                    return;
                }
            }
            if (result == "OK") {
                var url = '/delivery/packageSave'
                var data = JSON.stringify(obj);

                ajaxCall(url, data, packageCallBack, errorCallBack, "[포장주문 등록]");
            }
        }

        function packageCallBack(obj) {
            window.location.href = "/delivery/package_list";
        }

        function selStore(bid) {
            var url = "/promo/selStore";
            var obj = new Object();
            obj.br_id = bid;
            var jsonData = JSON.stringify(obj);
            ajaxCall(url, jsonData, selStoreCallBack, errorCallBack, '매장선택'); //alert  
        }

        //메뉴페이지에서 결과처리
        function selStoreCallBack(obj) {
            if (obj.result == common._trans_success_code) {
                var br_id = obj.body.br_id;
                console.log("매장선택 session 생성완료,선택매장 =>" + br_id);
                $('#promo_bg').addClass('l-hidden');
                $('#promo').addClass('l-hidden');

                location.href = "/menu/menu_main";
            }
        }
        // 게시판 상세링크
        function goBrdView(brd_id, seq) {
            document.goBrdFrom.seq.value = seq;
            document.goBrdFrom.action = '/brd/' + brd_id + '/view';
            document.goBrdFrom.submit();
        }


        function loginnet(urlstr) {
            if (urlstr == "") {
                urlstr = "/order/delivery.aspx";
            }
            $("#userurl").val(urlstr);
            var ofrm = document.loginnet;
            ofrm.action = "https://order.goobne.co.kr:8481/auth/authdt.aspx";
            ofrm.submit();
        }

        function goCart() {

            NetFunnel_Action({
                action_id: "goobne_02"
                , cookie_id: 'NetFunnel_ID2'
            }, function() {
                var cart_br_id = getCookie("cart_br_id");

                if (cart_br_id == "" || cart_br_id == "null") {
                    window.location.href = "/delivery/delivery_list";
                } else {
                    document.goCartForm.user_id.value = "null";
                    document.goCartForm.action = '/cart/cart_list'
                    document.goCartForm.submit();
                }
            });
        }

    </script>
</div>

<script>
    function scrollToTop() {
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    }
    </script>



