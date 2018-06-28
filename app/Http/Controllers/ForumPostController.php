<?php
/**
 * Copyright (c) 2018. Jun Zheng All Rights Reserved
 * I hereby grant the usage of this software to SOC (Statistical Society of Canada).
 *
 * Issue with the software? Contact juncapersonal at gmail dot com.
 */

namespace App\Http\Controllers;

use App\ForumChannel;
use App\ForumPost;
use Illuminate\Http\Request;

/**
 * Class ForumPostController
 * @package App\Http\Controllers
 */
class ForumPostController extends Controller
{
    /**
     * Create a new forum post
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request){
        $channel = ForumChannel::find($request->input('forum_channel_id'));
        // TODO: Make sure only authorized user can post
        if(!$request->user){
            return back()->with('error', 'You must login.');
        }
        if(!$channel) {
            return back()->with('error', 'Channel does not exist.');
        }
        if ($channel->status !== 'open'){
            return back()->with('error', 'Channel is currently closed.');
        }
        if(!$request->input('title') || !$request->input('content')){
            return back()->with('error', 'Title and content are required fields.');
        }

        $post = new ForumPost();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = $request->user->id;
        $post->forum_channel_id = $request->input('forum_channel_id');
        // TODO: Check if post exist
        $post->forum_post_id = $request->input('forum_post_id');
        $post->save();

        // TODO: Return back to forum channel page
        return back()->with('success', 'Post successfully created.');
    }
}
