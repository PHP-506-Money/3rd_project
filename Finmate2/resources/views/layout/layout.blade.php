<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:url" content="http://192.168.0.110/main">
    <meta property="og:type" content="website">
    <meta property="og:title" content="페이지 제목">
    <meta property="og:description" content="페이지 설명">
    <meta property="og:image" content="이미지 URL">

    <link rel="shortcut icon" href="/resources/images/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="/resources/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/resources/images/favicon.png" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','FIN.MATE')</title>
    {{-- <link href="{{ asset('/css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('/img/favicon3.png') }}">

    <link rel="stylesheet" href="/resources/assets/css/common/slick.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/common/swiper-bundle.min.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/common/base.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/common/header.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/common/footer.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/common/jquery-ui.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/common/animate.css?v=202307061208" type="text/css" />

    <!-- main  -->
    <link rel="stylesheet" href="/resources/assets/css/main/main.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/modal.css?v=202307061208" type="text/css" />
    <!-- sub  -->
    <link rel="stylesheet" href="/resources/assets/css/common_layout.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/layout.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/common/nice-select.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/common_v1.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/login_out.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/main/popup_main.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/verification_code.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/my_page.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/level.css?v=202307061208" type="text/css" />
    <link rel="stylesheet" href="/resources/assets/css/app_ui.css?v=202307061208" type="text/css" />
    <!---app_ui추가--->

    <script src="/resources/assets/js/common/jquery-3.5.1.min.js"></script>
    <script src="/resources/assets/js/common/swiper-bundle.min.js"></script>
    <script src="/resources/assets/js/common/jquery.js"></script>
    <script src="/resources/assets/js/common/jquery-ui.js"></script>
    <script src="/resources/assets/js/common/slick.js"></script>
    <script src="/resources/assets/js/common/wow.min.js"></script>
    <script src="/resources/assets/js/main/main_banner_header.js?v=202307061208"></script>
    <script src="/resources/assets/js/main/main.js?v=202307061208"></script>
    <script src="/resources/assets/js/common/all_checkbox.js?v=202307061208"></script>

    <script src="/resources/assets/js/common/jquery.nice-select.js"></script>

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

            if (intPagingCnt == '' || intPagingCnt == "undefined" || intPagingCnt == undefined || intPagingCnt == null) {
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


    <!--  dev 커스텀 -->
    <link rel="stylesheet" href="/resources/css/style.css?v=202307061208" type="text/css" />
    <script src="/resources/js/common.js"></script>
    <script src="/resources/js/file_common.js"></script>
    <script src="/resources/assets/js/common/file_upload.js"></script>
    <script src="/resources/js/jquery.form.js"></script>

    <!-- 약관 영역  -->
    <article class="modal-cnt-wrapper terms-moadl l-hidden">

        <!-- 이용약관 팝업 영역  -->
        <div class="dimmed-bg l-hidden"></div>
        <div class="modal-cnt-area find-cnt-area terms-cnt-width">
            <button type="button" class="close closeBtn"><img src="https://cdn.goob-ne.com/goobne/resources/assets/images/icon/m-close.svg" alt="닫기버튼"></button>
            <div class="shopping-address-wrap terms-cnt-wrapper">
                <div class="l-m-tit">이용약관</div>
                <div class="textarea">
                    <textarea readonly class="l-scroll-style">

            
                </textarea>
                </div>
            </div>
        </div>
    </article>
    <article class="modal-cnt-wrapper privacy-moadl l-hidden">



        <div class="dimmed-bg l-hidden"></div>
        <div class="modal-cnt-area find-cnt-area terms-cnt-width">
            <button type="button" class="close closeBtn"><img src="https://cdn.goob-ne.com/goobne/resources/assets/images/icon/m-close.svg" alt="닫기버튼"></button>
            <div class="shopping-address-wrap terms-cnt-wrapper">
                <div class="l-m-tit">개인정보 수집 및 이용 동의</div>
                <div class="textarea">
                    <textarea readonly class="l-scroll-style">

                </textarea>
                </div>
                <!-- <div class="l-com-area">
                        <button type="button" class="l-btn line closeBtn">취소</button>
                        <button type="submit" class="l-btn closeBtn">동의하기</button>
                    </div> -->
            </div>
        </div>
    </article>
    <article class="modal-cnt-wrapper e_mail-moadl l-hidden">



        <div class="dimmed-bg l-hidden"></div>
        <div class="modal-cnt-area find-cnt-area terms-cnt-width">
            <button type="button" class="close closeBtn"><img src="https://cdn.goob-ne.com/goobne/resources/assets/images/icon/m-close.svg" alt="닫기버튼"></button>
            <div class="shopping-address-wrap terms-cnt-wrapper">
                <div class="l-m-tit">이메일수집거부</div>
                <div class="textarea">
                    <textarea readonly class="l-scroll-style">

            
                </textarea>
                </div>
            </div>
        </div>
    </article>
    <article class="modal-cnt-wrapper map_agree-moadl l-hidden">




        <!-- 배송지 설정 팝업 영역  -->
        <article class="modal-cnt-wrapper map_agree-moadl l-hidden">
            <div class="dimmed-bg l-hidden"></div>
            <div class="modal-cnt-area find-cnt-area adderss-cnt-width">
                <button type="button" class="close closeBtn"><img src="https://cdn.goob-ne.com/goobne/resources/assets/images/icon/m-close.svg" alt="닫기버튼"></button>
                <div class="shopping-address-wrap terms-cnt-wrapper">
                    <div class="l-m-tit">위치기반 서비스 이용약관</div>
                    <div class="textarea">
                        <div class="l-scroll-style">
                           
                            <table width="100%" cellspacing="0" class="popup_table">

                                <thead>
                                    <tr>
                                        <th scope="col">서비스 내용</th>
                                        <th scope="col">서비스 대상</th>
                                        <th scope="col">비고</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                    </tr>
                                    <tr>
      
                                    </tr>

                                </tbody>
                            </table>



        
                            <table width="100%" cellspacing="0" class="popup_table">

                                <thead>
                                    <tr>
                                        <th scope="col">수탁자</th>
                                        <th scope="col">위탁범위</th>
                                        <th scope="col">제공정보</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                    </tr>
                                    <!--<tr>
		<td class="td_center">㈜스파코사</td>
		<td>- 드라이빙 픽업 이용시 이용자의 매장 도착정보 알림</td>
		<td>위치정보,휴대전화번호, 고객이 입력한 차량정보 (차종설명, 차량번호 등)</td>
	</tr>-->
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </article>
        <!-- // 배송지 설정 팝업 영역  -->

        <!-- end of :: wrap -->
        <script>
            $(document).ready(function() {


                // 팝업 닫기 버튼 구현
                function closePopupFunc() {
                    $(".map_agree-moadl").addClass("l-hidden");
                }
                const closeBtnElem = document.querySelectorAll(".closeBtn");
                closeBtnElem.forEach(e => e.addEventListener('click', closePopupFunc));

                //tab 탭
                var $tabblink = $(".delivery_tab_list_small li").click(function() {
                    var idx = $tabblink.index(this);
                    $(".delivery_tab_list_small li").removeClass("tab_on");
                    $(".delivery_tab_list_small li").eq(idx).addClass("tab_on");
                    $(".tab_content > .delivery_tab_content_list").removeClass("tab_content_on")
                    $(".tab_content > .delivery_tab_content_list").eq(idx).addClass("tab_content_on");
                });



            });

        </script>

    </article>
    <article class="modal-cnt-wrapper e_coupon-moadl l-hidden">



        <!-- end of :: wrap -->
        <script>
            $(document).ready(function() {


                // 팝업 닫기 버튼 구현
                function closePopupFunc() {
                    $(".e_coupon-moadl").addClass("l-hidden");
                }
                const closeBtnElem = document.querySelectorAll(".closeBtn");
                closeBtnElem.forEach(e => e.addEventListener('click', closePopupFunc));

                //tab 탭
                var $tabblink = $(".delivery_tab_list_small li").click(function() {
                    var idx = $tabblink.index(this);
                    $(".delivery_tab_list_small li").removeClass("tab_on");
                    $(".delivery_tab_list_small li").eq(idx).addClass("tab_on");
                    $(".tab_content > .delivery_tab_content_list").removeClass("tab_content_on")
                    $(".tab_content > .delivery_tab_content_list").eq(idx).addClass("tab_content_on");
                });



            });

        </script>
    </article>
    <!-- // 약관 영역  -->

    <!-- 프로모션 팝업 영역  -->
    <article id="promo" class="modal-cnt-wrapper promo-moadl l-hidden">



        <style>
            .promo_info_text {
                font-size: 13px;
                color: #c44830;
                text-align: left;
                font-weight: 600;
                line-height: 1.3;
            }

            .promo_info_text br {
                display: none;
            }

            @media (max-width: 500px) {
                .modal-cnt-wrapper .adderss-cnt-width {
                    height: auto;
                }

                .promo_info_text {
                    text-align: center;
                }
            }

            @media (max-width: 375px) {
                .promo_info_text br {
                    display: block;
                }
            }

        </style>
        <div id="promo_bg" class="dimmed-bg l-hidden"></div>
        <div class="modal-cnt-area find-cnt-area adderss-cnt-width">
            <button type="button" class="close closeBtn"><img src="https://cdn.goob-ne.com/goobne/resources/assets/images/icon/m-close.svg" alt="닫기버튼"></button>
            <div class="shopping-address-wrap">

                <div class="l-m-tit">가까운 매장</div>

                <!--S: 추가된 부분 --->
                <div id="deliveryArea"></div>
                <!--E: 추가된 부분 --->

                <!-- <div class="search-list-area mt" style="padding-top:20px;">-->
                <div class="promo_info_text">※준비시간은 매장상황에 따라 다르게<br> 안내될 수 있습니다.</div>
                <div class="search-list-area mt">

                    <div class="result-num">
                        <!-- 현재위치의 주소와 가까운 매장입니다. -->
                    </div>

                    <div class="result-list l-scroll-style" id="promoList">
                        <div class="list">
                            <div class="icon bk"></div>
                            <div class="desc">
                                <dl>
                                    <dt class="name">행당점 (0.4km)</dt>
                                    <dd class="local">서울특별시 성동구 행당로 79 해당텍스트 2
                                        줄 까지 노출됩니다.해당텍스트 2
                                    </dd>
                                    <dd class="num">02-2294-9294</dd>
                                </dl>
                                <p class="promo"><span class="l-num">#</span>수요일 방문 포장 <span class="l-num">50%</span> 할인
                                </p>
                                <div class="msg">
                                    <div class="msg-line">
                                        <span>1km 배달비 : 5,000원</span>
                                        <span class="bar"></span>
                                        <span>최소주문금액 : 15,000원</span>
                                    </div>
                                    <div class="msg-line">
                                        <span>예상 주문시간 : 1hour</span>
                                        <span class="bar"></span>
                                        <span>드라이브 픽업 : 가능</span>
                                    </div>
                                </div>
                                <div class="icon-list">
                                    <button type="button" class="l-coupon"></button>
                                    <button type="button" class="l-receipt"></button>
                                    <button type="button" class="l-cart"></button>
                                </div>
                            </div>
                            <div class="btn">
                                <button type="button" class="chk">선택하기</button>
                                <button type="button" class="like is-active"><i class="star"></i>찜하기</button>
                            </div>
                        </div>
                        <div class="list">
                            <div class="icon red"></div>
                            <div class="desc">
                                <dl>
                                    <dt class="name">성수 1호점</dt>
                                    <dd class="local">서울특별시 성동구 행당로 79 해당텍스트 2
                                        줄 까지 노출됩니다.
                                    </dd>
                                    <dd class="num">02-2294-9294</dd>
                                </dl>
                                <p class="promo"><span class="l-num">#</span>수요일 방문 포장 <span class="l-num">50%</span> 할인
                                </p>
                                <div class="msg">
                                    <div class="msg-line">
                                        <span>1km 배달비 : 5,000원</span>
                                        <span class="bar"></span>
                                        <span>최소주문금액 : 15,000원</span>
                                    </div>
                                    <div class="msg-line">
                                        <span>예상 주문시간 : 1hour</span>
                                        <span class="bar"></span>
                                        <span>드라이브 픽업 : 가능</span>
                                    </div>
                                </div>
                                <div class="icon-list">
                                    <button type="button" class="l-coupon"></button>
                                    <button type="button" class="l-receipt"></button>
                                    <button type="button" class="l-cart"></button>
                                </div>
                            </div>
                            <div class="btn">
                                <button type="button" class="chk">선택하기</button>
                                <button type="button" class="like"><i class="star"></i>찜하기</button>
                            </div>
                        </div>
                        <div class="list">
                            <div class="icon bk"></div>
                            <div class="desc">
                                <dl>
                                    <dt class="name">상왕십리역점</dt>
                                    <dd class="local">서울특별시 성동구 행당로 79</dd>
                                    <dd class="num">02-2294-9294</dd>
                                </dl>
                                <p class="promo"><span class="l-num">#</span>수요일 방문 포장 <span class="l-num">50%</span> 할인
                                </p>
                                <div class="msg">
                                    <div class="msg-line">
                                        <span>1km 배달비 : 5,000원</span>
                                        <span class="bar"></span>
                                        <span>최소주문금액 : 15,000원</span>
                                    </div>
                                    <div class="msg-line">
                                        <span>예상 주문시간 : 1hour</span>
                                        <span class="bar"></span>
                                        <span>드라이브 픽업 : 가능</span>
                                    </div>
                                </div>
                                <div class="icon-list">
                                    <button type="button" class="l-coupon"></button>
                                    <button type="button" class="l-receipt"></button>
                                    <button type="button" class="l-cart"></button>
                                </div>
                            </div>
                            <div class="btn">
                                <button type="button" class="chk">선택하기</button>
                                <button type="button" class="like"><i class="star"></i>찜하기</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </article>
    <!-- // 프로모션 팝업 영역  -->


    <!-- 공통 커스텀 js -->
    <script type="text/javascript">
        var CONTEXT_PATH = "https://www.goobne.co.kr";

        function logout() {
            //      if( confirm('로그아웃 하시겠습니까?') ){
            console.log("logout");
            var url = '/mypage/logout';
            var obj = new Object();
            var data = JSON.stringify(obj);
            ajaxCall(url, data, logoutCallBack, errorCallBack, '[사용자 로그아웃]');
            //      } 
        }

        function logoutCallBack(obj) {
            if (obj.result == common._trans_success_code) {
                console.log("logout callback");

                var site_id = "";
                if (getDevice() == 4) {
                    site_id = "PC";
                } else {
                    //obj.site_id = "MOB";
                    site_id = "PC";
                }
                console.log("header.jsp site_id : " + site_id);

                if (site_id == 'PC' || site_id == 'MOB') {
                    // adBrix API 관련 _ 로그아웃
                    adbrix.logout();
                }

                location.href = "/" + "index";
            }
        }

        /**
         * 로그인페인지로 이동
         */
        function goToLogin() {
            location.href = "/";
            return false;
        }

        /**
         * 메인페이지로 이동
         * @returns {Boolean}
         */
        function goToMain() {
            location.href = "/";
        }

    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            var id = "PC";
            var os = "windows";
            if (id != 'PC') {
                try {
                    var userAgent = navigator.userAgent.toLowerCase();
                    if (userAgent.search("android") > -1) {
                        goobnechicken.initApp();
                    } else if ((userAgent.search("iphone") > -1) || (userAgent.search("ipod") > -1) || (userAgent
                            .search("ipad") > -1)) {
                        window.webkit.messageHandlers.initApp.postMessage('loadPlatformInfo');
                    }
                    siteinfo("APP", os);
                } catch (error) {
                    console.log('web');
                    siteinfo("MOB", os);
                }
            }
        });

        function loadPlatformInfo(osType, deviceUid) {}

    </script>




    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o)
                , m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-91267323-1', 'auto');
        ga('send', 'pageview');

    </script>
    <script src="/resources/js/netfunnel1.js" charset="UTF-8"></script>
    <script>
        window.onload = function() {
            NetFunnel_Complete();
        }

    </script>

    <!-- Set AdBrix Web SDK -->
    <script>
        ! function(e, r) {
            if (void 0 !== e && !e.adbrix) {
                var o = {
                        queue: []
                    }
                    , t = navigator.userAgent.toLowerCase()
                    , c = r.createElement("script")
                    , a = "Netscape" === navigator.appName && -1 !== navigator.userAgent.search("Trident") || -1 !== t.indexOf(
                        "msie") ? "abx-web-sdk.ie.min.js" : "abx-web-sdk.min.js";
                c.type = "text/javascript", c.async = !0, c.src = "//static.adbrix.io/web-sdk/latest/" + a, c.onload =
                    function() {
                        e.adbrix.runQueuedFunctions ? e.adbrix.runQueuedFunctions() : console.log(
                            "[adbrix] Error: could not load SDK")
                    };
                var i = r.getElementsByTagName("script")[0];
                i.parentNode.insertBefore(c, i);
                ["init", "onInitialized", "login", "getUserId", "logout", "userProperty.get", "userProperty.getAll"
                    , "userProperty.addOrUpdate", "userProperty.remove", "userProperty.removes", "common.signUp"
                    , "common.invite", "common.useCredit", "common.purchase", "event.send", "debug.traceListener"
                    , "commerceAttr.categories", "commerceAttr.product", "commerce.viewHome", "commerce.categoryView"
                    , "commerce.productView", "commerce.addToCart", "commerce.addToWishList", "commerce.reviewOrder"
                    , "commerce.refund", "commerce.search", "commerce.share", "commerce.listView", "commerce.cartView"
                    , "commerce.paymentInfoAdded", "game.tutorialComplete", "game.characterCreated", "game.stageCleared"
                    , "game.levelAchieved"
                ].forEach(function(e) {
                    var r = e.split(".")
                        , t = r.pop();
                    r.reduce(function(e, r) {
                        return e[r] = e[r] || {}
                    }, o)[t] = function() {
                        o.queue.push([e, arguments])
                    }
                }), e.adbrix = o
            }
        }(window, document);

    </script>

    <!-- AdBrix Web SDK init -->
    <script>
        window.adbrix.init({
            appkey: 'lF1KNAw1902C61HwZw2KLA'
            , webSecretkey: 'xqWNqKfsGkqUvTVUwhjsRA'

                // push 관련 설정 추가
            , push: {
                enable: true
                , serviceWorkerOptions: {
                    file_name: 'service-worker.js'
                    , file_path: '/'
                    , scope: '/'
                }
            }, // In Web Message 추가 설정 
            inWebMessage: {
                enable: true
                , openInNewWindow: true
                , zIndex: 9999
                , fetchListener: function(message) {
                    console.log('fetch_listener ' + message);
                }
                , clickListener: function(actionId, actionType, actionArg, isClosed) {
                    console.log('click_listener ' + actionId + actionType + actionArg + isClosed);
                }
            , }
        });
        adbrix.onInitialized(() => {
            //adbrix.push.showPrompt();
        });

    </script>

    <script>
        new WOW().init();

    </script>

    <style>
        .main-box .goobne-img_office_bg_KSTD1 {
            background: url("https://cdn.goob-ne.com/goobne/img/banner/31331fc944e442df910fde1cd46d52e5.jpg") center;
            background-size: cover;
        }













        .main-box .goobne-img_office_bg_9TM8T {
            background: url("https://cdn.goob-ne.com/goobne/img/banner/7257fd33de92479fafce663990a7da1d.jpg") center;
            background-size: cover;
        }





























        .main-box .goobne-img_office_bg_MW9CA {
            background: url("https://cdn.goob-ne.com/goobne/img/banner/feb9a03af033494e88691c445c79b948.jpg") center;
            background-size: cover;
        }









        .main-box .goobne-img_office_bg_RJMWZ {
            background: url("https://cdn.goob-ne.com/goobne/img/banner/9d73d4c46aca49c3841631597929a306.jpg") center;
            background-size: cover;
        }



        @media (max-width: 768px) {




            .main-box .goobne-img_office_bg_KSTD1 {
                background: url("https://cdn.goob-ne.com/goobne/img/banner/0516764604b84056b3f2b5308d36668d.jpeg") no-repeat center;
                background-size: cover;
            }













            .main-box .goobne-img_office_bg_9TM8T {
                background: url("https://cdn.goob-ne.com/goobne/img/banner/28dd6133d20f47fb87373cc2dbc5ad18.jpg") no-repeat center;
                background-size: cover;
            }





























            .main-box .goobne-img_office_bg_MW9CA {
                background: url("https://cdn.goob-ne.com/goobne/img/banner/2794da397e98418fa466da94af28114e.jpg") no-repeat center;
                background-size: cover;
            }









            .main-box .goobne-img_office_bg_RJMWZ {
                background: url("https://cdn.goob-ne.com/goobne/img/banner/d0b1995f23b14097aabe3674010b732c.jpg") no-repeat center;
                background-size: cover;
            }



        }

        .main-box .goobne-btn-box button.universe_go {
            background: #bd4224;
        }

        .main-box .goobne-btn-box button.universe_go span {
            background: url('https://cdn.goob-ne.com/goobne/resources/assets/images/main/icon_playtown_6.png');
            background-repeat: no-repeat;
            background-size: contain;
            color: #fff;
        }

    </style>

    <script>
        $(window).ready(function() {
            $('.no-js').addClass('visible');
        });
        $(window).load(function() {
            $('.goobne-tv-wrap').slick('refresh');
        });

    </script>


</head>
<body>
<div id="wrap">

    @yield('section')
    @include('layout.header')
    @include('layout.aside')


    @yield('contents')
    @include('layout.footer')


</div>

<script type="text/javascript">
    $(document).ready(function() {

        var site_id = "";
        if (getDevice() == 4) {
            site_id = "PC";
        } else {
            //obj.site_id = "MOB";
            site_id = "PC";
        }

        console.log("index.jsp site_id : " + site_id);

        if (site_id == 'PC' || site_id == 'MOB') {
            console.log("adbrix api 시작");
            // adBrix API 관련 _ 홈 메인 화면 진입
            adbrix.commerce.viewHome();
        }

        try {
            var userAgent = navigator.userAgent.toLowerCase();
            if (userAgent.search("android") > -1) {
                goobnechicken.initApp();
            } else if ((userAgent.search("iphone") > -1) || (userAgent.search("ipod") > -1) || (userAgent.search(
                    "ipad") > -1)) {
                window.webkit.messageHandlers.initApp.postMessage('loadPlatformInfo');
            }
        } catch (error) {
            console.log('web');
        }
    });


    function loadPlatformInfo(osType, deviceUid) {}

</script>


<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o)
            , m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-44521541-5', 'anijs.github.io');
    ga('send', 'pageview');

</script>

</body>
</html>
