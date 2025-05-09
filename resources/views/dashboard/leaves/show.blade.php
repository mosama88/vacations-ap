@php
    use App\Enum\EmployeeType;
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
                                        value="{{ $employees->leaveBalance->used_days ?? 'لا يوجد رصيد' }}" name="used_days"
                                        class="form-control bg-white" id="exampleInputused_days" placeholder="">
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
                                        الأجازات <span class="text-success">(العارضه)</span> </label>
                                    <input disabled type="text" name="total_days_emergency"
                                        value="{{ $employees->leaveBalance->total_days_emergency ?? 'لا يوجد رصيد' }}"
                                        class="form-control bg-white" id="exampleInputtotal_days_emergency" placeholder="">
                                </div>


                                <div class="form-group col-4">
                                    <label for="exampleInputName">الرصيد المستخدم <span
                                            class="text-success">(العارضه)</span>
                                    </label>
                                    <input disabled type="text" name="used_days_emergency"
                                        value="{{ $employees->leaveBalance->used_days_emergency ?? 'لا يوجد رصيد' }}"
                                        name="used_days_emergency" class="form-control bg-white"
                                        id="exampleInputused_days_emergency" placeholder="">
                                </div>

                                <div class="form-group col-4">
                                    <label for="exampleInputName">الرصيد المتبقى <span class="text-success">(العارضه)</span>
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
                                            value="{{ LeaveTypeEnum::Annual }}">اجازه سنوية</option>
                                        <option @if (old('leave_type', $leave->leave_type) == LeaveTypeEnum::Sick) selected @endif
                                            value="{{ LeaveTypeEnum::Sick }}">مرضى</option>
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label for="exampleSelectBorder">سبب الأجازه</code></label>
                                    <textarea disabled class="form-control bg-white @error('description') is-invalid @enderror" name="description"
                                        rows="3" placeholder="أدخل السبب ...">{{ old('description', $leave->description) }}</textarea>
                                </div>

                                <form action="{{ route('dashboard.leaves.updateStatusLeave', $leave->id) }}"
                                    method="POST" id="showForm">
                                    @csrf
                                    @method('PUT')
                                    @can('اخذ اجراء الأجازات')
                                        <!-- /.card-body -->
                                        <div class="form-group col-12">
                                            <label for="leave_status">حالة الإجازة</label>

                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customPending"
                                                    name="leave_status" value="{{ LeaveStatusEnum::Pending }}"
                                                    @if (old('leave_status', $leave->leave_status) == LeaveStatusEnum::Pending) checked @endif>
                                                <label for="customPending" class="custom-control-label"> <i
                                                        class="fas fa-hourglass-half text-warning mx-1"></i>معلقة</label>
                                            </div>

                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customApproved"
                                                    name="leave_status" value="{{ LeaveStatusEnum::Approved }}"
                                                    @if (old('leave_status', $leave->leave_status) == LeaveStatusEnum::Approved) checked @endif>
                                                <label for="customApproved" class="custom-control-label"> <i
                                                        class="fas fa-thumbs-up mx-1 text-success"></i> موافق</label>
                                            </div>

                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRefused"
                                                    name="leave_status" value="{{ LeaveStatusEnum::Refused }}"
                                                    @if (old('leave_status', $leave->leave_status) == LeaveStatusEnum::Refused) checked @endif>
                                                <label for="customRefused" class="custom-control-label"> <i
                                                        class="fas fa-times-circle mx-1 text-danger"></i> مرفوض </label>
                                            </div>
                                            @error('leave_status')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    @endcan
                            </div>
                            <div class="form-group col-12" id="rejectionReasonContainer"
                                style="@if (old('leave_status', $leave->leave_status) != LeaveStatusEnum::Refused) display: none; @endif">
                                <label for="exampleSelectBorder">سبب الرفض</label>
                                <textarea class="form-control @error('reason_for_rejection') is-invalid @enderror" name="reason_for_rejection"
                                    rows="3" placeholder="أدخل السبب ...">{{ old('reason_for_rejection', $leave->reason_for_rejection) }}</textarea>
                                @error('reason_for_rejection')
                                    <span class="invalid-feedback text-right" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @if ($leave->leave_status != LeaveStatusEnum::Approved)
                                @if (auth()->user()->hasRole('super-admin') || Auth::user()->hasRole('admin'))
                                    <div class="card-footer text-center ">
                                        <button type="submit" id="submitButton" class="btn btn-info">أخذ إجراء <i
                                                class="fas fa-save mx-1"></i>
                                        </button>
                                    </div>
                                @endif

                            @endif
                            </form>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rejectionReasonContainer = document.getElementById('rejectionReasonContainer');
            const radioButtons = document.querySelectorAll('input[name="leave_status"]');

            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === '{{ LeaveStatusEnum::Refused }}') {
                        rejectionReasonContainer.style.display = 'block';
                    } else {
                        rejectionReasonContainer.style.display = 'none';
                        document.querySelector('textarea[name="reason_for_rejection"]').value = '';
                    }
                });
            });
        });
    </script>


    <script>
        // تفعيل Flatpickr مع اللغة العربية
        flatpickr("#start_date", {
            dateFormat: "Y-m-d",
            locale: "ar",
            onChange: calculateDays
        });

        flatpickr("#end_date", {
            dateFormat: "Y-m-d",
            locale: "ar",
            onChange: calculateDays
        });

        // دالة حساب عدد الأيام (الآن تشمل جميع الأيام بما فيها الجمعة)
        function calculateDays() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);

                // التأكد من أن تاريخ البداية قبل تاريخ النهاية
                if (start > end) {
                    document.getElementById('days_taken').value = 0;
                    return;
                }

                // حساب الفرق بين التاريخين بالأيام (بما فيها الجمعة)
                const diffTime = Math.abs(end - start);
                const totalDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

                document.getElementById('days_taken').value = totalDays;
            }
        }
    </script>
    <script>
        document.getElementById('showForm').addEventListener('submit', function(event) {
            var submitButton = document.getElementById('submitButton');
            submitButton.disabled = true;
            submitButton.innerHTML = 'جاري أخذ الأجراء...'; // Optional: Change text while submitting
        });
    </script>
@endpush
