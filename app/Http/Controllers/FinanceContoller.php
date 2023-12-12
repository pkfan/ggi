<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Alert;
class FinanceContoller extends Controller
{
    public function register(Request $req){
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
        $user->type='finance company';
        $user->roll=3;
       
        $user->save();

        session()->put('success','Registered Successfully! Now Login');

        return redirect()->route('fclogin');
    }


    public function signIn(Request $req)
    {
        if (Auth::attempt(['email' => $req->email,'password' => $req->password]))
        {
            if (Auth::user()->roll == 3 &&  Auth::user()->status==0)
            {
                session()->put('error','Waiting For Approval');
                return redirect()->route('fclogin');
               
               return  "hello";
            }
            elseif(Auth::user()->roll == 3 &&  Auth::user()->status==1){
                session()->put('success','Log in Successfully');
                return redirect()->route('fcdashboard');
            }
            else
            {
                session()->put('error','Your are not seem to be Finance Company');
                return redirect()->route('fclogin');
            }
        }
        else
        {
            session()->put('error','Invalid Credentials');
            return redirect()->route('fclogin')->with('invalid','Invalid Username or Password');
        }
    }
    
    public function editprofile(Request $req){
        $req->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'min:9'
        ]);
        $username=User::where('name',$req->name)->count();
       
            $finance=User::where('id',$req->id)->first();
            $finance->name =$req->name;
            
            $finance->email= $req->email;
            $finance->phone = '+966'.$req->phone;
           
            $finance->save();
            Alert::success('Updated','Profile Update Successful');
            return back();
        
       
    }
}
