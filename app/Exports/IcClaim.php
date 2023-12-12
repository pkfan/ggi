<?php

namespace App\Exports;

use App\Models\Claim;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Auth;
class IcClaim implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('ic.exportclaim',[
            'claims' =>Claim::where('company_id',Auth::user()->company_id)->get()
        ]);
    }
}
