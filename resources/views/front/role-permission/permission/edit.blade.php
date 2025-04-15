@extends('dashboard.layouts.master')
@section('active-permissions', 'active')
@section('title', 'تعديل أذونات')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'تعديل أذونات',
        'previousPage' => 'جدول الأذونات',
        'urlPreviousPage' => 'permission.index',
        'currentPage' => 'تعديل أذونات',
    ])

    @include('dashboard.layouts.message')

    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ url('permissions/' . $permission->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="">الأسم</label>
                    <input type="text" name="name" value="{{ $permission->name }}" class="form-control" />
                </div>
                {{-- Submit --}}
                <div class="card-footer text-center ">
                    <button type="submit" class="btn btn-info">حفظ البيانات <i class="fas fa-save mx-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
