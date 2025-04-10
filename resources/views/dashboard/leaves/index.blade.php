@php
    use App\Enum\LeaveStatusEnum;
    use App\Enum\LeaveTypeEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-all', 'active')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@section('title', 'أجازات الموظفين')
@section('content')


    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'الاجازات الموظفين',
        'previousPage' => 'لوحة التحكم',
        'urlPreviousPage' => 'employee-panel.index',
        'currentPage' => 'الاجازات الموظفين',
    ])
    @include('dashboard.layouts.message')




    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->


            <!-- /.row -->
            <!-- Main row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="col-12 float-right">جدول أجازات <span class="text-secondary"> الموظفين</span>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>كود الأجازه</th>
                                        <th>مقدم الأجازه</th>
                                        <th>نوع الأجازه</th>
                                        <th>بداية الاجازه</th>
                                        <th>نهاية الاجازه</th>
                                        <th>عدد الأيام</th>
                                        <th>حالة الاجازه</th>
                                        <th>ملاحظات</th>
                                        <th>انشاء بواسطة</th>
                                        <th>تحديث بواسطة</th>
                                        <th>عرض الرصيد</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $info)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $info->leave_code }}</td>
                                            <td>{{ $info->employee->name }}</td>
                                            <td>
                                                @if ($info->leave_type == LeaveTypeEnum::Emergency)
                                                    عارضه
                                                @elseif ($info->leave_type == LeaveTypeEnum::Regular)
                                                    إعتيادى
                                                @elseif ($info->leave_type == LeaveTypeEnum::Annual)
                                                    سنوى
                                                @else
                                                    مرضى
                                                @endif
                                            </td>
                                            <td>{{ $info->start_date }}</td>
                                            <td>{{ $info->end_date }}</td>
                                            <td>{{ $info->days_taken * 1 }}</td>
                                            <td>
                                                @if ($info->leave_status == LeaveStatusEnum::Approved)
                                                    <span class="badge bg-primary">موافق</span>
                                                @elseif ($info->leave_status == LeaveStatusEnum::Pending)
                                                    <span class="badge bg-warning">معلقه</span>
                                                @else
                                                    <span class="badge bg-danger">مرفوض</span>
                                                @endif

                                            </td>
                                            <td>{{ $info->description }}</td>
                                            <td>{{ $info->created_by ? $info->createdBy->name : 'لا يوجد' }}</td>
                                            <td>{{ $info->updated_by ? $info->updatedBy->name : 'لا يوجد تحديث' }}</td>
                                            <td>
                                                <a class="btn btn-outline-info btn-sm mx-2"
                                                    href="{{ route('dashboard.leaves.edit', $info->id) }}"><i
                                                        class="fas fa-edit ml-1"></i></a>

                                                <a class="btn btn-outline-success btn-sm mx-2"
                                                    href="{{ route('dashboard.leaves.show', $info->id) }}"><i
                                                        class="fas fa-eye ml-1"></i></a>
                                            </td>
                                        @empty
                                            لا توجد أجازات
                                    @endforelse
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>
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
    </script>
@endpush
