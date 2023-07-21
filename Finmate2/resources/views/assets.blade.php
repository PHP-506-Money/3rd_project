@extends('layout.layout')

@section('title', '나의 자산')

@section('header', '나의 자산')

@section('contents')

<style>
    .l-main-title {
        font-size: 72px;
        font-weight: bold;
        margin-top: 30px;
        text-align: center;
    }

    .assets-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 40px;
    }

    .asset-card {
        width: 300px;
        margin: 20px;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .asset-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .asset-name {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333333;
    }

    .asset-balance {
        font-size: 18px;
        color: #888888;
        margin-bottom: 20px;
    }

    .view-more-link {
        display: block;
        text-align: center;
        font-size: 16px;
        color: #ffffff;
        background-color: black;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .view-more-link:hover {
        background-color: var(--main-color);
    }

    /*@media (min-width: 769px) and (max-width: 1024px) {

        .asset-card {
            width: calc(50% - 40px);
            padding: 100px;
        }
    }*/

    @media (max-width: 768px) {
        .asset-card {
            width: calc(100% - 40px);
            margin: 20px;
            padding: 60px
        }
    }

    @media (max-width: 480px) {
        .asset-card {
            width: calc(100% - 40px);
            margin: 10px;
            padding: 30px;
        }
    }
</style>

<div id="content">
    <div class="inner">
        <div class="main-slick-wrap">
            <div class="con-box">
                <div class="con_wrap">
                    <p class="l-main-title wow fadeInUp">나의 자산</p>

                    <div class="assets-container">
                        @if(count($assets) === 0)
                            <div class="asset-card wow fadeInUp">
                                <div>
                                    <p class="asset-name">[자산이 없습니다]</p>
                                    <p class="asset-balance">연동하기 버튼을 눌러 연동해 주세요</p>
                                </div>
                                <div class="view-more-container">
                                    <button class="view-more-link" onclick="openPopup()">연동하기</button>
                                </div>
                            </div>

                            <script>
                                function openPopup() {
                                    window.open('/link', 'linkAccount', 'width=600,height=700');
                                }
                            </script>
                        @else
                            @foreach($assets as $asset)
                                <div class="asset-card wow fadeInUp">
                                    <div>
                                        <img style="border-radius: 3rem; width: 3rem; height: 3rem;" src="{{asset('/resources/assets/images/banklogo/'.$asset->assetname.'.png')}}" alt="assetlogo">

                                        <p class="asset-name">{{$asset->assetname}}</p>
                                        <p class="asset-balance">{{number_format($asset->balance)}}원</p>
                                        <div class="view-more-container">
                                            <form action="{{ route('transactions.search',[auth()->user()->userid]) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="startdate" value="20220720" >
                                            <input type="hidden" name="enddate" value="20230719" >
                                            <input type="hidden" name="search_asset" value="{{$asset->assetname}}" >
                                            <input type="hidden" name="search_tran" value="99" >
                                            <input type="hidden" name="search_category" value="99">
                                            <button class="view-more-link" type="submit">자산내역보러가기</button>
                                            </form>
                                            {{-- <a class="view-more-link" href="{{ route('transactions.search',[auth()->user()->userid]) }}">자산 내역 보러가기</a> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection