<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
1. 개인정보의 수집 및 이용목적 

㈜지앤푸드 goobne.co.kr 회원 이용약관입니다.
먼저 아래의 이용약관을 반드시 읽어 보시고 회원가입해 주시기 바랍니다.

1. [제 1장 총칙] 

제 1 조 목적

1. 이 약관은 “주식회사지앤푸드(이하 “굽네치킨” 또는 “회사”라 한다.) 홈페이지가 제공하는 모든 정보 제공 서비스를 이용하는 조건 및 절차에 관한 사항을 규정함을 목적으로 하며, 이용자들은 서비스 제공업체인 굽네치킨에서 제공해 드리는 굽네치킨 홈페이지 회원 약관에 동의하였음을 협약합니다.

2. 굽네치킨의 개인정보 사용은 <개인정보 수집목적 및 이용목적>을 준수합니다. 

3. 이벤트 진행을 위한 필요한 고객정보는 별도의 특별약관으로 고객정보 이용의 목적과 범위 및 제한 사항을 공지하고 승인을 얻어 이용합니다. 

4. 굽네치킨은 굽네치킨의 웹사이트를 보호하고 어떠한 법규에도 어긋나지 않기 위하여 법률 기관으로부터 정당한 법률상의 요청이 있을 시 공공의 안전을 위하여 어떠한 정보이든 법 기관과 협조하여 공유할 권한이 있음을 알려드립니다. 

제 2조 효력과 변경 

1. 이 약관은 웹사이트(www.goobne.co.kr)에 그 내용을 이용자가 알 수 있도록 게시함으로써 효력을 발생하며 “굽네치킨”은 약관의 규제 등에 관한 법률, 전자거래 기본법, 전자서명법, 정보통신망 이용촉진 등에 관한 법률, 소비자 보호법 등 관련법을 위배하지 않는 범위에서 개정할 수 있습니다. 

2. “굽네치킨” 는 약관을 개정할 경우, 적용일자 및 개정 사유를 지체 없이 사전에 공시합니다. 

3. 이 약관에 동의하는 것은 정기적으로 웹을 방문하여 약관의 변경사항을 확인하는 것에 동의함을 의미합니다.

4. 회원은 변경된 약관에 동의하지 않을 경우 회원 탈퇴(해지)를 요청할 수 있으며, 변경된 약관의 효력 발생일로부터 7일 이후에도 거부의사를 표시하지 아니하고 서비스를 계속 사용할 경우 약관의 변경 사항에 동의한 것으로 간주됩니다. 

5. 새로운 서비스가 개설될 경우 별도의 명시된 설명이 없는 한, 이 약관에 따라 제공합니다. 
제 3조 약관 이외의 준칙 
이 약관에 명시되지 않은 사항이 관계 법령에 규정되어 있을 경우에는 그 규정에 따릅니다. 

2. [제 2 장 회원 가입과 서비스 이용] 

제 4조 동의

1. 굽네치킨에서 제공하는 굽네치킨 인터넷 서비스를 이용함에 있어, 가입조건 및 이용에 관한 제반 사항과 기타 필요한 사항을 구체적으로 규정하며, 이용자가 등록절차를 거쳐서 “동의” 단추를 누르면 이 약관에 동의하는 것으로 간주됩니다.

2. 개인정보의 수집에 대한 동의철회(회원탈퇴)를 하시려면 로그인 후 홈페이지 상단의 정보수정에서 회원탈퇴 절차를 거쳐 탈퇴하시면 하시면 됩니다. 회원탈퇴 시 귀하가 굽네치킨에 제공한 개인정보는 즉시 모두 삭제됩니다. 단, 개인정보처리법에 의거하여 거래내역은 5년 이후 삭제처리 됩니다. 

제 5조 회원가입의 성립 

1. 굽네치킨 홈페이지 회원은 만 14세 미만의 아동일 경우, '정보통신망 이용촉진 및 정보보호 등에 관한 법률' 등에 따라 법정 대리인의 동의가 있어야만 서비스를 이용할 수 있습니다. 

2. "본인회원"이란 이 규약을 승인하고 굽네치킨 홈페이지 서비스의 회원신청 양식에 의거, 본인의 신상 정보를 사실에 입각, 입력하여 ID와 Password를 발급 받으신 분을 의미합니다. (법인 혹은 단체회원으로 가입신청을 하실 수는 없습니다.) 

3. “굽네치킨”는 다음 각 호에 해당하는 회원 가입 신청에 대하여는 이를 승낙하지 아니 합니다. 
1) 다른 사람의 명의를 사용하여 신청하였을 때
2) 본인의 실명으로 신청하지 않았을 때
3) 회원 가입 신청 시 이용자 정보를 허위로 기재하였을 때
4) 사회의 안녕과 질서 혹은 미풍양속을 저해할 목적으로 신청하였을 때
5) 기타 회사가 정한 이용신청요건이 미비할 때
6) 본인인증(아이핀 이용)을 하지 않은 경우

4. "굽네치킨"은 서비스 이용신청이 다음 각 호에 해당하는 경우에는 그 신청에 대하여 승낙 제한사유가 해소될 때까지 승낙을 유보할 수 있습니다.
1) 회사가 설비의 여유가 없는 경우
2) 회사의 기술상 지장이 있는 경우
3) 기타 회사의 귀책사유로 이용승낙이 곤란한 경우

제 6조 회원정보

1. 회원가입 시 입력한 신상정보는 회원관리용의 목적 및 특정 물품 (경품이벤트 당첨 등) 발송, 제품 배송(주문) 그리고, 굽네치킨 관련 소식 전달 외 다른 용도로 사용되지 않으며, 또한 외부로 유출되지 않습니다. 만약 이 사항에 대한 위반행위 시 굽네치킨에서 법적 책임을 질 것을 약속 드립니다.

2. 상기 6조 1항의 예외적용 만약 검찰/경찰 측의 사회안전을 위한 수사목적으로 참고자료 요청 시 굽네치킨은 부득이하게 회원정보를 넘겨줄 수 있으며, 이 경우 가급적 본인에게 사전 통보해 드리겠습니다. 

3. 회원의 비밀 보호를 위해 회원 자신이 설정한 문자, 숫자, 특수문자의 조합으로 구성 

제 7조 회원권리

1. 회원은 언제든지 개인정보를 열람하고 정정 또는 동의철회(회원탈퇴)를 요청할 수 있습니다. 

2. 굽네치킨 홈페이지 내 게재되어 있는 각종 정보서비스 이용에 관련된 불만사항이나 의견을 제안하여 시정을 요구할 수 있습니다. 

3. 회원으로 가입되어 있는 분들은 누구나 동등한 자격으로 서비스를 이용하실 수 있습니다. 

제 8조 회원정보 이용

1. 게시판에서의 다른 회원들의 e-mail 주소를 취득하였을 경우, 스팸메일을 발송하여 메일 수신자에게 피해를 주었을 경우, 이에 대한 법적책임은 메일발송자에게 있으며 굽네치킨과는 무관합니다.

제 9조 회원 계약 해지 및 이용 제한

1. 회원이 제 5조 3항에 해당하는 경우, "굽네치킨"은 회원자격을 제한 및 정지하거나 박탈시킬 수 있습니다.

2. "굽네치킨"은 회원자격을 상실시키는 경우에는 회원등록을 말소합니다. 이 경우 회원에게 이를 통지하여야 합니다.

3. 회원이 서비스 이용계약을 해지하고자 하는 때에는 회원 본인이 직접 인터넷의 해지서비스를 이용하여 서비스 해지 신청을 해야 하며 비밀번호를 입력하여 본인임을 확인한 후, 해지 확인을 선택하면 자동으로 가입 해지됩니다.

4. 가입 해지 여부는 기존의 ID, 비밀번호로 로그인이 되지 않으면 해지된 것입니다.

5. “굽네치킨”는 회원의 개인정보 보호를 위하여 서비스 미사용자(최종 로그인한 후 연속하여 12개월간 로그인 기록이 없는 회원)에 대해 정기적으로 회원자격 상실에 대한 안내문(전자우편)을 통지하고, 안내문에서 정한 기한(30일) 내에 로그인이 없을 경우 회원자격을 상실시킬 수 있습니다. 이 경우, 회원 아이디를 포함한 회원의 개인정보 및 서비스 이용정보는 파기, 삭제됩니다.

6. 굽네치킨 홈페이지 서비스 제공업자는 다음 사항에 해당하는 경우, 사전 통지 없이 이용 계약을 해지하거나 또는 기간을 정하여 서비스 이용을 중지할 수 있습니다. 
1) 회원가입 시 입력사항을 허위로 기재하였을 경우.
2) 타인의 명의를 빌리거나 도용하여 차명으로 신청하였을 경우
3) 같은 사용자가 다른 ID로 이중 등록을 한 경우
4) 명백한 형사처벌의 대상이 되는 행위 적발 시 (불법 상행위 포함)
5) 게시판에서의 욕설이나 저속한 문구를 사용하여, 타인에게 불쾌감을 준다고 판단되는 경우
6) 타인의 명예를 손상시키거나 불이익을 주는 경우
7) 혐오스럽거나 타인에게 불쾌감을 줄 수 있는 아이디로 회원가입을 하거나 음란물 등록 혹은 거래할 경우
8) 국익 또는 사회적 공익을 저해할 목적으로 서비스 이용을 계획 또는 실행할 경우
9) 회사, 다른 회원 또는 제 3자의 지적재산권을 침해하거나 회사의 서비스 정보를 이용하여 얻은 정보를 회사의 사전 승낙 없이 복제 또는 유통시키거나 상업적으로 이용하는 경우
11) 서비스에 위해를 가하는 등 건전한 이용을 저해하는 경우
12) 타 관련 법령이나 회사가 정한 이용조건에 위배되는 경우
13) 아이핀을 통한 실명인증을 아니한 경우 

제 10조 서비스 이용

1. 서비스는 “굽네치킨”의 업무상 기술상 특별한 지장이 없는 한 연중무휴, 1일 24시간을 원칙으로 합니다.

2. 제1항의 이용시간은 정기 점검 등의 필요로 인하여 “회사”가 정한 날과 시간에는 예외로 합니다. 단, 부득이한 경우로 서비스를 일시중지 할 경우에는 이를 사전, 후에 공지해야 합니다. 

3. 회원의 ID 및 비밀번호 등의 관리 및 이용은 전적으로 회원의 책임으로 하며 회원의 부주의로 인한 이용상의 과실 또는 제3자에 의한 부정사용 등에 대한 모든 책임은 회원에게 있습니다. 

3. [제 3 장 의무] 

제 11조 회원의무

1. ID와 Password는 회원본인이 직접 사용하여야 하며, 본인이 아닌 타인이 이용하게 하여서는 안됩니다. 

2. 본인 부주의로 ID와 비밀번호가 타인에게 유출되어 발생할 수 있는 각종 손실 및 손해에 대한 책임은 본인에게 귀속됩니다. 

3. 개인신상정보의 변경사항 발생 시 회원본인이 수정하지 않은 사항에 관련된 문제의 책임은 회원본인에게 귀속됩니다. 

제 12조 서비스제공업자의 의무

1. 특별한 사정이 없는 한 이용자가 신청한 서비스 제공 개시일에 서비스를 이용할 수 있도록 합니다. 

2. 굽네치킨은 이 약관에서 정한 바에 따라 계속적, 안정적으로 서비스를 제공할 의무가 있습니다. 

3. 굽네치킨은 회원의 개인신상정보를 본인의 승낙 없이 타인에게 누설, 배포하지 않습니다. 다만, 전기통신관련법령 등 관계법령에 의하여 관계 국가기관 등의 요구가 있는 경우에는 예외로 합니다.

4. 굽네치킨은 회원으로부터 제기되는 의견이나 불만이 정당하다고 인정할 경우에는 즉시 처리하여야 합니다. 다만, 즉시 처리가 곤란한 경우에는 회원에게 그 사유와 처리일정을 통보 하여야 합니다. 

4. [제 4 장 기타] 

제 13조 저작권

1. 굽네치킨 홈페이지에서 제공하는 각종 서비스에 대한 정보를 사전 동의 없이 외부로 유출시켰을 경우, 저작권법에 의해 법적 효력이 미칠 수 있습니다.

2. 굽네치킨 홈페이지에 등록되어 있는 굽네치킨의 CI/BI 혹은 캐릭터 등 상표권법에 의해 보호 받고 있는 이미지 파일을 무단으로 사용하실 수 없으며, 위반사항 적발 시 법적효력이 미침을 밝혀둡니다. 

제 14조 기타사항 (명기되지 않은 사항)

1. 본 회원약관에 명기되지 않은 사항이나 약관의 해석에 관하여서는 관계법령 또는 상관례에 따릅니다.

2. 본 약관은 특별한 사유 발생 시 수정될 수 있으며, 이 경우 굽네치킨 홈페이지를 통해 사전 공지됩니다. 

제 15 조 약관위반 시 책임

1. 이 약관을 위반함으로써 발생하는 모든 책임은 위반한 자가 부담하며, 이로 인하여 상대방에게 손해를 입힌 경우에는 관계법령에 의거하여 법적책임을 져야 합니다. 

2. 약관에 따른 소송은 굽네치킨 본점의 소재지를 관할하는 법원으로 합니다. 

제 16조 면책조항

1. 회사는 천재지변 또는 이에 준하는 불가항력으로 인하여 서비스를 제공할 수 없는 경우에는 서비스 제공에 관한 책임이 면제됩니다.

2. 회사는 회원의 귀책사유로 인한 서비스 이용의 장애에 대하여 책임을 지지 않습니다.

3. 회사는 회원이 서비스를 이용하여 기대하는 수익을 상실한 것에 대하여 책임을 지지 않습니다. 또한 회사는 서비스를 통하여 제공하는 자료의 정확성을 보장하지 아니하며 이로 인한 손해에 관하여 책임을 지지 않습니다.

4. 회사는 고의에 의한 경우를 제외하고 회사가 제공하는 자료, 사실 기타 모든 정보의 신뢰도, 정확성에 대하여 책임을 지지 않습니다.

(부칙) 이 약관은 2012년 8월 16일부터 시행합니다.

종전의 약관은 본 약관으로 대체합니다.	
            
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
(주)GNFood(굽네치킨 goobne.co.kr이하 '회사' 라 함)는 이용자들의 개인정보를 매우 중요시하며, 
"정보통신망 이용촉진 및 정보보호 등에 관한 법율" 및 "개인정보보호법"등 개인정보보호 관련 법규를 준수하고 있습니다. 
회사는 개인정보처리방침을 통하여 고객님께서 제공하시는 개인정보가 어떠한 용도와 방식으로 이용되고 있으며, 
개인정보 보호를 위해 어떠한 조치가 취해지고 있는지 알려드립니다. 회사는 개인정보 처리방침을 개정 또는 변경하는 경우 웹사이트 공지사항(또는 개별공지)를 통하여 공지할 것입니다. 

01. 총칙

01. 수집하는 개인정보의 항목 및 수집방법

가. 수집하는 개인정보의 항목

1) 회사는 회원가입, 원활한 고객상담, 각종 서비스의 제공을 위해 최초 회원가입 당시 아래와 같은 최소한의 개인정보를 필수항목으로 수집하고 있습니다.

ο 성명, 아이핀 번호, 생년월일, 성별, 아이디, 비밀번호, 연락처, 휴대폰 번호, 이메일, 가입인증정보, 만 14세 미만인 자의 경우 : 법정대리인 실명인증 정보, 법정대리인 이메일

2) 서비스 이용과정이나 사업처리 과정에서 아래와 같은 정보들이 자동으로 생성되어 수집될 수 있습니다.

ο 성명, 생년월일, 성별, 로그인ID, 비밀번호, 자택 전화번호, 자택 주소, 휴대전화번호, 이메일, 만 14세 미만인 자의 법정대리인정보, 접속로그, 쿠키
개인정보 수집방법: 홈페이지(회원가입), 경품행사 응모, 고객의 소리 및 생성정보 수집툴을 통한 수집

3) 회사 아이디를 이용한 부가 서비스 및 맞춤식 서비스 이용 또는 이벤트 응모 과정에서 해당 서비스의 이용자에 한해서만 아래와 같은 정보들이 수집될 수 있습니다.

ο 개인정보 추가 수집에 대해 동의를 받는 경우

4) 유료 서비스 이용 과정에서 아래와 같은 결제 정보들이 수집될 수 있습니다.

ο 신용카드 결제 시 : 카드사명, 카드번호, 카드 소유주명, 결제 시간, 이용 가맹점

나. 개인정보 수집방법

01.회사는 다음과 같은 방법으로 개인정보를 수집합니다.

ο 홈페이지, 팩스, 전화, 상담 게시판, 이메일, 이벤트 응모, 배송요청
ο 생성정보 수집 툴을 통한 수집

02. 개인정보의 수집 및 이용목적

가. 회원관리

ο 컨텐츠 제공, 특정 맞춤 서비스 제공, 물품배송 또는 청구서 등 발송, 본인인증, 구매 및 요금 결제, 요금추심
ο 단, 다음의 정보에 대해서는 아래의 이유로 명시한 기간 동안 보존합니다.
ο 보유기간을 회원에게 미리 고지하고 개별적으로 회원에게 사전에 동의를 받은 경우에는 약속한 보유기간 동안 보유

나. 회원관리

ο 회원제 서비스 이용 및 제한적 본인 확인제에 따른 본인확인, 개인식별, 불량회원의 부정 이용방지와 비인가 사용방지, 가입의사 확인, 가입 및 가입횟수 제한, 만14세 미만 아동 개인정보 수집 시 법정 대리인 동의여부 확인, 추후 법정 대리인 본인확인, 분쟁 조정을 위한 기록보존, 고객의 소리 등 민원처리, 고지사항 전달

다. 신규 서비스 개발 및 마케팅, 광고에의 활용

신규 서비스 개발 및 맞춤 서비스 제공, 통계학적 특성에 따른 서비스 제공 및 광고 게재, 서비스의 유효성 확인, 이벤트 및 광고성 정보 제공 및 참여기회 제공, 접속빈도 파악, 회원의 서비스이용에 대한 통계

03. 개인정보의 공유 및 제공

회사는 이용자들의 개인정보를 "2. 개인정보의 수집목적 및 이용목적"에서 고지한 범위내에서 사용하며, 이용자의 사전 동의 없이는 동 범위를 초과하여 이용하거나 원칙적으로 이용자의 개인정보를 외부에 공개하지 않습니다. 다만, 아래의 경우에는 예외로 합니다.
* 이용자들이 사전에 공개에 동의한 경우
* 법령의 규정에 의거하거나, 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우

04. 개인정보의 처리위탁

회사는 서비스 향상을 위해서 아래와 같이 개인정보를 위탁하고 있으며, 관계 법령에 따라 위탁계약 시 개인정보가 안전하게 관리될 수 있도록 필요한 사항을 규정하고 있습니다. 회사의 개인정보 위탁처리 기관 및 위탁업무 내용은 아래와 같습니다.

회사의 개인정보 위탁처리 기관 및 위탁업무

- 수탁업체 : ㈜씨엔티테크 / 위탁업무 : 콜센터 고객상담 지원 대행 / 개인정보의 보유 및 이용기간 : 회원탈퇴 시 혹은 위탁계약의 종료시까지

- 수탁업체 : 나이스신용평가정보㈜ / 위탁업무 : 본인인증 / 개인정보의 보유 및 이용기간 :해당 업체에서 이미 보유하고 있는 개인정보이기 때문에 별도로 저장하지 않음

- 수탁업체 : 주)구름소프트 / 위탁업무 : 본인인증, 알림톡 발송, 마케팅정보 전송(Push/LMS/SMS/E-mail) / 개인정보의 보유 및 이용기간 : 회원탈퇴시 혹은 위탁계약의 종료시까지

- 수탁업체 : (주)씨엔에스. / 위탁업무: 시스템 서비스 운영, 개인정보 보관 및 유지관리, 마케팅정보 전송(Push/LMS/SMS/E-mail) / 개인정보의 보유 및 이용기간: 회원탈퇴시 혹은 위탁계약의 종료시까지

- 수탁업체 : kg이니시스 / 위탁업무: PG 결제 대행 서비스 / 개인정보의 보유 및 이용기간: 회원탈퇴시 혹은 위탁계약의 종료시까지

- 수탁업체 : 푸드테크 / 위탁업무 : POS시스템 유지 관리 / 개인정보의 보유 및 이용기간 : 회원탈퇴시 혹은 위탁계약의 종료시까지

- 수탁업체 : 쿠프마케팅 / 위탁업무 : 알림톡 발송, 마케팅정보 전송(Push/LMS/SMS/E-mail) / 개인정보의 보유 및 이용기간 : 회원탈퇴시 혹은 위탁계약의 종료시까지

- 수탁업체 : 아이지에이웍스/ 위탁업무: 마케팅 성과 분석, 행태정보 수집 및 분석, 앱푸시 메세지 발송 / 개인정보의 보유 및 이용기간 : 회원탈퇴시 혹은 위탁계약의 종료시까지

※ 일부 서비스는 외부 콘텐츠 제공사(CP)에서 결제 및 환불 등에 대한 고객상담을 할 수 있습니다.

05. 개인정보의 보유 및 이용기간

이용자의 개인정보는 원칙적으로 개인정보의 수집 및 이용목적이 달성되면 지체 없이 파기합니다. 단, 다음의 정보에 대해서는 아래의 이유로 명시한 기간 동안 보존합니다.

가. 회원관리

부정이용기록 - 보존 기간 : 1년 -보존 이유 : 부정 이용 방지

나. 관련법령에 의한 정보보유 사유

상법, 전자상거래 등에서의 소비자보호에 관한 법률 등 관계법령의 규정에 의하여 보존할 필요가 있는 경우 회사는 관계법령에서 정한 일정한 기간 동안 회원정보를 보관합니다. 이 경우 회사는 보관하는 정보를 그 보관의 목적으로만 이용하며 보존기간은 아래와 같습니다.
* 계약 또는 청약철회 등에 관한 기록 -보존 이유 : 전자상거래 등에서의 소비자보호에 관한 법률 - 보존 기간 : 5년
* 대금결제 및 재화 등의 공급에 관한 기록 -보존 이유 : 전자상거래 등에서의 소비자보호에 관한 법률 - 보존 기간 : 5년
* 소비자의불만 또는 분쟁처리에 관한 기록 -보존 이유 : 전자상거래 등에서의 소비자보호에 관한 법률 - 보존 기간 : 3년
* 본인확인에 의한 기록 -보존 이유: 정보통신망 이용촉진 및 정보보호 등에 관한 법률 - 보존 기간 : 6개월
* 웹사이트 방문기록 -보존 이유: 통신비밀 보호법 - 보존 기간 : 3개월

06. 개인정보 파기절차 및 방법

가. 파기절차

* 이용자가 회원가입 등을 위해 입력한 정보는 목적이 달성된 후 별도의 DB로 옮겨져(종이의 경우 별도의 서류함) 내부 방침 및 기타 관련 법령에 의한 정보보호 사유에 따라(보유 및 이용기간 참조)일정 기간 저장된 후 파기됩니다.
* 동 개인정보는 법률에 의한 경우가 아니고서는 보유되는 이외의 다른 목적으로 이용되지 않습니다.
나. 파기방법

* 종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기합니다.
* 전자적 파일 형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다.

07. 이용자 및 법정대리인의 권리와 그 행사방법

* 이용자 및 법정 대리인은 언제든지 등록되어 있는 자신 혹은 당해 만 14세 미만인 자의 개인정보를 조회하거나 수정할 수 있으며, 회사의 개인정보의 처리에 동의하지 않는 경우 동의를 거부하거나 가입해지(회원탈퇴)를 요청하실 수 있습니다. 다만, 그러한 경우 서비스의 일부 또는 전부 이용이 어려울 수 있습니다.
* 이용자 혹은 만 14세 미만인 자의 개인정보 조회, 수정을 위해서는 '개인정보변경'(또는 '회원정보수정' 등)을, 가입해지(동의철회)를 위해서는 "회원탈퇴"를 클릭하여 본인 확인 절차를 거치신 후 직접 열람, 정정 또는 탈퇴가 가능합니다.
* 혹은 개인정보관리책임자에게 서면, 전화 또는 이메일로 연락하시면 지체 없이 조치하겠습니다.
* 이용자가 개인정보의 오류에 대한 정정을 요청하신 경우에는 정정을 완료하기 전까지 당해 개인정보를 이용 또는 제공하지 않습니다. 또한 잘못된 개인정보를 제3자에게 이미 제공한 경우에는 정정 처리결과를 제3자에게 지체 없이 통지하여 정정이 이루어지도록 하겠습니다.
* 회사는 이용자 혹은 법정 대리인의 요청에 의해 해지 또는 삭제된 개인정보는 "5. 개인정보의 보유 및 이용기간"에 명시된 바에 따라 처리하고 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다.

08. 개인정보 자동 수집 장치의 설치/운영 및 거부에 관한 사항

가. 회사의 쿠키 사용 목적

* 이용자들이 방문한 회사의 각 서비스와 웹 사이트들에 대한 방문 및 이용형태, 보안접속 여부, 이용자 규모 등을 파악하여 이용자에게 광고를 포함한 최적화된 맞춤형 정보를 제공하기 위해 사용합니다.

나. 쿠키의 설치/운영 및 거부

* 이용자는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서 이용자는 웹브라우저에서 옵션을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수도 있습니다. * 다만, 쿠키의 저장을 거부할 경우에는 로그인이 필요한 회사 일부 서비스는 이용에 어려움이 있을 수 있습니다.
* 쿠키 설치 허용 여부를 지정하는 방법(Internet Explorer의 경우)은 다음과 같습니다.
① [도구] 메뉴에서 [인터넷 옵션]을 선택합니다.
② [개인정보 탭]을 클릭합니다.
③ [개인정보처리 수준]을 설정하시면 됩니다

09. 개인정보의 기술적/관리적 보호 대책

* 회사는 이용자들의 개인정보를 처리함에 있어 개인정보가 분실, 도난, 누출, 변조 또는 훼손되지 않도록 안전성 확보를 위하여 다음과 같은 기술적/관리적 대책을 강구하고 있습니다.

가. 비밀번호 암호화

* 회사 회원 아이디(ID)의 비밀번호는 암호화되어 저장 및 관리되고 있어 본인만이 알고 있으며, 개인정보의 확인 및 변경도 비밀번호를 알고 있는 본인에 의해서만 가능합니다.

나. 해킹 등에 대비한 대책

* 개인정보 등 보안이 요구되는 정보의 경우 산업표준인 SSL(secure socket layer) 을 이용하여 암호화되어 전송되며 서비스 이용자가 사용하시는 스크린 하단 작업표시줄에 자물쇠 마크를 통해 확인할 수 있습니다. 이렇게 전송된 정보는 방화벽(Fire Wall) 및 VPN(Virtual Private Network)시스템 체계를 통하여 이중망으로 구성된 시스템에 안전하게 저장됩니다.
* 해킹과 내/외부의 침입 또는 공격에 대비하여 IDC(Internet Data Center)에서 24시간 관제 및 서버관리 운영을 함으로써 전산 시스템의 출입을 철저히 통제하고 있습니다.
* 회사는 해킹이나 컴퓨터 바이러스 등에 의해 회원의 개인정보가 유출되거나 훼손되는 것을 막기 위해 최선을 다하고 있습니다. 개인정보의 훼손에 대비해서 자료를 수시로 백업하고 있고, 최신 백신프로그램을 이용하여 이용자들의 개인정보나 자료가 누출되거나 손상되지 않도록 방지하고 있으며, 암호화통신 등을 통하여 네트워크상에서 개인정보를 안전하게 전송할 수 있도록 하고 있습니다. 그리고 침입차단시스템을 이용하여 외부로부터의 무단 접근을 통제하고 있으며, 기타 시스템적으로 보안성을 확보하기 위한 가능한 모든 기술적 장치를 갖추려 노력하고 있습니다.

다. 처리 직원의 최소화 및 교육

* 회사의 개인정보관련 처리 직원은 담당자에 한정시키고 있고 이를 위한 별도의 비밀번호를 부여하여 정기적으로 갱신하고 있으며, 담당자에 대한 수시 교육을 통하여 회사 개인정보 처리방침의 준수를 항상 강조하고 있습니다.

라. 개인정보보호전담기구의 운영

* 그리고 사내 개인정보보호전담기구 등을 통하여 회사 개인정보 처리방침의 이행사항 및 담당자의 준수여부를 확인하여 문제가 발견될 경우 즉시 수정하고 바로 잡을 수 있도록 노력하고 있습니다. 단, 이용자 본인의 부주의나 인터넷상의 문제로 ID, 비밀번호, 개인정보가 유출되어 발생한 문제에 대해 회사는 일체의 책임을 지지 않습니다.

10. 개인정보관리책임자 및 담당자의 연락처

* 귀하께서는 회사의 서비스를 이용하시며 발생하는 모든 개인정보보호 관련 민원을 개인정보관리책임자 혹은 담당부서로 신고하실 수 있습니다. 회사는 이용자들의 신고사항에 대해 신속하게 충분한 답변을 드릴 것입니다.

개인정보 관리책임자

- 이름 : 안종섭 / 소속 : 운영본부 / 전화 : 02-2648-2005
메일 : support@gngrp.com / 직위 : 전무 / 직책 : 본부장

개인정보 관리담당자

- 이름 : 나동욱 / 소속 : 운영본부 / 전화 : 02-2648-2005
메일 : dndn72@gngrp.com / 직위 : 과장 / 직책 : 팀장

온라인 담당자

- 이름 : 어광일 / 소속 : 마케팅본부 / 전화 : 02-2648-2005
메일 : beto577@gngrp.com / 직위 : 대리

기타 개인정보침해에 대한 신고나 상담이 필요하신 경우에는 아래 기관에 문의하시기 바랍니다.

개인정보침해신고센터 (www.118.or.kr / 118)
개인정보보호 종합지원 포털http://www.privacy.go.kr / 02-2100-2817)
대검찰청 첨단범죄수사과 (www.spo.go.kr / 02-3480-2000)
경찰청 사이버테러대응센터 (www.ctrc.go.kr / 02-392-0330)

11. 기타

* 회사에 링크되어 있는 웹사이트들이 개인정보를 수집하는 행위에 대해서는 본 "회사 개인정보처리방침"이 적용되지 않음을 알려 드립니다.

12. 고지의 의무

* 현 개인정보 처리방침 내용 추가, 삭제 및 수정이 있을 시에는 개정 최소 7일전부터 홈페이지의 '공지사항'을 통해 고지할 것입니다. 다만, 개인정보의 수집 및 활용, 제3자 제공 등과 같이 이용자 권리의 중요한 변경이 있을 경우에는 최소 30일 전에 고지합니다.

공고일자 : 2012년 08월 16일
시행일자 : 2012년 09월 01일
            
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
본 웹사이트에 게시된 이메일 주소가 전자우편 수집프로그램이나 그 밖의 기술적 장치를 이용하여 무단으로 수집되는 것을 거부하며 이를 위반 시 정보통신망법에 의해 형사 처벌됨을 유념하시기 바랍니다.

[게시일 2010년 9월 22일]
            
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
                            <b>제1조 목적</b>

                            이 약관은 ㈜지앤푸드(이하 “회사”)가 제공하는 위치기반서비스(이하 “서비스”)를 이용함에 있어 회사와 이용자의 권리, 의무 및 책임사항, 기타 필요한 사항에 따른
                            이용 조건 및 절차 등 기본적인 사항을 규정함을 목적으로 합니다.


                            <b>제2조 이용약관의 효력 및 변경</b>

                            (1) 본 약관은 서비스를 신청한 이용자 또는 개인위치정보주체가 본 약관을 확인하고 회사가 정한 소정의 절차에 따라 동의해야 효력이 발생합니다.

                            (2) 이용자가 온라인에서 본 약관의 "동의하기" 버튼을 클릭하였을 경우 본 약관의 내용을 모두 읽고 이를 충분히 이해하였으며, 적용에 동의한 것으로 봅니다.

                            (3) 회사는 서비스에 새로운 업무 적용, 정부에 의한 시정명령의 이행 및 기타 회사의 업무상 약관을 변경해야 할 중요한 사유가 있다고 판단될 경우 본 약관을 변경할
                            수 있습니다.

                            (4) 이용자와 계약을 체결한 서비스가 기술적 사양의 변경 등의 사유로 변경할 경우에는 그 사유를 이용자에게 통지 가능한 수단으로 즉시 통지합니다.

                            (5) 회사는 본 약관을 변경할 경우에는 변경된 약관과 사유를 적용일자 1주일 전까지 홈페이지에 게시하거나 이용자에게 전자적 형태(전자우편, SMS, 앱 푸시 등)로
                            공지하며, 이용자가 그 기간 안에 이의제기가 없거나, 본 서비스를 이용할 경우 이를 승인한 것으로 봅니다.



                            <b>제3조 관계법령의 적용</b>

                            본 약관은 신의성실의 원칙에 따라 공정하게 적용하며, 본 약관에 명시되지 아니한 사항에 대하여는 관계법령 또는 상관례에 따릅니다.



                            <b>제4조 서비스 내용 및 위치정보 수집방법 등</b>

                            (1) 회사가 제공하는 위치기반 서비스를 이용하기 위한 통신 비용은 기본적으로 무료이며 이용자가 이동통신사업자에 지불하는 통신요금 외의 요금은 추가적으로 없습니다.

                            (2) 회사는 다음과 같이 위치정보를 수집합니다.
                            휴대폰 등 모바일기기가 사용하는 이동통신사업자 기지국 기반의 실시간 위치정보 수집
                            GPS가 포함된 모바일기기의 GPS정보를 통한 위치정보 수집
                            인터넷망을 통해 접속 시 인터넷서비스사업자로부터 제공받는 위치정보 수집

                            (3) 회사는 제공받은 위치정보, 상태정보를 이용하여 다음의 내용을 서비스 합니다.
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
                                        <td><strong>* 주변 매장 찾기/현 위치로 매장 검색</strong><br>(인근 매장정보 제공)</td>
                                        <td>온라인 주문 <br>(웹사이트 및 모바일App)</td>
                                        <td>회원 및 비회원</td>
                                    </tr>
                                    <tr>
                                        <td><strong>* 현위치로 배달주소 설정</strong></td>
                                        <td>온라인 주문 <br>(웹사이트 및 모바일App)</td>
                                        <td>회원 및 비회원</td>
                                    </tr>
                                    <!--<tr>
			<td><strong>* 드라이빙 픽업 서비스</strong><br>(픽업서비스를 원하는 이용자 위치를 매장에 <br> 전송하여 픽업위치로 주문한 제품 배송)</td>
			<td>온라인 주문 <br> (웹사이트 및 모바일App) <br>방문포장만 적용</td>
			<td>회원만 제공<br>(단, 모바일App에서 위치접근 권한을 <br> 허용한 회원에 한해 제공)</td>
		</tr>-->
                                </tbody>
                            </table>



                            <b>제5조 이용자의 이용제한</b>

                            (1) 이용자의 악의적인 개인위치정보 도용 및 결제사기를 목적으로 할 경우 거절될 수 있습니다.

                            (2) 이용자가 법률, 공공질서나 도덕에 위반하는 목적으로 서비스를 이용할 경우에 거절될 수 있습니다.

                            (3) 기타 관계법령 및 해당 약관을 위반한 경우에 거절될 수 있습니다.

                            (4) 이용자가 회사 서비스 운영을 고의 또는 방해하는 경우에 거절될 수 있습니다.



                            <b>제6조 서비스 이용의 제한 및 중지</b>

                            (1) 회사는 아래에 해당하는 사유가 발생한 경우에는 서비스 이용을 제한하거나 중지시킬 수 있습니다.
                            서비스용 설비 점검, 보수 또는 공사로 인하여 부득이한 경우
                            전기통신사업법에 규정된 기간통신사업자가 전기통신서비스를 중지했을 경우
                            국가비상사태, 서비스 설비의 장애 또는 서비스 이용의 폭주 등으로 서비스 이용에 지장이 있는 때
                            기타 중대한 사유로 인하여 회사가 서비스 제공을 지속하는 것이 부적당하다고 인정하는 경우

                            (2) 회사는 전항의 규정에 의하여 서비스의 이용을 제한하거나 중지한 때에는 그 사유 및 제한기간 등을 이용자에게 알려야 합니다.



                            <b>제7조 개인위치정보의 이용 또는 제공</b>

                            (1) 회사는 개인위치정보를 이용하여 서비스를 제공하고자 하는 경우에는 미리 이용약관에 명시한 후 개인위치정보주체의 동의를 얻어야 합니다.

                            (2) 이용자 및 법정대리인의 권리와 그 행사 방법은 제소 당시의 이용자의 주소에 의하며, 주소가 없는 경우에는 거소를 관할하는 지방법원의 전속관할로 합니다. 다만,
                            제소 당시 이용자의 주소 또는 거소가 분명하지 않거나 외국 거주자의 경우에는 민사소송법상의 관할 법원에 제기합니다.

                            (3) 회사는 타사업자 또는 이용 고객과의 요금정산 및 민원처리를 위해 위치정보 이용·제공·사실 확인 자료를 자동 기록·보존하며, 해당 자료는 관련 법령에 따라
                            보관합니다.



                            <b>제8조 개인위치정보 처리 업무의 위탁</b>

                            회사는 서비스 향상을 위하여 위치정보 서비스를 아래와 같이 위탁하고 있으며 위탁계약 시 개인위치정보가 안전하게 관리되도록 하고 있습니다. 제공정보는 서비스를 위한
                            최소한의 필요정보로 국한됩니다.

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
                                        <td class="td_center">㈜지앤푸드</td>
                                        <td>- 가까운 매장 찾기 <br> - 현재 위치 배달주소 등록 </td>
                                        <td>위치정보</td>
                                    </tr>
                                    <!--<tr>
		<td class="td_center">㈜스파코사</td>
		<td>- 드라이빙 픽업 이용시 이용자의 매장 도착정보 알림</td>
		<td>위치정보,휴대전화번호, 고객이 입력한 차량정보 (차종설명, 차량번호 등)</td>
	</tr>-->
                                </tbody>
                            </table>



                            <b>제9조 개인위치정보주체의 권리</b>

                            (1) 이용자는 회사에 대하여 언제든지 개인위치정보를 이용한 서비스 제공 및 개인위치 정보의 위탁 제공에 대한 동의의 전부 또는 일부를 철회할 수 있습니다. 이 경우
                            회사는 수집한 개인위치정보 및 위치정보 이용, 제공사실 확인자료를 파기합니다.

                            (2) 이용자는 회사에 대하여 언제든지 개인위치정보의 수집, 이용 또는 제공의 일시적인 중지를 요구할 수 있으며, 회사는 이를 거절할 수 없고 이를 위한 기술적
                            수단을 갖추고 있습니다.

                            (3) 이용자는 회사에 대하여 아래 항목의 자료에 대한 열람 또는 고지를 요구할 수 있고, 당해 자료에 오류가 있는 경우에는 그 정정을 요구할 수 있습니다. 이 경우
                            회사는 정당한 사유 없이 이용자의 요구를 거절할 수 없습니다.
                            본인에 대한 위치정보 수집, 이용, 제공사실 확인자료
                            본인의 개인위치 정보가 위치정보의 보호 및 이용 등에 관한 법률 또는 다른 법률 규정에 의하여 제3자에게 제공된 이유 및 내용

                            (4) 이용자는 제 1호 내지 제 3호의 권리행사를 위해 회사에 소정의 절차를 통해 요구할 수 있습니다.



                            <b>제10조 위치정보관리책임자의 지정</b>

                            회사는 개인위치정보를 적절히 관리·보호하고 개인위치정보주체의 불만을 원활히 처리할 수 있도록 위치정보관리책임자를 지정해 운영합니다.

                            <b>개인정보 관리책임자</b>

                            - 이름 : 안종섭 / 소속 : 운영본부 / 전화 : 02-2648-2005
                            메일 : support@gngrp.com / 직위 : 전무 / 직책 : 본부장

                            개인정보 관리담당자

                            - 이름 : 나동욱 / 소속 : 운영본부 / 전화 : 02-2648-2005
                            메일 : dndn72@gngrp.com / 직위 : 과장 / 직책 : 팀장

                            온라인 담당자

                            - 이름 : 어광일 / 소속 : 마케팅본부 / 전화 : 02-2648-2005
                            메일 : beto577@gngrp.com / 직위 : 대리



                            <b>제11조 손해배상</b>

                            (1) 회사가 위치정보의 보호 및 이용 등에 관한 법률 제15조 내지 제26조의 규정을 위반한 행위로 이용자에게 손해가 발생한 경우 이용자는 회사에 대하여 손해배상
                            청구를 할 수 있습니다. 이 경우 회사는 고의, 과실이 없음을 입증하지 못하는 경우 책임을 면할 수 없습니다.

                            (2) 이용자가 본 약관의 규정을 위반하여 회사에 손해가 발생한 경우 회사는 이용자에 대하여 손해배상을 청구할 수 있습니다. 이 경우 이용자는 고의, 과실이 없음을
                            입증하지 못하는 경우 책임을 면할 수 없습니다.

                            (3) 전항에도 불구하고 천재지변, 전쟁 등과 같은 불가항력의 상태가 있는 경우 발생한 손해에 대해서는 책임을 부담하지 않습니다.



                            <b>제12조 분쟁의 조정</b>

                            (1) 회사는 위치정보와 관련된 분쟁에 대해 당사자간 협의가 이루어지지 아니하거나 협의를 할 수 없는 경우에는 위치정보의 보호 및 이용 등에 관한 법률 제28조의
                            규정에 의한 방송통신 위원회에 재정을 신청할 수 있습니다.

                            (2) 회사 또는 고객은 위치정보와 관련된 분쟁에 대해 당사자간 협의가 이루어지지 아니하거나 협의를 할 수 없는 경우에는 개인정보보호법 제43조의 규정에 의한
                            개인정보분쟁조정위원회에 조정을 신청할 수 있습니다.



                            <b>제13조 회사의 주소 및 연락처</b>

                            회사의 상호, 주소, 전화번호 그 밖의 연락처는 다음과 같습니다.
                            상호: ㈜지앤푸드
                            주소: 주소 서울특별시 강서구 강서로 318 (내발산동 677) 지앤빌딩
                            전화번호: 02-2648-2005


                            <b>부칙</b>
                            제 1 조 시행일
                            본 약관은 2022년 00월 00일부터 적용됩니다.
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



        <!-- 배송지 설정 팝업 영역  -->
        <article class="modal-cnt-wrapper e_coupon-moadl l-hidden">
            <div class="dimmed-bg l-hidden"></div>
            <div class="modal-cnt-area find-cnt-area adderss-cnt-width">
                <button type="button" class="close closeBtn"><img src="https://cdn.goob-ne.com/goobne/resources/assets/images/icon/m-close.svg" alt="닫기버튼"></button>
                <div class="shopping-address-wrap terms-cnt-wrapper">
                    <div class="l-m-tit">e-쿠폰 이용안내</div>
                    <div class="textarea">
                        <div class="l-scroll-style div_box_border_top">
                            <ul class="inside_ul">
                                <li><i class="icon_nu">.</i><span class="text_span">금액권 조회 후 결제 수단 변경 시 금액권 은 자동 취소
                                        됩니다.</span></li>
                                <li><i class="icon_nu">.</i><span class="text_span">금액권 사용 가능시간 : 12:00 ~ 23:00 (매장별로
                                        오픈,마감시간,휴무일 차이가 있습니다)</span></li>
                                <li><i class="icon_nu">.</i><span class="text_span">금액권 사용여부 및 잔액조회는 상담센터 : 1644-5368
                                        (평일 9:30~18:00, 주말&공휴일 상담 불가)</span></li>
                                <li><i class="icon_nu">.</i><span class="text_span">온라인 주문 취소 문의는 굽네치킨 콜센터 :
                                        1661-9494</span></li>
                                <li><i class="icon_nu">.</i><span class="text_span">금액권 환불 문의는 상품권 구매처에서만 가능합니다.</span>
                                </li>
                                <li><i class="icon_nu">.</i><span class="text_span">사용후 잔액은 유효기간 내에 재사용 가능합니다.</span>
                                </li>
                                <li><i class="icon_nu">.</i><span class="text_span">잔액은 60% 사용시에 반환 가능합니다.(단, 1만원 이하는
                                        80%)</span></li>
                                <li><i class="icon_nu">.</i><span class="text_span">잔액 환불 문의 : Pay's 고객센터 1644-5368(평일
                                        9:30~18:00, 주말&공휴일 상담 불가)</span></li>
                                <li><i class="icon_nu">.</i><span class="text_span">금액권은 매장에서 운영중인 기타 할인, 쿠폰과 중복 사용 혜택
                                        불가능 합니다.</span></li>
                            </ul>
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
