@extends('layout.master')
@section('title', 'view remarks')

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
                        <h4>CLAIM DETAIL
                        </h4>

                    </div>

                </div>

                <!-- Basic Tables start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">

                                    <div class="demo-inline-spacing">




                                        <div class="d-inline-block">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                                data-target="#info">Add Remarks</button>
                                            <!-- Modal -->
                                            <div class="modal fade modal-secondary text-left" id="info" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel130">Finance Report
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('approve.claims') }}" method="post">
                                                                @csrf
                                                                {{-- <input type="hidden" name="_token" value="wrKF6K73lazf98Uii6Ee9hodIHkUJ8azqdgReljC">                        <div class="col-md-12"> --}}
                                                                <input type="hidden" name="claim_id" value="1004">
                                                                <label for="inputLastName"
                                                                    class="form-label">Remarks</label>
                                                                <select class="form-control" name="remarks" required="">
                                                                    <option value="">Select Remarks</option>
                                                                    <option value="Postpone The payment. طلب تأجيل السداد">
                                                                        Postpone The payment. طلب تأجيل السداد</option>
                                                                    <option value="Ask for Discount طلب خصم">Ask for
                                                                        Discount طلب خصم</option>
                                                                    <option value="Refuse to Pay.  رفض التسوية والدفع">
                                                                        Refuse to Pay. رفض التسوية والدفع</option>
                                                                    <option value="No Answer العميل لا يجيب على الاتصال">No
                                                                        Answerالعميل لا يجيب على الاتصال</option>
                                                                    <option
                                                                        value="Mobile No. is not Correct.رقم الجوال غير صحيح">
                                                                        Mobile No. is not Correct.رقم الجوال غير صحيح
                                                                    </option>
                                                                    <option
                                                                        value="Debtor Has valid Insurance.العميل يفيد بوجود تأمين ساري المفعول">
                                                                        Debtor Has valid Insurance.العميل يفيد بوجود تأمين
                                                                        ساري المفعول</option>
                                                                    <option value="others">Others</option>
                                                                </select>
                                                                <br>
                                                                <textarea class="form-control" name="addremark"></textarea>
                                                        </div><br>
                                                        <input type="checkbox" id="remainder">
                                                        <label class="form-lable">Want Reminder</label>
                                                        <br>
                                                        <div id="dateshow" style="display:none">
                                                            <label class="form-label">Reminder date</label>

                                                            <input type="datetime-local" class="form-control"
                                                                id="accidentDate" name="rem_date" value=""
                                                                style="width:150px;" min="2023-07-11T00:00">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>

                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                            </div>

                            <!-- Basic Tables start -->
                            <div class="row" id="basic-table">
                                <div class="col-12">
                                    <div class="card">

                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <td>Claim Id</td>
                                                    <td>User Name</td>
                                                    <td>Remarks</td>
                                                    <td>Date</td>
                                                    <td>Reminder Date</td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Basic Tables end -->



                            <hr>

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
                                                <label for="last-name-column">Claim Number
                                                </label>
                                                <input type="text" id="last-name-column" class="form-control"
                                                   name="lname-column" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="city-column">Accident Date</label>
                                                <div class="input-group mb-2">
                                                    <input type="date" class="form-control"
                                                        aria-label="Username" aria-describedby="basic-addon1" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">Accident Location
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column" />
                                            </div>
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
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">Debtor Mobile Number
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">Libaility Percentage
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">Type
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">Debtor Type
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">Upload Supportive Document
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column" />
                                            </div>
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

@push('view-remarks-css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css"
        href="../../../app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="../../../app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="../../../app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <!-- END: Page CSS-->
@endpush
@push('view-remarks-js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/tables/table-datatables-basic.js"></script>
    <!-- END: Page JS-->
@endpush
