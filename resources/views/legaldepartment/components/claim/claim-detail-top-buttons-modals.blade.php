@props([
'claim'=>null,
])

<div>

    <div class="d-inline-block">
        <!-- Button trigger modal -->
        <a href="{{ route('admin.comment.id', ['id' => $claim->id]) }}">
            <button type="button" class="btn btn-outline-dark btn-sm" style="max-width: 115px;background: linear-gradient(-180deg, white, #adadad);" data-target="#primary">
                @lang('language.AddView Comments')
            </button>
        </a>
        @php
        $hasCourtVerdictIssued = \App\Models\LegalDepartmentModel::firstWhere('claim_id', $claim->id);
        @endphp
        @if($hasCourtVerdictIssued->court == \App\Enums\LegalDepartmentStatus::COURT_VERDICT_ISSUED_YES->value)
        <div class="d-inline-block">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-dark btn-sm" style="max-width: 115px;background: linear-gradient(-180deg, white, #adadad);" data-toggle="modal" data-target="#warning">
                @lang('language.Sadad Invoice')
            </button>
            <!-- Modal -->
            <div class="modal fade text-left modal-secondary" id="warning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        @php
                        $sadad = DB::table('sadad_pay')
                        ->where('claim_id', $claim->id)
                        ->get();
                        $additionalsadad = DB::table('additional_sadad')
                        ->where('claim_id', $claim->id)
                        ->get();
                        @endphp
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel140">@lang('language.Sadad Invoice')
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            @if ($sadad)
                            <h6>@lang('language.Sadad Number')</h6>
                            @foreach ($sadad as $sad)
                            {{ $sad->sadadNumber }}<br>
                            @endforeach
                            @endif
                            @if ($additionalsadad)
                            <!--<h6>Sadad Number</h6>-->
                            @foreach ($additionalsadad as $sad)
                            {{ $sad->sadadNumber }}<br>
                            @endforeach
                            @endif
                            <div class="mb-3">

                                @lang('language.Are you sure to send Sadad Invoice?')

                            </div>




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('language.No')</button>
                            <a href="{{ url('admin/sadad-link/' . $claim->id) }}" class="btn btn-primary">@lang('language.Yes')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Modal -->
        <!-- <div class="modal fade text-left modal-primary" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                                                                                                       </div> -->
    </div>

    @permission('call-history')
    <div class="d-inline-block">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-dark btn-sm" style="max-width: 90px;background: linear-gradient(-180deg, white, #adadad);" data-toggle="modal" data-target="#secondary">
            @lang('language.Call History')
        </button>
        <!-- Modal -->
        <div class="modal fade modal-secondary text-left" id="secondary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1660" aria-hidden="true">
            @php
            $res = DB::table('call_status')
            ->where('claim_id', $claim->id)
            ->get();
            // $calls = 1;
            @endphp
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1660">
                            @lang('language.Call History')
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">


                            <h4>Call History GGI00{{ $claim->id }}</h4>

                            @php
                            $calls = 1;
                            @endphp
                            @if ($res)
                            @foreach ($res as $resq)
                            <h6>Call:{{ $calls }}</h6>
                            @if ($resq->statuss != null)
                            <!--ye not equal to null tha -->

                            Duration:{{ $resq->duration }} <br>
                            Status:{{ $resq->statuss }}
                            @else
                            @php
                            $response = Http::withHeaders([
                            'AppsId' => 'lmfuLlmvVEKcOCMyxF1A',
                            'Content-Type' => 'application/json',
                            ])->get('https://voice.unifonic.com/v1/calls/' . $resq->callId);
                            @endphp
                            @if (isset($response['statusCode']) == false)
                            @if ($response != null)
                            Duration:{{ $response['status'] }}
                            Status: {{ $response['duration'] }}
                            @endif
                            @if ($response['status'] != 'completed')
                            <a href="{{ url('admin/call-again/' . $claim->id) }}" class="btn btn-primary">Call
                                Again</a>
                            @endif
                            @else
                            Error:{{ $response['statusCode'] }} <br>
                            <a href="{{ url('admin/call-again/' . $claim->id) }}" class="btn btn-primary">Call
                                Again</a>
                            @endif
                            @endif
                            @php
                            $calls + 1;
                            @endphp
                            @endforeach
                            @endif


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endpermission

    @permission('sms-history')
    <div class="d-inline-block">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-dark btn-sm" style="max-width: 90px;background: linear-gradient(-180deg, white, #adadad);" data-toggle="modal" data-target="#success">
            @lang('language.SMS History')
        </button>
        <!-- Modal -->
        <div class="modal fade text-left modal-primary" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-secondary" id="myModalLabel110">
                            @lang('language.SMS History')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">


                            <h4>SMS History GGI00{{ $claim->id }}</h4>
                            @php
                            $res = DB::table('sms_response')
                            ->where('claim_id', $claim->id)
                            ->get();
                            $calls = 1;
                            @endphp

                            @if ($res)
                            @foreach ($res as $sms)
                            <h6>Sms:{{ $calls }}</h6>
                            <b>MSGAT Message</b>:{{ $sms->message }}<br>
                            <b>Status:</b>
                            @if ($sms->code == 1)
                            Success
                            @elseif($sms->code == 'M0000')
                            Success
                            @elseif($sms->code == '1060')
                            Balance is not enough
                            @elseif($sms->code == '1120')
                            Mobile numbers is not correct
                            @elseif($sms->code = 'M0037')
                            Please send SMS by statist IP
                            @elseif($sms->code == '1061')
                            SMS Duplicated
                            @else
                            {{ $sms->code }}
                            @endif
                            <br>
                            <b>Message:</b>{{ $sms->sms }} <br>
                            <b>Date/Time:</b>{{ $sms->created_at }}<br>
                            <a href="{{ url('admin/resend/msg/' . $sms->claim_id.'/'.$sms->id) }}" class="btn btn-primary">Resend SMS</a>

                            <?php $calls++; ?>
                            @endforeach
                            @endif


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endpermission

    @if ($claim->link != null || $claim->status == 1)
    @permission('create-mada-settlement')
    <div class="d-inline-block">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-dark btn-sm" style="max-width: 115px;background: linear-gradient(-180deg, white, #adadad);" data-toggle="modal" data-target="#danger">
            @lang('language.Create Mada Settlement')
        </button>
        <!-- Modal -->
        <div class="modal fade modal-secondary text-left" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
            @php
            $payc = DB::table('payment_links')
            ->where('claim_id', $claim->id)
            ->count();
            $paylinks = DB::table('payment_links')
            ->where('claim_id', $claim->id)
            ->get();
            $clink = 1;
            @endphp
            <div class="modal-dialog modal-dialog-centered" role="document">

                {{-- form start  --}}
                <form action="{{ route('admin.create-payment-link') }}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel120">
                                Settlement
                                Links</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">

                                @if ($payc != 0)
                                @foreach ($paylinks as $link)
                                <b>Link generated</b>
                                {{ $clink }}<br>
                                Amount:{{ $link->amount }}<br>
                                Link:<span style="color:blue">{{ $link->link }}</span>
                                <br>
                                <?php $clink++; ?>
                                @endforeach
                                @endif
                            </div>

                            <div class="mb-3">


                                <h4>GGI00{{ $claim->id }}</h4>

                                <div class="mb-3">
                                    <input type="hidden" value="{{ $claim->id }}" name="claimid">

                                    <label>Add Amount</label>
                                    <input type="number" class="form-control" name="amount" required="">
                                    <input type="checkbox" name="save" class="form-checkbox" value="yes">
                                    Save link as new link in document?
                                </div>

                            </div>
                            {{-- /// --}}


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
                {{-- form end  --}}
            </div>
        </div>
    </div>
    @endpermission
    @permission('sadad-invoice')
    <div class="d-inline-block">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-dark btn-sm" style="max-width: 100px;background: linear-gradient(-180deg, white, #adadad);" data-toggle="modal" data-target="#warning">
            @lang('language.Sadad Invoice')
        </button>
        <!-- Modal -->
        <div class="modal fade text-left modal-secondary" id="warning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel140" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    @php
                    $sadad = DB::table('sadad_pay')
                    ->where('claim_id', $claim->id)
                    ->get();
                    $additionalsadad = DB::table('additional_sadad')
                    ->where('claim_id', $claim->id)
                    ->get();
                    @endphp
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel140">
                            @lang('language.Sadad Invoice')
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @if ($sadad)
                        <h6>@lang('language.Sadad Number')</h6>
                        @foreach ($sadad as $sad)
                        {{ $sad->sadadNumber }}<br>
                        @endforeach
                        @endif
                        @if ($additionalsadad)
                        <!--<h6>Sadad Number</h6>-->
                        @foreach ($additionalsadad as $sad)
                        {{ $sad->sadadNumber }}<br>
                        @endforeach
                        @endif
                        <div class="mb-3">

                            @lang('language.Are you sure to send Sadad Invoice?')

                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('language.No')</button>
                        <a href="{{ url('admin/sadad-link/' . $claim->id) }}" class="btn btn-primary">@lang('language.Yes')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endpermission
    @endif
    @permission('finance-report')
    <div class="d-inline-block">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-dark btn-sm" style="max-width: 115px;background: linear-gradient(-180deg, white, #adadad);" data-toggle="modal" data-target="#info">@lang('language.Finance Report')</button>
        <!-- Modal -->
        <div class="modal fade modal-secondary text-left" id="info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel130">
                            @lang('language.Finance Report')
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @php
                        $partialCount = DB::table('partial_pay')
                        ->where('claim_id', $claim->id)
                        ->count();
                        $partialSentCount = DB::table('partial_pay')
                        ->where('claim_id', $claim->id)
                        ->where('status', 2)
                        ->count();
                        $partailPayed = DB::table('partial_pay')
                        ->join('payment', 'payment.payment_id', '=', 'partial_pay.pay_id')
                        ->where('payment.response_code', '000')
                        ->where('partial_pay.claim_id', $claim->id)
                        ->count();
                        @endphp
                        <div class="mb-3">
                            @if ($partialCount != 0)
                            <h6>@lang('language.Settlement')</h6>
                            <p>@lang('language.Partial Link Settlement'): {{ $partialCount }}</p>
                            <p>@lang('language.Partial Settlement Link Sent'):
                                {{ $partialSentCount }}
                            </p>
                            <p>Settlement By Partial Link: {{ $partailPayed }}
                            </p>
                            @if ($partailPayed != 0)
                            <?php $payed = DB::table('partial_pay')
                                ->join('payment', 'payment.payment_id', '=', 'partial_pay.pay_id')
                                ->where('partial_pay.claim_id', $claim->id)
                                ->where('payment.response_code', '000')
                                ->select('payment.created_at', 'payment.amount')
                                ->get(); ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>@lang('language.Payed Date')</td>
                                        <td>@lang('language.Amount')</td>
                                    </tr>
                                </thead>
                                @foreach ($payed as $pays)
                                <tr>
                                    <td>
                                        {{ $pays->created_at }}
                                    </td>
                                    <td>
                                        {{ $pays->amount }}
                                    </td>
                                </tr>
                                @endforeach

                            </table>
                            @endif
                            @endif

                            <?php
                            $additionalLink = DB::table('payment_links')
                                ->where('claim_id', $claim->id)
                                ->get();
                            $recoveredLink = DB::table('payment_links')
                                ->join('payment', 'payment.payment_id', '=', 'payment_links.payment_id')
                                ->where('payment_links.claim_id', $claim->id)
                                ->where('payment.response_code', '000')
                                ->select('payment.amount', 'payment.created_at')
                                ->get();

                            ?>

                            @if ($additionalLink !== null)
                            <h6>@lang('language.Additional Link Created By Admin')</h6>
                            <p>@lang('language.Number of additional links'):
                                {{ $additionalLink->count() }}
                            </p>
                            @endif

                            @if ($recoveredLink->count() != 0)
                            <p>@lang('language.Number of recovery By additional links'):
                                {{ $recoveredLink->count() }}
                            </p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>@lang('language.Payed Date')</td>
                                        <td>@lang('language.Amount')</td>
                                    </tr>
                                </thead>
                                @foreach ($recoveredLink as $rec)
                                <tr>
                                    <td>{{ $rec->created_at }}</td>
                                    <td>{{ $rec->amount }}</td>
                                </tr>
                                @endforeach


                            </table>
                            @endif

                            <?php
                            $cashbankc = DB::table('claim_collected')
                                ->where('claim_id', $claim->id)
                                ->count();
                            ?>
                            @if ($cashbankc != 0)
                            <?php
                            $cashbank = DB::table('claim_collected')
                                ->where('claim_id', $claim->id)
                                ->first();
                            ?>
                            @if ($cashbank->payment == 'bank' || $cashbank->payment == 'cash')
                            <h6>@lang('language.Cash or Bank')</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>@lang('language.Payed Date')</td>
                                        <td>@lang('language.Amount')</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $cashbank->created_at }}
                                        </td>
                                        <td>{{ $claim->amount_after_discount }}
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                            @endif
                            @endif

                            <?php
                            $delaypay = DB::table('pay_delay')
                                ->where('claim_id', $claim->id)
                                ->where('status', '<>', 1)
                                ->get();

                            $delaypayrec = DB::table('pay_delay')
                                ->join('payment', 'pay_delay.pay_id', '=', 'payment.payment_id')
                                ->where('pay_delay.claim_id', $claim->id)
                                ->where('payment.response_code', '000')
                                ->select('payment.created_at', 'payment.amount')
                                ->get();
                            ?>
                            @if ($delaypay !== null)
                            <p>@lang('language.Delay links send'): {{ $delaypay->count() }}</p>
                            @if ($delaypayrec->count() != 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>@lang('language.Payed Date')</td>
                                        <td>@lang('language.Amount')</td>
                                    </tr>

                                    @foreach ($delaypayrec as $delaypay)
                                    <tr>
                                        <td>{{ $delaypay->created_at }}
                                        </td>
                                        <td>{{ $delaypay->amount }}
                                        </td>
                                    </tr>
                                    @endforeach

                                </thead>
                            </table>
                            @else
                            No recovery by delay link
                            @endif
                            @endif

                            <br>
                            <?php

                            $bankpay = DB::table('partial_manual')
                                ->where('claim_id', $claim->id)
                                ->get();

                            ?>
                            @if ($bankpay !== null && $bankpay->count() != 0)
                            <b>@lang('language.Manually Collected')</b>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>@lang('language.Payed Date')</td>
                                        <td>@lang('language.Amount')</td>
                                    </tr>

                                    @foreach ($bankpay as $bank)
                                    <tr>
                                        <td>{{ $bank->date }}</td>
                                        <td>{{ $bank->amount }}</td>
                                    </tr>
                                    @endforeach

                                </thead>
                            </table>
                            @endif

                            <?php
                            $sadadcollection = DB::table('sadad_response')
                                ->where('claimid', $claim->id)
                                ->where('responseCode', 000)
                                ->get();
                            $sadsent = DB::table('sadad_pay')
                                ->where('claim_id', $claim->id)
                                ->count();
                            $sadadd = DB::table('additional_sadad')
                                ->where('claim_id', $claim->id)
                                ->count();
                            ?>
                            @if ($sadadcollection->count() != 0)
                            <b>Sadad Link Send</b> {{ $sadsent + $sadadd }}<br>
                            <b>Sadad Collected</b>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Payed Date</td>
                                        <td>Amount</td>
                                    </tr>

                                    @foreach ($sadadcollection as $sadadc)
                                    <tr>
                                        <td>{{ $sadadc->created_at }}</td>
                                        <td>{{ $sadadc->amount }}</td>
                                    </tr>
                                    @endforeach

                                </thead>
                            </table>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endpermission

    <x-admin::claim.officer-discount-rate-modal :claim="$claim" />
</div>