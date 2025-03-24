@extends('dashboard.layouts.master')
@section('active-branches', 'active')
@section('title', 'عرض الفرع')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'عرض الفرع',
        'previousPage' => 'جدول الفروع',
        'urlPreviousPage' => 'branches.index',
        'currentPage' => 'عرض الفرع',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">عرض الفرع</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="exampleInputName">اسم الموظف</label>
                                    <input type="text" name="name" value="{{ old('name', $employee->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                        placeholder="أدخل موظف جديد">
                                    @error('name')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-6">
                                    <label for="exampleInputmobile">موبايل الموظف</label>
                                    <input type="text" name="mobile" value="{{ old('mobile', $employee->mobile) }}"
                                        class="form-control @error('mobile') is-invalid @enderror" id="exampleInputmobile"
                                        placeholder="أدخل موبايل موظف ">
                                    @error('mobile')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="exampleInputusername">اسم المستخدم</label>
                                    <input type="text" name="username" value="{{ old('username', $employee->username) }}"
                                        class="form-control @error('username') is-invalid @enderror"
                                        id="exampleInputusername" placeholder="أدخل أسم الموظف">
                                    @error('username')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="exampleSelectBorder">الفرع التابع له <code>الموظف</code></label>
                                    <select name="branch_id"
                                        class="custom-select form-control-border @error('branch_id') is-invalid @enderror"
                                        id="exampleSelectBorder">
                                        <option value="">-- أختر الفرع --</option>
                                        @forelse ($other['branches'] as $branche)
                                            <option @if (old('branch_id', $employee->branch_id) == $branche->id) selected @endif
                                                value="{{ $branche->id }}">{{ $branche->name }}</option>
                                        @empty
                                            عفوآ لا توجد بيانات!
                                        @endforelse
                                    </select>
                                    @error('branch_id')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleSelectBorder">المحافظة التابع لها <code>الموظف</code></label>
                                    <select name="governorate_id"
                                        class="custom-select form-control-border @error('governorate_id') is-invalid @enderror"
                                        id="exampleSelectBorder">
                                        <option value="">-- أختر المحافظة --</option>
                                        @forelse ($other['governorates'] as $governorate)
                                            <option @if (old('governorate_id', $employee->governorate_id) == $governorate->id) selected @endif
                                                value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                                        @empty
                                            عفوآ لا توجد بيانات!
                                        @endforelse
                                    </select>
                                    @error('governorate_id')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="exampleSelectBorder">الدرجه الوظيفية</code></label>
                                    <select name="job_grade_id"
                                        class="custom-select form-control-border @error('job_grade_id') is-invalid @enderror"
                                        id="exampleSelectBorder">
                                        <option value="">-- أختر الدرجه الوظيفية --</option>
                                        @forelse ($other['job_grades'] as $job_grade)
                                            <option @if (old('job_grade_id', $employee->job_grade_id) == $job_grade->id) selected @endif
                                                value="{{ $job_grade->id }}">{{ $job_grade->name }}</option>
                                        @empty
                                            عفوآ لا توجد بيانات!
                                        @endforelse
                                    </select>
                                    @error('job_grade_id')
                                        <span class="invalid-feedback text-right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleSelectBorder">الراحه الاسبوعية</code></label>
                                    <select name="week_id"
                                        class="custom-select form-control-border @error('week_id') is-invalid @enderror"
                                        id="exampleSelectBorder">
                                        <option value="">-- أختر الراحه الاسبوعية --</option>
                                        @forelse ($other['weeks'] as $week)
                                            <option @if (old('week_id', $employee->week_id) == $week->id) selected @endif
                                                value="{{ $week->id }}">{{ $week->name }}</option>
                                        @empty
                                            عفوآ لا توجد بيانات!
                                        @endforelse
                                    </select>
                                    @error('week_id')
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
