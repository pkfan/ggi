@extends('layout.master')
@section('title', 'Discount History')

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
                        <h4>Discount History</h4>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            @if (boolval($debDiscounts->count()))
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-nowrap"
                                                    style="background-color: #6c6c6c;color: white;">#</th>
                                                <th scope="col" class="text-nowrap"
                                                    style="background-color: #6c6c6c;color: white;">Claim</th>
                                                <th scope="col" class="text-nowrap"
                                                    style="background-color: #6c6c6c;color: white;">Requested Dis(%)</th>
                                                <th scope="col" class="text-nowrap"
                                                    style="background-color: #6c6c6c;color: white;">Officer Dis(%)</th>
                                                <th scope="col" class="text-nowrap"
                                                    style="background-color: #6c6c6c;color: white;">Total</th>
                                                <th scope="col" class="text-nowrap"
                                                    style="background-color: #6c6c6c;color: white;">After Discount</th>
                                                {{-- <th scope="col" class="text-nowrap"
                                                    style="background-color: #6c6c6c;color: white;">Requested By</th> --}}
                                                <th scope="col" class="text-nowrap"
                                                    style="background-color: #6c6c6c;color: white;">Processed By</th>
                                                <th scope="col" class="text-nowrap"
                                                    style="background-color: #6c6c6c;color: white;">Status</th>
                                                <th scope="col" class="text-nowrap"
                                                    style="background-color: #6c6c6c;color: white;">Requested Date</th>
                                                <th scope="col" class="text-nowrap"
                                                    style="background-color: #6c6c6c;color: white;">Processed Date</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($debDiscounts as $debDiscount)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>GGI00{{ $debDiscount->claim_id }}</td>
                                                    <td>{{ $debDiscount->requested_percentage }}%</td>
                                                    <td>{{ $debDiscount->officer_percentage }}%</td>
                                                    <td>{{ $debDiscount->total_claim_amount }}</td>
                                                    <td>{{ $debDiscount->after_discount }}</td>
                                                    {{-- <td>{{ $debDiscount->officer->name }}</td> --}}
                                                    <td>{{ $debDiscount->processor?->name ?? 'N/A'}}</td>

                                                    <td>
                                                        @if ($debDiscount->status == \App\Enums\DebDiscountRequestStatus::PENDING->value)
                                                            <div
                                                                style="background-color: #f1f19d;text-align: center;font-weight: 700;padding: 4px;border-radius: 50%;font-size: 12px;">
                                                                pending
                                                            </div>
                                                        @elseif($debDiscount->status == \App\Enums\DebDiscountRequestStatus::APPROVE->value)
                                                            <div
                                                                style="background-color: #68ff68;text-align: center;font-weight: 700;padding: 4px;border-radius: 50%;font-size: 12px;">
                                                                approved
                                                            </div>
                                                        @elseif($debDiscount->status == \App\Enums\DebDiscountRequestStatus::REJECT->value)
                                                            <div
                                                                style="background-color: #ffb2b2;text-align: center;font-weight: 700;padding: 4px;border-radius: 50%;font-size: 12px;">
                                                                rejected
                                                            </div>
                                                        @else
                                                            <div
                                                                style="background-color: #ffc942;text-align: center;font-weight: 700;padding: 4px;border-radius: 50%;font-size: 12px;">
                                                                Discard
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($debDiscount->created_at)->format('M d Y') }}</td>
                                                    <td>
                                                        @if ($debDiscount->process_date)
                                                            {{ \Carbon\Carbon::parse($debDiscount->process_date)->format('M d Y') }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                <?php
                                                $count++;
                                                ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <x-pagination :data="$debDiscounts" />
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
