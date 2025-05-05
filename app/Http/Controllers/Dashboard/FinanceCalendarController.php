<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Employee;
use App\Enum\StatusActive;
use App\Enum\EmployeeStatus;
use App\Models\LeaveBalance;
use Illuminate\Http\Request;
use App\Models\FinanceCalendar;
use App\Enum\LeaveBalanceStatus;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\FinanceCalendarRequest;



class FinanceCalendarController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = FinanceCalendar::orderByDesc('id')->get();
        return view('dashboard.financeCalendars.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.financeCalendars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FinanceCalendarRequest $request)
    {
        try {
            DB::beginTransaction();

            $dataValidated = $request->validated();
            $data = array_merge($dataValidated, [
                'status' => StatusActive::Inactive,
            ]);
            DB::commit();
            FinanceCalendar::create($data);
            session()->flash('success', 'تم أضافة السنه المالية بنجاح!');
            return redirect()->route('dashboard.financeCalendars.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'عفوا حدث خطأ']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FinanceCalendar $financeCalendar)
    {

        return view('dashboard.financeCalendars.show', compact('financeCalendar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinanceCalendar $financeCalendar)
    {
        if ($financeCalendar->status === StatusActive::Active) {
            return redirect()->back()->withErrors(['error' => 'عفوآ سنه مالية مفتوحة لا يمكن تعديلها ']);
        }

        return view('dashboard.financeCalendars.edit', compact('financeCalendar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinanceCalendarRequest $request, FinanceCalendar $financeCalendar)
    {
        try {
            DB::beginTransaction();
            if ($financeCalendar->status === StatusActive::Active) {
                return redirect()->route('dashboard.financeCalendars.index')->withErrors(['error' => 'عفوآ سنه مالية مفتوحة لا يمكن تعديلها ']);
            }
            $financeCalendar->fill($request->validated());
            DB::commit();

            $financeCalendar->update();

            session()->flash('success', 'تم تعديل السنه المالية بنجاح!');
            return redirect()->route('dashboard.financeCalendars.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'عفوا حدث خطأ']);
        }
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {

        $financeCalendar = FinanceCalendar::findOrFail($id);

        if ($financeCalendar->status === StatusActive::Active) {
            return response()->json([
                'error' => true,
                'message' => 'عفوآ، سنة مالية مفتوحة لا يمكن حذفها.'
            ]);
        }

        $financeCalendar->delete();



        return response()->json([
            'success' => true,
            'message' => 'تم حذف السنة المالية بنجاح!'
        ]);
    }


    public function open($id)
    {
        $data = FinanceCalendar::find($id);

        if (!$data) {
            return redirect()->route('dashboard.financeCalendars.index')->withErrors(['error' => 'عفوا حدث خطأ']);
        }

        if ($data->status === StatusActive::Active) {
            return redirect()->route('dashboard.financeCalendars.index')->withErrors(['error' => ' عفوا لايمكن فتح السنة المالية في هذه الحالة']);
        }

        $CheckDataOpenCounter = FinanceCalendar::where('status', StatusActive::Active)->count();
        if ($CheckDataOpenCounter > 0) {
            return redirect()->back()->withErrors(['error' => ' عفوا هناك بالفعل سنة مالية مازالت مفتوحة']);
        }
        try {
            DB::beginTransaction();
            $data->status = StatusActive::Active;

            DB::commit();
            if ($data->save()) {
                $this->createLeaveBalancesForAllEmployees($data); 
            }

            session()->flash('success', 'تم تحديث البيانات بنجاح!');
            return redirect()->route('dashboard.financeCalendars.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'عفوا حدث خطأ']);
        }
    }



    public function close($id)
    {
        try {
            DB::beginTransaction();
            $data = FinanceCalendar::find($id);

            if (empty($data)) {
                return redirect()->back()->with(['error' => 'عفوا، لا توجد بيانات للسنة المالية المحددة.']);
            }

            DB::commit();
            $data->update([
                'status' => StatusActive::Archive,
            ]);


            session()->flash('success', 'تم تحديث البيانات بنجاح!');
            return redirect()->route('dashboard.financeCalendars.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'عفوا حدث خطأ']);
        }
    }



    protected function createLeaveBalancesForAllEmployees(FinanceCalendar $financeCalendar)
    {
        $total_days_emergency = 7;

        $employees = Employee::where('status', EmployeeStatus::Active)->get();

        foreach ($employees as $employee) {
            $exists = LeaveBalance::where('employee_id', $employee->id)
                ->where('finance_calendar_id', $financeCalendar->id)
                ->exists();

            if (!$exists) {
                LeaveBalance::create([
                    'finance_calendar_id' => $financeCalendar->id,
                    'employee_id' => $employee->id,
                    'total_days' => $employee->total_days_balance,
                    'remainig_days' => $employee->total_days_balance,
                    'used_days' => 0,
                    'total_days_emergency' => $total_days_emergency,
                    'remainig_days_emergency' => $total_days_emergency,
                    'used_days_emergency' => 0,
                    'status' => LeaveBalanceStatus::Open,
                    'created_by' => Auth::id(),
                ]);
            }
        }
    }
}