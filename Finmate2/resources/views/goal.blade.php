@extends('layout.layout')

@section('title', 'goals')

@section('header', 'GOAL')

@section('contents')

@include('layout.errorsvalidate')

    <article class="l-layout founded" style="width: 80vw; margin: 0 auto;">
    <form id="db1" name="db1" action="{{ route('goal.post') }}" method="post" class="listbox2" id="db1">

        @method('POST')
        @csrf
        <div class="l-inner">
            <div class="l-title"> 나의 목표 정하기</div>
            <!-- 고객의 소리 쓰기 영역  -->
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
                                <input type="number" name="amount" id="amount" placeholder="금액" min="100000" max="10000000000" class="input_style input_cs">
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

    <script>
        function confirmData() {
            if (confirm("입력하신 내용이 맞습니까?")) {
                document.getElementById("db1").submit();
            }
        }

    </script>


        <div class="l-inner">
            <div class="l-title" style="margin-top:50px;"> 진행중인 목표들 </div>

            @if(isset($data))
            @foreach($data as $goal)

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
                                    <input type="text" name="title" id="title" required placeholder="{{ $goal->title }}" class="input_style input_cs" onkeyup="srchBr();">

                                    
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>금액</th>
                            <td colspan="3">
                                <input type="number" name="amount" id="amount" placeholder="{{ $goal->amount }}" min="100000" max="1000000000" class="input_style input_cs">
                                
                            </td>
                        </tr>
                        <tr>
                            <th>시작일자</th>
                            <td colspan="3">
                                <input type="date" name="startperiod" id="startperiod" required placeholder="{{ $goal->startperiod }}" value="{{ $goal->startperiod }}" class="input_style input_cs">

                            </td>
                        </tr>
                        <tr>
                            <th>목표일자</th>
                            <td colspan="3">
                                <input type="date" name="endperiod" id="endperiod" required value="{{ $goal->endperiod }}" placeholder="{{ $goal->endperiod }}" class="input_style input_cs">


                            </td>
                        </tr>
                        <tr>
                            <th>달성금액</th>
                            <td colspan="3">
                                {{ number_format($goalint) }}

                            </td>
                        </tr>
                        <tr>
                            <th>달성률</th>
                            <td colspan="3">
                                {{ ceil(($goalint/$goal->amount)*100).'%' }}

                            </td>
                        </tr>

                    </tbody>
                </table>

               

            </section>
            <ul class="list_info_line list_info_line_btn">
                <li>
                    <form action="{{ route('goal.delete') }}" method="delete">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="goalno" value="{{ $goal->goalno }}">
                        <button type="submit" class="l-btn line" style="margin-top:0;">삭제</button>
                    </form>
                </li>
                <li>
                    <form action="{{ route('goal.put') }}" method="put" id="form_{{ $goal->goalno }}" >
                        @csrf
                        @method('put')
                        <input type="hidden" name="goalno" value="{{ $goal->goalno }}">
                        <button type="submit" class="l-btn notice-list-btn" style="margin-top:0;">수정</button>
                    </form>
                </li>

            </ul>
             @endforeach
                @endif
        </div>

        <div class="l-inner">
            <div class="l-title" style="margin-top:50px;"> 목표 달성 목록</div>

            @if(isset($data1))
            @foreach($data1 as $goal)

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
                                {{ $goal->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>금액</th>
                            <td colspan="3">
                                {{ $goal->amount }}
                            </td>
                        </tr>
                    </tbody>
                </table>

            </section>
            <ul class="list_info_line list_info_line_btn">
                <li>
                    <form action="{{ route('goal.delete') }}" method="delete">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="goalno" value="{{ $goal->goalno }}">
                        <button type="submit" class="l-btn line" style="margin-top:0;">삭제</button>


                    </form>
                </li>


            </ul>
        </div>
        @endforeach
        @endif



    </article>


@endsection
