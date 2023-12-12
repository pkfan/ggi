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

            <div class="content-body">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between align-content-center mb-1">
                        <h4>@lang('language.ALL Targets')</h4>
                        <a href="@if(request()->is('admin/*')){{route('admin.set.officer.targets')}} @else {{route('supervisor.set.officer.targets')}} @endif" class="btn btn-dark mr-1 waves-effect waves-float waves-light"
                            style="padding: 8px 12px;">
                            Create New Target

                        </a>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header justify-content-end">
                                <div class="col-12 d-flex justify-content-end">
                                    <form method="GET" action="{{route('admin.officer.targets')}}">
                                        <div class="d-flex align-items-center">
                                            <div data-select2-id="187" class=" ">
                                                <div class="position-relative " data-select2-id="186" style=" width: 240px; border: 1px solid #82868b;border-radius: 4px;">
                                                    <select name='officer_id' class=" select2 btn btn-outline-secondary btn-sm waves-effect form-control select2-hidden-accessible dropdown-toggle" data-select2-id="16"
                                                        tabindex="-1" aria-hidden="true">
                                                        <option value="all" data-select2-id="all">all officers</option>
                                                        @foreach ($officers as $officer)
                                                            <option value="{{$officer->id}}" data-select2-id="{{$officer->id}}">{{$officer->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <select name="month" class="btn btn-outline-secondary btn-sm waves-effect" id="basicSelect">
                                                @php
                                                    $months = [
                                                        'January'=>1,
                                                        'February'=>2,
                                                        'March'=>3,
                                                        'April'=>4,
                                                        'May'=>5,
                                                        'June'=>6,
                                                        'July'=>7,
                                                        'August'=>8,
                                                        'September'=>9,
                                                        'October'=>10,
                                                        'November'=>11,
                                                        'December'=>12
                                                    ];
                                                @endphp
                                                <option value='all'>All month</option>

                                                @foreach ($months as $monthKey => $monthValue )
                                                    <option value="{{$monthValue}}">{{{$monthKey}}}</option>
                                                @endforeach
                                            </select>
                                            <select name="year" class="btn btn-outline-secondary btn-sm waves-effect" id="basicSelect">
                                                @php
                                                    $years = [
                                                        '2023',
                                                        '2024',
                                                        '2025',
                                                        '2026',
                                                        '2027',
                                                        '2028',
                                                        '2029',
                                                        '2030',
                                                    ];
                                                @endphp
                                                @foreach ($years as $year )
                                                    <option value="{{$year}}">{{{$year}}}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-outline-secondary btn-sm waves-effect">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            @if (boolval($targets->count()))
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-nowrap">#</th>
                                                <th scope="col" class="text-nowrap">@lang('language.Officer')</th>
                                                <th scope="col" class="text-nowrap">@lang('language.Targets')</th>
                                                <th scope="col" class="text-nowrap">@lang('language.Acheived (%)')</th>
                                                <th scope="col" class="text-nowrap">@lang('language.Acheived')</th>
                                                <th scope="col" class="text-nowrap">@lang('language.Pending')</th>
                                                <th scope="col" class="text-nowrap">@lang('language.Start Date')</th>
                                                <th scope="col" class="text-nowrap">@lang('language.End Date')</th>
                                                <th scope="col" class="text-nowrap">@lang('language.Status')</th>
                                                <th scope="col" class="text-nowrap">@lang('language.Action')</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($targets as $target)
                                                <tr>
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $target->officer->name }}</td>
                                                    <td>{{ $target->total }}</td>
                                                    <td>{{ $target->acheived_percentage ?? '0' }}%</td>
                                                    <td>{{ $target->achieved ?? '0' }}</td>
                                                    <td>{{ $target->pending }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($target->start_date)->format('M d, Y') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($target->end_date)->format('M d, Y') }}</td>
                                                    <td>
                                                        @if($target->status == \App\Enums\OfficerTargetStatus::UPCOMMING->value)
                                                        <span class="bg-warning text-light" style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;display: flex;font-weight: 700;">
                                                            upcomming
                                                        </span>
                                                        @elseif ($target->status == \App\Enums\OfficerTargetStatus::ACTIVE->value)
                                                        <span class="bg-success text-light" style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;display: flex;font-weight: 700;">
                                                            active
                                                        </span>
                                                        @elseif ($target->status == \App\Enums\OfficerTargetStatus::COMPLETED->value)
                                                        <span class="bg-info text-light" style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;display: flex;font-weight: 700;">
                                                            completed
                                                        </span>
                                                        @elseif ($target->status == \App\Enums\OfficerTargetStatus::EXPIRED->value)
                                                        <span class="bg-info text-light" style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;display: flex;font-weight: 700;">
                                                            expired
                                                        </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (request()->is('admin/*'))
                                                            <a href="{{ route('admin.edit.officer.targets', ['target_id' => $target->id]) }}">
                                                                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                            </a>
                                                        @elseif (request()->is('supervisor/*'))
                                                            <a href="{{ route('supervisor.edit.officer.targets', ['target_id' => $target->id]) }}">
                                                                <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="18" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                            </a>
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
                                <x-pagination :data="$targets" />
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
