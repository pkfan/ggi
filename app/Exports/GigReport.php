<?php

namespace App\Exports;
use App\Models\Claim;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Auth;
class GigReport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        if(Auth::user()->roll == 0){
            return view('admin.exportgigreport',[
            'claims' => Claim::with('statusee')->select('id','rec_amt','acc_date','created_at','status','claim_no','deb_type')->get()
            ]);
        }else if(Auth::user()->roll == 1){
             return view('admin.exportgigreport',[
            'claims' => Claim::with('statusee')->where('company_id',Auth::user()->company_id)->select('id','rec_amt','created_at','acc_date','status','claim_no','deb_type')->get()
            ]);
        }
        
    }
}
