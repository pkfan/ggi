@props([
'claim'=>null,
'status'=>null,
])

<div class="card-body">
    <form method="post" action="{{ url('admin-claim-status') }}">
        @csrf
        {{-- <input type="hidden" name="_token"
            value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi"> --}}
       
        <h5>@lang('language.Select Status')
            <i class="fadeIn animated bx bx-history" type="button" data-toggle="modal" data-target="#statushistory">
            </i>
            <i class="fadeIn animated bx bx-comment-detail" type="button" data-toggle="modal" data-target="#statusReasonmodal">
            </i>
        </h5>
        {{-- <input type="hidden" value="11" name="claimid"> --}}
        <input type="hidden" value="{{ $claim->id }}" name="claimid">
        <select class="form-control" name="cstatus" id="sectionChooser">
            {{-- @if ($status != null) --}}
            <option value="1" disabled @if ($status?->status == \App\Enums\ClaimStatus::FOLLOW_UP->value) selected @else selected @endif>
                Follow Up للمتابعة
            </option>

            <option value="2" disabled @if ($status?->status == \App\Enums\ClaimStatus::COLLECTED->value) selected @endif>
                Collected تم التحصيل</option>
            <option value="3" disabled @if ($status?->status == \App\Enums\ClaimStatus::DELAY_SETTLEMENT->value) selected @endif>Delay
                Settlement تأجيل السداد</option>
            <option value="4" disabled @if ($status?->status == \App\Enums\ClaimStatus::PARTIAL_SETTLEMENT->value) selected @endif>Partial
                Settlement سداد جزئ</option>
            <option value="5" disabled @if ($status?->status == \App\Enums\ClaimStatus::TRANSFER_TO_MORROR->value) selected @endif>Transfer to
                Morror تحول
                للمرور
            </option>
            <option value="6" disabled @if ($status?->status == \App\Enums\ClaimStatus::TRANSFER_TO_LAWYER->value) selected @endif>Transfer to
                Lawyer تحول للمحام</option>

            <option value="20" disabled @if ($status?->status == \App\Enums\ClaimStatus::SEND_TO_LEGAL_DEPARTMENT->value) selected @endif>Send to legal department
            </option>
            <option value="21" disabled @if ($status?->status == \App\Enums\ClaimStatus::SEND_TO_COLLECTION_OFFICE->value) selected @endif> Send to collection office
            </option>
            <option value="22" disabled @if ($status?->status == \App\Enums\ClaimStatus::SEND_BACK_TO_SUPERVISOR->value) selected @endif>Send back to supervisor
            </option>
        </select>
    </form>
    <br>

    <div id="details-container" style="
            border: 1px solid #dddddd;
            padding: 16px;
            border-radius: 8px;
            background: #f9f9f9;
        ">
        <div class="col-md-12 panel followupDiv">

            <h6>Revert Status</h6>
            <form action="{{ route('admin.claim-follow-up') }}" method="post">
                {{-- <input type="hidden" name="_token"
                    value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi">

                    <input
                    type="hidden" value="11" name="claimid"> --}}

                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claimid">
                <label class="form-label">You are going to change status to follow
                    up</label><br>
                <label class="form-label">@lang('language.Add Reason')</label><br>
                <input type="text" class="form-control" name="statusreason"><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <br>

        </div>

        <div class="col-md-12 panel collectedDiv">
            <h6>Collected</h6>
            <form action="{{ route('admin.payment-collected') }}" method="post">
                {{-- <input type="hidden" name="_token"
                    value="dkPP5ORXV6oUJXsFKlk89EswgwHY1fV8mIsfCNZi"> <input
                    type="hidden" value="11" name="claimid"> --}}
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claimid">

                <label class="form-lable">Choose Settlement Method</label><br>

                <div class="pl-1">

                    <div>

                        <input type="radio" id="settlementMethodYes" class="form-checkbox" name="cash" value="yes" checked>
                        <label for="settlementMethodYes"> Cash Settlement</label>
                    </div>
                    <div>

                        <input type="radio" id="settlementMethodNo" class="form-checkbox" name="cash" value="no">
                        <label for="settlementMethodNo"> Bank Transfer</label>
                    </div>
                </div>

                <br>
                <label class="form-label">@lang('language.Add Reason')</label><br>
                <input type="text" class="form-control" name="statusreason"><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-12 panel delayedDiv">
            <form method="post" action="{{ route('admin-pay.delay') }}">
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claimid">
                <h6>Delay Settlement</h6>
                <select class="form-control" name="type">
                    <option value="bank">Bank Transfer</option>
                </select><br>
                <input type="datetime-local" class="form-control" name="delaydate" id="delaypay" min="2023-07-10T00:00">
                <label class="form-label">@lang('language.Add Reason')</label><br>
                <input type="text" class="form-control" name="statusreason">
                <div style="margin-top:10px;margin-bottom:10px">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
        <div class="col-md-12 panel partialPayDiv">

            <form method="post" action="{{ route('admin.partial-pay') }}" id="partialform">
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claimid">
                <h6>Partial Settlement</h6>
                @php
                $claimHis = DB::table('partial_pay')
                ->where('claim_id', $claim->id)
                ->where('status', 5)
                ->get();
                @endphp
                @if ($claimHis->count() != 0)
                <h6>You want to retrieve Last Plan</h6>
                <select class="form-control" name="last_plan" id="lastplan">

                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <table class="table">
                    <tr>

                        <td>Date Time</td>
                        <td>Status</td>
                        <td>Recovered / Date Time</td>
                    </tr>
                    @if (isset($partialretrive))
                    @foreach ($partialretrive as $pay)
                    <?php
                    $customsadad = DB::table('custome_partial_sadad')
                        ->where('partial_id', $pay->id)
                        ->first();
                    $custommada = DB::table('custome_partial_mada')
                        ->where('partial_id', $pay->id)
                        ->first();
                    $manual = DB::table('partial_manual')
                        ->where('partial_id', $pay->id)
                        ->first();

                    if (isset($custommada)) {
                        $paymentCheck0 = DB::table('payment')
                            ->where('payment_id', $custommada->payment_id)
                            ->where('response_code', 000)
                            ->first();
                    }

                    if (isset($customsadad)) {
                        $paymentCheck3 = DB::table('sadad_response')
                            ->where('responseCode', 000)
                            ->where('sadadNumber', $customsadad->sadadNumber)
                            ->first();
                    }

                    if (($pay->link != null && $pay->type == 'online') || $pay->type == '') {
                        $paymentCheck1 = DB::table('payment')
                            ->where('payment_id', $pay->pay_id)
                            ->where('response_code', 000)
                            ->first();
                    }
                    if ($pay->link != null && $pay->type == 'sadad') {
                        $paymentCheck2 = DB::table('sadad_response')
                            ->where('responseCode', 000)
                            ->where('sadadNumber', $pay->link)
                            ->first();
                    }

                    ?>

                    @if (isset($paymentCheck2))
                    <tr>
                        <td>{{ $paymentCheck2->created_at }}</td>
                        <td>{{ $paymentCheck2->result }}</td>

                        <td>{{ $paymentCheck2->amount }}</td>




                    </tr>
                    <?php unset($paymentCheck2); ?>
                    @elseif(isset($paymentCheck1))
                    <tr>
                        <td>{{ $paymentCheck1->created_at }}</td>
                        <td>Success</td>

                        <td>{{ $paymentCheck1->amount }}</td>


                    </tr>
                    <?php unset($paymentCheck1); ?>
                    @elseif(isset($paymentCheck3))
                    <tr>
                        <td>{{ $paymentCheck3->created_at }}</td>
                        <td>Success</td>

                        <td>{{ $paymentCheck3->amount }}</td>


                    </tr>
                    <?php unset($paymentCheck3); ?>
                    @elseif(isset($paymentCheck0))
                    <tr>
                        <td>{{ $paymentCheck0->created_at }}</td>
                        <td>Success</td>

                        <td>{{ $paymentCheck0->amount }}</td>


                    </tr>
                    <?php unset($paymentCheck0); ?>
                    @elseif(isset($manual))
                    <tr>
                        <td>{{ $manual->created_at }}</td>
                        <td>Success</td>
                        <td>{{ $manual->amount }}</td>


                    </tr>
                    <?php unset($manual); ?>
                    @else
                    <tr>
                        <td>{{ $pay->date_time }}</td>
                        <td>
                            @if ($pay->status == 1)
                            SMS Not Send Yet
                            @elseif($pay->status == 2)
                            SMS Sent
                            @endif

                        </td>
                        <td>
                            @if ($custommada)
                            {{ customPartialCheck($claim->id, $custommada->payment_id) + partialCheck($pay->pay_id, $claim->id, $pay->id, $pay->link) }}
                            @elseif($customsadad)
                            {{ customPartialCheck($claim->id, $customsadad->sadadNumber + partialCheck($pay->pay_id, $claim->id, $pay->id, $pay->link)) }}
                            @else
                            {{ partialCheck($pay->pay_id, $claim->id, $pay->id, $pay->link) }}
                            @endif
                        </td>

                    </tr>
                    @endif
                    @endforeach
                    @endif




                    <tr>
                        <td colspan='2'>@lang('language.Recovered Amount')</td>
                        <td>{{ round(recoveryAmt($claim->id), 2) }}</td>
                    </tr>
                </table>
                @endif
                <div style="display:
                    <?php
                    if ($claimHis->count() != 0) {
                        echo 'none';
                    } else {
                        echo 'block';
                    }
                    ?>
                " id="newPartialDiv">

                    <label class="form-label">@lang('language.Select Settlement Plan')</label>

                    <input type="number" name="plan" class="form-control" id="rowCountInput" onkeyup="settelPlan()">
                    {{-- <label class="form-label">@lang('language.Select Method')</label>
                    <select name="type" class="form-control">
                        <option selected="" value="">@lang('language.Select Method')
                        </option>
                        <option value="sadad">@lang('language.Sadad Invoice')</option>
                        <option value="online">@lang('language.Online Link')</option>
                    </select> --}}

                    <label class="form-label">@lang('language.Set Date')</label>
                    <div><i>By default, each upcomming installment has 30 days duration.</i></div>
                    <input type="datetime-local" class="form-control" name="pardate" id="partialpay" min="2023-07-10T00:00" required>
                    <label class="form-label">@lang('language.Add Reason')</label><br>
                    <input type="text" class="form-control" name="statusreason">

                    <table id="myTable" class="table" style=" margin-top: 16px;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Amount</th>

                                <!-- Add more headers if needed -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Existing rows, if any -->
                        </tbody>
                    </table>

                </div>
                <div style="margin-top:10px;margin-bottom:10px">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
        <div class="col-md-12 panel transferMorr">
            @php
            $colllector = DB::table('users')
            ->where('roll', 5)
            ->select('name')
            ->get();
            @endphp
            <h6>Morror Detail</h6>
            <form action="{{ route('admin.transfer-morror') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claimid">
                <label class="form-label">City</label>
                <select class="form-control" name="morrorcity">
                    <option value="">-- Select City --</option>
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
                <input type="text" name="department" class="form-control" required="">
                <label class="form-label">@lang('language.Assign Collector')</label>
                <select class="form-control" name="collector" required="">
                    <option value="">-- @lang('language.Select Collector') --</option>
                    @if ($colllector != null)
                    @foreach ($colllector as $col)
                    <option value="{{ $col->name }}">
                        {{ $col->name }}
                    </option>
                    @endforeach
                    @else
                    <option selected>@lang('language.No Collector Register')</option>
                    @endif
                </select><br>
                <label class="form-label">@lang('language.Add Reason')</label><br>
                <input type="text" class="form-control" name="statusreason"><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-12 panel assignLaw">
            @php
            $lawfirm = DB::table('users')
            ->where('roll', 2)
            ->select('id', 'name')
            ->get();
            @endphp
            <h6>@lang('language.Transfer to Lawyer')</h6>
            <form action="{{ route('admin.transfer-lawyer') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claimid">
                <label class="form-label">@lang('language.Select Law firm')</label>
                <select class="form-control" name="lawfirm" required="">
                    <option value="">-- @lang('language.Select Law Firm') --</option>
                    @foreach ($lawfirm as $law)
                    <option value="{{ $law->id }}">{{ $law->name }}
                    </option>
                    @endforeach
                </select><br>
                <input type="text" class="form-control" name="statusreason"><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-12 panel assignAcc">
            @php
            $finance = DB::table('financial_companies')
            ->select('id', 'name')
            ->get();
            @endphp
            <h4>@lang('language.Transfer to Finance')</h4>
            <form action="{{ route('admin.transfer-finance') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claimid">
                <label class="form-label">@lang('language.Select Finance Company')</label>
                <select class="form-control" name="finance" required="">
                    <option value="">-- @lang('language.Select Finance Company') --</option>
                    @foreach ($finance as $fin)
                    <option value="{{ $fin->id }}">{{ $fin->name }}
                    </option>
                    @endforeach
                </select><br>
                <label class="form-label">@lang('language.Add Reason')</label>
                <input type="text" class="form-control" name="statusreason"><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-12 panel assignElm">

            <h4>@lang('language.Transfer to ELM')</h4>
            <form action="{{ route('admin.transfer-elm') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claimid">
                <label class="form-lable">@lang('language.Iqama Number')</label><br>
                <input type="number" class="form-control" name="deb_iqama" required=""><br>
                <label class="form-label">@lang('language.Add Reason')</label>
                <input type="text" class="form-control" name="statusreason"><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-12 panel assignIc">

            <h4>@lang('language.Transfer to IC')</h4>
            <form action="{{ route('admin.transfer-IC') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claimid">
                <input type="hidden" value="{{ $claim->company_id }}" name="company_id">
                <label class="form-lable">@lang('language.Add Comments')</label><br>
                <textarea name="comments" class="form-control"></textarea><br>
                <label class="form-label">@lang('language.Add Reason')</label>
                <input type="text" class="form-control" name="statusreason"><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-12 panel closeClaim">

            <h6>Closed</h6>
            <form action="{{ route('admin.closeClaim') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claimid">
                <label class="form-lable">Are you Sure to close?</label><br>
                <input type="radio" class="form-checkbox" name="elm" value="yes">Yes
                <input type="radio" class="form-checkbox" name="elm" value="no">No<br>
                <label class="form-label">@lang('language.Add Reason')</label>
                <input type="text" class="form-control" name="statusreason"><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <div class="col-md-12 panel  collectedbyic">
            <h4>Collected By Insurance</h4>
            <form action="{{ route('admin.collected-by-ic') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claimid">
                <label class="form-label">Are you sure to mark as collected by
                    Insurance</label><br>
                <label class="form-label">@lang('language.Add Reason')</label><br>
                <input type="text" class="form-control" name="statusreason"><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form><br>
        </div>
        @php
        use App\Enums\ClaimStatus;

        @endphp
        <!-- Added by Talha -->
        <div class="col-md-12 panel  sendToLegalDeparment">
            <h4>Send to Legal Department</h4>
            <form action="{{ route('supervisor.send-to-legal-department') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claim_id">
                <input type="hidden" name="status" value="{{ClaimStatus::SEND_TO_LEGAL_DEPARTMENT->value}}">
                <label class="form-label">Are you sure to mark as send to legal department</label><br>
                <label class="form-label">@lang('language.Add Reason')</label><br>
                <input type="text" class="form-control" name="remarks"><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form><br>
        </div>

      

        <div class="col-md-12 panel  sendToCollectionOffice">
            <h4>Send to Collection office </h4>
            @php
            use App\Models\User;
            $colllectors = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', 'collector');
            })->get();
            @endphp
            <form action="{{ route('supervisor.send-to-collection-office') }}" method="post">
                @csrf
                <input type="hidden" name="status" value="{{ClaimStatus::SEND_TO_COLLECTION_OFFICE->value}}">
                <input type="hidden" value="{{ $claim->id }}" name="claim_id">
                <label class="form-label">Are you sure to mark as send to Collection office</label><br>
                <label class="form-label">@lang('language.Select Collector Officer')</label><br>
                <select name="collector_id" class="form-control">
                    <option value=""></option>
                    @foreach($colllectors as $colllector)
                     <option value="{{$colllector->id}}">{{$colllector->name}}</option>
                    @endforeach
                </select>
                <label class="form-label">@lang('language.Add Reason')</label><br>
                <input type="text" class="form-control" name="remarks"><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form><br>
        </div>

        <div class="col-md-12 panel  sendBackToSV">
            <h4>Send to Supervisor</h4>
            
            <form action="{{ route('supervisor.send-back-to-supervisor') }}" method="post">
                @csrf
                <input type="hidden" name="status" value="{{ClaimStatus::SEND_BACK_TO_SUPERVISOR->value}}">
                <input type="hidden" value="{{ $claim->id }}" name="claim_id">
                <label class="form-label">Are you sure to mark as send back to supervisor</label><br>
                <label class="form-label">@lang('language.Add Reason')</label><br>
                <input type="text" class="form-control" name="remarks"><br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form><br>
        </div>

        


    </div>
</div>