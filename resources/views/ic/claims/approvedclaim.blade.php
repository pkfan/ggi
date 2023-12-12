<!DOCTYPE html>
<html lang="en">
<x-ic::head/>

<body>
<x-ic::header/>
<x-ic::sidebar/>
    <div class="app-content content ">
        <div class="page-wrapper">
            <div class="page-content">
                <h6 class="mb-0 text-uppercase">Approved claim Requests</h6>
                <hr>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dt-buttons btn-group">
                                            <button class="btn btn-outline-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example2" type="button">
                                                <span>Copy</span>
                                            </button>
                                            <button class="btn btn-outline-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example2" type="button">
                                                <span>Excel</span>
                                            </button>
                                            <button class="btn btn-outline-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example2" type="button">
                                                <span>PDF</span>
                                            </button>
                                            <button class="btn btn-outline-secondary buttons-print" tabindex="0" aria-controls="example2" type="button">
                                                <span>Print</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="example2_filter" class="dataTables_filter">
                                            <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example2"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row"><div class="col-sm-12">
                                    <table id="example2" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="example2_info">
                                <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 91.5312px;">ID</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Name: activate to sort column ascending" style="width: 184.875px;">Company Name</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Recovery Amount: activate to sort column ascending" style="width: 207.109px;">Recovery Amount</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Accident Date: activate to sort column ascending" style="width: 167.125px;">Accident Date</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Accident Location: activate to sort column ascending" style="width: 211.656px;">Accident Location</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Debtor Type: activate to sort column ascending" style="width: 146.766px;">Debtor Type</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 104.891px;">Status</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 164.047px;">Action</th>
                            </tr>
                                </thead>
                                    <tbody>
                                        @if (count($claims) > 0)
                                            @foreach($claims as $claim)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">GGI00{{$claim->id}}</td>
                                                    <td>{{getCompanyById($claim->company_id)->name}}</td>
                                                    <td>{{$claim->amount_after_discount}}</td>
                                                    <td>{{$claim->acc_date}}</td>
                                                    <td>{{$claim->acc_location}}</td>
                                                    <td>{{$claim->deb_type}}</td>
                                                    <td>
                                                        @if ($claim->status == 1)
                                                            <span class="bg-success p-2 mt-3 text-light rounded">Approved</span>
                                                        @endif
                                                    </td>
                                                    @php($doc=DB::table('supported-doc')->where('company_id',$claim->cid)->pluck('doc_name')->first())
                                                    <td>
                                                        <a class="btn btn-outline-gradient" href="https://recovery.taheiya.sa/ic/claim/detail/{{$claim->id}}" target="_blank">View Details</a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else

                                        @endif
                                    </tbody>
                            </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 2 of 2 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Prev</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<x-ic::footer/>
</body>
</html>
