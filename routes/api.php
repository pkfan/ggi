<?php

use Carbon\Carbon;
use App\Models\Claim;
use App\Models\payment;
use App\Models\PayDelay;
use App\Models\PartialPay;
use App\Models\ClaimRemark;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\PartialManual;
use App\Models\SadadResponse;
use App\Models\CustomPartialMada;
use App\Models\CustomPartialSadad;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtController;
use App\Http\Controllers\Officer\OfficerController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('getclaims', function () {
    $claims = Claim::select('id', 'company_id', 'cid', 'claim_no', 'deb_mob', 'deb_name', 'type', 'rec_amt', 'acc_date', 'created_at', 'status', 'deb_type', 'acc_location', 'deb_name', 'deb_iqama', 'is_assign')->get();
    return response()->json($claims, 200);
    // return view('admin.reg_claims',compact('claims'));
});
Route::get('partial-pay-event', function () {


    // Get the current date and time
    $currentDate = Carbon::now();

    // Subtract 7 days from the current date
    $startDate = $currentDate->subDays(7);


    $paid = [];
    $expiredUnpaid = [];



    $expPartial1 = PartialPay::where('pay_id', '<>', null)->select('id', 'claim_id', 'amount', 'date_time', 'pay_id', 'link')->where('type', null)
        ->where('date_time', '<=', $startDate)->get();
    //dd($expPartial1);


    $expPartial2 = PartialPay::where('link', '<>', null)->select('id', 'claim_id', 'amount', 'date_time', 'pay_id', 'link')->where('type', 'sadad')
        ->where('date_time', '<=', $startDate)->get();

    for ($i = 0; $i < $expPartial1->count(); $i++) {
        //dd($expPartial1[$expPartial1->count() - 1]->date_time);
        $check = payment::where('response_code', 000)->where('payment_id', $expPartial1[$i]->pay_id)->count();

        if ($check == 0) {
            array_push($expiredUnpaid, $expPartial1[$i]);
        } else {
            array_push($paid, $expPartial1[$i]);
        }
    }

    for ($i = 0; $i < $expPartial2->count(); $i++) {
        //dd($expPartial2[$i]);
        $check = SadadResponse::where('sadadNumber', $expPartial2[$i]->link)->count();

        if ($check == 0) {
            array_push($expiredUnpaid, $expPartial2[$i]);
        } else {
            array_push($paid, $expPartial2[$i]);
        }
    }

    // $partialUnpaid = array_merge($expiredUnpaidsadad+$expiredUnpaid);
    //dd($expiredUnpaid[140],$expiredUnpaid[139],$expiredUnpaid[141],$expiredUnpaid[129]);
    $partial1 = PartialPay::where('status', 1)->select('id', 'claim_id', 'amount', 'date_time')->where('type', null)->get();
    $sadad = PartialPay::where('status', 1)->select('id', 'claim_id', 'amount', 'date_time')->where('type', 'sadad')->get();
    $partial = $partial1->concat($sadad);

    $delay = PayDelay::where('status', 1)->select('id', 'claim_id', 'date_time')->get();

    $madarec = [];
    $sadadrec = [];
    $sendPartial = [];
    $sendPartial1 = PartialPay::where('status', 2)->select('id', 'claim_id', 'amount', 'date_time', 'link', 'pay_id')->where('type', null)->get();
    $sendSadad = PartialPay::where('status', 2)->select('id', 'claim_id', 'amount', 'date_time', 'link', 'pay_id')->where('type', 'sadad')->get();

    for ($i = 0; $i < $sendPartial1->count(); $i++) {
        //dd($expPartial1[$expPartial1->count() - 1]->date_time);
        $check = payment::where('response_code', 000)->where('payment_id', $sendPartial1[$i]->pay_id)->count();

        if ($check == 0) {
            array_push($sendPartial, $sendPartial1[$i]);
        } else {
            array_push($madarec, $sendPartial1[$i]);
        }
    }


    for ($i = 0; $i < $sendSadad->count(); $i++) {
        //dd($expPartial2[$i]);
        $check = SadadResponse::where('sadadNumber', $sendSadad[$i]->link)->count();

        if ($check == 0) {
            array_push($sendPartial, $sendSadad[$i]);
        } else {
            array_push($sadadrec, $sendSadad[$i]);
        }
    }





    // $sendPartial = $sendPartial1->concat($sendSadad);

    $senddelay = PayDelay::where('status', 2)->get();
    //  $madarec = payment::where('response_code',000)->select('id','amount','created_at','claim_id')->get();
    //  $sadadrec = SadadResponse::where('result','Success')->select('id','amount','created_at','claimid')->get();
    $data = [
        'partial' => $partial,
        'delay' => $delay,
        'sendPartial' => $sendPartial,
        'senddelay' => $senddelay,
        'madarec' => $madarec,
        'sadadrec' => $sadadrec,
        'expiredUnpaid' => $expiredUnpaid
    ];


    // return response()->json($data,200);
    //////// array transform according to new fullcalandar.js ////////
    $finalEventData = [];
    // {
    //     id: 1,
    //     url: 'https://www.recovery.taheiya.sa/admin-calendar',
    //     title: 'Design Review',
    //     start: date,
    //     end: nextDay,
    //     allDay: false,
    //     extendedProps: {
    //       calendar: 'Business'
    //     }
    //   },

    // partial

    foreach ($data as $eventCategoryKey => $eventCategoryValue) {
        foreach ($eventCategoryValue as  $value) {

            $transformValue = [
                'id' => $value->id,
                'url' => $value->link ? $value->link : '#',
                // 'url'=>'admin/claim/detail/'. $value->claim_id,
                'title' => "claim id {$value->claim_id}",
                'start' => $value->date_time,
                'end' => $value->date_time,
                'allDay' => true,
                'extendedProps' => [
                    // 'calendar'=> 'Partial'
                    'calendar' => $eventCategoryKey
                ]
            ];

            array_push($finalEventData, $transformValue);
        }
    }

    return $finalEventData;
});


Route::get('admin/partial-pay-event', function (Request $request) {

    $adminid = $request->id;
    $urlRole = $request->role;

    // Get the current date and time
    $currentDate = Carbon::now();

    // Subtract 7 days from the current date
    $startDate = $currentDate->subDays(6);


    $paid = [];
    $expiredUnpaid = [];

    $madarec = [];
    $sadadrec = [];

    $partialManualpaid = [];


    $expPartial1 = PartialPay::join('claims', 'claims.id', '=', 'partial_pay.claim_id')
        ->when($adminid, function ($query, $adminid) {
            $query->where('claims.is_assign', $adminid);
        })
        ->where('partial_pay.pay_id', '<>', null)
        ->select('partial_pay.id', 'partial_pay.claim_id', 'partial_pay.amount', 'partial_pay.date_time', 'partial_pay.pay_id', 'partial_pay.link')
        ->where('partial_pay.type', null)
        ->where('partial_pay.date_time', '<=', $startDate)
        ->get();
    //dd($expPartial1);


    $expPartial2 = PartialPay::join('claims', 'claims.id', '=', 'partial_pay.claim_id')
        ->when($adminid, function ($query, $adminid) {
            $query->where('claims.is_assign', $adminid);
        })
        ->where('partial_pay.link', '<>', null)
        ->select('partial_pay.id', 'partial_pay.claim_id', 'partial_pay.amount', 'partial_pay.date_time', 'partial_pay.pay_id', 'partial_pay.link')
        ->where('partial_pay.type', 'sadad')
        ->where('partial_pay.date_time', '<=', $startDate)
        ->get();

    for ($i = 0; $i < $expPartial1->count(); $i++) {
        //dd($expPartial1[$expPartial1->count() - 1]->date_time);
        $check = payment::where('response_code', 000)->where('payment_id', $expPartial1[$i]->pay_id)->count();
        $partialmanual = PartialManual::where('partial_id', $expPartial1[$i]->id)->count();

        if ($check == 0 && $partialmanual == 1) {
            //array_push($expiredUnpaid,$expPartial1[$i]);$partialManualpaid=[]
            array_push($partialManualpaid, $expPartial1[$i]);
        } else if ($check == 0 && $partialmanual == 0) {
            array_push($expiredUnpaid, $expPartial1[$i]);
        } else {
            array_push($madarec, $expPartial1[$i]);
        }
    }

    for ($i = 0; $i < $expPartial2->count(); $i++) {
        //dd($expPartial2[$i]);
        $check = SadadResponse::where('sadadNumber', $expPartial2[$i]->link)->count();
        $partialmanual2 = PartialManual::where('partial_id', $expPartial2[$i]->id)->count();
        if ($partialmanual2 == 1) {
            array_push($partialManualpaid, $expPartial2[$i]);
        } else if ($check == 0) {
            array_push($expiredUnpaid, $expPartial2[$i]);
        } else {
            array_push($sadadrec, $expPartial2[$i]);
        }
    }

    // $partialUnpaid = array_merge($expiredUnpaidsadad+$expiredUnpaid);
    //dd($expiredUnpaid[140],$expiredUnpaid[139],$expiredUnpaid[141],$expiredUnpaid[129]);
    $partial1 = PartialPay::join('claims', 'claims.id', '=', 'partial_pay.claim_id')
        ->when($adminid, function ($query, $adminid) {
            $query->where('claims.is_assign', $adminid);
        })
        ->where('partial_pay.status', 1)
        ->select('partial_pay.id', 'partial_pay.claim_id', 'partial_pay.amount', 'partial_pay.date_time')
        ->where('partial_pay.type', null)
        ->get();

    $sadad = PartialPay::join('claims', 'claims.id', '=', 'partial_pay.claim_id')
        ->when($adminid, function ($query, $adminid) {
            $query->where('claims.is_assign', $adminid);
        })
        ->where('partial_pay.status', 1)
        ->select('partial_pay.id', 'partial_pay.claim_id', 'partial_pay.amount', 'partial_pay.date_time')
        ->where('partial_pay.type', 'sadad')
        ->get();

    $partial = $partial1->concat($sadad);

    $delay = PayDelay::join('claims', 'claims.id', '=', 'pay_delay.claim_id')
        ->when($adminid, function ($query, $adminid) {
            $query->where('claims.is_assign', $adminid);
        })
        ->where('pay_delay.status', 1)
        ->select('pay_delay.id', 'pay_delay.claim_id', 'pay_delay.date_time')
        ->get();

    // $madarec=[];
    // $sadadrec=[];
    $sendPartial = [];
    $sendPartial1 = PartialPay::join('claims', 'claims.id', '=', 'partial_pay.claim_id')
        ->when($adminid, function ($query, $adminid) {
            $query->where('claims.is_assign', $adminid);
        })
        ->where('partial_pay.status', 2)
        ->select('partial_pay.id', 'partial_pay.claim_id', 'partial_pay.amount', 'partial_pay.date_time', 'partial_pay.link', 'partial_pay.pay_id')
        ->where('partial_pay.type', null)
        ->where('partial_pay.date_time', '>=', $startDate)
        ->get();

    $sendSadad = PartialPay::join('claims', 'claims.id', '=', 'partial_pay.claim_id')
        ->when($adminid, function ($query, $adminid) {
            $query->where('claims.is_assign', $adminid);
        })
        ->where('partial_pay.status', 2)
        ->select('partial_pay.id', 'partial_pay.claim_id', 'partial_pay.amount', 'partial_pay.date_time', 'partial_pay.link', 'partial_pay.pay_id')
        ->where('partial_pay.type', 'sadad')
        ->where('partial_pay.date_time', '>=', $startDate)
        ->get();

    ///custom mada
    $customMada = CustomPartialMada::join('claims', 'claims.id', '=', 'custome_partial_mada.claim_id')
        ->when($adminid, function ($query, $adminid) {
            $query->where('claims.is_assign', $adminid);
        })
        ->where('custome_partial_mada.status', 2)
        ->select('custome_partial_mada.id', 'custome_partial_mada.claim_id', 'custome_partial_mada.amount', 'custome_partial_mada.created_at', 'custome_partial_mada.payment_id')
        ->get();
    for ($i = 0; $i < $customMada->count(); $i++) {
        //dd($expPartial1[$expPartial1->count() - 1]->date_time);
        $check = payment::where('response_code', 000)->where('payment_id', $customMada[$i]->payment_id)->count();

        if ($check == 0) {
            // array_push($sendPartial,$sendPartial1[$i]);
        } else {
            array_push($madarec, $customMada[$i]);
            //  dd($madarec);
        }
    }
    ///custom sada
    $customSada = CustomPartialSadad::join('claims', 'claims.id', '=', 'custome_partial_sadad.claim_id')
        ->when($adminid, function ($query, $adminid) {
            $query->where('claims.is_assign', $adminid);
        })
        ->select('custome_partial_sadad.id', 'custome_partial_sadad.claim_id', 'custome_partial_sadad.amount', 'custome_partial_sadad.created_at', 'custome_partial_sadad.sadadNumber')
        ->get();

    for ($i = 0; $i < $customSada->count(); $i++) {
        //dd($expPartial1[$expPartial1->count() - 1]->date_time);
        $checksada = SadadResponse::where('sadadNumber', $customSada[$i]->sadadNumber)->where('responseCode', '000')->count();

        if ($checksada == 0) {
        } else {
            array_push($sadadrec, $customSada[$i]);
        }
    }



    for ($i = 0; $i < $sendPartial1->count(); $i++) {
        //dd($expPartial1[$expPartial1->count() - 1]->date_time);
        $check = payment::where('response_code', 000)->where('payment_id', $sendPartial1[$i]->pay_id)->count();

        if ($check == 0) {
            array_push($sendPartial, $sendPartial1[$i]);
        } else {
            array_push($madarec, $sendPartial1[$i]);
        }
    }


    for ($i = 0; $i < $sendSadad->count(); $i++) {
        //dd($expPartial2[$i]);
        $check = SadadResponse::where('sadadNumber', $sendSadad[$i]->link)->where('result', 'Success')->count();

        if ($check == 0) {
            array_push($sendPartial, $sendSadad[$i]);
        } else {
            array_push($sadadrec, $sendSadad[$i]);
        }
    }



    $approveDate = DB::table('table_approve_log')->join('claims', 'claims.id', '=', 'table_approve_log.claim_id')
        ->when($adminid, function ($query, $adminid) {
            $query->where('claims.is_assign', $adminid);
        })
        ->select('table_approve_log.id', 'table_approve_log.claim_id', 'table_approve_log.created_at as date_time')
        ->get()
        ->map(function ($row) use($urlRole){

            $row->link = "/{$urlRole}/claim/detail/{$row->claim_id}";

            return $row;
        });

    // $sendPartial = $sendPartial1->concat($sendSadad);

    $senddelay = PayDelay::join('claims', 'claims.id', '=', 'pay_delay.claim_id')
        ->when($adminid, function ($query, $adminid) {
            $query->where('claims.is_assign', $adminid);
        })
        ->where('pay_delay.status', 2)
        ->get();
    $reminder = ClaimRemark::join('claims', 'claims.id', '=', 'claim_remarks.claim_id')
        ->when($adminid, function ($query, $adminid) {
            $query->where('claims.is_assign', $adminid);
        })
        ->where('claim_remarks.remainder', '<>', null)
        ->select('claim_remarks.id', 'claim_remarks.claim_id', 'claim_remarks.remainder as date_time', 'claim_remarks.remark', 'claim_remarks.event')
        ->get()
        ->map(function ($row) use($urlRole){

            $row->link = "/{$urlRole}/claim/detail/{$row->claim_id}";

            return $row;
        });
    //  $madarec = payment::where('response_code',000)->select('id','amount','created_at','claim_id')->get();
    //  $sadadrec = SadadResponse::where('result','Success')->select('id','amount','created_at','claimid')->get();
    // $data = [$partial, $delay, $sendPartial, $senddelay, $madarec, $sadadrec, $expiredUnpaid, $approveDate, $reminder, $partialManualpaid];


    // return response()->json($data, 200);

    $data = [
        'partial' => $partial,
        'delay' => $delay,
        'sendPartial' => $sendPartial,
        'senddelay' => $senddelay,
        'madarec' => $madarec,
        'sadadrec' => $sadadrec,
        'expiredUnpaid' => $expiredUnpaid,
        'approveDate' => $approveDate,
        'reminder' => $reminder,
        'partialManualpaid' => $partialManualpaid,
    ];


    // dd($data);
    // return response()->json($data,200);
    //////// array transform according to new fullcalandar.js ////////
    $finalEventData = [];
    // {
    //     id: 1,
    //     url: 'https://www.recovery.taheiya.sa/admin-calendar',
    //     title: 'Design Review',
    //     start: date,
    //     end: nextDay,
    //     allDay: false,
    //     extendedProps: {
    //       calendar: 'Business'
    //     }
    //   },

    // partial

    foreach ($data as $eventCategoryKey => $eventCategoryValue) {
        foreach ($eventCategoryValue as  $value) {

            // if(!$value) {
            //     dd('found error off null');
            // }
            // return $value;
            $transformValue = [
                'id' => @$value?->id,
                'url' => @$value->link ?? '#',
                // 'url'=>'admin/claim/detail/'. $value->claim_id,
                'title' => "claim id {$value->claim_id}",
                'start' => @$value->date_time,
                'end' => @$value->date_time,
                'allDay' => true,
                'extendedProps' => [
                    // 'calendar'=> 'Partial'
                    'calendar' => $eventCategoryKey
                ]
            ];

            array_push($finalEventData, $transformValue);
        }
    }

    return $finalEventData;
});


Route::get('/admin/officer/targets', [ArtController::class, 'officerTargetsApi'])
    ->name('admin.officer.targets.api');

Route::get('/officer/targets', [OfficerController::class, 'officerTargetsApi'])
    ->name('officer.targets.api');


Route::get('/mark-notification-as-read/{notification_id}', function ($notification_id) {
    Notification::where('id', $notification_id)->update(['read' => true]);

    return response()->json(['data' => ['success' => 'notification read successfully']]);
})->name('officer.targets.api');
