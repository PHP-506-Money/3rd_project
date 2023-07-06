@extends('layout.layout')

@section('title', 'MY ASSETS')

@section('header', 'MY ASSETS')

@section('contents')

<div id="content">
    <div class="inner">
        <div class="main-slick-wrap">
            <div class="con-box">
                <div class="con_wrap">
                    <p class="l-main-title wow fadeInUp">나의 자산</p>
                    

                    <div class="event-list-wrap">
@if(count($assets) === 0)

<button class="news_view_more_btn" onclick="openPopup()">연동하기</button>

<script>
    function openPopup() {
        window.open('/link', 'linkAccount', 'width=600,height=700');
    }

</script>

<div class="event-list on wow fadeInUp">
    <a href="https://www.goobne.co.kr/brd/notice/view?seq=69443" target="self">
        <div class="mo-thum">
            <img src="https://cdn.goob-ne.com/goobne/img/banner/7b7a3c9067a14a2a9c091adbc2c15fc8.png" alt="">
        </div>
        <div class="status half">
            <p class="sub">[자산이 없습니다]</p>
        </div>
        <div class="event-title half">
            <p class="main-text">연동하기 버튼을 눌러 연동해 주세요</p>
        </div>
    </a>
</div>



@else
<a class="news_view_more_btn" href="{{url('/assets/transactions'.'/'.auth()->user()->userid)}}">내 자산 내역 보러가기</a>





<table class="assetTable">
    <tr>
        <th>자산명</th>
        <th>잔액</th>
    </tr>
    @foreach($assets as $asset)
    <tr>
        <td>{{$asset->assetname}}</td>
        <td>{{number_format($asset->balance)}}원</td>


    </tr>

    @endforeach


</table>



@endif
</div>

        </div>

        @endsection





