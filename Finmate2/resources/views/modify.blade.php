@extends('layout.layout')

@section('title', 'MODIFY')

@section('header', 'MODIFY')

@section('contents')
    {{-- <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" > --}}
    <div class="success">{!!session()->has('success') ? session('success') : ""!!}</div>

    <div id="content">
        <article class="l-layout join">
        @include('layout.errorsvalidate')
            <div class="l-inner joinForm_l-inner">
                <div class="l-title">회원 정보 수정</div>
                <form id="modify" action="{{route('users.modify.post')}}" method="post">
                @csrf
                <section class="join__input">
                <div>
                    <div class="tit-area">
                        <p class="tit">회원 정보</p>
                        <p class="msg"><i>*</i>표시는 수정가능한 항목입니다.</p>
                    </div>
                    @foreach ($data as $user)
                        <div class="input-area">

                            <div class="sec-line">
                                <label for="name" class="title">이름</label>
                                <input type="text" class="l-input short-input" name="name" id="name" value="{{ $user->username }}" readonly>
                                <div id="errMsgId"></div>
                                <div id="errMsg"></div>
                            </div>

                            <div class="sec-line">
                                <label for="id" class="title">아이디</label>
                                <input type="text" class="l-input short-input" name="id" id="id" value="{{ $user->userid }}" readonly>
                                <div id="errMsgId"></div>
                            </div>

                            <div class="sec-line">
                                <label for="password" class="title">비밀번호<i class="point">*</i></label>
                                <input type="password" class="l-input short-input" name="password" id="password" placeholder="영문, 숫자, 특수문자 1개씩 포함하여 8~12자 입력" onfocus="this.placeholder = ''" onblur="this.placeholder = '영문, 숫자, 특수문자 1개씩 포함하여 8~12자 입력'" required>
                                <div id="errMsgId"></div>
                            </div>

                            <div class="sec-line">
                                <label for="passwordchk" class="title">비밀번호 확인</label>
                                <input type="password" class="l-input short-input" name="passwordchk" id="passwordchk" placeholder="비밀번호란과 동일하게 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '비밀번호란과 동일하게 입력해주세요.'" required>
                                <div id="errMsgId"></div>
                            </div>

                            <div class="sec-line">
                                <label for="email" class="title">이메일<i class="point">*</i></label>
                                <input type="email" class="l-input short-input" name="email" id="email" value="{{ $user->useremail }}" placeholder="이메일주소를 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '이메일주소를 입력해주세요.'" required>
                                <div id="errMsgId"></div>
                                {{-- <button type="button" class="button" id="btn" onclick="btnclick();">인증하기</button> --}}
                            </div>

                            <div class="sec-line">
                                <label for="phone" class="title">휴대폰<i class="point">*</i></label>
                                <input type="tel" class="l-input short-input" name="phone" id="phone" value="{{ $user->phone }}" placeholder="휴대폰번호를 입력해주세요." onfocus="this.placeholder = ''" onblur="this.placeholder = '휴대폰번호를 입력해주세요.'" required>
                                <div id="errMsgId"></div>
                            </div>
            @endforeach
                <button type="submit" class="btn" id="btnmove">변경하기</button>
                            </div>
                <div class="login__link">
                <a class="leftmovea" onclick="confirmWithdrawal()">회원탈퇴</a>
                </div>
        </div>
                    </section>
    </form>

        </div>
    </article>
</div>
@endsection

<script src="{{ asset('/js/user.js') }}"></script>