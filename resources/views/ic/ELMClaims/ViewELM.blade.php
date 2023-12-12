<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<x-ic::head/>

<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

     <x-ic::Header/>

    <!-- END: Header-->


    <x-ic::sidebar/>

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="app-user-list">
                    <!-- users filter start -->
                    <!-- <div class="card">
                        <h5 class="card-header">Search Filter</h5>
                        <div class="d-flex justify-content-between align-items-center mx-50 row pt-0 pb-2">
                            <div class="col-md-4 user_role"></div>
                            <div class="col-md-4 user_plan"></div>
                            <div class="col-md-4 user_status"></div>
                        </div>
                    </div> -->
                    <!-- users filter end -->
                    <!-- list section start -->
                    <div class="card">
                        <div class="card-datatable table-responsive pt-0">
                            <table class="user-list-table table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Reference No.</th>
                                        <th>Company Name</th>
                                        <th>Recovery Amount</th>
                                        <th>Accident Date</th>
                                        <th>Accident Location</th>
                                        <th>Debtor Type</th>
                                        <th>Campany Claim no</th>
                                        <th>Status</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                @foreach($claims as $claim)
                                    <?php
                                    $company=DB::table('users')->where('id',$claim->cid)->pluck('name')->first();
                                    $debter=DB::table('users')->where('id',$claim->deb_id)->pluck('name')->first();
                                    $doc=DB::table('supported-doc')->where('company_id',$claim->cid)->pluck('doc_name')->first();
                                    ?>
                                    <tr>
                                        <td>
                                            GGI00{{$claim->id}}
                                        </td>
                                        <td>
                                            {{$company}}
                                        </td>
                                        <td>
                                        {{$claim->amount_after_discount}}
                                        </td>
                                        <td>
                                            {{$claim->acc_date}}
                                        </td>
                                        <td>
                                            {{$claim->acc_location}}
                                        </td>
                                        <!-- <?php
                                                $reason=DB::table('reasons')->where('id',$claim->rec_reason)->pluck('description')->first();
                                            ?>
                                        <td>
                                            {{$reason}}
                                        </td> -->
                                        <td>
                                            {{$claim->deb_type}}
                                        </td>
                                        <td>
                                            {{$claim->claim_no}}
                                        </td>

                                        <td>
                                            <!--@if($claim->status==0)-->
                                            <!--<span class="badge bg-danger">Not viewed</span>-->
                                            <!--@elseif($claim->status==1)-->
                                            <!--<span class="badge bg-success">Approved</span>-->
                                            <!--@elseif($claim->status==2)-->
                                            <!--<span class="badge bg-danger">Rejected</span>-->
                                            <!--@endif-->
                                                @if ($claim->status == 0)
                                                    <span class="badge badge-primary">Registered</span>
                                                    @elseif($claim->status==1 && objectionStatus($claim->id)==1)
                                                    <span class="badge badge-danger">Objection</span>
                                                    @elseif($claim->status==1 && objectionStatus($claim->id)==2)
                                                    <span class="badge badge-danger">Refused</span>
                                                    @elseif($claim->status==1 && objectionStatus($claim->id)==3)
                                                    <span class="badge badge-danger">Direct Pay</span>
                                                    @elseif($claim->status==1)
                                                    <span class="badge badge-success">Approved</span>
                                                    @elseif($claim->status==2)
                                                    <span class="badge badge-danger">Rejected</span>


                                                @endif
                                        </td>
                                        <td>
                                        <a  href="{{url('/ic/elm/claim/detail/'.$claim->id)}}" class="btn btn-outline-primary" target="_blank">View Details</a>
                                        </td>

                                        <!-- <td>
                                        <a href="{{asset($doc)}}" download="{{asset($doc)}}" target="_black">Document</a>
                                        </td> -->
                                    </tr>
                                    @endforeach
                            </table>
                        </div>
                        <!-- Modal to add new user starts-->
                        <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
                            <div class="modal-dialog">
                                <form class="add-new-user modal-content pt-0">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                    <div class="modal-header mb-1">
                                        <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                                    </div>
                                    <div class="modal-body flex-grow-1">
                                        <div class="form-group">
                                            <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                            <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" name="user-fullname" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="basic-icon-default-uname">Username</label>
                                            <input type="text" id="basic-icon-default-uname" class="form-control dt-uname" aria-label="jdoe1" aria-describedby="basic-icon-default-uname2" name="user-name" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="basic-icon-default-email">Email</label>
                                            <input type="text" id="basic-icon-default-email" class="form-control dt-email" aria-label="john.doe@example.com" aria-describedby="basic-icon-default-email2" name="user-email" />
                                            <small class="form-text text-muted"> You can use letters, numbers & periods </small>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="user-role">User Role</label>
                                            <select id="user-role" class="form-control">
                                                <option value="subscriber">Subscriber</option>
                                                <option value="editor">Editor</option>
                                                <option value="maintainer">Maintainer</option>
                                                <option value="author">Author</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="user-plan">Select Plan</label>
                                            <select id="user-plan" class="form-control">
                                                <option value="basic">Basic</option>
                                                <option value="enterprise">Enterprise</option>
                                                <option value="company">Company</option>
                                                <option value="team">Team</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-1 data-submit">Submit</button>
                                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Modal to add new user Ends-->
                    </div>
                    <!-- list section end -->
                </section>
                <!-- users list ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <x-ic::footer />
</body>
<!-- END: Body-->

</html>
