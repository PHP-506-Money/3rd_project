@extends('layout.layout')

@section('title', 'Myinfo')

@section('header', 'MY MOFIN')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/hj.css')  }}" >
    <div class="top1"></div>
    <div class="success">{!!session()->has('success') ? session('success') : ""!!}</div>
    @include('layout.errorsvalidate')
    <div class="profile">
        <form class="myinfo" name="myinfo" action="{{route('users.mofinname.post')}}" method="post">
            @csrf
                <div class="moffin">
                    @foreach ($data as $user)
                    <img class ="mof" src="{{ asset('/img/moffin' . $user->moffintype . '.png') }}" alt="">
                    @endforeach
                    <div class="charitem">
                        @foreach ($items as $item)
                            <input type="hidden" name="itemflg{{ $item->itemno }}" value="{{ $item->itemflg }}">
                            <img id="charitem{{ $item->itemno }}" class="{{ $item->itemflg == 1 ? '' : 'noneimg' }} imgposition" src="{{ asset('/img/charitem'.$item->itemno.'.png') }}">
                        @endforeach
                    </div>
                </div>
                <div id="info2">
                    {{ $user->username }} 님의 <textarea name="moffinname" id="moffinname" cols="10" rows="1" placeholder="한글, 영어 1~6자 입력" onfocus="this.placeholder = ''" onblur="this.placeholder = '한글, 영어 1~6자 입력'" required>{{ $user->moffinname }}</textarea>
                </div>
                <div class="bottom2">
                    <button type="button" class="button" id="btn" onclick="moffinnameChan();">변경완료</button>
                </div>
        </form>
    </div>
    <div class="back">
        <input type="button" class="back2" value="돌아가기" onclick="history_back()">
    </div>
@endsection

<script src="{{ asset('/js/user.js') }}"></script>