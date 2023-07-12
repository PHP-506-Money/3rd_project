@extends('layout.layout')

@section('title', 'Registration')

@section('header', 'SIGN UP TO FINMATE')

@section('contents')
    {{-- <link rel="stylesheet" href="{{ asset('/css/kjav2.css')  }}" > --}}
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <div class="top1"></div>
    @include('layout.errorsvalidate')
    <form id="form" action="{{route('users.registration.post')}}" method="post">
        @csrf
        <div class="regist">
            <div class="label2">
                <label for="name">이름</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="한글, 영문 2~20자 사이로 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '한글, 영문 2~20자 사이로 입력해주세요.'" autocomplete="off" required>
                <div id="errMsgId"></div>
                <div id="errMsg"></div>
            </div>
            <div class="label2">
                <label for="id">아이디</label>
                <input type="text" name="id" id="id" value="{{ old('id') }}" placeholder="영문, 숫자 4~12자 사이로 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '영문, 숫자 4~12자 사이로 입력해주세요.'" autocomplete="off" required>
                <button type="button" class="button" id="btn" onclick="checkDuplicateButton();">중복확인</button>
                <div id="errMsgId"></div>
            </div>
            <div class="label2">
                <label for="password">비밀번호</label>
                <input type="password" name="password" id="password" placeholder="영문, 숫자, 특수문자 1개씩 포함하여 8~12자 입력" onfocus="this.placeholder = ''" onblur="this.placeholder = '영문, 숫자, 특수문자 1개씩 포함하여 8~12자 입력'" required>
                <div id="errMsgId"></div>
            </div>
            <div class="label2">
                <label for="passwordchk">비밀번호 확인</label>
                <input type="password" name="passwordchk" id="passwordchk" placeholder="비밀번호란과 동일하게 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '비밀번호란과 동일하게 입력해주세요.'" required>
                <div id="errMsgId"></div>
            </div>
            <div class="label2">
                <label for="email">이메일</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="이메일주소를 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '이메일주소를 입력해주세요.'" autocomplete="off" required>
                <div id="errMsgId"></div>
            </div>
            <div class="label2">
                <label for="phone">휴대폰</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" placeholder="휴대폰번호를 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '휴대폰번호를 입력해주세요.'" autocomplete="off" required>
                <div id="errMsgId"></div>
            </div>
            <div id="menu">
                <label for="moffintype">나의 모핀이 선택</label>
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
            <div class="btn">
                <button type="submit" class="button" id="button">가입하기</button>
            </div>
        </div>
    </form>


{{-- <div id="content">
    <article class="l-layout join">
        <div class="l-inner joinForm_l-inner">
            <div class="l-title">회원가입</div>
            <form id="joinForm" action="{{route('users.registration.post')}}" method="post">
                <section class="join__input">
                    <div class="tit-area">
                        <p class="tit">기본정보</p>
                        <p class="msg"><i>*</i>표시는 반드시 입력하셔야 하는 항목입니다.</p>
                    </div>
                    <div class="input-area">
                        <div class="sec-line">
                            <label for="name" class="title">이름<i class="point">*</i></label>
                            <input id="name" name="name" type="text" placeholder="이름을 입력해주세요" class="l-input short-input" maxlength="20" required>
                        </div>
                        <div class="sec-line">
							<label for="id" class="title">아이디<i class="point">*</i></label>
							<div class="input-btn" style="width:100%;">
								<input type="text" id="id" name="id" placeholder="아이디를 입력해주세요" class="l-input short-input" onkeyup="fn_keyUpId();" required>
								<button type="button" class="l-btn" id="checkDuplicateId">중복확인</button>
							</div>
                        </div>
                        <div class="sec-line">
                            <label for="password" class="title">비밀번호<i class="point">*</i></label>
                            <input type="password" id="password" name="password" placeholder="비밀번호을 입력해주세요" class="l-input short-input" onchange="lng_pwd_focus(); return false;" required>
                        </div>
                        <div class="sec-line">
                            <label for="passwordchk" class="title">비밀번호 확인<i class="point">*</i></label>
                            <input type="password" id="passwordchk" name="passwordchk" placeholder="비밀번호을 입력해주세요" class="l-input short-input" onblur="lgn_pwd_cnfm_focus(); return false;" required>
                        </div>
                        <div class="sec-line">
                            <label for="email" class="title">이메일<i class="point">*</i></label>
                            <div class="right">
                                <div class="email-box">
                                    <ul class="inline_li email_inline">
                                        <li><input id="email" type="email" placeholder="이메일을 입력해주세요" class="l-input short-input" required></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="sec-line">
                            <label for="phone" class="title">휴대폰번호<i class="point">*</i></label>
                            <div class="right">
                                <div class="input-btn">
                                    <input type="tel" name="phone" id="phone" maxlength="11" placeholder="휴대폰번호를 입력하세요." class="l-input short-input" onkeyup="fn_keyUpAuthKey();" required>
                                </div>
                            </div>
                        </div>
                        <div id="menu">
                <label for="moffintype" class="title">나의 모핀이 선택<i class="point">*</i></label>
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
                    </section>
                    <div class="l-btn-area">
                        <button type="button" class="l-btn line" onclick="location.href='/main';">돌아가기</button>
                        <button type="submit" class="l-btn">가입하기</button>
                    </div>
                </form>
            </div>
            </article>

        </div> --}}
<script src="{{ asset('/js/user.js') }}"></script>

@endsection