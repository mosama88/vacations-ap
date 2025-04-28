@php
    use App\Enum\LeaveStatusEnum;
    use App\Enum\LeaveTypeEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-leaveByBranch', 'active')
@push('css')
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



                            @livewire('dashboard.leaves.leaves-by-branch-table')


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
    <!-- flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>





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
        // flatpickr("#start_date", {
        //     dateFormat: "Y-m-d",
        //     locale: "ar",
        //     onChange: calculateDays
        // });

        // flatpickr("#end_date", {
        //     dateFormat: "Y-m-d",
        //     locale: "ar",
        //     onChange: calculateDays
        // });

        // دالة حساب عدد الأيام مع استثناء يوم الجمعة
        // function calculateDays() {
        //     const startDate = document.getElementById('start_date').value;
        //     const endDate = document.getElementById('end_date').value;

        //     if (startDate && endDate) {
        //         const start = new Date(startDate);
        //         const end = new Date(endDate);

        //         let totalDays = 0;
        //         let currentDate = new Date(start);

        //         // التأكد من أن تاريخ البداية قبل تاريخ النهاية
        //         if (start > end) {
        //             document.getElementById('days_taken').value = 0;
        //             return;
        //         }

        //         // حساب الأيام مع استثناء الجمعة
        //         while (currentDate <= end) {
        //             // إذا كان اليوم ليس جمعة (5 في نظام الأيام حيث الأحد = 0)
        //             if (currentDate.getDay() !== 5) {
        //                 totalDays++;
        //             }
        //             currentDate.setDate(currentDate.getDate() + 1);
        //         }

        //         document.getElementById('days_taken').value = totalDays;
        //     }
        // }
    </script>
@endpush
