@extends('layout.layout')

@section('title', 'Login')

@section('header', 'LOGIN TO FINMATE')
@section('aside')


@section('contents')
<div id="content">
    <form id="domantForm" name="domantForm" method="get">
        <input type="hidden" id="domant_id" name="domant_id">
    </form>


    <article class="l-layout login">

        <!-- 로그인 영역 -->
        <section class="login__inner">
        <div class=success>{!!session()->has('success') ? session('success') : ""!!}</div>
        @include('layout.errorsvalidate')

            <div class="l-title">로그인</div>
            <div class="login__form-wrap">
                <!-- 회원로그인 -->
                <div class="form members">
                <form id="table" class="members__form" action="{{route('users.login.post')}}" method="post">
                    @csrf
                        <div class="login__input">
                            <div class="line">
                                <label for="id">아이디</label>
                                <div class="icon-input">
                                    <input type="text" name="id" id="id" value="{{ old('id') }}" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="line">
                                <label for="password">비밀번호</label>
                                <div class="icon-input">
                                    <input type="password" name="password" id="password" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button class="l-btn" type="submit">로그인</button>

                    </form>
                    <div class="login__link">
                        <a href="{{route('users.findid')}}">아이디 찾기</a>
                        <span class="l-bar"></span>
                        <a href="{{route('users.findpw')}}">비밀번호찾기</a>

                    </div>
                </div>
                <!-- // 회원로그인 -->

            </div>


            <div class="login__join">
                <p class="msg">아직 회원이 아니신가요?</p>
                <a href="/join/join_base">
                    <button class="l-btn line" type="button" onclick="location.href='{{route('users.registration')}}'">회원가입</button></a>


            </div>
            <div class="login__sns">
                <p class="tit">SNS 간편 회원가입</p>
                <div class="btn-area">
                    <button type="button" onclick="javascript:snsLogin('kakao');"><img src="/resources/assets/images/icon/l-kakao.png" alt="카카오아이콘"></button>
                    <!-- <button type="button" onclick="javascript:snsLogin('naver');"><img src="/resources/assets/images/icon/l-naver.png" alt="네이버아이콘"></button> -->
                </div>
            </div>
        </section>
        <!-- // 로그인 영역 -->

    </article>

</div>

@endsection