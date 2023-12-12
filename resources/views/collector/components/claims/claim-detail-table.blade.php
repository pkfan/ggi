@props([
    'claim'=>null,
    'status'=>null,
])

<div class="card-body">


    <div class="row">
        @php
            $recoverdClaimAmount = 0;
            $recoverdClaimAmountPercent = 0;

            $remainingClaimAmount = 0;
            $remainingClaimAmountPercent = 0;

            $claimStatus = \App\Models\ClaimStatus::firstWhere('claim_id', $claim->id);

            if ($claimStatus?->status == \App\Enums\ClaimStatus::COLLECTED->value) {
                $collectedClaim = \App\Models\CollectedClaim::firstWhere('claim_id', $claim->id);

                if ($collectedClaim) {
                    $recoverdClaimAmount = $claim->amount_after_discount;
                    $recoverdClaimAmountPercent = 100;

                    $remainingClaimAmount = 0;
                    $remainingClaimAmountPercent = 0;
                }
            } elseif ($claimStatus?->status == \App\Enums\ClaimStatus::PARTIAL_SETTLEMENT->value) {
                $partialPayInstallments = \App\Models\PartialPay::where('claim_id', $claim->id)->get();

                foreach ($partialPayInstallments as $partialPayInstallment) {
                    if ($partialPayInstallment->status == \App\Enums\PartialPayStatus::PAID->value || $partialPayInstallment->status == \App\Enums\PartialPayStatus::MANUAL_PAID->value) {
                        $recoverdClaimAmount += (int) $partialPayInstallment->amount;
                    } else {
                        $remainingClaimAmount += (int) $partialPayInstallment->amount;
                    }
                }

                $amount_after_discount = $claim->amount_after_discount;

                $recoverdClaimAmountPercent = round(($recoverdClaimAmount / $amount_after_discount) * 100, 2);
                $remainingClaimAmountPercent = round(($remainingClaimAmount / $amount_after_discount) * 100, 2);
            }
            $hasAdditionalDetail = \App\Models\AdditionalDetail::firstWhere('claim_id',$claim->id);
            $hasCourtVerdictIussued = \App\Models\LegalDepartmentModel::firstWhere('claim_id',$claim->id);
            $claimData = \App\Models\ClaimData::where('claim_id',$claim->id)->first();
        @endphp
        <table class="table table-borderless" style=" border: 1px solid #e1e0e0;">

            <tbody style=" background: #f5f5f5;">

                <tr style="padding-left: 61px;">
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">@lang('language.Reserve Amount')</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span
                            class="font-weight-bolder">{{ $claim->amount_after_discount }}</span>
                    </td>
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">@lang('language.Claim Number')</span>
                    </td>
                    <td style="width: 200px; ">
                        <span class="font-weight-bolder">{{ $claim->claim_no }}</span>
                    </td>
                </tr>
               
                
                {{-- //////////////////// --}}
                <tr style="padding-left: 61px;">
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">@lang('language.Policy Number')</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span
                            class="font-weight-bolder">{{ $claim->claimData?->policy_no }}</span>
                    </td>
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Recovery Request Date</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span class="font-weight-bolder">{{ $claimData->recovery_request_date }}</span>
                    </td>
                    <!-- <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">@lang('language.MT Plate No')</span>
                    </td>
                    <td style="width: 200px; ">
                        <span
                            class="font-weight-bolder">{{ $claim->claimData?->plate_no }}</span>
                    </td> -->
                </tr>
                {{-- ////////////////////// --}}

                <tr style="padding-left: 61px;">
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">@lang('language.City')</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span
                            class="font-weight-bolder">{{ $claim->acc_location }}</span>
                    </td>
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">GGI Remarks</span>
                    </td>
                    <td style="width: 200px; ">
                        <span
                            class="font-weight-bolder">{{ $claim->claimData?->remarks }}</span>
                        <span class="pen-icon" data-toggle="modal" data-target="#myModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 font-medium-3 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                        </span>
                       
                        <x-remark-component :claimId="$claim" />
                    </td>
                </tr>
                <tr style="padding-left: 61px;">
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">@lang('language.Accident Report Number')</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span
                            class="font-weight-bolder">{{ $claim->claimData?->accident_report_number }}</span>
                    </td>
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">@lang('language.Accident Date')</span>
                    </td>
                    <td style="width: 200px; ">
                        <span class="font-weight-bolder">{{ $claim->acc_date }}</span>
                    </td>
                </tr>
                <tr style="padding-left: 61px;">
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">@lang('language.Registration Date')</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span
                            class="font-weight-bolder">{{ $claim->claimData?->registration_date }}</span>
                    </td>
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">@lang('language.Recoveree Name')</span>
                    </td>
                    <td style="width: 200px; ">
                        <span class="font-weight-bolder">{{ $claim->deb_name }}</span>
                    </td>
                </tr>
                <tr style="padding-left: 61px;">
                    <!-- <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">@lang('language.Recovery Type')</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span
                            class="font-weight-bolder">{{ $claim->claimData?->recovery_type }}</span>
                    </td> -->
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Debtor ID</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span
                            class="font-weight-bolder">{{ $claim->deb_iqama }}</span>
                    </td>
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">@lang('language.Debtor Mobile Number')</span>
                    </td>
                    <td style="width: 200px; ">
                        <span class="font-weight-bolder">{{ $claim->deb_mob }}</span>
                    </td>
                </tr>
                <tr style="padding-left: 61px;">
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;padding-left:32px;">
                        <span class="font-weight-bolder">@lang('language.Debtor Age')</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span class="font-weight-bolder">{{ $claim->deb_age }}</span>
                    </td>
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">@lang('language.Type')</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span class="font-weight-bolder">{{ $claim->type }}</span>
                    </td>
                    
                </tr>
                <tr style="padding-left: 61px;">
                    
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">@lang('language.Our Responsipility Per')</span>
                    </td>
                    <td style="width: 200px; ">
                        <span
                            class="font-weight-bolder">{{ $claim->libpercent }}%</span>
                    </td>
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Recovery Reason</span>
                    </td>
                    <td style="width: 200px; ">
                        <span
                            class="font-weight-bolder">{{ $claim->rec_reason }}</span>
                    </td>
                </tr>
                <!-- <tr style="padding-left: 61px;">
                    
                    
                </tr> -->
                <tr style="padding-left: 61px;">
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Officer</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span
                            class="font-weight-bolder">{{ $claim?->officer?->name }}</span>
                    </td>
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Supportive Document</span>
                    </td>
                    <td style="width: 200px; ">
                        <ol>
                            @foreach (getdoc($claim->id) as $doc)
                                <li>
                                    <a href="{{ asset('storage/' . $doc->doc_name) }}"
                                        target="_blank">@lang('language.Supportive Doc')</a>
                                    <a href="{{ route('supportive.docs.delete', ['doc_id' => $doc->id]) }}"
                                        style="color:#e94f4f">
                                        <svg stroke="currentColor" fill="currentColor"
                                            stroke-width="0" viewBox="0 0 24 24"
                                            height="20" width="20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill="none" d="M0 0h24v24H0V0z">
                                            </path>
                                            <path
                                                d="M14.12 10.47L12 12.59l-2.13-2.12-1.41 1.41L10.59 14l-2.12 2.12 1.41 1.41L12 15.41l2.12 2.12 1.41-1.41L13.41 14l2.12-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4zM6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9z">
                                            </path>
                                        </svg>
                                    </a>
                                    <br>
                                </li>
                            @endforeach
                        </ol>
                    </td>


                </tr>
                <tr style="padding-left: 61px;">
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Additional Document</span>
                    </td>
                    <td style="width: 200px; ">
                        <ol>
                            @php
                                $admindoc = DB::table('admin_doc')
                                    ->where('claim_id', $claim->id)
                                    ->get();
                            @endphp
                            @foreach ($admindoc as $doc1)
                                <li>
                                    <a href="{{ asset('storage/' . $doc1->document) }}"
                                        target="_blank">Additional Doc</a>
                                    <a href="{{ route('additional.docs.delete', ['doc_id' => $doc1->id]) }}"
                                        style="color:#e94f4f">
                                        <svg stroke="currentColor" fill="currentColor"
                                            stroke-width="0" viewBox="0 0 24 24"
                                            height="20" width="20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill="none" d="M0 0h24v24H0V0z">
                                            </path>
                                            <path
                                                d="M14.12 10.47L12 12.59l-2.13-2.12-1.41 1.41L10.59 14l-2.12 2.12 1.41 1.41L12 15.41l2.12 2.12 1.41-1.41L13.41 14l2.12-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4zM6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9z">
                                            </path>
                                        </svg>
                                    </a>
                                    <br>
                                </li>
                            @endforeach
                        </ol>
                    </td>
                    <td style="width: 200px; padding-left: 32px;">
                    </td>
                    <td style="width: 200px; ">

                    </td>
                </tr>
                @if($hasAdditionalDetail)
                <tr style="padding-left: 61px;">
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Reference No</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span class="font-weight-bolder">{{ $hasAdditionalDetail->reference_no }}</span>
                    </td>
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Date</span>
                    </td>
                    <td style="width: 200px; ">
                        <span class="font-weight-bolder">{{ $hasAdditionalDetail->date_time}}</span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Remarks</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span class="font-weight-bolder">{{$hasAdditionalDetail->remarks}}</span>
                    </td>
                    @if($hasCourtVerdictIussued)
                
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Court Verdict Issued</span>
                    </td>
                    <td style="width: 200px;">

                        @if($hasCourtVerdictIussued->court == \App\Enums\LegalDepartmentStatus::COURT_VERDICT_ISSUED_YES->value)
                        <span class="font-weight-bolder text-success">Yes</span>
                        @else
                        <span class="font-weight-bolder text-danger">No</span>
                        @endif

                    </td>
                @endif
                </tr>
                @endif

                <tr style="padding-left: 61px;">
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Intimation Date</span>
                    </td>
                    <td style="width: 200px; ">
                        <span
                            class="font-weight-bolder">{{ $claimData->intimation_date }}</span>
                    </td>
                </tr>

                <!-- <tr style="padding-left: 61px;">
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Policy Holder Liability</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span class="font-weight-bolder">{{ $claimData->policy_holder_liability }}</span>
                    </td>
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Recovery Party</span>
                    </td>
                    <td style="width: 200px; ">
                        <span
                            class="font-weight-bolder">{{ $claimData->recovery_party_id }}</span>
                    </td>
                </tr> -->

                <!-- <tr style="padding-left: 61px;">
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Recovery Party Name</span>
                    </td>
                    <td style="border-right: 1px solid #d3d2d2;width: 200px;">
                        <span class="font-weight-bolder">{{ $claimData->recovery_party_name }}</span>
                    </td>
                    <td style="width: 200px; padding-left: 32px;">
                        <span class="font-weight-bolder">Recovery Reserve Amount</span>
                    </td>
                    <td style="width: 200px; ">
                        <span
                            class="font-weight-bolder">{{ $claimData->recovery_reserve_amount }}</span>
                    </td>
                </tr> -->

                <tr style="padding-left: 61px;"></tr>
            </tbody>
        </table>
    </div>

</div>
