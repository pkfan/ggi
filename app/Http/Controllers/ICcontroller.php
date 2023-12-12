<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ICcontroller extends Controller
{
    public function index()
    {
        return view('ic.index');
    }


    public function AddClaims()
    {
        return view('ic.claims.AddClaims');
    }


    public function Claimslist()
    {
        return view('ic.claims.Claimslist');
    }


    public function ApprovedClaims()
    {
        return view('ic.claims.ApprovedClaims');
    }


    public function AddRequest()
    {
        return view('ic.FileRequest.AddRequest');
    }


    public function ViewRequest()
    {
        return view('ic.FileRequest.ViewRequest');
    }

    public function RejectedRequest()
    {
        return view('ic.FileRequest.RejectedRequest');
    }
    

    public function AddELM()
    {
        return view('ic.ELMClaims.AddELM');
    }


    public function ViewELM()
    {
        return view('ic.ELM Claims.ViewELM');
    }

    public function RejectedELM()
    {
        return view('ic.ELM Claims.RejectedELM');
    }

    public function ValidObjection()
    {
        return view('ic.Objection.ValidObjection');
    }


    public function InvalidObjection()
    {
        return view('ic.Objection.InvalidObjection');
    }


    public function CaseClosedObjection()
    {
        return view('ic.Objection.CaseClosedObjection');
    }

    public function PartialDetail()
    {
        return view('ic.PartialDetail');
    }

    public function ReportSummary()
    {
        return view('ic.ReportSummary');
    }
}
