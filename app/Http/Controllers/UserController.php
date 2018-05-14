<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function authenticate(Request $request){
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return redirect('/portal/login')->with('error', 'User ID does not exist.');
        }
        if(Hash::check($request->password, $user->password)){
            session(['uid' => $user->id]);
            return redirect('/portal/dashboard');
        } else {
            return redirect('/portal/login')->with('error', 'Wrong password.');
        }
    }

    public function loginPage(){
        if(session('uid') && User::find(session('uid'))){
            return redirect('/portal/dashboard');
        } else {
            return view('portal/login');
        }
    }
}