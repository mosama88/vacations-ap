@php
    use App\Enum\EmployeeType;
    use App\Enum\EmployeeGender;
@endphp
@extends('dashboard.layouts.master')
@section('active-branches', 'active')
@section('title', 'عرض بيانات الموظف')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'عرض بيانات الموظف',
        'previousPage' => 'جدول الموظفين',
        'urlPreviousPage' => 'employees.index',
        'currentPage' => 'عرض بيانات الموظف',
    ])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">عرض بيانات الموظف {{ $employee->employee_code }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="exampleInputName">كود الموظف الموظف</label>
                                    <input disabled type="text" name="employee_code"
                                        value="{{ old('employee_code', $employee->employee_code) }}"
                                        class="form-control bg-white" id="exampleInputName" placeholder="أدخل موظف جديد">
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputName">اسم الموظف</label>
                                    <input disabled type="text" name="name" value="{{ old('name', $employee->name) }}"
                                        class="form-control bg-white" id="exampleInputName" placeholder="أدخل موظف جديد">
                                </div>


                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="exampleInputmobile">موبايل الموظف</label>
                                    <input disabled type="text" name="mobile"
                                        value="{{ old('mobile', $employee->mobile) }}" class="form-control bg-white"
                                        id="exampleInputmobile" placeholder="أدخل موبايل موظف ">
                                </div>
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
                                    <select disabled name="branch_id" class="custom-select bg-white form-control-border"
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
                                    <select disabled name="governorate_id"
                                        class="custom-select bg-white form-control-border" id="exampleSelectBorder">
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
                                    <select disabled name="job_grade_id" class="custom-select bg-white form-control-border"
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
                                    <select disabled name="week_id" class="custom-select bg-white form-control-border"
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
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="exampleSelectBorder">نوع الجنس</code></label>
                                    <select disabled name="gender" class="custom-select bg-white form-control-border"
                                        id="exampleSelectBorder">
                                        <option value="">-- أختر النوع --</option>
                                        <option @if (old('gender', $employee->gender) == EmployeeGender::Male) selected @endif
                                            value="{{ EmployeeGender::Male }}">ذكر</option>
                                        <option @if (old('gender', $employee->gender) == EmployeeGender::Female) selected @endif
                                            value="{{ EmployeeGender::Female }}">انثى</option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="exampleSelectBorder">نوع حساب الموظف</code></label>
                                    <select disabled name="type" class="custom-select bg-white form-control-border"
                                        id="exampleSelectBorder">
                                        <option value="">-- أختر نوع الحساب --</option>
                                        <option @if (old('type', $employee->type) == EmployeeType::User) selected @endif
                                            value="{{ EmployeeType::User }}">موظف</option>
                                        <option @if (old('type', $employee->type) == EmployeeType::Manager) selected @endif
                                            value="{{ EmployeeType::Manager }}">مدير</option>
                                    </select>
                                </div>
                                {{-- <div class="form-group col-4">
                                    <label for="exampleSelectBorder">رصيد أجازات الموظف</code></label>
                                    <input disabled type="text" name="total_days_balance"
                                        value="{{ old('total_days_balance', $employee->total_days_balance) }}"
                                        class="form-control bg-white" id="exampleInputtotal_days_balance"
                                        placeholder="أدخل الرصيد الموظف">
                                </div> --}}

                                <div class="form-group col-6">
                                    <label for="exampleSelectBorder">حالة حساب الموظف</code></label>
                                    <select disabled name="status" class="form-control bg-white select">
                                        <option disabled {{ is_null($employee->status) ? 'selected' : '' }}>افتح قائمة
                                            التحديد
                                        </option>
                                        <option value="{{ App\Enum\EmployeeStatus::Active }}"
                                            {{ $employee->status == App\Enum\EmployeeStatus::Active ? 'selected' : '' }}>
                                            نشط
                                        </option>
                                        <option value="{{ App\Enum\EmployeeStatus::Inactive }}"
                                            {{ $employee->status == App\Enum\EmployeeStatus::Inactive ? 'selected' : '' }}>
                                            غير
                                            نشط
                                        </option>
                                    </select>
                                </div>


                                <div class="form-group col-6">
                                    <label>الصلاحيات</label>
                                    <select disabled class="select2bs4 bg-white" name="roles[]" multiple="multiple"
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
