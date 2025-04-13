@php
    use App\Enum\LeaveBalanceStatus;
    use App\Livewire\Dashboard\LeaveBalance\LeaveBalanceTable;
@endphp
@extends('dashboard.layouts.master')
@section('active-leaveBalances', 'active')
@section('title', 'الصفحة الرئيسية')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'رصيد الأجازات',
        'previousPage' => 'لوحة التحكم',
        'urlPreviousPage' => 'employee-panel.index',
        'currentPage' => 'جدول رصيد الأجازات',
    ])

    @include('dashboard.layouts.message')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{ route('dashboard.leaveBalances.create') }}"
                                    class="btn btn-block text-white btn-success"> <i class="fas fa-plus-circle mx-1"></i>
                                    أنشاء</a>
                            </h3>

                            @livewire(LeaveBalanceTable::class)
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
