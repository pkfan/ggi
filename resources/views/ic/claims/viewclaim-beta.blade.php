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
                <!-- Bordered table start -->
                <div class="row" id="table-bordered">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Claims Record</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Reference No.</th>
                                            <th>UserName</th>
                                            <th>Recovery Amount</th>
                                            <th>Accident Date</th>
                                            <th>Accident Location</th>
                                            <th>Debtor Type</th>
                                            <th>Claim no</th>
                                            <th>Debtor Number</th>
                                            <th>Status</th>
                                            <th>Submission Time</th>
                                            <th>Assign Admin</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                                @if($claim->deb_mob!=null)
                                                {{$claim->deb_mob}}
                                                @else
                                                Elm Case
                                                @endif
                                            </td>

                                            <td>
                                                    @if(claimstatus($claim->id)==2)
                                                        <span class="badge badge-primary">Collected</span>
                                                        @elseif(claimstatus($claim->id)==3)
                                                        <span class="badge badge-primary">Delay Payment</span>
                                                        @elseif(claimstatus($claim->id)==4)
                                                        <span class="badge badge-primary">Partial Payment</span>
                                                        @elseif(claimstatus($claim->id)==5)
                                                        <span class="badge badge-primary">Transfer to Morror</span>
                                                        @elseif(claimstatus($claim->id)==6)
                                                        <span class="badge badge-primary">Transfered To Lawyer</span>
                                                        @elseif(claimstatus($claim->id)==7)
                                                        <span class="badge badge-primary">Transfer To Finance Co.</span>
                                                        @elseif(claimstatus($claim->id)==8)
                                                        <span class="badge badge-primary">Transfer to ELM</span>
                                                        @elseif(claimstatus($claim->id)==9)
                                                        <span class="badge badge-primary">Transfer to IC</span>
                                                        @elseif(claimstatus($claim->id)==10)
                                                        <span class="badge badge-primary">Close</span>
                                                        @elseif(claimstatus($claim->id)==11)
                                                        <span class="badge badge-primary">Registered</span>
                                                        @elseif(claimstatus($claim->id)==12)
                                                        <span class="badge badge-danger">Closed</span>
                                                        @elseif(claimstatus($claim->id)==13)
                                                        <span class="badge badge-success">Collected</span>
                                                        @elseif(claimstatus($claim->id)==14)
                                                        <span class="badge badge-danger">Objection</span>
                                                        @elseif(claimstatus($claim->id)==15)
                                                        <span class="badge badge-danger">Refused</span>
                                                        @elseif(claimstatus($claim->id)==16)
                                                        <span class="badge badge-danger">Direct Pay</span>
                                                        @elseif(claimstatus($claim->id)==17)
                                                        <span class="badge badge-success">Approved</span>
                                                        @elseif(claimstatus($claim->id)==18)
                                                        <span class="badge badge-danger">Rejected</span>
                                                        @elseif(claimstatus($claim->id)==1)
                                                        <span class="bg-secondary">Follow up</span>
                                                        @elseif(claimstatus($claim->id)==19)
                                                        <span class="badge badge-success">Collected by Insurance</span>
                                                        @else
                                                        <span class="badge badge-danger">Undefined</span>

                                                    @endif
                                            </td>
                                            <td>
                                                {{$claim->created_at}}
                                            </td>
                                            <td>
                                                @if($claim->is_assign)
                                                    {{username($claim->is_assign)->name}}
                                                    @else
                                                    N/A
                                                    @endif
                                            </td>
                                            <td>
                                            <a  href="{{url('/ic/claim/detail/'.$claim->id)}}" class="btn btn-outline-primary" target="_blank">View Details</a>
                                            </td>

                                            <!-- <td>
                                            <a href="{{asset($doc)}}" download="{{asset($doc)}}" target="_black">Document</a>
                                            </td> -->
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Bordered table end -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record modal-content pt-0">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                        <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" aria-label="John Doe" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-post">Post</label>
                                        <input type="text" id="basic-icon-default-post" class="form-control dt-post" aria-label="Web Developer" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-email">Email</label>
                                        <input type="text" id="basic-icon-default-email" class="form-control dt-email" aria-label="john.doe@example.com" />
                                        <small class="form-text text-muted"> You can use letters, numbers & periods </small>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-date">Joining Date</label>
                                        <input type="text" class="form-control dt-date" id="basic-icon-default-date" aria-label="MM/DD/YYYY" />
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="form-label" for="basic-icon-default-salary">Salary</label>
                                        <input type="text" id="basic-icon-default-salary" class="form-control dt-salary" aria-label="$12000" />
                                    </div>
                                    <button type="button" class="btn btn-primary data-submit mr-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!--/ Basic table -->
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
