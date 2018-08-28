<?php
/* Competition status description for [Active Competition] card.
 * This partial requires that $current_competition, which is a Competition object being set.
 *
 * Author(s): Jun Zheng (me@jackzh.com)
 */
?>

@if($current_competition->status === 'new')
    <p>
        You just created a new competition. Currently all public actions on this competition are disabled, this include poster submissions, judging and more.<br>
        If you wish to start accepting posters from teachers, please advance to Accept Submissions status.
    </p>
@endif

@if($current_competition->status === 'accept_submissions')
    <p>
        You are now accepting submissions, teachers can submit posters to this competition.<br>
        To close submissions, advance to next status Submission Closed.
    </p>
@endif

@if($current_competition->status === 'submission_closed')
    <p>
        Teachers can no longer submit posters, and you are ready to start judging.<br>
        Before advancing to next stage, please make sure you have rubrics ready, as you won't be able to modify them after judging has began.
    </p>
@endif

@if($current_competition->status === 'begin_judging')
    <p>
        Judging system is now enabled, judges can now login to their account.<br>
        Monitor judging status in Judging tab, once all scores have been submitted, you can advance to next stage, which will disable judging.
    </p>
@endif

@if($current_competition->status === 'judging_finished')
    <p>
        Judging is now finished, visit Judging tab to view all scores.<br>
        Once you are ready to announce the winners, advance to next status Result Announced.
    </p>
@endif

@if($current_competition->status === 'result_announced')
    <p>
        Results are announced!<br>
        When you are ready to take down the website, or start next competition, advance to next stage Over.
    </p>
@endif

@if($current_competition->status === 'over')
    <p>
        The competition is over. You can safely take down the website, export any data you wish, or create a new competition.
    </p>
@endif