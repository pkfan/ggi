<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signInForm()
    {
        // redirect to dashboard if authorize
        if (auth()?->user()?->hasRole(['admin', 'super-admin', 'director', 'manager'])) {
            return redirect()->route('AdminDashboard');
        } else if (auth()?->user()?->hasRole('officer')) {
            return redirect()->route('officer.dashboard');
        } else if (auth()?->user()?->hasRole('supervisor')) {
            return redirect()->route('supervisor.dashboard');
        } else if (auth()?->user()?->hasRole('legal-department')){
            return redirect()->route('legal-department.dashboard');
        }else if(auth()?->user()?->hasRole('collector')){
            return redirect()->route('collector.dashboard');
          }
        return view('admin.signin');
    }
    // Sign In
    public function signIn(Request $req)
    {

        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            $email = Auth::user()->email;
            $user = User::where('email', $email)->first();
            $twofactor = $user->twofactor;
            if ($twofactor == 0) {

                $user->verifyotp = 1;
                $user->save();

                if (auth()?->user()?->hasRole(['admin', 'super-admin', 'director', 'manager'])) {
                    session()->put('success', 'Login Successful');
                    return redirect()->route('AdminDashboard');
                }
                else if (auth()?->user()?->hasRole('officer')) {
                    session()->put('success', 'Login Successful');
                    return redirect()->route('officer.dashboard');
                }
                else if (auth()?->user()?->hasRole('supervisor')) {
                    session()->put('success', 'Login Successful');
                    return redirect()->route('supervisor.dashboard');
                }else if(auth()->user()->hasRole('legal-department')){
                    session()->put('success','Login Successfully');
                    return redirect()->route('legal-department.dashboard');
                }else if(auth()->user()->hasRole('collector')){
                    return redirect()->route('collector.dashboard');
                }
            } else {
                $otp = rand(1, 1000000);

                $detail = [
                    'otp' => $otp,
                ];
                try {
                    $email = Auth::user()->email;
                    \Mail::to($email)->send(new \App\Mail\OTPMail($detail));
                    $user = User::where('email', $email)->first();
                    $user->verifyotp = 0;
                    $user->otp = $otp;
                    $user->save();

                    return view('admin.signinotp', compact('email'));
                } catch (\Exception $e) {
                    dd($e);
                }
            }
        } else {
            session()->put('error', 'Invalid Credentals');
            return redirect()->back()->withInput()->with('invalid', 'Invalid username or password');
        }
    }
    public function forgetPassword()
    {
        if (auth()?->user()->hasRole(['admin', 'super-admin', 'director', 'manager'])) {
            return redirect()->route('AdminDashboard');
        } else {
            if (auth()?->user()->hasRole('employee')) {
                return redirect()->route('employee.dashboard');
            }
        }
        // just change middleware
        return view('admin.forgetpassword');
    }

    public function resetPassword(Request $req)
    {

        $check = User::where('email', $req->email)->count();
        if ($check > 0) {
            try {
                $random = generateRandomString(10);
                //dd($random);

                $user = User::where('email', $req->email)->first();
                $user->password = Hash::make($random);



                $email = $req->email;
                $user->save();
                $detail = [
                    'password' => $random
                ];


                \Mail::to($email)->send(new \App\Mail\ForgetPassword($detail));
                return back()->with('success', 'Successfully Reset Check Your Mail');
            } catch (\Exception $e) {
                dd($e);
                return back()->with('error', 'Something went wrong');
            }
        } else {
            return back()->with('error', 'Email not registered');
        }
    }

    // Logout
    public function logoutAdmin()
    {
        Auth::logout();

        session()->put('success', 'Logout Successful');
        return redirect()->route('AdminSignInForm');
    }
}
