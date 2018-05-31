<form action="{{ url('/portal/signup/teacher') }}" method="post">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6 pad-top">
            <label for="teacher-fullname">Full Name *</label>
            <input type="text" name="name" class="form-control inverted" id="teacher-fullname"/>
        </div>
        <div class="col-md-6 pad-top">
            <label for="teacher-email">Email Address (Work) *</label>
            <input type="email" name="email" class="form-control inverted" id="teacher-email"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 pad-top">
            <label for="teacher-subject">Teaching Subject *</label>
            <input type="text" name="teaching_subject" class="form-control inverted" id="teacher-subject"/>
        </div>
        <div class="col-md-6 pad-top">
            <label for="teacher-hear">How did you hear about ISLP? *</label>
            <input type="text" name="heard_from" class="form-control inverted" id="teacher-hear"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 pad-top">
            <label for="teacher-school">School Name *</label>
            <input type="text" name="school" class="form-control inverted" id="teacher-school"/>
        </div>
        <div class="col-md-6 pad-top">
            <label for="teacher-password">Choose a password for your account *</label>
            <input type="password" name="password" class="form-control inverted" id="teacher-password"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 pad-top">
            <label for="teacher-resources">Any additional resources required?</label>
            <input type="text" name="additional_resources" class="form-control inverted" id="teacher-resources"/>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-xl rounded-pill mt-5"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Register</button>
    <p class="signup-terms-service col-md-6">By clicking the register button, you agree to send the above information to ISLP poster competition organization committee.</p>
</form>