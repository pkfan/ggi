@extends('layout.master')
@section('title', 'Edit Finance Company')

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
                    <h4>@lang('language.USER MANAGEMENT')

                    </h4>
                </div>
            </div>

            <!-- Basic Tables start -->
            <section id="multiple-column-form">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">

                                @lang('language.Edit Financial Company')</h4>
                            </div>
                            <div class="card-body">
                                <form class="form">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">  @lang('language.Name')</label>
                                                <input type="text" id="first-name-column" class="form-control" name="fname-column" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column"> @lang('language.Cr Code')</label>
                                                <input type="text" id="last-name-column" class="form-control" name="lname-column" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="city-column"> @lang('language.Mobile Number')</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">+966</span>
                                                    </div>
                                                    <input type="number" class="form-control" aria-label="Username" aria-describedby="basic-addon1" />
                                                </div>                                                </div>
                                        </div>


                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="customFile"> @lang('language.With Browse button')</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile" />
                                                    <label class="custom-file-label" for="customFile"> @lang('language.Choose file')</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mr-1"> @lang('language.Update')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Basic Tables end -->



        </div>



    </div>
</div>
<!-- END: Content-->
@endsection

@push('edit-finance-company-css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <!-- END: Page CSS-->
@endpush
@push('edit-finance-company-js')
        <!-- BEGIN: Page Vendor JS-->
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js')}}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js')}}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
        <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')}}"></script>
        <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
        <!-- END: Page Vendor JS-->
        <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/tables/table-datatables-basic.js')}}"></script>
    <!-- END: Page JS-->

@endpush
