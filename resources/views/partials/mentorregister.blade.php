<form style="display: none;" id="mentor-application-form">
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
    <br>
    <div class="alert alert-danger hidden" id="mentor-application-error"></div>
    <button type="button" id="submit-mentor-application-button" onclick="submitMentorApplication()" class="btn btn-primary btn-xl rounded-pill mt-5"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Submit Application</button>
    <p class="signup-terms-service col-md-6">By clicking the apply button, you agree to send the above information to ISLP poster competition organization committee. You will be notified by email once your application has been processed.</p>

</form>

<script>
    function submitMentorApplication(){
        let data = {
            name: $("#mentor-fullname").val(),
            email: $("#mentor-email").val(),
            major_area: $("#mentor-major").val(),
            school: $("#mentor-school").val(),
            password: $("#mentor-password").val(),
            reason: $("#mentor-reason").val()
        };

        let currentButtonText = $("#submit-mentor-application-button").html();
        $("#mentor-application-error").slideUp();

        $("#submit-mentor-application-button").html("<i class=\"fa fa-circle-o-notch fa-spin\" aria-hidden=\"true\"></i>");

        $.post("{{ url('api/mentor') }}", data, function(result){
            if(result !== 'ok'){
                $("#mentor-application-error").html(result);
                $("#mentor-application-error").slideDown();
            } else {
                alert("Registration successful, you can now login to your account to check your application status.");
            }
            $("#submit-mentor-application-button").html(currentButtonText);
        });

        console.log(data);
    }
</script>