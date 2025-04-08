@php
    use App\Enum\EmployeeStatus;
    use App\Enum\EmployeeType;
    use App\Enum\EmployeeGender;
@endphp
@extends('dashboard.layouts.master')
@section('active-employees', 'active')
@section('title', 'تعديل بيانات الموظف')
@section('content')
    @push('css')
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    @endpush
    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'تعديل بيانات الموظف',
        'previousPage' => 'جدول الموظفين',
        'urlPreviousPage' => 'employees.index',
        'currentPage' => 'تعديل بيانات الموظف',
    ])

    @include('dashboard.layouts.message')

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">تعديل بيانات الموظف</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.employees.update', $employee->slug) }}" method="POST">
                            @csrf
                            @method('PUT')
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
                                            class="form-control @error('mobile') is-invalid @enderror"
                                            id="exampleInputmobile" placeholder="أدخل موبايل موظف ">
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
                                        <input type="text" name="username"
                                            value="{{ old('username', $employee->username) }}"
                                            class="form-control @error('username') is-invalid @enderror"
                                            id="exampleInputusername" placeholder="أدخل أسم الموظف">
                                        @error('username')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputpassword">كلمة المرور</label>
                                        <input type="password" name="password" value="{{ old('password') }}"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="exampleInputpassword" placeholder="أدخل *************">
                                        @error('password')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleSelectBorder">بيانات الموظف التابع له <code>الموظف</code></label>
                                        <select name="branch_id"
                                            class="form-control select2 @error('branch_id') is-invalid @enderror">
                                            <option value="">-- أختر بيانات الموظف --</option>
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
                                            class="form-control select2 @error('governorate_id') is-invalid @enderror">
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

                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="exampleSelectBorder">نوع الجنس</code></label>
                                        <select name="gender"
                                            class="custom-select form-control-border @error('gender') is-invalid @enderror"
                                            id="exampleSelectBorder">
                                            <option value="">-- أختر النوع --</option>
                                            <option @if (old('gender', $employee->gender) == 0) selected @endif
                                                value="{{ EmployeeGender::Male }}">ذكر</option>
                                            <option @if (old('gender', $employee->gender) == 1) selected @endif
                                                value="{{ EmployeeGender::Female }}">انثى</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="exampleSelectBorder">نوع حساب الموظف</code></label>
                                        <select name="type"
                                            class="custom-select form-control-border @error('type') is-invalid @enderror"
                                            id="exampleSelectBorder">
                                            <option value="">-- أختر نوع الحساب --</option>
                                            <option @if (old('type', $employee->type) == 0) selected @endif
                                                value="{{ App\Enum\EmployeeType::User }}">موظف</option>
                                            <option @if (old('type', $employee->type) == 1) selected @endif
                                                value="{{ App\Enum\EmployeeType::Manager }}">مدير</option>
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleSelectBorder">رصيد أجازات الموظف</code></label>
                                        <input type="text" name="total_days_balance"
                                            value="{{ old('total_days_balance', $employee->total_days_balance) }}"
                                            class="form-control @error('total_days_balance') is-invalid @enderror"
                                            id="exampleInputtotal_days_balance" placeholder="أدخل الرصيد الموظف">
                                        @error('total_days_balance')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="form-group col-6">
                                        <label for="exampleSelectBorder">حالة حساب الموظف</code></label>
                                        <select name="status" class="form-control select">
                                            <option disabled {{ is_null($employee->status) ? 'selected' : '' }}>افتح قائمة
                                                التحديد
                                            </option>
                                            <option value="{{ EmployeeStatus::Active }}"
                                                {{ $employee->status == EmployeeStatus::Active ? 'selected' : '' }}>نشط
                                            </option>
                                            <option value="{{ EmployeeStatus::Inactive }}"
                                                {{ $employee->status == EmployeeStatus::Inactive ? 'selected' : '' }}>
                                                غير
                                                نشط
                                            </option>
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-6">
                                        <label>الصلاحيات</label>
                                        <select class="select2bs4" name="roles[]" multiple="multiple"
                                            data-placeholder="-- حدد الصلاحية --" style="width: 100%;">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}"
                                                    {{ in_array($role, $employeeRoles) ? 'selected' : '' }}>
                                                    {{ $role }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!-- /.form-group -->
                                    </div>
                                </div>
                            </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer text-center ">
                        <button type="submit" class="btn btn-info">حفظ البيانات <i class="fas fa-save mx-1"></i>
                        </button>
                    </div>
                    </form>
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
@push('js')
    <!-- Select2 -->
    <script src="{{ asset('dashboard') }}/assets/plugins/select2/js/select2.full.min.js"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
        })
    </script>
@endpush
