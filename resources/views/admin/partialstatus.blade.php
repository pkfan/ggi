@extends('layout.master')
@section('title', 'Partial Detail')

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
                    <h4>@lang('language.LOAN REQUEST DATA')

                    </h4>
                </div>
            </div>

            <!-- Basic Tables start -->
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">


                            <div class=" col-md-6  mb-1">

                                <div class="btn-group">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-share font-small-4 mr-50">
                                                <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                                <polyline points="16 6 12 2 8 6"></polyline>
                                                <line x1="12" y1="2" x2="12" y2="15"></line>
                                            </svg> Export
                                    </button>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <button class=" buttons-print dropdown-item btn-outline-none " tabindex="0"
                                            aria-controls="DataTables_Table_0" type="button"><span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-printer font-small-4 mr-50">
                                                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                                    <path
                                                        d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                                    </path>
                                                    <rect x="6" y="14" width="12" height="8"></rect>
                                                </svg>Print</span></button>
                                        <button class="dt-button buttons-csv buttons-html5 dropdown-item"
                                            tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-file-text font-small-4 mr-50">
                                                    <path
                                                        d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                    </path>
                                                    <polyline points="14 2 14 8 20 8"></polyline>
                                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                                    <polyline points="10 9 9 9 8 9"></polyline>
                                                </svg>Csv</span></button>
                                        <button class="dt-button buttons-excel buttons-html5 dropdown-item"
                                            tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-file font-small-4 mr-50">
                                                    <path
                                                        d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z">
                                                    </path>
                                                    <polyline points="13 2 13 9 20 9"></polyline>
                                                </svg>Excel</span></button>
                                        <button class="dt-button buttons-pdf buttons-html5 dropdown-item"
                                            tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-clipboard font-small-4 mr-50">
                                                    <path
                                                        d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                                    </path>
                                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                                </svg>Pdf</span></button>
                                        <button class="dt-button buttons-copy buttons-html5 dropdown-item"
                                            tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-copy font-small-4 mr-50">
                                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                                    <path
                                                        d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1">
                                                    </path>
                                                </svg>Copy</span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search"
                                        aria-describedby="button-addon2" />
                                    <div class="input-group-append" id="button-addon2">
                                        <button class="btn btn-outline-primary" type="button"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-search">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                            </svg></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap">@lang('language.Claim ID')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Start Date - Last Date')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Number of Installment')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Link Sent')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.No. Additional Links')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Additional Links')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Manual Collection')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Recovered Amount')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Recovered Percentage')</th>

                                            <th scope="col" class="text-nowrap">@lang('language.Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($partials as $partial)

                        <tr>
                            <td>GGI00{{$partial->id}}</td>
                            <td>{{$partial->partialPaymentRe->first()->date_time}} - {{$partial->partialPaymentRe->last()->date_time}} </td>
                            <td>{{$partial->partialPaymentRe->count()}}</td>

                            <?php
                              $sendlink = $partial->partialPaymentRe->where('status',2);
                              $unsendlink = $partial->partialPaymentRe->where('status',1);
                              $sadads= $partial->sadadPayment;
                              $linkcount0=1;
                            ?>
                            <td>
                                <b>Send Links</b> <br>
                                @foreach($sendlink as $slink)
                                {{$linkcount0++}} Link<br>

                                    {{payidcheck($slink->pay_id)}} <br>

                                @endforeach
                                <b>SADAD</b><br>
                                @if($partial->sadadPayment->count() != 0)
                                    @foreach($sadads as $sadad)
                                    {{$sadad->sadadNumber}} <br>{{sadadPayedCheck($sadad->sadadNumber)}}<br>
                                    @endforeach
                                @else
                                None <br>
                                @endif
                                <b>Pending dates</b> <br>
                                @foreach($unsendlink as $unlink)
                                {{$unlink->date_time}} <br>
                                @endforeach
                            </td>
                            <td>{{$partial->additionalLinks->count() + $partial->additionalSadadLinks->count() }}</td>


                            <?php
                            $additionalLink= $partial->additionalLinks;
                            $linkcount1=1;

                            $additionalSadad = $partial -> additionalSadadLinks;

                            ?>
                            <td>
                                @foreach($additionalLink as $aLink)
                                            {{$linkcount1++}} Link<br>{{additionalcheck($aLink->payment_id)}}<br>
                                            @endforeach

                                            <b>Sadad</b><br>
                                            @if($partial -> additionalSadadLinks->count() != 0)
                                            @foreach($additionalSadad as $sLink)
                                            {{$linkcount1++}} Link<br>{{additionalSadadCheck($sLink->sadadNumber)}}<br>
                                            @endforeach
                                            @else
                                            None<br>
                                            @endif

                                        </td>

                                        <?php
                                        $manual = $partial-> manualPartial
                                        ?>
                                        <td>
                                            @foreach($manual as $pmanual)
                                            {{$pmanual->amount}}<br>
                                            @endforeach
                                        </td>
                                        <td>{{ round(amountRecovered($partial->id) ,2 )}}</td>
                                        <td>{{ round(  amountRecovered($partial->id) / $partial->amount_after_discount * 100 ,2) }} %</td>

                                        <td><a class="btn btn-outline-success" target="_blank" href="{{route('AdminClaimDetail',$partial->id)}}">View Details</a></td>

                                    </tr>



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

@push('view-load-req-css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <!-- END: Page CSS-->
@endpush
@push('view-load-req-js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/jszip.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{asset('app-assets/js/scripts/tables/table-datatables-basic.js')}}"></script>
    <!-- END: Page JS-->
@endpush
