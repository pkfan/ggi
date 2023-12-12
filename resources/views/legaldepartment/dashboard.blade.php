@extends('layout.master')
@section('title', 'Admin Dashboard')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">

        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <!-- Stats Horizontal Card -->
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                @php
                                    $users = \App\Models\User::all();
                                @endphp
                                <h2 class="font-weight-bolder mb-0">{{$users->count()}}</h2>
                                <p class="card-text">@lang('language.Total User')</p>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="check" class="font-medium-5"></i>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
            <!--/ Stats Horizontal Card -->
            @if ( auth()->user()->hasRole('super-admin') ||  auth()->user()->hasRole('director') || auth()->user()->hasRole('manager') || auth()->user()->hasRole('manager'))
                                           
                <div class="row">
                    <div class="col-12 col-lg-12">
                      <div class="card radius-10">
						  <div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="mb-0">Collected Claims Per Admin</h6>
								</div>
							
							</div>
								<div class="d-flex align-items-right">
									<!-- <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>-->
									<!--</a> -->
									<!--<ul class="dropdown-menu">-->
									<!--	<li><a class="dropdown-item" href="javascript:;" onclick="claimyr(2022)">2022</a>-->
									<!--	</li>-->
									<!--	<li><a class="dropdown-item" href="javascript:;" onclick="claimyr(2023)">2023</a>-->
									<!--	</li>-->
										
									<!--</ul>--> <a href="{{url('admin/recovered')}}" class="btn btn-primary">Details</a>
								</div>
							
                            <label for="year">Select Year:</label>
                            <select id="year" class="form-control">
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023" selected>2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                                <!-- Add more years as needed -->
                            </select>
                            <?php 
                             $user = \App\Models\User::whereHasRole('officer')->get();
                            ?>
                            <label for="user">Select User (optional):</label>
                            <select class="form-control" id="user">
                                <option value='' selected>Select Admin</option>
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>

                                <canvas id="barChart" width="400" height="200"></canvas>

							
						  </div>
						  <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
						  </div>
					  </div>
				   </div>
                </div>
            @endif
        </div>

    </div>
    <!-- END: Content-->
@endsection

@push('dashboard-css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <!-- END: Page CSS-->
@endpush
@push('dashboard-js')
    <!-- BEGIN: Page Vendor JS-->
   
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
     <!-- END: Page JS-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

$(document).ready(function() {
      // Initialize the chart with no data
      var chartData = {
        labels: [],
        datasets: [{
            label: 'Amount Collected',
            data: [],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    var options = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    var ctx = document.getElementById('barChart').getContext('2d');
    var barChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: options
    });
            // Fetch data from your API endpoint
           

            function updateChart(selectedYear, selectedUser) {

                var apiUrl = 'collectClaim/' + selectedYear;
                if (selectedUser) {
                    apiUrl =  'collectClaim/' + selectedYear +'/' + selectedUser;
                    //alert(selectedUser);
                }

                 //   url= 'collectClaim/' + selectedYear;
                   // alert(url);
                    $.ajax({
                    url: apiUrl, // Replace with your actual API endpoint
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        if (Object.keys(data).length > 0) {
                    // Update the chart with new data
                    var values = Object.values(data);
                    var labels = Object.keys(data);

                    // Update chart data
                    barChart.data.labels = labels;
                    barChart.data.datasets[0].data = values;
                    barChart.update();
                } else {
                    // Clear the chart if no new data is available
                    barChart.data.labels = [];
                    barChart.data.datasets[0].data = [];
                    barChart.update();
                    console.log('No new data available for ' + selectedYear);
                }                    },
                    error: function(error) {
                        console.error('Error fetching data from the API:', error);
                    }
                });
            }
           

            updateChart($('#year').val(), '');

            // Update the chart when the user selects a different year
            $('#year').on('change', function() {
                var selectedYear = $(this).val();
                var selectedUser = $('#user').val();
                updateChart(selectedYear, selectedUser);
            });

            // Update the chart when the user selects a different user
            $('#user').on('change', function() {
                var selectedYear = $('#year').val();
                var selectedUser = $(this).val();
                updateChart(selectedYear, selectedUser);
            });


        });


</script>
@endpush
