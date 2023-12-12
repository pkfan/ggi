@extends('layout.master')
@section('title', 'Officer Targets')

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
            @php
                $userRoleDisplayName = $role?->display_name ?? 'User';
            @endphp
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <h4>Officer Targets Details</h4>
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
                                                    <line x1="12" y1="2" x2="12" y2="15">
                                                    </line>
                                                </svg> Export
                                        </button>&nbsp; &nbsp;

                                        <a href="{{ route('admin.add-user',['role'=>$role?->name]) }}"> <button type="button"
                                                class="btn btn-primary">Add {{$userRoleDisplayName}}</button></a>


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
                                                        <rect x="6" y="14" width="12" height="8">
                                                        </rect>
                                                    </svg>Print</span></button>
                                            <button class="dt-button buttons-csv buttons-html5 dropdown-item" tabindex="0"
                                                aria-controls="DataTables_Table_0" type="button"><span><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-file-text font-small-4 mr-50">
                                                        <path
                                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                        </path>
                                                        <polyline points="14 2 14 8 20 8"></polyline>
                                                        <line x1="16" y1="13" x2="8" y2="13">
                                                        </line>
                                                        <line x1="16" y1="17" x2="8" y2="17">
                                                        </line>
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
                                                tabindex="0" aria-controls="DataTables_Table_0"
                                                type="button"><span><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-clipboard font-small-4 mr-50">
                                                        <path
                                                            d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                                        </path>
                                                        <rect x="8" y="2" width="8"
                                                            height="4" rx="1" ry="1"></rect>
                                                    </svg>Pdf</span></button>
                                            <button class="dt-button buttons-copy buttons-html5 dropdown-item"
                                                tabindex="0" aria-controls="DataTables_Table_0"
                                                type="button"><span><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-copy font-small-4 mr-50">
                                                        <rect x="9" y="9" width="13"
                                                            height="13" rx="2" ry="2"></rect>
                                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1">
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
                                                    <line x1="21" y1="21" x2="16.65" y2="16.65">
                                                    </line>
                                                </svg></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (boolval($users->count()))
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-nowrap">#</th>
                                                <th scope="col" class="text-nowrap"> @lang('language.Name')</th>
                                                <th scope="col" class="text-nowrap"> @lang('language.Email')</th>
                                                <th scope="col" class="text-nowrap" style="min-width: 250px;"> @lang('language.Roles')</th>
                                                <th scope="col" class="text-nowrap"> @lang('language.Mobile Number')</th>
                                                <th scope="col" class="text-nowrap"> @lang('language.National Id') </th>
                                                <th scope="col" class="text-nowrap"> @lang('language.Status')</th>
                                                <th scope="col" class="text-nowrap"> @lang('language.Registered Date')</th>
                                                <th scope="col" class="text-nowrap"> @lang('language.Action')</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($users as $user)
                                                @php
                                                    $userRoleNames = $user->roles->pluck('display_name')->all();
                                                    $userRoleNamesString = implode(' | ', $userRoleNames);
                                                @endphp
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td style="
                                                        @if(
                                                            $user->roles && (
                                                                @$user->roles[0]?->name == 'super-admin'
                                                                || @$user->roles[0]?->name == 'director'
                                                                || @$user->roles[0]?->name == 'manager'
                                                            )
                                                        )
                                                            background: #f7afbb;
                                                        @elseif($user->roles && @$user->roles[0]?->name == 'admin')
                                                            background: #e4e4e4;
                                                        @elseif($user->roles && @$user->roles[0]?->name == 'officer')
                                                            background: #cfd0fa;
                                                        @elseif($user->roles && @$user->roles[0]?->name == 'supervisor')
                                                            background: #ffe794;
                                                        @elseif($user->roles && @$user->roles[0]?->name == 'collector')
                                                            background: #94ff9b;

                                                        @endif
                                                    ">
                                                    {{$userRoleNamesString}}
                                                    </td>

                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ $user->reg_no }}</td>
                                                    <td>
                                                        @if ($user->status == 0)
                                                            <a href="{{ url('admin/de-active/user/' . $user->id) }}"
                                                                class="btn btn-danger">Not Active</a>
                                                        @else
                                                            <a href="{{ url('admin/active/user/' . $user->id) }}"
                                                                class="btn btn-success">Active</a>
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->created_at }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/edit-employee/' . $user->id) }}"
                                                            class="btn btn-outline-danger">Edit</a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $count++;
                                                ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <x-pagination :data="$users" />
                            @else
                                <x-errors.not-found />
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Basic Tables end -->



            </div>



        </div>
    </div>
    <!-- END: Content-->
@endsection

@push('employee-list-css')
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
@push('employee-list-js')
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
