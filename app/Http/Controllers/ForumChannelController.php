<?php
/**
 * Copyright (c) 2018. Jun Zheng All Rights Reserved
 * I hereby grant the usage of this software to SOC (Statistical Society of Canada).
 *
 * Issue with the software? Contact juncapersonal at gmail dot com.
 */

namespace App\Http\Controllers;

use App\ForumChannel;
use Illuminate\Http\Request;

/**
 * Class ForumChannelController
 * @package App\Http\Controllers
 */
class ForumChannelController extends Controller
{
    /**
     * Create a new ForumChannel
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request){
        if($request->input('name')){
            $channel = new ForumChannel();
            $channel->name = $request->input('name');
            $channel->status = 'open';
            $channel->save();
            return back()->with('success', 'Channel created.');
        } else {
            return back()->with('error', 'Name is a required attribute.');
        }
    }

    /**
     * Delete a ForumChannel
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request){
        $channel = ForumChannel::find($request->input('id'));
        if($channel){
            $channel->delete();
            return back()->with('success', 'Channel deleted.');
        } else {
            return back()->with('error', 'Channel not found');
        }
    }

    /**
     * Enable a channel
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enable(Request $request){
        $channel = ForumChannel::find($request->input('id'));
        if($channel){
            $channel->status = 'open';
            $channel->save();
            return back()->with('success', 'Channel enabled.');
        } else {
            return back()->with('error', 'Channel not found');
        }
    }

    /**
     * Disable a channel
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disable(Request $request){
        $channel = ForumChannel::find($request->input('id'));
        if($channel){
            $channel->status = 'closed';
            $channel->save();
            return back()->with('success', 'Channel disabled.');
        } else {
            return back()->with('error', 'Channel not found');
        }
    }
}
