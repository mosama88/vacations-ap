@php
    use App\Enum\LeaveStatusEnum;
    use App\Enum\LeaveTypeEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-pending', 'active')
@section('title', 'الاجازات المعلقه')
@push('css')
    <!-- flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@section('content')


    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'الاجازات المعلقه',
        'previousPage' => 'لوحة التحكم',
        'urlPreviousPage' => 'employee-panel.index',
        'currentPage' => 'الاجازات المعلقه',
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
                            <h3 class="col-12 float-right">جدول أجازات <span class="text-secondary">الموظفين المعلقه</span>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @livewire('dashboard.leaves.leaves-pending-table')
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
@endpush
