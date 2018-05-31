@if(request()->user->mentor->accepted === 0)
    <div class="alert alert-primary" role="alert">
        <b>We have received your application to become a mentor!</b><br>
        You will receive an email once your application has been reviewed, and a decision has been made.
    </div>
@endif