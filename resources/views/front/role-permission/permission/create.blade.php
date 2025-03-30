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
                    <h4>أنشاء أذونات جديده
                    </h4>
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
                        <div class="row row-xs wd-xl-80p">
                            <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0"><button type="submit"
                                    class="btn btn-success btn-with-icon btn-block"><i class="typcn typcn-edit"></i> تأكيد
                                    البيانات</button>
                            </div>
                            <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0"><a href="{{ url('permissions') }}"
                                    type="submit" class="btn btn-info btn-with-icon btn-block"><i
                                        class="typcn typcn-arrow-back-outline"></i> رجوع</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection