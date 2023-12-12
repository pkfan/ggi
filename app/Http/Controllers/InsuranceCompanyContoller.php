<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use Hash;
class InsuranceCompanyContoller extends Controller
{
    // Sign Up
    public function signUp(Request $req)
    {
          $validated=$req->validate([
            'email'=>'required|unique:users,email',
            'phone'=>'min:9',
        ]);
        $user=new User();
        $user->name=$req->cname;
        $user->password=Hash::make($req->password);
        $user->email=$req->email;
        $user->cr_code=$req->srcode;
        $user->type='Insurance Company';
        $user->roll=1;
        $user->save();

        session()->put('success','Registered Successfully! Now Login');

        return redirect()->route('IcSignInForm');
    }



    // Sign In
    public function signIn(Request $req)
    {
        if (Auth::attempt(['email' => $req->email,'password' => $req->password]))
        {
            if(Auth::user()->roll==1 && Auth::user()->status==0){
                session()->put('error','Waiting for admin approval');
                return redirect()->route('IcSignInForm');
            }
            elseif(Auth::user()->roll==1 && Auth::user()->status==1){
                session()->put('success','Login Successful');
                return redirect()->route('IcDashboard');
            }
            else{
                session()->put('error','You are not seems to be insurance company');
                return redirect()->route('IcSignInForm');
            }
        }
        else
        {
            session()->put('error','Invalid Credentials');
            return redirect()->route('IcSignInForm')->with('invalid','Invalid Username or Password ');
        }
    }


    // Logout
    public function logoutIc()
    {
        Auth::logout();

        session()->put('success','Logout Successful');
        return redirect()->route('AdminSignInForm');
    }
     public function editprofile(Request $req){

        $req->validate([
            'icname'=>'required',
            'ic_cr'=>'required',
            'icemail'=>'required',
            'ic_phone'=>'required'
        ]);
        $username=User::where('name',$req->icname)->count();
       
            $company=User::where('id',$req->id)->first();
            $company->name =$req->icname;
            $company->cr_code = $req->ic_cr;
            $company->email= $req->icemail;
            $company->phone = '+966'.$req->ic_phone;
           
            $company->save();
            Alert::success('Updated','Profile Update Successful');
            return back();
        
        
    }
}
