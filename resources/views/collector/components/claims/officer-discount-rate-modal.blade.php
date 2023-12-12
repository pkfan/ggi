@props(['claim'])

<div class="d-inline-block">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-outline-dark btn-sm"
        style="max-width: 115px;background: linear-gradient(-180deg, white, #adadad);" data-toggle="modal"
        data-target="#debtor-discount-rate">@lang('language.Debtor Discount')</button>
    <!-- Modal -->
    <div class="modal fade modal-secondary text-left" id="debtor-discount-rate" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel130" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel130">@lang('language.Debtor Discount')
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                        $officerDiscountRate = \App\Models\OfficerDiscountRate::firstWhere('officer_id', auth()->user()->id);
                    @endphp
                    <form method="POST" action="{{ route('officer.debtor.discount-rate.store') }}">
                        @csrf

                        <input type="hidden" name="claim_id" value="{{ $claim->id }}">
                        <input type="hidden" name="total_claim_amount" value="{{ $claim->rec_amt }}">
                        <input type="hidden" name="officer_discount_rate"
                            value="{{ $officerDiscountRate?->discount }}">

                        <div class="row justify-content-center">
                            <div class="col-8 mb-1"
                                style="border: 1px solid #dddddd;border-radius: 8px;padding: 16px;position:relative;margin-top: 16px;">
                                <p
                                    style="position: absolute;top: 0;left: 50%;transform: translate(-50%, -12px);background: white;">
                                    Request/Set Debtor Discount
                                </p>

                                <div class="form-row">
                                    <div class="col-md-2 col-12">
                                        <label for="validationTooltip01">Discount (%)</label>
                                        <input type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*"
                                            class="form-control" id="debtor-discount-percentage"
                                            required name="percent">
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label for="validationTooltip02">Total Amount</label>
                                        {{-- this value cannot be used because of disable so hidden input field created  --}}
                                        <input type="number" class="form-control" id="total-claim-amount"
                                            value="{{ $claim->rec_amt }}"
                                            disabled>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <label for="validationTooltip03">After Discount</label>
                                        <input type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*"
                                            class="form-control" id="claim-amount-after-discount"
                                            required name="after_discount">
                                    </div>
                                    <div class="col-md-2 col-12 align-self-end">
                                        <button class="btn btn-primary waves-effect" type="submit"
                                            style="font-size: 12px;">
                                            SUBMIT
                                        </button>
                                    </div>
                                </div>

                                {{-- <div id="request-to-supervisor-notice" class="d-none alert alert-warning" role="alert" --}}
                                <div class="alert alert-warning" role="alert"
                                    style="padding: 8px;margin-top: 4px;">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1"
                                        viewBox="0 0 16 16" height="1em" width="1em"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8 1.45l6.705 13.363h-13.409l6.705-13.363zM8 0c-0.345 0-0.69 0.233-0.951 0.698l-6.829 13.611c-0.523 0.93-0.078 1.691 0.989 1.691h13.583c1.067 0 1.512-0.761 0.989-1.691h0l-6.829-13.611c-0.262-0.465-0.606-0.698-0.951-0.698v0z">
                                        </path>
                                        <path
                                            d="M9 13c0 0.552-0.448 1-1 1s-1-0.448-1-1c0-0.552 0.448-1 1-1s1 0.448 1 1z">
                                        </path>
                                        <path
                                            d="M8 11c-0.552 0-1-0.448-1-1v-3c0-0.552 0.448-1 1-1s1 0.448 1 1v3c0 0.552-0.448 1-1 1z">
                                        </path>
                                    </svg> <span>
                                        New Request will be sent to Supervisor because your discount is greater than
                                        {{ $officerDiscountRate?->discount ?? 10 }}%
                                    </span>
                                </div>
                            </div>

                        </div>
                    </form>

                    <div style="width: 100%;border-top: 1px solid #d1d1d1;margin-top: 12px;">
                        <h4 style="padding-top: 24px;">
                            Requested/Set Discount History
                        </h4>
                    </div>


                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-nowrap"
                                        style="background-color: #6c6c6c;color: white;">#</th>
                                    <th scope="col" class="text-nowrap"
                                        style="background-color: #6c6c6c;color: white;">Requested Dis (%)</th>
                                    <th scope="col" class="text-nowrap"
                                        style="background-color: #6c6c6c;color: white;">Total</th>
                                    <th scope="col" class="text-nowrap"
                                        style="background-color: #6c6c6c;color: white;">After Discount</th>
                                    <th scope="col" class="text-nowrap"
                                        style="background-color: #6c6c6c;color: white;">Processed By</th>
                                    <th scope="col" class="text-nowrap"
                                        style="background-color: #6c6c6c;color: white;">Status</th>
                                    <th scope="col" class="text-nowrap"
                                        style="background-color: #6c6c6c;color: white;">Requested Date</th>
                                    <th scope="col" class="text-nowrap"
                                        style="background-color: #6c6c6c;color: white;">Accept/Reject Date</th>


                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // $debDiscounts = \App\Models\DebDiscount::with('processor','debDiscount')->get();

                                    $debDiscounts = \App\Models\DebDiscount::with('processor')->where('claim_id',$claim->id)->get();

                                    // dd($debDiscounts);
                                    $count = 1;
                                @endphp
                                @foreach ($debDiscounts as $debDiscount)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $debDiscount->requested_percentage }}%
                                        </td>
                                        <td>{{ $debDiscount->total_claim_amount }}</td>
                                        <td>{{ $debDiscount->after_discount }}</td>
                                        @php
                                            $processorName = 'default';
                                            if($debDiscount->processor?->name && $debDiscount->process_date){
                                                $processorName = $debDiscount->processor?->name;
                                            }
                                            elseif(! $debDiscount->process_date){
                                                $processorName = "N/A";
                                            }
                                        @endphp
                                        <td>{{ $processorName }}</td>
                                        <td>
                                            @if ($debDiscount->status == \App\Enums\DebDiscountRequestStatus::PENDING->value)
                                                <div
                                                    style="background-color: #f1f19d;text-align: center;font-weight: 700;padding: 4px;border-radius: 50%;font-size: 12px;">
                                                    pending
                                                </div>
                                            @elseif($debDiscount->status == \App\Enums\DebDiscountRequestStatus::APPROVE->value)
                                                <div
                                                    style="background-color: #68ff68;text-align: center;font-weight: 700;padding: 4px;border-radius: 50%;font-size: 12px;">
                                                    approved
                                                </div>
                                            @elseif($debDiscount->status == \App\Enums\DebDiscountRequestStatus::REJECT->value)
                                                <div
                                                    style="background-color: #ffb2b2;text-align: center;font-weight: 700;padding: 4px;border-radius: 50%;font-size: 12px;">
                                                    rejected
                                                </div>
                                            @else
                                                <div
                                                    style="background-color: #ffc942;text-align: center;font-weight: 700;padding: 4px;border-radius: 50%;font-size: 12px;">
                                                    Discard
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($debDiscount->created_at)->format('M d Y') }}</td>
                                        <td>
                                            @if ($debDiscount->process_date)
                                                {{ \Carbon\Carbon::parse($debDiscount->process_date)->format('M d Y') }}
                                            @else
                                                N/A
                                            @endif
                                        </td>


                                    </tr>

                                    @php
                                        $count++;
                                    @endphp
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let officerAllowDiscountPercentageRate = {!! $officerDiscountRate?->discount ?? 0 !!};


    if (!officerAllowDiscountPercentageRate) {
        officerAllowDiscountPercentageRate = 10;
    }

    let totalClaimAmount = document.querySelector('#total-claim-amount');
    let debtorDiscountPercentage = document.querySelector('#debtor-discount-percentage');
    let claimAmountAfterDiscount = document.querySelector('#claim-amount-after-discount');
    let requestToSupervisorNoticeNode = document.querySelector('#request-to-supervisor-notice');

    function requestToSupervisorNotice(percent) {
        if (Number(percent) <= officerAllowDiscountPercentageRate) {
            requestToSupervisorNoticeNode.classList.add('d-none');
        } else {
            requestToSupervisorNoticeNode.classList.remove('d-none');
        }
    }

    debtorDiscountPercentage.addEventListener('input', () => {
        console.log(debtorDiscountPercentage.value)

        if (Number(debtorDiscountPercentage.value) < 0 || Number(debtorDiscountPercentage.value) > 100) {
            alert('Discount Percentage must be from 0 to 100');
            debtorDiscountPercentage.value = null;
            claimAmountAfterDiscount.value = null;
        } else {
            let discountedAmount = (Number(debtorDiscountPercentage.value) / 100) * Number(totalClaimAmount.value);
            let afterDiscount = Number(totalClaimAmount.value) - discountedAmount;
            console.log('afterDiscount', afterDiscount);
            claimAmountAfterDiscount.value = afterDiscount.toFixed(2);
        }

        requestToSupervisorNotice(debtorDiscountPercentage.value);
    });

    claimAmountAfterDiscount.addEventListener('input', () => {
        console.log(claimAmountAfterDiscount.value)

        if (Number(claimAmountAfterDiscount.value) < 0) {
            alert(`Discount Amount must be greater than 0`);
            debtorDiscountPercentage.value = null;
            claimAmountAfterDiscount.value = null;
        } else if (Number(claimAmountAfterDiscount.value) > Number(totalClaimAmount.value)) {
            alert(`Discount Amount cannot be greater than total amount;`);
            debtorDiscountPercentage.value = null;
            claimAmountAfterDiscount.value = null;
        } else {
            let discount = (Number(claimAmountAfterDiscount.value) / Number(totalClaimAmount.value)) * 100;
            console.log('discount', discount);
            debtorDiscountPercentage.value = discount.toFixed(2);
        }

        requestToSupervisorNotice(debtorDiscountPercentage.value);
    });
</script>
