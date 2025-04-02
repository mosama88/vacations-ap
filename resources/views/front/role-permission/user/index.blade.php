@php
    use App\Enum\EmployeeStatus;
@endphp
@extends('dashboard.layouts.master')
@section('title', 'المستخدمين')
@section('active-users', 'active')
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
    <div class="card mt-3">
        <div class="card-header">
            <h4>المستخدمين</h4>
            @can('create user')
                <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
                    <a href="{{ url('users/create') }}" class="btn btn-outline-primary btn-block">أضافة مستخدم</a>
                </div>
            @endcan
        </div>
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>أسم المستخدم</th>
                        <th>أسم المستخدم</th>
                        <th>الصلاحيات</th>
                        <th>حالة الحساب</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->username }}</td>
                            <td>
                                @if (!empty($employee->getRoleNames()))
                                    @foreach ($employee->getRoleNames() as $rolename)
                                        <label class="badge bg-primary text-white mx-1">{{ $rolename }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if ($employee->status == EmployeeStatus::Active)
                                    <span class="label text-success d-flex">
                                        <div class="dot-label bg-success ml-1"></div>{{ __('نشط') }}
                                    </span>
                                @else
                                    <span class="label text-danger d-flex">
                                        <div class="dot-label bg-danger ml-1"></div>{{ __('غير نشط') }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @can('update user')
                                    <a href="{{ url('users/' . $employee->id . '/edit') }}"
                                        class="btn btn-outline-info btn-sm">تعديل</a>
                                @endcan

                                @can('delete user')
                                    <a href="#delete{{ $employee->id }}" data-effect="effect-scale" data-toggle="modal"
                                        class="btn btn-outline-danger btn-sm">حذف</a>
                                @endcan
                            </td>
                            @include('front.role-permission.user.delete')
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $employees->links() }}
        </div>
    </div>
@endsection
