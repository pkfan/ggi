@extends('layout.master')
@section('title', 'Claim Detail')

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
                    <h4>@lang('language.Claim Detail')
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
                                    <h4 class="mb-0 text-primary ">@lang('language.Claim Detail') &nbsp;<br> GGI0011</h4>
                                    <div class="d-inline-block">
                                        <!-- Button trigger modal -->
                                        <a href="chat.html">
                                            <button type="button" class="btn btn-outline-primary"
                                            data-target="#primary">
                                            @lang('language.Add/View Comments')
                                        </button>
                                        </a>

                                        <!-- Modal -->
                                        <!-- <div class="modal fade text-left modal-primary" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel160">Primary Modal</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Tart lemon drops macaroon oat cake chocolate toffee chocolate bar icing. Pudding jelly beans
                                                            carrot cake pastry gummies cheesecake lollipop. I love cookie lollipop cake I love sweet gummi
                                                            bears cupcake dessert.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                    </div>

                                    <div class="d-inline-block">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#secondary">
                                            @lang('language.Call History')
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade modal-secondary text-left" id="secondary"
                                            tabindex="-1" role="dialog" aria-labelledby="myModalLabel1660"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel1660">@lang('language.Call History')
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">


                                                            <h4>@lang('language.Call History') GGI0011</h4>


                                                            <h6>@lang('language.Call'):1</h6>

                                                            <!--ye not equal to null tha -->

                                                            @lang('language.Duration'):0 <br>
                                                            @lang('language.Status'):no-answer

                                                            <h6>Call:2</h6>

                                                            <!--ye not equal to null tha -->

                                                            Duration:44 <br>
                                                            Status:completed


                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal"> @lang('language.Close')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-inline-block">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#success">
                                            @lang('language.SMS History')
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade text-left modal-primary" id="success" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-secondary" id="myModalLabel110">
                                                        @lang('language.SMS History')</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">


                                                            <h4> @lang('language.SMS History') GGI0011</h4>



                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal"> @lang('language.Close')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-inline-block">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#danger">
                                            @lang('language.Create Mada Settlement')
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade modal-secondary text-left" id="danger" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel120">@lang('language.CSettlement Links')</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">

                                                        </div>
                                                        <div class="mb-3">


                                                            <h4>GGI0011</h4>
                                                            <form
                                                                action="https://recovery.taheiya.sa/admin/create-payment-link"
                                                                method="post">
                                                                <input type="hidden" name="_token"
                                                                    value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi">
                                                                <div class="mb-3">
                                                                    <input type="hidden" value="11" name="claimid">
                                                                    <label>@lang('language.Add Amount')</label>
                                                                    <input type="number" class="form-control"
                                                                        name="amount" required="">
                                                                    <input type="checkbox" name="save"
                                                                        class="form-checkbox" value="yes">
                                                                        @lang('language.Save link as new link in document')?
                                                                </div>

                                                            </form>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal">@lang('language.Close')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-inline-block">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#warning">
                                            @lang('language.Sadad Invoice')
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade text-left modal-secondary" id="warning" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel140" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel140">@lang('language.Sadad Invoice')
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <h6>@lang('language.Sadad Number')</h6>

                                                        <!--<h6>Sadad Number</h6>-->

                                                        <div class="mb-3">

                                                        @lang('language.Are you sure to send Sadad Invoice')?

                                                        </div>




                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal">@lang('language.Yes')</button>
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal">@lang('language.No')</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-inline-block">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#info">@lang('language.Finance Report')</button>
                                        <!-- Modal -->
                                        <div class="modal fade modal-secondary text-left" id="info" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel130">@lang('language.Finance Report')
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">


                                                            <h6>@lang('language.Additional Link Created By Admin')</h6>
                                                            <p>@lang('language.Number of additional links'): 0</p>



                                                            <p>@lang('language.Delay links send'): 0</p>
                                                            No recovery by delay link

                                                            <br>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal">@lang('language.Close')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <form method="post" action="">
                                            <input type="hidden" name="_token"
                                                value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi">
                                            <h5>Select Status <i class="fadeIn animated bx bx-history" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#statushistory"></i> <i
                                                    class="fadeIn animated bx bx-comment-detail" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#statusReasonmodal"></i>
                                            </h5>
                                            <input type="hidden" value="11" name="claimid">
                                            <select class="form-control" name="cstatus" id="sectionChooser">
                                                <option value="followupDiv">Follow Up للمتابعة</option>

                                                <option  value="collectedDiv">Collected تم التحصيل</option>
                                                <option value="delayedDiv">Delay Settlement تأجيل السداد</option>
                                                <option value="partialPayDiv">Partial Settlement سداد جزئ</option>
                                                <option value="transferMorr" selected="">Transfer to Morror تحول للمرور
                                                </option>
                                                <option value="assignLaw">Transfer to Lawyer تحول للمحام</option>
                                                <option value="assignAcc">Transfer to Finance Co. تحول</option>
                                                <option value="assignElm">Transfer to ELM</option>
                                                <option value="assignIc">Transfer to IC</option>
                                                <option value="closeClaim">Close</option>
                                                <option value="collectedbyic">@lang('language.Collected By Insurance') </option>


                                            </select>
                                        </form>
                                        <br>
                                        <div id="details-container">
                                        <div class="col-md-12 panel followupDiv" >

                                            <h4>@lang('language.Revert Status')</h4>
                                            <form action="" method="post">
                                                <input type="hidden" name="_token"
                                                    value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi"> <input
                                                    type="hidden" value="11" name="claimid">
                                                <label class="form-label">@lang('language.You are going to change status to follow up')</label><br>
                                                <label class="form-label">@lang('language.Add Reason')</label><br>
                                                <input type="text" class="form-control" name="statusreason"
                                                    ><br>
                                                <button type="submit" class="btn btn-primary">@lang('language.Submit')</button>
                                            </form>
                                            <br>

                                        </div>

                                        <div class="col-md-12 panel collectedDiv" >
                                            <h4>@lang('language.Collected')</h4>
                                            <form action="" method="post">
                                                <input type="hidden" name="_token"
                                                    value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi"> <input
                                                    type="hidden" value="11" name="claimid">
                                                <label class="form-lable">@lang('language.Settlement Method')</label><br>
                                                <input type="radio" class="form-checkbox" name="cash"
                                                    value="yes">@lang('language.Cash Settlement')
                                                <input type="radio" class="form-checkbox" name="cash"
                                                    value="no">@lang('language.Bank Transfer')<br>
                                                <label class="form-label">@lang('language.Add Reason')</label><br>
                                                <input type="text" class="form-control" name="statusreason"
                                                   ><br>
                                                <input type="submit" class="btn btn-primary">
                                            </form>
                                        </div>
                                        <div class="col-md-12 panel delayedDiv" >
                                            <form method="post"
                                                action="https://recovery.taheiya.sa/admin-pay/delay">
                                                <input type="hidden" name="_token"
                                                    value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi"> <input
                                                    type="hidden" value="11" name="claimid">
                                                <h6>@lang('language.Delay Settlement')</h6>
                                                <select class="form-control" name="type">
                                                    <option>@lang('language.Select Method')</option>
                                                    <option value="sadad">@lang('language.Sadad')</option>
                                                    <option value="mada">@lang('language.Mada')</option>
                                                </select><br>
                                                <input type="datetime-local" class="form-control" name="delaydate"
                                                    id="delaypay" min="2023-07-10T00:00">
                                                <label class="form-label">@lang('language.Add Reason')</label><br>
                                                <input type="text" class="form-control" name="statusreason"
                                                    >
                                                <div style="margin-top:10px;margin-bottom:10px">
                                                    <input type="submit" class="btn btn-primary">
                                                </div>
                                            </form>

                                        </div>
                                        <div class="col-md-12 panel partialPayDiv" >

                                            <form method="post"
                                                action="https://recovery.taheiya.sa/admin/partial-pay"
                                                id="partialform">
                                                <input type="hidden" name="_token"
                                                    value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi"> <input
                                                    type="hidden" value="11" name="claimid">
                                                <h6>@lang('language.Partial Settlement')</h6>
                                                <label class="form-label">@lang('language.Select Settlement Plan')</label>
                                                <!--<select class="form-control" name="plan" id="partial">-->
                                                <!--	<option value="2">2 payment</option>-->
                                                <!--	<option value="3">3 payment</option>-->
                                                <!--	<option value="4">4 payment</option>-->
                                                <!--	<option value="5">5 payment</option>-->
                                                <!--	<option value="6">6 payment</option>-->
                                                <!--</select>-->
                                                <input type="number" name="plan"
                                                    class="form-control">
                                                <label class="form-label">@lang('language.Select Method')</label>
                                                <select name="type" class="form-control">
                                                    <option selected="" value="">@lang('language.Select Method')</option>
                                                    <option value="sadad">@lang('language.Sadad Invoice')</option>
                                                    <option value="online">@lang('language.Online Link')</option>
                                                </select>

                                                <label class="form-label">@lang('language.Set Date')</label>
                                                <input type="datetime-local" class="form-control" name="pardate"
                                                    id="partialpay" min="2023-07-10T00:00">
                                                <label class="form-label">@lang('language.Add Reason')</label><br>
                                                <input type="text" class="form-control" name="statusreason"
                                                   >
                                                <div style="margin-top:10px;margin-bottom:10px">
                                                    <input type="submit" class="btn btn-primary">
                                                </div>
                                            </form>

                                        </div>
                                        <div class="col-md-12 panel transferMorr" >
                                            <h4>@lang('language.Morror Detail')</h4>
                                            <form action="" method="post">
                                                <input type="hidden" name="_token"
                                                    value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi"> <input
                                                    type="hidden" value="11" name="claimid">
                                                <label class="form-label">@lang('language.City')</label>
                                                <select class="form-control" name="morrorcity">
                                                    <option value="">-- lang('Language.Select City') --</option>
                                                    <option value="الرياض">الرياض</option>
                                                    <option value="جدة">جدة</option>
                                                    <option value="الدمام">الدمام</option>
                                                    <option value="مكة المكرمة">مكة المكرمة</option>
                                                    <option value="المدينة المنورة">المدينة المنورة</option>
                                                    <option value="الخبر">الخبر</option>
                                                    <option value="الظهران">الظهران</option>
                                                    <option value="الاحساء">الاحساء</option>
                                                    <option value="Artawiya">Artawiya</option>
                                                    <option value="الطائف">الطائف</option>
                                                    <option value="جازان">جازان</option>
                                                    <option value="بريدة">بريدة</option>
                                                    <option value="تبوك">تبوك</option>
                                                    <option value="القطيف">القطيف</option>
                                                    <option value="خميس مشيط">خميس مشيط</option>
                                                    <option value="حفر الباطن">حفر الباطن</option>
                                                    <option value="الجبيل">الجبيل</option>
                                                    <option value="الخرج">الخرج</option>
                                                    <option value="أبها">أبها</option>
                                                    <option value="حائل">حائل</option>
                                                    <option value="نجران">نجران</option>
                                                    <option value="ينبع">ينبع</option>
                                                    <option value="صبيا">صبيا</option>
                                                    <option value="الدوادمي">الدوادمي</option>
                                                    <option value="بيشة">بيشة</option>
                                                    <option value="أبو عريش">أبو عريش</option>
                                                    <option value="القنفذة">القنفذة</option>
                                                    <option value="محايل عسير">محايل عسير</option>
                                                    <option value="سكاكا">سكاكا</option>
                                                    <option value="عرعر">عرعر</option>
                                                    <option value="عنيزة">عنيزة</option>
                                                    <option value="القريات">القريات</option>
                                                    <option value="صامطة">صامطة</option>
                                                    <option value="المجمعة">المجمعة</option>
                                                    <option value="القويعية">القويعية</option>
                                                    <option value="أحد المسارحة">أحد المسارحة</option>
                                                    <option value="الرس">الرس</option>
                                                    <option value="الباحة">الباحة</option>
                                                    <option value="الجموم">الجموم</option>
                                                    <option value="رابغ">رابغ</option>
                                                    <option value="شرورة">شرورة</option>
                                                    <option value="الليث">الليث</option>
                                                    <option value="رفحاء">رفحاء</option>
                                                    <option value="عفيف">عفيف</option>
                                                    <option value="الخفجي">الخفجي</option>
                                                    <option value="الدرعية">الدرعية</option>
                                                    <option value="طبرجل">طبرجل</option>
                                                    <option value="بيش">بيش</option>
                                                    <option value="الزلفي">الزلفي</option>
                                                    <option value="الدرب">الدرب</option>
                                                    <option value="سراة عبيدة">سراة عبيدة</option>
                                                    <option value="رجال المع">رجال المع</option>
                                                    <option value="الأفلاج">الأفلاج</option>
                                                    <option value="بلجرشي">بلجرشي</option>
                                                    <option value="وادي الدواسر">وادي الدواسر</option>
                                                    <option value="أحد رفيدة">أحد رفيدة</option>
                                                    <option value="بدر">بدر</option>
                                                    <option value="أملج">أملج</option>
                                                    <option value="رأس تنورة">رأس تنورة</option>
                                                    <option value="المهد">المهد</option>
                                                    <option value="البكيرية">البكيرية</option>
                                                    <option value="البدائع">البدائع</option>
                                                    <option value="الحناكية">الحناكية</option>
                                                    <option value="العلا">العلا</option>
                                                    <option value="الطوال">الطوال</option>
                                                    <option value="النماص">النماص</option>
                                                    <option value="المجاردة">المجاردة</option>
                                                    <option value="بقيق">بقيق</option>
                                                    <option value="تثليث">تثليث</option>
                                                    <option value="النعيرية">النعيرية</option>
                                                    <option value="المخواة">المخواة</option>
                                                    <option value="الوجه">الوجه</option>
                                                    <option value="ضباء">ضباء</option>
                                                    <option value="بارق">بارق</option>
                                                    <option value="خيبر">خيبر</option>
                                                    <option value="طريف">طريف</option>
                                                    <option value="رنية">رنية</option>
                                                    <option value="دومة الجندل">دومة الجندل</option>
                                                    <option value="المذنب">المذنب</option>
                                                    <option value="تربة">تربة</option>
                                                    <option value="ظهران الجنوب">ظهران الجنوب</option>
                                                    <option value="حوطة بني تميم">حوطة بني تميم</option>
                                                    <option value="الخرمة">الخرمة</option>
                                                    <option value="شقراء">شقراء</option>
                                                    <option value="المزاحمية">المزاحمية</option>
                                                    <option value="الأسياح">الأسياح</option>
                                                    <option value="السليل">السليل</option>
                                                    <option value="تيماء">تيماء</option>
                                                    <option value="الارطاوية">الارطاوية</option>
                                                    <option value="ضرمة">ضرمة</option>
                                                    <option value="الحريق">الحريق</option>
                                                    <option value="حقل">حقل</option>

                                                    <option value="حريملاء">حريملاء</option>
                                                    <option value="جلاجل">جلاجل</option>
                                                    <option value="المبرز">المبرز</option>
                                                    <option value="القيصومة">القيصومة</option>
                                                    <option value="سبت العلايا">سبت العلايا</option>
                                                    <option value="صفوة">صفوة</option>
                                                    <option value="سيهات">سيهات</option>
                                                    <option value="تنومة">تنومة</option>
                                                    <option value="تاروت">تاروت</option>
                                                    <option value="ثادق">ثادق</option>
                                                    <option value="الثقبة">الثقبة</option>
                                                </select>
                                                <label class="form-label">@lang('language.Department')</label>
                                                <input type="text" name="department" class="form-control"
                                                    required="">
                                                <label class="form-label">@lang('language.Assign Collector')</label>
                                                <select class="form-control" name="collector" required="">
                                                    <option value="">-- @lang('language.Select Collector') --</option>
                                                    <option value="testing">testing</option>
                                                    <option value="Collector Test 1">Collector Test 1</option>
                                                </select><br>
                                                <label class="form-label">@lang('language.Add Reason')</label><br>
                                                <input type="text" class="form-control" name="statusreason"
                                                    ><br>
                                                <input type="submit" class="btn btn-primary">
                                            </form>
                                        </div>
                                        <div class="col-md-12 panel assignLaw" >
                                            <h4>@lang('language.Transfer to Lawyer')</h4>
                                            <form action="" method="post">
                                                <input type="hidden" name="_token"
                                                    value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi"> <input
                                                    type="hidden" value="11" name="claimid">
                                                <label class="form-label">@lang('language.Select Law firm')</label>
                                                <select class="form-control" name="lawfirm" required="">
                                                    <option value="">-- @lang('language.Select Law Firm') --</option>
                                                    <option value="4">lawfirm</option>
                                                    <option value="5">law firm 2</option>
                                                    <option value="6">law firm 3</option>
                                                </select><br>
                                                <input type="text" class="form-control" name="statusreason"
                                                    ><br>
                                                <input type="submit" class="btn btn-primary">
                                            </form>
                                        </div>
                                        <div class="col-md-12 panel assignAcc"  >
                                            <h4>@lang('language.Transfer to Finance')</h4>
    <form action="" method="post">
        <input type="hidden" name="_token" value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi">											<input type="hidden" value="11" name="claimid">
        <label class="form-label">@lang('language.Select Finance Company')</label>
        <select class="form-control" name="finance" required="">
            <option value="">-- @lang('language.Select Finance Company') --</option>
                                                            <option value="1">finance</option>
                                                            <option value="2">iman</option>
                                                        </select><br>
        <label class="form-label">@lang('language.Add Reason')</label>
        <input type="text" class="form-control" name="statusreason" ><br>
        <input type="submit" class="btn btn-primary">
    </form>
                                        </div>
                                        <div class="col-md-12 panel assignElm" >

                                            <h4>@lang('language.Transfer to ELM')</h4>
                                            <form action="" method="post">
                                                <input type="hidden" name="_token" value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi">											<input type="hidden" value="11" name="claimid">
                                                <label class="form-lable">@lang('language.Iqama Number')</label><br>
                                                <input type="number" class="form-control" name="deb_iqama" required=""><br>
                                                <label class="form-label">@lang('language.Add Reason')</label>
                                                <input type="text" class="form-control" name="statusreason" ><br>
                                                <input type="submit" class="btn btn-primary">
                                            </form>
                                        </div>
                                        <div class="col-md-12 panel assignIc"  >

                                            <h4>@lang('language.Transfer to IC')</h4>
                                            <form action="" method="post">
                                                <input type="hidden" name="_token" value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi">											<input type="hidden" value="11" name="claimid">
                                                <input type="hidden" value="3" name="company_id">
                                                <label class="form-lable">@lang('language.Add Comments')</label><br>
                                                <textarea name="comments" class="form-control"></textarea><br>
                                                <label class="form-label">@lang('language.Add Reason')</label>
                                                <input type="text" class="form-control" name="statusreason" ><br>
                                                <input type="submit" class="btn btn-primary">
                                            </form>
                                        </div>
                                        <div class="col-md-12 panel closeClaim"  >

                                            <h4>@lang('language.Closed')</h4>
                                            <form action="" method="post">
                                                <input type="hidden" name="_token" value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi">											<input type="hidden" value="11" name="claimid">
                                                <label class="form-lable">@lang('language.Are you Sure to close')?</label><br>
                                                <input type="radio" class="form-checkbox" name="elm" value="yes">@lang('language.Yes')
                                                <input type="radio" class="form-checkbox" name="elm" value="no">@lang('language.No')<br>
                                                <label class="form-label">@lang('language.Add Reason')</label>
                                                <input type="text" class="form-control" name="statusreason" ><br>
                                                <input type="submit" class="btn btn-primary">
                                            </form>
                                        </div>
                                        <div class="col-md-12 panel  collectedbyic"  >
                                            <h4>@lang('language.Collected By Insurance')</h4>
                                            <form action="" method="post">
                                                <input type="hidden" name="_token" value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi">											<input type="hidden" value="11" name="claimid">
                                                <label class="form-label">@lang('language.Are you sure to mark as collected by Insurance')</label><br>
                                                <label class="form-label">@lang('language.Add Reason')</label><br>
                                                <input type="text" class="form-control" name="statusreason" ><br>
                                                <input type="submit" class="btn btn-primary">
                                            </form><br>
                                        </div>

                                    </div>
                                </div>
                                </div>
                            </div>



<hr>

                            <div class="card-body">
                                <form class="form">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column"> @lang('language.Recovery Amount')</label>
                                                <input type="text" id="first-name-column" class="form-control"
                                                    name="fname-column" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-column">@lang('language.Claim Number')
                                                </label>
                                                <input type="text" id="last-name-column" class="form-control"
                                                   name="lname-column" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="city-column">@lang('language.Accident Date')</label>
                                                <div class="input-group mb-2">
                                                    <input type="date" class="form-control" placeholder=""
                                                        aria-label="Username" aria-describedby="basic-addon1" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">@lang('language.Accident Location')
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">@lang('language.Debtor Name')
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">@lang('language.Debtor Iqama Number')
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">@lang('language.Debtor Age')
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">@lang('language.Debtor Mobile Number')
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">@lang('language.Libaility Percentage')
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">@lang('language.Type')
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">@lang('language.Debtor Type')
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-column">@lang('language.Upload Supportive Document')
                                                </label>
                                                <input type="email" id="email-id-column" class="form-control"
                                                    name="email-id-column" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="reset" class="btn btn-primary mr-1">@lang('language.View Remarks')</button><br>
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="hidden" name="claim_id" value="11">
                                                <label for="inputLastName" class="form-label">@lang('language.Remarks')</label>
                                                <select class="form-control" name="remarks" required="">
                                                    <option value="">Select Remarks</option>
                                                    <option value="Postpone The payment. طلب تأجيل السداد">Postpone
                                                        The payment. طلب تأجيل السداد</option>
                                                    <option value="Ask for Discount طلب خصم">Ask for Discount طلب
                                                        خصم</option>
                                                    <option value="Refuse to Pay.  رفض التسوية والدفع">Refuse to
                                                        Pay. رفض التسوية والدفع</option>
                                                    <option value="No Answer العميل لا يجيب على الاتصال">No
                                                        Answerالعميل لا يجيب على الاتصال</option>
                                                    <option value="Mobile No. is not Correct.رقم الجوال غير صحيح">
                                                        Mobile No. is not Correct.رقم الجوال غير صحيح</option>
                                                    <option
                                                        value="Debtor Has valid Insurance.العميل يفيد بوجود تأمين ساري المفعول">
                                                        Debtor Has valid Insurance.العميل يفيد بوجود تأمين ساري
                                                        المفعول</option>
                                                    <option value="other  أخرى">Other أخرى</option>
                                                </select>
                                                <br>
                                                <textarea class="form-control" name="addremark"></textarea>

                                            </div>
                                            <!-- <input  type="checkbox" id="remainder">
                                            <label class="form-lable">Want Reminder</label>
                                            <div class="field">
                                                <input type="text" class="form-control"> -->
                                                <div class="checkbox">
                                                    <label>
                                                      <input class="othServCheck" type="checkbox"/>
                                                      @lang('language.Want Reminder')
                                                    </label>
                                                    <br>

                                                    <input  type="datetime-local" class="othServText form-control" style="display:none"  />
                                                  </div>
                                                  <br>
                                            </div>
                                            <br>

                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="reset" class="btn btn-primary mr-1">@lang('language.Submit')</button>
                                            </div>
                                        </div>

                                        <br>
<!--
                                        <div class="row" id="table-responsive ">
                                            <div class="col-12">
                                                <div class="card">

                                                    <div class="table-responsive mt-2">
                                                        <table class="table mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" class="text-nowrap">#</th>
                                                                    <th scope="col" class="text-nowrap">Date/Time</th>
                                                                    <th scope="col" class="text-nowrap">Status</th>
                                                                    <th scope="col" class="text-nowrap">Link</th>

                                                                    <th scope="col" class="text-nowrap">Action</th>
                                                                    <th scope="col" class="text-nowrap">Recovered Date/Time</th>
                                                                    <th scope="col" class="text-nowrap">Recovered Amount</th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-nowrap">1</td>
                                                                    <td class="text-nowrap">2023-06-03 08:00:00</td>
                                                                    <td>sms not send</td>

                                                                    <td>1551.0</td>
                                                                    <td><button class="btn btn-primary">Edit Data</button></td>
                                                                    <td>0</td>
                                                                    <td>3567</td>





                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </form>
                                <div class="col-12">
                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn btn-success" data-dismiss="modal">@lang('language.Approved')</button>
                                    <div class="d-inline-block">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#primary">
                                        @lang('language.Upload Additional Doc')
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade text-left modal-primary" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel160">@lang('language.Add Additional Document')</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="mb-3">
                                                            <h4>GGI0020</h4>
                                                            <form action="" method="post" enctype="multipart/form-data">
                                                            <input type="hidden" name="_token" value="wrKF6K73lazf98Uii6Ee9hodIHkUJ8azqdgReljC">										<div class="mb-3">
                                                            <input type="hidden" value="20" name="claimid">
                                                            <label>@lang('language.Upload Document')</label>
                                                            <input type="file" class="form-control" multiple="" name="addFile[]" required="">
                                                        </div>

                                                        </form></div>


                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('language.Close')</button>

                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">@lang('language.Save')</button>
                                                    </div>
                                                </div>
                                            </div>
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



    </div>
</div>
<!-- END: Content-->
@endsection

@push('claim-detail-css')
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
@push('claim-detail-js')
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
@push('claim-detail-js-custom')
<script>
    $(document).ready(function(){
        $("#sectionChooser").change(function(){
          var name =  $("#sectionChooser").val();
          $(".panel").hide();
          $("."+name).show();

        })
    })

        </script>
     <script>
        $(function() {
      if ($('.othServCheck').prop('checked') == false) {
        $(this).parent().siblings([':datetime-local']).hide();
      }
      $('.othServCheck').click(function() {
        $(this).parent().siblings([':datetime-local']).toggle();
      });
    });
     </script>
@endpush


