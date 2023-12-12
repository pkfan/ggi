@extends('layout.master')
@section('title', 'Edit Officer')

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
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                {{-- <div class="row">
                    <div class="col-12">
                        <h4>USER MANAGEMENT

                        </h4>
                    </div>
                </div> --}}

                <x-form-errors-alert />
                <!-- Basic Tables start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        Edit Targets for ({{ $target->officer?->name }})
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form class="form" method="POST"
                                        action="{{ route('supervisor.update.officer.targets') }}">
                                        @csrf
                                        <input type="hidden" class="custom-control-input" name="target_id"
                                            value="{{ $target->id }}" id="target-id">
                                        <input type="hidden" class="custom-control-input" name="officer_id"
                                            value="{{ $target->officer?->id }}" id="officer-id">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column"> Targets</label>
                                                    <input type="number" id="first-name-column" class="form-control"
                                                        placeholder="targets amount" name="targets" value="{{$target->total}}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">

                                            </div>


                                            {{-- <div class="col-md-6 mb-1" data-select2-id="52">
                                                <label>Choose Month</label>
                                                <div class="position-relative" data-select2-id="51">
                                                    <select
                                                        class="select2 form-control form-control-md select2-hidden-accessible"
                                                        data-select2-id="1" tabindex="-1" aria-hidden="true" name="month">
                                                        @foreach ($months as $month)
                                                            <option value="{{$month}}" data-select2-id="{{$month}}">{{$month}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div> --}}
                                            <div class="col-md-6 form-group">
                                                <label for="set-month-date">Start Date*</label>
                                                <input type="text" id="set-start-month-date" name="startDate"
                                                    class="form-control flatpickr-basic flatpickr-input"
                                                    placeholder="YYYY-MM-DD" readonly="readonly">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="set-month-date">End Date*</label>
                                                <input type="text" id="set-month-date" name="endDate" class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD" readonly="readonly">
                                            </div>


                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1">Update</button>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">

    <!-- END: Vendor CSS-->
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/pickers/form-pickadate.css')}}">
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
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/legacy.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/tables/table-datatables-basic.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script> --}}
    <!-- END: Page JS-->
    <script>

    let date = new Date(); // Now
    date.setDate(date.getDate() + 30); // Set now + 30 days as the new date
    console.log(date);

    const yyyy = date.getFullYear();
    // let mm = date.getMonth() + 1; // Months start at 0!
    let mm = date.getMonth(); // Months start at 0!
    let dd = date.getDate();

    if (dd < 10) dd = '0' + dd;
    // if (mm < 10) mm = '0' + mm;
    if (mm < 10) mm = mm;

    let month3letter = ['Jan','Feb', 'Mar', 'Apr', 'May','Jun','Jul','Aug','Sep', 'Oct', 'Nov','Dec'];

    // const formattedToday = `${yyyy} ${month3letter[mm]} ${dd}`;
    const formattedTodayStartDate  = "{!! \Carbon\Carbon::createFromFormat('Y-m-d', $target->start_date)->format('Y M d') !!}";
    const formattedTodayEndDate  = "{!! \Carbon\Carbon::createFromFormat('Y-m-d', $target->end_date)->format('Y M d') !!}";

        console.log('formattedTodayEndDate : ', formattedTodayEndDate);
        flatpickr("#set-start-month-date", {
            dateFormat: "Y M d",
            // defaultDate: formattedTodayEndDate,
            defaultDate: formattedTodayStartDate,
            // minDate: "today",

        });
        flatpickr("#set-month-date", {
            dateFormat: "Y M d",
            // defaultDate: formattedTodayEndDate,
            defaultDate: formattedTodayEndDate,
            // minDate: "today",

        });
    </script>
@endpush
