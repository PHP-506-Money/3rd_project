@extends('layout.layout')

@section('title', 'CHANGE PASSWORD')

@section('header', 'CHANGE PASSWORD')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/kjav2.css')  }}" >
    
    <div id="content">
        <article class="l-layout login find-id">
            <section class="login__inner">
                @include('layout.errorsvalidate')
                <div class="l-title" id="l-title">{{$data->userid}}님 비밀번호를 변경해 주세요.</div>
                <div class="form members">
                    <form id="table" action="{{route('users.updatepw.post')}}" method="post">
                        @csrf
                        @if ($data)
                            <div class="login__input">
                                <div class="line">
                                    <label for="password" class="title">변경할 비밀번호</label>
                                    <input type="password" class="l-input short-input" name="password" id="password" required>
                                </div>
                                
                                <div class="line">
                                    <label for="passwordchk" class="title" >비밀번호 확인</label>
                                    <input type="password" class="l-input short-input" name="passwordchk" id="passwordchk" required>
                                </div>
                            </div>
                            
                            <button class="l-btn" type="submit">비밀번호 변경</button>

                            <div class="login__link">
                                <a href="{{route('users.login')}}" id="down">로그인으로 돌아가기</a>
                                <span class="l-bar"></span>
                                <a href="{{route('main')}}" id="down">메인으로 돌아가기</a>
                            </div>
                        @else
                            <div class="label4">
                                <label>일치하는 사용자가 없습니다.</label>
                            </div>
                            <button type="button" class="button" id="button" onclick="location.href='/users/findpw';">돌아가기</button>
                            <div class="bottom">
                                <a href="{{route('users.findid')}}" id="down">아이디 찾기</a>
                                <a href="{{route('users.registration')}}" id="down">회원가입</a>
                                <a href="{{route('users.login')}}" id="down">로그인</a>
                            </div>
                        @endif
                    </form>
                </div>
            </section>
        </article>
    </div>
@endsection


