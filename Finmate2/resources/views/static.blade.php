@extends('layout.layout')

@section('title', 'static')

@section('header', 'STATIC')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-latest.js"></script> 
<link rel="stylesheet" href="{{ asset('/css/static.css')  }}" >

@section('contents')
    <div class="top1">
    @if($assetchk === 0)
    <div id="myModal" class="modal">
        <div class="modal_content">
            <div class="modalMsg">
                고객님, 연동된 자산이 없습니다.<br><br>
                자산을 연동해 주세요.<br><br>
                확인을 누르시면 자산 연동하기로 이동합니다.<br><br>
            </div>
            <div onClick="close_pop();">
                <span class="pop_bt" >
                    확인
                </span>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('myModal').style.display = 'block';
        });

        function close_pop(flag) {
            document.getElementById('myModal').style.display = 'none';
            location.href = "{{ route('assets.index',[auth()->user()->userid]) }}";
        }
    </script>

    @else
        <div id="currentyear">
            <h3>
                <button type="button" onclick="showLastYear()">
                    ◀
                </button>
                {{ $currentYear }}년 월별 입지출 내역
            </h3>
            <div class="chartBar">
                <canvas id="monthChart"></canvas>
            </div>
        </div>
        <div id="lastyear" class="none">
            <h3>
                {{ $lastYear }}년 월별 입지출 내역
                <button type="button" onclick="showCurrentYear()">
                    ▶
                </button>
            </h3>
            <div class="chartBar">
                <canvas id="lastMonthChart"></canvas>
            </div>
        </div>

        <div class="line2"></div>
        <h3>
            <button type="button" onclick="showLastMonth()">
                ◀
            </button>
            {{ $mmonth }}월 카테고리별 지출 내역
            <input type="hidden" value="{{ $mmonth }}">
            <button type="button" onclick="showNextMonth()">
                ▶
            </button>
        </h3>
            @if(empty($catdata))
                <div class="empty">해당 월의 지출이 없습니다.</div>
            @else
                <div class="donutChart">
                    <article>
                        <div class = "chartDo">
                            <div class ="categoryChar">
                                <canvas id="categoryChart"></canvas>
                                <div class="allcategoryChart">
                                    @php
                                        $colors = [
                                            '#ffadad',
                                            '#ffd6a5',
                                            '#fdffb6',
                                            '#d0f4de',
                                            '#a8dadc',
                                            '#bde0fe',
                                            '#a1d3ff',
                                            '#b8c0ff',
                                            '#ffc8dd',
                                        ];
                                        $colorIndex = 0; // Counter to loop through colors array
                                    @endphp
                                    <div class="percent">
                                        @foreach($percent as $data)
                                            @php
                                                // Get the color for this iteration and update the counter
                                                $color = $colors[$colorIndex];
                                                $colorIndex = ($colorIndex + 1) % count($colors);
                                            @endphp
                                            <!-- Apply the background color to the p tag -->
                                            <p style="background-color: {{$color}}">{{$data}}%</p>
                                        @endforeach
                                    </div>
                                    <div class="catdetail">
                                        @foreach($catdata as $data)
                                            <p class="catname">{{$data->category}}</p>
                                            <p class="catprice">{{number_format($data->consumption)}}원</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <br>
                            <p class="maxEx">최대 지출 카테고리  : {{$catdata[0]->category}}</p>
                        </div>
                    </article>
                </div>
            @endif


        <script>
            // 브라우저 사이즈 조정시마다 새로고침
            window.onresize = function(){
                document.location.reload();
            };

            // chart.js 데이터 입력 시작
            let monthrcLabels = [];
            let monthrcData = [];
            let lastMonthrcLabels = [];
            let lastMonthrcData = [];

            // 올해 월별 입금
            @foreach($monthrc as $data)
                monthrcLabels.push("{{ $data->Month }}");
                monthrcData.push({{ $data->consumption }});
            @endforeach

            // 작년 월별 입금
            @foreach($lastmonthrc as $data)
                lastMonthrcLabels.push("{{ $data->Month }}");
                lastMonthrcData.push({{ $data->consumption }});
            @endforeach

            let monthexData = [];
            let lastMonthexData = [];

            // 올해 월별 지출
            @foreach($monthex as $data)
                monthexData.push({{ $data->consumption }});
            @endforeach

            // 작년 월별 지출
            @foreach($lastmonthex as $data)
                lastMonthexData.push({{ $data->consumption }});
            @endforeach

            let categoryLabels = [];
            let categoryData = [];

            @foreach($catdata as $data)
                categoryLabels.push("{{ $data->category }}");
                categoryData.push({{ $data->consumption }});
            @endforeach

            // 카테고리 색깔을 지정하는 배열
            let colors = [
                '#ffadad',
                '#ffd6a5',
                '#fdffb6',
                '#d0f4de',
                '#a8dadc',
                '#bde0fe',
                '#a1d3ff',
                '#b8c0ff',
                '#ffc8dd',
            ];

            var monthChart = new Chart(document.getElementById('monthChart'), {
                type: 'bar',
                data: {
                    labels: monthrcLabels,
                    datasets: [{
                        label: '월별 입금',
                        data: monthrcData,
                        backgroundColor: '#f07167',
                        borderColor: '#f07167',
                        borderWidth: 1
                        },
                        {
                        label: '월별 지출',
                        data: monthexData,
                        backgroundColor: '#b5e2fa',
                        borderColor: '#b5e2fa',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var lastMonthChart = new Chart(document.getElementById('lastMonthChart'), {
                type: 'bar',
                data: {
                    labels: lastMonthrcLabels,
                    datasets: [{
                        label: '월별 입금',
                        data: lastMonthrcData,
                        backgroundColor: '#f07167',
                        borderColor: '#f07167',
                        borderWidth: 1
                        },
                        {
                        label: '월별 지출',
                        data: lastMonthexData,
                        backgroundColor: '#b5e2fa',
                        borderColor: '#b5e2fa',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                } 
            });

            var categoryChart = new Chart(document.getElementById('categoryChart'), {
                type: 'doughnut',
                data: {
                    labels: categoryLabels,
                    datasets: [{
                        label: '지출',
                        data: categoryData,
                        backgroundColor: colors,
                        borderColor: colors,
                        borderWidth: 1,
                    }]
                },
                options: {
                    responsive: false,
                    cutoutPercentage: 50,
                    plugins: {
                        legend: {
                            position: 'left'
                        },
                    },
                    tooltips: {
                        enabled: false
                    },
                    hover: {
                        animationDuration: 0
                    },
                }
            });

            function showCurrentYear() {
                var currentYear = document.getElementById('currentyear');
                var lastYear = document.getElementById('lastyear');
                currentYear.classList.remove('none');
                lastYear.classList.add('none');
            }

            function showLastYear() {
                var currentYear = document.getElementById('currentyear');
                var lastYear = document.getElementById('lastyear');
                currentYear.classList.add('none');
                lastYear.classList.remove('none');
            }

            function showLastMonth() {
                var currentMonth = {{ $mmonth }};
                var previousMonth = currentMonth === 1 ? 12 : currentMonth - 1;
                location.href = "{{ route('static.get', [auth()->user()->userid]) }}?mmonth=" + previousMonth;
            }

            function showNextMonth() {
                var currentMonth = {{ $mmonth }};
                var nextMonth = currentMonth === 12 ? 1 : currentMonth + 1;
                location.href = "{{ route('static.get', [auth()->user()->userid]) }}?mmonth=" + nextMonth;
            }
        </script>

    @endif
</div>
@endsection
