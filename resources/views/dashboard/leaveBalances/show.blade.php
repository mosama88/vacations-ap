@extends('dashboard.layouts.master')
@section('active-leaveBalances', 'active')
@section('title', 'عرض رصيد الأجازات')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'عرض رصيد الأجازات',
        'previousPage' => 'جدول رصيد الأجازات',
        'urlPreviousPage' => 'leaveBalances.index',
        'currentPage' => 'عرض رصيد الأجازات',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">عرض رصيد الأجازات</h3>
                            <span>{{ $leaveBalance->financeCalendar->finance_yr }}</span>

                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="exampleSelectBorder">أسم الموظف </label>
                                    <select name="employee_id"
                                        class="form-control select2 vh-100 @error('employee_id') is-invalid @enderror"
                                        id="exampleSelectBorder">
                                        <option value="">-- أختر المحافظة --</option>
                                        @forelse ($other['employees'] as $employee)
                                            <option @if (old('employee_id', $leaveBalance->employee_id) == $employee->id) selected @endif
                                                value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @empty
                                            عفوآ لا توجد بيانات!
                                        @endforelse
                                    </select>
                                    @error('employee_id')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-6">
                                    <label for="exampleInputName">اسم الرصيد الأجازات</label>
                                    <input type="text" name="total_days"
                                        value="{{ old('total_days', $leaveBalance->total_days) }}"
                                        class="form-control @error('total_days') is-invalid @enderror"
                                        id="exampleInputtotal_days" placeholder="أدخل رصيد الأجازات ">
                                    @error('total_days')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                        </div>

                    </div>
                    <!-- /.card-body -->



                </div>
                <!-- /.card -->

                <!-- general form elements -->

                <!-- /.card -->
            </div>
        </div>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
