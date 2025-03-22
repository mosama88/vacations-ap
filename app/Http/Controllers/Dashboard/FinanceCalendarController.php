<?php

namespace App\Http\Controllers\Dashboard;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Month;
use App\Enum\StatusActive;
use Illuminate\Http\Request;
use App\Models\FinanceCalendar;
use App\Models\financeClnPeriod;
use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Auth;
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
        return redirect()->route('dashboard.financeCalendars.index')->with('success', 'تم أضافة السنه المالية بنجاح');
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
        return view('dashboard.financeCalendars.edit', compact('financeCalendar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}