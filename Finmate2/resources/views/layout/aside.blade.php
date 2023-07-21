<aside class="aside">


    <style>
        /* S: 230502 추가: 르세라핌 배너 */
        .hamberger_banner {
            width: 496px;
            margin-left: -7rem;
            margin-bottom: 7rem;
        }

        @media (max-width: 1024px) {
            .hamberger_banner {
                width: 49rem;
                margin-left: -7rem;
                margin-bottom: 4rem;
            }
        }

        @media (max-width: 900px) {
            .hamberger_banner {
                width: 49rem;
                margin-left: -4rem;
            }
        }

        @media (max-width: 500px) {
            .hamberger_banner {
                width: 89vw
            }
        }
    </style>
    
    @guest
    <div class="aside__dimmed-bg l-hidden"></div>
    <div class="aside__lnb">
        <div class="aside__lnb-inner">
            <button type="button" class="aside__lnb-close">X</button>
            <div class="aside__lnb-login">
                <a href="/users/login" class="link">Login</a>
                <span class="bar"></span>
                <a href="/users/registration" class="link">Join</a>
            </div>
            <div class="aside__scroll">
                <ul class="aside__lnb-list">
                    <li class="list-arrow">
                        <a href="/">메인</a>
                    </li>

                    <li class="list-arrow">
                        <a href="#none">자산</a>
                        <ul class="dept">
                            <li><a href="/users/login">자산</a></li>
                            <li><a href="/users/login">자산내역</a></li>
                        </ul>
                    </li>

                    <li><a href="/users/login">예산</a></li>
                    <li><a href="/users/login">목표</a></li>
                    <li><a href="/users/login">통계</a></li>
                    <li><a href="/users/login">업적</a></li>

                    <li class="list-arrow">
                        <a href="#none">모핀</a>
                        <ul class="dept ">
                            <li><a href="/users/login">모핀</a></li>
                            <li><a href="/users/login">뽑기</a></li>
                        </ul>
                    </li>

                    <li><a href="/users/login">랭킹</a></li>

                </ul>
                <dl class="aside__num">
                    <dt>이메일 문의</dt>
                    <dd>fin.matee@gmail.com</dd>
                </dl>

            <a href="/">
                <img class="hamberger_banner" src="/resources/assets/images/banner/banner_aside.png">
            </a>

            </div>
        </div>
    </div>

@endguest
        @auth


<div class="aside__dimmed-bg l-hidden"></div>
    <div class="aside__lnb">
        <div class="aside__lnb-inner">
            <button type="button" class="aside__lnb-close">X</button>
            <div class="aside__lnb-login">
                <a href="{{route('users.modify')}}" class="link">Myinfo</a>
                <span class="bar"></span>
                <a href="{{ route('users.logout')}}" class="link">Logout</a>
            </div>
            <div class="aside__scroll">
                <ul class="aside__lnb-list">
                    <li class="list-arrow">
                        <a href="/">메인</a>
                    </li>

                    <li class="list-arrow">
                        <a href="#none">자산</a>
                        <ul class="dept">
                            <li><a href="{{ url('/assets'.'/' . auth()->user()->userid) }}">자산</a></li>
                            <li><a href="{{url('/assets/transactions'.'/'.auth()->user()->userid)}}">자산내역</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ url('/budget') }}">예산</a></li>
                    <li><a href="{{ url('/goal') }}">목표</a></li>
                    <li><a href="{{ url('/static'.'/' . auth()->user()->userid) }}">통계</a></li>
                    <li><a href="{{ url('/achievements') }}">업적</a></li>

                    <li class="list-arrow">
                        <a href="#none">모핀</a>
                        <ul class="dept ">
                            <li><a href="{{ url('/users/profile'.'/' . auth()->user()->userid) }}">모핀</a></li>
                            <li><a href="{{url('/mofin'.'/' . auth()->user()->userid)}}">뽑기</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ url('/rank'.'/' . auth()->user()->userid) }}">랭킹</a></li>


                </ul>
                <dl class="aside__num">
                    <dt>이메일 문의</dt>
                    <dd>fin.matee@gmail.com</dd>
                </dl>
                
            <a href="/">
                <img class="hamberger_banner" src="/resources/assets/images/banner/banner_aside.png">
            </a>


            </div>
        </div>
    </div>
@endauth
</aside>