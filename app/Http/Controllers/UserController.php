<?php

namespace App\Http\Controllers;

use App\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Teacher;

class UserController extends Controller
{
    /**
     * Attempt to authenticate
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * Return the login page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function loginPage(){
        if(session('uid') && User::find(session('uid'))){
            return redirect('/portal/dashboard');
        } else {
            return view('portal/login');
        }
    }

    public function createTeacherAccount(Request $request){
        if(strlen($request->input('password')) < 8){
            return back()->with('teacher_signup_error', 'Password must be at least 8 characters long.');
        }
        $user = User::where('email', $request->input('email'))->first();
        if($user){
            return back()->with('teacher_signup_error', 'Email address is already used by another user.');
        }
        if(!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)){
            return back()->with('teacher_signup_error', 'Please enter a valid email address.');
        }
        if(!$request->name){
            return back()->with('teacher_signup_error', 'Name is a required field.');
        }
        if(!$request->school){
            return back()->with('teacher_signup_error', 'School is a required field.');
        }
        if(!$request->heard_from){
            return back()->with('teacher_signup_error', '[How did you hear about ISLP?] is a required field.');
        }
        if(!$request->teaching_subject){
            return back()->with('teacher_signup_error', 'Teaching subject is a required field.');
        }

        $user = new User();
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = 1;
        $user->save();

        $teacher = new Teacher();
        $teacher->name = $request->input('name');
        $teacher->school = $request->input('school');
        $teacher->teaching_subject = $request->input('teaching_subject');
        $teacher->heard_from = $request->input('heard_from');
        $teacher->user_id = $user->id;
        $teacher->save();

        return back()->with('teacher_signup_success', 'Registration successful, you can now login.');

    }

    public function createMentorAccount(Request $request){
        if(strlen($request->input('password')) < 8){
            return back()->with('mentor_signup_error', 'Password must be at least 8 characters long.');
        }
        $user = User::where('email', $request->input('email'))->first();
        if($user){
            return back()->with('mentor_signup_error', 'Email address is already used by another user.');
        }
        if(!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)){
            return back()->with('mentor_signup_error', 'Please enter a valid email address.');
        }
        if(!$request->name){
            return back()->with('mentor_signup_error', 'Name is a required field.');
        }
        if(!$request->school){
            return back()->with('mentor_signup_error', 'School is a required field.');
        }
        if(!$request->major_area){
            return back()->with('mentor_signup_error', 'Major area is a required field');
        }
        if(!$request->reason){
            return back()->with('mentor_signup_error', 'Reason is a required field.');
        }

        $user = new User();
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = 3;
        $user->save();

        $mentor = new Mentor();
        $mentor->name = $request->name;
        $mentor->school = $request->school;
        $mentor->major_area = $request->major_area;
        $mentor->reason = $request->reason;
        $mentor->user_id = $user->id;
        $mentor->save();

        return back()->with('mentor_signup_success', 'Registration successful, you can now login.');

    }
}