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
                            <div class="col-12 d-flex justify-content-end">
                                <div class="btn-group" style="padding: 0 0 6px;">
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

                    <div class="col-12 card" style="padding: 16px;">
                        @if (boolval($targets->count()))
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap">#</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Targets')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Acheived (%)')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Acheived')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Pending')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Start Date')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.End Date')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($targets as $target)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ $target->total }}</td>
                                                <td>{{ $target->acheived_percentage ?? '0' }}%</td>
                                                <td>{{ $target->achieved ?? '0' }}</td>
                                                <td>{{ $target->pending }}</td>
                                                <td>{{ \Carbon\Carbon::parse($target->start_date)->format('M d Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($target->end_date)->format('M d Y') }}</td>
                                            </tr>
                                            <?php
                                            $count++;
                                            ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <x-pagination :data="$targets" />
                        @else
                            <x-errors.not-found />
                        @endif
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
                name: "Desktops",
                // data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Acheived Targets by Month',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                title: {
                    text: '2023 year'
                }
            },
            yaxis: {
                title: {
                    text: 'Acheived Targets Amount'
                },
                // min: 5,
                // max: 40
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        ////////////////////////////////

        let offficerTargetsLineChartOfTotalAchieved = (data) => {
            hideSpinner();
            window.monthsOfTargets = [];
            window.acheivedTargetsOfMonth = [];
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

            for (let [month, target] of Object.entries(data.targets)) {
                acheivedTargetsOfMonth.push(Number(target).toFixed(2));
                monthsOfTargets.push(month);
            }

            console.log('monthsOfTargets : ', monthsOfTargets);
            console.log('acheivedTargetsOfMonth : ', acheivedTargetsOfMonth);

            if (!monthsOfTargets.length) {
                setTimeout(() => {
                    document.querySelector("#chart").innerHTML =
                        `<h5 style="text-align: center;padding: 48px;color: red;">There are no records of officer targets</h5>`;
                }, 300);

            }

            let maxAcheived = Math.max(...monthsOfTargets);
            let MaxAcheived_3 = maxAcheived / 3;
            let MaxAcheived_1_5 = maxAcheived / 1.5;



            console.log('else (window.chart){', chart);

            chart.updateOptions({
                series: [{
                    name: 'acheived targets by officer',
                    data: acheivedTargetsOfMonth

                }],
                xaxis: {
                    categories: monthsOfTargets,
                    title: {
                        text: `${data.year} year`
                    }

                },

            });

        };

        let authUserId = {!! auth()->user()->id !!};

        let fetchOfficerTargets = (year = '') => {
            $.ajax({
                url: `/api/officer/targets?year=${year}&user_id=${authUserId}`,
                type: 'GET',
                xhrFields: {
                    withCredentials: true
                },
                success: function(result) {
                    offficerTargetsLineChartOfTotalAchieved(result);
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

        function onYearSelect() {
            let chooseYearTarget = document.querySelector('#choose-years-targets');
            console.log(chooseYearTarget.value);
            window.yearForOfficerTarget = chooseYearTarget.value;

        }

        function fetchOfficertargetsStatisticsByMonth() {
            // remove old chart data html
            document.querySelector("#chart").innerHTML = '';
            showSpinner();
            window.monthsOfTargets = null;
            window.acheivedTargetsOfMonth = null;
            // let chooseMonthsTarget = document.querySelector('#choose-months-targets');
            // console.log(chooseMonthsTarget.value);

            fetchOfficerTargets(window.yearForOfficerTarget);
        }
    </script>
@endpush
