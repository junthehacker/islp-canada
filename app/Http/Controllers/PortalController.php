<?php
/**
 * Copyright (c) 2018. Jun Zheng All Rights Reserved
 *
 * Issue with the software? Contact juncapersonal at gmail dot com.
 */

namespace App\Http\Controllers;

use App\Competition;
use App\ForumChannel;
use App\JudgingResult;
use App\JudgingRule;
use App\Poster;
use App\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


/**
 * Class PortalController
 * @package App\Http\Controllers
 */
class PortalController extends Controller
{

    /**
     * Get current competition status !== archived
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
     * Return dashboard page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function dashboardPage(Request $request)
    {
        $mentors = User::where('role', 3)->get();
        $pending_mentor_app_count = 0;
        foreach ($mentors as $mentor) {
            if ($mentor->mentor->accepted === 0) {
                $pending_mentor_app_count++;
            }
        }
        if ($request->user) {
            if ($request->user->isAdmin()) {
                return view('portal/dashboard', [
                    'users' => User::all(),
                    'posters' => Poster::all(),
                    'mentors' => $mentors,
                    'pending_mentor_app_count' => $pending_mentor_app_count,
                    'competition' => $this->_getCurrentCompetition()
                ]);
            }
            if($request->user->isJudge()) {
                return view('portal/dashboard', [
                    'competition' => $this->_getCurrentCompetition(),
                    'judging_results' => JudgingResult::where('user_id', $request->user->id)
                ]);
            }
            return view('portal/dashboard', [
                'competition' => $this->_getCurrentCompetition()
            ]);

        } else {
            return redirect('/portal/login');
        }
    }

    /**
     * Return account page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function accountPage(Request $request)
    {
        if ($request->user) {
            return view('portal/account');
        } else {
            return redirect('/portal/login');
        }
    }

    /**
     * Return submissions page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function submissionsPage(Request $request)
    {
        if ($request->user) {
            if ($request->user->role === 0) {
                $competition = $request->competition ? Competition::find($request->competition): null;
                return view('portal/submissions', [
                    'competitions' => Competition::all()->sortByDesc('created_at'),
                    'competition' => $competition,
                    'posters' => $competition ? $competition->posters : Poster::all()
                ]);
            }
            return view('portal/submissions', [
                'competitions' => Competition::all()->sortByDesc('created_at'),
                'current_competition' => $this->_getCurrentCompetition()
            ]);
        } else {
            return redirect('/portal/login');
        }
    }

    /**
     * Return users page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function usersPage(Request $request)
    {
        return view('portal/users', [
            'users' => User::all()
        ]);
    }

    /**
     * Return mentor applications page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mentorApplicationsPage(Request $request)
    {
        $mentors = User::where('role', 3)->get();
        $pending_mentor_app_count = 0;
        $accepted_mentor_app_count = 0;
        foreach ($mentors as $mentor) {
            if ($mentor->mentor->accepted === 0) {
                $pending_mentor_app_count++;
            }
            if ($mentor->mentor->accepted === 1) {
                $accepted_mentor_app_count++;
            }
        }
        return view('portal/mentorapplications', [
            'users' => User::all(),
            'mentors' => $mentors,
            'pending_mentor_app_count' => $pending_mentor_app_count,
            'accepted_mentor_app_count' => $accepted_mentor_app_count
        ]);
    }

    /**
     * Return mentor application details page
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mentorApplicationDetailsPage(Request $request, $id)
    {
        return view('portal/mentorapplicationdetails', [
            'mentor' => User::find($id)
        ]);
    }

    /**
     * Approve a mentor
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveMentor(Request $request)
    {
        $mentor = User::find($request->id);
        if ($mentor && $mentor->role === 3 && $mentor->mentor->accepted === 0) {
            $mentor->mentor->accepted = 1;
            $mentor->mentor->save();
            return redirect('/portal/mentorapplications')->with('success', 'Mentor application approved.');
        } else {
            return back()->with('error', 'Cannot find mentor application.');
        }
    }

    /**
     * Declie a mentor
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function declineMentor(Request $request)
    {
        $mentor = User::find($request->id);
        if ($mentor && $mentor->role === 3) {
            $mentor->mentor->delete();
            $mentor->delete();
            return redirect('/portal/mentorapplications')->with('success', 'Mentor application declined.');
        } else {
            return back()->with('error', 'Cannot find mentor application.');
        }
    }

    /**
     * Manage rubric page
     * Return the manage rubric page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rubricPage(Request $request)
    {
        $rules = JudgingRule::all();
        $rule_groups = [];
        $total_weight = 0;
        foreach ($rules as $rule) {
            if (!in_array($rule->group, $rule_groups)) {
                $rule_groups[] = $rule->group;
            }
            $total_weight += $rule->weight;
        }

        return view('portal/rubric', [
            'competitions' => Competition::all()->sortByDesc('created_at'),
            'rules' => $rules,
            'rule_groups' => $rule_groups,
            'total_weight' => $total_weight
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function rubricListingPage(Request $request, $id)
    {
        $competition = Competition::find($id);
        $rules = $competition->judging_rules;
        $rule_groups = [];
        $total_weight = 0;
        foreach ($rules as $rule) {
            if (!in_array($rule->group, $rule_groups)) {
                $rule_groups[] = $rule->group;
            }
            $total_weight += $rule->weight;
        }
        if (!$competition) {
            return response("Competition not found.", 404);
        }
        return view('portal/rubric/list', [
            'competition' => Competition::find($id),
            'rules' => $rules,
            'rule_groups' => $rule_groups,
            'total_weight' => $total_weight
        ]);
    }

    /**
     * Return the create rubric rule page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createRubricRulePage(Request $request, $competition_id)
    {
        return view('portal/rubric/create', [
            'competition' => Competition::find($competition_id)
        ]);
    }

    /**
     * Return the edit rubric rule page
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function editRubricRulePage(Request $request, $competition_id, $id)
    {
        $rule = JudgingRule::find($id);
        if ($rule) {
            return view('portal/rubric/edit', [
                'competition' => Competition::find($competition_id),
                'rule' => $rule
            ]);
        } else {
            return "Not found";
        }
    }

    /**
     * Return competitions management page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function competitionsPage(Request $request)
    {
        return view('portal/competitions/home', [
            'competitions' => Competition::all()->sortByDesc('created_at'),
            'current_competition' => $this->_getCurrentCompetition()
        ]);
    }

    /**
     * Return judging page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function judgingPage(Request $request)
    {
        $competition = $this->_getCurrentCompetition();
        return view('portal/judging/home', [
            'judges' => User::where('role', 2)->get(),
            'competition' => $competition
        ]);
    }

    public function judgeWarning(Request $request)
    {
        if ($request->user->role !== 2) {
            return response("401", 401);
        } else {
            return view('portal/judge/warning', [
                'competition' => $this->_getCurrentCompetition()
            ]);
        }
    }

    public function judgePoster(Request $request, $id)
    {
        $result = JudgingResult::find($id);
        $competition = $this->_getCurrentCompetition();

        $rules = $competition->judging_rules;
        $rule_groups = [];
        $total_weight = 0;
        foreach ($rules as $rule) {
            if (!in_array($rule->group, $rule_groups)) {
                $rule_groups[] = $rule->group;
            }
            $total_weight += $rule->weight;
        }
        if (!$competition) {
            return response("Competition not found.", 404);
        }


        if ($result && $result->user_id === $request->user->id && $competition && $competition->id === $result->poster->competition_id) {
            return view('portal/judge/judge', [
                'competition' => $competition,
                'result' => $result,
                'rules' => $rules,
                'rule_groups' => $rule_groups,
                'total_weight' => $total_weight
            ]);
        } else {
            return response("401", 401);
        }
    }

    public function judgeSubmit(Request $request, $id){
        $result = JudgingResult::find($id);
        $competition = $this->_getCurrentCompetition();

        $rules = $competition->judging_rules;
        $rule_groups = [];
        $total_weight = 0;
        foreach ($rules as $rule) {
            if (!in_array($rule->group, $rule_groups)) {
                $rule_groups[] = $rule->group;
            }
            $total_weight += $rule->weight;
        }
        if (!$competition) {
            return response("Competition not found.", 404);
        }


        if ($result && $result->user_id === $request->user->id && $competition && $competition->id === $result->poster->competition_id) {
            $final_weight = 0;
            $detailed_result = [];
            foreach($rules as $rule){
                $rule_percentage = $request->input('score-' . $rule->id) / $rule->score;
                $rule_weight = $rule_percentage * $rule->weight;
                $final_weight += $rule_weight;
                $detailed_result[$rule->id] = $request->input('score-' . $rule->id);
            }
            $result->result = json_encode([
                'detail' => $detailed_result,
                'final_weight' => $final_weight,
                'final_percentage' => $final_weight / $total_weight,
                'notes' => $request->input('notes')
            ]);
            $result->save();
            return redirect('/portal/judge/list');
        } else {
            return response("401", 401);
        }
    }

    public function judgeList(Request $request)
    {
        if ($request->user->role !== 2) {
            return response("401", 401);
        } else {
            return view('portal/judge/list', [
                'competition' => $this->_getCurrentCompetition()
            ]);
        }
    }

    /**
     * Log current user out
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        session(['uid' => null]);
        return redirect('/portal/login');
    }

    /**
     * Create a new user
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createUser(Request $request)
    {
        if ($request->user && $request->user->role === 0) {
            if (!$request->email || !$request->password || User::where('email', $request->email)->first() || ($request->role != 0 && $request->role != 1 && $request->role != 2)) {
                return back()->with('error', 'Cannot create user.');
            } else {
                $user = new User([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role
                ]);
                $user->save();
                return back()->with('success', 'User created');
            }
        } else {
            return back()->with('error', 'not authorized');
        }
    }

    public function forumPage(Request $request){
        return view('portal/forum/manage', [
            'channels' => ForumChannel::all()
        ]);
    }

    /**
     * Export submissions to CSV
     * Takes in a parameter called competition, define which competition to export, if not found, export all
     * @param Request $request
     * @return mixed
     */
    public function exportSubmissions(Request $request){
        $competition = $request->input('competition') ? Competition::find($request->input('competition')) : null;
        if($competition){
            $posters = $competition->posters;
        } else {
            $posters = Poster::all();
        }

        // Construct the response
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=export.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = [
            'id',
            'title',
            'student_name',
            'submitted_at',
            'teacher_email',
            'teacher_name',
            'teacher_id',
            'school',
            'link'
        ];

        $callback = function() use ($posters, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($posters as $poster) {
                fputcsv($file, [
                    $poster->id,
                    $poster->title,
                    $poster->student_name,
                    $poster->created_at,
                    $poster->user->email,
                    $poster->user->teacher->name,
                    $poster->user->id,
                    $poster->user->teacher->school,
                    url('portal/submissions/' . $poster->id . '/image')
                ]);
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);
    }
}
