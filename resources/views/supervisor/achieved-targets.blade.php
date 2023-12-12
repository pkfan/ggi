@extends('layout.master')
@section('title', 'Achieved Progress')

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
                {{-- <div class="row">
                    <div class="col-12 d-flex justify-content-between align-content-center mb-1">
                        <h4>@lang('language.ALL Targets')</h4>
                        <a href="{{route('admin.set.officer.targets')}}" class="btn btn-dark mr-1 waves-effect waves-float waves-light"
                            style="padding: 8px 12px;">
                            Create New Target
                        </a>
                    </div>
                </div> --}}

                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header justify-content-end">


                            </div>

                            @if (boolval($collectedClaims->count()))
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-nowrap">#</th>
                                                <th scope="col" class="text-nowrap">Claim</th>
                                                <th scope="col" class="text-nowrap">officer</th>
                                                <th scope="col" class="text-nowrap">Achieved Amount</th>
                                                <th scope="col" class="text-nowrap">Achieved Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($collectedClaims as $collectedClaim)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>GGI00{{ $collectedClaim->claim_id }}</td>
                                                    <td>{{ $collectedClaim->claim?->officer?->name }}</td>
                                                    <td>{{ $collectedClaim?->claim?->amount_after_discount }}</td>

                                                    <td>{{ \Carbon\Carbon::parse($collectedClaim->created_at)->format('M d Y') }}
                                                    </td>
                                                </tr>
                                                <?php
                                                $count++;
                                                ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <x-pagination :data="$collectedClaims" />
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
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}"> --}}
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
    {{-- <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script> --}}
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/tables/table-datatables-basic.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script> --}}
    <!-- END: Page JS-->
@endpush
