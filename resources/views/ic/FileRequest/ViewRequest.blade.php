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
                                <div class="row-sm-10"><div class="col-sm-12">
                                    <table id="example2" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="example2_info">
                                <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 91.5312px;">Sr No.</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Name: activate to sort column ascending" style="width: 184.875px;">Company Name</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Recovery Amount: activate to sort column ascending" style="width: 207.109px;">Claim Number</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Accident Date: activate to sort column ascending" style="width: 167.125px;">Comments</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Accident Location: activate to sort column ascending" style="width: 211.656px;">Files</th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="2" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 104.891px;">Status</th>
                            </tr>
                                </thead>
                                <tbody>
                            <?php
                            $count=1;
                            ?>
                                @foreach($files as $file)
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{company($file->company_id)->name}}</td>
                                    <td>{{str_replace("-","/",$file->claim_no) }}</td>
                                    <td>{{$file->comments}}</td>
                                    @if(isJson($file->document)=='True')
                                    <?php
                                    $document=json_decode($file->document);
                                    $count1=1;
                                    ?>
                                    <td>
                                        @foreach( $document as $doc)

                                        <a href="{{asset($doc)}}" target="_blank">View File{{$count1}}</a><br>
                                        <?php
                                        $count1++;
                                        ?>
                                        @endforeach
                                    </td>
                                    @else
                                    <td><a href="{{asset($file->document)}}" target="_blank">View File</a></td>

                                    @endif

                                    <td>
                                        @if($file->status==1)
                                        <a href="#" class="btn btn-danger">Pending For Action</a>
                                        @elseif($file->status==2)
                                        <a href="#" class="btn btn-success">Accepted</a>
                                        @else
                                        <a href="#" class="btn btn-danger">Rejected</a>

                                        @endif
                                    </td>
                                </tr>
                                <?php
                                    $count++;
                                    ?>
                                @endforeach
                        </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 2 of 2 entries</div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled" id="example2_previous">
                                        <a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Prev</a>
                                    </li>
                                    <li class="paginate_button page-item active">
                                        <a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                    </li>
                                    <li class="paginate_button page-item next disabled" id="example2_next">
                                        <a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<x-ic::footer/>
</body>
</html>
