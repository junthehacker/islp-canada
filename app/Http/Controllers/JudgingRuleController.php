<?php

namespace App\Http\Controllers;

use App\JudgingRule;
use Illuminate\Http\Request;

class JudgingRuleController extends Controller {

    /**
     * Create a new judging rule
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'score' => 'required|integer|min:1',
            'weight' => 'required|integer|min:1',
            'group' => 'required'
        ]);

        $rule = new JudgingRule();
        $rule->fill($request->all())->save();
        return redirect('/portal/rubric')->with('success', "Rule created.");
    }

    /**
     * Update a judging rule
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id) {
        $rule = JudgingRule::find($id);
        if($rule){
            $request->validate([
                'name' => 'required|max:255',
                'description' => 'required',
                'score' => 'required|integer|min:1',
                'weight' => 'required|integer|min:1',
                'group' => 'required'
            ]);

            $rule->fill($request->all())->save();
            return redirect('/portal/rubric')->with('success', "Rule updated.");
        } else {
            return back()->with('error', "Rule not found.");
        }
    }

    /**
     * Delete a judging rule
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request){
        $rule = JudgingRule::find($request->id);
        if($rule){
            $rule->delete();
            return redirect('/portal/rubric')->with('success', "Rule deleted.");
        } else {
            return back()->with('error', 'Cannot find rule.');
        }
    }
}
