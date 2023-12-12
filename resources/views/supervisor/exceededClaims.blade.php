@extends('layout.master')
@section('title', 'Exceeded Claims')

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
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">


                            <div class=" col-md-6  mb-1">

                                <div class="form-modal-ex">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#inlineForm">
                                        Search
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel33">Search</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="#">
                                                    @csrf
                                                    <section id="input-mask-wrapper">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h4 class="card-title">Search Anything you want
                                                                        </h4>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                <label for="credit-card">Claim
                                                                                    Id</label>
                                                                                <input type="text" class="form-control credit-card-mask" placeholder="Claim Id" id="credit-card" name="idclaim" />
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                <label for="phone-number">Claim
                                                                                    Number</label>
                                                                                <input type="text" name="claimno" class="form-control phone-number-mask" placeholder="Claim Number" id="phone-number" />

                                                                            </div>

                                                                            <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                <label for="time">Debtor
                                                                                    Name</label>
                                                                                <input type="text" name="debname" class="form-control time-mask" placeholder="Debtor Name" id="time" />
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                <label for="date">Date</label>
                                                                                <input type="text" name="accdate" class="form-control date-mask" placeholder="YYYY-MM-DD" id="date" />
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                <label for="numeral-formatting">Recovery
                                                                                    Amount</label>
                                                                                <input type="text" name="recoveryAmt" class="form-control numeral-mask" placeholder="Amount" id="numeral-formatting" />
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                <label for="blocks">Select
                                                                                    Location</label>
                                                                                <select class="form-control" name="accloc">

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


                                                                            <!-- <div
                                                                                    <?php
                                                                                    $users = DB::table('users')->where('status', 1)->get();
                                                                                    ?>
                                                                                    class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                    <label for="custom-delimiters">Select
                                                                                        User</label>
                                                                                    <select class="form-control"
                                                                                        name="ic_user">

                                                                                        <option value="">Select User</option>
                                                                                        @foreach($users as $user)
                                                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                                                        @endforeach

                                                                                    </select>
                                                                                </div> -->

                                                                            <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                <label for="date">Start
                                                                                    Date</label>
                                                                                <input type="text" name="start_date" class="form-control date-mask" placeholder="YYYY-MM-DD" id="date" />
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                <label for="date">End Date</label>
                                                                                <input type="text" name="end_date" class="form-control date-mask" placeholder="YYYY-MM-DD" id="date" />
                                                                            </div>

                                                                            <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                                                                <label for="date">Settlement Amount</label>
                                                                                <input type="text" name="settelAmt" class="form-control date-mask" placeholder="Settlement Amount" id="date" />
                                                                            </div>





                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Search</button>
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-4  mb-1">
                                <select class="custom-select" onchange="window.location.href = this.value;">

                                    <option value="">Claim Per Page</option>
                                    <option value="http://127.0.0.1:8000/admin/view-claims-beta/10">10</option>
                                    <option value="http://127.0.0.1:8000/admin/view-claims-beta/20">20</option>
                                    <option value="http://127.0.0.1:8000/admin/view-claims-beta/30">30</option>
                                    <option value="http://127.0.0.1:8000/admin/view-claims-beta/40">40</option>
                                    <option value="http://127.0.0.1:8000/admin/view-claims-beta/50">50</option>


                                </select>
                            </div>

                            <div class="col-md-2 mb-1">
                                <a style="width: 165px;" class="btn btn-outline-secondary " href="{{url('/exportclaims')}}">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share font-small-4 mr-50">
                                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                            <polyline points="16 6 12 2 8 6"></polyline>
                                            <line x1="12" y1="2" x2="12" y2="15">
                                            </line>
                                        </svg> Export Excel
                                </a>
                            </div>
                        </div>
                        <hr>

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
                                        <th scope="col" class="text-nowrap">@lang('language.Accident Date')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.Submission Date')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.Accident Location')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.Debtor Type')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.Debtor Name')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.Debtor Iqama')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.Status')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.After (30 & 60) Days')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.Assign Admin')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.Collected Via')</th>
                                        <th scope="col" class="text-nowrap">@lang('language.Action')</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($claims) > 0)
                                    @foreach ($claims as $claim)
                                    <tr>
                                        <!--<td><input class="form-check-input" type="checkbox" name="row[]" value="{{ $claim->id }}"></td>-->
                                        <!--</form>-->
                                        <td>RC00{{ $claim->id }}</td>
                                        <td>{{ username($claim->cid)}}</td>
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
                                        <td>{{ $claim->acc_date }}</td>
                                        @if ($claim->created_at)
                                        <td>2</td>
                                        @else
                                        <td>No data Found</td>
                                        @endif
                                        <td>{{ $claim->acc_location }}</td>
                                        <td>{{ $claim->deb_type }}</td>
                                        <td>{{ $claim->deb_name }}</td>
                                        <td>{{ $claim->deb_iqama }}</td>
                                        <td class="d-flex" style="justify-content:space-between">
                                            @if (claimstatus($claim->id) == 1)
                                            <span class="badge bg-primary text-light rounded" style="padding: 7px;">Follow Up</span>
                                            @elseif(claimstatus($claim->id) == 3)
                                            <span class="badge bg-primary text-light rounded" style="padding: 7px;">Delay
                                                Payment</span>
                                            @elseif(claimstatus($claim->id) == 4)
                                            <span class="badge bdage text-light rounded" style="padding: 7px;">Partial
                                                Payment</span>
                                            @elseif(claimstatus($claim->id) == 5)
                                            <span class="bg-primary badge text-light rounded" style="padding: 7px;">Transfer to
                                                Morror</span>
                                            @elseif(claimstatus($claim->id) == 6)
                                            <span class="bg-primary badge text-light rounded" style="padding: 7px;">Transfered To
                                                Lawyer</span>
                                            @elseif(claimstatus($claim->id) == 7)
                                            <span class="bg-primary badge text-light rounded" style="padding: 7px;">Transfer To Finance
                                                Co.</span>
                                            @elseif(claimstatus($claim->id) == 8)
                                            <span class="bg-primary badge text-light rounded" style="padding: 7px;">Transfer to
                                                ELM</span>
                                            @elseif(claimstatus($claim->id) == 9)
                                            <span class="bg-primary badge text-light rounded" style="padding: 7px;">Transfer to
                                                IC</span>
                                            @elseif(claimstatus($claim->id) == 10)
                                            <span class="bg-primary badge text-light rounded" style="padding: 7px;">Close</span>
                                            @elseif(claimstatus($claim->id) == 11)
                                            <span class="bg-primary badge text-light rounded" style="padding: 7px;">Registered</span>
                                            @elseif(claimstatus($claim->id) == 12)
                                            <span class="bg-danger badge text-light rounded" style="padding: 7px;">Closed</span>
                                            @elseif(claimstatus($claim->id) == 13)
                                            <span class="bg-success badge text-light rounded" style="padding: 7px;">Collected</span>
                                            @elseif(claimstatus($claim->id) == 14)
                                            <span class="bg-danger badge text-light rounded" style="padding: 7px;">Objection</span>
                                            @elseif(claimstatus($claim->id) == 15)
                                            <span class="badge  badge text-light rounded" style="padding: 7px;">Refused</span>
                                            @elseif(claimstatus($claim->id) == 16)
                                            <!--direct pay-->
                                            <span class="bg-danger badge text-light rounded" style="padding: 7px;">Collected</span>
                                            @elseif(claimstatus($claim->id) == 17)
                                            <span class="bg-success badge text-light rounded" style="padding: 7px;">Approved</span>
                                            @elseif(claimstatus($claim->id) == 18)
                                            <span class="bg-danger badge text-light rounded" style="padding: 7px;">Rejected</span>
                                            @elseif(claimstatus($claim->id) == 1)
                                            <span class="bg-secondary badge text-light rounded" style="padding: 7px;">Follow up</span>
                                            @elseif(claimstatus($claim->id) == 19)
                                            <span class="bg-success badge text-light rounded" style="padding: 7px;">Collected By
                                                Insurance</span>

                                            @else


                                            @endif
                                        </td>
                                        <td>
                                            <?php

                                            $today = \Carbon\Carbon::now();
                                            $thirtyDaysAgo = $today->subDays(30);
                                            $today = \Carbon\Carbon::now(); // Reset $today to the current date
                                            $sixtyDaysAgo = $today->subDays(60);
                                            ?>                                           
                                            @if($claim->updated_at <= $thirtyDaysAgo)
                                             <span>After thirty days</span>
                                             
                                            @endif
                                            @if(($claim->updated_at <= $sixtyDaysAgo))
                                            <span>After Sixty days</span>
                                            @endif


                                        </td>
                                        <td>
                                            @if ($claim->is_assign)
                                            {{ username($claim->is_assign)}}
                                            @else
                                            N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if (is_array(collectedVia($claim->id)))
                                            {{ collectedVia($claim->id)[0] }} {{ collectedVia($claim->id)[1] }}
                                            @elseif(claimstatus($claim->id) == 4)
                                            {{ recoveryAmt($claim->id) }}
                                            @else
                                            {{ collectedVia($claim->id) }}
                                            @endif

                                        </td>


                                        @php

                                        $doc = DB::table('supported-doc')->where('company_id', $claim->cid)->pluck('doc_name')->first();
                                        @endphp
                                        <td>
                                            <!-- <form>
                                                        <input type="hidden" name="id" value="{{ $claim->id }}">
                                                        <button class="btn btn-outline-danger">Delete</button>
                                                    </form> -->
                                            @if(request()->is('supervisor/*'))
                                            <a href="{{ route('supervisor.claim.detail', $claim->id) }}" target="_blank">
                                                                    <svg stroke="currentColor" fill="currentColor"
                                                                        stroke-width="0" viewBox="0 0 576 512"
                                                                        height="16" width="16"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z">
                                                                        </path>
                                                                    </svg>
</a>
                                            @endif
                                        </td>

                                    </tr>
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
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
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
@endpush