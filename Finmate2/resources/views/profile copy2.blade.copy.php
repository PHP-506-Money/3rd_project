@extends('layout.layout')

@section('title', 'Myinfo')

@section('header', 'MY MOFIN')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/hj.css')  }}" >
    <div class="top1"></div>
    {{-- <div class="success">{!!session()->has('success') ? session('success') : ""!!}</div> --}}
    @include('layout.errorsvalidate')
    <div class="profile">{{-- 모핀 프로필 시작 --}}
        <div class="myinfo">
            <form id="myinfo" name="myinfo" action="{{route('users.itemflg')}}" method="post">
                

                @csrf
                    <div class="moffin">
                        @foreach ($data as $user)
                        <img class ="mof" src="{{ asset('/img/moffin' . $user->moffintype . '.png') }}" alt="">
                        @endforeach
                        <div class="charitem">
                            @foreach ($items as $item)
                                <input type="hidden" name="itemflg" value="{{ $item->itemflg }}">
                                <img id="charitem{{ $item->itemno }}" class="{{ $item->itemflg == 1 ? '' : 'noneimg' }} imgposition" src="{{ asset('/img/charitem'.$item->itemno.'.png') }}">
                            @endforeach
                        </div>
                    </div>
                    {{-- 다른 사용자의 프로필 조회 --}}
                    @if ($userid !== $id)
                        <div id="info2">
                            {{ $user->username }} 님의 {{ $user->moffinname }}
                        </div>
                        <div class="back">
                            <input type="button" value="돌아가기" onclick="history_back()">
                        </div>
        </div>
    </div>
                    {{-- 현재 로그인한 사용자의 경우 --}}
                    @else
                        <div id="info2">
                            {{ $user->username }} 님의 {{ $user->moffinname }}
                        </div>
                        <div class="bottom2">
                            <button type="submit" class="button">저장하기</button>
                            <button type="button" class="button" id="btn" onclick="btnClick();">공유하기</button>
                        </div>
                        <div class="moffinname">
                            <a href="{{ route('users.mofinname') }}">모핀이명 변경</a>
                        </div>
        </div>
    </div>
                        {{-- 모핀 프로필 종료 --}}
                        <div class="container">
                            <div class="title">
                                <h6>내 아이템 목록(클릭시 장착/해제)</h6>
                            </div>
                            <div class="itemlist"> {{-- 아이템 부분 --}}
                                @foreach ($items as $item)
                                    <input type="hidden" name="itemno" value="{{$item->itemno}}">
                                    <button type="button" class="itembtn" onclick="toggleitem({{ $item->itemno }})">
                                        <img src="{{ asset('/img/charitem'.$item->itemno.'.png') }}" class="itemimg">
                                    </button>
                                @endforeach
                            </div>
                        </div>
                @endif
            </form>
@endsection

<script src="{{ asset('/js/user.js') }}"></script>
<script>

</script>