/*메인롤링배너 background height 리사이징*/
$(window).load(function(){   
  
  
   var windowWidth = $('.main-vi-wrap .main-box_hight').height(),
                    windowHeight = $('.main-vi-wrap .main-box_hight').height(),
                    adjHeight = windowHeight;
                $('.main-box .goobne-img_office_bg').css({
                    'height': adjHeight + 'px'
                });
           
            $(window).resize(function() {
                    windowHeight = $('.main-vi-wrap .main-box_hight').height(),
                    adjHeight = windowHeight;
                $('.main-box .goobne-img_office_bg').css({
                    'height': adjHeight + 'px'
                });
        });
	 	
        
                
  $(function() {
        var header = document.querySelector("#header");
        var headerHeight = header.offsetHeight;
		var lastScrollTop = 0;
		var delta = 5;
		var fixBox = document.querySelector('#mobile-nav');
		//var fixBoxHeight = fixBox.offsetHeight;
		var didScroll;

        window.onscroll = function () {
		  didScroll = true;
          var windowTop = window.scrollY;
            // 스크롤 세로값이 헤더높이보다 크거나 같으면 
            // 헤더에 클래스 'drop'을 추가한다
          if (windowTop >= headerHeight) {
            header.classList.add("drop");
          } 
          // 아니면 클래스 'drop'을 제거
          else {
            header.classList.remove("drop");
          }
        };
		//0.25초마다 스크롤 여부 체크하여 스크롤 중이면 hasScrolled() 호출
		setInterval(function(){
			if(didScroll){
				hasScrolled();
				didScroll = false;
			}
		}, 250);

		function hasScrolled(){
			var nowScrollTop = window.scrollY;
			if(Math.abs(lastScrollTop - nowScrollTop) <= delta){
				return;
			}
			if(nowScrollTop > lastScrollTop && nowScrollTop > headerHeight){
				//Scroll down
				fixBox.classList.remove('show');
				fixBox.classList.add('hidden_cla');
			}else{
				if(nowScrollTop + window.innerHeight < document.body.offsetHeight){
					//Scroll up
					fixBox.classList.add('show');
					fixBox.classList.remove('hidden_cla');
				}
			}
			lastScrollTop = nowScrollTop;
		}
	});
	

//모바일 체크
function isMobile(){
 return /(iphone|ipod|ipad|android|blackberry|windows ce|palm|symbian)/i.test(navigator.userAgent);
}
 
//모바일이 아닌경우
if(!isMobile()){
    //사이즈 조정시 리사이징
    var startBool = true;
    $( window ).resize( function(){
 
        if( startBool ) {
            
            // var locUrl = location.href;
            // location.href = locUrl;        
            startBool = false;
            
        }
 
    });
}
	
});
	

	
	
	