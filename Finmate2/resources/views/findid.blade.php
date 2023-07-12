@extends('layout.layout')

@section('title', 'FindID')

@section('header', 'FIND ID')

@section('contents')
    {{-- <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <div class="top1"></div>
    @include('layout.errorsvalidate')
    <form id="table" action="{{route('users.findid.post')}}" method="post">
        @csrf
        <div class="label">
            <label for="name">이름</label>
            <input type="text" name="name" id="name" autocomplete="off" required>
        </div>
        <div class="label">
            <label for="email">이메일</label>
            <input type="email" name="email" id="email" autocomplete="off" required>
        </div>
            <button type="submit" class="button" id="button">아이디 찾기</button>
        <div class="bottom">
            <a href="{{route('users.login')}}" id="down">로그인으로 돌아가기</a>
            <a href="{{route('users.findpw')}}" id="down">비밀번호 찾기</a>
            <a href="{{route('users.registration')}}" id="down">회원가입</a>
        </div>
    </form>
    --}}

<div id="content">
    <article class="l-layout login find-id">
        <section class="login__inner">
        @include('layout.errorsvalidate')
            <div class="l-title" id="l-title">아이디찾기</div>
            <div class="form members">
                <form action="{{route('users.findid.post')}}" method="post" class="non-members__form">
                    @csrf
                    <div class="login__input">
                        <div class="line">
                            <label for="name">이름</label>
                            <div class="icon-input">
                                <input type="text" placeholder="이름을 입력해주세요" id="name" name="name">
                            </div>
                        </div>
                        <div class="line">
                            <label for="email">가입메일주소</label>
                            <div class="email-box">
                                <ul class="inline_li email_inline">
                                    <li><input id="email" name="email" type="email" placeholder="이메일을 입력해주세요" class="l-input short-input" style="width:100%;height:42px;line-height: 42px;"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <button class="l-btn" type="submit">아이디 찾기</button>
                </form>
            </div>
            <div class="login__link">
                <a href="{{route('users.login')}}">로그인</a>
                <span class="l-bar"></span>
                <a href="{{route('users.findpw')}}">비밀번호찾기</a>
            </div>
            <div class="login__join">
                <p class="msg">아직 회원이 아니신가요?</p>
                <a href="{{route('users.registration')}}"><button class="l-btn line" type="button">회원가입</button></a>
            </div>
            <div class="login__sns">
                <p class="tit">SNS 간편 회원가입</p>
                <div class="btn-area">
                    <button type="button"><img src="/resources/assets/images/icon/l-kakao.png" alt="카카오아이콘"></button>
                </div>
            </div>
        </section>
    </article>
</div>
@endsection