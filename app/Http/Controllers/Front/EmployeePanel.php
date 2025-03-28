<?php

namespace App\Http\Controllers\Front;

use App\Models\Leave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeePanel extends Controller
{
    public function index()
    {
        $employee = Auth::user()->id;
        $data = Leave::where('employee_id', $employee)->orderByDesc('id')->paginate(10);
        return view('front.index', compact('data'));
    }

    public function managerIndex()
    {
        $employee = Auth::user()->id;
        $data = Leave::where('employee_id', $employee)->orderByDesc('id')->paginate(10);
        return view('front.manager', compact('data'));
    }
}