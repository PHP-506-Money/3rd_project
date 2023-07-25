@extends('layout.layout')

@section('title', 'EMAIL VERIFY')

@section('header', 'EMAIL VERIFY')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/kjav2.css')  }}" >
    
    

    <div id="content">

        <div class=success>{!!session()->has('success') ? session('success') : ""!!}</div>

        <article class="l-layout login find-id">
            <section class="login__inner">
                @include('layout.errorsvalidate')
                <div class="l-title" id="l-title">이메일을 인증해주세요.</div>
                <div class="form members">
                    <form id="table" action="{{route('users.chkverify')}}" method="post">
                        @csrf
                            <div class="login__input">
                                <div class="line">

                                    {{-- <label for="code" class="title">인증 코드</label> --}}
                                    <input type="text" class="l-input short-input" name="code" id="code" placeholder="인증 코드를 입력해주세요.">
                                    <button class="l-btn btnverify" type="submit">인증하기</button>
                                </div>
                    </form>
                    
                    
                </div>
                </div>
            </section>
        </article>
    </div>

@endsection

