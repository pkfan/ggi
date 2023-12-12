<?php

namespace App\Http\Controllers\Admin;

use App\Models\Loan;
use App\Models\User;
use App\Models\Claim;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\FinancialCompany;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyController extends Controller
{
    public function viewCompany() {
        $companies = User::where(['roll' => 1,])->get();
        return view('admin.view_company', compact('companies'));
    }
     // Toogle Company Status
     public function toogleCompanyStatus(Request $req)
     {
         $comp = User::where(['roll' => 1, 'id' => $req->id])->first();

         if ($comp->status == 0) {
             $comp->status = 1;
             $comp->save();

             session()->put('success', 'Company Status Changed');
             return redirect()->route('AdminViewCompany');
         } else {
             $comp->status = 0;
             $comp->save();

             session()->put('success', 'Company Status Changed');
             return redirect()->route('AdminViewCompany');
         }
     }

    public function financeCompany() {
        $fcompany = User::where('roll', 3)->get();
        return view('admin.viewfcompany', compact('fcompany'));
    }

    public function assignFcom(Request $req)
    {
        $loan = new Loan;
        $loan->claim_id = $req->claim_id;
        $loan->company_id = $req->finance;
        $loan->status = 0;
        $loan->save();
        Alert::success('Assigned', 'Finance Company Assigned');
        return back();
    }

    public function companiesList() {
        // $companies=Company::all();
        $companies = Company::paginate(10);
        return view('admin.companieslist', compact('companies'));
    }

    public function editCompanyView($id) {
        $company = Company::where('id', $id)->first();
        return view('admin.editcompany', compact('company'));
    }

    public function editCompany(Request $req)
    {
        $company = Company::where('id', $req->company_id)->first();

        $company->name = $req->name;
        $company->companyType = $req->companyType;
        $company->CrNo = $req->CrNo;
        $company->mobile_no = $req->mobile_no;
        $company->save();
        if ($req->file != null) {
            if ($req->hasfile('file')) {
                unlink(storage_path() . '/app/public/' . $company->document);

                $file = $req->file('file');
                $name = time() . '' . rand(3, 999);
                $ext = $file->getClientOriginalExtension();
                $filepath = 'Companies/' . $company->id . '/';
                $file->move(storage_path() . '/app/public/' . $filepath, $name . '.' . $ext);
                // $file->move(storage_path().'/uploads/'.$req->vehical_id.'/missing_parts', $name.'.'.$ext);
                $imgData = $filepath . $name . '.' . $ext;

                // $file=json_encode($imgData);
                $company->document = $imgData;
                $company->save();
            }
        }
        return back()->with('success', 'Company Upadated Successfully');
    }

    public function addCompanyView() {
        return view('admin.addcompany');
    }

    public function addCompany(Request $req)
    {
        $company = new Company;
        $company->name = $req->name;
        $company->companyType = $req->companyType;
        $company->CrNo = $req->CrNo;
        $company->mobile_no = $req->mobile_no;
        $company->save();
        //$company->document=$req->document;
        if ($req->hasfile('file')) {

            $file = $req->file('file');
            $name = time() . '' . rand(3, 999);
            $ext = $file->getClientOriginalExtension();
            $filepath = 'Companies/' . $company->id . '/';
            $file->move(storage_path() . '/app/public/' . $filepath, $name . '.' . $ext);
            // $file->move(storage_path().'/uploads/'.$req->vehical_id.'/missing_parts', $name.'.'.$ext);
            $imgData = $filepath . $name . '.' . $ext;

            // $file=json_encode($imgData);
            $company->document = $imgData;
            $company->save();
        }
        return back()->with('success', 'Company Added Successfully');
    }

    public function financeCompaniesList() {
        $financies = FinancialCompany::all();
        return view('admin.financecompany_list', compact('financies'));
    }

    public function addFinanceCompanyView() {
        return view('admin.addfinancecompany');
    }

    public function addFinanceCompany(Request $req)
    {
        $company = new FinancialCompany;
        $company->name = $req->name;
        $company->CrNo = $req->CrNo;
        $company->mobile_no = $req->mobile_no;
        $company->save();
        //$company->document=$req->document;
        if ($req->hasfile('file')) {

            $file = $req->file('file');
            $name = time() . '' . rand(3, 999);
            $ext = $file->getClientOriginalExtension();
            $filepath = 'FinanceCompanies/' . $company->id . '/';
            $file->move(storage_path() . '/app/public/' . $filepath, $name . '.' . $ext);
            // $file->move(storage_path().'/uploads/'.$req->vehical_id.'/missing_parts', $name.'.'.$ext);
            $imgData = $filepath . $name . '.' . $ext;

            // $file=json_encode($imgData);
            $company->document = $imgData;
            $company->save();
        }
        return back()->with('success', 'Financial Company Added Successfully');
    }

    public function financeCompanyView($id) {
        $company = FinancialCompany::where('id', $id)->first();
        return view('admin.editfinancecompany', compact('company'));
    }

    public function editfinanceCompany(Request $req)
    {
        $company = FinancialCompany::where('id', $req->company_id)->first();

        $company->name = $req->name;
        $company->CrNo = $req->CrNo;
        $company->mobile_no = $req->mobile_no;
        $company->save();
        if ($req->file != null) {
            if ($req->hasfile('file')) {
                unlink(storage_path() . '/app/public/' . $company->document);

                $file = $req->file('file');
                $name = time() . '' . rand(3, 999);
                $ext = $file->getClientOriginalExtension();
                $filepath = 'Companies/' . $company->id . '/';
                $file->move(storage_path() . '/app/public/' . $filepath, $name . '.' . $ext);
                // $file->move(storage_path().'/uploads/'.$req->vehical_id.'/missing_parts', $name.'.'.$ext);
                $imgData = $filepath . $name . '.' . $ext;

                // $file=json_encode($imgData);
                $company->document = $imgData;
                $company->save();
            }
        }

        return back()->with('success', 'Updated Successfully');
    }

}

