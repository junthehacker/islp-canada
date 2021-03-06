<div class="modal fade" tabindex="-1" role="dialog" id="addPosterModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit New Poster</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/portal/posters/create">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label><b>Title</b></label>
                        <input type="text" name="title" placeholder="Title" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label><b>Student Name</b></label>
                        <input type="text" name="student_name" placeholder="Student Name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label><b>Group</b></label>
                        <select type="text" name="group" placeholder="Group" class="form-control">
                            <option value="lower_secondary">Lower Secondary (15 years old or younger)</option>
                            <option value="upper_secondary">Upper Secondary (18 years old or younger)</option>
                            <option value="undergraduate">Undergraduate (Students currently pursuing Bachelor's degree)</option>
                        </select>
                    </div>
                    <input type="hidden" id="submission_image_input" name="image_base64" value="" />
                    <label><b>Image File (< 4GB)</b></label><br>
                    <input type="file" id="submission_image_file" />
                    <div id="submission_image_preview"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function getBase64(file, callback) {
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            callback(reader.result);
        };
        reader.onerror = function (error) {
            console.log('Error: ', error);
        };
    }

    $("#submission_image_file").on('change', function(){
        let file = document.querySelector('#submission_image_file').files[0];
        getBase64(file, function(base64){
            $("#submission_image_preview").html("");
            let imageElement = $("<img />");
            imageElement.attr('src', base64);
            $("#submission_image_input").val(base64);
            imageElement.css('max-width', "100%");
            $("#submission_image_preview").append(imageElement);
        });

    });
</script>