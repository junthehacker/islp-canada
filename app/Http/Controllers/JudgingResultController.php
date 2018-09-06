<?php
/**
 * Copyright (c) 2018. Jun Zheng All Rights Reserved
 * I hereby grant the usage of this software to SOC (Statistical Society of Canada).
 *
 * Issue with the software? Contact juncapersonal at gmail dot com.
 */

namespace App\Http\Controllers;

use App\Competition;
use App\JudgingResult;
use App\User;
use Illuminate\Http\Request;

/**
 * Class JudgingResultController
 * @package App\Http\Controllers
 */
class JudgingResultController extends Controller
{
    /**
     * Get current competition (first competition with status !== archived)
     * @return Competition
     */
    public function _getCurrentCompetition()
    {
        $competitions = Competition::all()->sortByDesc('created_at');

        foreach ($competitions as $competition) {
            if ($competition->status !== 'archived') {
                return $competition;
            }
        }
        return null;
    }

    /**
     * Automatically assign judges
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function autoAssign(Request $request)
    {
        $judges = User::where('role', 2)->get();
        $competition = $this->_getCurrentCompetition();
        if (!$competition) {
            return back()->with('error', 'Invalid competition.');
        }

        // Remove all previously assigned results
        foreach (JudgingResult::all() as $result) {
            if ($result->poster->competition_id === $competition->id) {
                $result->delete();
            }
        }

        // Make sure you the count is valid
        if ($request->count > $judges || $request->count < 1 || !$competition) {
            return back()->with('error', 'Invalid input.');
        }

        // Assign judges
        for ($i = 0; $i < $request->count * count($competition->posters); $i++) {
            $judge = $judges[$i % count($judges)];
            $poster = $competition->posters[(int)(floor($i / $request->count))];
            $result = new JudgingResult();
            $result->poster_id = $poster->id;
            $result->user_id = $judge->id;
            $result->save();
        }

        return back()->with('success', 'Judges assigned.');
    }

    /**
     * Return confirm deletion page
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deletePage(Request $request, $id)
    {
        $result = JudgingResult::find($id);
        if (!$result) {
            return response()->view('errors/404')->setStatusCode(404);
        }

        // Return the deletion page
        return view('portal/judging/delete', [
            'judging_result' => $result
        ]);
    }

    /**
     * Remove a judge from submission
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $result = JudgingResult::find($id);
        if (!$result) {
            return response()->view('errors/404')->setStatusCode(404);
        }

        // Delete the result and return back to judging management page
        $result->delete();
        return redirect('/portal/judging')->with('success', 'Judge removed.');
    }

}
