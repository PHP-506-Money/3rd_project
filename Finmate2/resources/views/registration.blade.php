@extends('layout.layout')

@section('title', 'Registration')

@section('header', 'SIGN UP TO FINMATE')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/kjav2.css')  }}" >

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
                                <input type="text" class="l-input short-input" name="name" id="name" value="{{ old('name') }}" placeholder="한글, 영문 2~20자 사이로 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '한글, 영문 2~20자 사이로 입력해주세요.'" autocomplete="off" required>
                                <div id="errMsgId"></div>
                                <div id="errMsg"></div>
                            </div>
                            <div class="sec-line">
                                <label for="id" class="title">아이디<i class="point">*</i></label>
                                <div class="input-btn" style="width:100%;">
                                    <input type="text" class="l-input short-input" name="id" id="id" value="{{ old('id') }}" placeholder="영문, 숫자 4~12자 사이로 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '영문, 숫자 4~12자 사이로 입력해주세요.'" autocomplete="off" required>
                                    <button type="button" class="l-btn buttonn" id="btn" onclick="checkDuplicateButton();">중복확인</button>
                                    <div id="errMsgId"></div>
                                </div>
                            </div>
                            <div class="sec-line">
                                <label for="password" class="title">비밀번호<i class="point">*</i></label>
                                <input type="password" class="l-input short-input" name="password" id="password" placeholder="영문, 숫자, 특수문자 1개씩 포함하여 8~12자 입력" onfocus="this.placeholder = ''" onblur="this.placeholder = '영문, 숫자, 특수문자 1개씩 포함하여 8~12자 입력'" required>
                                <div id="errMsgId"></div>
                            </div>
                            <div class="sec-line">
                                <label for="passwordchk" class="title">비밀번호 확인<i class="point">*</i></label>
                                <input type="password" class="l-input short-input" name="passwordchk" id="passwordchk" placeholder="비밀번호란과 동일하게 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '비밀번호란과 동일하게 입력해주세요.'" required>
                                <div id="errMsgId"></div>
                            </div>
                            <div class="sec-line">
                                <label for="email" class="title">이메일<i class="point">*</i></label>
                                <div class="input-btn" style="width:100%;">
                                    <input input type="email" class="l-input short-input" name="email" id="email" value="{{ old('email') }}" placeholder="이메일주소를 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '이메일주소를 입력해주세요.'" autocomplete="off" required>
                                    <button type="button" class="l-btn buttonn" id="btn">이메일 확인</button>
                                    <div id="errMsgId"></div>
                                </div>
                            </div>
                        <div class="sec-line">
                            <label for="phone" class="title">휴대폰<i class="point">*</i></label>
                            <div class="right">
                                <div class="input-btn">
                                    <input type="tel" class="l-input short-input" name="phone" id="phone" value="{{ old('phone') }}" placeholder="휴대폰번호를 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '휴대폰번호를 입력해주세요.'" autocomplete="off" required>
                                    <div id="errMsgId"></div>
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
        <label for="rabbit">
            <span id="chara">
                <img src="{{ asset('/img/rabbit2.png') }}" alt="rabbit">
            </span>
            <p class="arrow_box">저를 데려가주세요!</p>
            <input type="radio" name="moffintype" id="rabbit" value="1">
    </label>
        </div>
    <div>
        <label for="penguin">
            <span id="chara">
                <img src="{{ asset('/img/penguin2.png') }}" alt="penguin">
            </span>
                <p class="arrow_box">날 데려가면 좋을걸?</p>
                <input type="radio" name="moffintype" id="penguin" value="2">
        </label>
    </div>
    <div>
        <label for="panda">
            <span id="chara">
                <img src="{{ asset('/img/panda2.png') }}" alt="panda">
            </span>
            <p class="arrow_box">날 데려가라!</p>
            <input type="radio" name="moffintype" id="panda" value="3">
        </label>
    </div>
</div>
                        <button type="submit" class="l-btn" >가입하기</button>
                    </div>
                </section>
            </form>
        </div>
    </article>
</div>

<script src="{{ asset('/js/user.js') }}"></script>

@endsection