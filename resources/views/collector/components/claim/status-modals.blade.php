{{-- delay settlement modal  --}}
<div class="modal fade" id="delayDatemodal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{url('admin/delay-edit')}}" method="post">
                @csrf
            <div class="modal-body">
                <div class="mb-3">

                    <input id="delayid" type="hidden" name="id">
                    <h4>Edit Date</h4>

                    <input type="datetime-local" class="form-control" name="delayeddate" id="editpartial" required>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary" >Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>

{{-- edit partial date  --}}
<div class="modal fade" id="partialDate" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Settlement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{url('admin/partial-edit')}}" method="post">
                @csrf
            <div class="modal-body">
                <div class="mb-3">

                    <input id="partialid" type="hidden" name="id">
                    <label class="form-label">Edit Date</label>
                    <input type="datetime-local" class="form-control" name="partialeddate" id="editpartial" >
                    <label class="form-label">Amount</label>
                    <input type="text" name="paramt" id="paramt" class="form-control">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary" >Submit</button>
            </div>
        </form>
        </div>
    </div>
</div>
