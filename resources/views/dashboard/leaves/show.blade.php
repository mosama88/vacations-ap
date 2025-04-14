@php
    use App\Enum\LeaveStatusEnum;
    use App\Enum\LeaveTypeEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-leaves-create', 'active')
@section('title', 'عرض بيانات الأجازه')

@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'عرض بيانات الأجازه',
        'previousPage' => 'جدول الأجازات',
        'urlPreviousPage' => 'employee-panel.index',
        'currentPage' => 'عرض بيانات الأجازه',
    ])

    @include('dashboard.layouts.message')

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">عرض بيانات الأجازه</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-4" id="employee_div">
                                    <label for="exampleInputName">كود الموظف</label>
                                    <input disabled type="text" id="employee_code"
                                        value="{{ $leave->employee->employee_code }}" name="employee_code"
                                        class="form-control bg-white" id="exampleInputemployee_id" placeholder="">
                                </div>
                                <div class="form-group col-4" id="employee_div">
                                    <label for="exampleInputName">أسم الموظف</label>
                                    <input disabled type="text" id="employee_id" value="{{ $leave->employee->name }}"
                                        name="employee_id" class="form-control bg-white" id="exampleInputemployee_id"
                                        placeholder="">
                                </div>
                                <div class="form-group col-4">
                                    <label for="exampleSelectBorder">الراحه الاسبوعية</code></label>
                                    <input disabled type="text" id="week_id" value="{{ $leave->employee->week->name }}"
                                        name="week_id" class="form-control bg-white" id="exampleInputweek_id"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="exampleInputName">رصيد الأجازات
                                        <span class="text-info">(الأعتيادى)</span> </label>
                                    <input disabled type="text" name="total_days"
                                        value="{{ $employees->leaveBalance->total_days ?? 'لا يوجد رصيد' }}"
                                        class="form-control bg-white" id="exampleInputtotal_days" placeholder="">
                                </div>


                                <div class="form-group col-4">
                                    <label for="exampleInputName">الرصيد المستخدم <span class="text-info">(الأعتيادى)</span>
                                    </label>
                                    <input disabled type="text" name="used_days"
                                        value="{{ $employees->leaveBalance->used_days ?? 'لا يوجد رصيد' }}"
                                        name="used_days" class="form-control bg-white" id="exampleInputused_days"
                                        placeholder="">
                                </div>

                                <div class="form-group col-4">
                                    <label for="exampleInputName">الرصيد المتبقى <span class="text-info">(الأعتيادى)</span>
                                    </label>
                                    <input disabled type="text"
                                        value="{{ $employees->leaveBalance->remainig_days ?? 'لا يوجد رصيد' }}"
                                        name="remainig_days" class="form-control bg-white" id="exampleInputremainig_days"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="exampleInputName"> رصيد
                                        الأجازات <span class="text-danger">(العارضه)</span> </label>
                                    <input disabled type="text" name="total_days_emergency"
                                        value="{{ $employees->leaveBalance->total_days_emergency ?? 'لا يوجد رصيد' }}"
                                        class="form-control bg-white" id="exampleInputtotal_days_emergency" placeholder="">
                                </div>


                                <div class="form-group col-4">
                                    <label for="exampleInputName">الرصيد المستخدم <span class="text-danger">(العارضه)</span>
                                    </label>
                                    <input disabled type="text" name="used_days_emergency"
                                        value="{{ $employees->leaveBalance->used_days_emergency ?? 'لا يوجد رصيد' }}"
                                        name="used_days_emergency" class="form-control bg-white"
                                        id="exampleInputused_days_emergency" placeholder="">
                                </div>

                                <div class="form-group col-4">
                                    <label for="exampleInputName">الرصيد المتبقى <span class="text-danger">(العارضه)</span>
                                    </label>
                                    <input disabled type="text"
                                        value="{{ $employees->leaveBalance->remainig_days_emergency ?? 'لا يوجد رصيد' }}"
                                        name="remainig_days_emergency" class="form-control bg-white"
                                        id="exampleInputremainig_days_emergency" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label class="visually-hidden" for="specificSizeInputGroupUsername">بداية
                                        الأجازة</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                        <input disabled type="text" id="start_date" name="start_date"
                                            class="form-control bg-white @error('start_date') is-invalid @enderror"
                                            value="{{ old('start_date', $leave->start_date) }}"
                                            placeholder="اختر تاريخ البداية">
                                    </div>

                                </div>

                                <div class="form-group col-4">
                                    <label class="visually-hidden" for="specificSizeInputGroupUsername">نهاية
                                        الأجازة</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                        <input disabled type="text" id="end_date" name="end_date"
                                            class="form-control bg-white @error('end_date') is-invalid @enderror"
                                            value="{{ old('end_date', $leave->end_date) }}"
                                            placeholder="اختر تاريخ النهاية">
                                    </div>

                                </div>






                                <div class="form-group col-4">
                                    <label for="exampleInputName">عدد الأيام </label>
                                    <input disabled type="text" value="{{ old('days_taken', $leave->days_taken) }}"
                                        name="days_taken" class="form-control bg-white" id="days_taken" placeholder="">
                                </div>


                                <div class="form-group col-4">
                                    <label for="exampleSelectBorder">نوع الأجازه</code></label>
                                    <select disabled name="leave_type"
                                        class="custom-select form-control-border bg-white @error('leave_type') is-invalid @enderror"
                                        id="exampleSelectBorder">
                                        <option value="">-- أختر نوع الأجازه --</option>
                                        <option @if (old('leave_type', $leave->leave_type) == LeaveTypeEnum::Emergency) selected @endif
                                            value="{{ LeaveTypeEnum::Emergency }}">عارضه</option>
                                        <option @if (old('leave_type', $leave->leave_type) == LeaveTypeEnum::Regular) selected @endif
                                            value="{{ LeaveTypeEnum::Regular }}">إعتيادى</option>
                                        <option @if (old('leave_type', $leave->leave_type) == LeaveTypeEnum::Annual) selected @endif
                                            value="{{ LeaveTypeEnum::Annual }}">سنوى</option>
                                        <option @if (old('leave_type', $leave->leave_type) == LeaveTypeEnum::Sick) selected @endif
                                            value="{{ LeaveTypeEnum::Sick }}">مرضى</option>
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label for="exampleSelectBorder">سبب الأجازه</code></label>
                                    <textarea disabled class="form-control bg-white @error('description') is-invalid @enderror" name="description"
                                        rows="3" placeholder="أدخل السبب ...">{{ old('description', $leave->description) }}</textarea>
                                </div>
                                @can('اخذ اجراء الأجازات')
                                    <div class="form-group col-12">
                                        <label for="leave_status">حالة الإجازة</label>

                                        <div class="custom-control custom-radio">
                                            <input disabled class="custom-control-input" type="radio" id="customPending"
                                                name="leave_status" value="{{ LeaveStatusEnum::Pending }}"
                                                @if (old('leave_status', $leave->leave_status) == LeaveStatusEnum::Pending) checked @endif>
                                            <label for="customPending" class="custom-control-label"> <i
                                                    class="fas fa-hourglass-half text-warning mx-1"></i>معلقة</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input disabled class="custom-control-input" type="radio" id="customApproved"
                                                name="leave_status" value="{{ LeaveStatusEnum::Approved }}"
                                                @if (old('leave_status', $leave->leave_status) == LeaveStatusEnum::Approved) checked @endif>
                                            <label for="customApproved" class="custom-control-label"> <i
                                                    class="fas fa-thumbs-up mx-1 text-success"></i> موافق</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input disabled class="custom-control-input" type="radio" id="customRefused"
                                                name="leave_status" value="{{ LeaveStatusEnum::Refused }}"
                                                @if (old('leave_status', $leave->leave_status) == LeaveStatusEnum::Refused) checked @endif>
                                            <label for="customRefused" class="custom-control-label"> <i
                                                    class="fas fa-times-circle mx-1 text-danger"></i> مرفوض </label>
                                        </div>
                                    </div>
                                @endcan

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
