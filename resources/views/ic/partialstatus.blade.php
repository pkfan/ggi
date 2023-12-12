<!DOCTYPE html>
<html lang="en">
<x-ic::head/>

<body>
<x-ic::header/>
<x-ic::sidebar/>
<div class="app-content content ">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Claim ID</th>
                            <th>Start Date - Last Date</th>
                            <th>Number of Installment</th>
                            <th>Link Sent</th>
                            <th>No. Additional Links</th>
                            <th>Additional Links</th>
                            <th>Manual Collection</th>
                            <th>Recovered Amount</th>
                            <th>Recovered Percentage</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>
                        @foreach($partials as $partial)
                            <tr>
                                <td>GGI00{{$partial->id}}</td>
                                <td>{{$partial->partialPaymentRe->first()->date_time}} - {{$partial->partialPaymentRe->last()->date_time}} </td>
                                <td>{{$partial->partialPaymentRe->count()}}</td>
                                <?php
                                $sendlink = $partial->partialPaymentRe->where('status',2);
                                $unsendlink = $partial->partialPaymentRe->where('status',1);
                                $sadads= $partial->sadadPayment;
                                $linkcount0=1;
                                ?>
                                <td><b>Send Links</b> <br>
                                @foreach($sendlink as $slink)
                                {{$linkcount0++}} Link<br>

                                    {{payidcheck($slink->pay_id)}} <br>

                                @endforeach <br>
                                <b>SADAD</b><br>
                                @if($partial->sadadPayment->count() != 0)
                                    @foreach($sadads as $sadad)
                                    {{$sadad->sadadNumber}} <br>{{sadadPayedCheck($sadad->sadadNumber)}}<br>
                                    @endforeach
                                @else
                                None <br>
                                @endif
                                    <br><p>10112001102 <br>Not Recovered<br>
                                        10112001103 <br>Not Recovered<br>
                                        10112001104 <br>Not Recovered<br>
                                        10112001105 <br>Not Recovered<br>
                                        10112001106 <br>Not Recovered<br>
                                        10112001108 <br>Not Recovered<br>
                                        10112001109 <br>Not Recovered<br>
                                        10112001356 <br>Not Recovered<br>
                                        <b>Pending dates</b> <br>
                                        @foreach($unsendlink as $unlink)
                                        {{$unlink->date_time}} <br>
                                        @endforeach <br>
                                        2023-07-07 15:27:00 <br>
                                        2023-08-06 15:27:00 <br>
                                        2023-09-05 15:27:00 <br></p>
                                </td>
                                <td>{{$partial->additionalLinks->count() + $partial->additionalSadadLinks->count() }}</td>

                                <?php
                            $additionalLink= $partial->additionalLinks;
                            $linkcount1=1;

                            $additionalSadad = $partial -> additionalSadadLinks;

                            ?>
                                <td> @foreach($additionalLink as $aLink)
                                {{$linkcount1++}} Link<br>{{additionalcheck($aLink->payment_id)}}<br>
                                @endforeach

                                <b>Sadad</b><br>
                                @if($partial -> additionalSadadLinks->count() != 0)
                                @foreach($additionalSadad as $sLink)
                                {{$linkcount1++}} Link<br>{{additionalSadadCheck($sLink->sadadNumber)}}<br>
                                @endforeach
                                @else
                                None<br>
                                @endif</td>
                                <?php
                             $manual = $partial-> manualPartial
                            ?>
                                <td>@foreach($manual as $pmanual)
                                {{$pmanual->amount}}<br>
                                @endforeach</td>
                                <td>{{amountRecovered($partial->id)}}</td>
                                <td>{{ round(  amountRecovered($partial->id) / $partial->amount_after_discount * 100 ,2) }} %</td>
                                <td><a class="btn btn-outline-gradient" target="_blank" href="https://recovery.taheiya.sa/admin/claim/detail/1859">View Details</a></td>
                            </tr>


                       @endforeach
                        </tbody>
                </table>
            </div>
         </div>
    </div>
</div>
<x-ic::footer/>
</body>
</html>
