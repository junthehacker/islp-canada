<?php

namespace App\Http\Controllers;

use App\Poster;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PortalController extends Controller
{
    public function dashboardPage(Request $request){
        $mentors = User::where('role', 3)->get();
        $pending_mentor_app_count = 0;
        foreach ($mentors as $mentor){
            if($mentor->mentor->accepted === 0){
                $pending_mentor_app_count++;
            }
        }
        if($request->user){
            if($request->user->role === 0){
                return view('portal/dashboard', [
                    'users' => User::all(),
                    'posters' => Poster::all(),
                    'mentors' => $mentors,
                    'pending_mentor_app_count' => $pending_mentor_app_count
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
        return view('portal/users', [
            'users' => User::all()
        ]);
    }

    public function mentorApplicationsPage(Request $request){
        $mentors = User::where('role', 3)->get();
        $pending_mentor_app_count = 0;
        $accepted_mentor_app_count = 0;
        foreach ($mentors as $mentor){
            if($mentor->mentor->accepted === 0){
                $pending_mentor_app_count++;
            }
            if($mentor->mentor->accepted === 1){
                $accepted_mentor_app_count++;
            }
        }
        return view('portal/mentorapplications', [
            'users' => User::all(),
            'mentors' => $mentors,
            'pending_mentor_app_count' => $pending_mentor_app_count,
            'accepted_mentor_app_count' => $accepted_mentor_app_count
        ]);
    }

    public function mentorApplicationDetailsPage(Request $request, $id){
        return view('portal/mentorapplicationdetails', [
            'mentor' => User::find($id)
        ]);
    }

    public function approveMentor(Request $request){
        $mentor = User::find($request->id);
        if($mentor && $mentor->role === 3 && $mentor->mentor->accepted === 0){
            $mentor->mentor->accepted = 1;
            $mentor->mentor->save();
            return redirect('/portal/mentorapplications')->with('success', 'Mentor application approved.');
        } else {
            return back()->with('error', 'Cannot find mentor application.');
        }
    }

    public function declineMentor(Request $request){
        $mentor = User::find($request->id);
        if($mentor && $mentor->role === 3){
            $mentor->mentor->delete();
            $mentor->delete();
            return redirect('/portal/mentorapplications')->with('success', 'Mentor application declined.');
        } else {
            return back()->with('error', 'Cannot find mentor application.');
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
