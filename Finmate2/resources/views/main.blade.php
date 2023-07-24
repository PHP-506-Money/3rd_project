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
									<p class="mid">당신만의 모핀이를</p>
									<p class="last">골라<span class="mid"> 꾸며주세요!</span></p>
								</div>
								{{-- <div class="goobne-text line">
									<p>쉽고 재미있는</p>
									<p class="last">자산관리 <span class="mid">서비스</span></p>
								</div> --}}
								<div class="goobne-text line">
									<p class="mid">당신만의 모핀이를</p>
									<p class="last">골라<span class="mid"> 꾸며주세요!</span></p>
								</div>
							</div>
							<div class="goobne-bg wow fadeInUp">
								<div class="goobne-img">
									<img src="/resources/assets/images/banner/main_slide3.png" alt="">
								</div>
								{{-- <button class="goobne-btn btn2">
								    <div class="img">
								        <img src="/resources/assets/images/common/main_bg_icon_06.png" alt="">
								    </div>
								</button> --}}
							</div>
						</div>
						<div class="main-box main-box_hight">
							<div class="main-txt-area wow fadeInUp">
								<div class="goobne-text">
									<p class="mid">목표를 설정하여</p>
									<p class="last">달성해보세요!</span></p>
								</div>
								<div class="goobne-text line">
									<p class="mid">목표를 설정하여</p>
									<p class="last">달성해보세요!</span></p>
								</div>
							</div>
							<div class="goobne-bg wow fadeInUp">
								<div class="goobne-img">
									<img src="/resources/assets/images/banner/main_slide4.png" alt="">
								</div>
							</div>
						</div>
						<div class="main-box main-box_hight">
							<div class="main-txt-area wow fadeInUp">
								<div class="goobne-text">
									<p class="mid">랭킹에 이름을</p>
									<p class="last">장식해보세요!</span></p>
								</div>
								<div class="goobne-text line">
									<p class="mid">랭킹에 이름을</p>
									<p class="last">장식해보세요!</span></p>
								</div>
							</div>
							<div class="goobne-bg wow fadeInUp">
								<div class="goobne-img">
									<img src="/resources/assets/images/banner/main_slide5.png" alt="">
								</div>
							</div>
						</div>
				</div>
				<div class="con-box menu-box">
					<div class="inner">
						<p class="l-main-title wow fadeInUp">Our Service</p>
						<div class="menu-list-wrap wow fadeInUp">
							<a href="{{ route('users.login') }}" class="menu-list" target="self">
								<div class="menu-img">
									<img src="/resources/assets/images/banner/assets.png" alt="자산관리">
								</div>
								<p class="menu-name">✨자산관리</p>
							</a>
                            <a href="{{ route('users.login') }}" class="menu-list  top" target="self">
                                <div class="menu-img">
                                    <img src="/resources/assets/images/banner/transaction.png" alt="자산내역관리">
                                </div>
                                <p class="menu-name">자산내역관리</p>
                            </a>
							<a href="{{ route('users.login') }}" class="menu-list " target="self">
								<div class="menu-img">
									<img src="/resources/assets/images/banner/decoChar.png" alt="꾸미기">
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
									<img src="/resources/assets/images/banner/budget.png" alt="예산설정">
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
				            <div class="event-list wow fadeInUp">
				                <a href="{{ route('users.login') }}" target="self">
									<div class="mo-thum">
									    <img src="./resources/assets/images/main/catmo.jpg" alt="catmofin">
									</div>
				                    <div class="status half">
				                        <p class="sub">[공지]</p>
				                    </div>
				                    <div class="event-title half">
				                        <p class="main-text">Fin.mate 서비스 시작</p>
				                    </div>
				                </a>
				            </div>
				            <div class="event-list  wow fadeInUp">
				                <a href="{{ route('users.login') }}" target="self">
									<div class="mo-thum">
									    <img src="./resources/assets/images/main/catmo.jpg" alt="catmofin">
									</div>
				                    <div class="status half">
				                        <p class="sub">[이벤트]</p>
				                    </div>
				                    <div class="event-title half">
				                        <p class="main-text">첫 이벤트! 3달간 회원가입시 600포인트를 드립니다</p>
				                    </div>
				                </a>
				            </div>
				            <div class="event-list  wow fadeInUp">
				                <a href="{{ route('users.login') }}" target="self">
									<div class="mo-thum">
									    <img src="./resources/assets/images/main/catmo.jpg" alt="catmofin">
									</div>
				                    <div class="status half">
				                        <p class="sub">[공지]</p>
				                    </div>
				                    <div class="event-title half">
				                        <p class="main-text">다음 모핀 친구는 어떤 동물일까요?</p>
				                    </div>
				                </a>
				            </div>
				            <div class="event-list  wow fadeInUp">
				                <a href="{{ route('users.login') }}" target="self">
									<div class="mo-thum">
									    <img src="./resources/assets/images/main/catmo.jpg" alt="catmofin">
									</div>
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
				</div>
			</div>
@endsection
