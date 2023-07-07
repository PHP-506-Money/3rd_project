<div id="header">


    <div class="loading-bar on"></div>
    <div class="inner">
        

        @guest
        <div class="logo">
            <a href="{{ route('main') }}">

                <img src="/resources/assets/images/common/logo.png" alt="logo">
            </a>
        </div>

            <!-- 모바일 -->

            <div class="menu">
                <ul>
                    <li >
                        <a href="{{ route('users.login') }}">자산</a>
                    </li>

                    <li><a href="{{ route('users.login') }}">예산</a></li>

                    <li><a href="{{ route('users.login') }}">목표</a></li>

                    <li><a href="{{ route('users.login') }}">통계</a></li>

                    <li><a href="{{ route('users.login') }}">업적</a></li>

                </ul>
            </div>
            <div class="btn-cnt-area">


                <div class="login_div_box log_box">
                    <div onClick="location.href='{{ route('users.login') }}'">Login</div>
                    <div onClick="location.href='{{ route('users.registration') }}'">Join</div>
                </div>
                <!-- <a href="/account/login" class="link"><div class="login-btn"></div></a> -->


                <!-- <button class="search-icon mobile"></button> -->
                <div class="sub-menu-btn">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>

        @endguest
        @auth
        <div class="logo">
            <a href="{{ url('/main2') }}">


                <img src="/resources/assets/images/common/logo.png" alt="logo">
            </a>
        </div>

            <!-- 모바일 -->

            <div class="menu">
                <ul>
                    <li class="order">
                        <a href="{{ url('/assets'.'/' . auth()->user()->userid) }}">자산</a>

                        <div class="order_ob-wrap">
                            <div class="order_ob">
                                <button onclick="location.href='{{ url('/assets'.'/' . auth()->user()->userid) }}'">
                                    <img src="https://cdn.goob-ne.com/goobne/resources/assets/images/common/order_ob01.svg" alt="" />자산
                                </button>
                                <button onClick="location.href='{{url('/assets/transactions'.'/'.auth()->user()->userid)}}'">
                                    <img src="https://cdn.goob-ne.com/goobne/resources/assets/images/common/order_ob02.svg" alt="" />자산내역
                                </button>
                            </div>
                        </div>
                    </li>

                    <li><a href="{{ url('/budget'.'/' . auth()->user()->userid) }}">예산</a></li>
                    <li><a href="{{ url('/goal'.'/' . auth()->user()->userid) }}">목표</a></li>
                    <li><a href="{{ url('/static'.'/' . auth()->user()->userid) }}">통계</a></li>
                    <li><a href="{{ url('/achievements') }}">업적</a></li>
                    <li class="mofin">
                        <a href="{{ url('/users/profile'.'/' . auth()->user()->userid) }}">모핀</a>
                        <div class="mofin_ob">
                            <button onclick="location.href='{{ url('/users/profile'.'/' . auth()->user()->userid) }}'">
                                <img src="https://cdn.goob-ne.com/goobne/resources/assets/images/common/order_ob01.svg" alt="" />모핀
                            </button>
                            <button onClick="location.href='{{url('/mofin'.'/' . auth()->user()->userid)}}'">
                                <img src="https://cdn.goob-ne.com/goobne/resources/assets/images/common/order_ob02.svg" alt="" />뽑기
                            </button>
                            <button onClick="location.href='{{ url('/rank'.'/' . auth()->user()->userid) }}'">
                                <img src="https://cdn.goob-ne.com/goobne/resources/assets/images/common/order_ob02.svg" alt="" />랭킹
                            </button>

                        </div>

                    </li>




                </ul>
            </div>
            <div class="btn-cnt-area">


                <div class="login_div_box log_box">
                    <div onClick="location.href='{{route('users.modify')}}'">Myinfo</div>
                    <div onClick="location.href='{{ route('users.logout') }}'">Logout</div>
                </div>
                <!-- <a href="/account/login" class="link"><div class="login-btn"></div></a> -->


                <!-- <button class="search-icon mobile"></button> -->
                <div class="sub-menu-btn">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>

        @endauth
        
    </div>

</div>
