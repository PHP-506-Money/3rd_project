@extends('layout.layout')

@section('title', 'FindID')

@section('header', 'FIND ID')

@section('contents')
    {{-- <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <div class="top1"></div>
    @include('layout.errorsvalidate') --}}
    {{-- <form id="table">
        @csrf
            @if ($user)
                <div class="label4">
                    <label for="id">{{ $user->username }} 님의 아이디는 </label><br>
                    <input type="text" name="id" id="id" value="{{ $user->userid }}">
                    <label>입니다.</label>
                </div>
                <button type="button" class="button" id="button3" onclick="location.href='/users/login';">로그인</button>
                <div class="bottom">
                    <a href="{{route('users.findpw')}}" id="down">비밀번호 찾기</a>
                    <a href="{{route('users.registration')}}" id="down">회원가입</a>
                </div>
            @else
                <div class="label4">
                    <label>일치하는 사용자가 없습니다.</label>
                </div>
                <button type="button" class="button" id="button" onclick="location.href='/users/findid';">돌아가기</button>
                <div class="bottom">
                    <a href="{{route('users.login')}}" id="down">로그인</a>
                    <a href="{{route('users.findpw')}}" id="down">비밀번호 찾기</a>
                    <a href="{{route('users.registration')}}" id="down">회원가입</a>
                </div>
            @endif
    </form> --}}

    @include('layout.errorsvalidate')
    <div id="content">
        <article class="l-layout login find-id">
        @if ($user)
            <section class="login__inner">
                <div class="l-title" id="l-title">{{ $user->username }}님의 아이디는 </div>
                <br>
                <div class="l-title">{{ $user->userid }} 입니다.</div>
                <br>
                <div class="form members">
                    <button class="l-btn" type="button" onclick="location.href='/users/login';">로그인 하러 가기</button>
                </div>
                <div class="login__link">
                        <span class="l-bar"></span>
                    <a href="{{route('users.findpw')}}">비밀번호찾기</a>
                    <span class="l-bar"></span>
                </div>
            </section>
        @else
            <section class="login__inner">
                <div></div>
                <br>
                <div class="l-title" id="l-title">일치하는 사용자가 없습니다. </div>
                <br>
                <div></div>
                <div class="form members">
                    <button class="l-btn" type="button" onclick="location.href='/users/findid';">돌아가기</button>
                </div>
                <div class="login__link">
                    <a href="{{route('users.login')}}">로그인</a>
                    <span class="l-bar"></span>
                    <a href="{{route('users.findpw')}}">비밀번호찾기</a>
                    <span class="l-bar"></span>
                    <a href="{{route('users.findpw')}}">회원가입</a>
                </div>
            </section>
        @endif
        </article>
    </div>

@endsection