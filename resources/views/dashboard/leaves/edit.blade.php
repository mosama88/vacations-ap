@php
    use App\Enum\LeaveStatusEnum;
    use App\Enum\LeaveTypeEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-leaves-create', 'active')
@section('title', 'تعديل الأجازه')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'تعديل الأجازه',
        'previousPage' => 'جدول الأجازات',
        'urlPreviousPage' => 'employee-panel.index',
        'currentPage' => 'تعديل الأجازه',
    ])

    @include('dashboard.layouts.message')

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">تعديل الأجازه</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.leaves.update', $leave->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <input class="custom-control" type="hidden" name="leave_status"
                                        value="{{ $leave->leave_status }}">
                                    <!-- كود الموظف -->
                                    <div class="form-group col-4" id="employee_div">
                                        <label for="exampleInputName">كود الموظف</label>
                                        <input disabled type="text" id="employee_code"
                                            value="{{ $leave->employee->employee_code }}" name="employee_code"
                                            class="form-control bg-white" id="exampleInputemployee_id" placeholder="">
                                    </div>
                                    <!-- أسم الموظف -->
                                    <div class="form-group col-4" id="employee_div">
                                        <label for="exampleInputName">أسم الموظف</label>
                                        <input disabled type="text" id="employee_id" value="{{ $leave->employee->name }}"
                                            name="employee_id" class="form-control bg-white" id="exampleInputemployee_id"
                                            placeholder="">
                                    </div>
                                    <!-- الراحه الاسبوعية  -->
                                    <div class="form-group col-4">
                                        <label for="exampleSelectBorder">الراحه الاسبوعية</code></label>
                                        <input disabled type="text" id="week_id"
                                            value="{{ $leave->employee->week->name }}" name="week_id"
                                            class="form-control bg-white" id="exampleInputweek_id" placeholder="">
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- رصيد الأجازات  -->
                                    <div class="form-group col-4">
                                        <label for="exampleInputName">رصيد الأجازات
                                            <span class="text-info">(الأعتيادى)</span> </label>
                                        <input disabled type="text" name="total_days"
                                            value="{{ $employees->leaveBalance->total_days ?? 'لا يوجد رصيد' }}"
                                            class="form-control bg-white" id="exampleInputtotal_days" placeholder="">
                                    </div>


                                    <!-- الرصيد المستخدم  -->
                                    <div class="form-group col-4">
                                        <label for="exampleInputName">الرصيد المستخدم <span
                                                class="text-info">(الأعتيادى)</span> </label>
                                        <input disabled type="text" name="used_days"
                                            value="{{ $employees->leaveBalance->used_days ?? 'لا يوجد رصيد' }}"
                                            name="used_days" class="form-control bg-white" id="exampleInputused_days"
                                            placeholder="">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName">الرصيد المتبقى <span
                                                class="text-info">(الأعتيادى)</span> </label>
                                        <input disabled type="text"
                                            value="{{ $employees->leaveBalance->remainig_days ?? 'لا يوجد رصيد' }}"
                                            name="remainig_days" class="form-control bg-white"
                                            id="exampleInputremainig_days" placeholder="">
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- رصيد الأجازات  -->
                                    <div class="form-group col-4">
                                        <label for="exampleInputName"> رصيد
                                            الأجازات <span class="text-success">(العارضه)</span> </label>
                                        <input disabled type="text" name="total_days_emergency"
                                            value="{{ $employees->leaveBalance->total_days_emergency ?? 'لا يوجد رصيد' }}"
                                            class="form-control bg-white" id="exampleInputtotal_days_emergency"
                                            placeholder="">
                                    </div>

                                    <!-- الرصيد المستخدم  -->
                                    <div class="form-group col-4">
                                        <label for="exampleInputName">الرصيد المستخدم <span
                                                class="text-success">(العارضه)</span> </label>
                                        <input disabled type="text" name="used_days_emergency"
                                            value="{{ $employees->leaveBalance->used_days_emergency ?? 'لا يوجد رصيد' }}"
                                            name="used_days_emergency" class="form-control bg-white"
                                            id="exampleInputused_days_emergency" placeholder="">
                                    </div>

                                    <!-- الرصيد المتبقى  -->


                                    <div class="form-group col-4">
                                        <label for="exampleInputName">
                                            الرصيد المتبقى <span class="text-success">(العارضة)</span>
                                        </label>

                                        @php
                                            $remaining = $employees->leaveBalance->remainig_days_emergency ?? null;
                                            $class = 'form-control bg-white';

                                            if (!is_null($remaining) && $remaining <= 2) {
                                                $class = 'form-control bg-danger';
                                            }
                                        @endphp

                                        <input disabled type="text" value="{{ $remaining ?? 'لا يوجد رصيد' }}"
                                            name="remainig_days_emergency" class="{{ $class }}"
                                            id="exampleInputremainig_days_emergency" placeholder="">
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- بداية الأجازة  -->
                                    <div class="form-group col-4">
                                        <label class="visually-hidden" for="specificSizeInputGroupUsername">بداية
                                            الأجازة</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                            <input type="text" id="start_date" name="start_date"
                                                class="form-control bg-white @error('start_date') is-invalid @enderror"
                                                value="{{ old('start_date', $leave->start_date) }}"
                                                placeholder="اختر تاريخ البداية">
                                            @error('start_date')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <!-- نهاية الأجازة  -->
                                    <div class="form-group col-4">
                                        <label class="visually-hidden" for="specificSizeInputGroupUsername">نهاية
                                            الأجازة</label>
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                            <input type="text" id="end_date" name="end_date"
                                                class="form-control bg-white @error('end_date') is-invalid @enderror"
                                                value="{{ old('end_date', $leave->end_date) }}"
                                                placeholder="اختر تاريخ النهاية">
                                            @error('end_date')
                                                <span class="invalid-feedback text-right" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <!-- عدد الأيام  -->
                                    <div class="form-group col-4">
                                        <label for="exampleInputName">عدد الأيام </label>
                                        <input disabled type="text"
                                            value="{{ old('days_taken', $leave->days_taken) }}" name="days_taken"
                                            class="form-control bg-white" id="days_taken" placeholder="">
                                    </div>


                                    <div class="form-group col-6">
                                        <label for="exampleSelectBorder">نوع الأجازه</code></label>
                                        <select name="leave_type"
                                            class="custom-select form-control-border @error('leave_type') is-invalid @enderror"
                                            id="exampleSelectBorder">
                                            <option value="">-- أختر نوع الأجازه --</option>
                                            <option @if (old('leave_type', $leave->leave_type == LeaveTypeEnum::Emergency)) selected @endif
                                                value="{{ LeaveTypeEnum::Emergency }}">عارضه</option>
                                            <option @if (old('leave_type', $leave->leave_type == LeaveTypeEnum::Regular)) selected @endif
                                                value="{{ LeaveTypeEnum::Regular }}">إعتيادى</option>
                                            <option @if (old('leave_type', $leave->leave_type == LeaveTypeEnum::Annual)) selected @endif
                                                value="{{ LeaveTypeEnum::Annual }}">اجازه سنوية</option>
                                            <option @if (old('leave_type', $leave->leave_type == LeaveTypeEnum::Sick)) selected @endif
                                                value="{{ LeaveTypeEnum::Sick }}">مرضى</option>
                                        </select>
                                        @error('leave_type')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="exampleSelectBorder">سبب الأجازه</code></label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3"
                                            placeholder="أدخل السبب ...">{{ old('description', $leave->description) }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>




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


                                </div>
                            </div>


                            <!-- /.card-body -->
                            @if ($leave->leave_status != LeaveStatusEnum::Approved)
                                <div class="card-footer text-center ">
                                    <button type="submit" class="btn btn-primary">تعديل الأجازه <i
                                            class="fas fa-save mx-1"></i>
                                    </button>
                                </div>
                            @endif

                        </form>
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
    <!-- flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>

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

    <script>
        $(document).on('change', '#employee_id', function(e) {
            getLeaveBalance();
        });

        function getLeaveBalance() {
            var employee_id = $("#employee_id").val();
            jQuery.ajax({
                url: '{{ route('dashboard.leaves.getLeavesBalances') }}',
                type: 'POST',
                dataType: 'json', // التأكد من أنك ترجع البيانات بتنسيق JSON
                cache: false,
                data: {
                    "_token": '{{ csrf_token() }}',
                    "employee_id": employee_id
                },
                success: function(data) {
                    // تأكد أن الخادم يعيد البيانات بتنسيق JSON يحتوي على القيم المناسبة
                    if (data.leave_balance) {
                        // تحديث القيم في الحقول
                        $("#exampleInputtotal_days").val(data.leave_balance.total_days);
                        $("#exampleInputused_days").val(data.leave_balance.used_days);
                        $("#exampleInputremainig_days").val(data.leave_balance.remainig_days);
                    } else {
                        alert("لا توجد بيانات للموظف.");
                    }
                },
                error: function() {
                    alert("عفوا، لقد حدث خطأ.");
                }
            });
        }
    </script>

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
@endpush


{{--
 
 حساب يوم الجمعه
 <script>
        flatpickr("#start_date", {
            dateFormat: "Y-m-d",
            locale: "ar"
        });

        flatpickr("#end_date", {
            dateFormat: "Y-m-d",
            locale: "ar"
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

        // دالة حساب عدد الأيام مع استثناء يوم الجمعة
        function calculateDays() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);

                let totalDays = 0;
                let currentDate = new Date(start);

                // التأكد من أن تاريخ البداية قبل تاريخ النهاية
                if (start > end) {
                    document.getElementById('days_taken').value = 0;
                    return;
                }

                // حساب الأيام مع استثناء الجمعة
                while (currentDate <= end) {
                    // إذا كان اليوم ليس جمعة (5 في نظام الأيام حيث الأحد = 0)
                    if (currentDate.getDay() !== 5) {
                        totalDays++;
                    }
                    currentDate.setDate(currentDate.getDate() + 1);
                }

                document.getElementById('days_taken').value = totalDays;
            }
        }
    </script> --}}
