@props([
    'id' => 'modal-id-here',
])

<div class="modal fade text-left" id="{{ $id }}" tabindex="-1" aria-labelledby="myModalLabel33"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Add New Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('admin.settings.role.create')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Role Name/Code*: </label>
                        <div class="form-group">
                            <input type="text" name='name' class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Role Display Name*: </label>
                        <div class="form-group">
                            <input type="text" name='display_name' class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Role Discription:</label>
                        <textarea class="form-control" name='description' id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>


                </div>
                <div class="modal-footer">
                    <button
                        type="submit"
                        class="btn btn-primary waves-effect waves-float waves-light"
                    >
                        create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
