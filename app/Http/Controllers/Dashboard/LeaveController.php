<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Leave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LeaveRequest;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Leave::orderByDesc('id')->paginate(10);
        return view('dashboard.leaves.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.leaves.create', compact('other'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaveRequest $request)
    {
        $leavees = $request->validated();
        $data = array_merge($leavees, [
            'created_by' => auth()->guard('admin')->user()->id,
        ]);
        Leave::create($data);
        session()->flash('success', 'تم أضافة الأجازه بنجاح');

        return redirect()->route('dashboard.leaves.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {

        return view('dashboard.leaves.show', compact('leave', 'other'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {

        return view('dashboard.leaves.edit', compact('leave', 'other'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaveRequest $request, Leave $leave)
    {
        $leave->fill($request->validated());
        $leave->updated_by = auth()->guard('admin')->user()->id;

        $leave->update();
        session()->flash('success', 'تم تعديل الأجازه بنجاح');

        return redirect()->route('dashboard.leaves.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الأجازه بنجاح!'
        ]);
    }
}
