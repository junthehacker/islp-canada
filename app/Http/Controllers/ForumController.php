<?php

namespace App\Http\Controllers;

use App\ForumChannel;
use App\ForumPost;
use Illuminate\Http\Request;

/**
 * Class ForumController
 * @package App\Http\Controllers
 */
class ForumController extends Controller
{
    /**
     * Return forum home
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home(){
        return view('forum/home', [
            'channels' => ForumChannel::all()
        ]);
    }

    /**
     * Return create new post page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
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

    /**
     * Return post detail page
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function post(Request $request, $id){
        $post = ForumPost::find($id);
        if($post && !$post->forum_post_id){
            return view('forum/post', [
                'post' => $post
            ]);
        } else {
            return "404 :(";
        }
    }
}
