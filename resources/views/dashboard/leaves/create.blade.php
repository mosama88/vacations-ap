@extends('dashboard.layouts.master')
@section('active-branches', 'active')
@section('title', 'أنشاء فرع جديد')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'أنشاء فرع جديد',
        'previousPage' => 'جدول الفروع',
        'urlPreviousPage' => 'branches.index',
        'currentPage' => 'أنشاء فرع جديد',
    ])

    @include('dashboard.layouts.message')

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">أنشاء فرع جديد</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('dashboard.branches.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-6" id="employee_div">
                                        <label for="exampleSelectBorder">أسم الموظف </label>
                                        <select name="employee_id" id="employee_id"
                                            class="form-control select2 vh-100 @error('employee_id') is-invalid @enderror"
                                            id="exampleSelectBorder">
                                            <option value="">-- أختر المحافظة --</option>
                                            @forelse ($other['employees'] as $employee)
                                                <option @if (old('employee_id') == $employee->id) selected @endif
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
                                </div>
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="exampleInputName">رصيد الأجازات</label>
                                        <input disabled type="text" name="total_days" class="form-control"
                                            id="exampleInputtotal_days" placeholder="">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName">الرصيد المستخدم</label>
                                        <input disabled type="text" name="used_days" class="form-control"
                                            id="exampleInputused_days" placeholder="">
                                    </div>

                                    <div class="form-group col-4">
                                        <label for="exampleInputName">الرصيد المتبقى</label>
                                        <input disabled type="text" name="remainig_days" class="form-control"
                                            id="exampleInputremainig_days" placeholder="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>بداية الأجازه</label>
                                        <input type="date" name="start_date"
                                            class="form-control @error('start_date') is-invalid @enderror"
                                            value="{{ old('start_date') }}" placeholder="أدخل السنه المالية">
                                        @error('start_date')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label>نهاية الأجازه</label>
                                        <input type="date" name="end_date"
                                            class="form-control @error('end_date') is-invalid @enderror"
                                            value="{{ old('end_date') }}" placeholder="أدخل السنه المالية">
                                        @error('end_date')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleSelectBorder">نوع الأجازه</code></label>
                                        <select name="leave_type"
                                            class="custom-select form-control-border @error('leave_type') is-invalid @enderror"
                                            id="exampleSelectBorder">
                                            <option value="">-- أختر نوع الأجازه --</option>
                                            <option @if (old('leave_type') == 1) selected @endif
                                                value="{{ App\Enum\LeaveTypeEnum::Emergency }}">عارضه</option>
                                            <option @if (old('leave_type') == 2) selected @endif
                                                value="{{ App\Enum\LeaveTypeEnum::Regular }}">إعتيادى</option>
                                            <option @if (old('leave_type') == 3) selected @endif
                                                value="{{ App\Enum\LeaveTypeEnum::Annual }}">سنوى</option>
                                            <option @if (old('leave_type') == 4) selected @endif
                                                value="{{ App\Enum\LeaveTypeEnum::Sick }}">مرضى</option>
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
                                            placeholder="أدخل السبب ...">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback text-right" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer text-center ">
                        <button type="submit" class="btn btn-primary">حفظ البيانات <i class="fas fa-save mx-1"></i>
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

    <script>
        $(document).on('change', '#employee_id', function(e) {
            getLeaveBalance();
        });

        function getLeaveBalance() {
            var employee_id = $("#employee_id").val();
            jQuery.ajax({
                url: '{{ route('leaves.getLeavesBalances') }}',
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
@endpush
