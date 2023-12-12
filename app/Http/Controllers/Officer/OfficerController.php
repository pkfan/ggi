<?php

namespace App\Http\Controllers\Officer;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Claim;
use App\Models\Company;
use App\Models\DebDiscount;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Enums\BankSlipStatus;
use App\Models\OfficerTarget;
use App\Models\FinancialCompany;
use App\Models\DebDiscountRequest;
use App\Models\DebtorBankTransfer;
use App\Models\OfficerDiscountRate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Enums\DebDiscountRequestStatus;
use App\Enums\OfficerTargetStatus;
use Illuminate\Database\Eloquent\Builder;

class OfficerController extends Controller
{

    public function companyEmployeeList()
    {
        // $users=User::where('roll',1)->get();
        $users = User::where('roll', 1)->paginate(10);
        return view('admin.employeelist', compact('users'));
    }

    public function addCompanyEmployeeView()
    {
        $company = Company::all();
        return view('admin.companyEmp', compact('company'));
    }

    public function addCompanyEmp(Request $req)
    {
        try {
            $user = new User;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->reg_no = $req->national_id;
            $user->company_id = $req->company;
            $user->password = Hash::make($req->password);
            $user->phone = '+966' . $req->mobile_no;
            $user->roll = 1;
            $user->status = 1;
            $user->save();

            return back()->with('success', 'Company Employee Added Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }


        ///return $req->all();
    }

    public function editCompanyEmployeeView($id)
    {
        $user = User::where('id', $id)->first();
        $company = Company::all();
        return view('admin.editcompanyEmp', compact('user', 'company'));
    }

    public function editCompanyEmp(Request $req)
    {
        $user = User::where('id', $req->emp_id)->first();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->reg_no = $req->national_id;
        $user->company_id = $req->company;
        $user->phone = '+966' . $req->mobile_no;
        $user->save();
        return back()->with('success', 'Company Employee Updated Successfully');
    }
    public function financeCompanyEmployeeList()
    {
        $users = User::where('roll', 3)->get();
        return view('admin.financeemp_list', compact('users'));
    }

    public function addFinanceEmployeeView()
    {
        $company = FinancialCompany::all();
        return view('admin.financeEmp', compact('company'));
    }

    public function addFinanceCompanyEmp(Request $req)
    {
        try {
            $user = new User;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->reg_no = $req->national_id;
            $user->status = 1;
            $user->company_id = $req->company;
            $user->password = Hash::make($req->password);
            $user->phone = '+966' . $req->mobile_no;
            $user->roll = 3;
            $user->save();
            return back()->with('success', 'Finance employee added successfully');
        } catch (\Exception $e) {

            return back()->with('error', 'Something went wrong');
        }
    }
    public function editFinanceCompanyEmployeeView($id)
    {
        $user = User::where('id', $id)->first();
        $company = FinancialCompany::all();
        return view('admin.editfinanceEmp', compact('user', 'company'));
    }
    /////////////////////////////////////////////
    ////////// new methods added by Muhammad Amir
    /////////////////////////////////////////////

    public function officers(Request $request)
    {
        // $users=User::where('roll',1)->get();
        $users = User::with('roles');

        $officers = $users->whereHas('roles', function (Builder $query) {
            $query->where('name', 'officer');
        });


        $officers = $officers->orderByDesc('created_at')->paginate(10);

        // return $officers;
        return view('supervisor.all-officers-list', compact('officers'));
    }

    public function registerOfficer(Request $request)
    {
        return view('supervisor.add-officer');
    }

   public function storeOfficer(Request $request)
    {
        $request->validate([
            'name' => "required|min:3|max:60",
            'email' => "required|email|unique:users,email",
            'national_id' => "required",
            'password' => "required|min:8|max:30",
            'mobile_no' => "required",
            'role' => "required"
        ]);
        try {
            $officer = new User;
            $officer->name = $request->name;
            $officer->email = $request->email;
            $officer->reg_no = $request->national_id;
            $officer->password = Hash::make($request->password);
            $officer->phone = '+966' . $request->mobile_no;
            $officer->additional_phone = '+966' . $request->additional_phone;
            $officer->status = 1;
            $officer->roll = 0;
            $officer->is_super = 0;
            $officer->save();
            $officer->addRole($request->role);
            return redirect()
                ->route('supervisor.all-officers-list')
                ->with('success', 'User added successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function setTargets()
    {
        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        return view('supervisor.set-targets', compact('months'));
    }
    public function editTargets($target_id)
    {
        $target = OfficerTarget::with('officer')->firstWhere('id', $target_id);

        return view('supervisor.edit-targets', compact('target'));
    }

   public function storeTargets(Request $request)
    {
        $request->validate([
            'officer_id' => 'required|numeric',
            'targets' => 'required|numeric',
            'startDate' => 'required',
            'endDate' => 'required'
        ]);
        $startDate = Carbon::createFromFormat('Y M d', $request->startDate)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('Y M d', $request->endDate)->format('Y-m-d');
        $currentDate = now()->format('Y-m-d');
        $overlapStartDate = $startDate;
        $overlapEndDate = $endDate;
        // carbon objects
        $startDateCarbon = Carbon::createFromFormat('Y-m-d', $startDate);
        $endDateCarbon = Carbon::createFromFormat('Y-m-d', $endDate);
        $currentDateCarbon = Carbon::createFromFormat('Y-m-d', $currentDate);
        // if target exisit then supervisor cannot set new target on same date
        // $previousLatestOfficerTarget = OfficerTarget::where('officer_id', $request->officer_id)
        //     ->orderByDesc('end_date')
        //     ->first();
        // if ($previousLatestOfficerTarget) {
        //     $previousLatestDateCarbon = Carbon::createFromFormat('Y-m-d', $previousLatestOfficerTarget->end_date);
        //     if ($startDateCarbon->lte($previousLatestDateCarbon)) {
        //         return back()->withErrors(['Target Exist' => 'Officer current target exist, please edit that target or choose a different date to create new target.']);
        //     }
        // }
        /////////////////////////////////
        // if any request startdate and enddate is overlap any existing officer targets date range then response error
        $overlapTargetViaStartDate = OfficerTarget::where('officer_id', $request->officer_id)
            ->where(function ($query) {
                $query->where('status', OfficerTargetStatus::ACTIVE->value)
                    ->orWhere('status', OfficerTargetStatus::UPCOMMING->value);
            })
            ->where(function ($query) use ($overlapStartDate) {
                $query->where('start_date', '<=', $overlapStartDate)
                    ->where('end_date', '>=', $overlapStartDate);
            })
            ->first();
        $overlapTargetViaEndDate = OfficerTarget::where('officer_id', $request->officer_id)
            ->where(function ($query) {
                $query->where('status', OfficerTargetStatus::ACTIVE->value)
                    ->orWhere('status', OfficerTargetStatus::UPCOMMING->value);
            })
            ->where(function ($query) use ($overlapEndDate) {
                $query->where('start_date', '<=', $overlapEndDate)
                    ->where('end_date', '>=', $overlapEndDate);
            })
            ->first();
            // dd($overlapTargetViaStartDate);
        if ($overlapTargetViaStartDate || $overlapTargetViaEndDate) {
            return back()->withErrors(['Target Exist' => 'Officer current target exist, please edit that target or choose a different date to create new target.']);
        }
        /////////////////////////////////
        $targets = new OfficerTarget();
        $targets->officer_id =  $request->officer_id;
        $targets->total =  $request->targets;
        $targets->pending = $request->targets;
        $targets->start_date =  $startDate;
        $targets->end_date = $endDate;
        // check target date range if it is current
        /*
            -------logic---------
            (startdate <= currentdate <= enddate) = current (active)
            enddate < currentdate = expired
            currentdate < startdate = upcomming
        */
        // check if this is in current date range
        if ($startDateCarbon->lte($currentDateCarbon) && $currentDateCarbon->lte($endDateCarbon)) {
            // check if there is any current active target
            $officerActiveTarget = OfficerTarget::where('officer_id', $request->officer_id)
                ->where('status', OfficerTargetStatus::ACTIVE->value)
                ->first();
            if (!$officerActiveTarget) {
                $targets->status = OfficerTargetStatus::ACTIVE->value;
            } else {
                $endDateActiveTargetCarbon = Carbon::createFromFormat('Y-m-d', $officerActiveTarget->end_date);
                // active officer target enddate less than request start date
                if ($endDateActiveTargetCarbon->lt($startDateCarbon)) {
                    $targets->status = OfficerTargetStatus::UPCOMMING->value;
                } else {
                    return back()->withErrors(['Active Target Overlaps' => 'Officer Active Targets overlap, requested officer target date range overlap existing active officer targets']);
                }
            }
        } elseif ($endDateCarbon->lte($currentDate)) {
            return back()->withErrors(['Expire Officer Target' => 'You cannot add EXPIRED officer target, please add current target or upcomming target for officer.']);
        } elseif ($currentDateCarbon->lte($startDateCarbon)) {
            $targets->status = OfficerTargetStatus::UPCOMMING->value;
        } else {
            return back()->withErrors(['Invalid Date Range' => 'Invalid Date range for officer target, please choose different date to set target for officer']);
        }
        $targets->save();
        return redirect()
            ->route('supervisor.officer.targets')
            ->with('success', "Officer targets set successfully");
    }
    public function updateTargets(Request $request)
    {
        $request->validate([
            'target_id' => 'required|numeric',
            'officer_id' => 'required|numeric',
            'targets' => 'required|numeric',
            'startDate' => 'required',
            'endDate' => 'required'
        ]);

        $startDate = Carbon::createFromFormat('Y M d', $request->startDate)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('Y M d', $request->endDate)->format('Y-m-d');
        $overlapStartDate = $startDate;
        $overlapEndDate = $endDate;


        $officerTarget = OfficerTarget::firstWhere('id', $request->target_id);

        if($officerTarget->status == OfficerTargetStatus::COMPLETED->value || $officerTarget->status == OfficerTargetStatus::EXPIRED->value ){
            return back()->with('error', 'You cannot edit completed or expired targets of officer.');
        }


        // if any request startdate and enddate is overlap any existing officer targets date range then response error
        $overlapTargetViaStartDate = OfficerTarget::where('officer_id',$request->officer_id)
                    ->where('id','!=', $request->target_id)
                    ->where(function ($query){
                        $query->where('status', OfficerTargetStatus::ACTIVE->value)
                            ->orWhere('status', OfficerTargetStatus::UPCOMMING->value);
                    })
                    ->where(function ($query)use($overlapStartDate){
                        $query->where('start_date', '<=', $overlapStartDate)
                            ->where('end_date','>=', $overlapStartDate);
                    })
                    ->first();

        $overlapTargetViaEndDate = OfficerTarget::where('officer_id',$request->officer_id)
                    ->where('id','!=', $request->target_id)
                    ->where(function ($query){
                        $query->where('status', OfficerTargetStatus::ACTIVE->value)
                            ->orWhere('status', OfficerTargetStatus::UPCOMMING->value);
                    })
                    ->where(function ($query)use($overlapEndDate){
                        $query->where('start_date', '<=', $overlapEndDate)
                            ->where('end_date','>=', $overlapEndDate);
                    })
                    ->first();


        if($overlapTargetViaStartDate || $overlapTargetViaEndDate){
            return back()->withErrors(['Date Range Overlap' => 'Requested Dates overlap with existing officer targets, please choose different date to avoid dates overlap.']);
        }

        $targets = OfficerTarget::where('id', $request->target_id)->update([
            'total' => $request->targets,
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);

        return redirect()
            ->route('supervisor.officer.targets')
            ->with('success', "Officer targets updated successfully");
    }
    public function officerTargets(Request $request)
    {
        $year = $request->year ?? now()->year;

        $targets = OfficerTarget::with('officer')
            ->when($request->officer_id && $request->officer_id != 'all', function ($query) use ($request) {
                $query->where('officer_id', $request->officer_id);
            })
            ->when($request->month && $request->month != 'all', function ($query) use ($request) {
                $query->whereMonth('start_date', $request->month);
            })
            ->whereYear('start_date', $year)
            ->orderByDesc('created_at')
            ->paginate(15);

        $officers = User::whereHasRole('officer')->get();



        return view('supervisor.targets', compact('targets', 'officers'));
    }

    public function officersAchievedTargets()
    {

        $collectedClaims = \App\Models\CollectedClaim::with('claim.officer')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('supervisor.achieved-targets', compact('collectedClaims'));
    }

    public function oneOfficerAchievedTargets()
    {

        $collectedClaims = \App\Models\CollectedClaim::with('claim.officer')
            ->whereHas('claim', function (Builder $query) {
                $query->where('is_assign', auth()->user()->id);
            })
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('officer.achieved-targets', compact('collectedClaims'));
    }



    public function officerTargetStatistics()
    {
        $targets = OfficerTarget::where('officer_id', auth()->user()->id)
            ->orderByDesc('start_date')
            ->get();

        return view('officer.targets-statistics', compact('targets'));
    }
    public function officerTargetsApi(Request $request)
    {

        $year = $request->year ?? now()->year;

        $targets = OfficerTarget::where('officer_id', $request->user_id)
            ->whereYear('start_date', $year)
            ->orderBy('start_date')
            ->get();

        $transformOfficerWithTargets = [
            'year' => $year,
            'targets' => [],
        ];

        foreach ($targets as $target) {
            // $year = Carbon::createFromFormat('Y-m-d', $target->start_date)->format('Y');
            $month = Carbon::createFromFormat('Y-m-d', $target->start_date)->format('M');
            $transformOfficerWithTargets['targets'][$month] = $target->achieved;
        }

        return $transformOfficerWithTargets;
    }

    public function storeDebtorDiscountRate(Request $request)
    {
        $request->validate([
            'claim_id' => 'required|integer',
            'total_claim_amount' => 'required',
            'percent' => 'required|numeric|max:100',
            'after_discount' => 'required'
        ]);
        // $officerDiscountRate = OfficerDiscountRate::firstWhere('officer_id', auth()->user()->id);
        $requested_percent = (float) $request->percent;
        $assignedOfficerDiscount = (float) $request->officer_discount_rate ?? 0;
        $defaultOfficerDiscount = 10;
        /*
        if officer does not have any assigned discount (OfficerDiscountRate::class)
        then apply default system discount
        */
        if (!$assignedOfficerDiscount) {
            $assignedOfficerDiscount = $defaultOfficerDiscount;
        }
        $debDiscount = new DebDiscount();
        $debDiscount->claim_id = $request->claim_id;
        $debDiscount->total_claim_amount = $request->total_claim_amount;
        $debDiscount->after_discount = $request->after_discount;
        $debDiscount->requested_percentage = $requested_percent;
        $debDiscount->officer_percentage = $assignedOfficerDiscount;
        $debDiscount->status = DebDiscountRequestStatus::PENDING->value;
        $debDiscount->requested_by = auth()->user()->id;
        if ($assignedOfficerDiscount && $requested_percent > $assignedOfficerDiscount) {
            // notify to all supervisor/super-admin/manager here or create/update table etc
            $adminUsers = User::whereHasRole(['super-admin', 'manager', 'director','admin'])->get();
            $supervisors = User::whereHasRole(['supervisor'])->get();
            $officerName = auth()->user()->name;
            foreach ($adminUsers as $adminUser) {
                Notification::create([
                    'from' => auth()->user()->id,
                    'to' => $adminUser->id,
                    'message' => "discount request for claim GGI00{$request->claim_id} by officer {$officerName}.",
                    'type' => 'Discount request',
                    'read' => false,
                    'link' =>  route('admin.officers.discount.requests',null, false)
                ]);
            }
            foreach ($supervisors as $supervisor) {
                Notification::create([
                    'from' => auth()->user()->id,
                    'to' => $supervisor->id,
                    'message' => "discount request for claim GGI00{$request->claim_id} by officer {$officerName}.",
                    'type' => 'Discount request',
                    'read' => false,
                    'link' =>  route('supervisor.officers.discount.requests',null, false)
                ]);
            }
        } else {
            // discard/remove all previous approve/pending discounts of officer
            DebDiscount::where('claim_id', $request->claim_id)
                ->where(function ($query) {
                    $query->where('status', DebDiscountRequestStatus::APPROVE->value)
                        ->orWhere('status', DebDiscountRequestStatus::PENDING->value);
                })->update([
                    'status' => DebDiscountRequestStatus::DISCARD->value
                ]);
            $debDiscount->status = DebDiscountRequestStatus::APPROVE->value;
            $debDiscount->process_date = now();
            // apply approved discount to claim
            // $claim = Claim::firstWhere('id',$request->claim_id);
            // $totalAmount = (float) $claim->rec_amt;
            // $discountedAmount = ($requested_percent/100) * $totalAmount;
            // $amountAfterDiscount = $totalAmount - $discountedAmount;
            Claim::firstWhere('id', $request->claim_id)->update([
                'amount_after_discount' => $request->after_discount
            ]);
        }
        $debDiscount->save();
        // dd($debDiscount);
        if (!$debDiscount) {
            return back()->with('error', 'Something went wrong, please try later');
        }
        return back()->with('success', 'Debtor Discount set successfully');
    }

    public function claimsDiscountHistory()
    {
        $debDiscounts = DebDiscount::with('processor')
            ->where('requested_by', auth()->user()->id)
            ->paginate(10);

        return view('officer.discount-history', compact('debDiscounts'));
    }

    public function debtorBankTransferSlip(Request $request)
    {
        $request->validate([
            'claim_id' => 'required',
            'screenshot' => 'required|mimes:png,jpg,jpeg,pdf,doc,docx|max:10240',
            // 'amount' => 'required|numeric',
            // 'paid_at'=> 'required|date'
        ]);
        // dd($request);
        $bankSlipFileName = 'bank-slip-' . $request->claim_id . '--' . time() . '.' . $request->screenshot->getClientOriginalExtension();
        $filepath = 'bank-slips/' . $bankSlipFileName;
        $request->screenshot->move(storage_path('/app/public/bank-slips'), $bankSlipFileName);
        DebtorBankTransfer::create([
            'claim_id' => $request->claim_id,
            // 'amount'=> $request->amount,
            // 'paid_at'=> $request->paid_at,
            'screenshot' => $filepath,
            'debtor_ip' => $request->ip(),
            'status' => BankSlipStatus::UNVERIFIED->value
        ]);
        return back()->with('success', 'لقد استلمنا نسخة من قسيمة البنك الخاصة بك، وسنقوم بمراسلتك بعد التحقق منها قريبًا.');
    }
}
