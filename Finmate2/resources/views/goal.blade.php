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
                                    <input type="number" name="amount" id="amount" placeholder="금액" min="100000" max="1000000000" class="input_style input_cs">
                                </td>
                            </tr>
                            <tr>
                                <th>시작일자</th>
                                <td colspan="3">
                                    <input type="date" name="startperiod" id="startperiod" required placeholder="목표시작일" class="input_style input_cs">
                                </td>
                            </tr>
                            <tr>
                                <th>목표일자</th>
                                <td colspan="3">
                                    <input type="date" name="endperiod" id="endperiod" required placeholder="목표마감일" class="input_style input_cs">

                                </td>
                            </tr>
                        </tbody>
                    </table>

                </section>
                <ul class="list_info_line list_info_line_btn">
                    <li><button type="reset" class="l-btn line" style="margin-top:0;">취소하기</button></li>
                    <li><button type="button" class="l-btn notice-list-btn" style="margin-top:0;">등록하기</button></li>

                </ul>
            </div>
        
    </form>
        <div class="l-inner">
            <div class="l-title" style="margin-top:50px;"> 진행중인 목표들 </div>

            @if(isset($data))

            @foreach($data as $goal)

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
                                <input type="date" name="startperiod" id="startperiod" required placeholder="{{ $goal->startperiod }}" class="input_style input_cs">
                            </td>
                        </tr>
                        <tr>
                            <th>목표일자</th>
                            <td colspan="3">
                                <input type="date" name="endperiod" id="endperiod" required placeholder="{{ $goal->endperiod }}" class="input_style input_cs">
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
