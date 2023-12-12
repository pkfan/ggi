<!DOCTYPE html>
<html lang="en">
<x-ic::head/>

<body>
<x-ic::header/>
<x-ic::sidebar/>
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Add ELM Claim</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">IC</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">ELM Claims</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Add ELM</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
            <div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-file font-22 text-primary"></i>
									</div>

									<h4 class="mb-0 text-primary">ADD ELM</h4>
								</div>
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Multiple Column</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form">
                                        <div class="row">
                                        <form class="row g-3" method="  " action="{{url('add/elm-claim')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Recovery Amount</label>
                                                    <input type="number" onkeypress="return event.charCode >= 48" min="1" class="form-control" id="inputFirstName" value="{{ old('rec_amt')}}" name="rec_amt" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Claim Number</label>
                                                    <input type = "text"  onkeyup="alphanumeric(this)"  class="form-control" id="claimNumber" name="claim_no" value="{{ old('claim_no')}}" required>
                                                </div>
                                            </div>
                                            <script>
									            function alphanumeric(el){
                                                    // var number=/^[0-9a-zA-Z]+$/;
                                                    var number=/^[ A-Za-z0-9_@.$/#&+-]*$/;
                                                    if(el.value.match(number)){

                                                        document.getElementById('refError').innerHTML=' ';
                                                    }else{
                                                        document.getElementById('refError').innerHTML='Only AlphaNumric Allow';

                                                    }
                                                }
									        </script>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column">Accident Date </label>
                                                    <input type="date" class="form-control" id="accidentDate" name="acc_date" value="{{ old('acc_date')}}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="country-floating">Accident Location</label>
                                                    <select class="form-control" name="acc_location" required="">
                                                    <option value="" selected="">-- Select Location --</option>
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
                                                    <label for="company-column">Debtor Name</label>
                                                    <input type="text" class="form-control" id="inputDebtor" name="deb_name"  pattern="[أ-يa-zA-Z ]*" value="{{ old('deb_name')}}"  required >
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Ic Email</label>
                                                    <input type="email" class="form-control" id="inputDebtor" name="icemail"   value="{{ old('icemail')}}"  required >
                                                </div>
                                            </div>
                                            <script>
                                                $("#inputDebtor").on('change',function(){
                                                    let text=$('#inputDebtor').val();
                                                    let letter1 = /^[s/أ-يA-Za-z\s]+$/;
                                                    if(text.match(letter1)){
                                                        $('#debtor_name').text(' ');
                                                    }else{
                                                        $('#debtor_name').text('Only Alphabets Are Allowed');
                                                    }
                                                });

                                            </script>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Debtor Iqama Number/ID Number</label>
                                                    <input type="number" onkeypress="return event.charCode >= 48" min="1"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                    maxlength = "10" class="form-control" id="inputEmail" name="deb_iqama" value="{{ old('deb_iqama')}}" required maxlength="10">
                                                    @error('deb_iqama')
                                                    <span class="text-danger">Iqama Number is not valid</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Debtor Age</label>
                                                    <input type="number" onkeypress="return event.charCode >= 48" min="1"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                    type = "number"
                                                    maxlength = "3" max="150" class="form-control" id="inputEmail" name="deb_age" value="{{ old('deb_age')}}">
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-6 col-12">
                                            <label for="phone-number">Phone Number</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">US (+1)</span>
                                                </div>
                                                <input type="text" class="form-control phone-number-mask" ="1 234 567 8900" id="phone-number" />
                                                </div>
                                            </div> -->
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Type</label>
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-inline-block mr-2"><input type="radio" class="custom-control custom-radio" name="type" value="ind"/>
                                                            Ind
                                                        </li>
                                                        <li class="d-inline-block mr-2">
                                                            <input type="radio" class="custom-control custom-radio" name="type" value="Corporate"/>
                                                            Corporate
                                                        </li>
                                                        <li class="d-inline-block mr-2">
                                                            <input type="radio" class="custom-control custom-radio" name="type" value="Leasing"/>
                                                            Leasing
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Libaility Percentage </label>
                                                    <select class="form-control" required="" name="libpercent">
                                                        <option value="" selected="">Select Percentage</option>
                                                        <option value="100">100%</option>
                                                        <option value="75">75%</option>
                                                        <option value="50">50%</option>
                                                        <option value="25">25%</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Select Debtor Type </label>
                                                    <select id="debtorType" class="form-control" name="deb_type" required="">
                                                        <option value="" selected="">--Select Type--</option>
                                                        <option value="insured">Insured</option>
                                                        <option value="third party">Third Party</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Select Recovery Reason </label>
                                                    <select class="form-control" name="rec_reason">
                                                        <option value="" disabled="" selected="">Recovery Reason</option>
                                                        <option value="Used in contravention of the restrictions set forth in the Policy schedule">Used in contravention of the restrictions set forth in the Policy schedule</option>
                                                        <option value=" Carrying a number of passengers exceeding the seating capacity of the vehicle"> Carrying a number of passengers exceeding the seating capacity of the vehicle</option>
                                                        <option value="Driven against the direction of traffic.">Driven against the direction of traffic.</option>
                                                        <option value=" Driven under the influence of drugs, alcohol or medications "> Driven under the influence of drugs, alcohol or medications </option>
                                                        <option value="Driven by a person under the age of 18 (according to the Hijri calendar) ">Driven by a person under the age of 18 (according to the Hijri calendar) </option>
                                                        <option value="Driven by a person who does not hold a proper class of license driver’s license is forfeited by a competent entity ">Driven by a person who does not hold a proper class of license driver’s license is forfeited by a competent entity </option>
                                                        <option value="The license was expired and it wasn’t renewed within (50) working days from the date of the accvalueent.">The license was expired and it wasn’t renewed within (50) working days from the date of the accvalueent.</option>
                                                        <option value="The driver escaped the scene of the accvalueent for no acceptable reason.">The driver escaped the scene of the accvalueent for no acceptable reason.</option>
                                                        <option value="Running a red light.">Running a red light.</option>
                                                        <option value="Submitting inaccurate information in the insurance proposal form concealing material facts.">Submitting inaccurate information in the insurance proposal form concealing material facts.</option>
                                                        <option value="If it is proved that the accvalueent was deliberate.">If it is proved that the accvalueent was deliberate.</option>
                                                        <option value="The insured dvaluen’t notify the insurer within (20) working days of any material changes ">The insured dvaluen’t notify the insurer within (20) working days of any material changes </option>
                                                        <option value="The vehicle was stolen or taken forcibly ">The vehicle was stolen or taken forcibly </option>
                                                        <option value="Proven Fraud ">Proven Fraud </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Upload Supportive Document </label>
                                                    {{-- <input type="file" class="form-control" id="input-id" name="support_doc[]" multiple required> --}}
                                                    <input id="input-id" type="file" multiple type="file" class="file" name="support_doc[]" data-preview-file-type="text"  required>
                                                </div>
                                            </div>
                                            <!-- <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Use Button To Select Files</h4>
                                                        </div>
                                                        <div class="card-body">

                                                            <button id="select-files" class="btn btn-outline-primary mb-1">
                                                                <i data-feather="file"></i> Click me to select files
                                                            </button>
                                                            <form action="#" class="dropzone dropzone-area" id="dpz-btn-select-files">
                                                                <div class="dz-message">Drop files here or click button to upload.</div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Floating Label Form section end -->

            </div>
        </div>
    </div>
    <x-ic::footer/>
</body>
</html>
