@extends('layout.master')
@section('title', 'Edit User')

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

                <x-form-errors-alert />
                <!-- Basic Tables start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">

                                        Edit {{ $queryRole?->display_name ?? 'User' }}</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form" method="POST" action="{{ route('admin.edit.user') }}">
                                        @csrf
                                        <input type="hidden" name="queryRole" value="{{$queryRole?->name}}">
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">@lang('language.Name')</label>
                                                    <input type="text" id="first-name-column" class="form-control"
                                                        name="name" value="{{old('name') ?? $user->name}}"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">@lang('language.National Id')</label>
                                                    <input type="text" id="last-name-column" class="form-control"
                                                        value="{{old('national_id') ?? $user->reg_no}}" name="national_id" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column"> @lang('language.Mobile Number')</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">+966</span>
                                                        </div>
                                                        <input type="number" class="form-control" name="mobile_no"
                                                            value="{{old('mobile_no') ?? substr($user->phone,4)}}" aria-label="Username"
                                                            aria-describedby="basic-addon1" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">@lang('language.Email')</label>
                                                    <input type="email" id="email-id-column" class="form-control"
                                                        name="email" value="{{old('email') ?? $user->email}}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column"> Extension Phone</label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">+966</span>
                                                        </div>
                                                        <input type="number" class="form-control" name="additional_phone"
                                                            value="{{old('mobile_no') ?? substr($user->additional_phone,4)}}"
                                                            aria-label="Username"
                                                            aria-describedby="basic-addon1" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Update New Password</label>
                                                    <div class="input-group form-password-toggle">
                                                        <input type="password" class="form-control"
                                                            id="basic-default-password"
                                                            aria-describedby="basic-default-password" name="password" />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text cursor-pointer"><i
                                                                    data-feather="eye"></i></span>
                                                        </div>
                                                    </div>
                                                    <div style=" color: #99ad00;font-weight: 600;">
                                                        if you enter new password then old password will be remove.
                                                    </div>
                                                </div>
                                            </div>

                                            @if (!$queryRole?->name)
                                                <div class="col-12"
                                                    style="margin-top: 12px; border-top: 1px solid #c8c6c6; ">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">@lang('Language.Assign Roles')</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <p class="card-text mb-0">

                                                                @lang('language.Select Roles for this user to perform operations and grant permissions according to his roles').
                                                            </p>
                                                            <div>

                                                                @foreach ($roles as $role)
                                                                    <div
                                                                        class="custom-control custom-control-success custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input"
                                                                            name="roles[]" value="{{ $role->name }}"
                                                                            id="{{ $role->name }}-role"
                                                                            @foreach ($user->roles as $userRole)
                                                                                @if ($userRole?->name == $role->name) checked @break @endif
                                                                            @endforeach
                                                                            @if ($queryRole && $queryRole?->name != $role->name) disabled @endif>
                                                                        <label class="custom-control-label"
                                                                            for="{{ $role->name }}-role">{{ $role->display_name }}</label>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            {{-- @else --}}
                                                {{-- @foreach ($roles as $role)
                                                    <input type="hidden" name="roles[]" value="{{ $role->name }}">
                                                @endforeach --}}
                                            @endif

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1">Update</button>
                                                <button type="reset" class="btn btn-outline-secondary">@lang('Language.Reset')
                                                </button>
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

@push('edit-company-employee-css')
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
@push('edit-company-employee-js')
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
