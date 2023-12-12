<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollectorController;


Route::prefix('/collector')->middleware(['preventBackHistory', 'auth', 'role:collector'])->group(function(){

    Route::get('/dashboard',[CollectorController::class,'index'])->name('collector.dashboard');
    Route::get('/claims',[CollectorController::class,'collectorClaims'])->name('collector.claims');
    Route::get('/claim/detail/{id}',[CollectorController::class,'claimDetail'])->name('collector.claim-details');

});