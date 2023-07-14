@extends('layout.layout')

@section('title', 'WELCOME TO FINMATE')

@section('contents')

<div id="content">
			<div class="inner">
				<div class="main-slick-wrap">
					<div class="main-vi-wrap">


						<div class="main-box main-box_hight">
							<div class="main-txt-area wow fadeInUp">
								<div class="goobne-text">
									<p>Welcome</p>
									<p class="mid">to the</p>
									<p class="last">FIN. <span class="mid">MATE</span></p>
								</div>
								<div class="goobne-text line">
									<p>Welcome</p>
									<p class="mid">to the</p>
									<p class="last">FIN. <span class="mid">MATE</span></p>
								</div>
							</div>
							<div class="goobne-bg wow fadeInUp">
								<div class="goobne-img">
									<img src="/resources/assets/images/main/fin_bg_2.png"
										alt="">
								</div>
								<button class="goobne-btn btn1">
									<div class="img">
										<img src="https://cdn.goob-ne.com/goobne/resources/assets/images/common/main_bg_icon_01.png"
											alt="">
									</div>
									<span>✨자산관리<br>서비스 등장!</span>
								</button>
								<button class="goobne-btn btn2">
									<div class="img">
										<img src="/resources/assets/images/common/main_bg_icon_05.png"
											alt="">
									</div>
								</button>

								<button class="goobne-menu-btn btn1">
									예산기능
								</button>
								<button class="goobne-menu-btn btn2">
									통계기능
								</button>
							</div>
						</div>
						<div class="main-box main-box_hight">
							<div class="main-txt-area wow fadeInUp">
								<div class="goobne-text">
									<p>쉽고 재미있는</p>
									<p class="last">자산관리 <span class="mid">서비스</span></p>
								</div>
								<div class="goobne-text line">
									<p>쉽고 재미있는</p>
									<p class="last">자산관리 <span class="mid">서비스</span></p>
								</div>
							</div>
							<div class="goobne-bg wow fadeInUp">
								<div class="goobne-img">
									<img src="/resources/assets/images/banner/main_slide2.png" alt="">
								</div>
								<button class="goobne-btn btn2">
								    <div class="img">
								        <img src="/resources/assets/images/common/main_bg_icon_06.png" alt="">
								    </div>
								</button>

				
							</div>
						</div>


				</div>





				<div class="con-box menu-box">
					<div class="inner">
						<p class="l-main-title wow fadeInUp">Our Service</p>
						<div class="menu-list-wrap wow fadeInUp">



							<a href="{{ route('users.login') }}" class="menu-list" target="self">

								<div class="menu-img">
									<img src="/resources/assets/images/banner/assets.png"

										alt="자산관리">

								</div>
								<p class="menu-name">✨자산관리</p>
							</a>

                            <a href="{{ route('users.login') }}" class="menu-list  top" target="self">

                                <div class="menu-img">
                                    <img src="/resources/assets/images/banner/transaction.png"

									alt="자산내역관리">

                                </div>
                                <p class="menu-name">자산내역관리</p>
                            </a>




							<a href="{{ route('users.login') }}" class="menu-list " target="self">

								<div class="menu-img">
									<img src="/resources/assets/images/banner/decoChar.png"

										alt="꾸미기">
								</div>
								<p class="menu-name">모핀꾸미기</p>
							</a>


							<a href="{{ route('users.login') }}" class="menu-list  top" target="self">

								<div class="menu-img">
									<img src="/resources/assets/images/banner/itemdraw.png"
										alt="아이템뽑기">
								</div>
								<p class="menu-name">아이템뽑기</p>
							</a>


							<a href="{{ route('users.login') }}" class="menu-list " target="self">

								<div class="menu-img">
									<img src="/resources/assets/images/banner/setGoal.png"

										alt="목표">
								</div>
								<p class="menu-name">목표설정</p>
							</a>



							<a href="{{ route('users.login') }}" class="menu-list  top" target="self">

								<div class="menu-img">
									<img src="/resources/assets/images/banner/budget.png"

										alt="예산설정">

								</div>
								<p class="menu-name">예산설정</p>
							</a>


							<a href="{{ route('users.login') }}" class="menu-list " target="self">

								<div class="menu-img">
									<img src="/resources/assets/images/banner/static.png"
										alt="통계관리">
								</div>
								<p class="menu-name">통계관리</p>
							</a>



							<a href="{{ route('users.login') }}" class="menu-list  top" target="self">

								<div class="menu-img">
									<img src="/resources/assets/images/banner/achieve.png"
										alt="DESSERT">
								</div>
								<p class="menu-name">업적관리</p>
							</a>
						</div>
					</div>
				</div>



				<div class="con-box">
				    <div class="con_wrap">
				        <p class="l-main-title wow fadeInUp">Fin news</p>
				        <div class="event-list-wrap">
				            <div class="event-list on wow fadeInUp">
				                <a href="{{ route('users.login') }}" target="self">

				                    <div class="status half">
				                        <p class="sub">[프로모션]</p>
				                    </div>
				                    <div class="event-title half">
				                        <p class="main-text">Fin.mate 서비스 시작</p>
				                    </div>
				                </a>
				            </div>
				            <div class="event-list  wow fadeInUp">
				                <a href="{{ route('users.login') }}" target="self">

				                    <div class="status half">
				                        <p class="sub">[이벤트]</p>
				                    </div>
				                    <div class="event-title half">
				                        <p class="main-text">첫 자산연결 성공시 상품 추첨기회 제공</p>
				                    </div>
				                </a>
				            </div>


				            <div class="event-list  wow fadeInUp">
				                <a href="{{ route('users.login') }}" target="self">

				                    <div class="status half">
				                        <p class="sub">[이벤트]</p>
				                    </div>
				                    <div class="event-title half">
				                        <p class="main-text">첫 이벤트! 3달간 포인트 100에서 600으로 증정합니다.</p>
				                    </div>
				                </a>
				            </div>





				            <div class="event-list  wow fadeInUp">
				                <a href="{{ route('users.login') }}" target="self">

				                    <div class="status half">
				                        <p class="sub">[공지]</p>
				                    </div>
				                    <div class="event-title half">
				                        <p class="main-text">2023.07.10 새벽 2시부터 5시 사이 점검이 있을 예정입니다.</p>
				                    </div>
				                </a>
				            </div>

				        </div>
				    </div>
				    <!-- //230130 수정 -->

				</div>

			</div>

@endsection
