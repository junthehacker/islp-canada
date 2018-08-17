<form id="teacher-application-form">
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
    <br>
    <div class="alert alert-danger hidden" id="teacher-application-error"></div>
    <button type="button" id="submit-teacher-application-button" class="btn btn-primary btn-xl rounded-pill mt-5" onclick="submitTeacherApplication();">
        <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Register
    </button>
    <p class="signup-terms-service col-md-6">By clicking the register button, you agree to send the above information to ISLP poster competition organization committee.</p>
</form>
<div class="alert alert-success hidden" id="teacher-application-success">
    Registration successful, click <a href="{{ url('/portal/login') }}">here to login to your new account</a>.<br/>
    Or you can login later by clicking on the [Portal] link in navigation.
</div>


<script>
    function submitTeacherApplication(){
        let data = {
            name: $("#teacher-fullname").val(),
            email: $("#teacher-email").val(),
            teaching_subject: $("#teacher-subject").val(),
            heard_from: $("#teacher-hear").val(),
            school: $("#teacher-school").val(),
            password: $("#teacher-password").val(),
            additional_resources: $("#teacher-resources").val()
        };

        let currentButtonText = $("#submit-teacher-application-button").html();
        $("#teacher-application-error").slideUp();

        $("#submit-teacher-application-button").html("<i class=\"fa fa-circle-o-notch fa-spin\" aria-hidden=\"true\"></i>");

        $.post("{{ url('api/teacher') }}", data, function(result){
            if(result !== 'ok'){
                $("#teacher-application-error").html(result);
                $("#teacher-application-error").slideDown();
            } else {
                // TODO: Add link to login page
                $("#teacher-application-form").slideUp();
                $("#teacher-application-success").slideDown();
            }
            $("#submit-teacher-application-button").html(currentButtonText);
        });

    }
</script>