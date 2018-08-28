<div class="row">
    <div class="col-md-6">
        <h5>Pending</h5>
        <ul class="checklist">

            @if($competition->status === 'begin_judging')
                <li>
                    <input type="checkbox" disabled /> Has the judging deadline passed yet? Don't forget to close judging by changing the competition status to Judging Finished.
                </li>
            @endif

            @if($competition->status === 'submission_closed')
                <li>
                    <input type="checkbox" disabled />  Ready to start judging? Change the competition status to Begin Judging so judges can access score-sheets.
                </li>
                <li>
                    <input type="checkbox" disabled /> You need to assign judges before you can begin the judging process.
                </li>
            @endif

            @if($competition->status === 'accept_submissions')
                <li><input type="checkbox" disabled /> Have the submission deadline passed yet? Don't forget to change the competition status to Submission Closed.</li>
            @endif

            @if($competition->status === 'new')
                <li><input type="checkbox" disabled /> This is a new competition, submission is not open, start accepting submissions by changing the status to Accept Submissions.</li>
            @endif

            <li><input type="checkbox" disabled /> Seems like you don't have rubric yet, you must have a rubric before judges can start judging.</li>
        </ul>
    </div>
    <div class="col-md-6">
        <h5>Done</h5>
        <ul class="checklist">


            @if($competition->status !== 'accept_submissions' && $competition->status !== 'new' && $competition->status !== 'submission_closed')
                <li class="checked">
                    <input type="checkbox" disabled checked /> Judging has began.
                </li>
            @endif

            @if($competition->status !== 'accept_submissions' && $competition->status !== 'new')
                <li class="checked">
                    <input type="checkbox" disabled checked /> Submissions are now closed.
                </li>
            @endif

            @if($competition->status !== 'new')
                <li class="checked">
                    <input type="checkbox" disabled checked /> You are now accepting submissions.
                </li>
            @endif
            <li class="checked"><input type="checkbox" checked disabled /> New competition is created.</li>
        </ul>
    </div>
</div>