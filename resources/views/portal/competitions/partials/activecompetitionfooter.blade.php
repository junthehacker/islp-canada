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
        <button type="submit" class="btn btn-primary">Advance to {{ $current_competition->getNextStatusName() }}</button>
    </form>
@endif

@if($current_competition->status !== 'new')
    <form action="{{ url('portal/competitions/status/update/' . $current_competition->id) }}" method="post" style="display: inline;">
        {{ csrf_field() }}
        <input name="status" value="{{ $current_competition->getPrevStatus() }}" type="hidden" />
        <button type="submit" class="btn btn-link">Revert to {{ $current_competition->getPrevStatusName() }}</button>
    </form>
@endif
