@extends('layout.layout')

@section('title', 'FindID')

@section('header', 'FIND ID')

@section('contents')

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