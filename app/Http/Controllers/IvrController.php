<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\DebIvrResponse;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class IvrController extends Controller
{
    public function makeCall($to)
    {
        initiateCall($to);
    }

    public function callAnswer($to)
    {
        // Responses Codes
        // 1: Accept Call   2: Reject Call     3: Busy Call   4: Accept to pay  5:  Reject to pay   6: No answer after three call

        $claim=getClaimByPhoneNumber($to);

        $amount=$claim->amount_after_discount;

        $claim->ivr_status=1;
        $claim->pay_status="";
        $claim->save();


        return json_encode(["Hi ".$claim->deb_name." Thanks for accepting the call, you have to pay SAR ".$amount." to taheiya company. Details and respective link is already shared with you via message. Press 1 to conform and 0 to reject. Note if you don't accept your case will be refused by default."]);
    }

    public function callBusy($to)
    {
        // Responses Codes
        // 1: Accept Call   2: Reject Call     3: Busy Call   4: Accept to pay  5:  Reject to pay   6: No answer after three call

        $claim=getClaimByPhoneNumber($to);

        $claim->ivr_status=3;
        $claim->pay_status="";
        $claim->save();

        return json_encode(["message" => "Call Busy"]);
    }

    public function callReject($to)
    {
        // Responses Codes
        // 1: Accept Call   2: Reject Call     3: Busy Call   4: Accept to pay  5:  Reject to pay   6: No answer after three call

        $claim=getClaimByPhoneNumber($to);

        $claim->ivr_status=2;
        $claim->pay_status="";
        $claim->save();
        return json_encode(["message" => "Call Reject"]);

    }

    public function press1($to)
    {
        // Responses Codes
        // 1: Accept Call   2: Reject Call     3: Busy Call   4: Accept to pay  5:  Reject to pay   6: No answer after three call

        $claim=getClaimByPhoneNumber($to);

        $claim->ivr_status=4;
        $claim->pay_status="pending";
        $claim->save();

        return json_encode(["message" => "Thanks for submitting your response. Kindly pay the required amount using the link send to you by message"]);
    }

    public function press0($to)
    {
        // Responses Codes
        // 1: Accept Call   2: Reject Call     3: Busy Call   4: Accept to pay  5:  Reject to pay   6: No answer after three call

        $claim=getClaimByPhoneNumber($to);

        $claim->ivr_status=5;
        $claim->pay_status="rejected";
        $claim->save();

        return json_encode(["message" => "Thanks for submitting your response"]);

    }
}
