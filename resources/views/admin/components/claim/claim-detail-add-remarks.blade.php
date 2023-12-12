@props([
    'claim' => null,
    'status' => null,
])


@permission('add-remark')
    <div class="col-md-12">
        <form action="{{ url('admin/add/remarks') }}" method="post">
            @csrf
            <div class="form-group py-1">
                <input type="hidden" name="claim_id" value="{{ $claim->id }}">
                <label for="inputLastName" class="form-label">Remarks</label>
                <select class="form-control" name="remarks" required="">
                    <option value="">Select Remarks</option>
                    <option value="Postpone The payment. طلب تأجيل السداد">Postpone
                        The payment. طلب تأجيل السداد</option>
                    <option value="Ask for Discount طلب خصم">Ask for Discount طلب
                        خصم</option>
                    <option value="Refuse to Pay.  رفض التسوية والدفع">Refuse to
                        Pay. رفض التسوية والدفع</option>
                    <option value="No Answer العميل لا يجيب على الاتصال">No
                        Answerالعميل لا يجيب على الاتصال</option>
                    <option value="Mobile No. is not Correct.رقم الجوال غير صحيح">
                        Mobile No. is not Correct.رقم الجوال غير صحيح</option>
                    <option value="Debtor Has valid Insurance.العميل يفيد بوجود تأمين ساري المفعول">
                        Debtor Has valid Insurance.العميل يفيد بوجود تأمين ساري
                        المفعول</option>
                    <option value="other  أخرى">Other أخرى</option>
                </select>
                <br>
                <textarea class="form-control" name="addremark"></textarea>

            </div>
            <div class="checkbox">
                <label>
                    <input class="othServCheck" type="checkbox" />
                    Want Reminder
                </label>
                <br>

                <input type="datetime-local" class="othServText form-control" style="display:none" name="rem_date"
                    value="{{ old('acc_date') }}" />
            </div>
            <br>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary mr-1">Add</button>

                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#viewRemark">
                        View All Remarks
                    </button>
                </div>
            </div>
        </form>

        {{-- view all clims modal  --}}
        <div class="col-12 py-1">
            {{-- <button type="button" class="btn btn-outline-dark" data-toggle="modal"
                                                        data-target="#viewRemark">
                                                        @lang('language.View Remarks')
                                                    </button> --}}
            <!-- Modal -->
            <div class="modal fade modal-secondary text-left" id="viewRemark" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel1660" aria-hidden="true">
                @php
                    $remarks = DB::table('claim_remarks')
                        ->where('claim_id', $claim->id)
                        ->get();

                @endphp
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1660">Claim
                                Remarks
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">


                                <h4>GGI00{{ $claim->id }}</h4>
                                <table class="table table-responsive">
                                    <tr>
                                        <td>Claim Id</td>
                                        <td>User Name</td>
                                        <td>Remarks</td>
                                        <td>Date</td>
                                        <td>Reminder Date</td>
                                    </tr>
                                    @foreach ($remarks as $remark)
                                        <tr>
                                            <td>GGI00{{ $remark->claim_id }}</td>
                                            <td>{{ username($remark->user_id) }}
                                            </td>
                                            <td>{{ $remark->remark }} @if ($remark->add_remark != null)
                                                    <br>{{ $remark->add_remark }}
                                                @endif
                                            </td>
                                            <td>{{ $remark->created_at }}</td>
                                            <td>{{ $remark->remainder }}</td>
                                        </tr>
                                    @endforeach
                                </table>



                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endpermission
