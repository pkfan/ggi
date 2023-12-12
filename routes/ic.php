<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ICcontroller;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InsuranceCompanyContoller;
use App\Http\Controllers\DebtorResponseController;
use App\Http\Controllers\IvrController;
use App\Http\Controllers\LawFirmController;
use App\Http\Controllers\FinanceContoller;
use App\Http\Controllers\PaymentController;
use App\Models\Reason;
use App\Models\User;
use App\Models\Claim;
use App\Models\Message;
use App\Models\Loan;
use App\Models\CallStatus;
use App\Models\DebtorResponse;
use App\Models\Notification;
use App\Models\Company;
use App\Models\FinancialCompany;
use App\Models\PreClaim;
use App\Models\ClaimRemark;
use App\Models\Supported_Doc;
use App\Models\SmsResponse;
use App\Models\Distribution;
use App\Models\ClaimComment;
use App\Models\ClaimStatus;
use App\Models\ElmStatus;
use App\Models\payment;
use App\Models\PartialPay;
use App\Models\CollectedClaim;
use App\Models\AdminDoc;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/ic/home', [ICcontroller::class, 'index']);
// Route::get('/ic/claim/add', [ICcontroller::class, 'AddClaims']);
// Route::get('/ic/claim/list', [ICcontroller::class, 'Claimslist']);
// Route::get('/ic/claim/approved', [ICcontroller::class, 'ApprovedClaims']);
Route::get('/ic/request/add', [ICcontroller::class, 'AddRequest']);
// Route::get('/ic/request/view', [ICcontroller::class, 'ViewRequest']);
Route::get('/ic/request/rejected', [ICcontroller::class, 'RejectedRequest']);
Route::get('/ic/elm/add', [ICcontroller::class, 'AddELM']);
// Route::get('/ic/elm/view', [ICcontroller::class, 'ViewELM']);
Route::get('/ic/elm/rejected', [ICcontroller::class, 'RejectedELM']);
Route::get('/ic/objection/valid', [ICcontroller::class, 'ValidObjection']);
Route::get('/ic/objection/invalid', [ICcontroller::class, 'InvalidObjection']);
Route::get('/ic/objection/caseclosed', [ICcontroller::class, 'CaseClosedObjection']);
Route::get('/ic/ReportSummary', [ICcontroller::class, 'ReportSummary']);
// Route::get('/ic/PartialDetail', [ICcontroller::class, 'PartialDetail']);
// Route::get('/ic/addclaim',[ClaimController::class,'claimform'])->name('IcAddClaimForm');
// Route::post('/ic/add/claim',[ClaimController::class,'addclaim'])->name('IcAddClaim');


//----------------------------------------------------------------------------------------------------------------------
//  Admin Routes
//----------------------------------------------------------------------------------------------------------------------
// Route::get('recoveryservices',function () {

//     return view('recoveryservices');
// });
// // Sign In


// Route::post('admin/signin',[AdminController::class,'signIn'])->name('AdminSignIn')->middleware(['throttle:5,1']) ;
// Route::middleware(['preventBackHistory'])->group(function () {
    //  Sign-In Form
    // Route::get('signin-form',function () {
    //     return view('admin.signin');
    // })->name('AdminSignInForm')->middleware(['throttle:5,1']);
    //forget password
    // Route::get('forget/password',function () {
    //     return view('admin.forgetpassword');
    // })->middleware(['throttle:5,1']);
    // Route::post('reset-password',[AdminController::class,'resetPassword'])->middleware(['throttle:5,1']);

    // Logout
    Route::match(['get','post'],'/logout',[AdminController::class,'logoutAdmin'])->name('AdminLogout');


//     // Middleware grouped routes
//     Route::group(['middleware' => 'CA'], function () {
//         // Dashboard
//         Route::get('sign-in',function () {
//             $link= Claim::where('status',1)->get();
//             return view('admin.dashboard',compact('link'));
//         })->name('AdminDashboard');
//         // View Company
//         Route::get('/view-company',function () {
//             $companies=User::where(['roll'=>1,])->get();
//             return view('admin.view_company',compact('companies'));
//         })->name('AdminViewCompany');

//         // View Claims
//         Route::get('/view-claims',function () {

//         if(Auth::user()->is_super==1){
//             $claims = Claim::select('id','company_id','cid','claim_no','deb_mob','deb_name','type','rec_amt','acc_date','created_at','status','deb_type','acc_location','deb_name','deb_iqama')->get();
//             return view('admin.view_claims',compact('claims'));

//         }else{
//             $claims = Claim::select('id','company_id','cid','claim_no','deb_mob','deb_name','type','rec_amt','acc_date','created_at','status','deb_type','acc_location','deb_name','deb_iqama')->get();
//             return view('admin.view_claims',compact('claims'));

//         }

//         });
//         // Rejected Claims
//         Route::get('/rejectclaims',function(){

//             if(Auth::user()->company_id != null){
//                     $claims=Claim::where('status',2)->where('company_id',Auth::user()->company_id)->get();
//                     return view('admin.reject_claim',compact('claims'));
//             }else{
//                  if(Auth::user()->is_super==1){
//                 $claims=Claim::where('status',2)->get();
//                 return view('admin.reject_claim',compact('claims'));
//                 }else{
//                     $claims=Claim::where('status',2)->where('is_assign',Auth::user()->id)->get();
//                     return view('admin.reject_claim',compact('claims'));
//                 }
//             }


//         });
//         //Approved Claims
//         Route::get('/adminapprovedclaims',function(){
//             if(Auth::user()->company_id != null){

//                 $claims=Claim::where('status',1)->where('company_id',Auth::user()->company_id)->get();
//                 return view('admin.approved_claim',compact('claims'));

//             }else{
//                  if(Auth::user()->is_super==1){
//                 $claims=Claim::where('status',1)->get();
//                 return view('admin.approved_claim',compact('claims'));
//                 }else{
//                     $claims=Claim::where('status',1)->where('is_assign',Auth::user()->id)->get();
//                     return view('admin.approved_claim',compact('claims'));
//                 }
//             }



//         });
//         // Toogle Company Status
//         Route::post('/admin/toogle-status',[AdminController::class,'toogleCompanyStatus'])->name('AdminToggleCompanyStatus');
//         // Toogle Claim Status
//         Route::post('/admin/toogle-claim-status',[AdminController::class,'toogleClaimStatus'])->name('AdminToggleClaimStatus');
//         // Send Message
//         Route::get('/admin/send-message',[AdminController::class,'sendMessage'])->name('AdminSendSMS');
//         // Make Call
//         Route::get('/admin/make-call',[AdminController::class,'initiateCall'])->name('AdminMakeCall');
//         //Claim Details
//         Route::get('/admin/claim/detail/{id}',[AdminController::class,'claimDetail'])->name('AdminClaimDetail');
//         //edit claim admin/edit/claim/detail
//         //Route::get('admin/edit/claim/detail/{id}',[AdminController::class,'editclaim']);
//         Route::get('admin/edit/claim/detail/{id}',[AdminController::class,'editclaim'])->name('EditAdminClaim');
//         Route::post('admin/claim/resubmit',[AdminController::class,'resubmitclaim'])->name('AdminResubmitClaim');
//         //rejection detail
//         Route::post('/admin/reject/reason',[AdminController::class,'rejectClaim'])->name('AdminRejectClaim');

//         //make call
//         Route::get('make/call/{id}',[AdminController::class,'makeCall']);
//         //remove support documnet
//          Route::get('admin/remove/claim/file/{claimid}/{file}',function($claimid,$file){
//             $preclaim=PreClaim::where('claim_id',$claimid)->where('status',2)->first();


//             $document=json_decode($preclaim->document);
//            // dd($document,addslash($file));
//             for($i=0;$i<sizeof($document);$i++){
//                     if($document[$i]==addslash($file)){
//                         $document[$i]='';
//                     }
//             }
//             $doc=json_encode($document);
//             $preclaim->document=$doc;
//             $preclaim->save();
//             return back()->with('success','File Removed Successfully');

//         });

//         Route::get('admin/remove/file/claim/{claimno}/{file}',function($claimno,$file){

//             $preclaim=PreClaim::where('claim_no',$claimno)->where('status',1)->first();


//             $document=json_decode($preclaim->document);
//            // dd($document,addslash($file));
//             for($i=0;$i<sizeof($document);$i++){
//                     if($document[$i]==addslash($file)){
//                         $document[$i]='';
//                     }
//             }
//             $doc=json_encode($document);
//             $preclaim->document=$doc;
//             $preclaim->save();
//             return back()->with('success','File Removed Successfully');

//         });

//         //remove supportive doc
//         Route::get('admin/remove/supportive/doc/{id}/{file}',function($id,$file){
//             $file=addslash($file);
//             $doc=Supported_Doc::where('doc_name',$file)->first();
//             unlink(public_path().'/'.$file);
//             $doc->delete();
//             return back()->with('success','Document Remove Successfully');


//         });

//         //sms call response

//         //objections................................................
//         Route::get('objection',function(){

//                 if(Auth::user()->company_id != null){
//                  $objection=DebtorResponse::join('claims','debtorresponses.claim_id','=','claims.id')
//                 ->where('claims.company_id',Auth::user()->company_id)->where('debtorresponses.response',1)
//                ->where('debtorresponses.obj_status',null)->get();
//                 return view('admin.callsmsresponses',compact('objection'));
//             }else{
//                   $objection=DebtorResponse::where('response',1)->where('obj_status',null)->get();
//                 return view('admin.callsmsresponses',compact('objection'));
//             }

//             // $objection=DebtorResponse::where('response',1)->where('obj_status',null)->get();
//             // return view('admin.callsmsresponses',compact('objection'));

//         })->name('RespondObjection');

//         Route::post('admin/claim/valid/objection',[DebtorResponseController::class,'valid']);

//         //debtor valid objections
//         Route::get('valid/objection',function(){

//             $objection=DebtorResponse::where('response',1)->where('obj_status',1)->get();
//             return view('admin.validobjections',compact('objection'));

//         })->name('ValidObjection');


//      //debtor invalid objections
//      Route::get('admin/claim/in-valid/objection/{id}',[DebtorResponseController::class,'invalid']);
//      Route::get('invalid/objection',function(){
//     if(Auth::user()->company_id != null){
//              $objection=DebtorResponse::join('claims','debtorresponses.claim_id','=','claims.id')
//             ->where('claims.company_id',Auth::user()->company_id)->where('debtorresponses.response',1)
//            ->where('debtorresponses.obj_status',0)->get();
//             return view('admin.invalidobjections',compact('objection'));
//         }else{
//               $objection=DebtorResponse::where('response',1)->where('obj_status',0)->get();
//             return view('admin.invalidobjections',compact('objection'));
//         }
//         // $objection=DebtorResponse::where('response',1)->where('obj_status',0)->get();
//         // return view('admin.invalidobjections',compact('objection'));

//     })->name('InValidObjection');

//     //company objection
//     Route::get('company/valid/objecton',function(){
//          if(Auth::user()->company_id != null){
//              $objection=DebtorResponse::join('claims','debtorresponses.claim_id','=','claims.id')
//             ->where('claims.company_id',Auth::user()->company_id)->where('debtorresponses.response',1)
//            ->where('debtorresponses.obj_status',4)->get();
//            return view('admin.companyobjections',compact('objection'));
//         }else{
//               $objection=DebtorResponse::where('response',1)->where('obj_status',4)->get();
//             return view('admin.companyobjections',compact('objection'));
//         }
//         // $objection =DebtorResponse::where('response',1)->where('obj_status',4)->get();
//         // return view('admin.companyobjections',compact('objection'));
//     })->name('CompanyObjection');
//     //case close objection
//     Route::get('case/close/objecton',function(){
//         $objection =DebtorResponse::where('response',1)->where('obj_status',3)->get();
//         return view('admin.casecloseobjections',compact('objection'));
//     })->name('AdminCaseCloseObjection');


//     //View Lawfirms
//     Route::get('/view-lawfirms',function () {
//         $lawfirms=User::where(['roll'=>2,])->get();
//         return view('admin.viewlawfirms',compact('lawfirms'));
//     })->name('AdminViewLawFirm');
//     //change lawfirm status
//     Route::get('admin/change/lawfirm/status/{id}',[AdminController::class,'lfstatus'])->name('changelfstatus');
//     //view refuesed claim
//     Route::get('admin/response/refused',function(){
//         if(Auth::user()->company_id != null){
//               $response=DebtorResponse::join('claims','debtorresponses.claim_id','=','claims.id')
//             ->where('claims.company_id',Auth::user()->company_id)->where('debtorresponses.response',2)->get();

//             return view('admin.refuseresponse',compact('response'));
//         }else{
//               $response=DebtorResponse::where('response',2)->get();
//         return view('admin.refuseresponse',compact('response'));
//         }


//     })->name('responseRefused');
//     // assign law firm on refuse


//     Route::get('admin/check/call/status',function(){
//         $response=CallStatus::all();
//         return view('admin.callstatus',compact('response'));

//     })->name('callstatus');
//     Route::get('admin/call-again/{id}',[AdminController::class,'callAgain']);

//     Route::get('admin/assign/firm/{res}/{firm}',[AdminController::class,'assignfirm']);


//     //view refuse claim details
//     Route::get('admin/view/refuse/claim/detail/{id}',[AdminController::class,'getclaim']);

//     //admin upload additional documents  admin/upload/addionaldoc
//     Route::post('admin/upload/addionaldoc',[AdminController::class,'uploaddoc']);


//     //finance Companies list
//     Route::get('financecompanies',function(){
//         $fcompany=User::where('roll',3)->get();
//         return view('admin.viewfcompany',compact('fcompany'));
//     })->name('fcompanies');


//     //admin view loan request
//     Route::get('admin/view/loan/requests',function(){
//           if(Auth::user()->company_id != null){
//             $loan=DebtorResponse::join('claims','debtorresponses.claim_id','=','claims.id')
//            ->where('claims.company_id',Auth::user()->company_id)->where('debtorresponses.response',4)->get();
//            return view('admin.viewloanreq',compact('loan'));
//        }else{
//              $loan=DebtorResponse::where('response',4)->get();
//            return view('admin.viewloanreq',compact('loan'));
//        }
//         // $loan=DebtorResponse::where('response',4)->get();
//         // return view('admin.viewloanreq',compact('loan'));
//     })->name('adminLoanView');
//     Route::post('admin/assign/finance-company',[AdminController::class,'assignFcom']);
//     Route::get('admin/view/loan/request/details/{id}',[AdminController::class,'loanreqdetail']);

//     Route::get('admin/view/loan/accept/loan/requests',function(){
//         $loan=Loan::where('status',1)->get();
//         return view('admin.viewacceptloan',compact('loan'));
//     })->name('adminLoanAcc');;

//     Route::get('admin/view/loan/rejected/loan/requests',function(){
//         $loan=Loan::where('status',2)->get();
//         return view('admin.viewrejectloan',compact('loan'));
//     })->name('adminLoanRej');


//     //selected claim approve
//     Route::post('approve/claims',[AdminController::class,'approve']);
//     //selected f company approve
//     Route::post('verify-unverify/seleced',[AdminController::class,'verify']);

//     //company list
//     Route::get('admin/companies-list',function(){
//         $companies=Company::all();
//         return view('admin.companieslist',compact('companies'));
//     });

//     Route::get('admin/edit-company/{id}',function($id){
//         $company=Company::where('id',$id)->first();
//         return view('admin.editcompany',compact('company'));
//     });

//     Route::post('admin/edit/company',[AdminController::class,'editCompany']);

//     //add company
//     Route::get('admin/add/company',function(){
//         return view('admin.addcompany');
//     });
//     Route::post('admin/add/new-company',[AdminController::class,'addCompany']);
//     //company employee list
//     Route::get('admin/company-employee-list',function(){
//         $users=User::where('roll',1)->get();
//         return view('admin.employeelist',compact('users'));
//     });
//     //add company employee
//     Route::get('admin/add/company-employee',function(){
//         $company=Company::all();
//         return view('admin.companyEmp',compact('company'));
//     });
//     Route::post('admin/add/new-company-employee',[AdminController::class,'addCompanyEmp']);

//     //edit employee
//     Route::get('admin/edit-employee/{id}',function($id){
//         $user=User::where('id',$id)->first();
//         $company=Company::all();
//         return view('admin.editcompanyEmp',compact('user','company'));
//     });
//     Route::post('admin/edit/company-employee',[AdminController::class,'editCompanyEmp']);

//     //finance Company \
//     Route::get('admin/finance-companies-list',function(){
//         $financies=FinancialCompany::all();
//         return view('admin.financecompany_list',compact('financies'));
//     });

//     Route::get('admin/add/financial-company',function(){
//         return view('admin.addfinancecompany');
//     });

//     Route::post('admin/add/new-finance-company',[AdminController::class,'addFinanceCompany']);

//     Route::get('admin/edit-finance-company/{id}',function($id){
//         $company=FinancialCompany::where('id',$id)->first();
//         return view('admin.editfinancecompany',compact('company'));
//     });



//     Route::post('admin/edit/finance-company',[AdminController::class,'editfinanceCompany']);

//     Route::get('admin/finance-company-employee-list',function(){
//         $users=User::where('roll',3)->get();
//         return view('admin.financeemp_list',compact('users'));
//     });

//     Route::get('admin/add/finance-employee',function(){
//         $company=FinancialCompany::all();
//         return view('admin.financeEmp',compact('company'));
//     });
//     Route::post('admin/add/new-finance-company-employee',[AdminController::class,'addFinanceCompanyEmp']);

//     Route::get('admin/edit-finance-employee/{id}',function($id){
//         $user=User::where('id',$id)->first();
//         $company=FinancialCompany::all();
//         return view('admin.editfinanceEmp',compact('user','company'));
//     });

//     Route::get('admin/de-active/user/{id}',function($id){
//         $user=User::where('id',$id)->first();
//         $user->status=1;
//         $user->save();
//         return back()->with('success','User Active Successfully');
//     });

//     Route::get('admin/active/user/{id}',function($id){
//         $user=User::where('id',$id)->first();
//         $user->status=0;
//         $user->save();
//         return back()->with('success','User De-Active Successfully');
//     });


//     Route::post('admin/add/remarks',[AdminController::class,'addRemarks']);

//        Route::get('admin/ic/preclaim',function(){
//            if(Auth::user()->company_id != null){
//                 $files=PreClaim::where('company_id',Auth::user()->company_id)->get();
//                  return view('admin.preclaimReq',compact('files'));
//            }else{
//               $files=PreClaim::all();
//               return view('admin.preclaimReq',compact('files'));
//            }


//     })->name('icFileRequest');

//    //Route::get('admin/addclaim/{id}',[ClaimController::class,'claimform'])->name('IcAddClaimForm');
//   Route::get('admin/addclaim/{id}',function(){
//       //  $debtor=User::where('roll',2)->get();
//         $reason=Reason::all();
//         return view('admin.addclaim',compact('reason'));
//   });
//     Route::post('admin-addclaim',[AdminController::class,'addClaim'])->name('AdminAddClaim');
//     Route::get('admin/preclaim/approve/{id}',function($id){
//         $file=PreClaim::find($id);
//         $file->status=2;
//        // $file->save();
//         return redirect('admin/addclaim/'.$file->claim_no);
//     });

//     Route::post('admin/pre/claim',[AdminController::class,'addPreComment']);

//     Route::post('admin/add/remarks',[AdminController::class,'addClaimRemark']);

//     Route::get('admin/view-remarks/{id}',function($id){
//         $remarks=ClaimRemark::where('claim_id',$id)->get();
//         return view('admin.claimremark',compact('remarks'));
//     });

//     Route::get('admin/add/admin-staff',function(){
//         return view('admin.adminstaff');

//     });
//     Route::post('admin-staff',[AdminController::class,'adminStaff']);

//     Route::get('admin-list',function(){
//         $users=User::where('roll',0)->get();
//         return view('admin.admin_list',compact('users'));
//     });

//     //claims distribution
//     Route::get('admin-distribute/claims',function(){
//     return distribution();
//     });
//     //admin view distibuted claims list
//     Route::get('admin/assigned-claims',function(){
//     $dis=Distribution::orderBy('id', 'DESC')->get();
//     return view('admin.assignedclaim',compact('dis'));
//     });
//     //admin re assign claim to admin
//     Route::post('AdminReassignClaim',[AdminController::class,'reassClaim']);
//     //admin sms response
//     Route::get('admin/sms-response',function(){

//         if(Auth::user()->company_id != null){
//             $smsres=SmsResponse::join('claims','sms_response.claim_id','=','claims.id')->
//             where('company_id',Auth::user()->company_id)->get();
//             return view('admin.smsresponse',compact('smsres'));
//         }else{
//            $smsres=SmsResponse::all();
//             return view('admin.smsresponse',compact('smsres'));
//         }
//     });
//     //admin resend sms
//     Route::get('admin/resend/msg/{claimid}',[AdminController::class,'reSendMessage']);

//     //transaction history
//     Route::get('admin/transaction-history',[AdminController::class,'allTransaction']);
//     //all remarks
//     Route::get('admin/view-claims-remarks',function(){

//         if(Auth::user()->company_id != null){
//             $claims=Claim::where('company_id',Auth::user()->company_id )->get();
//             return view('admin.viewRemarks',compact('claims'));
//         }else{
//             $claims=Claim::all();
//             return view('admin.viewRemarks',compact('claims'));
//         }


//     });

//     Route::get('admin/edit-claim/{id}',function($id){
//             $claim=Claim::where('id',$id)->first();
//             return view('admin.editclaim',compact('claim'));
//         });
//     Route::post('admin/edit-Claim',[AdminController::class,'editclaiminfo']);

//     //payment collected
//     Route::post('admin/payment-collected',[AdminController::class,'claimCollected']);
//     //collected by insurance
//     Route::post('admin/collected-by-ic',[AdminController::class,'collectedByIc']);

//     //payment delay
//     Route::post('admin-pay/delay', [AdminController::class, 'payDelay']);

//     //admin close
//     Route::post('admin/closeClaim',[AdminController::class,'closeClaim']);

//     //partial payment
//     Route::post('admin/partial-pay',[AdminController::class,'payPartial']);

//     //collector
//     Route::get('admin/add-collectors',function(){
//             return view('admin.collectors');
//         });
//     Route::post('admin/collector',[AdminController::class,'addCollector']);

//     //transfer morror
//     Route::post('admin/transfer-morror',[AdminController::class,'transferMorr']);
//     //transfer to lawyer
//     Route::post('admin/transfer-lawyer',[AdminController::class,'transferLawyer']);
//     //transfer to finance
//     Route::post('admin/transfer-finance',[AdminController::class,'transferFinance']);
//     //transfer to elm
//     Route::post('admin/transfer-elm',[AdminController::class,'transferElm']);
//     //transfer to ic
//     Route::post('admin/transfer-IC',[AdminController::class,'transferIc']);
//     //revert to follow up
//     Route::post('admin/claim-follow-up',[AdminController::class,'followStatus']);
//     //claim reason status
//     Route::post('admin/add-reason',[AdminController::class,'claimReason']);
//     //comments
//     Route::get('admin/comment/{id}',function($id){
//     $comments=ClaimComment::where('claim_id',$id)->select('comment','status','updated_at','update_by')->get();
//     return view('admin.comments',compact('comments'));
//     });
//     Route::post('admin/add/comment',[AdminController::class,'addComment']);
//     Route::get('admin/comment',function(){
//     $comments=ClaimComment::where('claim_id',0)->select('comment','status','updated_at','update_by')->get();
//     return view('admin.comments',compact('comments'));
//     });

//     Route::get('admin/check/call/demo', function () {

//         if(Auth::user()->company_id != null){
//             $response = CallStatus::join('claims','call_status.claim_id','=','claims.id')->
//             where('claims.company_id',Auth::user()->company_id)->get();
//             // dd($response[0]->call_status->status);

//             return view('admin.callstatus1', compact('response'));
//         }else{
//             $response = CallStatus::all();
//             return view('admin.callstatus1', compact('response'));
//         }


//     });

//     //admin create new payment link
//     Route::post('admin/create-payment-link',[AdminController::class,'rePaymentLink']);
//     //admin additional document
//     Route::post('admin/additional-document',[AdminController::class,'additionalDoc']);
//     //admin discharge letter
//     Route::get('admin/generate-final/{id}',[AdminController::class,'generateLetter']);

//     //partial pay edit date
//     Route::post('admin/partial-edit',[AdminController::class,'editPartial']);
//     //delay edit date
//     Route::post('admin/delay-edit',[AdminController::class,'editDelay']);

//     Route::get('admin/elm-status',function(){

//         if(Auth::user()->company_id != null){

//              $elm=ElmStatus::join('claims','elm_status.claim_id','=','claims.id')
//              ->where('claims.company_id',Auth::user()->company_id)->get();
//              return view('admin.elmstatus',compact('elm'));
//         }else{
//              $elm=ElmStatus::all();
//              return view('admin.elmstatus',compact('elm'));
//         }

//     });


//     //partialpay list
//     Route::get('admin/partialpay-list',function(){
//     $partial=PartialPay::all();
//     return view('admin.partial_list',compact('partial'));
//     });

//     Route::get('cities',function(){
//             $cities=[ 'الرياض','جدة','الدمام','مكة المكرمة','المدينة المنورة','الخبر','الظهران','الاحساء','Artawiya','الطائف',
//         'جازان','بريدة','تبوك','القطيف','خميس مشيط','حفر الباطن','الجبيل','الخرج','أبها','حائل','نجران','ينبع','صبيا','الدوادمي',
//         'بيشة','أبو عريش','القنفذة','محايل عسير','سكاكا','عرعر','عنيزة','القريات','صامطة','المجمعة','القويعية','أحد المسارحة','الرس','الباحة',
//         'الجموم','رابغ','شرورة','الليث','رفحاء','عفيف','الخفجي','الدرعية','طبرجل','بيش','الزلفي','الدرب','سراة عبيدة','رجال المع',
//         'الأفلاج','بلجرشي','وادي الدواسر','أحد رفيدة','بدر','أملج',' رأس تنورة', 'المهد', 'البكيرية','البدائع','الحناكية','العلا',
//         'الطوال','النماص','المجاردة','بقيق','تثليث','النعيرية','المخواة','الوجه','ضباء','بارق','خيبر','طريف','رنية','دومة الجندل',
//         'المذنب','تربة','ظهران الجنوب','حوطة بني تميم','الخرمة','شقراء','المزاحمية','الأسياح','السليل','تيماء','الارطاوية','ضرمة','الحريق',
//         'حقل','حريملاء','جلاجل','المبرز', 'القيصومة','سبت العلايا', 'صفوة', 'سيهات', 'تنومة', 'تاروت', 'ثادق', 'الثقبة'
//         ];

//         $citiesamtdirect=array();
//         $citiesamtcollect=array();

//             for($i=0;$i<sizeof($cities);$i++){
//                 $direct=Claim::join('payment','payment.claim_id','=','claims.id')
//                 ->where('payment.response_code',000)->
//                 where('claims.acc_location',$cities[$i])->sum('payment.amount');
//                 array_push($citiesamtdirect,$direct);
//                 $collected=Claim::join('claim_collected','claim_collected.claim_id','=','claims.id')
//                 ->where('claims.acc_location',$cities[$i])->sum('claims.rec_amt');
//                 array_push($citiesamtcollect,$collected);

//             }

//             $post=[$citiesamtcollect,$citiesamtdirect];
//             return response($post,200);

//     });

//     Route::post('filterform',[AdminController::class,'filterForm']);
//     Route::post('collectedClaiminfo',[AdminController::class,'collectedClaimInfo']);
//     Route::post('claimsStatusinfo',[AdminController::class,'claimStatusInfo']);
//     Route::post('claimsaginginfo',[AdminController::class,'claimAgingInfo']);

//     Route::get('payment-vocher/{id}',[AdminController::class,'paymentVocher']);

//     Route::get('admin/resend-elm/{id}',[AdminController::class,'eleMsg']);

//     Route::get('admin/delete-doc/{id}',function($id){
//         try{
//         $doc=AdminDoc::where('id',$id)->first();
//         $doc->delete();
//         return back()->with('success','Deleted successfully');
//         }catch(\Exception $e){
//         return back()->with('error','Something went wrong');
//         }

//     });

//     //admin custom sadad link
//     Route::post('admin/custom-sadad',[AdminController::class,'customSadad']);

//     //GIG Report
//     Route::get('admin/gig-report',function(){
//     $claims= Claim::where('company_id',3)->with('statusee')->select('id','acc_date','rec_amt','created_at','status','claim_no','deb_type')->paginate(10);
//     return view('admin.gigreport',compact('claims'));
//     });

//     // partial manual collection
//     Route::post('admin/partial-manual-collection',[AdminController::class,'partialManual']);
//     //  admin change password
//     Route::get('admin/setting/{id}',function($id){
//     $user=User::where('id',$id)->first();
//     return view('admin.changepassword',compact('user'));
//     });

//     Route::get('admin/view-claims-beta',function(){
//         if(Auth::user()->company_id != null){
//         $claims=Claim::select('id','company_id','cid','claim_no','deb_mob','deb_name','type','rec_amt','acc_date','created_at','status','deb_type','acc_location','deb_name','deb_iqama','is_assign')
//         ->where('company_id',Auth::user()->company_id)->paginate(10);
//         return view('admin.reg_claims',compact('claims'));
//         }else{

//         $claims=Claim::select('id','company_id','cid','claim_no','deb_mob','deb_name','type','rec_amt','acc_date','created_at','status','deb_type','acc_location','deb_name','deb_iqama','is_assign')->paginate(10);
//         return view('admin.reg_claims',compact('claims'));

//         }
//     })->name('AdminViewClaims');

//     Route::get('admin/view-claims-beta/{paginate}',function($paginate){
//         if(Auth::user()->company_id != null){
//         $claims=Claim::select('id','company_id','cid','claim_no','deb_mob','deb_name','type','rec_amt','acc_date','created_at','status','deb_type','acc_location','deb_name','deb_iqama','is_assign')
//         ->where('company_id',Auth::user()->company_id)->paginate($paginate);
//         return view('admin.reg_claims',compact('claims'));
//         }else{

//         $claims=Claim::select('id','company_id','cid','claim_no','deb_mob','deb_name','type','rec_amt','acc_date','created_at','status','deb_type','acc_location','deb_name','deb_iqama','is_assign')->paginate($paginate);
//         return view('admin.reg_claims',compact('claims'));

//         }
//     });

//     Route::view('admin-calendar','admin.calander');
//     ///admin partial sadad and mada payment
//     Route::get('admin/partial-custom/{id}',[AdminController::class,'customPartial']);

//     //partial payment check received or not
//     Route::get('check-paylink/{id}',[AdminController::class,'paymentlinkCheck']);

//     Route::any('admin/paginate-data',[AdminController::class,'paginateClaim']);
// });

// //----------------------------------------------------------------------------------------------------------------------












// //----------------------------------------------------------------------------------------------------------------------
// //  Insurance Company Routes
// //----------------------------------------------------------------------------------------------------------------------

// IC Sign-Up
Route::get('/ic/sign-up-form',function () {
    return view('ic.signup');
})->name('IcSignUpForm');
// Sign Up
Route::post('/ic/signup',[InsuranceCompanyContoller::class,'signUp'])->name('IcSignUp');
// IC Sign-In Form
Route::get('/ic/sign-in-form',function () {
    return view('ic.signin');
})->name('IcSignInForm');
// Sign In
Route::post('/ic/signin',[InsuranceCompanyContoller::class,'signIn'])->name('IcSignIn');
// // Logout
// Route::match(['get','post'],'/ic/logout',[InsuranceCompanyContoller::class,'logoutIc'])->name('IcLogout');


// // Middleware grouped routes
// Route::group(['middleware' => 'CI'], function () {
//     // Dashboard
    Route::get('/ic/',function () {
        return view('ic.index');
    })->name('IcDashboard');
    Route::post('ic/add/remarks',[AdminController::class,'addRemarks']);
//     Route::get('ic/edit/profile/{id}',function($id){
//         $claimdata=User::where('id',$id)->first();
//         return view('ic.editprofile',compact('claimdata'));
//     })->name('IcEditProfile');
//     Route::post('ic/update/profile',[InsuranceCompanyContoller::class,'editprofile']);


    Route::get('/ic/addclaim',[ClaimController::class,'claimform'])->name('IcAddClaimForm');
    Route::post('/ic/add/claim',[ClaimController::class,'addclaim'])->name('IcAddClaim');

//      ///elm claim
    Route::get('ic/elm-claim',function(){
        $debtor=User::where('roll',2)->get();
        $reason=Reason::all();
        return view('ic.ELMClaims.AddELM',compact('debtor','reason'));
    });

    Route::post('add/elm-claim',[ClaimController::class,'elmaddclaim']);
//     Route::post('/ic/elm/import/inbulk',[ClaimController::class,'elmimportexcel'])->name('elmImportExcel');

     Route::get('/ic/elm/viewclaims',[ClaimController::class,'getelmclaims'])->name('IcElmViewClaim');
//     Route::get('/ic/elm/claim/detail/{id}',[ClaimController::class,'claimgetelm']);
//     Route::get('/ic/elm/claim/edit/detail/{id}',[ClaimController::class,'editelmclaim'])->name('IcElmEditClaim');

//      Route::get('/rejectedclaims/elm',function(){
//         $claims=Claim::where('status',2)->where('cid',Auth::user()->id)->where('deb_mob',null)->get();
//         return view('ic.rejectedelmclaim',compact('claims'));

//     });

    Route::get('/ic/viewclaims',[ClaimController::class,'getclaims'])->name('IcViewClaim');
    Route::get('/ic/claim/detail/{id}',[ClaimController::class,'claimget']);
//     Route::get('/ic/claim/edit/detail/{id}',[ClaimController::class,'editclaim'])->name('IcEditClaim');
//     Route::post('/ic/claim/resubmit',[ClaimController::class,'resubmitclaim'])->name('IcResubmitClaim');
//     //Approved Requests
    Route::get('/ic/claim/approved',function(){
        $claims=Claim::where('status',1)->where('cid',Auth::user()->id)->get();
        return view('ic.claims.approvedclaim',compact('claims'));

    });

//     //Rejected Requests
//     Route::get('/rejectedclaims',function(){
//         $claims=Claim::where('status',2)->where('cid',Auth::user()->id)->get();
//         return view('ic.rejectedclaim',compact('claims'));

//     });
//     //readed message
//     Route::get('readedmessage/{id}',[ClaimController::class,'readedmsg']);
//     //import excel
//     Route::post('/ic/import/inbulk',[ClaimController::class,'importexcel'])->name('ImportExcel');

//     //objections

//     Route::get('view/valid/objection', function(){
//         $objection= DB::table('debtorresponses')->join('claims','debtorresponses.claim_id','=','claims.id')->where('debtorresponses.obj_status',1)->where('debtorresponses.response',1)->where('claims.cid',Auth::user()->id)->get();
//         return view('ic.validobjections',compact('objection'));
//     })->name('IcValidObjecton');

//     Route::get('ic/claim/in-valid/objection/{id}',[DebtorResponseController::class,'icinvalid']);
//     Route::get('ic/claim/valid/objection/{id}',[DebtorResponseController::class,'icvalid']);


//     //invalid objection company submit list
//     Route::get('ic/invalid/objecton',function(){
//         $objection =DB::table('debtorresponses')->join('claims','debtorresponses.claim_id','=','claims.id')->where('debtorresponses.obj_status',4)->where('debtorresponses.response',1)->where('claims.cid',Auth::user()->id)->get();
//         return view('ic.invalidobjections',compact('objection'));
//     })->name('IcInvalidObjecton');

//     //case close by Company list
//     Route::get('ic/case/close/objecton',function(){
//         $objection =DB::table('debtorresponses')->join('claims','debtorresponses.claim_id','=','claims.id')->where('debtorresponses.obj_status',3)->where('debtorresponses.response',1)->where('claims.cid',Auth::user()->id)->get();
//         return view('ic.casecloseobjections',compact('objection'));
//     })->name('IcCaseCloseObjecton');

//     Route::get('ic/addFile',function(){
//          return view('ic.fileerror');
//         //return view('ic.addfile');
//     });
//     Route::post('ic/preclaim',[ClaimController::class,'preClaim']);

    Route::get('ic/viewPreclaim',function(){
         $files=PreClaim::where('company_id',Auth::user()->company_id)->get();

        return view('ic.FileRequest.ViewRequest',compact('files'));
    });

//     Route::get('ic/rejected-Preclaim',function(){
//          $files=PreClaim::where('company_id',Auth::user()->company_id)->where('status',3)->get();

//         return view('ic.preclaimRej',compact('files'));
//     });

//     //ic comments
    Route::post('ic/add-comment',[ClaimController::class,'addComment']);

    Route::get('ic/comment/{id}',function($id){
    $comments=ClaimComment::where('claim_id',$id)->select('comment','status','updated_at','update_by')->get();
    return view('ic.claims.comments',compact('comments'));
    });
//     Route::get('ic/comment',function(){
//     $comments=ClaimComment::where('claim_id',0)->select('comment','status','updated_at','update_by')->get();
//     return view('ic.comments',compact('comments'));
//     });

//     Route::post('ic/additional-document',[AdminController::class,'companyDoc']);

//     //claim summary report
//     Route::get('ic/summary-report/{id}',function($id){
//     $claims= Claim::where('company_id',Auth::user()->company_id)->with('statusee')->select('id','acc_date','rec_amt','created_at','status','claim_no','deb_type')->paginate(10);
//     return view('ic.claimsummary',compact('claims'));
//     });

//     Route::get('ic/setting/{id}',function($id){
//     $user=User::where('id',$id)->first();
//     return view('ic.changepassword',compact('user'));
//     });

//     //see transaction history

//     Route::get('ic/transaction-history',[AdminController::class,'icAllTransaction']);
    Route::get('ic/partial-payment',[AdminController::class,'icPartialDetail']);


// });



// //--------------------------------------------------------------------------------------------------------

// //  Increase Count Link
// Route::get('/bit.ly/{code}',function ($code) {
//     $claim=Claim::where('link',$code)->first();

//     $claim->link_count+=1;
//     $claim->save();
//     return view('ic.smspage',compact('claim'));
// })->name('IncreaseCounterLink');

// //sadad debtor
// Route::post('deb_sadad',[ClaimController::class,'debSadad'])->name('debtorSadad');

// Route::post('debtor/objection',[DebtorResponseController::class,'debtorobj'])->name('debtorresponse');
// //debtor refuse
// // Route::get('debtor/refuse/{id}',[DebtorResponseController::class,'debrefuse']);
// Route::post('debtor/refuse',[DebtorResponseController::class,'debrefuse']);
// //apply for loan
// Route::get('apply/for/loan/{fcom}/{claim}',[DebtorResponseController::class,'loan']);




// //----------------------------------------------------------------------------------------------------------------------

// /////////////////////////////////////////////////////////////////
// //--------------------Law Firm--------------------------------//
// ///////////////////////////////////////////////////////////////

// Route::get('lawfirm/sign-up-form',function(){
//     return view('lawfirm.signup');
// })->name('Lfsignup');
// Route::post('lawfirm/register',[LawFirmController::class,'register'])->name('Lfregister');

// Route::get('lawfirm/sign-in',function(){
//     return view('lawfirm.signin');
// })->name('LfSignin');
// Route::post('lawfirm/signin',[LawFirmController::class,'signIn'])->name('Lflogin');



// Route::group(['middleware'=>'CLF'],function(){

//     Route::get('lawfirm/edit/profile/{id}',function($id){
//         $lawfirm=User::where('id',$id)->first();
//         return view('lawfirm.editprofile',compact('lawfirm'));
//     })->name('FirmEditProfile');
//     Route::post('lawfirm/update/profile',[LawFirmController::class,'editprofile']);

//     Route::get('lawfirm',[LawfirmController::class,'dashboard'])->name('Lfdashboard');

//     //assign case
//     // Route::get('lawfirm/assigned/case',function(){
//     //     $assigned=DB::table('debtorrefuses')->where('lawfirm_id',Auth::user()->id)
//     //     ->where('status',null)
//     //     ->get();

//     //     return view('lawfirm.assignedcase',compact('assigned'));
//     // })->name('lawfirmassignedcase');

//      Route::get('lawfirm/assigned/case',function(){

//         $assigned=DB::table('law_firm_cases')->where('lawfirm_id',Auth::user()->id)
//         ->get();

//         return view('lawfirm.assignedcase',compact('assigned'));
//     })->name('lawfirmassignedcase');



//     Route::get('lawfirm/view/claim/detail/{id}',[LawFirmController::class,'getclaim']);
//     //ask for additional Document
//     Route::get('lawfirm/askadd/document/{id}',function($id){
//         DB::table('debtorrefuses')->where('id',$id)->update(['status'=>2]);
//         return back()->with('success','Successfully Ask Additional Documents');
//     });

//     //Accept the case
//     Route::get('lawfirm/accept/case/{id}',function($id){
//        DB::table('debtorrefuses')->where('id',$id)->update(['status'=>1]);
//        return back()->with('success','Successfully Case Accepted');
//     });

//     //lawfirmacceptcase   law firm accepted case
//     Route::get('lawfirm/accepted/case',function(){
//         $assigned=DB::table('debtorrefuses')->where('lawfirm_id',Auth::user()->id)->where('status',1)->get();
//         return view('lawfirm.acceptedcase',compact('assigned'));
//     })->name('lawfirmacceptcase');

//     //change case progress
//     Route::get('lawfirm/changeprogress/complete/{id}',[LawFirmController::class,'changeprogress1']);
//     Route::get('lawfirm/changeprogress/inprogress/{id}',[LawFirmController::class,'changeprogress2']);

//     //issue verdict
//     Route::post('lawfirm/issue/verdict',[LawFirmController::class,'issueverdict'])->name('issueverdict');

//     //accept case after additional document
//     Route::get('lawfirm/accept/add/case/{id}',function($id){
//         DB::table('debtorrefuses')->where('id',$id)->update(['status'=>1]);
//         return back()->with('success','Case Accepted Successfully');
//     });
//     Route::get('lawfirm/setting/{id}',function($id){
//         $user=User::where('id',$id)->first();
//         return view('lawfirm.changepassword',compact('user'));
//     });
// });

// /////////////////////////////////////////////////////////////
// //-----------------Finance Company------------------------//
// ///////////////////////////////////////////////////////////
Route::get('finance/company/signin',function(){
    return view('financialcom.signin');
})->name('fclogin');
//Register Finance Company
Route::get('finance/comany/signup',function(){
    return view('financialcom.signup');
});
// Route::post('finance/register',[FinanceContoller::class,'register'])->name('fcregister');

// Route::post('finance/login',[FinanceContoller::class,'signIn'])->name('fcsignin');

// Route::group(['middleware'=>'Fc'],function(){


//     Route::get('finance/edit/profile/{id}',function($id){
//         $finance=User::where('id',$id)->first();
//         return view('financialcom.editprofile',compact('finance'));
//     })->name('fEditProfile');

//     Route::post('finance/update/profile',[FinanceContoller::class,'editprofile']);

//     Route::get('financecompany',function(){
//         return view('financialcom.dashboard');
//     })->name('fcdashboard');

    // Route::get('financecompany/logout',function(){
    //     Auth::logout();
    //     session()->put('success','Logout Successfully');
    //     return redirect()->route('AdminSignInForm');
    // })->name('fclogout');

//     Route::get('loan/request',function(){
//         $loan=Loan::where('company_id',Auth::user()->company_id)->where('status',0)->get();

//         return view('financialcom.viewloanreq',compact('loan' ));
//     })->name('NewLoanRequest');
//     //accept loan request
//     Route::get('accept/loan/request/{id}',function($id){
//         Loan::where('id',$id)->update(['status'=>1]);
//         return back()->with('success','Loan Request Accepted Successfully');
//     });
//     //accepted  loan list  request
//     Route::get('loan/accepted',function(){
//        $loan =Loan::where('status',1)->where('company_id',Auth::user()->company_id)->get();
//         return view('financialcom.acceptreq',compact('loan'));
//     })->name('AcceptedLoanRequest');
//     //rejected loan list
//     Route::get('loan/rejected',function(){
//        $loan= Loan::where('status',2)->where('company_id',Auth::user()->company_id)->get();
//        return view('financialcom.rejectedreq',compact('loan'));
//     })->name('RejectedLoanRequest');
//     //reject loan request
//     Route::get('reject/loan/request/{id}',function($id){
//         Loan::where('id',$id)->update(['status'=>2]);
//         return back()->with('success','Loan Request Rejected Successfully');
//     });
//     //finance view claim request
//     Route::get('financecompany/view/detail/{id}',function($id){
//         $claim= Claim::where('id',$id)->first();
//         return view('financialcom.detailclaim',compact('claim'));
//     });

//     Route::get('financecompany/setting/{id}',function($id){
//     $user=User::where('id',$id)->first();
//     return view('financialcom.changepassword',compact('user'));
//     });

// });

// //  Payment
// Route::post('/init-payment',[PaymentController::class,'initPay'])->name('InitPayment');

// Route::get('/response-page',[PaymentController::class,'getPaymentResponse'])->name('PaymentResponsePage');


// //  IVR Routes
// Route::get('/ivr/{to?}',[IvrController::class,'makeCall'])->name('MakeIvrCall');
// Route::get('/call-answer/{to?}',[IvrController::class,'callAnswer'])->name('CallAnswer');
// Route::get('/call-busy/{to?}',[IvrController::class,'callBusy'])->name('CallBusy');
// Route::get('/call-reject/{to?}',[IvrController::class,'callReject'])->name('CallReject');
// Route::get('/press1/{to?}',[IvrController::class,'press1'])->name('Press1');
// Route::get('/press0/{to?}',[IvrController::class,'press0'])->name('Press0');


// // Test Routes
// Route::get('/test',function () {
// //    initiateCall("+923049167411");
//     adminSendMessage("+923094126153","Kl masti kr raha tha uni :)");
// });

// Route::get('/clear', function() {

//    Artisan::call('cache:clear');
//   Artisan::call('config:clear');
//   Artisan::call('config:cache');
//   Artisan::call('view:clear');

//    return "Cleared!";

// });

// Route::get('readAll',function(){
//     Notification::where([
//         ['read',false],
//         ['to',Auth::user()->id]
//         ])->update(['read'=>true]);
//     return response('success');
// });
// Route::get('readAll-admin',function(){
//     Notification::where([
//         ['read',false],
//         ])->update(['read'=>true]);
//     return response('success');
// });

// });
// //Route::get('debtor/call/response',[AdminController::class,'callresponse'])->name('callresponse');

// Route::get('change/password/{id}',function($id){
//     $user=User::where('id',$id)->first();
//     return view('admin.changepassword',compact('user'));
// });
// Route::post('user/change/password',[AdminController::class,'changePassword']);
// Route::get('unifonic/response',[AdminController::class,'unfonic'])->name('callresponse');


// Route::post('applyforloan/{id}',[DebtorResponseController::class,'loan']);

// // Route::get('testelm',function(){
// // $d=ELM();
// // return $d;
// // });

// Route::get('testelm1',[DebtorResponseController::class,'testelm']);

// Route::get('uni-call-status/{id}',[ClaimController::class,'callstatusapi']);

// Route::get('createPaymentLinkAmt',function (){
//   return createPaymentLinkAmt('16','17');
// });

// Route::get('delay-payment-response',[PaymentController::class,'delayPaymentRespone'])->name('PayDelayResponse');
// Route::get('partial-payment-response',[PaymentController::class,'partialPaymentResponse'])->name('PartialPayResponse');

// Route::get('payment-success',function(){
//     $pay=['null','null','null','2022-12-08 10:40:34'];
//     return view('payment',compact('pay'));
// });
// Route::get('payment-error',function(){
//     $errorCode=64;
//     //$pay=['null','null','null','2022-12-08 10:40:34'];
//     return view('pay_error',compact('errorCode'));
// });

// Route::get('exportclaims',[ClaimController::class,'export']);




// Route::any('search-claim',[ClaimController::class,'search']);

// //admin create payment link
// Route::get('/admin-payment-link-respone',[PaymentController::class,'adminPayResponse'])->name('AdminPayLink');
// //end admin create payment link



// Route::view('/','arabic');
// Route::view('contact-us','contact');

// Route::get('iqama',function(){
//     $id="e79846d2-7df1-4ea6-b107-d2ea1a42ab40";
//    return iqamaSMS($id);
// });

// Route::post('common-contact-us',[AdminController::class,'contactus']);
// Route::get('admin/queries',[AdminController::class,'getQuery']);

// Route::get('admin/partial-pay',function(){
//     $claims=ClaimStatus::join('claims','claim_status.claim_id','=','claims.id')->where('claim_status.status',4)

//     ->paginate(10);

//    // $claims=Claim::where('status',0)->paginate(10);
//     return view('admin.reg_claims',compact('claims'));
// });

// // Route::get('red',function(){
// //   redistribution();
// // });
// Route::get('testcall',function(){
//    $response=json_decode (callufone('+923310400668'));
//    return $response->callId;
// });
// Route::view('urlinks','urwaycode');


// Route::get('admin/collected-claims',function(){

//      $directpay=payment::where('payment.response_code',000)->select('claim_id','amount')->get();
//     $colected=CollectedClaim::select('claim_id','payment')->get();
//    // dd($directpay,$colected);
//     return view('admin.rec_collection',compact('directpay','colected'));


// });
// Route::get('checking',function(){
//    dd(env('URWAYS_PASSWORD')) ;
// });


// Route::get('createlink',function(){
//     $claimid=1;

// });


// Route::get('claimdata',function(){
//     $year=2022;
//     $month=1;
//    $accepted=array();
//    $returned=array();
//    $review=array();
//     for($i=1;$i<=12;$i++){
//         $accepted[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)->where('status',1)
//         ->count();

//         $returned[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)->where('status',2)
//         ->count();

//         $review[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)->where('status',0)
//         ->count();

//         $total[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)
//         ->count();

//     }

//    $post=[$accepted,$returned,$review,$total];

//     return response()->json($post,200);
// });
// Route::get('filedata',function(){
//     $year=2022;
//     $month=1;
//    $accepted=array();
//    $returned=array();
//    $review=array();
//     for($i=1;$i<=12;$i++){
//         $accepted[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)->where('status',2)
//         ->count();

//         $returned[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)->where('status',3)
//         ->count();

//         $review[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)->where('status',1)
//         ->count();

//         $total[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)
//         ->count();

//     }

//    $post=[$accepted,$returned,$review,$total];

//     return response()->json($post,200);
// });
// Route::get('preclaim-year/{id}',function($id){
//     $year=$id;
//   //  dd($year);
//     $month=1;
//    $accepted=array();
//    $returned=array();
//    $review=array();
//     for($i=1;$i<=12;$i++){
//         $accepted[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)->where('status',2)
//         ->count();

//         $returned[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)->where('status',3)
//         ->count();

//         $review[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)->where('status',1)
//         ->count();

//         $total[$i] = PreClaim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)
//         ->count();

//     }

//    $post=[$accepted,$returned,$review,$total];

//     return response()->json($post,200);
// });


// Route::get('claimdata-year/{id}',function($id){
//     $year=$id;
//     $month=1;
//    $accepted=array();
//    $returned=array();
//    $review=array();
//     for($i=1;$i<=12;$i++){
//         $accepted[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)->where('status',1)
//         ->count();

//         $returned[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)->where('status',2)
//         ->count();

//         $review[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)->where('status',0)
//         ->count();
//          $total[$i] = Claim::select('created_at')->whereYear('created_at', '=', $year)
//         ->whereMonth('created_at', '=', $i)
//         ->count();

//     }

//    $post=[$accepted,$returned,$review,$total];

//     return response()->json($post,200);
// });


// ///year revenue graph
// Route::get('admin/collected-amount',function(){
//     $year=2021;
//     $sum=array();
//     for($i=1;$i<=7;$i++){

//         $directpay=payment::where('response_code',000)->whereYear('created_at', '=', $year)->sum('amount');
//         $colected=Claim::join('claim_collected','claim_collected.claim_id','=','claims.id')
//         ->whereYear('claims.created_at', '=', $year)->sum('claims.rec_amt');
//         $sum[$i]=$directpay+$colected;
//         $year=$year+$i;
//     }

//     return response()->json($sum,200);
// });


// Route::get('collectedClaiminfo',[AdminController::class,'collectedClaimInfo']);


// //////////////////////////////////TEST//////////////////////////////////
// /////////////////////////////////URL/////////////////////////////////////
// Route::get('elm-no',function(){
//     $claim=Claim::where('deb_mob',null)->get();

//     $elmid=array();
//     foreach($claim as $c){
//         $elm=ElmStatus::where('claim_id',$c->id)->first();
//         if($elm){

//         }else{
//             array_push($elmid,$c->id);
//         }
//     }
//     dd($elmid);
// });


// Route::get('admin/sadad-link/{id}',function($id){
//    return additionalsadadLink($id);
// });

// Route::get('testclaim',function(){
//      $response = Http::get('https://recovery.taheiya.sa/api/getclaims');
//       $claims = json_decode($response->getBody(), true);

//       return view('admin.view_claims',compact('claims'));
//      //dd($team);
// });


// Route::get('/ic/viewclaims/beta',[ClaimController::class,'getclaims'])->name('IcViewClaim');
// Route::any('ic/search-claim',[ClaimController::class,'icSearch']);

// Route::get('icexport',[ClaimController::class,'icexporte']);

// ///debtor upload additional doc
// Route::post('debtor/upoad-file',[ClaimController::class,'debUpload']);
// //sadad payment response
// Route::get('sadad-response',[PaymentController::class,'sadadRes'])->name('sadadResponse');


// Route::get('testingsadad',function(){
//    return partialsadadLink(907,50);
//   // return sadadLink(907);
// });

// Route::get('time',function(){
//     $t=time();
//    dd(date('h:m:s',$t));
// });
// // Route::get('send-message',function(){
// //     $reciever='+966546593305';
// //     $amount=10821;
// //     $claimid=369;
// //     $link='https://payments.urway-tech.com/URWAYPGService/direct.jsp?paymentid=2305413961715914526';

// //      $message='عزيزي العميل نرجو التكرم بسداد المبلغ '.$amount.' الرجاء الضغط على الرابط التالي ليتم السداد من خلال احدى قنوات الدفع الرسمية المعتمدة لديكم '.$link.' ، تذكر دائماً أن تهيئة لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال';
// //       $reciever=substr($reciever,1);

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


// Route::get('custom-msgat',function(){
//     $reciever="966503774417";
//     $message="https://payments.urway-tech.com/URWAYPGService/direct.jsp?paymentid=2308713124682520860";
//     $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
//                     "userName"=> "Taheiya",
//                     "numbers"=> $reciever,
//                     "userSender"=> "Taheiya",
//                     "apiKey"=> env('MSEGAT_API_KEY'),
//                     "msg"=> "New payment link of 10000 SAR".$message
//                 ]);
//                 $data = json_decode($response->getBody(), true);
//                   //dd($data);
//                     if($data['code']==1){
//                         $smsres=new SmsResponse;
//                         $smsres->claim_id=1417;
//                         $smsres->code=$data['code'];
//                         $smsres->phone_no=$reciever;
//                         $smsres->message=$data['message'];
//                         $smsres->sms=$message;
//                         $smsres->save();
//                         return "done";
//                     }else{
//                         Alert::warning('error','Sms not sent');
//                          return "error";
//                     }
// });
// Route::get('downloadgig',[ClaimController::class,'gigexport']);


// Route::get('admin/partial-payment',[AdminController::class,'partialDetail']);


// Route::post('login-otp',[AdminController::class,'verifyOtp'])->name('otpLogin');
// Route::post('apply-security',[AdminController::class,'twofactor']);





// Route::get('test/sadad/partial',function(){

//    return partialsadadLink(1859,100);

// });

// /// admin custom partil madad linl
// Route::get('admin-custome-partial-mada',[PaymentController::class,'adminCustomPartialMada'])->name('PartialCustomerPayLink');
// ///end admin custom
