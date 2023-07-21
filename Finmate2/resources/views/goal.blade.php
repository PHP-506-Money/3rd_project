@extends('layout.layout')
@section('title', 'GOAL')
@section('header', 'GOAL')

@section('contents')

<style>

    .goalTitle {
        margin-bottom: 5rem;
        font-size: 5rem;
        color: #1c3879;

    }

    .que {
        position: relative;
        cursor: pointer;
        color: #fff;
        background-color: #1c3879;
        padding: 2rem 0;
    }

    .que.on {
        font-weight: bold;
    }

    .anw {
        display: none;
        overflow: hidden;
    }

    .anw , .nogoals {
        margin-bottom: 5rem;
    }

    .arrow-wrap {
        position: absolute;
        top: 50%;
        right: 3vw;
        transform: translate(0, -50%);
    }

    .que .arrow-top {
        display: none;
    }

    .que .arrow-bottom {
        display: block;
        color: #fff;
    }

    .que.on .arrow-bottom {
        display: none;
    }

    .que.on .arrow-top {
        display: block;
        color: #fff;
    }

</style>

    <article class="l-layout founded" style="width: 80vw; margin: 0 auto;">

        <div class="l-title goalTitle">
            나의 목표
        </div>

        <form id="db1" name="db1" action="{{ route('goal.post') }}" method="post" class="listbox2">
            @csrf
        @include('layout.errorsvalidate')
            @method('POST')
            <div class="l-inner">
                @if(count($goals) > 0)
                <div class="l-title que">
                    나의 목표 정하기
                    <div class="arrow-wrap">
                        <span class="arrow-top">-</span>
                        <span class="arrow-bottom">+</span>
                    </div>
                </div>
                <div class="anw">
                @else
                <div class="l-title" style="color: #1c3879;">

                    나의 목표 정하기
                </div>
                <div class="nogoals">
                @endif
                    <section class="notice__detail">
                        <table class="member_table cscenter_table">
                            <colgroup>
                                <col width="10%" class="th_col th_col_01">
                                <col width="40%" class="td_col th_col_02">
                                <col width="10%" class="th_col th_col_03">
                                <col width="40%" class="td_col th_col_04">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>목표</th>
                                    <td colspan="3">
                                        <div class="search_form">
                                            <input type="text" name="title" id="title" required placeholder="목표를 입력해주세요" class="input_style input_cs" onkeyup="srchBr();">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>금액</th>
                                    <td colspan="3">
                                        <input type="number" name="amount" id="amount" placeholder="금액 최소 10만 ~ 최대 100억 숫자로 입력해주세요" min="100000" max="10000000000" class="input_style input_cs">
                                    </td>
                                </tr>
                                <tr>
                                    <th>자산 선택</th>
                                    <td colspan="3">
                                        @if(count($assets) > 0)
                                        @foreach ($assets as $asset)
                                            <style>
                                                .asset-form-check {
                                                    padding: 3px 0;
                                                }
                                                .asset-radio:checked + label>img {
                                                    border: 3px solid #ff7676;
                                                }
                                            </style>
                                        <div class="form-check asset-form-check">
                                            <input class="form-check-input asset-radio" type="radio" name="asset" id="asset{{ $asset->assetno }}" value="{{ $asset->assetno }}" required>
                                            <label class="form-check-label" name="asset" for="asset{{ $asset->assetno }}"><img style="border-radius: 3rem; width: 3rem; height: 3rem;" src="./resources/assets/images/banklogo/{{ $asset->assetname }}.png" alt="assetlogo"> {{ $asset->assetname }} (잔액: {{number_format($asset->balance) }}원)</label>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="form-check">
                                            <p>자산이 연동 되지 않았습니다.</p>
                                            <p>자산을 먼저 연동해주세요</p>
                                            <p><a href="{{ url('/assets'.'/' . auth()->user()->userid) }}">연동하러 가기 (click)</a></p>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>기간(일)</th>
                                    <td colspan="3">
                                        <input type="number" name="goal_days" id="goal_days" min="1" placeholder="숫자로 기간을 입력하세요(일단위)" required class="input_style input_cs">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                    <ul class="list_info_line list_info_line_btn">
                        <button type="reset" class="l-btn line" style="margin-top:0;">취소하기</button>
                        <button type="button" class="l-btn notice-list-btn" onclick="confirmData()" style="margin-top:0;">확인하기</button>
                    </ul>
                </div>
            </div>
        </form>
            <div class="l-inner">
                @if(count($goals) > 0)
                <div class="l-title" style="color: #1c3879;">

                    진행중인 목표
                </div>
                <div class="nogoals">
                @foreach($goals as $goal)
                <form id="db2{{ $goal->goalno }}" name="db2{{ $goal->goalno }}" action="{{ route('goal.put') }}" method="post" class="listbox2">
                @csrf
                @method('put')
                <input type="hidden" name="set_goal_id" value="{{ $goal->goalno }}" />
                <section class="notice__detail">
                    <table class="member_table cscenter_table">
                        <colgroup>
                            <col width="10%" class="th_col th_col_01">
                            <col width="40%" class="td_col th_col_02">
                            <col width="10%" class="th_col th_col_03">
                            <col width="40%" class="td_col th_col_04">
                        </colgroup>
                        <tbody>
                            @if(now()->diffInDays($goal->endday) + 1 < 7)
                            <tr>
                                <th>!!!</th>
                                <td colspan="3">
                                    <div class="search_form">
                                        <h2 style="color:red;">목표달성일이 일주일 보다 적게 남았습니다</h2>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <th>목표</th>
                                <td colspan="3">
                                    <div class="search_form">
                                        <input type="text" name="set_title" id="set_title" required placeholder="{{$goal->title}}" class="input_style input_cs" onkeyup="srchBr();">


                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>목표 자산</th>
                                <td colspan="3">{{ $goal->assetname }}</td>
                            </tr>
                            <tr>
                                <th>목표 금액</th>
                                <td colspan="3">
                                    <input type="number" name="set_amount" id="amount" placeholder="{{number_format($goal->amount)}} 원" min="100000" max="10000000000" class="input_style input_cs">

                                </td>
                            </tr>
                            <tr>
                                <th>남은 금액</th>
                                <td colspan="3">{{ number_format($goal->amount - $goal->balance) }} 원</td>
                            </tr>
                            <tr>
                                <th>남은 기간</th>
                                <td colspan="3">
                                    <input type="number" name="set_goal_days" id="goal_days" min="1" placeholder="{{ now()->diffInDays($goal->endday) + 1 }}일" required class="input_style input_cs">

                                </td>
                            </tr>
                            <tr>
                                <th>목표일</th>
                                <td colspan="3">
                                    {{$goal->endday}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <ul class="list_info_line list_info_line_btn">
                    <button type="button" class="l-btn notice-list-btn" onclick="confirmData2({{ $goal->goalno }})" style="margin-top:0;">수정하기</button>
                </ul>
                </form>
                <ul class="list_info_line list_info_line_btn">
                    <form id="db3{{ $goal->goalno }}" name="db3{{ $goal->goalno }}" action="{{ route('goal.delete') }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="del_goal_id" value="{{ $goal->goalno }}" />
                        <button type="button" class="l-btn line" onclick="confirmData3({{ $goal->goalno }})" style="margin-top:10px;">삭제하기</button>

                    </form>
                </ul>
                @endforeach
                @else
                    <div class="l-title que">

                        진행중인 목표
                        <div class="arrow-wrap">
                            <span class="arrow-top">↑</span>
                            <span class="arrow-bottom">↓</span>
                        </div>
                    </div>
                    <div class="anw">

                    <section class="notice__detail">
                        <h2 style="text-align: center; font-size: 3rem;">진행중인 목표가 없습니다.</h2>
                    </section>
                @endif
                </div>

                <div class="l-title que" style="margin-top:30px;">
                    달성한 목표
                    <div class="arrow-wrap">
                        <span class="arrow-top">↑</span>
                        <span class="arrow-bottom">↓</span>
                    </div>
                </div>
                <div class="anw">
                @if(count($goalsCom) > 0)

                @foreach($goalsCom as $goalsCom)
                    <section class="notice__detail">
                        <table class="member_table cscenter_table">
                            <colgroup>
                                <col width="10%" class="th_col th_col_01">
                                <col width="40%" class="td_col th_col_02">
                                <col width="10%" class="th_col th_col_03">
                                <col width="40%" class="td_col th_col_04">
                            </colgroup>
                            <tbody>
                                    <tr>
                                        <th>목표</th>
                                        <td colspan="3">{{$goalsCom->title}}</td>
                                    </tr>
                                    <tr>
                                        <th>목표 자산</th>
                                        <td colspan="3">{{ $goalsCom->assetname }} 원</td>
                                    </tr>
                                    <tr>
                                        <th>목표한 금액</th>
                                        <td colspan="3">
                                            {{number_format($goalsCom->amount)}} 원
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>목표일</th>
                                        <td colspan="3">
                                            {{$goalsCom->endday}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>달성일</th>
                                        <td colspan="3">
                                            {{$goalsCom->completed_at}}
                                        </td>
                                    </tr>

                            </tbody>
                        </table>
                    </section>
                @endforeach
                @else
                    <section class="notice__detail">
                        <h2 style="text-align: center; font-size: 3rem;">달성한 목표가 없습니다.</h2>
                    </section>


                @endif
                </div>
                
                <div class="l-title que" style="margin-top:30px;">
                    실패한 목표
                    <div class="arrow-wrap">
                        <span class="arrow-top">↑</span>
                        <span class="arrow-bottom">↓</span>
                    </div>
                </div>
                <div class="anw">
                @if(count($goalsFail) > 0)
                    @foreach($goalsFail as $goalsFail)
                    <section class="notice__detail">
                        <table class="member_table cscenter_table">
                            <colgroup>
                                <col width="10%" class="th_col th_col_01">
                                <col width="40%" class="td_col th_col_02">
                                <col width="10%" class="th_col th_col_03">
                                <col width="40%" class="td_col th_col_04">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>목표</th>    
                                    <td colspan="3">{{$goalsFail->title}}</td>
                                </tr>
                                <tr>
                                    <th>목표 자산</th>
                                    <td colspan="3">{{ $goalsFail->assetname }}</td>


                                </tr>
                                <tr>
                                    <th>목표한 금액</th>

                                    <td colspan="3">
                                        {{number_format($goalsFail->amount)}} 원
                                    </td>
                                </tr>
                                <tr>
                                    <th>남은 금액</th>
                                    <td colspan="3">{{ number_format($goalsFail->amount - $goalsFail->balance) }} 원</td>
                                </tr>
                                <tr>
                                    <th>목표일</th>
                                    <td colspan="3">
                                        {{$goalsFail->endday}}

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                    @endforeach
                @else
                    <section class="notice__detail">
                        <h2 style="text-align: center; font-size: 3rem;">실패한 목표가 없습니다.</h2>
                    </section>
                @endif
                </div>

            </div>
        {{-- </form> --}}

        <script>

        $(".que").click(function() {
        $(this).next(".anw").stop().slideToggle(300);
        $(this).toggleClass('on').siblings().removeClass('on');
        $(this).next(".anw").siblings(".anw").slideUp(300); // 1개씩 펼치기
        });

            function confirmData() {
                if (confirm("입력하신 내용이 맞습니까?")) {
                    document.getElementById("db1").submit();
                }
            }

            function confirmData2($goalid) {

            if (confirm("수정하시겠습니까?")) {
                document.getElementById("db2" + $goalid).submit();
                }
            }

            function confirmData3($goalid) {
            if (confirm("삭제하시겠습니까?")) {
                document.getElementById("db3" + $goalid).submit();
                }
            }

        </script>
    </article>


    


@endsection
