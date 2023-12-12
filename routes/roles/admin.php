<?php

use App\Models\Loan;
use App\Models\Role;
use App\Models\User;
use App\Models\Claim;
use App\Models\Reason;
use App\Models\Company;
use App\Models\Message;
use App\Models\payment;
use App\Models\AdminDoc;
use App\Models\PreClaim;
use App\Models\ElmStatus;
use App\Models\CallStatus;
use App\Models\PartialPay;
use App\Models\ClaimRemark;
use App\Models\ClaimStatus;
use App\Models\SmsResponse;
use App\Models\ClaimComment;
use App\Models\Distribution;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Supported_Doc;
use App\Models\CollectedClaim;
use App\Models\DebtorResponse;
use App\Models\FinancialCompany;
use App\Helpers\Classes\Settings;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtController;
use App\Http\Controllers\IvrController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClaimController;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\FinanceContoller;
use App\Http\Controllers\LawFirmController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingController;
use PhpOffice\PhpSpreadsheet\Style\Supervisor;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ResponseController;
use App\Http\Controllers\DebtorResponseController;
use App\Http\Controllers\InsuranceCompanyContoller;
use App\Http\Controllers\Officer\OfficerController;

use App\Http\Controllers\Supervisor\SupervisorController;
use App\Http\Controllers\Admin\ClaimController as AdminClaimController;

//----------------------------------------------------------------------------------------------------------------------
//  Admin Routes
//----------------------------------------------------------------------------------------------------------------------
Route::get('recoveryservices', function () {

    return view('recoveryservices');
});

Route::middleware(['preventBackHistory', 'auth', 'role:admin|super-admin|director|manager'])
    ->group(function () {

        // ADDED BY TALHA

        Route::get('/admin/change-status-requests',[AdminController::class,'requestChangeStatusList'])->name('admin.request.change.status.list');
        Route::get('/admin/approve-change-status-request/{claim_id}',[AdminController::class,'approveRequestStatusChange'])->name('approve.request.status.change');
         
        //---------------------------------
        // Middleware grouped routes
        // Dashboard
        Route::get('admin/dashboard', [AdminController::class, 'adminDashboard'])
            ->name('AdminDashboard');


        // Rejected Claims
        Route::get('/admin/rejectclaims', [AdminClaimController::class, 'rejectClaims'])
            ->name('rejectclaims');
        //Approved Claims
        Route::get('/admin/adminapprovedclaims', [AdminClaimController::class, 'adminApprovedClaims'])
            ->name('adminapprovedclaims');


        //Claim Details
        Route::get('/admin/claim/detail/{id}', [AdminClaimController::class, 'claimDetail'])
            ->name('AdminClaimDetail');
            
        Route::get('admin/edit/claim/detail/{id}', [AdminClaimController::class, 'editclaim'])
            ->name('EditAdminClaim');



        //remove support documnet
        Route::get('admin/remove/claim/file/{claimid}/{file}', [AdminClaimController::class, 'removeClaimFile'])
            ->name('admin.remove.claim.file');

        Route::get('admin/remove/file/claim/{claimno}/{file}', [AdminClaimController::class, 'removeFileClaim'])
            ->name('admin.remove.file.claim');

        //remove supportive doc
        Route::get('admin/remove/supportive/doc/{id}/{file}', [AdminClaimController::class, 'removeSupportiveDoc'])
            ->name('admin.remove.supportive.doc');

        //sms call response

        //objections................................................
        Route::get('/admin/objection', [AdminController::class, 'objection'])
            ->name('RespondObjection');


        //debtor valid objections
        Route::get('/admin/valid/objection', [DebtorResponseController::class, 'validObjection'])
            ->name('ValidObjection');


        //debtor invalid objections
        Route::get('admin/claim/in-valid/objection/{id}', [DebtorResponseController::class, 'invalid']);
        Route::get('admin/invalid/objection', [DebtorResponseController::class, 'invalidObjection'])
            ->name('InValidObjection');


        //case close objection
        Route::get('/admin/case/close/objecton', [DebtorResponseController::class, 'caseCloseObjection'])
            ->name('AdminCaseCloseObjection');



        //change lawfirm status
        Route::get('admin/change/lawfirm/status/{id}', [AdminController::class, 'lfstatus'])
            ->name('changelfstatus');
        //view refuesed claim
        Route::get('admin/response/refused', [DebtorResponseController::class, 'refuseResponse'])
            ->name('responseRefused');
        // assign law firm on refuse


        Route::get('admin/check/call/status', [DebtorResponseController::class, 'checkCallStatus'])
            ->name('callstatus');
        Route::get('admin/call-again/{id}', [DebtorResponseController::class, 'callAgain'])
            ->middleware(['permission:call-again']);

        Route::get('admin/assign/firm/{res}/{firm}', [AdminController::class, 'assignfirm']);


        //view refuse claim details
        Route::get('admin/view/refuse/claim/detail/{id}', [AdminClaimController::class, 'getclaim']);





        //admin view loan request
        Route::get('admin/view/loan/requests', [DebtorResponseController::class, 'viewLoanRequests'])
            ->name('adminLoanView');
        Route::get('admin/view/loan/request/details/{id}', [AdminController::class, 'loanreqdetail']);

        Route::get('admin/view/loan/accept/loan/requests', [AdminController::class, 'viewLoanAcceptLoanRequest'])
            ->name('adminLoanAcc');

        Route::get('admin/view/loan/rejected/loan/requests', [AdminController::class, 'viewLoanRejectedLoanRequest'])
            ->name('adminLoanRej');



        //company list
        Route::get('admin/companies-list', [CompanyController::class, 'companiesList'])
            ->name('admin.companies-list');

        Route::get('admin/edit-company/{id}', [CompanyController::class, 'editCompanyView']);


        //add company
        Route::get('admin/add/company', [CompanyController::class, 'addCompanyView'])
            ->name('admin.add.company');
        //company employee list
        Route::get('admin/company-employee-list', [OfficerController::class, 'companyEmployeeList'])
            ->name('admin.company-employee-list');
        //add company employee
        Route::get('admin/add/company-employee', [OfficerController::class, 'addCompanyEmployeeView'])
            ->name('admin.add.company-employee');

        //edit employee
        Route::get('admin/edit-employee/{id}', [OfficerController::class, 'editCompanyEmployeeView']);

        //finance Company \
        Route::get('admin/finance-companies-list', [CompanyController::class, 'financeCompaniesList'])
            ->name('admin.finance-companies-list');

        Route::get('admin/add/financial-company', [CompanyController::class, 'addFinanceCompanyView'])
            ->name('admin.add.financial-company');


        Route::get('admin/edit-finance-company/{id}', [CompanyController::class, 'financeCompanyView']);




        Route::get('admin/finance-company-employee-list', [OfficerController::class, 'financeCompanyEmployeeList'])
            ->name('admin.finance-company-employee-list');

        Route::get('admin/add/finance-employee', [OfficerController::class, 'addFinanceEmployeeView'])
            ->name('admin.add.finance-employee');

        Route::get('admin/edit-finance-employee/{id}', [OfficerController::class, 'editFinanceCompanyEmployeeView']);

        Route::get('admin/de-active/user/{id}', [AdminController::class, 'deactiveUser']);

        Route::get('admin/active/user/{id}', [AdminController::class, 'activeUser'])
            ->middleware(['permission:change-user-status']);




        Route::get('admin/ic/preclaim', [AdminClaimController::class, 'icPreclaimView'])
            ->name('icFileRequest');

        //Route::get('admin/addclaim/{id}',[AdminClaimController::class,'claimform'])->name('IcAddClaimForm');
        Route::get('admin/addclaim/{id}', [AdminClaimController::class, 'addClaimView']);
        Route::get('admin/preclaim/approve/{id}', [AdminClaimController::class, 'approvePreClaim']);


        Route::get('admin/view-remarks/{id}', [AdminClaimController::class, 'viewRemarks']);

        Route::get('admin/add/admin-staff', [AdminController::class, 'addAdminStaffView']);


        //admin view distibuted claims list
        Route::get('admin/assigned-claims', [AdminClaimController::class, 'assignedClaim']);

        //admin sms response
        Route::get('admin/sms-response', [DebtorResponseController::class, 'smsResponse'])
            ->name('admin.sms-response');
        //admin resend sms
        Route::get('admin/resend/msg/{claimid}/{id}', [DebtorResponseController::class, 'reSendMessage'])
            ->middleware(['permission:resend-sms']);

        //transaction history
        Route::get('admin/transaction-historyadmin/bulk-registration', [AdminController::class, 'allTransaction'])
            ->name('admin.transaction-history');

        Route::get('admin/transaction-history/{debtor_bank_slip_id}/status/{status}', [AdminController::class, 'allTransactionStatus'])
            ->name('admin.transaction-history.status');
        // //all remarks | removed by zeeshan sir
        // Route::get('admin/view-claims-remarks', function () {

        //     if (Auth::user()->company_id != null) {
        //         $claims = Claim::where('company_id', Auth::user()->company_id)->get();
        //         return view('admin.viewRemarks', compact('claims'));
        //     } else {
        //         $claims = Claim::all();
        //         return view('admin.viewRemarks', compact('claims'));
        //     }
        // })->name('admin.view-claims-remarks');

        Route::get('admin/edit-claim/{id}', [AdminClaimController::class, 'editClaimView'])
            ->name('admin.edit-claim.id')
            ->middleware(['permission:edit-claim']);


        //collector
        Route::get('admin/add-collectors', [UserController::class, 'addCollectorsView'])
            ->name('admin.add-collectors');

        //comments
        Route::get('admin/comment/{id}', [AdminClaimController::class, 'claimComments'])
            ->name('admin.comment.id')->middleware(['permission:add-comment-claim']);


        Route::get('admin/comment', [AdminClaimController::class, 'claimCommentView']);

        Route::get('admin/check/call/demo', [AdminController::class, 'checkCall'])
            ->name('admin.check-call-demo');


        //admin discharge letter
        Route::get('admin/generate-final/{id}', [AdminController::class, 'generateLetter']);



        // Route::get('admin/elm-status', function () {

        //     if (Auth::user()->company_id != null) {

        //         $elm = ElmStatus::join('claims', 'elm_status.claim_id', '=', 'claims.id')
        //             ->where('claims.company_id', Auth::user()->company_id)->get();
        //         return view('admin.elmstatus', compact('elm'));
        //     } else {
        //         $elm = ElmStatus::all();
        //         return view('admin.elmstatus', compact('elm'));
        //     }
        // })->name('admin.elm-status');


        //partialpay list
        Route::get('admin/partialpay-list', [AdminController::class, 'partialPayList']);



        Route::get('admin/resend-elm/{id}', [AdminController::class, 'eleMsg']);

        Route::get('admin/delete-doc/{id}', [AdminController::class, 'deleteDoc']);

        //admin custom sadad link

        //GIG Report
        Route::get('admin/gig-report', [AdminController::class, 'gigReport']);


        //  admin change password
        Route::get('admin/setting/{id}', [UserController::class, 'profileSetting'])
            ->name('admin.setting.id');

        Route::get('admin/claims', [AdminClaimController::class, 'viewClaimsBeta'])
            ->name('AdminViewClaims');

        Route::get('admin/view-claims-beta/{paginate}', [AdminClaimController::class, 'viewClaimsBetaPaginate']);

        Route::view('admin/calendar', 'admin.calander')->name('admin-calendar');
        ///admin partial sadad and mada payment
        Route::get('admin/partial-custom/{id}', [AdminController::class, 'customPartial']);

        //partial payment check received or not
        Route::get('check-paylink/{id}', [AdminController::class, 'paymentlinkCheck']);

        Route::any('admin/paginate-data', [AdminClaimController::class, 'paginateClaim']);

        Route::get('admin/queries', [AdminController::class, 'getQuery']);

        Route::get('admin/partial-pay', function () {
            $claims = ClaimStatus::join('claims', 'claim_status.claim_id', '=', 'claims.id')->where('claim_status.status', 4)

                ->paginate(10);

            // $claims=Claim::where('status',0)->paginate(10);
            return view('admin.reg_claims', compact('claims'));
        });

        Route::get('admin/collected-claims', function () {

            $directpay = payment::where('payment.response_code', 000)->select('claim_id', 'amount')->get();
            $colected = CollectedClaim::select('claim_id', 'payment')->get();
            // dd($directpay,$colected);
            return view('admin.rec_collection', compact('directpay', 'colected'));
        });

        ///year revenue graph
        Route::get('admin/collected-amount', function () {
            $year = 2021;
            $sum = array();
            for ($i = 1; $i <= 7; $i++) {

                $directpay = payment::where('response_code', 000)->whereYear('created_at', '=', $year)->sum('amount');
                $colected = Claim::join('claim_collected', 'claim_collected.claim_id', '=', 'claims.id')
                    ->whereYear('claims.created_at', '=', $year)->sum('claims.rec_amt');
                $sum[$i] = $directpay + $colected;
                $year = $year + $i;
            }

            return response()->json($sum, 200);
        });

        Route::get('admin/sadad-link/{id}', function ($id) {
            return additionalsadadLink($id);
        });

        Route::get('admin/partial-payment', [AdminController::class, 'partialDetail'])
            ->name('admin.partial-payment');

        Route::any('admin/search-call-status', [AdminController::class, 'callSearch']);
        Route::any('admin/search-elm-status', [AdminController::class, 'elmSearch']);

        Route::get('admin/bulk-registration', function () {
            return view('admin.addClaimBulk');
        })->name('bulkClaimReg')
            ->middleware(['permission:bulk-import-claims']);

        Route::get('admin/add-claim', function () {
            return view('admin.addClaim');
        })->name('admin.add-claim')
            ->middleware(['permission:add-claim']);



        Route::get('admin/all-users-list', function (Request $request) {
            // $users=User::where('roll',1)->get();
            $users = User::with('roles');

            $role = null;

            if ($request->query('role')) {
                $users = $users->whereHas('roles', function (Builder $query) use ($request) {
                    $query->where('name', $request->query('role'));
                });

                $role = Role::firstWhere('name', $request->query('role'));
            }

            $users = $users->orderByDesc('created_at')->paginate(10);

            // return $users;
            return view('admin.all-users-list', compact('users', 'role'));
        })->name('admin.all-users-list');

        //add user
        Route::get('admin/add-user', function (Request $request) {
            $queryRole = Role::firstWhere('name', $request->query('role'));
            $roles = Role::all();

            return view('admin.add-user', compact('roles', 'queryRole'));
        })->name('admin.add-user')
            ->middleware(['permission:add-user']);



        Route::get('admin/edit-user/{user_id}', function (Request $request, $user_id) {
            $queryRole = Role::firstWhere('name', $request->query('role'));
            $roles = Role::all();
            $user = User::with('roles')->firstWhere('id', $user_id);

            return view('admin.edit-user', compact('roles', 'queryRole', 'user'));
        })->name('admin.edit-user');



        ///////// settings /////////

        Route::get('admin/settings', [SettingController::class, 'index'])->name('admin.settings');
        // languages
        Route::get('admin/settings/languages', [SettingController::class, 'languages'])
            ->name('admin.settings.languages')
            ->middleware(['permission:view-languages']);


        // initialize settings
        Route::get('admin/settings/initSettingsToDatabase', [SettingController::class, 'initSettingsToDatabase'])->name('admin.settings.initSettingsToDatabase');


        // targets

        Route::get('admin/set/officer/targets', [OfficerController::class, 'setTargets'])
            ->name('admin.set.officer.targets');

        Route::get('admin/edit/officer/targets/{target_id}', [OfficerController::class, 'editTargets'])
            ->name('admin.edit.officer.targets');



        Route::get('admin/officer/targets', [OfficerController::class, 'officerTargets'])
            ->name('admin.officer.targets');

        Route::get('admin/officer/achieved-targets', [OfficerController::class, 'officersAchievedTargets'])
            ->name('admin.officer.achieved-targets');



        // charts
        Route::get('admin/officers/targets/statistics', [ArtController::class, 'officerTargetsStatistics'])
            ->name('admin.officers.targets.statistics');

        Route::get('admin/officers/discount/requests', [SupervisorController::class, 'officerDiscountRequests'])
            ->name('admin.officers.discount.requests');

        Route::get('admin/officers/discounts/list', [SupervisorController::class, 'officersDiscountsList'])
            ->name('admin.officers.discounts.list');

        Route::get('/admin/claims/discount/history', [SupervisorController::class, 'claimsDiscountHistory'])
            ->name('admin.claims.discount.history');


        Route::get('/admin/multple-field-test', function () {
            return request();
        });
        Route::get('/admin/test', function () {
            $claims = \App\Models\Claim::where('amount_after_discount', 0)->get();

            foreach ($claims as $claim) {
                // try {
                \App\Models\Claim::where('id', $claim->id)->update(['amount_after_discount' => $claim->rec_amt]);
                // } catch (\Exception $e) {
                // }
            }
        });





        // roles and permissions
        Route::get('admin/settings/roles-permissions', [SettingController::class, 'roles'])->name('admin.settings.roles');

        Route::get('admin/settings/role/{role_id}/permissions', [SettingController::class, 'permissions'])
            ->name('admin.settings.roles.permissions');



        // Route::get('admin/settings/role/{role}/delete', [SettingController::class, 'deleteRole'])
        //     ->name('admin.settings.role.delete');
        
        
        //Recovery Detail
        Route::get('admin/recovered',[AdminController::class,'collectedClaim']);

        Route::get('admin/recovery/amount',[AdminController::class,'adminRec']);
        
    });

// post methods are seprate because all roles used them from old system to new one

Route::middleware(['preventBackHistory', 'auth'])
    ->group(function () {
        Route::post('admin/claim/resubmit', [AdminClaimController::class, 'resubmitclaim'])
            ->name('AdminResubmitClaim');
        Route::post('admin/claim/valid/objection', [DebtorResponseController::class, 'valid']);
        //admin upload additional documents  admin/upload/addionaldoc
        Route::post('admin/upload/addionaldoc', [AdminController::class, 'uploaddoc']);
        Route::post('admin/assign/finance-company', [CompanyController::class, 'assignFcom']);
        Route::post('admin/edit/company', [CompanyController::class, 'editCompany']);
        Route::post('admin/add/new-company', [CompanyController::class, 'addCompany']);
        Route::post('admin/add/new-company-employee', [OfficerController::class, 'addCompanyEmp']);
        Route::post('admin/edit/company-employee', [OfficerController::class, 'editCompanyEmp']);
        Route::post('admin/add/new-finance-company', [CompanyControllers::class, 'addFinanceCompany']);
        Route::post('admin/edit/finance-company', [CompanyController::class, 'editfinanceCompany']);
        Route::post('admin/add/new-finance-company-employee', [OfficerController::class, 'addFinanceCompanyEmp']);
        Route::post('admin/add/remarks', [AdminController::class, 'addRemarks'])
            ->middleware(['permission:add-remark']);

        Route::post('admin/pre/claim', [AdminClaimController::class, 'addPreComment']);

        Route::post('admin/add/remarks', [AdminClaimController::class, 'addClaimRemark']);
        Route::post('admin/edit-Claim', [AdminClaimController::class, 'editclaiminfo']);

        //payment collected
        Route::post('admin/payment-collected', [AdminClaimController::class, 'claimCollected'])
            ->name('admin.payment-collected');
        //collected by insurance
        Route::post('admin/collected-by-ic', [AdminClaimController::class, 'collectedByIc'])
            ->name('admin.collected-by-ic');



        //admin close
        Route::post('admin/closeClaim', [AdminClaimController::class, 'closeClaim'])
            ->name('admin.closeClaim');

        //partial payment
        Route::post('admin/partial-pay', [AdminController::class, 'payPartial'])
            ->name('admin.partial-pay');

        Route::post('admin/collector', [AdminController::class, 'addCollector']);

        // added by Talha Habib
        
        // send to legal department
        Route::post('/send-to-legal-department',[AdminController::class,'sendToLegalDepartment'])->name('admin.send-to-legal-department');
        // send back to supervisor

        //transfer morror
        Route::post('admin/transfer-morror', [AdminController::class, 'transferMorr'])->name('admin.transfer-morror');
        //transfer to lawyer
        Route::post('admin/transfer-lawyer', [AdminController::class, 'transferLawyer'])->name('admin.transfer-lawyer');
        //transfer to finance
        Route::post('admin/transfer-finance', [AdminController::class, 'transferFinance'])->name('admin.transfer-finance');
        //transfer to elm
        Route::post('admin/transfer-elm', [AdminController::class, 'transferElm'])->name('admin.transfer-elm');
        //transfer to ic
        Route::post('admin/transfer-IC', [AdminController::class, 'transferIc'])->name('admin.transfer-IC');
        //revert to follow up
        Route::post('admin/claim-follow-up', [AdminController::class, 'followStatus'])->name('admin.claim-follow-up');
        //claim reason status
        Route::post('admin/add-reason', [AdminController::class, 'claimReason']);
        Route::post('admin/add/comment', [AdminClaimController::class, 'addClaimComment']);
        //admin create new payment link
        Route::post('admin/create-payment-link', [AdminController::class, 'rePaymentLink'])
            ->name('admin.create-payment-link');
        //admin additional document
        Route::post('admin/additional-document', [AdminController::class, 'additionalDoc'])
            ->middleware(['permission:add-additional-document']);
        //partial pay edit date
        Route::post('admin/partial-edit', [AdminController::class, 'editPartial']);
        //delay edit date
        Route::post('admin/delay-edit', [AdminController::class, 'editDelay']);

        Route::post('admin/custom-sadad', [AdminController::class, 'customSadad']);

        // partial manual collection
        Route::post('admin/partial-manual-collection', [AdminController::class, 'partialManual']);
        //  general profile setting
        Route::post('admin/setting/general', [AdminController::class, 'generalProfileSetting'])
            ->name('admin.setting.general');

        Route::post('admin/claim/register', [AdminController::class, 'registerClaim'])
            ->name('AdminAddClaim');

        Route::post('admin/claim/update', [AdminController::class, 'updateClaim'])
            ->name('admin.claim.update');
        Route::post('admin/register/user', [AdminController::class, 'registerUser'])
            ->name('admin.register.user')
            ->middleware(['permission:add-user']);
        Route::post('admin/edit/user', [AdminController::class, 'editUser'])
            ->name('admin.edit.user')
            ->middleware(['permission:edit-user']);

        Route::post('admin/settings/languages/set', [SettingController::class, 'setLanguage'])->name('admin.settings.languages.set');
        Route::post('admin/store/officer/targets', [OfficerController::class, 'storeTargets'])
            ->name('admin.store.officer.targets');

        Route::post('admin/update/officer/targets', [OfficerController::class, 'updateTargets'])
            ->name('admin.update.officer.targets');
        Route::post('admin/settings/role/permissions', [SettingController::class, 'storePermissions'])->name('admin.settings.role.permissions');

        Route::post('admin/settings/role/create', [SettingController::class, 'createRole'])
            ->name('admin.settings.role.create');

        Route::post('admin/settings/role/update', [SettingController::class, 'updateRole'])
            ->name('admin.settings.role.update');

        // Toogle Company Status
        Route::post('/admin/toogle-status', [CompanyController::class, 'toogleCompanyStatus'])
            ->name('AdminToggleCompanyStatus');
        // Toogle Claim Status
        Route::post('/admin/toogle-claim-status', [AdminClaimController::class, 'toogleClaimStatus'])
            ->name('AdminToggleClaimStatus');
        //rejection detail
        Route::post('/admin/reject/reason', [AdminClaimController::class, 'rejectClaim'])
            ->name('AdminRejectClaim');
    });

/////////////////////////////////////
/////////// END ADMIN ROUTES ////////
////////////////////////////////////






Route::post('/send-back-to-supervisor',[AdminController::class,'sendBackToSV'])->name('admin.send-back-to-supervisor');


//----------------------------------------------------------------------------------------------------------------------
//  Insurance Company Routes
//----------------------------------------------------------------------------------------------------------------------

// IC Sign-Up
Route::get('/ic/sign-up-form', function () {
    return view('ic.signup');
})->name('IcSignUpForm');
// Sign Up
Route::post('/ic/signup', [InsuranceCompanyContoller::class, 'signUp'])->name('IcSignUp');
// IC Sign-In Form
Route::get('/ic/sign-in-form', function () {
    return view('ic.signin');
})->name('IcSignInForm');
// Sign In
Route::post('/ic/signin', [InsuranceCompanyContoller::class, 'signIn'])->name('IcSignIn');
// Logout
Route::match(['get', 'post'], '/ic/logout', [InsuranceCompanyContoller::class, 'logoutIc'])->name('IcLogout');


// Middleware grouped routes
Route::group(['middleware' => 'CI'], function () {
    // Dashboard
    Route::get('/ic/', function () {

        return view('ic.dashboard');
    })->name('IcDashboard');
    Route::post('ic/add/remarks', [AdminController::class, 'addRemarks']);
    Route::get('ic/edit/profile/{id}', function ($id) {
        $claimdata = User::where('id', $id)->first();
        return view('ic.editprofile', compact('claimdata'));
    })->name('IcEditProfile');
    Route::post('ic/update/profile', [InsuranceCompanyContoller::class, 'editprofile']);


    Route::get('/ic/addclaim', [ClaimController::class, 'claimform'])->name('IcAddClaimForm');
    Route::post('/ic/add/claim', [ClaimController::class, 'addclaim'])->name('IcAddClaim');

    ///elm claim
    Route::get('ic/elm-claim', function () {
        $debtor = User::where('roll', 2)->get();
        $reason = Reason::all();
        return view('ic.addelmclaim', compact('debtor', 'reason'));
    });

    Route::post('add/elm-claim', [ClaimController::class, 'elmaddclaim']);
    Route::post('/ic/elm/import/inbulk', [ClaimController::class, 'elmimportexcel'])->name('elmImportExcel');

    Route::get('/ic/elm/viewclaims', [ClaimController::class, 'getelmclaims'])->name('IcElmViewClaim');
    Route::get('/ic/elm/claim/detail/{id}', [ClaimController::class, 'claimgetelm']);
    Route::get('/ic/elm/claim/edit/detail/{id}', [ClaimController::class, 'editelmclaim'])->name('IcElmEditClaim');

    Route::get('/rejectedclaims/elm', function () {
        $claims = Claim::where('status', 2)->where('cid', Auth::user()->id)->where('deb_mob', null)->get();
        return view('ic.rejectedelmclaim', compact('claims'));
    });

    Route::get('/ic/viewclaims', [ClaimController::class, 'getclaims'])->name('IcViewClaim');
    Route::get('/ic/claim/detail/{id}', [ClaimController::class, 'claimget']);
    Route::get('/ic/claim/edit/detail/{id}', [ClaimController::class, 'editclaim'])->name('IcEditClaim');
    Route::post('/ic/claim/resubmit', [ClaimController::class, 'resubmitclaim'])->name('IcResubmitClaim');
    //Approved Requests
    Route::get('/approvedclaims', function () {
        $claims = Claim::where('status', 1)->where('cid', Auth::user()->id)->get();
        return view('ic.approvedclaim', compact('claims'));
    });

    //Rejected Requests
    Route::get('/rejectedclaims', function () {
        $claims = Claim::where('status', 2)->where('cid', Auth::user()->id)->get();
        return view('ic.rejectedclaim', compact('claims'));
    });
    //readed message
    Route::get('readedmessage/{id}', [ClaimController::class, 'readedmsg']);
    //import excel
    Route::post('/ic/import/inbulk', [ClaimController::class, 'importexcel'])->name('ImportExcel');

    //objections

    Route::get('view/valid/objection', function () {
        $objection = DB::table('debtorresponses')->join('claims', 'debtorresponses.claim_id', '=', 'claims.id')->where('debtorresponses.obj_status', 1)->where('debtorresponses.response', 1)->where('claims.cid', Auth::user()->id)->get();
        return view('ic.validobjections', compact('objection'));
    })->name('IcValidObjecton');

    Route::get('ic/claim/in-valid/objection/{id}', [DebtorResponseController::class, 'icinvalid']);
    Route::get('ic/claim/valid/objection/{id}', [DebtorResponseController::class, 'icvalid']);


    //invalid objection company submit list
    Route::get('ic/invalid/objecton', function () {
        $objection = DB::table('debtorresponses')->join('claims', 'debtorresponses.claim_id', '=', 'claims.id')->where('debtorresponses.obj_status', 4)->where('debtorresponses.response', 1)->where('claims.cid', Auth::user()->id)->get();
        return view('ic.invalidobjections', compact('objection'));
    })->name('IcInvalidObjecton');

    //case close by Company list
    Route::get('ic/case/close/objecton', function () {
        $objection = DB::table('debtorresponses')->join('claims', 'debtorresponses.claim_id', '=', 'claims.id')->where('debtorresponses.obj_status', 3)->where('debtorresponses.response', 1)->where('claims.cid', Auth::user()->id)->get();
        return view('ic.casecloseobjections', compact('objection'));
    })->name('IcCaseCloseObjecton');

    Route::get('ic/addFile', function () {
        return view('ic.fileerror');
        //return view('ic.addfile');
    });
    Route::post('ic/preclaim', [ClaimController::class, 'preClaim']);

    Route::get('ic/viewPreclaim', function () {
        $files = PreClaim::where('company_id', Auth::user()->company_id)->get();

        return view('ic.preclaimReq', compact('files'));
    });

    Route::get('ic/rejected-Preclaim', function () {
        $files = PreClaim::where('company_id', Auth::user()->company_id)->where('status', 3)->get();

        return view('ic.preclaimRej', compact('files'));
    });

    //ic comments
    Route::post('ic/add-comment', [ClaimController::class, 'addComment']);

    Route::get('ic/comment/{id}', function ($id) {
        $comments = ClaimComment::where('claim_id', $id)->select('comment', 'status', 'updated_at', 'update_by')->get();
        return view('ic.comments', compact('comments'));
    });
    Route::get('ic/comment', function () {
        $comments = ClaimComment::where('claim_id', 0)->select('comment', 'status', 'updated_at', 'update_by')->get();
        return view('ic.comments', compact('comments'));
    });

    Route::post('ic/additional-document', [AdminController::class, 'companyDoc']);

    //claim summary report
    Route::get('ic/summary-report/{id}', function ($id) {
        $claims = Claim::where('company_id', Auth::user()->company_id)->with('statusee')->select('id', 'acc_date', 'rec_amt', 'created_at', 'status', 'claim_no', 'deb_type')->paginate(10);
        return view('ic.claimsummary', compact('claims'));
    });

    Route::get('ic/setting/{id}', function ($id) {
        $user = User::where('id', $id)->first();
        return view('ic.changepassword', compact('user'));
    });

    //see transaction history

    Route::get('ic/transaction-history', [AdminController::class, 'icAllTransaction']);
    Route::get('ic/partial-payment', [AdminController::class, 'icPartialDetail']);
});



//--------------------------------------------------------------------------------------------------------

//  Increase Count Link


//sadad debtor
Route::post('deb_sadad', [ClaimController::class, 'debSadad'])->name('debtorSadad');

Route::post('debtor/objection', [DebtorResponseController::class, 'debtorobj'])->name('debtorresponse');
//debtor refuse
// Route::get('debtor/refuse/{id}',[DebtorResponseController::class,'debrefuse']);
Route::post('debtor/refuse', [DebtorResponseController::class, 'debrefuse']);
//apply for loan
Route::get('apply/for/loan/{fcom}/{claim}', [DebtorResponseController::class, 'loan']);




//----------------------------------------------------------------------------------------------------------------------

/////////////////////////////////////////////////////////////////
//--------------------Law Firm--------------------------------//
///////////////////////////////////////////////////////////////

Route::get('lawfirm/sign-up-form', function () {
    return view('lawfirm.signup');
})->name('Lfsignup');
Route::post('lawfirm/register', [LawFirmController::class, 'register'])->name('Lfregister');

Route::get('lawfirm/sign-in', function () {
    return view('lawfirm.signin');
})->name('LfSignin');
Route::post('lawfirm/signin', [LawFirmController::class, 'signIn'])->name('Lflogin');



Route::group(['middleware' => 'CLF'], function () {

    Route::get('lawfirm/edit/profile/{id}', function ($id) {
        $lawfirm = User::where('id', $id)->first();
        return view('lawfirm.editprofile', compact('lawfirm'));
    })->name('FirmEditProfile');
    Route::post('lawfirm/update/profile', [LawFirmController::class, 'editprofile']);

    Route::get('lawfirm', [LawfirmController::class, 'dashboard'])->name('Lfdashboard');

    //assign case
    // Route::get('lawfirm/assigned/case',function(){
    //     $assigned=DB::table('debtorrefuses')->where('lawfirm_id',Auth::user()->id)
    //     ->where('status',null)
    //     ->get();

    //     return view('lawfirm.assignedcase',compact('assigned'));
    // })->name('lawfirmassignedcase');

    Route::get('lawfirm/assigned/case', function () {

        $assigned = DB::table('law_firm_cases')->where('lawfirm_id', Auth::user()->id)
            ->get();

        return view('lawfirm.assignedcase', compact('assigned'));
    })->name('lawfirmassignedcase');



    Route::get('lawfirm/view/claim/detail/{id}', [LawFirmController::class, 'getclaim']);
    //ask for additional Document
    Route::get('lawfirm/askadd/document/{id}', function ($id) {
        DB::table('debtorrefuses')->where('id', $id)->update(['status' => 2]);
        return back()->with('success', 'Successfully Ask Additional Documents');
    });

    //Accept the case
    Route::get('lawfirm/accept/case/{id}', function ($id) {
        DB::table('debtorrefuses')->where('id', $id)->update(['status' => 1]);
        return back()->with('success', 'Successfully Case Accepted');
    });

    //lawfirmacceptcase   law firm accepted case
    Route::get('lawfirm/accepted/case', function () {
        $assigned = DB::table('debtorrefuses')->where('lawfirm_id', Auth::user()->id)->where('status', 1)->get();
        return view('lawfirm.acceptedcase', compact('assigned'));
    })->name('lawfirmacceptcase');

    //change case progress
    Route::get('lawfirm/changeprogress/complete/{id}', [LawFirmController::class, 'changeprogress1']);
    Route::get('lawfirm/changeprogress/inprogress/{id}', [LawFirmController::class, 'changeprogress2']);

    //issue verdict
    Route::post('lawfirm/issue/verdict', [LawFirmController::class, 'issueverdict'])->name('issueverdict');

    //accept case after additional document
    Route::get('lawfirm/accept/add/case/{id}', function ($id) {
        DB::table('debtorrefuses')->where('id', $id)->update(['status' => 1]);
        return back()->with('success', 'Case Accepted Successfully');
    });
    Route::get('lawfirm/setting/{id}', function ($id) {
        $user = User::where('id', $id)->first();
        return view('lawfirm.changepassword', compact('user'));
    });
});

/////////////////////////////////////////////////////////////
//-----------------Finance Company------------------------//
///////////////////////////////////////////////////////////
Route::get('finance/company/signin', function () {
    return view('financialcom.signin');
})->name('fclogin');
//Register Finance Company
Route::get('finance/comany/signup', function () {
    return view('financialcom.signup');
});
Route::post('finance/register', [FinanceContoller::class, 'register'])->name('fcregister');

Route::post('finance/login', [FinanceContoller::class, 'signIn'])->name('fcsignin');

Route::group(['middleware' => 'Fc'], function () {


    Route::get('finance/edit/profile/{id}', function ($id) {
        $finance = User::where('id', $id)->first();
        return view('financialcom.editprofile', compact('finance'));
    })->name('fEditProfile');

    Route::post('finance/update/profile', [FinanceContoller::class, 'editprofile']);

    Route::get('financecompany', function () {
        return view('financialcom.dashboard');
    })->name('fcdashboard');

    Route::get('financecompany/logout', function () {
        Auth::logout();
        session()->put('success', 'Logout Successfully');
        return redirect()->route('AdminSignInForm');
    })->name('fclogout');

    Route::get('loan/request', function () {
        $loan = Loan::where('company_id', Auth::user()->company_id)->where('status', 0)->get();

        return view('financialcom.viewloanreq', compact('loan'));
    })->name('NewLoanRequest');
    //accept loan request
    Route::get('accept/loan/request/{id}', function ($id) {
        Loan::where('id', $id)->update(['status' => 1]);
        return back()->with('success', 'Loan Request Accepted Successfully');
    });
    //accepted  loan list  request
    Route::get('loan/accepted', function () {
        $loan = Loan::where('status', 1)->where('company_id', Auth::user()->company_id)->get();
        return view('financialcom.acceptreq', compact('loan'));
    })->name('AcceptedLoanRequest');
    //rejected loan list
    Route::get('loan/rejected', function () {
        $loan = Loan::where('status', 2)->where('company_id', Auth::user()->company_id)->get();
        return view('financialcom.rejectedreq', compact('loan'));
    })->name('RejectedLoanRequest');
    //reject loan request
    Route::get('reject/loan/request/{id}', function ($id) {
        Loan::where('id', $id)->update(['status' => 2]);
        return back()->with('success', 'Loan Request Rejected Successfully');
    });
    //finance view claim request
    Route::get('financecompany/view/detail/{id}', function ($id) {
        $claim = Claim::where('id', $id)->first();
        return view('financialcom.detailclaim', compact('claim'));
    });

    Route::get('financecompany/setting/{id}', function ($id) {
        $user = User::where('id', $id)->first();
        return view('financialcom.changepassword', compact('user'));
    });
});

//  Payment
Route::post('/init-payment', [PaymentController::class, 'initPay'])->name('InitPayment');

Route::get('/response-page', [PaymentController::class, 'getPaymentResponse'])->name('PaymentResponsePage');


//  IVR Routes
Route::get('/ivr/{to?}', [IvrController::class, 'makeCall'])->name('MakeIvrCall');
Route::get('/call-answer/{to?}', [IvrController::class, 'callAnswer'])->name('CallAnswer');
Route::get('/call-busy/{to?}', [IvrController::class, 'callBusy'])->name('CallBusy');
Route::get('/call-reject/{to?}', [IvrController::class, 'callReject'])->name('CallReject');
Route::get('/press1/{to?}', [IvrController::class, 'press1'])->name('Press1');
Route::get('/press0/{to?}', [IvrController::class, 'press0'])->name('Press0');


// Test Routes
Route::get('/test', function () {
    //    initiateCall("+923049167411");
    adminSendMessage("+923094126153", "Kl masti kr raha tha uni :)");
});

Route::get('/clear', function () {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";
});

Route::get('readAll', function () {
    Notification::where([
        ['read', false],
        ['to', Auth::user()->id]
    ])->update(['read' => true]);
    return response('success');
});
Route::get('readAll-admin', function () {
    Notification::where([
        ['read', false],
    ])->update(['read' => true]);
    return response('success');
});
//Route::get('debtor/call/response',[AdminController::class,'callresponse'])->name('callresponse');

Route::get('change/password/{id}', function ($id) {
    $user = User::where('id', $id)->first();
    return view('admin.changepassword', compact('user'));
});
Route::post('user/change/password', [AdminController::class, 'changePassword'])->name('user.change.password');
Route::get('unifonic/response', [AdminController::class, 'unfonic'])->name('callresponse');


Route::post('applyforloan/{id}', [DebtorResponseController::class, 'loan']);

// Route::get('testelm',function(){
// $d=ELM();
// return $d;
// });

Route::get('testelm1', [DebtorResponseController::class, 'testelm']);

Route::get('uni-call-status/{id}', [ClaimController::class, 'callstatusapi']);

Route::get('createPaymentLinkAmt', function () {
    return createPaymentLinkAmt('16', '17');
});

Route::get('delay-payment-response', [PaymentController::class, 'delayPaymentRespone'])->name('PayDelayResponse');
Route::get('partial-payment-response', [PaymentController::class, 'partialPaymentResponse'])->name('PartialPayResponse');

Route::get('payment-success', function () {
    $pay = ['null', 'null', 'null', '2022-12-08 10:40:34'];
    return view('payment', compact('pay'));
});
Route::get('payment-error', function () {
    $errorCode = 64;
    //$pay=['null','null','null','2022-12-08 10:40:34'];
    return view('pay_error', compact('errorCode'));
});

Route::get('exportclaims', [ClaimController::class, 'export']);




Route::any('/admin/search-claim', [ClaimController::class, 'search'])->name('admin.search-claim');

//admin create payment link
Route::get('/admin-payment-link-respone', [PaymentController::class, 'adminPayResponse'])->name('AdminPayLink');
//end admin create payment link



// Route::view('/', 'arabic');
Route::view('contact-us', 'contact');

Route::get('iqama', function () {
    $id = "e79846d2-7df1-4ea6-b107-d2ea1a42ab40";
    return iqamaSMS($id);
});

Route::post('common-contact-us', [AdminController::class, 'contactus']);


// Route::get('red',function(){
//   redistribution();
// });
Route::get('testcall', function () {
    $response = json_decode(callufone('+923310400668'));
    return $response->callId;
});
Route::view('urlinks', 'urwaycode');



Route::get('checking', function () {
    dd(env('URWAYS_PASSWORD'));
});


Route::get('createlink', function () {
    $claimid = 1;
});


Route::get('claimdata', function () {
    $year = 2022;
    $month = 1;
    $accepted = array();
    $returned = array();
    $review = array();
    for ($i = 1; $i <= 12; $i++) {
        $accepted[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)->where('status', 1)
            ->count();

        $returned[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)->where('status', 2)
            ->count();

        $review[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)->where('status', 0)
            ->count();

        $total[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)
            ->count();
    }

    $post = [$accepted, $returned, $review, $total];

    return response()->json($post, 200);
});
Route::get('filedata', function () {
    $year = 2022;
    $month = 1;
    $accepted = array();
    $returned = array();
    $review = array();
    for ($i = 1; $i <= 12; $i++) {
        $accepted[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)->where('status', 2)
            ->count();

        $returned[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)->where('status', 3)
            ->count();

        $review[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)->where('status', 1)
            ->count();

        $total[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)
            ->count();
    }

    $post = [$accepted, $returned, $review, $total];

    return response()->json($post, 200);
});
Route::get('preclaim-year/{id}', function ($id) {
    $year = $id;
    //  dd($year);
    $month = 1;
    $accepted = array();
    $returned = array();
    $review = array();
    for ($i = 1; $i <= 12; $i++) {
        $accepted[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)->where('status', 2)
            ->count();

        $returned[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)->where('status', 3)
            ->count();

        $review[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)->where('status', 1)
            ->count();

        $total[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)
            ->count();
    }

    $post = [$accepted, $returned, $review, $total];

    return response()->json($post, 200);
});


Route::get('claimdata-year/{id}', function ($id) {
    $year = $id;
    $month = 1;
    $accepted = array();
    $returned = array();
    $review = array();
    for ($i = 1; $i <= 12; $i++) {
        $accepted[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)->where('status', 1)
            ->count();

        $returned[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)->where('status', 2)
            ->count();

        $review[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)->where('status', 0)
            ->count();
        $total[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $i)
            ->count();
    }

    $post = [$accepted, $returned, $review, $total];

    return response()->json($post, 200);
});




Route::get('collectedClaiminfo', [AdminController::class, 'collectedClaimInfo']);


//////////////////////////////////TEST//////////////////////////////////
/////////////////////////////////URL/////////////////////////////////////
Route::get('elm-no', function () {
    $claim = Claim::where('deb_mob', null)->get();

    $elmid = array();
    foreach ($claim as $c) {
        $elm = ElmStatus::where('claim_id', $c->id)->first();
        if ($elm) {
        } else {
            array_push($elmid, $c->id);
        }
    }
    dd($elmid);
});



Route::get('testclaim', function () {
    $response = Http::get('https://recovery.taheiya.sa/api/getclaims');
    $claims = json_decode($response->getBody(), true);

    return view('admin.view_claims', compact('claims'));
    //dd($team);
});


Route::get('/ic/viewclaims/beta', [ClaimController::class, 'getclaims'])->name('IcViewClaim');
Route::any('ic/search-claim', [ClaimController::class, 'icSearch']);

Route::get('icexport', [ClaimController::class, 'icexporte']);

///debtor upload additional doc
Route::post('debtor/upoad-file', [ClaimController::class, 'debUpload']);
//sadad payment response
Route::get('sadad-response', [PaymentController::class, 'sadadRes'])->name('sadadResponse');


Route::get('testingsadad', function () {
    return partialsadadLink(907, 50);
    // return sadadLink(907);
});

Route::get('time', function () {
    $t = time();
    dd(date('h:m:s', $t));
});
// Route::get('send-message',function(){
//     $reciever='+966546593305';
//     $amount=10821;
//     $claimid=369;
//     $link='https://payments.urway-tech.com/URWAYPGService/direct.jsp?paymentid=2305413961715914526';

//      $message='عزيزي العميل نرجو التكرم بسداد المبلغ '.$amount.' الرجاء الضغط على الرابط التالي ليتم السداد من خلال احدى قنوات الدفع الرسمية المعتمدة لديكم '.$link.' ، تذكر دائماً أن تهيئة لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال';
//       $reciever=substr($reciever,1);

//     $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
//         "userName"=> "Taheiya",
//         "numbers"=> $reciever,
//         "userSender"=> "Taheiya",
//         "apiKey"=> env('MSEGAT_API_KEY'),
//         "msg"=> $message
//     ]);
//     $data = json_decode($response->getBody(), true);
//   //dd( $data);
//     $smsres=new SmsResponse;
//     $smsres->claim_id=$claimid;
//     $smsres->code=$data['code'];
//     $smsres->phone_no=$reciever;
//     $smsres->message=$data['message'];
//     $smsres->sms=$message;
//     $smsres->save();
// });


Route::get('custom-msgat', function () {
    $reciever = "966503774417";
    $message = "https://payments.urway-tech.com/URWAYPGService/direct.jsp?paymentid=2308713124682520860";
    $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
        "userName" => "Taheiya",
        "numbers" => $reciever,
        "userSender" => "Taheiya",
        "apiKey" => env('MSEGAT_API_KEY'),
        "msg" => "New payment link of 10000 SAR" . $message
    ]);
    $data = json_decode($response->getBody(), true);
    //dd($data);
    if ($data['code'] == 1) {
        $smsres = new SmsResponse;
        $smsres->claim_id = 1417;
        $smsres->code = $data['code'];
        $smsres->phone_no = $reciever;
        $smsres->message = $data['message'];
        $smsres->sms = $message;
        $smsres->save();
        return "done";
    } else {
        Alert::warning('error', 'Sms not sent');
        return "error";
    }
});
Route::get('downloadgig', [ClaimController::class, 'gigexport']);





Route::post('login-otp', [AdminController::class, 'verifyOtp'])->name('otpLogin');
Route::post('apply-security', [AdminController::class, 'twofactor']);





Route::get('test/sadad/partial', function () {

    return partialsadadLink(1859, 100);
});

/// admin custom partil madad linl
Route::get('admin-custome-partial-mada', [PaymentController::class, 'adminCustomPartialMada'])->name('PartialCustomerPayLink');
///end admin custom

/////////////////////17 JULY//////////////////////////
Route::view('test', 'admin.callstatus');


///////////// shared by zeeshan sir - 31-7

Route::post('import/inbulk', [AdminController::class, 'importexcel'])
    ->name('ImportExcel')
    ->middleware(['permission:bulk-import-claims']);

Route::get('admin-read-reminder/{id}', function ($id) {
    $claimRemark = ClaimRemark::where('id', $id)->update(['readRemark' => 1]);
    return response('success');
});
Route::get('admin-read-all-reminder', function () {
    $claimRemark = ClaimRemark::where('readRemark', 0)->update(['readRemark' => 1]);
    return response('readsuccess');
});









///////////////////////////////
//////// OTHER ROUTES /////////
///////////////////////////////

// View Company
Route::get('/view-company', [CompanyController::class, 'viewCompany'])
    ->name('AdminViewCompany');

// View Claims
Route::get('/view-claims', [AdminClaimController::class, 'viewClaims'])
    ->name('view.claims');

//make call
Route::get('make/call/{id}', [DebtorResponseController::class, 'makeCall'])
    ->name('make.call');

//company objection
Route::get('company/valid/objecton', [DebtorResponseController::class, 'companyValidObjection'])
    ->name('CompanyObjection');

//View Lawfirms
Route::get('/view-lawfirms', [AdminController::class, 'viewLawFirm'])
    ->name('AdminViewLawFirm');

//finance Companies list
Route::get('financecompanies', [CompanyController::class, 'financeCompany'])
    ->name('fcompanies');

//selected claim approve
Route::post('approve/claims', [AdminClaimController::class, 'approve'])
    ->name('approve.claims');
//selected f company approve
Route::post('verify-unverify/seleced', [AdminController::class, 'verify']);


Route::get('admin-list', [AdminController::class, 'adminList'])
    ->name('admin-list');

//claims distribution
Route::get('admin-distribute/claims', [AdminClaimController::class, 'distributeClaims']);
Route::post('admin-staff', [AdminController::class, 'adminStaff']);

//admin re assign claim to admin
Route::post('AdminReassignClaim', [AdminClaimController::class, 'reassClaim']);


Route::get('cities', [ArtController::class, 'cities']);

Route::post('filterform', [AdminController::class, 'filterForm']);
Route::post('collectedClaiminfo', [AdminController::class, 'collectedClaimInfo']);
Route::post('claimsStatusinfo', [AdminController::class, 'claimStatusInfo']);
Route::post('claimsaginginfo', [AdminController::class, 'claimAgingInfo']);

Route::get('payment-vocher/{id}', [AdminController::class, 'paymentVocher']);

//payment delay
Route::post('admin-pay/delay', [AdminController::class, 'payDelay'])
    ->name('admin-pay.delay');
    
Route::get('admin/reassign-claim',function(){
    $claims = Claim::select('id','claim_no','is_assign')->paginate(500);
    return view('admin.reassignbulkclaim',compact('claims'));
})->name('adminReassignedClaim'); 
Route::post('admin-reassign-claim',[AdminController::class, 'claimReassign']);

Route::post('edit-art-remark',[AdminController::class,'editArtRemark']);

