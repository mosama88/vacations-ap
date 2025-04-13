@php
    use App\Enum\LeaveBalanceStatus;
    use App\Livewire\Dashboard\LeaveBalance\LeaveBalanceTable;
@endphp
@extends('dashboard.layouts.master')
@section('active-leaveBalances', 'active')
@section('title', 'الصفحة الرئيسية')
@push('css')
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
@endpush
