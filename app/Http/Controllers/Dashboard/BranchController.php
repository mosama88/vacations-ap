<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Branch;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BranchRequest;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Branch::orderByDesc('id')->paginate(10);
        return view('dashboard.branches.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $other['governorates'] = Governorate::get();
        return view('dashboard.branches.create', compact('other'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchRequest $request)
    {
        $branches = $request->validated();
        $data = array_merge($branches, [
            'created_by' => auth()->guard('admin')->user()->id,
        ]);
        Branch::create($data);
        session()->flash('success', 'تم أضافة الفرع بنجاح');

        return redirect()->route('dashboard.branches.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        $other['governorates'] = Governorate::get();

        return view('dashboard.branches.show', compact('branch', 'other'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        $other['governorates'] = Governorate::get();

        return view('dashboard.branches.edit', compact('branch', 'other'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchRequest $request, Branch $branch)
    {
        $branch->fill($request->validated());
        $branch->updated_by = auth()->guard('admin')->user()->id;

        $branch->update();
        session()->flash('success', 'تم تعديل الفرع بنجاح');

        return redirect()->route('dashboard.branches.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الفرع بنجاح!'
        ]);
    }
}
