@extends('dashboard.layouts.master')
@section('active-roles', 'active')
@section('title', 'أنشاء صلاحية')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'أنشاء صلاحية',
        'previousPage' => 'جدول الصلاحيات',
        'urlPreviousPage' => 'roles.index',
        'currentPage' => 'أنشاء صلاحية',
    ])


    @include('dashboard.layouts.message')

    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ url('roles') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="">أسم الصلاحية</label>
                    <input type="text" name="name" class="form-control" />
                </div>
                {{-- Submit --}}
                <div class="card-footer text-center ">
                    <button type="submit" class="btn btn-primary">حفظ البيانات <i class="fas fa-save mx-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
