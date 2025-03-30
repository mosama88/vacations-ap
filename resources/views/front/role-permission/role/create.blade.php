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

<div class="card">
    <div class="card-header">
        <h4>إنشاء صلاحية
        </h4>
    </div>
    <div class="card-body">
        <form action="{{ url('roles') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="">أسم الصلاحية</label>
                <input type="text" name="name" class="form-control" />
            </div>
            {{-- Submit --}}
            <div class="row row-xs wd-xl-80p">
                <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0"><button type="submit"
                                                                         class="btn btn-success btn-with-icon btn-block"><i class="typcn typcn-edit"></i> تأكيد
                        البيانات</button>
                </div>
                <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0"><a
                        href="{{ url('roles') }}" type="submit"
                        class="btn btn-info btn-with-icon btn-block"><i
                            class="typcn typcn-arrow-back-outline"></i> رجوع</a></div>
            </div>
        </form>
    </div>
</div>
@endsection