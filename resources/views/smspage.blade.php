<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Claim Detail</title>
    <style>
        body {

            width: 100%;
            /* to centre page on screen*/
            margin-left: auto;
            margin-right: auto;
        }

        .logo img {
            height: 50px;
            float: right;
            margin-top: 32px;
        }

        .heading {
            margin-top: 6px;
            text-align: center;
            margin-left: 89px;
        }

        .date {
            margin-top: 100px;
        }

        .paragraph1 {
            text-align: end;
            margin-left: 203px;
            margin-top: 20px;
        }



        .col-main {
            flex: 1;
        }

        .urdu {
            font-family: "Sakkal Majalla";
            text-align: end;

        }


        @media only screen and (min-width: 640px) {
            .layout {
                display: flex;
            }
        }

        .container {
            max-width: 50em;
            margin-right: auto;
            margin-left: auto;
        }


        .col-complementary {
            text-align: end;
        }

        table {
            --accent-color: #362f4b;
            --text-color: slategray;
            --bgColorDarker: #ececec;
            --bgColorLighter: #fcfcfc;
            --insideBorderColor: lightgray;
            width: 100%;
            margin: 0;
            padding: 0;
            color: black;
            table-layout: fixed;
        }


        table,
        th,
        td {
            border: 1px solid black;
            font-size: 14px;
        }

        table tbody tr:nth-child(odd) {
            background-color: rgb(226, 238, 247);
        }

        table tbody tr:nth-child(even) {
            background-color: rgb(166, 197, 220);
        }

        table th {
            letter-spacing: 0.075rem;
        }

        table th,
        table td {
            font-weight: normal;
            text-align: center;
        }

        table th:nth-child(4),
        table td:nth-child(4) {
            text-align: right;
        }

        @media screen and (max-width: 768px) {
            table {
                border: none;
            }

            table thead {
                position: absolute;
                width: 1px;
                height: 1px;
                clip: rect(0 0 0 0);
                overflow: hidden;
            }

            table tbody tr {
                margin-bottom: 2rem;
                display: block;
            }

            table td {
                font-size: 22px;
                text-align: right;
                display: block;
            }

            table td:before {
                content: attr(data-label);
                font-size: 0.75rem;
                font-weight: 600;
                letter-spacing: 0.075rem;
                text-transform: uppercase;
                float: left;
                opacity: 0.5;
            }

            table td:not(:last-child) {
                border-bottom: 1px solid var(--insideBorderColor);
            }
        }

        .upload {
            margin-top: 22px;
            text-align: center;
        }

        .footer {
            margin-top: 80px;
        }
    </style>
</head>

<body>
    @if (session()->has('success'))
        <div class="container alert alert-success" role="alert">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.2" baseProfile="tiny"
                viewBox="0 0 24 24" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M16.972 6.251c-.967-.538-2.185-.188-2.72.777l-3.713 6.682-2.125-2.125c-.781-.781-2.047-.781-2.828 0-.781.781-.781 2.047 0 2.828l4 4c.378.379.888.587 1.414.587l.277-.02c.621-.087 1.166-.46 1.471-1.009l5-9c.537-.966.189-2.183-.776-2.72z">
                </path>
            </svg>
            <span>
                {{ session()->get('success') }}
            </span>
        </div>
    @endif
    <div class="container">
        <x-form-errors-alert />
    </div>


    <div class="container logo">
        <a href="#home"><i class=""></i><img src="{{ asset('app-assets/images/logo/logo.png') }}" /></a>

    </div>
    <main>
        <div class="container">

            <div class="row layout">
                <h5 class="date">التاريخ : {{\Carbon\Carbon::parse($claim->created_at)->format('M d, Y')}}</h5>
                <h5 class="heading">اشعار مطالبة مالية</h5>

                <p class="paragraph1">
                    <strong class="urdu">...السلام عليكم ورحمة الله وبركاته </strong><br />
                    <!--بالإشارة إلى الحادث المذكورة بياناته أدناه، يرجى دفع المبلغ المسترد لصالح شركة تكافل الراجحي للتأمين-->
                    <!--التعاوني؛ وذلك خلال 5 ايام عمل من تاريخ اصدار هذا الاشعار، علماً أن رقم ايبان شركة تكافل الراجحي-->
                    <!--للتأمين التعاوني في مصرف الراجحي هو (IBAN:SA4780000678608010013614).-->
                </p>
            </div>
            <section>
                <table>
                    <tbody>

                        <tr>
                            <td>{{ $claim->deb_name }} </td>
                            <td>اسم المُطالب المتسبب / المؤمن له : </td>

                        </tr>
                        <tr>
                            <td>{{ $claim->deb_iqama }}</td>
                            <td>:رقم الهوية</td>

                        </tr>
                        <tr>
                            <td>GGI00{{ $claim->claim_no }}</td>
                            <td>:رقم المطالبة</td>

                        </tr>
                        <tr>
                            <td>{{ $claim->acc_date }}</td>
                            <td>: تاريخ الحادث </td>


                        </tr>
                        <tr>
                            <td>{{  $claim->claimData?->remarks }}</td>
                            <td>:سبب المطالبة</td>


                        </tr>
                        <tr>
                            <td>{{ $claim->libpercent }}</td>
                            <td>:نسبة المسؤولية عن الحادث</td>
                        </tr>
                       {{-- <tr>
                            <td>
                                @if ($claim?->ClaimData?->plate_no)
                                    {{ $claim?->ClaimData?->plate_no }}
                                @endif
                            </td>
                            <td>:لوحة سيارة عميل تكافل الراجحي</td>

                        </tr> --}}
                        <tr>
                            <td>{{$claim->rec_reason}}</td>
                            <td>:سبب الاسترداد</td>
                        </tr>
                        <tr>
                            <td>{{ $claim->amount_after_discount }}</td>
                            <td>:مبلغ المطالبة الاجمال</td>
                        </tr>
                        <tr>
                            <td>
                                @php
                                    $admindoc = DB::table('admin_doc')
                                            ->where('claim_id', $claim->id)
                                            ->get();

                                    $counter = 1;
                                @endphp
                                @foreach (getdoc($claim->id) as $doc)
                                    <div>
                                        <a href="{{ asset('storage/' . $doc->doc_name) }}"
                                            target="_blank">وثيقة.{{ $counter }}</a><br>
                                    </div>
                                    @php
                                        $counter++;
                                    @endphp
                                @endforeach

                                @foreach ($admindoc as $doc1)
                                    <div>
                                        <a href="{{ asset('storage/' . $doc1->document) }}" target="_blank">وثيقة.{{ $counter }}</a><br>
                                    </div>
                                    @php
                                        $counter++;
                                    @endphp
                                @endforeach
                            </td>
                            <td>:مستندات المطالبة المالية</td>

                        </tr>
                        <tr>
                            <td>Email: {{ $claim->officer?->email }} | Mobile No: {{ $claim->officer?->phone }}</td>

                            <td>اسم الموظف: {{ $claim->officer?->name }}</td>
                        </tr>

                    </tbody>
                </table>
            </section>
            {{-- <div class="upload">
                <input type="file">
            </div> --}}
            <form action="{{ route('officer.debtor.bank.transfer.slip') }}" method="post"
                enctype="multipart/form-data"
                style=" width: 100%; display: flex; justify-content: left;padding: 24px 0 0;">
                @csrf
                <input type="hidden" value="{{ $claim->id }}" name="claim_id">

                <div class="col-md-6">


                    <div class="input-group form-password-toggle mb-2">
                        <input type="file" class="form-control" id="excel_file" multiple="" required=""
                            name="screenshot"
                            accept=".doc,.docx,.pdf,.png,.jpg,.jpeg,.webp,"
                            >
                        <button type="submit"
                            class="show-loading-on-click input-group-append btn btn-primary waves-effect waves-float waves-light"
                            style="
                                display: flex;
                                gap: 6px;
                                justify-content: center;
                                align-items: center;
                            ">
                            <span>submit bank slip</span>
                        </button>
                    </div>
                </div>


            </form>
            <form action="{{route('InitPayment')}}" method="post" id="payOnlineForm">
                        @csrf
            <input type="hidden" value="{{$claim->rec_amt}}" name="amount">
            <input type="hidden" value="{{$claim->id}}" id="claim_id">
            <input type="hidden" value="{{$claim->id}}" name="claim_id">
            {{session()->put('claim',$claim->id)}}
            {{session()->put('url',\Illuminate\Support\Facades\Request::url())}}
            <button type="submit" class="btn btn-primary">Pay By Mada</button>
            </form>

                @if (paymentFromClaimId($claim->id))
                    <p>
                       @if(paymentFromClaimId($claim->id)->response_code == 000)
                        <strong style="color: green">Payment Received</strong><br>
                        Payment ID: {{paymentFromClaimId($claim->id)->payment_id}}<br>
                        Result: {{paymentFromClaimId($claim->id)->result}}<br>
                        Auth Code: {{paymentFromClaimId($claim->id)->auth_code}}<br>
                        Response Code: {{paymentFromClaimId($claim->id)->response_code}}<br>
                        RRN: {{paymentFromClaimId($claim->id)->rrn}}<br>
                        Amount: {{paymentFromClaimId($claim->id)->amount}}<br>
                        Card Brand: {{paymentFromClaimId($claim->id)->card_brand}}<br>
                        Masked Pan: {{paymentFromClaimId($claim->id)->masked_pan}}<br>
                        @elseif(paymentFromClaimId($claim->id)->response_code == 219)
                        <strong style="color: red">Card Not supported</strong><br>
                        @elseif(paymentFromClaimId($claim->id)->response_code == 220)
                        <strong style="color: red">Wrong CVV</strong><br>
                        @elseif(paymentFromClaimId($claim->id)->response_code == 506)
                        <strong style="color: red">Error</strong><br>
                        @elseif(paymentFromClaimId($claim->id)->response_code == 506)
                        <strong style="color: red">Invalid Card Number</strong><br>
                        @elseif(paymentFromClaimId($claim->id)->response_code == 556)
                        <strong style="color: red">No Card Record</strong><br>
                        @elseif(paymentFromClaimId($claim->id)->response_code==206)
                         <strong style="color: red"> Not allowed to perform Transaction</strong><br>
                        @else
                         <strong style="color: red">Error</strong><br>
                        @endif
                    </p>
                @endif


            <footer class="footer">
                <img src="{{ asset('app-assets/images/logo/logo.png') }}" alt="">
            </footer>
        </div>
    </main>
</body>

</html>
