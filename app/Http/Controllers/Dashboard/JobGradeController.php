<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\JobGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\JobGradeRequest;

class JobGradeController extends Controller
{

    protected array $middleware = [
        'permission: الدرجات الوظيفية' => ['only' => ['index']],
        'permission:عرض الدرجات الوظيفية' => ['only' => ['show']],
        'permission:اضافة الدرجات الوظيفية' => ['only' => ['create', 'store']],
        'permission:تعديل الدرجات الوظيفية' => ['only' => ['edit', 'update']],
        'permission:حذف الدرجات الوظيفية' => ['only' => ['destroy']],
    ];


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JobGrade::orderByDesc('id')->paginate(10);
        return view('dashboard.jobGrades.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.jobGrades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobGradeRequest $request)
    {
        try {
            DB::beginTransaction();
            $JobGrade = $request->validated();
            JobGrade::create($JobGrade);
            DB::commit();
            session()->flash('success', 'تم أضافة الدرجه الوظيفية بنجاح');
            return redirect()->route('dashboard.jobGrades.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'عفوا حدث خطأ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JobGrade $jobGrade)
    {

        return view('dashboard.jobGrades.show', compact('jobGrade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobGrade $jobGrade)
    {

        return view('dashboard.jobGrades.edit', compact('jobGrade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobGradeRequest $request, JobGrade $jobGrade)
    {
        try {
            DB::beginTransaction();
            $jobGrade->fill($request->validated());

            $jobGrade->update();
            DB::commit();
            session()->flash('success', 'تم تعديل الدرجه الوظيفية بنجاح');
            return redirect()->route('dashboard.jobGrades.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'عفوا حدث خطأ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobGrade $jobGrade)
    {
        $jobGrade->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الدرجه الوظيفية بنجاح!'
        ]);
    }
}