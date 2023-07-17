@extends('layout.layout')

@section('title', 'Myinfo')

@section('header', 'MY MOFIN')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <div class="top1"></div>
    <div class="success">{!!session()->has('success') ? session('success') : ""!!}</div>
    @include('layout.errorsvalidate')
    <div class="profile">
        <form class="myinfo" name="myinfo" action="{{route('users.mofinname.post')}}" method="post">
            @csrf
                <div class="moffin">
                    @foreach ($data as $user)
                    <img src="{{ asset('/img/moffin' . $user->moffintype . '.png') }}" alt="">
                    @endforeach
                </div>
                <div id="info">
                    {{ $user->username }} 님의 <textarea name="moffinname" id="moffinname" cols="10" rows="1" placeholder="한글, 영어 1~6자 입력" onfocus="this.placeholder = ''" onblur="this.placeholder = '한글, 영어 1~6자 입력'" required>{{ $user->moffinname }}</textarea>
                </div>
                <div class="bottom2">
                    <button type="button" class="button" id="btn" onclick="moffinnameChan();">변경완료</button>
                </div>
        </form>
    </div>
@endsection

<script src="{{ asset('/js/user.js') }}"></script>