<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AdditionalSadad
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSadad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSadad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdditionalSadad query()
 */
	class AdditionalSadad extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AdminDoc
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AdminDoc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminDoc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminDoc query()
 */
	class AdminDoc extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ApproveLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ApproveLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApproveLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApproveLog query()
 */
	class ApproveLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Batch
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Batch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Batch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Batch query()
 */
	class Batch extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CallStatus
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CallStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CallStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CallStatus query()
 */
	class CallStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Claim
 *
 * @property int $id
 * @property int $cid
 * @property string $rec_amt
 * @property string $acc_date
 * @property string $acc_location
 * @property string $rec_reason
 * @property string $deb_iqama
 * @property string|null $deb_name
 * @property string|null $deb_age
 * @property string|null $deb_mob
 * @property string|null $deb_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $status
 * @property string|null $claim_no
 * @property string|null $link
 * @property string|null $link_count
 * @property string|null $rejection_reason
 * @property string|null $pay_status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PaymentLink> $additionalLinks
 * @property-read int|null $additional_links_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AdditionalSadad> $additionalSadadLinks
 * @property-read int|null $additional_sadad_links_count
 * @property-read \App\Models\Company|null $companyname
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PartialManual> $manualPartial
 * @property-read int|null $manual_partial_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PartialPay> $partialPaymentRe
 * @property-read int|null $partial_payment_re_count
 * @property-read \App\Models\DebtorResponse|null $response
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SadadPay> $sadadPayment
 * @property-read int|null $sadad_payment_count
 * @property-read \App\Models\ClaimStatus|null $statusee
 * @property-read \App\Models\User $usere
 * @method static \Illuminate\Database\Eloquent\Builder|Claim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim query()
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereAccDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereAccLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereClaimNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereDebAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereDebIqama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereDebMob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereDebName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereDebType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereLinkCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereRecAmt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereRecReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereRejectionReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Claim whereUpdatedAt($value)
 */
	class Claim extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClaimComment
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimComment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimComment query()
 */
	class ClaimComment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClaimReason
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimReason query()
 */
	class ClaimReason extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClaimRemark
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimRemark newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimRemark newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimRemark query()
 */
	class ClaimRemark extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClaimStatus
 *
 * @property-read \App\Models\Claim|null $claim
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClaimStatus query()
 */
	class ClaimStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CollectedClaim
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CollectedClaim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CollectedClaim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CollectedClaim query()
 */
	class CollectedClaim extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Company
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 */
	class Company extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContactUs
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ContactUs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactUs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactUs query()
 */
	class ContactUs extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CustomPartialMada
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPartialMada newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPartialMada newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPartialMada query()
 */
	class CustomPartialMada extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CustomPartialSadad
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPartialSadad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPartialSadad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPartialSadad query()
 */
	class CustomPartialSadad extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DebDoc
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DebDoc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DebDoc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DebDoc query()
 */
	class DebDoc extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DebIvrResponse
 *
 * @property int $id
 * @property int $claim_id
 * @property int $response
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $pay_status
 * @method static \Illuminate\Database\Eloquent\Builder|DebIvrResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DebIvrResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DebIvrResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|DebIvrResponse whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebIvrResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebIvrResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebIvrResponse wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebIvrResponse whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebIvrResponse whereUpdatedAt($value)
 */
	class DebIvrResponse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DebtorRefuse
 *
 * @property int $id
 * @property int $debtorresponse_id
 * @property int $lawfirm_id
 * @property string|null $status 1 lawfirm accept the case
 * 2 law firm ask for additional doc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $caseprogress
 * @property string|null $add_doc
 * @property string|null $verdict
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuse query()
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuse whereAddDoc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuse whereCaseprogress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuse whereDebtorresponseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuse whereLawfirmId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuse whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuse whereVerdict($value)
 */
	class DebtorRefuse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DebtorRefuseReason
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuseReason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuseReason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorRefuseReason query()
 */
	class DebtorRefuseReason extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DebtorResponse
 *
 * @property int $id
 * @property int $claim_id
 * @property string $response 1 objection 
 * 2 refuse
 * 3 direct pay 
 * 4 loan application
 * @property string|null $objection
 * @property string|null $obj_status 1 valid by admin
 * 0 invalid by admin
 * 3 valid by company
 * 4 invalid by company
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Claim|null $claimRes
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorResponse whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorResponse whereObjStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorResponse whereObjection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorResponse whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DebtorResponse whereUpdatedAt($value)
 */
	class DebtorResponse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DelayError
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DelayError newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DelayError newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DelayError query()
 */
	class DelayError extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Distribution
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Distribution newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Distribution newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Distribution query()
 */
	class Distribution extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DivideClaim
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DivideClaim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DivideClaim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DivideClaim query()
 */
	class DivideClaim extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ElmStatus
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ElmStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ElmStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ElmStatus query()
 */
	class ElmStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FileBin
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FileBin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileBin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FileBin query()
 */
	class FileBin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FinanceCase
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceCase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceCase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceCase query()
 */
	class FinanceCase extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FinancialCompany
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinancialCompany query()
 */
	class FinancialCompany extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\IcDoc
 *
 * @method static \Illuminate\Database\Eloquent\Builder|IcDoc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IcDoc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IcDoc query()
 */
	class IcDoc extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LawFirmCase
 *
 * @method static \Illuminate\Database\Eloquent\Builder|LawFirmCase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LawFirmCase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LawFirmCase query()
 */
	class LawFirmCase extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Loan
 *
 * @property int $id
 * @property int $claim_id
 * @property int $company_id
 * @property string|null $status 0 new request 1 company accept 2 company rejeced
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Loan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereUpdatedAt($value)
 */
	class Loan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Message
 *
 * @property int $id
 * @property string $sender_id
 * @property string $receiver_id
 * @property string $claim_id
 * @property string $status
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereReceiverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Notification
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PartialManual
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PartialManual newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartialManual newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartialManual query()
 */
	class PartialManual extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PartialPay
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PartialPay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartialPay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartialPay query()
 */
	class PartialPay extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PayDelay
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PayDelay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayDelay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PayDelay query()
 */
	class PayDelay extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentLink
 *
 * @property-read \App\Models\Claim|null $paymnetLink
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentLink query()
 */
	class PaymentLink extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PreClaim
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PreClaim newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PreClaim newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PreClaim query()
 */
	class PreClaim extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Reason
 *
 * @property int $id
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Reason newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reason newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reason query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reason whereUpdatedAt($value)
 */
	class Reason extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SadadPay
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SadadPay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SadadPay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SadadPay query()
 */
	class SadadPay extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SadadResponse
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SadadResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SadadResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SadadResponse query()
 */
	class SadadResponse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SmsResponse
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SmsResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmsResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SmsResponse query()
 */
	class SmsResponse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StatusHistory
 *
 * @method static \Illuminate\Database\Eloquent\Builder|StatusHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusHistory query()
 */
	class StatusHistory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Supported_Doc
 *
 * @property int $id
 * @property int $company_id
 * @property string $doc_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $claim_id
 * @method static \Illuminate\Database\Eloquent\Builder|Supported_Doc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supported_Doc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Supported_Doc query()
 * @method static \Illuminate\Database\Eloquent\Builder|Supported_Doc whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supported_Doc whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supported_Doc whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supported_Doc whereDocName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supported_Doc whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Supported_Doc whereUpdatedAt($value)
 */
	class Supported_Doc extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TransferMorror
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TransferMorror newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransferMorror newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransferMorror query()
 */
	class TransferMorror extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $cr_code
 * @property string|null $type
 * @property string|null $roll
 * @property string|null $address
 * @property string|null $age
 * @property string|null $phone
 * @property string|null $iss_status
 * @property string|null $status
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $reg_no
 * @property string|null $idc
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCrCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIdc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIssStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRegNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\payment
 *
 * @property int $id
 * @property int $claim_id
 * @property string|null $payment_id
 * @property string|null $result
 * @property string|null $track_id
 * @property string|null $auth_code
 * @property string|null $response_code
 * @property string|null $rrn
 * @property string|null $amount
 * @property string|null $card_brand
 * @property string|null $masked_pan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereAuthCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereCardBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereClaimId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereMaskedPan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereResponseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereRrn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereTrackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|payment whereUpdatedAt($value)
 */
	class payment extends \Eloquent {}
}

