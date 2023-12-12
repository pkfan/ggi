@extends('layout.master')
@section('title', 'Objections')

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
                        <h4>@lang('language.Objections')

                        </h4>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">


                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap">@lang('language.Claim ID')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.User Name')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Company Name')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Response')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Assign Admin')</th>
                                            {{-- <th scope="col" class="text-nowrap">@lang('language.Detail')</th> --}}

                                            <th scope="col" class="text-nowrap">@lang('language.Action')</th>




                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($objection as $obj)
                                        <tr>
                                            <td>GGI00{{$obj->claim_id}}</td>
                                            <td>{{companyname($obj->claim_id)}}</td>
                                            <td>{{rescompany($obj->claim_id)}}</td>
                                            <td>Objection</td>
                                            <?php
                                            $claim=DB::table('claims')->where('id',$obj->claim_id)->first();
                                            
                                            ?>
                                            
                                            <td>
                                                @if(empty($claim->is_assign))
                                                N/A
                                                    
                                                @else
                                                {{username($claim->is_assign)}}
                                                @endif
                                            </td>
                                            {{-- <td><a href="{{url('admin/claim/detail/'.$obj->claim_id)}}" class="btn btn-outline-success" target="_blank">View Details</a></td> --}}
                                            <td>
                                                <!-- <a href="{{url('admin/claim/valid/objection/'.$obj->id)}}" class="btn btn-outline-success">Valid</a> -->
                                                {{-- <input type="hidden" id="id_claim{{$obj->claim_id}}" value="{{$obj->claim_id}}">
                                                <a href="{{url('admin/claim/in-valid/objection/'.$obj->id)}}" class="btn btn-outline-danger">Not Valid</a>
                                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#inlineForm" onclick="claimid({{$obj->claim_id}})">Valid</button> --}}

                                                <div class="btn-group dropleft" style="cursor: pointer;">
                                                    <div data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path></svg>                                                            </div>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{url('admin/claim/detail/'.$obj->claim_id)}}">View Details</a>
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#inlineForm" onclick="claimid({{$obj->claim_id}})">Valid</a>
                                                        <a class="dropdown-item" href="{{url('admin/claim/in-valid/objection/'.$obj->id)}}">Invalid</a>
                                                    </div>
                                                </div>
                                            </td>
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

            <!-- Modal -->
            <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">@lang('language.Valid')</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{url('admin/claim/valid/objection')}}" method="post">
                            @csrf
                            <section id="input-mask-wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">

                                            <div class="card-body">
                                                <input type="hidden" name="claim_id" id="claim_id">
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-6 col-sm-12 mb-2">
                                                        <label>@lang('language.Select one option')</label>
                                                       <select class="form-control" type="text" name="objection">
                                                            <option disabled selected>-----@lang('language.Select')-----</option>
                                                            <option value="0">@lang('language.Amount issue')</option>
                                                            <option value="1">@lang('language.other issue')</option>
                                                       </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" >@lang('language.Done')</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">@lang('language.Cancel')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- END: Content-->
    <script>
    
        function claimid(a){
        //var claimid= document.getElementById('id_claim').value;
        document.getElementById('claim_id').value=a;
        }
    </script>

@endsection

@push('refuse-response-css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <!-- END: Page CSS-->
@endpush
@push('refuse-response-js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/tables/table-datatables-basic.js') }}"></script>
    <!-- END: Page JS-->

@endpush
