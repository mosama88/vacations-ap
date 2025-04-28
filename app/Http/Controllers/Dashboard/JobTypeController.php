<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\JobType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\JobTypeRequest;

class JobTypeController extends Controller
{
    protected array $middleware = [
        'permission: نوع الوظيفه' => ['only' => ['index']],
        'permission:عرض نوع الوظيفه' => ['only' => ['show']],
        'permission:اضافة نوع الوظيفه' => ['only' => ['create', 'store']],
        'permission:تعديل نوع الوظيفه' => ['only' => ['edit', 'update']],
        'permission:حذف نوع الوظيفه' => ['only' => ['destroy']],
    ];


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JobType::orderByDesc('id')->paginate(10);
        return view('dashboard.jobTypes.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.jobTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobTypeRequest $request)
    {
        $jobTypes = $request->validated();

        JobType::create($jobTypes);
        session()->flash('success', 'تم أضافة الوظيفه بنجاح');

        return redirect()->route('dashboard.jobTypes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobType $jobType)
    {

        return view('dashboard.jobTypes.show', compact('jobType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobType $jobType)
    {

        return view('dashboard.jobTypes.edit', compact('jobType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobTypeRequest $request, JobType $jobType)
    {
        $jobType->fill($request->validated());

        $jobType->update();
        session()->flash('success', 'تم تعديل الوظيفه بنجاح');

        return redirect()->route('dashboard.jobTypes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobType $jobType)
    {
        $jobType->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الوظيفه بنجاح!'
        ]);
    }
}