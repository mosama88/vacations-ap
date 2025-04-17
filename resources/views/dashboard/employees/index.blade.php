@extends('dashboard.layouts.master')
@section('active-employees', 'active')
@section('title', 'الموظفين')
@push('css')
@endpush


@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'الموظفين',
        'previousPage' => 'لوحة التحكم',
        'urlPreviousPage' => 'employee-panel.index',
        'currentPage' => 'جدول الموظفين',
    ])

    @include('dashboard.layouts.message')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{ route('dashboard.employees.create') }}"
                                    class="btn btn-block text-white btn-success"> <i class="fas fa-plus-circle mx-1"></i>
                                    أنشاء</a>
                            </h3>

                            @livewire('dashboard.employees.employee-table')
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
