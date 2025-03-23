<?php

namespace App\Http\Controllers\Dashboard;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Month;
use App\Enum\StatusActive;
use Illuminate\Http\Request;
use App\Models\FinanceCalendar;
use Illuminate\Validation\Rule;
use App\Models\financeClnPeriod;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Auth;
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
            'created_by' => auth()->guard('admin')->user()->id,
            'status' => StatusActive::Inactive,
        ]);
        $financeClnPeriod = FinanceCalendar::create($data);

        if ($financeClnPeriod) {
            $insertdataOfFinanceCalendar = FinanceCalendar::select('id', 'finance_yr')->where('id', $financeClnPeriod->id)->first();

            $startDate = new DateTime($request->start_date);
            $endDate = new DateTime($request->end_date);
            $endDate->modify('first day of next month'); // To include the end date month in the period
            $dateInterval = new DateInterval('P1M'); // P1M = Period of 1 Month
            $datePeriod = new DatePeriod($startDate, $dateInterval, $endDate);

            foreach ($datePeriod as $date) {
                $dataMonth = [];
                $dataMonth['finance_calendar_id'] = $insertdataOfFinanceCalendar->id;

                $MonthName_en = $date->format('F'); // 'F': Full month name in English
                $dataParentMonth = Month::select('id')->where('name->en', $MonthName_en)->first();
                $dataMonth['month_id'] = $dataParentMonth ? $dataParentMonth->id : null;
                $dataMonth['finance_yr'] = $insertdataOfFinanceCalendar->finance_yr;
                $dataMonth['start_date_month'] = $date->format('Y-m-01');
                $dataMonth['end_date_month'] = $date->format('Y-m-t');
                $dataMonth['year_and_month'] = $date->format('Y-m');
                $CalcnumOfDays = strtotime($dataMonth['end_date_month']) - strtotime($dataMonth['start_date_month']);
                $dataMonth['number_of_days'] = round($CalcnumOfDays / (60 * 60 * 24)) + 1;
                $dataMonth['updated_at'] = now();
                $dataMonth['created_at'] = now();
                $dataMonth['created_by'] = auth()->guard('admin')->user()->id;
                $dataMonth['updated_by'] = auth()->guard('admin')->user()->id;

                financeClnPeriod::insert($dataMonth);
            }
        }
        session()->flash('success', 'تم أضافة السنه المالية بنجاح!');
        return redirect()->route('dashboard.financeCalendars.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $finance_cln_periods = FinanceClnPeriod::where('finance_calendar_id', $id)->get();
        return view('dashboard.financeCalendars.show', compact('finance_cln_periods'));
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
    public function update(FinanceCalendarRequest $request, $id)
    {

        $data = FinanceCalendar::select('*')->where(['id' => $id])->first();
        if (empty($data)) {
            return redirect()->back()->with(['error' => ' عفوا حدث خطأ ']);
        }
        if ($data->status === StatusActive::Active) {
            return redirect()->route('dashboard.financeCalendars.index')->withErrors(['error' => 'عفوآ سنه مالية مفتوحة لا يمكن تعديلها ']);
        }
        $validator = Validator::make($request->all(), [
            'finance_yr' => ['required', Rule::unique('finance_calendars')->ignore($id)],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => ' عفوا اسم السنة المالية مسجل من قبل'])->withInput();
        }

        $FinanceCalendar['finance_yr'] = $request->finance_yr;
        $FinanceCalendar['finance_yr_desc'] = $request->finance_yr_desc;
        $FinanceCalendar['start_date'] = $request->start_date;
        $FinanceCalendar['end_date'] = $request->end_date;
        $FinanceCalendar['updated_by'] = auth()->guard('admin')->user()->id;
        $UpdateData = FinanceCalendar::where(['id' => $id])->update($FinanceCalendar);
        if ($UpdateData) {
            if ($data['start_date'] != $request->start_date or $data['end_date'] != $request->end_date) {
                $flagDelete = FinanceClnPeriod::where(['finance_calendar_id' => $id])->delete();
                if ($flagDelete) {
                    $startDate = new DateTime($request->start_date);
                    $endDate = new DateTime($request->end_date);
                    $dareInterval = new DateInterval('P1M');
                    $datePerioud = new DatePeriod($startDate, $dareInterval, $endDate);
                    foreach ($datePerioud as $date) {
                        $dataMonth['finance_calendar_id'] = $id;
                        $Montname_en = $date->format('F');
                        $dataParentMonth = Month::select('id')->where(['name->en' => $Montname_en])->first();
                        $dataMonth['month_id'] = $dataParentMonth['id'];
                        $dataMonth['finance_yr'] = $FinanceCalendar['finance_yr'];
                        $dataMonth['start_date_month'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                        $dataMonth['end_date_month'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                        $dataMonth['year_and_month'] = date('Y-m', strtotime($date->format('Y-m-d')));
                        $datediff = strtotime($dataMonth['end_date_month']) - strtotime($dataMonth['start_date_month']);
                        $dataMonth['number_of_days'] = round($datediff / (60 * 60 * 24)) + 1;
                        $dataMonth['updated_at'] = now();
                        $dataMonth['created_at'] = now();
                        $dataMonth['created_by'] = auth()->guard('admin')->user()->id;
                        $dataMonth['updated_by'] = auth()->guard('admin')->user()->id;
                        $dataMonth['start_date_fp'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                        $dataMonth['end_date_fp'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                        FinanceClnPeriod::create($dataMonth);
                    }
                }
            }
        }

        session()->flash('success', 'تم تعديل السنه المالية بنجاح!');
        return redirect()->route('dashboard.financeCalendars.index');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function open($id)
    {
        try {

            $data = FinanceCalendar::select('*')->where(['id' => $id])->first();
            if (empty($data)) {
                return redirect()->back()->with(['error' => ' عفوا حدث خطأ ']);
            }
            if ($data['is_open'] != 0) {
                return redirect()->back()->with(['error' => ' عفوا لايمكن فتح السنة المالية في هذه الحالة']);
            }
            $CheckDataOpenCounter = FinanceCalendar::where(['is_open' => 1])->count();
            if ($CheckDataOpenCounter > 0) {
                return redirect()->back()->with(['error' => '   عفوا هناك بالفعل سنة مالية مازالت مفتوحة ']);
            }
            $dataToUpdate['is_open'] = 1;
            $dataToUpdate['updated_by'] = auth()->guard('admin')->user()->id;
            $flag = FinanceCalendar::where(['id' => $id])->update($dataToUpdate);

            return redirect()->route('dashboard.financeCalendars.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => ' عفوا حدث خطأ '] . $ex->getMessage());
        }
    }

    public function close($id)
    {
        try {

            // ابدأ معاملة قاعدة البيانات
            DB::beginTransaction();

            // البحث عن بيانات السنة المالية باستخدام المعرف المقدم
            $data = FinanceCalendar::select('*')->where('id', $id)->first();

            // التحقق من وجود البيانات
            if (empty($data)) {
                return redirect()->back()->with(['error' => 'عفوا، لا توجد بيانات للسنة المالية المحددة.']);
            }

            // البحث عن الشهور المفتوحة أو المعلقة
            $finance_cln_periods = FinanceClnPeriod::where('finance_calendars_id', $id)
                ->whereIn('is_open', [0, 1]) // تحقق من الشهور المعلقة أو المفتوحة
                ->count();

            // إذا كان هناك شهور معلقة أو مفتوحة
            if ($finance_cln_periods > 0) {
                return redirect()->back()->with(['error' => 'عفوا، هناك شهور مالية معلقة أو مفتوحة. لا يمكن غلق السنة المالية حتى يتم أرشفة جميع الشهور.']);
            }

            // تحديث حالة السنة المالية إلى مؤرشف (مغلقة)
            $dataToUpdate = [
                'is_open' => 2,
                'updated_by' => auth()->guard('admin')->user()->id,
            ];

            $flag = FinanceCalendar::where('id', $id)->update($dataToUpdate);

            if ($flag) {
                // إذا تم التحديث بنجاح، قم بتأكيد المعاملة
                DB::commit();

                return redirect()->route('dashboard.financeCalendars.index')->with(['success' => 'تم غلق السنة المالية بنجاح.']);
            } else {
                // إذا لم يتم التحديث، ارجع بخطأ
                DB::rollBack();

                return redirect()->back()->with(['error' => 'حدث خطأ أثناء تحديث البيانات.']);
            }
        } catch (\Exception $e) {
            // في حالة حدوث خطأ، قم بالتراجع عن المعاملة
            DB::rollBack();
            return redirect()->back()->with('error', 'حدث خطأ أثناء التعديل: ' . $e->getMessage());
        }
    }
}
