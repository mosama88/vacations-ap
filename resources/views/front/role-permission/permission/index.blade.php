@extends('dashboard.layouts.master')
@section('active-leaves', 'active')
@section('title', 'أنشاء طلب أجازه')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content')

    @include('dashboard.layouts.breadcrumb-front', [
        'pageTitle' => 'أنشاء طلب أجازه',
        'previousPage' => 'جدول الأجازات',
        'urlPreviousPage' => 'employee-panel.user',
        'currentPage' => 'أنشاء طلب أجازه',
    ])

    @include('dashboard.layouts.message')

    <div class="card mt-3">
        <div class="card-header">
            <h4>الأذونات</h4>
            @can('create permission')
                <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
                    <a href="{{ url('permissions/create') }}" class="btn btn-outline-primary btn-block">أضافة أذونات جديده</a>
                </div>
            @endcan
        </div>
        <div class="card-body">

            <table id="example" class="table key-buttons text-md-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الأسم</th>
                        <th>الفئة</th>
                        <th width="40%">العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->category }}</td>

                            <td>
                                @can('update permission')
                                    <a href="{{ url('permissions/' . $permission->id . '/edit') }}"
                                        class="btn btn-outline-info btn-sm">تعديل</a>
                                @endcan

                                @can('delete permission')
                                    <a href="#delete{{ $permission->id }}" data-effect="effect-scale" data-toggle="modal"
                                        class="btn btn-outline-danger btn-sm">حذف</a>
                                @endcan
                            </td>
                        </tr>
                        @include('front.role-permission.permission.delete')
                    @endforeach
                </tbody>
            </table>
            {{ $permissions->links() }}
        </div>
    </div>
@endsection
