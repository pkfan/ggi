@extends('layout.master')
@section('title', 'view claims')

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
                        <h4>@lang('language.CLAIM DATA')


                        </h4>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                                {{-- <div class="input-group col-6 row">
                                    <input type="text" class="form-control col-6"
                                        aria-describedby="button-addon2">

                                    <select class="form-control col-4" id="basicSelect">
                                        <option>IT</option>
                                        <option>Blade Runner</option>
                                        <option>Thor Ragnarok</option>
                                    </select>

                                    <div class="input-group-append" id="button-addon2">
                                        <button class="btn btn-primary waves-effect" type="button" style="padding: 0 13px;">
                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="16" width="16" xmlns="http://www.w3.org/2000/svg"><path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path></svg>
                                        </button>
                                    </div>
                                </div> --}}

                                <div class=" col-md-6  mb-1">

                                    <div class="form-modal-ex">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#inlineForm">
                                            Search
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel33" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel33">Search & Filter Claims</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="@if(request()->is('admin/*')) {{route('AdminViewClaims')}} @elseif (request()->is('supervisor/*')) {{route('supervisor.claims')}} @else {{route('officer.claims')}} @endif">
                                                        <section id="input-mask-wrapper">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            {{-- <h4 class="card-title">Search Anything you want
                                                                            </h4> --}}
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="credit-card">Claim
                                                                                        Id</label>
                                                                                    <input type="text"
                                                                                        class="form-control credit-card-mask"
                                                                                        placeholder="Claim Id"
                                                                                        id="credit-card"
                                                                                        name="idclaim"/>
                                                                                </div>
                                                                                <div
                                                                                    class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="phone-number">Claim
                                                                                        Number</label>
                                                                                    <input type="text"
                                                                                        class="form-control phone-number-mask"
                                                                                        placeholder="Claim Number"
                                                                                        id="phone-number"
                                                                                        name="claimno" />

                                                                                </div>

                                                                                <div
                                                                                    class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="time">Debtor
                                                                                        Name</label>
                                                                                    <input type="text"
                                                                                        class="form-control time-mask"
                                                                                        placeholder="Debtor Name"
                                                                                        id="time" name="debname"/>
                                                                                </div>
                                                                                <div
                                                                                    class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="date">Loss Date</label>
                                                                                    <input type="text"
                                                                                        class="form-control date-mask"
                                                                                        placeholder="YYYY-MM-DD"
                                                                                        id="date" name="accdate" />
                                                                                </div>
                                                                                <div
                                                                                    class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="numeral-formatting">Settlement
                                                                                        Amount</label>
                                                                                    <input type="text"
                                                                                        class="form-control numeral-mask"
                                                                                        placeholder="Amount"
                                                                                        id="numeral-formatting" name="settelAmt" />
                                                                                </div>
                                                                                <div
                                                                                    class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="numeral-formatting">Recovery
                                                                                        Amount</label>
                                                                                    <input type="text"
                                                                                        class="form-control numeral-mask"
                                                                                        placeholder="Amount"
                                                                                        id="numeral-formatting" name="recoveryAmt"/>
                                                                                </div>
                                                                                <div
                                                                                    class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="blocks">Select City</label>
                                                                                    <select class="form-control"
                                                                                        name="accloc">

                                                                                        <option value=""> -- select city --
                                                                                        </option>

                                                                                        <option value="الرياض">الرياض
                                                                                        </option>
                                                                                        <option value="جدة">جدة</option>
                                                                                        <option value="الدمام">الدمام
                                                                                        </option>
                                                                                        <option value="مكة المكرمة">مكة
                                                                                            المكرمة</option>
                                                                                        <option value="المدينة المنورة">
                                                                                            المدينة المنورة</option>
                                                                                        <option value="الخبر">الخبر
                                                                                        </option>
                                                                                        <option value="الظهران">الظهران
                                                                                        </option>
                                                                                        <option value="الاحساء">الاحساء
                                                                                        </option>
                                                                                        <option value="Artawiya">Artawiya
                                                                                        </option>
                                                                                        <option value="الطائف">الطائف
                                                                                        </option>
                                                                                        <option value="جازان">جازان
                                                                                        </option>
                                                                                        <option value="بريدة">بريدة
                                                                                        </option>
                                                                                        <option value="تبوك">تبوك</option>
                                                                                        <option value="القطيف">القطيف
                                                                                        </option>
                                                                                        <option value="خميس مشيط">خميس مشيط
                                                                                        </option>
                                                                                        <option value="حفر الباطن">حفر
                                                                                            الباطن</option>
                                                                                        <option value="الجبيل">الجبيل
                                                                                        </option>
                                                                                        <option value="الخرج">الخرج
                                                                                        </option>
                                                                                        <option value="أبها">أبها
                                                                                        </option>
                                                                                        <option value="حائل">حائل
                                                                                        </option>
                                                                                        <option value="نجران">نجران
                                                                                        </option>
                                                                                        <option value="ينبع">ينبع
                                                                                        </option>
                                                                                        <option value="صبيا">صبيا
                                                                                        </option>
                                                                                        <option value="الدوادمي">الدوادمي
                                                                                        </option>
                                                                                        <option value="بيشة">بيشة
                                                                                        </option>
                                                                                        <option value="أبو عريش">أبو عريش
                                                                                        </option>
                                                                                        <option value="القنفذة">القنفذة
                                                                                        </option>
                                                                                        <option value="محايل عسير">محايل
                                                                                            عسير</option>
                                                                                        <option value="سكاكا">سكاكا
                                                                                        </option>
                                                                                        <option value="عرعر">عرعر
                                                                                        </option>
                                                                                        <option value="عنيزة">عنيزة
                                                                                        </option>
                                                                                        <option value="القريات">القريات
                                                                                        </option>
                                                                                        <option value="صامطة">صامطة
                                                                                        </option>
                                                                                        <option value="المجمعة">المجمعة
                                                                                        </option>
                                                                                        <option value="القويعية">القويعية
                                                                                        </option>
                                                                                        <option value="أحد المسارحة">أحد
                                                                                            المسارحة</option>
                                                                                        <option value="الرس">الرس
                                                                                        </option>
                                                                                        <option value="الباحة">الباحة
                                                                                        </option>
                                                                                        <option value="الجموم">الجموم
                                                                                        </option>
                                                                                        <option value="رابغ">رابغ
                                                                                        </option>
                                                                                        <option value="شرورة">شرورة
                                                                                        </option>
                                                                                        <option value="الليث">الليث
                                                                                        </option>
                                                                                        <option value="رفحاء">رفحاء
                                                                                        </option>
                                                                                        <option value="عفيف">عفيف
                                                                                        </option>
                                                                                        <option value="الخفجي">الخفجي
                                                                                        </option>
                                                                                        <option value="الدرعية">الدرعية
                                                                                        </option>
                                                                                        <option value="طبرجل">طبرجل
                                                                                        </option>
                                                                                        <option value="بيش">بيش</option>
                                                                                        <option value="الزلفي">الزلفي
                                                                                        </option>
                                                                                        <option value="الدرب">الدرب
                                                                                        </option>
                                                                                        <option value="سراة عبيدة">سراة
                                                                                            عبيدة</option>
                                                                                        <option value="رجال المع">رجال المع
                                                                                        </option>
                                                                                        <option value="الأفلاج">الأفلاج
                                                                                        </option>
                                                                                        <option value="بلجرشي">بلجرشي
                                                                                        </option>
                                                                                        <option value="وادي الدواسر">وادي
                                                                                            الدواسر</option>
                                                                                        <option value="أحد رفيدة">أحد رفيدة
                                                                                        </option>
                                                                                        <option value="بدر">بدر</option>
                                                                                        <option value="أملج">أملج
                                                                                        </option>
                                                                                        <option value="رأس تنورة">رأس تنورة
                                                                                        </option>
                                                                                        <option value="المهد">المهد
                                                                                        </option>
                                                                                        <option value="البكيرية">البكيرية
                                                                                        </option>
                                                                                        <option value="البدائع">البدائع
                                                                                        </option>
                                                                                        <option value="الحناكية">الحناكية
                                                                                        </option>
                                                                                        <option value="العلا">العلا
                                                                                        </option>
                                                                                        <option value="الطوال">الطوال
                                                                                        </option>
                                                                                        <option value="النماص">النماص
                                                                                        </option>
                                                                                        <option value="المجاردة">المجاردة
                                                                                        </option>
                                                                                        <option value="بقيق">بقيق
                                                                                        </option>
                                                                                        <option value="تثليث">تثليث
                                                                                        </option>
                                                                                        <option value="النعيرية">النعيرية
                                                                                        </option>
                                                                                        <option value="المخواة">المخواة
                                                                                        </option>
                                                                                        <option value="الوجه">الوجه
                                                                                        </option>
                                                                                        <option value="ضباء">ضباء
                                                                                        </option>
                                                                                        <option value="بارق">بارق
                                                                                        </option>
                                                                                        <option value="خيبر">خيبر
                                                                                        </option>
                                                                                        <option value="طريف">طريف
                                                                                        </option>
                                                                                        <option value="رنية">رنية
                                                                                        </option>
                                                                                        <option value="دومة الجندل">دومة
                                                                                            الجندل</option>
                                                                                        <option value="المذنب">المذنب
                                                                                        </option>
                                                                                        <option value="تربة">تربة
                                                                                        </option>
                                                                                        <option value="ظهران الجنوب">ظهران
                                                                                            الجنوب</option>
                                                                                        <option value="حوطة بني تميم">حوطة
                                                                                            بني تميم</option>
                                                                                        <option value="الخرمة">الخرمة
                                                                                        </option>
                                                                                        <option value="شقراء">شقراء
                                                                                        </option>
                                                                                        <option value="المزاحمية">المزاحمية
                                                                                        </option>
                                                                                        <option value="الأسياح">الأسياح
                                                                                        </option>
                                                                                        <option value="السليل">السليل
                                                                                        </option>
                                                                                        <option value="تيماء">تيماء
                                                                                        </option>
                                                                                        <option value="الارطاوية">الارطاوية
                                                                                        </option>
                                                                                        <option value="ضرمة">ضرمة
                                                                                        </option>
                                                                                        <option value="الحريق">الحريق
                                                                                        </option>
                                                                                        <option value="حقل">حقل</option>

                                                                                        <option value="حريملاء">حريملاء
                                                                                        </option>
                                                                                        <option value="جلاجل">جلاجل
                                                                                        </option>
                                                                                        <option value="المبرز">المبرز
                                                                                        </option>
                                                                                        <option value="القيصومة">القيصومة
                                                                                        </option>
                                                                                        <option value="سبت العلايا">سبت
                                                                                            العلايا</option>
                                                                                        <option value="صفوة">صفوة
                                                                                        </option>
                                                                                        <option value="سيهات">سيهات
                                                                                        </option>
                                                                                        <option value="تنومة">تنومة
                                                                                        </option>
                                                                                        <option value="تاروت">تاروت
                                                                                        </option>
                                                                                        <option value="ثادق">ثادق
                                                                                        </option>
                                                                                        <option value="الثقبة">الثقبة
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                                @if (! request()->is('officer/*'))
                                                                                    <div
                                                                                        class="col-xl-4 col-md-6 col-sm-12 mb-2">

                                                                                        <x-select-officer label="Selct Officer" name="assign_admin"/>
                                                                                    </div>

                                                                                @endif

                                                                                <div
                                                                                    class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="date">Start
                                                                                        Date</label>
                                                                                    <input type="text"
                                                                                        class="form-control date-mask"
                                                                                        placeholder="YYYY-MM-DD"
                                                                                        id="date" name="start_date" />
                                                                                </div>
                                                                                <div
                                                                                    class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="date">End Date</label>
                                                                                    <input type="text"
                                                                                        class="form-control date-mask"
                                                                                        placeholder="YYYY-MM-DD"
                                                                                        id="date" name="end_date"/>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <label>Search By Status</label>
                                                                                         <select  name="claimStatus" class="form-control">
                                                                                            <option value="">Select Status</option>
                                                                                            <option value="reg">Registered</option>
                                                                                            <option value="app">Approved</option>
                                                                                            <option value="rej">Rejected</option>
                                                                                            <option value="1">Follow up with reminder</option>
                                                                                            <option value="2">Collected</option>
                                                                                            <option value="12">Follow up without reminder</option>
                                                                                            <option value="3">Delay Settlement</option>
                                                                                            <option value="4">Partial Settlement</option>
                                                                                            <option value="5">Transfer to Morror</option>
                                                                                            <option value="6">Transfer to Lawyer</option>
                                                                                          
                                                                                            <option value="10">Close</option>
                                                                                            
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="rec_reason">Recovery Reason</label>
                                                                                    <input type="text" class="form-control" name="rec_reason">
                                                                                    
                                                                                </div>
                                                                                
                                                                                <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="art_remark">Art Remarks</label>
                                                                                    <input type="text" class="form-control" name="art_remark">
                                                                                    
                                                                                </div>
                                                                                
                                                                                <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="filter">Amount Filter</label>
                                                                                   <select name="filter" class="form-control"> 
                                                                                        <option value="">Select Filter</option>
                                                                                        <option value="lowHigh">Low - High</option>
                                                                                        <option value="highLow">High - Low</option>
                                                                                    </select>
                                                                                    
                                                                                </div>
                                                                                    
                                                                                

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary"
                                                                >Search</button>

                                                            <a href="@if(request()->is('admin/*')) {{route('AdminViewClaims')}} @elseif (request()->is('supervisor/*')) {{route('supervisor.claims')}} @else {{route('officer.claims')}} @endif" class="btn btn-warning"
                                                                >Clear Filter Results</a>

                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-4  mb-1">
                                    <select class="custom-select"  onchange="onChangeClaimPerPageFilter(this);">

                                        <option value="">Claim Per Page</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>

                            </div>
                            {{-- <hr> --}}

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap">@lang('language.Claim ID')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.User Name')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Claim Number')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Debtor Number')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Owner Type')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Recovery Amount')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Recovery Reason')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.GGI Remark')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Accident Date')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Submission Date')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Accident Location')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Debtor Type')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Debtor Name')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Debtor Iqama')</th>
                                            <th scope="col" class="text-nowrap" style="min-width: 180px;">@lang('language.Status')</th>
                                            <th scope="col" class="text-nowrap">@lang('language.Assign Admin')</th>
                                            <th scope="col" class="text-nowrap" style="min-width: 150px;">
                                                @lang('language.Collected Via')</th>
                                                <th scope="col" class="text-nowrap" style="min-width: 150px;">
                                                @lang('language.Our Responsipility Per')</th>
                    
                                            <th scope="col" class="text-nowrap">@lang('language.Action')</th>



                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @if (is_array($claims) || is_object($claims))
                                            @foreach ($claims as $claim)
                                                <tr @if ($count % 2 == 0) style="background: #ebebeb;" @endif>
                                                    <!--<td><input class="form-check-input" type="checkbox" name="row[]" value="{{ $claim->id }}"></td>-->
                                                    <!--</form>-->
                                                    <td>GGI{{ $claim->id }}</td>
                                                    <td>{{ username($claim->cid) }}</td>
                                                    <td>{{ $claim->claim_no }}</td>
                                                    <td>
                                                        @if ($claim->deb_mob != null)
                                                            {{ $claim->deb_mob }}
                                                        @else
                                                            ELM Case
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($claim->type == 'ind')
                                                            Individual
                                                        @elseif($claim->type != null)
                                                            {{ $claim->type }}
                                                        @else
                                                            Not Defined
                                                        @endif
                                                    </td>

                                                    <td>{{ $claim->amount_after_discount }}</td>
                                                    <td>{{$claim->rec_reason}}</td>
                                                    <td>{{$claim->claimData?->remarks}}</td>
                                                    <td>{{ $claim->acc_date }}</td>
                                                    @if ($claim->created_at)
                                                        <td>20{{ $claim->created_at->format('y-m-d') }}</td>
                                                    @else
                                                        <td>No data Found</td>
                                                    @endif
                                                    <td>{{ $claim->acc_location }}</td>
                                                    <td>{{ $claim->deb_type }}</td>
                                                    <td>{{ $claim->deb_name }}</td>
                                                    <td>{{ $claim->deb_iqama }}</td>
                                                    <td class="d-flex" style="justify-content:space-between">
                                                        @if (claimstatus($claim->id) == 2)
                                                            <span class="bg-primary text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">تم السداد - كامل</span>
                                                        @elseif(claimstatus($claim->id) == 3)
                                                            <span class="bg-primary text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">وعد سداد</span>
                                                        @elseif(claimstatus($claim->id) == 4)
                                                            <span class="bg-primary text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">تم السداد - جزئي</span>
                                                        @elseif(claimstatus($claim->id) == 5)
                                                            <span class="bg-primary text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">Transfer
                                                                to
                                                                Morror</span>
                                                        @elseif(claimstatus($claim->id) == 6)
                                                            <span class="bg-primary text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">رفض السداد</span>
                                                        @elseif(claimstatus($claim->id) == 7)
                                                            <span class="bg-primary text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">Transfer
                                                                To
                                                                Finance
                                                                Co.</span>
                                                        @elseif(claimstatus($claim->id) == 8)
                                                            <span class="bg-primary text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">Transfer
                                                                to
                                                                ELM</span>
                                                        @elseif(claimstatus($claim->id) == 9)
                                                            <span class="bg-primary text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">Transfer
                                                                to
                                                                IC</span>
                                                        @elseif(claimstatus($claim->id) == 10)
                                                            <span class="bg-primary text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">حذف المسترد</span>
                                                        @elseif(claimstatus($claim->id) == 11)
                                                            <span class="bg-primary text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">معلق</span>
                                                        @elseif(claimstatus($claim->id) == 12)
                                                            <span class="bg-danger text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">حذف المسترد</span>
                                                        @elseif(claimstatus($claim->id) == 13)
                                                            <span class="bg-success text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">Collected</span>
                                                        @elseif(claimstatus($claim->id) == 14)
                                                            <span class="bg-danger text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">Objection</span>
                                                        @elseif(claimstatus($claim->id) == 15)
                                                            <span class="bg-danger text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">Refused</span>
                                                        @elseif(claimstatus($claim->id) == 16)
                                                            <!--direct pay-->
                                                            <span class="bg-danger text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">تم السداد - كامل</span>
                                                        @elseif(claimstatus($claim->id) == 17)
                                                            <span class="bg-success text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">معلق</span>
                                                        @elseif(claimstatus($claim->id) == 18)
                                                            <span class="bg-danger text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">Rejected</span>
                                                        @elseif(claimstatus($claim->id) == 1)
                                                            <span class="bg-secondary text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">معلق</span>
                                                        @elseif(claimstatus($claim->id) == 19)
                                                            <span class="bg-success text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">Collected
                                                                By
                                                                Insurance</span>
                                                        @elseif(claimstatus($claim->id) == 20)
                                                        <span class="bg-dark text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">Legal Deparment
                                                                </span>
                                                                @elseif(claimstatus($claim->id) == 21)
                                                                
                                                        <span class="bg-warning text-dark"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">Collection Office
                                                                </span>
                                                                @elseif(claimstatus($claim->id) == 22)
                                        
                                                                <span class=""
                                                                        style="background-color:#F4D03F; border-radius: 4px;padding: 6px;font-size: 12px;width: 100%; text-color:black;">Back To Supervisor
                                                                        </span>

                                                        @else
                                                            <span class="bg-danger text-light"
                                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;">Undefined</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        
                                                        @if ($claim->is_assign)
                                                            {{ username($claim->is_assign) }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (is_array(collectedVia($claim->id)))
                                                            {{ collectedVia($claim->id)[0] }}
                                                            {{ collectedVia($claim->id)[1] }}
                                                        @elseif(claimstatus($claim->id) == 4)
                                                            {{ recoveryAmt($claim->id) }}
                                                        @else
                                                            {{ collectedVia($claim->id) }}
                                                        @endif

                                                    </td>


                                                    @php

                                                        $doc = DB::table('supported-doc')
                                                            ->where('company_id', $claim->cid)
                                                            ->pluck('doc_name')
                                                            ->first();
                                                    @endphp
                                                    <td>{{$claim->our_responsipility_per}}</td>
                                                    <td>
                                                        <div class="d-flex" style="gap: 4px;">
                                                            <!-- <form>
                                                                                        <input type="hidden" name="id" value="{{ $claim->id }}">
                                                                                        <button class="btn btn-outline-danger">Delete</button>
                                                                                    </form> -->
                                                            @if (request()->is('officer/*'))
                                                                <a class="btn btn-outline-gradient" target="_blank"
                                                                    href="{{ route('officer.claim.detail', $claim->id) }}">
                                                                    <svg stroke="currentColor" fill="currentColor"
                                                                        stroke-width="0" viewBox="0 0 576 512"
                                                                        height="16" width="16"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                                <a class="btn btn-outline-gradient" target="_blank"
                                                                    href="{{ route('officer.edit-claim.id', $claim->id) }}">
                                                                    <svg stroke="currentColor" fill="none"
                                                                        stroke-width="2" viewBox="0 0 24 24"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        height="1em" width="1em"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                                        </path>
                                                                        <path
                                                                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                            @elseif(request()->is('supervisor/*'))
                                                                <a class="btn btn-outline-gradient" target="_blank"
                                                                    href="{{ route('supervisor.claim.detail', $claim->id) }}">
                                                                    <svg stroke="currentColor" fill="currentColor"
                                                                        stroke-width="0" viewBox="0 0 576 512"
                                                                        height="16" width="16"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                                <a class="btn btn-outline-gradient" target="_blank"
                                                                    href="{{ route('supervisor.edit-claim.id', $claim->id) }}">
                                                                    <svg stroke="currentColor" fill="none"
                                                                        stroke-width="2" viewBox="0 0 24 24"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        height="1em" width="1em"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                                        </path>
                                                                        <path
                                                                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                            @else
                                                                <a href="{{ route('AdminClaimDetail', $claim->id) }}">
                                                                    <svg stroke="currentColor" fill="currentColor"
                                                                        stroke-width="0" viewBox="0 0 576 512"
                                                                        height="16" width="16"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                                <a href="{{ url('admin/edit-claim/' . $claim->id) }}">
                                                                    <svg stroke="currentColor" fill="none"
                                                                        stroke-width="2" viewBox="0 0 24 24"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        height="1em" width="1em"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                                        </path>
                                                                        <path
                                                                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </td>

                                                </tr>
                                                @php
                                                    $count++;
                                                @endphp
                                            @endforeach
                                        @else
                                        @endif
                                    </tbody>
                                </table>
                            </div>
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

@push('view-claims-css')
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
@push('view-claims-js')
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


    <script>

        function pkfan_searchQuery_to_object(){
            if(window.location.search){
                //remove "?" sign from search string url
                var searchString = window.location.search.substring(1);

                //transform queryString into ['paginate=10', 'amir=12', 'rizwan=wrew']
                searchStringArray = searchString.split('&');

                queryStringObject = {};

                searchStringArray.forEach(nameValue=>{
                        let [name,value] = nameValue.split('=');
                        queryStringObject[name] = value;
                });

                return queryStringObject;
            }
            else {
                return {};
            }
        }

        function pkfan_object_to_searchQuery(queryStringObject){
            var queryStringAgain = '';

            var nameValueCounter = 1;

            for(let [name,value] of Object.entries(queryStringObject)){

                if(nameValueCounter == 1){
                    name = `?${name}`;
                }
                else{
                    name = `&${name}`;
                }

                queryStringAgain = `${queryStringAgain}${name}=${value}`;

                nameValueCounter++;
            }

            return queryStringAgain;
        }

        function onChangeClaimPerPageFilter(event){
            var paginate = event.value;

            var searchQueryObject = pkfan_searchQuery_to_object();

            searchQueryObject['paginate'] = paginate;

            var newSearchQuery = pkfan_object_to_searchQuery(searchQueryObject);

            var fullUrlWithQuerySearch = `${window.location.origin}${window.location.pathname}${newSearchQuery}`;

            console.log(fullUrlWithQuerySearch);

            window.location = fullUrlWithQuerySearch;
        }



    </script>
@endpush
