@extends('dashboard.layouts.master')
@section('active-permissions', 'active')
@section('title', 'أنشاء أذونات')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@section('content')

    @include('dashboard.layouts.breadcrumb', [
        'pageTitle' => 'أنشاء أذونات',
        'previousPage' => 'جدول الأذونات',
        'urlPreviousPage' => 'permission.index',
        'currentPage' => 'أنشاء أذونات',
    ])

    @include('dashboard.layouts.message')

    <div class="row">
        <div class="col-md-12">

            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="card">
                <div class="card-header">
 
                </div>
                <div class="card-body">
                    <form action="{{ url('permissions') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="">الأسم</label>
                            <input type="text" name="name" class="form-control" />
                        </div>

                        <div class="mb-3">
                            <label for="category">الفئة</label>
                            <input type="text" class="form-control" name="category">
                        </div>
                        {{-- Submit --}}
                        <div class="card-footer text-center ">
                            <button type="submit" class="btn btn-primary">حفظ البيانات <i class="fas fa-save mx-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
