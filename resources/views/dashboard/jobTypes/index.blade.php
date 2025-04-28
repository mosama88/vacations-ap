@extends('dashboard.layouts.master')
@section('active-jobTypes', 'active')
@section('title', 'نوع الوظيفه')
@push('css')
@endpush
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'نوع الوظيفه',
        'previousPage' => 'لوحة التحكم',
        'urlPreviousPage' => 'employee-panel.index',
        'currentPage' => 'جدول نوع الوظيفه',
    ])

    @include('dashboard.layouts.message')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{ route('dashboard.jobTypes.create') }}"
                                    class="btn btn-block text-white btn-success"> <i class="fas fa-plus-circle mx-1"></i>
                                    أنشاء</a>
                            </h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>أسم نوع الوظيفه</th>

                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $info)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $info->name }}</td>

                                            <td class="project-actions">
                                                @include('dashboard.partials.action', [
                                                    'name' => 'jobTypes',
                                                    'name_id' => $info,
                                                ])

                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-primary" role="alert">
                                            عفوآ لاتوجد بيانات
                                            !
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                {{ $data->links() }}
                            </div>
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
@endpush
