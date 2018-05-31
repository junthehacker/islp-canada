<form action="{{ url('/portal/signup/mentor') }}" method="post" style="display: none;" id="mentor-application-form">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6 pad-top">
            <label for="mentor-fullname">Full Name *</label>
            <input type="text" name="name" class="form-control inverted" id="mentor-fullname"/>
        </div>
        <div class="col-md-6 pad-top">
            <label for="mentor-email">Email Address (School) *</label>
            <input type="email" name="email" class="form-control inverted" id="mentor-email"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 pad-top">
            <label for="mentor-major">Major Area *</label>
            <input type="text" name="major_area" class="form-control inverted" id="mentor-major"/>
        </div>
        <div class="col-md-6 pad-top">
            <label for="mentor-school">School *</label>
            <input type="text" name="school" class="form-control inverted" id="mentor-school"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 pad-top">
            <label for="mentor-password">Choose a password for your account *</label>
            <input type="password" name="password" class="form-control inverted" id="mentor-password"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 pad-top">
            <label for="mentor-reason">Why do you want to become a mentor for ISLP poster competition? (around 750 characters)</label>
            <textarea type="text" name="reason" class="form-control inverted" id="mentor-reason"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-xl rounded-pill mt-5"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Submit Application</button>
    <p class="signup-terms-service col-md-6">By clicking the apply button, you agree to send the above information to ISLP poster competition organization committee. You will be notified by email once your application has been processed.</p>

</form>