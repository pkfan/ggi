@extends('layout.master')
@section('title', 'rejected claims')

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
                        <h4>CLAIM Rejected


                        </h4>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header justify-content-end">

                                <x-RowsPerPage />
                                <x-admin::ExportExcel />
                                {{-- search  --}}
                                <x-SearchFilter id="inlineForm">
                                    <form action="#">
                                        <section id="input-mask-wrapper">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        {{-- <div class="card-header">
                                                            <h4 class="card-title">Search Anything you want
                                                            </h4>
                                                        </div> --}}
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                    <label for="credit-card">
                                                                        Id</label>
                                                                    <input type="text"
                                                                        class="form-control credit-card-mask"
                                                                         id="credit-card" />
                                                                </div>
                                                                <x-SearchFilterModalInput name='id' title="Claim Id" />






                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Search</button>
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Cancel</button>
                                        </div>
                                    </form>
                                </x-SearchFilter>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap">ID</th>
                                            <th scope="col" class="text-nowrap">Company Name</th>
                                            <th scope="col" class="text-nowrap">Recovery Amount </th>
                                            <th scope="col" class="text-nowrap">Accident Date</th>
                                            <th scope="col" class="text-nowrap">Accident Location </th>

                                            <th scope="col" class="text-nowrap">Debtor Type</th>
                                            <th scope="col" class="text-nowrap">Status</th>
                                            <th scope="col" class="text-nowrap">Action</th>




                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($claims) > 0)
                                            @foreach ($claims as $claim)
                                                <tr>
                                                    <td>GGI00{{ $claim->id }}</td>
                                                    <td>{{ getCompanyById($claim->company_id)->name }}</td>
                                                    <td>{{ $claim->amount_after_discount }}</td>
                                                    <td>{{ $claim->acc_date }}</td>
                                                    <td>{{ $claim->acc_location }}</td>
                                                    <td>{{ $claim->deb_type }}</td>
                                                    <td>
                                                        @if ($claim->status == 2)
                                                            <a href="#" class="btn btn-danger">Rejected</a>
                                                        @endif
                                                    </td>
                                                    @php
                                                        $doc = DB::table('supported-doc')
                                                            ->where('company_id', $claim->cid)
                                                            ->pluck('doc_name')
                                                            ->first();
                                                    @endphp
                                                    <td>
                                                        <!-- <form>
                                                                    <input type="hidden" name="id" value="{{ $claim->id }}">
                                                                    <button class="btn btn-outline-danger">Delete</button>
                                                                </form> -->
                                                        <a style=" width: 127px;" class="btn btn-outline-primary"
                                                            href="{{ route('AdminClaimDetail', $claim->id) }}"
                                                            target="_blank">View Details</a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            {{-- @if ($claims instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <nav aria-label="...">
                            <ul class="pagination">
                            {!! $claims->links() !!}

                            </ul>
                        </nav>
                        @endif --}}
                            <x-pagination :data="$claims" />
                        </div>
                    </div>
                </div>
                <!-- Basic Tables end -->



            </div>



        </div>
    </div>
    <!-- END: Content-->
@endsection

@push('reject-claim-css')
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
@push('reject-claim-js')
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
