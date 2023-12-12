<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Claim;
use App\Models\Reason;
use App\Models\Supported_Doc;
use Illuminate\Http\Request;
use App\Models\Message;
use Excel;
use File;
use DB;
use App\imports\ClaimsImport;
use App\Models\PreClaim;
use App\Models\Notification;
use App\Models\ClaimComment;
use App\Exports\ClaimsExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\HeadingRowImport;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Exports\ClaimExport;
use App\Exports\IcClaim;
use Alert;
use App\Models\DebDoc;
use App\Models\SadadPay;
use App\Models\SmsResponse;
use App\Models\DebtorResponse;
use Carbon\Carbon;
use DateTime;
use App\Exports\GigReport;

class ClaimController extends Controller
{
    public function claimform(){
        $debtor=User::where('roll',2)->get();
        $reason=Reason::all();
        return view('ic.addclaim',compact('debtor','reason'));
    }
   
    public function addclaim(Request $req){
        
       

        if($req->claim_type == 'no'){

            $req->validate([
                'deb_iqama'=>'required',
                'deb_mob'=>'required',
            ]);

            $claim = new Claim;
            $claim->cid=Auth::user()->id;
            $claim->claim_type=$req->claim_type;
            $claim->company_id=Auth::user()->company_id;
            $claim->type=$req->type;
            $claim->libpercent=$req->libpercent;
            $claim->amount_after_discount=$req->amount_after_discount;
            $claim->deb_iqama=$req->deb_iqama;
            $claim->acc_date=$req->acc_date;
            $claim->acc_location=$req->acc_location;
            $claim->deb_name=$req->deb_name;
            $claim->ic_mail=$req->icemail;
            $claim->deb_age=$req->deb_age;
            $claim->claim_no=$req->claim_no;
            $claim->deb_mob='+966'.$req->deb_mob;
            if($req->deb_type=='insured'){
                $claim->deb_type='insured';
                $claim->rec_reason=$req->rec_reason;
            }
            else{
                $claim->deb_type='third_party';
                $claim->rec_reason="";
            }
    
    
            $claim->save();
            
             $admin=User::where('roll',0)->first();
            Notification::create([
                'from'=> Auth::user()->id,
                'to'=> $admin->id,
                'message'=>'New Claim Added',
                'type'=>'claim added',
                'read'=>false,
            ]);
    
            if($req->hasfile('support_doc')) {
    
                foreach($req->file('support_doc') as $file){
                $doc = new Supported_Doc;
                $doc->company_id=$claim->cid;
                $ran=rand(3,9999);
                $name=time().$ran.'.'.$file->getClientOriginalExtension();
                $filepath='claims/'.$claim->id.'/company/'.$claim->cid.'/Supported_document/';
                $file->move(storage_path().'/app/public/'.$filepath,$name);
                $doc->doc_name = $filepath.$name;
                $doc->claim_id=$claim->id;
                $doc->save();
                }
            }
        }else{

            $claim = new Claim;
            $claim->cid=Auth::user()->id;
            $claim->company_id=Auth::user()->company_id;
            $claim->type=$req->type;
            $claim->claim_type=$req->claim_type;
            $claim->libpercent=$req->libpercent;
            $claim->amount_after_discount=$req->amount_after_discount;
            $claim->acc_date=$req->acc_date;
            $claim->acc_location=$req->acc_location;
            $claim->deb_name=$req->deb_name;
            $claim->ic_mail=$req->icemail;
            $claim->deb_age=$req->deb_age;
            $claim->claim_no=$req->claim_no;
            $claim->deb_mob='+966'.$req->deb_mob;
            if($req->deb_type=='insured'){
                $claim->deb_type='insured';
                $claim->rec_reason=$req->rec_reason;
            }
            else{
                $claim->deb_type='third_party';
                $claim->rec_reason="";
            }
            $claim->save();
            
             $admin=User::where('roll',0)->first();
            Notification::create([
                'from'=> Auth::user()->id,
                'to'=> $admin->id,
                'message'=>'New Claim Added',
                'type'=>'claim added',
                'read'=>false,
            ]);
    
            if($req->hasfile('support_doc')) {
    
                foreach($req->file('support_doc') as $file){
                $doc = new Supported_Doc;
                $doc->company_id=$claim->cid;
                $ran=rand(3,9999);
                $name=time().$ran.'.'.$file->getClientOriginalExtension();
                $filepath='claims/'.$claim->id.'/company/'.$claim->cid.'/Supported_document/';
                $file->move(storage_path().'/app/public/'.$filepath,$name);
                $doc->doc_name = $filepath.$name;
                $doc->claim_id=$claim->id;
                $doc->save();
                }
            }
        }
        


        return back()->with('success','Your Claim Request Added SuccessFully');
    }
    public function elmaddclaim(Request $req){
        
        $req->validate([
            'deb_iqama'=>'min:10|max:10',
        ]);


        $claim = new Claim;
        $claim->cid=Auth::user()->id;
        $claim->company_id=Auth::user()->company_id;
        $claim->amount_after_discount=$req->amount_after_discount;
        $claim->type=$req->type;
        $claim->libpercent=$req->libpercent;
        $claim->deb_iqama=$req->deb_iqama;
        $claim->acc_date=$req->acc_date;
        $claim->acc_location=$req->acc_location;
        $claim->deb_name=$req->deb_name;
        $claim->ic_mail=$req->icemail;
        $claim->deb_age=$req->deb_age;
        $claim->claim_no=$req->claim_no;
        if($req->deb_type=='insured'){
            $claim->deb_type='insured';
            $claim->rec_reason=$req->rec_reason;
        }
        else{
            $claim->deb_type='third_party';
            $claim->rec_reason="";
        }


        $claim->save();
        
         $admin=User::where('roll',0)->first();
        Notification::create([
            'from'=> Auth::user()->id,
            'to'=> $admin->id,
            'message'=>'New Claim Added',
            'type'=>'claim added',
            'read'=>false,
        ]);

        if($req->hasfile('support_doc')) {

            foreach($req->file('support_doc') as $file){
            $doc = new Supported_Doc;
            $doc->company_id=$claim->cid;
            $ran=rand(3,9999);
            $name=time().$ran.'.'.$file->getClientOriginalExtension();
            $filepath='claims/'.$claim->id.'/company/'.$claim->cid.'/Supported_document/';
            $file->move(storage_path().'/app/public/'.$filepath,$name);
            $doc->doc_name = $filepath.$name;
            $doc->claim_id=$claim->id;
            $doc->save();
            }
        }


        return back()->with('success','Your Claim Request Added SuccessFully');
    }
    
    public function elmimportexcel(Request $req){
        //        $req->validate([
        //            'bulkfile'=>'required'
        //        ]);
        if($req->hasfile('xfile'))
        {
        //             dd($req);
        //data[0]['request_type'] = 1;
            $size_of_array=sizeof($req->data);
            // dd($size_of_array);
            $rows = $size_of_array/10;
            $data = $req->all();
            
            // dd($data);
            // dd($req->data4);
            // dd($req->$data);
            $details=$data["data"];
         // dd($req->date1);
            $col=0;
            $i=1;
            for ($item=0; $item <$rows ; $item++) {
                $details[$col];
                $details[$col+1];
                $details[$col+2];
                $details[$col+3];
                $details[$col+4];
                $details[$col+5];
                $details[$col+6];
                $details[$col+7];
                $details[$col+8];
                $details[$col+9];
               
                $excelDateValue = $details[$col+10]; // replace with your own Excel date value
                $unixTimestamp = (($excelDateValue - 25569) * 86400);
                $dateTime = new DateTime("@$unixTimestamp");
                $dateString = $dateTime->format('Y-m-d');
                $accidentDate = $dateString;
              
               // dd();
                $date=$req->date;
                        //
                       // dd( $date);
                $claim[$item]= Claim::insertGetId([
                    "cid"=>Auth::user()->id,
                    "company_id"=>Auth::user()->company_id,
                    "rec_amt"=>$details[$col],
                    "acc_location"=>$details[$col+1],
                    "rec_reason"=>$details[$col+2],
                    "deb_iqama"=>$details[$col+3],
                    "deb_name"=>$details[$col+4],
                    "deb_age"=>$details[$col+5],
                    "deb_type"=>$details[$col+6],
                    "claim_no"=>$details[$col+7],
                    "ic_mail"=>$details[$col+8],
                    "acc_date"=> $accidentDate ,
                    'created_at'=>date("Y-m-d"),
                    'updated_at'=>date("Y-m-d")

                ]);
                // dd($claim[$item]);
                $img=$req->files->all();
                // dd();
                // if($img['data'.$i]){
                //     foreach($img['data'.$i] as $file){
                        
                //         //  loop will be here
                //         $ran=rand(3,9999);
                //         $name=time().$ran.'.'.$file->getClientOriginalExtension();
                //         $filepath='/claims/'.$claim[$item].'/company/'.Auth::user()->id.'/Supported_document/';
                //         $file->move(storage_path().'/'.$filepath,$name);

                //         $documents=new Supported_Doc;
                //         $documents->company_id=Auth::user()->id;
                //         $documents->doc_name=$filepath.$name;
                //         $documents->claim_id=$claim[$item];
                //         $documents->save();

                //         // unset($file);
                //         $filepath='';
                //         $name='';
                //         // $doc[$item]= Supported_Doc::insertGetId([
                //             //     "company_id"=>Auth::user()->id,
                //             //     "doc_name"=>$filepath.$name,
                //             //     "claim_id"=>$claim[$item]
                //             // ]);
                //         }
                //     }
                foreach($img['data'.$i] as $file){
                    // dd($img['data'.$i]);
                    $doc =new Supported_Doc;
                    $doc->company_id=Auth::user()->id;
                    $ran=rand(3,9999);
                    $name=time().$ran.'.'.$file->getClientOriginalExtension();
                    $filepath='claims/'.$claim[$item].'/company/'.Auth::user()->id.'/Supported_document/';
                    $file->move(storage_path().'/app/public/'.$filepath,$name);
                    $doc->doc_name = $filepath.$name;
                    $doc->claim_id=$claim[$item];
                    $doc->save();
                    }
                    //          
                    $i++;
                    $col+=10;
                }
            session()->put('success',"Record inserted");
        }

        //        $string = json_encode($id_vehicle);
        //   $string = rand(0, 99);
        //   $string1 = $string+4;
        //        return redirect()->back()->with('id',$string.' All records has been successfully added.');
        // Excel::import(new form2,$req->xfile);
        // return redirect()->back()->with('id',$string.' All records has been successfully added.');
        return back();
    }
    
    public function getelmclaims(){
        $claim = Claim::where('company_id',Auth::user()->company_id)->where('status',0)->where('deb_mob',null)->get();
        return view('ic.viewelmclaim',compact('claim'));
    }
    
     public function claimgetelm($id){
        $claim=Claim::where('company_id',Auth::user()->company_id)->where('id',$id)->first();

        return view('ic.detailelmclaim',compact('claim'));
    }
    
    public function editelmclaim($id){
        $claim=Claim::where('id',$id)->first();
        return view('ic.editelmclaim',compact('claim'));
    }
    
    public function importexcel(Request $req){
        //        $req->validate([
        //            'bulkfile'=>'required'
        //        ]);
        if($req->hasfile('xfile'))
        {
        //             dd($req);
        //data[0]['request_type'] = 1;
            $size_of_array=sizeof($req->data);
           
            $rows = $size_of_array/13;
           //dd($rows);
            $data = $req->all();
           // dd($size_of_array,$rows);
             //dd($data);
            // dd($req->data4);
           
            $details=$data["data"];
           // dd($details);
            $col=0;
            $i=1;
           
            for ($item=0; $item <$rows ; $item++) {
                
                
                // $excelDateValue = $details[$col+10]; // replace with your own Excel date value
                // $unixTimestamp = (($excelDateValue - 25569) * 86400);
                // $dateTime = new DateTime("@$unixTimestamp");
                // $dateString = $dateTime->format('Y-m-d');
                // $accidentDate = $dateString;
                
                
                $details[$col];
                $details[$col+1];
                $details[$col+2];
                $details[$col+3];
                $details[$col+4];
                $details[$col+5];
                $details[$col+6];
                $details[$col+7];
                $details[$col+8];
                $details[$col+9];
                $details[$col+10];
                $details[$col+11];
                $details[$col+12];
               
               // dd($details[$col+11]);
               
               
              
               // dd();
                $date=$req->date;
                        //
                       // dd( $date);
                $claim[$item]= Claim::insertGetId([
                    "cid"=>Auth::user()->id,
                    "company_id"=>Auth::user()->company_id,
                    "rec_amt"=>$details[$col],
                    "acc_location"=>$details[$col+1],
                    "rec_reason"=>$details[$col+2],
                    "deb_iqama"=>$details[$col+3],
                    "deb_name"=>$details[$col+4],
                    "deb_age"=>$details[$col+5],
                    "deb_mob"=>'+966'.$details[$col+6],
                    "deb_type"=>$details[$col+7],
                    "claim_no"=>$details[$col+8],
                    "ic_mail"=>$details[$col+9],
                    "acc_date"=>$details[$col+10],
                    "libpercent"=>$details[$col+11],
                    "type"=>$details[$col+12],
                    'created_at'=>date("Y-m-d"),
                    'updated_at'=>date("Y-m-d")

                ]);
                // dd($claim[$item]);
                $img=$req->files->all();
                // dd();
                // if($img['data'.$i]){
                //     foreach($img['data'.$i] as $file){
                        
                //         //  loop will be here
                //         $ran=rand(3,9999);
                //         $name=time().$ran.'.'.$file->getClientOriginalExtension();
                //         $filepath='/claims/'.$claim[$item].'/company/'.Auth::user()->id.'/Supported_document/';
                //         $file->move(storage_path().'/'.$filepath,$name);

                //         $documents=new Supported_Doc;
                //         $documents->company_id=Auth::user()->id;
                //         $documents->doc_name=$filepath.$name;
                //         $documents->claim_id=$claim[$item];
                //         $documents->save();

                //         // unset($file);
                //         $filepath='';
                //         $name='';
                //         // $doc[$item]= Supported_Doc::insertGetId([
                //             //     "company_id"=>Auth::user()->id,
                //             //     "doc_name"=>$filepath.$name,
                //             //     "claim_id"=>$claim[$item]
                //             // ]);
                //         }
                //     }
                foreach($img['data'.$i] as $file){
                    // dd($img['data'.$i]);
                    $doc =new Supported_Doc;
                    $doc->company_id=Auth::user()->id;
                    $ran=rand(3,9999);
                    $name=time().$ran.'.'.$file->getClientOriginalExtension();
                    $filepath='claims/'.$claim[$item].'/company/'.Auth::user()->id.'/Supported_document/';
                    $file->move(storage_path().'/app/public/'.$filepath,$name);
                    $doc->doc_name = $filepath.$name;
                    $doc->claim_id=$claim[$item];
                    $doc->save();
                    }
                    //          
                    $i++;
                    
                    $col+=13;
                  //  dd($col,$data);
                   
                   
                }
            session()->put('success',"Record inserted");
        }

        //        $string = json_encode($id_vehicle);
        //   $string = rand(0, 99);
        //   $string1 = $string+4;
        //        return redirect()->back()->with('id',$string.' All records has been successfully added.');
        // Excel::import(new form2,$req->xfile);
        // return redirect()->back()->with('id',$string.' All records has been successfully added.');
        return back();
    }

    public function getclaims(){
        // $claim = Claim::where('company_id',Auth::user()->company_id)->get();
        // return view('ic.viewclaim',compact('claim'));
        
        $claims = Claim::where('company_id',Auth::user()->company_id)->paginate(10);
        return view('ic.viewclaim-beta',compact('claims'));
    }

    public function claimget($id){
        $claim=Claim::where('company_id',Auth::user()->company_id)->where('id',$id)->first();

        return view('ic.detailclaim',compact('claim'));
    }


    public function editclaim($id){
        $claim=Claim::where('id',$id)->first();
        return view('ic.editclaim',compact('claim'));
    }

    public function resubmitclaim(Request $req){
        
          $req->validate([
            'deb_mob'=>'min:9|max:9',
        ]);

        $claim=Claim::where('id',$req->xyz)->first();

        $claim->amount_after_discount=$req->amount_after_discount;
        $claim->deb_iqama=$req->deb_iqama;
        if(!empty($req->acc_date)){
            $claim->acc_date=$req->acc_date;
        }
        else{
            $claim->acc_date=$claim->acc_date;
        }

        $claim->acc_location=$req->acc_location;
        $claim->deb_name=$req->deb_name;
        $claim->deb_age=$req->deb_age;
       if($claim->deb_mob!=null){
            $claim->deb_mob='+966'.$req->deb_mob;
        }
        $claim->claim_no=$req->claim_no;
        $claim->status=0;
        if($req->deb_type=='insured'){
            $claim->deb_type='issured';
            $claim->rec_reason=$req->rec_reason;
        }
        elseif($req->deb_type=='third party'){
            $claim->deb_type='third party';
            $claim->rec_reason="";
        }

        $claim->save();
        if($req->hasfile('support_doc')) {

            $documents=Supported_Doc::where('claim_id',$req->id)->get();
            foreach($documents as $doc){
                File::delete(storage_path.'/app/public/'.($doc->doc_name));
                $doc->delete();
            }


            foreach($req->file('support_doc') as $file){

                $doc =new Supported_Doc;
                $doc->company_id=$claim->company_id;
                $ran=rand(3,9999);
                $name=time().$ran.'.'.$file->getClientOriginalExtension();
                $filepath='claims/'.$claim->id.'/company/'.$claim->cid.'/Supported_document/';
                $file->move(storage_path().'/app/public/'.$filepath,$name);
                $doc->doc_name = $filepath.$name;
                $doc->claim_id=$claim->id;
                $doc->save();
                }

        }

        return redirect()->route('IcViewClaim')->with('success','Request Details Changed Successfully');
    }


    public function readedmsg($id){
        $message=Message::where('id',$id)->first();
        $message->status=0;
        $message->save();
        return back();
        

    }
     public function callstatusapi($id){

      

        $response = Http::withHeaders([
            'AppsId' => 'lmfuLlmvVEKcOCMyxF1A',
            'Content-Type' => 'application/json'
        ])->get('https://voice.unifonic.com/v1/calls/'.$id);

         $result=json_decode($response);
       //  dd($response1);
        return  response()->json($result,200);
    }
    
    public function preClaim(Request $req){
      //  dd($req->document);
        $claim=new PreClaim();
        DB::beginTransaction();
        try{
            $claim->company_id=Auth::user()->company_id;
            $claim->user_id=Auth::user()->id;
            $claim_no= str_replace("/","-",$req->claim_no);
            $claim->claim_no= str_replace("/","-",$req->claim_no)  ;
            $claim->status=1;
           
           // dd($req->file);
            // if($req->hasfile('document')) {
                
            //     $file=$req->file('document');
            //     $name = time().''.rand(3,999);
            //     $ext= $file->getClientOriginalExtension();
            //     $filepath='PreRegister/'.$req->claim_no.'/';
            //     $file->move(storage_path().'/'.$filepath,$name.'.'.$ext);
            //     // $file->move(storage_path().'/uploads/'.$req->vehical_id.'/missing_parts', $name.'.'.$ext);
            //     $imgData = $filepath.$name.'.'.$ext;
            
          
            //     $claim->document=$imgData;
            //     $claim->save();
    
            
            // }
            if ($req->hasfile('document')) {
             foreach ($req->file('document') as $file) {
                $name = time() . '' . rand(1000000, 999999999999);
                $ext = $file->getClientOriginalExtension();
                $filepath ='/Preclaim1/' .  $claim_no .'/files/';
                $fullname = $name . '.' . $ext;
                $file->move(storage_path() .'/app/public/'. $filepath, $fullname);
                $imgData[] = $filepath . $fullname;
                }
             $file = json_encode($imgData);
                // dd($imgData);
            }
             $claim->document=$file;
            $claim->save();
            DB::commit();

            return back()->with('success','File uploaded successfully');
        }catch(\Excetpion $e){
            DB::rollback();

            return back()->with('error','Something went wrong');
        }
       
    }
    
    public function addComment(Request $req){

        if($req->claimid!=null){
            DB::beginTransaction();
            try{
    
                $comment= new ClaimComment;
                $comment->claim_id=$req->claimid;
                $comment->ic_id=Auth::user()->company_id;
                $comment->update_by=Auth::user()->id;
                $comment->comment=$req->comment;
                $comment->status=2;//status =1 admin comment status 2 ic comment
                $comment->save();
                
                DB::commit();
                return back()->with('success', 'Comment Added Successfully');
            }catch(\Exception $e){
               dd($e);
                DB::rollback();
                return back()->with('error', 'Something went wrong');
            }
        }else{
            return back()->with('error', 'Select Claim First');
        }
       

    }
     public function export() 
    {
  
    return Excel::download(new ClaimExport, 'claims.xlsx');
    }
    
    public function search(Request $req)
    {
      
        if($req->idclaim!=null){
            $claims=Claim::where('id', $req->idclaim)->paginate(100);
            return view('admin.reg_claims',compact('claims'));
        }else if($req->claimStatus != null){
            if($req->claimStatus == 1){
               $claims= ClaimStatus::join('claims','claim_status.claim_id','=','claims.id')
                ->join('claim_remarks','claim_status.claim_id','=','claim_remarks.claim_id')
                ->where('claim_remarks.status',1)->whereNotNull('claim_remarks.remainder')
                ->select('claims.id','claims.company_id','claims.cid','claims.claim_no','claims.deb_mob','claims.deb_name',
                'claims.type','claims.rec_amt','claims.acc_date','claims.created_at','claims.status','claims.deb_type','claims.acc_location',
                'claims.deb_name','claims.deb_iqama','claims.is_assign')
                ->paginate(100);
                return view('admin.reg_claims',compact('claims'));
            }else if($req->claimStatus == '12'){
               
                $claims= Claim::join('claim_status','claim_status.claim_id','=','claims.id')->join('claim_remarks','claim_status.claim_id','=','claim_remarks.claim_id')
                ->where('claim_remarks.status',1)->whereNull('claim_remarks.remainder')
                ->where('claim_status.status',1)
                ->select('claims.id','claims.company_id','claims.cid','claims.claim_no','claims.deb_mob','claims.deb_name',
                'claims.type','claims.rec_amt','claims.acc_date','claims.created_at','claims.status','claims.deb_type','claims.acc_location',
                'claims.deb_name','claims.deb_iqama','claims.is_assign')
                ->paginate(100);
                // dd($claims);
                 return view('admin.reg_claims',compact('claims'));
            }
            
            else if($req->claimStatus == 2){
                $claims= ClaimStatus::join('claims','claim_status.claim_id','=','claims.id')->where('claim_status.status',2)->paginate(100);
                 return view('admin.reg_claims',compact('claims'));
            }
            else if($req->claimStatus == 3){
                $claims= ClaimStatus::join('claims','claim_status.claim_id','=','claims.id')->where('claim_status.status',3)->paginate(100);
                 return view('admin.reg_claims',compact('claims'));
            }
            else if($req->claimStatus == 4){
                $claims= ClaimStatus::join('claims','claim_status.claim_id','=','claims.id')->where('claim_status.status',4)->paginate(100);
                 return view('admin.reg_claims',compact('claims'));
            }else if($req->claimStatus == 5){
                $claims= ClaimStatus::join('claims','claim_status.claim_id','=','claims.id')->where('claim_status.status',5)->paginate(100);
                 return view('admin.reg_claims',compact('claims'));
            }else if($req->claimStatus == 6){
                $claims= ClaimStatus::join('claims','claim_status.claim_id','=','claims.id')->where('claim_status.status',6)->paginate(100);
                 return view('admin.reg_claims',compact('claims'));
            }else if($req->claimStatus == 7){
                $claims= ClaimStatus::join('claims','claim_status.claim_id','=','claims.id')->where('claim_status.status',7)->paginate(100);
                 return view('admin.reg_claims',compact('claims'));
            }else if($req->claimStatus == 8){
                $claims= ClaimStatus::join('claims','claim_status.claim_id','=','claims.id')->where('claim_status.status',8)->paginate(100);
                 return view('admin.reg_claims',compact('claims'));
            }else if($req->claimStatus == 9){
                $claims= ClaimStatus::join('claims','claim_status.claim_id','=','claims.id')->where('claim_status.status',9)->paginate(100);
                 return view('admin.reg_claims',compact('claims'));
            }else if($req->claimStatus == 10){
                $claims= ClaimStatus::join('claims','claim_status.claim_id','=','claims.id')->where('claim_status.status',10)->paginate(100);
                 return view('admin.reg_claims',compact('claims'));
            }else if($req->claimStatus == 11){
                $claims= ClaimStatus::join('claims','claim_status.claim_id','=','claims.id')->where('claim_status.status',11)->paginate(100);
                 return view('admin.reg_claims',compact('claims'));
            }else if($req->claimStatus == 'reg'){
                $claims= Claim::where('status',0)->paginate(100);
                 return view('admin.reg_claims',compact('claims'));
            }
            else if($req->claimStatus =='app'){
                $claims= Claim::where('status',1)->paginate(100);
                 return view('admin.reg_claims',compact('claims'));
            }
            else if($req->claimStatus == 'rejec'){
                $claims= Claim::where('status',2)->paginate(100);
                 return view('admin.reg_claims',compact('claims'));
            }
        }
        else if($req->debname!=null){
            $claims=Claim::where('deb_name','like','%'.$req->debname.'%')
            ->paginate(100);
            return view('admin.reg_claims',compact('claims'));
        }else if($req->claimno!=null){
            $claims=Claim::where('claim_no',$req->claimno)->paginate(10);
            return view('admin.reg_claims',compact('claims'));
        }else if($req->accdate!=null){
            $claims=Claim::where('acc_date',$req->accdate)->paginate(100);
            return view('admin.reg_claims',compact('claims'));
        }else if($req->recoveryAmt!=null){
            $claims=Claim::where('rec_amt',$req->recoveryAmt)->paginate(100);
            return view('admin.reg_claims',compact('claims'));
        }
        else if($req->accloc != null){
            $claims=Claim::where('acc_location',$req->accloc)->paginate(100);
            return view('admin.reg_claims',compact('claims'));
        }else if($req->assign_admin != null){
            
            $claims=Claim::where('is_assign',$req->assign_admin)->with('usere','companyname','statusee')->select('id','company_id','cid','claim_no','deb_mob','deb_name','type','rec_amt','acc_date','created_at','status','deb_type','acc_location','deb_name','deb_iqama','is_assign')
            ->get();
            return view('admin.reg_claims',compact('claims'));
        }
        else if($req->ic_name != null){
            
            $claims=Claim::where('company_id',$req->ic_name)->with('usere','companyname','statusee')->select('id','company_id','cid','claim_no','deb_mob','deb_name','type','rec_amt','acc_date','created_at','status','deb_type','acc_location','deb_name','deb_iqama','is_assign')
            ->get();
            return view('admin.reg_claims',compact('claims'));
        }
        else if($req->ic_user != null){
            
            $claims=Claim::where('cid',$req->ic_user)->with('usere','companyname','statusee')->select('id','company_id','cid','claim_no','deb_mob','deb_name','type','rec_amt','acc_date','created_at','status','deb_type','acc_location','deb_name','deb_iqama','is_assign')
            ->get();
            return view('admin.reg_claims',compact('claims'));
        }
        else if($req->start_date != null){
           // dd('erer');
           if($req->end_date != null){
                $startdate = DateTime::createFromFormat('Y-m-d', $req->start_date);
                $newDateString1 = $startdate->format('d/m/Y');
                $enddate = DateTime::createFromFormat('Y-m-d', $req->end_date);
                $newDateString2 = $enddate->format('d/m/Y');
                $startDate = Carbon::createFromFormat('d/m/Y', $newDateString1);
                $endDate = Carbon::createFromFormat('d/m/Y', $newDateString2);
           }else{
                $t=time();
                $enddate1=date("d/m/Y",$t);
                //dd($enddate1);
                $startdate = DateTime::createFromFormat('Y-m-d', $req->start_date);
                $newDateString1 = $startdate->format('d/m/Y');
               
                $startDate = Carbon::createFromFormat('d/m/Y', $newDateString1);
                $endDate = Carbon::createFromFormat('d/m/Y', $enddate1);   
           }
           
            //dd($startDate );
            $claims=Claim::whereBetween('created_at', [$startDate, $endDate]) ->get();
           // dd($claims);
        
           return view('admin.reg_claims',compact('claims'));
        }
        else{
            $claims=Claim::where('id', $req->idclaim)->orWhere('deb_name','like','%'.$req->debname.'%')
            ->orWhere('claim_no',$req->claimno)->orWhere('acc_date',$req->accdate)->orWhere('acc_location',$req->accloc)
            ->paginate(10);
            return view('admin.reg_claims',compact('claims'));
        }
       
            
        
    }
    
    public function icSearch(Request $req)
    {
      
        if($req->idclaim!=null){
            $claims=Claim::where('id', $req->idclaim)->paginate(100);
            return view('ic.viewclaim-beta',compact('claims'));
        }else if($req->debname!=null){
            $claims=Claim::where('deb_name','like','%'.$req->debname.'%')
            ->paginate(100);
           // dd($claims);
            return view('ic.viewclaim-beta',compact('claims'));
        }else if($req->claimno!=null){
            $claims=Claim::where('claim_no',$req->claimno)->paginate(100);
            return view('ic.viewclaim-beta',compact('claims'));
        }else if($req->accdate!=null){
            $claims=Claim::where('acc_date',$req->accdate)->paginate(100);
            return view('ic.viewclaim-beta',compact('claims'));
        }else if($req->accloc != null){
            $claims=Claim::where('acc_location',$req->accloc)->paginate(100);
            return view('ic.viewclaim-beta',compact('claims'));
        } 
        else{
           
            $claims=Claim::where('id', $req->idclaim)->orWhere('deb_name','like','%'.$req->debname.'%')
            ->orWhere('claim_no',$req->claimno)->orWhere('acc_date',$req->accdate)->orWhere('acc_location',$req->accloc)
            ->paginate(10);
            return view('ic.viewclaim-beta',compact('claims'));
        }
       
            
        
    }
    
    
    public function icexporte() 
    {
    return Excel::download(new IcClaim, 'RecoveryClaims.xlsx');
    }
    
     public function debUpload(Request $req){
        $req->validate([
            'files.*'=>'required|image'
        ]);
       
       // dd($req->all());
        try{
            $claim=Claim::where('link',$req->link)->first();
            
            if($claim->id==$req->id){
                if($req->hasfile('files')) {
                   
                    foreach($req->file('files') as $file){
                       
                  
                        $doc =new DebDoc;
                        $ran=rand(3,9999);
                        $name=time().$ran.'.'.$file->getClientOriginalExtension();
                        $filepath='claims/'.$claim->id.'/company/'.$claim->cid.'/DebtorDoc/';
                        $file->move(storage_path().'/app/public/'.$filepath,$name);
                        $doc->document = $filepath.$name;
                        $doc->claim_id=$claim->id;
                        $doc->status=1;
                        $doc->ip=$this->getIp();
                        $doc->save();
                    }
                }
                Alert::success('success', 'Additional uploaded successfully');
                return back();
            }else{
                Alert::error('error', 'Something went wrong');
                return back()->with('error','Something went wrong');
            }
           
        }catch(\Exception $e){
            dd($e);
            Alert::error('error', 'Something went wrong');
            return back();

        } 
    }
    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return the server IP if the client IP is not found using this method.
    }
    
    public function debSadad(Request $req){
        
    $claim=Claim::where('id',$req->claim_id)->first();
    $id=$req->claim_id;
    $idorder = 'PHP_' . rand(1, 1000);//Customer Order ID
    $terminalId = 'taheiyaSD';// Will be provided by URWAY
    $password = 'SD_URWAY@976';// Will be provided by URWAY
    $merchant_key = '74f5a88215a11c1fd76fa7540b26c1562565c7ab19ebaee21c09063057c327fe';// Will be provided by URWAY
    $currencycode = "SAR";
    $issueDate=date("Y-m-d");
   
    $expiryDate = Carbon::now()->addDay(3)->format("Y-m-d");
        $unitPrice= $claim->amount_after_discount;
        //$vat=$unitPrice*0.15;
        
        //$amount=$unitPrice+$vat;
        $amount= $unitPrice;
        $mob=$claim->deb_mob;
        $reciever=substr($mob,1);

    $ipp = "127.0.0.1";

    //Generate Hash
    $txn_details= $idorder.'|'.$terminalId.'|'.$password.'|'.$merchant_key.'|'.$amount.'|'.$currencycode;
    $hash=hash('sha256', $txn_details);
    $itemList=["name"=>"Recovery",
        "quantity"=>"1",
        "discount"=>"0",
        "discountType"=>"FIXED",
        "vat"=>"0",
        "unitPrice"=>$unitPrice
    ];
     
    $sadatpay=[
        "billNumber" => "902",
        "customerFullName"=> "Taheiya Recovery",
        "customerIdNumber"=> "",
        "customerIdType"=> "NAT",
        "customerEmailAddress"=> "developer@taheiya.sa",
        "customerMobileNumber"=> $reciever,
        "customerPreviousBalance"=> "",
        "customerTaxNumber"=> "",
        "issueDate"=> $issueDate,
        "expireDate"=> $expiryDate,
        "serviceName"=> "Recovery",
        "buildingNumber"=> "1234",
        "cityCode"=> "12",
        "districtCode"=> "1",
        "postalCode"=> "22230",
        "billItemList"=>json_encode($itemList),
        "isPartialAllowed"=>"",
        "miniPartialAmount"=>""
    ] ;
 

    $fields=array(
        'trackid' => $idorder,
        'terminalId' => $terminalId,
        'action' => "17",  // action is always 1
        'merchantIp' => '9.10.10.102',
        'password'=> $password,
        'currency' => $currencycode,
        'requestHash' => $hash,
        'country'=>"SA",
        "amount"=>$amount,
        "currency"=>"SAR",
        "country"=>"SA",
        "instrumentType"=>"Default",
        "sadadPaymentDetails"=>[$sadatpay],
        "smsLanguage"=>"ar",
        "sendLinkMode"=>"2",
       // "udf1"=>route('sadadResponse')
    );
    // return $fields;
   $curl = curl_init();
   curl_setopt_array($curl, [
       CURLOPT_URL => 'https://payments.urway-tech.com/PGServiceB2B/transaction/jsonProcess/JSONrequest',
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_ENCODING => '',
       CURLOPT_MAXREDIRS => 10,
       CURLOPT_TIMEOUT => 0,
       CURLOPT_FOLLOWLOCATION => true,
       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => 'POST',
       CURLOPT_POSTFIELDS => json_encode($fields),
       CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
   ]);

   $response = curl_exec($curl);
   curl_close($curl);
  // dd($response);
   $result = json_decode($response);
            if($result->responseCode == 5005){
       
                $sadad=new SadadPay();
                $sadad->claim_id=$claim->id;
                $sadad->tranid=$result->tranid;
                $sadad->trackid=$result->trackid;
                $sadad->amount=$result->amount;
                $sadad->sadadNumber=$result->sadadNumber;
                $sadad->hashResponse=$result->responseHash;
                $sadad->billNumber=$result->billNumber;
                $sadad->save();

                $claimid="902";
                $amt= $amount;
                $sada=$result->sadadNumber;
                $message="عزيزي العميل تم اصدار فاتورة سداد بمبلغ قدره". $amt." ريال سعودي بالرقم المرجعي".$sada." برجاء دفع الفاتورة من خلال الخيار". $claimid.
        
                "شكرا وتحياتي";
         
                $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
                    "userName"=> "Taheiya",
                    "numbers"=> $reciever,
                    "userSender"=> "Taheiya",
                    "apiKey"=> env('MSEGAT_API_KEY'),
                    "msg"=> $message
                ]);
                $data = json_decode($response->getBody(), true);
       
                    if($data['code']==1){
                        $smsres=new SmsResponse;
                        $smsres->claim_id=$id;
                        $smsres->code=$data['code'];
                        $smsres->phone_no=$reciever;
                        $smsres->message=$data['message'];
                        $smsres->sms=$message;
                        $smsres->save();
                    }else{
                        Alert::warning('error','Sms not sent');
                         return back()->with('error','Sms not sent');
                    }
                    
                     $response=DebtorResponse::where('claim_id',$id)->first();
                    if($response==null){
                       
                        $res=new DebtorResponse();
                        $res->claim_id=session()->get('claim');
                        $res->response=8;//sadad link
                        $res->save();
                    }else{
                        $response->response=8; //sadad link
                        $response->save();
                    }
                    
                    
                    Alert::success('success','Sadad Link Created Successfully');
                return back()->with('success','Sadad Link Created Successfully');
            }else{
                    Alert::warning('error','Something went wrong');
                 return back()->with('error','Something went wrong');
            }

     
    }
    public function gigexport() 
    {
        if(Auth::check()){
            if(Auth::user()->roll==0){
                return Excel::download(new GigReport, 'Gig Report.xlsx');
            }else if(Auth::user()->roll==1){
                 return Excel::download(new GigReport, 'Gig Report.xlsx');
            }else{
                return "no access";
            }
            
        }
    
    }
}
