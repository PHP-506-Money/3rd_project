@extends('layout.layout')

@section('title', 'RANK')

@section('header', 'RANK')

@section('contents')

<link rel="stylesheet" href="{{ asset('/css/kjav2.css') }}">

<br><br>

<div class="rankTit">
    <div class="mainTit">FIN.MATE Rankings</div>
    <h5>(닉네임클릭시 클릭한 회원의 모핀이를 구경할수있습니다!)</h5>
</div>

<div class ="search-moffin">
    <form action="{{ route('mofin.search',[auth()->user()->userid]) }}" method="post">
        @csrf
        <label for="search_name"></label>
        <input type="text" name="search_name" id ="search_name" placeholder="아이디를 검색해보세요"> <button type="submit"><img src="{{ asset('/img/search2.png') }}" alt="돋보기"></button>
    </form>
</div>

@if(session()->has('errmsg'))
        <p class = "mofinmsg">
        {{ session('errmsg') }}
        </p>
@endif

<br><br>

<div class="tabmenu">
    <ul>
        <li id="tab1" class="btnCon active"><a class="tabname active">포인트</a>
        </li>
        <li id="tab2" class="btnCon"><a class="tabname">로그인</a>
        </li>    
        <li id="tab3" class="btnCon"><a class="tabname">아이템뽑기</a>
        </li>
    </ul>
        <div class="tabCon tabCon1 active">
            {{-- <h2>포인트 순위</h2> --}}
            <table>
                <thead>
                    <tr>
                        <th>순위</th>
                        <th>닉네임</th>
                        <th>포인트</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pointrank as $key => $value)
                        @if($key < 3)
                            <div class="rankeruser">
                                    <p class = "rankk">{{$key +1}} 위</p>
                                    <div class="moffin">
                                        <img class ="mof" src="{{ asset('/img/moffin' . $value->moffintype . '.png') }}" alt="">
                                        <div class="charitem">
                                            @foreach ($pointranker as $item)
                                                @if($item->userid == $value->userid)
                                                    <input type="hidden" name="itemflg{{ $item->itemno }}" value="{{ $item->itemflg }}">
                                                    <img id="charitem{{ $item->itemno }}" class="{{ $item->itemflg == 1 ? '' : 'noneimg' }} imgposition" src="{{ asset('/img/charitem'.$item->itemno.'.png') }}">
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <p><a href={{ url('/users/profile'.'/' . $value->userid) }}>{{$value->username}}</a></p>
                                    <p>{{$value->point}}</p>
                                </div>
                        @else
                            <tr>
                                <td>{{$key +1}} 위</td>
                                <td><a href={{ url('/users/profile'.'/' . $value->userid) }}>{{$value->username}}</a></td>
                                <td>{{$value->point}}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tabCon tabCon2">
            {{-- <h2>로그인 순위</h2> --}}
            <table>
                <thead>
                    <tr>
                        <th>순위</th>
                        <th>닉네임</th>
                        <th>로그인횟수</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loginrank as $key => $value)
                        @if($key < 3)
                            <div class="rankeruser">
                                <p>{{$key +1}} 위</p>
                                <div class="moffin">
                                    <img class ="mof" src="{{ asset('/img/moffin' . $value->moffintype . '.png') }}" alt="">
                                    <div class="charitem">
                                        @foreach ($loginranker as $item)
                                            @if($item->userid == $value->userid)
                                                <input type="hidden" name="itemflg{{ $item->itemno }}" value="{{ $item->itemflg }}">
                                                <img id="charitem{{ $item->itemno }}" class="{{ $item->itemflg == 1 ? '' : 'noneimg' }} imgposition" src="{{ asset('/img/charitem'.$item->itemno.'.png') }}">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <p><a href={{ url('/users/profile'.'/' . $value->userid) }}>{{$value->username}}</a></p>
                                <p>{{$value->login_count}}</p>
                            </div>
                        @else
                            <tr>
                                <td>{{$key +1}} 위</td>
                                <td><a href={{ url('/users/profile'.'/' . $value->userid) }}>{{$value->username}}</a></td>
                                <td>{{$value->login_count}}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tabCon tabCon3">
            {{-- <h2>아이템뽑기 순위</h2> --}}
            <table>
                <thead>
                    <tr>
                        <th>순위</th>
                        <th>닉네임</th>
                        <th>아이템뽑기 횟수</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach($itemdrawrank as $key => $value)
                        @if($key< 3)
                            <div class="rankeruser">
                                <p>{{$key +1}} 위</p>
                                <div class="moffin">
                                    <img class ="mof" src="{{ asset('/img/moffin' . $value->moffintype . '.png') }}" alt="">
                                    <div class="charitem">
                                        @foreach ($drawranker as $item)
                                            @if($item->userid == $value->userid)
                                                <input type="hidden" name="itemflg{{ $item->itemno }}" value="{{ $item->itemflg }}">
                                                <img id="charitem{{ $item->itemno }}" class="{{ $item->itemflg == 1 ? '' : 'noneimg' }} imgposition" src="{{ asset('/img/charitem'.$item->itemno.'.png') }}">
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <p><a href={{ url('/users/profile'.'/' . $value->userid) }}>{{$value->username}}</a></p>
                                <p>{{$value->item_draw_count}}</p>
                            </div>
                        @else
                            <tr>
                                <td>{{$key +1}} 위</td>
                                <td><a href={{ url('/users/profile'.'/' . $value->userid) }}>{{$value->username}}</a></td>
                                <td>{{$value->item_draw_count}}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
</div>

<script>
    $(document).ready(function(){
        $('#tab1').on('click',function(){
            $('#tab1 a').addClass('active');
            $('#tab1').addClass('active');
            $('.tabCon1').addClass('active');

            $('#tab2 a').removeClass('active');
            $('#tab2').removeClass('active');
            $('.tabCon2').removeClass('active');
            $('#tab3 a').removeClass('active');
            $('#tab3').removeClass('active');
            $('.tabCon3').removeClass('active');
        })

        $('#tab2').on('click',function(){
            $('#tab2 a').addClass('active');
            $('#tab2').addClass('active');
            $('.tabCon2').addClass('active');

            $('#tab1 a').removeClass('active');
            $('#tab1').removeClass('active');
            $('.tabCon1').removeClass('active');
            $('#tab3 a').removeClass('active');
            $('#tab3').removeClass('active');
            $('.tabCon3').removeClass('active');
        })

        $('#tab3').on('click',function(){
            $('#tab3 a').addClass('active');
            $('#tab3').addClass('active');
            $('.tabCon3').addClass('active');

            $('#tab1 a').removeClass('active');
            $('#tab1').removeClass('active');
            $('.tabCon1').removeClass('active');
            $('#tab2 a').removeClass('active');
            $('#tab2').removeClass('active');
            $('.tabCon2').removeClass('active');
        })

    })

</script>



{{-- <script>location.href = "#tab1";
</script> --}}

{{-- @if(session()->has('errmsg'))
        {{ session('errmsg') }}
    @endif
    <div>
        <form action="{{ route('mofin.search',[auth()->user()->userid]) }}" method="post">
            @csrf
            <label for="search_name"></label>
            <input type="text" name="search_name" id ="search_name" placeholder="아이디를 검색해보세요"> <button type="submit">검색해보기</button>
        </form>
    </div>
<br><br>
<div class="tabmenu">
    <ul>
    <li id="tab1" class="btnCon"><a class="btn first" href="#tab1">포인트부자</a>
        <div class="tabCon">
        <h2>포인트부자</h2>
        <table>
            <thead>
                <tr>
                    <th>순위</th>
                    <th>닉네임</th>
                    <th>포인트</th>
                </tr>
            </thead>
            <tbody>
                @php
                $rank = 1 ; 
                @endphp
                @foreach($pointrank as $value)
                <tr>
                    <td>{{$rank}}</td>
                    <td><a href={{ url('/users/profile'.'/' . $value->userid) }}>{{$value->username}}</a></td>
                    <td>{{$value->point}}</td>
                </tr>
                @php
                    $rank++;
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    
    </li>
    <li id="tab2" class="btnCon"><a class="btn" href="#tab2">로그인왕</a>
        <div class="tabCon">
        <h2>로그인왕</h2>
        <table>
            <thead>
                <tr>
                    <th>순위</th>
                    <th>닉네임</th>
                    <th>로그인횟수</th>
                </tr>
            </thead>
            <tbody>
                @php
                $login = 1 ; 
                @endphp
                @foreach($loginrank as $value)
                <tr>
                    <td>{{$login}}</td>
                    <td><a href={{ url('/users/profile'.'/' . $value->userid) }}>{{$value->username}}</a></td>
                    <td>{{$value->login_count}}</td>
                </tr>
                @php
                    $login++;
                @endphp
                @endforeach
            </tbody>
            </table>
        </div>
    
    </li>    

    
    <li id="tab3" class="btnCon"><a class="btn" href="#tab3">아이템뽑기왕</a>
        <div class="tabCon">
        <h2>아이템뽑기왕</h2>
        <table>
            <thead>
                <tr>
                    <th>순위</th>
                    <th>닉네임</th>
                    <th>아이템뽑기 횟수</th>
                </tr>
            </thead>
            <tbody>
                @php
                $item = 1 ; 
                @endphp
                @foreach($itemdrawrank as $value)
                <tr>
                    <td>{{$item}}</td>
                    <td><a href={{ url('/users/profile'.'/' . $value->userid) }}>{{$value->username}}</a></td>
                    <td>{{$value->item_draw_count}}</td>
                </tr>
                @php
                    $item++;
                @endphp
                @endforeach
            </tbody>
        </table>
        </div>

    </li>
</ul>
</div>

<script>location.href = "#tab1";
</script>
<h5>(닉네임클릭시 클릭한 회원의 모핀이를 구경할수있습니다!)</h5> --}}

@endsection