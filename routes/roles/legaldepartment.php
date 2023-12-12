<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LegalDepartment;
use App\Http\Controllers\Admin\ClaimController;


Route::prefix('legal-department')->middleware(['auth','role:legal-department'])->group(function(){
    Route::get('/dashboard',[LegalDepartment::class,'index'])->name('legal-department.dashboard');


    // Admin routes copy and put here
    Route::get('/claims',[LegalDepartment::class,'legalDepartmentClaims'])
    ->name('legaldepartment.claims');

    Route::get('/claim/detail/{id}', [LegalDepartment::class, 'claimDetail'])
    ->name('legaldepartment.claim-detail');

    // approve that documents are compelete or not

    Route::get('/claim/docs-compelete/{id}',[LegalDepartment::class,'approveDocsCompelete'])
    ->name('legaldepartment.docs-compelete');

    Route::post('/additional-detail',[LegalDepartment::class,'additionalDetail'])
    ->name('legaldepartment.additional-detail');

    Route::get('/claim/court-verdict-issue/{id}/{status}',[LegalDepartment::class,'courtVerdictIssued'])
    ->name('legaldepartment.court-verdict-issued');
});