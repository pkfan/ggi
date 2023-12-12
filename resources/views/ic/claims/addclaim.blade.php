<!DOCTYPE html>
<html lang="en">
<x-ic::head/>

<body>
<x-ic::header/>
<x-ic::sidebar/>
<div class="app-content content ">
        @if(session()->has('success'))
            <div id="toast-container" class="toast-container toast-top-right">
                <div class="toast toast-success" aria-live="polite" style>
                    <button type="button" class="toast-close-button" role="button">×</button>
                    <div class="toast-title">👋Claim Registered!</div>
                    <div class="toast-message">You have successfully regostered your claim.</div>
                </div>
            </div>
        @endif
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Request Form</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">IC</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Claims</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Add Claims</a>
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

									<h4 class="mb-0 text-primary">Request Form</h4> &nbsp; &nbsp; &nbsp; <b>Is Debtor Contractor/Minuciplity Or Government </b> &nbsp; &nbsp; <input type="radio" name="claim_type" value="yes">Yes &nbsp; &nbsp;  <input type="radio" name="claim_type" value="no" checked="">No
								</div>

                <form class="form" method="post" action="{{route('IcAddClaim')}}" enctype="multipart/form-data">
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Multiple Column</h4>
                                </div>
                                <div class="card-body">
                                    @csrf
                                    <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Recovery Amount</label>
                                                    <input type="number" onkeypress="return event.charCode >= 48" min="1" class="form-control" id="inputFirstName" value="{{ old('rec_amt')}}" name="rec_amt" required>>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Claim Number</label>
                                                    <input
                                                    type = "text"  onkeyup="alphanumeric(this)" min="1"
                                                    class="form-control" id="claimNumber" name="claim_no" value="{{ old('claim_no')}}" required>
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
                                                    <input type="text" class="form-control" id="inputDebtor" name="deb_name"   value="{{ old('deb_name')}}"  required >
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Ic Email</label>
                                                    <input type="email" class="form-control" id="inputDebtor" name="icemail"   value="{{ old('icemail')}}"   >
                                                </div>
                                            </div>
                                            <script>
                                                    $("#inputDebtor").on('change',function(){
                                                        let text=$('#inputDebtor').val();
                                                        let letter1 = /^[a-zA-Z\u0600-\u06FF\s]+$/;
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
                                                    maxlength = "10" class="form-control" id="deb_iqama" name="deb_iqama" value="{{ old('deb_iqama')}}" required maxlength="10">
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
                                            <div class="col-md-6 col-12">
                                            <label for="phone-number">Phone Number</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">US (+1)</span>
                                                </div>
                                                <input type="number" onkeypress="return event.charCode >= 48" min="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                maxlength = "9" class="form-control" id="deb_phone" name="deb_mob" aria-label="Username" aria-describedby="addon-wrapping" value="{{ old('deb_mob')}}" requierd>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Type</label>
                                                    <input type="number" id="email-id-column" class="form-control" name="email-id-column" />
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
                                        <input id="input-id" type="file" class="file" multiple type="file" name="support_doc[]" data-preview-file-type="text"  required>
                                                </div>
                                            </div>
                                            <div class="row">
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
                                            </div>
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
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>

    $(function(){
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    var hour=  dtToday.getHours();
    var min=dtToday.getMinutes();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
        console.log(day)
    var maxDate = year + '-' + month + '-' + day ;

   // alert(maxDate);
    $('#accidentDate').attr('max',maxDate );
    $('#inspection-date-from').attr('min',maxDate );

  });
    </script>
<script>
	$('#debtorType').on('change',function(){
		if($('#debtorType').val() == 'insured'){
			$('#recoveryReason').removeClass('d-none')
		}
		else if($('#debtorType').val() == 'thirdparty'){
			$('#recoveryReason').addClass('d-none')
		}
        else if($('#debtorType').val() == 'third party'){
			$('#recoveryReason').addClass('d-none')
		}
	})

	   $('input[type=radio][name=claim_type]').change(function() {
    if (this.value == 'yes') {
        $('#divIqama').hide();
        $('#divphone').hide();
        $('#deb_iqama').removeAttr('required');
        $('#deb_phone').removeAttr('required');

    }
    else if (this.value == 'no') {
        $('#divIqama').show();
        $('#divphone').show();
        $('#deb_iqama').attr('required',true);
        $('#deb_phone').attr('required',true);
    }
    })
</script>
{{--<script>--}}
{{--const excel_file = document.getElementById('excel_file');--}}
{{--excel_file.addEventListener('change', (event) => {--}}
{{--    if(!['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'].includes(event.target.files[0].type))--}}
{{--    {--}}
{{--        document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Only .xlsx or .xls file format are allowed</div>';--}}
{{--        excel_file.value = '';--}}
{{--        return false;--}}
{{--    }--}}
{{--    var reader = new FileReader();--}}
{{--    reader.readAsArrayBuffer(event.target.files[0]);--}}
{{--    reader.onload = function(event){--}}
{{--        var data = new Uint8Array(reader.result);--}}
{{--        var work_book = XLSX.read(data, {type:'array'});--}}
{{--        var sheet_name = work_book.SheetNames;--}}
{{--        var sheet_data = XLSX.utils.sheet_to_json(work_book.Sheets[sheet_name[0]], {header:1});--}}
{{--        if(sheet_data.length > 0)--}}
{{--        {--}}
{{--            if(sheet_data[0][0].toUpperCase() == 'MAKE' && sheet_data[0][1].toUpperCase() == 'MODEL' && sheet_data[0][2].toUpperCase() == 'YEAR' && sheet_data[0][3].toUpperCase() == 'TYPE' && sheet_data[0][4].toUpperCase() == 'COLOR' && sheet_data[0][5].toUpperCase() == 'CLAIM NO' && sheet_data[0][6].toUpperCase() == 'PLATE NO' )--}}
{{--            {--}}
{{--            var table_output = '<table class="table table-striped table-bordered">';--}}
{{--            for(var row = 0; row < sheet_data.length; row++)--}}
{{--            {--}}
{{--                table_output += '<tr>';--}}
{{--                for(var cell = 0; cell < sheet_data[row].length; cell++)--}}
{{--                {--}}
{{--                    if(row == 0)--}}
{{--                    {--}}
{{--                        table_output += '<th>'+sheet_data[row][cell]+'</th>';--}}
{{--                    }--}}
{{--                    else--}}
{{--                    {--}}
{{--                        table_output += '<td>'+sheet_data[row][cell]+' <input type="hidden" name="data[]" value="'+sheet_data[row][cell]+'" >    '+'</td>';--}}
{{--                    }--}}
{{--                }--}}
{{--                if(!row == 0){--}}
{{--              table_output += '<td> <input type="file" name="data[]" value="Upload" required multiple>  </td>';--}}
{{--                }--}}
{{--                table_output += '</tr>';--}}
{{--            }--}}
{{--            table_output += '</table>';--}}
{{--            console.log(table_output);--}}
{{--             document.getElementById('excel_data').innerHTML = table_output;--}}
{{--              }else{--}}
{{--              document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Only recomended format are allowed</div>';--}}
{{--        }--}}
{{--        }--}}
{{--        excel_file.value = '';--}}
{{--    }--}}
{{--});--}}
{{--</script>--}}
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


    const excel_file = document.getElementById('excel_file');
    excel_file.addEventListener('change', (event) => {
        if(!['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'].includes(event.target.files[0].type))
        {
            document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Only .xlsx or .xls file format are allowed</div>';
            excel_file.value = '';
            return false;
        }
        var reader = new FileReader();
        reader.readAsArrayBuffer(event.target.files[0]);
        reader.onload = function(event){
            var data = new Uint8Array(reader.result);
            var work_book = XLSX.read(data, {type:'array'});
            var sheet_name = work_book.SheetNames;
            var sheet_data = XLSX.utils.sheet_to_json(work_book.Sheets[sheet_name[0]], {header:1});
            if(sheet_data.length > 0)
            {
                if(sheet_data[0][0] === 'rec_amt' &&  sheet_data[0][1] === 'acc_location' && sheet_data[0][2] === 'rec_reason' && sheet_data[0][3] === 'deb_iqama' && sheet_data[0][4] === 'deb_name' && sheet_data[0][5] === 'deb_age' && sheet_data[0][6] === 'deb_mob'  && sheet_data[0][7] === 'deb_type' && sheet_data[0][8] === 'claim_no' &&  sheet_data[0][9] === 'ic_email'
                 && sheet_data[0][10] === 'accident_date' && sheet_data[0][11] === 'liability percentage' && sheet_data[0][12] === 'type')
                {
                    console.log(sheet_data.length);
                    var table_output = '<table class="table table-striped table-bordered">';
                    for(var row = 0; row < sheet_data.length; row++) {
                        table_output += '<tr>';
                        for (var cell = 0; cell < sheet_data[row].length; cell++) {
                            if (row == 0) {
                                table_output += '<th>' + sheet_data[row][cell] + '</th>';
                            } else {
                                if(cell == 10){
                                    table_output += '<td>'+convertExcelDate(sheet_data[row][cell])+  ' <input type="hidden" name="data[]" value=" ' + convertExcelDate(sheet_data[row][cell])+ ' " >    ' + '</td>';
                                } else if(cell == 11){
                                    table_output += '<td>'+100*sheet_data[row][cell]+  ' <input type="hidden" name="data[]" value=" ' + 100*sheet_data[row][cell] + ' " >    ' + '</td>';
                                }
                                else{
                                    table_output += '<td>' + sheet_data[row][cell] + ' <input type="hidden" name="data[]" value="' + sheet_data[row][cell] + '" >    ' + '</td>';
                                }
                            }
                        }
                        if (!row == 0) {
                            table_output += '<td> <input type="file" name="data'+row+'[]"    value="Upload" required multiple accept="image/png, image/jpeg ,application/pdf" >  </td>';

                        }
                        table_output += '</tr>';

                    }
                    table_output += '</table>';
                    console.log(table_output);
                    document.getElementById('excel_data').innerHTML = table_output;
                }else{
                    document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Only recomended format are allowed</div>';
                }
            }
            excel_file.value = '5r5r';
        }
    });

    function hel()
    {
        var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    var hour=  dtToday.getHours();
    var min=dtToday.getMinutes();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
        console.log(day)
    var maxDate = year + '-' + month + '-' + day ;

   // alert(maxDate);
    $('.accidentDate2').attr('max',maxDate );
        console.log
    }
</script>
</body>
</html>
