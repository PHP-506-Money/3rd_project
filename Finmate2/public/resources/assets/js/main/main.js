$(document).ready(function () {
	// 햄버거 버튼  구현 영역 
	$('.sub-menu-btn').click(function () {
	    $('#wrap').addClass('non-scroll');
	    $('.aside__dimmed-bg').removeClass('l-hidden');
	    $('.aside__lnb').addClass('is-active');
	});
	
		$('.search-active .search-btn').click(function () {
	    $('.search-area .input-search').toggleClass('is-show');
	    $('#header').toggleClass('is-active');
	});
	
	// aside close 구현 영역 
	$('.aside__lnb-close').click(function () {
	    $('#wrap').removeClass('non-scroll');
	    $('.aside__dimmed-bg').addClass('l-hidden');
	    $('.aside__lnb').removeClass('is-active');
	});
	
	// aside bg close 구현 영역 
	$('.aside__dimmed-bg').click(function () {
	    $('#wrap').removeClass('non-scroll');
	    $('.aside__dimmed-bg').addClass('l-hidden');
	    $('.aside__lnb').removeClass('is-active');
	});
	
	// aside 메뉴 영역
	$('.aside__lnb-list >li >a').click(function () {
	    $(this).toggleClass('is-active');
	    $(this).next().toggleClass('is-show');
	
	    $(this).parent().siblings().children('a').removeClass('is-active');
	    $(this).parent().siblings().children('.dept').removeClass('is-show');
	});
	
	// 메인 환영합니다. 버튼 영역 
	$('.mo-login-cnt .mo-login').click(function () {
	    $(this).children('.arrow-link').toggleClass('is-active');
	    $('.mo-info-area').toggleClass('l-hidden');
	});
	
	// 팝업 닫기 버튼 구현
	function closePopupFunc() {
	    document.querySelector(".dimmed-bg").classList.add("l-hidden");
	    document.querySelector(".modal-cnt-wrapper").classList.add("l-hidden");
	}
	 var closeBtnElem = document.querySelectorAll(".closeBtn");
	$(closeBtnElem).each(function(){
	    	this.addEventListener('click', closePopupFunc);
	 });
	
	
	
    $('.event-list-wrap .event-list').mouseenter(function () {
        $('.event-list-wrap .event-list').removeClass('on')
        $(this).addClass('on')
    })

    $('#mobile-nav a').click(function () {
        $('#mobile-nav a').removeClass('on')
        $(this).addClass('on')
    })

    $('.main-box .goobne-bg .goobne-btn').mouseenter(function () {
        $(this).addClass('on')
    })

    $('.main-box .goobne-bg .goobne-btn').mouseleave(function () {
        $(this).removeClass('on')
    })

    $('.menu-list-wrap').slick({
        slide: 'div', //슬라이드 되어야 할 태그 ex) div, li 
        infinite: true, //무한 반복 옵션	 
        slidesToShow: 5, // 한 화면에 보여질 컨텐츠 개수
        slidesToScroll: 1, //스크롤 한번에 움직일 컨텐츠 개수
        speed: 1000, // 다음 버튼 누르고 다음 화면 뜨는데까지 걸리는 시간(ms)
        arrows: false, // 옆으로 이동하는 화살표 표시 여부
        dots: false, // 스크롤바 아래 점으로 페이지네이션 여부
        autoplay: true, // 자동 스크롤 사용 여부
        autoplaySpeed: 2000, // 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
        pauseOnHover: false, // 슬라이드 이동	시 마우스 호버하면 슬라이더 멈추게 설정
        vertical: false, // 세로 방향 슬라이드 옵션
        dotsClass: "slick-dots", //아래 나오는 페이지네이션(점) css class 지정
        draggable: false, //드래그 가능 여부 

        responsive: [ // 반응형 웹 구현 옵션
            {
                breakpoint: 1920, //화면 사이즈 1920px
                settings: {
                    //위에 옵션이 디폴트 , 여기에 추가하면 그걸로 변경
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 900, //화면 사이즈 900px
                settings: {
                    //위에 옵션이 디폴트 , 여기에 추가하면 그걸로 변경
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 501, //화면 사이즈 900px
                settings: {
                    //위에 옵션이 디폴트 , 여기에 추가하면 그걸로 변경
                    slidesToShow: 2
                }
            }
        ]
    });

    $('.goobster-box').slick({
        slide: 'div', //슬라이드 되어야 할 태그 ex) div, li 
        infinite: true, //무한 반복 옵션	 
        slidesToShow: 7, // 한 화면에 보여질 컨텐츠 개수
        slidesToScroll: 1, //스크롤 한번에 움직일 컨텐츠 개수
        speed: 1000, // 다음 버튼 누르고 다음 화면 뜨는데까지 걸리는 시간(ms)
        arrows: false, // 옆으로 이동하는 화살표 표시 여부
        dots: false, // 스크롤바 아래 점으로 페이지네이션 여부
        autoplay: true, // 자동 스크롤 사용 여부
        autoplaySpeed: 2000, // 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
        pauseOnHover: false, // 슬라이드 이동	시 마우스 호버하면 슬라이더 멈추게 설정
        vertical: false, // 세로 방향 슬라이드 옵션
        dotsClass: "slick-dots", //아래 나오는 페이지네이션(점) css class 지정
        draggable: false, //드래그 가능 여부 

        responsive: [ // 반응형 웹 구현 옵션
            {
                breakpoint: 1600, //화면 사이즈 1600px
                settings: {
                    //위에 옵션이 디폴트 , 여기에 추가하면 그걸로 변경
                    slidesToShow: 7
                }
            },
            {
                breakpoint: 1200, //화면 사이즈 1200px
                settings: {
                    //위에 옵션이 디폴트 , 여기에 추가하면 그걸로 변경
                    slidesToShow: 4
                }
            }
        ]
    });


    $('.goobne-tv-wrap').slick({
            slide: 'div', //슬라이드 되어야 할 태그 ex) div, li 
            infinite: true, //무한 반복 옵션	 
            slidesToShow: 3, // 한 화면에 보여질 컨텐츠 개수
            slidesToScroll: 1, //스크롤 한번에 움직일 컨텐츠 개수
            speed: 1000, // 다음 버튼 누르고 다음 화면 뜨는데까지 걸리는 시간(ms)
            arrows: false, // 옆으로 이동하는 화살표 표시 여부
            dots: false, // 스크롤바 아래 점으로 페이지네이션 여부
            autoplay: true, // 자동 스크롤 사용 여부
            autoplaySpeed: 2000, // 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
            pauseOnHover: false, // 슬라이드 이동	시 마우스 호버하면 슬라이더 멈추게 설정
            vertical: false, // 세로 방향 슬라이드 옵션
            dotsClass: "slick-dots", //아래 나오는 페이지네이션(점) css class 지정
            draggable: false, //드래그 가능 여부 

            responsive: [ // 반응형 웹 구현 옵션
                {
                    breakpoint: 1600, //화면 사이즈 1600px
                    settings: {
                        //위에 옵션이 디폴트 , 여기에 추가하면 그걸로 변경
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 1200, //화면 사이즈 1200px
                    settings: {
                        //위에 옵션이 디폴트 , 여기에 추가하면 그걸로 변경
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 900, //화면 사이즈 1200px
                    settings: {
                        //위에 옵션이 디폴트 , 여기에 추가하면 그걸로 변경
                        slidesToShow: 1
                    }
                }
            ]
    });

    $('.main-vi-wrap').slick({
        slide: 'div', //슬라이드 되어야 할 태그 ex) div, li 
        infinite: true, //무한 반복 옵션	 
        slidesToShow: 1, // 한 화면에 보여질 컨텐츠 개수
        slidesToScroll: 1, //스크롤 한번에 움직일 컨텐츠 개수
        arrows: false, // 옆으로 이동하는 화살표 표시 여부
        dots: true, // 스크롤바 아래 점으로 페이지네이션 여부
        autoplay: true, // 자동 스크롤 사용 여부
        autoplaySpeed: 4000, // 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
       
    });
//주문방법선택 슬라이드배너
$('.ad_banner').slick({
        slide: 'div', //슬라이드 되어야 할 태그 ex) div, li 
        infinite: true, //무한 반복 옵션	 
        slidesToShow: 1, // 한 화면에 보여질 컨텐츠 개수
        slidesToScroll: 1, //스크롤 한번에 움직일 컨텐츠 개수
        arrows: false, // 옆으로 이동하는 화살표 표시 여부
        dots:false, // 스크롤바 아래 점으로 페이지네이션 여부
        autoplay: true, // 자동 스크롤 사용 여부
        autoplaySpeed: 4000, // 자동 스크롤 시 다음으로 넘어가는데 걸리는 시간 (ms)
    });	
});

