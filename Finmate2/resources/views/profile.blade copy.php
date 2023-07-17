@extends('layout.layout')

@section('title', 'Myinfo')

@section('header', 'MY MOFIN')

@section('contents')
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
    <link rel="stylesheet" href="{{ asset('/css/hj.css')  }}" >
    <div class="top1"></div>
    <div class="success">{!!session()->has('success') ? session('success') : ""!!}</div>
    @include('layout.errorsvalidate')
    <div class="profile">{{-- 모핀 프로필 시작 --}}
        <div class="myinfo" >
            {{-- <form id="myinfo" name="myinfo" action="{{route('users.itemflg')}}" method="post" onsubmit="return updateItemFlg()"> --}}
            <form id="myinfo" name="myinfo" action="{{route('users.itemflg')}}" method="post">
                @csrf
                    <div class="moffin">
                        @foreach ($data as $user)
                        <img src="{{ asset('/img/moffin' . $user->moffintype . '.png') }}" alt="">
                        @endforeach
                        {{-- @foreach ($data as $user)
                            @if ($user->moffintype == 0)
                                <img src="{{ asset('/img/moffin2.png') }}">
                            @elseif ($user->moffintype == 1)
                                <img src="{{ asset('/img/rabbit3.png') }}">
                            @elseif ($user->moffintype == 2)
                                <img src="{{ asset('/img/penguin3.png') }}">
                            @elseif ($user->moffintype == 3)
                                <img src="{{ asset('/img/panda3.png') }}" alt="">
                            @elseif ($user->moffintype == 4)
                                <img src="{{ asset('/img/moffin4.png') }}" alt="">
                            @elseif ($user->moffintype == 5)
                                <img src="{{ asset('/img/moffin5.png') }}" alt="">
                            @elseif ($user->moffintype == 6)
                                <img src="{{ asset('/img/moffin6.png') }}" alt="">
                            @endif
                        @endforeach --}}
                        <div class="charitem">
                            @foreach ($items as $item)
                                <img id="charitem{{ $item->itemno }}" class="{{ $item->itemflg == 1 ? '' : 'noneimg' }} imgposition" src="{{ asset('/img/charitem'.$item->itemno.'.png') }}">
                            @endforeach
                        </div>
                        {{-- <div class="charitem">
                            <img id="charitem1" class="noneimg imgposition" src="{{ asset('/img/sunglasses.png') }}">
                            <img id="charitem2" class="noneimg imgposition" src="{{ asset('/img/sword.png') }}" >
                            <img id="charitem3" class="noneimg imgposition" src="{{ asset('/img/safe.png') }}" >
                            <img id="charitem4" class="noneimg imgposition" src="{{ asset('/img/air.png') }}"   >
                            <img id="charitem5" class="noneimg imgposition" src="{{ asset('/img/idcard.png') }}">
                            <img id="charitem6" class="noneimg imgposition" src="{{ asset('/img/wing.png') }}" >
                            <img id="charitem7" class="noneimg imgposition" src="{{ asset('/img/tea.png') }}" >
                            <img id="charitem8" class="noneimg imgposition" src="{{ asset('/img/bat.png') }}" >
                            <img id="charitem9" class="noneimg imgposition" src="{{ asset('/img/eyeing.png') }}" >
                            <img id="charitem10" class="noneimg imgposition" src="{{ asset('/img/notebook.png') }}" >
                            <img id="charitem11" class="noneimg imgposition" src="{{ asset('/img/hanbok.png') }}" >
                            <img id="charitem12" class="noneimg imgposition" src="{{ asset('/img/hanbokbaji.png') }}" >
                            <img id="charitem13" class="noneimg imgposition" src="{{ asset('/img/kindcloth.png') }}" >
                        </div> --}}
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
                        <div id="info">
                            {{ $user->username }} 님의 <textarea name="moffinname" id="moffinname" cols="10" rows="1" placeholder="한글, 영어 1~6자 입력" onfocus="this.placeholder = ''" onblur="this.placeholder = '한글, 영어 1~6자 입력'" required>{{ $user->moffinname }}</textarea>
                        </div>
                        <div class="bottom2">
                            <button type="submit" class="button" id="savebtn">저장하기</button>
                            <button type="button" class="button" id="btn" onclick="btnClick();">공유하기</button>
                        </div>
                        <div class="moffinname">
                            <a href="{{ route('users.mofinname') }}">모핀이명 변경</a>
                        </div>
        </div>
    </div>
                    {{-- @endif --}}
                        {{-- 모핀 프로필 종료 --}}
                        <div class="container">
                            <div class="title">
                                <h6>내 아이템 목록(클릭시 장착/해제)</h6>
                            </div>
                            <div class="itemlist"> {{-- 아이템 부분 --}}
                                @foreach ($items as $item)
                                        <button class="itembtn" name="itemno" onclick="toggleitem({{ $item->itemno }})">
                                            <img src="{{ asset('/img/charitem'.$item->itemno.'.png') }}" class="itemimg">
                                        </button>
                                @endforeach
                            </div>
                            {{-- <div class="itemlist"> 아이템 부분
                                @foreach($itemname as $value)
                                    @if($value === '선글라스')
                                        <button class="itembtn"  onclick="toggleitem1()" > <img src="{{ asset('/img/sunglasses.png') }}" class = "itemimg">  </button>
                                    @elseif($value === '검')
                                        <button class="itembtn"   onclick="toggleitem2()" > <img src="{{ asset('/img/sword.png') }}" class = "itemimg">  </button>
                                    @elseif($value === '안전모')
                                        <button class="itembtn"   onclick="toggleitem3()" > <img src="{{ asset('/img/safe.png') }}"  class = "itemimg"> </button>
                                    @elseif($value === '에어팟맥스')
                                        <button class="itembtn"   onclick="toggleitem4()" > <img src="{{ asset('/img/air.png') }}"  class = "itemimg">  </button>
                                    @elseif($value === '사원증')
                                        <button class="itembtn"   onclick="toggleitem5()" > <img src="{{ asset('/img/idcard.png') }}"  class = "itemimg"> </button>
                                    @elseif($value === '날개')
                                        <button class="itembtn"   onclick="toggleitem6()" > <img src="{{ asset('/img/wing.png') }}"  class = "itemimg"> </button>
                                    @elseif($value === '티셔츠')
                                        <button class="itembtn"   onclick="toggleitem7()" > <img src="{{ asset('/img/tea.png') }}"  class = "itemimg"> </button>
                                    @elseif($value === '야구배트')
                                        <button class="itembtn"   onclick="toggleitem8()" > <img src="{{ asset('/img/bat.png') }}"  class = "itemimg"> </button>
                                    @elseif($value === '아잉눈')
                                        <button class="itembtn"   onclick="toggleitem9()" > <img src="{{ asset('/img/eyeing.png') }}"  class = "itemimg"> </button>
                                    @elseif($value === '노트북')
                                        <button class="itembtn"   onclick="toggleitem10()" > <img src="{{ asset('/img/notebook.png') }}"  class = "itemimg"> </button>
                                    @elseif($value === '여성한복')
                                        <button class="itembtn"   onclick="toggleitem11()" > <img src="{{ asset('/img/hanbok.png') }}"  class = "itemimg"> </button>
                                    @elseif($value === '남성한복')
                                        <button class="itembtn"   onclick="toggleitem12()" > <img src="{{ asset('/img/hanbokbaji.png') }}"  class = "itemimg"> </button>
                                    @elseif($value === '유아복')
                                        <button class="itembtn"   onclick="toggleitem13()" > <img src="{{ asset('/img/kindcloth.png') }}"  class = "itemimg"> </button>
                                    @endif    
                                @endforeach
                            </div> --}}
                            
                        </div>
                @endif
            </form>
@endsection

<script src="{{ asset('/js/user.js') }}"></script>
<script>
    function updateItemFlg() {
        // 폼 내의 모든 아이템 버튼을 선택합니다.
        var itemButtons = document.getElementsByClassName('itembtn');

        // 선택한 각 아이템 버튼의 상태를 확인하고 업데이트합니다.
        for (var i = 0; i < itemButtons.length; i++) {
            var itemButton = itemButtons[i];
            var itemNo = itemButton.getAttribute('data-itemno');
            var itemFlg = itemButton.classList.contains('noneimg') ? 0 : 1;

            // TODO: 서버로 아이템 상태를 업데이트하는 AJAX 요청을 보냅니다.
            // AJAX 요청을 사용하여 서버에 아이템 상태를 전달하고 업데이트합니다.
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // AJAX 요청을 보냅니다.
            fetch('{{ route("users.itemflg") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    itemno: itemNo,
                    itemflg: itemFlg
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(response.status + ' : API 응답 오류');
                }
                return response.json();
            })
            .then(data => {
                // 응답 결과를 처리합니다.
                if (data.success) {
                    console.log('아이템 상태 업데이트 성공');
                } else {
                    console.error('아이템 상태 업데이트 실패:', data.error);
                }
            })
            .catch(error => {
                console.error('아이템 상태 업데이트 오류:', error);
            });
        }
    }
</script>