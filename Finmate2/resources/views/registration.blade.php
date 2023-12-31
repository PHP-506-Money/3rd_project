@extends('layout.layout')

@section('title', 'SIGN UP TO FINMATE')

@section('header', 'SIGN UP TO FINMATE')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/kjav2.css')  }}" >
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div id="content">
        <article class="l-layout join">
            @include('layout.errorsvalidate')
            <div class="l-inner joinForm_l-inner">
                <div class="l-title">회원가입</div>
                <form id="joinForm" action="{{route('users.registration.post')}}" method="post">
                    @csrf
                    <section class="join__input">
                        <div class="tit-area">
                            <p class="tit">기본정보</p>
                            <p class="msg"><i>*</i>표시는 반드시 입력하셔야 하는 항목입니다.</p>
                        </div>
                        <div class="input-area">
                            <div class="sec-line">
                                <label for="name" class="title">이름<i class="point">*</i></label>
                                <div class="right">
                                <input type="text" class="l-input short-input" name="name" id="name" value="{{ old('name') }}" placeholder="한글, 영문 2~20자 사이로 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '한글, 영문 2~20자 사이로 입력해주세요.'" autocomplete="off" required>
                                <div id="chkerr"></div>
                                </div>
                            </div>
                            
                            <div class="sec-line">
                                <label for="id" class="title">아이디<i class="point">*</i></label>
                                <div class="input-btn" style="width:100%;">
                                    <input type="text" class="l-input short-input" name="id" id="id" value="{{ old('id') }}" placeholder="영문, 숫자 4~12자 사이로 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '영문, 숫자 4~12자 사이로 입력해주세요.'" autocomplete="off" required>
                                    <button type="button" class="l-btn buttonn" id="btn" onclick="checkDuplicateButton();">중복확인</button>
                                    <div id="chkerr"></div>
                                    <div id="errMsg"></div>
                                </div>
                            </div>
                            <div class="sec-line">
                                <label for="password" class="title">비밀번호<i class="point">*</i></label>
                                <div class="right">
                                <input type="password" class="l-input short-input" name="password" id="password" placeholder="영문, 숫자, 특수문자 1개씩 포함하여 8~12자 입력" onfocus="this.placeholder = ''" onblur="this.placeholder = '영문, 숫자, 특수문자 1개씩 포함하여 8~12자 입력'" required>
                                <div id="chkerr"></div>
                            </div>
                            </div>
                            <div class="sec-line">
                                <label for="passwordchk" class="title">비밀번호 확인<i class="point">*</i></label>
                                <div class="right">
                                <input type="password" class="l-input short-input " name="passwordchk" id="passwordchk" placeholder="비밀번호란과 동일하게 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '비밀번호란과 동일하게 입력해주세요.'" required>
                                <div id="chkerr"></div>
                            </div>
                            </div>
                            <div class="sec-line">
                                <label for="email" class="title">이메일<i class="point">*</i></label>
                                <div class="input-btn" style="width:100%;">
                                    <input input type="email" class="l-input short-input" name="email" id="email" value="{{ old('email') }}" placeholder="이메일주소를 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '이메일주소를 입력해주세요.'" autocomplete="off" required>
                                    <button type="button" class="l-btn buttonn" id="btn" onclick="checkDupeemail();">중복확인</button>
                                    <div id="chkerr"></div>
                                    <div id="emailerrormessgepls"></div>
                                    {{-- <button type="button" id="sentbtn" class="l-btn buttonn" onclick="checkDupeemail();">인정번호 받기</button> --}}
                                    {{-- <input type="text" name="emailcode"  class="l-input short-input" autocomplete="off" id="emailcode" placeholder="인증번호" disabled="true" required> --}}
                                    {{-- <button type="button" id="codechk" class="l-btn buttonn" disabled="true" >인증하기</button> --}}
                                {{-- <div id="codeerrMsg"></div> --}}
                                </div>
                            </div>
                        <div class="sec-line">
                            <label for="phone" class="title">휴대폰<i class="point">*</i></label>
                            <div class="right">
                                    <input type="tel" class="l-input short-input" name="phone" id="phone" value="{{ old('phone') }}" placeholder="휴대폰번호를 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '휴대폰번호를 입력해주세요.'" autocomplete="off" required>
                                    <div id="chkerr"></div>
                            </div>
                        </div>
                        </div>
                    </section>
                    <section class="join__input">
                        <div class="tit-area">
                            <p class="tit">모핀이 선택</p>
                        </div>
                        <div id="menu">
    <label for="moffintype" class="title"></label>
        <div>
            <input type="radio" name="moffintype" id="rabbit" value="1">
            <label for="rabbit">
                <span class="mofin-rabbit">
                    {{-- <img src="{{ asset('/img/rabbit2.png') }}" alt="rabbit"> --}}
                </span>
                <p class="arrow_box">저를 데려가주세요!</p>
            </label>
        </div>
    <div>
        <input type="radio" name="moffintype" id="penguin" value="2">
        <label for="penguin">
            <span class="mofin-penguin">
                {{-- <img src="{{ asset('/img/penguin2.png') }}" alt="penguin" > --}}
            </span>
                <p class="arrow_box">날 데려가면 좋을걸?</p>
        </label>
    </div>
    <div>
        <input type="radio" name="moffintype" id="panda" value="3">
        <label for="panda">
            <span class="mofin-panda">
                {{-- <img src="{{ asset('/img/panda2.png') }}" alt="panda"> --}}
            </span>
            <p class="arrow_box">날 데려가라!</p>
        </label>
    </div>
</div>
                        <button type="submit" id="btnmove" class="signbtn">가입하기</button>
                    </div>
                </section>
            </form>
        </div>
    </article>
</div>


<script src="{{ asset('/js/user.js') }}"></script>
{{-- <script src="{{ asset('/js/email.js') }}"></script> --}}
@endsection