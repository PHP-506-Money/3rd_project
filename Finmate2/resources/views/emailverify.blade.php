@extends('layout.layout')

@section('title', 'EMAIL VERIFY')

@section('header', 'EMAIL VERIFY')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/kjav2.css')  }}" >
    


        @if(session()->has('msgg'))
            <div id="myModal" class="modal">
                <div class="modal_content">
                    <div class="modalMsg">
                        <p class = "emailresentpls">
                            {{session('msgg')}}
                        </p>
                        <div onClick="close_pop();">
                        <span class="pop_bt" >확인
                </span>
                        </div>
                </div>
            </div>
            @endif
            {{-- @if(session()->has('msgg'))
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            alert("{{ session('msgg') }}");
            location.href = "{{ route('users.verify') }}";
        });
    </script>
@endif --}}

    
        {{-- @else             --}}
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
{{-- @endif --}}
<script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('myModal').style.display = 'block';
        });

        function close_pop(flag) {
            document.getElementById('myModal').style.display = 'none';
            location.href = "{{ route('users.verify') }}";
        }
    </script>
<script src="{{ asset('/js/email.js') }}"></script>

@endsection


