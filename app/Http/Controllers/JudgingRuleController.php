<?php

namespace App\Http\Controllers;

use App\JudgingRule;
use Illuminate\Http\Request;
use App\Competition;

class JudgingRuleController extends Controller
{

    /**
     * Create a new judging rule
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request, $competition_id)
    {
        $competition = Competition::find($competition_id);
        if ($competition && $competition->status !== 'archived') {
            $request->validate([
                'name' => 'required|max:255',
                'description' => 'required',
                'score' => 'required|integer|min:1',
                'weight' => 'required|integer|min:1',
                'group' => 'required'
            ]);

            $rule = new JudgingRule();
            $rule->fill($request->all());
            $rule->competition_id = $competition->id;
            $rule->save();
            return redirect('/portal/rubric/' . $competition->id)->with('success', "Rule created.");
        } else {
            return response("404", 404);
        }
    }

    /**
     * Update a judging rule
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $competition_id, $id)
    {
        $competition = Competition::find($competition_id);
        if ($competition && $competition->status !== 'archived') {
            $rule = JudgingRule::where('id', $id)->where('competition_id', $competition_id)->first();
            if ($rule) {
                $request->validate([
                    'name' => 'required|max:255',
                    'description' => 'required',
                    'score' => 'required|integer|min:1',
                    'weight' => 'required|integer|min:1',
                    'group' => 'required'
                ]);

                $rule->fill($request->all())->save();
                return redirect('/portal/rubric/' . $competition->id)->with('success', "Rule updated.");
            } else {
                return back()->with('error', "Rule not found.");
            }
        } else {
            return response("404", 404);
        }
    }

    /**
     * Delete a judging rule
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $competition_id)
    {
        $competition = Competition::find($competition_id);
        if ($competition && $competition->status !== 'archived') {
            $rule = JudgingRule::where('id', $request->id)->where('competition_id', $competition_id)->first();
            if ($rule) {
                $rule->delete();
                return back()->with('success', "Rule deleted.");
            } else {
                return back()->with('error', 'Cannot find rule.');
            }
        } else {
            return response("404", 404);
        }
    }
}
