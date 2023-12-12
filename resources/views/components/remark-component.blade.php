<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Art Remark</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                  
             
                
            <div class="modal-body">
                    <form method="post" action="{{url('edit-art-remark')}}">
                        @csrf
                        <input name="claim_id" value="{{$claimId->id}}" type="hidden">
                        <label class="form-label">Art Remark</label>
                        <input value="{{ $claimId->claimData?->remarks }}" class="form-control" name="remark">
                        <br>
                        <button class="btn btn-primary">Submit</button>
                    </form>
            </div>
        </div>
    </div>
</div>