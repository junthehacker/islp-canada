<div class="modal fade" tabindex="-1" role="dialog" id="addUserModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="/portal/users/create">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label><b>Email Address</b></label>
                        <input type="text" name="email" placeholder="Email Address" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label><b>Password</b></label>
                        <button class="btn btn-link" onClick="generateRandomPassword()" type="button">Generate</button>
                        <input type="text" id="add-user-modal-password" name="password" placeholder="Password" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label><b>User Role</b></label>
                        <div class="text-muted small pb-1">To create teacher or mentor accounts, please instruct the user to sign-up on landing page. Admin have the exact same privilege as your account, create with caution!</div>
                        <select name="role" class="form-control">
                            <option value="0">Admin</option>
                            <option value="2">Judge</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function generateRandomPassword(){
        $("#add-user-modal-password").val(Math.random().toString(36).substring(7) + Math.random().toString(36).substring(7));
    }
</script>