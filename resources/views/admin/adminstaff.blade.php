@extends('layout.master')
@section('title', 'Add Admin')

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
                        <h4>  @lang('language.USER MANAGEMENT')

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

                                    @lang('language.Add Admin')</h4>
                                </div>
                                <div class="card-body">


                                    <form class="form" method="post" action="{{url('admin-staff')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="inputFirstName" class="form-label"> @lang('language.Name') <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputFirstName" value="{{ old('name')}}" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="inputFirstName" class="form-label"> @lang('language.National Id')<span class="text-danger">*</span></label>
                                                <input  type = "text" class="form-control" id="claimNumber" name="national_id" value="{{ old('national_id')}}" required>
                                            </div>
                                        </div>
                                        <span id="refError" class="text-danger"></span>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="inputEmail" class="form-label"> @lang('language.Mobile Number') <span class="text-danger">*</span></label>
                                                <div class="input-group flex-nowrap">
                                                <span class="input-group-text" id="addon-wrapping">+966</span>
                                                <input type="number" maxlength = "9" class="form-control" id="inputEmail" name="mobile_no" aria-label="Username" aria-describedby="addon-wrapping" value="{{ old('mobile_no')}}" requierd>
                                                </div>
                                            </div>
                                            @error('deb_mob')
                                                <span class="text-danger">Mobile number is not valid</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="inputFirstName" class="form-label"> @lang('language.Email')<span class="text-danger">*</span></label>
                                                <input  type = "email" class="form-control" id="claimNumber" name="email" value="{{ old('email')}}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="inputFirstName" class="form-label"> @lang('language.Password')<span class="text-danger">*</span></label>
                                                <input  type = "password"  class="form-control" id="claimNumber" name="password" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="inputFirstName" class="form-label"> @lang('language.Admin Type')<span class="text-danger">*</span></label>
                                                <select name="admintype" class="form-control">
                                                    <option value=""> @lang('language.Select Type')</option>
                                                    <option value="0"> @lang('language.Admin')</option>
                                                    <option value="1"> @lang('language.Super Admin')</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-12 ">
                                            <button type="submit" class="btn btn-primary px-5"> @lang('language.Register')</button>
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

@push('add-company-css')
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

@push('add-company-js')
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
