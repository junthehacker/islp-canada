<?php
/* Footer for active competition card.
 * This partial requires that $current_competition, which is a Competition object being set.
 *
 * Author(s): Jun Zheng (me@jackzh.com)
 */
?>


@if($current_competition->status !== 'over')
    <form action="{{ url('portal/competitions/status/update/' . $current_competition->id) }}" method="post" style="display: inline;">
        {{ csrf_field() }}
        <input name="status" value="{{ $current_competition->getNextStatus() }}" type="hidden" />
        <button type="submit" class="btn btn-primary">
            Advance to {{ $current_competition->getNextStatusName() }}
            @if($current_competition->status === 'submission_closed')
                <span data-toggle="tooltip" data-placement="top" title="By advancing, rubric management will be disabled, please make sure the rubric is correct before proceeding.">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                </span>
            @endif
        </button>
    </form>
@endif

@if($current_competition->status !== 'new')
    <form action="{{ url('portal/competitions/status/update/' . $current_competition->id) }}" method="post" style="display: inline;">
        {{ csrf_field() }}
        <input name="status" value="{{ $current_competition->getPrevStatus() }}" type="hidden" />
        <button type="submit" class="btn btn-link">
            Revert to {{ $current_competition->getPrevStatusName() }}
            @if($current_competition->status === 'begin_judging')
                <span data-toggle="tooltip" data-placement="top" title="By reverting, you will be able to edit rubric again, however you will lose all judging results for this competition.">
                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                </span>
            @endif
        </button>
    </form>
@endif
