@extends('layout.layout')

@section('title', 'MY TRANSACTIONS')

@section('header', 'MY TRANSACTIONS')

@section('contents')

<div style="margin-top:300px;  height: 600px;" >
    <table class="scriptCalendar" style=" width:50%; height: 600px; text-align:center; font-size:30px; margin:0px auto; " >
        <thead>
            <tr>
                <td class="calendarBtn" id="btnPrevCalendar">&#60;&#60;</td>
                <td colspan="5">
                    <span id="calYear">YYYY</span>년
                    <span id="calMonth">MM</span>월
                </td>
                <td class="calendarBtn" id="nextNextCalendar">&#62;&#62;</td>
            </tr>
            <tr>
                <td>일</td>
                <td>월</td>
                <td>화</td>
                <td>수</td>
                <td>목</td>
                <td>금</td>
                <td>토</td>
            </tr>
        </thead>
        <tbody class="scriptCalendarVal"></tbody>

    </table>
</div>


<div class="listbox">

<!-- 좌우 버튼 -->

<h3 style=" width:50%; text-align:center; font-size:50px; margin:0px auto; margin-top:20px " >
    <button class="button min" id="previous-month-btn">&#60;&#60;</button>
    <span id="current-month"></span>월
    <button class="button min" id="next-month-btn">&#62;&#62;</button>
    <br>
    <span style="font-size:30px" > 이번달 총 수입: </span> <span id="monthly-income" style="font-size:40px"  ></span> 원
    <span style="font-size:30px"> 이번달 총 지출: </span>  <span id="monthly-expense" style="font-size:40px" ></span> 원
</h3>

{{-- 0706 v2 최혁재 --}}
{{-- 최신순 과거순 추가해야함 --}}
            <div style=" width:50%; text-align:center; font-size:20px; margin:0px auto; margin: top 20px; " >
            <form action="{{ route('transactions.search',[auth()->user()->userid]) }}" method="post">
            @csrf
            <label for="startdate">시작일자</label>
            <input type="date" class="" name="startdate" id="startdate" required>

            <label for="enddate">종료일자</label>
            <input type="date" class="" name="enddate" id="enddate" required >
            
            <select name="search_asset" id="search_asset">
							<option value="99">전체</option>
							<option value="토스뱅크">토스뱅크</option>
							<option value="신한은행">신한은행</option>
							<option value="현대카드">현대카드</option>
							<option value="대구은행">대구은행</option>
							<option value="카카오뱅크">카카오뱅크</option>
							<option value="국민은행">국민은행</option>
							<option value="하나은행">하나은행</option>
							<option value="우리은행">우리은행</option>
							<option value="농협은행">농협은행</option>
							<option value="새마을금고">새마을금고</option>

            </select>

            <select id = "search_tran" name="search_tran">
							<option value="99">전체</option>
							<option value="0">입금</option>
							<option value="1">출금</option>
            </select> 
            <select id = "search_category" name="search_category">
							<option value="99">전체</option>
                            @foreach($category as $value)
							<option value={{ $value->no }}>{{ $value->name }}</option>
                            @endforeach
            </select> 
            <button type="submit">검색</button>
            </form>
            </div>

            <script>
                $(document).ready(function() {
                    $('#search_tran').on('change', function() {
                        var search_category1 = document.getElementById('search_category');
                        if ($('#search_tran').val() === '0') {
                            search_category1.style.display = 'none';
                            search_category1.value = '9';
                        } else {
                            search_category1.style.display = 'inline-block';
                        }
                    });
                });
            </script>

            @if(isset($data))
            <div id ="search_box" style=" width:50%; text-align:center; font-size:25px; margin:0px auto; margin-top:20px; display:block; " >
                <span style="font-size:30px; color:red; margin-bottom : 10px;">검색결과   </span><button onclick="SearchBox()">숨기기</button><br><br>
                    @foreach($data as  $value)
                        {{ $value->assetname }}
                            @if($value->type == '0')
                                <span>입금</span>
                            @else
                                <span>출금</span>
                            @endif
                        {{ $value->payee }}
                        {{ $value->name }}
                        {{ $value->amount }}
                        {{ $value->trantime }}
                        <br>
                    @endforeach
            </div>
        @endif
            
    <table id="assetTable" class="assetTable" style=" width:50%; text-align:center; font-size:20px; margin:0px auto; margin-top:20px " >
        <thead>
            <tr>
                <th>자산명</th>
                <th>거래구분</th>
                <th>거래처</th>
                <th>카테고리</th>
                <th>거래금액</th>
                <th>거래일시</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $tran)
            <tr data-month="{{ substr($tran->trantime, 0, 7) }}">
                <td>{{$tran->assetname}}</td>
                @if($tran->type == '0')
                <td>입금</td>
                @else
                <td>출금</td>
                @endif
                <td>{{$tran->payee}}</td>
                @if($tran->type == '0')
                <td>수입</td>
                @else
                <td>{{$tran->name}}</td>
                @endif

                @if($tran->type == '0')
                <td>{{number_format($tran->amount)}}원</td>
                @else
                <td>-{{number_format($tran->amount)}}원</td>
                @endif

                <td>{{$tran->trantime}}</td>
            </tr>
            @endforeach
        </tbody>

    </table>



<script>
    function SearchBox() {
        var searchBox = document.getElementById("search_box");
        var assetTable = document.getElementById("assetTable");


            searchBox.style.display = "none";
            assetTable.style.display = "table";
        
    }

    // 검색 결과가 있을 때 assetTable 숨김 처리
    @if(isset($data))
    var searchBox = document.getElementById("search_box");
    var assetTable = document.getElementById("assetTable");
    searchBox.style.display = "block";
    assetTable.style.display = "none";
    @endif
    

    function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    const currentMonthElem = document.getElementById("current-month");
    const monthlyIncomeElem = document.getElementById("monthly-income");
    const monthlyExpenseElem = document.getElementById("monthly-expense");
    const previousMonthBtn = document.getElementById("previous-month-btn");
    const nextMonthBtn = document.getElementById("next-month-btn");
    const allRows = document.querySelectorAll(".listbox tbody tr");
    const monthlyIncome = JSON.parse('@json($monthly_income)'.replace(/&quot;/g, '\"'));
    const monthlyExpense = JSON.parse('@json($monthly_expense)'.replace(/&quot;/g, '\"'));

    const today = new Date();
    let currentYear = today.getFullYear();
    let currentMonth = today.getMonth() + 1;
    currentMonth = currentMonth < 10 ? '0' + currentMonth : currentMonth;

    const updateMonthElem = () => {
    const monthStr = `${currentYear}-${currentMonth}`;
    currentMonthElem.textContent = monthStr;
    showByMonth(monthStr);
    monthlyIncomeElem.textContent = numberWithCommas(monthlyIncome[monthStr] || 0);
    monthlyExpenseElem.textContent = numberWithCommas(monthlyExpense[monthStr] || 0);
    };

    const showByMonth = (month) => {
        allRows.forEach((row) => {
            if (row.dataset.month === month) row.style.display = "table-row";
            else row.style.display = "none";
        });
    }; 

    // 초기 표시
    updateMonthElem();

   // 이전 달로 이동
previousMonthBtn.addEventListener("click", () => {
prevCalendar();
currentMonth = parseInt(currentMonth, 10) - 1;

if (currentMonth < 1) { 
    currentMonth=12; currentYear--; 
    } 
    currentMonth=currentMonth < 10 ? '0' + currentMonth : currentMonth; updateMonthElem(); 
    }
    );



// 다음 달로 이동
nextMonthBtn.addEventListener("click", () => {
nextCalendar();
currentMonth = parseInt(currentMonth, 10) + 1;

if (currentMonth > 12) {
currentMonth = 1;
currentYear++;
}
currentMonth = currentMonth < 10 ? '0' + currentMonth : currentMonth; updateMonthElem(); });


    document.addEventListener("DOMContentLoaded", function() {
        buildCalendar();

        document.getElementById("btnPrevCalendar").addEventListener("click", function(event) {
            prevCalendar();
            currentMonth = parseInt(currentMonth, 10) - 1;

            if (currentMonth < 1) { currentMonth=12; currentYear--; } currentMonth=currentMonth < 10 ? '0' + currentMonth : currentMonth; updateMonthElem(); 

        });

        document.getElementById("nextNextCalendar").addEventListener("click", function(event) {
            nextCalendar();
            currentMonth = parseInt(currentMonth, 10) + 1;

            if (currentMonth > 12) {
            currentMonth = 1;
            currentYear++;
            }
            currentMonth = currentMonth < 10 ? '0' + currentMonth : currentMonth; updateMonthElem();

        });
    });

    var toDay = new Date(); // @param 전역 변수, 오늘 날짜 / 내 컴퓨터 로컬을 기준으로 toDay에 Date 객체를 넣어줌
    var nowDate = new Date(); // @param 전역 변수, 실제 오늘날짜 고정값

    /* @brief   이전달 버튼 클릭시 */
    function prevCalendar() {
        this.toDay = new Date(toDay.getFullYear(), toDay.getMonth() - 1, toDay.getDate());
        buildCalendar(); // @param 전월 캘린더 출력 요청
    }

    /* @brief   다음달 버튼 클릭시 */
    function nextCalendar() {
        this.toDay = new Date(toDay.getFullYear(), toDay.getMonth() + 1, toDay.getDate());
        buildCalendar(); // @param 명월 캘린더 출력 요청
    }

    /**
     * @brief   캘린더 오픈
     * @details 날짜 값을 받아 캘린더 폼을 생성하고, 날짜값을 채워넣는다.
     */
    function buildCalendar() {

        let doMonth = new Date(toDay.getFullYear(), toDay.getMonth(), 1);
        let lastDate = new Date(toDay.getFullYear(), toDay.getMonth() + 1, 0);

        let tbCalendar = document.querySelector(".scriptCalendar > tbody");

        document.getElementById("calYear").innerText = toDay.getFullYear(); // @param YYYY월
        document.getElementById("calMonth").innerText = autoLeftPad((toDay.getMonth() + 1), 2); // @param MM월


        // @details 이전 캘린더의 출력결과가 남아있다면, 이전 캘린더를 삭제한다.
        while (tbCalendar.rows.length > 0) {
            tbCalendar.deleteRow(tbCalendar.rows.length - 1);
            // clearTransactionAmounts();
        }

        // @param 첫번째 개행
        let row = tbCalendar.insertRow();

        // @param 날짜가 표기될 열의 증가값
        let dom = 1;

        // @details 시작일의 요일값( doMonth.getDay() ) + 해당월의 전체일( lastDate.getDate())을  더해준 값에서
        //               7로 나눈값을 올림( Math.ceil() )하고 다시 시작일의 요일값( doMonth.getDay() )을 빼준다.
        let daysLength = (Math.ceil((doMonth.getDay() + lastDate.getDate()) / 7) * 7) - doMonth.getDay();

        // @param 달력 출력
        // @details 시작값은 1일을 직접 지정하고 요일값( doMonth.getDay() )를 빼서 마이너스( - )로 for문을 시작한다.
        for (let day = 1 - doMonth.getDay(); daysLength >= day; day++) {

            let column = row.insertCell();

            // @param 평일( 전월일과 익월일의 데이터 제외 )
            if (Math.sign(day) == 1 && lastDate.getDate() >= day) {

                // @param 평일 날짜 데이터 삽입
                column.innerText = autoLeftPad(day, 2);

                // @param 일요일인 경우
                if (dom % 7 == 1) {
                    column.style.color = "#FF4D4D";
                }

                // @param 토요일인 경우
                if (dom % 7 == 0) {
                    column.style.color = "#4D4DFF";
                    row = tbCalendar.insertRow(); // @param 토요일이 지나면 다시 가로 행을 한줄 추가한다.
                }

            }

            // @param 평일 전월일과 익월일의 데이터 날짜변경
            {{-- else {
                let exceptDay = new Date(doMonth.getFullYear(), doMonth.getMonth(), day);
                column.innerText = autoLeftPad(exceptDay.getDate(), 2);
                column.style.color = "#A9A9A9";
            } --}}

            // @brief   전월, 명월 음영처리
            // @details 현재년과 선택 년도가 같은경우
            if (toDay.getFullYear() == nowDate.getFullYear()) {

                // @details 현재월과 선택월이 같은경우
                if (toDay.getMonth() == nowDate.getMonth()) {

                    // @details 현재일보다 이전인 경우이면서 현재월에 포함되는 일인경우
                    if (nowDate.getDate() > day && Math.sign(day) == 1) {
                        column.style.cursor = "pointer";
                        column.style.color = "#607EAA";

                    }

                    // @details 현재일보다 이후이면서 현재월에 포함되는 일인경우
                    else if (nowDate.getDate() < day && lastDate.getDate() >= day) {
                        column.style.cursor = "pointer";
                    }

                    // @details 현재일인 경우
                    else if (nowDate.getDate() == day) {
                        column.style.backgroundColor = "#FF7676";

                        column.style.cursor = "pointer";
                    }

                    // @details 현재월보다 이전인경우
                } else if (toDay.getMonth() < nowDate.getMonth()) {
                    if (Math.sign(day) == 1 && day <= lastDate.getDate()) {
                        column.style.cursor = "pointer";
                        column.style.color = "#607EAA";
                    }
                }

                // @details 현재월보다 이후인경우
                else {
                    if (Math.sign(day) == 1 && day <= lastDate.getDate()) {
                        column.style.cursor = "pointer";
                    }
                }
            }

            // @details 선택한년도가 현재년도보다 작은경우
            else if (toDay.getFullYear() < nowDate.getFullYear()) {
                if (Math.sign(day) == 1 && day <= lastDate.getDate()) {}
            }

            // @details 선택한년도가 현재년도보다 큰경우
            else {
                if (Math.sign(day) == 1 && day <= lastDate.getDate()) {
                    column.style.cursor = "pointer";
                }
            }

            dom++;
        }
        @if(count($transactions) > 0)

        const transactions = @json($transactions);

        function showTransactionAmounts() {
            if (document.querySelector("tbody.scriptCalendarVal")) {

                let calendarCells = document.querySelectorAll("tbody.scriptCalendarVal > tr > td");


                for (let i = 0; i < calendarCells.length; i++) {
                    const cell = calendarCells[i];
                    const date = new Date(toDay.getFullYear(), toDay.getMonth(), parseInt(cell.innerText));
                    let depositAmount = 0;
                    let withdrawalAmount = 0;
                    transactions.forEach(transaction => {
                        const transactionDate = new Date(transaction.trantime);

                        if (transactionDate.toDateString() === date.toDateString()) {
                            if (transaction.type === '0') {
                                depositAmount += transaction.amount;
                            } else {
                                withdrawalAmount += transaction.amount;
                            }
                        }
                    });

                    if (depositAmount > 0 || withdrawalAmount > 0) {
                        const amounts = document.createElement('div');
                        amounts.innerHTML = `<span style="color: blue">+${depositAmount}</span><br><span style="color: red">-${withdrawalAmount}</span>`;
                        cell.appendChild(amounts);
                    }
                }
            }
        }

        showTransactionAmounts();

        @endif


    }

    /**
     * @brief   숫자 두자릿수( 00 ) 변경
     * @details 자릿수가 한자리인 ( 1, 2, 3등 )의 값을 10, 11, 12등과 같은 두자리수 형식으로 맞추기위해 0을 붙인다.
     * @param   num     앞에 0을 붙일 숫자 값
     * @param   digit   글자의 자릿수를 지정 ( 2자릿수인 경우 00, 3자릿수인 경우 000 … )
     */
    function autoLeftPad(num, digit) {
        if (String(num).length < digit) {
            num = new Array(digit - String(num).length + 1).join("0") + num;
        }
        return num;
    }

</script>


@endsection








