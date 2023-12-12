@extends('layout.master')
@section('title', 'All Transaction')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0"></h2>

                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <h4> @lang('language.ONLINE PAY HISTORY')

                        </h4>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">


                                <div class=" col-md-6  mb-1">

                                    <div class="btn-group">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-share font-small-4 mr-50">
                                                    <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                                    <polyline points="16 6 12 2 8 6"></polyline>
                                                    <line x1="12" y1="2" x2="12" y2="15">
                                                    </line>
                                                </svg> Export
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <button class=" buttons-print dropdown-item btn-outline-none " tabindex="0"
                                                aria-controls="DataTables_Table_0" type="button"><span><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-printer font-small-4 mr-50">
                                                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                                        <path
                                                            d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                                        </path>
                                                        <rect x="6" y="14" width="12" height="8">
                                                        </rect>
                                                    </svg>Print</span></button>
                                            <button class="dt-button buttons-csv buttons-html5 dropdown-item" tabindex="0"
                                                aria-controls="DataTables_Table_0" type="button"><span><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-file-text font-small-4 mr-50">
                                                        <path
                                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                        </path>
                                                        <polyline points="14 2 14 8 20 8"></polyline>
                                                        <line x1="16" y1="13" x2="8" y2="13">
                                                        </line>
                                                        <line x1="16" y1="17" x2="8" y2="17">
                                                        </line>
                                                        <polyline points="10 9 9 9 8 9"></polyline>
                                                    </svg>Csv</span></button>
                                            <button class="dt-button buttons-excel buttons-html5 dropdown-item"
                                                tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-file font-small-4 mr-50">
                                                        <path
                                                            d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z">
                                                        </path>
                                                        <polyline points="13 2 13 9 20 9"></polyline>
                                                    </svg>Excel</span></button>
                                            <button class="dt-button buttons-pdf buttons-html5 dropdown-item"
                                                tabindex="0" aria-controls="DataTables_Table_0"
                                                type="button"><span><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-clipboard font-small-4 mr-50">
                                                        <path
                                                            d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                                        </path>
                                                        <rect x="8" y="2" width="8"
                                                            height="4" rx="1" ry="1"></rect>
                                                    </svg>Pdf</span></button>
                                            <button class="dt-button buttons-copy buttons-html5 dropdown-item"
                                                tabindex="0" aria-controls="DataTables_Table_0"
                                                type="button"><span><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="feather feather-copy font-small-4 mr-50">
                                                        <rect x="9" y="9" width="13"
                                                            height="13" rx="2" ry="2"></rect>
                                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1">
                                                        </path>
                                                    </svg>Copy</span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search"
                                            aria-describedby="button-addon2" />
                                        <div class="input-group-append" id="button-addon2">
                                            <button class="btn btn-outline-primary" type="button"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-search">
                                                    <circle cx="11" cy="11" r="8"></circle>
                                                    <line x1="21" y1="21" x2="16.65" y2="16.65">
                                                    </line>
                                                </svg></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-nowrap">Claim Id</th>
                                            <th scope="col" class="text-nowrap">Screenshot</th>
                                            {{-- <th scope="col" class="text-nowrap">Amount</th>
                                            <th scope="col" class="text-nowrap">Paid Date</th> --}}
                                            <th scope="col" class="text-nowrap">Verified by</th>
                                            {{-- <th scope="col" class="text-nowrap">Debtor Ip</th> --}}
                                            <th scope="col" class="text-nowrap">Status</th>
                                            <th scope="col" class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($debtorBankTransfers as $debtorBankTransfer)
                                        <tr>

                                            <td>GGI00{{$debtorBankTransfer->claim_id}}</td>
                                            <td>
                                                <a href="/storage/{{$debtorBankTransfer->screenshot}}"
                                                    style="font-weight: 600; text-decoration: underline;"
                                                    target="_blank"
                                                >
                                                    view bank slip
                                                </a>

                                            </td>
                                            {{-- <td>{{$debtorBankTransfer->amount}}</td>
                                            <td>{{$debtorBankTransfer->paid_at}}</td> --}}
                                            <td>{{$debtorBankTransfer->verifier?->name ?? 'N/A'}}</td>
                                            {{-- <td>{{$debtorBankTransfer->debtor_ip}}</td> --}}
                                            {{-- staus --}}
                                            <td>
                                                @if($debtorBankTransfer->status == \App\Enums\BankSlipStatus::UNVERIFIED->value)
                                                    <span style="  background: #ffbebe;  font-weight: 600; padding: 8px; border-radius: 50%; font-size:12px">
                                                        unverified
                                                    </span>
                                                @else
                                                    <span style="  background: #beffcf;  font-weight: 600; padding: 8px; border-radius: 50%; font-size:12px">
                                                        verified
                                                    </span>
                                                @endif


                                            </td>
                                            {{-- action  --}}
                                            <td>
                                                <div class="btn-group dropleft" style="cursor: pointer;">
                                                    <div data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path></svg>                                                            </div>
                                                    <div class="dropdown-menu" style="">
                                                        <a class="dropdown-item" href="{{route('admin.transaction-history.status',['debtor_bank_slip_id'=>$debtorBankTransfer->id,'status'=>'verify'])}}">Verify</a>
                                                        <a class="dropdown-item" href="{{route('admin.transaction-history.status',['debtor_bank_slip_id'=>$debtorBankTransfer->id,'status'=>'unverify'])}}">Unverify</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Basic Tables end -->



            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
