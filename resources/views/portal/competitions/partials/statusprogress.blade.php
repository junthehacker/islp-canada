<?php
/* Competition status progress bar for [Active Competition] card.
 * This partial requires that $current_competition, which is a Competition object being set.
 *
 * Author(s): Jun Zheng (me@jackzh.com)
 */
?>

<div class="status-progress">
    <div class="status-current">
        {{ $current_competition->getStatusName() }}
        <span class="small text-muted">Next: {{ $current_competition->getNextStatusName() }}</span>
    </div>
    <div class="status-progress-bar">
        <div class="status-progress-bar-inner" style="width: {{$current_competition->getCurrentStatusProgressPercentage()}}%;"></div>
        <div class="status-progress-checkpoint @if($current_competition->hasStatusPassed('new')) active @endif"
             data-toggle="tooltip" data-placement="bottom" title="New Competition"></div>
        <div class="status-progress-checkpoint @if($current_competition->hasStatusPassed('accept_submissions')) active @endif"
             data-toggle="tooltip" data-placement="bottom" title="Accept Submissions"></div>
        <div class="status-progress-checkpoint @if($current_competition->hasStatusPassed('submission_closed')) active @endif"
             data-toggle="tooltip" data-placement="bottom" title="Submission Closed"></div>
        <div class="status-progress-checkpoint @if($current_competition->hasStatusPassed('begin_judging')) active @endif"
             data-toggle="tooltip" data-placement="bottom" title="Begin Judging"></div>
        <div class="status-progress-checkpoint @if($current_competition->hasStatusPassed('judging_finished')) active @endif"
             data-toggle="tooltip" data-placement="bottom" title="Judging Finished"></div>
        <div class="status-progress-checkpoint @if($current_competition->hasStatusPassed('result_announced')) active @endif"
             data-toggle="tooltip" data-placement="bottom" title="Result Announced"></div>
        <div class="status-progress-checkpoint @if($current_competition->hasStatusPassed('over')) active @endif"
             data-toggle="tooltip" data-placement="bottom" title="Over"></div>
    </div>
</div>