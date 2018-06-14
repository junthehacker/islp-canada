<div class="modal fade" tabindex="-1" role="dialog" id="addUserModal" aria-hidden="true">
    <div class="modal-dialog">
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
                        <label>Email Address</label>
                        <input type="text" name="email" placeholder="Email Address" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
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