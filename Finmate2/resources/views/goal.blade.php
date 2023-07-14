@extends('layout.layout')

@section('title', 'goals')

@section('header', 'GOAL')

@section('contents')

    <article class="l-layout founded" style="width: 80vw; margin: 0 auto;">
        <form id="db1" name="db1" action="{{ route('goal.post') }}" method="post" class="listbox2">
        @include('layout.errorsvalidate')
            @method('POST')
            @csrf
            <div class="l-inner">
                <div class="l-title"> 나의 목표 정하기</div>
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
                                        <input type="text" name="title" id="title" required placeholder="목표" class="input_style input_cs" onkeyup="srchBr();">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>금액</th>
                                <td colspan="3">
                                    <input type="number" name="amount" id="amount" placeholder="금액 최소 10만 ~ 최대 100억" min="100000" max="10000000000" class="input_style input_cs">
                                </td>
                            </tr>
                            <tr>
                                <th>자산 선택</th>
                                <td colspan="3">
                                    @foreach ($assets as $asset)
                                    <div class="form-check">
                                        <input style="appearance: button;" class="form-check-input" type="radio" name="asset" id="asset{{ $asset->assetno }}" value="{{ $asset->assetno }}" required>
                                        <label class="form-check-label" name="asset" for="asset{{ $asset->assetno }}">자산명: {{ $asset->assetname }}  (잔액: {{number_format($asset->balance) }}원)</label>
                                    </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>기간(일)</th>
                                <td colspan="3">
                                    <input type="number" name="goal_days" id="goal_days" min="1" placeholder="기간을 입력하세요" required class="input_style input_cs">
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
        </form>
    </article>

    <article class="l-layout founded" style="width: 80vw; margin: 0 auto;">
        <form id="db2" name="db2" action="{{ route('goal.put') }}" method="post" class="listbox2">
            @include('layout.errorsvalidate')
            @method('put')
            @csrf
            <div class="l-inner">
                <div class="l-title"> 나의 목표들</div>
                @if($goals)
                @foreach($goals as $goal)


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
                                        <input type="text" name="title" id="title" required placeholder="{{$goal->title}}" class="input_style input_cs" onkeyup="srchBr();">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>목표 자산</th>
                                <td colspan="3">{{ $goal->assetname }}</td>
                            </tr>
                            <tr>
                                <th>금액</th>
                                <td colspan="3">
                                    <input type="number" name="amount" id="amount" placeholder="{{$goal->amount}}" min="100000" max="10000000000" class="input_style input_cs">

                                </td>
                            </tr>
                            <tr>
                                <th>남은 금액</th>
                                <td colspan="3">{{ $goal->amount - $goal->balance }}원</td>
                            </tr>
                            <tr>
                                <th>남은 기간</th>
                                <td colspan="3">
                                    <input type="number" name="goal_days" id="goal_days" min="1" placeholder="{{ now()->diffInDays($goal->endday) + 1 }}일" required class="input_style input_cs">
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
                    <form id="db3" name="db3" action="{{ route('goal.delete') }}" method="delete">
                        @method('delete')

                        <button type="button" class="l-btn line" onclick="confirmData3()" style="margin-top:0;">삭제하기</button>
                    </form>
                    <button type="button" class="l-btn notice-list-btn" onclick="confirmData2()" style="margin-top:0;">수정하기</button>

                </ul>
                @endforeach
                @endif
            </div>
        </form>

        <script>
            function confirmData() {
                if (confirm("입력하신 내용이 맞습니까?")) {
                    document.getElementById("db1").submit();
                }
            }

            function confirmData2() {
            if (confirm("수정하시겠습니까?")) {
            document.getElementById("db2").submit();
            }
            }

            function confirmData3() {
            if (confirm("삭제하시겠습니까?")) {
            document.getElementById("db3").submit();
            }
            }

        </script>
    </article>


    


@endsection
