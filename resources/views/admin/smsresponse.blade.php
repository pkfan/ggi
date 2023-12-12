@extends('layout.master')
@section('title', 'sms response')

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
                    <h4>@lang('language.SMS STATUS')

                    </h4>
                </div>
            </div>

            <!-- Basic Tables start -->
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">


                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>

                                        <th scope="col" class="text-nowrap">@lang('language.Claim Id')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.Phone Number')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.Status')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.Message')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.MSEGAT Response')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.Sent Time')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.Action')</th>




                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($smsres as $sms)
                                <tr>

                                    <td>GGI00{{$sms->claim_id}}</td>
                                    <td>{{$sms->phone_no}}</td>
                                    <td>
                                        @if($sms->code==1)
                                        Success
                                        @elseif($sms->code=='M0000')
                                        Success
                                        @elseif($sms->code=='M0001')
                                        Variables missing
                                        @elseif($sms->code=='1060')
                                        Balance is not enough
                                        @elseif($sms->code=='1120')
                                        Mobile numbers is not correct
                                        @elseif($sms->code=='M0037')
                                        Please send SMS by statist IP
                                        @elseif($sms->code=='M0002')
                                        Invalid login info
                                        @elseif($sms->code=='M0022')
                                        Exceed number of senders allowed
                                        @elseif($sms->code=='M0023')
                                        Sender Name is active or under activation or refused
                                        @elseif($sms->code=='M0024')
                                        Sender Name should be in English or number
                                        @elseif($sms->code=='M0025')
                                        Invalid Sender Name Length
                                        @elseif($sms->code=='M0026')
                                        Sender Name is already activated or not found
                                        @elseif($sms->code=='M0027')
                                        Activation Code is not Correct
                                        @elseif($sms->code=='1010')
                                        Variables missing
                                        @elseif($sms->code=='1020')
                                        Invalid login info
                                        @elseif($sms->code=='1050')
                                        MSG body is empty
                                        @elseif($sms->code=='1060')
                                        Balance is not enough
                                        @elseif($sms->code=='1061')
                                        MSG duplicated
                                        @elseif($sms->code=='1064')
                                        Free OTP , Invalid MSG content you should use "Pin Code is: xxxx" or "Verification Code: xxxx" or "رمز التحقق: 1234" , or upgrade your account and activate your sender to send any content
                                        @elseif($sms->code=='1110')
                                        Sender name is missing or incorrect
                                        @elseif($sms->code=='1120')
                                        Mobile numbers is not correct
                                        @elseif($sms->code=='1140')
                                        MSG length is too long
                                        @elseif($sms->code=='M0029')
                                        Invalid Sender Name - Sender Name should contain only letters, numbers and the maximum length should be 11 characters
                                        @elseif($sms->code=='M0030')
                                        Sender Name should ended with AD
                                        @elseif($sms->code=='M0031')
                                        Maximum allowed size of uploaded file is 5 MB
                                        @elseif($sms->code=='M0032')
                                        Only pdf,png,jpg and jpeg files are allowed!
                                        @elseif($sms->code=='M0033')
                                        Sender Type should be normal or whitelist only
                                        @elseif($sms->code=='M0034')
                                        Please Use POST Method
                                        @elseif($sms->code=='M0036')
                                        There is no any sender
                                        @else
                                    {{ $sms->code}}
                                        @endif

                                    </td>
                                    <td><textarea>{{$sms->sms}}</textarea></td>
                                    <td>{{$sms->message}}</td>
                                    <td>{{$sms->created_at}}</td>
                                    <td><a href="{{url('admin/resend/msg/'.$sms->claim_id)}}" class="btn btn-sm btn-primary">Resend SMS</a></td>

                                </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <x-pagination :data="$smsres" />
                    </div>
                </div>
            </div>
            <!-- Basic Tables end -->



        </div>



    </div>
</div>
<!-- END: Content-->
@endsection

@push('sms-response-css')
<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
<!-- END: Vendor CSS-->
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
<!-- END: Page CSS-->
@endpush
@push('sms-response-js')
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/jszip.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{{asset('app-assets/js/scripts/tables/table-datatables-basic.js')}}"></script>
<!-- END: Page JS-->
@endpush
