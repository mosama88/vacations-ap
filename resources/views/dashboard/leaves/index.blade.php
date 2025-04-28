@php
    use App\Enum\LeaveStatusEnum;
    use App\Enum\LeaveTypeEnum;
@endphp
@extends('dashboard.layouts.master')
@section('active-all', 'active')
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



                            @livewire('dashboard.leaves.leaves-table')


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
        flatpickr("#start_date_all_leave", {
            dateFormat: "Y-m-d",
            locale: "ar"
        });

        flatpickr("#end_date_all_leave", {
            dateFormat: "Y-m-d",
            locale: "ar"
        });
    </script>


@endpush
