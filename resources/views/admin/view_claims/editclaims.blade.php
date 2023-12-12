@extends('layout.master')
@section('title', 'edit claims')

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
                        <h4>CLAIM REQUEST FORM

                        </h4>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Claim</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column"> Recovery Amount</label>
                                                    <input type="text" id="first-name-column" class="form-control"
                                                        name="fname-column" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column">Accident Date</label>
                                                    <div class="input-group mb-2">
                                                        <input type="date" class="form-control" aria-label="Username"
                                                            aria-describedby="basic-addon1" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Claim Number
                                                    </label>
                                                    <input type="text" id="last-name-column" class="form-control"
                                                        name="lname-column" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputLastName" class="form-label">Change Accident Date</label>
                                                <input type="date" class="form-control" id="changeAccident"
                                                    name="acc_date" max="2023-07-11">
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Accident Location
                                                    </label>
                                                    <input type="email" id="email-id-column" class="form-control"
                                                        name="email-id-column" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="inputEmail" class="form-label">IC Email</label>
                                                <input type="email" class="form-control" id="inputEmail" name="icmail"
                                                    value="">
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Debtor Name
                                                    </label>
                                                    <input type="email" id="email-id-column" class="form-control"
                                                        name="email-id-column" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Debtor Iqama Number
                                                    </label>
                                                    <input type="email" id="email-id-column" class="form-control"
                                                        name="email-id-column" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Debtor Age
                                                    </label>
                                                    <input type="email" id="email-id-column" class="form-control"
                                                        name="email-id-column" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputEmail" class="form-label">Debtor Mobile Number</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">+966</span>
                                                    </div>
                                                    <input type="text" onkeypress="return event.charCode >= 48"
                                                        min="1"
                                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                        maxlength="9" class="form-control" id="inputEmail" name="deb_mob"
                                                        value="509846984"
                                                        aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                                <!--<input type="number" onkeypress="return event.charCode >= 48" min="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"-->
                                                <!--                              maxlength = "9" class="form-control" id="inputEmail" name="deb_mob" value="+966509846984" required maxlength="10">-->
                                            </div>


                                            <div class="col-md-6">
                                                <label for="inputPassword" class="form-label">Select Debtor Type</label>
                                                <select id="debtorType" class="form-control" name="deb_type"
                                                    required="">

                                                    <option value="insured">Insured</option>
                                                    <option value="third party" selected="">Third Party</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputLastName" class="form-label">Upload Supportive
                                                    Document</label>
                                                <input type="file" class="form-control" id="inputLastName"
                                                    name="support_doc[]" multiple="">
                                                <i class="text-danger">If you not add new document, old documents will be
                                                    considerd</i>
                                            </div>
                                            <div class="col-md-6">

                                                <labelclass="form-label">Check to remove
                                                    <div class="col-md-6">

                                                        <div class="input-group">
                                                            <div class="input-group-text">

                                                                <input class="form-check-input" type="checkbox"
                                                                    value="/Preclaim1/0500500267548/files/166773406642101774952.pdf"
                                                                    name="prefile[]"
                                                                    aria-label="Text input with checkbox">
                                                                <a href="https://recovery.taheiya.sa/Preclaim1/0500500267548/files/166773406642101774952.pdf"
                                                                    target="_blank">Supportive Doc</a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <labelclass="form-label">Check to remove
                                                        <div class="col-md-6">

                                                            <div class="input-group">
                                                                <div class="input-group-text">

                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="/Preclaim1/0500500267548/files/1667734066537287092650.pdf"
                                                                        name="prefile[]"
                                                                        aria-label="Text input with checkbox">
                                                                    <a href="https://recovery.taheiya.sa/Preclaim1/0500500267548/files/1667734066537287092650.pdf"
                                                                        target="_blank">Supportive Doc</a>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <br>


                                                        </labelclass="form-label">
                                                        </labelclass="form-label">
                                            </div>
                                            <div class="col-12">
                                                <button type="reset" class="btn btn-primary mr-1">Re-Submit</button><br>
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

@push('edit-claims-css')
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
@push('edit-claims-js')
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
