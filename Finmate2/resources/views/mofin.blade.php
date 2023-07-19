@extends('layout.layout')

@section('title', 'mofin')

@section('header', 'DRAWING')

@section('contents')

<link rel="stylesheet" href="{{ asset('/css/hj.css') }}">
<style>
       @media (max-width: 1024px) {
        .item-box {
            width: 40%;
            margin: 20px;
            height: 40%;
            padding: 60px
        }
    }

   @media (max-width: 768px) {
        .item-box {
            width: 100%;
            height: 40%;
            margin: 20px;
            padding: 100px
        }

        .random {
            flex-direction: column;
            align-items: center;
        }

        .randombox:not(last-child) {
            margin-bottom: 1rem;
        }
    }
</style>

<div class="l-title" style="margin-top: 20rem;" >
    <h2>
        뽑기
    </h2>
    <p> 현재 포인트 : {{$data->point}} </p>
</div>

<div class="random">
    <form action="{{route('mofin.point',[auth()->user()->userid])}}" method="post">
        @csrf
        <button type="submit" class="randombtn">
            <div class="randombox pointrandbox">

            <img class="randomimg" src="{{ asset('/img/randitem.png') }}" onmouseover="this.src='{{ asset('/img/mouseoverpoint.png') }}'" onmouseout="this.src='{{ asset('/img/randitem.png') }}'">
                {{-- <span class="bold">랜덤 포인트 뽑기</span>
                <span>(100pt)</span> --}}
            </div>
        </button>
    </form>

    <form action="{{route('mofin.item',[auth()->user()->userid])}}" method="post">
        @csrf
        <button type="submit" class="randombtn">
            <div class="randombox itemrandbox">
                <img class="randomimg" src="{{ asset('/img/randpoint.png') }}" onmouseover="this.src='{{ asset('/img/mouseoveritem.png') }}'" onmouseout="this.src='{{ asset('/img/randpoint.png') }}'">
                {{-- <span class="bold">랜덤 아이템 뽑기</span>
                <span>(500pt)</span> --}}
            </div>
        </button>
    </form>
</div>
<br><br>
<div style="text-align : center; font-size:40px; ">내 컬렉션</div>

<div class="item-list">
    @foreach ($itemname as $value)
        <div class="item-box">
            <img class="item-img" src="{{asset('/img/charitem'.$value->itemno.'.png')}}">
            {{-- @if ($value === '선글라스')
                <img class="item-img" src="{{ asset('/img/charitem1.png') }}">
            @elseif ($value === '검')
                <img class="item-img" src="{{ asset('/img/charitem2.png') }}">
            @elseif ($value === '안전모')
                <img class="item-img" src="{{ asset('/img/charitem3.png') }}">
            @elseif ($value === '에어팟맥스')
                <img class="item-img" src="{{ asset('/img/charitem4.png') }}">
            @elseif ($value === '사원증')
                <img class="item-img" src="{{ asset('/img/charitem5.png') }}">
            @elseif($value === '날개')
                <img class="item-img" src="{{ asset('/img/charitem6.png') }}">
            @elseif($value === '티셔츠')
                <img class="item-img" src="{{ asset('/img/charitem7.png') }}">
            @elseif($value === '야구배트')
                <img class="item-img" src="{{ asset('/img/charitem8.png') }}">
            @elseif($value === '아잉눈')
                <img class="item-img" src="{{ asset('/img/charitem9.png') }}">
            @elseif($value === '노트북')
                <img class="item-img" src="{{ asset('/img/charitem10.png') }}">
            @elseif($value === '여성한복')
                <img class="item-img" src="{{ asset('/img/charitem11.png') }}">
            @elseif($value === '남성한복')
                <img class="item-img" src="{{ asset('/img/charitem12.png') }}">
            @elseif($value === '유아복')
                <img class="item-img" src="{{ asset('/img/charitem13.png') }}">
            @endif --}}
            <span class="item-name">{{ $value->itemname }}</span>

        </div>
    @endforeach
</div>

@if (session()->has('pt1'))
    <script>
        // 페이지가 로드될 때 자동으로 실행되도록 수정
        window.addEventListener('load', function() {
            alert('{{ session('pt1') }}');
        });
    </script>
@endif

@endsection