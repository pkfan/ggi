<?php
use App\Models\Claim;
use App\Http\Controllers\ArtController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GraphContoller;
/*
https://laracasts.com/discuss/channels/laravel/no-routes-defined-after-cache?page=1&replyId=541455
@mkulik a few tips,
you can't use closure based routes with route caching. be sure to check for that.
anytime you define a new route, be sure to run php artisan route:clear to clear your routes cache and recache them.
*/
$rolePath = __DIR__ . DIRECTORY_SEPARATOR  . 'roles' . DIRECTORY_SEPARATOR;
require_once($rolePath  . 'collector.php');
require_once($rolePath . 'super-admin.php');
require_once($rolePath . 'admin.php');
require_once($rolePath . 'officer.php');
require_once($rolePath . 'supervisor.php');
require_once($rolePath . 'legaldepartment.php');
require_once(__DIR__ . DIRECTORY_SEPARATOR  . 'ic.php');
require_once(__DIR__ . DIRECTORY_SEPARATOR  . 'permissions.php');
///////////////////////////////////////////////////
////////// other common routes for all ///////////
//////////////////////////////////////////////////
// language translate
Route::get('/language/translate/{languageCode}', [ArtController::class, 'translateLanguage'])
    ->name('language.translate');
// Sign In
Route::post('admin/signin', [AuthController::class, 'signIn'])
    ->name('AdminSignIn')
    ->middleware(['throttle:5,1']);
Route::middleware(['preventBackHistory'])
    ->group(function () {
        //  Sign-In Form
        Route::get('/', [AuthController::class, 'signInForm'])
            ->name('AdminSignInForm')
            ->middleware(['throttle:5,1']);
        //forget password
        Route::get('forget/password', [AuthController::class, 'forgetPassword'])
            ->name('forget.password')
            ->middleware(['throttle:5,1']);
        Route::post('reset-password', [AuthController::class, 'resetPassword'])
            ->name('reset-password')
            ->middleware(['throttle:5,1']);
        // Logout
        Route::match(['get', 'post'], '/logout', [AuthController::class, 'logoutAdmin'])
            ->name('AdminLogout');
    });
Route::get('/bit.ly/{code}', function ($code) {
    $claim = Claim::with('claimData', 'officer')->where('link', $code)->first();
    // return $claim;
    $claim->link_count += 1;
    $claim->save();
    return view('smspage', compact('claim'));
})->name('IncreaseCounterLink');
Route::middleware(['auth'])
    ->group(function () {
        Route::get('/additional/docs/{doc_id}/delete', [ArtController::class, 'deleteAdditionalDocs'])
            ->name('additional.docs.delete');
        Route::get('/supportive/docs/{doc_id}/delete', [ArtController::class, 'deleteSupportiveDocs'])
            ->name('supportive.docs.delete');
    });
Route::get('admin/collectClaim/{year}',[GraphContoller::class,'collectedClaim']);
Route::get('admin/collectClaim/{year}/{id}',[GraphContoller::class,'collectedClaimUser']); 


