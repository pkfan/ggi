<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function addCollectorsView() {
        return view('admin.collectors');
    }

    public function addCollector(Request $req)
    {
        try {
            $user = new User();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->reg_no = $req->national_id;
            $user->password = Hash::make($req->password);
            // $user->phone = '+966' . $req->mobile_no;
            $user->status = 1;
            $user->roll = 5; //collector
            $user->save();
            return back()->with('success', 'Collector added successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function profileSetting($id) {
        $user = User::where('id', $id)->first();
        return view('admin.profile_setting', compact('user'));
    }
}
