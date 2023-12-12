<?php

namespace App\Http\Controllers;

use App\Enums\ClaimStatus;
use App\Enums\LegalDepartmentStatus;
use App\Models\AdditionalDetail;
use App\Models\Claim;
use App\Models\Legal;
// use App\Models\LegalDepartment as ModelsLegalDepartment;
use DB;
use Illuminate\Http\Request;
use App\Models\LegalDepartmentModel;

class LegalDepartment extends Controller
{
    public function index()
    {
        return view('legaldepartment.dashboard');
    }

    public function legalDepartmentClaims()
    {
        $claims = Claim::with('claimData')->whereHas('statusee',function($query){
            $query->where('status',ClaimStatus::SEND_TO_LEGAL_DEPARTMENT->value);
        })->get();
        // dd($claim);
        return view('legaldepartment.reg_claims',compact('claims'));
    }

    public function claimDetail($claim_id)
    {

        // dd($claim_id);
        $claim = Claim::whereHas('statusee',function($query){
            $query->where('status',ClaimStatus::SEND_TO_LEGAL_DEPARTMENT->value);
        })
        ->where('id',$claim_id)
        ->first();
        return view('legaldepartment.view_claims.view_claim_detail',compact('claim'));
    }

    public function approveDocsCompelete(Request $request, $id)
    {
        $pending = LegalDepartmentStatus::PENDING->value;
        $approve = LegalDepartmentStatus::APPROVE->value;
        $reject = LegalDepartmentStatus::REJECT->value;
        $claimStatus =  LegalDepartmentModel::where('claim_id', $id)->first();
        // dd($claimStatus->status);
        DB::beginTransaction();
        try {
            if ($claimStatus->status  == $pending) {
                if ($request->status == 'reject') {
                    DB::table('legal_department_model')->where('claim_id', $id)->update([
                        'status' => $reject
                    ]);
                    DB::commit();
                    session()->put('success', 'Documents are not complete');
                    return redirect()->back();
                }else{
                    DB::table('legal_department_model')->where('claim_id', $id)->update([
                        'status' => $approve
                    ]);
                    DB::commit();
                    session()->put('success', 'Documents are compelete');
                    return redirect()->back();
                }
            } else {
                DB::table('legal_department_model')->where('claim_id', $id)->update([
                    'status' => $pending
                ]);
                DB::commit();
                session()->put('success', 'Documents are not compelete');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            DB::rollBack();
        }
    }
    
    public function additionalDetail(Request $request)
    {
        $request->validate([
            'reference_no' => 'required',
            'date_time' => 'required',
        ]);

        DB::beginTransaction();
        try{
            AdditionalDetail::create($request->input());
            DB::commit();
            session()->put('success','Additional Detail add successfully!');
            return redirect()->back();
        }catch(\Exception $e){
            $message = $e->getMessage();
            session()->put('error','Something went wrong');
            return redirect()->back();
        }
    }
    
     public function courtVerdictIssued($claim_id, $status)
    {
        // $noVertdictIssue = ;
        // $yesVerdictIssue = 
        DB::beginTransaction();
        // try{
            if(!empty($claim_id)){
                $claimVerdictIssue = LegalDepartmentModel::where('claim_id',$claim_id)->first();
                $court = $claimVerdictIssue->court;
                // dd((int) $table);
                if($status == 'yes'){
                    $update = DB::table('legal_department_model')->where('claim_id',$claim_id)->update([
                        'court' =>  LegalDepartmentStatus::COURT_VERDICT_ISSUED_YES->value,
                    ]);
                    DB::commit();
                    session()->put('success','Court verdict issued');
                    return redirect()->back();
                }
                elseif($status == 'no'){

                    $update = DB::table('legal_department_model')
                    ->where('claim_id',$claim_id)->update([
                        'court' =>LegalDepartmentStatus::COURT_VERDICT_ISSUED_NO->value,
                    ]);
                    DB::commit();
                    session()->put('success','No court verdict issued');
                    return redirect()->back();
                }
                else{
                    return abort(400,'court verdict issue status is not valid');
                }
            }
        // }catch(\Exception $e){
        //     $message = $e->getMessage();
        //     DB::rollBack();
        // }
        
    }
    
    
}
