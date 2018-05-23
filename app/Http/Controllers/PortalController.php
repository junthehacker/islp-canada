<?php

namespace App\Http\Controllers;

use App\Poster;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PortalController extends Controller
{
    public function dashboardPage(Request $request){
        if($request->user){
            if($request->user->role === 0){
                return view('portal/dashboard', [
                    'users' => User::all(),
                    'posters' => Poster::all()
                ]);
            }
            return view('portal/dashboard');
        } else {
            return redirect('/portal/login');
        }
    }

    public function accountPage(Request $request){
        if($request->user){
            return view('portal/account');
        } else {
            return redirect('/portal/login');
        }
    }

    public function submissionsPage(Request $request){
        if($request->user){
            if($request->user->role === 0){
                return view('portal/submissions', ['posters' => Poster::all()]);
            }
            return view('portal/submissions');
        } else {
            return redirect('/portal/login');
        }
    }

    public function usersPage(Request $request){
        if($request->user && $request->user->role === 0){
            return view('portal/users', [
                'users' => User::all()
            ]);
        } else {
            return "Not authorized";
        }
    }

    public function logout(Request $request){
        session(['uid' => null]);
        return redirect('/portal/login');
    }

    public function createUser(Request $request){
        if($request->user && $request->user->role === 0){
            if(!$request->email || !$request->password || User::where('email', $request->email)->first() || ($request->role != 0 && $request->role != 1 && $request->role != 2)){
                return back()->with('error', 'Cannot create user.');
            } else {
                $user = new User([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role
                ]);
                $user->save();
                return back()->with('message', 'User created');
            }
        } else {
            return back()->with('error', 'not authorized');
        }
    }
}
