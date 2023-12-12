<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Claim;

class CollectorController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function collectorClaims()
    {
        $claim = DB::table('claims')
            ->select(
                'claims.id',
                'claims.cid',
                'claims.amount_after_discount',
                'claims.deb_name',
                'claims.claim_no',
                'claims.deb_mob',
                'claims.type',
                'claims.rec_amt',
                'claims.acc_date',
                'claims.created_at',
                'claims.acc_location',
                'claims.deb_type',
                'claims.deb_iqama',
                'claims.status',
                'claims.is_assign',
                'claim_status.status'
            )
            ->join('claim_status', 'claim_status.claim_id', '=', 'claims.id')
            ->join('collection_office', 'collection_office.claim_id', '=', 'claims.id')
            ->where('claim_status.status', 21)
            ->where('collector_id', Auth::user()->id)
            ->get();
        return view('collector.claims', compact('claim'));
    }

    public function claimDetail($id)
    {
        $claim = Claim::find($id);
        return view('collector.view_claim_detail', compact('claim'));
    }
}
