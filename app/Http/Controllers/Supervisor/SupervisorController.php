<?php

namespace App\Http\Controllers\Supervisor;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Claim;
use App\Models\Company;
use App\Models\DebDiscount;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\OfficerTarget;
use App\Models\FinancialCompany;
use App\Models\DebDiscountRequest;
use App\Models\OfficerDiscountRate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Enums\DebDiscountRequestStatus;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\ClaimStatus as ClaimStatusEnum;
use App\Models\ClaimStatus;
use DB;
use App\Models\CollectionOffice;
// use App\Enums\ClaimStatus;
// use App\Models\Legal;
use App\Models\LegalDepartmentModel;
use App\Models\RequestChangeStatusModel;

class SupervisorController extends Controller
{
    public function officerDiscountRequests()
    {
        $defaultDiscount = 10;

        $debDiscountRequests = DebDiscount::with('processor', 'officer')
            ->where('status', DebDiscountRequestStatus::PENDING->value)
            ->orderByDesc('created_at')->paginate(10);
        return view('supervisor.officers-discount-requests', compact('debDiscountRequests'));
    }

    public function officerDiscountRequestsStatus($discount_request_id, $status)
    {
        if ($status == 'approve') {
            $debDiscount = DebDiscount::firstWhere('id', $discount_request_id);
            // discard/remove all previous approve/pending discounts of officer
            DebDiscount::where('claim_id', $debDiscount->claim_id)
                ->where(function ($query) {
                    $query->where('status', DebDiscountRequestStatus::APPROVE->value)
                        ->orWhere('status', DebDiscountRequestStatus::PENDING->value);
                })->update([
                    'status' => DebDiscountRequestStatus::DISCARD->value
                ]);
            // update current status
            DebDiscount::where('id', $discount_request_id)->update([
                'status' => DebDiscountRequestStatus::APPROVE->value,
                'process_by' => auth()->user()->id,
                'process_date' => now()
            ]);
            // apply approved discount to claim
            Claim::where('id', $debDiscount->claim_id)->update([
                'amount_after_discount' => $debDiscount->after_discount,
            ]);
            // notify to officer here or create/update table etc
            Notification::create([
                'from' => auth()->user()->id,
                'to' => $debDiscount->requested_by,
                'message' => "discount approved for claim GGI00{$debDiscount->claim_id}.",
                'type' => 'Discount Approved',
                'read' => false,
                'link' =>  route('officer.claims.discount.history',null, false)
            ]);
        } else if ($status == 'reject') {
            DebDiscount::where('id', $discount_request_id)->update([
                'status' => DebDiscountRequestStatus::REJECT->value,
                'process_by' => auth()->user()->id,
                'process_date' => now()
            ]);
        } else {
            throw new \InvalidArgumentException('Invalid Status type');
        }
        return back()->with('success', 'successfully updated status');
    }

    public function officersDiscountsList()
    {
        $officersDiscountRates = OfficerDiscountRate::with('officer', 'setter')
            ->orderByDesc('updated_at')
            ->paginate(10);

        return view('supervisor.officers-discount-rate-list', compact('officersDiscountRates'));
    }

    public function officerDiscountStore(Request $request)
    {
        $request->validate([
            'officer_id' => 'required',
            'discount' => 'required|numeric|between:0,100'
        ], [
            'officer_id.required' => 'Please choose officer from list to create/set discount rate for him.'
        ]);

        $officerDiscountRate = OfficerDiscountRate::create([
            'officer_id' => $request->officer_id,
            'set_by' => auth()->user()->id,
            'discount' => $request->discount
        ]);

        return back()->with('success', 'officer discount rate created successfully');
    }

    public function claimsDiscountHistory(Request $request)
    {
        $debDiscounts = DebDiscount::with('processor', 'officer')
            ->when($request->officer_id, function ($query, $officer_id) {
                $query->where('requested_by', $officer_id);
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('supervisor.discount-history', compact('debDiscounts'));
    }

    public function officerDiscountDelete($officer_discount_id)
    {
        OfficerDiscountRate::where('id', $officer_discount_id)->delete();

        return back()->with('success', 'Officer Discount Deleted.');
    }


    // ADDED BY TALHA
    public function sendToLegalDepartment(Request $request)
    {
        $countClaimStatus = ClaimStatus::where('claim_id',$request->claim_id)->count();
        if($countClaimStatus == 0){
            DB::beginTransaction();
            try{
                $createStatus = ClaimStatus::create([
                    'claim_id' => $request->claim_id,
                    'status' => $request->status,
                    'update_by' => Auth::user()->id,
                ]);
                LegalDepartmentModel::create([
                    'claim_id' => $createStatus->claim_id,
                    'remarks' => $request->remarks
                ]);
                Claim::where('id',$request->claim_id)->update([
                    'status' => $request->status,
                ]);
                statusHistory($createStatus->claim_id,$createStatus->status,Auth::user()->id);
                DB::commit();
                session()->put('success','Claim send to legal department');
                return redirect()->back();
            }catch(\Exception $e){
                DB::rollBack();
                session()->put('error',$e->getMessage());
                return redirect()->back();
            }
        }else{
            $updateStatus = ClaimStatus::where('claim_id',$request->claim_id)->update([
                'claim_id' => $request->claim_id,
                'status' => $request->status,
                'update_by' => Auth::user()->id,
            ]);
            Claim::where('id',$request->claim_id)->update([
                'status' => $request->status,
            ]);
            if($updateStatus){
                session()->put('success','Claim send to legal department');
                return redirect()->back();
            }else{
                session()->put('error','Somthing went wrong');
                return redirect()->back();
            }
        }
    }

    public function sendToCollectionOffice(Request $request)
    {
        $data = $request->validate([
            'claim_id' => 'required',
            'collector_id' => 'required'
        ],[
            'collector_id.required' => 'Please select collector officer!'
        ]);

        $countClaimStatus = ClaimStatus::where('claim_id',$request->claim_id)->count();

        if($countClaimStatus == 0){
            DB::beginTransaction();
            try{
                $created = ClaimStatus::create([
                    'claim_id' => $request->claim_id,
                    'status' => $request->status,
                    'update_by' => Auth::user()->id
                ]);
    
                CollectionOffice::create([
                    'claim_id' => $request->claim_id,
                    'collector_id' => $request->collector_id,
                    'remarks' => $request->remarks
                ]);
                Claim::where('id',$request->claim_id)->update([
                    'status' => $request->status,
                ]);
                DB::commit();
                session()->put('success','Claim send to collection office');
                return redirect()->back();

            }catch(\Exception $e){
                dd($e->getMessage());
                DB::rollBack();
            }
        }else{
            DB::beginTransaction();
            try{

                $update = ClaimStatus::where('claim_id',$request->claim_id)->update([
                    'claim_id' =>$request->claim_id,
                    'status' => $request->status,
                    'update_by' => Auth::user()->id,
                ]);
                Claim::where('id',$request->claim_id)->update([
                    'status' => $request->status,
                ]);
                DB::commit();
                session()->put('success','Claim send to collection office');
                return redirect()->back();
            }catch(\Exception $e){
                dd($e->getMessage());
                DB::rollBack();
            }
        }
    }


    public function sendBackToSupervisor(Request $request)
    {
        $data = $request->validate([
            'claim_id' => 'required'
        ]);

        // dd($data);

        $countClaimStatus = ClaimStatus::where('claim_id',$request->claim_id)->count();

        if($countClaimStatus == 0){
            DB::beginTransaction();
            try {   
            $create = ClaimStatus::create([
                'claim_id' => $request->claim_id,
                'status' => $request->status,
                'update_by' => Auth::user()->id
            ]);
            Claim::where('id',$request->claim_id)->update([
                'status' => $request->status,
            ]);
            DB::commit();

            LegalDepartmentModel::where('claim_id',$request->claim_id)->delete();
            session()->put('success','Claim send to supervisor');
            return redirect('/legal-department/claims');
            } catch (\Exception $e) {
                dd($e->getMessage());
                DB::rollBack();
            }
        }else{
            DB::beginTransaction();
            try {
                $update = ClaimStatus::where('claim_id', '=', $request->claim_id )->update([
                    'claim_id' => $request->claim_id,
                    'status' => $request->status, 
                    'update_by' => Auth::user()->id,
                ]);
                Claim::where('id',$request->claim_id)->update([
                    'status' => $request->status,
                ]);

            DB::commit();
            LegalDepartmentModel::where('claim_id',$request->claim_id)->delete();
            session()->put('success','Claim send to supervisor');
            return redirect('/legal-department/claims');

            } catch (\Exception $e) {
                dd($e->getMessage());
                DB::rollBack();
            }
        }
    }


    public function exceededClaims()
    {
        $today = Carbon::now();    
        $thirtyDaysAgo = $today->subDays(30);
        $sixtyDaysAgo = $today->subDays(60);
        $claims = Claim::with(['statusee'=> function($query) use ($thirtyDaysAgo,$sixtyDaysAgo){
            $query->where('status',0)->where('updated_at', '<', $thirtyDaysAgo)->orWhere('updated_at','<',$sixtyDaysAgo);
        }])->whereHas('statusee',function($query){
            $query->where('status',0);
        })->get();
        return view('supervisor.exceededClaims', compact('claims'));
    }

    public function supervisorClaims()
    {
       $claims = Claim::with('claimData')->whereHas('statusee',function($query){
            $query->where('status',ClaimStatusEnum::SEND_BACK_TO_SUPERVISOR->value);
        })->get();
        return view('supervisor.supervisorClaims',compact('claims'));
    }

    public function requestToChangeStatus(Request $request)
    {
        $request->validate([
            'current_status' => 'required',
            'new_status' => 'required',
            'reason' => 'required',
        ]);
        $createRequest = RequestChangeStatusModel::create($request->all());
        if($createRequest){
            session()->put('success','Request send successfully!');
            return redirect()->back();
        }else{
            session()->put('error','Somthing went wrong!');
            return redirect()->back();
        }
    }
}
