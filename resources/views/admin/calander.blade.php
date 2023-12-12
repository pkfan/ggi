@extends('layout.master')

@section('title', 'Calendar')


@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Full calendar start -->
            <section>
                <div class="app-calendar overflow-hidden border">
                    <div class="row no-gutters">
                        <!-- Sidebar -->

                        <!-- /Sidebar -->

                        <!-- Calendar -->
                        <div class="col position-relative">
                            <div class="card shadow-none border-0 mb-0 rounded-0">
                                <div class="card-body pb-0">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /Calendar -->
                        <div class="body-content-overlay"></div>
                    </div>
                </div>
                <!-- Calendar Add/Update/Delete event modal-->
                <div class="modal modal-slide-in event-sidebar fade" id="modal">
                    <div class="modal-dialog sidebar-lg">
                        <div class="modal-content p-0">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                            <div class="modal-header mb-1">
                                <h5 class="modal-title">Add Event</h5>
                            </div>
                            <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                <!-- <form class="event-form needs-validation"> -->
                                <div class="form-group">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required />
                                </div>
                                <button class="btn btn-primary" id="saveBtn">Add</button>
                                <!-- <div class="form-group">
                                        <label for="select-label" class="form-label">Label</label>
                                        <select class="select2 select-label form-control w-100" id="select-label" name="select-label">
                                            <option data-label="primary" value="Business" selected>Business</option>
                                            <option data-label="danger" value="Personal">Personal</option>
                                            <option data-label="warning" value="Family">Family</option>
                                            <option data-label="success" value="Holiday">Holiday</option>
                                            <option data-label="info" value="ETC">ETC</option>
                                        </select>
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="start-date" class="form-label">Start Date</label>
                                        <input type="text" class="form-control" id="start-date" name="start-date" />
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="end-date" class="form-label">End Date</label>
                                        <input type="text" class="form-control" id="end-date" name="end-date" />
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input allDay-switch" id="customSwitch3" />
                                            <label class="custom-control-label" for="customSwitch3">All Day</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="event-url" class="form-label">Event URL</label>
                                        <input type="url" class="form-control" id="event-url" />
                                    </div>
                                    <div class="form-group select2-primary">
                                        <label for="event-guests" class="form-label">Add Guests</label>
                                        <select class="select2 select-add-guests form-control w-100" id="event-guests" multiple>
                                            <option data-avatar="1-small.png" value="Jane Foster">Jane Foster</option>
                                            <option data-avatar="3-small.png" value="Donna Frank">Donna Frank</option>
                                            <option data-avatar="5-small.png" value="Gabrielle Robertson">Gabrielle
                                                Robertson</option>
                                            <option data-avatar="7-small.png" value="Lori Spears">Lori Spears</option>
                                            <option data-avatar="9-small.png" value="Sandy Vega">Sandy Vega</option>
                                            <option data-avatar="11-small.png" value="Cheryl May">Cheryl May</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="event-location" class="form-label">Location</label>
                                        <input type="text" class="form-control" id="event-location" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea name="event-description-editor" id="event-description-editor" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group d-flex">
                                        <button type="submit" class="btn btn-primary add-event-btn mr-1">Add</button>
                                        <button type="button" class="btn btn-outline-secondary btn-cancel" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary update-event-btn d-none mr-1">Update</button>
                                        <button class="btn btn-outline-danger btn-delete-event d-none">Delete</button>
                                    </div> -->
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Calendar Add/Update/Delete event modal-->
            </section>
            <!-- Full calendar end -->

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@push('calander-css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> -->
<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
<!-- END: Vendor CSS-->
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
<!-- END: Page CSS-->
@endpush

@push('calander-js')
<!-- BEGIN: Page Vendor JS-->
{{-- <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script> --}}
<script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('app-assets/js/scripts/pages/app-calendar-events.js') }}"></script>
{{-- <script src="{{ asset('app-assets/js/scripts/pages/app-calendar-zee.js')}}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<!-- END: Page JS-->
<script>
    
    $(document).ready(function(){
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        // var events = {!! json_encode($events_array) !!},
        var events = @json($events_array);

        $('#calendar').fullCalendar({

            header: {
                left: 'prev,next',
                center: 'title',
            },
            events: events,
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDays) {
                $('#modal').modal('toggle');

                $('#saveBtn').click(function() {
                    var title = $('#title').val();
                    // console.log(title);
                    var start_date = moment(start).format('YYYY-MM-DD');
                    var end_date = moment(end).format('YYYY-MM-DD');

                    $.ajax({
                        url: '{{route("supervisor.events.store")}}',
                        type: "POST",
                        dataType: "json",
                        data: {
                            title,
                            start_date,
                            end_date
                        },
                        success: function(response) {
                            console.log(response.message);
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                });
            },

        })    
    });
</script>
@endpush