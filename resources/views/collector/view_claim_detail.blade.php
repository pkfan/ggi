@extends('layout.master')
@section('title', 'claim detail')

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
            <x-form-errors-alert />
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <h4>@lang('language.CLAIM DETAIL')
                        </h4>

                    </div>

                </div>

                <!-- Basic Tables start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header" style="padding-top: 0;">
                                    {{-- top silver buttons for modal actions  --}}
                                    <div
                                        style="
                                        width: 100%;
                                        display: flex;
                                        flex-direction: column;
                                        justify-content: center;
                                        align-items: center;">
                                        <h4 class="mb-0 text-primary "
                                            style="  background: #037293;color: white!important;padding: 4px; text-align: center;  border-radius: 4px; margin-bottom: 22px!important;width: 100%;">
                                            Claim Detail - <span style="color: #ffff5a;">GGI00{{ $claim->id }}</span>
                                        </h4>
                                        <x-collector::claims.claim-detail-top-buttons-modals :claim="$claim" />
                                    </div>

                                </div>
                                <hr>
                                @php
                                    $status = DB::table('claim_status')
                                        ->where('claim_id', $claim->id)
                                        ->select('status')
                                        ->first();

                                    // dd($status);

                                @endphp

                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <x-collector::claims.claim-detail-select-status :status="$status" :claim="$claim" />
                                    </div>
                                    <div class="divider" style="width:100%">
                                        <div class="divider-text">Current Claim Status</div>
                                    </div>
                                    <div class="container px-3 py-1">

                                        <x-collector::claims.status :status="$status" :claim="$claim" />
                                    </div>
                                    {{-- claim status component here  --}}




                                    <div class="divider">
                                        <div class="divider-text">GGI00{{ $claim->id }}</div>
                                    </div>
                                    <x-collector::claims.claim-detail-table :status="$status" :claim="$claim" />
                                    <input type="hidden" name="rec_amt" id="rec_amt"
                                        value="{{ $claim->amount_after_discount }}" />

                                    <div class="row">


                                        </form>
                                        <br>
                                        <!-- <div class="divider" style=" width: 100%;">
                                            <div class="divider-text">Add Remarks</div>
                                        </div> -->
                                        <!-- <x-collector::claims.claim-detail-add-remarks :status="$status" :claim="$claim" /> -->
                                        <br>

                                    </div>
                                    <br>

                                    {{-- </div>
                        <h4>end of card error test</h4> --}}
                                    {{-- </form> --}}

                                    @php
                                        $hasSupportiveDoc = \App\Models\Supported_Doc::firstWhere('claim_id', $claim->id);
                                        $hasAdditionalDoc = \App\Models\AdminDoc::firstWhere('claim_id', $claim->id);
                                    @endphp

                                    @if (!($hasSupportiveDoc || $hasAdditionalDoc))
                                        <!-- <div class="col-12">
                                            <div class="alert alert-warning" role="alert"
                                                style="padding: 8px;margin-top: 4px;">
                                                <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                    version="1.1" viewBox="0 0 16 16" height="1em" width="1em"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M8 1.45l6.705 13.363h-13.409l6.705-13.363zM8 0c-0.345 0-0.69 0.233-0.951 0.698l-6.829 13.611c-0.523 0.93-0.078 1.691 0.989 1.691h13.583c1.067 0 1.512-0.761 0.989-1.691h0l-6.829-13.611c-0.262-0.465-0.606-0.698-0.951-0.698v0z">
                                                    </path>
                                                    <path
                                                        d="M9 13c0 0.552-0.448 1-1 1s-1-0.448-1-1c0-0.552 0.448-1 1-1s1 0.448 1 1z">
                                                    </path>
                                                    <path
                                                        d="M8 11c-0.552 0-1-0.448-1-1v-3c0-0.552 0.448-1 1-1s1 0.448 1 1v3c0 0.552-0.448 1-1 1z">
                                                    </path>
                                                </svg> <span>
                                                    This claim does not has any supportive or additinal docs.
                                                    <br>
                                                    please upload supportive or additinal docs to (<span
                                                        style="color:rgb(0, 90, 0); font-weight:bolder">APPROVE</span>)
                                                    this
                                                    claim
                                                </span>
                                            </div>
                                        </div> -->
                                    @endif
                                    <div class="modal-footer">



                                        @if ($claim->status == \App\Enums\ClaimsTableStatus::REJECT->value)
                                            <div class="modal fade text-left modal-primary" id="rejectClaim" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel160">Reject the
                                                                claim
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('AdminRejectClaim') }}" method="post"
                                                                enctype="multipart/form-data">
                                                                <div class="mb-3">
                                                                    <h4>GGI00{{ $claim->id }}</h4>
                                                                    @csrf
                                                                    <input type="hidden" name="id" id="claimid"
                                                                        value="{{ $claim->id }}">
                                                                    <div class="mb-3">

                                                                        <label for="user-current-role"
                                                                            class="form-label">Rejection Reason</label>
                                                                        <textarea class="form-control" name="rejection_reason"></textarea>
                                                                    </div>


                                                                </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>

                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>


                                            <form action="{{ route('AdminToggleClaimStatus') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $claim->id }}">

                                                {{-- show approve button if additional docs OR supportive docs exist; --}}

                                                @if ($hasSupportiveDoc || $hasAdditionalDoc)
                                                    <button class="btn btn-outline-success"
                                                        style="margin-left:5px">@lang('language.Approve')</button>
                                                @endif
                                            </form>
                                        <!-- @elseif($claim->status == \App\Enums\ClaimsTableStatus::APPROVED->value)
                                            <button type="button" class="btn btn-success"
                                                data-dismiss="modal">@lang('language.Approved')</button>
                                        @elseif($claim->status == \App\Enums\ClaimsTableStatus::REJECTED->value)
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">@lang('language.Rejected')</button>
                                        @endif -->

                                        @permission('add-additional-document')
                                            <div class="d-inline-block">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                                    data-target="#primary">
                                                    @lang('language.Upload Additional Doc')
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade text-left modal-primary" id="primary" tabindex="-1"
                                                    role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel160">Add Additional
                                                                    Document</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="mb-3">
                                                                    <h4>GGI00{{ $claim->id }}</h4>
                                                                    <form action="{{ url('admin/additional-document') }}"
                                                                        method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <input type="hidden" value="{{ $claim->id }}"
                                                                                name="claimid">
                                                                            <label>Upload Document</label>
                                                                            <input type="file" class="form-control"
                                                                                multiple="" name="addFile[]"
                                                                                required="">
                                                                        </div>


                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>

                                                                <button type="submit" class="btn btn-primary">Upload</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endpermission
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </section>

        <!-- Basic Tables end -->



    </div>

    <!-- END: Content-->
@endsection

@push('view-claim-detail-css')
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
@push('view-claim-detail-js')
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

    {{-- copy from view_claim_detail old blade page  --}}
    <script type='text/javascript'>
        function check(a) {

            var modal = document.getElementById("myModal1");


            var url = '/check-paylink/' + a;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    modal.style.display = "block";
                    var closeBtn = document.getElementsByClassName("close1")[0];
                    closeBtn.onclick = function() {
                        modal.style.display = "none";
                    };

                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    };
                    if (Object.values(data).length === 0) {
                        document.getElementById('payid').innerHTML = 'N/A'
                        document.getElementById('payresult').innerHTML = 'N/A'
                        document.getElementById('payamt').innerHTML = 'N/A'
                        document.getElementById('paydate').innerHTML = 'N/A'
                    } else {
                        const timestamp = data.created_at;
                        const date = new Date(timestamp);

                        // Using jQuery to update an element with the formatted date
                        const formattedDate = date.toLocaleString();

                        document.getElementById('payid').innerHTML = data.billNumber
                        document.getElementById('payresult').innerHTML = data.result
                        document.getElementById('payamt').innerHTML = data.amount

                        document.getElementById('paydate').innerHTML = formattedDate
                    }


                }
            });
            return false;
        }
    </script>

    <script>
        function rejectid(claimid) {
            document.getElementById('claimid').value = claimid;
        }

        $('#remainder').change(function() {
            if (this.checked) {
                $("#dateshow").css("display", "");
            } else {
                $("#dateshow").css("display", "none");
            }
        });
        // 	$(function(){
        //     var dtToday = new Date();
        //     var month = dtToday.getMonth() + 1;
        //     var day = dtToday.getDate();
        //     var year = dtToday.getFullYear();
        //     var hour=  dtToday.getHours();
        //     var min=dtToday.getMinutes();
        //     if(month < 10)
        //         month = '0' + month.toString();
        //     if(day < 10)
        //         day = '0' + day.toString();
        //         console.log(day)
        //     var maxDate = year + '-' + month + '-' + day ;

        //   // alert(maxDate);
        //     $('#accidentDate').attr('min',maxDate );
        //     $('#inspection-date-from').attr('min',maxDate );

        //   });
        // });



        $(function() {

            var dtToday = new Date();
            console.log(dtToday)
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            var hour = dtToday.getHours();
            var min = dtToday.getMinutes();
            console.log(month, day, year);
            if (month < 10)
                month = '0' + month.toString();
            console.log(month)
            if (day < 10)
                day = '0' + day.toString();
            console.log(day)
            var maxDate = year + '-' + month + '-' + day + 'T' + '00' + ':' + '00';


            $('#accidentDate').attr('min', maxDate);
            $('#delaypay').attr('min', maxDate);
            $('#partialpay').attr('min', maxDate);
            $('#editpartial').attr('min', maxDate);

        });

        function changedelay(a) {
            console.log(a)
            $('#delayid').val(a);
        }

        function changepartial(a, amount) {
            //   console.log(a)
            $('#partialid').val(a);
            $('#paramt').val(amount);
        }

        function manualpartialCollection(partial_pay_id, partial_pay_amount, partial_pay_date_time, partial_pay_claim_id) {
            $('#manualpartialid').val(partial_pay_id);
            $('#partial-pay-amount-modal').val(partial_pay_amount);
            $('#partial-pay-date-time-modal').val(partial_pay_date_time);
            $('#manualpartialClaimId').val(partial_pay_claim_id);
        }
        $('#claimstatus').on('change', function() {
            if (this.value == 1) {
                $('#followupDiv').show();
                $('#collectedDiv').hide();
                $('#delaypaymentDiv').hide();
                $('#partialPayDiv').hide();
                $('#transferMorr').hide();
                $('#assignLaw').hide();
                $('#assignAcc').hide();
                $('#assignElm').hide();
                $('#assignIc').hide();
                $('#closeClaim').hide();
                $('#partialPayDiv').hide();
                $('#collectedbyic').hide();
            } else if (this.value == 2) {
                $('#followupDiv').hide();
                $('#collectedDiv').show();
                $('#delaypaymentDiv').hide();
                $('#partialPayDiv').hide();
                $('#transferMorr').hide();
                $('#assignLaw').hide();
                $('#assignAcc').hide();
                $('#assignElm').hide();
                $('#assignIc').hide();
                $('#closeClaim').hide();
                $('#partialPayDiv').hide();
                $('#collectedbyic').hide();
            } else if (this.value == 3) {
                $('#followupDiv').hide();
                $('#delaypaymentDiv').show();
                $('#partialPayDiv').hide();
                $('#transferMorr').hide();
                $('#assignLaw').hide();
                $('#assignAcc').hide();
                $('#assignElm').hide();
                $('#assignIc').hide();
                $('#closeClaim').hide();
                $('#partialPayDiv').hide();
                $('#collectedDiv').hide();
                $('#collectedbyic').hide();
            } else if (this.value == 4) {
                $('#followupDiv').hide();
                $('#partialPayDiv').show();
                $('#transferMorr').hide();
                $('#assignLaw').hide();
                $('#assignAcc').hide();
                $('#assignElm').hide();
                $('#assignIc').hide();
                $('#closeClaim').hide();
                $('#delaypaymentDiv').hide();
                $('#collectedDiv').hide();
                $('#collectedbyic').hide();
            } else if (this.value == 5) {
                $('#followupDiv').hide();
                $('#partialPayDiv').hide();
                $('#transferMorr').show();
                $('#assignLaw').hide();
                $('#assignAcc').hide();
                $('#assignElm').hide();
                $('#assignIc').hide();
                $('#closeClaim').hide();
                $('#delaypaymentDiv').hide();
                $('#collectedDiv').hide();
                $('#collectedbyic').hide();
            } else if (this.value == 6) {
                $('#followupDiv').hide();
                $('#assignLaw').show();
                $('#partialPayDiv').hide();
                $('#transferMorr').hide();
                $('#assignAcc').hide();
                $('#assignElm').hide();
                $('#assignIc').hide();
                $('#closeClaim').hide();
                $('#delaypaymentDiv').hide();
                $('#collectedDiv').hide();
                $('#collectedbyic').hide();
            } else if (this.value == 7) {
                $('#followupDiv').hide();
                $('#assignAcc').show();
                $('#partialPayDiv').hide();
                $('#transferMorr').hide();
                $('#assignLaw').hide();
                $('#assignElm').hide();
                $('#assignIc').hide();
                $('#closeClaim').hide();
                $('#delaypaymentDiv').hide();
                $('#collectedDiv').hide();
                $('#collectedbyic').hide();
            } else if (this.value == 8) {
                $('#followupDiv').hide();
                $('#assignElm').show();
                $('#partialPayDiv').hide();
                $('#transferMorr').hide();
                $('#assignLaw').hide();
                $('#assignAcc').hide();
                $('#assignIc').hide();
                $('#closeClaim').hide();
                $('#delaypaymentDiv').hide();
                $('#collectedDiv').hide();
                $('#collectedbyic').hide();
            } else if (this.value == 9) {
                $('#followupDiv').hide();
                $('#assignIc').show();
                $('#partialPayDiv').hide();
                $('#transferMorr').hide();
                $('#assignLaw').hide();
                $('#assignAcc').hide();
                $('#assignElm').hide();
                $('#closeClaim').hide();
                $('#delaypaymentDiv').hide();
                $('#collectedDiv').hide();
                $('#collectedbyic').hide();
            } else if (this.value == 10) {
                $('#followupDiv').hide();
                $('#closeClaim').show();
                $('#partialPayDiv').hide();
                $('#assignIc').hide();
                $('#transferMorr').hide();
                $('#assignLaw').hide();
                $('#assignAcc').hide();
                $('#assignElm').hide();
                $('#delaypaymentDiv').hide();
                $('#collectedDiv').hide();
                $('#collectedbyic').hide();
            } else if (this.value == 11) {
                $('#collectedbyic').show();
                $('#closeClaim').hide();
                $('#partialPayDiv').hide();
                $('#assignIc').hide();
                $('#transferMorr').hide();
                $('#assignLaw').hide();
                $('#assignAcc').hide();
                $('#assignElm').hide();
                $('#delaypaymentDiv').hide();
                $('#collectedDiv').hide();
            }
        });
    </script>
    <script>
        const copyButtons = document.querySelectorAll('.copyIcon');
        copyButtons.forEach(function(icon) {
            icon.addEventListener('click', function() {
                const targetId = this.dataset.target;
                const textToCopy = document.getElementById(targetId).textContent;

                const range = document.createRange();
                range.selectNode(document.getElementById(targetId));

                const selection = window.getSelection();
                selection.removeAllRanges();
                selection.addRange(range);

                document.execCommand('copy');
                selection.removeAllRanges();

                alert('Text copied: ' + textToCopy);
            });
        });
    </script>
    <script>
        $('#lastplan').change(function() {
            $('#newPartialDiv').hide();
            var selectedOption = $(this).val();
            switch (selectedOption) {
                case "yes":
                    $('#newPartialDiv').hide();
                    break;
                case "no":
                    $('#newPartialDiv').show();
                    break;
            }

        });

        function onPartialInputChangeAddEvent() {
            console.log('onPartialInputChange event');
            var claimTotalAmount = Number(document.getElementById("rec_amt").value);

            var partialSettlementClasses = document.querySelectorAll('.partial-settlement-class');

            partialSettlementClasses.forEach(partialSettlementClass => {

                partialSettlementClass.addEventListener('input', (e) => {
                    // reset previous styles
                    e.target.style.color = 'black';
                    e.target.style.border = '1px solid black';
                    e.target.style.background = '#fff';


                    // console.log('partialSettlementClass.addEventListener( ', partialSettlementClasses[partialSettlementClasses.length-1]);
                    console.log('partialSettlementClass.addEventListener( ', e.target.value);
                    e.target.setAttribute('is-touch', 'true');

                    let currentPartialInputValue = Number(e.target.value);

                    if (currentPartialInputValue > claimTotalAmount) {

                        e.target.style.color = 'red';
                        e.target.style.border = '1px solid red';
                        e.target.style.background = '#ffeaea';

                        alert('invalid amount of claim partial. please make equal amount of installment.');

                    }


                    let isPartialTouchAllInputsFlase = document.querySelectorAll("[is-touch='false']");
                    let isPartialTouchAllInputsTrue = document.querySelectorAll("[is-touch='true']");

                    let totalTouchInputTrueAmount = 0;

                    isPartialTouchAllInputsTrue.forEach(inputTouchTrue => {
                        inputTouchTrueValue = Number(inputTouchTrue.value);

                        if (isNaN(inputTouchTrueValue)) return;

                        totalTouchInputTrueAmount += inputTouchTrueValue;
                    });


                    let remainingTotalAmount = claimTotalAmount - totalTouchInputTrueAmount;


                    if (isPartialTouchAllInputsFlase.length > 0) {
                        let counterDivideIndex = 0;
                        let remainingEqualPartials = divideValue(remainingTotalAmount,
                            isPartialTouchAllInputsFlase.length);
                        console.log('remainingEqualPartials : ', remainingEqualPartials);
                        isPartialTouchAllInputsFlase.forEach(isPartialTouchFalse => {
                            isPartialTouchFalse.value = remainingEqualPartials[counterDivideIndex];

                            counterDivideIndex++;
                        });
                    }

                    checkAndFixAllPartialEquals();



                });

            });



        }

        function divideValue(value, numParts) {
            // Calculate the quotient and remainder
            const quotient = Math.floor(value / numParts);
            const remainder = value % numParts;

            // Create an array to store the result
            const result = Array(numParts).fill(quotient);

            // Distribute the remainder among the parts
            for (let i = 0; i < remainder; i++) {
                result[i]++;
            }

            return result;
        }

        function settelPlan() {

            //	debugger
            var rowCountInput = document.getElementById("rowCountInput");
            var rowCount = parseInt(rowCountInput.value);
            var amount = document.getElementById("rec_amt");
            var rec_amount = Number(amount.value);
            var planamount = rec_amount / rowCount
            planamount = divideValue(rec_amount, rowCount)
            var columnCount = 2; // Number of columns you want

            var table = document.getElementById("myTable");
            var tbody = table.getElementsByTagName("tbody")[0];

            // Clear existing rows, if any
            tbody.innerHTML = "";

            // Add rows
            for (var i = 0; i < rowCount; i++) {
                var row = document.createElement("tr");
                var cell1 = document.createElement("td");
                var text = document.createTextNode(i + 1);
                cell1.append(text)
                row.appendChild(cell1);
                for (var j = 0; j < columnCount - 1; j++) {
                    var cell = document.createElement("td");
                    var input = document.createElement("input");
                    input.setAttribute('type', 'text');
                    input.setAttribute('value', planamount[i]);
                    input.setAttribute('style', 'width:100%;margin-top:6px');
                    input.setAttribute('name', 'amount[]');
                    input.setAttribute('class', 'partial-settlement-class');
                    input.setAttribute('is-touch', 'false');

                    cell.appendChild(input);
                    row.appendChild(cell);
                }
                tbody.appendChild(row);
            }

            onPartialInputChangeAddEvent();
        }

        function checkAndFixAllPartialEquals() {
            var amountString = document.getElementById("rec_amt").value;
            var totalClaimAmount = Number(amountString);

            if (isNaN(totalClaimAmount)) return false;

            var partialSettlementClasses = document.querySelectorAll('.partial-settlement-class');

            var totalPartialInputsAmount = 0;

            let isAllTouched = true;

            partialSettlementClasses.forEach(partialSettlementClass => {
                console.log('partialSettlementClass : ', partialSettlementClass.value);

                var partialAmount = Number(partialSettlementClass.value);

                totalPartialInputsAmount += partialAmount;

                if (partialSettlementClass.getAttribute('is-touch') == 'false') {
                    isAllTouched = false;
                }

            });

            if (totalClaimAmount == totalPartialInputsAmount) {
                return true;
            }

            if (isAllTouched) {
                console.log('if(isAllTouched){ ');
                let lastPartialSettlementInput = partialSettlementClasses[partialSettlementClasses.length - 1];

                if (totalPartialInputsAmount > totalClaimAmount) {
                    let exceededAmount = totalPartialInputsAmount - totalClaimAmount;
                    let lastPartialInputFixAmount = Number(lastPartialSettlementInput.value) - exceededAmount;

                    if (lastPartialInputFixAmount < 0) {
                        lastPartialSettlementInput.value = 0;
                        console.log('if(lastPartialInputFixAmount < 0){');
                    } else {
                        lastPartialSettlementInput.value = lastPartialInputFixAmount;

                        console.log('else(lastPartialInputFixAmount < 0){');
                    }

                } else {
                    console.log('else(totalPartialInputsAmount > totalClaimAmount){');
                    let lesserAmount = totalClaimAmount - totalPartialInputsAmount;
                    if (lesserAmount < 0) {
                        lastPartialSettlementInput.value = 0;
                    }
                    let lastPartialInputFixAmount = Number(lastPartialSettlementInput.value) + lesserAmount;
                    lastPartialSettlementInput.value = lastPartialInputFixAmount;

                }
                lastPartialSettlementInput
            }

            return false;

        }
    </script>
@endpush
