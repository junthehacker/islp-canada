<?php

namespace App\Http\Controllers;

use App\Poster;
use Illuminate\Http\Request;

class PosterController extends Controller
{
    public function create(Request $request){
        if($request->user && $request->user->role === 1){
            if(!$request->input('title')){
                return back()->with('create_poster_error', "Title is a required field.");
            }
            if(!$request->input('student_name')){
                return back()->with('create_poster_error', "Student name is a required field.");
            }
            if(!$request->input('image_base64')){
                return back()->with('create_poster_error', "You must upload an image.");
            }
            $poster = new Poster();
            $poster->title = $request->input('title');
            $poster->student_name = $request->input('student_name');
            $poster->image_base64 = $request->input('image_base64');
            $poster->user_id = $request->user->id;
            $poster->save();
            return back()->with('create_poster_success', "Poster successfully submitted.");
        } else {
            return redirect('/portal/login');
        }
    }
}
