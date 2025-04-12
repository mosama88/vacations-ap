@extends('dashboard.layouts.master')
@section('active-branches', 'active')
@section('title', 'الملف الشخصى')
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'الملف الشخصى',
        'previousPage' => 'الملف الشخصى',
        'urlPreviousPage' => 'employee-panel.index',
        'currentPage' => 'الملف الشخصى',
    ])

    @include('dashboard.layouts.message')

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12 mx-auto">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">الملف الشخصى</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.profile') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row  mx-auto">
                                    <div class="form-group col-3">
                                        <label for="exampleInputName">كلمة المرور الجديدة</label>
                                        <input type="password" name="password" value="{{ old('password') }}"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="exampleInputpassword" placeholder="مثال:**************">
                                        @error('password')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="exampleInputName">تأكيد كلمة المرور </label>
                                        <input type="password" name="password_confirmation"
                                            value="{{ old('password_confirmation') }}"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            id="exampleInputpassword_confirmation"placeholder="مثال: تأكيد **************">
                                        @error('password_confirmation')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3 text-center">

                                    <button type="submit" class="btn btn-primary">تغيير كلة المرور <i
                                            class="fas fa-save mx-1"></i>
                                    </button>
                                </div>

                        </form>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputName">اسم الموظف</label>
                                <input disabled type="text" name="name" value="{{ old('name', $employee->name) }}"
                                    class="form-control bg-white" id="exampleInputName" placeholder="أدخل موظف جديد">
                            </div>

                            <div class="form-group col-6">
                                <label for="exampleInputmobile">موبايل الموظف</label>
                                <input disabled type="text" name="mobile" value="{{ old('mobile', $employee->mobile) }}"
                                    class="form-control bg-white" id="exampleInputmobile" placeholder="أدخل موبايل موظف ">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputusername">اسم المستخدم</label>
                                <input disabled type="text" name="username"
                                    value="{{ old('username', $employee->username) }}" class="form-control bg-white"
                                    id="exampleInputusername" placeholder="أدخل أسم الموظف">
                            </div>


                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleSelectBorder">بيانات الموظف التابع له <code>الموظف</code></label>
                                <select disabled name="branch_id" class="custom-select form-control-border bg-white"
                                    id="exampleSelectBorder">
                                    <option value="">-- أختر بيانات الموظف --</option>
                                    @forelse ($other['branches'] as $branche)
                                        <option @if (old('branch_id', $employee->branch_id) == $branche->id) selected @endif
                                            value="{{ $branche->id }}">{{ $branche->name }}</option>
                                    @empty
                                        عفوآ لا توجد بيانات!
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="exampleSelectBorder">المحافظة التابع لها <code>الموظف</code></label>
                                <select disabled name="governorate_id" class="custom-select form-control-border bg-white"
                                    id="exampleSelectBorder">
                                    <option value="">-- أختر المحافظة --</option>
                                    @forelse ($other['governorates'] as $governorate)
                                        <option @if (old('governorate_id', $employee->governorate_id) == $governorate->id) selected @endif
                                            value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                                    @empty
                                        عفوآ لا توجد بيانات!
                                    @endforelse
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleSelectBorder">الدرجه الوظيفية</code></label>
                                <select disabled name="job_grade_id" class="custom-select form-control-border bg-white"
                                    id="exampleSelectBorder">
                                    <option value="">-- أختر الدرجه الوظيفية --</option>
                                    @forelse ($other['job_grades'] as $job_grade)
                                        <option @if (old('job_grade_id', $employee->job_grade_id) == $job_grade->id) selected @endif
                                            value="{{ $job_grade->id }}">{{ $job_grade->name }}</option>
                                    @empty
                                        عفوآ لا توجد بيانات!
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="exampleSelectBorder">الراحه الاسبوعية</code></label>
                                <select disabled name="week_id" class="custom-select form-control-border bg-white"
                                    id="exampleSelectBorder">
                                    <option value="">-- أختر الراحه الاسبوعية --</option>
                                    @forelse ($other['weeks'] as $week)
                                        <option @if (old('week_id', $employee->week_id) == $week->id) selected @endif
                                            value="{{ $week->id }}">{{ $week->name }}</option>
                                    @empty
                                        عفوآ لا توجد بيانات!
                                    @endforelse
                                </select>
                            </div>
                        </div>
                     

                    </div>


                </div>


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
