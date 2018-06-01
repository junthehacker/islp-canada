<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function home(){
        return view('forum/home');
    }

    public function new(){
        return view('forum/new');
    }

    public function post(){
        return view('forum/post');
    }
}
