@extends('layout.master')
@section('title', 'targets statistics')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0" style="border-right: none;">
                                OFFICER TARGETS STATISTICS
                            </h2>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body pl-1">


                <div class="row">
                    <div class="col-12 card" style="padding: 16px;">
                        <div class="row align-items-center" style="font-weight: 600;padding: 0 16px;border-bottom: 1px solid #cfcfcf;">
                            <div class="col-4">officers</div>
                            <div class="col-4">Acheived Targets</div>
                            <div class="col-4 d-flex justify-content-end">
                                <div class="btn-group" style="padding: 0 0 6px;">
                                    <select onchange="onMonthSelect();" id="choose-months-targets" class="btn btn-outline-primary btn-sm waves-effect" id="basicSelect">
                                        @php
                                            $months = [
                                                'January'=>1,
                                                'February'=>2,
                                                'March'=>3,
                                                'April'=>4,
                                                'May'=>5,
                                                'June'=>6,
                                                'July'=>7,
                                                'August'=>8,
                                                'September'=>9,
                                                'October'=>10,
                                                'November'=>11,
                                                'December'=>12
                                            ];
                                        @endphp
                                        <option value='all'>All month</option>

                                        @foreach ($months as $monthKey => $monthValue )
                                            <option value="{{$monthValue}}">{{{$monthKey}}}</option>
                                        @endforeach
                                    </select>
                                    <select onchange="onYearSelect()" id="choose-years-targets" class="btn btn-outline-primary btn-sm waves-effect" id="basicSelect">
                                        @php
                                            $years = [
                                                '2023',
                                                '2024',
                                                '2025',
                                                '2026',
                                                '2027',
                                                '2028',
                                                '2029',
                                                '2030',
                                            ];
                                        @endphp
                                        @foreach ($years as $year )
                                            <option value="{{$year}}">{{{$year}}}</option>
                                        @endforeach
                                    </select>
                                    <button onclick="fetchOfficertargetsStatisticsByMonth()" type="button" class="btn btn-outline-primary btn-sm waves-effect">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{-- spinner  --}}
                        <div class="spinner-toggler w-100 d-flex justify-content-center align-content-center my-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div id="chart"></div>
                    </div>
                </div>



            </div>



        </div>
    </div>
    <!-- END: Content-->
@endsection

@push('apexcharts-js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        let hideSpinner = () => {
            let spinTogle = document.querySelector('.spinner-toggler');
            spinTogle.classList.remove('d-flex');
            spinTogle.classList.add('d-none');
        }
        let showSpinner = () => {
            let spinTogle = document.querySelector('.spinner-toggler');
            spinTogle.classList.remove('d-none');
            spinTogle.classList.add('d-flex');
        }

        ////////////////////////////////
        var options = {
                    series: [{
                        name: 'acheived targets by officer',
                        // data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
                        // data: totalAcheived
                    }],
                    chart: {
                        type: 'bar',
                        // height: 350
                        height: 'auto'
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            horizontal: true,
                            width:2
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        // categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France',
                        //     'Japan',
                        //     'United States', 'China', 'Germany'
                        // ],
                        // categories: officersNames,
                    },
                    colors: [function({
                        value,
                        seriesIndex,
                        w
                    }) {
                        // if (value < MaxAcheived_3) {
                        //     return '#D9534F'
                        // } else if (value < MaxAcheived_1_5) {
                        //     return '#cdc800'
                        // } else {
                        //     return '#00b700'
                        // }
                    }],
                    dataLabels: {
                        enabled: true,
                        offsetX: -6,
                        style: {
                            fontSize: '12px',
                            colors: ['#fff']
                        }
                    },
                    noData: {
                        text: 'Officer Targets not found.'
                    }

                };

                let chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();

                ////////////////////////////////

        let allOfficersTargetsBarChartOfTotalAchieved = (data) => {
            hideSpinner();
            window.totalAcheived = [];
            window.officersNames = [];
            // data = {
            //     "41": {
            //         "officer_name": "ictest1",
            //         "total_achieved": 130513.041666667
            //     },
            //     "42": {
            //         "officer_name": "finance employ",
            //         "total_achieved": 69022.946428571
            //     },
            // }

            for (let [key, value] of Object.entries(data)) {
                totalAcheived.push(Number(value.total_achieved).toFixed(2));
                officersNames.push(value.officer_name);
            }

            console.log('totalAcheived : ', totalAcheived);
            console.log('officersNames : ', officersNames);

            if(! totalAcheived.length){
                setTimeout(() => {
                    document.querySelector("#chart").innerHTML = `<h5 style="text-align: center;padding: 48px;color: red;">There are no records of officer targets</h5>`;
                }, 300);

            }

            let maxAcheived = Math.max(...totalAcheived);
            let MaxAcheived_3 = maxAcheived / 3;
            let MaxAcheived_1_5 = maxAcheived / 1.5;



                console.log('else (window.chart){', chart);

                chart.updateOptions({
                    series: [{
                        name: 'acheived targets by officer',
                        data: totalAcheived

                    }],
                    xaxis: {
                       categories: officersNames,

                    },
                    colors: [function({
                        value,
                        seriesIndex,
                        w
                    }) {
                        if (value < MaxAcheived_3) {
                            return '#D9534F'
                        } else if (value < MaxAcheived_1_5) {
                            return '#cdc800'
                        } else {
                            return '#00b700'
                        }
                    }],
                });

        };

        let fetchOfficerTargets = (month='', year='')=>{
            $.ajax({
                url: `/api/admin/officer/targets?month=${month}&year=${year}`,
                type: 'GET',
                success: function(result) {

                        allOfficersTargetsBarChartOfTotalAchieved(result);


                },
                error: function(error) {
                    console.log('officer error', error);
                    alert('all officers targets data not fetched', error);
                }
            });
        }

        ////////// fetch officer targets data ///////////
        $(document).ready(function() {
            fetchOfficerTargets();

            // setTimeout(() => {
            //     fetchOfficerTargets();

            // }, 4000);

        });

        //////////////////////
        function onMonthSelect(){
            let chooseMonthsTarget = document.querySelector('#choose-months-targets');
            console.log(chooseMonthsTarget.value);
            window.monthForOfficerTarget = chooseMonthsTarget.value;
        }

        function onYearSelect(){
            let chooseYearTarget = document.querySelector('#choose-years-targets');
            console.log(chooseYearTarget.value);
            window.yearForOfficerTarget = chooseYearTarget.value;

        }

        function fetchOfficertargetsStatisticsByMonth(){
            // remove old chart data html
            document.querySelector("#chart").innerHTML = '';
            showSpinner();
            window.totalAcheived = null;
            window.officersNames = null;
            // let chooseMonthsTarget = document.querySelector('#choose-months-targets');
            // console.log(chooseMonthsTarget.value);

            fetchOfficerTargets(window.monthForOfficerTarget, window.yearForOfficerTarget );

        }

    </script>
@endpush
