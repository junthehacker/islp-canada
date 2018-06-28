<?php

namespace App\Http\Controllers;

use App\ForumChannel;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function home(){
        return view('forum/home', [
            'channels' => ForumChannel::all()
        ]);
    }

    public function new(Request $request){
        // TODO: Make sure only accepted mentor can post
        if($request->user){
            return view('forum/new', [
                'channels' => ForumChannel::where('status', 'open')->get()
            ]);
        } else {
            return "401 :(";
        }
    }

    public function post(){
        return view('forum/post');
    }
}
