@php
    use App\Enums\ClaimStatus;
@endphp

@props([
    'status' => null,
    'claim' => null,
])


@if ($status != null)

   @if($status->status == ClaimStatus::SEND_TO_COLLECTION_OFFICE->value)
   @endif

   @if($status->status == ClaimStatus::SEND_TO_LEGAL_DEPARTMENT->value)
   @endif

   @if($status->status == ClaimStatus::SEND_BACK_TO_SUPERVISOR->value)
   @endif
   
    @if ($status->status == ClaimStatus::COLLECTED->value)
        <?php
        $collected = DB::table('claim_collected')
            ->where('claim_id', $claim->id)
            ->first();

        ?>
        <h4>Collected via {{ $collected->payment }}</h4>
    @endif
    @if ($status->status == ClaimStatus::CLOSE->value)
        <h4>Claim Closed</h4>
    @endif
    @if ($status->status == ClaimStatus::TRANSFER_TO_IC->value)
        <div class="col-md-4">
            <?php
            $comments = DB::table('claim_comments')
                ->where('claim_id', $claim->id)
                ->orderBy('created_at')
                ->get();
            ?>
            <h4>Transfer To IC</h4>
            @foreach ($comments as $comment)
                @if ($comment->status == ClaimStatus::FOLLOW_UP->value)
                    <div class="chat-content-rightside">
                        <div class="d-flex ms-auto">
                            <div class="flex-grow-1 me-2">
                                <p class="mb-0 chat-time text-end">
                                    you,{{ \Carbon\Carbon::parse($comment->updated_at)->diffForhumans() }}
                                </p>
                                <p class="chat-right-msg">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="chat-content-leftside">
                        <div class="d-flex ms-auto">
                            <div class="flex-grow-1 me-2">
                                <p class="mb-0 chat-time text-end">
                                    {{ username($comment->update_by)->name }},
                                    {{ \Carbon\Carbon::parse($comment->updated_at)->diffForhumans() }}
                                </p>
                                <p class="chat-left-msg">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            <form action="{{ url('admin/transfer-IC') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claimid">
                <input type="hidden" value="{{ $claim->company_id }}" name="company_id">
                <label class="form-lable">Add Comments</label><br>
                <textarea name="comments" class="form-control"></textarea><br>
                <input type="submit" class="btn btn-primary">
            </form>
        </div>

    @endif



    @if ($status->status == ClaimStatus::TRANSFER_TO_ELM->value)
        Case Transferred To ELM
    @endif

    @if ($status->status == ClaimStatus::TRANSFER_TO_FINANCE->value)
        <?php
        $financeCompany = DB::table('finance_cases')
            ->where('claim_id', $claim->id)
            ->first();
        ?>
        <h4>Assigned Finance Company</h4>
        Finance Company: {{ getFinanceById($financeCompany->finance_id)->name }}
    @endif

    @if ($status->status == ClaimStatus::TRANSFER_TO_LAWYER->value)
        <?php
        $transfer = DB::table('law_firm_cases')
            ->where('claim_id', $claim->id)
            ->first();
        ?>
        <h4>Assigned Law Firm</h4>
        Law Firm : {{ username($transfer->lawfirm_id)->name }}
    @endif

    @if ($status->status == ClaimStatus::TRANSFER_TO_MORROR->value)
        <?php
        $tranfer = DB::table('tranfer_morror')
            ->where('claim_id', $claim->id)
            ->where('status', 1)
            ->first();
        ?>
        <h4>Transfer to Morror تحول للمرور</h4>
        <div class="col-md-4">
            <label class="form-lable">City</label>
            <input class="form-control" value="{{ $tranfer->city }}">
            <label class="form-lable">Department</label>
            <input class="form-control" value="{{ $tranfer->department }}">
            <label class="form-lable">Collector</label>
            <input class="form-control" value="{{ $tranfer->collector }}">
        </div>
    @endif

    @if ($status->status == ClaimStatus::DELAY_SETTLEMENT->value || $status->status == ClaimStatus::COLLECTED->value)

        <?php
        $delaypayc = DB::table('pay_delay')
            ->where('claim_id', $claim->id)
            ->where('status', 1)
            ->count();
        $delaypay = DB::table('pay_delay')
            ->where('claim_id', $claim->id)
            ->get();
        $delaysent = DB::table('pay_delay')
            ->where('claim_id', $claim->id)
            ->where('status', 2)
            ->get();
        ?>
        @if ($delaypayc == 0 && $status->status == ClaimStatus::DELAY_SETTLEMENT->value && $delaysent->count() == 0)
            <form method="post" action="{{ url('admin-pay/delay') }}">
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claimid">
                <h6>Delay Settlement</h6>
                <div class="col-md-4">
                    <select class="form-control" name="type">
                        <option>Select Method</option>
                        <option value="sadad">Sadad</option>
                        <option value="mada">Mada</option>
                    </select><br>
                    <input type="datetime-local" class="form-control" name="delaydate" id="delaypay">
                </div>
                <div class="col-md-6" style="margin-top:10px;margin-bottom:10px">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        @elseif($delaypayc != null || $delaysent->count() != 0)
            <div class="col-md-12">

                <table class="table">
                    <tr>
                        <td>Date Time</td>
                        <td>Status</td>
                        <td>Link</td>
                        <td>Action</td>
                    </tr>

                    @foreach ($delaypay as $delay)
                        <tr>
                            <td>{{ $delay->date_time }}</td>
                            <td>
                                @if ($delay->status == 1)
                                    SMS Not Send Yet
                                @elseif($delay->status == 2)
                                    SMS Sent
                                @endif
                            </td>
                            <td>{{ $delay->link }}</td>


                            <td>
                                @if ($delay->status == 1)
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#delayDatemodal" onclick="changedelay({{ $delay->id }})">Edit
                                        Date</button>
                                @endif
                            </td>

                        </tr>
                    @endforeach

                </table>
            </div>
        @endif


    @endif



    @if ($status->status == ClaimStatus::PARTIAL_SETTLEMENT->value || $status->status == ClaimStatus::COLLECTED->value)

        <?php
        $partialcount = DB::table('partial_pay')
            ->where('claim_id', $claim->id)
            ->where('status', '<>', 5)
            ->count();
        $partialpay = DB::table('partial_pay')
            ->where('claim_id', $claim->id)
            ->where('status', '<>', 5)
            ->get();
        $claimstatus = DB::table('claim_status')
            ->where('claim_id', $claim->id)
            ->first();
        $payments = DB::table('payment')
            ->where('claim_id', $claim->id)
            ->where('response_code', 000)
            ->get();
        $partialDel = DB::table('partial_pay')
            ->where('claim_id', $claim->id)
            ->where('status', 5)
            ->get();
        ?>
        @if ($partialcount == 0 && $status->status == ClaimStatus::PARTIAL_SETTLEMENT->value)
            <form method="post" action="{{ url('admin/partial-pay') }}" id="partialform">
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claimid">
                <h6>Partial Settlement</h6>
                <div class="col-md-4">
                    <label class="form-label">Select Settlement Plan</label>
                    <!--	<select class="form-control" name="plan" id="partial">-->
                    <!--	<option value="2">2 payment</option>-->
                    <!--	<option value="3">3 payment</option>-->
                    <!--	<option value="4">4 payment</option>-->
                    <!--	<option vlaue="5">5 payment</option>-->
                    <!--	<option value="6">6 payment</option>-->
                    <!--</select>-->
                    <input type="number" class="form-control" name="plan" required>
                    <select name="type" class="form-control" required>
                        <option selected>Select Method</option>
                        <option value="sadad">Sadad Invoice</option>
                        <option value="online">Online Link</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Set Date</label>
                    <input type="datetime-local" class="form-control" name="pardate" id="partialpay" required>
                </div>

                <div class="col-md-6" style="margin-top:10px;margin-bottom:10px">
                    <input type="submit" class="btn btn-primary">
                </div>


            </form>
        @elseif($partialcount != 0 || $partialDel->count() != 0)
            <div class="col-md-12">
                <h4>

                    Settlement Plan: {{ $partialcount }}
                </h4>


                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-nowrap">Installment</th>
                                <th scope="col" class="text-nowrap">Amount</th>
                                <th scope="col" class="text-nowrap">SMS</th>
                                <th scope="col" class="text-nowrap">Status</th>
                                <th scope="col" class="text-nowrap">Due Date</th>
                                <th scope="col" class="text-nowrap">Recovered Date</th>
                                {{-- <th scope="col" class="text-nowrap">Link</th> --}}

                                <th scope="col" class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $partialPayInstallments = \App\Models\PartialPay::where('claim_id', $claim->id)->get();
                            @endphp

                            @foreach ($partialPayInstallments as $partialPayInstallment)
                                <tr>

                                    <td>{{ $partialPayInstallment->installment }}</td>
                                    <td>{{ $partialPayInstallment->amount }}</td>
                                    {{-- sms  --}}
                                    <td>
                                        @if ($partialPayInstallment->sms_status == \App\Enums\PartialPaySmsStatus::SMS_NOT_SEND->value)
                                            SMS Not Send Yet
                                        @elseif ($partialPayInstallment->sms_status == \App\Enums\PartialPaySmsStatus::SMS_SENT->value)
                                            SMS sent
                                        @elseif ($partialPayInstallment->sms_status == \App\Enums\PartialPaySmsStatus::ERROR_SENDING_SMS->value)
                                            Error while sending sms
                                        @endif
                                    </td>

                                    {{-- staus --}}
                                    <td>
                                        @if ($partialPayInstallment->status == \App\Enums\PartialPayStatus::UPCOMMING->value)
                                            <span class="bg-warning text-light"
                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;display: flex;font-weight: 700;">
                                                upcomming
                                            </span>
                                        @elseif($partialPayInstallment->status == \App\Enums\PartialPayStatus::ACTIVE->value)
                                            <span class="bg-success text-light"
                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;display: flex;font-weight: 700;">
                                                active
                                            </span>
                                        @elseif($partialPayInstallment->status == \App\Enums\PartialPayStatus::PAID->value)
                                            <span class="bg-primary text-light"
                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;display: flex;font-weight: 700;">
                                                paid
                                            </span>
                                        @elseif($partialPayInstallment->status == \App\Enums\PartialPayStatus::MANUAL_PAID->value)
                                            <span class="bg-dark text-light"
                                                style="border-radius: 4px;padding: 6px;font-size: 12px;width: 100%;display: flex;font-weight: 700;">
                                                manual paid
                                            </span>
                                        @endif

                                    </td>
                                    {{-- due date  --}}
                                    <td>{{ \Carbon\Carbon::parse($partialPayInstallment->date_time)->format('M d, Y | h:m') }}</td>

                                    <td>@if($partialPayInstallment->recovered_date){{ \Carbon\Carbon::parse($partialPayInstallment->recovered_date)->format('M d, Y | h:m') }} @else N/A @endif</td>
                                    {{-- <td>{{ $partialPayInstallment->link }}</td> --}}
                                    {{-- action  --}}
                                    <td>
                                        <div class="btn-group dropleft" style="cursor: pointer;">
                                            <div data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                    viewBox="0 0 16 16" height="24" width="24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="dropdown-menu" style="">

                                                @if ($partialPayInstallment->sms_status == \App\Enums\PartialPaySmsStatus::SMS_NOT_SEND->value)
                                                    <a class="dropdown-item" href="#">
                                                        Send SMS now
                                                    </a>
                                                @elseif($partialPayInstallment->sms_status == \App\Enums\PartialPaySmsStatus::ERROR_SENDING_SMS->value)
                                                    <a class="dropdown-item" href="#">
                                                        Send SMS again
                                                    </a>
                                                @endif

                                                @if ($partialPayInstallment->sms_status == \App\Enums\PartialPaySmsStatus::SMS_NOT_SEND->value)
                                                    <div class="dropdown-item" class="btn btn-primary"
                                                        data-toggle="modal" data-target="#partialDate"
                                                        onclick="changepartial({{ $partialPayInstallment->id }})">
                                                        Edit Date
                                                    </div>
                                                @elseif (
                                                    // $partialPayInstallment->sms_status == \App\Enums\PartialPaySmsStatus::SMS_SENT->value &&
                                                    $partialPayInstallment->status == \App\Enums\PartialPayStatus::ACTIVE->value)
                                                    <div class="dropdown-item" class="btn btn-primary"
                                                        data-toggle="modal" data-target="#partialManual"
                                                        onclick="manualpartialCollection({{ $partialPayInstallment->id . ',' . $partialPayInstallment->amount . ',\'' . $partialPayInstallment->date_time . '\',' . $partialPayInstallment->claim_id }})">
                                                        Manual Collection
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>


        @endif




    @endif

@endif

<x-admin::claim.status-modals />

<!-- manual collection Modal -->
<div class="modal fade modal-secondary text-left" id="partialManual" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1660" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ url('admin/partial-manual-collection') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1660">Installment Collection
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input id="manualpartialid" type="hidden" name="partial_pay_id">
                        <input id="manualpartialClaimId" type="hidden" name="claim_id">
                        {{-- <input id="manualpartialid" type="hidden" name="amount"> --}}
                        <label class="form-label">Installment Amount</label>
                        <input type="number" class="form-control" id="partial-pay-amount-modal" disabled>
                        <label class="form-label">Date</label>
                        <input type="datetime-local" name="cdate" class="form-control"
                            id="partial-pay-date-time-modal">
                        {{-- <label class="form-label">Remark (optional)</label>
                        <textarea class="form-control" name="remark" row="3" col="5"></textarea> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
