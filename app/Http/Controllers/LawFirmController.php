<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Claim;
use App\Models\DebtorRefuse;
use Illuminate\Http\Request;
use Auth;
use Alert;
use Hash;
class LawFirmController extends Controller
{
    //register
    public function register(Request $req)
    {
          $validated=$req->validate([
            'email'=>'required|unique:users,email',
            'phone'=>'min:9',
        ]);
        $user=new User();
        $user->name=$req->name;
        $user->password=Hash::make($req->password);
        $user->email=$req->email;
        $user->phone=$req->phone;
        $user->reg_no=$req->reg;
        $user->type='Law Firm';
        $user->roll=2;
        $user->idc=$req->idc;

        $user->save();

        session()->put('success','Registered Successfully! Now Login');

        return redirect()->route('LfSignin');
    }

    public function signIn(Request $req)
    {
        if (Auth::attempt(['email' => $req->email,'password' => $req->password]))
        {
            if(Auth::user()->roll==2 && Auth::user()->status==0){
                session()->put('error','Waiting for admin approval');
                return redirect()->route('LfSignin');
               
            }
            elseif(Auth::user()->roll==2 && Auth::user()->status==1){
                session()->put('success','Login Successful');
                return redirect()->route('Lfdashboard');
               
            }
            else
            {
                session()->put('error','Your are not seem to be Law Firm');
                return redirect()->route('AdminSignInForm');
            }
        }
        else
        {
            session()->put('error','Invalid Credentials');
            return redirect()->route('LfSignin')->with('invalid','Invalid Username or Password');
        }
    }

    public function dashboard(){
        return view('lawfirm.dashboard');
    }

    public function getclaim($id){
        
        $claim=Claim::where('id',$id)->first();
       
        return view('lawfirm.detailclaim',compact('claim'));
    }

    public function changeprogress1($id){
        $refuse=DebtorRefuse::where('id',$id)->first();
        if($refuse->caseprogress=='inprogress' || $refuse->caseprogress==null){
            $refuse->caseprogress='complete';
            $refuse->save();
            return back()->with('success','Progress changed');
        }
        else{
            return back()->with('success','Progress Completed');
        }
        
    }


    public function changeprogress2($id){
        $refuse=DebtorRefuse::where('id',$id)->first();
        if($refuse->caseprogress=='complete' || $refuse->caseprogress==null){
            $refuse->caseprogress='inprogress';
            $refuse->save();
            return back()->with('success','Progress changes');
        }
        
    }

    public function issueverdict(Request $req){
        $verdict=DebtorRefuse::where('id',$req->id)->first();
        $claim= getclaimdetail($verdict->debtorresponse_id);
        if($req->hasfile('file')) {
            $file=$req->file;
            $ran=rand(3,999);
            $name=time().$ran.'.'.$file->getClientOriginalExtension();
            $filepath='verdicts/'.'lawfirm/'.$verdict->lawfirm_id.'/claimid/'.$claim->id.'/';
            $file->move(public_path().'/'.$filepath,$name);  
            $verdict->verdict = $filepath.$name;  
            $verdict->save();
            return back()->with('success','Verdict is Isssued');
        }
        else{
            return back()->with('fail','Please Select File');
        }
        
        
    }
    
    public function editprofile(Request $req){
        $req->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'min:9'
        ]);
        $username=User::where('name',$req->name)->count();
       
            $lawfirm=User::where('id',$req->id)->first();
            $lawfirm->name =$req->name;
            
            $lawfirm->email= $req->email;
            $lawfirm->phone = '+966'.$req->phone;
           
            $lawfirm->save();
            Alert::success('Updated','Profile Update Successful');
            return back();
        
       
    }
    
}
