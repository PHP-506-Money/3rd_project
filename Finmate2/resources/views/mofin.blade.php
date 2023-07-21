@extends('layout.layout')

@section('title', 'MOFIN')

@section('header', 'MOFIN')

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

    /* ---------------Animation---------------- */

    .slit-in-vertical {
    -webkit-animation: slit-in-vertical 0.45s ease-out both;
    animation: slit-in-vertical 0.45s ease-out both;
    }

    @-webkit-keyframes slit-in-vertical {
    0% {
    -webkit-transform: translateZ(-800px) rotateY(90deg);
    transform: translateZ(-800px) rotateY(90deg);
    opacity: 0;
    }

    54% {
    -webkit-transform: translateZ(-160px) rotateY(87deg);
    transform: translateZ(-160px) rotateY(87deg);
    opacity: 1;
    }

    100% {
    -webkit-transform: translateZ(0) rotateY(0);
    transform: translateZ(0) rotateY(0);
    }
    }

    @keyframes slit-in-vertical {
    0% {
    -webkit-transform: translateZ(-800px) rotateY(90deg);
    transform: translateZ(-800px) rotateY(90deg);
    opacity: 0;
    }

    54% {
    -webkit-transform: translateZ(-160px) rotateY(87deg);
    transform: translateZ(-160px) rotateY(87deg);
    opacity: 1;
    }

    100% {
    -webkit-transform: translateZ(0) rotateY(0);
    transform: translateZ(0) rotateY(0);
    }
    }

    /*---------------#region Alert--------------- */

    #dialogoverlay {
    display: none;
    opacity: .8;
    position: fixed;
    top: 0px;
    left: 0px;
    background: #707070;
    width: 100%;
    z-index: 10;
    }

    #dialogbox {
    display: none;
    position: absolute;
    background: #1C3879;;
    border-radius: 7px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.575);
    transition: 0.3s;
    width: 40%;
    z-index: 10;
    top: 0;
    left: 0;
    right: 0;
    margin: auto;
    }

    #dialogbox:hover {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.911);
    }

    .container {
    padding: 2px 16px;
    }

    .pure-material-button-contained {
    position: relative;
    display: inline-block;
    box-sizing: border-box;
    border: none;
    border-radius: 4px;
    padding: 0 16px;
    min-width: 64px;
    height: 36px;
    vertical-align: middle;
    text-align: center;
    text-overflow: ellipsis;
    text-transform: uppercase;
    color: #fff;
    background-color: #1459a6;
    /* background-color: rgb(1, 47, 61) */
    box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
    font-size: 14px;
    font-weight: 500;
    line-height: 36px;
    overflow: hidden;
    outline: none;
    cursor: pointer;
    transition: box-shadow 0.2s;
    }

    .pure-material-button-contained::-moz-focus-inner {
    border: none;
    }

    /* ---------------Overlay--------------- */

    .pure-material-button-contained::before {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: #1459a6;
    opacity: 0;
    transition: opacity 0.2s;
    }

    /* Ripple */
    .pure-material-button-contained::after {
    content: "";
    position: absolute;
    left: 50%;
    top: 50%;
    border-radius: 50%;
    padding: 50%;
    width: 32px;
    /* Safari */
    height: 32px;
    /* Safari */
    background-color: #1459a6;
    opacity: 0;
    transform: translate(-50%, -50%) scale(1);
    transition: opacity 1s, transform 0.5s;
    }

    /* Hover, Focus */
    .pure-material-button-contained:hover,
    .pure-material-button-contained:focus {
    box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2), 0 4px 5px 0 rgba(0, 0, 0, 0.14), 0 1px 10px 0 rgba(0, 0, 0, 0.12);
    }

    .pure-material-button-contained:hover::before {
    opacity: 0.08;
    }

    .pure-material-button-contained:focus::before {
    opacity: 0.24;
    }

    .pure-material-button-contained:hover:focus::before {
    opacity: 0.3;
    }

    /* Active */
    .pure-material-button-contained:active {
    box-shadow: 0 5px 5px -3px rgba(0, 0, 0, 0.2), 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12);
    }

    .pure-material-button-contained:active::after {
    opacity: 0.32;
    transform: translate(-50%, -50%) scale(0);
    transition: transform 0s;
    }

    /* Disabled */
    .pure-material-button-contained:disabled {
    color: #ddd;
    background-color: #1459a6;
    box-shadow: none;
    cursor: initial;
    }

    .pure-material-button-contained:disabled::before {
    opacity: 0;
    }

    .pure-material-button-contained:disabled::after {
    opacity: 0;
    }

    #dialogbox>div {
    background: #FFF;
    margin: 8px;
    }

    #dialogbox>div>#dialogboxhead {
    background: rgb(5, 1, 70);
    font-size: 2rem;
    padding: 10px;
    color: rgb(255, 255, 255);
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    #dialogbox>div>#dialogboxbody {
    background: rgb(5, 1, 47);
    font-size: 2rem;
    padding: 20px;
    color: #FFF;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    #dialogbox>div>#dialogboxfoot {
    background: rgb(5, 1, 47);
    padding: 10px;
    text-align: right;
    }

    /*#endregion Alert*/

    .randomimg {
        z-index: 3;
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
        <button type="submit" class="randombtn" >
            <div class="randombox pointrandbox">

            <img class="randomimg" src="{{ asset('/img/randitem.png') }}" onmouseover="this.src='{{ asset('/img/mouseoverpoint.png') }}'" onmouseout="this.src='{{ asset('/img/randitem.png') }}'">
                {{-- <span class="bold">랜덤 포인트 뽑기</span>
                <span>(100pt)</span> --}}
            </div>
        </button>
    </form>

    <form action="{{route('mofin.item',[auth()->user()->userid])}}" method="post">
        @csrf
        <button type="submit" class="randombtn" >
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

    <script>

        //커스텀 알러트
        function CustomAlert(){
        this.alert = function(message,title){
        document.body.innerHTML = document.body.innerHTML + '<div id="dialogoverlay"></div> <div id="dialogbox" class="slit-in-vertical"> <div> <div id="dialogboxhead"></div><div id="dialogboxbody"></div><div id="dialogboxfoot"></div></div></div>';

        let dialogoverlay = document.getElementById('dialogoverlay');
        let dialogbox = document.getElementById('dialogbox');

        let winH = window.innerHeight;
        dialogoverlay.style.height = winH+"px";

        dialogbox.style.top = "50vh";

        dialogoverlay.style.display = "block";
        dialogbox.style.display = "block";

        document.getElementById('dialogboxhead').style.display = 'block';

        if(typeof title === 'undefined') {
        document.getElementById('dialogboxhead').style.display = 'none';
        } else {
        document.getElementById('dialogboxhead').innerHTML = '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> '+ title;
        }
        document.getElementById('dialogboxbody').innerHTML = message;
        document.getElementById('dialogboxfoot').innerHTML = '<button class="pure-material-button-contained active" onclick="customAlert.ok()">OK</button>';
        }

        this.ok = function(){
        document.getElementById('dialogbox').style.display = "none";
        document.getElementById('dialogoverlay').style.display = "none";
        // location.reload();
        }
        }

        let customAlert = new CustomAlert();

        // 페이지가 로드될 때 자동으로 실행되도록 수정
        /* window.addEventListener('load', function() {
            customAlert.alert('{{ session('pt1') }}');

        }); */
    </script>

@if($pt1 != null)
    <script>
        customAlert.alert('{{ $pt1 }}');
    </script>
@endif


@endsection