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
                            <li class="goobne-text" onclick="location.href='{{url('/assets/transactions'.'/'.auth()->user()->userid)}}'">💥 내 자산 내역 보러가기</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/goal'.'/' . auth()->user()->userid) }}'">💥 나의 목표 보러가기</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/budget'.'/' . auth()->user()->userid) }}'">💥 예산 관리 하러가기</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/achievements') }}'">💥 업적 관리 하러가기</li>
                            <li class="goobne-text" onclick="location.href='{{url('/mofin'.'/' . auth()->user()->userid)}}'">💥 포인트 뽑으러 가기</li>
                            <li class="goobne-text" onclick="location.href='{{url('/mofin'.'/' . auth()->user()->userid)}}'">💥 아이템 뽑으러 가기</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/users/profile'.'/' . auth()->user()->userid) }}'">💥 캐릭터 꾸미러 가기</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/static'.'/' . auth()->user()->userid) }}'">💥 내 통계 보러가기</li>
                            <li class="goobne-text" onclick="location.href='{{route('users.modify')}}'">💥 내 정보 수정하기</li>
                            <li class="goobne-text" onclick="location.href='{{ url('/rank'.'/' . auth()->user()->userid) }}'">💥 전체 랭킹 보러가기</li>
                        </ul>
                    </div>
                </div>

            </div>
            <article class="l-layout founded" style="padding-top: 0;">
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
                                        @foreach($pointrank as $value)
                                        <dd>{{$value->username}}님</dd>
                                        <dd><a style="color: #ff7676" href={{ url('/users/profile'.'/' . $value->userid) }}>모핀이 보러가기</a></dd>
                                        <dd>보유포인트 : {{$value->point}}</dd>
                                        @endforeach
                                    </dl>
                                    <div class="center-box">
                                        <p class="img">
                                            <img src="./resources/assets/images/main/crown.png" alt="왕관수여">
                                        </p>
                                        <div class="text">
                                            @foreach($loginrank as $value)
                                            <p>로그인왕 : {{$value->username}}님</p>
                                            <span style="color: #ff7676">{{$value->login_count}}회 방문! 자주 와주셔서 감사합니다!</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <dl class="box">
                                        <dt class="l-num">아이템 뽑기 TOP 1</dt>
                                        @foreach($itemdrawrank as $value)
                                        <dd>{{$value->username}}님</dd>
                                        <dd><a style="color: #ff7676" href={{ url('/users/profile'.'/' . $value->userid) }}>모핀이 보러가기</a></dd>
                                        <dd>아이템 뽑은 횟수 : {{$value->item_draw_count}}</dd>
                                        @endforeach
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
                                        <p class="l-num num">이번달 남은 예산</p>
                                        <p class="l-num tit">{{number_format($all - $sumamount)}}원</p>
                                        <p class="l-num num">이번주 남은 예산</p>
                                        <p class="l-num tit">{{number_format($data['leftBudget'])}}원</p>


                                        @if($data['dailyBudget'] < 0 || ($all - $sumamount) < 0 || $data['sumDayAmount'] < 0)
                                            <p class="sub">예산을 초과하셨어요! <br> 지출을 조금 줄일 필요가 있습니다.</p>
                                        @elseif($data['dailyBudget'] == 0 && ($all - $sumamount) == 0 && $data['sumDayAmount'] == 0)
                                            <p class="sub">예산을 설정해 주세요! <br> 예산 설정은 자산 관리의 시작입니다.</p>
                                        @else
                                            <p class="sub">잘하고 있어요! <br> 예산을 잘 지키는 건 부자의 지름길이죠!</p>
                                        @endif


                                    </li>
                                    <li>
                                        <p class="l-num num">오늘 사용 가능한 금액</p>
                                        <p class="l-num tit">{{number_format($data['dailyBudget'])}}원</p>
                                        <p class="l-num num">오늘 지출액</p>
                                        <p class="l-num tit">{{number_format($data['sumDayAmount'])}}원</p>
                                        @if($data['dailyBudget'] <= 0)
                                            <p class="sub">오늘은 지출 하시면 안됩니다! <br> 이미 예산을 초과했어요! </p>
                                        @else
                                            <p class="sub">잘하고 있어요! 오늘 지출은 <br> {{number_format($data['dailyBudget'])}}원 보다 적게 유지해 주세요!</p>
                                        @endif

                                    </li>
                                </ul>
                            </div>
                            @foreach($goals as $goal)
                            @if($goal)


                            <div class="l-c-pt sys-pro">
                                <dl class="l-comm">
                                    <dt class="tit">
                                        내 목표 현황
                                    </dt>
                                    <dd> 가장 임박한 목표 : {{$goal->title}}</dd>

                                </dl>
                                <div class="sys-pro__half">
                                    <div class="half">
                                        <p class="text">목표 달성 률: {{ number_format(($goal->balance) / ($goal->amount) * 100)  }}%</p>


                                        <p class="text">남은 기간: {{ now()->diffInDays($goal->endday) + 1 }}일</p>

                                    </div>
                                    <div class="half">
                                        <p class="text">하루에 모아야 하는 돈: {{ number_format(($goal->amount - $goal->balance) / (now()->diffInDays($goal->endday) + 1)) }} 원</p>



                                        <p class="text" onclick="location.href='{{url('/goal')}}'">내 목표 보러가기(click)</p>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                            @else
                            <div class="l-c-pt sys-pro">
                                <dl class="l-comm">
                                    <dt class="tit">
                                        내 목표 현황
                                    </dt>
                                    <dd> 설정된 목표가 없습니다. </dd>
                                </dl>
                                <div class="sys-pro__half">
                                    <div class="half">
                                        <p class="text">목표를 설정해 주세요.</p>
                                        {{-- <p class="text">남은 기간: 000일</p> --}}
                                    </div>
                                    <div class="half">
                                        {{-- <p class="text">하루에 모아야 하는 돈: 000000000 원</p> --}}
                                        <p class="text" onclick="location.href='{{url('/goal')}}'">내 목표 설정하기(click)</p>
                                    </div>
                                </div>
                            </div>

                                
                            @endif
                        </section>


                    </div>
                </div>
            </article>


        </div>

        @endsection

