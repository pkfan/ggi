@props([
    'id'=>'searchFilterIdHere'
])


<div class="form-modal-ex">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
        data-target="#{{$id}}">
        <svg
                xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-search">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65">
                </line>
            </svg>
        Search
    </button>

    <!-- filter search Modal -->
    <div class="modal fade text-left" id="{{$id}}" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Search By</h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- Form data for modal render here  --}}
                {{$slot}}
            </div>
        </div>
    </div>
</div>
