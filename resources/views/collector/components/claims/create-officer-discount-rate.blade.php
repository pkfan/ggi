@props([
    'id' => 'modal-id-here',
])

<div class="modal fade text-left" id="{{ $id }}" tabindex="-1" aria-labelledby="myModalLabel33"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Create Officer Discount</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('supervisor.officer.discount.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    @php
                        $officers = \App\Models\User::whereHasRole('officer')->get();
                    @endphp
                    <div class="form-group">
                        <label>Select Officer: </label>
                        <div data-select2-id="187" class=" ">
                            <div class="position-relative " data-select2-id="186" style=" border: 1px solid #82868b;border-radius: 4px;">
                                <select name='officer_id' class=" select2 btn btn-outline-secondary btn-sm waves-effect form-control select2-hidden-accessible dropdown-toggle" data-select2-id="16"
                                    tabindex="-1" aria-hidden="true">
                                    <option value="" data-select2-id="all">--select officer--</option>
                                    @foreach ($officers as $officer)
                                        <option value="{{$officer->id}}" data-select2-id="{{$officer->id}}">{{$officer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Discount (%): </label>
                        <div class="form-group">
                            <input type="text" name='discount' class="form-control">
                        </div>
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
