<?php

namespace App\Http\Controllers\Dashboard;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Month;
use App\Enum\StatusOpen;
use App\Enum\StatusActive;
use Illuminate\Http\Request;
use App\Models\FinanceCalendar;
use Illuminate\Validation\Rule;
use App\Models\financeClnPeriod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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

        $dataValidated = $request->validated();
        $data = array_merge($dataValidated, [
            'status' => StatusActive::Inactive,
        ]);
        FinanceCalendar::create($data);

        session()->flash('success', 'تم أضافة السنه المالية بنجاح!');
        return redirect()->route('dashboard.financeCalendars.index');
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

        if ($financeCalendar->status === StatusActive::Active) {
            return redirect()->route('dashboard.financeCalendars.index')->withErrors(['error' => 'عفوآ سنه مالية مفتوحة لا يمكن تعديلها ']);
        }
        $financeCalendar->fill($request->validated());

        $financeCalendar->update();

        session()->flash('success', 'تم تعديل السنه المالية بنجاح!');
        return redirect()->route('dashboard.financeCalendars.index');
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
                'message' => 'عفوآ، سنة مالية مفتوحة لا يمكن تعديلها.'
            ]);
        }

        $flagDelete = $financeCalendar->delete();

        if ($flagDelete) {
            FinanceClnPeriod::where('finance_calendar_id', $id)->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'تم حذف السنة المالية بنجاح!'
        ]);
    }

    public function open($id)
    {
        $data = FinanceCalendar::select('*')->where(['id' => $id])->first();
        if (empty($data)) {
            return redirect()->route('dashboard.financeCalendars.index')->withErrors(['error' => 'عفوآ حدث خطأ ']);
        }
        if ($data->status === StatusActive::Active) {
            return redirect()->route('dashboard.financeCalendars.index')->withErrors(['error' => ' عفوا لايمكن فتح السنة المالية في هذه الحالة']);
        }

        $CheckDataOpenCounter = FinanceCalendar::where(['status' => StatusActive::Active])->count();
        if ($CheckDataOpenCounter > 0) {
            return redirect()->back()->with(['error' => '   عفوا هناك بالفعل سنة مالية مازالت مفتوحة ']);
        }
        $dataToUpdate['status'] = StatusActive::Active;
        FinanceCalendar::where(['id' => $id])->update($dataToUpdate);

        session()->flash('success', 'تم تحديث البيانات بنجاح!');

        return redirect()->route('dashboard.financeCalendars.index');
    }




    public function close($id)
    {
        // البحث عن بيانات السنة المالية باستخدام المعرف المقدم
        $data = FinanceCalendar::select('*')->where('id', $id)->first();

        // التحقق من وجود البيانات
        if (empty($data)) {
            return redirect()->back()->with(['error' => 'عفوا، لا توجد بيانات للسنة المالية المحددة.']);
        }


        $dataToUpdate = [
            'status' =>  StatusOpen::Archive,
        ];

        FinanceCalendar::where('id', $id)->update($dataToUpdate);

        session()->flash('success', 'تم تحديث البيانات بنجاح!');
        return redirect()->route('dashboard.financeCalendars.index');
    }
}