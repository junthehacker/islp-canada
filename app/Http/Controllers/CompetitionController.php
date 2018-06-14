<?php

namespace App\Http\Controllers;

use App\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    /**
     * Create a new competition
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request){
        $competitions = Competition::all();
        foreach($competitions as $competition){
            $competition->status = 'archived';
            $competition->save();
        }
        $competition = new Competition();
        $competition->name = $request->input('name');
        $competition->status = 'new';
        $competition->save();
        return back()->with('success', 'Competition created.');
    }

    /**
     * Update a competition's status
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id){
        $valid_status = ['new', 'accept_submissions', 'submission_closed', 'begin_judging', 'judging_finished', 'result_announced', 'over'];
        $competition = Competition::find($id);
        if($competition){
            if($competition->status === 'archived'){
                return back()->with('error', 'Competition cannot be updated, it is already archived.');
            } else {
                if(in_array($request->input('status'), $valid_status)){
                    $competition->status = $request->input('status');
                    $competition->save();
                    return back()->with('success', 'Competition status updated.');
                } else {
                    return back()->with('error', 'Please choose a valid status.');
                }
            }
        } else {
            return back()->with('error', 'Competition not found');
        }
    }
}
