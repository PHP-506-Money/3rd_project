@extends('layout.layout')

@section('title', 'BUDGET')

@section('header', 'BUDGET')
@section('aside')

@section('contents')
<div id="content">
    <article class="l-layout menu-detail">
        <div class="l-inner">
            <div class="l-title">{{$data['currentMonth']}}월 지출 현황</div>

            <form id="cartListForm" name="cartListForm" method="get">
                <input type="hidden" id="br_id" name="br_id" value="">
                <input type="hidden" id="seq" name="seq" value="">
                <input type="hidden" id="user_id" name="user_id" value="">
            </form>

            <input type="hidden" id="sel_item_id" value="32250">
            <input type="hidden" id="target" value="">
            <input type="hidden" id="sale_id" value="">
            <section class="menu-detail__wrap">
                <div class="half menu-detail__desc-area">
                    <div class="l-badge-wrap">
                        <button class="badge l-num l-hot hot1">Month<i></i></button>
                    </div>
                    <dl class="name">
                        <dt class="tit" id="itemNm">한달 예산 : {{number_format($all)}}원</dt>


                        <dd class="desc" id="description">
                            사용한 금액 : {{number_format($sumamount)}}원
                        </dd>
                    </dl>

                    <dl class="total-price">
                        <dt class="tit">이번 달 남은예산 :</dt>

                        <dd class="total"><span class="l-num" id="totPrice">{{number_format($all - $sumamount)}}</span>원</dd>


                    </dl>


                </div>
                <div class="half menu-detail__desc-area">
                    <div class="l-badge-wrap">
                        <button class="badge l-num l-hot hot1">Week<i></i></button>
                    </div>
                    <dl class="name">
                        <dt class="tit" id="itemNm">주간 예산 : {{number_format($data['weekBudget'])}}원</dt>




                        <dd class="desc" id="description">
                            사용한 금액 : {{number_format($sumweek)}}원

                        </dd>
                    </dl>

                    <dl class="total-price">
                        <dt class="tit">이번 주 남은예산 :</dt>

                        <dd class="total"><span class="l-num" id="totPrice">{{number_format($data['leftBudget'])}}</span>원</dd>
                    </dl>
                    

                </div>
                


            </section>
            <div class="result-btn" id="orderbtn" style="display: block;margin: 4rem auto;text-align: center;">
                <a href="{{ route('budgetset.get') }}" class="budget_a"><button type="button" class="l-btn" style="border-color:#D4000B;background:#D4000B;">예산수정</button></a>



            </div>

        </div>
    </article>
</div>


</body>

@endsection