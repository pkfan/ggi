<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Claim;
use App\Models\CallStatus;
use App\Models\SmsResponse;
use App\Models\DebtorResponse;
use App\Http\Controllers\AdminController;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Officer\OfficerController;
use App\Http\Controllers\Supervisor\SupervisorController;
use App\Http\Controllers\Admin\ClaimController as AdminClaimController;
use App\Http\Controllers\CalendarController;
use App\Models\OfficerDiscountRate;
use App\Models\OfficerTarget;
use PhpOffice\PhpSpreadsheet\Style\Supervisor;
use App\Enums\ClaimStatus;

Route::middleware(['preventBackHistory', 'auth', 'role:supervisor|admin|super-admin|director|manager'])
    ->group(function () {

        // Dashboard
        Route::get('supervisor/dashboard', function () {
            $link = Claim::where('status', 1)->get();
            return view('admin.dashboard', compact('link'));
        })->name('supervisor.dashboard');
        ///////////////////
        // claims routes
        ///////////////////
        Route::get('supervisor/claims', [AdminClaimController::class, 'viewClaimsBeta'])
            ->name('supervisor.claims');

        Route::get('supervisor/add-claim', function () {
            return view('admin.addClaim');
        })->name('supervisor.add-claim')
            ->middleware(['permission:add-claim']);

        Route::get('supervisor/bulk-registration', function () {
            return view('admin.addClaimBulk');
        })->name('supervisor.bulkClaimReg')
            ->middleware(['permission:bulk-import-claims']);

        // Rejected Claims
        Route::get('supervisor/rejectclaims', function () {

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
        })->name('supervisor.rejectclaims');
        //Approved Claims
        Route::get('supervisor/approved-claims', function () {
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
        })->name('supervisor.approved-claims');


        Route::get('/supervisor/claim/detail/{id}', [AdminController::class, 'claimDetail'])->name('supervisor.claim.detail');

        Route::get('supervisor/edit-claim/{id}', function ($id) {
            $claim = Claim::where('id', $id)->first();
            return view('admin.editclaim', compact('claim'));
        })->name('supervisor.edit-claim.id')
            ->middleware(['permission:edit-claim']);

        //////////////////////
        //   call sms response route
        /////////////////
        //admin sms response
        Route::get('supervisor/sms-response', function () {

            if (Auth::user()->company_id != null) {
                $smsres = SmsResponse::join('claims', 'sms_response.claim_id', '=', 'claims.id')->where('company_id', Auth::user()->company_id)->get();
                return view('admin.smsresponse', compact('smsres'));
            } else {
                $smsres = SmsResponse::all();
                return view('admin.smsresponse', compact('smsres'));
            }
        })->name('supervisor.sms-response');

        Route::get('supervisor/check/call/status', function () {
            $response = CallStatus::all();
            return view('admin.callstatus', compact('response'));
        })->name('supervisor.check.call.status');

        Route::get('supervisor/check/call', function () {

            if (Auth::user()->company_id != null) {
                $response = CallStatus::join('claims', 'call_status.claim_id', '=', 'claims.id')->where('claims.company_id', Auth::user()->company_id)->get();
                // dd($response[0]->call_status->status);

                return view('admin.callstatus', compact('response'));
            } else {
                $response = CallStatus::all();
                return view('admin.callstatus', compact('response'));
            }
        })->name('supervisor.check-call');

        //objections................................................
        Route::get('supervisor/objection', function () {

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

        })->name('supervisor.RespondObjection');

        //debtor valid objections
        Route::get('supervisor/valid/objection', function () {

            $objection = DebtorResponse::where('response', 1)->where('obj_status', 1)->get();
            return view('admin.validobjections', compact('objection'));
        })->name('supervisor.ValidObjection');

        Route::get('supervisor/invalid/objection', function () {
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

        })->name('supervisor.InValidObjection');

        //case close objection
        Route::get('supervisor/case/close/objecton', function () {
            $objection = DebtorResponse::where('response', 1)->where('obj_status', 3)->get();
            return view('admin.casecloseobjections', compact('objection'));
        })->name('supervisor.CaseCloseObjection');

        Route::get('supervisor/partial-payment', [AdminController::class, 'partialDetail'])->name('supervisor.partial-payment');
        Route::get('/supervisor/calendar',[CalendarController::class,'index'])->name('supervisor.calendar');

        // Route::view('supervisor/calendar', '')->name('');

        ///////////////
        // new routes added by Muhammad Amir //////
        //////////////
        //add user
        Route::get('supervisor/all-officers-list', [OfficerController::class, 'officers'])
            ->name('supervisor.all-officers-list');

        Route::get('supervisor/register/officer', [OfficerController::class, 'registerOfficer'])
            ->name('supervisor.register.officer');

        Route::post('supervisor/register/officer', [OfficerController::class, 'storeOfficer'])
            ->name('supervisor.register.officer');

        Route::get('/supervisor/claim/detail/{id}', [AdminClaimController::class, 'claimDetail'])
            ->name('supervisor.claim.detail');
        Route::get('supervisor/edit-claim/{id}', [AdminClaimController::class, 'editClaimView'])
            ->name('supervisor.edit-claim.id')
            ->middleware(['permission:edit-claim']);

        // targets
        Route::get('supervisor/set/officer/targets', [OfficerController::class, 'setTargets'])
            ->name('supervisor.set.officer.targets');

        Route::get('supervisor/edit/officer/targets/{target_id}', [OfficerController::class, 'editTargets'])
            ->name('supervisor.edit.officer.targets');

        Route::post('supervisor/store/officer/targets', [OfficerController::class, 'storeTargets'])
            ->name('supervisor.store.officer.targets');

        Route::post('supervisor/update/officer/targets', [OfficerController::class, 'updateTargets'])
            ->name('supervisor.update.officer.targets');

        Route::get('supervisor/officer/targets', [OfficerController::class, 'officerTargets'])
            ->name('supervisor.officer.targets');

        Route::get('supervisor/officer/achieved-targets', [OfficerController::class, 'officersAchievedTargets'])
            ->name('supervisor.officer.achieved-targets');

        // discount
        Route::get('supervisor/officers/discount/requests', [SupervisorController::class, 'officerDiscountRequests'])
            ->name('supervisor.officers.discount.requests');

        Route::get('supervisor/officers/discount/requests/{request_id}/status/{status}', [SupervisorController::class, 'officerDiscountRequestsStatus'])
            ->name('supervisor.officers.discount.requests.status');

        Route::get('supervisor/officers/discounts/list', [SupervisorController::class, 'officersDiscountsList'])
            ->name('supervisor.officers.discounts.list');

        Route::post('supervisor/officer/discount/store', [SupervisorController::class, 'officerDiscountStore'])
            ->name('supervisor.officer.discount.store');

        Route::get('supervisor/officer/discount/{officer_discount_id}/delete', [SupervisorController::class, 'officerDiscountDelete'])
            ->name('supervisor.officer.discount.delete');

        Route::get('/supervisor/claims/discount/history', [SupervisorController::class, 'claimsDiscountHistory'])
            ->name('supervisor.claims.discount.history');
            
        Route::any('/supervisor/search-claim', [ClaimController::class, 'search'])->name('supervisor.search-claim');

        // ADDED BY TALHA 
        Route::post('/send-to-legal-department',[SupervisorController::class,'sendToLegalDepartment'])
        ->name('supervisor.send-to-legal-department');

        Route::post('/send-to-collection-office',[SupervisorController::class,'sendToCollectionOffice'])
        ->name('supervisor.send-to-collection-office');

       

        Route::get('supervisor/exceed-claims',[SupervisorController::class,'exceededClaims'])
        ->name('supervisor.exceede-claims');

        Route::post('/supervisor/events/store',[CalendarController::class,'store'])->name('supervisor.events.store');

        Route::get('supervisor/supervisor-claims',[SupervisorController::class,'supervisorClaims'])
        ->name('supervisorClaims');

        Route::post('/supervisor/request-to-change-status',[SupervisorController::class,'requestToChangeStatus'])
        ->name('requestToChangeStatus');
    });

    Route::post('/send-back-to-supervisor',[SupervisorController::class,'sendBackToSupervisor'])
    ->name('supervisor.send-back-to-supervisor');
