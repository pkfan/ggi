<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\payment;
use App\Models\SadadResponse;
use App\Models\PartialManual;
use App\Models\DebtorBankTransfer;
class GraphContoller extends Controller
{
    public function collectedClaim($year){

        $year = $year;
        $directEveryMonth=[];
        for($i=1;$i<=12;$i++){
            $bankTransfer = DebtorBankTransfer::join('claims','claims.id','=','debtor_bank_transfers.claim_id')
            ->whereYear('debtor_bank_transfers.created_at',$year)->whereMonth('debtor_bank_transfers.created_at',$i)
            ->where('debtor_bank_transfers.status',2)
            ->sum('debtor_bank_transfers.amount');

            $partialManual = PartialManual::join('claims','claims.id','=','partial_manual.claim_id')
            ->whereYear('partial_manual.created_at',$year)->whereMonth('partial_manual.created_at',$i)->sum('partial_manual.amount');

            $directEveryMonth[$i] =  $bankTransfer +  $partialManual;
        }
   
        return response($directEveryMonth,200);
        



    }

    public function collectedClaimUser($year,$id){

        $year = $year;
        $directEveryMonth=[];
        for($i=1;$i<=12;$i++){
            $bankTransfer = DebtorBankTransfer::join('claims','claims.id','=','debtor_bank_transfers.claim_id')
            ->whereYear('debtor_bank_transfers.created_at',$year)->whereMonth('debtor_bank_transfers.created_at',$i)
            ->where('debtor_bank_transfers.status',2)->where('claims.is_assign',$id)
            ->sum('debtor_bank_transfers.amount');

            $partialManual = PartialManual::join('claims','claims.id','=','partial_manual.claim_id')
            ->whereYear('partial_manual.created_at',$year)->whereMonth('partial_manual.created_at',$i)
            ->where('claims.is_assign',$id)
            ->sum('partial_manual.amount');
            $directEveryMonth[$i] =  $bankTransfer +  $partialManual;
        }
   
        return response($directEveryMonth,200);
        



    }
}
