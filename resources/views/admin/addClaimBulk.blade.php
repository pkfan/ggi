@extends('layout.master')
@section('title', 'Add Claim')

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
                        <h4>@lang('language.Claim Register')

                        </h4>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Import Claims List from Excel File</h4>
                                </div>
                                <div class="card-body">
                                    {{-- <label for="" class="form-label"> Download Sample file:</label>
                                    <a href="{{ asset('storage/' . 'claims/formate/claims -new.xlsx') }}"
                                        download="{{ asset('claims/formate/claims.xlsx') }}"><button
                                            class="btn btn-primary">Download</button></a> --}}
                                    <div class="table-responsive">
                                        <form action="{{ route('ImportExcel') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            {{-- <label class="form-label">@lang('language.Import InBulk')</label> --}}

                                            <div class="col-md-6">


                                                <div class="input-group form-password-toggle mb-2">
                                                    <input type="file" class="form-control" id="excel_file" name="xfile"  required>
                                                      <button type="submit" hasFile='no' onclick="showLoaderOnButtonOnClickClaimImport('keeploading');" class="show-loading-on-click input-group-append btn btn-primary"
                                                      style="
                                                            display: flex;
                                                            gap: 6px;
                                                            justify-content: center;
                                                            align-items: center;
                                                        "
                                                      >
                                                        <span>import</span>
                                                        {{-- loader  --}}
                                                        <div class="loading-on-click-circle d-none spinner-border text-light" role="status" style=" width: 14px; height: 14px;">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                            @error('bulkfile')
                                                @lang('language.File Required')
                                            @enderror
                                            <div id="excel_data">
                                            </div>
                                            {{-- <input type="submit" class="btn btn-primary mt-3"> --}}
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <!-- END: Page CSS-->
@endpush

@push('add-company-js')
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
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        function convertExcelDate(excelDate) {
            var date = new Date((excelDate - 25569) * 86400 * 1000);
            var day = date.getDate();
            var month = date.getMonth() + 1; // Months are zero-based
            var year = date.getFullYear();

            // Format the date as desired (e.g., DD-MM-YYYY)
            var formattedDate = ("0" + day).slice(-2) + "-" + ("0" + month).slice(-2) + "-" + year;
            var formattedDate = year + "-" + ("0" + month).slice(-2) + "-" + ("0" + day).slice(-2);
            return formattedDate;
        }

        let showLoadingOnClick = document.querySelector('.show-loading-on-click');
        let loadingOnClickCircle = document.querySelector('.loading-on-click-circle');

        const excel_file = document.getElementById('excel_file');
        excel_file.addEventListener('change', (event) => {
            if (!['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel']
                .includes(event.target.files[0].type)) {
                document.getElementById('excel_data').innerHTML =
                    '<div class="alert alert-danger">Only .xlsx or .xls file format are allowed</div>';
                excel_file.value = '';
                loadingOnClickCircle.classList.add('d-none');
                return false;
            }

            showLoadingOnClick.setAttribute('hasFile','yes');

            var reader = new FileReader();
            reader.readAsArrayBuffer(event.target.files[0]);
            reader.onload = function(event) {
                var data = new Uint8Array(reader.result);
                // console.log('new Uint8Array(reader.result) :',data);
                var work_book = XLSX.read(data, {
                    type: 'array'
                });
                var sheet_name = work_book.SheetNames;
                var emptyhain = '';
                var sheet_data = XLSX.utils.sheet_to_json(work_book.Sheets[sheet_name[0]], {
                    header: 1
                });
                console.log('sheet_data :',sheet_data);
                if (sheet_data.length > 0) {
                    if (
                        sheet_data[0][0] === 'RUN_DATE' &&
                        sheet_data[0][1] === 'SUB_CLASS' &&
                        sheet_data[0][2] === 'RECOVERY_TYPE' &&
                        sheet_data[0][3] === 'CLAIM_NO' &&
                        sheet_data[0][4] === 'POLICY_NO' &&
                        sheet_data[0][5] === 'UW_YEAR' &&
                        sheet_data[0][6] === 'VEHICLE_BODY' &&
                        sheet_data[0][7] === 'SUBJECT_TYPE' &&
                        sheet_data[0][8] === 'LOSS_DATE' &&
                        sheet_data[0][9] === 'REGISTRATION_DATE' &&
                        sheet_data[0][10] === 'CITY' &&
                        sheet_data[0][11] === 'VEHICLE_TYPE' &&
                        sheet_data[0][12] === 'VEHICLE_MAKE' &&
                        sheet_data[0][13] === 'MT_PLATE_NO' &&
                        sheet_data[0][14] === 'MT_CHASSIS_NO' &&
                        sheet_data[0][15] === 'SUMINSURED_LC' &&
                        sheet_data[0][16] === 'LOSS_TYPE' &&
                        sheet_data[0][17] === 'OS_OD' &&
                        sheet_data[0][18] === 'PAID_AMT' &&
                        sheet_data[0][19] === 'RESERVE_AMT' &&
                        sheet_data[0][20] === 'RECOVERY_AMT' &&
                        sheet_data[0][21] === 'OUR_RESPONSIPILITY_PER' &&
                        sheet_data[0][22] === 'CAUSE' &&
                        sheet_data[0][23] === 'RECOVEREE_NAME' &&
                        sheet_data[0][24] === 'REMARKS' &&
                        sheet_data[0][25] === 'VEHICLE_USAGE' &&
                        sheet_data[0][26] === 'RECOVERY_DATE' &&
                        sheet_data[0][27] === 'CREATED_BY' &&
                        sheet_data[0][28] === 'OD_TP' &&
                        sheet_data[0][29] === 'SUBJECT_SERIAL' &&
                        sheet_data[0][30] === 'SETTLEMENT_DATE' &&
                        sheet_data[0][31] === 'PAYMENT_TYPE' &&
                        sheet_data[0][32] === 'OS_TP' &&
                        sheet_data[0][33] === 'PAID_AMT_TP' &&
                        sheet_data[0][34] === 'MT_PROD_YEAR' &&
                        sheet_data[0][35] === 'REPAIR_CONDITION' &&
                        sheet_data[0][36] === 'BRANCH_NAME' &&
                        sheet_data[0][37] === 'INSURED_NAME' &&
                        sheet_data[0][38] === 'INSURED_NATIONAL_ID' &&
                        sheet_data[0][39] === 'CONTRACT_NO' &&
                        sheet_data[0][40] === 'MOBILE' &&
                        sheet_data[0][41] === 'POLICY_BRANCH_NAME' &&
                        sheet_data[0][42] === 'VEHICLE_CATEGORY' &&
                        sheet_data[0][43] === 'User Name'
                    ) {
                        console.log(sheet_data.length);
                        var table_output = '<table class="table table-striped table-bordered">';
                        for (var row = 0; row < sheet_data.length; row++) {
                            table_output += '<tr>';
                            // for (var cell = 0; cell < 23; cell++) {
                            for (var cell = 0; cell < 43; cell++) {
                                if (row == 0) {
                                    table_output += '<th>' + sheet_data[row][cell] + '</th>';
                                } else {
                                    if (cell == 0) {
                                        table_output += '<td>' + convertExcelDate(sheet_data[row][cell]) +
                                            ' <input type="hidden" name="data[]" value=" ' + convertExcelDate(
                                                sheet_data[row][cell]) + ' " >    ' + '</td>';
                                    } else if (cell == 16 || cell == 15)
                                        table_output += '<td>' + convertExcelDate(sheet_data[row][cell]) +
                                        ' <input type="hidden" name="data[]" value=" ' + convertExcelDate(
                                            sheet_data[row][cell]) + ' " >    ' + '</td>';
                                    else if (cell == 11) {
                                        table_output += '<td>' + sheet_data[row][cell] +
                                            ' <input type="hidden" name="data[]" value=" ' + sheet_data[row][
                                                cell
                                            ] + ' " >    ' + '</td>';
                                    } else if (cell == 12) {
                                        if (sheet_data[row][cell] !== undefined) {
                                            table_output += '<td>' + sheet_data[row][cell] +
                                                ' <input type="hidden" name="data[]" value="' + sheet_data[row][
                                                    cell
                                                ] + '" >    ' + '</td>';
                                        } else {
                                            table_output += '<td>' + emptyhain +
                                                ' <input type="hidden" name="data[]" value="' + emptyhain +
                                                '" >    ' + '</td>';
                                        }
                                    } else {
                                        table_output += '<td>' + sheet_data[row][cell] +
                                            ' <input type="hidden" name="data[]" value="' + sheet_data[row][
                                                cell
                                            ] + '" >    ' + '</td>';
                                    }
                                }
                            }
                            // if (!row == 0) {
                            //     table_output += '<td> <input type="file" name="data'+row+'[]"    value="Upload" required multiple accept="image/png, image/jpeg ,application/pdf" >  </td>';

                            // }
                            table_output += '</tr>';

                        }
                        table_output += '</table>';
                        console.log(table_output);
                        document.getElementById('excel_data').innerHTML = table_output;
                    }
                    // } else {
                    //     document.getElementById('excel_data').innerHTML =
                    //         '<div class="alert alert-danger">Only recomended format are allowed</div>';
                    // }
                }
                excel_file.value = '5r5r';
            }
        });
    </script>
@endpush
