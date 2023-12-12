@extends('layout.master')
@section('title', 'Recovery Detail')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0"></h2>

                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <h4> @lang('language.Recovery Details')

                        </h4>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                            <form action="{{url('admin/recovery/amount')}}" method="">
                                <div class="row">
                                    <h1></h1>
                                    <div class="col-md-4">
                                    
                                        <?php 
                                            $users =DB::table('users')->where('is_super',0)->where('roll',0)->where('status',1)->select('id','name')->get();
                                            $userId = request('userId'); // Using request() helper function
                                            $year = request('year');
                                        ?>
                                        <select class="form-control" name="userId">
                                            <option value='' selected>Select Admin</option>
                                            @if($userId != null)
                                            <option value="{{$userId}}" selected>{{username($userId)->name}}</option>
                                            @endif
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="year">
                                            <option value='' selected>Select Year</option>
                                            @if($year != null)
                                            <option value="{{$year}}" selected>{{$year}}</option>
                                            @endif
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                        </select>

                                    </div>
                                    <!-- <div class="col-md-2">
                                        <select class="form-control">
                                            <option>Select Month</option>
                                            <option value="1">Jan</option>
                                            <option value="2">Feb</option>
                                            <option value="3">Mar</option>
                                            <option value="4">Apr</option>
                                            <option value="5">May</option>
                                            <option value="6">Jun</option>
                                            <option value="7">Jul</option>
                                            <option value="8">Aug</option>
                                            <option value="9">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                        </select>

                                    </div> -->
                                    <div class="col-md-1">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                
                                </div>
                            </form>
                               
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th scope="col" class="text-nowrap">Claim Id</th>
                                            <th scope="col" class="text-nowrap">Debtor Name</th>
                                            <th scope="col" class="text-nowrap">Claim Number</th>  
                                            <th scope="col" class="text-nowrap">Recovered Date</th>
                                            <th scope="col" class="text-nowrap">Amount Recovered</th> 
                                            <th scope="col" class="text-nowrap">Assign Name</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $count =1;
                                        ?>
                                        @foreach ($dataByMonth as $month => $data)
                                        <tr>
                                            <td colspan="6" style="background-color:gray ;text-align: center; vertical-align: middle;" ><b>Month</b>  {{$month}}</td>
                                        </tr>
                                            @foreach ($data['payment'] as $paymentData)
                                                <tr>
                                                    <td>GGI00{{ $paymentData->claim_id }}</td>
                                                    <td>{{ $paymentData->deb_name }}</td>
                                                    <td>{{ $paymentData->claim_no }}</td>
                                                    <td>{{ $paymentData->created_at }}</td>
                                                    <td>{{ $paymentData->amount }} Bank Transfer</td>
                                                    <td>{{ username($paymentData->is_assign)->name }}</td>
                                                    
                                                </tr>
                                                <!-- Replace with actual properties -->
                                            @endforeach

                                        
                                         

                                            
                                            @foreach ($data['partialManual'] as $partialManualData)
                                            <tr>
                                                    <td>GGI00{{ $partialManualData->claim_id }}</td>
                                                    <td>{{ $partialManualData->deb_name }}</td>
                                                    <td>{{ $partialManualData->claim_no }}</td>
                                                    <td>{{ $partialManualData->created_at }}</td>
                                                    <td>{{ $partialManualData->amount }} Manual</td>
                                                    <td>{{ username($partialManualData->is_assign)->name }}</td>
                                            </tr><!-- Replace with actual properties -->
                                            @endforeach

                                        
                                        @endforeach
                        
                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Basic Tables end -->



            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
