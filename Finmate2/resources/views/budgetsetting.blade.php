@extends('layout.layout')

@section('title', 'BUDGET')

@section('header', 'BUDGET')
@section('aside')


@section('contents')
<div id="content">
    <form id="domantForm" name="domantForm" method="get">
        <input type="hidden" id="domant_id" name="domant_id">
    </form>

    <article class="l-layout login">

        <section class="login__inner">
            @include('layout.errorsvalidate')
            @if ($existingBudget)
            <div class="l-title">한달 예산 수정하기</div>
            <div class="login__form-wrap">
                <div class="form members">
                    <form id="table" class="members__form" action="{{route('budget.put')}}" method="post">
                    @csrf
                    @method('PUT')
                        <div class="login__input">
                            <div class="line">
                                <label for="id">예산을 수정해 주세요</label>
                                <div class="icon-input">
                                    <input type="number" name="budgetprice" id="budgetprice">
                                </div>
                            </div>
                        </div>
                        <br>
                        <button class="l-btn" type="submit">수정</button>
                    </form>
                    <div class="login__link">
                        <a href="{{ route('budget.get',[auth()->user()->userid])}}">돌아가기</a>
                    </div>
                </div>
            @else
            <div class="l-title">한달 예산 설정하기</div>
            <div class="login__form-wrap">
                <div class="form members">
                    @if($assetLinked > 0)
                    <form id="table" class="members__form" action="{{route('budget.post')}}" method="post">
                        @csrf
                        <div class="login__input">
                            <div class="line">
                                <label for="budgetprice">예산을 설정해 주세요</label>
                                <div class="icon-input">
                                    <input type="number" name="budgetprice" id="budgetprice">
                                </div>
                            </div>
                        </div>
                        <br>
                        <button class="l-btn" type="submit">설정</button>
                    </form>
                    @else
                    <div class="login__input">
                        <div class="line" >
                            <h2>* 자산을 먼저 연동해 주세요</h2>
                        </div>
                    </div>
                    <br>
                        <button class="l-btn" type="button" onclick="location.href='{{ url('/assets'.'/' . auth()->user()->userid) }}'">연동하러가기</button>
                    @endif
                </div>
            </div>
            @endif
    </article>

</div>

@endsection