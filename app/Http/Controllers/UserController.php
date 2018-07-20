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

    /**
     * Create an account for teacher
     * @param Request $request
     * @return string
     */
    public function createTeacherAccount(Request $request){
        if(strlen($request->input('password')) < 8){
            return "Password must be at least 8 characters long.";
        }
        $user = User::where('email', $request->input('email'))->first();
        if($user){
            return "Email address is already used by another user.";
        }
        if(!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)){
            return "Please enter a valid email address.";
        }
        if(!$request->name){
            return "Name is a required field.";
        }
        if(!$request->school){
            return "School is a required field.";
        }
        if(!$request->heard_from){
            return "[How did you hear about ISLP?] is a required field.";
        }
        if(!$request->teaching_subject){
            return "Teaching subject is a required field.";
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

        return "ok";

    }

    public function createMentorAccount(Request $request){
        if(strlen($request->input('password')) < 8){
            return "Password must be at least 8 characters long.";
        }
        $user = User::where('email', $request->input('email'))->first();
        if($user){
            return "Email address is already used by another user.";
        }
        if(!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)){
            return "Please enter a valid email address.";
        }
        if(!$request->name){
            return "Name is a required field.";
        }
        if(!$request->school){
            return "School is a required field.";
        }
        if(!$request->major_area){
            return "Major area is a required field.";
        }
        if(!$request->reason){
            return "Reason is a required field";
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

        return "ok";
    }

    /**
     * Get confirm user deletion page
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deletePage(Request $request, $id){
        $user = User::find($id);
        if ($user) {
            return view('portal/user/delete', [
                'user' => $user
            ]);
        } else {
            return App::abort(404);
        }
    }

    /**
     * Execute a deletion request
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id){
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect('portal/users')->with('success', "User deleted.");
        } else {
            return App::abort(404);
        }
    }
}