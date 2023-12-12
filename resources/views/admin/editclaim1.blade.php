@extends('layout.master')
@section('title', 'Edit Claim')

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


                <!-- Basic Tables start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">


                                        @lang('language.Edit Claim')
                                    </h4>
                                </div>
                               
                                <div class="card-body">
                                    <form class="form" method="POST" action="{{ route('admin.claim.update') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name='claim_id' value="{{ $claim->id }}">
                                        <input type="hidden" name='claim_data_id' value="{{ $claim->claimData?->id }}">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">@lang('language.Reserve Amount') </label>
                                                    <input type="text" id="first-name-column" class="form-control"
                                                        value="{{ old('rec_amt') ?? $claim->rec_amt }}" name="rec_amt" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">@lang('language.Claim Number') </label>
                                                    <input type="text" id="last-name-column" class="form-control"
                                                        name="claim_no" value="{{ old('claim_no') ?? $claim->claim_no }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">@lang('language.Vehicle Type') </label>
                                                    <input type="text" id="last-name-column" class="form-control"
                                                        name="vehicle_type"
                                                        value="{{ old('vehicle_type') ?? $claim->claimData?->vehicle_type }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">@lang('language.Vehicle Make') </label>
                                                    <input type="text" id="last-name-column" class="form-control"
                                                        name="vehicle_make"
                                                        value="{{ old('vehicle_make') ?? $claim->claimData?->vehicle_make }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">@lang('language.MT Plate No') </label>
                                                    <input type="text" id="last-name-column" class="form-control"
                                                        name="plate_no"
                                                        value="{{ old('plate_no') ?? $claim->claimData?->plate_no }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">@lang('language.Policy Number') </label>
                                                    <input type="text" id="last-name-column" class="form-control"
                                                        name="policy_no"
                                                        value="{{ old('policy_no') ?? $claim->claimData?->policy_no }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">@lang('language.City')</label>
                                                    <select class="form-control" name="acc_location">
                                                        <option value="{{ $claim->acc_location }}" selected>
                                                            {{ $claim->acc_location }}</option>
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
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Art Remarks</label>
                                                    <input type="text" id="first-name-column" class="form-control"
                                                        name="remarks"
                                                        value="{{ old('remarks') ?? $claim->claimData?->remarks }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">@lang('language.Accident Report Number')</label>
                                                    <input type="text" id="first-name-column" class="form-control"
                                                        name="accident_report_number"
                                                        value="{{ old('accident_report_number') ?? $claim->claimData?->accident_report_number }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">@lang('language.Accident Date') </label>
                                                    <input type="date" id="first-name-column" class="form-control"
                                                        name="acc_date"
                                                        value="{{ old('acc_date') ?? $claim->acc_date }}" />
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">@lang('language.Loss Date') </label>
                                                    <input type="date" id="first-name-column" class="form-control"
                                                        name="loss_date"
                                                        value="{{ old('loss_date') ?? $claim->claimData?->loss_date }}" />
                                                </div>
                                            </div> --}}
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">@lang('language.Registration Date') </label>
                                                    <input type="date" id="first-name-column" class="form-control"
                                                        name="registration_date"
                                                        value="{{ old('registration_date') ?? $claim->claimData?->registration_date }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">@lang('language.Recoveree Name')</label>
                                                    <input type="text" id="first-name-column" class="form-control"
                                                        name="deb_name"
                                                        value="{{ old('deb_name') ?? $claim->deb_name }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">@lang('language.Recovery Type')</label>
                                                    <input type="text" id="first-name-column" class="form-control"
                                                        name="recovery_type"
                                                        value="{{ old('recovery_type') ?? $claim->claimData?->recovery_type }}" />
                                                </div>
                                            </div>

                                            <!-- <div class="col-md-6 col-12">
                                                                        <div class="form-group">
                                                                            <label for="last-name-column">IC Email</label>
                                                                            <input type="text" id="last-name-column" class="form-control"
                                                                                 name="icemail"   value="{{ old('icemail') }}"  />
                                                                        </div>
                                                                    </div> -->

                                            <div class="col-md-6 col-12" id="divIqama">
                                                <div class="form-group">
                                                    <label for="inputEmail" class="form-label">Debtor ID <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" onkeypress="return event.charCode >= 48"
                                                        min="1"
                                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                        maxlength="10" class="form-control" id="deb_iqama"
                                                        name="deb_iqama"
                                                        value="{{ old('deb_iqama') ?? $claim->deb_iqama }}"
                                                        maxlength="10">
                                                    @error('deb_iqama')
                                                        <span class="text-danger">Iqama Number is not valid</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="inputEmail" class="form-label">@lang('language.Debtor Age') <span
                                                            class="text-danger"></span></label>
                                                    <input type="number" onkeypress="return event.charCode >= 48"
                                                        min="1"
                                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                        type="number" maxlength="3" max="150"
                                                        class="form-control" id="inputEmail" name="deb_age"
                                                        value="{{ old('deb_age') ?? $claim->deb_age }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column">@lang('language.Debtor Mobile Number') </label>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">+966</span>
                                                        </div>
                                                        <input type="number" class="form-control" aria-label="Username"
                                                            aria-describedby="basic-addon1" name="deb_mob"
                                                            value="{{ old('deb_mob') ?? substr($claim->deb_mob, 4) }}" />
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- /////////////// --}}
                                            <div class="col-md-6 col-12">
                                                <label for="inputEmail" class="form-label">@lang('language.Type') <span
                                                        class="text-danger">*</span></label>
                                                <div class="demo-inline-spacing form-control">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" value="ind"
                                                            name="type"
                                                            aria-label="Radio button for following text input" required
                                                            @if ($claim->type == 'ind') checked @endif>
                                                        {{-- <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked /> --}}
                                                        <label class="form-check-label rad"
                                                            for="inlineRadio1">@lang('language.Ind')</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" value="Corporate"
                                                            name="type" @if ($claim->type == 'Corporate') checked @endif
                                                            aria-label="Radio button for following text input" required>
                                                        {{-- <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked /> --}}
                                                        <label class="form-check-label rad"
                                                            for="inlineRadio1">@lang('language.Corporate')</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" value="Leasing"
                                                            name="type" @if ($claim->type == 'Leasing') checked @endif
                                                            aria-label="Radio button for following text input" required>
                                                        <label class="form-check-label rad"
                                                            for="inlineRadio2">@lang('language.Leasing')</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" value="Government"
                                                            name="type" @if ($claim->type == 'Government') checked @endif
                                                            aria-label="Radio button for following text input" required>
                                                        <label class="form-check-label rad "
                                                            for="inlineRadio3">@lang('language.Government')</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            value="Minuciplity" name="type"
                                                            @if ($claim->type == 'Minuciplity') checked @endif
                                                            aria-label="Radio button for following text input" required>
                                                        <label class="form-check-label rad"
                                                            for="inlineRadio4">@lang('language.Minuciplity')</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">@lang('language.Our Responsipility Per') </label>
                                                    <select class="form-control" name="libpercent">
                                                        <option value="{{ $claim->libpercent }}" selected>
                                                            {{ $claim->libpercent }}</option>
                                                        <option value="100">100%</option>
                                                        <option value="75">75%</option>
                                                        <option value="50">50%</option>
                                                        <option value="25">25%</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column"> @lang('language.Select Debtor Type')</label>
                                                    <select id="debtorType" class="form-control" name="deb_type">
                                                        <option value="{{ $claim->deb_type }}" selected>
                                                            {{ $claim->deb_type }}</option>
                                                        <option value="insured"> @lang('language.Insured')</option>
                                                        <option value="third party">@lang('language.Third Party')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12" id="recoveryReason">
                                                <div class="form-group">
                                                    <label for="inputPassword" class="form-label"> @lang('language.Select Recovery Reason')
                                                        <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="rec_reason">
                                                        <option value='' disabled selected> @lang('language.Select Recovery Reason')
                                                        </option>
                                                        <option
                                                            value='Used in contravention of the restrictions set forth in the Policy schedule'>
                                                            @lang('language.Used in contravention of the restrictions set forth in the Policy schedule')
                                                        </option>
                                                        <option
                                                            value=' Carrying a number of passengers exceeding the seating capacity of the vehicle'>
                                                            @lang('language.Carrying a number of passengers exceeding the seating capacity of the vehicle')
                                                        </option>
                                                        <option value='Driven against the direction of traffic.'>
                                                            @lang('language.Driven against the direction of traffic')
                                                            .</option>
                                                        <option
                                                            value=' Driven under the influence of drugs, alcohol or medications '>
                                                            @lang('language.Driven under the influence of drugs, alcohol or medications')
                                                        </option>
                                                        <option
                                                            value='Driven by a person under the age of 18 (according to the Hijri calendar) '>
                                                            @lang('language.Driven by a person under the age of 18 according to the Hijri calendar')
                                                        </option>
                                                        <option
                                                            value='Driven by a person who does not hold a proper class of license driver’s license is forfeited by a competent entity '>
                                                            @lang('language.Driven by a person who does not hold a proper class of license drivers license is forfeited by a competent entity')
                                                        </option>
                                                        <option
                                                            value='The license was expired and it wasn’t renewed within (50) working days from the date of the accvalueent.'>
                                                            @lang('language.The license was expired and it was not renewed within 50 working days from the date of the accvalueent')
                                                        </option>
                                                        <option
                                                            value='The driver escaped the scene of the accvalueent for no acceptable reason.'>
                                                            @lang('language.The driver escaped the scene of the accvalueent for no acceptable reason')
                                                            .</option>
                                                        <option value='Running a red light.'>@lang('language.Running a red light').</option>
                                                        <option
                                                            value='Submitting inaccurate information in the insurance proposal form concealing material facts.'>
                                                            @lang('language.Submitting inaccurate information in the insurance proposal form concealing material facts').</option>
                                                        <option
                                                            value='If it is proved that the accvalueent was deliberate.'>
                                                            @lang('language.If it is proved that the accvalueent was deliberate').</option>
                                                        <option
                                                            value='The insured dvaluen’t notify the insurer within (20) working days of any material changes '>
                                                            @lang('language.The insured dvaluen’t notify the insurer within (20) working days of any material changes') </option>
                                                        {{-- <option value='The vehicle was stolen or taken forcibly '> @lang('language.The vehicle was stolen or taken forcibly') </option>
                                                        <option value='Proven Fraud '>@lang('language.Proven Fraud') </option> --}}
                                                    </select>
                                                </div>
                                            </div>


                                            {{-- officers  --}}
                                            @if (request()->is('officer/*'))
                                                <input type="hidden" name="officer_id"
                                                    value="{{ auth()->user()->id }}">
                                            @else
                                                <div class="col-md-6 col-12">
                                                    @php
                                                        $officers = \App\Models\User::whereHasRole('officer')->get();
                                                    @endphp
                                                    <div class="form-group">
                                                        <label>Select Officer: </label>
                                                        <div data-select2-id="187" class=" ">
                                                            <div class="position-relative " data-select2-id="186">
                                                                <select name='officer_id'
                                                                    class=" select2 btn btn-outline-secondary btn-sm waves-effect form-control select2-hidden-accessible dropdown-toggle"
                                                                    data-select2-id="16" tabindex="-1"
                                                                    aria-hidden="true" required>
                                                                    <option value="{{ $claim->officer->id }}"
                                                                        data-select2-id="all">{{ $claim->officer->name }}
                                                                    </option>
                                                                    @foreach ($officers as $officer)
                                                                        <option value="{{ $officer->id }}"
                                                                            data-select2-id="{{ $officer->id }}">
                                                                            {{ $officer->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            {{-- <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">@lang('language.Upload Supportive Document')}}</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile"
                                                            name="support_doc[]" multiple />
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            File</label>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-6 col-12">
                                                
                                                    <div class="form-group">
                                                        <label>Our Responsipility Per: </label>
                                                        <div data-select2-id="187" class=" ">
                                                            <div class="position-relative " data-select2-id="186">
                                                                <input type="text" name="our_responsipility_per" id="" class="form-control" value="{{$claim->our_responsipility_per}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">@lang('language.Sub claim No')</label>
                                                    <input type="number" class="form-control" id="customFile"
                                                            name="sub_claim_no"  value="{{$claim->claimData?->sub_claim_no}}" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">@lang('language.Intimation Date')</label>
                                                    <input type="date" class="form-control" id="customFile"
                                                            name="intimation_date" required value="{{$claim->claimData?->intimation_date}}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">@lang('language. Policy Holder Liability')</label>
                                                    <select class="form-control" required name="policy_holder_liability">
                                                        <option value="" selected> @lang('language.Select Percentage')</option>
                                                        <option value="100">100%</option>
                                                        <option value="75">75%</option>
                                                        <option value="50">50%</option>
                                                        <option value="25">25%</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">@lang('language. Recovery Party ID')</label>
                                                    <input type="number" class="form-control" id="customFile"
                                                            name="recovery_party_id" required  value="{{$claim->claimData?->recovery_party_id}}"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">@lang('language. Recovery Party Name')</label>
                                                    <input type="text" class="form-control" id="customFile"
                                                            name="recovery_party_name" required value="{{$claim->claimData?->recovery_party_name}}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">@lang('language. Recovery Reserve Amount')</label>
                                                    <input type="number" class="form-control" id="customFile"
                                                            name="recovery_reserve_amount" required value="{{$claim->claimData?->recovery_reserve_amount}}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">@lang('language. Recovery Request Date')</label>
                                                    <input type="date" class="form-control" id="customFile"
                                                            name="recovery_request_date"  required value="{{$claim->claimData?->recovery_request_date}}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">@lang('language. Recovery OS Date')</label>
                                                    <input type="date" class="form-control" id="customFile"
                                                            name="recovery_os_date"  required value="{{$claim->claimData?->recovery_os_date}}"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">@lang('language. Recovery Close Date')</label>
                                                    <input type="date" class="form-control" id="customFile"
                                                            name="recovery_close_date"  required value="{{$claim->claimData?->recovery_close_date}}"/>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">@lang('language. Recovered Date')</label>
                                                    <input type="date" class="form-control" id="customFile"
                                                            name="recovered_date"  required value=""/>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">@lang('language. Recovered Amount')</label>
                                                    <input type="number" class="form-control" id="customFile"
                                                            name="recovered_amount"  required value="{{$claim->claimData?->recovered_amount}}"/>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">@lang('language. Partial Recoverd')</label>
                                                    <input type="number" class="form-control" id="customFile"
                                                            name="is_partial_recovered"  required  value="{{$claim->claimData?->is_partial_recovered}}"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="customFile">@lang('language. Assign To')</label>
                                                    <input type="text" class="form-control" id="customFile"
                                                            name="assign_user_id" value="{{$claim->claimData?->assign_user_id}}"  required/>
                                                </div>
                                            </div>
                                            {{-- dropzone  --}}
                                            {{-- <div class="col-lg-6 col-12">
                                                <label for="email-id-column">@lang(''
                                                    language.Upload Files')
                                                </label>


                                                <div class="dropzone dropzone-2"></div>


                                                <div style="display:none;" id="my-template">
                                                    <div id="mytmp" class="dz-preview dz-file-preview">
                                                        <div class="dz-image"><img data-dz-thumbnail /></div>
                                                        <div class="dz-details">
                                                            <div class="dz-size"><span data-dz-size></span></div>
                                                            <div class="dz-filename"><span data-dz-name></span></div>
                                                        </div>
                                                        <div class="dz-progress">
                                                            <span class="dz-upload" data-dz-uploadprogress></span>
                                                        </div>

                                                        <div class="dz-remove" data-dz-remove>
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                                viewBox="0 0 24 24" width="24px" fill="#000000">
                                                                <path d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M14.59 8L12 10.59 9.41 8 8 9.41 10.59 12 8 14.59 9.41 16 12 13.41 14.59 16 16 14.59 13.41 12 16 9.41 14.59 8zM12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- dropzone end  --}}
                                            <div class="divider divider-secondary" style=" width: 100%;">
                                                <div class="divider-text">Uploaded Supportive Documents</div>
                                            </div>
                                            {{-- alert  --}}
                                            <div style="width: 100%;">
                                                <div class="alert alert-warning mt-1 alert-validation-msg" role="alert">
                                                    <div class="alert-body">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                            height="14" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="feather feather-info mr-50 align-middle">
                                                            <circle cx="12" cy="12" r="10">
                                                            </circle>
                                                            <line x1="12" y1="16" x2="12"
                                                                y2="12"></line>
                                                            <line x1="12" y1="8" x2="12.01"
                                                                y2="8"></line>
                                                        </svg>
                                                        <span>
                                                            Notice:
                                                            <br>
                                                            Following are uploaded documents of this claim
                                                            <br>
                                                            If you want to delete any uploaded documents please check those
                                                            to delete.
                                                        </span>
                                                    </div>
                                                </div>

                                                <div style=" display: flex;flex-direction: column; gap: 8px;">

                                                    @php
                                                        $count = 1;
                                                    @endphp
                                                    @foreach ($claim->supportedDocs as $supportedDoc)
                                                        <div class="d-flex align-items-center">
                                                            <div
                                                                class="custom-control custom-control-danger custom-switch">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="deletable_docs[]"
                                                                    value="{{ $supportedDoc->id }}"
                                                                    id="supportive-doc-{{ $supportedDoc->id }}">
                                                                <label class="custom-control-label"
                                                                    for="supportive-doc-{{ $supportedDoc->id }}"></label>
                                                            </div>
                                                            <a href="/storage/{{ $supportedDoc->doc_name }}"
                                                                style=" font-size: 16px; font-weight: 500; text-decoration: underline;"
                                                                target="_blank">
                                                                {{ $count }}. Supportive Document
                                                            </a>
                                                        </div>
                                                        @php
                                                            $count++;
                                                        @endphp
                                                    @endforeach

                                                </div>

                                            </div>
                                            

                                            <label class="krajee-file-label"
                                                style="
                                                    border-top: 1px solid #a3a3a3;
                                                    margin-top: 16px;
                                                    padding-top: 16px;"
                                                for="krajee-file-uploader">
                                                Upload New Supportive Docs
                                            </label>
                                            <input id="krajee-file-uploader" name="support_doc[]" type="file" class="file"
                                                style="width: 100%;
                                            padding: 0 16px 32px;"
                                                multiple data-show-upload="false" data-show-caption="true"
                                                data-browse-on-zone-click="true"
                                                data-msg-placeholder="Select {files} for upload..." multiple>

                                            <div class="col-12 mt-2">
                                                <button type="submit"
                                                    class="btn btn-primary mr-1">@lang('language.Update')</button>
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

@push('add-company-css')
    <!-- BEGIN: Vendor CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}"> --}}
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
    {{-- file upload  --}}
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />

    <!-- END: Vendor CSS-->
    <!-- BEGIN: Page CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}"> --}}
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
    {{-- image preview inputs script  --}}
    {{-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/buffer.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/filetype.min.js"
        type="text/javascript"></script> --}}

    <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
                    wish to resize images before upload. This must be loaded before fileinput.min.js -->
    {{-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js"
        type="text/javascript"></script> --}}

    <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
                    This must be loaded before fileinput.min.js -->
    {{-- <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js"
        type="text/javascript"></script> --}}

    <!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
                    dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <!-- the main fileinput plugin script JS file -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>


    <script>
        $('#debtorType').on('change', function() {
            if ($('#debtorType').val() == 'insured') {
                $('#recoveryReason').removeClass('d-none')
            } else if ($('#debtorType').val() == 'thirdparty') {
                $('#recoveryReason').addClass('d-none')
            } else if ($('#debtorType').val() == 'third party') {
                $('#recoveryReason').addClass('d-none')
            }
        })
    </script>
    {{-- krajee plugin for file input  --}}

    <script>
        window.allSupportiveDocumentsFilesList = null;

        function createSupportiveDocumentsFilesList() {

            if (!window.allSupportiveDocumentsFilesList) {
                window.allSupportiveDocumentsFilesList = new DataTransfer();
            }
            // let file = new File(["content"], "filename.jpg");
            let newFiles = document.querySelector('#krajee-file-uploader').files

            for (let file of Object.values(newFiles)) {
                // console.log('for(let file of Object.values(newFiles : ', file)
                window.allSupportiveDocumentsFilesList.items.add(file);
            }

            document.querySelector('#krajee-file-uploader').files = window.allSupportiveDocumentsFilesList.files;

        }



        $("#krajee-file-uploader").fileinput({
            uploadUrl: "/admin/claim/register",
            // deleteUrl: "/site/file-delete",
            'showUpload': false,
            'previewFileType': 'any',
            // 'showCaption': true,
            // 'showPreview': true,
            // 'showRemove': true,
            // overwriteInitial: true,
        }).on('change', function(event) {
            // console.log("change");
            createSupportiveDocumentsFilesList();
        });
    </script>
@endpush
