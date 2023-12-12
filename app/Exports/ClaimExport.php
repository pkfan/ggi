<?php

namespace App\Exports;

use App\Models\Claim;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClaimExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('admin.exportclaim',[
            'claims' => Claim::select('id','company_id','cid','claim_no','deb_mob','deb_name','deb_iqama','type','rec_amt','acc_date','created_at','status','deb_type','acc_location','is_assign')->get()
        ]);
    }
}
