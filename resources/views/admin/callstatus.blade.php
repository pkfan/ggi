@extends('layout.master')
@section('title', 'Call status')

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
                        <h4>@lang('Language.CALL RESPONSE STATUS')

                        </h4>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">


                                <div class=" col-md-6  mb-1">

                                <div class="form-modal-ex">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#inlineForm">
                                         @lang('language.Search')
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel33">@lang('language.Search')</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{url('admin/search-call-status')}}" method="post">
                                                        @csrf
                                                        <section id="input-mask-wrapper">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h4 class="card-title">@lang('language.Search Anything you want')</h4>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="credit-card">@lang('language.Claim Id')</label>
                                                                                    <input type="text" class="form-control credit-card-mask" name="claimid" id="credit-card" />
                                                                                </div>
                                                                                <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="credit-card">@lang('language.Call Id')</label>
                                                                                    <input type="text" class="form-control credit-card-mask" name="refid" id="credit-card" />
                                                                                </div>
                                                                                <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="credit-card">@lang('language.Call Status')</label>
                                                                                    <select name="callstatus" class="form-control">
                                                                                        <option value="">@lang('language.Select Status')</option>
                                                                                        <option value="completed">@lang('language.Completed')</option>
                                                                                        <option value="no-answer">@lang('language.No Answer')</option>
                                                                                        <option value="busy">@lang('language.Busy')</option>
                                                                                        <option value="failed">@lang('language.Failed')</option>
                                                                                    </select>
                                                                                </div>








                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary" >@lang('language.Search')</button>
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">@lang('language.Cancel')</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap">@lang('language.Claim Id')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Call Id')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Reference Id')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Call Status')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Call Duration')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Action')</th>




                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($response as $res)
                                        <tr>
                                            <td>GGI00{{$res->claim_id}}</td>

                                            <td>{{$res->callId}}</td>

                                            <td>{{$res->referenceId}}</td>

                                            <td>{{$res->statuss}}</td>
                                            <td>{{$res->duration}}</td>

                                            @if($res->statuss!='completed')
                                            <td><a href="{{url('admin/call-again/'.$res->claim_id)}}" class="btn btn-primary">Call Again</a></td>
                                            @else
                                            <td>Done</td>
                                            @endif
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <x-pagination :data="$response" />
                        </div>
                    </div>
                </div>
                <!-- Basic Tables end -->



            </div>



        </div>
    </div>
    <!-- END: Content-->
@endsection

@push('call-status-css')
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

@push('call-status-js')
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
