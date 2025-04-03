<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\JobGrade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\JobGradeRequest;

class JobGradeController extends Controller
{
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
        $branches = $request->validated();
        $data = array_merge($branches, [
            'created_by' => auth()->guard('employee')->user()->id,
        ]);
        JobGrade::create($data);
        session()->flash('success', 'تم أضافة الدرجه الوظيفية بنجاح');

        return redirect()->route('dashboard.jobGrades.index');
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
        $jobGrade->fill($request->validated());
        $jobGrade->updated_by = auth()->guard('employee')->user()->id;

        $jobGrade->update();
        session()->flash('success', 'تم تعديل الدرجه الوظيفية بنجاح');

        return redirect()->route('dashboard.jobGrades.index');
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