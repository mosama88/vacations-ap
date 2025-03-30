@extends('dashboard.layouts.master')
@section('active-roles', 'active')
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

    <div class="container mt-5">
        <a href="{{ url('roles') }}" class="btn btn-primary mx-1">الصلاحيات</a>
        <a href="{{ url('permissions') }}" class="btn btn-info mx-1">الأذونات</a>
        <a href="{{ url('users') }}" class="btn btn-warning mx-1">المستخدمين</a>
    </div>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>الصلاحيات</h4>
                        @can('create role')
                            <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
                                <a href="{{ url('roles/create') }}" class="btn btn-outline-primary btn-block">أضافة صلاحية</a>
                            </div>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table id="example" class="table key-buttons text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>أسم الصلاحية</th>
                                        <th width="40%">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <a href="{{ url('roles/' . $role->id . '/give-permissions') }}"
                                                    class="btn btn-outline-warning btn-sm">
                                                    إضافة / تعديل أذونات الصلاحية
                                                </a>

                                                @can('update role')
                                                    <a href="{{ url('roles/' . $role->id . '/edit') }}"
                                                        class="btn btn-outline-info btn-sm">
                                                        تعديل
                                                    </a>
                                                @endcan

                                                @can('delete role')
                                                    <a href="#delete{{ $role->id }}" class="btn btn-outline-danger btn-sm"
                                                        data-toggle="modal">حذف</a>
                                                @endcan
                                            </td>
                                        </tr>
                                        @include('front.role-permission.role.delete')
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
