<!DOCTYPE html>
<html lang="en">
<x-ic::head/>
<body>
    <style>
        .chat-content-leftside {
    text-align: left;
}

.chat-content-rightside {
    text-align: right;
}

.chat-time {
    font-size: 12px;
    color: #999;
    margin-bottom: 5px;
}

.chat-left-msg {
    background-color: #F2F2F2;
    padding: 10px;
    border-radius: 10px;
    display: inline-block;
}

.chat-right-msg {
    background-color: #DCF8C6;
    padding: 10px;
    border-radius: 10px;
    display: inline-block;
}

    </style>
<x-ic::header/>
<x-ic::sidebar/>
<div class="app-content content ">
        @if(session()->has('success'))
            <div id="toast-container" class="toast-container toast-top-right">
                <div class="toast toast-success" aria-live="polite" style>
                    <button type="button" class="toast-close-button" role="button">×</button>
                    <div class="toast-title">👋{{session('success')}}!</div>
                    <div class="toast-message">You have successfully regostered your claim.</div>
                </div>
            </div>
        @endif
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Claims Details</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">IC</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Claims</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Claim Detail</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
            <div class="card-title d-flex align-items-center">


                <!-- <form class="form" method="post" action="{{route('IcAddClaim')}}" enctype="multipart/form-data">  -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Claim Details</h4>
                                    <div class="card-title d-flex align-items-center">
									</div>
                                </div>
                                <div class="card-body">
                                <div class="row mb-2">
                                        <div class="col-sm-4">
                                            <h5 class="mb-0 text-primary">Claim Request Detail</h5>
                                        </div>
                                        <div class="col-sm-8">
                                            <a class="btn btn-primary" href="{{url('ic/comment/'.$claim->id)}}">Add/View Comment</a>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#additionalDoc" >Upload Additional Doc.</button>
                                            @if($claim->status!=0)
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#calldurationmodal" >Call History</button>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#smsstatus">SMS History</button>
                                            @endif
                                        </div>
                                    </div>
                                    @csrf
                                    <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">Recovery Amount</label>
										            <input type="number" class="form-control" id="inputFirstName" name="rec_amt" value="{{$claim->amount_after_discount}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="last-name-column">Claim Number</label>
										            <input type="text" class="form-control" id="inputFirstName" name="claim_no" value="{{$claim->claim_no}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="city-column">Accident Date </label>
										            <input type="text" class="form-control" id="inputLastName" name="acc_date" value="{{$claim->acc_date}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="country-floating">Accident Location</label>
                                                    <select class="form-control" name="acc_location" required disabled>
                                            <option value="{{$claim->acc_location}}" selected >{{$claim->acc_location}}</option>

                                            </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="company-column">Debtor Name</label>
										            <input type="type" class="form-control" id="inputEmail" name="deb_name" value="{{$claim->deb_name}}" required disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Ic Email</label>
										            <input type="email" class="form-control" id="inputEmail" name="deb_name" value="{{$claim->ic_mail}}" required disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Debtor Iqama Number/ID Number</label>
										<input type="text" class="form-control" id="inputEmail" name="deb_iqama"  value="{{$claim->deb_iqama}}" required maxlength="10" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Debtor Age</label>
										            <input type="text" class="form-control" id="inputEmail" name="deb_age" value="{{$claim->deb_age}}" required disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                            <label for="phone-number">Phone Number</label>
                                            <div class="input-group input-group-merge">
										            <input type="text" class="form-control" id="inputEmail" name="deb_mob"  value="{{$claim->deb_mob}}" required maxlength="10" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-id-column">Type</label>
                                                    <select id="debtorType" class="form-control" name="deb_type" required disabled>
                                                        <option value="{{$claim->deb_type}}" selected> {{$claim->deb_type}}</option disabled>
                                                    </select>
                                                </div>
                                            </div>
                                            @if(!empty($claim->rec_reason))
                                            <div class="col-md-6" id="recoveryReason">
                                                <label for="inputPassword" class="form-label">Recovery Reason</label>
                                                <textarea class="form-control" disabled>{{$claim->rec_reason}}</textarea>
                                            </div>
                                            @endif

                                            @if(!empty($claim->rejection_reason))
                                            <div class="col-md-6" id="recoveryReason">
                                                <label for="inputPassword" class="form-label">Rejection Reason</label>
                                                <textarea class="form-control" disabled>{{$claim->rejection_reason}}</textarea>
                                            </div>
                                            @endif
                                            <div class="col-md-6">
                                    <label for="inputLastName" class="form-label">Uploaded Supportive Document</label>
                                    <br>
										@foreach(getdoc($claim->id) as $doc)

                                       <a href="{{asset('storage/'.$doc->doc_name)}}"  target="_blank">

                                       Supportive Doc</a><br>

                                        @endforeach
									</div>

									<?php
									$icdoc=DB::table('ic_doc')->where('claim_id',$claim->id)->get();
									$icdocc=DB::table('ic_doc')->where('claim_id',$claim->id)->count();
									?>
									@if($icdocc)
									<div class="col-md-6">
									<label for="inputLastName" class="form-label">Additional Doc. By IC</label><br>
											@foreach($icdoc as $doc)

											<a href="{{asset('storage/'.$doc->document)}}"  target="_blank">Additional Supportive Doc</a><br>

											@endforeach
									</div>
									@endif

									<?php
									$admindoc=DB::table('admin_doc')->where('claim_id',$claim->id)->get();
									$doccount=DB::table('admin_doc')->where('claim_id',$claim->id)->count();
									?>
									@if($doccount>0)

									<div class="col-md-6">
									<label for="inputLastName" class="form-label">Additional Doc. By Admin</label><br>
											@foreach($admindoc as $doc)

											<a href="{{asset('storage/'.$doc->document)}}"  target="_blank">Additional Supportive Doc</a><br>

											@endforeach
									</div>
									@endif

				                    <?php
									$debdocc=DB::table('deb_doc')->where('claim_id',$claim->id)->count();
									$debdoc=DB::table('deb_doc')->where('claim_id',$claim->id)->get();
									?>
									@if($debdocc>0)
									<div class="col-md-6">
									<label for="inputLastName" class="form-label">Additional Doc. By Debtor</label><br>
											@foreach($debdoc as $doc)

											<a href="{{asset('storage/'.$doc->document)}}"  target="_blank">Additional Supportive Doc</a><br>

											@endforeach
									</div>
									@endif
									@if(Auth::user()->roll==1  && checkobjection($claim->id)>0)
									<div class="col-md-6">
									<label for="inputLastName" class="form-label"> Objection From Debtor</label>
									<textarea class="form-control" disabled>{{getobjection($claim->id)->objection}}</textarea>
									</div>
									@endif
                                    <div class="col-md-6">

                                        @if($claim->status==2)
                                        <a class="btn btn-outline-primary" href="{{route('IcEditClaim',$claim->id)}}">Edit Details</a>
                                        @elseif($claim->status==1)
										<label class="form-label">You cannot edit once approved</label> <br>
										@endif

                                    </div>
                                        </div>
                                    </form>
                                    <?php
								$status = DB::table('claim_status')
        									->where('claim_id', $claim->id)
        									->select('status')
        									->first();
								?>
								@if($status->status == 4)
                                       <br> <h6>Partial Payment Details</h6>
					 						<?php
					 						$status = DB::table('claim_status')
        									->where('claim_id', $claim->id)
        									->select('status')
        									->first();
											$partialcount=DB::table('partial_pay')->where('claim_id',$claim->id)->count();
											$partialpay=DB::table('partial_pay')->where('claim_id',$claim->id)->get();
											?>
											@if($partialcount>0)
					 							<div class="col-md-12">
													Payment Plan:{{$partialcount}}
													<table class="table">
														<tr>

															<td>Date Time</td>
															<td>Status</td>
															<td>Link</td>

															<td>Recovered</td>
														</tr>
														@foreach($partialpay as $pay)
					 										<tr>

																<td>{{$pay->date_time}}</td>
																<td>
																    @if($pay->status==1)
																    SMS Not Send Yet
																    @elseif($pay->status==2)
																    SMS Sent
																    @endif

																</td>
																<td>{{$pay->link}}</td>

                                                                <td>{{partialCheck($pay->pay_id,$claim->id,$pay->id,$pay->link)}} </td>
															</tr>
														@endforeach

														    <tr>
														        <td colspan='3'>Recovered Amount</td>
														        <td>{{recoveryAmt($claim->id)}}</td>
														    </tr>
													</table>
												</div>
											@endif
										@endif
								<!--end partial details-->

                                <?php
								$remarks=DB::table('claim_remarks')->where('claim_id',$claim->id)->get();
								?>
								@if( $remarks->count() != 0 )

                    			    <h6>Admin Remarks On Claim</h6>
                                    <table class="table">
                                        <tr>
                                            <td>Claim Id</td>
                                            <td>User Name</td>
                                            <td>Remarks</td>
                                            <td>Date</td>

                                        </tr>
                                        @foreach($remarks as $remark)
                                            <tr>
                                                <td>GGI00{{$remark->claim_id}}</td>
                                                <td>{{ username($remark->user_id)->na}}</td>
                                                <td>{{$remark->remark}} @if($remark->add_remark!=null)<br>{{$remark->add_remark}}@endif</td>
                                                <td>{{$remark->created_at}}</td>

                                            </tr>
                                        @endforeach
                                    </table>

								@endif

							    <!--end	Claims Remarks -->

                                <?php
									$cCount=DB::table('claim_comments')->where('claim_id',$claim->id)->count();
									$comments=DB::table('claim_comments')->where('claim_id',$claim->id)->orderBy('created_at')->get();
								?>
								@if($cCount!=0)
									<hr>
									<h4>Comments</h4><p>Add Comment</p>
									<div class="col-md-12">
											@foreach($comments as $comment)
												@if($comment->status==1)
												<div class="chat-content-leftside">
												<div class="d-flex ms-auto">
													<div class="flex-grow-1 me-2">
														<p class="mb-0 chat-time text-end">Admin, {{\Carbon\Carbon::parse($comment->updated_at)->diffForhumans()}}</p>
															<p class="chat-left-msg">{{$comment->comment}}</p>
															</div>
													</div>
												</div>
												@else
												<div class="chat-content-rightside">
												<div class="d-flex ms-auto">
													<div class="flex-grow-1 me-2">
														<p class="mb-0 chat-time text-end">you, {{\Carbon\Carbon::parse($comment->updated_at)->diffForhumans()}}</p>
															<p class="chat-right-msg">{{$comment->comment}}</p>
															</div>
													</div>
												</div>
												@endif
											@endforeach


											<form method="post" action="{{url('ic/add-comment')}}">
												@csrf
											<input type="hidden" name="claimid" value="{{$claim->id}}">
											<textarea class="form-control" name="comment" required></textarea><br>
											<input type="submit" class="btn btn-primary">
											</form>
									</div>
								@endif
									{{-- <form action="{{url('ic/add/remarks')}}" method="post">
										@csrf
									<div class="col-md-12">
										<input type="hidden" name="claim_id" value="{{$claim->id}}">
									<label for="inputLastName" class="form-label">Remarks</label>
									<textarea class="form-control" name="remarks">{{$claim->remarks}}</textarea>
									</div><br>
									<div class="col-md-6">
										<input type="submit" class="btn btn-primary">
									</div>
                                </div> --}}

                            </div>
                        </div>
                    </div>
                </section>

                <!-- Basic Floating Label Form section end -->
                <!-- additional doc for admin -->
				<div class="modal fade" id="additionalDoc" tabindex="-1" aria-hidden="true">
        			<div class="modal-dialog modal-dialog-centered">
        				<div class="modal-content">
        					<div class="modal-header">
        						<h5 class="modal-title">Add Additional Document</h5>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
        					</div>
        					<div class="modal-body">

        							<div class="mb-3">
        								<h4>GGI00{{$claim->id}}</h4>
										<form action="{{url('ic/additional-document')}}" method="post" enctype="multipart/form-data">
										@csrf
										<div class="mb-3">
        								<input type="hidden" value="{{$claim->id}}" name="claimid">
        								<label>Upload Document</label>
        								<input type="file" class="form-control" multiple name="addFile[]" required>
        							</div>

        							</div>


        					</div>
        					<div class="modal-footer">
        						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        						<button type="submit" class="btn btn-primary" >Save</button>
								</form>
        					</div>
        					</form>
        				</div>
        			</div>
        		</div>
				<!-- additional doc for admin end -->

                <!-- Call duration modal  -->
				<div class="modal fade" id="calldurationmodal" tabindex="-1" aria-hidden="true">
					<?php
						$res = DB::table('call_status')
							->where('claim_id', $claim->id)
							->get();
						$calls = 1;
     				?>
        			<div class="modal-dialog modal-dialog-centered">
        				<div class="modal-content">
        					<div class="modal-header">
        						<h5 class="modal-title">Call History</h5>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
        					</div>
        					<div class="modal-body">

        							<div class="mb-3">


        								<h4>Call History GGI00{{$claim->id}}</h4>


										@if($res)
											@foreach($res as $resq)
												<h6>Call:{{$calls}}</h6>
												@if($resq->statuss!=null)

													Duration:{{$resq->duration}} <br>
													Status:{{$resq->statuss}}

												@else
													<?php $response = Http::withHeaders([
														'AppsId' => 'lmfuLlmvVEKcOCMyxF1A',
														'Content-Type' => 'application/json',
													])->get('https://voice.unifonic.com/v1/calls/' . $resq->callId);
													?>
													@if(isset($response['statusCode'])==False)
														@if($response!=null)
														Duration:{{$response['status']}}
														Status:	{{$response['duration']}}
														@endif
														@if($response['status']!='completed')

														@endif
													@else
														Error:{{$response['statusCode']}} <br>


													@endif



												@endif
												<?php $calls++; ?>
											@endforeach
										@endif

        							</div>


        					</div>
        					<div class="modal-footer">
        						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        					</div>

        				</div>
        			</div>
        		</div>
				<!-- call duration modal end -->



                <!-- Sms Status  -->
				<div class="modal fade" id="smsstatus" tabindex="-1" aria-hidden="true">
					<?php
						$res = DB::table('sms_response')
							->where('claim_id', $claim->id)
							->get();
						$calls = 1;
					?>
        			<div class="modal-dialog modal-dialog-centered">
        				<div class="modal-content">
        					<div class="modal-header">
        						<h5 class="modal-title">SMS History</h5>
        						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
        					</div>
        					<div class="modal-body">

        							<div class="mb-3">
        								<h4>SMS History GGI00{{$claim->id}}</h4>
										@if($res)
											@foreach($res as $sms)
												<h6>Sms:{{$calls}}</h6>
													<b>MSGAT Message</b>:{{$sms->message}}<br>
													<b>Status:</b>
													@if($sms->code==1)
														Success
														@elseif($sms->code=='M0000')
														Success
														@elseif($sms->code=='1060')
														Balance is not enough
														@elseif($sms->code=='1120')
														Mobile numbers is not correct

														@elseif($sms->code='M0037')
														Please send SMS by statist IP
														@else
														{{ $sms->code}}
													@endif
													<br>
													<b>Message:</b>{{$sms->sms}} <br>


												<?php $calls++; ?>
                                                <hr/>
											@endforeach
										@endif

        							</div>


        					</div>
        					<div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">Close</span>
                                                            </button>
        					</div>
        					</form>
        				</div>
        			</div>
        		</div>
				<!-- Sms Status end -->


            </div>
        </div>
    </div>
    <x-ic::footer/>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>

    $(function(){
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    var hour=  dtToday.getHours();
    var min=dtToday.getMinutes();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
        console.log(day)
    var maxDate = year + '-' + month + '-' + day ;

   // alert(maxDate);
    $('#accidentDate').attr('max',maxDate );
    $('#inspection-date-from').attr('min',maxDate );

  });
    </script>
<script>
	$('#debtorType').on('change',function(){
		if($('#debtorType').val() == 'insured'){
			$('#recoveryReason').removeClass('d-none')
		}
		else if($('#debtorType').val() == 'thirdparty'){
			$('#recoveryReason').addClass('d-none')
		}
        else if($('#debtorType').val() == 'third party'){
			$('#recoveryReason').addClass('d-none')
		}
	})

	   $('input[type=radio][name=claim_type]').change(function() {
    if (this.value == 'yes') {
        $('#divIqama').hide();
        $('#divphone').hide();
        $('#deb_iqama').removeAttr('required');
        $('#deb_phone').removeAttr('required');

    }
    else if (this.value == 'no') {
        $('#divIqama').show();
        $('#divphone').show();
        $('#deb_iqama').attr('required',true);
        $('#deb_phone').attr('required',true);
    }
    })
</script>
{{--<script>--}}
{{--const excel_file = document.getElementById('excel_file');--}}
{{--excel_file.addEventListener('change', (event) => {--}}
{{--    if(!['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'].includes(event.target.files[0].type))--}}
{{--    {--}}
{{--        document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Only .xlsx or .xls file format are allowed</div>';--}}
{{--        excel_file.value = '';--}}
{{--        return false;--}}
{{--    }--}}
{{--    var reader = new FileReader();--}}
{{--    reader.readAsArrayBuffer(event.target.files[0]);--}}
{{--    reader.onload = function(event){--}}
{{--        var data = new Uint8Array(reader.result);--}}
{{--        var work_book = XLSX.read(data, {type:'array'});--}}
{{--        var sheet_name = work_book.SheetNames;--}}
{{--        var sheet_data = XLSX.utils.sheet_to_json(work_book.Sheets[sheet_name[0]], {header:1});--}}
{{--        if(sheet_data.length > 0)--}}
{{--        {--}}
{{--            if(sheet_data[0][0].toUpperCase() == 'MAKE' && sheet_data[0][1].toUpperCase() == 'MODEL' && sheet_data[0][2].toUpperCase() == 'YEAR' && sheet_data[0][3].toUpperCase() == 'TYPE' && sheet_data[0][4].toUpperCase() == 'COLOR' && sheet_data[0][5].toUpperCase() == 'CLAIM NO' && sheet_data[0][6].toUpperCase() == 'PLATE NO' )--}}
{{--            {--}}
{{--            var table_output = '<table class="table table-striped table-bordered">';--}}
{{--            for(var row = 0; row < sheet_data.length; row++)--}}
{{--            {--}}
{{--                table_output += '<tr>';--}}
{{--                for(var cell = 0; cell < sheet_data[row].length; cell++)--}}
{{--                {--}}
{{--                    if(row == 0)--}}
{{--                    {--}}
{{--                        table_output += '<th>'+sheet_data[row][cell]+'</th>';--}}
{{--                    }--}}
{{--                    else--}}
{{--                    {--}}
{{--                        table_output += '<td>'+sheet_data[row][cell]+' <input type="hidden" name="data[]" value="'+sheet_data[row][cell]+'" >    '+'</td>';--}}
{{--                    }--}}
{{--                }--}}
{{--                if(!row == 0){--}}
{{--              table_output += '<td> <input type="file" name="data[]" value="Upload" required multiple>  </td>';--}}
{{--                }--}}
{{--                table_output += '</tr>';--}}
{{--            }--}}
{{--            table_output += '</table>';--}}
{{--            console.log(table_output);--}}
{{--             document.getElementById('excel_data').innerHTML = table_output;--}}
{{--              }else{--}}
{{--              document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Only recomended format are allowed</div>';--}}
{{--        }--}}
{{--        }--}}
{{--        excel_file.value = '';--}}
{{--    }--}}
{{--});--}}
{{--</script>--}}
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>

    function convertExcelDate(excelDate) {
      var date = new Date((excelDate - 25569) * 86400 * 1000);
      var day = date.getDate();
      var month = date.getMonth() + 1; // Months are zero-based
      var year = date.getFullYear();

      // Format the date as desired (e.g., DD-MM-YYYY)
      var formattedDate = ("0" + day).slice(-2) + "-" + ("0" + month).slice(-2) + "-" + year;
      var formattedDate = year + "-" + ("0" + month).slice(-2) + "-" + ("0" + day).slice(-2);
      return formattedDate;
    }


    const excel_file = document.getElementById('excel_file');
    excel_file.addEventListener('change', (event) => {
        if(!['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'].includes(event.target.files[0].type))
        {
            document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Only .xlsx or .xls file format are allowed</div>';
            excel_file.value = '';
            return false;
        }
        var reader = new FileReader();
        reader.readAsArrayBuffer(event.target.files[0]);
        reader.onload = function(event){
            var data = new Uint8Array(reader.result);
            var work_book = XLSX.read(data, {type:'array'});
            var sheet_name = work_book.SheetNames;
            var sheet_data = XLSX.utils.sheet_to_json(work_book.Sheets[sheet_name[0]], {header:1});
            if(sheet_data.length > 0)
            {
                if(sheet_data[0][0] === 'rec_amt' &&  sheet_data[0][1] === 'acc_location' && sheet_data[0][2] === 'rec_reason' && sheet_data[0][3] === 'deb_iqama' && sheet_data[0][4] === 'deb_name' && sheet_data[0][5] === 'deb_age' && sheet_data[0][6] === 'deb_mob'  && sheet_data[0][7] === 'deb_type' && sheet_data[0][8] === 'claim_no' &&  sheet_data[0][9] === 'ic_email'
                 && sheet_data[0][10] === 'accident_date' && sheet_data[0][11] === 'liability percentage' && sheet_data[0][12] === 'type')
                {
                    console.log(sheet_data.length);
                    var table_output = '<table class="table table-striped table-bordered">';
                    for(var row = 0; row < sheet_data.length; row++) {
                        table_output += '<tr>';
                        for (var cell = 0; cell < sheet_data[row].length; cell++) {
                            if (row == 0) {
                                table_output += '<th>' + sheet_data[row][cell] + '</th>';
                            } else {
                                if(cell == 10){
                                    table_output += '<td>'+convertExcelDate(sheet_data[row][cell])+  ' <input type="hidden" name="data[]" value=" ' + convertExcelDate(sheet_data[row][cell])+ ' " >    ' + '</td>';
                                } else if(cell == 11){
                                    table_output += '<td>'+100*sheet_data[row][cell]+  ' <input type="hidden" name="data[]" value=" ' + 100*sheet_data[row][cell] + ' " >    ' + '</td>';
                                }
                                else{
                                    table_output += '<td>' + sheet_data[row][cell] + ' <input type="hidden" name="data[]" value="' + sheet_data[row][cell] + '" >    ' + '</td>';
                                }
                            }
                        }
                        if (!row == 0) {
                            table_output += '<td> <input type="file" name="data'+row+'[]"    value="Upload" required multiple accept="image/png, image/jpeg ,application/pdf" >  </td>';

                        }
                        table_output += '</tr>';

                    }
                    table_output += '</table>';
                    console.log(table_output);
                    document.getElementById('excel_data').innerHTML = table_output;
                }else{
                    document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Only recomended format are allowed</div>';
                }
            }
            excel_file.value = '5r5r';
        }
    });

    function hel()
    {
        var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    var hour=  dtToday.getHours();
    var min=dtToday.getMinutes();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
        console.log(day)
    var maxDate = year + '-' + month + '-' + day ;

   // alert(maxDate);
    $('.accidentDate2').attr('max',maxDate );
        console.log
    }
</script>
</body>
</html>
