@extends('layout.layout')

@section('title', 'WELCOME TO FINMATE')

@section('contents')

<div id="content">
    <div class="inner">
        <div class="main-slick-wrap">
            <div class="con-box">
                <p class="title wow fadeInUp">The Fin.mate</p>
                <div id="infinite" class="goobne-slider wow fadeInUp">
                    <div class="container goobne-wrapper">
                        <ul class="goobne-line">
                            <li class="goobne-text" onclick="location.href='{{ url('/assets'.'/' . auth()->user()->userid) }}'">💥 내 자산 보러가기</li>
                            <li class="goobne-text" onclick="location.href='{{url('/assets/transactions'.'/'.auth()->user()->userid)}}'">💥 내 자산 내역</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/goal'.'/' . auth()->user()->userid) }}'">💥 나의 목표</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/budget'.'/' . auth()->user()->userid) }}'">💥 예산 관리</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/achievements') }}'">💥 업적 관리</li>
                            <li class="goobne-text" onclick="location.href='{{url('/mofin'.'/' . auth()->user()->userid)}}'">💥 포인트 뽑기</li>
                            <li class="goobne-text" onclick="location.href='{{url('/mofin'.'/' . auth()->user()->userid)}}'">💥 아이템 뽑기</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/users/profile'.'/' . auth()->user()->userid) }}'">💥 캐릭터 꾸미기</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/static'.'/' . auth()->user()->userid) }}'">💥 통계 보러가기</li>
                            <li class="goobne-text" onclick="location.href='{{route('users.modify')}}'">💥 내 정보</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/rank'.'/' . auth()->user()->userid) }}'">💥 랭킹 보러가기</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/assets'.'/' . auth()->user()->userid) }}'">💥 내 자산 보러가기</li>
                            <li class="goobne-text" onclick="location.href='{{url('/assets/transactions'.'/'.auth()->user()->userid)}}'">💥 내 자산 내역</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/goal'.'/' . auth()->user()->userid) }}'">💥 나의 목표</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/budget'.'/' . auth()->user()->userid) }}'">💥 예산 관리</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/achievements') }}'">💥 업적 관리</li>
                            <li class="goobne-text" onclick="location.href='{{url('/mofin'.'/' . auth()->user()->userid)}}'">💥 포인트 뽑기</li>
                            <li class="goobne-text" onclick="location.href='{{url('/mofin'.'/' . auth()->user()->userid)}}'">💥 아이템 뽑기</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/users/profile'.'/' . auth()->user()->userid) }}'">💥 캐릭터 꾸미기</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/static'.'/' . auth()->user()->userid) }}'">💥 통계 보러가기</li>
                            <li class="goobne-text" onclick="location.href='{{route('users.modify')}}'">💥 내 정보</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/rank'.'/' . auth()->user()->userid) }}'">💥 랭킹 보러가기</li>
                        </ul>
                    </div>
                </div>

            </div>
			
            <article class="l-layout founded">
                <div class="my_page my_correction_main my_page_order_main">
                    <div class="l-inner">

                        <section class="founded__franchise">
                            <div class="l-c-pt diff">
                                <dl class="l-comm">
                                    <dt class="tit">
                                        랭킹
                                    </dt>
                                    <dd class="l-hidden">없음</dd>
                                </dl>
                                <div class="diff__desc">
                                    <dl class="box">
                                        <dt class="l-num">포인트 보유 TOP 1</dt>
                                        <dd>닉네임</dd>
                                        <dd>모핀이 보러가기</dd>
                                        <dd>카운트</dd>
                                    </dl>
                                    <div class="center-box">
                                        <p class="img">
                                            <img src="https://cdn.goob-ne.com/goobne/resources/assets/images/contents/c-founded-diff.png" alt="오븐구이치킨">
                                        </p>
                                        <div class="text">
                                            <span>로그인왕 : 닉네임</span>
                                            <p>자주 와주셔서 감사합니다!</p>
                                        </div>
                                    </div>
                                    <dl class="box">
                                        <dt class="l-num">아이템 뽑기 TOP 1</dt>
                                        <dd>닉네임</dd>
                                        <dd>모핀이 보러가기</dd>
                                        <dd>카운트</dd>
                                    </dl>
                                </div>
                            </div>

                            <div class="l-c-pt sys-cook">
                                <dl class="l-comm">
                                    <dt class="tit">
                                        내 예산 현황
                                    </dt>
                                </dl>
                                <ul class="sys-cook__list">
                                    <li>
                                        <p class="l-num num">일일 예산</p>
                                        <p class="l-num tit">오늘 예산 금액: {{number_format($data['dailyBudget'])}}</p>
                                        <p class="sub">이번달 남은 예산 : {{number_format($all - $sumamount)}}</p>
                                    </li>
                                    <li>
                                        <p class="l-num num">일일 지출</p>
                                        <p class="tit">오늘 지출금액: {{number_format($data['sumDayAmount'])}}</p>
                                        @if($data['dailyBudget'] < 0 || ($all - $sumamount) < 0 || $data['sumDayAmount'] < 0)

                                            <p class="sub">예산을 초과하셨어요! <br> 지출을 조금 <br> 줄일 필요가 있습니다.</p>

                                        @elseif($data['dailyBudget'] == 0 && ($all - $sumamount) == 0 && $data['sumDayAmount'] == 0)
                                            <p class="sub">예산을 설정해 주세요! <br> 예산 설정은 <br> 자산 관리의 시작입니다.</p>

                                        @else
                                            <p class="sub">잘하고 있어요! <br> 예산을 잘 지켜서 <br> 소비를 줄이는 건 <br> 부자의 지름길이죠!</p>


                                        @endif
                                        
                                    </li>
                                </ul>
                            </div>

                            <div class="l-c-pt sys-pro">
                                <dl class="l-comm">
                                    <dt class="tit">
                                        내 목표 현황
                                    </dt>
                                    <dd class="">대표목표 : 목표 이름</dd>
                                </dl>
                                <div class="sys-pro__half">
                                    <div class="half">
                                        <p class="text">목표 달성 률 및 게이지</p>
                                    </div>
                                    <div class="half">
                                        <p class="text">칭찬 or 조언 </p>
                                    </div>
                                </div>
                            </div>

                        </section>


                    </div>
                </div>
            </article>


        </div>

        @endsection

