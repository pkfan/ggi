@props([
    'id' => 'modal-id-here',
])



<div class="modal fade text-left" id="{{ $id }}" tabindex="-1" aria-labelledby="myModalLabel33"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Edit Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('admin.settings.role.update')}}" method="POST">
                @csrf
                <input type="hidden" name="role_id" id="user-role-id-form" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Role Name/Code*: </label>
                        <div class="form-group">
                            <input type="text" placeholder="art-manager" name='name' id="update-role-name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Role Display Name*: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Art Manager" name='display_name' id="update-role-display-name"  class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="update-description">Role Description:</label>
                        <textarea class="form-control" name='description' id="update-description" rows="3" placeholder="write role description "></textarea>
                    </div>


                </div>
                <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn-primary waves-effect waves-float waves-light"
                    >
                        update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function updateUserRole(event){
        console.log('updateUserRole called data : ', event);
        var userRoleId = event.getAttribute('user-role-id');
        var roleName = event.getAttribute('role-name');
        var roleDisplayName = event.getAttribute('role-display-name');
        var roleDescription = event.getAttribute('role-description');
        // window.userRoleId = event;
        console.log('userRoleId', userRoleId);
        console.log('roleDescription', roleDescription);
        document.querySelector('#user-role-id-form').value = userRoleId;
        document.querySelector('#update-role-name').value = roleName;
        document.querySelector('#update-role-display-name').value = roleDisplayName;
        document.querySelector('#update-description').value = roleDescription;
    }
</script>
