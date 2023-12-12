<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;
    // protected $fillable=['rec_amt','acc_date','acc_location','rec_reason','deb_iqama','deb_name','deb_age','deb_mob','deb_type'];

    protected $guarded = ['id'];
    public function usere()
    {
        return $this->belongsTo(User::class,'cid', 'id');
    }
    public function companyname()
    {
        return $this->belongsTo(Company::class,'company_id', 'id');
    }
    // public function claimstatus()
    // {
    //     return $this->hasOne('ClaimStatus');
    // }

    public function statusee()
    {
        return $this->hasOne(ClaimStatus::class);
    }

    public function response()
    {
        return $this->hasOne(DebtorResponse::class);
    }
    public function paymentCheck(){
        $payexist = payment::where('claim_id',$this->id)->count();
        $payment = payment::where('claim_id',$this->id)->where('response_code',000)->sum('amount');
        if($payexist != 0){
            if($payment == $this->amount_after_discount){
                return 1;
            }else{
                return 2;
            }
        }else{

            $collectexist= CollectedClaim::where('claim_id',$this->id)->count();
            $collected = CollectedClaim::where('claim_id',$this->id)->first();
            if($collectexist != 0){

                if($collected->payment== 'bank'  || $collected->payment=='cash'){
                    return 1;
                }else{
                    return 3;
                }
            }else{
                return 0;
            }
        }


    }

     public function partialPaymentRe()
    {
        return $this->hasMany(PartialPay::class);
    }

    public function additionalLinks()
    {
        return $this->hasMany(PaymentLink::class);
    }

    public function additionalSadadLinks()
    {
        return $this->hasMany(AdditionalSadad::class);
    }
    public function sadadPayment()
    {
        return $this->hasMany(SadadPay::class);
    }
    public function manualPartial()
    {
        return $this->hasMany(PartialManual::class);
    }

    public function claimData()
    {
        return $this->hasOne(ClaimData::class);
    }

    public function supportedDocs(){
        return $this->hasMany(Supported_Doc::class, 'claim_id');
    }

    public function officer(){
        return $this->belongsTo(User::class, 'is_assign');
    }


    public function legalCase()
    {
        return $this->hasOne(LegalDepartment::class, 'claim_id');
    }
}
