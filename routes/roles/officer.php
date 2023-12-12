<?php

use App\Models\User;
use App\Models\Claim;
use App\Models\CallStatus;
use App\Models\SmsResponse;
use App\Models\DebtorResponse;
use App\Http\Controllers\AdminController;
use App\Models\OfficerTarget;
use App\Models\DebtorBankTransfer;
use App\Http\Controllers\Admin\ClaimController as AdminClaimController;
use App\Http\Controllers\Officer\OfficerController;

Route::middleware(['preventBackHistory', 'auth', 'role:officer|admin|super-admin|director|manager'])
    ->group(function () {
        // Dashboard
        Route::get('officer/dashboard', function () {
            $link = Claim::where('status', 1)->get();
            return view('admin.dashboard', compact('link'));
        })->name('officer.dashboard');
        ///////////////////
        // claims routes
        ///////////////////
        Route::get('officer/claims',[AdminClaimController::class, 'viewClaimsBeta'])
            ->name('officer.claims');

        Route::get('officer/add-claim', function () {
            return view('admin.addClaim');
        })->name('officer.add-claim')
            ->middleware(['permission:add-claim']);

        Route::get('officer/bulk-registration', function () {
            return view('admin.addClaimBulk');
        })->name('officer.bulkClaimReg')
            ->middleware(['permission:add-claim']);

        // Rejected Claims
        Route::get('officer/rejectclaims', function () {

            if (Auth::user()->company_id != null) {
                $claims = Claim::where('status', 2)->where('company_id', Auth::user()->company_id)->paginate(10);
                // $claims=Claim::where('status',2)->where('company_id',Auth::user()->company_id)->get();
                return view('admin.reject_claim', compact('claims'));
            } else {
                if (Auth::user()->is_super == 1) {
                    // $claims=Claim::where('status',2)->get();
                    $claims = Claim::where('status', 2)->paginate(10);
                    return view('admin.reject_claim', compact('claims'));
                } else {
                    $claims = Claim::where('status', 2)->where('is_assign', Auth::user()->id)->paginate(10);
                    // $claims=Claim::where('status',2)->where('is_assign',Auth::user()->id)->get();
                    return view('admin.reject_claim', compact('claims'));
                }
            }
        })->name('officer.rejectclaims');
        //Approved Claims
        Route::get('officer/approved-claims', function () {
            if (Auth::user()->company_id != null) {

                // $claims=Claim::where('status',1)->where('company_id',Auth::user()->company_id)->get();
                $claims = Claim::where('status', 1)->where('company_id', Auth::user()->company_id)->paginate(10);
                return view('admin.approved_claim', compact('claims'));
            } else {
                if (Auth::user()->is_super == 1) {
                    // $claims=Claim::where('status',1)->get();
                    $claims = Claim::where('status', 1)->paginate(10);
                    return view('admin.approved_claim', compact('claims'));
                } else {
                    // $claims=Claim::where('status',1)->where('is_assign',Auth::user()->id)->get();
                    $claims = Claim::where('status', 1)->where('is_assign', Auth::user()->id)->paginate(10);
                    return view('admin.approved_claim', compact('claims'));
                }
            }
        })->name('officer.approved-claims');



        Route::get('officer/edit-claim/{id}', function ($id) {
            $claim = Claim::where('id', $id)->first();
            return view('admin.editclaim', compact('claim'));
        })->name('officer.edit-claim.id')
            ->middleware(['permission:edit-claim']);

        //////////////////////
        //   call sms response route
        /////////////////
        //admin sms response
        Route::get('officer/sms-response', function () {

            if (Auth::user()->company_id != null) {
                $smsres = SmsResponse::join('claims', 'sms_response.claim_id', '=', 'claims.id')->where('company_id', Auth::user()->company_id)->get();
                return view('admin.smsresponse', compact('smsres'));
            } else {
                $smsres = SmsResponse::all();
                return view('admin.smsresponse', compact('smsres'));
            }
        })->name('officer.sms-response');

        Route::get('officer/check/call/status', function () {
            $response = CallStatus::all();
            return view('admin.callstatus', compact('response'));
        })->name('officer.check.call.status');

        Route::get('officer/check/call', function () {

            if (Auth::user()->company_id != null) {
                $response = CallStatus::join('claims', 'call_status.claim_id', '=', 'claims.id')->where('claims.company_id', Auth::user()->company_id)->get();
                // dd($response[0]->call_status->status);

                return view('admin.callstatus', compact('response'));
            } else {
                $response = CallStatus::all();
                return view('admin.callstatus', compact('response'));
            }
        })->name('officer.check-call');

        //objections................................................
        Route::get('officer/objection', function () {

            if (Auth::user()->company_id != null) {
                $objection = DebtorResponse::join('claims', 'debtorresponses.claim_id', '=', 'claims.id')
                    ->where('claims.company_id', Auth::user()->company_id)->where('debtorresponses.response', 1)
                    ->where('debtorresponses.obj_status', null)->get();
                return view('admin.callsmsresponses', compact('objection'));
            } else {
                $objection = DebtorResponse::where('response', 1)->where('obj_status', null)->get();
                return view('admin.callsmsresponses', compact('objection'));
            }

            // $objection=DebtorResponse::where('response',1)->where('obj_status',null)->get();
            // return view('admin.callsmsresponses',compact('objection'));

        })->name('officer.RespondObjection');
        //search
        Route::any('/officer/search-claim', [ClaimController::class, 'search'])->name('officer.search-claim');
        //debtor valid objections
        Route::get('officer/valid/objection', function () {

            $objection = DebtorResponse::where('response', 1)->where('obj_status', 1)->get();
            return view('admin.validobjections', compact('objection'));
        })->name('officer.ValidObjection');

        Route::get('officer/invalid/objection', function () {
            if (Auth::user()->company_id != null) {
                $objection = DebtorResponse::join('claims', 'debtorresponses.claim_id', '=', 'claims.id')
                    ->where('claims.company_id', Auth::user()->company_id)->where('debtorresponses.response', 1)
                    ->where('debtorresponses.obj_status', 0)->get();
                return view('admin.invalidobjections', compact('objection'));
            } else {
                $objection = DebtorResponse::where('response', 1)->where('obj_status', 0)->get();
                return view('admin.invalidobjections', compact('objection'));
            }
            // $objection=DebtorResponse::where('response',1)->where('obj_status',0)->get();
            // return view('admin.invalidobjections',compact('objection'));

        })->name('officer.InValidObjection');

        //case close objection
        Route::get('officer/case/close/objecton', function () {
            $objection = DebtorResponse::where('response', 1)->where('obj_status', 3)->get();
            return view('admin.casecloseobjections', compact('objection'));
        })->name('officer.CaseCloseObjection');

        Route::get('officer/partial-payment', [AdminController::class, 'partialDetail'])->name('officer.partial-payment');
        Route::view('officer/calendar', 'admin.calander')->name('officer.calendar');

        Route::get('/officer/claim/detail/{id}', [AdminClaimController::class, 'claimDetail'])
            ->name('officer.claim.detail');

        // targets
        Route::get('calculateAchievedTargets', function () {
            $officers = User::whereHasRole('officer')->get();

            foreach ($officers as $officer) {
                $claimsTotalTargetAmount = Claim::where('is_assign', $officer->id)->sum('rec_amt');

                if ($claimsTotalTargetAmount) {
                    $isTargetUpdated = OfficerTarget::where('officer_id', $officer->id)->update([
                        'achieved' => $claimsTotalTargetAmount
                    ]);
                }
                // dd($officer->id);
                // if($isTargetUpdated){
                //     return 'officer target updated';
                // }else{
                //     return 'officer not updated';
                // return ['claims'=>$claimsTotalTargetAmount];
            }




            return $officers;
        });

        Route::get('officer/achieved-targets', [OfficerController::class, 'oneOfficerAchievedTargets'])
            ->name('officer.achieved-targets');


        // charts
        Route::get('/officer/targets/statistics', [OfficerController::class, 'officerTargetStatistics'])
            ->name('officer.targets.statistics');


        // discount
        Route::post('/officer/debtor/discount-rate/store', [OfficerController::class, 'storeDebtorDiscountRate'])
            ->name('officer.debtor.discount-rate.store');

        Route::get('/officer/claims/discount/history', [OfficerController::class, 'claimsDiscountHistory'])
            ->name('officer.claims.discount.history');


        Route::post('/officer/debtor/bank/transfer/slip', [OfficerController::class, 'debtorBankTransferSlip'])
            ->name('officer.debtor.bank.transfer.slip');


        ///////////////
        // url testing
        Route::get('officer/someothjer/testing', function () {
            return request()->is('officer/*');
        });
        Route::get('officer/debtor/discount', function () {
            return $debDiscount = \App\Models\DebDiscount::with('debDiscountRequest.processor')->get();
        });

        Route::get('officer/test/{id}', function ($id) {
            return Claim::with('claimData', 'supportedDocs')->where('id', $id)->first();
        });
        
        Route::get('officer/transaction',function(){
        
                try{
                    $debtorBankTransfers = DebtorBankTransfer :: join('claims','claims.id','=','debtor_bank_transfers.claim_id')
                ->where('claims.is_assign',Auth::user()->id)->get();
               return view('admin.alltransactions', compact('debtorBankTransfers'));
                }catch(\Exception $e){
                    dd($e);
                }
                
        })->name('officer.transaction-history');
        
        
    });
