@extends('layout.layout')

@section('title', 'rank')

@section('header', 'Rank')

@section('contents')

<link rel="stylesheet" href="{{ asset('/css/hj.css') }}">



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
        <div style="text-align:center;">(닉네임클릭시 클릭한 회원의 모핀이를 구경할수있습니다!)</div>
    @if(session()->has('errmsg'))
        {{ session('errmsg') }}
    @endif

    <div>

        <form action="{{ route('mofin.search',[auth()->user()->userid]) }}" method="post">
        @csrf
        <label for="search_name"></label>
        <input type="text" name="search_name" id ="search_name" placeholder="아이디를 검색해보세요"> <button type="submit">검색해보기</button>
        </form>

    </div>

    <script>location.href = "#tab1";
    </script>
    
    @endsection



