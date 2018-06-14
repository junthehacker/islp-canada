<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Poster;
use Illuminate\Http\Request;

class PosterController extends Controller
{

    public function _getCurrentCompetition(){
        $competitions = Competition::all()->sortByDesc('created_at');

        foreach($competitions as $competition){
            if($competition->status !== 'archived'){
                return $competition;
            }
        }
        return null;
    }

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
            $competition = $this->_getCurrentCompetition();
            if($competition && $competition->status !== 'accept_submissions'){
                return back()->with('create_poster_error', "Submission is closed.");
            }
            $poster = new Poster();
            $poster->title = $request->input('title');
            $poster->student_name = $request->input('student_name');
            $poster->image_base64 = $request->input('image_base64');
            $poster->user_id = $request->user->id;
            $poster->competition_id = $competition->id;
            $poster->save();
            return back()->with('create_poster_success', "Poster successfully submitted.");
        } else {
            return redirect('/portal/login');
        }
    }
}
